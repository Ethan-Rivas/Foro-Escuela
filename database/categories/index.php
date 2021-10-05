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
	
	$table = "categories";
	$columns = "*";
	
	$sql = "SELECT " . $columns . " FROM " . $table;
	$categories = $conn->query($sql);
	
	if ($categories->num_rows > 0) {
		// output data of each row
		while($category = $categories->fetch_assoc()) {
			if ($category["category_id"] == null) {
				echo '<tr>
                <th colspan="2">'.$category["title"].'</th>
                <th class="text-center"><i class="fas fa-book"></i></th>
                <th class="text-center"><i class="fas fa-comment-dots"></i></th>
                <th class=""><i class="fas fa-clock"></i></th>
            </tr>';
			} else {
				echo '<tr>
                <td class="text-center">
                    <i class="fas fa-comments forum-icon"></i>
                </td>
                <td>
                    <a href="pages/subcategories/index.html">'.$category["title"].'</a>
                    <p>'.$category["description"].'</p>
                </td>
                <td class="text-center">
                    100
                </td>
                <td class="text-center">
                    350
                </td>
                <td>
                    <a href="pages/threads/show.html">Última actividad publicada</a> <br>
                    <span>Por: <a href="pages/profile/profile.html">Ethan Rivas</a></span>
                    <p>Hoy 27/09/2021 - 11:33 AM</p>
                </td>
            </tr>';
			}
		}
	} else {
		echo '<tr>
              <td colspan="5" class="text-center">
                  No hay categorías disponibles
              </td>
          </tr>';
	}
	
	$conn->close();