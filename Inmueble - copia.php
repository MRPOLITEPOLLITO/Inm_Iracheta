<!DOCTYPE html>
<html lang="">
<head>
<?php
  include "conexion.php";
  $con = mysqli_connect($server,$db_user,$db_pass);
  mysqli_select_db($con,$database);
  $query = "SELECT immovables_ID, Name, Description, Details, Picture, Type, Map, Date FROM inamovibles WHERE immovables_ID = '$_POST[ID_inm]'";
  $res = mysqli_query($con, $query);
  mysqli_data_seek($res, 0);
  $info = mysqli_fetch_array($res);
  $map = str_replace("600", "100%", $info['Map']);
  $map = str_replace("450", "800em", $map);
  mysqli_close($con);
?>
<title>Inmueble | <?php echo $info['Name'];?> | </title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<link href="Slider/vendor/animate.css/animate.min.css" rel="stylesheet">
<link href="Slider/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="Slider/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link href="Slider/css/style.css" rel="stylesheet">
<link href="layout/styles/layout.css?v=<?php echo(rand()); ?>" rel="stylesheet" type="text/css" media="all">
</head>
<body id="top">
<div class="wrapper row0" style="background-color: black; color: white;">
  <div id="topbar" class="hoc clear">
    <div class="fl_left"> 
      <ul class="nospace">
        <li><i class="fas fa-phone rgtspace-5"></i>+52 444 814 0846</li>
        <li><i class="far fa-envelope rgtspace-5"></i>inmovi@live.com</li>
      </ul>
    </div>
    <div class="fl_right"> 
      <ul class="nospace">
        <li><a href="index.php"><i class="fas fa-home"></i></a></li>
      </ul>
    </div>
  </div>
</div>
<div class="wrapper row1">
  <header id="header" class="hoc clear">
    <div id="logo" class="fl_left"> 
      <h1><a href="index.php">Iracheta</a></h1>
    </div>
    <nav id="mainav" class="fl_right"> 
      <ul class="clear">
        <li><a href="index.php">Inicio</a></li>
        <li><a href="Contacto.html">Contacto</a></li>
      </ul>
    </nav>
  </header>
</div>

<div class="wrapper bgded overlay" style="background-image:url('../images/inmBacks9.jpg');">
  <div id="breadcrumb" class="hoc clear"> 
    <ul>
      <li><a href="#">Inicio</a></li>
      <li><a href="#">Inmuebles</a></li>
      <li><a href="#">Residencia <?php echo $info['immovables_ID'];?></a></li>
    </ul>
  </div>
</div>

<div class="wrapper row3">
  <main class="hoc container clear"> 
    <!-- main body -->
    <div class="content">
      <h1><?php echo $info['Name']; ?></h1> 
      <p><?php echo $info['Details']; ?></p>
    </div>      
  </main>
</div>


<div class="wrapper bgded overlay" style="background-image: url('data:<?php echo $info['Type']; ?>;base64,<?php echo base64_encode($info['Picture']); ?>')">
  <section class="hoc container clear"> 
    
    <div class="center btmspace-80">
      <h6 class="heading underline font-x2">Detalles del inmueble</h6>
    </div>
    <ul id="testimonials" class="nospace group btmspace-80">
      <?php
        $con = mysqli_connect($server,$db_user,$db_pass);
        mysqli_select_db($con,$database);
        $query = "SELECT Title, Text, Icon FROM section WHERE Imm_ID = '$_POST[ID_inm]'";
        $result = mysqli_query($con, $query);
        $cont = 0;
            while($rough = mysqli_fetch_assoc($result)){
              if($cont == 0 || $cont % 2 == 0){
              ?>
                <li class="one_half first" style="margin-bottom: 1em;">
                  <blockquote><?php echo $rough['Text']; ?></blockquote>
                  <figure class="clear">
                    <a href="#"><i class="<?php echo $rough['Icon']; ?>"></i></a>
                    <figcaption>
                      <h6 class="heading"><?php echo $rough['Title']; ?></h6>
                    </figcaption>
                  </figure>
                </li>
              <?php
              }else{
              ?>
                <li class="one_half" style="margin-bottom: 1em;">
                  <blockquote><?php echo $rough['Text']; ?></blockquote>
                  <figure class="clear">
                    <a href="#"><i class="<?php echo $rough['Icon']; ?>"></i></a>
                    <figcaption>
                      <h6 class="heading"><?php echo $rough['Title']; ?></h6>
                    </figcaption>
                  </figure>
                </li>
              <?php
              }
              $cont++;
            }
      ?>
    </ul>
  </section>
</div>

<div class="wrapper row2">
  <section class="hoc container clear"> 
    <div class="center btmspace-80">
      <h6 class="heading underline font-x2">Galería</h6>
    </div>
    <center><section id="slider" >
      <div class="slider-container">
        <div id="sliderCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
          <ol id="slider-carousel-indicators" class="carousel-indicators"></ol>
          
          <div class="carousel-inner" role="listbox">
            <?php
              $con = mysqli_connect($server,$db_user,$db_pass);
              mysqli_select_db($con,$database);
              $query = "SELECT Frase, Type, Picture FROM images WHERE immovables_ID = $info[immovables_ID]";
              
              $res = mysqli_query($con, $query);
              $cont = 0;
              while($row = mysqli_fetch_assoc($res)){
                if($cont == 0){
                ?>
                <div class="carousel-item active" style="background-image: url('data:<?php echo $row['Type']; ?>;base64,<?php echo base64_encode($row['Picture']); ?>')">
                  <div class="carousel-container">
                    <div class="container">
                      <h2 class="animate__animated animate__fadeInDown"><?php echo $row['Frase']; ?></h2>
                    </div>
                  </div>
                </div>
                <?php
                }else{
                ?>
                <div class="carousel-item" style="background-image: url('data:<?php echo $row['Type']; ?>;base64,<?php echo base64_encode($row['Picture']); ?>')">
                  <div class="carousel-container">
                    <div class="container" >
                      <h2 class="animate__animated animate__fadeInDown"><?php echo $row['Frase']; ?></h2>
                    </div>
                  </div>
                </div>
                <?php
                }
                $cont++;
              }
            ?>
          </div>

          <a class="carousel-control-prev" href="#sliderCarousel" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
          </a>
          <a class="carousel-control-next" href="#sliderCarousel" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
          </a>

        </div>
      </div>
    </section></center> 
  </section>
