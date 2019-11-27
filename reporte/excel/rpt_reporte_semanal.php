<?php
header("Content-Type: text/html;charset=utf-8");
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=rpt_reporte_semanal.xls");
header("Expires: 0");
header("Pragma: no-cache");

require_once '../../conexion/config.php';
require_once '../../conexion/MYSQLConnectionMYSQLI.php';
require_once '../../conexion/MYSQLConnectionPDO.php';
require_once '../../factory/DAOFactory.php';
require_once '../../factory/FactoryConnection.php';

date_default_timezone_set('America/Lima');


$factoryConnection= FactoryConnection::create('mysql');	
$connection = $factoryConnection->getConnection();

// $vctodesde= empty($_GET['vctodesde']) ?  '' : date('Y-m-d', strtotime(str_replace('/', '-', $_GET['vctodesde'])));
// $vctohasta= empty($_GET['vctohasta']) ?  '' : date('Y-m-d', strtotime(str_replace('/', '-', $_GET['vctohasta'])));
// $iddietfechdesde= empty($_GET['iddietfechdesde']) ?  '' : date('Y-m-d', strtotime(str_replace('/', '-', $_GET['iddietfechdesde'])));
// $iddietfechhasta= empty($_GET['iddietfechhasta']) ?  '' : date('Y-m-d', strtotime(str_replace('/', '-', $_GET['iddietfechhasta'])));
// $idmon= isset($_GET['idmon']) ? $_GET['idmon'] : '';
// $idempresa= isset($_GET['idempresa']) ? $_GET['idempresa'] : '';
// $idrazonsocial= isset($_GET['idrazonsocial']) ? $_GET['idrazonsocial'] : '';
// $idvendedor= isset($_GET['idvendedor']) ? $_GET['idvendedor'] : '';
// $idzona= isset($_GET['idzona']) ? $_GET['idzona'] : '';


/*if(empty($_GET['fechgestion']) ){
  $fechgestion='';
}else{
  $fechgestion=date('Y-m-d', strtotime(str_replace('/', '-', $_GET['fechgestion'])));
}*/

$utf8='SET NAMES utf8;';
$prutf8 = $connection->prepare($utf8);
$prutf8->execute();


if(empty($_GET['dfechgestion']) ){
  $dfechgestion='';
}else{
  $dfechgestion=date('Y-m-d', strtotime(str_replace('/', '-', $_GET['dfechgestion'])));
}

if(empty($_GET['hfechgestion']) ){
  $hfechgestion='';
}else{
  $hfechgestion=date('Y-m-d', strtotime(str_replace('/', '-', $_GET['hfechgestion'])));
}

$idcliente=$_GET['idcliente'];
$idcliente= empty($_GET['idcliente']) ?  '' : $_GET['idcliente'];
$idmotivo= empty($_GET['objetivo']) ?  '' : $_GET['objetivo'];
$idactividad= empty($_GET['actividad']) ?  '' : $_GET['actividad'];
$idusuario= empty($_GET['idusuario']) ?  '' : $_GET['idusuario'];

$where="";

/*if($fechgestion!=''){
  $date = str_replace('/', '-', $fechgestion);
  $fech_gestion =date('Y-m-d', strtotime($date));
  $where.=" AND fecha_visita='$fechgestion'";
}*/

if($dfechgestion!='' AND $hfechgestion!=''){
  $ddate = str_replace('/', '-', $dfechgestion);
  $dfech_gestion =date('Y-m-d', strtotime($ddate));
  $hdate = str_replace('/', '-', $hfechgestion);
  $hfech_gestion =date('Y-m-d', strtotime($hdate));
  $where.=" AND DATE(vcul.fecha_visita) BETWEEN '$dfech_gestion' AND '$hfech_gestion'";
}
if($dfechgestion!='' AND $hfechgestion==''){
  $ddate = str_replace('/', '-', $dfechgestion);
  $dfech_gestion =date('Y-m-d', strtotime($ddate));
  $where.=" AND DATE(vcul.fecha_visita) >= '$dfech_gestion'";
}
if($dfechgestion=='' AND $hfechgestion!=''){
  $hdate = str_replace('/', '-', $hfechgestion);
  $hfech_gestion =date('Y-m-d', strtotime($hdate));
  $where.=" AND DATE(vcul.fecha_visita) <= '$hfechgestion'";
}


