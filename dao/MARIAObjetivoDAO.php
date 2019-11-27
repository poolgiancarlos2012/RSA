<?php
class MARIAObjetivoDAO{
    public function QUERYListarObjetivo($obje){

        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $utf8='SET NAMES utf8;';
        $prutf8 = $connection->prepare($utf8);
        $prutf8->execute();

        $sql="SELECT idmotivo,motivo FROM motivo WHERE motivo LIKE '%$obje%' ORDER BY motivo ASC";

        $pr = $connection->prepare($sql);
        $pr->execute();
        $data=$pr->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(array("rst"=>true,"dato"=>$data));
        
    }
    public function JQGRIDCOUNTListObjetivo($idmotivo,$motivo){

        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $utf8='SET NAMES utf8;';
        $prutf8 = $connection->prepare($utf8);
        $prutf8->execute();

        $where="";
        if($idmotivo!=''){
            $where.=" AND idmotivo=$idmotivo";
        }
        if($motivo!=''){
            $where.=" AND motivo='$motivo'";
        }

        $sql="  SELECT 
                COUNT(*) AS 'COUNT' 
                FROM 
                motivo 
                WHERE 
                1=1
                $where
                ";
        
        $pr = $connection->prepare($sql);
        if ($pr->execute()) {
            return $pr->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return array(array('COUNT' => 0));
        }
    }
    public function JQGRIDListObjetivo($sidx, $sord, $start, $limit,$idmotivo,$motivo){
        $where="";
        if($idmotivo!=''){
            $where.=" AND idmotivo=$idmotivo";
        }
        if($motivo!=''){
            $where.=" AND motivo='$motivo'";
        }

        $sql="  SELECT
                idmotivo,
                motivo,
                IF(estado=1,'ACTIVO','INACTIVO') AS estado
                FROM 
                motivo
                WHERE 
                1=1
                $where
                ORDER BY $sidx $sord LIMIT $start , $limit";
        // echo $sql;
        // exit();
        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();
        $pr = $connection->prepare($sql);
        if ($pr->execute()) {
            return $pr->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return array();
        }
    }
    public function INSERT_Motivo($motivo,$estado){
        $insert="INSERT INTO motivo(motivo,estado) VALUES('$motivo',$estado)";
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
    public function UPDATE_Motivo($id,$motivo,$estado){
        $insert="UPDATE motivo SET motivo='$motivo',estado=$estado WHERE idmotivo=$id;";
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
    public function DELETE_Motivo($id){
        $insert="UPDATE motivo SET estado=0 WHERE idmotivo=$id;";
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

    public function VerificarDuplicado($obje){
        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $sql="SELECT COUNT(*) AS 'COUNT' FROM motivo WHERE motivo='$obje'";
        
        $pr = $connection->prepare($sql);
        if ($pr->execute()) {
            $ar_count=$pr->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode(array("rst"=>true,"msg"=>"Se Verifico Correctamente","count"=>$ar_count[0]['COUNT']));
        }else{
            echo json_encode(array("rst"=>false,"msg"=>"No Se Verifico Correctamente","count"=>$ar_count[0]['COUNT']));
        }
    }
}

