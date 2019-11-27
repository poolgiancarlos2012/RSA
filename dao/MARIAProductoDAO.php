<?php
class MARIAProductoDAO{
    public function JQGRIDCOUNTListProducto($idproducto,$producto){
        $where="";
        if($idproducto!=''){
            $where.=" AND idproducto=$idproducto";
        }
        if($producto!=''){
            $where.=" AND producto='$producto'";
        }

        $sql="  SELECT 
                COUNT(*) AS 'COUNT' 
                FROM 
                producto 
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
    public function JQGRIDListProducto($sidx, $sord, $start, $limit,$idproducto,$producto){

        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $utf8='SET NAMES utf8;';
        $prutf8 = $connection->prepare($utf8);
        $prutf8->execute();

        $where="";
        if($idproducto!=''){
            $where.=" AND idproducto=$idproducto";
        }
        if($producto!=''){
            $where.=" AND producto='$producto'";
        }

        $sql="  SELECT
                idproducto,
                producto,
                IF(estado=0,'INACTIVO','ACTIVO') AS estado
                FROM 
                producto
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
    public function QUERYListarProducto($prod){
        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $utf8='SET NAMES utf8;';
        $prutf8 = $connection->prepare($utf8);
        $prutf8->execute();

        $sql="SELECT idproducto,producto FROM producto WHERE producto LIKE '%$prod%' ORDER BY producto ASC";

        $pr = $connection->prepare($sql);
        $pr->execute();
        $data=$pr->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(array("rst"=>true,"dato"=>$data));        
    }

    public function INSERT_Producto($producto,$estado){
        $insert="INSERT INTO producto(producto,estado) VALUES('$producto',$estado)";
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
    public function UPDATE_Producto($id,$producto,$estado){
        $insert="UPDATE producto SET producto='$producto',estado=$estado WHERE idproducto=$id;";
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
    public function DELETE_Producto($id){
        $insert="UPDATE producto SET estado=0 WHERE idproducto=$id;";
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

    public function VerificarDuplicado($prod){
        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $sql="SELECT COUNT(*) AS 'COUNT' FROM producto WHERE producto='$prod'";

        $pr = $connection->prepare($sql);
        if ($pr->execute()) {
            $ar_count=$pr->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode(array("rst"=>true,"msg"=>"Se Verifico Correctamente","count"=>$ar_count[0]['COUNT']));
        }else{
            echo json_encode(array("rst"=>false,"msg"=>"No Se Verifico Correctamente","count"=>$ar_count[0]['COUNT']));
        }
    }
}

