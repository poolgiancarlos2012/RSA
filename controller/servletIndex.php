<?php
	class servletIndex extends CommandController{
		public function doPost(){
			#####DAO#####
			$DAOIndex = DAOFactory::getDAOIndex('maria');
			#####DAO#####
			switch ($_POST['action']) {
				case 'FechaCierre':
					$DAOIndex->FechaCierre();
					break;
				break;				
				default:
					echo json_encode(array('rst'=>false,'msg'=>'Accion no encontrada'));
				break;
			}
		}
		public function doGet(){
			#####DAO#####
			
			#####DAO#####
		}
	}
?>