@extends('master')

@section('title', 'Sınav Ekleme Ekranı')

@section('content')

    @include('layouts.message')  

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title" style="font-size: 16px; font-weight: 400">
                {{ $examDetail['department'] }} > {{ $examDetail['yearTerm'] }} > {{ $examDetail['course'] }} > {{ $examDetail['examType']->name }}
            </h3>
        </div>

        <div class="box-body">
            <form method="POST" action="{{ route('exam.enter-file') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_course_assign_id" value="{{ Request()->assigned_id }}">
                <input type="hidden" name="exam_type_id" value="{{ Request()->exam_type_id }}">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group @error('examFile') has-error @enderror">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="uploadFileInput" name="examFile">
                                <label class="custom-file-label" for="uploadFileInput">Sınav Sonuçları Ekle</label>
                            </div>
                            @error('examFile')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group @error('answerKeyFile') has-error @enderror">
                            <div class="custom-file mt-2">
                                <input type="file" class="custom-file-input" id="uploadFileInput" name="answerKeyFile">
                                <label class="custom-file-label" for="uploadFileInput">Cevap Anahtarı Ekle</label>
                            </div>
                            @error('answerKeyFile')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary w-100 mt-3" id="upload-file">Listele</button>
                    </div>
                </div>
            </form>

        </div>

    </div>
@endsection

@push('scripts')
<script>
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
@endpush