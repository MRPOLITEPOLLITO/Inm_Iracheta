<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="">
<head>
<title>Sesión</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="Slider/vendor/animate.css/animate.min.css" rel="stylesheet">
<link href="Slider/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="Slider/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link href="Slider/css/style.css?v=<?php echo(rand()); ?>" rel="stylesheet">
<link href="layout/styles/layout.css?v=<?php echo(rand()); ?>" rel="stylesheet" type="text/css" media="all">
<style>
  .hovertext {
    position: relative;
    border-bottom: 1px dotted black;
  }
  .hovertext:before {
    content: attr(data-hover);
    visibility: hidden;
    opacity: 0;
    width: max-content;
    background-color: white;
    color: #000;
    text-align: center;
    border-radius: 5px;
    padding: 5px 5px;
    transition: opacity 1s ease-in-out;

    position: absolute;
    z-index: 1;
    left: 0;
    top: 110%;
  }
  .hovertext:hover:before {
  opacity: 1;
  visibility: visible;
  }
</style>
</head>
<body id="top">
<div class="wrapper row1">
  <header id="header" class="hoc clear">
    <div id="logo" class="fl_left"> 
      <h1><a href="index.php">Iracheta</a></h1>
    </div>
    <nav id="mainav" class="fl_right"> 
      <ul class="clear">
        <li><a href="index.php">Inicio</a></li>
        <li><a href="Cerrar.php">Cerrar</a></li>
      </ul>
  </header>
</div>

<div class="wrapper bgded overlay" style="background-image:url('../images/demo/backgrounds/01.png');">
  <div id="breadcrumb" class="hoc clear"> 
    <ul>
      <li><a href="#">Sesión</a></li>
    </ul>
  </div>
</div>

<div class="wrapper row3">
  <main class="hoc container clear"> 
    <div class="content"> 
      <div class="one_half first" id="comments">
        <h2>Inicio de sesión</h2>
        <form id="login" action="Inicio.php" method="post">
          <div class="">
            <label for="user">Usuario <span>*</span></label>
            <input type="text" name="user" id="user" value="" size="22" required pattern="[A-Za-z0-9_-]{1,50}">
          </div>
          <div class="">
            <label for="email">Contraseña<span>*</span></label>
            <input type="password" name="pass" id="pass" value="" size="22" required pattern="[A-Za-z0-9_-]{1,50}">
          </div>
          <div>
            <div class="g-recaptcha" data-sitekey="6Lesxe0fAAAAABGx4ZRCLtfyDtgSN_8Z3PRypDLG"></div>
          </div>
          <div>
            <input type="submit" name="submit" value="Continuar">
          </div>
        </form>
      </div>
      <div class="one_half " id="comments">
        <span class="hovertext" data-hover="Sección restringida">
          <center><img class="rounded" src="images/sesion.jpg"></center>
        </span>
      </div>
    </div>
  </main>
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

<script src="https://www.google.com/recaptcha/api.js" async defer></script>

</body>
</html>