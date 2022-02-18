<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Daten in Tabelle</title>
        <link rel="stylesheet" href="../css/jscourse.css"/>
	</head>

	<body>
		<h1>Daten in Tabelle</h1>
        <a href="tabelle.php">Anfang</a>
        <a href="tabelle.php?offset=20">Ab 20</a>
        <a href="tabelle.php?offset=40">Ab 40</a>
        <table class="bordered">
<?php
    $server     = 'localhost';
    $user       = 'root';
    $password   = '';
    $dbname     = 'world';

    $conn       = mysqli_connect($server, $user, $password, $dbname);
    if(!$conn)
        die('Verbindung gescheitert');

    $conn->set_charset('utf8mb4');
    

    print_r($_GET);


    if(isset($_GET['offset'])){
        $offset = $_GET['offset'];
    } else {
        $offset = 0;
    }

    print_r($offset);

    $sql = "SELECT Code AS 'Länder Code', Name, Population FROM Country LIMIT $offset, 20";
   
    $result = $conn->query($sql);
    if($result) {
        $record = $result->fetch_assoc();
        echo '<thead>';
        echo '<tr>';
        foreach($record as $key => $value) {
            echo '<th>';
            echo htmlentities($key);
            echo '</th>';
        }
        echo '</tr>';
        echo '</thead>';
        while($record){
            echo '<tr>';
            foreach($record as $key => $value) {
                echo '<td>';
                echo htmlentities($value);
                echo '</td>';
            }

            echo '</tr>';

            $record = $result->fetch_assoc();
        }
    }


    $conn->close();
   
?>

        </table>
    </body>
</html>