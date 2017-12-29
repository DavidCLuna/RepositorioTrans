<?php

require 'Database.php';

class Controlador
{
    function __construct()
    {
    }

    //Registro de un nuevo usuario por parte de un administrador
     public static function registrar(
            $cedula, $id_razon_social, $nombre_conductor, $apellido_conductor)
        {
            // Sentencia INSERT

            $comando = "insert into conductores values (?,?,?,?,'',now())";

            // Preparar la sentencia
            try{

            $sentencia = Database::getInstance()->getDb()->prepare($comando);

            return $sentencia->execute(
                array(
                    $cedula, $id_razon_social, $nombre_conductor, $apellido_conductor
                    )
            );
            }catch(PDOException $e){
                    return null;
            }
    }


    public static function consultar($parametro){
        
        // Consulta con where para consultar los usuarios con el nombre de usuario guardado en el parametro
        $consulta = "select * from usuarios where nombre_usuario = ?";
        try{
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($parametro));
            // Capturar primera fila del resultado
            $row = $comando->fetchAll(PDO::FETCH_ASSOC);
            return $row;

        }catch (PDOException $e) {
            // Aqui puedes clasificar el error dependiendo de la excepcion
            // para presentarlo en la respuesta Json
            return null;
        }
    }

    /* Funcion que realiza el cambio de la contraseña del usuario*/

    public static function modificar(
            $nombre, $cedula)
        {
            // Sentencia INSERT
            $comando = "update conductores set nombre_conductor = ? where cedula_conductor = ?";

            // Preparar la sentencia
            try{

            $sentencia = Database::getInstance()->getDb()->prepare($comando);

            return $sentencia->execute(
                array(
                    $nombre,
            $cedula)
            );
            }catch(PDOException $e){
                    return null;
            }
        }

    public static function eliminar(
            $cedula)
        {
            // Sentencia DELETE
            $comando = "delete from conductores where cedula_conductor = ?";

            // Preparar la sentencia
            try{

            $sentencia = Database::getInstance()->getDb()->prepare($comando);

            return $sentencia->execute(
                array(
                    $cedula)
            );
            }catch(PDOException $e){
                    return null;
            }
        }
    
    
    public static function getNotify(){
        
        // Consulta con where para consultar los usuarios con el nombre de usuario guardado en el parametro
        $consulta = "SELECT CON.CEDULA_CONDUCTOR as cedula,  CON.NOMBRE_CONDUCTOR as name, CON.APELLIDO_CONDUCTOR as apellido, VEHI.PLACA_VEHICULO as placa, EST_CAR.ESTADO_CARGUE as estado, DATE_FORMAT(EST_CAR.fecha_hora_cargue, '%r') as hourStart, DATE_FORMAT(EST_CAR.fecha_hora_cargue, '%r') as hourWait, CAR.id_factura_cargue as numberBill
        FROM CONDUCTORES CON 
        JOIN CONDUCTORES_VEHICULOS CON_VEHI 
        JOIN VEHICULOS VEHI
        JOIN CARGUES CAR 
        JOIN ESTADOS_CARGUES EST_CAR 
        ON CON.CEDULA_CONDUCTOR = CON_VEHI.CEDULA_CONDUCTOR 
        AND VEHI.PLACA_VEHICULO = CON_VEHI.PLACA_VEHICULO 
        AND CON_VEHI.ID_CONDUCTOR_VEHICULO = CAR.ID_CONDUCTOR_VEHICULO 
        AND CAR.ID_FACTURA_CARGUE = EST_CAR.ID_FACTURA_CARGUE 
        WHERE EST_CAR.ESTADO_CARGUE = '1' OR EST_CAR.ESTADO_CARGUE = '2'";
        try{
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();
            // Capturar primera fila del resultado
            $row = $comando->fetchAll(PDO::FETCH_ASSOC);
            return $row;

        }catch (PDOException $e) {
            // Aqui puedes clasificar el error dependiendo de la excepcion
            // para presentarlo en la respuesta Json
            return null;
        }
    }



}
?>
