<?php

abstract class CommandController {

    public function process() {
        switch ($_SERVER['REQUEST_METHOD']):
            case 'POST':
                if (method_exists($this, 'doPost')) {
                    $this->doPost();
                }
                break;
            case 'GET':
                if (method_exists($this, 'doGet')) {
                    $this->doGet();
                }
                break;
        endswitch;
    }

    public function doPost() {
        
    }

    public function doGet() {
        
    }

    public static function getCommand() {
        $classController = NULL;
        switch ($_REQUEST['command']) :
            case 'logeo':
                $classController = new servletLogeo;
                break;
            case 'index':
                $classController = new servletIndex;
                break;
            case 'registrogestion':
                $classController = new servletRegistroGestion;
                break;
            case 'fundo':
                $classController = new servletFundo;
                break;
            case 'cultivo':
                $classController = new servletCultivo;
                break;
            case 'objetivo':
                $classController = new servletObjetivo;
                break;
            case 'problema':
                $classController = new servletProblema;
                break;
            case 'cierre':
                $classController = new servletCierre;
                break;
            case 'distribuidor':
                $classController = new servletDistribuidor;
                break;
            case 'producto':
                $classController = new servletProducto;
                break;
            case 'usuario':
                $classController = new servletUsuario;
                break;
            default:
                echo json_encode(array('rst' => false, 'msg' => 'Controllador no encontrado'));
                exit();
                break;
        endswitch;
        return $classController;
    }

}

?>
