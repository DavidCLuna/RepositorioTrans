
<?php

require 'Database.php';

class Controlador
{
    function __construct()
    {
    }
//Funcion que realiza la consulta de los detalles de los costos
public static function getDetallesCostos($sql, $lote)
    {
   
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($sql);
            // Ejecutar sentencia preparada
            $comando->execute(array($lote));
            // Capturar primera fila del resultado
            $row = $comando->fetchAll(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            // Aqui puedes clasificar el error dependiendo de la excepcion
            // para presentarlo en la respuesta Json
            return null;
        }
    }

//Funcion que realiza la consulta de la version de la aplicacion
public static function getDatosVersionName()
    {

        try {
	    $sql = 'select version_name, titulo_ventana_informativa, texto_ventana_informativa from detalles_aplicacion';
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($sql);
            // Ejecutar sentencia preparada
            $comando->execute();
            // Capturar primera fila del resultado
            $row = $comando->fetchAll(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            // Aqui puedes clasificar el error dependiendo de la excepcion
            // para presentarlo en la respuesta Json
            return null;
        }
    }


public static function eliminarDetalleCosto(
        $sql, $id)
    {
        // Sentencia INSERT

        $comando = $sql;

        // Preparar la sentencia
        try{

        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $id
                )
        );
        }catch(PDOException $e){
                return null;
        }
}

}

?>

