<?php 
require '../ControladoresBD.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

        //Decodificando formato JSON
        $body = json_decode(file_get_contents("php://input"), true);

        //Registrar usuario
        $retorno = Controlador::RegistroCosechaSiembraManual(
		$body["fecha"],
		$body["lote"],
                $body["variedadSemilla"],
                $body["cantidadBultos"],
                $body["precioBulto"],
                $body["costoSemilla"],
                $body["costoTransporte"],
		$body["costoSecado"],	
		$body["pagoTotal"],	
		$body["valorTotal"]);

        if($retorno){
                //código de éxito
                print json_encode(
                    array(
                        'Resultado' => '1',
                        'Datos' => 'Se ha registrado la siembra manual')
                    );
        }else{
                print json_encode(
                    array(
                        'Resultado' => '2',
                        'Datos' => 'Error al registrar la siembra manual, verifique los datos que ingresastes')
                    );
        }

}

?>
