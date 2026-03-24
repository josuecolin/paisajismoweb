@extends('layouts.app')

@section('content')
<div class="container py-4">

    <!-- Título -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">📄 Logs del Sistema</h2>
        <span class="badge bg-secondary">Laravel</span>
    </div>

    <!-- Buscador -->
    <div class="mb-3">
        <input type="text" id="search" class="form-control" placeholder="🔍 Buscar en logs...">
    </div>

    <!-- Card principal -->
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center rounded-top-4">
            <span>Registro de actividad</span>
            <button class="btn btn-sm btn-outline-light" onclick="scrollToBottom()">⬇ Ir al final</button>
        </div>

        <div class="card-body p-0">
            <div id="logContainer" style="height: 500px; overflow-y: auto; background:#0d1117; color:#c9d1d9; font-family: monospace; padding:15px;">

                @foreach($logs as $log)
                    @php
                        $color = 'text-light';

                        if(str_contains($log, 'ERROR')) $color = 'text-danger';
                        elseif(str_contains($log, 'WARNING')) $color = 'text-warning';
                        elseif(str_contains($log, 'INFO')) $color = 'text-info';
                    @endphp

                    <div class="log-line {{ $color }}">
                        {{ $log }}
                    </div>
                @endforeach

            </div>
        </div>
    </div>

</div>

<!-- Scripts -->
<script>
    // Buscador en tiempo real
    document.getElementById('search').addEventListener('keyup', function() {
        let value = this.value.toLowerCase();
        let logs = document.querySelectorAll('.log-line');

        logs.forEach(log => {
            log.style.display = log.textContent.toLowerCase().includes(value) ? '' : 'none';
        });
    });

    // Scroll al final
    function scrollToBottom() {
        let container = document.getElementById('logContainer');
        container.scrollTop = container.scrollHeight;
    }

    // Auto scroll al cargar
    window.onload = () => scrollToBottom();
</script>

@endsection