<?php 
require '../ControladoresBD.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

        //Decodificando formato JSON
        $body = json_decode(file_get_contents("php://input"), true);

        //Registrar usuario
        $retorno = Controlador::RegistroPreparacionSueloQuemaQuimica(
		$body["fecha"],
                $body["lote"],
                $body["cantidadJornal"],
                $body["valorUnidadJornal"],
                $body["valorTotalJornal"],
                $body["valorTotalTotal"]);

        if($retorno){
                //código de éxito
                print json_encode(
                    array(
                        'Resultado' => '1',
                        'Datos' => 'Se ha registrado la mano de obra exitosamente')
                    );
        }else{
                print json_encode(
                    array(
                        'Resultado' => '2',
                        'Datos' => 'Error al registrar la mano de obra, verifique los datos que ingresastes')
                    );
        }

}

?>
