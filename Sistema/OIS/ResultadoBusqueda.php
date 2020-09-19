<?php
$page_title = 'Filtro Busqueda';
  require_once('configuracion/Cargar.php');
  page_require_level(2);
  $e_user = find_by_id('mobiliarioaula',(int)$_GET['id']);
$all_aula = find_all('aula');
?>
<!doctype html>
<html>
<head>
  <?php include_once('Diseños/Encabezado.php'); ?>
<meta charset="utf-8">
<title></title>
</head>

<body>

  <form action="ResultadoBusqueda.php" method="POST">

  <label for="idAula">Aula del mobiliario</label>
                <select class="form-control" name="buscar">
                <option value=""></option>
                  <?php foreach ($all_aula as $all_aul):?>
                   <option <?php if($all_aul['id'] === $e_user['idAula']) 
                   echo 'selected="selected"';?> value="<?php echo $all_aul['id'];?>"><?php echo ucwords($all_aul['NombreAula']);?></option>
                 <?php endforeach;?>
                 </select>
<input type="submit" name="enviando" value="Buacar!" >



</form>

<?php
if(isset($_POST['buscar'])){
$busca=$_POST['buscar'];
require 'cn.php';
if($busca!=""){
	$consulta = "SELECT m.id, m.NombreMobiliario, m.CodigoMobiliario, a.NombreAula, m.VidaUtilMobiliario, m.VidaUtilMobiliarioFinal, em.NombreEstadoMobiliario FROM MobiliarioAula m INNER JOIN Aula a ON a.id = m.idAula INNER JOIN EstadoMobiliario em ON em.id = m.idNombreEstadoMobiliario  WHERE idAula LIKE '".$busca."'";
  $consulta .="ORDER BY m.NombreMobiliario ASC";
	

	$busqueda = $mysqli->query($consulta);
}}
?>

 <div class="panel-body">
	<table class="table table-bordered" width="400" border ="1">
    <thead>
	<tr>
		<th class="text-center" style="width: 10px;">#</th>
		<th class="text-center" style="width: 10px;">Nombre Mobiliario</th>
		<th class="text-center" style="width: 10px;">Codigo de Mobiliario</th>
		<th class="text-center" style="width: 10px;">Nombre del Aula</th>
		<th class="text-center" style="width: 10px;">Vida Util Inicial</th>
		<th class="text-center" style="width: 10px;">Vida Util Final</th>
		<th class="text-center" style="width: 10px;">Estado Mobiliario</th>
		<th class="text-center" style="width: 10px;">Acciones</th>

</thead>
	</tr>


<tbody>
		<?php foreach ($busqueda as $product):?>
              <tr>
               	<td class="text-center"> <?php echo ($product['id']); ?></td>
               	<td class="text-center"> <?php echo ($product['NombreMobiliario']); ?></td>
               	<td class="text-center"> <?php echo ($product['CodigoMobiliario']); ?></td>
                <td class="text-center"> <?php echo ($product['NombreAula']); ?></td>
                <td class="text-center"> <?php echo ($product['VidaUtilMobiliario']); ?></td>
                <td class="text-center"> <?php echo ($product['VidaUtilMobiliarioFinal']); ?></td>
                <td class="text-center"> <?php echo ($product['NombreEstadoMobiliario']); ?></td>
                <td class="text-center">
               
                  <div class="btn-group">
                    <a href="Editar_producto.php?id=<?php echo (int)$product['id'];?>" class="btn btn-info btn-xs"  title="Editar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                     <a href="Eliminar_producto.php?id=<?php echo (int)$product['id'];?>" class="btn btn-danger btn-xs"  title="Eliminar" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>

                  </div>
                </tr>
                <?php endforeach; ?>
                </tbody>

</table>
</div>



</body>
</html>