@extends('master')

@section('title', 'Bölüm Listesi')

@section('content')

    @include('layouts.message')  

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Bölüm Listesi</h3>

            <a href="{{ route('department.create') }}" class="btn btn-add">
                <i class="fa fa-plus"></i> Ekle
            </a>
        </div>

        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tbody>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th style="width: 350px">Bölüm</th>
                        <th>Fakülte</th>
                        <th>Yeterlilik Sayısı</th>
                        <th style="width: 135px"></th>
                    </tr>

                    @foreach ($departments as $index => $item)
                        <tr>
                            <td>{{ ++$index }}.</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->faculty->name }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-{{ $item->qualifications->count() > 0 ? 'success' : 'warning' }}">
                                    {{ $item->qualifications->count() > 0 ? 'Var' : 'Yok' }}
                                    <span class="badge badge-light">
                                        {{ $item->qualifications->count() }}
                                    </span>
                                </button>                                
                            </td>
                            <td>
                                <a href="{{ route('department.edit', $item->id) }}" class="btn btn-action btn-edit" data-toggle="tooltip" data-placement="top" title="Düzenle">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <form action="{{ route('department.destroy', $item->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-action btn-delete" data-toggle="tooltip" data-placement="top" title="Sil" onclick="return confirm('Bu fakülteyi silmek istediğinizden emin misiniz?');">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                <div class="dropdown btn-action">
                                    <button class="btn dropdown-toggle btn-action other-options" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                        <a href="{{ route('qualification.create', $item->id) }}" class="dropdown-item">
                                            Yeterlilik Ekle
                                        </a>
                                        <a href="{{ route('qualification.edit', $item->id ) }}" class="dropdown-item">
                                            Yeterlilik Güncelle
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection