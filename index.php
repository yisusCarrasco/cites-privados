<?php
    require_once "./config/database.php";
    require_once "./config/config.php";
    $db = new Database();
    $con = $db->conectar();
    
    $sql = $con->prepare('SELECT id, nombre, description, spaceAtention,chainAtention FROM cites ');
    $sql -> execute();
    $resultado = $sql-> fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Red Cites Privados Perú</title>
    <!-- CSS -->
    <link rel="stylesheet" href="css/estilos.css">
    <!-- Bootstrap -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- ajax -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
   

</head>
<body style="height-min:100vh;">
  
<div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
      <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center"
              id="bd-theme"
              type="button"
              aria-expanded="false"
              data-bs-toggle="dropdown"
              aria-label="Toggle theme (auto)">
        <svg class="bi my-1 theme-icon-active" width="1em" height="1em"><use href="#circle-half"></use></svg>
        <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
      </button>
      <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
            <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em"><use href="#sun-fill"></use></svg>
            Light
            <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
          </button>
        </li>
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
            <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em"><use href="#moon-stars-fill"></use></svg>
            Dark
            <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
          </button>
        </li>
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto" aria-pressed="true">
            <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em"><use href="#circle-half"></use></svg>
            Auto
            <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
          </button>
        </li>
      </ul>
    </div>
    

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
                <a href="apps.php?modulo=comprar" class="nav-link">Apps</a>
              </li>
              
          </ul>
        </div>
    </div>
  </div>
</header>

<div class="container">
<main style="min-height:90vh">
<div class="container">

  <div class="album py-5 bg-body-tertiary">
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-3 row-cols-md-5 g-3">
        <?php foreach ($resultado as $row) { ?>
        <div class="col">
          <div class="card shadow-sm">
            <?php

            $id = $row["id"];
            $imagen = "imagen/productos/".$id."/principal.jpg";
            if(!file_exists($imagen)){
                $imagen = "imagen/no-photo.jpg";
            }
            ?>
            <img src="<?php echo $imagen?>" alt="imagenProducto"  class="img-fluid">
            <div class="card-body">
              <h5 class="card-title"><?php echo $row["nombre"] ?></h5>

              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                    <a href="detalles.php?id=<?php echo $row['id']; ?>&token=<?php echo hash_hmac('sha1',$row['id'],KEY_TOKEN);?>" class="btn btn-primary">Detalles</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php }?>
        
        
      </div>
    </div>
    
  </div>

   
</main>
</div>


<footer class="text-body-secondary py-2"  style="background-color:#1fae11">
  <div class="d-flex justify-content-center align-items-end">
    <p class="copyright" style="color:white; padding-top:10px">Copyrigth  &#169; 2023 Carbar</p>
  </div> 

</footer>   



 <!-- Boostrap -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  
 <script>
        function compra(){
            window.location.href = "comprar.php";
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  

</body>
</html>