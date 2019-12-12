@extends('master')

@section('title', 'Yıl-Dönem Ekleme Ekranı')

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Yıl-Dönem  Ekleme Ekranı</h3>
        </div>
        
        
        <form class="form-horizontal" method="POST" action="{{ route('year-term.store') }}">
            @csrf
            <div class="box-body">
                <div class="form-group @error('year_id') has-error @enderror">
                    <div class="row">
                        <label for="year_id" class="col-sm-2 control-label">Yıl</label>                                
                        <div class="col-sm-8">
                            <select class="form-control" name="year_id">
                                <option value="" disabled selected>Bir yıl seçin ...</option>
                                @foreach ($years as $item)
                                    <option value="{{ $item->id }}">{{ $item->year }}</option>
                                @endforeach
                            </select>
                            @error('year_id')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group @error('term_id') has-error @enderror">
                    <div class="row">
                        <label for="term_id" class="col-sm-2 control-label">Dönem</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="term_id">
                                <option value="" disabled selected>Bir dönem seçin ...</option>
                                @foreach ($terms as $item)
                                    <option value="{{ $item->id }}">{{ $item->term }}</option>
                                @endforeach
                            </select>
                            @error('term_id')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>                    
                </div>
            </div>

            <div class="box-footer">
                <a href="{{ route('year-term.index') }}" class="btn btn-secondary">Geri</a>
                <button type="submit" class="btn btn-primary" style="float: right;">Kaydet</button>
            </div>
        </form>

    </div>
@endsection