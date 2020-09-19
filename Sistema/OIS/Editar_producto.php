<?php
$page_title = 'Añadir Mobiliario';
  require_once('Configuracion/Cargar.php');

  // Compruebe en qué nivel el usuario tiene permiso para ver esta página
page_require_level(2);
// Foreaneas
  $e_user = find_by_id('mobiliarioaula',(int)$_GET['id']);
 
  $all_states = find_all('estadomobiliario');
  $all_aula = find_all('aula');

?>
<?php

if(isset($_POST['e_user'])){ // <--- Editar 
   $req_fields = array('NombreMobiliario','CodigoMobiliario','idAula','VidaUtilMobiliario','VidaUtilMobiliarioFinal','idNombreEstadoMobiliario');
   validate_fields($req_fields);

   if(empty($errors)){
 $NombreMobiliario = remove_junk($db->escape($_POST['NombreMobiliario']));  
 $CodigoMobiliario= remove_junk($db->escape($_POST['CodigoMobiliario']));
 $idAula= (int)$db->escape($_POST['idAula']);
 $VidaUtilMobiliario= remove_junk($db->escape($_POST['VidaUtilMobiliario']));
 $VidaUtilMobiliarioFinal= remove_junk($db->escape($_POST['VidaUtilMobiliarioFinal']));
 $idNombreEstadoMobiliario= (int)($db->escape($_POST['idNombreEstadoMobiliario']));


// Modificar

 $query   = "UPDATE mobiliarioaula SET";
       $query  .=" NombreMobiliario ='{$NombreMobiliario}', CodigoMobiliario ='{$CodigoMobiliario}', idAula = '{$idAula}',";
       //
       $query  .=" VidaUtilMobiliario ='{$VidaUtilMobiliario}', VidaUtilMobiliarioFinal ='{$VidaUtilMobiliarioFinal}', idNombreEstadoMobiliario ='{$idNombreEstadoMobiliario}'";
      //Condicion
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

// Formularios de editar mobiliario

?>
<?php include_once('Diseños/Encabezado.php') ?>

<div class="row">
   <div class="col-md-12"> <?php echo display_msg($msg); ?> </div>
  <div class="col-md-6">
     <div class="panel panel-default">
       <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-tasks"></span>
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
                  <input type="text" class="form-control" max="5" name="CodigoMobiliario" value="<?php echo remove_junk($e_user['CodigoMobiliario']); ?>">
            </div>



             <div class="form-group">
              <label for="idAula">Aula del Mobiliario</label>
                    <select class="form-control" name="idAula">
                      <?php  foreach ($all_aula as $all_aul): ?>
                        <option value="<?php echo (int)$all_aul['id'];?>" <?php if($e_user['idAula'] === $all_aul['id']): echo "selected"; endif; ?> >
                          <?php echo $all_aul['NombreAula'] ?></option>
                      <?php endforeach; ?>
                    </select>
            </div>


           <div class="form-group">
                  <label for="VidaUtilMobiliario" class="control-label"> Vida inicial de mobliiario (Fecha : YYYY-DD-MM) </label>
                  <input type="text"class="datepicker form-control" name="VidaUtilMobiliario" value="<?php echo remove_junk($e_user['VidaUtilMobiliario']); ?>">
            </div>


              <div class="form-group">
                  <label for="VidaUtilMobiliarioFinal" class="control-label"> Vida final de mobliiario (Fecha : YYYY-DD-MM) </label>
                  <input type="text" class="datepicker form-control" name="VidaUtilMobiliarioFinal" value="<?php echo remove_junk($e_user['VidaUtilMobiliarioFinal']); ?>">
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

<?php include_once('Diseños/Pie_De_Pagina.php'); ?>

