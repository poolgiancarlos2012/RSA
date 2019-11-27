<?php
class MARIARegistroGestionDAO{
	public function QUERYListarCliente($dtr){
		$factoryConnection = FactoryConnection::create('mysql');
		$connection = $factoryConnection->getConnection();

		$utf8='SET NAMES utf8;';
        $prutf8 = $connection->prepare($utf8);
        $prutf8->execute();

		$sql="SELECT idcliente,razon_social FROM cliente WHERE estado=1 AND razon_social LIKE '%$dtr%' ORDER BY razon_social ASC";

		$pr = $connection->prepare($sql);
		$pr->execute();

		$data=$pr->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode(array("rst"=>true,"dato"=>$data));
	}

	public function QUERYListarProductos($prod){
		$sql="SELECT idproducto,producto FROM producto WHERE producto LIKE '%$prod%' ORDER BY idproducto ASC";
		$factoryConnection = FactoryConnection::create('mysql');
		$connection = $factoryConnection->getConnection();
		$pr = $connection->prepare($sql);
		if ($pr->execute()) {
			$data=$pr->fetchAll(PDO::FETCH_ASSOC);
			echo json_encode(array("rst"=>true,"data"=>$data));
		}
	}



	public function QUERYListarMotivo($obje){
		$factoryConnection = FactoryConnection::create('mysql');
		$connection = $factoryConnection->getConnection();

		$utf8='SET NAMES utf8;';
        $prutf8 = $connection->prepare($utf8);
        $prutf8->execute();

		$sql="SELECT idmotivo,motivo FROM motivo WHERE estado=1 AND motivo LIKE '%$obje%' ORDER BY motivo ASC";

		$pr = $connection->prepare($sql);
		$pr->execute();
		$data=$pr->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode(array("rst"=>true,"dato"=>$data));

	}

	public function QUERYListarActividad($prob){

		$factoryConnection = FactoryConnection::create('mysql');
		$connection = $factoryConnection->getConnection();

		$utf8='SET NAMES utf8;';
        $prutf8 = $connection->prepare($utf8);
        $prutf8->execute();

		$sql="SELECT idactividad,actividad FROM actividad WHERE estado=1 AND actividad LIKE '%$prob%' ORDER BY actividad ASC";

		$pr = $connection->prepare($sql);
		$pr->execute();
		$data=$pr->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode(array("rst"=>true,"dato"=>$data));

	}

	public function QUERYListarFundo($fdo){


		$factoryConnection = FactoryConnection::create('mysql');
		$connection = $factoryConnection->getConnection();

		$utf8='SET NAMES utf8;';
        $prutf8 = $connection->prepare($utf8);
        $prutf8->execute();

		$sql="SELECT idfundo,datos FROM fundo WHERE estado=1 AND datos LIKE '%$fdo%' ORDER BY datos ASC";

		$pr = $connection->prepare($sql);
		$pr->execute();
		$data=$pr->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode(array("rst"=>true,"dato"=>$data));

	}

	public function QUERYListarCultivo($cvo){

		$factoryConnection = FactoryConnection::create('mysql');
		$connection = $factoryConnection->getConnection();

		$utf8='SET NAMES utf8;';
        $prutf8 = $connection->prepare($utf8);
        $prutf8->execute();

		$sql="SELECT idcultivo,cultivo FROM cultivo WHERE estado=1 AND cultivo LIKE '%$cvo%' ORDER BY cultivo ASC";

		$pr = $connection->prepare($sql);
		$pr->execute();
		$data=$pr->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode(array("rst"=>true,"dato"=>$data));

	}
	public function QUERYListarArea($idfundo,$idcultivo){
		$sql="SELECT idfundo_cultivo,area FROM fundo_cultivo WHERE idfundo=$idfundo AND idcultivo=$idcultivo ORDER BY area ASC";
		//echo $sql;
		$factoryConnection = FactoryConnection::create('mysql');
		$connection = $factoryConnection->getConnection();
		$pr = $connection->prepare($sql);
		if ($pr->execute()) {
			return $pr->fetchAll(PDO::FETCH_ASSOC);
		}else{
			return array();
		}
	}