if ($idcliente!='' OR $idcliente!=NULL) {
  $where.=" AND idcliente=$idcliente";
}

// if($idusuario!=40){
//   $where.=" AND idusuario=$idusuario";
// }

if($idusuario==17){
  $where.=" AND idusuario IN (18,38,39,47,54)";
}elseif($idusuario==46){
  $where.=" AND idusuario IN (42,28,56,30,48,31,26,25,20,27,41,7,21,10,9,8)";
}elseif($idusuario==50){
  $where.=" AND idusuario IN (57,49,11,2,3,4,58,44,51)";
}elseif($idusuario==55){
  $where.=" AND idusuario IN (34,53,36,37,14,23,16,59,15)";
}elseif($idusuario==60){
      $where.=" AND idusuario IN (14,23,16,15,50,53,34)";
}elseif($idusuario==40){
  $where.="";
}else{
  $where.=" AND idusuario = $idusuario";
}

if($idmotivo!=''){
  $where.=" AND idmotivo=$idmotivo";
}
if($idactividad!=''){
  $where.=" AND idactividad=$idactividad";
}



// $sql="  SELECT
//         -- vcul.idvisita_cultivo,
//         vis.fecha_visita,
//         (SELECT razon_social FROM cliente WHERE idcliente=vcli.idcliente) AS 'razon_social',
//         vcul.fundo,
//         vcul.lugar,
//         vcul.motivo AS 'objetivo',
//         vcul.cultivo,
//         vcul.area,
//         vcul.actividad AS 'problema',
//         vcul.productos,
//         SUBSTRING_INDEX(productos, ',', 1) AS 'prod_1',
//         SUBSTRING_INDEX(SUBSTRING(productos,LENGTH(SUBSTRING_INDEX(productos, ',', 1)) + 2), ',', 1) AS 'prod_2',
//         SUBSTRING_INDEX(SUBSTRING(productos,LENGTH(SUBSTRING_INDEX(productos, ',', 2)) + 2), ',', 1) AS 'prod_3',
//         SUBSTRING_INDEX(SUBSTRING(productos,LENGTH(SUBSTRING_INDEX(productos, ',', 3)) + 2), ',', 1) AS 'prod_4',
//         SUBSTRING_INDEX(SUBSTRING(productos,LENGTH(SUBSTRING_INDEX(productos, ',', 4)) + 2), ',', 1) AS 'prod_5',
//         SUBSTRING_INDEX(SUBSTRING(productos,LENGTH(SUBSTRING_INDEX(productos, ',', 5)) + 2), ',', 1) AS 'prod_6',
//         SUBSTRING_INDEX(SUBSTRING(productos,LENGTH(SUBSTRING_INDEX(productos, ',', 6)) + 2), ',', 1) AS 'prod_7',
//         SUBSTRING_INDEX(SUBSTRING(productos,LENGTH(SUBSTRING_INDEX(productos, ',', 7)) + 2), ',', 1) AS 'prod_8',
//         SUBSTRING_INDEX(SUBSTRING(productos,LENGTH(SUBSTRING_INDEX(productos, ',', 8)) + 2), ',', 1) AS 'prod_9',
//         SUBSTRING_INDEX(SUBSTRING(productos,LENGTH(SUBSTRING_INDEX(productos, ',', 9)) + 2), ',', 1) AS 'prod_10',
//         vrec.inicio,
//         vrec.fin,
//         vcul.observacion,
//         vcul.zona,
//         vcul.creacion,
//         (SELECT CONCAT(nombre,', ',paterno,' ',materno) FROM usuario WHERE idusuario=vis.idusuario) AS 'responsable'
//         FROM visita vis
//         INNER JOIN visita_cliente vcli ON vis.idvisita=vcli.idvisita
//         INNER JOIN visita_cultivo  vcul ON vcul.idvisita_cliente=vcli.idvisita_cliente
//         INNER JOIN visita_recorrido vrec ON vrec.idvisita=vis.idvisita
//         WHERE
//         1=1
//         $where";

