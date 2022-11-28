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
      <title>Modificaciones </title>
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
                  <a class="nav-item nav-link" href="ModInm.php">Inmuebles</a>
                  <a class="nav-item nav-link" href="ModSecc.php">Secciónes</a>
                  <a class="nav-item nav-link" href="#">Imagenes</a>
                </div>
              </div>
            </nav>
				  </div>
			  </div>
		  </div>
	  </div>
   	<!-- contact section start -->
    <div class="collection_text">Modificar Imagenes</div>
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
                    include "../conexion.php";
                    if(isset($_REQUEST['guardar'])){
                      if(isset($_POST['frase']) && $_POST['frase'] != "" && isset($_POST['id']) && $_POST['id'] != ""){
                        $con = mysqli_connect($server,$db_user,$db_pass);
                        mysqli_select_db($con,$database);
                        if(isset($_FILES['foto']['name']) && $_FILES['foto']['name'] != ""){
                          $tipoArchivo = $_FILES['foto']['type'];
                          $nombreArchivo = $_FILES['foto']['name'];
                          $tamanoArchivo = $_FILES['foto']['size'];
                          $imagenSubida = fopen($_FILES['foto']['tmp_name'], 'r');
                          $permitido = array("image/jpeg", "image/png");
                          if(!in_array($tipoArchivo, $permitido)){
                            ?>
                              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                      <span class="sr-only">Close</span>
                                  </button>
                                  Error tipo de archivo no admitido
                              </div>
                            <?php
                            die();
                          }
                          $binarios = fread($imagenSubida, $tamanoArchivo);
                          $binarios = mysqli_escape_string($con, $binarios);
                          $query = "UPDATE images SET Frase = '$_POST[frase]', Type = '$tipoArchivo', Picture = '$binarios' WHERE ID = $_POST[id]" ;
                        }else{
                          $query = "UPDATE images SET Frase = '$_POST[frase]' WHERE ID = $_POST[id]" ;
                        }
                        if(mysqli_query($con, $query)){
                          ?>
                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    <span class="sr-only">Close</span>
                                </button>
                                Registro modificado exitosamente
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
                      }else{
                        ?>
                        <div class="alert alert-primary alert-dismissible fade show" role="alert" style="background-color: pink; color: red">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                          </button>
                          Falta rellenar campos y recuerde seleccionar primero una imagen
                        </div>
                        <?php
                      }
                    }
                  ?>
                  <form method = "post" enctype="multipart/form-data">
                    <legend>Selecciona una imagen</legend>
                    <select class="form-select" name="img" style="height: 4em; width: 100%;">
                    <?php
                        $con = mysqli_connect($server,$db_user,$db_pass);
                        mysqli_select_db($con,$database);
                        $query = "SELECT A.immovables_ID, Name, ID, Frase FROM inamovibles A INNER JOIN images B ON A.immovables_ID = B.immovables_ID ORDER BY A.immovables_ID DESC";
                        $drop = mysqli_query($con, $query);
                        while($resultados = mysqli_fetch_assoc($drop)){
                        ?>
                            <option value="<?php echo $resultados['ID']; ?>"><?php echo $resultados['immovables_ID']."-.".$resultados['Name']."-".$resultados['Frase']; ?></option>
                        <?php
                        }
                        mysqli_close($con);
                    ?>
                    </select>
                    <div class="form-group" style="margin-top:2em;">
                      <button type="submit" class="btn btn-primary" name="cons">Consultar</button>
                    </div>
                  </form>
                  <?php
                    if(isset($_REQUEST['cons'])){
                      $con = mysqli_connect($server,$db_user,$db_pass);
                      mysqli_select_db($con,$database);
                      $query = "SELECT ID, Frase FROM images WHERE ID = $_POST[img]";
                      $res = mysqli_query($con, $query);
                      mysqli_data_seek($res, 0);
                      $info = mysqli_fetch_array($res);
                      mysqli_close($con);
                    }
                  ?>
                  <form method = "post" enctype="multipart/form-data">
                  <div class="form-group">
                      <input type="text" class="email-bt" placeholder="Frase" name="frase" required value="<?php echo isset($_REQUEST['cons'])? $info['Frase'] : "" ?>">
                    </div>
                    <div class="form-group">
                      <legend>Selecciona una imagen</legend>
                      <input type="file" class="form-control-file" name="foto" accept="image/*" pattern="[A-Za-z0-9_-ñ ]{1,50}" title="Letras, números y máximo 50 caracteres">
                    </div>
                    <input name="id" type="hidden" value="<?php echo isset($_REQUEST['cons'])? $info['ID'] : "" ?>">
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary" name="guardar">Modificar</button>
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