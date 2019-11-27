 <?php
class servletObjetivo extends CommandController {
	public function doPost(){
		$getDAOObjetivo = DAOFactory::getDAOObjetivo('maria');
		switch ($_POST['action']){
			case 'QUERYListarObjetivo':
					$obje=$_POST['obje'];
					$getDAOObjetivo->QUERYListarObjetivo($obje);
				break;
			case 'VerificarDuplicado':
					$obje=$_POST['obje'];
	                $getDAOObjetivo->VerificarDuplicado($obje);
				break;
			default:
				echo json_encode(array('rst'=>false,'msg'=>'Accion no encontrada in POST'));
				break;
		}
	}
	public function doGet() {
		$getDAOObjetivo = DAOFactory::getDAOObjetivo('maria');
		switch ($_GET['action']){
			case 'ListObjetivo':

					$idmotivo= empty($_GET['idmotivo']) ?  '' : $_GET['idmotivo'];
					$motivo= empty($_GET['motivo']) ?  '' : $_GET['motivo'];

					$page = $_GET['page']; // get the requested page
	                $limit = $_GET['rows']; // get how many rows we want to have into the grid
	                $sidx = $_GET['sidx']; // get index row - i.e. user click to sort
	                $sord = $_GET['sord']; // get the direction

	                if (!$sidx)
	                    $sidx = 1;

	                $row = $getDAOObjetivo->JQGRIDCOUNTListObjetivo($idmotivo,$motivo);

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

	                $data = $getDAOObjetivo->JQGRIDListObjetivo($sidx, $sord, $start, $limit,$idmotivo,$motivo);

	                $dataRow = array();
	                for ($i = 0; $i < count($data); $i++) {
	                    array_push($dataRow, array("id" =>  $data[$i]['idmotivo'], "cell" => array(
															$data[$i]['idmotivo'],
															$data[$i]['motivo'],
															$data[$i]['estado']
															)
														)
													);
	                }
	                $response["rows"] = $dataRow;
	                echo json_encode($response);
				break;
			case 'Mant_Objetivo':
                    if($_GET['oper']=='add'){

                        // $motivo=utf8_decode(strtoupper(trim($_GET['motivo'])));
                        $motivo=strtoupper(trim($_GET['motivo']));
                        $estado= $_GET['estado'];
                        $getDAOObjetivo->INSERT_Motivo($motivo,$estado);


                    }else if($_GET['oper']=='edit'){

                        $id=$_GET['id'];
                        // $motivo=utf8_decode(strtoupper(trim($_GET['motivo'])));
                        $motivo=strtoupper(trim($_GET['motivo']));
                        $estado= $_GET['estado'];

                        $getDAOObjetivo->UPDATE_Motivo($id,$motivo,$estado);

                    }else if($_GET['oper']=='del'){

                        $id=$_GET['id'];
                        $getDAOObjetivo->DELETE_Motivo($id);

                    }
                break;
			default:
				echo json_encode(array('rst'=>false,'msg'=>'Accion no encontrada in GET'));
				break;
		}
	}

}
?>