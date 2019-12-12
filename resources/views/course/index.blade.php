@extends('master')

@section('title', 'Ders Listesi')

@section('content')

    @include('layouts.message')  

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Ders Listesi</h3>

            <a href="{{ route('course.create') }}" class="btn btn-add">
                <i class="fa fa-plus"></i> Ekle
            </a>
        </div>

        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tbody>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Ders Kodu</th>
                        <th>Ders Adı</th>
                        <th>Ders Kazanımı</th>
                        <th style="width: 135px"></th>
                    </tr>

                    @foreach ($courses as $index => $item)
                        <tr>
                            <td>{{ ++$index }}.</td>
                            <td>{{ $item->course_code }}</td>   
                            <td>{{ $item->name }}</td>   
                            <td>
                                <button type="button" class="btn btn-sm btn-{{ $item->gains->count() > 0 ? 'success' : 'warning' }}">
                                    {{ $item->gains->count() > 0 ? 'Var' : 'Yok' }}
                                    <span class="badge badge-light">
                                        {{ $item->gains->count() }}
                                    </span>
                                </button>     
                            <td>
                                <a href="{{ route('course.edit', $item->id) }}" class="btn btn-action btn-edit" data-toggle="tooltip" data-placement="top" title="Düzenle">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <form action="{{ route('course.destroy', $item->id)}}" method="POST">
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
                                        <a href="{{ route('gain.create', $item->id) }}" class="dropdown-item">
                                            Kazanım Ekle
                                        </a>
                                        <a href="{{ route('gain.edit', $item->id) }}" class="dropdown-item">
                                            Kazanım Güncelle
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

    {{-- <script>
        document.getElementById('add_new_input').addEventListener('click', (e) => {
            e.preventDefault();

            addNewInputButton = document.getElementById('add_new_input');
            modalBoxBody = document.getElementsByClassName('box-body')[1];

            console.log(modalBoxBody.children[modalBoxBody.children.length - 2].children[0].children[2]);

            modalBoxBody.children[modalBoxBody.children.length - 2].children[0].children[2].remove();

            // Add Button Silindi.
            modalBoxBody.children[modalBoxBody.children.length - 1].remove();

            // Ekleme yapacağımız input oluşutruldu.
            var input = document.createElement("input"); 
            input.type = "text";
            input.classList.add('form-control');
            input.name = "name[]";
            input.id = "name-" + (modalBoxBody.children.length + 1);
            
            // İnputun divi oluşturuldu.
            var divColSm10 = document.createElement("div");
            divColSm10.classList.add('col-sm-9');
            divColSm10.appendChild(input);            

            // Label oluşturuldu.
            var label = document.createElement("label"); 
            label.for = "name-" + (modalBoxBody.children.length + 1);
            label.classList.add('col-sm-2', 'control-label');
            label.style = "line-height: 30px;";
            label.innerText = "Yeterlilik - " + (modalBoxBody.children.length + 1);

            // input silme butonunu oluşurdu.
            var deleteButton = document.createElement("button");
            deleteButton.classList.add('btn', 'btn-danger');
            deleteButton.id = "removeInput";
            deleteButton.innerText = "X";

            // silme butonunu kapsayan div oluşturuldu.
            var divColSm1 = document.createElement("div");
            divColSm1.classList.add('col-sm-1');
            divColSm1.appendChild(deleteButton);
            
            // div class="row" oluşturuldu bunun içine label ve input divi ve silme butonu divi eklendi.
            var divRow = document.createElement("div");
            divRow.classList.add('row');
            divRow.appendChild(label);
            divRow.appendChild(divColSm10);
            divRow.appendChild(divColSm1);

            // div class="forum-group" oluşturuldu içine üstteki row atıldı.
            var divFormGroup = document.createElement("div");
            divFormGroup.classList.add('form-group');
            divFormGroup.appendChild(divRow);

            // Ekleme butonunu kapsayan div oluşturulup içine ekleme butonu eklendi.
            var buttonDiv = document.createElement("div");
            buttonDiv.classList.add('col-md-10', 'offset-md-2', 'col-sm-12');
            buttonDiv.appendChild(addNewInputButton);
            
            var divRowButton = document.createElement("div");
            divRowButton.classList.add('row');
            divRowButton.appendChild(buttonDiv);
            
            modalBoxBody.appendChild(divFormGroup); // Ekleme inputu DOM'a eklendi.
            modalBoxBody.appendChild(divRowButton); // Ekleme butonu Dom'a eklendi.

        });
        
        document.getElementsByClassName('modal-body')[0].addEventListener('click', (e) => {
            e.preventDefault();
            if (e.target.id === "removeInput") {
                divRow = e.target.parentElement.parentElement.parentElement.parentElement.children[e.target.parentElement.parentElement.parentElement.parentElement.children.length -3].children[0];
                console.log(divRow);

                // input silme butonunu oluşurdu.
                var deleteButton = document.createElement("button");
                deleteButton.classList.add('btn', 'btn-danger');
                deleteButton.id = "removeInput";
                deleteButton.innerText = "X";

                // silme butonunu kapsayan div oluşturuldu.
                var divColSm1 = document.createElement("div");
                divColSm1.classList.add('col-sm-1');
                divColSm1.appendChild(deleteButton);

                divRow.appendChild(divColSm1);
                e.target.parentElement.parentElement.parentElement.remove();
            }

            // else if (e.target.id === "add_new_input")
            //     console.log(e.target.parentElement.parentElement.parentElement);
        })
    </script> --}}
@endsection