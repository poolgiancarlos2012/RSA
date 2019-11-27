<?php
// $ruta_xml = "/home/poolpg/Documentos/DOCUMS/";
// $destino='/opt/lampp/htdocs/SFW/reporte/pdf/Documentos/588a2aa8966c6/xml/';
// foreach(glob($ruta_xml.'Documento_0001FTF0040000324'.'.zip') as $file) {
//     //$ficheros[]= str_replace($ruta_xml, "", $file);

// 	if (!file_exists($destino)) {
//     	mkdir($destino);
// 	}

// 	//$filxmlzip= 'Documento_0001FTF0040000325.zip';
// 	$filxmlzip= str_replace($ruta_xml, "", $file);
// 	copy($ruta_xml.$filxmlzip, $destino.$filxmlzip);

// }

// print_r($ficheros);






// $ruta_xml='/home/poolpg/Documentos/DOCUMS/';
// $destino='/opt/lampp/htdocs/SFW/reporte/pdf/Documentos/588a2aa8966c6/xml/';

// if (!file_exists($destino)) {
//     mkdir($destino);
// }

// $filxmlzip= 'Documento_0001FTF0040000325.zip';

// copy($ruta_xml.$filxmlzip, $destino.$filxmlzip);


function addFolderToZip($dir, $zipArchive){
    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {

            //Add the directory
            $zipArchive->addEmptyDir($dir);
            
            // Loop through all the files
            while (($file = readdir($dh)) !== false) {
            
                //If it's a folder, run the function again!
                if(!is_file($dir . $file)){
                    // Skip parent and root directories
                    if( ($file !== ".") && ($file !== "..")){
                        //addFolderToZip($dir . $file . "/", $zipArchive);
                    }
                    
                }else{
                    // Add the files
                    $zipArchive->addFile($dir . $file);
                    
                }
            }
        }
    }
}




$dir='/opt/lampp/htdocs/SFW/reporte/pdf/Documentos/';
$directorio='588a3bdafdab2';

$filename = $dir.$directorio.".zip";
$zip = new ZipArchive();
if ($zip->open($filename, ZipArchive::CREATE) !== TRUE) {
exit("cannot open <$filename>\n");
}

$carpeta = $dir.$directorio."/";
foreach(glob($carpeta.'*.pdf') as $file) {
    $ficheros[]= str_replace($dir.$directorio."/", "", $file);
}

$input = '.pdf';
$data = $ficheros;

$result = array_filter($data, function ($item) use ($input) {
    if (stripos($item, $input) !== false) {
        return true;
    }
    return false;
});

$result_arr=array_values($result);

for($i=0;$i<=count($result_arr)-1;$i++){
    $zip->addFile($dir.$directorio."/".$result_arr[$i],$result_arr[$i]);
}

$zip->addEmptyDir('xml');

$filexml = $dir.$directorio."/xml/";
foreach(glob($filexml.'*.zip') as $fixml) {
    $fichzipxml[]= str_replace($dir.$directorio."/xml/", "", $fixml);
}

for($j=0;$j<=count($fichzipxml)-1;$j++){
    $zip->addFile($dir.$directorio."/xml/".$fichzipxml[$j],'xml/'.$fichzipxml[$j]);
}
	

?>