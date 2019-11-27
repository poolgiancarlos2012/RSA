<?php
class MARIAFundoDAO{
    public function JQGRIDCOUNTListFundo($idfundo,$datos){
        $where="";
        if($idfundo!=''){
            $where.=" AND idfundo=$idfundo";
        }
        if($datos!=''){
            $where.=" AND datos='$datos'";
        }

        $sql="  SELECT 
                COUNT(*) AS 'COUNT' 
                FROM 
                fundo 
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
    public function JQGRIDListFundo($sidx, $sord, $start, $limit,$idfundo,$datos){

        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $utf8='SET NAMES utf8;';
        $prutf8 = $connection->prepare($utf8);
        $prutf8->execute();

        $where="";
        if($idfundo!=''){
            $where.=" AND idfundo=$idfundo";
        }
        if($datos!=''){
            $where.=" AND datos='$datos'";
        }

        $sql="  SELECT
                idfundo,
                datos,
                tipo_documento,
                codigo,
                IF(estado=0,'INACTIVO','ACTIVO') AS estado
                FROM 
                fundo
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
    public function QUERYListarFundo($fdo){
        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $utf8='SET NAMES utf8;';
        $prutf8 = $connection->prepare($utf8);
        $prutf8->execute();

        $sql="SELECT idfundo,datos FROM fundo WHERE datos LIKE '%$fdo%' ORDER BY datos ASC";

        $pr = $connection->prepare($sql);
        $pr->execute();
        $data=$pr->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(array("rst"=>true,"dato"=>$data));        
    }

    public function INSERT_Fundo($datos,$tipo_documento,$codigo,$estado){
        

        $insert="";
        if($tipo_documento=='DNI'){
            $insert="INSERT INTO fundo(datos,tipo_documento,codigo,dni,estado) VALUES('$datos','$tipo_documento','$codigo','$codigo',$estado)";
        }else if($tipo_documento=='RUC'){
            $insert="INSERT INTO fundo(datos,tipo_documento,codigo,numero_documento,estado) VALUES('$datos','$tipo_documento','$codigo','$codigo',$estado)";
        }else if($tipo_documento==''){
            $insert="INSERT INTO fundo(datos,estado) VALUES('$datos',$estado)";
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
    public function UPDATE_Fundo($id,$datos,$tipo_documento,$codigo,$estado){
        //$insert="UPDATE fundo SET datos='$datos',estado=$estado WHERE idfundo=$id;";
        
        $insert="";
        if($tipo_documento=='DNI'){
            $insert="UPDATE fundo SET datos='$datos',estado=$estado,tipo_documento='$tipo_documento',codigo='$codigo',dni='$codigo',numero_documento=NULL WHERE idfundo=$id;";
        }else if($tipo_documento=='RUC'){
            $insert="UPDATE fundo SET datos='$datos',estado=$estado,tipo_documento='$tipo_documento',codigo='$codigo',numero_documento='$codigo',dni=NULL WHERE idfundo=$id;";
        }else if($tipo_documento==''){
            $insert="UPDATE fundo SET datos='$datos',estado=$estado WHERE idfundo=$id;";
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
    public function DELETE_Fundo($id){
        $insert="UPDATE fundo SET estado=0 WHERE idfundo=$id;";
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

    public function VerificarDuplicado($fdo){
        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $sql="SELECT COUNT(*) AS 'COUNT' FROM fundo WHERE datos='$fdo'";

        $pr = $connection->prepare($sql);
        if ($pr->execute()) {
            $ar_count=$pr->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode(array("rst"=>true,"msg"=>"Se Verifico Correctamente","count"=>$ar_count[0]['COUNT']));
        }else{
            echo json_encode(array("rst"=>false,"msg"=>"No Se Verifico Correctamente","count"=>$ar_count[0]['COUNT']));
        }
    }
}

