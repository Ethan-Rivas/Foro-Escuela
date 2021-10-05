<?php
    require('../connection_info.php');

    // Create connection
    $conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
	
	// Verificar la conexión
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$errors = array();
	
	// Obtención del Hilo
	if (isset($_GET['post_id'])) {
		$post_id = $_GET['post_id'];
		$query = "SELECT * FROM posts WHERE id='$post_id'";
		$results = mysqli_query($conn, $query);
		
		if (mysqli_num_rows($results) == 1) {
			$post = (object) $results->fetch_assoc();
			$conn->close();
		} else {
			$conn->close();
			header("location: ../../404.html");
		}
	} else {
		$conn->close();
		header("location: /404.html");
	}
