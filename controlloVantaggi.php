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

if($_POST['tipo']=='b'){
$sql = "INSERT INTO prog.vantaggio(descrizione, data, luogo, tipo, id_tessera, livello) 
VALUES('".$_POST['descrizione']."','".$_POST['data']."',null,'b',".$_POST['id_tessera'].",null)";
}else{
	if($_POST['tipo']=='o'&&($_POST['livello']!='base'&&$_POST['livello']!='oro'&&$_POST['livello']!='platino')){
		$sql = "INSERT INTO prog.vantaggio(descrizione, data, luogo, tipo, id_tessera, livello) 
		VALUES('".$_POST['descrizione']."','".$_POST['data']."',null,'o',".$_POST['id_tessera'].",null)";
	}else{
		if($_POST['tipo']=='o'&&($_POST['livello']=='base'||$_POST['livello']=='oro'||$_POST['livello']=='platino')){
			$sql = "INSERT INTO prog.vantaggio(descrizione, data, luogo, tipo, id_tessera, livello) 
			VALUES('".$_POST['descrizione']."','".$_POST['data']."',null,'o',null,'".$_POST['livello']."')";
		}else{
			if($_POST['tipo']=='e'){
				
				$sql="INSERT INTO prog.vantaggio(descrizione, data, luogo, tipo, id_tessera, livello) 
				VALUES('".$_POST['descrizione']."','".$_POST['data']."','".$_POST['luogo']."','e',null,'".$_POST['livello']."')";			
				$check=true;
			}else{
				header("Location:vantaggi.php");
			}		
		}
	}
}

$value = array();
$resource = pg_prepare($db, 0, $sql);
$resource = pg_execute($db, 0, $value);
$row = pg_fetch_array($resource, NULL, PGSQL_ASSOC);

if($check==true){
	$sql5 =pg_query("select count(*) from prog.tessera where livello='".$_POST["livello"]."'");
	$result=pg_result($sql5,0); //numero di utenti dello stesso livello dell'ultimo evento inserito			
	$sql5 =pg_query("select max(id_vantaggio) from prog.vantaggio where tipo='e'");
	$result1=pg_result($sql5,0); //è l'id dell'ultimo evento inserito
	
	$sql5 =pg_query("select * from prog.tessera where livello='".$_POST["livello"]."'");
	$cont=0; //conta tutti gli utenti a cui è arrivato il singolo invito
	while($row=pg_fetch_array($sql5)){
		$cont++;
		pg_query("insert into prog.partecipazione values(".$result1.",".$row[id_tessera].", default)");			
	}
	if($cont!=$result) echo('errore!'); //l'invito non è arrivato a tutti gli utenti dello stesso livello. controlla.
	$check=false;
	$cont=0;
}


header("Location:vantaggi.php");

close_connect($db);
?>

</div>
</body>
</html>
