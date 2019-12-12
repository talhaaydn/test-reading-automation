@extends('master')

@section('title', 'Bölüm Yeterliliği Güncelleme Ekranı')

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Bölüm Yeterliliği Güncelleme Ekranı</h3>
        </div>

        <div class="box-body">
            @foreach ($qualifications as $index => $item)
                <div class="form-group">
                    <div class="row">
                        <label for="name" class="col-sm-1 control-label" style="line-height: 30px;">{{ ++$index }} -</label>                                
                        <div class="col-sm-9">
                            <form action="{{ route('qualification.update', $item->id) }}" method="POST">
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    name="name" 
                                    id="name"
                                    value="{{ $item->name }}"
                                >
                        </div>
                        <div class="col-sm-2">                                    
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="department_id" value="{{ Request()->department->id }}">
                                <button type="submit" class="btn btn-action btn-edit" data-toggle="tooltip" data-placement="top" title="Güncelle">
                                    <i class="fas fa-pen"></i>
                                </button>
                            </form>
                            <form action="{{ route('qualification.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="department_id" value="{{ Request()->department->id }}">
                                <button type="submit" class="btn btn-action btn-delete" data-toggle="tooltip" data-placement="top" title="Sil" onclick="return confirm('Bu bölüm yeterliliğini silmek istediğinizden emin misiniz?');">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>  
            @endforeach                   

            </div>
            <div class="box-footer">
                <a href="{{ route('department.index') }}" class="btn btn-secondary">Geri</a>
                <button type="submit" class="btn btn-primary" style="float: right;">Kaydet</button>
            </div>
        </form>

    </div>
@endsection