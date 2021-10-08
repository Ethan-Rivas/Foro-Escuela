<header class="header">
    <?php
        if(!isset($_SESSION)) {
            session_start();
        }
    
        echo '<a href="/" class="header__logo">UNISUR</a>';
        
        if (isset($_SESSION["user"])) {
            echo '
            <nav class="menu">
							<a href="/">Inicio</a>
							<a href="/pages/profile/profile.html.php?user_id=' . $_SESSION["user"]["id"] . '">Perfil</a>
							<a href="/database/sessions/logout.php">Cerrar Sesión</a>
						</nav>';
        } else {
            echo '<nav class="menu">
							<a href="/">Inicio</a>
							<a href="/pages/sessions/login.html.php">Iniciar Sesión</a>
							<a href="/pages/sessions/register.html.php">Registrarse</a>
						</nav>';
        }
    ?>
</header>

<?php