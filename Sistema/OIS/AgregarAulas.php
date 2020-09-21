<?php
  $page_title = 'Agregar Aula';
  require_once('configuracion/Cargar.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
?>

<?php

  if(isset($_POST['AgregarAulas'])){
    $req_fields = array('NombreAula','EstadoAula' );
    validate_fields($req_fields);
        if(empty($errors)){
          $s_NombreAula     = remove_junk($db->escape($_POST['NombreAula'])); 
          $s_estado   = remove_junk($db->escape((int)$_POST['EstadoAula']));
          

          $sql  = "INSERT INTO aula (";
          $sql .= " NombreAula, EstadoAula";
          $sql .= ") VALUES (";
          $sql .= "'{$s_NombreAula}',{$s_estado}";
          $sql .= ")";

                if($db->query($sql)){
                  $session->msg('s',"Aula Agregada ");
                  redirect('Aulas.php', false);
                } else {
                  $session->msg('d','Lo siento, registro falló.');
                  redirect('Aulas.php', false);
                }
        } else {
           $session->msg("d", $errors);
           redirect('Aulas.php',false);
        }
  }
  
  ?>
  <?php include_once('Disenos/Encabezado.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>

<html>
<body>
  

<div class="row">
  <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading" style="background:#0588FC;">
          <strong>
            <span class="glyphicon glyphicon-inbox" style="color:#FFF;"></span>
            <span style="color:#FFF;">Agregar Aula</span>
         </strong>
        </div>

        <div class="panel-body">
          <div class="col-md-6">
              <form method="post" action="AgregarAulas.php">
            <div class="form-group">
                <label for="name">Nombre del aula</label>
                <input type="text" class="form-control" name="NombreAula" placeholder="Nombre del aula" required>
            </div>

        <div class="form-group">
          <label for="estado">Estado</label>
              <select class="form-control" name="EstadoAula">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
        </div>


        <button type="submit" name="AgregarAulas" class="btn btn-primary">Añadir aula</button>


           
              <a href="Aulas.php" class="btn btn-danger">Regresar</a>
           
        
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>
  </body>
  </html>
  <?php include_once('Disenos/Pie_de_Pagina.php'); ?>