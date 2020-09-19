<?php
$page_title = 'Lista de mobiliario registrado';
require_once 'configuracion/Cargar.php';
?>

<?php
include "Paginacion/connect.php";
include "Paginacion/paginadorMobiliario.php";
?>
<?php
// Registrar qué nivel de usuario tiene permiso para ver esta página
page_require_level(2);
$products = join_mobiliario_table();
?>
<?php
if (isset($_POST["enviar"])) {

    $archivo          = $_FILES["archivo"]["name"];
    $archivo_copiado  = $_FILES["archivo"]["tmp_name"];
    $archivo_guardado = "copia_" . $archivo;

    if (copy($archivo_copiado, $archivo_guardado)) {
        echo "Se copeo correctamente el archivo temporal a nuestra carpeta de trabajo <br/>";

    } else {

        echo "Hubo un error <br/>";
    }

    if (file_exists($archivo_guardado)) {

        $fp   = fopen($archivo_guardado, "r"); //abrir un archivo
        $rows = 0;
        while ($dato = fgetcsv($fp, 1000, ";")) {
            $rows++;
            // echo $datos[0] ." ".$datos[1] ."."<br/>";
            if ($rows > 1) {
                $resultado = insertar_datos_mobiliario($dato[0], $dato[1], $dato[2], $dato[3], $dato[4], $dato[5]);
                if ($resultado) {
                    echo "se inserto los datos correctamnete<br/>";
                } else {
                    echo "no se inserto <br/>";
                }
            }
        }

    } else {
        echo "no existe el archivo copiado <br/>";
    }

}

?>

<?php include_once 'Diseños/Encabezado.php';?>
 <?php
if (isset($_POST['buscar'])) {
    $busca = $_POST['buscar'];
    require 'cn.php';
    if ($busca != "") {
        $consulta = "SELECT m.id, m.NombreMobiliario, m.CodigoMobiliario, a.NombreAula, m.VidaUtilMobiliario, m.VidaUtilMobiliarioFinal, em.NombreEstadoMobiliario ";
        $consulta .= "FROM MobiliarioAula m ";
        $consulta .= "INNER JOIN Aula a ON a.id = m.idAula ";
        $consulta .= "INNER JOIN EstadoMobiliario em ON em.id = m.idNombreEstadoMobiliario ";
        $consulta .= "WHERE NombreMobiliario LIKE '%" . $busca . "%'";
        $consulta .= "ORDER BY m.NombreMobiliario ASC";

        $products = $mysqli->query($consulta);
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
          <span class="glyphicon glyphicon-tasks" style="color: #FFF;"></span>
          <span style="color: #FFF;">Mobiliario</span>
       </strong>
        <div class="pull-right">
           <a href="plantillas/plantilla.xlsx" style="margin-left: 10px" class="btn btn-primary"  download="plantilla.xlsx">Manual de mobiliario</a>
         </div>

         <strong>
         <a href="Agregar_producto.php" class="btn btn-info pull-right">Agregar mobiliario</a>
       </strong>
       <br>
       <h1 style="color: #FFF;" align="center">Subir Archivos</h1>
          <div class="formulario">
             <form action="Producto.php" class="formulariocompleto" method="post" enctype="multipart/form-data">
         <input type="file"  name="archivo" class="form-control"/>
        <input type="submit"  value="SUBIR ARCHIVO"  class="form-control" name="enviar">
        </form>
      </div>


      <h1 style="color: #FFF; font-size: 150%">Mobiliario</h1>
  <div>
  <form action="Producto.php" method="POST">
  <label><input type="text"  name="buscar" ></label>
<input type="submit" class="btn btn-info " name="enviando" value="Buscar por mobiliario" >
</form>
  </div>
<div>

</div>

</body>
</html>
</div>





        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 10px;">#</th>
                <th class="text-center" style="width: 45%;"> Nombre Mobiliario </th>
                <th class="text-center" style="width: 10%;"> Codigo de Mobiliario </th>
                <th class="text-center" style="width: 15%;"> Nombre del Aula </th>
                <th class="text-center" style="width: 15%;">Vida Util Inicial</th>
                <th class="text-center" style="width: 15%;">Vida Util Final</th>
                <th class="text-center" style="width: 15%;">Estado Mobiliario</th>
                <th class="text-center" style="width: 5px;">Acciones</th>
              </tr>
            </thead>

            <tbody>
              <?php
if ($totalregistros >= 1):
    foreach ($registros as $reg):
    ?>
                        <tr>
                          <td class="text-center"><?php echo count_id(); ?></td>

                         <td> <?php echo remove_junk($reg['NombreMobiliario']); ?></td>
                         <td class="text-center"> <?php echo remove_junk($reg['CodigoMobiliario']); ?></td>
                          <td class="text-center"> <?php echo remove_junk($reg['NombreAula']); ?></td>
                          <td class="text-center"> <?php echo remove_junk($reg['VidaUtilMobiliario']); ?></td>
                          <td class="text-center"> <?php echo remove_junk($reg['VidaUtilMobiliarioFinal']); ?></td>
                          <td class="text-center"> <?php echo remove_junk($reg['NombreEstadoMobiliario']); ?></td>
                          <td class="text-center">
                          <div class="btn-group">
                              <a href="Editar_producto.php?id=<?php echo (int) $reg['id']; ?>" class="btn btn-info btn-xs"  title="Editar" data-toggle="tooltip">
                                <span class="glyphicon glyphicon-edit"></span>
                              </a>
                               <a href="Eliminar_producto.php?id=<?php echo (int) $reg['id']; ?>" class="btn btn-danger btn-xs"  title="Eliminar" data-toggle="tooltip">
                                <span class="glyphicon glyphicon-trash"></span>
                              </a>

                            </div>
                          </tr>
                          <?php endforeach;
else:
?>
                <tr>
                  <td colspan="9">No hay registros</td>
                </tr>
                  <?php endif;?>
              </tbody>
            </table>
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
      <a href="Producto.php?pagina=<?php echo $pagina - 1; ?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
  <?php endif;
for ($i = 1; $i <= $numeropaginas; $i++) {
    if ($pagina == $i) {
        echo '<li class="active"><a href="Producto.php?pagina=' . $i . '">' . $i . '</a></li>';
    } else {
        echo '<li><a href="Producto.php?pagina=' . $i . '">' . $i . '</a></li>';
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
      <a href="Producto.php?pagina=<?php echo $pagina + 1; ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
    <?php endif;?>
  </ul>
</nav>
<?php endif;?>
      </div>
    </div>

    <?php include_once 'Diseños/Pie_De_Pagina.php'?>










