<?php 
require '../ControladoresBD.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

        //Decodificando formato JSON
        $body = json_decode(file_get_contents("php://input"), true);

        //Registrar usuario
        $retorno = Controlador::RegistroCosechaInsumosAbonadas(
		$body["lote"],
		$body["tipoInsumo"],
		$body["nombreInsumo"],
		$body["cantidadInsumo"],
		$body["unidadInsumo"],
		$body["valorUnitarioInsumo"],
		$body["valorTotalInsumos"]
		);

        if($retorno){
                //código de éxito
                print json_encode(
                    array(
                        'Resultado' => '1',
                        'Datos' => 'Se ha registrado los insumos de abonada correctamente')
                    );
        }else{
                print json_encode(
                    array(
                        'Resultado' => '2',
                        'Datos' => 'Error al registrar los insumos de abonada, verifique los datos que ingresastes')
                    );
        }

}

?>
