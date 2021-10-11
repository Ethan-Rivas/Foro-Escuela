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
        
        // Recuperar Usuario
        $email = $_SESSION['user']['email'];
        $query = "SELECT * FROM users WHERE email='$email'";
        $results = mysqli_query($conn, $query);
        $user = (object)$results->fetch_assoc();
        
        $errors = array();
        
        if (isset($_POST['submit'])) {
            $image = mysqli_real_escape_string($conn, isset($_POST['image']) ? $_POST['image'] : '');
            $nickname = mysqli_real_escape_string($conn, $_POST['nickname']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $description = mysqli_real_escape_string($conn, $_POST['description']);
            $birthday = mysqli_real_escape_string($conn, $_POST['birthday']);
            $facebook_url = mysqli_real_escape_string($conn, $_POST['facebook_url']);
            $twitter_url = mysqli_real_escape_string($conn, $_POST['twitter_url']);
            
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
            $password_confirmation = mysqli_real_escape_string($conn, $_POST['password_confirmation']);
            
            if (empty($email)) {
                array_push($errors, "El email no puede estar vacío");
                return;
            }
            
            // Verificar si no hay un usuario con ese correo existente
            $user_check_query = "SELECT * FROM users WHERE email='$email' OR nickname='$nickname' LIMIT 1";
            $result = $conn->query($user_check_query);
            $found_user = (object)$result->fetch_assoc();
            
            if ($found_user) { // Si el usuario ya existe
                if ($user->nickname != $nickname && $found_user->nickname === $nickname) { // Validamos el nickname
                    array_push($errors, "Ya existe una cuenta registrada con ese nickname");
                }
                
                if ($user->email != $email && $found_user->email === $email) { // Validamos el correo
                    array_push($errors, "Ya existe una cuenta registrada con ese email");
                }
            }
            
            // Validar si la contraseña ingresada es igual a la contraseña almacenada
            if ($new_password) {
                if (md5($password) === $user->password) {
                    if ($new_password != $password_confirmation) {
                        array_push($errors, "La nueva contraseña y la confirmación no coinciden");
                    }
                } else {
                }
            }
            
            // Validamos si el usuario desea subir una imagen
            if (isset($_FILES["image"]) && $_FILES["image"]["name"]) {
                if (!file_exists($_SERVER['DOCUMENT_ROOT'] . "/img/profile-pictures/" . $user->id)) {
                    mkdir($_SERVER['DOCUMENT_ROOT'] . "/img/profile-pictures/" . $user->id, 0777, true);
                }
                
                $image_folder = "/img/profile-pictures/" . $user->id . "/" . uniqid() . "." . pathinfo(
                    $_FILES["image"]['name'],
                    PATHINFO_EXTENSION
                  );
                $filepath = $_SERVER['DOCUMENT_ROOT'] . $image_folder;
                
                if (!move_uploaded_file($_FILES["image"]["tmp_name"], $filepath)) {
                    array_push($errors, "Hubo un error al subir la imagen");
                }
            } else {
                $image_folder = $user->image;
            }
            
            // Registrar usuario si no se presentaron errores
            if (count($errors) == 0) {
                if ($new_password) {
                    $new_password = md5($new_password); // Encriptación de contraseña
                    $query = "UPDATE users SET nickname='$nickname', email='$email', description='$description', image='$image_folder', password='$new_password', birthday='$birthday', facebook_url='$facebook_url', twitter_url='$twitter_url' WHERE id='$user->id'";
                } else {
                    $query = "UPDATE users SET nickname='$nickname', email='$email', description='$description', image='$image_folder', birthday='$birthday', facebook_url='$facebook_url', twitter_url='$twitter_url' WHERE id='$user->id'";
                }
                
                $an = $conn->query($query);
                
                $query = "SELECT id, nickname, email  FROM users WHERE email='$email'";
                $user = mysqli_query($conn, $query);
                
                if (mysqli_num_rows($user) == 1) {
                    $_SESSION['user'] = $user->fetch_assoc();
                    $conn->close();
                    
                    header('location: /pages/profile/profile.html.php?user_id=' . $_SESSION["user"]["id"]);
                }
            }
        }
    } else {
        header("location: /404.html");
    }
    
    