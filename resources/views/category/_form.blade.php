    <div class="col-md-6">

        <div class="form-group">

            {!! Form::label('name', 'Nome:') !!}
            {!! Form::text('name', null, ['class'=>'form-control', 'placeholder' => 'Informe o nome da categoria.']) !!}

        </div>

        <div class="form-group">

            {!! Form::label('description', 'Descrição:') !!}
            {!! Form::textarea('description', null, ['class'=>'form-control', 'placeholder' => 'Informe a descrição da categoria.']) !!}

        </div>

    </div>

    <div class="col-md-6">


    </div>