<?php 
require '../ControladoresBD.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

        //Decodificando formato JSON
        $body = json_decode(file_get_contents("php://input"), true);

        //Registrar usuario
        $retorno = Controlador::RegistroCosechaFumigas(
		$body["fecha"],
		$body["lote"],
		"Abonada",
		$body["cantidadManoObraFumiga"],
		$body["valorUniManoObraFumiga"],
		$body["valorTotalManoObra_fumiga"],
		$body["valorTotalFumiga"]);

        if($retorno){
                //código de éxito
                print json_encode(
                    array(
                        'Resultado' => '1',
                        'Datos' => 'Se ha registrado la fumiga correctamente')
                    );
        }else{
                print json_encode(
                    array(
                        'Resultado' => '2',
                        'Datos' => 'Error al registrar la fumiga, verifique los datos que ingresastes')
                    );
        }

}

?>
