<?php 
require '../ControladoresBD.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

        //Decodificando formato JSON
        $body = json_decode(file_get_contents("php://input"), true);

        //Registrar usuario
        $retorno = Controlador::RegistroPreparacionSueloQuemaFisica(
		$body["fecha"],
                $body["lote"],
                $body["cantidadJornal"],
                $body["valorUnidadJornal"],
                $body["valorTotalJornal"],
		$body["cantidadInsu"],
		$body["dosisInsu"],
		$body["valorUnitarioInsu"],
		$body["valorTotalInsu"],
                $body["valorTotalTotal"]);

        if($retorno){
                //código de éxito
                print json_encode(
                    array(
                        'Resultado' => '1',
                        'Datos' => 'Se ha registrado la quema fisica exitosamente')
                    );
        }else{
                print json_encode(
                    array(
                        'Resultado' => '2',
                        'Datos' => 'Error al registrar, verifique los datos que ingresastes')
                    );
        }

}

?>
