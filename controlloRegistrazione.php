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
$cf=$_POST['cf'];
$nome=$_POST['nome'];
$cognome=$_POST['cognome'];
$tel=$_POST['tel'];
$username=$_POST['user'];
$psw=$_POST['psw'];
$sql4=pg_query("select count(*) from (
	select username, psw from prog.tessera where username='$username'
	union
	select username, psw from prog.dipendente where username='$username'
	) as query_search_username
");
$row4=pg_fetch_assoc($sql4);
$sql5=pg_query("select count(*) from (select cf from prog.persona where cf='$cf') as  query_ricerca_cf");
$row5=pg_fetch_assoc($sql5);
//	$result4=pg_result($sql4,0);
//	$result5=pg_result($sql5);

	if($nome==''||$cognome==''||$tel==''||$psw=''){
		$_SESSION["warning"]='Attenzione: riempire tutti i campi sottostanti.';
			header("Location: registrazione.php");
	}else{
		if($row5['count']==0){
			if($row4['count']==0){
				$sql =pg_query( "INSERT INTO prog.persona VALUES ('$cf','$nome','$cognome','$tel')");
				$sql =pg_query( "INSERT INTO prog.tessera VALUES (default,'$cf','base','$username','$psw')");
				header("Location: login.php");
			}else{
				$_SESSION["warning"]='Attenzione: username già in uso!';
				header("Location: registrazione.php");
			}	
		}else{
			$_SESSION["warning"]="Attenzione: codice fiscale gia' registrato!";
			header("Location: registrazione.php");
		}
	}
close_connect($db);
?>

</div>
</body>
</html>
