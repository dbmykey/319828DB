<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
	    <title>Globales Formular</title>
        <link rel="stylesheet" href="../../css/jscourse.css">
        <style>
                th.ordered {
                    background-color:rgba(0, 128, 128, 0.5)!important;
                }
                th button {
                    border:none;
                    background-color:transparent;
                }
        </style>
    </head>
    <body>
        <h1>Emmas shop</h1>

<?php
    require_once 'config.php';


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
    function canEdit() {
        global $currentrecordid;
        if($currentrecordid)
            return '';
        return 'disabled';
    }
?>

<?php
    global $currentrecordid;
    // Verbindung zur Datenbank aufbauen

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


    $orderby            = getPostVar('orderby');
    $orderdir           = getPostVar('orderdir');

    $neworderby         = getPostVar('neworderby', false);
    if($neworderby) {
        if($neworderby != $orderby) {
            $orderby    = $neworderby;
            $orderdir  = 'ASC';
        } else {
            switch($orderdir) {
                case 'ASC':
                    $orderdir = 'DESC';
                    break;
                case 'DESC':
                    $orderdir = 'ASC';
                    break;
                default:
                    $orderdir = 'ASC';
            }
        }
    }


    // Einstellung eines anderen Datensatzes aus der Listenansicht

    $selectid = getPostVar('select', false);
    if($selectid) {
        $sql = 'SELECT * FROM ' . $tablename . ' WHERE id=' . $selectid;
        $result = mysqli_query($conn, $sql);
        if($result) {
            // Daten abholen
            $record = mysqli_fetch_assoc($result);
            foreach($defs[$tablename] as $key){
                $_POST[$key] = $record[$key];
            }
            $currentrecordid = $selectid;
        } else {
            echo 'Konnte Datensatz nicht auswählen';
        }

    }

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
                $set    = implode(', ', $set);
               
                $sql    = 'UPDATE ' . $tablename . ' SET ' . $set . ' WHERE id=' . $currentrecordid;
                $result = mysqli_query($conn, $sql);
                if($result) {
                    echo 'Datensatz wurde aktualisiert';
                } else {
                    echo 'Konnte Datensatz nicht aktualisieren';
                }
            }
            break;
        case 'delete':  // Datensatz löschen
            // DELETE FROM tabellenname WHERE ...
            if($currentrecordid){
                $sql = 'DELETE FROM ' . $tablename . ' WHERE id=' . $currentrecordid;
                $result = mysqli_query($conn, $sql);
                if($result) {
                    echo 'Datensatz wurde gelöscht';
                    $currentrecordid = 0;
                    foreach($defs[$tablename] as $key){
                        $_POST[$key] = '';
                    }
                } else {
                    echo 'Konnte Datensatz nicht löschen';
                }
            }
            break;
    };

    echo '<form method="post">';
    include 'templates/listenansicht.php';
    include 'templates/' . $tablename . 'formular.php';
   
    echo '</form>';

    mysqli_close($conn);
?>

    </body>
</html>