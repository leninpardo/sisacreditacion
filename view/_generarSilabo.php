<?php
require_once '../dompdf-master/dompdf_config.inc.php';
$html='';
$html.='
<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title>Document</title>
<style>
	#customers{
		margin: 0 auto;
		border: 0px dashed skyblue;
		width: 625px;
		padding: 40px;
		border-radius: 5px 5px 5px 5px;
	}
	.unsm{
		float: left;
		vertical-align: middle;
		width: 80px; height:95px; 
	}
 .cont p{
 	margin-left: -3.5em;
 	text-align: center;
 }

 p{margin: 0.5em;
   text-align: justify;
 }

 ol{margin: 0.5em 25px;}

 dir{margin: 0.3em 0px;
     text-align: justify;
 }

.tb tr td{padding: 10px; text-align: justify;}

.tbb tr td dir{margin: 0.3em 0px;}

</style>

</head>
<body>
<div id="customers">
<img class="unsm" src="../web/images/noticias/unsm.png" />
<div class="cont">
	 <p><strong style="font-size: 19px">UNIVERSIDAD NACIONAL DE SAN MARTÍN-T</strong></p>
	 <p> FACULTAD DE INGENIERÍA DE SISTEMAS E INFORMÁTICA  </p>
	 <p> Escuela Académico Profesional de Ingeniería de Sistemas e Informática </p>
 ';
 foreach ($rows as $key => $value) { $curso=utf8_encode($value[0]); $semes=$value[12];

 	$html.='<p><strong> Semestre Académico: '.$value[12].'</strong></p>
</div>
 	<h4 align="center">SÍLABO  </h4>
	<div style="text-align: left" >
	<strong>I. DATOS GENERALES</strong>
	<table class="table tbb">
	  <tbody>
		<tr>
		<td ><dir>1. ASIGNATURA</dir></td>
		<td >:</td>
	<td> '.utf8_encode($value[0]).'</td>
	</tr>
	<tr>
		<td><dir>2. CÓDIGO</dir></td>
		<td>:</td>
	<td>'.utf8_encode($value[4]).'</td>
	</tr>
			
			<tr>
				<td><dir>3. SEMESTRE ACADÉMICO</dir></td>
				<td>:</td>
				<td>'.$value[12].'</td>
			</tr>
			<tr>
				<td><ol>I. Fecha Inicio</ol></td>
				<td>:</td>
				<td>'.$value[13].'</td>
			</tr>
			<tr>
				<td><ol>II. Fecha Término</ol></td>
				<td>:</td>
				<td>'.$value[14].'</td>
			</tr>			
			<tr>
				<td><dir>4. ÁREA CURRICULAR</dir></td>
				<td>:</td>
				<td>'.$value[5].'</td>
			</tr>
			<tr>
				<td><dir>5. N° DE ORDEN</dir></td>
				<td>:</td>
				<td>'.$value[18].'</td>
			</tr>
			<tr>
				<td><dir>6. CICLO EN EL QUE SE DICTA</dir></td>
				<td>:</td>
				<td>'.$value[3].'</td>
			</tr>
			<tr>
				<td><dir>7. DURACIÓN DE SEMANAS</dir></td>
				<td>:</td>
				<td> '.floor((strtotime($value[14])-strtotime($value[13]))/604800).'</td>
			</tr>
			<tr>
				<td><dir>8. HORAS A LA SEMANA</dir></td>
				<td>:</td>
				<td>HT= '.$value[6].', HP= '.$value[7].', HT= '.($value[6]+$value[7]).'</td>
			</tr>
			<tr>
				<td><dir>9.N° DE CRÉDITOS</dir></td>
				<td>:</td>
				<td>'.intval($value[1]).'</td>
			</tr>
			<tr>
				<td><dir>10. DOCENTE RESPONDABLE</dir></td>
				<td>:</td>
				<td>'.$value[16].'</td>
			</tr>
		</tbody>
	</table>

</div>
<br>
<div style="text-align: left" >
	<strong>II. SUMILLA</strong>
	<dir>'.$value[9].'</dir>
</div>

<div style="text-align: left" >
	<strong>III. OBJETIVO</strong>
	<dir>'.$value[17].'</dir>
</div>

<div style="text-align: left" >
	<strong>IV. METODOLOGIA</strong>
	<dir>'.$value[10].'</dir>
</div>
<div style="text-align: left" >
	<strong>V. COMPETENCIA</strong>
	<dir>'.$value[11].'</dir>
    
    <div>
        <strong>VI. PROGRAMACIÓN DE DESARROLLO DEL CONTENIDO TEMÁTICO DE LA SUMILLA</strong>
		<dir><strong>6.1. Diseño</strong></dir>
';
}
if(isset($rows2)){
	foreach ($rows2 as $key => $value) {
 	 $html.='<dir><p>UNIDAD '.$value[0].': '.strtolower(utf8_encode($value[1])).'</p></dir>';
 	}
 }
 $html.='</div>
         <dir><strong>6.2. Contenido</strong></dir>
        ';
