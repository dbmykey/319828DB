<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>PHP Index Datei</title>
		
    </head>

    <body>
        <h1>Beispiel index - Datei</h1>
		
		
		<?php
			echo 'ich bin php';
			
			$server 	= 'localhost';
			$user 		= 'root';
			$password 	= '';
			$dbname		= 'world';
			
			/* Mit den Zugangsdaten die Verbindung zu Server und Datenbank herstellen */
			$conn 		= mysqli_connect($server, $user, $password, $dbname);
			
			if(!$conn)		/* Die Verbindung konnte nicht hergestellt werden */
				die('Das ging schief'); // Also alles abbrechen
			
			/* Formulierung einer Abfrage, die mehrere Datensätze liefert */ 
			$sql 	= 'SELECT * FROM Country';
			$result = mysqli_query($conn, $sql); // Resultat, aber noch keine Datensätze
			if($result) {
				echo '<pre>';
				print_r($result);
				echo '</pre>';
				
				/* 	durch mysqli_fetch_assoc wird immer der nächste Datensatz abgeholt 
					und in der Variable $record gespeichert. 
					die while Schleife überwacht dabei auch, ob $record einen Wert enthält => weiterer Schleifendurchlauf -
					oder nicht => Schleife endet
				*/
				while($record = mysqli_fetch_assoc($result)) {
					echo '<pre>';		// html pre-Tag ausgeben
					print_r($record);	// Das assoziative Feld $record ausgeben
					echo '</pre>';		// html pre-Tag wieder schließen
				}
			}
			
			
		?>
		
		
		
		<?php
			mysqli_close($conn);
		?>
    </body>
</html>