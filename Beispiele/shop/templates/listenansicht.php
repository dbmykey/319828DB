<?php

    $sql    = 'SELECT * FROM ' . $tablename;
    $result = mysqli_query($conn, $sql);
    if(!$result)
        return;
    
    

    echo '<form>';
    echo '<table class="bordered">';
    echo '<tbody>';



    while($record = mysqli_fetch_assoc($result)){
        echo '<tr>';
        foreach($defs[$tablename] as $key){
            echo '<td>';
            echo $record[$key];
            echo '</td>';
        }
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</form>';
?>