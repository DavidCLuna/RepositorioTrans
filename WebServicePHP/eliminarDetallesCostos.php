<?php
/**
* funcion que realiza la consulta de  los costos de la clase ControladoresBD para mostrarlos al principal activity
*/

require 'ControladoresBDCostos.php';


if($_SERVER['REQUEST_METHOD'] == 'POST'){
	
	//obtener numero del lote
	$body = json_decode(file_get_contents("php://input"),true);
	$condicional = $body['condicional'];
	$id = $body['id_eliminar'];
    error_log("valor de id = ".$id);
	//Asignar a la variable retorno el resultado de la consulta"
	$retorno = Controlador::eliminarDetalleCosto(validarConsulta($condicional), $id);
	
	if($retorno){
		$Datos["Resultado"] = '1';
		$Datos["Datos"] = $retorno;
		print json_encode($Datos);
	}else{
		print json_encode(
			array(
			    'Resultado' => '2',
			    'Datos' => 'No se ha podido eliminar el registro'
			)
		);
	}
}

function validarConsulta($condicional){
    $sql = "";
    
    switch ($condicional) {
        
        case 0: //Mano de obra quema quimica
            $sql = "DELETE FROM quema_quimica WHERE id_quemaq = ?";
            break;
        case 1: //Insumos quema quimica
            $sql = "DELETE FROM insumos_quema_quimica WHERE id_insumo = ?";
            break;
        
        case 2: //Mano de obra quema fisica
            $sql = "DELETE FROM quema_fisica WHERE id_qf = ?";
            break;
            
        case 4: //Preparación de suelo
            $sql = "DELETE FROM preparacion_suelo WHERE id_preparacions = ?";
            break;
            
        case 5: // Manejo de residuos de cosecha
            $sql =  "DELETE FROM manejo_residuos_cosecha WHERE id_mrc = ?";
            break;
            
        case 6: // Siembra Manual
            $sql = "DELETE FROM siembra_manual WHERE id_sim = ?";
            break;
            
        case 7: // Siembra Mecanizada
            $sql = "DELETE FROM siembra_mecanizada WHERE id_smzd = ?";
            break;
            
        case 8: // Abonadas //mano de obra abonada 
            $sql = "DELETE FROM abonada WHERE id_abonada = ?";
            break;
            
        case 9: // transporte de insumos de abonos 
            $sql = "";
            break;
            
        case 10: //gastos insumos abonadas 
            $sql = "DELETE FROM insumos_abonada WHERE id_insumo = ?";
            break;
        
        case 11: //mano de obra fumigas
            $sql = "DELETE FROM fumiga WHERE id_fumiga = ?";
            break;
            
        case 12: // insumos fumigas 
            $sql = "DELETE FROM insumos_fumiga WHERE id_insumo = ?";
            break;
            
        case 13: // Despalille
            $sql = "DELETE FROM despalille WHERE id_dsp = ?";
            break;
            
        case 14: // Entresaque
            $sql = "DELETE FROM entresaque WHERE id_etsq = ?";
            break;
        
        case 15: // Macheteada
            $sql = "DELETE FROM macheteada WHERE id_mchd = ?";
            break;
        
        case 16: //pajareo
            $sql ="DELETE FROM pajareo_celaduria_patos WHERE id_pcp = ?";
            break;
        
        case 17: //corta bultos
            $sql = "DELETE FROM corta_bultos WHERE id_crb = ?";
            break;
        case 18: //corta granel
            $sql = "DELETE FROM corta_granel WHERE id_crg = ?";
            break;
        case 19: // mano de obra mantenimiento
            $sql = "DELETE FROM mantenimiento_lote WHERE id_mntlote = ?";
            break;
        case 20: // insumos mantenimiento
            $sql = "DELETE FROM insumos_mantenimiento_lote WHERE id_insumo = ?";
            break;
        case 21: //riego bombeo
            $sql = "DELETE FROM riego WHERE id_riego = ?";
            break;
        case 22: //riego gravedad
            $sql = "DELETE FROM riego WHERE id_riego = ?";
            break;
    }
    return $sql;
}
