<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

    require('./database/connection_info.php');

    // Create connection
    $conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
	
	// Verificar la conexión
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$errors = array();
	
	// Área de Publicación
	if (isset($_POST['submit']) && $_GET["category_id"]) {
		$title = mysqli_real_escape_string($conn, $_POST['title']);
		$content = mysqli_real_escape_string($conn, $_POST['content']);
		
		if (empty($title)) {
			array_push($errors, "Se necesita un título para crear un hilo");
		}
		if (empty($content)) {
			array_push($errors, "Se necesita el contenido para crear un hilo");
		}
		
		if (count($errors) == 0) {
			$email = $_SESSION['email'];
			$query = "SELECT * FROM users WHERE email='$email'";
			$results = mysqli_query($conn, $query);
			$user = (object) $results->fetch_assoc();
			
			if (mysqli_num_rows($results) == 1) {
				$category_id = $_GET["category_id"];
				$query = "INSERT INTO posts (title, content, user_id, category_id) VALUES('$title', '$content', '$user->id', '$category_id')";
				$results = mysqli_query($conn, $query);
				
				$query = "SELECT * FROM posts WHERE id = LAST_INSERT_ID()";
				$results = mysqli_query($conn, $query);
				$post = (object) $results->fetch_assoc();
				$conn->close();
				
				header("location: ../../pages/threads/show.html.php?post_id=$post->id");
			} else {
				$conn->close();
				array_push($errors, "Error de asociación");
			}
		}
	} else {
		$conn->close();
		header("location: /404.html");
	}
