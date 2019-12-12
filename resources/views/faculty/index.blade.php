@extends('master')

@section('title', 'Fakülte Listesi')

@section('content')

    @include('layouts.message')  

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Fakülte Listesi</h3>

            <a href="{{ route('faculty.create') }}" class="btn btn-add">
                <i class="fa fa-plus"></i> Ekle
            </a>
        </div>

        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tbody>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Fakülte Adı</th>
                        <th style="width: 90px"></th>
                    </tr>

                    @foreach ($faculties as $index => $item)
                        <tr>
                            <td>{{ ++$index }}.</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <a href="{{ route('faculty.edit', $item->id) }}" class="btn btn-action btn-edit" data-toggle="tooltip" data-placement="top" title="Düzenle">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <form action="{{ route('faculty.destroy', $item->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-action btn-delete" data-toggle="tooltip" data-placement="top" title="Sil" onclick="return confirm('Bu fakülteyi silmek istediğinizden emin misiniz?');">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection