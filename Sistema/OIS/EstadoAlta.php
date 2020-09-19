<?php
$page_title = 'Estado Alta';

require_once 'configuracion/Cargar.php';
page_require_level(2);
?>

<?php
// Registrar qué nivel de usuario tiene permiso para ver esta página
page_require_level(2);
$results = find_sale_by_alta();
?>
 <?php
include "Paginacion/connect.php";
include "Paginacion/paginadorEstadoAlta.php";?>
 ?>
 <!doctype html>
<html lang="en-US">
 <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <title>Estados Dados de Alta</title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
     <style>
   @media print {
     html,body{
        font-size: 9.5pt;
        margin: 0;
        padding: 0;
     }.page-break {
       page-break-before:always;
       width: auto;
       margin: auto;
      }
    }
    .page-break{
      width: 980px;
      margin: 0 auto;
    }
     .sale-head{
       margin: 40px 0;
       text-align: center;
     }.sale-head h1,.sale-head strong{
       padding: 10px 20px;
       display: block;
     }.sale-head h1{
       margin: 0;
       border-bottom: 1px solid #212121;
     }.table>thead:first-child>tr:first-child>th{
       border-top: 1px solid #000;
      }
      table thead tr th {
       text-align: center;
       border: 1px solid #ededed;
     }table tbody tr td{
       vertical-align: middle;
     }.sale-head,table.table thead tr th,table tbody tr td,table tfoot tr td{
       border: 1px solid #212121;
       white-space: nowrap;
     }.sale-head h1,table thead tr th,table tfoot tr td{
       background-color: #f8f8f8;
     }tfoot{
       color:#000;
       text-transform: uppercase;
       font-weight: 500;
     }
   </style>
</head>
<body>
  <div class="page-break">
       <div class="sale-head pull-right">
           <h1>Estado Dado de Alta</h1>
           <img src="Cargas/Usuarios/fondo.png" height="100px" width="100">
           <br>
           <br>
           <center>
                    <button  class="btn btn-info" style="background:#49FF33; "><a href="ReporteEstado.php">Regresar</a></button>
                    </center>
                    <br>
             </div>
             <table class="table table-border">
        <thead>
          <tr>
              <th>Mobiliario</th>
              <th>Codigo</th>
              <th>Aula</th>
              <th>Estado</th>
          </tr>
      </thead>
      <tbody>
        <?php
if ($totalregistros >= 1):
    foreach ($registros as $reg):
    ?>
                   <tr>
                       <td class="desc">
                        <h6><?php echo remove_junk(ucfirst($reg['NombreMobiliario'])); ?></h6>
                      </td>
                      <td class="desc">
                        <h6><?php echo remove_junk(ucfirst($reg['CodigoMobiliario'])); ?></h6>
                      </td>
                      <td class="desc">
                        <h6><?php echo remove_junk(ucfirst($reg['NombreAula'])); ?></h6>
                      </td>
                       <td class="desc">
                        <h6 align="center"><?php echo remove_junk(ucfirst($reg['NombreEstadoMobiliario'])); ?></h6>
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
      <a href="EstadoAlta.php?pagina=<?php echo $pagina - 1; ?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
  <?php endif;
for ($i = 1; $i <= $numeropaginas; $i++) {
    if ($pagina == $i) {
        echo '<li class="active"><a href="EstadoAlta.php?pagina=' . $i . '">' . $i . '</a></li>';
    } else {
        echo '<li><a href="EstadoAlta.php?pagina=' . $i . '">' . $i . '</a></li>';
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
      <a href="EstadoAlta.php?pagina=<?php echo $pagina + 1; ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
    <?php endif;?>
  </ul>
</nav>
<?php endif;?>
</body>
</html>







