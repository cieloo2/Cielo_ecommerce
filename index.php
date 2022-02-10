<!DOCTYPE html>
<html lang="en">
 <head>
  <meta charset="utf-8">
   <script type="text/javascript" src="js/jquery-3.6.0.js"></script>
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
          <div class="title-section">Productos</div>
          <div class="products-list" id="space-list">
                      </div>
                      <div class="comprar1">
                        <form id="form1" action = "checkout.php?prod1" method = "post">
                          <button id="bot1" type="submit" class="btn btn-warning" form="form1">Crear orden</button>
                      <form>
                      
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
            console.log(data.datos[1].codpro);
                        for (var i = 0;i <data.datos[1].codpro; i++) {
              html += 
             '<div class="product-box">'+
                '<a href="#">'+
                  '<div class="product">'+
                    '<img src="assets/prod/'+data.datos[i].rutimapro+'">'+
                    '<div class="detail-title">'+data.datos[i].nompro+'</div>'+
                    '<div class="detail-description">'+data.datos[i].despro+'</div>'+
                    '<div class="detail-price">'+data.datos[i].prepro+'</div>'+
                  '</div>'+
                '</a>'+
              '</div>';   
            }
            console.log(html);
            document.getElementById('space-list').innerHTML=html;
          },
          error:function(err){
            console.error(err);
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