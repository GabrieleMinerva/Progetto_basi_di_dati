<?php
session_start();
include_once ('lib/functions.php'); 
include('lib/head2.php');
include_once('lib/navigation-master.php');		
$db = open_connect();
info();
if($_SESSION['logged-dip'] ==false) header("Location: index.php");
$nome=$_POST['nome'];
$piattaforma=$_POST['piattaforma'];
$genere=$_POST['genere'];
$stato=$_POST['stato'];
$prezzo=$_POST['prezzo'];
$cf=$_POST['cf'];
$sql=pg_query("INSERT INTO prog.prodotto (id_prodotto,denominazione,piattaforma,genere,stato,prezzo,disponibilità,data_uscita) 
							VALUES (default,'$nome','$piattaforma','$genere','$stato','$prezzo',default,default);");					
$sql=pg_query("SELECT MAX(id_prodotto) AS m FROM prog.prodotto;");
$idprod=pg_result($sql,0);
echo $idprod;
$sqlt=pg_query("INSERT INTO prog.ordine VALUES (default,'$idprod','vendi',default,'$cf');");
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
