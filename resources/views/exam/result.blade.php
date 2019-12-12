@extends('master')

@section('title', 'Sınav Ekleme Ekranı')

@section('content') 

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title" style="font-size: 16px; font-weight: 400">
                {{ $examDetail['department'] }} > {{ $examDetail['yearTerm'] }} > {{ $examDetail['course'] }} > {{ $examDetail['examType']->name }}
            </h3>
        </div>

        @if ($examResults != null)
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>#</th>
                            <th>Ad</th>
                            <th>Soyad</th>
                            <th>Numara</th>
                            <th>Grup</th>
                            <th>Cevaplar</th>
                            <th>Doğru</th>
                            <th>Yanlış</th>
                            <th>Boş</th>
                            <th>Puan</th>
                        </tr>

                        @foreach ($examResults as $index => $item)
                            @if (isset($item['number']))
                                <tr>
                                    <td>{{ ++$index }}.</td>
                                    @foreach ($fields as $value)
                                        <td style="{{ $value == 'score' ? 'font-weight: bold;' : '' }}">{{ $item[$value] }}</td>
                                    @endforeach                                
                                </tr> 
                            @endif                                                   
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        @if ($examResults != null)

            @include('exam.exam-page1', $examResults)  

            @include('exam.exam-page2', $examResults)  
            
        @endif

        <div class="box-footer">
            <button type="submit" class="btn btn-primary" id="confirmExamResults">Excele Aktar</button>
            
            <form action="{{ route('exam.save-excel', ['assigned_id' => $examDetail['assigned_id'], 'exam_type_id' => $examDetail['examType']->id]) }}" method="GET" style="display: block; float:right">
                <button type="submit" class="btn btn-success" id="confirmExamResults">Exceli Kaydet</button>
            </form>          
        </div>

    </div>
@endsection

@push('scripts')
<script lang="javascript" src="{{ asset('js/xlsx.full.min.js') }}"></script>
<script lang="javascript" src="{{ asset('js/FileSaver.min.js') }}"></script>
<script>
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    @if ($examResults != null)  
        var workbook = XLSX.utils.book_new();
        
        var ws1 = XLSX.utils.table_to_sheet(document.getElementById('page1'));
        XLSX.utils.book_append_sheet(workbook, ws1, "Sayfa-1");
        
        var ws2 = XLSX.utils.table_to_sheet(document.getElementById('page2'));
        XLSX.utils.book_append_sheet(workbook, ws2, "Sayfa-2");

        var wbout = XLSX.write(workbook, {bookType:'xlsx', bookSST:true, type: 'binary'});

        function s2ab(s) {
            var buf = new ArrayBuffer(s.length);
            var view = new Uint8Array(buf);
            for (var i=0; i<s.length; i++) view[i] = s.charCodeAt(i) & 0xFF;
            return buf;
        }
        
        $("#confirmExamResults").click(function(){
            var fileName = '{{ $examDetail['yearTerm'] }}' + '_{{ $examDetail['examType']->name }}_' + '{{ $examDetail['course'] }}' + '_Soru_Bazlı_Degerlendirme.xlsx';
            fileName = fileName.split(' ').join('_');
            saveAs(new Blob([s2ab(wbout)],{type:"application/octet-stream"}), fileName);
        });
    @endif

</script>
@endpush