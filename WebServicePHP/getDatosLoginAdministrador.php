<?php
/**
 * Obtener datos para realizar el login
 */

require 'ControladoresBD.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$body = json_decode(file_get_contents("php://input"),true);
	
        // Obtener parámetro idMeta

        // Tratar retorno
        $retorno = Controlador::getDatosLoginAdministrador($_POST['usuario'], $_POST['contrasena']);


        if ($retorno) {
		session_start();
		$_SESSION['sesion'] = 'true_verdadero';
		header('Location: ../Noticias/Register.php');
        } else {
		header('Location: ../Noticias/login.php');
        }

}
