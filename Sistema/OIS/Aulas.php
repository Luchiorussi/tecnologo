<?php
$page_title = 'Lista de Aulas';
require_once 'configuracion/Cargar.php';
// Checkin What level user has permission to view this page
page_require_level(2);
?>
<?php
include "Paginacion/connect.php";
include "Paginacion/paginadorAula.php";
?>
<?php
if (isset($_POST["enviar"])) {
//nos permite recepcionar una variable que si exista y que no sea null

    $archivo          = $_FILES["archivo"]["name"];
    $archivo_copiado  = $_FILES["archivo"]["tmp_name"];
    $archivo_guardado = "copia_" . $archivo;

    //echo $archivo."esta en la ruta temporal: " .$archivo_copiado;

    if (copy($archivo_copiado, $archivo_guardado)) {
        echo "se copio correctamente el archivo temporal a nuestra carpeta de trabajo <br/>";
    } else {
        echo "hubo un error <br/>";
    }

    if (file_exists($archivo_guardado)) {

        $fp   = fopen($archivo_guardado, "r"); //abrir un archivo
        $rows = 0;
        while ($datos = fgetcsv($fp, 1000, ";")) {
            $rows++;
            // echo $datos[0] ." ".$datos[1] ."."<br/>";
            if ($rows > 1) {
                $resultado = insertar_datos_aula($datos[0], $datos[1]);
                if ($resultado) {
                    echo "se inserto los datos correctamente<br/>";
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




<?php
$aulas = find_all_aula();
?>
<?php include_once 'Diseños/Encabezado.php';?>

<?php
if (isset($_POST['buscar'])) {
    $busca = $_POST['buscar'];
    require 'cn.php';
    if ($busca != "") {
        $consulta = "SELECT * ";
        $consulta .= " FROM aula ";
        $consulta .= "WHERE NombreAula LIKE '%" . $busca . "%'";
        $aulas = $mysqli->query($consulta);
    }}
?>


<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix" style="background: #0174DF;">
          <strong>
            <span class="glyphicon glyphicon-inbox" style="color: #FFF;"></span>
            <span style="color: #FFF;">Todas la Aulas Registradas</span>
          </strong>



          <div class="pull-right">
            <a href="plantillas/plantilla.xlsx" class="btn btn-primary" style="margin-left: 10px" download="plantilla.xlsx">Manual de aulas</a>
          </div>
          <strong>
         <a href="AgregarAulas.php" class="btn btn-info pull-right">Agregar aula</a>
       </strong>

          <br>
        <h1 style="color: #FFF;" align="center">Subir Archivos</h1>
      <div class="formulario">
    <form action="Aulas.php" class="formulariocompleto" method="post" enctype="multipart/form-data">
       <input type="file" name="archivo" class="form-control"/>
      <input type="submit" value="SUBIR ARCHIVO" class="form-control" name="enviar">
    </form>
   </div>
<br>
 <h1 style="color: #FFF; font-size: 150%">Aula</h1>
<form action="Aulas.php" method="POST">
  <label><input type="text"  name="buscar" ></label>
<input type="submit" class="btn btn-info " name="enviando" value="Buscar aulas" >
</form>
</body>
</html>
        </div>


        <div class="panel-body">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th> Nombre del Aula </th>
                <th class="text-center" style="width: 15%;"> Estado</th>
                <th class="text-center" style="width: 100px;"> Acciones </th>
             </tr>
            </thead>


           <tbody>
             <?php
if ($totalregistros >= 1):
    foreach ($registros as $reg):
    ?>
                         <tr>
                           <td class="text-center"><?php echo count_id(); ?></td>
                           <td><?php echo remove_junk($reg['NombreAula']); ?></td>
                           <td class="text-center">
                             <?php if ($reg['EstadoAula'] === '1'): ?>
                        <span class="label label-success"><?php echo "Activo"; ?></span>
                      <?php else: ?>
            <span class="label label-danger"><?php echo "Inactivo"; ?></span>
          <?php endif;?>
               </td>
               <td class="text-center">
                  <div class="btn-group">
                     <a href="Editar_Aulas.php?id=<?php echo (int) $reg['id']; ?>" class="btn btn-info btn-xs"  title="Editar" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-edit"></span>
                     </a>
                     <a href="Eliminar_Aulas.php?id=<?php echo (int) $reg['id']; ?>" class="btn btn-danger btn-xs"  title="Eliminar" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-trash"></span>
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
      <a href="Aulas.php?pagina=<?php echo $pagina - 1; ?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
  <?php endif;
for ($i = 1; $i <= $numeropaginas; $i++) {
    if ($pagina == $i) {
        echo '<li class="active"><a href="Aulas.php?pagina=' . $i . '">' . $i . '</a></li>';
    } else {
        echo '<li><a href="Aulas.php?pagina=' . $i . '">' . $i . '</a></li>';
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
      <a href="Aulas.php?pagina=<?php echo $pagina + 1; ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
    <?php endif;?>
  </ul>
</nav>
<?php endif;?>


    </div>
  </div>

<?php include_once 'Diseños/Pie_De_Pagina.php';?>
