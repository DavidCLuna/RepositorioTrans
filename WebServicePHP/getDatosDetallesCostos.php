<?php
/**
* funcion que realiza la consulta de  los costos de la clase ControladoresBD para mostrarlos al principal activity
*/

require 'ControladoresBDCostos.php';


if($_SERVER['REQUEST_METHOD'] == 'POST'){
	
	//obtener numero del lote
	$body = json_decode(file_get_contents("php://input"),true);
	$condicional = $body['condicional'];
	$num_lote = $body['num_lote'];
	//Asignar a la variable retorno el resultado de la consulta"
	$retorno = Controlador::getDetallesCostos(validarConsulta($condicional), $num_lote);
	
	if($retorno){
		$Datos["Resultado"] = '1';
		$Datos["Datos"] = $retorno;
		print json_encode($Datos);
	}else{
		print json_encode(
			array(
			    'Resultado' => '2',
			    'Datos' => 'No se ha podido realizar la consulta de los lotes'
			)
		);
	}
}

function validarConsulta($condicional){
    $sql = "";
    switch ($condicional) {
        
        case 0: //Mano de obra quema quimica
            $sql = "SELECT id_quemaq as 'id',fecha_quemaq AS  'Fecha', cantidad_mano_obra_quemaq AS  'Cantidad', valor_mano_obra_quemaq AS  'Valor', valor_total_mano_obra_quemaq AS  'Total mano de obra'
                FROM quema_quimica
            WHERE num_lote = ? 
            ORDER BY 'Fecha'";
            break;
        case 1: //Insumos quema quimica
            $sql = "SELECT ins.id_insumo as 'id',qq.fecha_quemaq as 'Fecha', ins.tipo_insumo as 'Tipo insumo', ins.nombre_insumo as 'Nombre insumo', ins.cantidad_insumo as 'Cantidad', ins.unidad_insumo as 'Unidad', ins.valor_unitario_insumo 'Valor', valor_total_insumos 'Valor total' 
            FROM insumos_quema_quimica ins join quema_quimica qq on ins.id_quemaq = qq.id_quemaq
            WHERE qq.num_lote = ? 
            ORDER BY 'Fecha'";
            break;
        
        case 2: //Mano de obra quema fisica
            $sql = "SELECT id_qf as 'id', fecha_qf as 'Fecha', cantidad_jornales_qf as 'Cantidad', valor_unidad_jornal_qf as 'Valor', valor_total_jornal_qf as 'Total mano de obra'
            FROM quema_fisica 
            WHERE num_lote = ? 
            ORDER BY 'Fecha'";
            break;
            
        case 3: //Insumos quema fisica
            $sql = "SELECT fecha_qf as 'Fecha', cantidad_insumos_qf as 'Cantidad', unidad_insumo_qf 'Unidad', valor_unitario_insumo_qf as 'Valor', valor_total_insumo_qf as 'Total insumos'
            FROM quema_fisica 
            WHERE num_lote = ? 
            ORDER BY 'Fecha'";
            break;
            
        case 4: //Preparación de suelo
            $sql = "SELECT 
            id_preparacions as 'id', fecha_preparacions as 'Fecha', tipo_preparacions as 'Tipo',cantidad_hect_horas_preparacions as 'Hectareas',pases_preparacions as 'Pases',valor_unitario_preparacions as 'Valor unitario',valor_total_preparacions 
            as 'Valor total'
            FROM preparacion_suelo
             WHERE num_lote = ? 
            ORDER BY 'Fecha'";
            break;
            
        case 5: // Manejo de residuos de cosecha
            $sql = "SELECT 
            id_mrc as 'id', 
            fecha_mrc as 'Fecha',
            tipo_manejo_mrc as 'Tipo',
            cantidad_hectareas_mrc as 'Cantidad',
            valor_hectareas_mrc as 'Valor',
            valor_total_mrc as 'Valor total'
            FROM manejo_residuos_cosecha 
            WHERE num_lote = ? 
            ORDER BY 'Fecha'";
            break;
            
        case 6: // Siembra Manual
            $sql = "SELECT id_sim as 'id', fecha_sim as 'Fecha', variedad_semilla_sim as 'Semilla', cantidad_bultos_sim as 'Bultos', precio_bulto_sim as 'Precio bulto', costo_semilla_sim 'Valor semilla', costo_transporte_sim as 'Valor transporte', 
            costo_secado_semilla_sim as 'Valor Secado', pago_total_obreros_sim as 'Pago Obreros', valor_total_sim as 'Total siembra' 
            FROM siembra_manual 
            WHERE num_lote = ? 
            ORDER BY 'Fecha'";
            break;
            
        case 7: // Siembra Mecanizada
            $sql = "SELECT id_smzd as 'id', fecha_smzd as 'Fecha', variedad_semilla_smzd as 'Semilla', costo_mq_sembradora_smzd as 'Costo maquina', costo_semilla_smzd as 'Valor semilla', secado_semilla_smzd as 'Valor secado', num_hect_sembradas_smzd as 'Hectareas', costo_mano_obra_smzd as 'Mano obra', cantidad_bultos_smzd as 'Cantidad bultos', valor_bulto_smzd as 'Valor bulto', transporte_semilla_smzd as 'Transporte', valor_total_smzd as 'Total' 
            FROM siembra_mecanizada 
            WHERE num_lote = ? 
            ORDER BY 'Fecha'";
            break;
            
        case 8: // Abonadas //mano de obra abonada 
            $sql = "SELECT id_abonada as 'id', fecha_abonada as 'Fecha', nombre_abonada as 'Nombre',cantidad_mano_obra_abonada as 'Cantidad bultos',costo_unitario_mano_obra_abonada as 'Valor unitario', valor_total_mano_obra_abonada as 'Valor total mano de obra'
            FROM abonada
            WHERE num_lote = ? 
            ORDER BY 'Fecha'";
            break;
            
        case 9: // transporte de insumos de abonos 
            $sql = "SELECT id_abonada as 'id',fecha_abonada as 'Fecha',unidad_transporte_abonada as 'Tipo', cantidad_transporte_abonada as 'Cantidad',costo_transporte_abonada  as 'Valor bulto' ,valor_total_transporte_abonada as 'Total transporte'
             from abonada
             WHERE num_lote = ? 
             ORDER BY 'Fecha'";
            break;
            
        case 10: //gastos insumos abonadas 
            $sql = "SELECT ia.id_insumo as 'id', ab.fecha_abonada as 'Fecha' ,ia.tipo_insumo as 'Tipo', ia.nombre_insumo as 'Nombre insumo', ia.cantidad_insumo as 'Cantidad insumo', ia.unidad_insumo as 'Unidad', ia.valor_unitario_insumo as 'Valor',ia.valor_total_insumos as 'Valor total'  
            FROM insumos_abonada ia join abonada ab on ab.id_abonada = ia.id_abonada 
            WHERE num_lote = ? 
            ORDER BY 'Fecha'";
            break;
        
        case 11: //mano de obra fumigas
            $sql = "SELECT id_fumiga as 'id', `fecha_fumiga` as 'Fecha',`cantidad_mano_obra_fumiga` as 'Jornales',`valor_uni_mano_obra_fumiga` as 'Valor por jornal',`valor_total_mano_obra_fumiga` as 'Total mano de obra' FROM fumiga WHERE num_lote = ? ORDER BY 'Fecha' ";
            break;
            
        case 12: // insumos fumigas 
            $sql = "SELECT ifs.id_insumo as 'id', fm.fecha_fumiga as 'Fecha', ifs.tipo_insumo as 'Tipo insumo', ifs.nombre_insumo as 'Nombre insumo', ifs.cantidad_insumo as 'Cantidad insumo', ifs.unidad_insumo as 'Unidad insumo', ifs.valor_unitario_insumo as 'Valor unitario', ifs.valor_total_insumos as 'Total insumos'
             FROM insumos_fumiga ifs join fumiga fm on fm.id_fumiga = ifs.id_fumiga 
             WHERE num_lote = ? 
            ORDER BY 'Fecha'";
            break;
            
        case 13: // Despalille
            $sql = "SELECT id_dsp as 'id', fecha_dsp as 'Fecha',cantidad_mano_obra_dsp as 'Jornales',precio_mano_obra_dsp as 'Precio jornal',total_mano_obra_dsp as 'Total mano de obra' 
            FROM despalille 
            WHERE num_lote = ? 
            ORDER BY 'Fecha'";
            break;
            
        case 14: // Entresaque
            $sql = "SELECT id_etsq as 'id', fecha_etsq as 'Fecha', cantidad_mano_obra_etsq as 'Cantidad', precio_mano_obra_etsq as 'Valor', total_mano_obra_etsq as 'Valor total' 
            FROM entresaque 
            WHERE num_lote = ? 
            ORDER BY 'Fecha'";
            break;
        
        case 15: // Macheteada
            $sql = "SELECT id_mchd as 'id', fecha_mchd as 'Fecha', cantidad_mano_obra_mchd as 'Cantidad', precio_mano_obra_mchd as 'Valor', total_mano_obra_mchd as 'Valor total' 
            FROM macheteada 
            WHERE num_lote = ? 
            ORDER BY 'Fecha'";
            break;
        
        case 16: //pajareo
            $sql ="SELECT id_pcp as 'id',
            fecha_pcp as 'Fecha',
            cantidad_mano_obra_pcp as 'Jornales',
            valor_mano_obra_pcp as 'Valor jornal',
            valor_total_mano_obra_pcp as 'Valor total jornales',
            cantidad_polvora_pcp as 'Cantidad polvora',
            valor_polvora_pcp as 'Valor polvora',
            valor_total_polvora_pcp as 'Total polvora',
            valor_total_pcp as 'Gastos totales'
            FROM pajareo_celaduria_patos 
            WHERE num_lote = ? 
            ORDER BY 'Fecha'";
            break;
        
        case 17: //corta bultos
            $sql = "SELECT 
            id_crb as 'id',
            fecha_crb as 'Fecha', 
            cantidad_mq_llanta_crb as 'Cantidad maquina llanta', 
            valor_mq_llanta_crb as 'Valor maquina llanta', 
            valor_total_mq_llanta_crb as 'Valor total maquina llanta', 
            cantidad_mq_oruga_crb as 'Cantidad maquina oruga', 
            valor_mq_oruga_crb as 'Valor maquina oruga', 
            valor_total_mq_oruga_crb as 'Valor total maquina oruga', 
            cantidad_llenador_crb as 'Cantidad llenador', 
            valor_llenador_crb as 'Valor llenador', 
            valor_total_llenador_crb as 'Valor total llenador', 
            cantidad_tractor_crb as 'Cantidad tractor', 
            valor_tractor_crb as 'Valor tractor', 
            valor_total_tractor_crb as 'Valor total tractor', 
            cantidad_bulteador_crb as 'Cantidad bulteador', 
            valor_bulteador_crb as 'Valor bulteador', 
            valor_total_bulteador_crb as 'Valor total bulteador', 
            cantidad_flete_crb as 'Cantidad flete', 
            valor_flete_crb as 'Valor flete', 
            valor_total_flete_crb as 'Valor total flete', 
            valor_cabuya_nylon_crb as 'Valor cabuya', 
            valor_celaduria_maquina_crb as 'Valor celaduria', 
            valor_alimentacion_crb as 'Valor alimentación', 
            valor_administracion_crb as 'Valor administración', 
            valor_maquina_oruga_crb as 'Valor maquina oruga', 
            valor_total_crb as 'Valor total' 
            FROM corta_bultos 
            WHERE num_lote = ? 
            ORDER BY 'Fecha'";
            break;
        case 18: //corta granel
            $sql = "SELECT 
            id_crg as 'id',
            fecha_crg as 'Fecha',
            cantidad_mq_llanta_crg as 'Cantidad maquina llanta',
            valor_mq_llanta_crg as 'Valor maquina llanta',
            valor_total_mq_llanta_crg as 'Valor total maquina llanta',
            cantidad_mq_oruga_crg as 'Cantidad maquina oruga',
            valor_mq_oruga_crg as 'Valor maquina oruga',
            valor_total_mq_oruga_crg as 'Valor total maquina oruga',
            cantidad_flete_crg as 'Cantidad flete',
            valor_flete_crg as 'Valor flete',
            valor_total_flete_crg as 'Valor total flete',
            valor_celaduria_maquina_crg as 'Valor celaduría',
            valor_alimentacion_crg as 'Valor alimentación',
            valor_administracion_crg as 'Valor administración',
            valor_maquina_oruga_crg as 'Valor maquina oruga',
            valor_total_crg as 'Valor total corta'
            FROM corta_granel
            WHERE num_lote = ?  
            ORDER BY 'Fecha'";
            break;
        case 19: // mano de obra mantenimiento
            $sql ="SELECT 
            id_mntlote as 'id',
            fecha_mntlote as 'Fecha',
            tipo_limpieza_mntlote as 'Tipo limpieza',
            cantidad_jornal_mntlote as 'Cantidad',
            valor_jornal_mntlote as 'Valor unitario',
            valor_total_jornal_mntlote as 'Valor total'
            FROM mantenimiento_lote 
            WHERE num_lote = ? 
            ORDER BY 'Fecha'";
            break;
        case 20: // insumos mantenimiento
            $sql = "SELECT 
            insuMan.id_insumo as 'id',
            mantMan.fecha_mntlote as 'Fecha',
            insuMan.tipo_insumo as 'Tipo insumo',
            insuMan.nombre_insumo as 'Nombre insumo',
            insuMan.cantidad_insumo as 'Cantidad insumo',
            insuMan.unidad_insumo as 'Unidad insumo',
            insuMan.valor_unitario_insumo as 'Valor unitario',
            insuMan.valor_total_insumos as 'Valor total'
            FROM insumos_mantenimiento_lote insuMan join mantenimiento_lote mantMan 
			ON insuMan.id_mntlote = mantMan.id_mntlote 
            WHERE mantMan.num_lote = ? 
            ORDER BY mantMan.fecha_mntlote";
            break;
        case 21: //riego bombeo
            $sql = "SELECT 
            id_riego as 'id',
            fecha_riego as 'Fecha',
            cantidad_mano_obra_riego as 'Cantidad mano de obra',
            valor_mano_obra_riego as 'Valor mano de obra',
            total_mano_obra as 'Total mano de obra',
            cantidad_aceite as 'Cantidad aceite',
            valor_aceite as 'Valor aceite',
            total_aceite as 'Total aceite',
            cantidad_combustible as 'Cantidad combustible',
            valor_combustible as 'Valor combustible',
            total_combustible_riego as 'Total combustible',
            cantidad_alquiler_riego as 'Cantidad alquiler',
            valor_alquiler_riego as 'Valor alquiler',
            total_alquiler_riego as 'Total alquiler',
            valor_tarifa_districto_riego as 'Tarifa distrito',
            valor_tarifa_corponor_riego as 'Tarifa corponor',
            total_tarifa_riego as 'Tarifa riego',
            valor_total_riego as 'Valor total'
            FROM riego 
            WHERE num_lote = ? and tipo_riego = 'gravedad' 
            ORDER BY 'Fecha'";
            break;
        case 22: //riego gravedad
            $sql = "SELECT 
            id_riego as 'id',
            fecha_riego as 'Fecha',
            cantidad_mano_obra_riego as 'Cantidad mano de obra',
            valor_mano_obra_riego as 'Valor mano de obra',
            total_mano_obra as 'Total mano de obra',
            valor_tarifa_districto_riego as 'Valor tarifa distrito',
            valor_total_riego as 'Valor total riego' 
            FROM riego 
            WHERE num_lote = ? and tipo_riego = 'bombeo' 
            ORDER BY 'Fecha'";
            break;
    }
    return $sql;
}
/*
Server: Error en la insercion de radicado. INSERT INTO RADICADO (CARP_PER, CARP_CODI, TDOC_CODI, RA_ASUN,	TRTE_CODI,	MREC_CODI, RADI_FECH_OFIC, RADI_USUA_ACTU,	RADI_DEPE_ACTU, RADI_FECH_RADI,	RADI_USUA_RADI, RADI_DEPE_RADI, CODI_NIVEL,	FLAG_NIVEL,	RADI_LEIDO, SGD_APLI_CODIGO,SGD_APLI_ENLACE, RADI_NUME_RADI, PAR_SERV_SECUE, RADI_DEPE_RESPTRTE, TIPO_EXAMEN) VALUES (0, 0, 0, 'Buenas tardes, Quiero realizar una consulta de cuando se va a realizar la publicación de los resultados de las pruebas saber TyT aplicadas este año en el mes de Junio, ya que en el momento de realizarla los delegados me dijeron que iba a ser para los primeros días del mes de septiembre y consulto en la página y todavía no están los resultados. Entonces la pregunta es, que día se va a realizar la publicación de estos resultados?. Muchas gracias.', 0, 5, '2017-09-29', 1, 210, CURRENT_TIMESTAMP, 40, 210, 1, 1, 0, 1,'null', 20172101139312, 2, 210, ) 
*/
/*
