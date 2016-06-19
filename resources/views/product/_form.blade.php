    <div class="col-md-6">

        <div class="form-group">

            {!! Form::label('name', 'Nome:') !!}
            {!! Form::text('name', null, ['class'=>'form-control', 'placeholder' => 'Informe o nome do Produto']) !!}

        </div>

        <div class="form-group">

            {!! Form::label('description', 'Descrição:') !!}
            {!! Form::textarea('description', null, ['class'=>'form-control', 'placeholder' => 'Informe a descrição do Produto']) !!}

        </div>

    </div>

    <div class="col-md-6">

        <div class="form-group">

            {!! Form::label('price', 'Preço:') !!}
            {!! Form::text('price', null, ['class'=>'form-control', 'placeholder' => 'Informe o preço do Produto']) !!}

        </div>

        <div class="form-group">

            {!! Form::label('category_id', 'Categoria:') !!}
            {!! Form::select('category_id', array('' => '') + $categories->toArray(), null, ['class'=>'form-control']) !!}

        </div>

    </div>