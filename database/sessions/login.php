<?php
	session_start();

    require('./database/connection_info.php');

    // Create connection
    $conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
	
	// Verificar la conexión
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$errors = array();
	
	// Área de Registro
	if (isset($_POST['submit'])) {
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);
		
		if (empty($email)) {
			array_push($errors, "El email no puede estar vacío");
		}
		if (empty($password)) {
			array_push($errors, "Se necesita una contraseña");
		}
		
		if (count($errors) == 0) {
			$password = md5($password);
			$query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
			$results = mysqli_query($conn, $query);
			
			if (mysqli_num_rows($results) == 1) {
				$_SESSION['email'] = $email;
				$conn->close();
				
				header('location: ../../index.html.php');
			} else {
				$conn->close();
				array_push($errors, "El email y/o la contraseña estan incorrectos");
			}
		}
	}
