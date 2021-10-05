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
	
	// Obtención del Hilo
	if (isset($_GET['post_id'])) {
		$query = "SELECT * FROM posts WHERE id='".$_GET['post_id']."'";
		$results = mysqli_query($conn, $query);
		$post = (object) $results->fetch_assoc();
	} else {
		header("location: ../../404.html");
	}
	
	// Área de Edición
	if (isset($_POST['submit']) && $_GET['post_id']) {
		$title = mysqli_real_escape_string($conn, $_POST['title']);
		$content = mysqli_real_escape_string($conn, $_POST['content']);
		
		if (empty($title)) {
			array_push($errors, "Se necesita un título para crear un hilo");
		}
		if (empty($content)) {
			array_push($errors, "Se necesita el contenido para crear un hilo");
		}

		$post_id = $_GET["post_id"];
		$query = "UPDATE posts SET title='$title', content='$content' WHERE id = '$post_id'";
		$results = mysqli_query($conn, $query);
		$conn->close();
		
		header("location: ../../pages/threads/show.html.php?post_id=$post_id");
	} else {
		header("location: /404.html");
	}