<?php

require 'Database.php';

class Controlador
{
    function __construct()
    {
    }


/**
* Inicio Registros Cosecha
*/

//Registro de un nuevo usuario por parte de un administrador
 public static function setNuevoLote(
        $cedula, $lote, $hectareas)
    {
        // Sentencia INSERT

        $comando = "insert into cd_sistem_lot values (?,?,'0',?)";

        // Preparar la sentencia
        try{

        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $lote, $cedula, $hectareas
                )
        );
        }catch(PDOException $e){
                return null;
        }
}


//Registro de un nuevo usuario por parte de un administrador
 public static function setNuevoUsuario(
        $cedula)
    {
        // Sentencia INSERT

        $comando = "insert into usuario_sistema values (?)";

        // Preparar la sentencia
        try{

        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $cedula
                )
        );
        }catch(PDOException $e){
                return null;
        }
}


//registro cosecha pajareo
 public static function RegistroCortaBulto(
        $fecha_crb,
	$num_lote,
	$cantidad_mq_llanta_crb,
	$valor_mq_llanta_crb,
	$valor_total_mq_llanta_crb,
	$cantidad_mq_oruga_crb,
	$valor_mq_oruga_crb,
	$valor_total_mq_oruga_crb,
	$cantidad_llenador_crb,
	$valor_llenador_crb,
	$valor_total_llenador_crb,
	$cantidad_tractor_crb,
	$valor_tractor_crb,
	$valor_total_tractor_crb,
	$cantidad_bulteador_crb,
	$valor_bulteador_crb,
	$valor_total_bulteador_crb,
	$cantidad_flete_crb,
	$valor_flete_crb,
	$valor_total_flete_crb,
	$valor_cabuya_nylon_crb,
	$valor_celaduria_maquina_crb,
	$valor_alimentacion_crb,
	$valor_administracion_crb,
	$valor_maquina_oruga_crb,
	$valor_total_crb)
    {
        // Sentencia INSERT

        $comando = "call RegistroCortaBultos(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

        // Preparar la sentencia
        try{

        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $fecha_crb,
	        $num_lote,
	        $cantidad_mq_llanta_crb,
	        $valor_mq_llanta_crb,
	        $valor_total_mq_llanta_crb,
	        $cantidad_mq_oruga_crb,
	        $valor_mq_oruga_crb,
	        $valor_total_mq_oruga_crb,
	        $cantidad_llenador_crb,
	        $valor_llenador_crb,
	        $valor_total_llenador_crb,
	        $cantidad_tractor_crb,
	        $valor_tractor_crb,
	        $valor_total_tractor_crb,
	        $cantidad_bulteador_crb,
	        $valor_bulteador_crb,
	        $valor_total_bulteador_crb,
	        $cantidad_flete_crb,
	        $valor_flete_crb,
	        $valor_total_flete_crb,
	        $valor_cabuya_nylon_crb,
	        $valor_celaduria_maquina_crb,
        	$valor_alimentacion_crb,
	        $valor_administracion_crb,
        	$valor_maquina_oruga_crb,
	        $valor_total_crb
                )
        );
        }catch(PDOException $e){
//		error_log("Error en el catch")
                return null;
        }
}


//registro corta bultos
 public static function RegistroCortaGranel(
        $fecha_crg,
	$num_lote,
	$cantidad_mq_llanta_crg,
	$valor_mq_llanta_crg,
	$valor_total_mq_llanta_crg,
	$cantidad_mq_oruga_crg,
	$valor_mq_oruga_crg,	
	$valor_total_mq_oruga_crg,
	$cantidad_flete_crg,
	$valor_flete_crg,	
	$valor_total_flete_crg,
	$valor_celaduria_maquina_crg,
	$valor_alimentacion_crg,
	$valor_administracion_crg,
	$valor_maquina_oruga_crg,
	$valor_total_crg
	)
    {
        // Sentencia INSERT

        $comando = "call RegistroCortaGranel(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

        // Preparar la sentencia
        try{

        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $fecha_crg,
	        $num_lote,
	        $cantidad_mq_llanta_crg,
        	$valor_mq_llanta_crg,
	        $valor_total_mq_llanta_crg,
	        $cantidad_mq_oruga_crg,
	        $valor_mq_oruga_crg,
        	$valor_total_mq_oruga_crg,
	        $cantidad_flete_crg,
	        $valor_flete_crg,
	        $valor_total_flete_crg,
	        $valor_celaduria_maquina_crg,
	        $valor_alimentacion_crg,
	        $valor_administracion_crg,
        	$valor_maquina_oruga_crg,
	        $valor_total_crg
                )
        );
        }catch(PDOException $e){
                return null;
        }
}



