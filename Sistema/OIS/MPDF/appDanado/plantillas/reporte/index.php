<?php

function getPlantilla($conexion){










  $plantilla= '<body>
    <header class="clearfix">
      <div id="logo">
        <img src="logo/logo.png" width="100" height="100">
      </div>
      <div id="company">
        <h2 class="name">SISTEMA OIS</h2>
        <div><a href="mailto:company@example.com">sistem_jcta_ois@sistemaois.com</a></div>
      </div>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to">Julio Cesar Turbay Ayala</div>
          <h2 class="name">7796196 - 5795177</h2>
          <div class="address">TRANSVERSAL 9 ESTE N° 45A-80 BARRIO JULIO RINCON.</div>
          <div class="email"><a href="mailto:john@example.com">i.e.juliocesarturbay@hotmail.com</a></div>
        </div>
        <div id="invoice">
          <br>
          <h1 align="center">Estados Dañados</h1>
        </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no"><h4>Nombres de Mobiliario</h4></th>
            <th class="desc"><h3>Codigo Mobiliario</h3></th>
            <th class="total"><h3>Aulas</h3></th>
            <th class="unit"><h3>Estado</h3></th>
            
          </tr>
        </thead>
        <tbody>';

      foreach($conexion as $producto){

        $plantilla .='<tr>
        <td class="total" align="left">'.$producto["NombreMobiliario"].'</td>
        <td class="deno" align="center">'.$producto["CodigoMobiliario"].'</td>
        <td class="total" align="left">'.$producto["NombreAula"].'</td>
        <td class="unit" align="left">'.$producto["NombreEstadoMobiliario"].'</td>       
      </tr>';
      }





        

          
        $plantilla.='</tbody>
      </table>
    </main>
  </body>';

  return $plantilla;
}