<!DOCTYPE html>
<?php
session_start();
include_once('network/_connect.php');

$response =new stdClass();
$producto=[];
$i=0;

$sql="SELECT * FROM producto WHERE codpro = 1";
$result=mysqli_query($con,$sql);

$prods = mysqli_fetch_all($result, MYSQLI_ASSOC);
foreach($prods as $prod){
    $nompro=$prod['nompro'];
    $despro=$prod['despro'];
    $prepro=$prod['prepro'];
    //$estado=$prod['estado'];
}
$codpro = 1;

/* mysqli_free_result($result); */
/* mysqli_close($con); */

$nombre = $_POST['firstName'];
$correo = $_POST['email'];
$celular = $_POST['mobile'];
$returnurl = rand(5, 30000);
$reqreference = 'testing_cielo'.rand(3333,3000404);

//CONSUMO REDIRECCION

$login = 'bfd71f89e5defe8affc93dd0a095486c';
$secretKey="5a120Yn7eSwt3nrs";
$seed = date('c');
$expi =  date('c', strtotime('+20 minutes', strtotime($seed)));

if (function_exists('random_bytes')) {
$nonce = bin2hex(random_bytes(16));
} elseif (function_exists('openssl_random_pseudo_bytes')) {
$nonce = bin2hex(openssl_random_pseudo_bytes(16));
} else {
$nonce = mt_rand();
}
$nonceBase64 = base64_encode($nonce);

$tranKey = base64_encode(hash('sha1', $nonce . $seed . $secretKey, true));

$url = 'https://checkout-test.placetopay.com/api/session/';

$data_array = array(
    "locale" => "es_CO",
    "expiration" => $expi,    
    "returnUrl" => "http://localhost/cielo/thankyou.php?".$returnurl,
    "ipAddress" => "157.100.171.150",
    "userAgent" => "Chrome 95",
    'auth' => array(
        'login' => $login,
        'tranKey' => $tranKey,
        'seed' => $seed,
        'nonce' =>  $nonceBase64
    ),
    'buyer' => array(
        'name' => $nombre,
        'email' => $correo,
        "mobile" => $celular
    ),
    'payment' => array(
        'reference'=> $reqreference,
        'amount' => array(
            'total'=> 10,
            'currency'=> "USD"),
        "allowPartial" => false
    )
        );
$data = http_build_query($data_array);


$ch = curl_init();

curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_POST, true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

$resp = curl_exec($ch);

//console_log($data_array);
//console_log($data);
//console_log($datazz);
//console_log($resp);

if($e = curl_error($ch)){
    echo $e;
}else{
    $decoded = json_decode($resp, true);
    //console_log($decoded);
    $requestStatus = $decoded['status'];
    $tranStatus = $requestStatus['status'];
    $processurl = $decoded['processUrl'];
    $requestid = $decoded['requestId'];    
    $responseStatus = $requestStatus['message'];
}
$estado=$requestid;

        curl_close($ch);

//REQUEST ID

$sql="INSERT INTO orders(customer_name,customer_email,customer_mobile,transactional_status,created_at,updated_at,codpro,nompro,despro,prepro,estado,tran_status,referencia)
VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?); ";
$stmt = $con->prepare($sql);

$stmt->bind_param("sssssssssssss", $nombre,$correo,$celular,$tranStatus,$seed,$seed,$codpro,$nompro,$despro,$prepro,$estado,$tranStatus,$reqreference);
$stmt->execute();
//mysqli_close($con);
curl_close($ch);
    header('Location: ' .$processurl);
    die();


?>