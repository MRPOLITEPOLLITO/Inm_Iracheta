<!DOCTYPE html>
<html lang="">
<head>
<title>Página de inicio</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="Slider/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
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
        <li><a href="InicioSesion.php" title="Login"><i class="fas fa-sign-in-alt"></i></a></li>
        <?php
          session_start();
          if(isset($_SESSION['userName'])){
        ?>
        <li><a href="Cerrar.php" title="Logout"><i class="fas fa-sign-out-alt"></i></a></li>
        <?php
          }
        ?>
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
        <li class="active"><a href="index.php">Inicio</a></li>
        <li><a href="Historia.html">Nosotros</a></li>
        <?php
          
          if(isset($_SESSION['userName'])){
          ?>
        <li><a class="drop" href="#">Admin</a>
          <ul>
            <li><a class="drop" href="#">Altas</a>
              <ul>
                <li><a href="Admin/AltaInm.php">Inmuebles</a></li>
                <li><a href="Admin/AltaSecc.php">Secciónes</a></li>
                <li><a href="Admin/AltaImg.php">Imagenes</a></li>
                <li><a href="Admin/AltaUser.php">Usuarios</a></li>
              </ul>
            </li>
            <li><a class="drop" href="#">Modificaciones</a>
              <ul>
              <li><a href="Admin/ModInm.php">Inmuebles</a></li>
                <li><a href="Admin/ModSecc.php">Secciónes</a></li>
                <li><a href="Admin/ModImg.php">Imagenes</a></li>
              </ul>
            </li>
            <li><a class="drop" href="#">Bajas</a>
              <ul>
              <li><a href="Admin/BajaInm.php">Inmuebles</a></li>
                <li><a href="Admin/BajaSecc.php">Secciónes</a></li>
                <li><a href="Admin/BajaImg.php">Imagenes</a></li>
                <li><a href="Admin/BajaUser.php">Usuarios</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <?php
          }
        ?>
        <li><a href="Contacto.html">Contacto</a></li>
      </ul>
    </nav>
  </header>
</div>

<div class="wrapper bgded overlay" style="background-image:url('images/IndexBack.jpg');">
  <div id="pageintro" class="hoc clear"> 
    
    <article>
      <h3 class="heading">Inmuebles Iracheta</h3>
      <p>¿Buscas adquirir una casa o algún activo? ¿Qué mejor que tu asesor inmobiliario de confianza?</p>
      <footer>
        <ul class="nospace inline pushright">
          <li><a class="btn" href="#Inmuebles">Inmuebles</a></li>
          <li><a class="btn inverse" href="#Objetivos">Objetivos</a></li>
        </ul>
      </footer>
    </article>
  </div>
</div>

<div class="wrapper row2">
  <section id="introblocks" class="hoc container clear"> 
    
    <ul class="nospace group">
      <li class="one_third first">
        <article class="rounded"><a href="Historia.html"><i class="fas fa-book"></i></a>
          <h6 class="heading underline">Acerca de nosotros</h6>
          <p>¿Te gustaría conocer más acerca de la inmobiliaria Iracheta? Presiona el icono para conocer nuestra historia.</p>
        </article>
      </li>
      <li class="one_third">
        <article class="rounded"><a href="#" onclick="return false;"><i class="fas fa-star"></i></a>
          <h6 class="heading underline">Misión</h6>
          <p>Queremos ofrecerte el mejor asesoramiento para ayudarte a encontrar la propiedad de tus sueños.</p>
        </article>
      </li>
      <li class="one_third">
        <article class="rounded"><a href="https://goo.gl/maps/qxzr3vkJSauCjHmU9"><i class="fas fa-location-arrow"></i></a>
          <h6 class="heading underline">Ubícanos</h6>
          <p>¿Te gustaría conocer nuestra ubicación? Presiona el incono para obtener más información.</p>
        </article>
      </li>
    </ul>

  </section>
</div>

<!--ooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo-->

