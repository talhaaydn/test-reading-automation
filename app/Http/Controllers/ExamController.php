<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

use Auth;

use App\Exports\ExamResultsView;

use App\Models\Department;
use App\Models\YearTerm;
use App\Models\Course;
use App\Models\ExamType;
use App\Models\Assignment;
use App\Models\Exam;

class ExamController extends Controller
{
    // public function controlData($data) 
    // {
    //     $fields = array('name', 'surname', 'number', 'group', 'results');
    //     $errorFields = array();

    //     $error = false;
    //     for ($j=0; $j < count($fields); $j++) { 
    //         if(strstr($data[$fields[$j]], '*') || $data[$fields[$j]] == "") {
    //             $error = true;
    //             array_push($errorFields, $fields[$j]);
    //         }          
    //     }

    //     $data['error'] = $error;
    //     $data['error_fields'] = $errorFields;
    //     // dd($data);
    //     return $data;
    // }

    public function getAnswerKeys($answerKeyFile)
    {
        $answerKeys = [];
        foreach ($answerKeyFile as $key => $line) {
            $answerKey = explode(':', $line);

            $group = $answerKey[0];
            $results = trim($answerKey[1]);

            $answerKeys[] = [
                'group' => $group,
                'results' => $results,
            ];
        }

        return $answerKeys;
    }

    public function calculateResults($data, $answerKeys) 
    {
        $fields = array('group', 'results');

        $answers = array();
        $trueCount  = 0;
        $falseCount = 0;
        $emptyCount = 0;
        $score      = 0;
        foreach ($answerKeys as $key => $answerKey) {
            if($answerKey['group'] == $data['group']) {

                $questionNumber = strlen($answerKey['results']);
                $questionScore  = 100 / $questionNumber;

                for ($i=0; $i < $questionNumber; $i++) { 
                    if($answerKey['results'][$i] == $data['results'][$i]) {
                        $trueCount++;
                        $score += $questionScore;  
                        array_push($answers, (float) number_format($questionScore, 2, '.', ''));              
                    }
                    else if($data['results'][$i] == '*') {
                        $emptyCount++;
                        array_push($answers, 0);
                    } 
                    else if($data['results'][$i] != ' ' && $answerKey['results'][$i] != $data['results'][$i]) {
                        $falseCount++;
                        array_push($answers, 0);
                    }                      
                    else{
                        $emptyCount++;
                        array_push($answers, 0);
                    }                 
                }
            }
        }

        $data['trueCount'] = $trueCount;
        $data['falseCount'] = $falseCount;
        $data['emptyCount'] = $emptyCount;
        $data['score'] = round($score);
        $data['answers'] = $answers;
        // dd($data);
        return $data;
    }

    public function calculateAverage($examResults)
    {
        $average = array();
        foreach ($examResults as $key => $value) {
            $answers = $value['answers'];

            if ($key == 0) {
                for ($i=0; $i < count($answers); $i++) { 
                    array_push($average, 0);
                }
            }
            
            for ($i=0; $i < count($answers); $i++) { 
                $average[$i] += $answers[$i];
            }  
        }

        $studentNumber = count($examResults);
        for ($i=0; $i < count($average); $i++) { 
            $average[$i] = (float) number_format(($average[$i] / $studentNumber), 2, '.', '');                
        }        

        return $average;
    }

    public function index(Request $request) 
    {        
        
        $user = Auth::user();
        if ($user->role->name == 'Admin') {
            $departments = Department::all();
        } else {
            $userId = $user->id;
            $departments = DB::table('departments')
                ->join('user_course_assign', function ($join) use ($userId) {
                    $join->on('departments.id', '=', 'user_course_assign.department_id')
                        ->where('user_course_assign.user_id', $userId);
                })
                ->select('departments.*')
                ->distinct()
                ->get();
        }

        $yearTerms   = YearTerm::all();
        $examTypes   = ExamType::orderBy('id', 'ASC')->get();

        return view('exam.index', compact('departments', 'yearTerms', 'examTypes'));
    }

