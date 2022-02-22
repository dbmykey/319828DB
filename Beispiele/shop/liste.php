<?php
    /* SELECT * FROM ...;*/

   
    $sql = "SELECT * FROM `$tablename`;";
    echo $sql . '<br>';
    $result = $conn->query($sql);
    if($result) {
        echo '<table class="bordered">';
        echo '<thead>';
        echo '<tr>';
        foreach($defs[$tablename] as $key) {
            echo '<th>';
            echo $key;
            echo '</th>';
        }
        
        echo '</tr>';
        echo '</thead>';


        while($record = $result->fetch_assoc()){
            echo '<tr>';
            foreach($defs[$tablename] as $key) {
                echo '<td>';
                echo $record[$key];
                echo '</td>';
            }
            echo '<td>';
            echo '<button type="submit" name="selrecord" value="' . $record['ID'] . '">...</button>';
            echo '</td>';
            echo '</tr>';
        } 
        echo '</table>';
    }

?>
