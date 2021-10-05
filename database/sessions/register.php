<?php
    require('./database/connection_info.php');

	session_start();

    // Create connection
    $conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
	
	// Verificar la conexión
	if ($conn->connect_error) {
		die("Conexión fallida: " . $conn->connect_error);
	}
	
	$errors = array();

	// Área de Registro
	if (isset($_POST['submit'])) {
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);
		$password_confirmation = mysqli_real_escape_string($conn, $_POST['password_confirmation']);
		
		if (empty($email)) { array_push($errors, "El email no puede estar vacío"); }
		if (empty($password)) { array_push($errors, "Se necesita una contraseña"); }
		if ($password != $password_confirmation) {
			array_push($errors, "La contraseña y la confirmación no coinciden");
		}
		
		// Verificar si no hay un usuario con ese correo existente
		$user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
		$result = $conn->query($user_check_query);
		$user = $result->fetch_assoc();
		
		if ($user) { // Si esl usuario ya existe
			if ($user['email'] === $email) {
				array_push($errors, "Ya existe una cuenta registrada con email");
			}
		}
		
		// Registrar usuario si no se presentaron errores
		if (count($errors) == 0) {
			$password = md5($password); // Encriptación de contraseña
			$query = "INSERT INTO users (email, password) VALUES('$email', '$password')";
			$an = $conn->query($query);
			
			$_SESSION['email'] = $email;
			$conn->close();
			
			header('location: ../../index.html.php');
		}
	}