    public function examPost(Request $request) 
    {         
        $request->validate(
            [
                'department_id' => 'required',
                'year_term_id'  => 'required',
                'course_id'     => 'required',
                'exam_type_id'  => 'required',
            ],
            [
                'department_id.required' => "Bölüm alanı boş bırakılamaz.",
                'year_term_id.required'  => "Dönem alanı boş bırakılamaz.",
                'course_id.required'     => "Ders alanı boş bırakılamaz.",
                'exam_type_id.required'  => "Sınav Türü alanı boş bırakılamaz.",
            ]
        );

        $assigned = Assignment::where([
            ['department_id', '=', $request->department_id],
            ['year_term_id', '=', $request->year_term_id],
            ['course_id', '=', $request->course_id],
        ])->firstOrFail();

        // return $this->enterExamFile($request, $data);
        return redirect()
            ->route('exam.enter-file-index', ['assigned_id' => $assigned->id, 'exam_type_id' => $request->exam_type_id]);
    }

    public function examDetails($assigned_id, $exam_type_id) 
    {
        $assigned = Assignment::find($assigned_id);
            
        $department = $assigned->department->name;
        $yearTerm   = $assigned->yearTerm->year->year.' '.$assigned->yearTerm->term->term;
        $course     = $assigned->course->name;
        $examType   = ExamType::find($exam_type_id);

        $data = [
            'department' => $department,
            'yearTerm'   => $yearTerm,
            'course'     => $course,
            'assigned_id'=> $assigned->id,
            'examType'   => $examType,
        ];

        return $data;
    }

    public function enterExamFileIndex(Request $request, $assigned_id, $exam_type_id) 
    {
        // Atanmış dersin bilgilerini getirir.
        $examDetail = $this->examDetails($assigned_id, $exam_type_id);

        return view('exam.enter-file', compact('examDetail'));
    }    

    public function showResult(Request $request) 
    {
        $request->validate(
            [
                'examFile'      => 'required',
                'answerKeyFile' => 'required'
            ],
            [
                'examFile.required'       => "Sınav sonuçları dosyası alanı boş bırakılamaz.",
                'answerKeyFile.required'  => "Cevap Anahtarı dosyası alanı boş bırakılamaz."
            ]
        );

        if($request->examFile != null && $request->answerKeyFile != null) {    
            $examFile      = file($request->examFile);                
            $answerKeyFile = file($request->answerKeyFile); 

            // Cevap anahtarının sonuçları alındı.
            $answerKeys = $this->getAnswerKeys($answerKeyFile);

            $examResults = [];
            foreach($examFile as $key => $line) {

                $name    = trim(substr($line, 0, 12));
                $surname = trim(substr($line, 12, 12));
                $number  = trim(substr($line, 24, 9));
                $group   = trim(substr($line, 33, 1));

                $lineLenght    = strlen($line);
                $resultsLenght = $lineLenght - 34;
                $results       = substr($line, -$resultsLenght);                  

                $data = [
                    'name'        => iconv('ISO-8859-9', 'utf-8', $name), 
                    'surname'     => iconv('ISO-8859-9', 'utf-8', $surname),
                    'number'      => $number,
                    'group'       => $group,
                    'results'     => $results,
                ];

                // $examResults[] = $this->controlData($data);
                // Sınav sonuçları hesaplandı. Doğru, yanlış, boş, puan gibi ...
                $examResults[] = $this->calculateResults($data, $answerKeys);
            }            

            // Her bir sorunun ortalama puanı hesaplanıyor.
            $examResults['average'] = $this->calculateAverage($examResults);    

            // Atanmış dersin bilgilerini getirir.
            $examDetail = $this->examDetails($request->user_course_assign_id, $request->exam_type_id);

            $fields = array('name', 'surname', 'number', 'group', 'results', 'trueCount', 'falseCount', 'emptyCount', 'score');

            return view('exam.result', compact('fields', 'examResults', 'examDetail'));
            // return $this->convertISO($examResults);
        }

        $examResults = null;
        return view('exam.enter-file', compact('examResults'));
    }

    public function saveExcelView($assigned_id, $exam_type_id)
    {
        return view('exam.save-excel', compact('assigned_id', 'exam_type_id'));
    }

