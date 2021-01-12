<nav class="uk-navbar-container" uk-navbar>
    <div class="uk-navbar-left">
        <ul class="uk-navbar-nav">
            <li <?php if($_SERVER['PHP_SELF'] == '/progetto/index-user.php') echo('class="uk-active"'); ?> ><a href="index-user.php">Home</a></li>
            <li <?php if($_SERVER['PHP_SELF'] == '/progetto/catalogo.php') echo('class="uk-active"'); ?> ><a href="catalogo-user.php">Catalogo</a></li>
			<li <?php if($_SERVER['PHP_SELF'] == '/progetto/logout.php') echo('class="uk-active"'); ?> ><a href="logout.php">Logout</a></li>
        </ul>

    </div>
</nav>
