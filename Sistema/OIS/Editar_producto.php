<?php
$page_title = 'Añadir Mobiliario';
  require_once('configuracion/Cargar.php');

  
page_require_level(2);

  $e_user = find_by_id('mobiliarioaula',(int)$_GET['id']);
 
  $all_states = find_all('estadomobiliario');
  $all_aula = find_all('aula');

?>
<?php

if(isset($_POST['e_user'])){ 
   $req_fields = array('NombreMobiliario','CodigoMobiliario','idAula','VidaUtilMobiliario','VidaUtilMobiliarioFinal','idNombreEstadoMobiliario');
   validate_fields($req_fields);

   if(empty($errors)){
 $NombreMobiliario = remove_junk($db->escape($_POST['NombreMobiliario']));  
 $CodigoMobiliario= remove_junk($db->escape($_POST['CodigoMobiliario']));
 $idAula= (int)$db->escape($_POST['idAula']);
 $VidaUtilMobiliario= remove_junk($db->escape($_POST['VidaUtilMobiliario']));
 $VidaUtilMobiliarioFinal= remove_junk($db->escape($_POST['VidaUtilMobiliarioFinal']));
 $idNombreEstadoMobiliario= (int)($db->escape($_POST['idNombreEstadoMobiliario']));




 $query   = "UPDATE mobiliarioaula SET";
       $query  .=" NombreMobiliario ='{$NombreMobiliario}', CodigoMobiliario ='{$CodigoMobiliario}', idAula = '{$idAula}',";
   
       $query  .=" VidaUtilMobiliario ='{$VidaUtilMobiliario}', VidaUtilMobiliarioFinal ='{$VidaUtilMobiliarioFinal}', idNombreEstadoMobiliario ='{$idNombreEstadoMobiliario}'";

       $query  .=" WHERE id ='{$e_user ['id']}'";
       



       $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"El mobiliario ha sido actualizado. ");
                 redirect('Producto.php', false);
               } else {
                 $session->msg('d',' Lo siento, actualización del mobiliario ha fallado fallado.');
                 redirect('Editar_producto.php?id='.$mobiliarioaula['id'], false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('Editar_producto.php?id='.$mobiliarioaula['id'], false);
   }

 }


?>
<?php include_once('Disenos/Encabezado.php') ?>

<div class="row">
   <div class="col-md-12"> <?php echo display_msg($msg); ?> </div>
  <div class="col-md-6">
     <div class="panel panel-default">
       <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          Actualiza el mobiliario <?php echo remove_junk(ucwords($e_user['NombreMobiliario'])); ?>
        </strong>
        </div>





            <div class="panel-body">
          <form method="post" action="Editar_producto.php?id=<?php echo (int)$e_user['id'];?>" class="clearfix">
            <div class="form-group">
                  <label for="NombreMobiliario" class="control-label">Nombre del mobiliario</label>
                  <input type="name" class="form-control" name="NombreMobiliario" value="<?php echo remove_junk ($e_user['NombreMobiliario']); ?>">
            </div>

          



           <div class="form-group">
                  <label for="CodigoMobiliario" class="control-label"> Codigo del mobiliario</label>
                  <input type="text" class="form-control" name="CodigoMobiliario" value="<?php echo remove_junk($e_user['CodigoMobiliario']); ?>">
            </div>




   
             <div class="form-group">
              <label for="idAula">Aula del mobiliario</label>
                <select class="form-control" name="idAula">
                  <?php foreach ($all_aula as $all_aul):?>
                   <option <?php if($all_aul['id'] === $e_user['idAula']) 
                   echo 'selected="selected"';?> value="<?php echo $all_aul['id'];?>"><?php echo ucwords($all_aul['NombreAula']);?></option>
                 <?php endforeach;?>
                 </select>
             </div>




           <div class="form-group">
                  <label for="VidaUtilMobiliario" class="control-label"> Vida inical de mobiliario (Fecha : YYYY-DD-MM) </label>
                  <input type="date" class="form-control" name="VidaUtilMobiliario" value="<?php echo remove_junk($e_user['VidaUtilMobiliario']); ?>">
            </div>


              <div class="form-group">
                  <label for="VidaUtilMobiliarioFinal" class="control-label"> Vida final de mobliiario (Fecha : YYYY-DD-MM) </label>
                  <input type="date" class="form-control" name="VidaUtilMobiliarioFinal" value="<?php echo remove_junk($e_user['VidaUtilMobiliarioFinal']); ?>">
            </div>



             <div class="form-group">
              <label for="idNombreEstadoMobiliario">Estado del mobiliario</label>
                <select class="form-control" name="idNombreEstadoMobiliario">
                  <?php foreach ($all_states as $all_stat ):?>
                   <option <?php if($all_stat['id'] === $e_user['idNombreEstadoMobiliario']) 
                   echo 'selected="selected"';?> value="<?php echo $all_stat['id'];?>"><?php echo  ($all_stat['NombreEstadoMobiliario']);?></option>
                 <?php endforeach;?>
                 </select>
             </div>





         <button type="submit" name="e_user" class="btn btn-danger" style="font-size: 18px;">Actualizar</button>
         <br>
         <br>
          </form>
          
          <div class="form-group">
            
          <a href="Producto.php" class="btn btn-primary" style="font-size: 18px;">Regresar</a>
                
          </div>
         
         
         </div>
        </div>
      </div>
  </div>

<?php include_once('Disenos/Pie_de_Pagina.php'); ?>