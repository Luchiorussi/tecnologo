<?php
  $page_title = 'Editar Grupo';
  require_once('configuracion/Cargar.php');
  // Checkin What level user has permission to view this page
   page_require_level(1);
?>

<?php
  $e_group = find_by_id('cargousuario',(int)$_GET['id']);
  if(!$e_group){
    $session->msg("d","Missing Group id.");
    redirect('GrupoUsuario.php');
  }
?>

<?php
  if(isset($_POST['update'])){

   $req_fields = array('Estado');
   validate_fields($req_fields);
   if(empty($errors)){
         $Estado = remove_junk($db->escape($_POST['Estado']));

        $query  = "UPDATE cargousuario SET ";
        $query .= "Estado='{$Estado}'";
        $query .= "WHERE ID='{$db->escape($e_group['id'])}'";
        $result = $db->query($query);
         if($result && $db->affected_rows() === 1){
          //sucess
          $session->msg('s',"Grupo se ha actualizado! ");
          redirect('EditarGrupo.php?id='.(int)$e_group['id'], false);
        } else {
          //failed
          $session->msg('d','Lamentablemente no se ha actualizado el grupo!');
          redirect('EditarGrupo.php?id='.(int)$e_group['id'], false);
        }
   } else {
     $session->msg("d", $errors);
    redirect('EditarGrupo.php?id='.(int)$e_group['id'], false);
   }
 }
?>
<?php include_once('Disenos/Encabezado.php'); ?>
<div class="login-page">
    <div class="text-center">
       <h1>Editar Grupo</h1>
       <img src="Cargas/Usuarios/grupo.png" height="200px" width="200">
       <h3>Solo puedes editar los estados de los usuarios</h3>
     </div>
     <?php echo display_msg($msg); ?>
      <form method="post" action="EditarGrupo.php?id=<?php echo (int)$e_group['id'];?>" class="clearfix">



      <div class="form-group">
          <label for="status">Estado</label>
              <select class="form-control" name="Estado">
                <option <?php if($e_group['Estado'] === '1') echo 'selected="selected"';?> value="1"> Activo </option>
                <option <?php if($e_group['Estado'] === '0') echo 'selected="selected"';?> value="0">Inactivo</option>
              </select>
        </div>

        <div class="form-group clearfix">
                <button type="submit" name="update" class="btn btn-info">Actualizar</button>
        </div>
    </form>
</div>

<?php include_once('Disenos/Pie_de_Pagina.php'); ?>


