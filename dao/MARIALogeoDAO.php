<?php

class MARIALogeoDAO {

    public function QUERY_login(dto_usuario $dto_usuario) {
        $user = $dto_usuario->getUsuario();
        $pass = $dto_usuario->getClave();

        $factoryConnection = FactoryConnection::create('mysql');
        $connection = $factoryConnection->getConnection();
        #### VERIFICAR USUARIO ####
        $sql_Exist_user = "SELECT COUNT(*) AS count FROM usuario WHERE usuario='$user'";
        $pr = $connection->prepare($sql_Exist_user);
        $pr->execute();
        $data_Exist_user = $pr->fetchAll(PDO::FETCH_ASSOC);
        if ($data_Exist_user[0]['count'] > 0) {
            $sql_Exist_clave = "SELECT COUNT(*) AS count FROM usuario WHERE clave=MD5('$pass')";
            // echo $sql_Exist_clave;
            // exit();
            $pr_pass = $connection->prepare($sql_Exist_clave);
            $pr_pass->execute();
            $data_Exist_clave = $pr_pass->fetchAll(PDO::FETCH_ASSOC);
            if ($data_Exist_clave[0]['count'] > 0) {
                $sql_Exist_user_clave = "SELECT COUNT(*) AS COUNT FROM usuario WHERE usuario= '$user' AND clave= MD5('$pass')";
                $pr_user_pass = $connection->prepare($sql_Exist_clave);
                $pr_user_pass->execute();
                $data_Exist_user_clave = $pr_user_pass->fetchAll(PDO::FETCH_ASSOC);
                if ($data_Exist_user_clave[0]['count'] > 0) {

                    
                    
                    $sql_User_datos = " SELECT
                                        u.idusuario AS idusuario,
                                        u.usuario AS usuario,
                                        u.clave AS clave,
                                        u.nombre AS nombre,
                                        u.paterno AS paterno,
                                        u.materno AS materno,
                                        u.datos AS datos,
                                        u.dni,
                                        u.ruc,
                                        u.idtipo_persona AS idtipo_persona,
                                        per.nombre AS persona,
                                        u.idtipo_usuario AS idtipo_usuario,
                                        tus.nombre AS tipo_usuario,
                                        u.idprivilegio AS idprivilegio,
                                        pri.nombre AS privilegio,
                                        u.estado AS estado
                                        FROM usuario u
                                        INNER JOIN tipo_usuario tus ON u.idtipo_usuario=tus.idtipo_usuario
                                        INNER JOIN tipo_persona per ON per.idtipo_persona=u.idtipo_persona
                                        INNER JOIN privilegio pri ON pri.idprivilegio=u.idprivilegio
                                        WHERE 
                                        u.usuario= '$user' AND
                                        u.clave= MD5('$pass') AND
                                        u.estado=1";

                    // echo $sql_User_datos;
                    // exit();
                    $pr_User_datos = $connection->prepare($sql_User_datos);
                    $pr_User_datos->execute();
                    $data_User_datos = $pr_User_datos->fetchAll(PDO::FETCH_ASSOC);
                    if (count($data_User_datos) > 0) {
                        
                        
                        $_SESSION['logeo'] = $data_User_datos[0]['estado'];
                        $_SESSION['activo'] = $data_User_datos[0]['estado'];
                        $_SESSION['idusuario'] = $data_User_datos[0]['idusuario'];
                        $_SESSION['usuario'] = $data_User_datos[0]['usuario'];
                        $_SESSION['clave'] = $data_User_datos[0]['clave'];
                        $_SESSION['nombre'] = $data_User_datos[0]['nombre'];
                        $_SESSION['paterno'] = $data_User_datos[0]['paterno'];
                        $_SESSION['materno'] = $data_User_datos[0]['materno'];
                        $_SESSION['datos'] = $data_User_datos[0]['datos'];
                        $_SESSION['dni'] = $data_User_datos[0]['dni'];
                        $_SESSION['ruc'] = $data_User_datos[0]['ruc'];
                        $_SESSION['idtipo_persona'] = $data_User_datos[0]['idtipo_persona'];
                        $_SESSION['persona'] = $data_User_datos[0]['persona'];
                        $_SESSION['idtipo_usuario'] = $data_User_datos[0]['idtipo_usuario'];
                        $_SESSION['tipo_usuario'] = $data_User_datos[0]['tipo_usuario'];
                        $_SESSION['idprivilegio'] = $data_User_datos[0]['idprivilegio'];
                        $_SESSION['privilegio'] = $data_User_datos[0]['privilegio'];
                        
                        return array('rst' => true, 'msg' => 'Ingreso Correctamente...!!!', 'data' => $data_User_datos[0]['nombre'] . " " . $data_User_datos[0]['paterno']. " " . $data_User_datos[0]['materno'],'tipo_usuario' => $_SESSION['tipo_usuario']);
                    } else {
                        return array('rst' => false, 'msg' => 'Error de ejecucion al obtener datos', 'data' => $data_User_datos[0]['count']);
                    }
                } else {
                    return array('rst' => false, 'msg' => 'Error al ejecutar Ingreso', 'data' => $data_Exist_clave[0]['count']);
                }
            } else {
                return array('rst' => false, 'msg' => '¡Clave incorrecta!', 'data' => $data_Exist_clave[0]['count']);
            }
        } else {
            return array('rst' => false, 'msg' => '¡Usuario no registrado!', 'data' => $data_Exist_user[0]['count']);
        }
    }

}

?>