<?php
// API access key from Google API's Console
define( 'API_ACCESS_KEY', 'AAAANXQToOA:APA91bHfTYxynzkXH8lidU1-G76k-Mph6l77TzFOgiq845nZSJooKTPj9aF6VMp9D5svwqwYRCmOrRHyN3dMpKi0ZyC7lniKKhMqkYrF5nselwb09FwF0DtByVN_Jr4uoes9n8G9qA7i' );
require 'ControladoresBD.php';
//if(isset(basename($_FILES['uploadedfile']['name'])) &&  isset($_POST['tipo']) && isset($_POST['descripcion'])){

        $valorImagen = basename($_FILES['uploadedfile']['name']);
        $valorTipo = $_POST['tipo'];
        $valorDescripcion =  $_POST['descripcion'];



        $response = Controlador::setDatosNoticias($valorImagen,$valorTipo,$valorDescripcion);

        if($response)
        {
                //print('Registro exitoso');
                $uploadedfileload="true";
                $file_name=$_FILES['uploadedfile']['name'];
                $add="../Images/Noticias/$file_name";
                if(move_uploaded_file ($_FILES['uploadedfile']['tmp_name'], $add))
                {
                        if(enviarNotificacion($valorDescripcion,$valorTipo))
                        {
                        print("Se ha registrado satisfactoriamente ");
                        }
                        else
                        {
                        print("No se ha enviado la notificacion pero se realizó el registro");
                        }
                }
                else
                {
                        echo "Error al subir el archivo";
                }
        }else{
                print('error al registrar');
        }



function enviarNotificacion($msj , $title)
{

	$registrationIds = 
	["dRc2hnZcUdc:APA91bFfR8a8VgjAqu04nITay00LtIKgtFjC2v6b8iiXrtvd4kajPMdKBwgeDUFG7GfhbIL67UeL_GwSnu-Hu_CfD_dIlm0210iV68HgDS36luRAcSh8fBEDqR8XF2kuYvByAbdeJl-_"];
	$msg = array
(
	'body' 	=> $msj,
	'title'		=> $title,
	'vibrate'	=> 1,
	'sound'		=> 1,
);
$fields = array
(
	'registration_ids' 	=> $registrationIds,
	'notification'			=> $msg
);
 
$headers = array
(
	'Authorization: key=' . API_ACCESS_KEY,
	'Content-Type: application/json'
);
 
$ch = curl_init();
curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
$result = curl_exec($ch );
curl_close( $ch );
echo $result;
}

?>
