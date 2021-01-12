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

print("<h2>Storico</h2>");
	

$sql =pg_query("select * from prog.ordine natural join prog.copia order by id_fattura");
$result=pg_result($sql,0,0);

if(pg_num_rows($sql)>0){
		echo('<div><table border=1>');
		echo('<th>cod. fattura</th><th>data</th><th>tipo</th><th>cliente</th><th>id_copia</th><th>tot. ATTIVO</th><th>tot. PASSIVO</th>');
		while($row = pg_fetch_array($sql)){
			
			$id_fattura=$row['id_fattura'];
			$prodotto=$row['id_copia'];
			$tipo=$row['tipo'];
			$data=$row['data'];
			$cliente=$row['cf'];
			$prezzo=$row['prezzo'];
			$prezzo_ritiro=$row['prezzo_ritiro'];
			echo('<tr>');
			
			if(strcmp($tipo,'vendita')==0){
				echo("<td>$id_fattura</td><td>$data</td><td>$tipo</td><td>$cliente</td><td>$prodotto</td><td>$prezzo</td><td></td>");
			}
			else{
						
				echo("<td>$id_fattura</td><td>$data</td><td>$tipo</td><td>$cliente</td><td>$prodotto</td><td></td><td>$prezzo_ritiro </td>");
			}
			
			echo('</tr>');
		}
		echo('</table></div>');
}else echo('Nessuna fattura presente.');
close_connect($db);
?>

</div>
</body>
</html>
