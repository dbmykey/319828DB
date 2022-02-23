<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Shop: Formulare</title>
        <link rel="stylesheet" href="../../css/jscourse.css"/>
	</head>

	<body>
        <h1>Emmas shop</h1>
        <pre>
<?php

    require('config.php');

    $tablename = 'kunden';
    $conn = mysqli_connect($server, $user, $password, $dbname);


    function isSelected($key, $comparewith) {
        if(getPVar($key) == $comparewith)
            return 'selected';
        return '';
    }
    function getPVar($key, $default = '') {
        if(isset($_POST[$key]))
            return $_POST[$key];
        return $default;
    }
    function isEditable() {
        $cid = getPVar('currentrecordid', false);
        if($cid === false || empty($cid))
            return 'disabled';
        return '';
    }

    $currentrecordid    = getPVar('currentrecordid', false);
    $action             = getPVar('action', false);

    $selrecord          = getPVar('selrecord', false);
    if($selrecord) {
        $sql = "SELECT * FROM `$tablename` WHERE ID = $selrecord;";
        $result = $conn->query($sql);
        if($result) {
            $record = $result->fetch_assoc();
            if($record) {
                foreach($defs[$tablename] as $key) {
                    $_POST[$key] = $record[$key];
                }
                $_POST['currentrecordid']   = $selrecord;
                $currentrecordid            = $selrecord;
            }
        }
    }

    switch($action) {
        case 'insert':

            /* INSERT INTO `kunden` (`Anrede`, `Vorname`, ...) VALUES ('Frau', 'Minnie', ...)*/


            $keys   = [];
            $values = [];
            foreach($defs[$tablename] as $key) {
                $keys[]     = '`' . $key . '`';
                $values[]   = "'" . getPVar($key) . "'";
            }

            $keys   = implode(', ', $keys);
            $values = implode(', ', $values);

            $sql = "INSERT INTO `$tablename` ($keys) VALUES ($values);";

            $result = $conn->query($sql);
            if(!$result)
                echo 'Einfügen schlug fehl';
            else {
                $currentrecordid            = $conn->insert_id;
                $_POST['currentrecordid']   = $currentrecordid;
                echo 'Datensatz wurde eingefügt (' . $currentrecordid . ')<br>'; 
            }
              
            break;
        case 'update':
            /* UPDATE `kunden` SET `Attribut` = 'Wert', ... WHERE ID=$currentrecordid*/
            if($currentrecordid) {
                $sets = [];
                foreach($defs[$tablename] as $key){
                    $sets[] = '`' . $key . "` = '" . getPVar($key) . "'";
                }
                $sets = implode(', ', $sets);

                $sql = "UPDATE `$tablename` SET $sets WHERE ID = $currentrecordid;";
                $result = $conn->query($sql);
                if(!$result) 
                    echo 'Aktualisierung schlug fehl';
                else 
                    echo 'Datensatz wurde aktualisiert';
                
            }

            break;
        case 'delete':
            /* DELETE FROM `kunden` WHERE ID=$currentrecordid*/
            if($currentrecordid) {
                $sql = "DELETE FROM `$tablename` WHERE ID=$currentrecordid";
                $result = $conn->query($sql);
                if(!$result)
                    echo 'Löschen schlug fehl';
                else {   
                    echo 'Datensatz wurde gelöscht';
                    $currentrecordid = false;
                    $_POST['currentrecordid'] = false;
                }  
            }
            break;
    }

?>
        </pre>
        <form method="post">
          
            <?php 
                require('liste.php');
            ?>
           
            <table class="bordered">
                <tr>
                    <td>
                        Anrede
                    </td>
                    <td>
                        <select name="Anrede">
                            <option <?php echo isSelected('Anrede', '');?>></option>
                            <option <?php echo isSelected('Anrede', 'Frau');?>>Frau</option>
                            <option <?php echo isSelected('Anrede', 'Herr');?>>Herr</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        Vorname
                    </td>
                    <td>
                        <input type="text" name="Vorname" value="<?php echo getPVar('Vorname');?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        Name
                    </td>
                    <td>
                        <input type="text" name="Name" value="<?php echo getPVar('Name');?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        Strasse
                    </td>
                    <td>
                        <input type="text" name="Strasse" value="<?php echo getPVar('Strasse');?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        Hausnummer
                    </td>
                    <td>
                        <input type="text" name="Hausnummer" value="<?php echo getPVar('Hausnummer');?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        Plz
                    </td>
                    <td>
                        <input type="text" name="Plz" value="<?php echo getPVar('Plz');?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        Ort
                    </td>
                    <td>
                        <input type="text" name="Ort" value="<?php echo getPVar('Ort');?>">
                    </td>
                </tr>
            </table>
            <button type="submit" name="action" value="insert">Datensatz einfügen</button>
            <button type="submit" name="action" value="update" <?php echo isEditable();?>>Datensatz aktualisieren</button>
            <button type="submit" name="action" value="delete" <?php echo isEditable();?>>Datensatz löschen</button>
            <input type="hidden" name="currentrecordid" value="<?php echo $currentrecordid;?>"/>
        </form>

    </body>
</html>
<?php
    $conn->close();
?>