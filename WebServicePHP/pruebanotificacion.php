<?php
// API access key from Google API's Console
define( 'API_ACCESS_KEY', 'AAAANXQToOA:APA91bHfTYxynzkXH8lidU1-G76k-Mph6l77TzFOgiq845nZSJooKTPj9aF6VMp9D5svwqwYRCmOrRHyN3dMpKi0ZyC7lniKKhMqkYrF5nselwb09FwF0DtByVN_Jr4uoes9n8G9qA7i');

$registrationIds = ["dRc2hnZcUdc:APA91bFfR8a8VgjAqu04nITay00LtIKgtFjC2v6b8iiXrtvd4kajPMdKBwgeDUFG7GfhbIL67UeL_GwSnu-Hu_CfD_dIlm0210iV68HgDS36luRAcSh8fBEDqR8XF2kuYvByAbdeJl-_"];

// prep the bundle
$msg = [
    'title'=> 'Programación Android',
	'body'=>'Prueba 2'
];
$fields = [
    'registration_ids'=>$registrationIds,
    'notification'=>$msg
];

$headers = [
    'Authorization: key=' . API_ACCESS_KEY,
    'Content-Type: application/json'
];
$fields = json_encode($fields);

$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
curl_setopt($ch,CURLOPT_POST, true);
curl_setopt($ch,CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields);
$result = curl_exec($ch );
curl_close( $ch );

echo $result;
print('paso la prueba');
?>
