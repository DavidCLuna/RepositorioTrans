<?php
require 'MySQL.php';
require 'ControladoresBD.php';
define( 'API_ACCESS_KEY', 'AAAANXQToOA:APA91bHfTYxynzkXH8lidU1-G76k-Mph6l77TzFOgiq845nZSJooKTPj9aF6VMp9D5svwqwYRCmOrRHyN3dMpKi0ZyC7lniKKhMqkYrF5nselwb09FwF0DtByVN_Jr4uoes9n8G9qA7i');
$con = new MySQL();



$valorImagen = basename($_FILES['uploadedfile']['name']);
$valorTipo = $_POST['tipo'];
$valorDescripcion =  $_POST['descripcion'];


$response = Controlador::setDatosNoticias($valorImagen,$valorTipo,$valorDescripcion);

//print($response);
//print(" / ");
if($response)
{


        $uploadedfileload="true";
        $file_name=$_FILES['uploadedfile']['name'];
        $add="/var/www/html/CoagroCostos/Images/Noticias/$file_name";
	$concat = "https://coagrocostos.com.co/CoagroCostos/Images/Noticias/$file_name";
//print($add);
        if(move_uploaded_file ($_FILES['uploadedfile']['tmp_name'], $add)){
//  	print(" / ");
//	print("Registró");

                $sql = "select token from notifitoken;";
                if($con->solicitud($sql))
                {
                    if($con->result->num_rows > 0)
                    {
			print("Entro al if donde se llama la funcion".$con->result->num_rows);
                        echo enviarNotificacion($con->result,$valorDescripcion,$valorTipo,$concat);
                    }else{
                        session_start();
		        $_SESSION['result'] = "Se ha realizado ";

		}
                }else{
			print("No se ha podido consultar los token para enviar las notificaciones");
		}
              //enviarNotificacion($sql,$_GET['mensaje'],$_GET['titulo']);
              //echo " Ha sido subido satisfactoriamente";
        }else{  
            echo "Error al subir el archivo";
        }

       


}else{
	print("no registra :/");
}

       function enviarNotificacion($result, $msj, $title, $photo)
    {

        $registrationIds = [0];
        $x = 0;
        while($r = mysqli_fetch_object($result))
        {
            $registrationIds[$x] = $r->token;
//	print("                /               ");
	print $r->token;
            $x++;
        }

        // prep the bundle
//        $msg = [
  //          'title'         =>  $title,
    //        'body'          =>  $msj,
      //      'sound'         => 'default',
        //    'vibrate'       =>'1'
$msg = array ("body" => $msj , "title" => $title, "sound" => 'default',"vibrate" =>'1');
        //];
$dat = [
     'imagen' => $photo
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
//	header('Location: ../Noticias/Register.php');
	session_start();
	$_SESSION['result'] = "Se ha realizado el registro de la noticia exitosamente";
header('Location: ../Noticias/Register.php');
//print ($resullt);
        return $result;
    }


