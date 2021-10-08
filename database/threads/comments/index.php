<?php
    
    // Create connection
    $conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "SELECT
          posts.*,
          users.nickname AS user_nickname,
          users.email AS user_email,
          users.facebook_url AS user_facebook_url,
          users.twitter_url AS user_twitter_url,
          users.image AS user_image,
          count(threads.id) AS user_threads
          FROM posts
          JOIN users
          LEFT JOIN posts AS threads ON threads.user_id = users.id AND threads.post_id IS NULL
          WHERE posts.post_id=" . $post->id . "
          AND threads.post_id IS NULL
          AND posts.user_id = users.id
          GROUP BY posts.id";
    
    $comments = $conn->query($sql);
    
    if ($comments->num_rows > 0) {
        // output data of each row
        while ($comment = $comments->fetch_assoc()) {
            $comment = (object)$comment;
            
            echo '<tr>
              <td class="text-center vertical-align-top user-info">';
            if ($comment->user_image) {
                echo '<div id="profileImagePreview" style="background-image: url(' . $comment->user_image . ');"></div>';
            } else {
                echo '<div id="profileImagePreview"
                        style="background-image: url(https://ui-avatars.com/api/?name=' . urlencode(
                    $comment->user_nickname ? $comment->user_nickname : $comment->user_email
                  ) . '&color=FFFFFF&background=a5d6a7);"></div>';
            }
            
            echo '<div class="mt-10">
                      <a href="/pages/profile/profile.html.php?user_id=' . $comment->user_id . '">' . ($comment->user_nickname ? $comment->user_nickname : $comment->user_email) . '</a> <br>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i> <br>
                      Hilos: <strong>' . $comment->user_threads . '</strong>
                  </div>
              </td>
              <td class="vertical-align-top">
              <div id="edit-thread" class="edit-comment">';
                if (isset($_SESSION['user']) && $comment->user_email === $_SESSION['user']['email']) {
                    echo '<a href="/pages/threads/edit.html.php?post_id=' . $comment->id . '">
                             <button class="btn btn-success">Editar</button>
                          </a>
                          
                          <a href="/database/threads/delete.php?post_id=' . $comment->id . '" onclick="return confirm(\'Seguro que desea eliminar este comentario?\');">
                            <button class="btn btn-success">Eliminar</button>
                          </a>';
            }
            
            echo '</div>
                  <h1 class="text-left">
										' . htmlspecialchars($comment->title) . '
									</h1>

                  <pre>' . htmlspecialchars($comment->content) . '</pre>
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