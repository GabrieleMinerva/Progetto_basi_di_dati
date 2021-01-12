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
$cf=$_POST['id_cliente'];
$_cf=$_POST['_cf'];
$_nome=$_POST['_nome'];
$_cognome=$_POST['_cognome'];
$_tel=$_POST['_tel'];
$tipo=$_POST['tipo'];

if($tipo=='vendita'){
	if($_cf<>NULL&&$_cf<>''){
		$sql2=pg_query("SELECT * FROM prog.persona WHERE cf='$_cf'");
		if (pg_num_rows($sql2)<=0){
			$sql =pg_query( "INSERT INTO prog.persona VALUES ('$_cf','$_nome','$_cognome','$_tel')");	
			echo("Acquirente aggiunto. ");
		} else echo("Codice fiscale già registrato. Reindirizzamento acquisto. ");
		$cf=$_cf;
	}
	$copia=$_POST['id_copia'];
	$sql1=pg_query("SELECT * FROM prog.copia WHERE id_copia=$copia");					
	if (pg_num_rows($sql1)>0){
		while($row=pg_fetch_row($sql1)){
		pg_query("INSERT INTO prog.ordine VALUES(default,$copia,'$tipo',default,'$cf')");
		pg_query("update prog.copia set disponibile=false WHERE id_copia=$copia;");
		break;
		}
		echo('<br>Prodotto venduto!');
	}
	else echo('<br>Errore! torna a <b><a href="vendita.php">Vendita</a></b><');
}

if($tipo=='ritiro'){
	$prodotto=$_POST['id_prodotto'];
	$prezzo_v=$_POST['prezzo_v'];
	$prezzo_r=$_POST['prezzo_r'];
	$tipo=$_POST['tipo'];
	pg_query("INSERT INTO prog.copia 
					VALUES(default, $prodotto, true, 'usato', $prezzo_v, $prezzo_r);");
	pg_query("INSERT INTO prog.ordine VALUES(default,(select MAX(id_copia) from prog.copia),'$tipo',default,'$cf');");
	
	echo("Prodotto ritirato!");
}
?>

<?php	 
close_connect($db);
?>
</div>
</body>
</html>

