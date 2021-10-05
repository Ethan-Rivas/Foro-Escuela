<header class="header">
	<?php
		session_start();
    
    echo '<a href="/" class="header__logo">UNISUR</a>';
  
		if (isset($_SESSION['email'])) {
			echo '
            <nav class="menu">
							<a href="/">Inicio</a>
							<a href="/pages/profile/profile.html.php">Perfil</a>
							<a href="/database/sessions/logout.php">Cerrar Sesión</a>
						</nav>';
		} else {
			echo '<nav class="menu">
							<a href="#">Inicio</a>
							<a href="/pages/sessions/login.html.php">Iniciar Sesión</a>
							<a href="/pages/sessions/register.html.php">Registrarse</a>
						</nav>';
		}
	?>
</header>

<?php