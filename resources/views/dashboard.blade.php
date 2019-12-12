@extends('master')

@section('title', 'Kontrol Paneli')

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Verilen Dersler Listesi</h3>
    </div>

    <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
            <tbody>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Bölüm</th>
                    <th>Dönem</th>
                    <th>Ders</th>
                </tr>

                @foreach ($assigned as $index => $item)
                    <tr>
                        <td>{{ ++$index }}.</td>
                        <td>{{ $item->department->name }}</td>
                        <td>{{ $item->yearTerm->year->year }} {{ $item->yearTerm->term->term }}</td>
                        <td>{{ $item->course->name }}</td>
                    </tr>
                    
                @endforeach

            </tbody>
        </table>
    </div>
</div>
@endsection