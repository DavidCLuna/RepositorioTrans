<?php

require 'ControladoresBD.php';

if($_SERVER['REQUEST_METHOD'] == 'GET'){

//        $body = json_decode(file_get_contents("php://input"),true);

        echo Controlador::calcularFechaPublicacion('2017-07-01 11:02:18');
     /*   if($retorno){
                $Datos["Resultado"] = '1';
                $Datos["Datos"] = $retorno;
                print json_encode($Datos);
        }else{
                print json_encode(
                        array(
                            'Resultado' => '2',
                            'Datos' => 'Lotes Obtenidos'
                        )
                );
        }*/
}
?>

