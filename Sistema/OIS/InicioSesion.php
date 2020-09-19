<?php
ob_start();
require_once 'configuracion/Cargar.php';
if ($session->isUserLoggedIn(true)) {redirect('Bienvenido.php', false);}
?>

 <?php include_once 'Diseños/Encabezado.php';?>

<html>
<body style="background: #E6E6E6;">
 <div class="login-page" style="background: #0588FC;">
    <div class="text-center">
       <h1 style="font-family: Arial; color: #FFF;">Bienvenido</h1>
       <img src="Cargas/Usuarios/fondo.png" height="190px" width="200">
       <h1 style="font-family: Arial; color: #FFF;">Inicio Sesion</h1>
        <h3 ></h3>
       </div>

    <?php echo display_msg($msg); ?>

    <form method="post" action="Autentificacion.php" class="clearfix">
        <div class="form-group">
              <label for="NoDocumento" class="control-label" style="color: #FFF; font-family: Arial;">Usuario</label>
              <input type="text" class="form-control" name="NoDocumento" placeholder="Numero de documento">
        </div>

    <div class="form-group">
            <label for="ClaveUsuario" class="control-label" style="color: #FFF; font-family: Arial;">Contraseña</label>
            <input type="password" name= "ClaveUsuario" class="form-control" placeholder="Contraseña">
        </div>

    <div class="form-group">
            <br>
            <center>
            <button type="submit" class="btn btn-info  pull-right" style="background:#848484;">Ingresar </button>
            </center>
        </div>
    </form>
</div>

</body>
</html>


<?php include_once 'Diseños/Pie_De_Pagina.php';?>