//registro cosecha riego bombeo
 public static function RegistroCosechaRiegoBombeo(
        $fecha_riego, $num_lote,
	$cantidad_mano_obra_riego, $valor_mano_obra_riego, $total_mano_obra, $cantidad_aceite,
$valor_aceite, $total_aceite, $cantidad_combustible, $valor_combustible, $total_combustible_riego,
$cantidad_alquiler_riego, $valor_alquiler_riego, $total_alquiler_riego, $valor_tarifa_districto_riego,
$valor_tarifa_corponor_riego, $total_tarifa_riego, $valor_total_riego)
		

    {
        // Sentencia INSERT

        $comando = "call RegistroCosechaRiegoBombeo(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

        // Preparar la sentencia
        try{

        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $fecha_riego, $num_lote,
        $cantidad_mano_obra_riego, $valor_mano_obra_riego, $total_mano_obra, $cantidad_aceite,
$valor_aceite, $total_aceite, $cantidad_combustible, $valor_combustible, $total_combustible_riego,
$cantidad_alquiler_riego, $valor_alquiler_riego, $total_alquiler_riego, $valor_tarifa_districto_riego,
$valor_tarifa_corponor_riego, $total_tarifa_riego, $valor_total_riego
                )
        );
        }catch(PDOException $e){
                return null;
        }
}



//registro cosecha riego gravedad
 public static function RegistroCosechaRiegoGravedad(
        $fecha, $lote, $cantidad, $valor, $valorTotal, $valorTarifa ,$valorTotalTotal)
    {
        // Sentencia INSERT

        $comando = "call RegistroCosechaRiegoGravedad(?,?,?,?,?,?,?)";

        // Preparar la sentencia
        try{

        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $fecha, $lote, $cantidad, $valor, $valorTotal, $valorTarifa, $valorTotalTotal
                )
        );
        }catch(PDOException $e){
                return null;
        }
}

//registro cosecha pajareo
 public static function RegistroCosechaPajareo(
        $fecha_pcp, $num_lote, $cantidad_mano_obra_pcp, $valor_mano_obra_pcp, $valor_total_mano_obra_pcp,
	$cantidad_polvora_pcp, $valor_polvora_pcp, $valor_total_polvora_pcp, $valor_total_pcp)
    {
        // Sentencia INSERT

        $comando = "call RegistroCosechaPajareo(?,?,?,?,?,?,?,?,?)";

        // Preparar la sentencia
        try{

        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $fecha_pcp, $num_lote, $cantidad_mano_obra_pcp, $valor_mano_obra_pcp, $valor_total_mano_obra_pcp,
		$cantidad_polvora_pcp, $valor_polvora_pcp, $valor_total_polvora_pcp, $valor_total_pcp
                )
        );
        }catch(PDOException $e){
                return null;
        }
}



//registro cosecha despalille
 public static function RegistroCosechaDespalille(
        $fecha, $lote, $cantidad, $valor, $valorTotal, $valorTotalTotal)
    {
        // Sentencia INSERT

        $comando = "call RegistroCosechaDespalille(?,?,?,?,?,?)";

        // Preparar la sentencia
        try{

        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
		$fecha, $lote, $cantidad, $valor, $valorTotal, $valorTotalTotal
		)
        );
        }catch(PDOException $e){
                return null;
        }
}


//registro cosecha entresaque
 public static function RegistroCosechaEntresaque(
        $fecha, $lote, $cantidad, $valor, $valorTotal, $valorTotalTotal)
    {
        // Sentencia INSERT

        $comando = "call RegistroCosechaEntresaque(?,?,?,?,?,?)";

        // Preparar la sentencia
        try{

        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array( 
                $fecha, $lote, $cantidad, $valor, $valorTotal, $valorTotalTotal
                )
        );
        }catch(PDOException $e){
                return null;
        }
}

