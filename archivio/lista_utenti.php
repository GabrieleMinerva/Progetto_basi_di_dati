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
include_once('lib/navigation.php');


$sql = 'select * from prog.utente join prog.dipendente on utente.id=dipendente.cf union select * from prog.utente join prog.cliente on utente.id=cliente.cf;';	
$value = array();
$resource = pg_prepare($db, 0, $sql);
$resource = pg_execute($db, 0, $value);

if(pg_num_rows($resource) > 0){
	while($row = pg_fetch_assoc($resource)){
		echo('<div class="uk-form-row">');
		echo('<label>nome: '.$row['nome'].' - cognome: '.$row['cognome'].' - username: '.$row['username'].'</label>');
		echo('</div>');
	}
}else{
	echo("Non ci sono ancora utenti.<br>");
	//$_SESSION['tipo']=''; $_SESSION['tipo']=''; $_SESSION['logged']=false;
}
?>
