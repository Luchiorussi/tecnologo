<?php
  $page_title = 'Mi perfil';
  require_once('configuracion/Cargar.php');

   page_require_level(5);
?>

<?php
  $user_id = (int)$_GET['id'];
  if(empty($user_id)):
    redirect('Bienvenido.php',false);
  else:
    $user_p = find_by_id('usuario',$user_id);
  endif;
?>

<?php include_once('Disenos/Encabezado.php'); ?>
<div class="row">
   <div class="col-md-4">
       <div class="panel profile">
         <div class="jumbotron text-center bg-blue" style="background:#0174DF;">
            <img class="img-circle img-size-2" src="Cargas/Usuarios/<?php echo $user_p['ImagenUsuario'];?>" alt="">
           <h3><?php echo first_character($user_p['Nombre']); ?></h3>
         </div>
         <?php if( $user_p['id'] === $user['id']):?>
            <ul class="nav nav-pills nav-stacked">
          <li><a href="EditarCuenta.php"> <i class="glyphicon glyphicon-edit"></i> Editar perfil</a></li>
         </ul>
       <?php endif;?>
       </div>
   </div>
</div>
<?php include_once('Disenos/Pie_de_Pagina.php'); ?>

