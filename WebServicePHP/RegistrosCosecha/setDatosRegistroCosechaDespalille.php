<?php 
require '../ControladoresBD.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

        //Decodificando formato JSON
        $body = json_decode(file_get_contents("php://input"), true);

	$tipo = $body["tipo"];
	
	if($tipo == "0"){

		$retorno = Controlador::RegistroCosechaDespalille(
                $body["fecha"],
                $body["lote"],
                $body["cantidad"],
                $body["valor"],
                $body["valorTotal"],
                $body["valorTotalTotal"]);

	}
	if($tipo == "1"){
		$retorno = Controlador::RegistroCosechaEntresaque(
                $body["fecha"],
                $body["lote"],
                $body["cantidad"],
                $body["valor"],
                $body["valorTotal"],
                $body["valorTotalTotal"]);

	}else{
		$retorno = Controlador::RegistroCosechaMacheteada(
                $body["fecha"],
                $body["lote"],
                $body["cantidad"],
                $body["valor"],
                $body["valorTotal"],
                $body["valorTotalTotal"]);

	}
        
        if($retorno){
                //código de éxito
                print json_encode(
                    array(
                        'Resultado' => '1',
                        'Datos' => 'Se ha realizado el registro correctamente')
                    );
        }else{
                print json_encode(
                    array(
                        'Resultado' => '2',
                        'Datos' => 'Error al realizar el registro, verifique los datos que ingresastes')
                    );
        }

}

?>
