<?php
class MARIAIndexDAO{
	// public function FechaCierre(){

	// 	$factoryConnection = FactoryConnection::create('mysql');
	// 	$connection = $factoryConnection->getConnection();

	// 	$utf8='SET NAMES latin1;';
 //        $prutf8 = $connection->prepare($utf8);
 //        $prutf8->execute();

	// 	$sqlnumdia="SELECT (ELT(WEEKDAY(DATE(NOW())) + 1, '1', '2', '3', '4', '5', '6', '7')) AS numero_dia";
	// 	$prnumdia = $connection->prepare($sqlnumdia);
	// 	if ($prnumdia->execute()) {
	// 		$arrnrodia=$prnumdia->fetchAll(PDO::FETCH_ASSOC);

	// 		$nrodia=$arrnrodia[0]['numero_dia'];
	// 		$resto=7-$nrodia;

	// 		$sqlcierre="	SELECT
	// 						ADDDATE(DATE(NOW()), INTERVAL 1-$nrodia DAY) AS 'fincierre',
	// 						ADDDATE(DATE(NOW()), INTERVAL $resto DAY) AS 'inicierre'
	// 					";
	// 		$prcierre = $connection->prepare($sqlcierre);
	// 		if ($prcierre->execute()) {
	// 			$arrcierre=$prcierre->fetchAll(PDO::FETCH_ASSOC);

	// 			$dateinicierre = str_replace('/', '-', $arrcierre[0]['fincierre']);
	// 			$datefincierre = str_replace('/', '-', $arrcierre[0]['inicierre']);
	// 			$fchinicierre =date('Y/m/d', strtotime($dateinicierre));
	// 			$fchfincierre =date('Y/m/d', strtotime($datefincierre));

	// 			echo json_encode(array("rst"=>true,"Se Obtuvo fecha cierre","inicierre"=>$fchinicierre,"fincierre"=>$fchfincierre));
	// 		}else{
	// 			echo json_encode(array("rst"=>false,"No Se Obtuvo fecha cierre"));
	// 		}
	// 	} else {
	// 		echo json_encode(array("rst"=>false,"No Se numero de dia"));
	// 	}
	// }


	public function FechaCierre(){
		$sql="	SELECT 
				DATE_FORMAT(ini,'%d/%m/%Y %H:%i:%s') AS 'ini',
				DATE_FORMAT(fin,'%d/%m/%Y %H:%i:%s') AS 'fin',
				(SELECT nombre FROM cierre_programacion WHERE idcierre_programacion=c.idcierre_programacion) AS 'programacion',
				(SELECT nombre FROM cierre_modo WHERE idcierre_modo=c.idcierre_modo) AS 'modo' 
				FROM 
				cierre c
				WHERE 
				estado=1";
		$factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();
        $pr = $connection->prepare($sql);
        if ($pr->execute()) {
            $arr_cierre=$pr->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode(array("rst"=>true,"msg"=>"Se consulto Correctamente","dato"=>$arr_cierre));
        }else{
            echo json_encode(array("rst"=>false,"msg"=>"Hubo Problemas al consultar","data"=>""));
        }
	}

}
?>