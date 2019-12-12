@extends('master')

@section('title', 'Test Sınavı Ekleme Ekranı')

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Test Sınavını Seç</h3>
        </div>
        
        <div class="box-body">
        <form class="form-horizontal" method="POST" action="{{ route('exam.post') }}">
            @csrf
                <div class="form-group @error('department_id') has-error @enderror">
                    <div class="row">
                        <label for="department_id" class="col-sm-2 control-label">Bölüm</label>                                
                        <div class="col-sm-8">
                            <select class="form-control" name="department_id" id="departments">
                                <option value="" disabled selected>Bir bölüm seçin ...</option>
                                @foreach ($departments as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('department_id')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group @error('year_term_id') has-error @enderror">
                    <div class="row">
                        <label for="year_term_id" class="col-sm-2 control-label">Dönem</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="year_term_id" id="year_terms">
                                <option value="" disabled selected>Bir dönem seçin ...</option>
                                @foreach ($yearTerms as $item)
                                    <option value="{{ $item->id }}">{{ $item->year->year }} {{ $item->term->term }}</option>
                                @endforeach
                            </select>
                            @error('year_term_id')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>                    
                </div>

                <div class="form-group @error('course_id') has-error @enderror">
                    <div class="row">
                        <label for="course_id" class="col-sm-2 control-label">Ders</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="course_id" id="courses">
                                <option value="" disabled selected>Bir ders seçin ...</option>
                            </select>
                            @error('course_id')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>                    
                </div>

                <div class="form-group @error('exam_type_id') has-error @enderror">
                    <div class="row">
                        <label for="exam_type_id" class="col-sm-2 control-label">Sınav Türü</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="exam_type_id">
                                <option value="" disabled selected>Bir sınav türü seçin ...</option>
                                @foreach ($examTypes as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('exam_type_id')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>                    
                </div>

            <div class="box-footer text-right" style="padding-bottom: 0px">
                <button type="submit" class="btn btn-primary">Onayla</button>
            </div>
        </form>

    </div>
@endsection

@push('scripts')

<script>
    $("#year_terms").on("change", function() {
        var departmentId = $("#departments").val();
        var yearTermId = $("#year_terms").val();
        
        if(departmentId != null && yearTermId != null) {
            $.ajax({
                type: 'GET',
                url: '{{ route('exam.get-assigned-courses') }}',
                data: {
                    departmentId: departmentId,
                    yearTermId: yearTermId
                },
                success: function(data) {
                    if(data.length > 0) {
                        clearOptions()

                        $.each(data, function (i, item) {
                            $('#courses').append($('<option>', { 
                                value: item.id,
                                text : item.name 
                            }));
                        });
                    } else {
                        clearOptions()
                    }
                }
            });

            function clearOptions() {
                $('#courses')
                    .empty()
                    .append('<option value="" disabled selected>Bir ders seçin ...</option>');
            }
        }
    });
</script>

@endpush