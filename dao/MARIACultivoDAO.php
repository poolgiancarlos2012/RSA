<?php
class MARIACultivoDAO{
    public function QUERYListarCultivo($cvo){

        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $utf8='SET NAMES utf8;';
        $prutf8 = $connection->prepare($utf8);
        $prutf8->execute();

        $sql="SELECT idcultivo,cultivo FROM cultivo WHERE cultivo LIKE '%$cvo%' ORDER BY cultivo ASC";

        $pr = $connection->prepare($sql);
        $pr->execute();
        $data=$pr->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(array("rst"=>true,"dato"=>$data));
        
    }
    public function JQGRIDCOUNTListCultivo($idcultivo,$cultivo){
        $where="";
        if($idcultivo!=''){
            $where.=" AND idcultivo=$idcultivo";
        }
        if($cultivo!=''){
            $where.=" AND cultivo='$cultivo'";
        }

        $sql="  SELECT 
                COUNT(*) AS 'COUNT' 
                FROM 
                cultivo 
                WHERE 
                1=1
                $where
                ";

        // echo $sql;
        // exit();
        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();
        $pr = $connection->prepare($sql);
        if ($pr->execute()) {
            return $pr->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return array(array('COUNT' => 0));
        }
    }
    public function JQGRIDListCultivo($sidx, $sord, $start, $limit,$idcultivo,$cultivo){

        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $utf8='SET NAMES utf8;';
        $prutf8 = $connection->prepare($utf8);
        $prutf8->execute();
        
        $where="";
        if($idcultivo!=''){
            $where.=" AND idcultivo=$idcultivo";
        }
        if($cultivo!=''){
            $where.=" AND cultivo='$cultivo'";
        }

        $sql="  SELECT
                idcultivo,
                cultivo,
                IF(estado=1,'ACTIVO','INACTIVO') AS estado
                FROM 
                cultivo
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
    public function INSERT_Cultivo($cultivo,$estado){

        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $utf8='SET NAMES utf8;';
        $prutf8 = $connection->prepare($utf8);
        $prutf8->execute();

        $insert="INSERT INTO cultivo(cultivo,estado) VALUES('".$cultivo."',$estado)";

        // echo($insert);
        // exit();
        
        $pr = $connection->prepare($insert);
        if ($pr->execute()) {
            return json_encode(array("rst"=>true,"msg"=>"Se inserto Correctamente"));
        }else{
            return json_encode(array("rst"=>false,"msg"=>"No Se inserto Correctamente"));
            exit();
        }
    }
    public function UPDATE_Cultivo($id,$cultivo,$estado){
        $insert="UPDATE cultivo SET cultivo='$cultivo',estado=$estado WHERE idcultivo=$id;";
        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();
        $pr = $connection->prepare($insert);
        if ($pr->execute()) {
            return json_encode(array("rst"=>true,"msg"=>"Se Modifico Correctamente"));
        }else{
            return json_encode(array("rst"=>false,"msg"=>"No Se Modifico Correctamente"));
            exit();
        }
    }
    public function DELETE_Cultivo($id){
        $insert="UPDATE cultivo SET estado=0 WHERE idcultivo=$id;";
        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();
        $pr = $connection->prepare($insert);
        if ($pr->execute()) {
            return json_encode(array("rst"=>true,"msg"=>"Se Elimino Correctamente"));
        }else{
            return json_encode(array("rst"=>false,"msg"=>"No Se Elimino Correctamente"));
            exit();
        }
    }

    public function VerificarDuplicado($cvo){
        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $sql="SELECT COUNT(*) AS 'COUNT' FROM cultivo WHERE cultivo='$cvo'";
        
        $pr = $connection->prepare($sql);
        if ($pr->execute()) {
            $ar_count=$pr->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode(array("rst"=>true,"msg"=>"Se Verifico Correctamente","count"=>$ar_count[0]['COUNT']));
        }else{
            echo json_encode(array("rst"=>false,"msg"=>"No Se Verifico Correctamente","count"=>$ar_count[0]['COUNT']));
        }
    }
}