//registro cosecha macheteada
 public static function RegistroCosechaMacheteada(
        $fecha, $lote, $cantidad, $valor, $valorTotal, $valorTotalTotal)
    {
        // Sentencia INSERT

        $comando = "call RegistroCosechaMacheteada(?,?,?,?,?,?)";

        // Preparar la sentencia
        try{

        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array( 
                $fecha, $lote, $cantidad, $valor, $valorTotal, $valorTotalTotal
                )
        );
        }catch(PDOException $e){
                return null;
        }
}





//registro insumos fumigas

 public static function RegistroCosechaInsumosFumigas(
        $lote, $tipoInsumo, $nombreInsumo, $cantidadInsumo, $unidadInsumo, $valorUnitarioInsumo, $valorTotalInsumos)
    {
        // Sentencia INSERT

        $comando = "call RegistroCosechaFumigasInsumos(?,?,?,?,?,?,?)";

        // Preparar la sentencia
        try{

        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $lote,
                $tipoInsumo,
                $nombreInsumo,
                $cantidadInsumo,
                $unidadInsumo,
                $valorUnitarioInsumo,
                $valorTotalInsumos)
        );
        }catch(PDOException $e){
                return null;
        }
}



//registro cosecha fumigas

 public static function RegistroCosechaFumigas(
        $fecha,$lote, $nombreFumiga, $cantidadManoObraFumiga,
	$valorUniManoObraFumiga, $valorTotalManoObra_fumiga, $valorTotalFumiga)
    {
        // Sentencia INSERT

        $comando = "call RegistroCosechaFumigas(?,?,?,?,?,?,?)";

        // Preparar la sentencia
        try{

        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $fecha,
                $lote,
                $nombreFumiga,
                $cantidadManoObraFumiga,
                $valorUniManoObraFumiga,
                $valorTotalManoObra_fumiga,
                $valorTotalFumiga)
        );
        }catch(PDOException $e){
                return null;
        }
}



//registro insumos abonadas

 public static function RegistroCosechaInsumosAbonadas(
        $lote, $tipoInsumo, $nombreInsumo, $cantidadInsumo, $unidadInsumo, $valorUnitarioInsumo, $valorTotalInsumos)
    {
        // Sentencia INSERT

        $comando = "call RegistroCosechaInsumosAbonada(?,?,?,?,?,?,?)";

        // Preparar la sentencia
        try{

        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $lote,
		$tipoInsumo,
		$nombreInsumo,
		$cantidadInsumo,
		$unidadInsumo,
		$valorUnitarioInsumo,
		$valorTotalInsumos)
        );
        }catch(PDOException $e){
                return null;
        }
}



//registro cosecha abonadas

 public static function RegistroCosechaAbonadas(
	$fecha,$lote,
	$nombreAbonada, 
	$cantidadManoObraAbonada, 
	$unidadManoObraAbonada,
	$costoUnitarioManoObraAbonada,
	$valorTotalManoObraAbonada,
	$cantidadTransporteAbonada,
	$unidadTransporteAbonada,
	$costoTransporteAbonada,
	$valorTotalTransporteAbonada,
	$valorTotalAbonada)
    {
        // Sentencia INSERT

        $comando = "call RegistroCosechaAbonada(?,?,?,?,?,?,?,?,?,?,?,?)";

        // Preparar la sentencia
        try{

        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $fecha,$lote,
        	$nombreAbonada, 
        	$cantidadManoObraAbonada, 
        	$unidadManoObraAbonada,
        	$costoUnitarioManoObraAbonada,
        	$valorTotalManoObraAbonada,
        	$cantidadTransporteAbonada,
        	$unidadTransporteAbonada,
        	$costoTransporteAbonada,
	        $valorTotalTransporteAbonada,
	        $valorTotalAbonada)
        );
        }catch(PDOException $e){
                return null;
        }
}


//registro cosecha siembra manual

 public static function RegistroCosechaSiembraManual(
        $fecha,$lote, $variedadSemilla, $cantidadBultos, 
	$precioBulto, $costoSemilla, $costoTransporte, $costoSecado, $pagoTotal, $valorTotal)
    {
        // Sentencia INSERT

        $comando = "call RegistroCosechaSiembraManual(?,?,?,?,?,?,?,?,?,?)";

        // Preparar la sentencia
        try{

        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $fecha,
                $lote,
                $variedadSemilla,
		$cantidadBultos,
		$precioBulto,
		$costoSemilla,
		$costoTransporte,
		$costoSecado,
		$pagoTotal,
		$valorTotal)
        );
        }catch(PDOException $e){
                return null;
        }
}


