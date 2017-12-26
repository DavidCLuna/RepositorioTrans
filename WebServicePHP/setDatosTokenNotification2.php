<?php

require 'ControladoresBD.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

        //Decodificando formato JSON
        $body = json_decode(file_get_contents("php://input"), true);

        //Registrar usuario
        $retorno = Controlador::setDatosToken(
                $body["token"],
                $body["cedula"]);

	header ("Location: getDatosVersionName.php");
}

