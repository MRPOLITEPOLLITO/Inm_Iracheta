<?php
    session_start();
    if(!isset($_SESSION['userName'])){
        header('Location: ../index.php');
        exit;
    } 
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Altas</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" href="css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="images/fevicon.png" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <!-- owl stylesheets --> 
      <link rel="stylesheet" href="css/owl.carousel.min.css">
      <link rel="stylesheet" href="css/owl.theme.default.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
   </head>
   <!-- body -->
   <body class="main-layout">
    <div class="header_section header_main">
		  <div class="container">
			  <div class="row">
				  <div class="col-sm-3">
					  
				  </div>
				  <div class="col-sm-9">
					  <nav class="navbar navbar-expand-lg navbar-light bg-light">
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                  <a class="nav-item nav-link" href="../index.php">Inicio</a>
                  <a class="nav-item nav-link" href="AltaInm.php">Inmuebles</a>
                  <a class="nav-item nav-link" href="AltaSecc.php">Secciónes</a>
                  <a class="nav-item nav-link" href="#">Imagenes</a>
                  <a class="nav-item nav-link" href="AltaUser.php">Cuentas</a>
                </div>
              </div>
            </nav>
				  </div>
			  </div>
		  </div>
	  </div>
   	<!-- contact section start -->
    <div class="collection_text">Agregar imagen</div>
    <div class="layout_padding contact_section">
    	<div class="container">
    		<h1 class="new_text"><strong>Rellene los campos</strong></h1>
    	</div>
    	<div class="container-fluid ram">
    		<div class="row">
    			<div class="col-md-6">
    				<div class="email_box rounded">
              <div class="input_main">
                <div class="container">
                  <?php
                    include "imgScript.php";
                    include "../conexion.php";
                    if(isset($_REQUEST['guardar'])){
                      if(isset($_FILES['foto']['name'])){
                        $con = mysqli_connect($server,$db_user,$db_pass);
                        mysqli_select_db($con,$database);
                        $binarios = imgData($_FILES['foto'], $con);
                        $query = "INSERT INTO images (immovables_ID, Frase, Type, Picture) VALUES ('$_POST[Immov]', '$_POST[frase]', 'image/jpeg', '".$binarios."')";
                        $res = mysqli_query($con, $query);
                        if($res){
                          ?>
                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    <span class="sr-only">Close</span>
                                </button>
                                Insertado exitosamente
                            </div>
                          <?php
                        }else{
                          ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    <span class="sr-only">Close</span>
                                </button>
                                Error <?php echo mysqli_error($con); ?>
                            </div>
                          <?php
                        }
                        mysqli_close($con);
                      }else{
                        ?>
                        <div class="alert alert-primary alert-dismissible fade show" role="alert" style="background-color: pink; color: red">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                          </button>
                          Falta completar campos
                        </div>
                        <?php
                      }
                    }
                  ?>
                  <form method = "post" enctype="multipart/form-data">
                    <div class="form-group">
                        <legend>Selecciona un inmueble</legend>
                        <select class="form-select" name="Immov" style="height: 4em; width: 100%;">
                        <?php
                          $con = mysqli_connect($server,$db_user,$db_pass);
                          mysqli_select_db($con,$database);
                          $query = "SELECT immovables_ID , Name FROM inamovibles ORDER BY immovables_ID DESC";
                          $drop = mysqli_query($con, $query);
                          $query = "SELECT Name FROM inamovibles";
                          $Inm = mysqli_query($con, $query);
                          while($resultados = mysqli_fetch_assoc($drop)){
                          ?>
                              <option value="<?php echo $resultados['immovables_ID']; ?>"><?php echo $resultados['immovables_ID']."-".$resultados['Name']; ?></option>
                          <?php
                          }
                          mysqli_close($con);
                      ?>
                        </select>
                    </div>
                    <div class="form-group">
                      <input type="text" class="email-bt" placeholder="Frase" name="frase" required pattern="[A-Za-z0-9_-ñ ]{1,50}" title="Letras, números y máximo 50 caracteres">
                    </div>
                    <div class="form-group">
                      <legend>Selecciona una imagen</legend>
                      <input type="file" class="form-control-file" name="foto" accept="image/*" required>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary" name="guardar">Enviar</button>
                    </div>
                  </form>
                </div>
              </div>
    		    </div>
    			</div>
    			<div class="col-md-6">
    				<div class="shop_banner">
              <img src="../images/Inm.jpg" style="width: 200.5em;" class="rounded">
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
	<div class="copyright">2022 Todos los derechos reservados. <a href="https://www.upslp.edu.mx/">Proyectos UPSLP</a></div>
      <!-- Javascript files-->
    <script src="../layout/scripts/avoidR.js"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
    <script>
        $(document).ready(function(){
        $(".fancybox").fancybox({
        openEffect: "none",
        closeEffect: "none"
        });
         
         
        $('#myCarousel').carousel({
            interval: false
        });

        //scroll slides on swipe for touch enabled devices

        $("#myCarousel").on("touchstart", function(event){

            var yClick = event.originalEvent.touches[0].pageY;
            $(this).one("touchmove", function(event){

                var yMove = event.originalEvent.touches[0].pageY;
                if( Math.floor(yClick - yMove) > 1 ){
                    $(".carousel").carousel('next');
                }
                else if( Math.floor(yClick - yMove) < -1 ){
                    $(".carousel").carousel('prev');
                }
            });
            $(".carousel").on("touchend", function(){
                $(this).off("touchmove");
            });
        });
      </script> 
   </body>
</html>