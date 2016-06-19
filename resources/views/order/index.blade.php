@extends('app')

@section('content')

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Confirmação</h4>
                </div>

                <div class="modal-body">
                    Olá, <strong>{{ auth()->user()->name }}</strong>! Você confirma a exclusão do registro, abaixo:

                    <br>
                    <br>
                    <strong><div class="inner_2"></div></strong>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <a href="" class="btn btn-primary inner" role="button">Confirmar</a>
                </div>

            </div>

        </div>

    </div>
    <!-- Fim Modal -->

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-plug" aria-hidden="true"></i>
                    <h3 class="box-title">Criação de Ordem de Compra</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

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

                    <a href="{{ Route('order.create') }}" class="btn btn-primary" role="button">Adicionar Ordem</a>
                    <br>
                    <br>
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Status</th>
                            <th>Número da Ordem</th>
                            <th>Cliente</th>
                            <th>Data de Entrega</th>
                            <th>Quantidade de Itens</th>
                            <th>Ação</th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse($orders as $order)
                            <tr>
                                <td><a href="#">{{ $order->getStatus()}}</a></td>
                                <td># {{ $order->id }}</td>
                                <td>{{ $order->client_name }}</td>
                                <td>{{ $order->shipment_date }}</td>
                                <td> - </td>

                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default">Ação</button>
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="{{ Route('order.edit', $order->id) }}">Editar</a></li>
                                            <li><a onclick="show_modal('{{ Route('order.destroy', $order->id) }}', '{{ $order->name }}')" data-toggle="modal" data-target="#myModal" href="#">Excluir</a></li>
                                            <li><a href="#">Produtos</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td class="" colspan="7">
                                    <p> Nenhum item encontrado.</p>
                                </td>
                            </tr>

                        @endforelse

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Status</th>
                            <th>Número da Ordem</th>
                            <th>Cliente</th>
                            <th>Data de Entrega</th>
                            <th>Quantidade de Itens</th>
                            <th>Ação</th>
                        </tr>
                        </tfoot>
                    </table>

                    {!! $orders->render() !!}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <!-- /.content -->

    <!-- page script -->
    <script>

    </script>

    <input type="hidden" value="{{ $indice = '9' }}">

@endsection

@section('javascript')
    <script>
        function show_modal(url, content)
        {
            $( ".inner_2" ).empty();

            $(".inner").attr("href", url);
            $(".inner_2").append(content);
        }
    </script>

@endsection
