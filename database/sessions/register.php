<?php
	session_start();
	
	$servername = "localhost";
	$nickname = "root";
	$password = "1234";
	$database = "foro_unisur";
	
	// Create connection
	$conn = new mysqli($servername, $nickname, $password, $database);
	
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$errors = array();

	// Register
	if (isset($_POST['submit'])) {
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);
		$password_confirmation = mysqli_real_escape_string($conn, $_POST['password_confirmation']);
		
		if (empty($email)) { array_push($errors, "Email is required"); }
		if (empty($password)) { array_push($errors, "Password is required"); }
		if ($password != $password_confirmation) {
			array_push($errors, "The two passwords do not match");
		}
		
		// first check the database to make sure
		// a user does not already exist with the same nickname and/or email
		$user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
		$result = $conn->query($user_check_query);
		$user = $result->fetch_assoc();
		
		if ($user) { // if user exists
			if ($user['email'] === $email) {
				array_push($errors, "Email already exists");
			}
		}
		
		// Finally, register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password);//encrypt the password before saving in the database
			
			$query = "INSERT INTO users (email, password) VALUES('$email', '$password')";
			$conn->query($query);
			
			$_SESSION['nickname'] = $email;
			$_SESSION['success'] = "You are now logged in";
			
			header('location: ../../index.html.php');
		}
	}
