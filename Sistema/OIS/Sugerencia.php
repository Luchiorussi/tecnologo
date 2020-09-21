<?php 
  $page_title = 'Observaciones';
  require_once('configuracion/Cargar.php');
 ?>


  <?php 
page_require_level(5);
$all_Novedad = find_all_novedad();
 ?>

<?php include_once('Disenos/Encabezado.php'); ?>
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
    
         <div class="pull-right">
           <a href="plantillas/ManualUsuario.pdf" class="btn btn-primary"  download="ManualUsuario.pdf">MANUAL DE NOVEDADES
                                <i  class="glyphicon glyphicon-download-alt"></i>

           </a>
                                
         </div>
         
         
       <a href="Novedad.php"  style="margin-left: 1030px" class="btn btn-primary ">Agregar Sugerencia</a>

       <br>
   </div>
   
           
       <div class="panel-body">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
<th class="text-center" style="width: 50px;">#</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Mobiliario</th>
<th class="text-center" style="width: 40%;">Novedad</th>
          </tr>
        </thead>
            <tbody> 
                <?php   foreach ($all_Novedad as $novedad):  ?>
                        <tr>
       <td class="text-center"><?php echo count_id();?></td>
<td><?php echo remove_junk(ucwords($novedad['Nombre']))?></td>  
<td><?php echo remove_junk(ucwords($novedad['Apellido']))?></td>
<td><?php echo remove_junk(ucwords($novedad['NombreMobiliario']))?></td>
<td><?php echo remove_junk(ucwords($novedad['DescripcionNovedad']))?></td>  
            </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>
</div>

<?php include_once('Disenos/Pie_de_Pagina.php') ?>