//registro cosecha siembra mecanizada

 public static function RegistroCosechaSiembraMecanizada(
        $fecha,$lote, $variedadSemilla, $costoSembradora, $costoSemilla, $secadoSemilla, $numHectareas, $costoManoObra, $cantidadBultos,
	$valorBulto, $transporteSemilla, $valorTotal)
    {
        // Sentencia INSERT

        $comando = "call RegistroCosechaSiembraMencanizada(?,?,?,?,?,?,?,?,?,?,?,?)";

        // Preparar la sentencia
        try{

        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        return $sentencia->execute(
            array(
                $fecha,
                $lote,
                $variedadSemilla,
                $costoSembradora,
                $costoSemilla,
                $secadoSemilla,
		$numHectareas,
		$costoManoObra,
		$cantidadBultos,
		$valorBulto,
		$transporteSemilla,
		$valorTotal
		)
        );
        }catch(PDOException $e){
                return null;
        }
}





/**
* Inicio Registros Preparacion de suelo
*/

//registro preparacion suelo preparacion suelo

 public static function RegistroPreparacionSueloPreparacionSuelo(
        $fecha,$lote,$tipo,$cantidad,
        $pases, $valor,$valorTotal, $valorTotalTotal)
    {
        // Sentencia INSERT

        $comando = "call RegistroPreparacionSuelo(?,?,?,?,?,?,?,?)";

        // Preparar la sentencia
        try{

        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $fecha,
                $lote,
                $tipo,
                $cantidad,
		$pases,
                $valor,
                $valorTotal,	
		$valorTotalTotal)
        );
        }catch(PDOException $e){
                return null;
        }
}


//registro preparacion suelo quema quimica mano de obra

 public static function RegistroPreparacionCortamaleza(
        $fecha,$lote,$tipo,$cantidad,
        $valor,$valorTotal)
    {
        // Sentencia INSERT

        $comando = "call RegistroCortamaleza(?,?,?,?,?,?)";

        // Preparar la sentencia
        try{

        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $fecha,
                $lote,
                $tipo,
                $cantidad,
                $valor,
                $valorTotal)
        );
        }catch(PDOException $e){
                return null;
        }
}


//registro preparacion suelo quema quimica mano de obra

 public static function RegistroPreparacionSueloQuemaQuimica(
	$fecha,$lote,$cantidadJornal,$valorUnidadJornal,
	$valorTotalJornal,$valorTotalTotal)
    {
        // Sentencia INSERT

        $comando = "call RegistroQuemaQuimica(?,?,?,?,?,?)";

        // Preparar la sentencia
        try{

        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $fecha,
		$lote,
		$cantidadJornal,
		$valorUnidadJornal,
        	$valorTotalJornal,
		$valorTotalTotal)
        );
        }catch(PDOException $e){
                return null;
        }
}

//registro preparacion suelo  quema fisica

 public static function RegistroPreparacionSueloQuemaFisica(
        $fecha,$lote,$cantidadJornal,$valorUnidadJornal,
        $valorTotalJornal,$cantidadInsu,$dosisInsu,
	$valorUnitarioInsu,$valorTotalInsu,$valorTotalTotal)
    {
        // Sentencia INSERT

        $comando = "call RegistroQuemaFisica(?,?,?,?,?,?,?,?,?,?)";

        // Preparar la sentencia
        try{

        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $fecha,
                $lote,
                $cantidadJornal,
                $valorUnidadJornal,
                $valorTotalJornal,
		$cantidadInsu,
		$dosisInsu,
		$valorUnitarioInsu,
		$valorTotalInsu,
                $valorTotalTotal)
        );
        }catch(PDOException $e){
                return null;
        }
}


//registro preparacion suelo  quema quimica

 public static function RegistroPreparacionSueloQuemaQuimicaInsumo(
        $lote, $tipo_insumo, $nombre_insumo, $cantidad_insumo, $unidad_insumo,
	$valor_unitario, $valor_total_insumo)
    {
        // Sentencia INSERT

        $comando = "call InsumosQuemaQuimica(?,?,?,?,?,?,?)";

        // Preparar la sentencia
        try{
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        return $sentencia->execute(
            array(
                $lote,	
		$tipo_insumo,
		$nombre_insumo,
		$cantidad_insumo,
		$unidad_insumo,
		$valor_unitario,
		$valor_total_insumo)
        );
        }catch(PDOException $e){
                return null;
        }
}

