<?php
  $page_title = 'Editar_Aulas';
  require_once('configuracion/Cargar.php');
  // Checkin What level user has permission to view this page
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
<?php include_once('Diseños/Encabezado.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>
<div class="row">

  <div class="col-md-12">
  <div class="panel">
    <div class="panel-heading clearfix">
      <strong>
        <span class="glyphicon glyphicon-th"></span>
        <span>todas las Aulas</span>
     </strong>
     <div class="pull-right">
       <a href="Aulas.php" class="btn btn-primary">Mostrar todos los detalles</a>
     </div>
    </div>
    <div class="panel-body">
       <table class="table table-bordered">
         <thead>
          <th> NombreAula </th>
          <th> EstadoAula </th>
          <th> Action</th>
         </thead>
           <tbody  id="product_info">
              <tr>
              <form method="post" action="Editar_Aulas.php?id=<?php echo (int)$aula['id']; ?>">
                <td id="a_NombreAula">
                  <input type="text" class="form-control" id="sug_input" name="NombreAula" value="<?php echo remove_junk($aula['NombreAula']); ?>">
                  <div id="result" class="list-group"></div>
                </td>
                <td id="a_EstadoAula">
                <div class="form-group">
          <label for="EstadoAula">Estado</label>
            <select class="form-control" name="EstadoAula">
              <option value="1">Activo</option>
              <option value="0">Inactivo</option>
            </select>
        </div>
                </td>
                
                <td>
                  
                  <button href="Producto.php" type="submit" name="update_Aula" class="btn btn-primary" style="font-size: 18px;">Actualizar Aula</button>

                  
                  
                </td>

              </form>
              </tr>
           </tbody>
       </table>

    </div>
  </div>
  </div>

</div>

<?php include_once('Diseños/Pie_De_Pagina.php'); ?>
