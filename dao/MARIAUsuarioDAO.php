<?php
class MARIAUsuarioDAO{
    public function JQGRIDCOUNTListUsuario($idusuario,$datos){
        $where="";
        if($idusuario!=''){
            $where.=" AND idusuario=$idusuario";
        }
        if($datos!=''){
            $where.=" AND CONCAT(nombre,' ',paterno,' ',materno)='$datos'";
        }


        $sql="  SELECT 
                COUNT(*) AS 'COUNT' 
                FROM 
                usuario 
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
    public function JQGRIDListUsuario($sidx, $sord, $start, $limit,$idusuario,$datos){

        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $utf8='SET NAMES utf8;';
        $prutf8 = $connection->prepare($utf8);
        $prutf8->execute();

        $where="";
        if($idusuario!=''){
            $where.=" AND idusuario=$idusuario";
        }
        if($datos!=''){
            $where.=" AND CONCAT(nombre,' ',paterno,' ',materno)='$datos'";
        }

        $sql="  SELECT
                idusuario,
                nombre,
                paterno,
                materno,
                usuario,
                '' AS clave,
                IF(estado=0,'INACTIVO','ACTIVO') AS estado
                FROM 
                usuario
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
    public function QUERYListarUsuario($usu){
        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $utf8='SET NAMES utf8;';
        $prutf8 = $connection->prepare($utf8);
        $prutf8->execute();

        $sql="SELECT idusuario,CONCAT(nombre,' ',paterno,' ',materno) AS  'usuario' FROM usuario WHERE CONCAT(nombre,' ',paterno,' ',materno) LIKE '%$usu%' ORDER BY CONCAT(nombre,' ',paterno,' ',materno) ASC";

        $pr = $connection->prepare($sql);
        $pr->execute();
        $data=$pr->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(array("rst"=>true,"dato"=>$data));        
    }

    public function INSERT_Usuario($nombre,$paterno,$materno,$usuario,$clave,$estado){
        $insert="   INSERT INTO
                    usuario(
                    nombre,
                    paterno,
                    materno,
                    usuario,
                    clave,
                    estado,
                    genero,
                    idtipo_usuario,
                    idprivilegio,
                    idtipo_persona
                    ) 
                    VALUES
                    (
                    '$nombre',
                    '$paterno',
                    '$materno',
                    '$usuario',
                    MD5('$clave'),
                    '$estado',
                    'M',
                    6,
                    4,
                    1
                    )";
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
    public function UPDATE_Usuario($id,$nombre,$paterno,$materno,$usuario,$clave,$estado){
        $insert="   UPDATE 
                    usuario 
                    SET 
                    nombre='$nombre',
                    paterno='$paterno',
                    materno='$materno',
                    usuario='$usuario',
                    clave=MD5('$clave'),
                    estado='$estado'
                    WHERE 
                    idusuario=$id;";
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
    public function DELETE_Usuario($id){
        $insert="UPDATE usuario SET estado=0 WHERE idusuario=$id;";
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

    public function VerificarDuplicado($usu){
        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $sql="SELECT COUNT(*) AS 'COUNT' FROM usuario WHERE CONCAT(nombre,' ',paterno,' ',materno)='$usu'";

        $pr = $connection->prepare($sql);
        if ($pr->execute()) {
            $ar_count=$pr->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode(array("rst"=>true,"msg"=>"Se Verifico Correctamente","count"=>$ar_count[0]['COUNT']));
        }else{
            echo json_encode(array("rst"=>false,"msg"=>"No Se Verifico Correctamente","count"=>$ar_count[0]['COUNT']));
        }
    }

    public function VerificarUsuario($usuario){
        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();

        $sql="SELECT COUNT(*) AS 'COUNT' FROM usuario WHERE usuario='$usuario'";

        $pr = $connection->prepare($sql);
        if ($pr->execute()) {
            $ar_count=$pr->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode(array("rst"=>true,"msg"=>"Se Verifico Correctamente","count"=>$ar_count[0]['COUNT']));
        }else{
            echo json_encode(array("rst"=>false,"msg"=>"No Se Verifico Correctamente","count"=>$ar_count[0]['COUNT']));
        }
    }
}

