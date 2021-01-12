<?php
function info(){
	//if($_SESSION)
	//	echo("<p style=\"font-size: 20px; color: red\"><i>Logged as <b>".$_SESSION['user']."</b></i></p>");
	
	print_r($_SESSION);
	print("<br>");
	print_r($_POST);
	//print_r($_SERVER);
	
}


function open_connect() {
    include_once("conf/conf.php");
    $connection = "host=".host." dbname=".dbname." user=".user." password=".psw." port=".port; 
    return pg_connect($connection);
}

function close_connect($db) {
	return pg_close($db);  
}

?>
