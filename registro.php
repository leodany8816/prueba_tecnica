<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href=" https://cdn.jsdelivr.net/npm/sweetalert2@11.14.4/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4 text-white">Formulario de Registro</h2>
        <div class="formRegistro">
            <form id="registro">
                <div class="mb-1">
                    <label for="nombre" class="form-label">Nombre <strong class="text-danger">*</strong></label>
                    <input type="text" class="form-control requerido" id="nombre" placeholder="Ingresa tu nombre">
                </div>

                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono<strong class="text-danger">*</strong></label>
                    <input type="text" class="form-control requerido" id="telefono" maxlength="10" pattern="[0-9]{10}" placeholder="Ingresa tu Teléfono" required>
                </div>

                <div class="mb-3">
                    <label for="correo" class="form-label">Correo Electrónico<strong class="text-danger">*</strong></label>
                    <input type="email" class="form-control requerido" id="correo" placeholder="Ingresa tu correo electrónico" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña<strong class="text-danger">*</strong></label>
                    <input type="password" class="form-control requerido" id="password" placeholder="Ingresa tu contraseña" required>
                </div>

                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirmar Contraseña<strong class="text-danger">*</strong></label>
                    <input type="password" class="form-control requerido" id="confirmPassword" placeholder="Confirma tu contraseña" required>
                </div>

                <div class="mb-3">
                    <label for="rfc" class="form-label">RFC<strong class="text-danger">*</strong></label>
                    <input type="text" class="form-control requerido" id="rfc" placeholder="Ingresa tu RFC" maxlength="13" oninput="this.value = this.value.toUpperCase()" required>
                </div>

                <div class="mb-3">
                    <label for="notas" class="form-label">Notas<strong class="text-danger">*</strong></label>
                    <textarea class="form-control requerido" id="notas" rows="3" placeholder="Agrega algunas notas adicionales"></textarea>
                </div>
                <div class="mb-3 text-center">
                    <button type="button" id="btnRegistrar" class="btn btn-primary w-50" onclick="formRegistro();">Registrar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS (Opcional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.14.4/dist/sweetalert2.all.min.js "></script>
    <script src="js/scripts.js"></script>
</body>

</html>