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
<h2>Upgrade Utente</h2>
<?php
if(!isset($_POST['nuovo_livello'])){
	echo('
	<form action="upgrade.php" method="post">
		<p>cliente: </p>
				<select class="uk-select" name="cf">				
						<option value=""></option>
		');
	

		$sql=pg_query("Select * from prog.persona natural join prog.tessera");
		while($row = pg_fetch_assoc($sql)){
			$cf=$row['cf'];
			$nome=$row['nome'];
			$cognome=$row['cognome'];
			echo("<option value='$cf'>$nome $cognome</option>");
		}


	echo('		
				</select>
		<h>upgrade a</h>
		<select name="nuovo_livello">
			<option value="base">base</option>
			<option value="oro">oro</option>
			<option value="platino">platino</option>
		</select>
		</br>
		</br>
		<button type="submit">Conferma</button>
	</form>
	');
}else{
	$sql1=pg_query("select * from prog.tessera where cf='".$_POST['cf']."'");
	if(pg_num_rows($sql1)>0){	
	$sql2=pg_query("UPDATE prog.tessera SET livello='".$_POST["nuovo_livello"]."' where cf='".$_POST["cf"]."'");	
	$sql3=pg_query("select data_rinnovo from prog.tessera where where cf='".$_POST["cf"]."'");
	$row=pg_fetch_array('$sql3');
	echo($row[0]);
	$data_corrente=date("Y/m/d");
	$data_aggiornata = date('Y/m/d', strtotime("$data_corrente + 1 year"));
	if($_POST['nuovo_livello']=='oro'||$_POST['nuovo_livello']=='platino') $sql2=pg_query("UPDATE prog.tessera SET data_rinnovo='".$data_aggiornata."' where cf='".$_POST["cf"]."'");
	if($_POST['nuovo_livello']=='base') $sql2=pg_query("UPDATE prog.tessera SET data_rinnovo=NULL where cf='".$_POST["cf"]."'");
	echo('<h>Upgrade eseguito</h>');
	echo('<form method="get" action="upgrade.php">
    <br><button type="submit">nuovo Upgrade</button>
	</form>');
	unset($sql1);
	}else{
		echo('<h>utente non trovato</h>');
		echo('<form method="get" action="upgrade.php">
		<br><button type="submit">nuovo Upgrade</button>
		</form>');	
	}
	
}




/*
$cf=$_POST['cf'];
$sql= "select * from prog.tessera where cf='".$cf."'";	
$value = array();
$resource = pg_prepare($db, 0, $sql);
$resource = pg_execute($db, 0, $value);

if(pg_num_rows($resource) == 1){
	$row = pg_fetch_assoc($resource);
	echo('<div class="uk-form-row">');
	echo('<label>'.$row['nome'].' '.$row['cognome'].' - livello: '.$row['username'].'</label>');
	echo('UPGRADE a:');
	echo('
<form action="index-master.php" method="post">
	<select name="nuovo_livello">
		<option value="base">base</option>
		<option value="oro">oro</option>
		<option value="platino">platino</option>
	</select>
	<input type="hidden" name="result" value="true">
	<button type="submit">Conferma</button>
</form>
</div>
	');
	
$sql= "UPDATE livello where cf='".$cf."'";	
$value = array();
$resource = pg_prepare($db, 0, $sql);
$resource = pg_execute($db, 0, $value);
}else{
	echo("<h3>utente non esistente</h3>");
}
?>
<h3>UPGRADE UTENTE</h3>
<?php
if($_POST['result']!=true){
	echo('
<form action="upgrade.php" method="post">
<input type="text" placeholder="codice fiscale" name="cf">
<button type="submit">Cerca</button>
</form>
');
}else{
	echo("Upgrade eseguito a: ".$_POST['nuovo_livello']);
}
*/
close_connect($db);
?>
</div>
</body>
</html>

