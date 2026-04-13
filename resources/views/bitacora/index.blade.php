@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Bitácora del Sistema</h2>

    <!-- 🔍 FILTROS -->
    <form method="GET" class="card p-3 mb-4 shadow-sm">
        <div class="row">

            <!-- Usuario -->
            <div class="col-md-3">
                <label>Usuario</label>
                <select name="user_id" class="form-control">
                    <option value="">Todos</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}"
                            {{ request('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Acción -->
            <div class="col-md-3">
                <label>Acción</label>
                <select name="accion" class="form-control">
                    <option value="">Todas</option>
                    <option value="CREATE" {{ request('accion')=='CREATE' ? 'selected' : '' }}>CREATE</option>
                    <option value="UPDATE" {{ request('accion')=='UPDATE' ? 'selected' : '' }}>UPDATE</option>
                    <option value="DELETE" {{ request('accion')=='DELETE' ? 'selected' : '' }}>DELETE</option>
                </select>
            </div>

            <!-- Fecha inicio -->
            <div class="col-md-2">
                <label>Desde</label>
                <input type="date" name="fecha_inicio" class="form-control"
                       value="{{ request('fecha_inicio') }}">
            </div>

            <!-- Fecha fin -->
            <div class="col-md-2">
                <label>Hasta</label>
                <input type="date" name="fecha_fin" class="form-control"
                       value="{{ request('fecha_fin') }}">
            </div>

            <!-- Botones -->
            <div class="col-md-2 d-flex align-items-end">
                <button class="btn btn-primary w-100">Filtrar</button>
            </div>
        </div>
    </form>

    <!-- 📊 TABLA -->
    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Usuario</th>
                        <th>Acción</th>
                        <th>Tabla</th>
                        <th>ID</th>
                        <th>Descripción</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                        <tr>
                            <td>{{ $log->user->name ?? 'Sistema' }}</td>

                            <td>
                                <span class="badge 
                                    @if($log->accion=='CREATE') bg-success 
                                    @elseif($log->accion=='UPDATE') bg-warning 
                                    @else bg-danger @endif">
                                    {{ $log->accion }}
                                </span>
                            </td>

                            <td>{{ $log->tabla }}</td>
                            <td>{{ $log->registro_id }}</td>
                            <td>{{ $log->descripcion }}</td>
                            <td>{{ $log->created_at }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No hay registros</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- 📄 PAGINACIÓN -->
            {{ $logs->links() }}
        </div>
    </div>
</div>
@endsection