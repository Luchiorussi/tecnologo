<?php
$page_title = 'Lista de usuarios';
require_once 'configuracion/Cargar.php';

// Compruebe en qué nivel el usuario tiene permiso para ver esta página.
page_require_level(1);
$groups       = find_all('CargoUsuario');
$all_Document = find_all('TipoDocumento');
?>

 <?php
if (isset($_POST['add_user'])) {

    $req_fields = array('Nombre', 'Apellido', 'idCargoUsuario', 'idTipoDocumento', 'NoDocumento', 'CorreoElectronico', 'ClaveUsuario');
    validate_fields($req_fields);

    if (empty($errors)) {
        $Nombre            = remove_junk($db->escape($_POST['Nombre']));
        $Apellido          = remove_junk($db->escape($_POST['Apellido']));
        $idCargoUsuario    = remove_junk($db->escape($_POST['idCargoUsuario']));
        $idTipoDocumento   = remove_junk($db->escape($_POST['idTipoDocumento']));
        $NoDocumento       = remove_junk($db->escape($_POST['NoDocumento']));
        $CorreoElectronico = remove_junk($db->escape($_POST['CorreoElectronico']));
        $ClaveUsuario      = remove_junk($db->escape($_POST['ClaveUsuario']));

        $ClaveUsuario = sha1($ClaveUsuario);

        $query = "INSERT INTO usuario(";
        $query .= "Nombre,Apellido,idCargoUsuario,idTipoDocumento,NoDocumento,CorreoElectronico,ClaveUsuario,Estado";
        $query .= ") VALUES (";
        $query .= " '{$Nombre}', '{$Apellido}', '{$idCargoUsuario}', '{$idTipoDocumento}',
 '{$NoDocumento}', '{$CorreoElectronico}', '{$ClaveUsuario}', '1'";
        $query .= ")";
        $query .= " ON DUPLICATE KEY UPDATE Nombre='{$Nombre}'";

        if ($db->query($query)) {
            $session->msg('s', " Cuenta de usuario ha sido creada");
            redirect('Agregar_Usuarios.php', false);
        } else {
            //failed
            $session->msg('d', ' No se pudo crear la cuenta.');
            redirect('Agregar_Usuarios.php', false);
        }
    } else {
        $session->msg("d", $errors);
        redirect('Agregar_Usuarios.php', false);
    }
}
?>


<?php include_once 'Diseños/Encabezado.php';?>

<!--Mirar la Contraseña del Usuario-->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

  <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
  <script>
    $(document).on('ready', function() {
      $('#show-hide-passwd').on('click', function(e) {
        e.preventDefault();
        var current = $(this).attr('action');
        if (current == 'hide') {
          $(this).prev().attr('type','text');
          $(this).removeClass('glyphicon-eye-open').addClass('glyphicon-eye-close').attr('action','show');
        }
        if (current == 'show') {
          $(this).prev().attr('type','password');
          $(this).removeClass('glyphicon-eye-close').addClass('glyphicon-eye-open').attr('action','hide');
        }
      })
    })
  </script>

<?php echo display_msg($msg); ?>
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading" style="background: #0174DF;">
        <strong>
          <span class="glyphicon glyphicon-user" style="color: #FFF;"></span>
          <span style="color: #FFF;">Agregar usuario</span>
       </strong>
        </div>

      <div class="panel-body">
        <div class="col-md-6">
          <form method="post" action="Agregar_Usuarios.php">

            <div class="form-group">
                <label for="Nombre">Nombre</label>
                <input type="text" class="form-control" name="Nombre" placeholder="Nombre completo" required>
            </div>

            <div class="form-group">
                <label for="Apellido">Apellido</label>
                <input type="text" class="form-control" name="Apellido" placeholder="Apellidos Completos">
            </div>

            <div class="form-group">
              <label for="idCargoUsuario">Tipos de cargo</label>
                <select class="form-control" name="idCargoUsuario">
              <option value="">Seleccione un Tipo de Cargo</option>
                  <?php foreach ($groups as $group): ?>
                   <option value="<?php echo (int) $group['id'] ?>">
                        <?php echo $group['NombreCargo'] ?></option>
                <?php endforeach;?>
                </select>
              </div>

            <div class="form-group">
              <label for="TipoDocumento">Tipo de Documento</label>
                <select class="form-control" name="idTipoDocumento">
                  <option value="">Seleccione un Tipo de Documento</option>
                  <?php foreach ($all_Document as $Tipo): ?>
                   <option value="<?php echo (int) $Tipo['id'] ?>">
                        <?php echo $Tipo['NombreTipoDocumento'] ?></option>
                <?php endforeach;?>
                </select>
            </div>

            <div class="form-group">
                <label for="NoDocumento">Numero de Documento</label>
                <input type="text" class="form-control" name="NoDocumento" placeholder="Numero de Documento">
            </div>

            <div class="form-group">
                <label for="CorreoElectronico">Correo Electronico</label>
                <input type="email" class="form-control" name="CorreoElectronico" placeholder="CorreoElectronico                                                       Example@gmail.com">
            </div>

            <div class="form-group">
              <label for="ClaveUsuario">Contraseña</label>
            <div class="input-group">
                <input type="password" class="form-control" name ="ClaveUsuario"  placeholder="Contraseña"/>
                <span id="show-hide-passwd" action="hide" class="input-group-addon glyphicon glyphicon glyphicon-eye-open"></span>
            </div>
            </div>


            <div class="form-group clearfix">
              <button type="submit" name="add_user" class="btn btn-primary" style="font-size: 18px;">Enviar</button>
              <a href="Usuarios.php" class="btn btn-danger" style="font-size: 18px;">Regresar</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php include_once 'Diseños/Pie_De_Pagina.php';?>