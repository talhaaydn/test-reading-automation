@extends('master')

@section('title', 'Dönem Güncelleme Ekranı')

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Dönem Güncelleme Ekranı</h3>
        </div>
        
        <form class="form-horizontal" method="POST" action="{{ route('term.update', $term->id) }}">
            @method('PATCH') 
            @csrf
            <div class="box-body">
                <div class="form-group @error('term') has-error @enderror">
                    <div class="row">
                        <label for="term" class="col-sm-2 control-label">Dönem Adı</label>                                
                        <div class="col-sm-10">
                            <input 
                                type="text" 
                                class="form-control" 
                                name="term" 
                                id="term" 
                                placeholder="Örn: Güz Dönemi, Bahar Dönemi"
                                value="{{ $term->term }}"
                            >
                            @error('term')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <a href="{{ route('term.index') }}" class="btn btn-secondary">Geri</a>
                <button type="submit" class="btn btn-primary" style="float: right;">Kaydet</button>
            </div>
        </form>

    </div>
@endsection