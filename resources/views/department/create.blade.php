@extends('master')

@section('title', 'Bölüm Ekleme Ekranı')

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Bölüm Ekleme Ekranı</h3>
        </div>
        
        
        <form class="form-horizontal" method="POST" action="{{ route('department.store') }}">
            @csrf
            <div class="box-body">
                <div class="form-group @error('name') has-error @enderror">
                    <div class="row">
                        <label for="name" class="col-sm-2 control-label">Bölüm Adı</label>                                
                        <div class="col-sm-8">
                            <input 
                                type="text" 
                                class="form-control" 
                                name="name" 
                                id="name" 
                                placeholder="Örn: Bilişim Sistemleri Mühendisliği"
                            >
                            @error('name')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group @error('faculty_id') has-error @enderror">
                    <div class="row">
                        <label for="faculty_id" class="col-sm-2 control-label">Fakülte Adı</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="faculty_id">
                                <option value="" disabled selected>Bir fakülte seçin ...</option>
                                @foreach ($faculties as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('faculty_id')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>                    
                </div>
            </div>
            
            <div class="box-footer">
                <a href="{{ route('department.index') }}" class="btn btn-secondary">Geri</a>
                <button type="submit" class="btn btn-primary" style="float: right;">Kaydet</button>
            </div>
        </form>

    </div>
@endsection