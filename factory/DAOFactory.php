<?php
class  DAOFactory{
    public static function getDAOLogeo($tipo){
        $rs = NULL ;
        switch ($tipo) :
            case 'mysql':
                    $rs = new MYSQLLogeoDAO;
            break;
            case 'maria':
                    $rs = new MARIALogeoDAO;
            break;
            case 'pgsql_pdo':
                    $rs = new PGSQL_PDOLogeoDAO;
            break;
            case 'pg':
                    $rs = new PG_Logeo_DAO;
            break;
        endswitch;
        return $rs ;
    }
    public static function getDAOIndex($tipo){
    	$rs = NULL ;
        switch ($tipo) :
            case 'mysql':
                    $rs = new MYSQLIndexDAO;
            break;
            case 'maria':
                    $rs = new MARIAIndexDAO;
            break;
            case 'pgsql_pdo':
                    $rs = new PGSQL_PDOIndexDAO;
            break;
            case 'pg':
                    $rs = new PG_Index_DAO;
            break;
        endswitch;
        return $rs ;
    }
    public static function getDAORegistroGestion($tipo){
        $rs = NULL ;
        switch ($tipo) :
            case 'mysql':
                    $rs = new MYSQLRegistroGestionDAO;
            break;
            case 'maria':
                    $rs = new MARIARegistroGestionDAO;
            break;
            case 'pgsql_pdo':
                    $rs = new PGSQL_PDORegistroGestionDAO;
            break;
            case 'pg':
                    $rs = new PG_RegistroGestion_DAO;
            break;
        endswitch;
        return $rs ;
    }
    public static function getDAOFundo($tipo){
        $rs = NULL ;
        switch ($tipo) :
            case 'mysql':
                    $rs = new MYSQLFundoDAO;
            break;
            case 'maria':
                    $rs = new MARIAFundoDAO;
            break;
            case 'pgsql_pdo':
                    $rs = new PGSQL_PDOFundoDAO;
            break;
            case 'pg':
                    $rs = new PG_FundoDAO;
            break;
        endswitch;
        return $rs ;
    }
    public static function getDAOCultivo($tipo){
        $rs = NULL ;
        switch ($tipo) :
            case 'mysql':
                    $rs = new MYSQLCultivoDAO;
            break;
            case 'maria':
                    $rs = new MARIACultivoDAO;
            break;
            case 'pgsql_pdo':
                    $rs = new PGSQL_PDOCultivoDAO;
            break;
            case 'pg':
                    $rs = new PG_CultivoDAO;
            break;
        endswitch;
        return $rs ;
    }
    public static function getDAOObjetivo($tipo){
        $rs = NULL ;
        switch ($tipo) :
            case 'mysql':
                    $rs = new MYSQLObjetivoDAO;
            break;
            case 'maria':
                    $rs = new MARIAObjetivoDAO;
            break;
            case 'pgsql_pdo':
                    $rs = new PGSQL_PDOObjetivoDAO;
            break;
            case 'pg':
                    $rs = new PG_ObjetivoDAO;
            break;
        endswitch;
        return $rs ;
    }
    public static function getDAOProblema($tipo){
        $rs = NULL ;
        switch ($tipo) :
            case 'mysql':
                    $rs = new MYSQLProblemaDAO;
            break;
            case 'maria':
                    $rs = new MARIAProblemaDAO;
            break;
            case 'pgsql_pdo':
                    $rs = new PGSQL_PDOProblemaDAO;
            break;
            case 'pg':
                    $rs = new PG_ProblemaDAO;
            break;
        endswitch;
        return $rs ;
    }
    public static function getDAOCierre($tipo){
        $rs = NULL ;
        switch ($tipo) :
            case 'mysql':
                    $rs = new MYSQLCierreDAO;
            break;
            case 'maria':
                    $rs = new MARIACierreDAO;
            break;
            case 'pgsql_pdo':
                    $rs = new PGSQL_PDOCierreDAO;
            break;
            case 'pg':
                    $rs = new PG_CierreDAO;
            break;
        endswitch;
        return $rs ;
    }
    public static function getDAODistribuidor($tipo){
        $rs = NULL ;
        switch ($tipo) :
            case 'mysql':
                    $rs = new MYSQLDistribuidorDAO;
            break;
            case 'maria':
                    $rs = new MARIADistribuidorDAO;
            break;
            case 'pgsql_pdo':
                    $rs = new PGSQL_PDODistribuidorDAO;
            break;
            case 'pg':
                    $rs = new PG_DistribuidorDAO;
            break;
        endswitch;
        return $rs ;
    }
    public static function getDAOProducto($tipo){
        $rs = NULL ;
        switch ($tipo) :
            case 'mysql':
                    $rs = new MYSQLProductoDAO;
            break;
            case 'maria':
                    $rs = new MARIAProductoDAO;
            break;
            case 'pgsql_pdo':
                    $rs = new PGSQL_PDOProductoDAO;
            break;
            case 'pg':
                    $rs = new PG_ProductoDAO;
            break;
        endswitch;
        return $rs ;
    }
    public static function getDAOUsuario($tipo){
        $rs = NULL ;
        switch ($tipo) :
            case 'mysql':
                    $rs = new MYSQLUsuarioDAO;
            break;
            case 'maria':
                    $rs = new MARIAUsuarioDAO;
            break;
            case 'pgsql_pdo':
                    $rs = new PGSQL_PDOUsuarioDAO;
            break;
            case 'pg':
                    $rs = new PG_UsuarioDAO;
            break;
        endswitch;
        return $rs ;
    }
}
?>