</div>
<div class="wrapper bgded overlay" style="background-image:url('images/inmBacks1.jpg');">
  <section class="hoc container clear"> 
    <div class="center btmspace-80">
      <h6 class="heading underline font-x2">Ubicación </h6>
    </div>
    <div class="center btmspace-80">
      <?php echo $map; ?>
    </div>
  </section>
</div>


<!----------------------------------------------------------------------------------------------------------------------------------->


<div class="wrapper row4">
  <footer id="footer" class="hoc clear"> 
    
    <div class="one_quarter first">
      <h6 class="heading">Datos de contacto</h6>
      <ul class="nospace linklist contact btmspace-30">
        <li><i class="fas fa-map-marker-alt"></i>
          <address>
          Tomasa Esteves, SLP, SLP &amp; #430, SLP, 78230, Local 2
          </address>
        </li>
        <li><i class="fas fa-phone"></i> +52 444 814 0846</li>
        <li><i class="far fa-envelope"></i>inmovi@live.com</li>
      </ul>
      <ul class="faico clear">
        <li><a class="faicon-facebook" href="https://www.facebook.com/inmobi.velazquez"><i class="fab fa-facebook"></i></a></li>
        <li><a class="faicon-instagram" href="#"><i class="fab fa-instagram"></i></a></li>
        <li><a class="faicon-whatss" href="https://wa.me/4448140846"><i class="fab fa-whatsapp"></i></a></li>
        <li><a class="faicon-twitter" href="#"><i class="fab fa-twitter"></i></a></li>
        <li><a class="user-ses" href="InicioSesion.php"><i class="fas fa-address-book"></i></a></li>
      </ul>
    </div>
    <div class="one_quarter">
      <h6 class="heading">Nuestro compromiso</h6>
      <ul class="nospace linklist">
        <li>
          <article>
            <p class="nospace btmspace-10" style="text-align:justify;"><a href="#">Como agentes inmobiliarias y, como seres humanos, nos comprometemos a brindar un servicio de calidad y un trabajo bien hecho, sin necesidad de engañar y/o seducir al proveedor o cliente con el que se hace el trato, teniendo la filosofía más importante en mente; ganar-ganar.</a></p>
            <time class="block font-xs" datetime="2045-04-06">Miércoles, 27<sup>th</sup> Abril 2022</time>
          </article>
        </li>
      </ul>
    </div>
    <div class="one_quarter">
      <h6 class="heading">Valores de la empresa</h6>
      <ul class="nospace linklist">
        <li><a>Honestidad</a></li>
        <li><a>Transparencia</a></li>
        <li><a>Excelencia</a></li>
        <li><a>Responsabilidad</a></li>
        <li><a>Pasión</a></li>
      </ul>
    </div>

    <div class="one_quarter">
      <h6 class="heading">Inmobiliaria Iracheta</h6>
      <ul class="nospace clear latestimg">
        <li><a class="imgover" href="#"><img src="images/9c_01.jpg" alt="iracheta"></a></li>
        <li><a class="imgover" href="#"><img src="images/9c_02.jpg" alt="iracheta"></a></li>
        <li><a class="imgover" href="#"><img src="images/9c_03.jpg" alt="iracheta"></a></li>
        <li><a class="imgover" href="#"><img src="images/9c_04.jpg" alt="iracheta"></a></li>
        <li><a class="imgover" href="#"><img src="images/9c_05.jpg" alt="iracheta"></a></li>
        <li><a class="imgover" href="#"><img src="images/9c_06.jpg" alt="iracheta"></a></li>
        <li><a class="imgover" href="#"><img src="images/9c_07.jpg" alt="iracheta"></a></li>
        <li><a class="imgover" href="#"><img src="images/9c_08.jpg" alt="iracheta"></a></li>
        <li><a class="imgover" href="#"><img src="images/9c_09.jpg" alt="iracheta"></a></li>
      </ul>
    </div>
    
  </footer>
</div>

<div class="wrapper row5">
  <div id="copyright" class="hoc clear"> 
    
    <p class="fl_left">Copyright &copy; 2022 - Todos los derechos reservados - <a href="#">Iracheta</a></p>
    <p class="fl_right">Proyectos <a target="_blank" href="https://www.upslp.edu.mx/upslp/" title="Universidad Politécnica de San Luis Potosí">UPSLP</a></p>
    
  </div>
</div>


<!----------------------------------------------------------------------------------------------------------------------------------->

<a id="backtotop" href="#top"><i class="fas fa-chevron-up"></i></a>

<!-- JS -->
<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>
<script src="Slider/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="Slider/js/main.js"></script>
</body>
</html>