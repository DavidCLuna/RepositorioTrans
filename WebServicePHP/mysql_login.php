<?php
/**
 * Provee las constantes para conectarse a la base de datos
 * Mysql.
 */
define("HOSTNAME", "localhost");// Nombre del host
define("DATABASE", "mysqll"); // Nombre de la base de datos
define("USERNAME", "root"); // Nombre del usuario
define("PASSWORD", "XbU9NRNx"); // Nombre de la constraseña
$con = mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DATABASE) or die('Unable to Connect');
$tildes = $con->query("SET NAMES 'utf8'");
?>
