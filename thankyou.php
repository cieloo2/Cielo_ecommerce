<?php
include_once('network/_connect.php');

$sql="SELECT * FROM orders ORDER BY id DESC LIMIT 1";
$result=mysqli_query($con,$sql);

$prods = mysqli_fetch_all($result, MYSQLI_ASSOC);
foreach($prods as $prod){
    $id=$prod['id'];
    $sessionid=$prod['estado'];
}


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


$url2 = 'https://checkout-test.placetopay.com/api/session/'.$sessionid;

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
    //echo $e2;
}else{
    $decoded2 = json_decode($resp2, true);
    //console_log($decoded);
    $actStatus = $decoded2['status'];
    $finalStatus = $actStatus['status'];
    $summary = $decoded2['request'];
    $payment = $summary['payment'];
    $reference = $payment['reference'];
}

/* echo $sessionid;
echo $finalStatus;
 */
$sql2=' UPDATE orders SET tran_status="'.$finalStatus.'" WHERE estado='.$sessionid;
$result2=mysqli_query($con,$sql2);

$sql3="SELECT * FROM orders WHERE estado=".$sessionid;
$result3=mysqli_query($con,$sql3);

$prods3 = mysqli_fetch_all($result3, MYSQLI_ASSOC);
foreach($prods3 as $prod3){
    $id3=$prod3['id'];
    $name3=$prod3['customer_name'];
    $email3=$prod3['customer_email'];
    $mobile3=$prod3['customer_mobile'];
    $fecha3=$prod3['created_at'];    
    $refe3=$prod3['referencia'];
    $status3=$prod3['tran_status'];
    $nompro3=$prod3['nompro'];
    $prepro3=$prod3['prepro'];
}
mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="en">
 <head>
  <meta charset="utf-8">
   <script type="text/javascript" src="js/jquery-3.6.0.js"></script>
   <script type="text/javascript" src="https://ajax.microsoft.com/ajax/jquery.validate/1.7/additional-methods.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <title>Cielo</title>
  <link rel="stylesheet" href="./css/styles.css">
  <script src="js/script.js"></script>
  <meta charset="utf-8">
  </head>

 <body>
    <header>
        <div class="container-fluid top text-center"></div>
     <div id="navbar">
      <a href="#default" id="logo"><img src="assets/img/LOGO-P2P-blanco-developers-1.png" style="width: 50%;" alt=""></a>
      <div id="navbar-right">
        <a class="active" href="history.php">Historico</a>
        <a href="#contact" style="color:aliceblue">Contact</a>
        <a href="#about" style="color:aliceblue">About</a>
      </div>
    </div>
    <div class="backgroundimg top text-center"></div>
    <div class="container-fluid bottom"></div>
    
    </header>
<body>
    <br>
    <div class="row justify-content-center">
    <div id="tablacompleta" class="col-auto">
    <table class="table table-bordered table-striped table-dark">
        <thead>
            <tr>
                <th scope="col"> Resumen de Pago</th> 
            </tr>
        </thead>
        <tbody>
            <tr>
                <td scope="row"> <?php echo htmlspecialchars($refe3); ?> </td>
            </tr>
            <tr>
                <td scope="row"> <?php echo htmlspecialchars($fecha3); ?> </td>
            </tr>    
            <tr>
                <td scope="row"> <?php echo htmlspecialchars($nompro3); ?> </td>
            </tr>    
            <tr>
                <td scope="row"> <?php echo htmlspecialchars($prepro3); ?> </td>
            </tr>    
            <tr>
                <td scope="row"> <?php echo htmlspecialchars($status3); ?> </td>
            </tr>    
            <tr>
                <td scope="row"> <?php echo htmlspecialchars($name3); ?> </td>
            </tr>    
            <tr>
                <td scope="row"> <?php echo htmlspecialchars($email3); ?> </td>
            </tr>    
            <tr>
                <td scope="row"> <?php echo htmlspecialchars($mobile3); ?> </td>
            </tr>    
        </tbody>
    </table>
    </div>
  </div>
</body>
<footer><div>
<h4>@Luis Osorno</h4>
</div>
  
</footer>
</html>

