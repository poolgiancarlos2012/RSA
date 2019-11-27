 <?php
class servletDistribuidor extends CommandController {
	public function doPost(){
		$getDAODistribuidor = DAOFactory::getDAODistribuidor('maria');
		switch ($_POST['action']){
			case 'QUERYListarDistribuidor':
					$dist=$_POST['dist'];
	                $getDAODistribuidor->QUERYListarDistribuidor($dist);
				break;
			case 'VerificarDuplicado':
					$dist=$_POST['dist'];
	                $getDAODistribuidor->VerificarDuplicado($dist);
				break;
			default:
				echo json_encode(array('rst'=>false,'msg'=>'Accion no encontrada in POST'));
				break;
		}
	}
	public function doGet() {
		$getDAODistribuidor = DAOFactory::getDAODistribuidor('maria');
		switch ($_GET['action']){
			case 'ListDistribuidor':
					//echo $_GET['datos'];
					//echo urldecode($_GET['datos']);
					//exit();

					$iddistribuidor= empty($_GET['iddistribuidor']) ?  '' : $_GET['iddistribuidor'];
					$distribuidor= empty($_GET['distribuidor']) ?  '' : $_GET['distribuidor'];
					

					//echo $_GET['datos']."\n";
					//exit();

					$page = $_GET['page']; // get the requested page
	                $limit = $_GET['rows']; // get how many rows we want to have into the grid
	                $sidx = $_GET['sidx']; // get index row - i.e. user click to sort
	                $sord = $_GET['sord']; // get the direction

	                if (!$sidx)
	                    $sidx = 1;

	                $row = $getDAODistribuidor->JQGRIDCOUNTListDistribuidor($iddistribuidor,$distribuidor);

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

	                $data = $getDAODistribuidor->JQGRIDListDistribuidor($sidx, $sord, $start, $limit,$iddistribuidor,$distribuidor);

	                $dataRow = array();
	                for ($i = 0; $i < count($data); $i++) {
	                    array_push($dataRow, array("id" =>  $data[$i]['iddistribuidor'], "cell" => array(
															$data[$i]['iddistribuidor'],
															$data[$i]['distribuidor'],
															$data[$i]['tipo_documento'],
															$data[$i]['codigo'],
															$data[$i]['estado']
															)
														)
													);
	                }
	                $response["rows"] = $dataRow;
	                echo json_encode($response);
				break;
			case 'Mant_Distribuidor':
                    if($_GET['oper']=='add'){


                        // $distribuidor=utf8_decode(strtoupper(trim($_GET['distribuidor'])));
                        $distribuidor=strtoupper(trim($_GET['distribuidor']));
                        $tipo_documento=utf8_decode(strtoupper(trim($_GET['tipo_documento'])));
                        $codigo=utf8_decode(strtoupper(trim($_GET['codigo'])));
                        $estado= $_GET['estado'];
                        $getDAODistribuidor->INSERT_Distribuidor($distribuidor,$tipo_documento,$codigo,$estado);


                    }else if($_GET['oper']=='edit'){

                        $id=$_GET['id'];
                        // $distribuidor=utf8_decode(strtoupper(trim($_GET['distribuidor'])));
                        $distribuidor=strtoupper(trim($_GET['distribuidor']));
                        $tipo_documento=utf8_decode(strtoupper(trim($_GET['tipo_documento'])));
                        $codigo=utf8_decode(strtoupper(trim($_GET['codigo'])));
                        $estado= $_GET['estado'];

                        $getDAODistribuidor->UPDATE_Distribuidor($id,$distribuidor,$tipo_documento,$codigo,$estado);

                    }else if($_GET['oper']=='del'){

                        $id=$_GET['id'];
                        $getDAODistribuidor->DELETE_Distribuidor($id);

                    }
                break;
			default:
				echo json_encode(array('rst'=>false,'msg'=>'Accion no encontrada in GET'));
				break;
		}
	}

}
?>