//registro preparacion suelo mantenimiento mano de obra

 public static function RegistroPreparacionSueloMantenimientoManoObra(
        $fecha,$lote,$tipo_limpieza,$cantidadJornal,$valorUnidadJornal,
        $valorTotalJornal,$valorTotalTotal)
    {
        // Sentencia INSERT

        $comando = "call RegistroMantenimiento(?,?,?,?,?,?,?)";

        // Preparar la sentencia
        try{

        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $fecha,
                $lote,
		$tipo_limpieza,
                $cantidadJornal,
                $valorUnidadJornal,
                $valorTotalJornal,
                $valorTotalTotal)
        );
        }catch(PDOException $e){
                return null;
        }
}

//registro preparacion suelo  mantenimiento insumos

 public static function RegistroPreparacionSueloMantenimientoInsumo(
        $lote, $tipo_insumo, $nombre_insumo, $cantidad_insumo, $unidad_insumo,
        $valor_unitario, $valor_total_insumo)
    {
        // Sentencia INSERT

        $comando = "call RegistroInsumosMantenimiento(?,?,?,?,?,?,?)";

        // Preparar la sentencia
        try{

        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $lote,
                $tipo_insumo,
                $nombre_insumo,
                $cantidad_insumo,
                $unidad_insumo,
                $valor_unitario,
                $valor_total_insumo)
        );
        }catch(PDOException $e){
                return null;
        }
}


//registro insumos

 public static function setInsumos(
        $nombre, $clasificacion)
    {
        // Sentencia INSERT

        $comando = "insert into nombres_insumos(nombre_insumo, clasificacion) values (?,?)";

        // Preparar la sentencia
        try{

        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $nombre,
		$clasificacion)
        );
        }catch(PDOException $e){
                return null;
        }
}



  //registro nuevo ciclo que se realiza concatenando la fecha actual con el numero de lote original

 public static function registroNewCicle(
        $lote)
    {
        // Sentencia INSERT

        $comando = "call new_cycle(?)";

        // Preparar la sentencia
        try{

        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $lote)
        );
        }catch(PDOException $e){
                return null;
        }
}


public static function getLoteNewCycle($lote)
    {
        // Consulta todos los costos  para mostrarlos en el principal activity m$
        $consulta = "select num_lote from lote where num_lote like ? order by num_lote desc limit 1";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
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


/* funcion que realiza la consulta de los insumos*/
public static function getDatosInsumos($parametro)
    {
        // Consulta todos los costos  para mostrarlos en el principal activity m$
        $consulta = "select nombre_insumo from nombres_insumos where clasificacion = ? order by nombre_insumo";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($parametro));
            // Capturar primera fila del resultado
            $row = $comando->fetchAll(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            // Aqui puedes clasificar el error dependiendo de la excepcion
            // para presentarlo en la respuesta Json
            return null;
        }
    }



//registro token
public static function setDatosToken($token,$cedula)
    {
	//sentencia UPDATE
	$comando = "update notifitoken set token = ? where idusuario = ?";
	

        // Preparar la sentencia
        try{

        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
		array($token,$cedula
		)
	);
        }catch(PDOException $e){
                return null;
        }
    }


//registro noticias
public static function setDatosNoticias(
	$image,$tipo,$descripcion)
    {
        // Sentencia INSERT
        $comando = "call registrarNoticia(?,?,?)";

        // Preparar la sentencia
        try{

        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $image,
		$tipo,
		$descripcion)
        );
        }catch(PDOException $e){
                return null;
        }
    }


/*Fin registros preparacion de suelo*/


/* Funcion que realiza el cambio de la contraseña del usuario*/

public static function setDatosChangeContrasena(
        $cedula, $contrasena)
    {
        // Sentencia INSERT
        $comando = "update usuario set contrasena = ? where cedula = ?";

        // Preparar la sentencia
        try{

        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $contrasena,
		$cedula)
        );
        }catch(PDOException $e){
                return null;
        }
    }


/* Funcion que realiza la consulta de la contraseña para el posterior cambio*/

public static function getDatoNewContrasena($cedula, $contrasena)
    {
        // Consulta todos los costos  para mostrarlos en el principal activity m$
        $consulta = "select * from usuario where cedula = ? and contrasena = ?";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($cedula, $contrasena));
            // Capturar primera fila del resultado
            $row = $comando->fetchAll(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            // Aqui puedes clasificar el error dependiendo de la excepcion
            // para presentarlo en la respuesta Json
            return null;
        }
    }


