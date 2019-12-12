@extends('master')

@section('title', 'Okutulmuş Sınavlar Listesi')

@section('content')

    @include('layouts.message')  

    <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Okutulmuş Sınavları Filtrele</h3>
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
            <h3 class="box-title">Okutulmuş Sınavlar Listesi</h3>
        </div>

        <div class="box-body table-responsive no-padding">
            @if (count($examsArray) > 0)
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Bölüm</th>
                            <th>Ders</th>
                            <th>Dönem</th>
                            <th>Sınıf</th>
                            <th>Vize</th>
                            <th>Final</th>
                            <th>Bütünleme</th>
                        </tr>
                        
                        @foreach ($examsArray as $index => $item)
                            <tr>
                                <td>{{ ++$index }}.</td>
                                <td>{{ $item['department'] }}</td>
                                <td>{{ $item['course'] }}</td>
                                <td>{{ $item['yearTerm'] }}</td>
                                <td>{{ $item['class'] }}</td>
                                <td>
                                    @if (array_key_exists('Vize-file', $item))
                                        <a href="{{ asset('storage/exam/'.$item['Vize-file']) }}" download style="text-decoration: underline; color: #4272d7;">Vize</a>
                                    @else
                                        Vize
                                    @endif
                                </td>
                                <td>
                                    @if (array_key_exists('Final-file', $item))
                                        <a href="{{ asset('storage/exam/'.$item['Final-file']) }}" download style="text-decoration: underline; color: #4272d7;">Final</a>
                                    @else
                                        Final
                                    @endif
                                </td>
                                <td>
                                    @if (array_key_exists('Bütünleme-file', $item))
                                        <a href="{{ asset('storage/exam/'.$item['Bütünleme-file']) }}" download style="text-decoration: underline; color: #4272d7;">Bütünleme</a>
                                    @else
                                        Bütünleme
                                    @endif
                                </td>
                                {{-- <td>{{ $item->yearTerm->year->year }} {{ $item->yearTerm->term->term }}</td>
                                <td>{{ $item->course->name }}</td>
                                <td>{{ $item->user->name }} {{ $item->user->surname }}</td> --}}
                            </tr>
                            
                        @endforeach
    
                    </tbody>
                </table>
            @else
                <div class="col-sm-12 text-center" style="padding: 20px 0; font-weight: 600; font-size: 16px;">
                    Okutulmuş bir sınav bulunamadı.
                </div>
            @endif
            
        </div>
    </div>
@endsection