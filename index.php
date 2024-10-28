<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Registros</title>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href="css/styles.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <form class="login">
            <p class="title">Ingresa tus credenciales</p>
            <input type="text" placeholder="Correo" id="correo" autofocus />
            <i class="fa fa-user"></i>
            <input type="password" placeholder="Password" id="password" />
            <i class="fa fa-key"></i>
            <a href="registro.php">Registro</a>
            <button id="btnLogin" type="submit">
                <i class="spinner"></i>
                <span class="state">Ingresar</span>
            </button>
            <!-- <button id="btnLogin" onclick="formLogin()">
                <i class="spinner"></i>
                <span class="state">Ingresar</span>
            </button> -->


            <!-- <button type="button" id="btnLogin" class="btn state w-50" onclick="formLogin()">Ingresar</button> -->
            <!-- <button>
                <i class="spinner"></i>
                <button class="state" id="btnLogin">Ingresar</button>
            </button> -->
        </form>
        <!-- <footer><a target="blank" href="http://boudra.me/">boudra.me</a></footer> -->
        </p>
    </div>
    <script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.14.4/dist/sweetalert2.all.min.js "></script>
    <script src="js/scripts.js"></script>
</body>

</html>