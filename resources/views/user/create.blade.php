@extends('master')

@section('title', 'Kullanıcı Ekleme Ekranı')

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Kullanıcı Ekleme Ekranı</h3>
        </div>
        
        <form class="form-horizontal" method="POST" action="{{ route('user.store') }}">
            @csrf
            <div class="box-body">

                <div class="form-group @error('name') has-error @enderror">
                    <div class="row" style="margin-bottom: 10px;">
                        <label for="name" class="col-sm-2 control-label">Adı</label>                                
                        <div class="col-sm-8">
                            <input 
                                type="text" 
                                class="form-control" 
                                name="name" 
                                id="name"
                            >
                            @error('name')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group @error('surname') has-error @enderror">
                    <div class="row" style="margin-bottom: 10px;">
                        <label for="surname" class="col-sm-2 control-label">Soyadı</label>                                
                        <div class="col-sm-8">
                            <input 
                                type="text" 
                                class="form-control" 
                                name="surname" 
                                id="surname"
                            >
                            @error('surname')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="form-group @error('registration_number') has-error @enderror">
                    <div class="row" style="margin-bottom: 10px;">
                        <label for="registration_number" class="col-sm-2 control-label">Sicil Numarası</label>                                
                        <div class="col-sm-8">
                            <input 
                                type="text" 
                                class="form-control" 
                                name="registration_number" 
                                id="registration_number" 
                            >
                            @error('registration_number')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group @error('password') has-error @enderror">
                    <div class="row" style="margin-bottom: 10px;">
                        <label for="password" class="col-sm-2 control-label">Şifre</label>                                
                        <div class="col-sm-8">
                            <input 
                                type="password" 
                                class="form-control" 
                                name="password" 
                                id="password" 
                            >
                            @error('password')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group @error('role_id') has-error @enderror">
                    <div class="row" style="margin-bottom: 10px;">
                        <label for="role_id" class="col-sm-2 control-label">Kullanıcı Türü</label>                                
                        <div class="col-sm-8">
                            <select class="form-control" name="role_id" id="role_id">
                                <option value="" disabled selected>Bir kullanıcı türü seçin ...</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }} </option> 
                                @endforeach    
                            </select>
                            @error('role_id')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

            </div>
            
            <div class="box-footer">
                <a href="{{ route('user.index') }}" class="btn btn-secondary">Geri</a>
                <button type="submit" class="btn btn-primary" style="float: right;">Kaydet</button>
            </div>
        </form>

    </div>
@endsection