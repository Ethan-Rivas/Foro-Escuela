<?php
    
    $base_path = substr(__DIR__, 0, strpos(__DIR__, 'database')) . '/database';
    require("{$base_path}/connection_info.php");
    
    // Create connection
    $conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    if ($_GET['category_id']) {
        $sql = "SELECT posts.*,
                count(comments.id) AS comments,
                CASE WHEN posts.updated_at > comments.updated_at
                    THEN posts.user_id
                    ELSE comments.user_id
                END AS user_id,
                CASE WHEN users.nickname IS NOT NULL
                    THEN users.nickname
                    ELSE users.email
                END AS user,
                CASE WHEN posts.created_at < posts.updated_at
                    THEN posts.created_at
                    ELSE posts.updated_at
                END AS last_activity_datetime,
                comments.title AS user_comment_title
                FROM posts
                LEFT JOIN posts AS comments ON comments.post_id = posts.id
                LEFT JOIN users ON comments.user_id = users.id
                WHERE posts.post_id IS NULL
                AND posts.category_id=" . $_GET['category_id'] . "
                GROUP BY posts.id";
        
        $threads = $conn->query($sql);
        if ($threads->num_rows > 0) {
            // output data of each row
            while ($thread = $threads->fetch_assoc()) {
                $thread = (object) $thread;
                $content = strlen($thread->content) >= 100 ? htmlspecialchars(substr($thread->content, 0, 150)) . '...' . '<a href="/pages/threads/show.html.php?post_id=' . $thread->id . '">Ver más</a>' : $thread->content;
                
                echo '<tr>
                        <td class="text-center comment-icon">
                            <i class="fas fa-comments forum-icon"></i>
                        </td>
                        <td>
                            <a href="/pages/threads/show.html.php?post_id=' . $thread->id . '">' . $thread->title . '</a>
                            <p>' . $content . '</p>
                        </td>
                        <td class="text-center comment-icon">
                            ' . $thread->comments . '
                        </td>';
                if ($thread->user_comment_title) {
                    echo '<td class="comments-info">
                                    <a href="/pages/threads/show.html.php?post_id=' . $thread->id . '">' . $thread->user_comment_title . '</a> <br>
                                    <span>Por: <a href="/pages/profile/profile.html.php?user_id=' . $thread->user_id . '">' . ($thread->user) . '</a></span>
                                    <p>' . ($thread->last_activity_datetime) . '</p>
                                  </td>';
                } else {
                    echo '<td class="comments-info">
                                    <a href="/pages/threads/show.html.php">No hay comentarios recientes</a>
                                  </td>';
                }
                echo '</tr>';
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