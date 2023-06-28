<div class="modal fade" id="create-modal" tabindex="-1" aria-labelledby="create-chamados" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="create-chamados">Título do Modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <form method="POST" action="{{ route('chamados.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Título</label>
                        <input type="text" class="form-control" id="title" name="title">
                    </div>
                    <div class="mb-3">
                        <label for="text" class="form-label">Texto</label>
                        <input type="text" class="form-control" id="text" name="text">
                    </div>
                    <div class="mb-3">
                        <label for="text" class="form-label">Prioridade</label>
                        <select id="priority" name="priority" class="form-control select2">
                            <option value="low" selected>Baixa</option>
                            <option value="medium">Médio</option>
                            <option value="high">Alta</option>
                        </select>
                    </div>
                    <input type="text" class="form-control" id="status" name="status" value="pending" hidden>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-success">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
