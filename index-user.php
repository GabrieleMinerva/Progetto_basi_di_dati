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
include_once('lib/navigation-user.php');

if($_SESSION['logged'] ==true){	
//utente loggato come cliente
	$sql=pg_query("select * from prog.tessera NATURAL JOIN prog.persona where username='".$_SESSION['user']."';");
	$row = pg_fetch_assoc($sql);
	$scad=$row['data_rinnovo'];
	$nome=$row['nome'];
	$tessera=$row['id_tessera'];
	$livello=$row['livello'];
	print("<h2>Benvetuto/a, $nome!</h2>");
	print("<h3>tessera: $tessera</h3>");
	print("<h3>profilo: $livello</h3>");
	if(isset($scad) && $scad!=NULL) print("<h3>scadenza: $scad </h3>");
	else print("<h3>scadenza: -</h3>");
//buoni

	$sql=pg_query("select id_vantaggio, descrizione, data  from prog.tessera join prog.vantaggio using(id_tessera) where tipo='b' and id_tessera=".$row["id_tessera"]."");
	$result=pg_result($sql,0);
	print("<h3>Buoni</h3>");
	if(pg_num_rows($sql)>0){
		
		echo("<div><table border=1><th>codice</th><th>descrizione</th><th>scadenza</th>");

		while($row1= pg_fetch_row($sql)){
			echo("<tr>");
			echo("<td>".$row1[0]."</td><td>".$row1[1]."</td><td>".$row1[2]."</td>");
			echo("</tr>");
			}
		echo("</table></div>");
	}
	else{
			echo("<p>nessun buono presente</p>");
		}
		
//offerte tessera
	$sql=pg_query("select id_vantaggio, descrizione, data  from prog.tessera join prog.vantaggio using(id_tessera) where tipo='o' and id_tessera=".$row["id_tessera"]."");
	$result=pg_result($sql,0);
	print("<h3>Offerte nominali</h3>");
	if(pg_num_rows($sql)>0){
		
		echo("<div><table border=1><th>codice</th><th>descrizione</th><th>scadenza</th>");

		while($row1= pg_fetch_row($sql)){
			echo("<tr>");
			echo("<td>".$row1[0]."</td><td>".$row1[1]."</td><td>".$row1[2]."</td>");
			echo("</tr>");
			}
		echo("</table></div>");
	}
	else{
			echo("<p>nessuna offerta nominale presente</p>");
		}

//offerte livello	
	$sql=pg_query("select id_vantaggio, descrizione, data  from prog.tessera join prog.vantaggio using(livello) 
		where tipo='o' and livello='".$row["livello"]."'");
	$result=pg_result($sql,0);
	print("<h3>Offerte su livello</h3>");
	if(pg_num_rows($sql)>0){
		echo("<div><table border=1><th>codice</th><th>descrizione</th><th>scadenza</th>");
		while($row1= pg_fetch_row($sql)){
			echo("<tr>");
			echo("<td>".$row1[0]."</td><td>".$row1[1]."</td><td>".$row1[2]."</td>");
			echo("</tr>");
			}
		echo("</table></div>");
	}else{
			echo("<p>nessuna offerta di livello presente</p>");
	}

//eventi	

	$sql=pg_query("select id_vantaggio, descrizione, data, luogo from prog.tessera join prog.partecipazione using(id_tessera)
		where id_tessera=");
	$result=pg_result($sql,0);
	print("<h3>Eventi</h3>");
	if(pg_num_rows($sql)>0){		
		echo("<div><table border=1><th>codice</th><th>descrizione</th><th>data</th><th>luogo</th>");
		while($row1= pg_fetch_row($sql)){
			echo("<tr>");
			echo("<td>".$row1[0]."</td><td>".$row1[1]."</td><td>".$row1[2]."</td><td>".$row1[3]."</td>");
			echo("</tr>");
			}
		echo("</table></div>");
	}
	else{
			echo("<p>nessun evento disponibile</p>");
		}
			
}else{
//utente non loggato come cliente
	echo('errore login cliente!');
	echo("<a href='login.php'>Vai alla pagina di Login</a>");
}

close_connect($db);
?>

</div>
</body>
</html>
