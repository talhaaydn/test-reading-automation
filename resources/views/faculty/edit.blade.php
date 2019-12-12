@extends('master')

@section('title', 'Fakülte Güncelleme Ekranı')

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Fakülte Güncelleme Ekranı</h3>
        </div>
        
        <form class="form-horizontal" method="POST" action="{{ route('faculty.update', $faculty->id) }}">
            @method('PATCH') 
            @csrf
            <div class="box-body">
                <div class="form-group @error('name') has-error @enderror">
                    <div class="row">
                        <label for="name" class="col-sm-2 control-label">Fakülte Adı</label>                                
                        <div class="col-sm-10">
                            <input 
                                type="text" 
                                class="form-control" 
                                name="name" 
                                id="name" 
                                placeholder="Örn: Teknoloji Fakültesi"
                                value="{{ $faculty->name }}"
                            >
                            @error('name')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>                
            </div>

            <div class="box-footer">
                <a href="{{ route('faculty.index') }}" class="btn btn-secondary">Geri</a>
                <button type="submit" class="btn btn-primary" style="float: right;">Kaydet</button>
            </div>
        </form>

    </div>
@endsection