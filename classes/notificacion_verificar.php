<?php

define( 'API_ACCESS_KEY', 'AAAATyyBK0o:APA91bEi-8cetsf-p2ouJG1cPzThEdu2i3nP83r1K8_Gs2VDTR4zpEd8joZbCEg_3ZvLPqScxOK4NSCfPcWC2N7wZxxXXJXqzCvJUPI8QOfIiuaMlCpIaxUFsp5PQTMGuJepYJSgajmz');

enviarNotificacion('Mensaje notificacion prueba','Vehículo Pendiente','121212', '123-EWQ','1090521536');

function enviarNotificacion($msj, $title, $id_factura, $placa_vehiculo, $cedula_conductor){
           
        $registrationIds[] = "fDZDc5u2nAw:APA91bEDyuoL_9IIVl94qisR9E8AFl2ik__qiEn8hRW5L7lMLjSRW8W7j8PWnxxG2o1BlRu8SLfDFzRfR3VZWrp7OFsOmIcfTCBBamEgM0DvCGdl2ikbYBLIFWe4klMj2c_vGEch9WJJ";
    
        $msg = array ("body" => $msj , "title" => $title, "sound" => 'default',"vibrate" =>'1');
                //];
        $dat = [
             'id_factura' => $id_factura,
             'placa_vehiculo' => $placa_vehiculo,
             'cedula_conductor' => $cedula_conductor
        ];
        $fields = [
            'registration_ids'  => $registrationIds,
            'notification' => $msg,
            'data' => $dat
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
    }


