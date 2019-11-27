 <?php
class servletFundo extends CommandController {
	public function doPost(){
		$getDAOFundo = DAOFactory::getDAOFundo('maria');
		switch ($_POST['action']){
			case 'QUERYListarFundo':
					$fdo=$_POST['fdo'];
	                $getDAOFundo->QUERYListarFundo($fdo);
				break;
			case 'VerificarDuplicado':
					$fdo=$_POST['fdo'];
	                $getDAOFundo->VerificarDuplicado($fdo);
				break;
			default:
				echo json_encode(array('rst'=>false,'msg'=>'Accion no encontrada in POST'));
				break;
		}
	}
	public function doGet() {
		$getDAOFundo = DAOFactory::getDAOFundo('maria');
		switch ($_GET['action']){
			case 'ListFundo':
					//echo $_GET['datos'];
					//echo urldecode($_GET['datos']);
					//exit();

					$idfundo= empty($_GET['idfundo']) ?  '' : $_GET['idfundo'];
					$datos= empty($_GET['datos']) ?  '' : $_GET['datos'];
					

					//echo $_GET['datos']."\n";
					//exit();

					$page = $_GET['page']; // get the requested page
	                $limit = $_GET['rows']; // get how many rows we want to have into the grid
	                $sidx = $_GET['sidx']; // get index row - i.e. user click to sort
	                $sord = $_GET['sord']; // get the direction

	                if (!$sidx)
	                    $sidx = 1;

	                $row = $getDAOFundo->JQGRIDCOUNTListFundo($idfundo,$datos);

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

	                $data = $getDAOFundo->JQGRIDListFundo($sidx, $sord, $start, $limit,$idfundo,$datos);

	                $dataRow = array();
	                for ($i = 0; $i < count($data); $i++) {
	                    array_push($dataRow, array("id" =>  $data[$i]['idfundo'], "cell" => array(
															$data[$i]['idfundo'],
															$data[$i]['datos'],
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
			case 'Mant_Fundo':
                    if($_GET['oper']=='add'){

                        //$datos=utf8_decode(strtoupper(trim($_GET['datos'])));
                        $datos=strtoupper(trim($_GET['datos']));
                        $tipo_documento=utf8_decode(strtoupper(trim($_GET['tipo_documento'])));
                        $codigo=utf8_decode(strtoupper(trim($_GET['codigo'])));
                        $estado= $_GET['estado'];
                        $getDAOFundo->INSERT_Fundo($datos,$tipo_documento,$codigo,$estado);


                    }else if($_GET['oper']=='edit'){

                        $id=$_GET['id'];
                        //$datos=utf8_decode(strtoupper(trim($_GET['datos'])));
                        $datos=strtoupper(trim($_GET['datos']));
                        $tipo_documento=utf8_decode(strtoupper(trim($_GET['tipo_documento'])));
                        $codigo=utf8_decode(strtoupper(trim($_GET['codigo'])));
                        $estado= empty($_GET['estado']) ?  '' : $_GET['estado'];

                        $getDAOFundo->UPDATE_Fundo($id,$datos,$tipo_documento,$codigo,$estado);

                    }else if($_GET['oper']=='del'){

                        $id=$_GET['id'];
                        $getDAOFundo->DELETE_Fundo($id);

                    }
                break;
			default:
				echo json_encode(array('rst'=>false,'msg'=>'Accion no encontrada in GET'));
				break;
		}
	}

}
?>