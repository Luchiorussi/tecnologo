<?php
  $page_title = 'Administracion de SISTEMA OIS';
  require_once('configuracion/Cargar.php');
  
   page_require_level(5);
?>

<?php
 $c_user          =count_by_id('usuario');
 $c_Producto      =count_by_id('mobiliarioaula');
 $c_Aula          =count_by_id('aula');
 $c_Novedad       =count_by_id('novedad');
 $maxUser         =find_by_Maxuser('3');
 $product         =find_recent_mobiliario_added('3');
 $aula            =find_recent_aula('3');
?>

<?php include_once('Disenos/Encabezado.php'); ?>


<html>
<body>
  


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
          <h2 class="margin-top"> <?php  echo $c_user['total']; ?> </h2>
          <p class="text-muted">Usuarios</p>
        </div>
       </div>
    </div>

    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-blue">
          <i class="glyphicon glyphicon-inbox"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $c_Aula['total']; ?> </h2>
          <p class="text-muted">Aulas</p>
        </div>
       </div>
    </div>


    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-yellow">
          <i class="glyphicon glyphicon-tasks"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $c_Producto['total']; ?> </h2>
          <p class="text-muted">Mobiliarios</p>
        </div>
       </div>
    </div>

    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-red">
          <i class="glyphicon glyphicon-envelope"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $c_Novedad['total']; ?> </h2>
          <p class="text-muted">Novedades</p>
        </div>
       </div>
    </div>

    <div class="col-md-3">
       <div class="panel panel-box clearfix">
         <div class="panel-icon pull-left bg-red">
          <i class="glyphicon glyphicon-folder-open"></i>
        </div>
        <div class="panel-value pull-right">
          <h2 class="margin-top"> <?php  echo $c_Novedad['total']; ?> </h2>
          <p class="text-muted">Prestamos</p>
        </div>
       </div>
    </div>


    </div><!--Fin de la clase row--->








    <div class="row">

    <div class="col-md-4" >
     <div class="panel panel-default">
       <div class="panel-heading" style="background:#0588FC;">
         <strong>
           <span class="glyphicon glyphicon-user" style="color: #FFF;"></span>
           <span style="color: #FFF;">Ultimos Usuarios Registrados</span>
         </strong>
       </div>
       <div class="panel-body">
         <table class="table table-striped table-bordered table-condensed">
          <thead>
           <tr>
             <th>Nombre</th>
             <th>Apellido</th>
             <th>TipoCargo</th>
             <th>Ultimo Login</th>
           <tr>
          </thead>
          <tbody>
            <?php foreach ($maxUser as  $product_sold): ?>
              <tr>
                <td><?php echo remove_junk(first_character($product_sold['Nombre'])); ?></td>
                <td><?php echo remove_junk(first_character($product_sold['Apellido'])); ?></td>
                <td><?php echo remove_junk(first_character($product_sold['NombreCargo'])); ?></td>
                <td><?php echo remove_junk(read_date($product_sold['UltimoLogin'])); ?></td>
              </tr>
            <?php endforeach; ?>
          <tbody>
         </table>
       </div>
     </div>
   </div>


   <div class="col-md-4">
     <div class="panel panel-default">
       <div class="panel-heading" style="background:#0588FC;">
         <strong>
           <span class="glyphicon glyphicon-inbox" style="color:#FFF;"></span>
           <span style="color:#FFF;">Ultimos Aulas Registrados</span>
         </strong>
       </div>
       <div class="panel-body">
         <table class="table table-striped table-bordered table-condensed">
          <thead>
           <tr>
             <th>Nombre del aula</th>
             <th>Estado</th>
           <tr>
          </thead>
          <tbody>
            <?php foreach ($aula  as  $product_sold): ?>
              <tr>
                <td><?php echo remove_junk(first_character($product_sold['NombreAula'])); ?></td>
                <td class="text-center">
                <?php if($product_sold['EstadoAula'] === '1'): ?>
                <span class="label label-success"><?php echo "Activo"; ?></span>
                <?php else: ?>
                <span class="label label-danger"><?php echo "Inactivo"; ?></span>
                <?php endif;?>
            </td>
              </tr>
            <?php endforeach; ?>
          <tbody>
         </table>
       </div>
     </div>
   </div>
   

<div class="col-md-4">
     <div class="panel panel-default">
       <div class="panel-heading" style="background:#0588FC;">
         <strong>
           <span class="glyphicon glyphicon-tasks" style="color:#FFF;"></span>
           <span style="color:#FFF;">Ultimos Mobiliarios Registrados</span>
         </strong>
       </div>
       <div class="panel-body">
         <table class="table table-striped table-bordered table-condensed">
          <thead>
           <tr>
             <th>NombreMobiliario</th>
             <th>CodigoMobiliario</th>
             <th>Aula</th>
             <th>Estado del Mobiliario</th>
           <tr>
          </thead>
          <tbody>
            <?php foreach ($product  as  $product_sold): ?>
              <tr>
                <td><?php echo remove_junk(first_character($product_sold['NombreMobiliario'])); ?></td>
                <td><?php echo remove_junk(first_character($product_sold['CodigoMobiliario'])); ?></td>
                <td><?php echo remove_junk(first_character($product_sold['NombreAula'])); ?></td>
                <td><?php echo remove_junk(first_character($product_sold['NombreEstadoMobiliario'])); ?></td>
              </tr>
            <?php endforeach; ?>
          <tbody>
         </table>
       </div>
     </div>
   </div>




    </div><!--Fin de la clase row--->

        <div class="pull-left">       
           <a href="plantillas/ManualTecnico.pdf" class="btn btn-primary"  download="Manual Tecnico.pdf">Descargar Manual Tecnico</a>
         </div>
        
         <div class="pull-left">
           <a href="plantillas/ManualUsuario.pdf" class="btn btn-primary" style="margin-left: 10px" download="Manual de Usuario.pdf">Descargar Manual de Usuario</a>
         </div>
         
         <div class="pull-left">
           <a href="plantillas/ManualdeInstalacion.pdf" class="btn btn-primary" style="margin-left: 10px" download="Manual de instalacion.pdf">Descargar Manual de instalacion</a>
         </div>
</body>
</html>



<?php include_once('Disenos/Pie_de_Pagina.php');?>