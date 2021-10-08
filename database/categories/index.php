<?php
    
    $base_path = substr(__DIR__, 0, strpos(__DIR__, 'database')) . '/database';
    require("{$base_path}/connection_info.php");
    
    // Create connection
    $conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $table = "categories";
    $columns = "*";
    
    $sql = "SELECT categories.*,
          count(threads.id) AS threads,
          users.id AS user_id,
          CASE WHEN users.nickname IS NOT NULL
            THEN users.nickname
            ELSE users.email
          END AS user,
          threads.id AS last_activity_id,
          threads.title AS last_activity,
          CASE WHEN threads.created_at > threads.updated_at
            THEN threads.created_at
            ELSE threads.updated_at
          END AS last_thread_datetime
          FROM categories
          LEFT JOIN posts AS threads ON threads.category_id = categories.id AND threads.post_id IS NULL
          LEFT JOIN users ON threads.user_id = users.id
          GROUP BY categories.id";
    
    $categories = $conn->query($sql);
    
    if ($categories->num_rows > 0) {
        // output data of each row
        while ($category = $categories->fetch_assoc()) {
            if ($category["category_id"] == null) {
                echo '<tr>
                <th colspan="2">' . $category["title"] . '</th>
                <th class="text-center"><i class="fas fa-book"></i></th>
                <th class=""><i class="fas fa-clock"></i></th>
            </tr>';
            } else {
                echo '<tr>
                <td class="text-center comment-icon">
                    <i class="fas fa-comments forum-icon"></i>
                </td>
                <td>
                    <a href="/pages/subcategories/index.html.php?category_id=' . $category["id"] . '">' . $category["title"] . '</a>
                    <p>' . $category["description"] . '</p>
                </td>
                <td class="text-center comment-icon">
                    ' . $category["threads"] . '
                </td>';
                if ($category["last_activity"]) {
                    echo '<td class="comments-info">
                               <a href="/pages/threads/show.html.php?post_id=' . $category["last_activity_id"] . '">' . $category["last_activity"] . '</a> <br>
                               <span>Por: <a href="/pages/profile/profile.html.php?user_id=' . $category["user_id"] . '">' . $category["user"] . '</a></span>
                               <p>' . $category["last_thread_datetime"] . '</p>
                            </td>';
                } else {
                    echo '<td class="comments-info">
                               <a href="/pages/threads/show.html.php">No hay actividad reciente</a>
                            </td>';
                }
                echo '</tr>';
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