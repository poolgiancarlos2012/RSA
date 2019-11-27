<?php


$filename = "mi_archivo.zip";
$zip = new ZipArchive();

if ($zip->open($filename, ZipArchive::CREATE) !== TRUE) {
exit("cannot open <$filename>\n");
}

$directorio = "587f8eba55a51/";
// $gestor_dir = opendir($directorio);
// $nombre_fichero = readdir($gestor_dir);
// while (false !== ($nombre_fichero = readdir($gestor_dir))) {
//     $ficheros[] = $nombre_fichero;
// }

foreach(glob($directorio.'*.pdf') as $file) {
    $ficheros[]= str_replace("587f8eba55a51/", "", $file);

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

print_r($result_arr);

for($i=0;$i<=count($result_arr)-1;$i++){
	$zip->addFile("587f8eba55a51/".$result_arr[$i],$result_arr[$i]);
}




$zip->close();







?>