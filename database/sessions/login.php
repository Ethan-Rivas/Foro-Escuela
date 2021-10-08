<?php
    
    session_start();
    
    if (isset($_SESSION['user'])) {
        header('location: /');
    }
    
    $base_path = substr(__DIR__, 0, strpos(__DIR__, 'database')) . '/database';
    require("{$base_path}/connection_info.php");
    
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
            $query = "SELECT id, nickname, email  FROM users WHERE email='$email' AND password='$password'";
            $user = mysqli_query($conn, $query);
            
            if (mysqli_num_rows($user) == 1) {
                $_SESSION['user'] = $user->fetch_assoc();
                $conn->close();
                
                header('location: /');
            } else {
                $conn->close();
                array_push($errors, "El email y/o la contraseña estan incorrectos");
            }
        }
    }
