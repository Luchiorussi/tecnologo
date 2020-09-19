<?php
$page_title = 'Reporte de Fechas';
$results    = '';

require_once 'configuracion/Cargar.php';

page_require_level(2);
?>

 <?php
if (isset($_POST['submit'])) {
    $req_dates = array('start-date', 'end-date');
    validate_fields($req_dates);

    if (empty($errors)):

        $start_date = remove_junk($db->escape($_POST['start-date']));
        $end_date   = remove_junk($db->escape($_POST['end-date']));
        $results    = find_sale_by_dates($start_date, $end_date);
    else:
        $session->msg("d", $errors);
        redirect('ReporteFecha.php', false);
    endif;

} else {
    $session->msg("d", "Selecciona las Fecha");
    redirect('ReporteFecha.php', false);
}
?>
<!doctype html>
<html lang="en-US">
 <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <title>Reporte de Vida util Inicial</title>
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
  <?php if ($results): ?>
    <div class="page-break">
       <div class="sale-head pull-right">
           <h1>Mobiliario Ingresado</h1>
           <br>
           <center>
                    <button  class="btn btn-info" style="background:#49FF33; "><a href="ReporteFecha.php">Regresar</a></button>
                    </center>
           <strong><?php if (isset($start_date)) {echo $start_date;}?> a <?php if (isset($end_date)) {echo $end_date;}?> </strong>
       </div>
      <table class="table table-border">
        <thead>
          <tr>
              <th>Fecha de Ingreso</th>
              <th>Nombre Mobiliario</th>
              <th>Aula</th>
              <th>Condiciones de Entrega</th>
              <th>Cantidad</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($results as $result): ?>
           <tr>
              <td class=""><?php echo remove_junk($result['VidaUtilMobiliario']); ?></td>
               <td class="desc">
                <h6><?php echo remove_junk(ucfirst($result['NombreMobiliario'])); ?></h6>
              </td>
              <td class="desc">
                <h6><?php echo remove_junk(ucfirst($result['NombreAula'])); ?></h6>
              </td>
                <td class="desc">
                <h6><?php echo remove_junk(ucfirst($result['EstadoMobiliario'])); ?></h6>
              </td>
                <td class="text-right">
                  <?php echo remove_junk($result['Total_Mobiliarios']); ?></td>
              </tr>
        <?php endforeach;?>
        </tbody>
      </table>
    </div>
  <?php
else:
    $session->msg("d", "No se encontraron ninguna fecha. ");
    redirect('ReporteFecha.php', false);
endif;
?>
</body>
</html>
<?php if (isset($db)) {$db->db_disconnect();}?>




