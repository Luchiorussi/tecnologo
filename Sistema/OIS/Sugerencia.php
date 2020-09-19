<?php 
  $page_title = 'Observaciones';
  require_once('configuracion/Cargar.php');
 ?>

 <?php // Registrar qué nivel de usuario tiene permiso para ver esta página
page_require_level(5);
// extraer todos los usuarios de la base de datos
$all_Novedad = find_all_novedad();
 ?>

  <?php include_once('Diseños/Encabezado.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>

  <div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">

      <div class="panel-heading clearfix" style="background: #0174DF;">
        <strong>
          <span class="glyphicon glyphicon-list-alt" style="color: #FFF;"></span>
          <span style="color: #FFF;">Novedades</span>
       </strong>
       <a href="Novedad.php" class="btn btn-info pull-right">Agregar Sugerencia</a>
       <br>
   </div>
       <div class="panel-body">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th class="text-center" style="width: 50px;">#</th>
            <th class="text-center">Nombre</th>
            <th class="text-center">Apellido</th>
            <th class="text-center">Mobiliario</th>
            <th class="text-center" style="width: 40%;">Novedad</th>
          </tr>
        </thead>
        	<tbody>	
        		<?php 	foreach ($all_Novedad as $novedad):  ?>
        				<tr>
       <td class="text-center"><?php echo count_id();?></td>
          <td align="center"><?php echo remove_junk(ucwords($novedad['Nombre']))?></td>	
        <td align="center"><?php echo remove_junk(ucwords($novedad['Apellido']))?></td>
        <td align="center"><?php echo remove_junk(ucwords($novedad['NombreMobiliario']))?></td>
        <td align="center"><?php echo remove_junk(ucwords($novedad['DescripcionNovedad']))?></td>	
        	</tr>
        	<?php endforeach;?>
        	</tbody>
        </table>
    </div>
</div>
</div>
</div>
</div>
<?php include_once('Diseños/Pie_De_Pagina.php') ?>
        