@extends('master')

@section('title', 'Yıl Ekleme Ekranı')

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Yıl Ekleme Ekranı</h3>
        </div>
        
        <form class="form-horizontal" method="POST" action="{{ route('year.store') }}">
            @csrf
            <div class="box-body">
                <div class="form-group @error('year') has-error @enderror">
                    <div class="row">
                        <label for="year" class="col-sm-2 control-label">Yıl Adı</label>                                
                        <div class="col-sm-10">
                            <input 
                                type="text" 
                                class="form-control" 
                                name="year" 
                                id="year" 
                                placeholder="Örn: 2019-2020"
                            >
                            @error('year')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="box-footer">
                <a href="{{ route('year.index') }}" class="btn btn-secondary">Geri</a>
                <button type="submit" class="btn btn-primary" style="float: right;">Kaydet</button>
            </div>
        </form>

    </div>
@endsection