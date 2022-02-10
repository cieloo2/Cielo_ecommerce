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
    <div class="main-content">
        <div class="content-page">
          <div class="title-section">CHECKOUT</div>
          <div class="container">
  <div class="row">
    <div id="formulario" class="col-sm">
        <div class="title-formulario"><h1>Datos de pagador</h1>
            <form id="formcheckout" action="redirection.php" method="post">
            <div class="col-md-12 mb-3">
            <label for="firstName">Nombre <span class="text-muted">(Required)</span></label>
            <input type="text" class="form-control" name="firstName" id="firstName" placeholder="" required="">
            <div class="invalid-feedback">
              Valid first name is required.
            </div>
          </div>
          <div class="mb-3">
          <label for="email">Email <span class="text-muted">(Required)</span></label>
          <input type="email" class="form-control" name="email" id="email" placeholder="you@example.com">
          <div class="invalid-feedback">
            Please enter a valid email address.
          </div>
        </div>
        <div class="mb-3">
            <label for="mobile">Numero de celular <span class="text-muted">(Required)</span></label>
            <input type="text" class="form-control" name="mobile" id="mobile" placeholder="3210123456"  required="">
            <div class="invalid-feedback">
              Valid first name is required.
            </div>
          </div>
          <div class="row">
                       <div class="col text-center">
                         <img src="https://static.placetopay.com/placetopay-logo.svg" style="width: 200px;" >
                          <button type="submit" class="btn btn-warning" form="formcheckout">Ir a pagar</button>
                      
                      
                      </div>

  </div>
        </form>
        </div>
    </div>
    <div id="summary" class="col-sm">  
          
    </div>
   
  </div>

</div>
                    </div> 
    </div>
    <script type="text/javascript">
      $(document).ready(function(){
        $.ajax({
          url:'network/service/get_prod.php',
          type:'POST',
          data:{},
          success:function(data){
            console.log(data);
            let html= '';
            console.log(data.datos[0].codpro);
                        for (var i = 0;i <data.datos[0].codpro; i++) {
                         html +=  '<div class="row align-items-start"><h1>Resumen</h1></div>'+
                                '<ul class="list-group mb-3">'+
                '<li class="list-group-item d-flex justify-content-between lh-condensed">'+
                '<div>'+
                '<div class="g-col-4">'+
                '<img src="assets/prod/'+data.datos[0].rutimapro+'">'+
                '</div>'+
                    '<h6 class="my-0">'+data.datos[0].nompro+'</h6>'+
                    '<small class="text-muted">'+data.datos[0].despro+'</small>'+
                '</div>'+
                '<span class="text-muted">'+data.datos[0].prepro+'</span>'+
                '</li>'+
                '</ul>'
            }
            console.log(html);
            document.getElementById('summary').innerHTML=html;
          },
          error:function(err){
            console.error(err);
          }
        });

        $('#formcheckout').validate({
            rules:{
                firstName:{
                    required: true,
                    lettersonly: true
                },
                email: {
                    required: true,
                    email: true
                },
                mobile:{
                    number: true,
                    minlenght: 10
                }
            }
        });    
    });

    </script>

</body>
<footer><div>
<h4>@Luis Osorno</h4>
</div>
  
</footer>
</html>