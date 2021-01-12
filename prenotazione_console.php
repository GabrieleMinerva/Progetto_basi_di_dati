<?php
session_start();
include_once ('lib/functions.php'); 
include('lib/head2.php');
include_once('lib/navigation-master.php');	
$db = open_connect();
info();
if($_SESSION['logged-dip'] == false) header("Location: index.php");
$nome=$_POST['nome'];
$produttore=$_POST['produttore'];
$modello=$_POST['modello'];
$stato=$_POST['stato'];
$prezzo=$_POST['prezzo'];
$data_uscita=$_POST['data_uscita'];
$id_tessera=$_POST['id_tessera'];
$sql=pg_query("INSERT INTO prog.prodotto (id_prodotto,denominazione,produttore,modello,stato,prezzo,disponibilità,data_uscita) 
							VALUES (default,'$nome','$produttore','$modello','prenot','$prezzo','false','$data_uscita');");
$sqlcf=pg_query("SELECT cf FROM prog.persona NATURAL JOIN prog.tessera WHERE id_tessera='$id_tessera'");
$cf=pg_result($sqlcf,0);
$sql=pg_query("SELECT MAX(id_prodotto) FROM prog.prodotto;");
$idprod=pg_result($sql,0);
pg_query("INSERT INTO prog.ordine VALUES (default,'$idprod','prenot',default,'$cf');");
pg_query("INSERT INTO prog.prenotazione VALUES (default,'$id_tessera','$idprod')");
?>

<!DOCTYPE html>
<html>
<head><?php include('lib/header.php'); ?></head>
<body>
<div class="uk-container">

<?php	 
close_connect($db);
?>



</div>
</body>
</html>
