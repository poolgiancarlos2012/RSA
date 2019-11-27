<?php
session_start();

require_once 'E:/Proyectos/RSA/conexion/config.php';
require_once 'E:/Proyectos/RSA/conexion/MYSQLConnectionPDO.php';
require_once 'E:/Proyectos/RSA/factory/FactoryConnection.php';

function ProcesarDesabilitacion(){
	$factoryConnection = FactoryConnection::create('mysql');
    $connection = $factoryConnection->getConnection();
    
    date_default_timezone_set('America/Lima');

    $hoy = date("Y-m-d H:i:s");

	$update="	UPDATE cierre SET estado=0 WHERE fin<='$hoy'";
	//echo $update;
	$prupdate = $connection->prepare($update);
	if($prupdate->execute()){
	}
		
}


ProcesarDesabilitacion();

?>