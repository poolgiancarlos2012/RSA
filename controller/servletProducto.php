 <?php
class servletProducto extends CommandController {
	public function doPost(){
		$getDAOProducto = DAOFactory::getDAOProducto('maria');
		switch ($_POST['action']){
			case 'QUERYListarProducto':
					$prod=$_POST['prod'];
	                $getDAOProducto->QUERYListarProducto($prod);
				break;
			case 'VerificarDuplicado':
					$prod=$_POST['prod'];
	                $getDAOProducto->VerificarDuplicado($prod);
				break;
			default:
				echo json_encode(array('rst'=>false,'msg'=>'Accion no encontrada in POST'));
				break;
		}
	}
	public function doGet() {
		$getDAOProducto = DAOFactory::getDAOProducto('maria');
		switch ($_GET['action']){
			case 'ListProducto':
					//echo $_GET['producto'];
					//echo urldecode($_GET['producto']);
					//exit();

					$idproducto= empty($_GET['idproducto']) ?  '' : $_GET['idproducto'];
					$producto= empty($_GET['producto']) ?  '' : $_GET['producto'];
					

					//echo $_GET['producto']."\n";
					//exit();

					$page = $_GET['page']; // get the requested page
	                $limit = $_GET['rows']; // get how many rows we want to have into the grid
	                $sidx = $_GET['sidx']; // get index row - i.e. user click to sort
	                $sord = $_GET['sord']; // get the direction

	                if (!$sidx)
	                    $sidx = 1;

	                $row = $getDAOProducto->JQGRIDCOUNTListProducto($idproducto,$producto);

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

	                $data = $getDAOProducto->JQGRIDListProducto($sidx, $sord, $start, $limit,$idproducto,$producto);

	                $dataRow = array();
	                for ($i = 0; $i < count($data); $i++) {
	                    array_push($dataRow, array("id" =>  $data[$i]['idproducto'], "cell" => array(
															$data[$i]['idproducto'],
															$data[$i]['producto'],
															$data[$i]['estado']
															)
														)
													);
	                }
	                $response["rows"] = $dataRow;
	                echo json_encode($response);
				break;
			case 'Mant_Producto':
                    if($_GET['oper']=='add'){

                        // $producto=utf8_decode(strtoupper(trim($_GET['producto'])));
                        $producto=strtoupper(trim($_GET['producto']));
                        $estado= $_GET['estado'];
                        $getDAOProducto->INSERT_Producto($producto,$estado);


                    }else if($_GET['oper']=='edit'){

                        $id=$_GET['id'];
                        // $producto=utf8_decode(strtoupper(trim($_GET['producto'])));
                        $producto=strtoupper(trim($_GET['producto']));
                        $estado= $_GET['estado'];

                        $getDAOProducto->UPDATE_Producto($id,$producto,$estado);

                    }else if($_GET['oper']=='del'){

                        $id=$_GET['id'];
                        $getDAOProducto->DELETE_Producto($id);

                    }
                break;
			default:
				echo json_encode(array('rst'=>false,'msg'=>'Accion no encontrada in GET'));
				break;
		}
	}

}
?>