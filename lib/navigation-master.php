<nav class="uk-navbar-container" uk-navbar>
    <div class="uk-navbar-left">
        <ul class="uk-navbar-nav">
            <li <?php if($_SERVER['PHP_SELF'] == '/progetto/index-master.php') echo('class="uk-active"'); ?> ><a href="index-master.php">Home</a></li>
			<li <?php if($_SERVER['PHP_SELF'] == '/progetto/catalogo-master.php') echo('class="uk-active"'); ?> ><a href="catalogo-master.php">Catalogo</a></li>
			<li <?php if($_SERVER['PHP_SELF'] == '/progetto/storico.php') echo('class="uk-active"'); ?> ><a href="storico.php">Storico</a></li>
			<li <?php if($_SERVER['PHP_SELF'] == '/progetto/vantaggi.php') echo('class="uk-active"'); ?> ><a href="vantaggi.php">Vantaggi</a></li>
			<li <?php if($_SERVER['PHP_SELF'] == '/progetto/ritiro.php') echo('class="uk-active"'); ?> ><a href="ritiro.php">Ritiro</a></li>
			<li <?php if($_SERVER['PHP_SELF'] == '/progetto/vendita.php') echo('class="uk-active"'); ?> ><a href="vendita.php">Vendita</a></li>
			<li <?php if($_SERVER['PHP_SELF'] == '/progetto/inserimento.php') echo('class="uk-active"'); ?> ><a href="inserimento.php">Inserimento</a></li>
			<li <?php if($_SERVER['PHP_SELF'] == '/progetto/prenotazione.php') echo('class="uk-active"'); ?> ><a href="prenotazione.php">Prenotazione</a></li>
			<li <?php if($_SERVER['PHP_SELF'] == '/progetto/upgrade.php') echo('class="uk-active"'); ?> ><a href="upgrade.php">Upgrade</a></li>
			<li <?php if($_SERVER['PHP_SELF'] == '/progetto/logout.php') echo('class="uk-active"'); ?> ><a href="logout.php">Logout</a></li>
        </ul>

    </div>
</nav>
