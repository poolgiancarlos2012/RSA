<?php




$xruta=$_GET['xruta'];
$xvalue=$_GET['xvalue'];
// $xruta='/home/poolpg/Documentos/DOCUMS/';
// $xvalue='F004-0000324';


foreach(glob($xruta.'*'.$xvalue.'.zip') as $file) {
    $ficheros[]= str_replace($xruta, "", $file);
}

//print_r($ficheros);

//$arch = $ruta.$carpetazip.".zip";
$arch = $xruta.$ficheros[0];
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