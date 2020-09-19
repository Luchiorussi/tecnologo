<?php 
$page_title = 'Reporte Prestamo';

require_once('configuracion/Cargar.php');
page_require_level(2);
 ?>

<?php 
// Registrar qué nivel de usuario tiene permiso para ver esta página
$results = find_Estado_Prestamo();
 ?>
 
 <!doctype html>
<html lang="en-US">
 <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <title>Reporte de Prestamo</title>
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
           <h1>Prestamos con Estados</h1>
             </div>
             <table class="table table-border">
        <thead>
          <tr>
              <th>Mobiliario</th>
              <th>aula</th>
              <th>Numero Documento</th>
              <th>Nombres Completos</th>
              <th>Novedad del Prestamo</th>
              <th>Estado</th>
          </tr>
      </thead>
      <tbody>
      	<?php foreach($results as $result): ?>
           <tr class="text-center">
               <td class="desc">
                <h6><?php echo remove_junk(ucfirst($result['Mobiliario']));?></h6>
              </td>
              <td class="desc">
                <h6><?php echo remove_junk(ucfirst($result['aula']));?></h6>
              </td>

              <td class="desc">
                <h6><?php echo remove_junk(ucfirst($result['documento']));?></h6>
              </td>
              <td class="desc">
                <h6><?php echo remove_junk(ucfirst($result['nombre']));?></h6>
              </td>
              <td class="desc">
                <h6><?php echo remove_junk(ucfirst($result['prestamo']));?></h6>
              </td>

              <td class="desc">
                <h6><?php echo remove_junk(ucfirst($result['estado']));?></h6>
              </td>
              </td>  
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
</body>
</html>







