    <div class="col-md-6">

        <div class="form-group">

            {!! Form::label('client_name', 'Nome do Cliente:') !!}
            {!! Form::text('client_name', null, ['class'=>'form-control', 'placeholder' => 'Informe o nome completo do Cliente']) !!}

        </div>

        <div class="form-group">

            {!! Form::label('client_address', 'Endereço do Cliente:') !!}
            {!! Form::textarea('client_address', null, ['class'=>'form-control', 'placeholder' => 'Informe o endereço do Cliente']) !!}

        </div>

        <div class="form-group">

            {!! Form::label('client_phone', 'Telefone do Cliente:') !!}
            {!! Form::text('client_phone', null, ['class'=>'form-control', 'placeholder' => 'Informe o telefone do Cliente']) !!}

        </div>

    </div>

    <div class="col-md-6">

        <div class="form-group">

            {!! Form::label('client_email', 'E-mail do Cliente:') !!}
            {!! Form::text('client_email', null, ['class'=>'form-control', 'placeholder' => 'Informe o e-mail do Cliente']) !!}

        </div>

        <div class="form-group">

            {!! Form::label('shipment_date', 'Data de Entrega:') !!}
            {!! Form::date('shipment_date', null, ['class'=>'form-control', 'placeholder' => 'Data de Entrega']) !!}

        </div>

    </div>