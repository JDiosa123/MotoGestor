<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel del Administrador - MotoGestor</title>
</head>
<body>
    <h2>Bienvenido Administrador</h2>
    <p>Has iniciado sesión como <strong>{{ Auth::user()->username }}</strong></p>

    <nav>
        <ul>
            <li><a href="#">Gestionar Usuarios</a></li>
            <li><a href="#">Ver Inventario</a></li>
            <li><a href="#">Citas</a></li>
        </ul>
    </nav>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Cerrar Sesión</button>
    </form>
</body>
</html>
