<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel del Almacenista - MotoGestor</title>
</head>
<body>
    <h2>Bienvenido Almacenista</h2>
    <p>Has iniciado sesión como <strong>{{ Auth::user()->username }}</strong></p>

    <nav>
        <ul>
            <li><a href="#">Registrar Productos</a></li>
            <li><a href="#">Actualizar Inventario</a></li>
            <li><a href="#">Consultar Productos</a></li>
        </ul>
    </nav>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Cerrar Sesión</button>
    </form>
</body>
</html>
