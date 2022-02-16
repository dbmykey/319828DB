<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Erste Datenbank Datei</title>
</head>

<body>
	<h1>Datenbankverbindungen</h1>
	<!-- Ab hier sollen Newline Zeichen interpretiert werden -->
	<pre>
	<?php


		
		$server 	= 'localhost';
		$user 		= 'root';
		$password	= '';
		$dbname		= 'world';

			/* Kommentar
			mehrzeilig 
			*/
			// Einzeilig 

		$conn = mysqli_connect($server, $user, $password, $dbname);
		
		if(!$conn)
			die('Keine Verbindung zur Datenbank');

		echo 'Klappt';

		$sql 	= 'SELECT * FROM country';
		$result = mysqli_query($conn, $sql);

		print_r($result);
		if($result) {
			$record = mysqli_fetch_assoc($result);
			print_r($record);
		}

	?>

	</pre>
</body>
</html>

<?php
	mysqli_close($conn);
?>