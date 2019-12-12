@extends('master')

@section('title', 'Ders Ekleme Ekranı')

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Ders Ekleme Ekranı</h3>
        </div>
        
        
        <form class="form-horizontal" method="POST" action="{{ route('course.store') }}">
            @csrf
            <div class="box-body">
                <div class="form-group @error('course_code') has-error @enderror">
                    <div class="row">
                        <label for="course_code" class="col-sm-2 control-label">Ders Kodu</label>                                
                        <div class="col-sm-8">
                            <input 
                                type="text" 
                                class="form-control" 
                                name="course_code" 
                                id="course_code" 
                                placeholder="Örn: TBL103"
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