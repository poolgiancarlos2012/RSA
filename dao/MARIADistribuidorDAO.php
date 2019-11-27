<?php
class MARIADistribuidorDAO{
    public function JQGRIDCOUNTListDistribuidor($iddistribuidor,$distribuidor){
        $where="";
        if($iddistribuidor!=''){
            $where.=" AND idcliente=$iddistribuidor";
        }
        if($distribuidor!=''){
            $where.=" AND razon_social='$distribuidor'";
        }

        $sql="  SELECT 
                COUNT(*) AS 'COUNT' 
                FROM 
                cliente 
                WHERE 
                1=1
                $where
                ";
        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();
        $pr = $connection->prepare($sql);
        if ($pr->execute()) {
            return $pr->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return array(array('COUNT' => 0));
        }
    }
    public function JQGRIDListDistribuidor($sidx, $sord, $start, $limit,$iddistribuidor,$distribuidor){

        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $utf8='SET NAMES utf8;';
        $prutf8 = $connection->prepare($utf8);
        $prutf8->execute();

        $where="";
        if($iddistribuidor!=''){
            $where.=" AND idcliente=$iddistribuidor";
        }
        if($distribuidor!=''){
            $where.=" AND razon_social='$distribuidor'";
        }

        $sql="  SELECT
                idcliente AS 'iddistribuidor',
                razon_social AS 'distribuidor',
                tipo_documento,
                codigo,
                IF(estado=0,'INACTIVO','ACTIVO') AS estado
                FROM 
                cliente
                WHERE 
                1=1
                $where
                ORDER BY $sidx $sord LIMIT $start , $limit";
        // echo $sql;
        // exit();
        
        $pr = $connection->prepare($sql);
        if ($pr->execute()) {
            return $pr->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return array();
        }
    }
    public function QUERYListarDistribuidor($dist){
        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $utf8='SET NAMES utf8;';
        $prutf8 = $connection->prepare($utf8);
        $prutf8->execute();

        $sql="SELECT idcliente AS 'iddistribuidor',razon_social AS 'distribuidor' FROM cliente WHERE razon_social LIKE '%$dist%' ORDER BY razon_social ASC";

        $pr = $connection->prepare($sql);
        $pr->execute();
        $data=$pr->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(array("rst"=>true,"dato"=>$data));        
    }

    public function INSERT_Distribuidor($distribuidor,$tipo_documento,$codigo,$estado){
        
        $insert="";
        if($tipo_documento=='DNI'){
            $insert="INSERT INTO cliente(razon_social,tipo_documento,codigo,dni,estado) VALUES('$distribuidor','$tipo_documento','$codigo','$codigo',$estado)";
        }else if($tipo_documento=='RUC'){
            $insert="INSERT INTO cliente(razon_social,tipo_documento,codigo,numero_documento,estado) VALUES('$distribuidor','$tipo_documento','$codigo','$codigo',$estado)";
        }

        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();
        $pr = $connection->prepare($insert);
        if ($pr->execute()) {
            return json_encode(array("rst"=>true,"msg"=>"Se inserto Correctamente"));
        }else{
            return json_encode(array("rst"=>false,"msg"=>"No Se inserto Correctamente"));
            exit();
        }
    }
    public function UPDATE_Distribuidor($id,$distribuidor,$tipo_documento,$codigo,$estado){
        

        $insert="";
        if($tipo_documento=='DNI'){
            $insert="UPDATE cliente SET razon_social='$distribuidor',estado=$estado,tipo_documento='$tipo_documento',codigo='$codigo',dni='$codigo',numero_documento=NULL WHERE idcliente=$id;";
        }else if($tipo_documento=='RUC'){
            $insert="UPDATE cliente SET razon_social='$distribuidor',estado=$estado,tipo_documento='$tipo_documento',codigo='$codigo',numero_documento='$codigo',dni=NULL WHERE idcliente=$id;";
        }

        // echo $insert;
        // exit();
        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();
        $pr = $connection->prepare($insert);
        if ($pr->execute()) {
            return json_encode(array("rst"=>true,"msg"=>"Se inserto Correctamente"));
        }else{
            return json_encode(array("rst"=>false,"msg"=>"No Se inserto Correctamente"));
            exit();
        }
    }
    public function DELETE_Distribuidor($id){
        $insert="UPDATE cliente SET estado=0 WHERE idcliente=$id;";
        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();
        $pr = $connection->prepare($insert);
        if ($pr->execute()) {
            return json_encode(array("rst"=>true,"msg"=>"Se inserto Correctamente"));
        }else{
            return json_encode(array("rst"=>false,"msg"=>"No Se inserto Correctamente"));
            exit();
        }
    }

    public function VerificarDuplicado($dist){
        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $sql="SELECT COUNT(*) AS 'COUNT' FROM cliente WHERE razon_social='$dist'";

        $pr = $connection->prepare($sql);
        if ($pr->execute()) {
            $ar_count=$pr->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode(array("rst"=>true,"msg"=>"Se Verifico Correctamente","count"=>$ar_count[0]['COUNT']));
        }else{
            echo json_encode(array("rst"=>false,"msg"=>"No Se Verifico Correctamente","count"=>$ar_count[0]['COUNT']));
        }
    }
}

