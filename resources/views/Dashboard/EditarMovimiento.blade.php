<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Movimiento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-dark text-white">
            <h4>Editar Movimiento de Inventario</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('inventario.actualizar', $movimiento->id_movimiento) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Producto</label>
                    <input type="text" class="form-control" value="{{ $movimiento->producto->nombre }}" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tipo</label>
                    <select name="tipo" class="form-select" required>
                        <option value="entrada" {{ $movimiento->tipo == 'entrada' ? 'selected' : '' }}>Entrada</option>
                        <option value="salida" {{ $movimiento->tipo == 'salida' ? 'selected' : '' }}>Salida</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Cantidad</label>
                    <input type="number" name="cantidad" class="form-control" value="{{ $movimiento->cantidad }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <input type="text" name="descripcion" class="form-control" value="{{ $movimiento->descripcion }}">
                </div>
                <div class="text-end">
                    <a href="{{ route('inventario.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
