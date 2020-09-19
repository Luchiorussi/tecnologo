<?php
$page_title = 'Añadir Mobiliario';
  require_once('configuracion/Cargar.php');
  // Compruebe en qué nivel el usuario tiene permiso para ver esta página.
page_require_level(2);



// Foraneas

  $all_states = find_all('estadomobiliario');
  $all_aula = find_all('aula');


?>


<?php
if(isset($_POST['Agregar_producto'])){
  $req_fields = array('NombreMobiliario','CodigoMobiliario','idAula','VidaUtilMobiliario','VidaUtilMobiliarioFinal','idNombreEstadoMobiliario');
  validate_fields($req_fields);
 
 
  if(empty($errors)){
 $NombreMobiliario = remove_junk($db->escape($_POST['NombreMobiliario']));  
 $CodigoMobiliario= remove_junk($db->escape($_POST['CodigoMobiliario']));
 $idAula= remove_junk($db->escape($_POST['idAula']));
 $VidaUtilMobiliario= remove_junk($db->escape($_POST['VidaUtilMobiliario']));
 $VidaUtilMobiliarioFinal= remove_junk($db->escape($_POST['VidaUtilMobiliarioFinal']));
 $idNombreEstadoMobiliario= remove_junk($db->escape($_POST['idNombreEstadoMobiliario']));




 
     $query  = "INSERT INTO mobiliarioaula (";
     $query .=" NombreMobiliario, CodigoMobiliario, idAula , VidaUtilMobiliario,VidaUtilMobiliarioFinal,idNombreEstadoMobiliario";
     $query .=") VALUES (";
     $query .=" '{$NombreMobiliario}','{$CodigoMobiliario}','{$idAula}','{$VidaUtilMobiliario}','{$VidaUtilMobiliarioFinal}','{$idNombreEstadoMobiliario}'"; 

    
     $query .=")";
     $query .=" ON DUPLICATE KEY UPDATE NombreMobiliario='{$NombreMobiliario}'";
    


     if($db->query($query)){
       $session->msg('s',"Mobiliario añadido exitosamente. ");
       redirect('Agregar_producto.php', false);
     }else{
       $session->msg('d',' Lo siento, registro del mobiliario falló.');
       redirect('Producto.php', false);
         }

   } else{
     $session->msg("d", $errors);
     redirect('Agregar_producto.php',false);
   }
}

?>



<?php include_once('Diseños/Encabezado.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
  <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Agregar Mobiliario a la Institucion</span>
         </strong>
</div>
        

  <div class="panel-body">
        <div class="col-md-6">
          <form method="post" action="Agregar_producto.php">      

   <div class="form-group">
                <label for="NombreMobiliario">Nombre del mobiliario</label>
                <input type="text" class="form-control" name="NombreMobiliario" placeholder="Nombre mobiliario" required>
   </div>



   <div class="form-group">
                <label for="CodigoMobiliario">Codigo del mobiliario</label>
                <input type="text" class="form-control" name="CodigoMobiliario" placeholder="Codigo del mobiliario" required>
   </div>



    <div class="form-group">
              <label for="idCargoUsuario">Aulas de mobiliario</label>
                <select class="form-control" name="idAula">
                  <?php foreach ($all_aula as $all_aul):  ?>
                   <option value="<?php echo (int)$all_aul['id'] ?>">
                        <?php echo $all_aul['NombreAula'] ?></option>
                <?php endforeach;?>
                </select>
              </div>




    <div class="form-group">
                <label for="VidaUtilMobiliario">Vida util del mobiliario</label>
                <input type="date" class="form-control" name="VidaUtilMobiliario" placeholder="Fecha inicial del mobiliario" required>
   </div>



   <div class="form-group">
                <label for="VidaUtilMobiliarioFinal">Vida util del mobiliario</label>
                <input type="date" min="2018-03-25" class="form-control" name="VidaUtilMobiliarioFinal" placeholder="Fecha final del mobiliario" required>
   </div>


   

  
             <div class="form-group">
              <label for="idNombreEstadoMobiliario">Estado del mobiliario</label>
                <select class="form-control" name="idNombreEstadoMobiliario">
                  <?php foreach ($all_states as $all_stat):  ?>
                   <option value="<?php echo (int)$all_stat['id'] ?>">
                        <?php echo $all_stat['NombreEstadoMobiliario'] ?></option>
                   <?php endforeach;?>
                </select>
              </div>


              <div>  
              <button type="submit" name="Agregar_producto" class="btn btn-danger" style="font-size: 18px;">Añadir Mobiliario</button>
              </div>
              <br>
               <div> 
              <a href="Producto.php" class="btn btn-primary" style="font-size: 18px;">Regresar</a>        
              </div>
            </form>
         </div>
        </div>
      </div>
    </div>
  
  </div>
 <?php include_once('Diseños/Pie_De_Pagina.php'); ?>
