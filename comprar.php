<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasarella</title>
    <link rel="icon" type="image/png" href="./images/inventario.png">
    <script src="https://www.paypal.com/sdk/js?client-id=AXasi97ANAAbyHBNmr9EJAMhDihCuR76LgTo64OP6AO451ayBt4DMZL1eKVj6W70DaqnlFDiAVtK0nJ5&currency=USD"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <style>
        .contenedor {
            display: flex;
            align-items: center;
 
            overflow-y:auto;
        }
        .row{
            margin: auto;
             width: 50%; 
        }
        .flexi {
            display: flex;
            flex-direction: column; 
            align-items: center;
            justify-content: center;

        }
        .flexison {
            margin-top: 55px;
            padding: 10px;
            overflow-y:auto;
        }
        .flexison:first-child{
            border: 1px solid #ccc;
        }
        .titulo{
            padding-bottom:10px;
        }
        .flecha{
            border: 1px solid #ccc;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            text-align: center;
            margin-left:35px;
            position:absolute;
            left:320px;
            display:flex;
            text-decoration:none;
        }
        .elemento-flecha{
            padding-left:6px;
            padding-top: 6px;
            justify-content:center;
            color: #959697;

        }
        .flecha:hover{
            background-color: #33b8ff;
            color:#fff;
        }
        .elemento-flecha.fa-solid.fa-arrow-left:hover{
            color:#fff;
        }

    </style>
 
    
</head>
<body>

<header style="background-color:#1fae11">
  
  <div class="navbar navbar-expand-lg navbar-dark  shadow-sm">
    <div class="container" >
      
        <a href="index.php" class="navbar-brand">
          <strong>RedCitesPrivadosPerú</strong>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation" style="position:absolute; right:10px">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarHeader">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a href="comprar.php?modulo=comprar" class="nav-link <?php echo ($modulo=="comprar"|| $modulo=="")?"active":""; ?>">Apps</a>
              </li>
              
          </ul>
        </div>
    </div>
  </div>
</header>

<main  style="min-height:85vh" class="container py-3">
<div class="row row-cols-1 row-cols-md mb text-center">
    <div>
        <a href="./index.php" class="flecha" onmouseover="cambiarEstilo()" onmouseout="volverEstilo()">
            <i class="elemento-flecha fa-solid fa-arrow-left" id="elemento_cambiante" >
        </i>
        </a>
    </div>
    <div class="contenedor">
        
        <div class="card mb-4 rounded-3 shadow-sm text-center">
            <div class="d-flex justify-content-start">
                <div class="d-flex flex-row mb-3">
                <div class="p-2">
                    <h2 class="my-0 fw-normal titulo">App de inventario</h2>
                    <img src="./imagen/apps/inventario/appinven.png" alt="">
                </div>
                <div class="p-2">
                    <div class="flexi">
                        <div class="flexison">
                            <h2 class="my-0 fw-normal">Precio </h2>
                            <h1 class="card-title pricing-card-title">$10.00</h1>
                        </div>
                        <div  class="flexison">
                            <div id="paypal-button-container"></div>
                        </div>
                       
                    </div>
                    
                </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
</main>

<footer class="text-body-secondary py-2"  style="background-color:#1fae11">
  <div class="d-flex justify-content-center align-items-end">
    <p class="copyright" style="color:white; padding-top:10px">Copyrigth  &#169; 2023 Carbar</p>
  </div> 

</footer>   

    <script>
        paypal.Buttons({
            style:{
                color:"blue",
                shape:"pill",
                label:"pay"
            },
            createOrder: function(data,actions){
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: 10
                        }
                    }]
                });
            },
            onApprove:function(data,actions){
                actions.order.capture().then(function(detalles){
                    console.log(detalles)
                    window.location.href="pagoaceptado.php";
                });
            },
            onCancel: function(data){
                alert("Pago cancelado");
                console.log(data);
            }
        }).render("#paypal-button-container")
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script>
    function cambiarEstilo() {
      var elementoCambiar = document.getElementById('elemento_cambiante');

      elementoCambiar.style.color = 'white'; 
    }

    function volverEstilo(){
        var elementoCambiante = document.getElementById("elemento_cambiante");
        elementoCambiante.style.color = "#959697"
    }
  </script>

</body>
</html>