if(isset($rows2)){
   foreach ($rows2 as $key => $value) { $idu= $value[0];
   	$html.='<strong><p><dir>UNIDAD '.$value[0].':  '.utf8_encode($value[1]).'</dir></p></strong>
		    <dir><strong>4.2.1 Descripcion:</strong></dir><dir><p>'.$value[2].'</p></dir>
			<dir><p><strong>4.2.2 Duracion:</strong>    '.$value[3].'</p></dir>
			<dir><strong>4.2.3 Competencia:</strong></dir> <dir><p>'.$value[4].'</p></dir>
			<dir><p><strong>4.2.4 Porcentaje:</strong>  '.$value[5].'</p></dir>';
	if(isset($rows3)){
		$html.='
			<table class="table table-striped table-bordered tb" rules="all" border="1" align="justify">
		    <thead class="mloencontre">
		        <tr>
		            <th vertical-align="middle"><b>Semana</b></th>
		            <th vertical-align="middle"><b>Contenido</b></th>
		            <th vertical-align="middle"><b>Concepto</b></th>
		            <th vertical-align="middle"><b>Procedimiento</b></th>
		            <th vertical-align="middle"><b>Actitudinal</b></th>
		        </tr> 
		    </thead>
		    <tbody style="background-color: #f5f5f5 ;">
		';
		foreach ($rows3 as $key => $value) { 
		if($idu==$value[6]){
			$html.='
			<tr>
            <td >'.utf8_encode($value[0]).'</td>
            <td>
                '.$value[1].'
            </td>

            <td>
                '.$value[2].'
            </td>

            <td>
                '.$value[3].'
            </td>

            <td>
                '.$value[4].'
            </td>
        </tr> 
			';
			} 
		}
	$html.=' </tbody></table>';
	} 
$html.='</li>';
  }
}

$html.='<br>

<div style="text-align: left" >
	<strong>VII. SISTEMA DE EVALUACIÓN DEL APRENDIZAJE</strong>
