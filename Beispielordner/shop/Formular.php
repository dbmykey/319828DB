<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Globales Formular</title>
		<link rel="stylesheet" href="../../css/jscourse.css"> <!-- etwas styling -->
    </head>

    <body>

    <?php
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
    function canEdit() {
        global $currentrecordid;
        if(!$currentrecordid)
            return 'disabled';
        return '';
    }
    function isSelected($key, $comparewith) {
        if($comparewith == getPostVar($key))
            return 'selected';
        return '';
    }
    ?>

    
    <?php
    global $currentrecordid;

    $tablename  =   'kunden';

    $servername =   'localhost';
    $user       =   'root';
    $password   =   '';
    $dbname     =   'emmasshop';

    $conn = mysqli_connect($servername, $user, $password, $dbname);
    if(!$conn)
        die('Keine Verbindung zur Datenbank möglich');

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
        ],
        'produkte' => [

        ]
    ];

    $action             = getPostVar('action');
    $currentrecordid    = getPostVar('currentrecordid', 0);

    $select = getPostVar('select', false);
    if($select) {
        $currentrecordid = $select;
        $sql = 'SELECT * FROM ' . $tablename . ' WHERE id=' . $currentrecordid;
        $result = mysqli_query($conn, $sql);
        if($result) {
            $record = mysqli_fetch_assoc($result);
            foreach($defs[$tablename] as $key) {
                $_POST[$key] = $record[$key];
            }
        }
    }
    switch($action) {
        case 'insert':
            /* INSERT INTO tabelle (...) VALUES (...) */
            $keys   = $defs[$tablename];
            $values = [];
            foreach($keys as $key) {
                $values[] = "'" . getPostVar($key) . "'";
            }
            
            $keys   = implode(', ', $keys);
            $values = implode(', ', $values);

            $sql = 
            'INSERT INTO ' . $tablename . '
                (' . $keys . ') VALUES
                (' . $values. ')
            '; 
            
            $result = mysqli_query($conn, $sql);
            if(!$result) {
                echo 'Konnte Datensatz nicht einfügen';
            } else {
                $currentrecordid = mysqli_insert_id($conn);
                echo 'Habe Datensatz eingefügt id=' . $currentrecordid;
            }
            
            break;
        case 'update':

            if($currentrecordid) {
                /* UPDATE tabelle SET (...) WHERE id=($currentrecordid)) */
                /*Tabellenattribut1 = Wert1, Tabellenattribut2 = Wert2*/
                $keys   = $defs[$tablename];
                $values = [];
                foreach($keys as $key) {
                    $values[] = $key . "='" . getPostVar($key) . "'";
                }
                $values = implode(', ', $values);
                $sql = '
                    UPDATE ' . $tablename . '
                        SET ' . $values . '
                        WHERE id=' . $currentrecordid . '
                ';
                $result = mysqli_query($conn, $sql);
                if(!$result) {
                    echo 'Konnte Datensatz nicht aktualisieren';
                } else {
                    echo 'Erfolgreich aktualisiert';
                }

            } else {
                echo 'Kein aktueller Datensatz';
            }
            break;
            case 'delete':
                if($currentrecordid) {
                    /* DELETE FROM tabellenname WHERE id=$currentrecordid */
                    $sql = '
                        DELETE FROM ' . $tablename . '
                        WHERE id = ' . $currentrecordid . '
                    ';
                    $result = mysqli_query($conn, $sql);
                    if(!$result) {
                        echo 'Konnte Datensatz nicht löschen';
                    } else {
                        echo 'Erfolgreich gelöscht';
                        $currentrecordid = 0;
                    }
                } else {
                    echo 'Kein aktueller Datensatz';
                }
                break;
    }
    ?>

    <?php
        include 'templates/listenansicht.php';
        include 'templates/'. $tablename . 'formular.php';

        mysqli_close($conn);
    ?>
    </body>
</html>