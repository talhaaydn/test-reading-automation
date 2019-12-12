<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Auth\LoginController@showLoginForm')->name('loginpage');
Route::post('login', 'Auth\LoginController@login')->name('login');

Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => ['auth']], function () {

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/permission-denied', 'DashboardController@permissionDenied')->name('permission-denied');

    Route::group(['middleware' => ['admin']], function () {
        Route::resource('faculty', 'FacultyController');
        Route::resource('class', 'ClassesController');
        Route::resource('term', 'TermController');
        Route::resource('year', 'YearController');
        Route::resource('year-term','YearTermController');

        Route::resource('department', 'DepartmentController');
        Route::get('department/{department}/qualification/create', 'QualificationController@create')->name('qualification.create');
        Route::post('qualification', 'QualificationController@store')->name('qualification.store');
        Route::get('department/{department}/qualification/edit', 'QualificationController@edit')->name('qualification.edit');
        Route::match(['PUT', 'PATCH'], 'qualification/{qualification}', 'QualificationController@update')->name('qualification.update');
        Route::delete('qualification/{qualification}', 'QualificationController@destroy')->name('qualification.destroy');

        Route::resource('course','CourseController');
        Route::get('course/{course}/gain/create', 'GainController@create')->name('gain.create');
        Route::post('gain', 'GainController@store')->name('gain.store');
        Route::get('course/{course}/gain/edit', 'GainController@edit')->name('gain.edit');
        Route::match(['PUT', 'PATCH'], 'gain/{gain}', 'GainController@update')->name('gain.update');
        Route::delete('gain/{gain}', 'GainController@destroy')->name('gain.destroy');

        Route::resource('user', 'UserController');
        Route::resource('assignment', 'AssignmentController');
    });

    Route::get('exam', 'ExamController@index')->name('exam.index');
    Route::post('exam', 'ExamController@examPost')->name('exam.post');
    Route::get('exam/enter-file/assignment/{assigned_id}/exam-type/{exam_type_id}', 'ExamController@enterExamFileIndex')->name('exam.enter-file-index');
    Route::post('exam/show-result', 'ExamController@showResult')->name('exam.enter-file');
    Route::get('exam/save-excel/assignment/{assigned_id}/exam-type/{exam_type_id}', 'ExamController@saveExcelView')->name('exam.save-excel');
    Route::post('exam/save-excel', 'ExamController@saveExcel')->name('exam.save-excel-db');
    Route::get('list-exam', 'ExamController@examList')->name('exam.list');

    
    Route::get('get-assigned-courses', 'ExamController@getAssignedCourses')->name('exam.get-assigned-courses');
});