	public function QUERYListarZona(){
		$sql="SELECT idzona,zona FROM zona ORDER BY zona ASC";
		//echo $sql;
		$factoryConnection = FactoryConnection::create('mysql');
		$connection = $factoryConnection->getConnection();
		$pr = $connection->prepare($sql);
		if ($pr->execute()) {
			return $pr->fetchAll(PDO::FETCH_ASSOC);
		}else{
			return array();
		}
	}

	public function QUERYListarTipoCliente(){
		$sql="SELECT idtipo_cliente,tipo_cliente FROM tipo_cliente ORDER BY tipo_cliente ASC";
		//echo $sql;
		$factoryConnection = FactoryConnection::create('mysql');
		$connection = $factoryConnection->getConnection();
		$pr = $connection->prepare($sql);
		if ($pr->execute()) {
			return $pr->fetchAll(PDO::FETCH_ASSOC);
		}else{
			return array();
		}
	}

	public function RegistrarGestion($gestion,$idusuario){

		$factoryConnection = FactoryConnection::create('mysql');
		$connection = $factoryConnection->getConnection();

		$utf8='SET NAMES utf8;';
        $prutf8 = $connection->prepare($utf8);
        $prutf8->execute();


		# INSERTANDO VISITA

		for($i=0;$i<=count($gestion)-1;$i++){

			$idgestion=$gestion[$i]['idgestion'];
			$fechgestion=date('Y-m-d H:i:s', strtotime(str_replace('/','-',$gestion[$i]['fechgestion'])));
			// $idcliente=$gestion[$i]['idcliente'];

			$idcliente=empty($gestion[$i]['idcliente']) ? 0 : $gestion[$i]['idcliente'];
			$cliente=$gestion[$i]['cliente'];

			$idfundo=empty($gestion[$i]['idfundo']) ? 0 : $gestion[$i]['idfundo'];
			$fundo=$gestion[$i]['fundo'];

			$idzona=empty($gestion[$i]['idzona']) ? 0 : $gestion[$i]['idzona']; //
			$zona=$gestion[$i]['zona'];

			$idtipo_cliente=empty($gestion[$i]['idtipo_cliente']) ? 0 : $gestion[$i]['idtipo_cliente']; //
			$tipo_cliente=$gestion[$i]['tipo_cliente'];

			$lugar=$gestion[$i]['lugar'];

			$idobjetivo=empty($gestion[$i]['idobjetivo']) ? 0 : $gestion[$i]['idobjetivo']; //			
			$objetivo=$gestion[$i]['objetivo'];

			$idcultivo=empty($gestion[$i]['idcultivo']) ? 0 : $gestion[$i]['idcultivo']; //
			$cultivo=$gestion[$i]['cultivo'];

			$area=empty($gestion[$i]['area']) ? 0 : $gestion[$i]['area']; //

			$idproblema=empty($gestion[$i]['idproblema']) ? 0 : $gestion[$i]['idproblema']; //
			$problema=$gestion[$i]['problema'];

			$idproductos=$gestion[$i]['idproductos'];
			$productos=$gestion[$i]['productos'];
			
			$observacion=$gestion[$i]['observacion'];

			$insert="	INSERT INTO
						`rsa`.`visita_cultivo`
						(
							`fecha_visita`,
							`idcliente`,
							`cliente`,
							`idfundo`,
							`fundo`,
							`idcultivo`,
							`cultivo`,
							`idzona`,
							`zona`,

							`idtipo_cliente`,
							`tipo_cliente`,

							`area`,
							`idmotivo`,
							`motivo`,
							`idactividad`,
							`actividad`,
							`idproductos`,
							`productos`,
							`lugar`,
							`observacion`,
							`idusuario`,
							estado
						)
						VALUES
						(
							'$fechgestion',
							$idcliente,
							'$cliente',
							$idfundo,
							'$fundo',
							$idcultivo,
							'$cultivo',
							$idzona,
							'$zona',

							$idtipo_cliente,
							'$tipo_cliente',

							'$area',
							$idobjetivo,
							'$objetivo',
							'$idproblema',
							'$problema',
							'$idproductos',
							'$productos',
							'$lugar',
							'$observacion',
							'$idusuario',
							1
						);
					";

			//echo "<BR>".$insert."<BR>";
			//exit();

			$pr = $connection->prepare($insert);
			if ($pr->execute()) {
				if($i==count($gestion)-1){
					echo json_encode(array("rst"=>true,"rpta"=>"Se Grabo exitosamente las Gestiones"));
				}
			}else{
				if($i==count($gestion)-1){
					echo json_encode(array("rst"=>false,"rpta"=>"No Se Grabo exitosamente las Gestiones"));
				}
			}
		}
	}

