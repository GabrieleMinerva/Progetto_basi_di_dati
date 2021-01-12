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
$digitale=$_POST['digitale'];														//se si inserisce si=digitale altrimenti no=non digitale
if($_POST['categoria']!=null){
	$categoria=$_POST['categoria'];
	$nome=$_POST['nome'];
	if($_POST['piattaforma']==''||$_POST['piattaforma']==NULL) $piattaforma=NULL;
	else $piattaforma=$_POST['piattaforma'];
	$modello=$_POST['modello'];
	$produttore=$_POST['produttore'];
	$data_uscita=$_POST['data_uscita'];
	if($_POST['genere']=='NULL') $genere=NULL;
	else $genere=$_POST['genere'];
	$copie=$_POST['copie'];
	$prezzo=$_POST['prezzo'];

	if($categoria=="gioco"){
	$sql=pg_query("select * from prog.prodotto where denominazione='$nome' and piattaforma='$piattaforma' and digitale='$digitale'" );
	if(pg_num_rows($sql)>0){
		echo('<p><b>Attenzione!</b> prodotto già presente in catalogo</p>');
		echo('<a href="inserimento.php">torna ad Inserimento</a>');
	}else{
		if($genere==NULL||$piattaforma==NULL||$modello!=NULL){
			echo('<p><b>Attenzione!</b> errore di inserimento</p>');
			echo('<a href="inserimento.php">torna ad Inserimento</a>');
		}else{
			$sql=pg_query("INSERT INTO prog.prodotto 
			VALUES (default,'$nome','$piattaforma','$genere','$produttore', NULL, '$data_uscita', '$categoria', '$digitale');");
			if($copie>0){
				for($i=0; $i<$copie; $i++)
					$sql=pg_query("INSERT INTO prog.copia 
					VALUES(default, (select MAX(id_prodotto) from prog.prodotto), true, 'nuovo', $prezzo);");    //ho tolto null
				echo('sono dentro');
			}
			echo('<p>Inserimento gioco avvenuto con successo!</p>');
			echo('<p>effetua un <b><a href="inserimento.php">nuovo inserimento</a></b></p>');
			echo('<p>vai a <b><a href="ritiro.php">ritiro</a></b></p>');
		}
	}
	}

	if($categoria=="console"){
	$sql=pg_query("select * from prog.prodotto where denominazione='$nome' and modello='$modello'");
	if(pg_num_rows($sql)>0){
		echo("$nome.' '.$modello");
		echo('<p><b>Attenzione!</b> prodotto già presente in catalogo</p>');
		echo('<a href="inserimento.php">aggiungi un nuovo prodotto</a>');
	}else{
		if($genere!=NULL||$piattaforma!=NULL){
			echo("qui");
			echo('<p><b>Attenzione!</b> errore di inserimento</p>');
			echo('<a href="inserimento.php">torna ad Inserimento</a>');
		}else{
		$sql=pg_query("INSERT INTO prog.prodotto 
		VALUES (default,'$nome',NULL,NULL,'$produttore', '$modello', '$data_uscita', '$categoria',null);");    //modifica da gabry aggiunto null
		if($copie>0)
				for($i=0; $i<$copie; $i++)
					$sql=pg_query("INSERT INTO prog.copia 
					VALUES(default, (select MAX(id_prodotto) from prog.prodotto), true, 'nuovo', $prezzo);");
			echo('<p>Inserimento console avvenuto con successo!</p>');
			echo('<p>effetua un <b><a href="inserimento.php">nuovo inserimento</a></b></p>');
			echo('<p>vai a <b><a href="ritiro.php">ritiro</a></b></p>');
		}
	}
	}
	
}

else{
	$prodotto=$_POST['prodotto'];
	$copie=$_POST['copie'];
	$prezzo=$_POST['prezzo'];
	for($i=0;$i<$copie;$i++) pg_query("insert into prog.copia values(default, $prodotto, true, 'nuovo', $prezzo) ");
	echo("insert into prog.copia values(default, $prodotto, true, 'nuovo', $prezzo) ");
	echo('<p>Inserimento copie avvenuto con successo!</p>');
	echo('<p>effetua un <b><a href="inserimento.php">nuovo inserimento</a></b></p>');
}	

?>

<?php	 
close_connect($db);
?>



</div>
</body>
</html>

