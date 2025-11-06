<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inventario - Almacenista</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-4">
        <h2 class="text-center mb-4">Gestión de Inventario</h2>

        
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">Registrar movimiento</div>
            <div class="card-body">
                <form method="POST" action="{{ route('inventario.registrar') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Producto</label>
                            <input type="text" name="producto_nombre" class="form-control" placeholder="Nombre del producto" required>
                        </div>

                        <div class="col-md-2">
                            <label class="form-label">Categoría</label>
                            <input type="text" name="categoria" class="form-control" placeholder="Ej: Motor, Aceite">
                        </div>

                        <div class="col-md-2">
                            <label class="form-label">Precio</label>
                            <input type="number" name="precio" step="0.01" min="0" class="form-control" placeholder="Ej: 25000">
                        </div>

                        <div class="col-md-2">
                            <label class="form-label">Tipo</label>
                            <select name="tipo" class="form-select" required>
                                <option value="entrada">Entrada</option>
                                <option value="salida">Salida</option>
                            </select>
                        </div>

                        <div class="col-md-1">
                            <label class="form-label">Cant.</label>
                            <input type="number" name="cantidad" class="form-control" min="1" required>
                        </div>

                        <div class="col-md-2">
                            <label class="form-label">Descripción</label>
                            <input type="text" name="descripcion" class="form-control" placeholder="Opcional">
                        </div>

                        <div class="col-md-12 text-end">
                            <button type="submit" class="btn btn-success mt-3">Registrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        
        <div class="card">
            <div class="card-header bg-dark text-white">Historial de Movimientos</div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Fecha</th>
                            <th>Producto</th>
                            <th>Categoría</th>
                            <th>Precio</th>
                            <th>Tipo</th>
                            <th>Cantidad</th>
                            <th>Descripción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($movimientos as $mov)
    <tr>
        <td>{{ $mov->fecha }}</td>
        <td>{{ $mov->producto->nombre }}</td>
        <td>{{ $mov->producto->categoria ?? '—' }}</td>
        <td>${{ number_format($mov->producto->precio, 0, ',', '.') }}</td>
        <td>
            <span class="badge {{ $mov->tipo == 'entrada' ? 'bg-success' : 'bg-danger' }}">
                {{ ucfirst($mov->tipo) }}
            </span>
        </td>
        <td>{{ $mov->cantidad }}</td>
        <td>{{ $mov->descripcion }}</td>
        <td>
            <a href="{{ route('inventario.editar', $mov->id_movimiento) }}" class="btn btn-warning btn-sm">Editar</a>
            <form action="{{ route('inventario.eliminar', $mov->id_movimiento) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este movimiento?')">Eliminar</button>
            </form>
        </td>
    </tr>
@endforeach
