<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Daten in Tabelle</title>
        <link rel="stylesheet" href="../css/jscourse.css"/>
	</head>

	<body>
		<h1>Daten in Tabelle</h1>
        <table class="bordered">
    <?php

    $server 	= 'localhost';
    $user		= 'root';
    $password	= '';
    $dbname		= 'world';
    
    $conn 		= mysqli_connect($server, $user, $password, $dbname);
    if(!$conn)
        die('Verbindung gescheitert');

    $sql        = 'SELECT Code, Name, Population FROM Country LIMIT 20';
    $result     = $conn->query($sql);

    if($result) {



        while($record = $result->fetch_assoc()) {
            echo '<tr>';
            foreach($record as $key => $value) {
                $value = $record[$key];
                echo '<td>';
                echo $value;
                echo '</td>';
            }
            echo '</tr>';
        }
        $result->free_result();
    }
   
    $conn->close();
    
    ?>

        </table>
    </body>
</html>