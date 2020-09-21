<?php
  $page_title = 'Lista de grupos';
  require_once('configuracion/Cargar.php');
   page_require_level(1);
  $all_groups = find_all('cargousuario');
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
        <span class="glyphicon glyphicon-education" style="color:#FFF"></span>
        <span style="color:#FFF">Grupos de Usuarios</span>
     </strong>
    </div>

    <div class="panel-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th class="text-center" style="width: 50px;">#</th>
            <th>Nombre del grupo</th>
            <th class="text-center" style="width: 20%;">Nivel de grupo</th>
            <th class="text-center" style="width: 15%;">Estado</th>
            <th class="text-center" style="width: 100px;">Acciones</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($all_groups as $a_group): ?>
          <tr>
           <td class="text-center"><?php echo count_id();?></td>
           <td><?php echo remove_junk(ucwords($a_group['NombreCargo']))?></td>
           <td class="text-center">
             <?php echo remove_junk(ucwords($a_group['NivelVisibilidad']))?>
           </td>
           <td class="text-center">
           <?php if($a_group['Estado'] === '1'): ?>
            <span class="label label-success"><?php echo "Activo"; ?></span>
          <?php else: ?>
            <span class="label label-danger"><?php echo "Inactivo"; ?></span>
          <?php endif;?>
           </td>

           <td class="text-center">
             <div class="btn-group">
                <a href="EditarGrupo.php?id=<?php echo (int)$a_group['id'];?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Editar">
                  <i class="glyphicon glyphicon-pencil"></i>
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


  <?php include_once('Disenos/Pie_de_Pagina.php'); ?>
</body>
</html>