<div class="wrapper row3">
  <section class="hoc container clear" id="Inmuebles"> 
    <div class="center btmspace-80">
      <h6 class="heading underline font-x2">Inmuebles</h6>
    </div>
    <ul id="latest" class="nospace group">
      <?php
      include_once "conexion.php";
      $con = mysqli_connect($server,$db_user,$db_pass);
      mysqli_select_db($con,$database);
      $query = "SELECT immovables_ID, Name, Description, Picture, Type, Date FROM inamovibles WHERE Availability = 1 ORDER BY Date DESC, immovables_ID DESC LIMIT 30";
      $res = mysqli_query($con, $query);
      $cont = 0;
      while($row = mysqli_fetch_assoc($res)){
        $timestamp = strtotime($row['Date']); 
        $newDate = date("d-m-Y", $timestamp );
        $texto = substr($row['Description'],0,77);
        ?>
          <li class="<?php echo ($cont % 3 == 0 || $cont ==0) ?  'one_third first' : 'one_third' ?>" style="margin: 10px;">
            <article>
              <figure style="height: 20em !important; vertical-aling: middle;"><a><center><img src="data:<?php echo $row['Type']; ?>;base64,<?php echo base64_encode($row['Picture']); ?>" alt="" style="max-height: 20.5em;"></center></a></figure>
              <div class="excerpt">
                <h6 class="heading"><?php echo $row['Name']; ?></h6>
                <ul class="nospace meta">
                  <li><i class="fas fa-user rgtspace-5"></i> <a href="#" onclick="return false;">Admin</a></li>
                  <li><i class="far fa-clock rgtspace-5"></i>
                    <time><?php echo $newDate; ?></time>
                  </li>
                </ul>
                <p style="height: 1.8em !important;"><?php echo $texto; ?> [<a href="#" onclick="return false;">&hellip;</a>]</p>
                <form action='Inmueble.php' method='post'>
                  <input type='hidden' name='ID_inm' value="<?php echo $row['immovables_ID']; ?>" />
                  <footer><input style="margin-top: 2em;" class="btn" type='submit' name='enviar' value='Más' /></footer>
                </form>
              </div>
            </article>
          </li>
        <?php
        $cont++;
      }
      mysqli_close($con);
      ?>
    </ul>
  </section>
</div>

<!--ooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo-->


<div class="wrapper bgded overlay" style="background-image:url('images/Empresa.jpg');">
  <section class="hoc container clear"> 
    
    <div class="center btmspace-80">
      <h6 class="heading underline font-x2">Caras de la empresa</h6>
    </div>
    <ul id="testimonials" class="nospace group btmspace-80">
      <li class="one_half first">
        <blockquote>Vemos a nuestros clientes como los invitados de una fiesta en la que nosotros somos los anfitriones. Nuestro trabajo es hacer que cada aspecto importante de la experiencia del consumidor sea un poco mejor.</blockquote>
        <figure class="clear"><img style="width: 7em;" class="circle" src="images/Fundador 1.jpg" alt="">
          <figcaption>
            <h6 class="heading">Yolanda Velázquez Iracheta</h6>
            <em>Presidente/ Fundadora</em></figcaption>
        </figure>
      </li>
      <li class="one_half">
        <blockquote>Se necesita humildad para darse cuenta que no sabemos todo, no dormirse en los laureles y saber que debemos seguir aprendiendo y observando. Si no lo hacemos, aseguramos que habrá una empresa que va iniciando que tomará nuestro lugar.</blockquote>
        <figure class="clear"><img style="width: 7em;" class="circle" src="images/Fundador 2.jpg" alt="">
          <figcaption>
            <h6 class="heading">Silvia Velázquez Iracheta</h6>
            <em>Director / Fundadora</em></figcaption>
        </figure>
      </li>
    </ul>
  </section>
</div>

