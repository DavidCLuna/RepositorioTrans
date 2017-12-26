<?php 
require '../ControladoresBD.php';

//if($_SERVER['REQUEST_METHOD'] == 'POST'){

        //Decodificando formato JSON
        $body = json_decode(file_get_contents("php://input"), true);

        //Registrar usuario
        $retorno = Controlador::RegistroCosechaSiembraMecanizada(
		$body["fecha"],
		$body["lote"],
                $body["variedadSemilla"],
                $body["costoSembradora"],
                $body["costoSemilla"],
                $body["secadoSemilla"],
                $body["numHectareas"],
		$body["costoManoObra"],	
		$body["cantidadBultos"],	
		$body["valorBulto"],
		$body["transporteSemilla"],
		$body["valorTotal"]);

        if($retorno){
                //código de éxito
                print json_encode(
                    array(
                        'Resultado' => '1',
                        'Datos' => 'Se ha registrado la siembra mecanizada')
                    );
        }else{

                print json_encode(
                    array(
                        'Resultado' => '2',
                        'Datos' => 'Error al registrar la siembra mecanizada, verifique los datos que ingresastes')
                    );
        }

//}

?>
