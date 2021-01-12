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

print("<h2>Benvetuto nel Negozio!</h2>");
if(!isset($_SESSION['logged'])) echo("<a href='login.php'>Vai alla pagina di Login</a>");

close_connect($db);
?>

</div>
</body>
</html>
