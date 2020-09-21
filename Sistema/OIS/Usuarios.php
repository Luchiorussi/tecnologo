<?php
  $page_title = 'Lista de usuarios';
  require_once('configuracion/Cargar.php');
?>

<?php

 page_require_level(1);

 $all_users = find_all_user();
?>

<?php
if (isset($_POST["enviar"])) {
//nos permite recepcionar una variable que si exista y que no sea null

    $archivo          = $_FILES["archivo"]["name"];
    $archivo_copiado  = $_FILES["archivo"]["tmp_name"];
    $archivo_guardado = "copia_" . $archivo;

    //echo $archivo."esta en la ruta temporal: " .$archivo_copiado;

    if (copy($archivo_copiado, $archivo_guardado)) {
        echo "Se ha realizado la copia con exito a nuestro Sistema OIS<br/>";
    } else {
        echo "hubo Problemas, error <br/>";
    }

    if (file_exists($archivo_guardado)) {

        $fp   = fopen($archivo_guardado, "r"); //abrir un archivo
        $rows = 0;
        while ($datos = fgetcsv($fp, 1000, ";")) {
            $rows++;
            // echo $datos[0] ." ".$datos[1] ."."<br/>";
            if ($rows > 1) {
                $resultado = insertar_datos_usuario($datos[0], $datos[1], $datos[2], $datos[3], $datos[4], $datos[5]);
                if ($resultado) {
                    echo "Se insertaron los usuarios correctamente<br/>";
                } else {
                    echo "No se han insertaron los usuarios<br/>";
                }
            }
        }

    } else {
        echo "Lo sentimos no se ha copiado el archivo<br/>";
    }

}
?>

<?php
if(isset($_POST['buscar'])){
$busca=$_POST['buscar'];
require 'ConexionBuscador.php';
if($busca!=""){ 
  $consulta = "SELECT u.id,u.Nombre,u.Apellido,cg.NombreCargo,";
	$consulta .="u.Estado,u.UltimoLogin ";
	$consulta .="FROM usuario u ";
	$consulta .="INNER JOIN cargousuario cg ";
  $consulta .="ON cg.NivelVisibilidad=u.idCargoUsuario ";
  $consulta .="WHERE u.Nombre LIKE '%".$busca."%' ";
  $consulta .="ORDER BY u.id ASC";

 

  $all_users= $mysqli->query($consulta);
}}
?>


<html>
<body>

<?php include_once('Disenos/Encabezado.php'); ?>

<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
</div>


  

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix" style="background:#0588FC;">
        <strong>
          <span class="glyphicon glyphicon-user" style="color:#FFF;"></span>
          <span style="color:#FFF;">Usuarios</span>
       </strong>

        <!--Boton de Manual de usuario--->
        <div class="pull-right">
           <a href="plantillas/ManualUsuario.pdf" class="btn btn-primary"  style="margin-left: 3%" download="ManualUsuario.pdf">Manual de usuario
                  <i  class="glyphicon glyphicon-download-alt"></i>
           </a>
        </div>

        <!--Boton de agregar--->
         <a href="AgregarUsuario.php"  style="margin-left: 1080px" class="btn btn-primary" >Agregar usuario</a>
        <br>
        
      <!--Carga masiva--->
      <h1 align="center" style="color: #FFF;">Subir Archivos</h1>
      <div class="formulario">
          <form action="Usuarios.php" class="formulariocompleto" method="post" enctype="multipart/form-data">
            <input type="file" name="archivo" class="form-control"/>
            <input type="submit" value="SUBIR ARCHIVO" class="form-control" name="enviar">
          </form>
      </div>

    
         <!--Buscador de Usuarios--->
         <br>
      <form action="Usuarios.php" method="POST">
        <label><input type="text"  name="buscar" placeholder="Usuarios"></label>
        <input type="submit" class="btn btn-primary " name="enviando" value="Buscar" >
      </form>

      </div>

      <div class="panel-body">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th class="text-center" style="width: 50px;">#</th>
            <th>Nombre </th>
            <th>Apellido</th>
            <th class="text-center" style="width: 15%;">Tipo de Cargo</th>
            <th class="text-center" style="width: 10%;">Estado</th>
            <th class="text-center" style="width: 20%;">Último login</th>
            <th class="text-center" style="width: 100px;">Acciones</th>
          </tr>
        </thead>

        <tbody>
        <?php foreach($all_users as $a_user): ?>
            <tr>
           <td class="text-center"><?php echo count_id();?></td>
           <td><?php echo remove_junk(ucwords($a_user['Nombre']))?></td>
           <td><?php echo remove_junk(ucwords($a_user['Apellido']))?></td>
           <td class="text-center"><?php echo remove_junk(ucwords($a_user['NombreCargo']))?></td>
           <td class="text-center">
           <?php if($a_user['Estado'] === '1'): ?>
            <span class="label label-success"><?php echo "Activo"; ?></span>
          <?php else: ?>
            <span class="label label-danger"><?php echo "Inactivo"; ?></span>
          <?php endif;?>
          </td>

          <td><?php echo read_date($a_user['UltimoLogin'])?></td>
          <td class="text-center">
             <div class="btn-group">
                <a href="EditarUsuario.php?id=<?php echo (int)$a_user['id'];?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Editar">
                  <i class="glyphicon glyphicon-pencil"></i>
               </a>
                <a href="EliminarUsuario.php?id=<?php echo (int)$a_user['id'];?>" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Eliminar">
                  <i class="glyphicon glyphicon-remove"></i>
                </a>
                </div>
           </td>
           </tr>
        <?php endforeach;?>
       </tbody>
     </table>
     </div>
    </div>
  </div>
</div>

<div class="pull-left">       
   <a href="plantillas/plantilla.xlsx" class="btn btn-primary" download="plantilla.xlsx">Descargar plantilla
          <i  class="glyphicon glyphicon-download-alt"></i>
   </a>
</div>

  <?php include_once('Disenos/Pie_de_Pagina.php'); ?>
</body>
</html>
