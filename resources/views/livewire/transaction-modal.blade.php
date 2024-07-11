<div>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
        data-bs-target="#modal_{{ $transaction['id'] }}">
        Editar
    </button>

    <div class="modal fade" id="modal_{{ $transaction['id'] }}" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="modal_{{ $transaction['id'] }}Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_{{ $transaction['id'] }}Label">Formulario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="transactionForm_{{ $transaction['id'] }}">
                        <div class="mb-3">
                            <label for="transactionId_{{ $transaction['id'] }}" class="form-label">ID</label>
                            <input type="text" class="form-control" id="transactionId_{{ $transaction['id'] }}"
                                value="{{ $transaction['id'] }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="codeSelect_{{ $transaction['id'] }}" class="form-label">Código</label>
                            <select class="form-select" id="codeSelect_{{ $transaction['id'] }}">
                                @if ($user && count($user) > 0)
                                    @foreach ($user as $data)
                                        <option value="{{ $data['code'] }}">{{ $data['code'] }}</option>
                                    @endforeach
                                @else
                                    <option disabled selected>No se obtuvieron datos</option>
                                @endif
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="amount_{{ $transaction['id'] }}" class="form-label">Monto</label>
                            <input type="text" class="form-control" id="amount_{{ $transaction['id'] }}"
                                value="{{ $transaction['amount'] }}">
                            <div id="amountError_{{ $transaction['id'] }}" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label for="date_{{ $transaction['id'] }}" class="form-label">Fecha</label>
                            <input type="text" class="form-control" id="date_{{ $transaction['id'] }}"
                                value="{{ $transaction['date'] }}">
                            <div id="dateError_{{ $transaction['id'] }}" class="text-danger"></div>
                        </div>

                        <div class="mb-3">
                            <label for="github_{{ $transaction['id'] }}" class="form-label">GitHub</label>
                            <input type="text" class="form-control" id="github_{{ $transaction['id'] }}">
                            <div id="githubError_{{ $transaction['id'] }}" class="text-danger"></div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-success"
                                onclick="submitForm('{{ $transaction['id'] }}')">Guardar
                                Cambios</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    async function submitForm(transactionId) {
        try {
            let id = document.getElementById('transactionId_' + transactionId).value;
            let code = document.getElementById('codeSelect_' + transactionId).value;
            let amount = document.getElementById('amount_' + transactionId).value;
            let date = document.getElementById('date_' + transactionId).value;
            let github = document.getElementById('github_' + transactionId).value;

            document.getElementById('amountError_' + transactionId).innerText = '';
            document.getElementById('dateError_' + transactionId).innerText = '';
            document.getElementById('githubError_' + transactionId).innerText = '';

            if (!amount.trim()) {
                document.getElementById('amountError_' + transactionId).innerText = 'El monto es requerido';
                return;
            }
            if (!date.trim()) {
                document.getElementById('dateError_' + transactionId).innerText = 'La fecha es requerida';
                return;
            }
            if (!github.trim()) {
                document.getElementById('githubError_' + transactionId).innerText = 'El enlace de GitHub es requerido';
                return;
            }

            let formData = {
                id: id,
                code: code,
                amount: amount,
                date: date,
                github: github
            };

            const response = await axios.post('/update-transaction', formData);

            console.log(response.data);
            $('#modal_' + transactionId).modal('hide');
            alert('Los cambios han sido guardados correctamente.');

        } catch (error) {
            if (error.response && error.response.status === 422) {
                const errors = error.response.data.errors;
                if (errors.amount) {
                    document.getElementById('amountError_' + transactionId).innerText = errors.amount[0];
                }
                if (errors.date) {
                    document.getElementById('dateError_' + transactionId).innerText = errors.date[0];
                }
                if (errors.github) {
                    document.getElementById('githubError_' + transactionId).innerText = errors.github[0];
                }
            } else {
                console.error(error);
                alert('Ocurrió un error al intentar guardar los cambios.');
            }
        }
    }
</script>