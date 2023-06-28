@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-3">
                Filtrar por setor:
            </div>
            <div class="col-md-6 float-right">
                <select class="form-control select2" id="sector-filter">
                    <option value="">Todos os setores</option>
                    @foreach ($setoresList as $sector)
                        <option value="{{ $sector }}" @if ($setorAtual == $sector) selected @endif>
                            {{ $sector }}</option>
                    @endforeach
                </select>
            </div>
            </br>
            </br>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6 col-md-6">
                                <h4>
                                    @if ($status == 0)
                                        Chamados
                                    @elseif ($status == 1)
                                        Em andamento
                                    @else
                                        Concluídos
                                    @endif
                                </h4>
                            </div>
                            <div class="col-6 col-md-6">
                                @if ($status == 0)
                                    <button type="button" class="btn btn-success float-end" data-bs-toggle="modal"
                                        data-bs-target="#create-modal">
                                        Adicionar chamado
                                    </button>
                                @endif
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
                            @foreach ($chamadosList as $chamado)
                                <div class="card text-center">
                                    <div class="card-header">
                                        <div class="col-5 col-md-5 align-middle">
                                            <h5 class="card-title">{{ $chamado->title }}</h5>
                                        </div>
                                        <div class="col-1 col-md-1 float-left">
                                            <i class="fa-sharp fa-solid fa-circle-exclamation" style="color: {{ $chamado->priority == 'low' ? 'green' : ($chamado->priority == 'medium' ? 'orange' : 'red')}}"></i>
                                        </div>
                                        <div class="col-6 col-md-6 float-right">
                                            <div class="float-right">
                                                @if ($status == 0)
                                                    <form action="{{ route('chamados.atenderChamado', $chamado->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-primary btn-sm float-right">
                                                            Atender
                                                        </button>
                                                    </form>
                                                @elseif($status == 1)
                                                    <form action="{{ route('chamados.finalizarChamado', $chamado->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <button class="btn btn-success btn-sm float-right">
                                                            Finalizar
                                                        </button>
                                                    </form>
                                                @else
                                                    <button class="btn btn-success btn-sm float-right" disabled>
                                                        Finalizado
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">{{ $chamado->text }}</p>
                                    </div>
                                    <div class="card-footer text-muted">
                                        {{ $chamado->createdByUser->name }} do setor
                                        {{ $chamado->createdByUser->sector }} criou o chamado
                                        {{ $chamado->tempoDecorrido }}
                                        <br />
                                        @if ($status == 1)
                            
                                        @endif
                                        @if ($status == 2)
                                            @isset($chamado->doneByUser)
                                                {{ $chamado->doneByUser->name }} do setor
                                                {{ $chamado->doneByUser->sector }} finalizou o chamado
                                                {{ $chamado->tempoFinalizado }}
                                            @endisset
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        setTimeout(function() {
            $('.alert-success').fadeOut('fast');
        }, 3000);
    </script>

    @include('chamados.create')
@endsection
