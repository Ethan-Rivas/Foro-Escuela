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
	
	$sql = "SELECT " . $columns . " FROM " . $table . " WHERE post_id='".$post->id."'";
	$comments = $conn->query($sql);
	
	if ($comments->num_rows > 0) {
		// output data of each row
		while($comment = $comments->fetch_assoc()) {
			$comment = (object) $comment;
			
			echo '<tr>
              <td class="text-center vertical-align-top user-info">
                  <img src="https://ui-avatars.com/api/?name=Diego%20Garcia&color=FFFFFF&background=a5d6a7"
                       alt=""
                       width="150px"
                       height="150px;"
                       class="mt-10">

                  <div class="mt-10">
                      <a href="../../pages/profile/profile.html.php">Diego García</a> <br>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i> <br>
                      Hilos: <strong>2</strong>
                  </div>
              </td>
              <td class="vertical-align-top">
                  <h1 class="text-left">
										'.htmlspecialchars($comment->title).'
									</h1>

                  <pre>'.htmlspecialchars($comment->content).'</pre>
              </td>
         	 </tr>';
		}
	} else {
		echo '<tr>
              <td colspan="5" class="text-center">
                  No hay comentarios disponibles.
              </td>
          </tr>';
	}
	
	$conn->close();