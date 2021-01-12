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
<h2>Vendita</h2>
<form action="ordine.php" method="post">
    <fieldset class="uk-fieldset">
        <div class="uk-margin">
			<p>prodotto: </p>
			<select class="uk-select" name="id_copia">				
					<option value=""></option>		
					<?php 
						$sql=pg_query("select * from prog.copia natural join prog.prodotto where disponibile=true");
						while($row = pg_fetch_assoc($sql))
						echo("<option value=".$row['id_copia'].">".$row['denominazione']." ".$row['modello']." - ".$row['piattaforma']." ".$row['digitale']."</option>");
					?>			
			</select>		
			<p>cliente: </p>
			<select class="uk-select" name="id_cliente">				
					<option value=""></option>		
					<?php 
						$sql=pg_query("select * from prog.persona where cf NOT IN(select cf from prog.dipendente)");
						while($row = pg_fetch_assoc($sql)){
							$cf=$row['cf'];
							$nome=$row['nome'];
							$cognome=$row['cognome'];
							echo("<option value='$cf'>$nome $cognome</option>");
						}
					?>			
			</select>
			<input type="hidden" name="tipo" value="vendita">
			 <p><b>Attenzione!</b> Primo acquisto?</p>
			 <input type="text" placeholder="nome" name="_nome">
			 <input type="text" placeholder="cognome" name="_cognome">
			 <input type="text" placeholder="cf" name="_cf">
			 <input type="text" placeholder="tel" name="_tel">

        </div>

    </fieldset>
	
	<button class="uk-button uk-button-default uk-button-primary">Aggiungi</button>
</form>

<?php
close_connect($db);
?>

</div>
</body>
</html>

