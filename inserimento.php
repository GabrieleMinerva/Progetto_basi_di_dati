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
<h2>Inserisci Copia</h2>
<form action="add_prod.php" method="post">
    <fieldset class="uk-fieldset">
		<div class="uk-margin">
			<p>prodotto: </p>
			<select class="uk-select" name="prodotto">				
				<option value=""></option>
				<?php
				$sql=pg_query("select * from prog.prodotto");
				while($row = pg_fetch_assoc($sql))
				echo("<option value=".$row['id_prodotto'].">".$row['denominazione']." ".$row['modello']." - ".$row['piattaforma']." ".$row['digitale']."</option>");
				?>
			</select>		
			<input class="uk-input" type="text" placeholder="numero copie" name="copie">
			<input class="uk-input" type="text" placeholder="prezzo cad." name="prezzo">
		</div>
    </fieldset>
	<button class="uk-button uk-button-default uk-button-primary">Aggiungi</button>
</form>

<h2>Inserisci Prodotto</h2>		
<form action="add_prod.php" method="post">
    <fieldset class="uk-fieldset">
        <div class="uk-margin">
			<p>categoria: 
			<select name="categoria">
					<option value="gioco">videogioco</option>
					<option value="console">console</option>			
				</select>
			</p>				
			<input class="uk-input" type="text" placeholder="nome" name="nome">
			<input class="uk-input" type="text" placeholder="piattaforma" name="piattaforma">
			<input class="uk-input" type="text" placeholder="modello" name="modello">
			<input class="uk-input" type="text" placeholder="produttore" name="produttore">
			<input class="uk-input" type="text" placeholder="data uscita" name="data_uscita">
			<br><p>genere: 
			<select name="genere" placeholder="genere">				
					<option value="NULL">-</option>
					<option value="avventura">avventura</option>
					<option value="arcade">arcade</option>
					<option value="horror">horror</option>
					<option value="kids">kids</option>
					<option value="sparatutto">sparatutto</option>
					<option value="simulazione">simulazione</option>
					<option value="rpg">rpg</option>					
				</select>
			</p>				
			<input class="uk-input" type="text" placeholder="numero copie" name="copie">
			<input class="uk-input" type="text" placeholder="prezzo cad." name="prezzo">
			<input class="uk-input" type="text" placeholder="versione" name="digitale">
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


