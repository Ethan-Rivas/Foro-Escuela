<?php
    
    if (isset($_SESSION['user'])) {
        // Create connection
        $conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
        
        // Verificar la conexión
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $errors = array();
        
        $email = $_SESSION['user']['email'];
        $query = "SELECT users.*,
                  count(posts.id) AS threads
                  FROM users
                  LEFT JOIN posts ON posts.user_id = users.id AND posts.post_id IS NULL
                  WHERE email='" . $_SESSION['user']['email'] . "'";
        
        $results = mysqli_query($conn, $query);
        $user = (object)$results->fetch_assoc();
        
        // Área de Publicación
        if (isset($_POST['submit']) && $_GET["post_id"]) {
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $content = mysqli_real_escape_string($conn, $_POST['content']);
            
            if (empty($title)) {
                array_push($errors, "Se necesita un título para crear un comentario");
            }
            
            if (empty($content)) {
                array_push($errors, "Se necesita el contenido para crear un comentario");
            }
            
            if (count($errors) == 0) {
                if (mysqli_num_rows($results) == 1) {
                    $date = date('Y-m-d h:i:s');
                    $query = "INSERT INTO posts (title, content, user_id, post_id, category_id, created_at, updated_at) VALUES('$title', '$content', '$user->id', '$post->id', '$post->category_id', '$date', '$date')";
                    $results = mysqli_query($conn, $query);
                    
                    header("location: /pages/threads/show.html.php?post_id=" . $post->id);
                } else {
                    array_push($errors, "Error de asociación");
                }
            }
        }
    }
