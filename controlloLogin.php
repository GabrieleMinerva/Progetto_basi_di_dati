<?php
session_start();
include_once('lib/functions.php'); 
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
$user=$_POST['user'];
$psw=$_POST['psw'];
$sql = pg_query("select * from prog.tessera where username = '$user' and psw = '$psw'");
$row = pg_fetch_assoc($sql);

if(isset($row["id_tessera"])){
	$_SESSION['user'] = $user;
	$_SESSION['pwd'] = $psw;	
	$_SESSION['logged'] = true;
	header("Location: index-user.php");
} 
else{
	$sql = pg_query("select * from prog.dipendente where username = '$user' and psw = '$psw'");
	$row = pg_fetch_assoc($sql);

	if(isset($row["cf"])){
		$_SESSION['user'] = $user;
		$_SESSION['pwd'] = $psw;	
		$_SESSION['logged-dip'] = true;
		header("Location: index-master.php");
		}	
	else{
		$_SESSION["logged"] = false;	
		header('Location: login.php');
		$_SESSION["warning"]="Attenzione: utente o password errati.";
	}
}
close_connect($db);
?>

</div>
</body>
</html>
