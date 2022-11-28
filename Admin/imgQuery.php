<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Image submit</title>
</head>
<body>
    <!--Trozo de codigo para insertar una imagen como binario en una base de datos-->
    <?php
        include "https://raw.githubusercontent.com/MRPOLITEPOLLITO/binImage/main/imgScript.php";
        include "conexion.php";
        $con = mysqli_connect($server,$db_user,$db_pass);
        mysqli_select_db($con,$database);
        if(isset($_REQUEST['guardar'])){
            if(isset($_FILES['image']['name'])){
                $binarios = imgData($_FILES['image'], $con);
                $query = "INSERT INTO img (type, picture) VALUES ('image/jpeg', '".$binarios."')";
                $res = mysqli_query($con, $query);
            }
        }
        mysqli_close($con);
    ?>
    <!--formulario de ejemplo-->
    <div style="margin: 80px;">
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleInputEmail1">Imagen</label>
                <input type="file" class="form-control-file" name="image">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" name="guardar">Enviar</button>
            </div>
        </form>
    </div>
    <!--trozo de codigo para mostrar las imagenes en la base de datos-->
    <?php
        $con = mysqli_connect($server,$db_user,$db_pass);
        mysqli_select_db($con,$database);
        $query = "SELECT * FROM img LIMIT 5";
        $res = mysqli_query($con, $query);
        while($row = mysqli_fetch_assoc($res)){
            ?>
            <center><img src="data:<?php echo $row['type']; ?>;base64,<?php echo base64_encode($row['picture']); ?>" alt="" style="max-height: 20.5em;"><br><br></center>
            <?php
        }
        mysqli_close($con);
    ?>
</body>
</html>