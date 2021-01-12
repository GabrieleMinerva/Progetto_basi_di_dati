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
<h2>Vantaggi</h2>
<form action="controlloVantaggi.php" method="post">
    <fieldset>

        <legend>NUOVO VANTAGGIO NOMINALE</legend>

        <div>
			<p>Crea nuovo/a</p>
			<input type="radio" name="tipo" value="b">Buono<br>
			<input type="radio" name="tipo" value="o">Offerta<br>
			<h>su tessera: </h><input type="text" placeholder="tessera" name="id_tessera">
			<input type="text" placeholder="descrizione" name="descrizione">
			<input type="text" placeholder="data" name="data">
			<input type="hidden" name="luogo" value="">
			<input type="hidden" name="livello" value="">
		<br>
		<br>
		<button type="submit">Conferma</button>
		</div>
    </fieldset>
</form>

<form action="controlloVantaggi.php" method="post">
    <fieldset>

        <legend>NUOVA OFFERTA SU LIVELLO</legend>
        <div>
			<p>Crea nuova Offerta </p>
			<h>su livello: </h>
			<select name="livello">
					<option value="base">base</option>
					<option value="oro">oro</option>
					<option value="platino">platino</option>
				</select>
			<input type="text" placeholder="descrizione" name="descrizione">
			<input type="text" placeholder="data" name="data">
			<input type="hidden" name="tipo" value="o">
			<input type="hidden" name="luogo" value="">
			<input type="hidden" name="id_tessera" value="">
		<br>
		<br>
		<button type="submit">Conferma</button>
		</div>
    </fieldset>
</form>

<form action="controlloVantaggi.php" method="post">
    <fieldset>

        <legend>NUOVO EVENTO</legend>

       <div>
			<p>Crea nuovo Evento </p>
			<h>su livello: </h>
			<select name="livello">
					<option value="base">base</option>
					<option value="oro">oro</option>
					<option value="platino">platino</option>
			</select>
			<input type="text" placeholder="descrizione" name="descrizione">
			<input type="text" placeholder="data" name="data">
			<input type="text" placeholder="luogo" name="luogo">
			<input type="hidden" name="tipo" value="e">
			<input type="hidden" name="id_tessera" value="">
		<br>
				<br>
		<button type="submit">Conferma</button>
		</div>
    </fieldset>
</form>

<?php	

close_connect($db);
?>



</div>
</body>
</html>
