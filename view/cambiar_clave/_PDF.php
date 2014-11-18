<?php //    include_once '../../lib/fpdf/html2fpdf.php';?>
<?php
  
ob_start();
?>

<style type="text/css">
.aqaqa {
	color: #609;
}
.fondo {
	color: #e8edff;
}
.kaa {
	text-align: center;
}
.jzj {
	color: #96C;
}
.ol {
	color: #30C;
}

body {font-family: Comic Sans MS, Helvetica, sans-serif;}

table {     font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
    font-size: 15px;    margin: 45px;     width: 480px; text-align: center;    border-collapse: collapse; }

th {     font-size: 13px;     font-weight: normal;     padding: 10px;     background: #fff;
    border-top: 4px #aabcfe;    border-bottom: 25px #fff; color: #039; }

td {    padding: 4px;     background: #fff;     border-bottom: 1px #fff;
    color: #669;    border-top: 1px transparent; }

tr:hover td { background: #C763D8; color: #C763D8;}

</style>

<div class="col-md-12">
    <img src="images/baner_cca.png" width="468px">

<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="304" height="228" border="2" align="center">
  <tr>
    <td colspan="2"><div align="center">PAGOS </div></td>
  </tr>
  <tr>
      <td>Nombre: </font></td>
    <td><?php 
    

    if ($nombre){
                    echo $nombre;}
                    if ($nombre_session){
                        
                    echo $nombre_session[0][0];}
                ?> </td>
  </tr>
  <tr>
    <td><p>Total a pagar: </p></td>
    <td><?php 
                       
                    foreach ($montocomi as $val2){?>
                    
                    <?php echo "S/.".$val2[0]?>
                  
            <?php    }?></td>
  </tr>
  <tr>
    <td height="25" colspan="2">CCA:</td>
  </tr>
  <tr>   
            
    <td height="25" colspan="2" align="left"> 
        <?php    
            //print "<pre>"; print_r($asignatura_cca); print "</pre>\n";exit(); 
            for ($i=0;$i< count($asignatura_cca);$i++){?>
        <?php echo $asignatura_cca[$i][1];?>(<strong><?php echo $asignatura_cca[$i][2];?></strong>)<br>
        <?php }?>
    </td>                           
  
  </tr> 
  <tr class="kaa">
    <td width="114" height="25">Fechas</td>
    <td width="172">Monto</td>
  </tr>
  <tr>
    <td><ul>
            <?php  
//                 var_dump($crono_alumno);
//                 exit();
//print "<pre>"; print_r($crono_alumno); print "</pre>\n";exit(); 
                           
                    for ($i=0;$i < count($crono_alumno);$i++){?>   
                        
                              
                          
                               <li><?php echo $crono_alumno[$i][0];?></li>
                     <?php  }?>
    
      
    </ul></td>
    <td><ul>
     
            <li>
                
                <?php  
//                 var_dump($crono_alumno);
//                 exit();
//print "<pre>"; print_r($crono_alumno); print "</pre>\n";exit(); 
                            
                    for ($i=0;$i < count($crono_alumno);$i++){?>   
                        
                              
                          
                               <li> <?php echo $crono_alumno[$i][1];?> </li>
                     <?php  }?>
            </li>
     
    </ul></td>
  </tr>
  <tr>
    <td colspan="2"><p>Cancela su cuota de acuerdo al cronograma establecido en el banco &quot;N&quot; con su numero de DNI &quot;<?php 
                    if ($nombre_session){
                        
                    echo $nombre_session[0][2];}
                ?>&quot; de la cuenta #3802</p></td>
  </tr>
</table>
<p>&nbsp;</p>
</div>

<?php


//  $conten .= ob_get_clean();
    
//    $pdf = new HTML2FPDF('P','A4','fr','utf-8');
//    $pdf->writeHTML($conten);
//    $pdf->pdf->IncludeJS("print(TRUE)");
//    $pdf->Output('matricula_cca.pdf');
require_once("../lib/dompdf/dompdf_config.inc.php");

$dompdf = new DOMPDF();
$dompdf->load_html(ob_get_clean());
$dompdf->set_paper("A5","portrait");
$dompdf->render();
$pdf = $dompdf->output();
$filename = "ejemplo".time().'.pdf';
//file_put_contents($filename, $pdf);
$dompdf->stream($filename);
?>

    