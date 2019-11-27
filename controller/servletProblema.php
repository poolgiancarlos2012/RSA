 <?php
class servletProblema extends CommandController {
	public function doPost(){
		$getDAOProblema = DAOFactory::getDAOProblema('maria');
		switch ($_POST['action']){
			case 'QUERYListarProblema':
					$prob=$_POST['prob'];
					$getDAOProblema->QUERYListarProblema($prob);
				break;
			case 'VerificarDuplicado':
					$prob=$_POST['prob'];
	                $getDAOProblema->VerificarDuplicado($prob);
				break;
			default:
				echo json_encode(array('rst'=>false,'msg'=>'Accion no encontrada in POST'));
				break;
		}
	}
	public function doGet() {
		$getDAOProblema = DAOFactory::getDAOProblema('maria');
		switch ($_GET['action']){
			case 'ListProblema':

					$idactividad= empty($_GET['idactividad']) ?  '' : $_GET['idactividad'];
					$actividad= empty($_GET['actividad']) ?  '' : $_GET['actividad'];

					$page = $_GET['page']; // get the requested page
	                $limit = $_GET['rows']; // get how many rows we want to have into the grid
	                $sidx = $_GET['sidx']; // get index row - i.e. user click to sort
	                $sord = $_GET['sord']; // get the direction

	                if (!$sidx)
	                    $sidx = 1;

	                $row = $getDAOProblema->JQGRIDCOUNTListProblema($idactividad,$actividad);

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

	                $data = $getDAOProblema->JQGRIDListProblema($sidx, $sord, $start, $limit,$idactividad,$actividad);

	                $dataRow = array();
	                for ($i = 0; $i < count($data); $i++) {
	                    array_push($dataRow, array("id" =>  $data[$i]['idactividad'], "cell" => array(
															$data[$i]['idactividad'],
															$data[$i]['actividad'],
															$data[$i]['estado']
															)
														)
													);
	                }
	                $response["rows"] = $dataRow;
	                echo json_encode($response);
				break;
			case 'Mant_Problema':
                    if($_GET['oper']=='add'){

                        // $actividad=utf8_decode(strtoupper(trim($_GET['actividad'])));
                        $actividad=strtoupper(trim($_GET['actividad']));
                        $estado= $_GET['estado'];
                        $getDAOProblema->INSERT_Problema($actividad,$estado);


                    }else if($_GET['oper']=='edit'){

                        $id=$_GET['id'];
                        // $actividad=utf8_decode(strtoupper(trim($_GET['actividad'])));
                        $actividad=strtoupper(trim($_GET['actividad']));
                        $estado= $_GET['estado'];

                        $getDAOProblema->UPDATE_Problema($id,$actividad,$estado);

                    }else if($_GET['oper']=='del'){

                        $id=$_GET['id'];
                        $getDAOProblema->DELETE_Problema($id);

                    }
                break;
			default:
				echo json_encode(array('rst'=>false,'msg'=>'Accion no encontrada in GET'));
				break;
		}
	}
}
?>