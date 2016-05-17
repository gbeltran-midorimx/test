<?php 
    require_once('nusoap095/nusoap.php'); 
     
    $conect_banxico = new nusoap_client('http://www.banxico.org.mx/DgieWSWeb/DgieWS?WSDL','wsdl'); 
         
    if ($error = $conect_banxico->getError()) { 
        echo "No se pudo realizar la operación [" . $error . "]"; 
        die(); 
    } 
    //$aParametros = array("TITULO" => $titulo,"IDSERIE"=> $serie,"BANXICO_FREQ"=>$frec, "BANXICO_UNIT_TYPE"=> $tipo); 
    //$aParametros = ""; 
    $respuesta = $conect_banxico->call('tiposDeCambioBanxico'); 
     
    // Existe alguna falla en el servicio?  
    if ($conect_banxico->fault) { // Si 
        echo 'No se pudo completar la operación'; 
        die(); 
    }else { // No 
        $error = $conect_banxico->getError(); 
        // Hay algun error ? 
        if ($error) { // Si 
            echo 'Error:' . $error; 
            die(); 
        } 
        echo "Funciono correctamente<br/>"; 
      //  echo $respuesta;

   $dom = new DomDocument(); 
    $dom->loadXML($respuesta); 
    $xmlDatos = $dom->getElementsByTagName( "Obs" ); 
        $xmlTags = $dom->getElementsByTagName( "Series" ); 
    if($xmlDatos->length>1) { ?>
           <select name="Tipo de cambio"> 
    <?PHP
        for($i=0;$i<6;$i++){
            ?>

<?php
        $item = $xmlDatos->item($i);
        $tags = $xmlTags->item($i); 
        $fecha_tc =($item->getAttribute('TIME_PERIOD'))."  "; 
        $nombre=($tags->getAttribute('TITULO'));
        $tc = $item->getAttribute('OBS_VALUE').'' ;
      ?>
     <option value=<?php echo $tc?>><?php echo $nombre."---".$tc."------". $fecha_tc?></option>          

  <?PHP  } 
    
        }
    }?>
     </select>
   <?php

      //  echo $respuesta['OBS_VALUE']; 
//        
//    }

//$resultado=''; 
//$fecha_tc=''; 
//$tc=''; 
//$client = new SoapClient(null, array('location' => 'http://www.banxico.org.mx:80/DgieWSWeb/DgieWS?WSDL', 
//                             'uri'      => 'http://DgieWSWeb/DgieWS?WSDL', 
//                            // 'encoding' => 'ISO-8859-1', 
//     
//                             
//                                                                             'trace'    => 1) ); 
//SEGUIMOS PROBANDO
?>

    
    </head>
     
    <body>
     
     
	 
    <form action="" name="formularito">
    <table width="250" border="1">
      <tr>
        <td>
          <select name="combo1" size="1" id="combo1" onchange= "javascript:funcion(combo1.value)">
          <option value="adidas">ADIDAS</option>
          <option value="nike">NIKE</option>
          <option value="umbro">UMBRO</option>
          <option value="diadora">DIADORA</option>
          <option value="fila">FILA</option>
          </select>
        </td>
      </tr>
      <tr>
        <td>
        <input type="text" name="combito" id="marcas" size="5"  />
		<input type="text" name="combito" id="marcas" size="5"  />
		<input type="text" name="combito" id="marcas" size="5"  />
		<input type="text" name="combito" id="marcas" size="5"  />
        </td>
      </tr>
      <tr>
        <td>
            
        <input  type="button" value="shit" onclick="document.getElementById('marcas').value=document.getElementById('combo1').value"> 
        </form>
        <script language="javascript">
    function funcion(combo1)
    {
           document.getElementById('marcas').value=combo1;
    }
    </script>