 <?php
class MARIACierreDAO{
    public function QUERYListarCierreProgramacion(){
        $sql="SELECT idcierre_programacion,nombre FROM cierre_programacion WHERE estado=1 ORDER BY nombre ASC";
        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();
        $pr = $connection->prepare($sql);
        if ($pr->execute()) {
            return $pr->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return array();
        }
    }   
    public function QUERYListarCierreModo(){
        $sql="SELECT idcierre_modo,nombre FROM cierre_modo WHERE estado=1 ORDER BY nombre ASC";
        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();
        $pr = $connection->prepare($sql);
        if ($pr->execute()) {
            return $pr->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return array();
        }
    }
    public function JQGRIDCOUNTListarCierre($ini,$fin,$programacion,$modo){

        $where="";

        if($ini!=''){
            $where.=" AND ini='$ini'";
        }

        if($fin!=''){
            $where.=" AND fin='$fin'";
        }

        if($programacion!=''){
            $where.=" AND idcierre_programacion=$programacion";
        }

        if($modo!=''){
            $where.=" AND idcierre_modo=$modo";
        }


        $sql="  SELECT 
                COUNT(*) AS 'COUNT'
                FROM 
                cierre
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
            return array();
        }
    }
    public function JQGRIDListarCierre($sidx, $sord, $start, $limit,$ini,$fin,$programacion,$modo){

        $where="";

        if($ini!=''){
            $where.=" AND ini='$ini'";
        }

        if($fin!=''){
            $where.=" AND fin='$fin'";
        }

        if($programacion!=''){
            $where.=" AND idcierre_programacion=$programacion";
        }

        if($modo!=''){
            $where.=" AND idcierre_modo=$modo";
        }

        $sql="  SELECT 
                c.idcierre,
                DATE_FORMAT(c.ini, '%d/%m/%Y %H:%i:%s') AS ini,
                DATE_FORMAT(c.fin, '%d/%m/%Y %H:%i:%s') AS fin,
                IF(c.estado=1,'ACTIVO','DESACTIVO') AS estado,
                (SELECT nombre FROM cierre_programacion WHERE idcierre_programacion=c.idcierre_programacion) AS cierre_programacion,
                (SELECT nombre FROM cierre_modo WHERE idcierre_modo=c.idcierre_modo) AS cierre_modo
                FROM cierre c
                WHERE
                1=1
                $where
                ORDER BY DATE(c.fin) DESC LIMIT $start , $limit";

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
    public function INSERT_Cierre($xini,$xfin,$estado,$cierre_programacion,$cierre_modo){
        $inicio=explode(" ",$xini);
        $final=explode(" ",$xfin);
        $xinicio = str_replace('/', '-', $inicio[0]);
        $ini=date('Y-m-d', strtotime($xinicio))." ".$inicio[1];
        $xfinal = str_replace('/', '-', $final[0]);
        $fin=date('Y-m-d', strtotime($xfinal))." ".$final[1];
        $insert="   INSERT INTO 
                    `rsa`.`cierre`
                    (
                        `ini`, 
                        `fin`, 
                        `estado`, 
                        `idcierre_programacion`, 
                        `idcierre_modo`
                    ) 
                    VALUES 
                    (
                        '$ini',
                        '$fin',
                        $estado,
                        $cierre_programacion,
                        $cierre_modo
                    );
                    ";
        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();
        $pr = $connection->prepare($insert);
        if ($pr->execute()) {
            return json_encode(array("rst"=>true,"msg"=>"Se inserto Correctamente"));
        }else{
            return json_encode(array("rst"=>false,"msg"=>"Se inserto Correctamente"));
        }
    }
    public function UPDATE_Cierre($xid,$xini,$xfin,$xestado,$xcierre_programacion,$xcierre_modo){
        $inicio=explode(" ",$xini);
        $final=explode(" ",$xfin);

        $xinicio = str_replace('/', '-', $inicio[0]);
        $ini=date('Y-m-d', strtotime($xinicio))." ".$inicio[1];

        $xfinal = str_replace('/', '-', $final[0]);
        $fin=date('Y-m-d', strtotime($xfinal))." ".$final[1];

        $update="   UPDATE `rsa`.`cierre` 
                    SET 
                    `ini`='$ini',
                    `fin`='$fin',
                    `estado`=$xestado,
                    `idcierre_programacion`=$xcierre_programacion,
                    `idcierre_modo`=$xcierre_modo
                    WHERE idcierre=$xid";

        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();
        $pr = $connection->prepare($update);
        if ($pr->execute()) {
            return json_encode(array("rst"=>true,"msg"=>"Se actualizo Correctamente"));
        }else{
            return json_encode(array("rst"=>false,"msg"=>"Se actualizo Correctamente"));
        }
    }
    public function DELETE_Cierre($xid){
        $delete="   UPDATE `rsa`.`cierre` 
                    SET 
                    `estado`=0
                    WHERE idcierre=$xid";

        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();
        $pr = $connection->prepare($delete);
        if ($pr->execute()) {
            return json_encode(array("rst"=>true,"msg"=>"Se actualizo Correctamente"));
        }else{
            return json_encode(array("rst"=>false,"msg"=>"Se actualizo Correctamente"));
        }
    }
    public function Verificar_Activo_Cierre(){
        $sql=" SELECT COUNT(*) AS 'COUNT' FROM cierre WHERE estado=1";

        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();
        $pr = $connection->prepare($sql);
        if ($pr->execute()) {

            $arr_activo=$pr->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode(array("rst"=>true,"msg"=>"Se actualizo Correctamente","dato"=>$arr_activo[0]['COUNT']));
        }else{
            echo json_encode(array("rst"=>false,"msg"=>"Hubo Problemas","data"=>""));
        }
    }

}