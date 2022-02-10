<?php
include_once('network/_connect.php');

$sql3="SELECT * FROM orders WHERE customer_email='".$_POST['histmail']."';";
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



$message="";
if(isset($_POST['SubmitButton'])){ //check if form was submitted
    $input = $_POST['histmail']; //get input text
    $message = "Success! You entered: ".$input;
  }  



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

    <form class="col-lg-6 offset-lg-3 " id="hist" action="#" method="post" >
   <div class="row justify-content-center">
       <h1>Historico Transaccional</h1>
       <h3>Ingrese su correo</h3>
       <br>
     <input type="email" name="histmail" id="histmail" placeholder="nombre@ejemplo.com" require="">
     <br>
     <span class="input-group-btn">
         <br>
       <button type="submit" name="SubmitButton" class="btn btn-primary">Buscar</button>
       
     </span>
     <?php echo $message; ?>
   </div>
 </form>  

    <br>

    <div class="row justify-content-center">
    <div id="tablacompleta" class="col-auto">
    <table class="table table-bordered table-striped table-dark">
        <thead>
            <tr>
            <th scope="col">Fecha</th>
            <th scope="col">Referencia</th>
            <th scope="col">Estado</th>
            </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row"><?php echo htmlspecialchars($fecha3);?></th>
            <td><?php echo htmlspecialchars($refe3);?></td>
            <td><?php echo htmlspecialchars($status3);?></td>
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

