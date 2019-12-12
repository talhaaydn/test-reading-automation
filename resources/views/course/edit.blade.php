@extends('master')

@section('title', 'Ders Güncelleme Ekranı')

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Ders Güncelleme Ekranı</h3>
        </div>
        
        
        <form class="form-horizontal" method="POST" action="{{ route('course.update', $course->id) }}">
            @method('PATCH')
            @csrf
            <div class="box-body">
                <div class="form-group @error('course_code') has-error @enderror">
                    <div class="row">
                        <label for="course_code" class="col-sm-2 control-label">Ders Adı</label>                                
                        <div class="col-sm-8">
                            <input 
                                type="text" 
                                class="form-control" 
                                name="course_code" 
                                id="course_code" 
                                placeholder="Örn: TBL331"
                                value="{{ $course->course_code }}"
                            >
                            @error('course_code')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group @error('name') has-error @enderror">
                    <div class="row">
                        <label for="name" class="col-sm-2 control-label">Ders Adı</label>                                
                        <div class="col-sm-8">
                            <input 
                                type="text" 
                                class="form-control" 
                                name="name" 
                                id="name" 
                                placeholder="Örn: Yazılım Geliştirme Lab."
                                value="{{ $course->name }}"
                            >
                            @error('name')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <a href="{{ route('course.index') }}" class="btn btn-secondary">Geri</a>
                <button type="submit" class="btn btn-primary" style="float: right;">Kaydet</button>
            </div>
        </form>

    </div>
@endsection