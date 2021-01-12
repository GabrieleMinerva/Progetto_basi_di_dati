<?php
session_start();
include_once ('lib/functions.php'); 
$db = open_connect();
info();
if($_SESSION['logged-dip'] == false) header("Location: login.php");
if(!$_POST)
	header("Location: login.php");
?>
<!DOCTYPE html>
<html>
<head><?php include('lib/header.php'); ?></head>
<body>
<div class="uk-container">
	
<?php	 
include('lib/head2.php');
include_once('lib/navigation-master.php');



	$id_tessera=$_POST['cliente'];
	$id_prodotto=$_POST['prodotto'];
	$sql1=pg_query("select * from prog.prenotazione where id_tessera=$id_tessera and id_prodotto=$id_prodotto;");
	if (pg_num_rows($sql1)>0){
		while($row1=pg_fetch_row($sql1)){
			echo("<p>Prenotazione gia' effettuata</b></p>");
			break;
		}
		echo('<a href="prenotazione.php">Torna a Prenotazione</a>');
	}
	else{
		
		pg_query("insert into prog.prenotazione values(default, $id_tessera, $id_prodotto);");
		$sql2=pg_query("select * from prog.prenotazione where id_tessera=$id_tessera and id_prodotto=$id_prodotto;");
		while($row2 = pg_fetch_assoc($sql2)){
				echo("<p>Prenotazione avvenuta con successo col codice: <b>".$row2['id_prenotazione']."</b></p>");
				break;
		}
		echo('<a href="prenotazione.php">Torna a Prenotazione</a>');
	}


?>
<?php
close_connect($db);
?>

</div>
</body>
</html>	
