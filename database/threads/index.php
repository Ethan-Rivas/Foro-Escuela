<?php
	$servername = "localhost";
	$username = "root";
	$password = "1234";
	$database = "foro_unisur";
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $database);
	
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$table = "threads";
	$columns = "*";
	
	$sql = "SELECT " . $columns . " FROM " . $table . 'WHERE post_id = null';
	$threads = $conn->query($sql);
	
	if ($threads->num_rows > 0) {
		// output data of each row
		while($thread = $threads->fetch_assoc()) {
			echo '<tr>
            <td class="text-center">
                <i class="fas fa-comments forum-icon"></i>
            </td>
            <td>
                <a href="../threads/show.html">'.$thread['title'].'</a>
                <p>'.$thread['description'].'</p>
            </td>
            <td class="text-center">
                100
            </td>
            <td class="text-center">
                350
            </td>
            <td>
                <a href="../threads/show.html">Último comentario publicado</a> <br>
                <span>Por: <a href="../profile/profile.html">Ethan Rivas</a></span>
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
	
	$conn->close();