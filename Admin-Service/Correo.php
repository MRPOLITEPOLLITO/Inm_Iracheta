<?php
    if(isset($_POST['submitR'])){
        $header = "Asunto - ".$_POST['asunto'];
        $destino = "brayan8003@gmail.com, 172817@upslp.edu.mx, 181014@upslp.edu.mx, 180626@upslp.edu.mx";
        $nombre ="Nombre: ".$_POST['name']." ".$_POST['secondname'];
        $telefono ="Número de teléfono: ".$_POST['number'];
        $email ="Correo: ".$_POST['email'];
        $mensaje = $nombre."\n".$telefono."\n".$email."\n\n".$_POST['comment'];
        mail($destino, $header, $mensaje, "Enviado desde la página de la inmobiliaria Iracheta");
        echo "<script> alert('Correo enviado exitosamente')</script>";
        echo "<script> setTimeout(\"location.href='Contacto.html'\",1000) </script>";
    }
    if(isset($_POST['submitC'])){
        $header = "Asunto - Comentario";
        $destino = "brayan8003@gmail.com, 172817@upslp.edu.mx, 181014@upslp.edu.mx, 180626@upslp.edu.mx";
        $nombre ="Nombre: ".$_POST['name'];
        $email ="Correo: ".$_POST['email'];
        $mensaje = $nombre."\n".$email."\n\n".$_POST['comment'];
        mail($destino, $header, $mensaje, "Enviado desde la página de la inmobiliaria Iracheta");
        echo "<script> alert('Correo enviado exitosamente')</script>";
        echo "<script> setTimeout(\"location.href='Historia.html'\",1000) </script>";
    }
?>