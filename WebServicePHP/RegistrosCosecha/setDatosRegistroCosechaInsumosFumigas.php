<?php 
require '../ControladoresBD.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

        //Decodificando formato JSON
        $body = json_decode(file_get_contents("php://input"), true);

        //Registrar usuario
        $retorno = Controlador::RegistroCosechaInsumosFumigas(
		$body["lote"],
		$body["tipoInsumo"],
		$body["nombreInsumo"],
		$body["cantidadInsumo"],
		$body["unidadInsumo"],
		$body["valorUnitarioInsumo"],
		$body["valorTotalInsumos"]);

        if($retorno){
                //código de éxito
                print json_encode(
                    array(
                        'Resultado' => '1',
                        'Datos' => 'Se ha registrado el insumo de fumigas correctamente')
                    );
        }else{
                print json_encode(
                    array(
                        'Resultado' => '2',
                        'Datos' => 'Error al registrar el insumo de fumigas, verifique los datos que ingresastes')
                    );
        }

}

?>
