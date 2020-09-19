<?php 
  $page_title = 'Agregar grupo';
  require_once('configuracion/Cargar.php');
  // Registrar qué nivel de usuario tiene permiso para ver esta página
   page_require_level(1);
 ?>

 <?php 
  if(isset($_POST['add'])){

    $req_fields = array('NombreCargo', 'NivelVisibilidad');
    validate_fields($req_fields);
    
    if(find_by_groupName($_POST['NombreCargo']) === false ){
      $session->msg('d','<b>Error!</b> El nombre del cargo de usuario ya existe por favor registre otro nombre');
      redirect('NivelVisibilidad', false);
     }elseif(find_by_groupLevel($_POST['NivelVisibilidad']) === false) {
      $session->msg('d','<b>Error!</b> Nivel de Visibilidad no existen por favor no intente de nuevo');
     redirect('TipoVista.php', false);
      }
      if(empty($errors)){
        $NombreCargo = remove_junk($db->escape($_POST['NombreCargo']));
        $NivelVisibilidadremove_junk($db->escape($_POST['NivelVisibilidad']));
        $Estado = remove_junk($db->escape($_POST['Estado']));
      

        $query  = "INSERT cargousuario (";
        $query .="group_name,group_level, Estado";
        $query .=") VALUES (";
        $query .=" '{$NombreCargo}', '{$NivelVisibilidad}','{$Estado}'";
        $query .=")";
        if($db->query($query)){
          //mensaje
          $session->msg('s',"Tipo de cargo ha sido creado! ");
          redirect('TipoVista.php', false);
        } else {
          //mensaje
        $session->msg('d','Lamentablemente no se pudo crear el tipo de cargo!');
          redirect('TipoVista.php', false);
        }
   } else {
    $session->msg("d", $errors);
      redirect('TipoVista.php',false);
   }
 }
?>

<?php include_once('Diseños/Encabezado.php'); ?>
<div class="login-page" style="background:#0174DF;">
  <div class="text-center">
      <h3 style="color: #FFF;">Registrar tipo de cargos en la Institucion</h3>
      <img src="Cargas/Usuarios/user.png" width="100">
  </div>
  <?php echo display_msg($msg); ?>

  <form method="post" action="TipoVistas  .php" class="clearfix">
    <div class="form-group">
      <label for="name" class="control-label" style="color: #FFF;">Nombre del cargo</label>
      <input type="name" class="form-control" name="NombreCargo">
    </div>


    <div class="form-group">
      <label for="level" class="control-label" style="color: #FFF;">Nivel de vista de usuario</label>
      <input type="number" min=0  max=4 class="form-control" name="NivelVisibilidad">
    </div>

    <div class="form-group">
          <label for="status" style="color: #FFF">Estado</label>
            <select class="form-control" name="Estados">
              <option value="1">Activo</option>
              <option value="0">Inactivo</option>
            </select>
        </div>

        <div class="form-group clearfix">
                <button type="submit" name="add" class="btn btn-info">Guardar</button>
        </div>
         </form>
</div>

<?php include_once('Diseños/Pie_De_Pagina.php'); ?>