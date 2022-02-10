<?php
$login = '6dd490faf9cb87a9862245da41170ff2';
$secretKey="024h1IlD";
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

$url = 'https://checkout-co.placetopay.dev/api/session';

$data_array = array(
    "locale" => "es_CO",
    "expiration" => $expi,    
    "returnUrl" => "https://dnetix.co/p2p/client",
    "ipAddress" => "157.100.171.150",
    "userAgent" => "Chrome 95",
    'auth' => array(
        'login' => $login,
        'tranKey' => $tranKey,
        'seed' => $seed,
        'nonce' =>  $nonceBase64
    ),
    'buyer' => array(
        'name' => 'luis',
        'email' => 'testp2psky@gmail.com',
        "mobile" => '3211231212'
    ),
    'payment' => array(
        'reference'=> 'testing_luis',
        'amount' => array(
            'total'=> "10",
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

print($resp);

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
echo $processurl;
?>