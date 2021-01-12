<?php
session_start();
include_once ('lib/functions.php'); 
$db = open_connect();
info();
if($_SESSION['logged-dip'] == false) header("Location: login.php");
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
<?php
	echo('
	<h2>Prenotazione</h2>
	<form action="prenotazione_esito.php" method="post">
		<fieldset class="uk-fieldset">
			<div class="uk-margin">
				<p>prodotto: </p>
				<select class="uk-select" name="prodotto">				
						<option value=""></option>
	');
	$sql=pg_query("select * from prog.prodotto where data_uscita>current_date");
	while($row = pg_fetch_assoc($sql))
		echo("<option value=".$row['id_prodotto'].">".$row['denominazione']." ".$row['modello']." - ".$row['piattaforma']."</option>");
	
	echo('						
			</select>		
			<p>cliente: </p>
			<select class="uk-select" name="cliente">				
					<option value=""></option>
	');	
					
	$sql=pg_query("select * from prog.persona natural join prog.tessera");
	while($row = pg_fetch_assoc($sql)){
		$id_tessera=$row['id_tessera'];
		$nome=$row['nome'];
		$cognome=$row['cognome'];
		echo("<option value='$id_tessera'>$nome $cognome</option>");
	}
	echo('		
			</select>
        </div>

    </fieldset>
	<button class="uk-button uk-button-default uk-button-primary">Prenota</button>
</form>
	');

?>
<?php
close_connect($db);
?>

</div>
</body>
</html>
