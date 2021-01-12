<?php
session_start();
include_once ('lib/functions.php'); 
$db = open_connect();
info();
?>

<!DOCTYPE html>
<html>
<head><?php include('lib/header.php'); ?></head>
<body>
<div class="uk-container">
<?php	 
include('lib/head2.php');
include_once('lib/navigation-master.php');
?>
<h2>Pannello di Amministrazione</h2>
<?php
if($_SESSION['logged-dip'] == true){
	//utente loggato come dipendente
	echo("<p>sessione attiva</p>");
}
else{
	//utente non loggato come dipendente
	echo("<p>errore login dipendente.<br><b><a href='login.php'> Vai alla pagina di Login</a></b></p>");
}

close_connect($db);
?>



</div>
</body>
</html>