/*Método que consulta la informacion del arroz paddy*/

public static function getDatosPaddy()
    {
        // Consulta todos los costos  para mostrarlos en el principal activity menú costos
        $consulta = "select * from paddy";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array());
            // Capturar primera fila del resultado
            $row = $comando->fetchAll(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            // Aqui puedes clasificar el error dependiendo de la excepcion
            // para presentarlo en la respuesta Json
            return -1;
        }
    }

/*Método que realiza la modificacion de los datos de la tabla paddy*/
public static function updateDatosPaddy(
        $asociados,$otros)
    {
        // Sentencia INSERT
        $comando = "update paddy set copasociados = ? , copotros = ?";

        // Preparar la sentencia
        try{

        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $asociados,
                $otros)
        );
        }catch(PDOException $e){
                return null;
        }
    }



public static function getDatosNoti()
    {
        // Consulta todos los costos  para mostrarlos en el principal activity menú costos
        $consulta = "select * from noticias";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($num_lote));
            // Capturar primera fila del resultado
            $row = $comando->fetchAll(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            // Aqui puedes clasificar el error dependiendo de la excepcion
            // para presentarlo en la respuesta Json
            return -1;
        }
    }


public static function getDatosNoticias($start, $limit){
	//consulta  las noticias que se encuentran almacenadas
	$consulta = "select * from noticias limit ?,?";
	try {
	    //preparar sentencia
	    $comando = Database::getInstance()->getDb()->prepare($consulta);
	    // Ejecutar sentencia preparada
	    $comando->execute();
	    // Capturar primera fila del resultado
	    $row = $comando->fecthAll(PDO::FETCH_ASSOC);
	    return $row;
	} catch (PDOException $e){
	    return -1;
	}
}

public static function getCountNoticias()
    {
        // Consulta cuantas noticias hay registradas
        $consulta = "select count(id) as numColum from noticias";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();
            // Capturar primera fila del resultado
            $row = $comando->fetchAll(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            // Aqui puedes clasificar el error dependiendo de la excepcion
            // para presentarlo en la respuesta Json
            return -1;
        }
    }
	

    public static function getDatosAlmacen()
    {
        // Consulta todos los almacenes para mostralos en el menú almacenes
        $consulta = "select * from almacenes";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();
            // Capturar primera fila del resultado
            $row = $comando->fetchAll(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            // Aqui puedes clasificar el error dependiendo de la excepcion
            // para presentarlo en la respuesta Json
            return -1;
        }
    }

/* metodo que realiza la consulta de las graficas*/   

public static function getDatosGraficas($lote)
    {
        // Consulta todos los almacenes para mostralos en el menú almacenes
        $consulta = "call graficas(?)";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(
			array($lote)
		);
            // Capturar primera fila del resultado
            $row = $comando->fetchAll(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            // Aqui puedes clasificar el error dependiendo de la excepcion
            // para presentarlo en la respuesta Json
            return -1;
        }
}

/** metodo que consulta todas*/

public static function getDatosReporteDetallado($lote)
    {
        // Consulta todos los almacenes para mostralos en el menú almacenes
        $consulta = "call especificosapp(?)";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(
                        array($lote)
                );
            // Capturar primera fila del resultado
            $row = $comando->fetchAll(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            // Aqui puedes clasificar el error dependiendo de la excepcion
            // para presentarlo en la respuesta Json
            return -1;
        }
}



/* obtener lotes para realizar la consulta de las graficas*/
public static function getDatosLotesGraficas($loteSin, $num_lote)
    {
        // Consulta todos los almacenes para mostralos en el menú almacenes
        $consulta = "select num_lote from lote where num_lote like ? and num_lote <= ? order by num_lote desc limit 3 ";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(
                        array($loteSin, $num_lote)
                );
            // Capturar primera fila del resultado
            $row = $comando->fetchAll(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            // Aqui puedes clasificar el error dependiendo de la excepcion
            // para presentarlo en la respuesta Json
            return -1;
        }
}




