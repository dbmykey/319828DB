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
		print_r("Hi\n");

		/* 
			Kommentare mehrzeilig
		*/
		// Einzeiliger Kommentar

		$server 	= 'localhost';
		$user		= 'root';
		$password	= '';
		$dbname		= 'world';
		
		$conn 		= mysqli_connect($server, $user, $password, $dbname);

		//$conn1		= new mysqli($server, $user, $password, $dbname);

		if(!$conn)
			die('Verbindung gescheitert');

		$sql = 'SELECT * FROM Country LIMIT 50';
		$result = $conn->query($sql);
		//$result = mysqli_query($conn, $sql);
		print_r($result);
		/*
		$field 	= [
			1, 
			2, 
			3,
			[
				1,
				2,
				3,
				[
					1, 
					2, 
					3	
				]
			]
		];

		print_r($field);
		$inhalt = $field[1][0];
	
		print_r($inhalt);

		/*$assoc = [
				'fach1' => 1, 
				'fach2' => 2, 
				'fach3' => 3, 
				'fach4' => [
					'unterfach1' => 1
				]
			];
		$inhalt = $assoc['fach1'];
		*/

		if($result) {
			/*$record = $result->fetch_assoc();
			print_r($record);
			$record = $result->fetch_assoc();
			print_r($record);*/

			
			while($record = $result->fetch_assoc()){
				print_r($record);
			}

			$result->free_result();
		}
		
		// mysqli_close($conn);
		$conn->close();
	?>	
		</pre>
	</body>
</html>

