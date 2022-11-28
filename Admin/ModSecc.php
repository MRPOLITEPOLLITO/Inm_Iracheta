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
                  <a class="nav-item nav-link" href="#.php">Secciónes</a>
                  <a class="nav-item nav-link" href="ModImg.php">Imagenes</a>
                </div>
              </div>
            </nav>
				  </div>
			  </div>
		  </div>
	  </div>
   	<!-- contact section start -->
    <div class="collection_text">Modificar Sección</div>
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
                      if(isset($_POST['title']) && isset($_POST['icon'] ) && isset($_POST['text']) && $_POST['title'] != "" && $_POST['icon'] != "" && $_POST['text'] != "" && isset($_POST['id']) && $_POST['id'] != ""){
                        $con = mysqli_connect($server,$db_user,$db_pass);
                        mysqli_select_db($con,$database);
                        $query = "UPDATE section SET Title = '$_POST[title]', Icon = '$_POST[icon]', Text = '$_POST[text]' WHERE ID = $_POST[id]";
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
                          Falta rellenar campos / recuerde seleccionar una sección
                        </div>
                        <?php
                      }
                    }
                  ?>
                  <form method = "post" enctype="multipart/form-data">
                    <legend>Selecciona una sección</legend>
                    <select class="form-select" name="seccs" style="height: 4em; width: 100%;">
                    <?php
                        $con = mysqli_connect($server,$db_user,$db_pass);
                        mysqli_select_db($con,$database);
                        $query = "SELECT ID, Imm_ID, Name, Title FROM section A INNER JOIN inamovibles B ON A.Imm_ID = B.immovables_ID  ORDER BY Imm_ID ASC";
                        $drop = mysqli_query($con, $query);
                        $query = "SELECT Name FROM inamovibles";
                        $Inm = mysqli_query($con, $query);
                        while($resultados = mysqli_fetch_assoc($drop)){
                        ?>
                            <option value="<?php echo $resultados['ID']; ?>"><?php echo $resultados['Name']."-".$resultados['Imm_ID']."-.".$resultados['Title']; ?></option>
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
                      $query = "SELECT ID, Title, Icon, Text FROM section WHERE ID = $_POST[seccs]";
                      $res = mysqli_query($con, $query);
                      mysqli_data_seek($res, 0);
                      $info = mysqli_fetch_array($res);
                      mysqli_close($con);
                    }
                  ?>
                  <form method = "post" enctype="multipart/form-data">
                    <div class="form-group">
                      <input type="text" class="email-bt" placeholder="Título" name="title" required pattern="[A-Za-z0-9_-ñ ]{1,50}" title="Letras, números y máximo 50 caracteres" value="<?php echo isset($_REQUEST['cons'])? $info['Title'] : "" ?>">
                    </div>
                    <div class="form-group">
                      <input type="text" class="email-bt" placeholder="Icono" name="icon" required pattern="[a-zA-Z\-0-9 ]{1,35}" title="Letras, guiones y máximo 35 caracteres" value="<?php echo isset($_REQUEST['cons'])? $info['Icon'] : "" ?>">
                    </div>
                    <div class="form-group">
                      <textarea class="form-control" name="text" rows="5" placeholder="Texto" required maxlength="1000"><?php echo isset($_REQUEST['cons'])? $info['Text'] : "" ?></textarea>
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
            <iframe src="../pages/icons.html" width="100%" height="500em" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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