	public function VerificarRecorrido($fecha_gestion,$idusuario){
		$factoryConnection = FactoryConnection::create('mysql');
		$connection = $factoryConnection->getConnection();

		$fch_ges="";
		for ($i=0; $i <=count($fecha_gestion)-1 ; $i++){
			$fecha_visita=date('Y-m-d', strtotime(str_replace('/', '-', $fecha_gestion[$i])));
			$fch_ges.="'".$fecha_visita."',";
		}

		$sql="	SELECT
				fecha_visita
				FROM
				visita_recorrido
				WHERE fecha_visita IN (".substr($fch_ges, 0, strlen($fch_ges)-1).") AND idusuario=$idusuario";

		// echo $sql;
		// exit();

		$pr = $connection->prepare($sql);
		if($pr->execute()) {
			$data=$pr->fetchAll(PDO::FETCH_ASSOC);

			$ar_acu=[];
			for($j=0;$j<=count($data)-1;$j++){
				array_push($ar_acu, date('d/m/Y',strtotime($data[$j]['fecha_visita'])));

			}

			$resultado = array_values(array_diff($fecha_gestion, $ar_acu));
			echo json_encode(array("rst"=>true,"rpta"=>"Se Proceso Consulta","fecha_recor"=>$resultado));

		}
	}

	public function RegistrarRecorrido($fechareco,$idusuario){
		$factoryConnection = FactoryConnection::create('mysql');
		$connection = $factoryConnection->getConnection();

		for($i=0;$i<=count($fechareco)-1;$i++){

			$fecha_visita=date('Y-m-d', strtotime(str_replace('/', '-', $fechareco[$i]['fechgestion'])));
			$inicio=$fechareco[$i]['inicio'];
			$fin=$fechareco[$i]['fin'];

				$InsertVisReco="	INSERT IGNORE INTO visita_recorrido(fecha_visita,inicio,fin,idusuario) VALUES('$fecha_visita',$inicio,$fin,$idusuario)";
				$prInsertVisReco = $connection->prepare($InsertVisReco);
				if ($prInsertVisReco->execute()) {

				}

		}

		echo json_encode(array("rst"=>true,"rpta"=>"Se Proceso Consulta"));

	}

	public function JQGRIDConsultarGestion($sidx, $sord, $start, $limit,$idusuario,$dfechgestion,$hfechgestion,$idcliente,$idmotivo,$idactividad){

		$factoryConnection = FactoryConnection::create('mysql');
		$connection = $factoryConnection->getConnection();

		$utf8='SET NAMES utf8;';
        $prutf8 = $connection->prepare($utf8);
        $prutf8->execute();

        if($dfechgestion=='1969-12-31'){$dfechgestion='';}
        if($hfechgestion=='1969-12-31'){$hfechgestion='';}

		$where="";
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
			$where.=" AND idmotivo = $idmotivo";
		}
		if($idactividad!=''){
			$where.=" AND idactividad = $idactividad";
		}

		$wh="";
		if(trim($where)==""){
			$wh.="1=0";
		}else{
			$wh.="1=1";
		}

