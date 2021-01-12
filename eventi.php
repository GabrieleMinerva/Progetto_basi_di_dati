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
print("<h2>Pannello di amministrazione</h2>");
if($_SESSION['logged'] == 'true'){	
	echo("<h3>dipendente: ".$_SESSION['nome']."</h3>");
}
else{
	echo('errore login dipendente!');
	//header('Location: login.php');
}

echo('<button type="button">Crea Evento</button><br><br>');
echo('<button type="button">Crea Buono</button><br><br>');
echo('<button type="button">Crea Offerta</button><br><br>');




close_connect($db);
?>



</div>
</body>
</html>
