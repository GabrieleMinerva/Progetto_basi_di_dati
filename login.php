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
?>
<form action="controlloLogin.php" method="post">
    <fieldset class="uk-fieldset">

       <h2>Login</h2>
       <?php
        if(isset($_SESSION['warning'])){
			echo("<b>".$_SESSION['warning']."</b>");
			unset($_SESSION['warning']);
		}     
        ?>
        <div class="uk-margin">
            <input class="uk-input" type="text" placeholder="User" name="user">
			<input class="uk-input" type="password" placeholder="Password" name="psw">
        </div>

    </fieldset>
	
	<button class="uk-button uk-button-default uk-button-primary">Login</button>
</form>

<?php
close_connect($db);
?>

</div>
</body>
</html>
