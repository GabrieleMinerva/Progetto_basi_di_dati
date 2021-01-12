<nav class="uk-navbar-container" uk-navbar>
    <div class="uk-navbar-left">
        <ul class="uk-navbar-nav">
            <li <?php if($_SERVER['PHP_SELF'] == '/progetto/index.php') echo('class="uk-active"'); ?> ><a href="index.php">Home</a></li>
			<li <?php if($_SERVER['PHP_SELF'] == '/progetto/login.php') echo('class="uk-active"'); ?> ><a href="login.php">Login</a></li>
	<!--	<li <?php if($_SERVER['PHP_SELF'] == '/progetto/logout.php') echo('class="uk-active"'); ?> ><a href="logout.php">Logout</a></li> /-->
			<li <?php if($_SERVER['PHP_SELF'] == '/progetto/registrazione.php') echo('class="uk-active"'); ?> ><a href="registrazione.php">Registrati</a></li>
        </ul>

    </div>
</nav>