    public function saveExcel(Request $request)
    {
        $request->validate([
            'excelFile' => 'required|file|max:1024',
        ]);

        $fileName = time().'-'.$request->excelFile->getClientOriginalName();
        $request->excelFile->storeAs('public/exam', $fileName);
        
        $isExist = Exam::where([
            ['user_course_assign_id', '=', $request->user_course_assign_id],
            ['exam_type_id', '=', $request->exam_type_id],
        ])->get()->count();

        if($isExist > 0){
            return redirect('/list-exam')
                    ->with('warning', 'Bu sınav daha önce eklenmiş. Başka bir sınav ekleyebilirsiniz.');
        } else {
            Exam::create([
                'file'                  => $fileName,
                'user_course_assign_id' => $request->user_course_assign_id,
                'exam_type_id'          => $request->exam_type_id,
            ]);
    
            return redirect()->route('exam.list');
        }

        
    }

    public function examList(Request $request) 
    {   
        
        $examsArray = [];
        if(Auth::user()->role->name == 'Admin') {            
            
            $departments = DB::table('departments')
                ->join('user_course_assign', 'departments.id', '=', 'user_course_assign.department_id')
                ->select('departments.*')
                ->distinct()
                ->get();

            $classes = DB::table('classes')
                ->join('user_course_assign', 'classes.id', '=', 'user_course_assign.class_id')
                ->select('classes.*')
                ->distinct()
                ->get();

            $yearTerms = YearTerm::all();

            if($request->department_id != null && $request->class_id != null && $request->year_term_id != null){

                $assignedIds = array();
                $assigned = Assignment::where([
                    ['department_id', $request->department_id],
                    ['class_id', $request->class_id],
                    ['year_term_id', $request->year_term_id]
                ])->get();
                foreach ($assigned as $value) {
                    array_push($assignedIds, $value->id);
                }

                $exams = Exam::whereIn('user_course_assign_id', $assignedIds)->orderBy('user_course_assign_id', 'ASC')->get();

            } else {
                $exams = Exam::orderBy('user_course_assign_id', 'ASC')->get();
            }             

            $examTypes = ExamType::orderBy('id', 'ASC')->get();
            
            $index = 0;
            foreach ($exams as $key => $exam) {
                if($key == 0){
                    $examsArray[$index]['course'] = $exam->assignment->course->name;
                    $examsArray[$index]['department'] = $exam->assignment->department->name;
                    $examsArray[$index]['yearTerm'] = $exam->assignment->yearTerm->year->year.' '.$exam->assignment->yearTerm->term->term;
                    $examsArray[$index]['class'] = $exam->assignment->class->name;
                }
                else if($exams[$key-1]->user_course_assign_id == $exams[$key]->user_course_assign_id) {
                    $examsArray[$index]['course'] = $exam->assignment->course->name;
                    $examsArray[$index]['department'] = $exam->assignment->department->name;    
                    $examsArray[$index]['yearTerm'] = $exam->assignment->yearTerm->year->year.' '.$exam->assignment->yearTerm->term->term;
                    $examsArray[$index]['class'] = $exam->assignment->class->name;                                    
                }
                else{
                    $index++;
                    $examsArray[$index]['course'] = $exam->assignment->course->name;
                    $examsArray[$index]['department'] = $exam->assignment->department->name; 
                    $examsArray[$index]['yearTerm'] = $exam->assignment->yearTerm->year->year.' '.$exam->assignment->yearTerm->term->term;
                    $examsArray[$index]['class'] = $exam->assignment->class->name; 
                }

                foreach ($examTypes as $examType) {
                    if($examType->id == $exam->exam_type_id) {
                        $name = $examType->name.'-file';
                        $examsArray[$index][$name] = $exam->file;
                    }
                }               
            }
        } else {

            $departments = DB::table('departments')
                ->join('user_course_assign', 'departments.id', '=', 'user_course_assign.department_id')
                ->where('user_course_assign.user_id', Auth::user()->id)
                ->select('departments.*')
                ->distinct()
                ->get();

            $classes = DB::table('classes')
                ->join('user_course_assign', 'classes.id', '=', 'user_course_assign.class_id')
                ->select('classes.*')
                ->where('user_course_assign.user_id', Auth::user()->id)
                ->distinct()
                ->get();

            $yearTerms = YearTerm::all();

            if($request->department_id != null && $request->class_id != null && $request->year_term_id != null){

                $assignedIds = array();
                $assigned = Assignment::where([
                    ['department_id', $request->department_id],
                    ['class_id', $request->class_id],
                    ['year_term_id', $request->year_term_id],
                    ['user_id', Auth::user()->id]
                ])->get();
                foreach ($assigned as $value) {
                    array_push($assignedIds, $value->id);
                }

                $exams = Exam::whereIn('user_course_assign_id', $assignedIds)->orderBy('user_course_assign_id', 'ASC')->get();

            } else {
                $assignedIds = array();
                $assigned = Assignment::where('user_id', Auth::user()->id)->get();
                foreach ($assigned as $value) {
                    array_push($assignedIds, $value->id);
                }
                $exams = Exam::whereIn('user_course_assign_id', $assignedIds)->orderBy('user_course_assign_id', 'ASC')->get();
            }

            

            $examTypes = ExamType::orderBy('id', 'ASC')->get();
            
            $index = 0;
            foreach ($exams as $key => $exam) {
                if($key == 0){
                    $examsArray[$index]['course'] = $exam->assignment->course->name;
                    $examsArray[$index]['department'] = $exam->assignment->department->name;
                    $examsArray[$index]['yearTerm'] = $exam->assignment->yearTerm->year->year.' '.$exam->assignment->yearTerm->term->term;
                    $examsArray[$index]['class'] = $exam->assignment->class->name;
                }
                else if($exams[$key-1]->user_course_assign_id == $exams[$key]->user_course_assign_id) {
                    $examsArray[$index]['course'] = $exam->assignment->course->name;
                    $examsArray[$index]['department'] = $exam->assignment->department->name;    
                    $examsArray[$index]['yearTerm'] = $exam->assignment->yearTerm->year->year.' '.$exam->assignment->yearTerm->term->term; 
                    $examsArray[$index]['class'] = $exam->assignment->class->name;                                   
                }
                else{
                    $index++;
                    $examsArray[$index]['course'] = $exam->assignment->course->name;
                    $examsArray[$index]['department'] = $exam->assignment->department->name; 
                    $examsArray[$index]['yearTerm'] = $exam->assignment->yearTerm->year->year.' '.$exam->assignment->yearTerm->term->term; 
                    $examsArray[$index]['class'] = $exam->assignment->class->name;
                    // $index++;
                }

                foreach ($examTypes as $examType) {
                    if($examType->id == $exam->exam_type_id) {
                        $name = $examType->name.'-file';
                        $examsArray[$index][$name] = $exam->file;
                    }
                }               
            }
        }

        return view('exam.exam-list', compact('examsArray', 'departments', 'classes', 'yearTerms'));
    }

