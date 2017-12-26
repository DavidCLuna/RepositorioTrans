<?php
require 'MySQL.php';
require 'ControladoresBD.php';
define( 'API_ACCESS_KEY', 'AAAANXQToOA:APA91bHfTYxynzkXH8lidU1-G76k-Mph6l77TzFOgiq845nZSJooKTPj9aF6VMp9D5svwqwYRCmOrRHyN3dMpKi0ZyC7lniKKhMqkYrF5nselwb09FwF0DtByVN_Jr4uoes9n8G9qA7i');
$con = new MySQL();



$asociadosP = $_POST['asociados'];
$otrosP =  $_POST['otros'];

print $asociadosP.$otrosP;


$response = Controlador::updateDatosPaddy($asociadosP,$otrosP);

print($response);

if($response)
{
	$sql = "select token from notifitoken;";
        if($con->solicitud($sql))
        {
        	if($con->result->num_rows > 0)
                {    
		    $valorT = "Precio De Paddy";
		    $valorDescripcion = "Se ha actualizado el precio del paddy, entra para conocerlo";
		    echo enviarNotificacion($con->result,$valorDescripcion,$valorT);	
		 }else
                        echo "-1"; 
	}else{
                print("No se ha podido consultar los token para enviar las notificaiones");
        }
}else
{
	print("No registra :/");
}



function enviarNotificacion($result, $msj, $title)
{

        $registrationIds = [0];
        $x = 0;
        while($r = mysqli_fetch_object($result))
        {
            $registrationIds[$x] = $r->token;
            $x++;
        }

        // prep the bundle
        $msg = [
            'title'         =>  $title,
            'body'          =>  $msj,
            'sound'         => 'default',
            'vibrate'       =>'1'

        ];

	$dat = [
     'imagen' => "https://coagrocostos.com.co/CoagroCostos/Images/paddy/paddy.JPG"
];


        $fields = [
            'registration_ids'  => $registrationIds,
            'notification'              => $msg,
            'data'    => $dat
        ];

        $headers = [
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        ];
        $fields = json_encode( $fields );

        //apt-get install -y php5-curl

        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, $fields );
        $result = curl_exec($ch );
        curl_close( $ch );
	
	session_start();
        $_SESSION['result'] = "Se ha realizado la actualización del precio paddy exitosamente";
	header('Location: ../Noticias/Register.php');
        return $result;
    }



