<?php 
require '../ControladoresBD.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

        //Decodificando formato JSON
        $body = json_decode(file_get_contents("php://input"), true);

        //Registrar usuario
        $retorno = Controlador::RegistroPreparacionSueloQuemaQuimicaInsumo(
		$body["lote"],
                $body["tipo_insumo"],
                $body["nombre_insumo"],
                $body["cantidad_insumo"],
                $body["unidad_insumo"],
                $body["valor_unitario"],
		$body["valor_total_insumo"]);

        if($retorno){
                //código de éxito
                print json_encode(
                    array(
                        'Resultado' => '1',
                        'Datos' => 'Se ha registrado los insumos exitosamente')
                    );
        }else{
                print json_encode(
                    array(
                        'Resultado' => '2',
                        'Datos' => 'Error al registrar los insumos, verifique los datos que ingresastes')
                    );
        }

}

?>