    public function filterExam(Request $request)
    {
        $request->validate(
            [
                'department_id'      => 'required',
                'class_id' => 'required',
                'year_term_id' => 'required',
            ],
            [
                'department_id.required'       => "Bölüm alanı boş bırakılamaz.",
                'class_id.required'  => "Sınıf alanı boş bırakılamaz.",
                'year_term_id.required'  => "Dönem alanı boş bırakılamaz.",
            ]
        );
    }

    public function getAssignedCourses(Request $request) 
    {

        if(Auth::user()->role->name == 'Admin') {
            $courses = DB::table('courses')
            ->join('user_course_assign', function ($join) use ($request) {
                $join->on('courses.id', '=', 'user_course_assign.course_id')
                    ->where([
                        ['user_course_assign.department_id', '=', $request->departmentId],
                        ['user_course_assign.year_term_id', '=', $request->yearTermId]
                    ]);
            })
            ->select('courses.id', 'courses.name')
            ->get();
        } else {
            $courses = DB::table('courses')
            ->join('user_course_assign', function ($join) use ($request) {
                $join->on('courses.id', '=', 'user_course_assign.course_id')
                    ->where([
                        ['user_course_assign.department_id', '=', $request->departmentId],
                        ['user_course_assign.year_term_id', '=', $request->yearTermId],
                        ['user_course_assign.user_id', '=', Auth::user()->id]
                    ]);
            })
            ->select('courses.id', 'courses.name')
            ->get();
        }

        return Response::json($courses);
    }
}