$sql="  SELECT
        DATE(vcul.fecha_visita) AS fecha_visita,
        (SELECT razon_social FROM cliente WHERE idcliente=vcul.idcliente) AS 'cliente',
        vcul.fundo AS 'consu.final',
        vcul.lugar,
        vcul.motivo AS 'objetivo',
        vcul.cultivo,
        vcul.area,
        vcul.actividad AS 'problema',
        vcul.productos,
        SUBSTRING_INDEX(productos, ',', 1) AS 'prod_1',
        SUBSTRING_INDEX(SUBSTRING(productos,LENGTH(SUBSTRING_INDEX(productos, ',', 1)) + 2), ',', 1) AS 'prod_2',
        SUBSTRING_INDEX(SUBSTRING(productos,LENGTH(SUBSTRING_INDEX(productos, ',', 2)) + 2), ',', 1) AS 'prod_3',
        SUBSTRING_INDEX(SUBSTRING(productos,LENGTH(SUBSTRING_INDEX(productos, ',', 3)) + 2), ',', 1) AS 'prod_4',
        SUBSTRING_INDEX(SUBSTRING(productos,LENGTH(SUBSTRING_INDEX(productos, ',', 4)) + 2), ',', 1) AS 'prod_5',
        SUBSTRING_INDEX(SUBSTRING(productos,LENGTH(SUBSTRING_INDEX(productos, ',', 5)) + 2), ',', 1) AS 'prod_6',
        SUBSTRING_INDEX(SUBSTRING(productos,LENGTH(SUBSTRING_INDEX(productos, ',', 6)) + 2), ',', 1) AS 'prod_7',
        SUBSTRING_INDEX(SUBSTRING(productos,LENGTH(SUBSTRING_INDEX(productos, ',', 7)) + 2), ',', 1) AS 'prod_8',
        SUBSTRING_INDEX(SUBSTRING(productos,LENGTH(SUBSTRING_INDEX(productos, ',', 8)) + 2), ',', 1) AS 'prod_9',
        SUBSTRING_INDEX(SUBSTRING(productos,LENGTH(SUBSTRING_INDEX(productos, ',', 9)) + 2), ',', 1) AS 'prod_10',
        (SELECT inicio FROM visita_recorrido WHERE fecha_visita=vcul.fecha_visita AND idusuario=vcul.idusuario) AS 'inicio',
        (SELECT fin FROM visita_recorrido WHERE fecha_visita=vcul.fecha_visita AND idusuario=vcul.idusuario) AS 'fin',
        vcul.observacion,
        vcul.zona,
        vcul.creacion,
        (SELECT CONCAT(nombre,', ',paterno,' ',materno) FROM usuario WHERE idusuario=vcul.idusuario) AS 'responsable'
        FROM 
        visita_cultivo  vcul
        WHERE
        estado=1 AND
        1=1
        $where";


$prData = $connection->prepare($sql);
$prData->execute();
$i = 0;
//echo '<table>';
while( $row = $prData->fetch(PDO::FETCH_ASSOC) ) {
  if( $i == 0 ) {
      //echo '<tr>';
      foreach( $row as $index => $value ) {
       // echo '<td style="background-color:#4F81BD;color:white;border-color:white;" align="center" >'.$index.'</td>';
       echo $index."\t";
      }
      echo "\n";
     // echo '</tr>';
  }

    $style="";
    ( $i%2 == 0 ) ? $style="background-color:#00B7FF;border-color:white;":$style="background-color:#B8CCE4;border-color:white;";
    //echo '<tr>';
    foreach( $row as $key => $value )
    {
      //echo '<td style="'.$style.'" align="center">'.utf8_decode($value).'</td>';
      if( $key == 'NUMERO_CUENTA' || $key == 'CODIGO_CLIENTE' || $key == 'PAN' || $key == 'NUMERO'  ) {
        echo '="'.$value.'"'."\t";
      }else if( $key == 'OBSERVACION' ){
        echo str_replace("\n"," ",str_replace("\t"," ",$value))."\t";
      }else{
        echo utf8_decode($value)."\t";
      }
    }
    echo "\n";
    //echo '</tr>';

  $i++;
}


?>