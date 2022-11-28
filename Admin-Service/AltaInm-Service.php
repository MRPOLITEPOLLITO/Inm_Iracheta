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
      <style>
        #map{
            height: 70%;
            width: 100%:
        }
      </style>
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
                  <a class="nav-item nav-link" href="#">Inmuebles</a>
                  <a class="nav-item nav-link" href="AltaSecc.php">Secciónes</a>
                  <a class="nav-item nav-link" href="AltaImg.php">Imagenes</a>
                  <a class="nav-item nav-link" href="AltaUser.php">Cuentas</a>
                </div>
              </div>
            </nav>
				  </div>
			  </div>
		  </div>
	  </div>
   	<!-- contact section start -->
    <div class="collection_text">Alta de inmueble</div>
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
                    if(isset($_REQUEST['guardar'])){
                      if(isset($_FILES['foto']['name']) && isset($_POST['nombre']) && isset($_POST['mapa']) && isset($_POST['descripcion'] ) && $_POST['nombre'] != "" && $_POST['mapa'] != "" && $_POST['descripcion'] != "" ){
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
                        $date = date("y-m-d");
                        if(isset($_POST['disponible'])){
                            $disponible=1;
                        }else{
                            $disponible=0;
                        }
                        include_once "../conexion.php";
                        $textEdit = $_POST["editor"];
                        $map = $_POST["geometry"];
                        echo "<script>alert('".$map."')</script>";
                        $con = mysqli_connect($server,$db_user,$db_pass);
                        mysqli_select_db($con,$database);
                        $binarios = mysqli_escape_string($con, $binarios);
                        $query = "INSERT INTO inamovibles (Name, Description, Details, Picture, NameI, Type, Map, Date, Availability, WhoAdd) VALUES ('$_POST[nombre]', '$_POST[descripcion]', '".$textEdit."', '".$binarios."', '".$nombreArchivo."', '".$tipoArchivo."', '".$map."', '".$date."', '".$disponible."', '1')";
                        $res = mysqli_query($con, $query);
                        if($res){
                          ?>
                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    <span class="sr-only">Close</span>
                                </button>
                                Registro insertado exitosamente
                            </div>
                          <?php
                        }else{
                          ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    <span class="sr-only">Close</span>
                                </button>
                                Error <?php echo mysqli_error($con)." ".isset($_POST['disponible']); ?>
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
                          Falta rellenar campos
                        </div>
                        <?php
                      }
                    }
                  ?> 
                  <form method = "post" enctype="multipart/form-data">
                    <div class="form-group">
                      <input type="text" class="email-bt" placeholder="Nombre" name="nombre" required pattern="[A-Za-z0-9_-ñ ]{1,50}" title="Letras, números y máximo 50 caracteres">
                    </div>
                    <div class="form-group">
                      <input type="text" class="email-bt" placeholder="Dirección" id="place" name="mapa" required maxlength="800">
                    </div>
                    <div class="form-group">
                      <textarea class="form-control" name="descripcion" rows="3" placeholder="Descripción breve" maxlength="1000" required></textarea>
                    </div>
                    <div class="form-group">
                      <textarea id="texteditor"></textarea>
                    </div>
                    <div class="form-group">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="disponible">
                        <label class="form-check-label" for="disponible">Disponible</label>
                      </div>
                    </div>
                    <div class="form-group">
                      <legend>Selecciona una imagen</legend>
                      <input type="file" class="form-control-file" name="foto" accept="image/*" required>
                    </div>
                    <div class="form-group">
                      <input type="hidden" name="editor" id="editor" value="">
                    </div>
                    <div class="form-group">
                      <input type="hidden" name="geometry" id="geometry" value="">
                    </div>
                    <div class="form-group">
                      <button type="submit" onclick="setContent()" class="btn btn-primary" name="guardar">Enviar</button>
                    </div>
                  </form>  
                </div>                   
              </div>
    		    </div>
    			</div>
          <div class="col-md-5">
            <div id="map" class="rounded"></div>
          </div>
    		</div>
    	</div>
    </div>
	<div class="copyright">2022 Todos los derechos reservados. <a href="https://www.upslp.edu.mx/">Proyectos UPSLP</a></div>
      <!-- Javascript files-->
      <script src="../layout/scripts/avoidR.js"></script>
      <script src="https://cdn.tiny.cloud/1/wt5ttjbcyw4wh1ji20ezt3n923qjpz2tktxp23250va2kgvw/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
      <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-IQcMgHDbU2PWoU46G64uKN2yxACj304&libraries=places&callback=initMap"></script>
      <script>
        tinymce.init({
          selector: '#texteditor',
          height: 700,
          plugins: [
            'advlist','autolink',
            'lists','link','image','charmap','preview','anchor','searchreplace','visualblocks',
            'fullscreen','insertdatetime','media','table','help','wordcount'
          ],
          toolbar: 'undo redo | formatpainter casechange blocks | bold italic backcolor | ' +
            'alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist checklist outdent indent | removeformat | a11ycheck code table help'
        });
      </script>
      <script src="helper.js"></script>
      <script>
      </script>
   </body>
</html>