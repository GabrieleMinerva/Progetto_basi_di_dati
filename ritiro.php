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
<h2>Ritiro</h2>
<form action="ordine.php" method="post">
    <fieldset class="uk-fieldset">
       <p><b>Attenzione!</b> Prodotto mancante in Catalogo? <a href="inserimento.php"><b>Fai prima l'inserimento</b></a></p>
        <div class="uk-margin">
			<p>prodotto:</p>
			<select class="uk-select" name="id_prodotto">				
					<option value=""></option>		
					<?php 
						$sql=pg_query("select * from prog.prodotto");
						while($row = pg_fetch_assoc($sql))
						echo("<option value=".$row['id_prodotto'].">".$row['denominazione']." ".$row['modello']." - ".$row['piattaforma']."</option>");
					?>			
			</select>		
			<p>condizioni:
			<select name="stato" >
					<option value="buono">buono</option>
					<option value="discreto">discreto</option>
					<option value="ottimo">ottimo</option>
				</select>
				</p>
			<input class="uk-input" type="text" placeholder="prezzo di ritiro" name="prezzo_r">
			<input class="uk-input" type="text" placeholder="prezzo di vendita" name="prezzo_v">
			<p>cliente: </p>
			<select class="uk-select" name="id_cliente">				
					<option value=""></option>		
					<?php 
						$sql=pg_query("select * from prog.persona natural join prog.tessera");
						while($row = pg_fetch_assoc($sql)){
							$cf=$row['cf'];
							$nome=$row['nome'];
							$cognome=$row['cognome'];
							echo("<option value='$cf'>$nome $cognome</option>");
						}
					?>			
			</select>
			<input type="hidden" value="ritiro" name="tipo">
        </div>
    </fieldset>
	
	<button class="uk-button uk-button-default uk-button-primary">Ritira</button>
</form>

<?php
close_connect($db);
?>

</div>
</body>
</html>
