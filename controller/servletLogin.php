<?php

class servletLogeo extends CommandController {

    public function doPost() {
        #####DAO#####
        $PG_Logeo_DAO = DAOFactory::getDAOLogeo('maria');
        #####DAO#####
        switch ($_POST['action']) {
            case 'acceso':
                $user = $_POST['usuario'];
                $pass = $_POST['clave'];
                $dto_usuario = new dto_usuario;
                $dto_usuario->setUsuario($user);
                $dto_usuario->setClave($pass);
                $response = $PG_Logeo_DAO->QUERY_login($dto_usuario);
                echo json_encode($response);
                break;
            default:
                echo json_encode(array('rst' => false, 'msg' => 'Accion no encontrada'));
                break;
        }
    }

    public function doGet() {
        #####DAO#####
        #####DAO#####
    }

}

?>