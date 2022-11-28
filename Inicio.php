<?php	session_start();
	include("conexion.php");
	$bandera=false;

    $captcha = $_POST['g-recaptcha-response'];
    $secretKey = '6Lesxe0fAAAAAHKIqUGVcDp6pMzOtDJu08hHfrRK';
	$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captcha");
	$atributos = json_decode($response, TRUE);
	
	if (isset($_POST['user']) && isset($_POST['pass']) && $_POST['user'] != "" && $_POST['pass'] != "" && $atributos['success']) {
		$conexion = mysqli_connect($server,$db_user,$db_pass)or die("Problemas en la conexion");
		if($conexion){
			mysqli_select_db($conexion,$database)or die("Problemas en la base de datos");
			$query = "SELECT * FROM accounts WHERE User='$_POST[user]' AND Password='$_POST[pass]';";
			if($registros = mysqli_query($conexion,$query)){
				$total_reg=mysqli_num_rows($registros);
				if($total_reg==1){
					$_SESSION['userName']=$_POST['user'];
					$_SESSION['pass']=$_POST['pass'];
					$bandera=true;
				}else{
					unset($_SESSION['contador']);
				}
			}
            mysqli_close($conexion);
		}
	}else{
		header('Location: InicioSesion.php');
	}
	if ($bandera){
		header('Location: index.php');
	}else{
		header('Location: InicioSesion.php');
	}
?>