@extends('master')

@section('title', 'Bölüm Yeterliliği Ekleme Ekranı')

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Bölüm Yeterliliği Ekleme Ekranı</h3>
        </div>
        
        <form class="form-horizontal" method="POST" action="{{ route('qualification.store') }}">
            @csrf
            <input type="hidden" name="department_id" value="{{ Request()->department->id }}">            
            <div class="box-body">
                @if ($qualificationCount > 0)
                    @foreach ($qualifications as $index => $item)                        
                        <div class="form-group" id="inserted_qualification">
                            <div class="row">
                                <label for="name" class="col-sm-2 control-label" style="line-height: 30px;">Yeterlilik - {{ ++$index }}</label>                                
                                <div class="col-sm-9">
                                    <input 
                                        type="text" 
                                        class="form-control"
                                        value="{{ $item->name }}"
                                        readonly
                                    >
                                </div>
                            </div>
                        </div>  
                    @endforeach 
                @else
                    @php
                        $index = 0;   
                    @endphp
                @endif                

                <div class="form-group @error('name.*') has-error @enderror">
                    <div class="row">
                        <label for="name" class="col-sm-2 control-label" style="line-height: 30px;">Yeterlilik - {{ ++$index }}</label>                                
                        <div class="col-sm-9">
                            <input 
                                type="text" 
                                class="form-control" 
                                name="name[]" 
                                id="name"
                            >
                            @error('name.*')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-1"><button class="btn btn-danger" id="removeInput">X</button></div>
                    </div>
                </div>

                <div class="row">                               
                    <div class="col-md-10 offset-md-2 col-sm-12">
                        <button class="btn add-new-input" id="add_new_input">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
            

            <div class="box-footer">
                <a href="{{ route('department.index') }}" class="btn btn-secondary">Geri</a>
                <button type="submit" class="btn btn-primary" style="float: right;">Kaydet</button>
            </div>
        </form>

    </div>

    <script>
        document.getElementById('add_new_input').addEventListener('click', (e) => {
            e.preventDefault();

            addNewInputButton = document.getElementById('add_new_input');
            modalBoxBody = document.getElementsByClassName('box-body')[0];

            // Önceden ekli olan alan değilse önceki removeInput button'u silinir.
            if(modalBoxBody.children[modalBoxBody.children.length - 2].id !== 'inserted_qualification'){
                // Önceki satırın içindeki removeInput alanı siliniyor.  
                modalBoxBody.children[modalBoxBody.children.length - 2].children[0].children[2].remove();
            }

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
        
        document.getElementsByClassName('box-body')[0].addEventListener('click', (e) => {
            e.preventDefault();
            if (e.target.id === "removeInput") {
                divRow = e.target.parentElement.parentElement.parentElement.parentElement.children[e.target.parentElement.parentElement.parentElement.parentElement.children.length -3].children[0];
                // console.log(divRow);

                if(divRow.parentElement.id != 'inserted_qualification') {
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
                }                

                // console.log(e.target.parentElement.parentElement.parentElement);
                e.target.parentElement.parentElement.parentElement.remove();
            }
        })
    </script>
@endsection