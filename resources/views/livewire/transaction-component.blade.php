<div class="table-responsive">
    @if ($loader)
        <div class="d-flex flex-column justify-content-center align-items-center h-100">
            @include('components.loader')
        </div>
    @endif

    @if ($error)
        <div class="d-flex flex-column justify-content-center align-items-center h-100">
            @include('components.error', ['message' => 'Hubo un problema al obtener los datos de tabla de usuarios.'])
        </div>
    @else
        @if ($transactions && count($transactions) > 0)
            <livewire:transaction-table :transactions="$transactions"/>
        @else
            <div class="d-flex flex-column justify-content-center align-items-center h-100">
                <p>No se encontraron transacciones.</p>
            </div>
        @endif
    @endif
</div>
