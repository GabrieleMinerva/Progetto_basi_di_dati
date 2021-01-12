st<?php
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
print("<h2>Catalogo</h2>");
$sql =pg_query('select * from prog.prodotto');
//$result=pg_result($sql);

if(pg_num_rows($sql) > 0){
	
	//VIDEOGIOCHI
	print("<h3>VIDEOGIOCHI</h3>");
	
	$sql =pg_query("select * from prog.copia natural join prog.prodotto WHERE categoria='gioco' and disponibile=true");
//	$result=pg_result($sql);
	
	if(pg_num_rows($sql)>0){
		
		echo('<div><table border=1>');
		echo('<th>cod.</th><th>nome</th><th>piattaforma</th><th>stato</th><th>prezzo</th><th>digitale</th>');
		while($row = pg_fetch_assoc($sql)){
			echo('<tr>');
			echo('<td>'.$row['id_copia'].'</td><td>'.$row['denominazione'].'</td><td>'.$row['piattaforma'].'</td>');
			echo('<td>'.$row['stato'].'</td><td>'.$row['prezzo'].'</td>'.'<td>'.$row['digitale'].'</td>');					//modificato da gabry
			echo('</tr>');
		}
		echo('</table></div>');
		
		
	}else echo('non ci sono videogiochi in catalogo.');
	
	
	//CONSOLE
	print("<h3>CONSOLE</h3>");
	
	$sql =pg_query("select * from prog.copia natural join prog.prodotto WHERE categoria='console'  and disponibile=true");
//	$result=pg_result($sql);
	
	if(pg_num_rows($sql)>0){
		
		echo('<div><table border=1>');
		echo('<th>cod.</th><th>produttore</th><th>nome</th><th>modello</th><th>stato</th><th>prezzo</th>');
		while($row = pg_fetch_assoc($sql)){
			echo('<tr>');
			echo('<td>'.$row['id_copia'].'</td><td>'.$row['produttore'].'</td><td>'.$row['denominazione'].'</td>');
			echo('<td>'.$row['modello'].'</td><td>'.$row['stato'].'</td><td>'.$row['prezzo'].'</td>');
			echo('</tr>');
		}
		echo('</table></div>');
			
	}else echo('non ci sono console in catalogo.');
	
}else{
	print("<h5>Non ci sono prodotti in catalogo</h5>");
}

close_connect($db);
?>

</div>
</body>
</html>
