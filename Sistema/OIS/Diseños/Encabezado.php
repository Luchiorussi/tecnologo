
<?php $user = current_user(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
<title><?php if(!empty($page_title))
      echo remove_junk($page_title);
    elseif(!empty($user))
    echo ucfirst($user['Nombre']);
else echo "SISTEMA OIS";?> 
</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    <link rel="stylesheet" href="Librerias/css/Estilos.css" />
  </head>


<body>
	<?php if($session->isUserLoggedIn(true)): ?>
<header id="header" style="background: #F8F8F8;">
	<div class="logo pull-left" style="background:#0174DF;font-size: 18px;"> SISTEMA INVENTARIO</div>
	<div class="header-content">
	<div class="header-date pull-left" >
        <?php date_default_timezone_set("America/Bogota"); ?>
        <strong style="color: #000000;"><?php echo date("d/m/Y  h:i a");?></strong>
      </div>
       <div class="pull-right clearfix">
        <ul class="info-menu list-inline list-unstyled">
          <li class="profile">
            <a href="#" data-toggle="dropdown" class="toggle" aria-expanded="false">
            <img src="Cargas/Usuarios/<?php echo $user['ImagenUsuario'];?>" alt="user-image" class="img-circle img-inline">	
            <span><?php echo remove_junk(ucfirst($user['Nombre'])); ?> <i class="caret"></i></span>
            </a>
            <ul class="dropdown-menu">
            	<li>
            		<a href="Perfil.php?id=<?php echo (int)$user['id'];?>">
            	<i class="glyphicon glyphicon-user"></i>
                      Configuracion
                  </a>
                  </li>
                  <li class="last">
                 <a href="CerrarSesion.php">
                     <i class="glyphicon glyphicon-off"></i>
                     Cerrar Sesion
                 </a>
             </li>
         </ul>
     </li>
 </ul>
</div>
</div>
</header>

<div class="sidebar">
    <!-- Menu del cargo de la institucion educativa julio cesar turbay ayala Rector  -->
	<?php if($user['idCargoUsuario'] === '1'): ?>
	<?php include_once('Menu_Administrador.php');?>


      <!-- Menu del cargo de la institucion educativa julio cesar turbay ayala Jefe de inventario -->
    <?php elseif($user['idCargoUsuario'] === '2'): ?>
	<?php include_once('Jefe_Inventario_Menu.php');?>


      <!-- Menu del cargo de la institucion educativa julio cesar turbay ayala docente-->
  <?php elseif($user['idCargoUsuario'] === '3'): ?>
	<?php include_once('Docente_Menu.php');?>


    <!-- Menu del cargo de la institucion educativa julio cesar turbay ayala coordinador-->
  <?php elseif ($user['idCargoUsuario'] === '4'): ?>
    <?php include_once('Coordinador_Menu.php') ?>
   <?php endif;?>

   </div>
<?php  endif;?>

<div class="page">
	<div class="container-fluid">