		$sql="	SELECT
					vcul.idvisita_cultivo,
					DATE(vcul.fecha_visita) AS fecha_visita,
					(SELECT razon_social FROM cliente WHERE idcliente=vcul.idcliente) AS 'razon_social',
					vcul.fundo,
					vcul.lugar,
					vcul.motivo,
					vcul.cultivo,
					vcul.area,
					vcul.actividad,
					vcul.productos,
					(SELECT inicio FROM visita_recorrido WHERE DATE(fecha_visita)=DATE(vcul.fecha_visita) AND idusuario=vcul.idusuario) AS 'inicio',
					(SELECT fin FROM visita_recorrido WHERE DATE(fecha_visita)=DATE(vcul.fecha_visita) AND idusuario=vcul.idusuario) AS 'fin',
					vcul.observacion,
					vcul.zona,
					vcul.creacion,
					(SELECT CONCAT(nombre,', ',paterno,' ',materno) FROM usuario WHERE idusuario=vcul.idusuario) AS 'responsable'
				FROM
				visita_cultivo  vcul
				WHERE
				estado=1 AND
				$wh
				$where
				ORDER BY $sidx $sord LIMIT $start , $limit";

		// echo $sql;
		// exit();

		$pr = $connection->prepare($sql);
		if ($pr->execute()) {
			return $pr->fetchAll(PDO::FETCH_ASSOC);
		} else {
			return array();
		}
	}

	public function JQGRIDCOUNTConsultarGestion($idusuario,$dfechgestion,$hfechgestion,$idcliente,$idmotivo,$idactividad){
		$factoryConnection = FactoryConnection::create('mysql');
		$connection = $factoryConnection->getConnection();

		if($dfechgestion=='1969-12-31'){$dfechgestion='';}
        if($hfechgestion=='1969-12-31'){$hfechgestion='';}

		$where="";
		if($dfechgestion!='' AND $hfechgestion!=''){
			$ddate = str_replace('/', '-', $dfechgestion);
			$dfech_gestion =date('Y-m-d', strtotime($ddate));

			$hdate = str_replace('/', '-', $hfechgestion);
			$hfech_gestion =date('Y-m-d', strtotime($hdate));

			$where.=" AND fecha_visita BETWEEN '$dfech_gestion' AND '$hfech_gestion'";
		}
		if($dfechgestion!='' AND $hfechgestion==''){
			$ddate = str_replace('/', '-', $dfechgestion);
			$dfech_gestion =date('Y-m-d', strtotime($ddate));
			$where.=" AND fecha_visita >= '$dfech_gestion'";
		}
		if($dfechgestion=='' AND $hfechgestion!=''){
			$hdate = str_replace('/', '-', $hfechgestion);
			$hfech_gestion =date('Y-m-d', strtotime($hdate));
			$where.=" AND fecha_visita <= '$hfechgestion'";
		}


		if ($idcliente!='' OR $idcliente!=NULL) {
			$where.=" AND idcliente=$idcliente";
		}

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

		$wh="";
		if(trim($where)==""){
			$wh.="1=0";
		}else{
			$wh.="1=1";
		}

		$sql="	SELECT
				COUNT(*) AS 'COUNT'
				FROM
				visita_cultivo  vcul
				WHERE
				estado=1 AND
				$wh
				$where";

		// echo $sql;
		// exit();

		$pr = $connection->prepare($sql);
		if ($pr->execute()) {
			return $pr->fetchAll(PDO::FETCH_ASSOC);
		} else {
			return array(array('COUNT' => 0));
		}
	}

	public function ValidarRegistroCierre(){
		$factoryConnection = FactoryConnection::create('mysql');
		$connection = $factoryConnection->getConnection();

		$sql="SELECT ini,fin,idcierre_programacion,idcierre_modo FROM cierre WHERE estado=1";

		$pr = $connection->prepare($sql);
		if ($pr->execute()) {
			$data=$pr->fetchAll(PDO::FETCH_ASSOC);
			echo json_encode(array("rst"=>true,"dato"=>$data));
		}

	}

}
?>
