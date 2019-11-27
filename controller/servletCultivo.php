 <?php
class servletCultivo extends CommandController {
	public function doPost(){
		$getDAOCultivo = DAOFactory::getDAOCultivo('maria');
		switch ($_POST['action']){
			case 'QUERYListarCultivo':
					$cvo=$_POST['cvo'];
                	$getDAOCultivo->QUERYListarCultivo($cvo);
				break;
			case 'VerificarDuplicado':
					$cvo=$_POST['cvo'];
	                $getDAOCultivo->VerificarDuplicado($cvo);
				break;
			default:
				echo json_encode(array('rst'=>false,'msg'=>'Accion no encontrada in POST'));
				break;
		}
	}
	public function doGet() {
		$getDAOCultivo = DAOFactory::getDAOCultivo('maria');
		switch ($_GET['action']){
			case 'ListCultivo':

					$idcultivo= empty($_GET['idcultivo']) ?  '' : $_GET['idcultivo'];
					$cultivo= empty($_GET['cultivo']) ?  '' : $_GET['cultivo'];

					$page = $_GET['page']; // get the requested page
	                $limit = $_GET['rows']; // get how many rows we want to have into the grid
	                $sidx = $_GET['sidx']; // get index row - i.e. user click to sort
	                $sord = $_GET['sord']; // get the direction

	                if (!$sidx)
	                    $sidx = 1;

	                $row = $getDAOCultivo->JQGRIDCOUNTListCultivo($idcultivo,$cultivo);

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

	                $data = $getDAOCultivo->JQGRIDListCultivo($sidx, $sord, $start, $limit,$idcultivo,$cultivo);

	                $dataRow = array();
	                for ($i = 0; $i < count($data); $i++) {
	                    array_push($dataRow, array("id" =>  $data[$i]['idcultivo'], "cell" => array(
															$data[$i]['idcultivo'],
															$data[$i]['cultivo'],
															$data[$i]['estado']
															)
														)
													);
	                }
	                $response["rows"] = $dataRow;
	                echo json_encode($response);
				break;
			case 'Mant_Cultivo':
                    if($_GET['oper']=='add'){

                        //$cultivo=utf8_decode(strtoupper(trim($_GET['cultivo'])));
                        $cultivo=strtoupper(trim($_GET['cultivo']));
                        $estado= $_GET['estado'];
                        $getDAOCultivo->INSERT_Cultivo($cultivo,$estado);


                    }else if($_GET['oper']=='edit'){

                        $id=$_GET['id'];
                        //$cultivo=utf8_decode(strtoupper(trim($_GET['cultivo'])));
                        $cultivo=strtoupper(trim($_GET['cultivo']));
                        $estado= $_GET['estado'];

                        $getDAOCultivo->UPDATE_Cultivo($id,$cultivo,$estado);

                    }else if($_GET['oper']=='del'){

                        $id=$_GET['id'];
                        $getDAOCultivo->DELETE_Cultivo($id);

                    }
                break;
			default:
				echo json_encode(array('rst'=>false,'msg'=>'Accion no encontrada in GET'));
				break;
		}
	}

}
?>