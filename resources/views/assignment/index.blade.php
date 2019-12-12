@extends('master')

@section('title', 'Atanmış Dersler Listesi')

@section('content')

    @include('layouts.message')  

    <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Atanmış Dersleri Filtrele</h3>
            </div>
    
            <div class="box-body">
                <form class="form-horizontal" method="GET" action="">
                    <div class="form-group @error('department_id') has-error @enderror">
                        <div class="row">
                            <label for="department_id" class="col-sm-2 control-label">Bölümler</label>                                
                            <div class="col-sm-8">
                                <select class="form-control" name="department_id">
                                    <option value="" disabled selected>Bir bölüm seçin ...</option>
                                    @foreach ($departments as $item)
                                        <option value="{{ $item->id }}" {{ Request()->department_id != null && $item->id == Request()->department_id ? 'selected' : '' }}>{{ $item->name }}</option>
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
                                        <option value="{{ $item->id }}" {{ Request()->class_id != null && $item->id == Request()->class_id ? 'selected' : '' }}>{{ $item->name }}</option>
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
                                        <option value="{{ $item->id }}" {{ Request()->year_term_id != null && $item->id == Request()->year_term_id ? 'selected' : '' }}>{{ $item->year->year }} {{ $item->term->term }}</option>
                                    @endforeach
                                </select>
                                @error('year_term_id')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>                    
                    </div>
        
                    <div class="box-footer text-right">
                        <button type="submit" class="btn btn-primary">Ara</button>
                    </div>
                </form>
            </div>
    </div>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Atanmış Dersler Listesi</h3>

            <a href="{{ route('assignment.create') }}" class="btn btn-add">
                <i class="fa fa-plus"></i> Ekle
            </a>
        </div>

        <div class="box-body table-responsive no-padding">
            @if (count($assignments) > 0)
            <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Bölüm</th>
                            <th>Dönem</th>
                            <th>Sınıf</th>
                            <th>Ders</th>
                            <th>Öğretim Görevlisi</th>
                            <th style="width: 105px"></th>
                        </tr>
    
                        @foreach ($assignments as $index => $item)
                            <tr>
                                <td>{{ ++$index }}.</td>
                                <td>{{ $item->department->name }}</td>
                                <td>{{ $item->yearTerm->year->year }} {{ $item->yearTerm->term->term }}</td>
                                <td>{{ $item->class->name }}</td>
                                <td>{{ $item->course->name }}</td>
                                <td>{{ $item->user->name }} {{ $item->user->surname }}</td>
                                <td>
                                    <a href="{{ route('assignment.edit', $item->id) }}" class="btn btn-action btn-edit" data-toggle="tooltip" data-placement="top" title="Düzenle">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <form action="{{ route('assignment.destroy', $item->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-action btn-delete" data-toggle="tooltip" data-placement="top" title="Sil" onclick="return confirm('Bu atanmış dersi silmek istediğinizden emin misiniz?');">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            
                        @endforeach
    
                    </tbody>
                </table>
            @else
                <div class="col-sm-12 text-center" style="padding: 20px 0; font-weight: 600; font-size: 16px;">
                    Atanmış bir ders kaydı bulunamadı.
                </div>
            @endif
            
        </div>
    </div>
@endsection