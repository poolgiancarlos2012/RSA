<?php
class servletCierre extends CommandController {
	public function doPost(){
		$getDAOCierre = DAOFactory::getDAOCierre('maria');
		switch ($_POST['action']){
			case 'QUERYListarCierreProgramacion':
					$data=$getDAOCierre->QUERYListarCierreProgramacion();  
	                $dataRow = array();
	                for ($i=0; $i<count($data); $i++){
	                    array_push($dataRow, array("id"=>$data[$i]['idcierre_programacion'], "cell" => array($data[$i]['idcierre_programacion'],utf8_encode($data[$i]['nombre']))));
	                }
	                $response["fila"] = $dataRow;
	                if(count($response["fila"])!=""){
	                    echo json_encode(array('rst' => true, 'msg' => 'Listados correctamente en el Combobox','datos'=>$response));
	                }else{
	                    echo json_encode(array('rst' => false, 'msg' => 'Error al listar en el combobox'));
	                }
				break;
			case 'QUERYListarCierreModo':
					$data=$getDAOCierre->QUERYListarCierreModo();  
	                $dataRow = array();
	                for ($i=0; $i<count($data); $i++){
	                    array_push($dataRow, array("id"=>$data[$i]['idcierre_modo'], "cell" => array($data[$i]['idcierre_modo'],utf8_encode($data[$i]['nombre']))));
	                }
	                $response["fila"] = $dataRow;
	                if(count($response["fila"])!=""){
	                    echo json_encode(array('rst' => true, 'msg' => 'Listados correctamente en el Combobox','datos'=>$response));
	                }else{
	                    echo json_encode(array('rst' => false, 'msg' => 'Error al listar en el combobox'));
	                }
				break;
			case 'Verificar_Activo_Cierre':
				$getDAOCierre->Verificar_Activo_Cierre();  
				break;
			default:
				echo json_encode(array('rst'=>false,'msg'=>'Accion no encontrada in POST'));
				break;
		}
	}
	public function doGet() {
		$getDAOCierre = DAOFactory::getDAOCierre('maria');
		switch ($_GET['action']){
			case 'ListCierre':

					$ini=empty($_GET['ini']) ?  '' : date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $_GET['ini'])));
					$fin=empty($_GET['fin']) ?  '' : date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $_GET['fin'])));;
					$programacion=empty($_GET['programacion']) ?  '' : $_GET['programacion'];
					$modo=empty($_GET['modo']) ?  '' : $_GET['modo'];




					$page = $_GET['page']; // get the requested page
	                $limit = $_GET['rows']; // get how many rows we want to have into the grid
	                $sidx = $_GET['sidx']; // get index row - i.e. user click to sort
	                $sord = $_GET['sord']; // get the direction

	                if (!$sidx)
	                    $sidx = 1;

	                $row = $getDAOCierre->JQGRIDCOUNTListarCierre($ini,$fin,$programacion,$modo);

	                $count = $row[0]['COUNT'];

	                if ($count > 0) {
	                    $total_pages = ceil($count / $limit);
	                } else {
	                    $total_pages = 0;
	                }

	                if ($page > $total_pages)
	                    $page = $total_pages;

	                $inicio = $page * $limit - $limit;
	                if ($inicio < 0) {
	                    $start = 0;
	                } else {
	                    $start = $page * $limit - $limit;
	                }

	                $response = array("page" => $page, "total" => $total_pages, "records" => $count);

	                $data = $getDAOCierre->JQGRIDListarCierre($sidx, $sord, $start, $limit,$ini,$fin,$programacion,$modo);

	                $dataRow = array();
	                for ($i = 0; $i < count($data); $i++) {
	                    array_push($dataRow, array("id" =>  $data[$i]['idcierre'], "cell" => array(
															$data[$i]['idcierre'],
											                $data[$i]['ini'],
											                $data[$i]['fin'],
											                $data[$i]['estado'],
											                $data[$i]['cierre_programacion'],
											                $data[$i]['cierre_modo']
															)
														)
													);
	                }
	                $response["rows"] = $dataRow;
	                echo json_encode($response);
				break;
			case 'Mant_Cierre':
                    if($_GET['oper']=='add'){

                        $ini=trim($_GET['ini']);
						$fin=trim($_GET['fin']);
						$estado=trim($_GET['estado']);
						$cierre_programacion=trim($_GET['cierre_programacion']);
						$cierre_modo=trim($_GET['cierre_modo']);

                        $getDAOCierre->INSERT_Cierre($ini,$fin,$estado,$cierre_programacion,$cierre_modo);

                    }else if($_GET['oper']=='edit'){

                        $id=$_GET['id'];
                        $ini=trim($_GET['ini']);
						$fin=trim($_GET['fin']);
						$estado=trim($_GET['estado']);
						$cierre_programacion=trim($_GET['cierre_programacion']);
						$cierre_modo=trim($_GET['cierre_modo']);

                        $getDAOCierre->UPDATE_Cierre($id,$ini,$fin,$estado,$cierre_programacion,$cierre_modo);

                    }else if($_GET['oper']=='del'){

                        $id=$_GET['id'];
                        $getDAOCierre->DELETE_Cierre($id);

                    }
                break;
			default:
				echo json_encode(array('rst'=>false,'msg'=>'Accion no encontrada in GET'));
				break;
		}
	}

}
?>