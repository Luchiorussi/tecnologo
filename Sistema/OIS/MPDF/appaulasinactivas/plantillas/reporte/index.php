<?php

function getPlantilla($conexion){










  $plantilla= '<body>
    <header class="clearfix"><meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
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
          <h1 align="center"> AULAS INACTIVAS </h1>
        </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no"><h5>Nombre del aula</h5></th>
            <th class="desc" align="center"><h2>Estado</h2></th>
       
            
            
          </tr>
        </thead>
        <tbody>';

      foreach($conexion as $usuario){

        $plantilla .='<tr>
        <td class="total" align="center">'.$usuario["NombreAula"].'</td>
        <td class="desc" align="center">Inactivo</td>
      </tr>';
      
      }

     
          
        $plantilla.='</tbody>
      </table>
    </main>
  </body>';

  return $plantilla;
}