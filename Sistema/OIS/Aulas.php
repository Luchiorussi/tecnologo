<?php
  $page_title = 'Lista de Aulas';
  require_once('configuracion/Cargar.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
?>

<?php
$aulas = find_all_aula();
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
if(isset($_POST['buscar'])){
$busca=$_POST['buscar'];
require 'ConexionBuscador.php';
if($busca!=""){ 
  $consulta = "SELECT * ";
  $consulta .=" FROM aula ";
  $consulta .="WHERE NombreAula LIKE '%".$busca."%'";
  $aulas = $mysqli->query($consulta);
}}
?>

<html>
<body>

<?php include_once('Disenos/Encabezado.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>


  
<div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix" style="background:#0588FC;">
          <strong>
            <span class="glyphicon glyphicon-inbox"  style="color:#FFF;"></span>
            <span  style="color:#FFF;">Aulas Registradas</span>
          </strong>

        <!--Boton de Manual--->
        <div class="pull-right">
           <a href="plantillas/ManualUsuario.pdf" class="btn btn-primary" style="margin-left: 10px" download="ManualUsuario.pdf">Manual de aulas
                           <i  class="glyphicon glyphicon-download-alt"></i>
           </a>
         </div> 

          <!--Boton de agregar--->
          <div class="pull-right">
            <a href="AgregarAulas.php"  style="margin-left: 1000px" class="btn btn-primary" >Agregar Aula</a>
          </div>

          <!--Carga masiva--->
      <h1 align="center"  style="color:#FFF;">Subir Archivos</h1>
      <div class="formulario">
          <form action="Aulas.php" class="formulariocompleto" method="post" enctype="multipart/form-data">
            <input type="file" name="archivo" class="form-control"/>
            <input type="submit" value="SUBIR ARCHIVO" class="form-control" name="enviar">
          </form>
      </div>

    <form action="Aulas.php" method="POST">
            <label><input type="text"  name="buscar" ></label>
            <input type="submit" class="btn btn-primary " name="enviando" value="Buscar aulas" >
    </form>


        </div>

        <div class="panel-body">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th> Nombre del Aula</th>
                <th class="text-center" style="width: 15%;"> Estado</th>
                <th class="text-center" style="width: 100px;"> Acciones </th>
             </tr>
            </thead> 

            <tbody>
             <?php foreach ($aulas as $aula):?>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td><?php echo remove_junk($aula['NombreAula']); ?></td>
               <td class="text-center">
                  <?php if ($aula['EstadoAula'] === '1'): ?>
                  <span class="label label-success"><?php echo "Activo"; ?></span>
                  <?php else: ?>
            <span class="label label-danger"><?php echo "Inactivo"; ?></span>
          <?php endif;?>
               </td>

               <td class="text-center">
                  <div class="btn-group">
                     <a href="Editar_Aulas.php?id=<?php echo (int)$aula['id'];?>" class="btn btn-warning btn-xs"  title="Editar" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-edit"></span>
                     </a>
                     <a href="Eliminar_Aulas.php?id=<?php echo (int)$aula['id'];?>" class="btn btn-danger btn-xs"  title="Eliminar" data-toggle="tooltip">
                       <span class="glyphicon glyphicon-trash"></span>
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
           <a href="plantillas/plantilla.xlsx" class="btn btn-primary" download="plantilla.xlsx">PLANTILLAS DE AULAS
                           <i  class="glyphicon glyphicon-download-alt"></i>

           </a>
        </div>  

<?php include_once('Disenos/Pie_de_Pagina.php'); ?>
</body>
</html>