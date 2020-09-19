<?php 
  $page_title = 'BIENVENIDO';
  require_once('configuracion/Cargar.php');
    if(!$session->isUserLoggedIn(true)) { redirect('InicioSesion.php', false);}; 
 ?>
 <?php include_once('Diseños/Encabezado.php'); ?>
  <html>
  <body style="background: #FFF;">
 <div class="row">
  <div class="col-md-12">
  	<?php echo display_msg($msg); ?>
  </div>
 <div class="col-md-12">
    <div class="panel">
      <div class="jumbotron text-center" style="background: #0588FC;">
         <h1 style="color: #FFF;">BIENVENIDO AL SISTEMA OIS</h1>
         <br>
         <h1 style="color: #FFF;">Institución Educativa</h1>
         <img src="Cargas/Usuarios/fondo.png">
         <h1 style="color: #FFF;">Julio Cesar Turbay Ayala</h1>
        </div>
    </div>
 </div>
</div>
</body>
</html>
<?php include_once('Diseños/Pie_De_Pagina.php'); ?>