public static function getDatosCostos($num_lote)
    {
        // Consulta todos los costos  para mostrarlos en el principal activity menú costos
        $consulta = "call arrayCostosapp(?)";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($num_lote));
            // Capturar primera fila del resultado
            $row = $comando->fetchAll(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            // Aqui puedes clasificar el error dependiendo de la excepcion
            // para presentarlo en la respuesta Json
            return -1;
        }
    }

    public static function getDatosLogin($usuario, $contrasena)
    {
        // Consulta que obtiene todos los datos del usuario para realizar el ingreso al sistema
        $consulta = "SELECT u.cedula,initcap(u.nombre) as nombre,initcap(u.apellido) as apellido ,u.contrasena,u.clave,u.sexo,u.telefono,u.correo,u.direccion,u.tipo,n.token  
		     FROM usuario u join notifitoken n on u.cedula = n.idusuario
                             WHERE cedula = ? and contrasena = ?";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($usuario, $contrasena));
            // Capturar primera fila del resultado
            $row = $comando->fetchAll(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            // Aqui puedes clasificar el error dependiendo de la excepcion
            // para presentarlo en la respuesta Json
            return -1;
        }
    }
/* funcion que realiza el login para la pagina administrativa que realiza registros de noticias y modificacion apddy*/
public static function getDatosLoginAdministrador($usuario, $contrasena)
    {
        // Consulta que obtiene todos los datos del usuario para realizar el ingreso al siste$
        $consulta = "SELECT * FROM usuario WHERE cedula = ? and contrasena = ? and tipo = 'Administrador'";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($usuario, $contrasena));
            // Capturar primera fila del resultado
            $row = $comando->fetchAll(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            // Aqui puedes clasificar el error dependiendo de la excepcion
            // para presentarlo en la respuesta Json
            return -1;
        }
    }


    /*
     * Registrar usuario
     *
     * @param $cedula numero identificacion usuario primary key
     * @param $nombre  nombre del usuario
     * @param $apellido apellido de usuario
     * @param $contrasena contraseña del usuario con el que se loguea
     * @param $sexo sexo del usuario
     * @param $telefono numero de telefono del usuario
     * @param $correo correo del usuario tipo unique
     * @param $direccion direccion de la casa del usuario
     * @return PDOStatement
     */
    public static function registroUsuario(
        $cedula,
        $nombre,
	$apellido,
	$contrasena,
	$sexo,
	$telefono,
	$correo,
	$direccion,
	$token
    )
    {
        // Sentencia INSERT
        $consulta = "call insert_usuarioapp(?,?,?,?,?,?,?,?,?)";

        // Preparar la sentencia
	try{
	
	$comando = Database::getInstance()->getDb()->prepare($consulta);
	//ejecutar sentencia prepaada
	$comando->execute(
            array(
	        $cedula,
	        $nombre,
	        $apellido,
		$correo,
		$contrasena,
        	$sexo,
	        $telefono,
	        $direccion,
		$token)
        );
	//capturar resultados
	$row = $comando->fetchAll(PDO::FETCH_ASSOC);
	return $row;
	}catch(PDOException $e){
		return null;
	}
    }



    public static function getDatosLotes($cedula)
    {
	//consulta sql que lista todos los lotes del usuario con la cedula especificada
	$consulta = "SELECT num_lote FROM lote where usuario_cedula = ? order by num_lote desc";	

	try{
	    //preparar sentencia
	    $comando = Database::getInstance()->getDb()->prepare($consulta);
	    //ejecutar sentencia preparada
	    $comando->execute(array($cedula));
	    //capturar información
	    $row =  $comando->fetchAll(PDO::FETCH_ASSOC);
	    return $row;
	    
	} catch(PDOException $e){
	    return -1;
	}
    }


function calcularFechaPublicacion($get_timestamp)
{
        $timestamp = strtotime($get_timestamp);
        $diff = time() - (int)$timestamp;

        if ($diff == 0) 
             return 'justo ahora';

        if ($diff > 604800)
            return date("d M Y",$timestamp);

        $intervals = array
        (
            //1                   => array('año',    31556926),
           // $diff < 31556926    => array('mes',   2628000),
           // $diff < 2629744     => array('semana',    604800),
            $diff < 604800      => array('día',     86400),
            $diff < 86400       => array('hora',    3600),
            $diff < 3600        => array('minuto',  60),
            $diff < 60          => array('segundo',  1)
        );

        $value = floor($diff/$intervals[1][1]);
        return 'hace '.$value.' '.$intervals[1][0].($value > 1 ? 's' : '');
}
}
?>
