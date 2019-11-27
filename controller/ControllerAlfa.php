<?php
session_start();
date_default_timezone_set('America/Lima');

require_once '../controller/CommandController.php';


/*CONNECTION BD*/
require_once '../conexion/config.php';
require_once '../conexion/MYSQLConnectionPDO.php';
/*CONNECTION BD*/

/*PDO DE CONECCION*/
require_once '../factory/DAOFactory.php';
require_once '../factory/FactoryConnection.php';
/*PDO DE CONECCION*/

/***SERVLET***/
require_once '../controller/servletLogin.php';
require_once '../controller/servletIndex.php';
require_once '../controller/servletRegistroGestion.php';
require_once '../controller/servletFundo.php';
require_once '../controller/servletCultivo.php';
require_once '../controller/servletObjetivo.php';
require_once '../controller/servletProblema.php';
require_once '../controller/servletCierre.php';
require_once '../controller/servletDistribuidor.php';
require_once '../controller/servletProducto.php';
require_once '../controller/servletUsuario.php';
/***SERVLET***/

/***DAO***/
require_once '../dao/MARIALogeoDAO.php';
require_once '../dao/MARIAIndexDAO.php';
require_once '../dao/MARIARegistroGestionDAO.php';
require_once '../dao/MARIAFundoDAO.php';
require_once '../dao/MARIACultivoDAO.php';
require_once '../dao/MARIAObjetivoDAO.php';
require_once '../dao/MARIAProblemaDAO.php';
require_once '../dao/MARIACierreDAO.php';
require_once '../dao/MARIADistribuidorDAO.php';
require_once '../dao/MARIAProductoDAO.php';
require_once '../dao/MARIAUsuarioDAO.php';
/***DAO***/

/***DTO***/
require_once '../dto/dto_usuario.php';
/***DTO***/

$cn = CommandController::getCommand();
$cn->process();
?>
