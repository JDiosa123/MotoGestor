<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel del Mecánico - MotoGestor</title>
</head>
<body>
    <h2>Bienvenido Mecánico</h2>
    <p>Has iniciado sesión como <strong>{{ Auth::user()->username }}</strong></p>

    <nav>
        <ul>
            <li><a href="#">Registrar Cliente</a></li>
            <li><a href="#">Consultar Citas</a></li>
            <li><a href="#">Historial de Mantenimientos</a></li>
        </ul>
    </nav>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Cerrar Sesión</button>
    </form>
</body>
</html>
