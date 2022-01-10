<?php

    
    $sql    = 'SELECT * FROM ' . $tablename;


    if($orderby) {
        $ordering = ' ORDER BY ' . $orderby . ' ' . $orderdir;
        
        $sql = $sql . $ordering;
        echo 'neues SQL : ' . $sql;
    }
    $result = mysqli_query($conn, $sql);
    if(!$result)
        return;
    
    

    echo '<table class="bordered">';

    echo '<thead>';
    echo '<tr>';
    foreach($defs[$tablename] as $key){
        echo '<th>';
        echo '<button type="submit" name="neworderby" value="' . $key . '">';
        echo $key;
        echo '</button>';
        echo '</th>';
    }

    echo '</tr>';
    echo '</thead>';


    echo '<tbody>';

    while($record = mysqli_fetch_assoc($result)){
        if($record['id'] == $currentrecordid){
            $class = 'active';
        } else {
            $class ='';
        }
        echo '<tr class="' . $class . '">';
        foreach($defs[$tablename] as $key){
            echo '<td>';
            echo $record[$key];
            echo '</td>';
        }
        echo '<td>';
        echo '<button type="submit" name="select" value="' . $record['id'] . '">';
        echo '...' . $record['id'];
        echo '</button>';
        echo '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>'; 
?>