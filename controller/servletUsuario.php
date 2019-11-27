 <?php
class servletUsuario extends CommandController {
	public function doPost(){
		$getDAOUsuario = DAOFactory::getDAOUsuario('maria');
		switch ($_POST['action']){
			case 'QUERYListarUsuario':
					$usu=$_POST['usu'];
	                $getDAOUsuario->QUERYListarUsuario($usu);
				break;
			case 'VerificarDuplicado':
					$usu=$_POST['usu'];
	                $getDAOUsuario->VerificarDuplicado($usu);
				break;
			case 'VerificarUsuario':
					$usuario=$_POST['usuario'];
	                $getDAOUsuario->VerificarUsuario($usuario);
				break;
			default:
				echo json_encode(array('rst'=>false,'msg'=>'Accion no encontrada in POST'));
				break;
		}
	}
	public function doGet() {
		$getDAOUsuario = DAOFactory::getDAOUsuario('maria');
		switch ($_GET['action']){
			case 'ListUsuario':
					//echo $_GET['datos'];
					//echo urldecode($_GET['datos']);
					//exit();

					$idusuario= empty($_GET['idusuario']) ?  '' : $_GET['idusuario'];
					$datos= empty($_GET['datos']) ?  '' : $_GET['datos'];
					

					//echo $_GET['datos']."\n";
					//exit();

					$page = $_GET['page']; // get the requested page
	                $limit = $_GET['rows']; // get how many rows we want to have into the grid
	                $sidx = $_GET['sidx']; // get index row - i.e. user click to sort
	                $sord = $_GET['sord']; // get the direction

	                if (!$sidx)
	                    $sidx = 1;

	                $row = $getDAOUsuario->JQGRIDCOUNTListUsuario($idusuario,$datos);

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

	                $data = $getDAOUsuario->JQGRIDListUsuario($sidx, $sord, $start, $limit,$idusuario,$datos);





	                $dataRow = array();
	                for ($i = 0; $i < count($data); $i++) {
	                    array_push($dataRow, array("id" =>  $data[$i]['idusuario'], "cell" => array(
															$data[$i]['idusuario'],
															$data[$i]['nombre'],
															$data[$i]['paterno'],
															$data[$i]['materno'],
															$data[$i]['usuario'],
															$data[$i]['clave'],
															$data[$i]['estado']
															)
														)
													);
	                }
	                $response["rows"] = $dataRow;
	                echo json_encode($response);
				break;
			case 'Mant_Usuario':
                    if($_GET['oper']=='add'){

                        $nombre=utf8_decode(strtoupper(trim($_GET['nombre'])));
						$paterno=utf8_decode(strtoupper(trim($_GET['paterno'])));
						$materno=utf8_decode(strtoupper(trim($_GET['materno'])));
						$usuario=utf8_decode(strtoupper(trim($_GET['usuario'])));
						$clave=utf8_decode(strtoupper(trim($_GET['clave'])));
						$estado=$_GET['estado'];


                        $getDAOUsuario->INSERT_Usuario($nombre,$paterno,$materno,$usuario,$clave,$estado);


                    }else if($_GET['oper']=='edit'){

                        $id=$_GET['id'];
                        $nombre=utf8_decode(strtoupper(trim($_GET['nombre'])));
						$paterno=utf8_decode(strtoupper(trim($_GET['paterno'])));
						$materno=utf8_decode(strtoupper(trim($_GET['materno'])));
						$usuario=utf8_decode(strtoupper(trim($_GET['usuario'])));
						$clave=utf8_decode(strtoupper(trim($_GET['clave'])));
						$estado=$_GET['estado'];

                        $getDAOUsuario->UPDATE_Usuario($id,$nombre,$paterno,$materno,$usuario,$clave,$estado);

                    }else if($_GET['oper']=='del'){

                        $id=$_GET['id'];
                        $getDAOUsuario->DELETE_Usuario($id);

                    }
                break;
			default:
				echo json_encode(array('rst'=>false,'msg'=>'Accion no encontrada in GET'));
				break;
		}
	}

}
?>