<?php
  $page_title = 'Editar Usuario';
  require_once('configuracion/Cargar.php');
  
   page_require_level(1);
?>

<?php
  $e_user = find_by_id('usuario',(int)$_GET['id']);
  $document = find_all('tipodocumento');
  $groups  = find_all('cargousuario');
  if(!$e_user){
    $session->msg("d","Falta la identificación de usuario.");
    redirect('Usuarios.php');
  }
?>

<?php
// Actualizar información básica del usuario
if(isset($_POST['update'])) {
    $req_fields = array('Nombre','Apellido','idCargoUsuario', 'idTipoDocumento', 'NoDocumento', 'CorreoElectronico');
    validate_fields($req_fields);
    if(empty($errors)){
        $id = (int)$e_user['id'];
        $Nombre = remove_junk($db->escape($_POST['Nombre']));
        $Apellido = remove_junk($db->escape($_POST['Apellido']));
        $idCargoUsuario = remove_junk($db->escape($_POST['idCargoUsuario']));
        $idTipoDocumento = remove_junk($db->escape($_POST['idTipoDocumento']));
        $NoDocumento = remove_junk($db->escape($_POST['NoDocumento']));
        $CorreoElectronico = remove_junk($db->escape($_POST['CorreoElectronico']));
        $Estado  = remove_junk($db->escape($_POST['Estado']));

        $sql = "UPDATE usuario SET Nombre ='{$Nombre}', Apellido ='{$Apellido}',idCargoUsuario='{$idCargoUsuario}',idTipoDocumento='{$idTipoDocumento}',
        NoDocumento='{$NoDocumento}',Estado='{$Estado}' WHERE id='{$db->escape($id)}'";
         $result = $db->query($sql);
        if($result && $db->affected_rows() === 1){
            $session->msg('s',"Cuenta Actualizada ");
            redirect('EditarUsuario.php?id='.(int)$e_user['id'], false);
          } else {
            $session->msg('d',' Lo siento no se actualizó los datos.');
            redirect('EditarUsuario.php?id='.(int)$e_user['id'], false);
          }
    } else {
      $session->msg("d", $errors);
      redirect('EditarUsuario.php?id='.(int)$e_user['id'],false);
    }
  }




?>

<?php
// Actualizar contraseña de usuario
if(isset($_POST['update-pass'])){
  $req_fields = array('ClaveUsuario');
  validate_fields($req_fields);
  if(empty($errors)){
           $id = (int)$e_user['id'];
        $ClaveUsuario = remove_junk($db->escape($_POST['ClaveUsuario']));
        $h_pass   = sha1($ClaveUsuario);
        $sql = "UPDATE usuario SET ClaveUsuario='{$h_pass}' WHERE id='{$db->escape($id)}'";
        $result = $db->query($sql);
        if($result && $db->affected_rows() === 1){
          $session->msg('s',"Se ha actualizado la contraseña del usuario. ");
          redirect('EditarUsuario.php?id='.(int)$e_user['id'], false);
        } else {
          $session->msg('d','No se pudo actualizar la contraseña de usuario..');
          redirect('EditarUsuario.php?id='.(int)$e_user['id'], false);
        }
  } else {
    $session->msg("d", $errors);
    redirect('EditarUsuario.php?id='.(int)$e_user['id'],false);
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
          <span class="glyphicon glyphicon-user"></span>
          Actualiza cuenta <?php echo remove_junk(ucwords($e_user['Nombre'])); ?>
        </strong>
       </div>

       <div class="panel-body">
          <form method="post" action="EditarUsuario.php?id=<?php echo (int)$e_user['id'];?>" class="clearfix">

          <div class="form-group">
                  <label for="Nombre" class="control-label">Nombres</label>
                  <input type="name" class="form-control" name="Nombre" value="<?php echo remove_junk(ucwords($e_user['Nombre'])); ?>">
            </div>

            <div class="form-group">
                  <label for="Apellido" class="control-label">Apellidos</label>
                  <input type="text" class="form-control" name="Apellido" value="<?php echo remove_junk(ucwords($e_user['Apellido'])); ?>">
            </div> 

             <div class="form-group">
              <label for="idCargoUsuario">Tipo de Cargo</label>
                <select class="form-control" name="idCargoUsuario">
                  <?php foreach ($groups as $group ):?>
                   <option <?php if($group['NivelVisibilidad'] === $e_user['idCargoUsuario']) echo 'selected="selected"';?> value="<?php echo $group['NivelVisibilidad'];?>"><?php echo ucwords($group['NombreCargo']);?></option>
                <?php endforeach;?>
                </select>
            </div>  

            <div class="form-group">
              <label for="level">Tipo de Documento</label>
                <select class="form-control" name="idTipoDocumento">
                  <?php foreach ($document as $documents ):?>
                   <option <?php if($documents['id'] === $e_user['idTipoDocumento']) echo 'selected="selected"';?> value="<?php echo $documents['id'];?>"><?php echo ucwords($documents['NombreTipoDocumento']);?></option>
                <?php endforeach;?>
                </select>
            </div>

            <div class="form-group">
                  <label for="NoDocumento" class="control-label">Numero de Documento</label>
                  <input type="text" class="form-control" name="NoDocumento" value="<?php echo remove_junk(ucwords($e_user['NoDocumento'])); ?>">
            </div> 

            <div class="form-group">
                  <label for="CorreoElectronico" class="control-label">Correo Electronico</label>
                  <input type="text" class="form-control" name="CorreoElectronico" value="<?php echo remove_junk(ucwords($e_user['CorreoElectronico'])); ?>">
            </div> 

            <div class="form-group">
              <label for="status">Estado</label>
                <select class="form-control" name="Estado">
                  <option <?php if($e_user['Estado'] === '1') echo 'selected="selected"';?>value="1">Activo</option>
                  <option <?php if($e_user['Estado'] === '0') echo 'selected="selected"';?> value="0">Inactivo</option>
                </select>
            </div>

            <div class="form-group clearfix">
                    <button type="submit" name="update" class="btn btn-info">Actualizar</button>
            </div>
            </form>
        </div>
      </div>
    </div>


   <!-- cambiar comtraseña  form -->
   <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-new-window"></span>
          Cambiar <?php echo remove_junk(ucwords($e_user['Nombre'])); ?> contraseña
        </strong>
      </div>
      <div class="panel-body">
        <form action="EditarUsuario.php?id=<?php echo (int)$e_user['id'];?>" method="post" class="clearfix">
          <div class="form-group">
                <label for="ClaveUsuario" class="control-label">Contraseña</label>
                <input type="password" class="form-control" name="ClaveUsuario" placeholder="Ingresa la nueva contraseña" required>
          </div>
          <div class="form-group clearfix">
                  <button type="submit" name="update-pass" class="btn btn-danger pull-right" style="font-size: 18px;">Cambiar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <?php include_once('Disenos/Pie_de_Pagina.php'); ?>



