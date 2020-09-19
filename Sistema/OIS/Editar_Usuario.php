<?php 
  $page_title = 'Editar Usuario';
  require_once('configuracion/Cargar.php');
// Compruebe en qué nivel el usuario tiene permiso para ver esta página
  page_require_level(1);
 ?>

 <?php 
  $e_user = find_by_id('usuario',(int)$_GET['id']);
  $groups  = find_all('Cargousuario');
  $documents = find_all('TipoDocumento');
  if (!$e_user) {
    $session->msg("d","Falta la identificación de usuario.");
    redirect('Usuarios.php');
  }
  ?>

  <?php 
// Actualizar información básica del usuario
if(isset($_POST['update'])) {
  $req_fields = array('Nombre','Apellido','idCargoUsuario','idTipoDocumento','NoDocumento','CorreoElectronico');
  validate_fields($req_fields);
  if(empty($errors)){
    $id = (int)$e_user['id'];
    $Nombre = remove_junk($db->escape($_POST['Nombre']));
    $Apellido = remove_junk($db->escape($_POST['Apellido']));
    $idCargoUsuario= (int)$db->escape($_POST['idCargoUsuario']);
    $idTipoDocumento=(int)$db->escape($_POST['idTipoDocumento']);
    $NoDocumento= remove_junk($db->escape($_POST['NoDocumento']));
    $CorreoElectronico = remove_junk($db->escape($_POST['CorreoElectronico']));
    $Estado = remove_junk($db->escape($_POST['Estado'])); 
    $sql = "UPDATE usuario SET Nombre='{$Nombre}', Apellido ='{$Apellido}', idCargoUsuario='{$idCargoUsuario}', idTipoDocumento='{$idTipoDocumento}', NoDocumento='$NoDocumento',
        CorreoElectronico='{$CorreoElectronico}',Estado='{$Estado}' WHERE id='{$db->escape($id)}'";

    $result = $db->query($sql);
    if($result && $db->affected_rows() === 1){
            $session->msg('s',"Cuenta actualizada ");
            redirect('Editar_Usuario.php?id='.(int)$e_user['id'], false);
            } else {
            $session->msg('d',' Lo siento no se actualizó los datos.');
            redirect('Editar_Usuario.php?id='.(int)$e_user['id'], false);
            }
    } else {
      $session->msg("d", $errors);
      redirect('Editar_Usuario.php?id='.(int)$e_user['id'],false);
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
          redirect('Editar_Usuario.php?id='.(int)$e_user['id'], false);
        } else {
          $session->msg('d','No se pudo actualizar la contraseña de usuario..');
          redirect('Editar_Usuario.php?id='.(int)$e_user['id'], false);
        }
  } else {
    $session->msg("d", $errors);
    redirect('Editar_Usuario.php?id='.(int)$e_user['id'],false);
  }
}

?>

<?php include_once('Diseños/Encabezado.php') ?>

<div class="row">
   <div class="col-md-12"> <?php echo display_msg($msg); ?> </div>
  <div class="col-md-6">
     <div class="panel panel-default">
       <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-user"></span>
          Actualiza tu cuenta <?php echo remove_junk(ucwords($e_user['Nombre'])); ?>
        </strong>
        </div>


        <div class="panel-body">
          <form method="post" action="Editar_Usuario.php?id=<?php echo (int)$e_user['id'];?>" class="clearfix">
            <div class="form-group">
                  <label for="Nombre" class="control-label">Nombres</label>
                  <input type="name" class="form-control" name="Nombre" value="<?php echo remove_junk(ucwords($e_user['Nombre'])); ?>">
            </div>

            <div class="form-group">
                  <label for="Apellido" class="control-label">Apellidos</label>
                  <input type="text" class="form-control" name="Apellido" value="<?php echo remove_junk(ucwords($e_user['Apellido'])); ?>">
            </div>

            <div class="form-group">
              <label for="idCargoUsuario">Tipo de Usuario</label>
                <select class="form-control" name="idCargoUsuario">
                  <?php foreach ($groups as $group ):?>
                   <option <?php if($group['NivelVisibilidad'] === $e_user['idCargoUsuario']) echo 'selected="selected"';?> value="<?php echo $group['NivelVisibilidad'];?>"><?php echo ucwords($group['NombreCargo']);?></option>
                <?php endforeach;?>
                </select>
            </div>

            <div class="form-group">
              <label for="idTipoDocumento">Tipo de Documento</label>
                    <select class="form-control" name="idTipoDocumento">
                      <?php  foreach ($documents as $document): ?>
                        <option value="<?php echo (int)$document['id'];?>" <?php if($e_user['idTipoDocumento'] === $document['id']): echo "selected"; endif; ?> >
                          <?php echo $document['NombreTipoDocumento'] ?></option>
                      <?php endforeach; ?>
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
              <label for="Estado">Estado</label>
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
        <form action="Editar_Usuario.php?id=<?php echo (int)$e_user['id'];?>" method="post" class="clearfix">
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




          

            

            


 <?php include_once('Diseños/Pie_De_Pagina.php'); ?>






































