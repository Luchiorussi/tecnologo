<?php
  $page_title = 'Editar Aulas';
  require_once('configuracion/Cargar.php');
  
   page_require_level(2);
?>
<?php
$aula = find_by_id('aula',(int)$_GET['id']);
if(!$aula){
  $session->msg("d","Missing Aula id.");
  redirect('Aulas.php');
}
?>
<?php $aula = find_by_id('aula',$aula['id']); ?>
<?php

  if(isset($_POST['update_Aula'])){
    $req_fields = array('NombreAula','EstadoAula' );
    validate_fields($req_fields);
        if(empty($errors)){
          $a_id      = $db->escape((int)$_POST['id']);
          $a_NombreAula    = $db->escape($_POST['NombreAula']);
          $a_EstadoAula  = $db->escape((int)$_POST['EstadoAula']); 
        



 $sql  = "UPDATE aula SET";
 $sql .= " NombreAula='{$a_NombreAula}',EstadoAula='{$a_EstadoAula}'";
 $sql .= " WHERE id ='{$aula['id']}'";
 $result = $db->query($sql);
 if( $result && $db->affected_rows() === 1){
                    
                    $session->msg('s',"Aula actualizado.");
                    redirect('Aulas.php', false);
                  } else {
                    $session->msg('d',' Lo lamento la actualizacion fallo!');
                    redirect('Editar_Aulas.php?id='.$aula['id'], false);
                  }
        } else {
           $session->msg("d", $errors);
           redirect('Editar_Aulas.php?id='.(int)$aula['id'],false);
        }
  }

?>
<?php include_once('Disenos/Encabezado.php'); ?>


<div class="row">
   <div class="col-md-12"> <?php echo display_msg($msg); ?> </div>
  <div class="col-md-6">
     <div class="panel panel-default">
       <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-inbox"></span>
          Actualiza el mobiliario <?php echo remove_junk(ucwords($aula['NombreAula'])); ?>
        </strong>
        </div>


        <div class="panel-body">
          <form method="post" action="Editar_Aulas.php?id=<?php echo (int)$aula['id'];?>" class="clearfix">
            <div class="form-group">
                  <label for="NombreAula" class="control-label">Nombre del Aulas</label>
                  <input type="name" class="form-control" name="NombreAula" value="<?php echo remove_junk ($aula['NombreAula']); ?>">
            </div>

        
            <div class="form-group">
              <label for="Estado">Estado</label>
                <select class="form-control" name="EstadoAula">
                  <option <?php if($aula['EstadoAula'] === '1') echo 'selected="selected"';?>value="1">Activo</option>
                  <option <?php if($aula['EstadoAula'] === '0') echo 'selected="selected"';?> value="0">Inactivo</option>
                </select>
            </div>
            
            <div class="form-group clearfix">
                    <button type="submit" name="update_Aula" class="btn btn-info">Actualizar</button>
            </div>




            </div>
        </div>
   </div> 
</div>
<?php include_once('Disenos/Pie_de_Pagina.php'); ?>