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
    $tablename = 'kunden';

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
    _dump($defs);

    include 'templates/listenansicht.php';
    include 'templates/' . $tablename . 'formular.php';
   
?>

    </body>
</html>