<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Usuario - MotoGestor</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card col-md-6 offset-md-3 shadow-lg">
        <div class="card-header bg-success text-white text-center">
            <h4>Registrar Nuevo Usuario</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('usuario.store') }}">
                @csrf
                <div class="mb-3">
                    <label>Nombre de Usuario</label>
                    <input type="text" name="username" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Contraseña</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Rol</label>
                    <select name="rol" class="form-control" required>
                        <option value="">Seleccione...</option>
                        <option value="admin">Administrador</option>
                        <option value="almacenista">Almacenista</option>
                        <option value="mecanico">Mecánico</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Estado</label>
                    <input type="checkbox" name="estado" value="1" checked> 
                </div>
                <button type="submit" class="btn btn-success w-100">Registrar</button><br><br>
                <a href="{{ route('login') }}" class="btn btn-secondary w-100">Volver</a>
            </form>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>

</body>
</html>
