<?php 
$page_title = 'Registrar alguna novedad';
	require_once('configuracion/Cargar.php');
	// Compruebe en qué nivel el usuario tiene permiso para ver esta página.
page_require_level(5);
$aula = find_all('aula');
$product = find_all('mobiliarioaula');
$users = find_all('usuario');
$state = find_all('estadomobiliario');
 ?>
<?php  
if(isset($_POST['add_novedad'])){
$req_fields = array('idUsuario','idAula','idMobiliarioaula', 'idEstadoMobiliario', 'DescripcionNovedad' );
   validate_fields($req_fields);

if(empty($errors)){
 $idUsuario = remove_junk($db->escape($_POST['idUsuario']));
 $idAula = remove_junk($db->escape($_POST['idAula']));
 $idMobiliarioaula  =remove_junk($db->escape($_POST['idMobiliarioaula']));
 $idEstadoMobiliario =remove_junk($db->escape($_POST['idEstadoMobiliario']));
 $DescripcionNovedad = remove_junk($db->escape($_POST['DescripcionNovedad']));
 
 $query = "INSERT INTO Novedad(";
 $query .="idUsuario,idAula,idMobiliarioaula,idEstadoMobiliario,DescripcionNovedad";
 $query .=") VALUES (";
 $query .=" '{$idUsuario}', '{$idAula}', '{$idMobiliarioaula}', '{$idEstadoMobiliario}', 
  '{$DescripcionNovedad}'";
 $query .=")";
 
 if($db->query($query)){
  $session->msg('s'," Novedad Registrada Gracias Por Reportar Alguna Inconformidad");
   redirect('Novedad.php', false);
 }else {
          //failed
          $session->msg('d',' No se pudo crear Crear La Novedad Intenta De Nuevo.');
          redirect('Novedad.php', false);
        }
   } else {
     $session->msg("d", $errors);
      redirect('Novedad.php',false);
   }
 }
?>


<?php include_once('Diseños/Encabezado.php'); ?>

<?php echo display_msg($msg); ?>
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading" style="background: #0174DF;">
        <strong>
          <span class="glyphicon glyphicon-list-alt" style="color: #FFF;"></span>
          <span style="color: #FFF;">Agregar Novedad</span>
       </strong>
        </div>

        <div class="panel-body">
        <div class="col-md-6">
          <form method="post" action="Novedad.php">

            <div class="form-group">
              <label for="Nombre">Seleccione Su Nombre</label>
                <select class="form-control" name="idUsuario">
                  <option value="">Nombre</option>
                  <?php foreach ($users as $user):?>
                   <option value="<?php echo (int)$user['id'] ?>">
                        <?php echo $user['Nombre'] ?></option>
                <?php endforeach;?>
                </select>
            </div>

            <div class="form-group">
              <label for="Nombre">Seleccione El Aula</label>
                <select class="form-control" name="idAula">
                  <option value="">Aula</option>
                  <?php foreach ($aula as $sales):?>
                   <option value="<?php echo (int)$sales['id'] ?>">
                        <?php echo $sales['NombreAula'] ?></option>
                <?php endforeach;?>
                </select>
            </div>

            <div class="form-group">
              <label for="idMobiliarioaula">Seleccione El Mobiliario</label>
                <select class="form-control" name="idMobiliarioaula">
                  <option value="">Mobiliario</option>
                  <?php foreach ($product as $products):?>
                   <option value="<?php echo (int)$products['id'] ?>">
                        <?php echo $products['NombreMobiliario'] ?></option>
                <?php endforeach;?>
                </select>
            </div>

            <div class="form-group">
              <label for="idEstadoMobiliario">Seleccione El Estado</label>
                <select class="form-control" name="idEstadoMobiliario">
                  <option value="">Estado</option>
                  <?php foreach ($state as $states):?>
                   <option value="<?php echo (int)$states['id'] ?>">
                        <?php echo $states['NombreEstadoMobiliario'] ?></option>
                <?php endforeach;?>
                </select>
            </div>

            <div class="form-group">
                <label for="DescripcionNovedad">Escribenos Alguna Novedad de Nuestro Mobiliario</label>
                <input type="text" class="form-control" name ="DescripcionNovedad"  placeholder="Escribe Aqui Alguna Inconformidad">
            </div>


            <div class="form-group clearfix">
              <button type="submit" name="add_novedad" class="btn btn-primary"style="font-size: 18px;">Enviar</button>
              <a href="Administrador.php" class="btn btn-danger" style="font-size: 18px;">Regresar</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>







<?php include_once('Diseños/Pie_De_Pagina.php') ?>