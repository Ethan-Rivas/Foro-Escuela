<div class="mt-10">
    <?php
        if ($errors) {
            echo '<ul>';
            foreach ($errors as $error) {
                echo '<li>' . $error . '</li>';
            }
            echo '</ul>';
        }
    ?>
</div>