<br><br>
<table class="table table-striped table-bordered tb" rules="all" border="1" align="justify">
		    <thead class="mloencontre">
		        <tr>
		            <th vertical-align="middle"><b>SIMBOLO</b></th>
		            <th vertical-align="middle"><b>CONCEPTO</b></th>
		            <th vertical-align="middle"><b>LA NOTA</b></th>
		        </tr> 
		        <tr>
		            <th colspan="2"><b>ACAD = ACADEMICA(90%)</b></th>
		            <th><b></b></th>
		        </tr>
		        <tr>
		            <th vertical-align="middle"><b>PC1</b></th>
		            <th vertical-align="middle"><b>PRACTICA CALIFICADA 1</b></th>
		            <th vertical-align="middle"><b>10%</b></th>
		        </tr> 
		        <tr>
		            <th vertical-align="middle"><b>PC2</b></th>
		            <th vertical-align="middle"><b>PRACTICA CALIFICADA 2</b></th>
		            <th vertical-align="middle"><b>10%</b></th>
		        </tr>
		        <tr>
		            <th vertical-align="middle"><b>TP</b></th>
		            <th vertical-align="middle"><b>PROYECTO DE CICLO</b></th>
		            <th vertical-align="middle"><b>10%</b></th>
		        </tr>
		        <tr>
		            <th vertical-align="middle"><b>L</b></th>
		            <th vertical-align="middle"><b>LABORATORIO</b></th>
		            <th vertical-align="middle"><b>20%</b></th>
		        </tr>
		        <tr>
		            <th vertical-align="middle"><b>EP</b></th>
		            <th vertical-align="middle"><b>EXAMEN PARCIAL</b></th>
		            <th vertical-align="middle"><b>20%</b></th>
		        </tr>
		        <tr>
		            <th vertical-align="middle"><b>EF</b></th>
		            <th vertical-align="middle"><b>EXAMEN FINAL</b></th>
		            <th vertical-align="middle"><b>20%</b></th>
		        </tr>
		        <tr>
		            <th colspan="2" vertical-align="middle"><b>EF = EVALUACION FORMATIVA(10%)</b></th>
		            <th vertical-align="middle"><b>CONCEPTO</b></th>
		        </tr>
		        <tr>
		            <th vertical-align="middle"><b>ET</b></th>
		            <th vertical-align="middle"><b>EVENTOS DE TUTORIA</b></th>
		            <th vertical-align="middle"><b>2%</b></th>
		        </tr>
		        <tr>
		            <th vertical-align="middle"><b>JL</b></th>
		            <th vertical-align="middle"><b>JORNADA LABORAL</b></th>
		            <th vertical-align="middle"><b>2%</b></th>
		        </tr>
		        <tr>
		            <th vertical-align="middle"><b>PIPS</b></th>
		            <th vertical-align="middle"><b>INVESTIGACION Y/O PROYECCION SOCIAL</b></th>
		            <th vertical-align="middle"><b>2%</b></th>
		        </tr>
		        <tr>
		            <th vertical-align="middle"><b>SEF</b></th>
		            <th vertical-align="middle"><b>SEFISI Y/O ANIVERSARIO DE LA UNSM</b></th>
		            <th vertical-align="middle"><b>2%</b></th>
		        </tr>
		        <tr>
		            <th vertical-align="middle"><b>OT</b></th>
		            <th vertical-align="middle"><b>CURSOS, PONENCIAS Y OTROS</b></th>
		            <th vertical-align="middle"><b>2%</b></th>
		        </tr>
		        <tr>
		            <th colspan="2" align="center" vertical-align="middle"><b>TOTAL</b></th>
		            <th vertical-align="middle"><b>100</b></th>
		        </tr>
		    </thead>
		    </table>
		    </div>
		';

$html.='<br><div style="text-align: left" >
	    <strong>VIII. BIBLIOGRAFIA</strong>';
if(isset($rows4)){
	foreach ($rows4 as $key => $value) {$idb=$value[3];
		if($idb==1){
 	 $html.='<dir><p>'.$value[2].'.'.$value[4].'</p></dir>
	         ';
	     }
 	}
 }
$html.='<dir><strong>LINKOGRAFIA</strong></dir>';
if(isset($rows4)){
	foreach ($rows4 as $key => $value) {$idb=$value[3];
 if($idb==2){
	     $html.='
	        <dir><p>'.$value[2].'.'.$value[4].'</p></dir>
	         ';
	       }
	   }
 }

$html.='
	 </div>	
	</div>
  </body>
</html>';


# Instanciamos un objeto de la clase DOMPDF.
$mipdf = new DOMPDF();
 
# Definimos el tamaño y orientación del papel que queremos.
# O por defecto cogerá el que está en el fichero de configuración.
$mipdf ->set_paper("A4", "portrait");
 
# Cargamos el contenido HTML.
$mipdf ->load_html($html);
 
# Renderizamos el documento PDF.
$mipdf ->render();
# Enviamos el fichero PDF al navegador.
$mipdf ->stream(''.$curso.'--'.$semes);
?>
 
