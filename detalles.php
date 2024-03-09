<?php
    require_once "./config/config.php";
    require_once "./config/database.php";
    $db = new Database();
    $con = $db->conectar();

    $id = isset($_GET['id']) ? $_GET['id'] : '';
    $token = isset($_GET['token']) ? $_GET['token'] : '';

    if($id==''|| $token ==''){
      echo "Error al procesar petición";
      exit;
    }else{
      $token_tmp = hash_hmac('sha1', $id, KEY_TOKEN);

      //Validamos si el token es igual
      if($token == $token_tmp){
        $sql = $con->prepare('SELECT count(id) FROM cites WHERE id=?');
        $sql -> execute([$id]);
        if($sql->fetchColumn()>0){
          $sql = $con->prepare('SELECT  id,nombre,description,spaceAtention,chainAtention FROM cites WHERE id=? ');
          $sql -> execute([$id]);
          $row = $sql -> fetch(PDO::FETCH_ASSOC);
          $spaceAtention = $row['spaceAtention'];
          $nombre = $row['nombre'];
          $description = $row['description'];
          $chainAtention = $row['chainAtention'];
          $dir_images = 'imagen/productos/'.$id.'/';

          $ruta_img = $dir_images.'principal.jpg';

          if(!file_exists($ruta_img)){
            $ruta_img= 'imagen/no-imagen.jpg';
          }

          $imagenes = array();
          $dir = dir($dir_images);

          while(($archivo=$dir->read()) !== false){
            if($archivo != 'principal.jpg' && (strpos($archivo,'jpg') || strpos($archivo,'jpeg'))){
              $imagenes[] = $dir_images . $archivo;
            }
          }
          $dir -> close();
        }
      }else{
        echo 'Error al procesar la petición';
        exit; 
      }
    }


    

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Red Cites Privados Perú</title>
    <link rel="stylesheet" href="css/estilos.css">
    <!-- Bootstrap -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- ajax -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="css/estilos.css">
   

</head>
<body>
    
<header style="background-color:#1fae11">
  
  <div class="navbar navbar-expand-lg navbar-dark  shadow-sm">
    <div class="container">
      <a href="index.php" class="navbar-brand">
        <strong>RedCitesPrivadosPerú</strong>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <div class="collapse navbar-collapse" id="navbarHeader">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a href="apps.php" class="nav-link ">Apps</a>
              </li>
              
          </ul>
        </div>
    </div>
  </div>
</header>

<main style="min-height:90vh">
  <div class="container">
    <div class="album py-5 bg-body-tertiary">
      <div class="container">
        <div class="row principal_detalles">
          <div class="col-md-6 order-md-1 d-flex align-items-center justify-content-center">
            <div id="carouselImages" class="carousel slide">
              <div class="carousel-inner">
                <h2><?php echo $nombre;?></h2>
                <div class="carousel-item active">
                  <img src="imagen/productos/<?php echo $id; ?>/principal.jpg" alt="" class="img-fluid imagen_detalle" style="width:70vh; margin-bottom:20px;">
                </div>
                <?php foreach ($imagenes as $img) { ?>
                  <div class="carousel-item">
                    <img src="<?php echo $ruta_img; ?>" alt="" class="img-fluid imagen_detalle" style="width:50vh; margin-bottom:20px;">
                  </div>
                <?php } ?>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselImages" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselImages" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>
          <div class="col-md-6 order-md-2">
            <h2>Descripción</h2>
            <p class="lead">
              <?php echo $description ?>
            </p>

            <div class="d-grid gap-3 col-10 mx-auto">
            </div>
          </div>

        </div>
        <!-- Nuevas filas para el espacio de atención y cadena de atención -->
        <div class="row principal_detalles">
          <div class="col-md-12 order-md-1 d-flex align-items-center justify-content-center ms-5">
            <div class="col-md-12 ml-12 mt-4">
              <div class="no-aparece">
                <div class="d-flex justify-content-start align-items-end">
                  
                  <h2>Cadena de atención:</h2>
                  <p class="m-1 fs-3 text"><?php echo $chainAtention ?></p>
                </div>
                <div class="d-flex justify-content-start align-items-end">
                  <h2>Espacio de atención:</h2>
                  <p class="m-1 fs-3 text"><?php echo $spaceAtention ?></p>
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



 <!-- Boostrap -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  
    
</body>
</html>