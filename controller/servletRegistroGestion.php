 <?php
class servletRegistroGestion extends CommandController {
	public function doPost(){
		$DAORegistroGestion = DAOFactory::getDAORegistroGestion('maria');
		switch ($_POST['action']){
			case 'QUERYListarCliente':

				$dtr=$_POST['dtr'];
                $DAORegistroGestion->QUERYListarCliente($dtr);

				break;
			case 'QUERYListarProductos':
					$prod=$_POST['prod'];
					$DAORegistroGestion->QUERYListarProductos($prod);
				break;
			case 'QUERYListarMotivo':

				$obje=$_POST['obje'];
				$DAORegistroGestion->QUERYListarMotivo($obje);

				break;
			case 'QUERYListarActividad':

					$prob=$_POST['prob'];
					$DAORegistroGestion->QUERYListarActividad($prob);

				break;
			case 'QUERYListarFundo':

					$fdo=$_POST['fdo'];
                	$DAORegistroGestion->QUERYListarFundo($fdo);

				break;
			case 'QUERYListarCultivo':

					$cvo=$_POST['cvo'];
                	$DAORegistroGestion->QUERYListarCultivo($cvo);

				break;
			case 'QUERYListarArea':
					$idfundo=empty($_POST['idfundo']) ? 0 : $_POST['idfundo'];
					$idcultivo=empty($_POST['idcultivo']) ? 0 : $_POST['idcultivo'];
					$data=$DAORegistroGestion->QUERYListarArea($idfundo,$idcultivo);  
	                $dataRow = array();
	                for ($i=0; $i<count($data); $i++){
	                    array_push($dataRow, array("id"=>$data[$i]['idfundo_cultivo'], "cell" => array($data[$i]['idfundo_cultivo'],$data[$i]['area'])));
	                }
	                $response["fila"] = $dataRow;
	                // if(count($response["fila"])!=""){
	                    echo json_encode(array('rst' => true, 'msg' => 'Area Listados correctamente en el Combobox','datos'=>$response));
	                // }else{
	                    // echo json_encode(array('rst' => false, 'msg' => 'Error al listar Area en el combobox'));
	                // }
				break;
			case 'QUERYListarZona':
					$data=$DAORegistroGestion->QUERYListarZona();  
	                $dataRow = array();
	                for ($i=0; $i<count($data); $i++){
	                    array_push($dataRow, array("id"=>$data[$i]['idzona'], "cell" => array($data[$i]['idzona'],utf8_encode($data[$i]['zona']))));
	                }
	                $response["fila"] = $dataRow;
	                echo json_encode(array('rst' => true, 'msg' => 'Zona Listados correctamente en el Combobox','datos'=>$response));
				break;
			case 'QUERYListarTipoCliente':
					$data=$DAORegistroGestion->QUERYListarTipoCliente();  
	                $dataRow = array();
	                for ($i=0; $i<count($data); $i++){
	                    array_push($dataRow, array("id"=>$data[$i]['idtipo_cliente'], "cell" => array($data[$i]['idtipo_cliente'],$data[$i]['tipo_cliente'])));
	                }
	                $response["fila"] = $dataRow;
	                echo json_encode(array('rst' => true, 'msg' => 'Zona Listados correctamente en el Combobox','datos'=>$response));
				break;
			case 'RegistrarGestion':
				$gestion=$_POST['gestion'];
				$idusuario=$_POST['idusuario'];
				$DAORegistroGestion->RegistrarGestion($gestion,$idusuario);
				break;
			case 'VerificarRecorrido':
				$fecha_gestion=$_POST['fecha_gestion'];
				$idusuario=$_POST['idusuario'];
				$DAORegistroGestion->VerificarRecorrido($fecha_gestion,$idusuario);
				break;
			case 'RegistrarRecorrido':
				$fechareco=$_POST['fechareco'];
				$idusuario=$_POST['idusuario'];
				$DAORegistroGestion->RegistrarRecorrido($fechareco,$idusuario);
				break;
			case 'ValidarRegistroCierre':
				$DAORegistroGestion->ValidarRegistroCierre();
				break;
			default:
				echo json_encode(array('rst'=>false,'msg'=>'Accion no encontrada in POST'));
				break;
		}
	}
	public function doGet() {
		$DAORegistroGestion = DAOFactory::getDAORegistroGestion('maria');
		switch ($_GET['action']){
			case 'ConsultarGestion':

				$idusuario=$_GET['idusuario'];

				// if(empty($_GET['fechgestion']) ){
				// 	$fechgestion='';
				// }else{
				// 	$fechgestion=date('Y-m-d', strtotime(str_replace('/', '-', $_GET['fechgestion'])));
				// }

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

				$page = $_GET['page']; // get the requested page
                $limit = $_GET['rows']; // get how many rows we want to have into the grid
                $sidx = $_GET['sidx']; // get index row - i.e. user click to sort
                $sord = $_GET['sord']; // get the direction

                if (!$sidx)
                    $sidx = 1;

                $row = $DAORegistroGestion->JQGRIDCOUNTConsultarGestion($idusuario,$dfechgestion,$hfechgestion,$idcliente,$idmotivo,$idactividad);

                $count = $row[0]['COUNT'];
                // echo $count;
                // exit();
                if ($count > 0) {
                    $total_pages = ceil($count / $limit);
                } else {
                    $total_pages = 0;
                }

                // if ($page > $total_pages)
                //     $page = $total_pages;

                // $start = $page * $limit - $limit;


                if ($page > $total_pages)
                    $page = $total_pages;

                $inicio = $page * $limit - $limit;
                if ($inicio < 0) {
                    $start = 0;
                } else {
                    $start = $page * $limit - $limit;
                }

                $response = array("page" => $page, "total" => $total_pages, "records" => $count);

                $data = $DAORegistroGestion->JQGRIDConsultarGestion($sidx, $sord, $start, $limit,$idusuario,$dfechgestion,$hfechgestion,$idcliente,$idmotivo,$idactividad);

                $dataRow = array();
                for ($i = 0; $i < count($data); $i++) {
                    array_push($dataRow, array("id" =>  $data[$i]['idvisita_cultivo'], "cell" => array(
														$data[$i]['idvisita_cultivo'],
														$data[$i]['fecha_visita'],
														$data[$i]['razon_social'],
														$data[$i]['fundo'],
														$data[$i]['lugar'],
														$data[$i]['motivo'],
														$data[$i]['cultivo'],
														$data[$i]['area'],
														$data[$i]['actividad'],
														$data[$i]['productos'],
														$data[$i]['inicio'],
														$data[$i]['fin'],
														$data[$i]['observacion'],
														$data[$i]['zona'],
														$data[$i]['creacion'],
														$data[$i]['responsable']
														)
													)
												);
                }
                $response["rows"] = $dataRow;
                echo json_encode($response);
				break;
				default:
					echo json_encode(array('rst'=>false,'msg'=>'Accion no encontrada in GET'));
					break;
		}
	}

}
?>