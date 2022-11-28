<?php
    function imgData($imagen, $con){
        $tipoArchivo = $imagen['type'];
        $nombreArchivo = $imagen['name'];
        $tamanoArchivo = $imagen['size'];
        $imagenSubida = fopen($imagen['tmp_name'], 'r');
        $binarios = fread($imagenSubida, $tamanoArchivo);
        $binarios = mysqli_escape_string($con, $binarios);
        $permitido = array("image/jpeg", "image/png");
        if(!in_array($tipoArchivo, $permitido)){
          die();
        }
        return $binarios;
      }
?>