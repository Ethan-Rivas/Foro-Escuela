<?php
    
    if(!isset($_SESSION)) {
        session_start();
    }
    
    if (isset($_SESSION["user"])) {
        $base_path = substr(__DIR__, 0, strpos(__DIR__, 'database')) . '/database';
        require("{$base_path}/connection_info.php");
        
        // Create connection
        $conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
        
        // Verificar la conexión
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $errors = array();
        
        // Área de Borrado
        if (isset($_GET["user_id"]) && $_SESSION["user"]["id"] === $_GET["user_id"]) {
            $query = "DELETE FROM users WHERE id=" . $_GET["user_id"];
            $results = mysqli_query($conn, $query);
            $conn->close();
            
            require_once('../../database/sessions/logout.php');
        } else {
            $conn->close();
            header("location: /404.html");
        }
    }
