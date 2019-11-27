<?php
class MARIAProblemaDAO{
    public function JQGRIDCOUNTListProblema($idactividad,$actividad){
        $where="";
        if($idactividad!=''){
            $where.=" AND idactividad=$idactividad";
        }
        if($actividad!=''){
            $where.=" AND actividad='$actividad'";
        }

        $sql="  SELECT 
                COUNT(*) AS 'COUNT' 
                FROM 
                actividad 
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
    public function JQGRIDListProblema($sidx, $sord, $start, $limit,$idactividad,$actividad){

        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $utf8='SET NAMES utf8;';
        $prutf8 = $connection->prepare($utf8);
        $prutf8->execute();

        $where="";
        if($idactividad!=''){
            $where.=" AND idactividad=$idactividad";
        }
        if($actividad!=''){
            $where.=" AND actividad='$actividad'";
        }

        $sql="  SELECT
                idactividad,
                actividad,
                IF(estado=1,'ACTIVO','INACTIVO') AS estado
                FROM 
                actividad
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
    public function QUERYListarProblema($prob){
        // $sql="SELECT idactividad,actividad FROM actividad WHERE 1=1 ORDER BY actividad ASC";
        // $factoryConnection = FactoryConnection::create('mysql');
        // $connection = $factoryConnection->getConnection();
        // $pr = $connection->prepare($sql);
        // if ($pr->execute()) {
        //     return $pr->fetchAll(PDO::FETCH_ASSOC);
        // }else{
        //     return array();
        // }

        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $utf8='SET NAMES utf8;';
        $prutf8 = $connection->prepare($utf8);
        $prutf8->execute();

        $sql="SELECT idactividad,actividad FROM actividad WHERE actividad LIKE '%$prob%' ORDER BY actividad ASC";

        $pr = $connection->prepare($sql);
        $pr->execute();
        $data=$pr->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(array("rst"=>true,"dato"=>$data));
        
    }

    public function INSERT_Problema($actividad,$estado){
        $insert="INSERT INTO actividad(actividad,estado) VALUES('$actividad',$estado)";
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
    public function UPDATE_Problema($id,$actividad,$estado){
        $insert="UPDATE actividad SET actividad='$actividad',estado=$estado WHERE idactividad=$id;";
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
    public function DELETE_Problema($id){
        $insert="UPDATE actividad SET estado=0 WHERE idactividad=$id;";
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

    public function VerificarDuplicado($prob){
        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $sql="SELECT COUNT(*) AS 'COUNT' FROM actividad WHERE actividad='$prob'";

        $pr = $connection->prepare($sql);
        if ($pr->execute()) {
            $ar_count=$pr->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode(array("rst"=>true,"msg"=>"Se Verifico Correctamente","count"=>$ar_count[0]['COUNT']));
        }else{
            echo json_encode(array("rst"=>false,"msg"=>"No Se Verifico Correctamente","count"=>$ar_count[0]['COUNT']));
        }
    }

}

