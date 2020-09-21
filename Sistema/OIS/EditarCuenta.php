<?php
  $page_title = 'Editar Cuenta';
  require_once('configuracion/Cargar.php');
   page_require_level(4);
?>

<?php
//actualizar usuarios en imagen
  if(isset($_POST['submit'])) {
  $photo = new Media();
  $user_id = (int)$_POST['user_id'];
  $photo->upload($_FILES['file_upload']);
  if($photo->process_user($user_id)){
    $session->msg('s','La foto fue subida al servidor.');
    redirect('EditarCuenta.php');
    } else{
      $session->msg('d',join($photo->errors));
      redirect('EditarCuenta.php');
    }
  }
?>

<?php
 // actualizar otra información del usuario 
  if(isset($_POST['update'])){
    $req_fields = array('Nombre','Apellido' );
    validate_fields($req_fields);
    if(empty($errors)){
             $id = (int)$_SESSION['user_id'];
           $Nombre = remove_junk($db->escape($_POST['Nombre']));
       $Apellido = remove_junk($db->escape($_POST['Apellido']));
            $sql = "UPDATE usuario SET Nombre ='{$Nombre}', Apellido ='{$Apellido}' WHERE id='{$id}'";
    $result = $db->query($sql);
          if($result && $db->affected_rows() === 1){
            $session->msg('s',"Cuenta actualizada. ");
            redirect('EditarCuenta.php', false);
          } else {
            $session->msg('d',' Lo siento, actualización falló.');
            redirect('EditarCuenta.php', false);
          }
    } else {
      $session->msg("d", $errors);
      redirect('EditarCuenta.php',false);
    }
  }
  ?>
<?php include_once('Disenos/Encabezado.php'); ?> 
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>

<html>
<body>
  

  <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading" style="background:#0588FC;">
          <div class="panel-heading clearfix" >
            <span class="glyphicon glyphicon-camera"style="color:#FFF;" ></span>
            <span style="color:#FFF;">Cambiar mi foto</span>
          </div>
        </div>

        <div class="panel-body">
          <div class="row">
            <div class="col-md-4">
                <img class="img-circle img-size-2" src="Cargas/Usuarios/<?php echo $user['ImagenUsuario'];?>" alt="">
            </div>

        <div class="col-md-8">
            <form class="form" action="EditarCuenta.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <input type="file" name="file_upload" multiple="multiple" class="btn btn-default btn-file"/>
        </div>

        <div class="form-group">
                <input type="hidden" name="user_id" value="<?php echo $user['id'];?>">
                 <button type="submit" name="submit" class="btn btn-warning">Cambiar</button>
        </div>

        </form>
            </div>
          </div>
        </div>
      </div>
  </div>

  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading clearfix" style="background:#0588FC;">
        <span class="glyphicon glyphicon-edit"style="color:#FFF;" ></span>
        <span style="color:#FFF;">Editar mi cuenta</span>
      </div>

      <div class="panel-body">
          <form method="post" action="EditarCuenta.php?id=<?php echo (int)$user['id'];?>" class="clearfix">
            <div class="form-group">
                  <label for="Nombre" class="control-label">Nombres</label>
                  <input type="name" class="form-control" name="Nombre" value="<?php echo remove_junk(ucwords($user['Nombre'])); ?>">
            </div>

            <div class="form-group">
                  <label for="Apellido" class="control-label">Apellido</label>
                  <input type="text" class="form-control" name="Apellido" value="<?php echo remove_junk(ucwords($user['Apellido'])); ?>">
            </div>

            <div class="form-group clearfix">
                    <button type="submit" name="update" class="btn btn-info">Actualizar</button>
            </div>
            </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>

<?php include_once('Disenos/Pie_de_Pagina.php'); ?>

