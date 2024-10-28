<?php
session_start();

if (empty($_SESSION["correo"]) && empty($_SESSION["nombre"])) {
    echo "no esta login";
    header('location:index.php');
}

$correo = $_SESSION["correo"];
$nombre =  $_SESSION["nombre"];
// echo $correo . "<br/>" . $nombre;

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Registros</title>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <!-- Buttons DataTable CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href=" https://cdn.jsdelivr.net/npm/sweetalert2@11.14.4/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-1">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-0 mb-0 bg-white border-bottom border-black">
            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li class="nav-item">
                    <span class="nav-link link-dark px-2 fs-2">Nombre: <?= $nombre ?></span>
                </li>
                <li class="nav-item">
                    <span class="nav-link link-dark px-2 fs-2">Correo: <?= $correo ?></span>
                </li>
                <li class="nav-item">
                    <a href="logout.php"><button class="btn btn-danger mx-2 my-3" class="nav-link link-dark px-2 fs-2">Cerrar Sesión</button>
                    </a>
                </li>
            </ul>
        </header>
        <div class="formRegistro col-sm-12">
            <table id="dt_usuarios" class="table table-bordered table-hover table-striped w-100">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Telefono</th>
                        <th>Correo</th>
                        <th>Password</th>
                        <th>RFC</th>
                        <th>Notas</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="usuarios">
                </tbody>
            </table>

        </div>
    </div>

    <!-- modal para editar la informacion -->

    <div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="registro">

                        <div class="mb-1">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="hidden" id="id"/>
                            <input type="text" class="form-control requerido" id="nombre">
                        </div>

                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" class="form-control requerido" id="telefono" maxlength="10" pattern="[0-9]{10}" required>
                        </div>

                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control requerido" id="correo"  required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control requerido" id="password" required>
                        </div>
                  
                        <div class="mb-3">
                            <label for="rfc" class="form-label">RFC</label>
                            <input type="text" class="form-control requerido" id="rfc" placeholder="Ingresa tu RFC" maxlength="13" oninput="this.value = this.value.toUpperCase()" required>
                        </div>

                        <div class="mb-3">
                            <label for="notas" class="form-label">Notas</label>
                            <textarea class="form-control requerido" id="notas" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnEditar" onclick="editarUsuario();">Guardar cambios</button>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <!-- Buttons DataTable Export JS -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.14.4/dist/sweetalert2.all.min.js "></script>
    <script src="js/tablas.js"></script>
</body>

</html>