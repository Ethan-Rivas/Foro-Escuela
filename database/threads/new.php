<?php
    
    if (isset($_SESSION['user'])) {
        $base_path = substr(__DIR__, 0, strpos(__DIR__, 'database')) . '/database';
        require("{$base_path}/connection_info.php");
        
        // Create connection
        $conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
        
        // Verificar la conexión
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $errors = array();
        
        // Área de Publicación
        if ($_GET["category_id"]) {
            $email = $_SESSION['user']['email'];
            $query = "SELECT users.*,
                      count(posts.id) AS threads
                      FROM users
                      LEFT JOIN posts ON posts.user_id = users.id AND posts.post_id IS NULL
                      WHERE email='$email'";
            $results = mysqli_query($conn, $query);
            $user = (object)$results->fetch_assoc();
            
            if (isset($_POST['submit'])) {
                $title = mysqli_real_escape_string($conn, $_POST['title']);
                $content = mysqli_real_escape_string($conn, $_POST['content']);
                
                if (empty($title)) {
                    array_push($errors, "Se necesita un título para crear un hilo");
                }
                if (empty($content)) {
                    array_push($errors, "Se necesita el contenido para crear un hilo");
                }
                
                if (count($errors) == 0) {
                    $category_id = $_GET["category_id"];
                    $date = date('Y-m-d h:i:s');
                    
                    $query = "INSERT INTO posts (title, content, user_id, category_id, created_at, updated_at) VALUES('$title', '$content', '$user->id', '$category_id', '$date', '$date')";
                    $results = mysqli_query($conn, $query);
                    $inserted_post_id = mysqli_insert_id($conn);
                    
                    $conn->close();
                    header("location: /pages/threads/show.html.php?post_id=" . $inserted_post_id);
                }
                
                $conn->close();
            }
        } else {
            $conn->close();
            header("location: /404.html");
        }
    } else {
        header("location: /404.html");
    }
