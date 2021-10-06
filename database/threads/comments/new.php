<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

  // Create connection
  $conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
	
	// Verificar la conexión
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$errors = array();
	
	// Área de Publicación
	if (isset($_POST['submit']) && $_GET["post_id"]) {
		session_start();
		
		$title = mysqli_real_escape_string($conn, $_POST['title']);
		$content = mysqli_real_escape_string($conn, $_POST['content']);
		
		if (empty($title)) {
			array_push($errors, "Se necesita un título para crear un comentario");
		}
		if (empty($content)) {
			array_push($errors, "Se necesita el contenido para crear un comentario");
		}
		
		if (count($errors) == 0) {
			$email = $_SESSION['email'];
			$query = "SELECT * FROM users WHERE email='$email'";
			$results = mysqli_query($conn, $query);
			$user = (object) $results->fetch_assoc();
			
			if (mysqli_num_rows($results) == 1) {
				$query = "INSERT INTO posts (title, content, user_id, post_id) VALUES('$title', '$content', '$user->id', '".$_GET['post_id']."')";
				$results = mysqli_query($conn, $query);
				
				header("location: ../../pages/threads/show.html.php?post_id=".$_GET["post_id"]);
			} else {
				array_push($errors, "Error de asociación");
			}
		}
	}
