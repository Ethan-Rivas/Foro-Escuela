<?php
    
    $base_path = substr(__DIR__, 0, strpos(__DIR__, 'database')) . '/database';
    require("{$base_path}/connection_info.php");
    
    // Create connection
    $conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
    
    // Verificar la conexión
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Recuperar Usuario
    if (isset($_GET['user_id'])) {
        $query = "SELECT * FROM users WHERE id=" . $_GET['user_id'];
        $results = mysqli_query($conn, $query);
        $user = (object)$results->fetch_assoc();
        
        // Recuperar Hilos del Usuario
        $table = "posts";
        $columns = "*";
        
        $sql = "SELECT " . $columns . " FROM " . $table . " WHERE post_id IS NULL AND user_id=" . $user->id . ' LIMIT 3;';
        $threads = $conn->query($sql);
        $sql = "SELECT " . $columns . " FROM " . $table . " WHERE post_id IS NOT NULL AND user_id=" . $user->id . ' LIMIT 3;';
        $comments = $conn->query($sql);
        
        $conn->close();
    } else {
        $conn->close();
        header("location: /404.html");
    }
    