<?php
$page_title = 'Vista Principal';
require_once 'configuracion/Cargar.php';
// Compruebe en qué nivel el usuario tiene permiso para ver esta página
page_require_level(4);
?>

<?php
$c_user          = count_by_id('Usuario');
$c_product       = count_by_id('mobiliarioaula');
$c_categorie     = count_by_id('aula');
$c_sale          = count_by_id('prestamomobiliario');
$products_sold   = count_by_id('10');
$recent_products = find_recent_mobiliario_added('5');
$recent_sales    = count_by_id('5')
?>


<?php include_once 'Diseños/Encabezado.php';?>
<html>
  <body style="background: #E2E2E1;">
<div class="row">
   <div class="col-md-6">
    <?php echo display_msg($msg); ?>
    </div>
   </div>

    <div class="row">
    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-green">
          <i class="glyphicon glyphicon-user"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php echo $c_user['total']; ?> </h2>
          <p class="text-muted">USUARIOS</p>
        </div>
       </div>
    </div>

  <div class="row">
   <div class="col-md-4">
     <div class="panel panel-default">
       <div class="panel-heading" style="background: #0174DF;">
        <strong>
          <span class="glyphicon glyphicon-user" style="color: #FFF;"></span>
          <span style="color: #FFF;">USUARIOS RECIENTEMENTE INGRESADOS</span>
        </strong>
      </div>
      <div class="panel-body">
        <table class="table table-striped table-bordered table-condensed">
          <thead>
            <tr>
              <th>NOMBRE DEL USUARIO</th>
              <th>CARGO DEL USUARIO</th>
              <th>ESTADO DEL USUARIO</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
      </div>
    </div>
    </div>
  </div>
    </div>









    <div class="row">
        <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-red">
          <i class="glyphicon glyphicon-inbox"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php echo $c_categorie['total']; ?> </h2>
          <p class="text-muted">AULAS</p>
        </div>
       </div>
  </div>

    <div class="row">
   <div class="col-md-4">
     <div class="panel panel-default">
       <div class="panel-heading" style="background: #0174DF;">
          <strong>
          <span class="glyphicon glyphicon-inbox"style="color: #FFF;"></span>
          <span style="color: #FFF;">AULAS RECIENTEMENTE INGRESADAS</span>
        </strong>
      </div>
    </div>
    </div>
  </div>
    </div>











    <div class="row">
      <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-blue">
          <i class="glyphicon glyphicon-tasks"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php echo $c_product['total']; ?> </h2>
          <p class="text-muted">MOBILIARIO</p>
        </div>
       </div>
    </div>
      <div class="row">
   <div class="col-md-4">
     <div class="panel panel-default">
       <div class="panel-heading" style="background: #0174DF;">
          <strong>
            <span class="glyphicon glyphicon-tasks" style="color: #FFF;"></span>
            <span style="color: #FFF;">MOBILIARIO RECIENTEMENTE INGRESADO</span>
        </strong>
      </div>
    <?php foreach ($recent_products as $recent_product): ?>
            <a class="list-group-item clearfix" href="Editar_producto.php?id=<?php echo (int) $recent_product['id']; ?>">
                <h4 class="list-group-item-heading">
                 <?php if ($recent_product['imagenMobiliario'] === '0'): ?>
                    <img class="img-avatar img-circle" src="Cargas/Mobiliaro/no_image.jpg" alt="">
                  <?php else: ?>
                  <img class="img-avatar img-circle" src="Cargas/Mobiliario/<?php echo $recent_product['imagenMobiliario']; ?>" alt="" />
                <?php endif;?>
                <?php echo remove_junk(first_character($recent_product['NombreMobiliario'])); ?>
                  <span class="label label-warning pull-right">
                 $<?php echo (int) $recent_product['CodigoMobiliario']; ?>
                  </span>
                </h4>
                <span class="list-group-item-text pull-right">
                <?php echo remove_junk(first_character($recent_product['nombreEstadoMobiliario'])); ?>
              </span>
          </a>
      <?php endforeach;?>
          </tbody>
        </table>
    </div>
    </div>
  </div>
        </div>

















    <div class="row">
        <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-yellow">
          <i class="glyphicon glyphicon-folder-open"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php echo $c_sale['total']; ?></h2>
          <p class="text-muted">PRESTAMOS</p>
        </div>
       </div>
    </div>
      <div class="row">
   <div class="col-md-4">
     <div class="panel panel-default">
       <div class="panel-heading" style="background: #0174DF;">
            <strong>
              <span class="glyphicon glyphicon-folder-open" style="color: #FFF;"></span>
              <span style="color: #FFF;">PRESTAMOS RECIENTEMENTE REGISTRADOS</span>
        </strong>
      </div>
    </div>
    </div>
  </div>
</div>

<div class="pull-left">
           <a href="plantillas/ManualTecnico.pdf" class="btn btn-primary" download="Manual Tecnico.pdf">Descargar Manual Tecnico</a>
         </div>

         <div class="pull-left">
           <a href="plantillas/ManualUsuario.pdf" class="btn btn-primary" download="Manual de Usuario.pdf">Descargar Manual de Usuario</a>
         </div>
         <div class="pull-left">
           <a href="plantillas/ManualdeInstalacion.pdf" class="btn btn-primary" download="Manual de instalacion.pdf">Descargar Manual de instalacion</a>
         </div>

</body>
</html>



<?php include_once 'Diseños/Pie_De_Pagina.php';?>


