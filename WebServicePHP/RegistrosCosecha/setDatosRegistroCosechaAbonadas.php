<?php 
require '../ControladoresBD.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

        //Decodificando formato JSON
        $body = json_decode(file_get_contents("php://input"), true);

        //Registrar usuario
        $retorno = Controlador::RegistroCosechaAbonadas(
		$body["fecha"],
		$body["lote"],
		$body["nombreAbonada"],
		$body["cantidadManoObraAbonada"],
		$body["unidadManoObraAbonada"],
		$body["costoUnitarioManoObraAbonada"],
		$body["valorTotalManoObraAbonada"],
		$body["cantidadTransporteAbonada"],
		$body["unidadTransporteAbonada"],
		$body["costoTransporteAbonada"],
		$body["valorTotalTransporteAbonada"],
		$body["valorTotalAbonada"]);

        if($retorno){
                //código de éxito
                print json_encode(
                    array(
                        'Resultado' => '1',
                        'Datos' => 'Se ha registrado la abonada correctamente')
                    );
        }else{
                print json_encode(
                    array(
                        'Resultado' => '2',
                        'Datos' => 'Error al registrar la abonada, verifique los datos que ingresastes')
                    );
        }

}

?>
