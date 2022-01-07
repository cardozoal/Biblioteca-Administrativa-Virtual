<?php
	require "../db_connect.php";
	require "../message_display.php";
	require "../verify_logged_out.php";
	require "../header.php";
?>

<html>
	<head>
		<title>Ingreso Administrador</title>
		<link rel="stylesheet" type="text/css" href="../css/global_styles.css">
		<link rel="stylesheet" type="text/css" href="../css/form_styles.css">
		<link rel="stylesheet" type="text/css" href="css/index_style.css">
	</head>
	<body>
		<form class="cd-form" method="POST" action="#">
		
		<legend>Ingreso Administrador</legend>
		
			<div class="error-message" id="error-message">
				<p id="error"></p>
			</div>
			
			<div class="icon">
				<input class="l-user" type="text" name="l_user" placeholder="Usuario" required />
			</div>
			
			<div class="icon">
				<input class="l-pass" type="password" name="l_pass" placeholder="Contraseña" required />
			</div>
			
			<input type="submit" value="Ingresar" />
			
		</form>
	</body>
	
	<?php
		error_reporting(0);
		if(isset($_POST['l_user']))
		{
			$query = $con->prepare("SELECT id FROM librarian WHERE username = ? AND password = ?;");
			$query->bind_param("ss", $_POST['l_user'], sha1($_POST['l_pass']));
			$query->execute();
			if(mysqli_num_rows($query->get_result()) != 1)
				echo error_without_field("Nombre de usuario y contraseña incorrectos");
			else
			{
				$_SESSION['type'] = "librarian";
				$_SESSION['id'] = mysqli_fetch_array($result)[0];
				$_SESSION['username'] = $_POST['l_user'];
				header('Location: home.php');
			}
		}
	?>
	
</html>