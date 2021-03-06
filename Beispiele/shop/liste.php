<?php
    /* SELECT * FROM ...;*/

    echo '<pre>';
    print_r($_POST);
    
    $orderby    = getPVar('orderby', false);
    $orderdir   = getPVar('orderdir', false);

    $neworderby = getPVar('neworderby', false);
    if($neworderby){
        if($neworderby == $orderby) {
            if($orderdir == 'ASC') {
                $orderdir = 'DESC';
            } elseif ($orderdir == 'DESC') {
                $orderby    = false;
                $orderdir   = false;
            } else {
                $orderdir = 'ASC';
            }
        } else {
            $orderby    = $neworderby;
            $orderdir   = 'ASC';
        }
    }

    $sql = "SELECT * FROM `$tablename`";
    if($orderby) {
        $oclause = " ORDER BY `$orderby` $orderdir";
        $sql .= $oclause;
    }
    $sql .= ';';
    echo '</pre>';

    $result = $conn->query($sql);
    if($result) {
        echo '<table class="bordered">';
        echo '<thead>';
        echo '<tr>';
        foreach($defs[$tablename] as $key) {
            echo '<th>';
            echo '<button type="submit" name="neworderby" value="' . $key . '">' . $key . '</button>';        
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
        echo '<input type="hidden" name="orderby" value="' . $orderby . '"/>';
        echo '<input type="hidden" name="orderdir" value="' . $orderdir . '"/>';
    }

?>
