<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Eine Datentabelle ausgeben 2.Versuch</title>
		<link rel="stylesheet" href="../css/jscourse.css"> <!-- etwas styling -->
    </head>

    <body>

    <?php

    /* Programmierung */
    function _dump($t) {
        echo '<pre>';
        print_r($t);
        echo '</pre>';
    }

    echo '<h1>Hallo world Datenbank</h1>';

    $servername     = 'localhost';
    $user           = 'root'; 
    $password       = '';
    $dbname         = 'world';

    $conn = mysqli_connect($servername, $user, $password, $dbname);
    if(!$conn)
        die('Keine Verbindung zm Server');

    echo 'Verbindung erfolgreich hergestellt';

    /* Verbindung nutzen -> Daten anfordern */
    
    /* das erste SQL-Statement */
    $sql    = '
        SELECT 
            Name AS Ländername, Continent AS Kontinent, Region AS Region, Population AS Bevölkerung  
            FROM Country 
            ORDER BY Population
            LIMIT 230, 10;
    ';

    $result = mysqli_query($conn, $sql);

    /* Daten aus dem Resultat abholen */

    $record = mysqli_fetch_assoc($result);
    
    /* html Gerüst für Tabelle */
    echo '<table class="bordered">';
    echo '<thead>'; // Table Head
    echo '<tr>';    // Zeile im Head
    foreach($record as $key => $value) {
        echo '<th>';    // Spaltenüberschriften
        echo $key;      // hier ausgeben
        echo '</th>';   // in einer TableHead Zelle
    }
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    while($record) {
        echo '<tr>';
        foreach($record as $key => $value) {
            echo '<td>';    // Spaltendaten
            echo $value;    // hier ausgeben
            echo '</td>';   // in einer TableData Zelle
        }
        echo '</tr>';
        $record = mysqli_fetch_assoc($result);
    }
    echo '</tbody>';
    echo '</table>';

    mysqli_close($conn);
    ?>


    </body>
</html>