<?php 
require '../ControladoresBD.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

        //Decodificando formato JSON
        $body = json_decode(file_get_contents("php://input"), true);

        //Registrar usuario
        $retorno = Controlador::RegistroPreparacionSueloPreparacionSuelo(
		$body["fecha"],
		$body["num_lote"],
		$body["tipo"],
		$body["cantidad"],
		$body["pases"],
		$body["valor"],
		$body["valorTotal"],
		$body["valorTotalTotal"]

		);

        if($retorno){
                //codigo de éxito
                print json_encode(
                    array(
                        'Resultado' => '1',
                        'Datos' => 'Se ha registrado la preparacion de suelo exitosamente')
                    );
        }else{
                print json_encode(
                    array(
                        'Resultado' => '2',
                        'Datos' => 'Error al registrar la preparacion de suelo, verifica los datos que ingresastes')
                    );
        }

}

?>