<div class="wrapper row3">
  <section id="Objetivos">
  <main class="hoc container clear"> 
    <!-- main body -->
    
    <div class="center btmspace-80">
      <h6 class="heading underline font-x2">Objetivos</h6>
    </div>
    <ul class="nospace group overview btmspace-80">
      <li class="one_third">
        <article>
          <div class="clear"><a href="#"><i class="fas fa-hand-holding"></i></a>
            <h6 class="heading">Ayudar</h6>
          </div>
          <p>Tenemos como objetivo que nuestros clientes encuentren lo que buscan y más, para ello tendemos una mano amiga por parte de la inmobiliaria Iracheta.</p>
        </article>
      </li>
      <li class="one_third">
        <article>
          <div class="clear"><a href="#" onclick="return false;"><i class="fas fa-chess-queen"></i></a>
            <h6 class="heading">Confianza</h6>
          </div>
          <p>Pretendemos ser una empresa que transmita seguridad y confianza a nuestros clientes, ya que el cliente es lo más importante.</p>
        </article>
      </li>
      <li class="one_third">
        <article>
          <div class="clear"><a href="#"><i class="fas fa-cloud"></i></a>
            <h6 class="heading">Sueño</h6>
          </div>
          <p>Queremos que nuestros servicios lleguen y estén al alcance de cualquiera que los necesite, ser una empresa reconocida a nivel mundial.</p>
        </article>
      </li>
      <li class="one_third">
        <article>
          <div class="clear"><a href="#"><i class="fas fa-gem"></i></a>
            <h6 class="heading">Reputación </h6>
          </div>
          <p>Deseamos que nuestro servicio este a la altura de las expectativas del cliente y se nos reconozca por ello. Queremos se nos conceptualice como un estándar de calidad.</p>
        </article>
      </li>
      <li class="one_third">
        <article>
          <div class="clear"><a href="#"><i class="fas fa-leaf"></i></a>
            <h6 class="heading">Medio ambiente</h6>
          </div>
          <p>Nuestra idea es mejorar nuestros servicios conforme al crecimiento de la empresa para facilitar al cliente diseños de inmuebles amigables con el medio ambiente.</p>
        </article>
      </li>
      <li class="one_third">
        <article>
          <div class="clear"><a href="#"><i class="fas fa-sort-amount-up"></i></a>
            <h6 class="heading">Satisfacción</h6>
          </div>
          <p>Se desea ser cercanos a los clientes, poder ofrecer un servicio que se adecúe a las necesidades de cada uno y mejorar de manera constante con su la ayuda.</p>
        </article>
      </li>
    </ul>
    <!-- / main body -->
    <div class="clear"></div>
  </main>
  </section>
</div>

<div class="wrapper row2">
  <section class="hoc container clear"> 
    
    <div class="center btmspace-80">
      <h6 class="heading underline font-x2">Actividades</h6>
    </div>
    <ul class="nospace group">
      <li class="one_quarter first">
        <figure class="fixwidth"><a class="imgover btmspace-30 rounded"><img src="images/Venta.jpg" alt=""></a>
          <figcaption class="bold uppercase center">Venta</figcaption>
        </figure>
      </li>
      <li class="one_quarter">
        <figure class="fixwidth"><a class="imgover btmspace-30 rounded"><img src="images/Compra.jpg" alt=""></a>
          <figcaption class="bold uppercase center">Compra</figcaption>
        </figure>
      </li>
      <li class="one_quarter">
        <figure class="fixwidth"><a class="imgover btmspace-30 rounded"><img src="images/Renta.jpg" alt=""></a>
          <figcaption class="bold uppercase center">Renta</figcaption>
        </figure>
      </li>
      <li class="one_quarter">
        <figure class="fixwidth"><a class="imgover btmspace-30 rounded"><img src="images/Asesor.jpg" alt=""></a>
          <figcaption class="bold uppercase center">Asesoramiento</figcaption>
        </figure>
      </li>
    </ul>
    
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
            <p class="nospace btmspace-10" style="text-align:justify;"><a href="#" onclick="return false;">Como agentes inmobiliarias y, como seres humanos, nos comprometemos a brindar un servicio de calidad y un trabajo bien hecho, sin necesidad de engañar y/o seducir al proveedor o cliente con el que se hace el trato, teniendo la filosofía más importante en mente; ganar-ganar.</a></p>
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
</body>
</html>