@extends('app')

@section('content')

    <!-- SELECT2 EXAMPLE -->
    <div class="box box-primary">
        {!! Form::open(['route'=>'admin.category.store', 'method'=>'post']) !!}
            <div class="box-header with-border">
                <i class="fa fa-eye" aria-hidden="true"></i>
                <h3 class="box-title">Criar Categoria</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">

                    @if ($errors->any())
                        <div class="col-md-11">
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h4><i class="icon fa fa-ban"></i> Alerta!</h4>
                                <ul class="alert">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    @include('category._form')

                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <a href="{{ Route('admin.category.index') }}" class="btn btn-primary" role="button">Retornar</a>
                    {!! Form::submit('Adicionar Categoria', ['class'=> 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
    </div>
    <!-- /.box -->

@endsection

@section('javascript')
    <script>
        $( ".target" ).change(function() {
            var content = $( ".target" ).val()
            $( ".inner" ).empty();
            $( ".inner" ).append(content);
        });
    </script>


@endsection