@extends('master')

@section('title', 'Ders Atama Güncelleme Ekranı')

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Ders Atama Güncelleme Ekranı</h3>
        </div>
        
        <div class="box-body">
        <form class="form-horizontal" method="POST" action="{{ route('assignment.update', $assignment->id) }}">
            @method('PATCH')
            @csrf
                <div class="form-group @error('department_id') has-error @enderror">
                    <div class="row">
                        <label for="department_id" class="col-sm-2 control-label">Bölümler</label>                                
                        <div class="col-sm-8">
                            <select class="form-control" name="department_id">
                                <option value="" disabled selected>Bir bölüm seçin ...</option>
                                @foreach ($departments as $item)
                                    <option value="{{ $item->id }}" {{ $assignment->department_id == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('department_id')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group @error('class_id') has-error @enderror">
                    <div class="row">
                        <label for="class_id" class="col-sm-2 control-label">Sınıflar</label>                                
                        <div class="col-sm-8">
                            <select class="form-control" name="class_id">
                                <option value="" disabled selected>Bir sınıf seçin ...</option>
                                @foreach ($classes as $item)
                                    <option value="{{ $item->id }}" {{ $assignment->class_id == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('class_id')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group @error('year_term_id') has-error @enderror">
                    <div class="row">
                        <label for="year_term_id" class="col-sm-2 control-label">Dönemler</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="year_term_id">
                                <option value="" disabled selected>Bir dönem seçin ...</option>
                                @foreach ($yearTerms as $item)
                                    <option value="{{ $item->id }}" {{ $assignment->year_term_id == $item->id ? 'selected' : '' }}>
                                        {{ $item->year->year }} {{ $item->term->term }}
                                    </option>
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
                        <label for="course_id" class="col-sm-2 control-label">Dersler</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="course_id">
                                <option value="" disabled selected>Bir ders seçin ...</option>
                                @foreach ($courses as $item)
                                    <option value="{{ $item->id }}" {{ $assignment->course_id == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('course_id')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>                    
                </div>

                <div class="form-group @error('user_id') has-error @enderror">
                    <div class="row">
                        <label for="user_id" class="col-sm-2 control-label">Öğretim Görevlileri</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="user_id">
                                <option value="" disabled selected>Bir öğretim görevlisi seçin ...</option>
                                @foreach ($users as $item)
                                    <option value="{{ $item->id }}" {{ $assignment->user_id == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }} {{ $item->surname }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>                    
                </div>

            <div class="box-footer">
                <a href="{{ route('assignment.index') }}" class="btn btn-secondary">Geri</a>
                <button type="submit" class="btn btn-primary" style="float: right;">Kaydet</button>
            </div>
        </form>

    </div>
@endsection