<?php
include('../_connect.php');


//header('Content-Type: application/json');

$response=new stdClass();

$ordenes=[];
$i=0;

$sql="select * from orders where estado=1";
$result=mysqli_query($con,$sql);
$ordenes=mysqli_fetch_all($result, MYSQLI_ASSOC);
foreach($ordenes as $orden){
    $nompro=$orden['nompro'];
    $requestidd=$orden['estado'];
}
mysqli_close($con);

$estado= 1898696;

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

$url2 = 'https://checkout-test.placetopay.com/api/session/'.$estado;

$data_array2 = array(
    "locale" => "es_CO",
    'auth' => array(
        'login' => $login,
        'tranKey' => $tranKey,
        'seed' => $seed,
        'nonce' =>  $nonceBase64
    ));
$data2 = http_build_query($data_array2);


$ch2 = curl_init();

curl_setopt($ch2,CURLOPT_URL,$url2);
curl_setopt($ch2,CURLOPT_POST, true);
curl_setopt($ch2,CURLOPT_POSTFIELDS,$data2);
curl_setopt($ch2,CURLOPT_RETURNTRANSFER,true);

$resp2 = curl_exec($ch2);

//console_log($data_array);
//console_log($data);
//console_log($datazz);
//console_log($resp);

if($e2 = curl_error($ch2)){
    echo $e2;
}else{
    $decoded2 = json_decode($resp2, true);
    //print_r($decoded2);
    //echo $resp2;
    $actStatus = $decoded2['status'];
    $finalStatus = $actStatus['status'];
    $summary = $decoded2['request'];
    $payment = $summary['payment'];
    $reference = $payment['reference'];

    //console_log($decoded);
/*     $requestStatus = $decoded['status'];
    $tranStatus = $requestStatus['status'];
    $processurl = $decoded['processUrl'];
    $requestid = $decoded['requestId'];    
    $responseStatus = $requestStatus['message']; */
}
?>
