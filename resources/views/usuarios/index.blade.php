@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6 col-md-6">
                                <h4>Usuários</h4>
                            </div>
                            <div class="col-6 col-md-6">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="col-12 col-md-12">
                            @foreach ($users as $usuario)
                                    <div class="card text-center">
                                        <div class="card-header">
                                            <h5 class="card-title">{{ $usuario->name }}</h5>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">Esse usuário criou {{ $usuario->total_chamados }} chamados.</p>
                                            <p class="card-text">Esse usuário atendeu {{ $usuario->chamados_atendidos }} chamados.</p>
                                            <p class="card-text">Esse usuário criou {{ $usuario->chamados_ativos }} chamados que ainda estão pendentes.</p>
                                        </div>
                                        <div class="card-footer text-muted">
                                            {{ $usuario->id }}
                                        </div>
                                    </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
