<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Eine Datentabelle ausgeben</title>
		<link rel="stylesheet" href="../css/jscourse.css"> <!-- etwas styling -->
    </head>

    <body>
        <h1>Daten als html-Tabelle</h1>
		
		
		<?php
			$server 	= 'localhost';
			$user 		= 'root';
			$password 	= '';
			$dbname		= 'world';
			
			/* Mit den Zugangsdaten die Verbindung zu Server und Datenbank herstellen */
			$conn 		= mysqli_connect($server, $user, $password, $dbname);
			
			if(!$conn)		/* Die Verbindung konnte nicht hergestellt werden */
				die('Das ging schief'); // Also alles abbrechen
			
			/* Formulierung einer Abfrage, die mehrere Datensätze liefert */ 
			$sql 	= '
			SELECT 
					Name AS Land, 
					Region AS Region, 
					Continent AS Kontinent, 
					Population AS Bevölkerung 
				FROM Country 
				ORDER BY Population';
			
			
			$result = mysqli_query($conn, $sql); // Resultat, aber noch keine Datensätze
			if($result) {
				/* ein html-table-Tag öffnen */
				echo '<table class="bordered">';
				$record = mysqli_fetch_assoc($result); // den ersten Datensatz holen für die Tabellenspalten
				
				/* die Spaltenüberschriften schreiben */
				echo '<thead>';
				echo '<tr>';
				foreach($record as $key => $val) {
					echo '<th>';
					echo $key;
					echo '</th>';
				}
				echo '</tr>';
				echo '</thead>';
				
				/* alle Datensätze in Tabellenzeilen umsetzen */
				while($record) {
					echo '<tr>';
					foreach($record as $key => $val) {
						echo '<td>';
						echo $val;
						echo '</td>';
					}
						
					echo '</tr>';
					$record = mysqli_fetch_assoc($result); // erst jetzt den nächsten Datensatz holen
				}
				echo '</table>';
			}
			
			
		?>
		
		
		
		<?php
			mysqli_close($conn);
		?>
    </body>
</html>