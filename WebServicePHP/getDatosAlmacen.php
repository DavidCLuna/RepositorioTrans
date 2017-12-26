<?php

require 'ControladoresBD.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Manejar petición GET
    $response = Controlador::getDatosAlmacen();

    if (response) {

        $Datos["Resultado"] = 1;
        $Datos["Datos"] = $response;

        print json_encode($Datos);
    } else {
        print json_encode(array(
            "Resultado" => 2,
            "Datos" => "Ha ocurrido un error y no se han podido consultar los lotes"
        ));
    }
}
