<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
	    <title>Globales Formular</title>
        <link rel="stylesheet" href="../../css/jscourse.css">
    </head>
    <body>
        <h1>Emmas shop</h1>

<?php
    //require_once 'config.php';


    function _dump($t) {
        echo '<pre>';
        print_r($t);
        echo '</pre>';
    }
    function getPostVar($key, $default = '') {
        if(isset($_POST[$key])) {
            return $_POST[$key];
        }
        return $default;
    }
    function isSelected($key, $comparewith) {
        if(getPostVar($key) == $comparewith) {
            return 'selected';
        }
        return '';
    }
?>

<?php

    // Verbindung zur Datenbank aufbauen

    $servername     =   'localhost';
    $user           =   'localemma';
    $password       =   'tzY[5PfJb9I.!Ghq';
    $dbname         =   'emmasshop';

    $conn           = mysqli_connect($servername, $user, $password, $dbname);
    if(!$conn) {
        die('Keine Verbindung zur Datenbank');
    }

    $tablename      =   'kunden';

    $defs = [
        'kunden' => [
            'Anrede',
            'Vorname',
            'Name',
            'Strasse',
            'Hausnummer',
            'Plz',
            'Ort',
            'Email'
        ]
    ];
  
    $action             = getPostVar('action');
    $currentrecordid    = getPostVar('currentrecordid', 0);

    switch($action){
        case 'insert':  // Datensatz einfügen

            // INSERT INTO tabellenname (...) VALUES (...)
            $keys   = $defs[$tablename];
            $values = []; // array();
            foreach($keys as $key){
                $values[] = "'" . getPostVar($key) . "'";
            }

            $keys   = implode(', ', $keys);
            $values = implode(', ', $values);
           
            $sql    = 'INSERT INTO ' . $tablename . ' (' . $keys . ') VALUES (' . $values . ')';
            $result = mysqli_query($conn, $sql);
            if($result) {
                $currentrecordid = mysqli_insert_id($conn);
                echo 'Habe Datensatz eingefügt: id=' . $currentrecordid;
            } else {
                echo 'Konnte Datensatz nicht einfügen';
            }
            break;
        case 'update':  // Datensatz aktualisieren
            // UPDATE tabellenname SET ... WHERE ...
            if($currentrecordid) {
                // attribut = wert, ...
                $set    = [];
                $keys   = $defs[$tablename];
                foreach($keys as $key){
                    $set[] = $key . '=' . "'" . getPostVar($key) . "'";   
                }

                _dump($set);

            }
            break;
        case 'delete':  // Datensatz löschen

            break;
    };


    include 'templates/listenansicht.php';
    include 'templates/' . $tablename . 'formular.php';
   

    mysqli_close($conn);
?>

    </body>
</html>