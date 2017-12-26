<?php 
require '../ControladoresBD.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

        //Decodificando formato JSON
        $body = json_decode(file_get_contents("php://input"), true);

        //Registrar usuario
        $retorno = Controlador::RegistroPreparacionSueloMantenimientoManoObra(
		$body["fecha"],
                $body["lote"],
		$body["tipo_limpieza"],
                $body["cantidadJornal"],
                $body["valorUnidadJornal"],
                $body["valorTotalJornal"],
                $body["valorTotalTotal"]);

        if($retorno){
                //código de éxito
                print json_encode(
                    array(
                        'Resultado' => '1',
                        'Datos' => 'Se ha registrado el mantenimiento exitosamente')
                    );
        }else{
                print json_encode(
                    array(
                        'Resultado' => '2',
                        'Datos' => 'Error al registrar el mantenimiento, verifique los datos que ingresastes')
                    );
        }

}

?>
