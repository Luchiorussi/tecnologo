<?php
  $page_title = 'Agregar Aula';
  require_once('configuracion/Cargar.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
?>
<?php

  if(isset($_POST['AgregarAulas'])){
    $req_fields = array('NombreAula','estado' );
    validate_fields($req_fields);
        if(empty($errors)){
          $s_NombreAula     = remove_junk($db->escape($_POST['NombreAula'])); 
          $s_estado   = remove_junk($db->escape((int)$_POST['estado']));
          

          $sql  = "INSERT INTO aula (";
          $sql .= " NombreAula, estadoAula";
          $sql .= ") VALUES (";
          $sql .= "'{$s_NombreAula}',{$s_estado}";
          $sql .= ")";

                if($db->query($sql)){
                  $session->msg('s',"Aula Agregada ");
                  redirect('AgregarAulas.php', false);
                } else {
                  $session->msg('d','Lo siento, registro falló.');
                  redirect('AgregarAulas.php', false);
                }
        } else {
           $session->msg("d", $errors);
           redirect('AgregarAulas.php',false);
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
        <div class="panel-heading" style="background: #0174DF;">
          <strong>
            <span class="glyphicon glyphicon-inbox" style="color: #FFF;"></span>
            <span style="color: #FFF;">Agregar nueva aula</span>
         </strong>
        </div>

        <div class="panel-body">
         <div class="col-md-12">
          <form method="post" action="AgregarAulas.php" class="clearfix">

              <div class="form-group">
                <label for="NombreAula">Nombre del aula</label>
                <input type="text" class="form-control" name="NombreAula" placeholder="Nombre del Aula">
            </div>

              <div class="form-group">
          <label for="estado">Estado</label>
            <select class="form-control" name="estado">
              <option value="1">Activo</option>
              <option value="0">Inactivo</option>
            </select>
        </div>
              <button type="submit" name="AgregarAulas" class="btn btn-danger" style="font-size: 18px;">Añadir aula</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>

<?php include_once('Diseños/Pie_De_Pagina.php'); ?>

