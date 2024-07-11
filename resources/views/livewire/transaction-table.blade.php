<div class="bg-light p-3 rounded">
    <table id="transactions-table" class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Monto</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction['id'] }}</td>
                    <td>{{ $transaction['code'] }}</td>
                    <td>{{ $transaction['amount'] }}</td>
                    <td>{{ $transaction['date'] }}</td>
                    <td>
                        <livewire:transaction-modal :transaction="$transaction"/>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


<script>
    $(document).ready(function () {
        $('#transactions-table').DataTable({
            responsive: true
        });
    });
</script>