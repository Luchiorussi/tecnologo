<?php
$page_title = 'Lista de Usuarios';
require_once 'configuracion/Cargar.php';

?>

<?php
include "Paginacion/connect.php";
include "Paginacion/paginadorUsuario.php";?>
<?php // Registrar qué nivel de usuario tiene permiso para ver esta página
page_require_level(1);

// extraer todos los usuarios de la base de datos
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

 <?php include_once 'Diseños/Encabezado.php';?>

<?php
if (isset($_POST['buscar'])) {
    $busca = $_POST['buscar'];
    require 'cn.php';
    if ($busca != "") {
        $consulta = "SELECT u.id,u.Nombre,u.Apellido,cg.NombreCargo,";
        $consulta .= "u.Estado ";
        $consulta .= "FROM Usuario u ";
        $consulta .= "INNER JOIN cargousuario cg ";
        $consulta .= "ON cg.NivelVisibilidad=u.idCargoUsuario ";
        $consulta .= "WHERE u.Nombre LIKE '%" . $busca . "%' ";
        $consulta .= "ORDER BY u.id ASC";

        $all_users = $mysqli->query($consulta);
    }}
?>


<html>
 <body style="background: #E2E2E1;">
<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
</div>

<div class="row" >
  <div class="col-md-12">
    <div class="panel panel-default" style="background: #FFF;">

      <div class="panel-heading clearfix" style="background: #0174DF;">
        <strong>
          <span class="glyphicon glyphicon-user" style="color: #FFF;"></span>
          <span style="color: #FFF;">Usuarios</span>
       </strong>
       <br>
       <div class="pull-right">
           <a href="plantillas/plantilla.xlsx" class="btn btn-primary"  style="margin-left: 10px" download="plantilla.xlsx">Manual de usuario</a>
         </div>
       <strong>
         <a href="Agregar_Usuarios.php" class="btn btn-info pull-right" style="background: #FFF; color:#0174DF ">Agregar usuario</a>
       </strong>
       <br>
       <h1 style="color: #FFF;" align="center">Subir Archivos</h1>
   <div class="formulario">
    <form action="Usuarios.php" class="formulariocompleto" method="post" enctype="multipart/form-data">
       <input type="file"  name="archivo" class="form-control"/>
      <input type="submit"  value="SUBIR ARCHIVO"  class="form-control" name="enviar">
    </form>
    <h1 style="color: #FFF; font-size: 150%">Usuarios</h1>
<form action="Usuarios.php" method="POST">
  <label><input type="text"  name="buscar" placeholder="Usuarios"></label>
<input type="submit" class="btn btn-info " name="enviando" value="Buscar" >
</form>
</br>

   </div>
</body>
</html>
      </div>

<div class="panel-body">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th class="text-center" style="width: 50px;">#</th>
            <th>Nombre </th>
            <th>Apellido</th>
            <th class="text-center" style="width: 15%;">Rol de usuario</th>
            <th class="text-center" style="width: 10%;">Estado</th>
            <th class="text-center" style="width: 100px;">Acciones</th>
          </tr>
        </thead>




       <tbody>
          <?php
if ($totalregistros >= 1):
    foreach ($registros as $reg):
    ?>
                              <tr>
                             <td class="text-center"><?php echo count_id(); ?></td>
                             <td><?php echo remove_junk(ucwords($reg['Nombre'])) ?></td>
                             <td><?php echo remove_junk(ucwords($reg['Apellido'])) ?></td>
                             <td class="text-center"><?php echo remove_junk(ucwords($reg['NombreCargo'])) ?></td>

                             <td class="text-center">
                             <?php if ($reg['Estado'] === '1'): ?>
                              <span class="label label-success"><?php echo "Activo"; ?></span>
                            <?php else: ?>
            <span class="label label-danger"><?php echo "Inactivo"; ?></span>
          <?php endif;?>
           </td>
           <td class="text-center">
             <div class="btn-group">
              <a href="Editar_Usuario.php?id=<?php echo (int) $reg['id']; ?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Editar">
            <i class="glyphicon glyphicon-pencil"></i>
               </a>
            <a href="Eliminar_Usuario.php?id=<?php echo (int) $reg['id']; ?>" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Eliminar">
              <i class="glyphicon glyphicon-remove"></i>
                </a>
                </div>
           </td>
          </tr>
        <?php endforeach;
else:
?>
        <tr>
           <td colspan="7">No hay registros</td>
        </tr>
      <?php endif;?>
       </tbody>
     </table>
     </div>
    </div>
  </div>
  <div class="pull-left">
   <a href="plantillas/ManualTecnico.pdf" class="btn btn-primary" download="plantilla.xlsx">Descargar plantilla</a>
</div>
</div>
<?php if ($totalregistros >= 1): ?>
<nav aira-label="Page navigation" class="text-center">
  <ul class="pagination" >
    <?php if ($pagina == 1): ?>
    <li class="disabled">
      <a href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <?php else: ?>
      <li >
      <a href="Usuarios.php?pagina=<?php echo $pagina - 1; ?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
  <?php endif;
for ($i = 1; $i <= $numeropaginas; $i++) {
    if ($pagina == $i) {
        echo '<li class="active"><a href="Usuarios.php?pagina=' . $i . '">' . $i . '</a></li>';
    } else {
        echo '<li><a href="Usuarios.php?pagina=' . $i . '">' . $i . '</a></li>';
    }
}
if ($pagina == $numeropaginas):
?>
    <li class="disabled">
      <a href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
    <?php else: ?>
      <li>
      <a href="Usuarios.php?pagina=<?php echo $pagina + 1; ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
    <?php endif;?>
  </ul>
</nav>
<?php endif;?>
</body>
</html>
<?php include_once 'Diseños/Pie_De_Pagina.php'?>