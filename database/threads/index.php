<?php
    $base_path = substr(__DIR__, 0, strpos(__DIR__, 'database')) . '/database';
    require("{$base_path}/connection_info.php");

    // Create connection
    $conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
	
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$table = "posts";
	$columns = "*";
	
	$sql = "SELECT " . $columns . " FROM " . $table . ' WHERE post_id IS NULL AND category_id=' . $_GET['category_id'];
	$threads = $conn->query($sql);
	
	if ($_GET['category_id']) {
		if ($threads->num_rows > 0) {
			// output data of each row
			while($thread = $threads->fetch_assoc()) {
				$content = strlolen($thread['content']) >= 100 ? htmlspecialchars(substr($thread['content'], 0, 150)).'...'.'<a href="../threads/show.html.php?post_id='.$thread["id"].'">Ver más</a>' : $thread['content'];
				
				echo '<tr>
            <td class="text-center">
                <i class="fas fa-comments forum-icon"></i>
            </td>
            <td>
                <a href="../threads/show.html.php?post_id='.$thread["id"].'">'.$thread["title"].'</a>
                <p>'.$content.'</p>
            </td>
            <td class="text-center">
                100
            </td>
            <td class="text-center">
                350
            </td>
            <td>
                <a href="../threads/show.html.php">Último comentario publicado</a> <br>
                <span>Por: <a href="../profile/profile.html.php">Ethan Rivas</a></span>
                <p>Hoy 27/09/2021 - 11:33 AM</p>
            </td>
        </tr>';
			}
		} else {
			echo '<tr>
              <td colspan="5" class="text-center">
                  No hay hilos disponibles
              </td>
          </tr>';
		}
	} else {
		$conn->close();
		
		header("location: /404.html");
	}
	
	$conn->close();