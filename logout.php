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

$_SESSION = array();
close_connect($db);

header("Location: index.php");
?>

</div>
</body>
</html>
