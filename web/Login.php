<?php
include_once '../lib/helpers.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Inicio Sesión</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="./build/css/login.css">
</head>

<body>

    <form id="login" class=" login form-box" method="POST"
        action="<?php echo getUrl("Access", "Access", "login", false, 'ajax'); ?>">
        <h1 class="text-center">Inicio Sesión</h1>
        <div class="contenedor">
            <div  class="text-center">
                <i class="fas fa-envelope icon"></i>
                <input type="text" name="usu_correo" id="usu_correo"
                    placeholder="Correo Electronico">
            </div>

            <div  class="text-center  ">
                <i class="fas fa-key icon"></i>
                <input  type="password" id="usu_contraseña" name="usu_contraseña"
                    placeholder="Contraseña"><br> 

            <p>¿No tienes una cuenta? <a class="link"
                    href="<?php echo getUrl("Access", "Access", "getLogin", false, 'ajax'); ?>">Registrate </a></p>
                    <input style="margin:auto;"type="submit" value="Ingresar" class="button">
            </div>
            
        </div>
        
    </form>
</body>
</html>