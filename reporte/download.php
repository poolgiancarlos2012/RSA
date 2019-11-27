<?php

$conf = parse_ini_file('../conf/cobrast.ini', true);


$xruta=$_GET['xruta'];
//$ruta="/opt/lampp/htdocs/SFW/reporte/pdf/Documentos/";
//$ruta=$conf['ruta_cobrast']['document_root_cobrast']."/reporte/pdf/Documentos/";
$ruta=$conf['ruta_cobrast']['document_root_cobrast'].$xruta;

//$carpetazip=$_GET['carpetazip'];
$unique=$_GET['unique'];



foreach(glob($ruta.'*'.$unique.'.pdf') as $file) {
    $ficheros[]= str_replace($ruta, "", $file);
}


//$arch = $ruta.$carpetazip.".zip";
$arch = $ruta.$ficheros[0];
// $arch = $ruta."Documento_0001FTF0040000022-588fffd0bfa20".".pdf";
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename='.basename($arch));
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($arch));
ob_clean();
flush();
readfile($arch);

?>