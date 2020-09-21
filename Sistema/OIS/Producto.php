<?php
  $page_title = 'Lista de Productos';
  require_once('configuracion/Cargar.php');
?>

<?php

 page_require_level(2);

 $products = join_mobiliario_table();
 $e_user = find_by_id('mobiliarioaula',(int)$_GET['id']);
$all_aula = find_all('aula');
$all_states = find_all('estadomobiliario');
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

<?php
if(isset($_POST['buscar'])){
$busca=$_POST['buscar'];
require 'ConexionBuscador.php';
if($busca!=""){ 
  $consulta = "SELECT m.id, m.NombreMobiliario, m.CodigoMobiliario, a.NombreAula, m.VidaUtilMobiliario, m.VidaUtilMobiliarioFinal, em.NombreEstadoMobiliario ";
  $consulta .="FROM mobiliarioaula m ";
  $consulta .="INNER JOIN aula a ON a.id = m.idAula ";
  $consulta .="INNER JOIN estadomobiliario em ON em.id = m.idNombreEstadoMobiliario ";
  $consulta .="WHERE NombreMobiliario LIKE '%".$busca."%'";
  $consulta .="ORDER BY m.NombreMobiliario ASC";
  

  $products = $mysqli->query($consulta);
}}
?>

<?php
if(isset($_POST['buscar1'])){
$busca1=$_POST['buscar1'];
require 'ConexionBuscador.php';
if($busca1!=""){
	$consultar = "SELECT m.id, m.NombreMobiliario, m.CodigoMobiliario, a.NombreAula, m.VidaUtilMobiliario, m.VidaUtilMobiliarioFinal, em.NombreEstadoMobiliario FROM mobiliarioaula m
     INNER JOIN aula a ON a.id = m.idAula 
    INNER JOIN estadomobiliario em ON em.id = m.idNombreEstadoMobiliario  WHERE idAula LIKE '".$busca1."'";
  $consultar .="ORDER BY m.NombreMobiliario ASC";
	

	$products = $mysqli->query($consultar);
}}
?>


<?php
if(isset($_POST['buscar2'])){
$busca2=$_POST['buscar2'];
require 'ConexionBuscador.php';
if($busca2!=""){
  $consultas = "SELECT m.id, m.NombreMobiliario, m.CodigoMobiliario, a.NombreAula, m.VidaUtilMobiliario, m.VidaUtilMobiliarioFinal, em.NombreEstadoMobiliario FROM mobiliarioaula m INNER JOIN aula a ON a.id = m.idAula INNER JOIN estadomobiliario em ON em.id = m.idNombreEstadoMobiliario  WHERE idNombreEstadoMobiliario LIKE '".$busca2."'";
  $consultas .="ORDER BY m.NombreMobiliario ASC";
  

  $products = $mysqli->query($consultas);
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
          <span class="glyphicon glyphicon-tasks" style="color:#FFF;"></span>
          <span style="color:#FFF;">Mobiliarios</span>
       </strong>

         
        <!--boton de Manuales--->
        <div class="pull-right">
           <a href="plantillas/ManualUsuario.pdf" style="margin-left: 3%" class="btn btn-primary"  download="ManualUsuario.pdf">Manual de mobiliario
                  <i  class="glyphicon glyphicon-download-alt"></i>
           </a>
         </div>
         <!--Boton de descargar--->
         <a href="Agregar_producto.php"  style="margin-left: 1000px" class="btn btn-primary"  >Agregar Mobiliario</a>
         

        <!--Carga masiva--->
      <h1 align="center" style="color:#FFF;">Subir Archivos</h1>
      <div class="formulario">
          <form action="Producto.php" class="formulariocompleto" method="post" enctype="multipart/form-data">
            <input type="file" name="archivo" class="form-control"/>
            <input type="submit" value="SUBIR ARCHIVO" class="form-control" name="enviar">
          </form>
      </div>

    <!--Buscar Mobiliario--->
      <br>
      <label style="color:#FFF;">Mobiliario</label>
        <div>
                <form action="Producto.php" method="POST">
                  <label><input type="text" placeholder="Mobiliario" name="buscar"></label>
                    <input type="submit" class="btn btn-primary"   name="enviando" value="Buscar por mobiliario" >
              </form>
        </div>


    <div>
<label sc for="idAula" style="color:#FFF;">Aula del mobiliario</label>
<form action="Producto.php" method="POST">

  
                <select class="col-md-3" class="form-control" name="buscar1">
                <option value=""></option>
                  <?php foreach ($all_aula as $all_aul):?>
                   <option <?php if($all_aul['id'] === $e_user['idAula']) 
                   echo 'selected="selected"';?> value="<?php echo $all_aul['id'];?>"><?php echo ucwords($all_aul['NombreAula']);?></option>
                 <?php endforeach;?>
                 </select>
                 
<input type="submit" class="btn btn-primary "   style="margin-left: 10px" name="enviando1" value="Buscar por aulas" >

</form>
</div>


<div>
<label sc for="idAula" style="color:#FFF;">Estados del mobiliario</label>
<form action="Producto.php" method="POST">

  
                <select class="col-md-3" class="form-control" name="buscar2">
                  <option value=""></option>
                  <?php foreach ($all_states as $all_stat):?>
                   <option <?php if($all_stat['id'] === $e_user['idNombreEstadoMobiliario']) 
                   echo 'selected="selected"';?> value="<?php echo $all_stat['id'];?>"><?php echo ucwords($all_stat['NombreEstadoMobiliario']);?></option>
                 <?php endforeach;?>
                 </select>
                  
                 
<input type="submit" class="btn btn-primary " style="margin-left: 10px"  name="enviando2" value="Buscar por estado" >

</form>
</div>





      </div>

      <div class="panel-body">
      <table class="table table-bordered table-striped">
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
        <?php foreach($products as $product): ?>
            <tr>
           <td class="text-center"><?php echo count_id();?></td>
           <td><?php echo remove_junk(ucwords($product['NombreMobiliario']))?></td>
           <td class="text-center"><?php echo remove_junk(ucwords($product['CodigoMobiliario']))?></td>
           <td class="text-center"><?php echo remove_junk(ucwords($product['NombreAula']))?></td>
           <td class="text-center"><?php echo remove_junk(ucwords($product['VidaUtilMobiliario']))?></td>
           <td class="text-center"><?php echo remove_junk(ucwords($product['VidaUtilMobiliarioFinal']))?></td>
           <td class="text-center"><?php echo remove_junk(ucwords($product['NombreEstadoMobiliario']))?></td>
          <td class="text-center">
             <div class="btn-group">
                <a href="Editar_producto.php?id=<?php echo (int)$product['id'];?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Editar">
                  <i class="glyphicon glyphicon-pencil"></i>
               </a>
                <a href="Eliminar_producto.php?id=<?php echo (int)$product['id'];?>" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Eliminar">
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
              <a href="plantillas/plantilla.xlsx" class="btn btn-primary"   download="plantilla.xlsx">DESCARGAR PLANTILLA DE MOBILIARIO
                <i  class="glyphicon glyphicon-download-alt"></i>
              </a>
         </div>
  <?php include_once('Disenos/Pie_de_Pagina.php'); ?>
</body>
</html>

