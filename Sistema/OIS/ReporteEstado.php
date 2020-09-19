<?php 
	$page_title = 'Estados de Mobiliario';
	require_once('configuracion/Cargar.php');
 ?>

 <?php // Registrar qué nivel de usuario tiene permiso para ver esta página
page_require_level(2);

// extraer todos los usuarios de la base de datos
$states = find_all_states();
 ?>

<?php  include_once('Diseños/Encabezado.php');?>
<html>
 <body style="background: #E2E2E1;">
<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
</div>

<div class="row" >
  <div class="col-md-12">
    <div class="panel panel-default" style="background: #FFF;">

    	<div class="panel-heading clearfix" style="background: #0174DF;">
        <strong>
          <span class="glyphicon glyphicon-file" style="color: #FFF;"></span>
          <span style="color: #FFF;">Estados</span>
       </strong>
       </body>
</html>
      </div>

      <div class="panel-body">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
          	<th class="text-center" style="width: 50px;">#</th>
          	<th class="text-center" style="width: 40px;">Nombre de Estados</th>
          	<th class="text-center" style="width: 5px;">Reporte Mobiliario</th>
          	 </tr>
        </thead>
        <tbody>
            <tr>
           <td align="center">1</td>
           <td align="center">Dañado</td>
           <td class="text-center">
            <a href="EstadoDañado.php" class="btn btn-xs btn-warning" title="Dañado">
            <i class="glyphicon glyphicon-file" style="width: 30px; height: 20px;"></i>
           </td>
          </tr>
       </tbody>
       <tbody>
        <tr>
           <td align="center">2</td>
           <td align="center">Dado de Baja</td>
           <td class="text-center">
            <a href="EstadoBaja.php" class="btn btn-xs btn-warning" title="Dado de Baja">
            <i class="glyphicon glyphicon-file" style="width: 30px; height: 20px;"></i>
           </td>
          </tr>
       </tbody>
       <tbody>
        <tr>
           <td align="center">3</td>
           <td align="center">Dado de Alta</td>
           <td class="text-center">
            <a href="EstadoAlta.php" class="btn btn-xs btn-warning" title="Dado de Alta">
            <i class="glyphicon glyphicon-file" style="width: 30px; height: 20px;"></i>
           </td>
          </tr>
       </tbody>
       <tbody>
        <tr>
           <td align="center">4</td>
           <td align="center">Reparación</td>
           <td class="text-center">
            <a href="EstadoReparacion.php" class="btn btn-xs btn-warning" title="Reparar">
            <i class="glyphicon glyphicon-file" style="width: 30px; height: 20px;"></i>
           </td>
          </tr>
       </tbody>
       <tbody>
        <tr>
           <td align="center">5</td>
           <td align="center">Robado</td>
           <td class="text-center">
            <a href="EstadoRobado.php" class="btn btn-xs btn-warning" title="Robado">
            <i class="glyphicon glyphicon-file" style="width: 30px; height: 20px;"></i>
           </td>
          </tr>
       </tbody>
       <tbody>
        <tr>
           <td align="center">6</td>
           <td align="center">Bueno</td>
           <td class="text-center">
            <a href="EstadoBueno.php" class="btn btn-xs btn-warning" title="Bueno">
            <i class="glyphicon glyphicon-file" style="width: 30px; height: 20px;"></i>
           </td>
          </tr>
       </tbody>
       <tbody>
        <tr>
           <td align="center">7</td>
           <td align="center">Malo</td>
           <td class="text-center">
            <a href="EstadoMalo.php" class="btn btn-xs btn-warning" title="Malo">
            <i class="glyphicon glyphicon-file" style="width: 30px; height: 20px;"></i>
           </td>
          </tr>
       </tbody>
     </table>
     </div>
    </div>
  </div>
</div>
</body>
</html>
<?php include_once('Diseños/Pie_De_Pagina.php') ?>




