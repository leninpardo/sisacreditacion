<?php 
$id = $_GET["ht"];
require_once '../dompdf-master/dompdf_config.inc.php';
		$html= '
<!DOCTYPE html>
<html>
<head>
	<title>hola</title>
</head>
<body>
'.$id.'
</body>
</html>
		'

		;
# Instanciamos un objeto de la clase DOMPDF.
$mipdf = new DOMPDF();
 
# Definimos el tamaño y orientación del papel que queremos.
# O por defecto cogerá el que está en el fichero de configuración.
$mipdf ->set_paper("A4", "portrait");
 
# Cargamos el contenido HTML.
$mipdf ->load_html(utf8_decode($html));
 
# Renderizamos el documento PDF.
$mipdf ->render();
 
# Enviamos el fichero PDF al navegador.
$mipdf ->stream('FicheroEjemplo.pdf');
?>
