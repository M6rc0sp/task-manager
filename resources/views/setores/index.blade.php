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
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 col-md-6">
                            <h4>
                                Chamados
                            </h4>
                        </div>
                        <div class="col-6 col-md-6">
                            @if (Auth::user()->id == 1)
                                <button type="button" class="btn btn-success float-end" data-bs-toggle="modal"
                                    data-bs-target="#create-modal">
                                    Adicionar setor
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
                        @foreach ($setores as $setor)
                            @if ($setor->id != 1)
                                <div class="card text-left">
                                    <div class="card-header">
                                        <div class="col-6 col-md-6 float-left">
                                            {{ $setor->name }}
                                        </div>
                                        @if (Auth::user()->id == 1)
                                            <div class="col-6 col-md-6 float-right">
                                                <form action="{{ route('setores.delete', $setor->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger float-end"
                                                        data-nome="{{ $setor->name }}"
                                                        onclick="return confirmDelete(this)">Excluir</button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        function confirmDelete(button) {
            var nomeSetor = button.getAttribute("data-nome");
            return confirm("Tem certeza que deseja excluir o setor \"" + nomeSetor + "\"?");
        }
        setTimeout(function() {
            $('.alert-success').fadeOut('fast');
        }, 3000);
    </script>

    @include('setores.create')
@endsection
