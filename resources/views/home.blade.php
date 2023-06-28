@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Chamados Criados por Usuário</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Usuário</th>
                                    <th>Número de Chamados</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($chamadosCriadosPorUsuario as $usuario => $contagens)
                                    <tr>
                                        <td>{{ $usuario }}</td>
                                        <td>{{ array_sum($contagens) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Chamados Atendidos por Usuário</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Usuário</th>
                                    <th>Número de Chamados</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($chamadosAtendidosPorUsuario as $usuario => $contagens)
                                    <tr>
                                        <td>{{ $usuario }}</td>
                                        <td>{{ array_sum($contagens) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Chamados Pendentes por Setor</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Setor</th>
                                    <th>Número de Chamados</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($chamadosCriadosPorSetor as $setor => $contagens)
                                    <tr>
                                        <td><a href="{{URL::to('/')}}/chamados?sector={{ $setor }}">{{ $setor }}</a></td>
                                        <td>{{ array_sum($contagens) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Chamados Atendidos por Setor</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Setor</th>
                                    <th>Número de Chamados</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($chamadosAtendidosPorSetor as $setor => $contagens)
                                    <tr>
                                        <td><a href="{{URL::to('/')}}/chamados/concluidos?sector={{ $setor }}">{{ $setor }}</a></td>
                                        <td>{{ array_sum($contagens) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
