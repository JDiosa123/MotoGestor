<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración - Usuarios</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Panel de Administración</a>
            <form action="{{ route('logout') }}" method="POST" class="d-flex ms-auto">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm">Cerrar sesión</button>
            </form>
        </div>
    </nav>

    <div class="container py-4">
        <h2 class="text-center mb-4">Gestión de Usuarios</h2>

        {{-- Mensajes de éxito o error --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- FORMULARIO CREAR USUARIO --}}
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                Crear nuevo usuario
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.usuario.store') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Nombre de usuario</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Contraseña</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Rol</label>
                            <select name="rol" class="form-select" required>
                                <option value="">Seleccione</option>
                                <option value="admin">Administrador</option>
                                <option value="almacenista">Almacenista</option>
                                <option value="mecanico">Mecánico</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Estado</label>
                            <select name="estado" class="form-select">
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                        <div class="col-md-2 d-grid">
                            <label class="form-label">&nbsp;</label>
                            <button class="btn btn-success">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- TABLA USUARIOS --}}
        <div class="card">
            <div class="card-header bg-dark text-white">
                Lista de usuarios
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Rol</th>
                            <th>Estado</th>
                            <th>Fecha creación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->id_usuario }}</td>
                                <td>{{ $usuario->username }}</td>
                                <td>{{ ucfirst($usuario->rol) }}</td>
                                <td>
                                    <span class="badge {{ $usuario->estado ? 'bg-success' : 'bg-danger' }}">
                                        {{ $usuario->estado ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </td>
                                <td>{{ $usuario->fecha_creacion }}</td>
                                <td>
                                    {{-- BOTÓN EDITAR (abre modal) --}}
                                    <button class="btn btn-warning btn-sm" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#modalEdit"
                                            data-id="{{ $usuario->id_usuario }}"
                                            data-username="{{ $usuario->username }}"
                                            data-rol="{{ $usuario->rol }}"
                                            data-estado="{{ $usuario->estado }}">
                                        <i class="bi bi-pencil"></i> Editar
                                    </button>

                                    {{-- BOTÓN ELIMINAR --}}
                                    <form action="{{ route('admin.usuario.delete', $usuario->id_usuario) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" 
                                            onclick="return confirm('¿Seguro que deseas eliminar este usuario?')">
                                            <i class="bi bi-trash"></i> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- MODAL EDITAR USUARIO --}}
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="POST" id="editForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title">Editar usuario</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit-id">

                        <div class="mb-3">
                            <label class="form-label">Nombre de usuario</label>
                            <input type="text" name="username" id="edit-username" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Rol</label>
                            <select name="rol" id="edit-rol" class="form-select" required>
                                <option value="admin">Administrador</option>
                                <option value="almacenista">Almacenista</option>
                                <option value="mecanico">Mecánico</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Estado</label>
                            <select name="estado" id="edit-estado" class="form-select">
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nueva contraseña (opcional)</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button class="btn btn-primary">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet"/>

    <script>
        // Llenar el modal con los datos del usuario
        const modalEdit = document.getElementById('modalEdit');
        modalEdit.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const username = button.getAttribute('data-username');
            const rol = button.getAttribute('data-rol');
            const estado = button.getAttribute('data-estado');

            document.getElementById('edit-id').value = id;
            document.getElementById('edit-username').value = username;
            document.getElementById('edit-rol').value = rol;
            document.getElementById('edit-estado').value = estado;

            document.getElementById('editForm').action = `/admin/usuarios/${id}`;
        });
    </script>
</body>
</html>
