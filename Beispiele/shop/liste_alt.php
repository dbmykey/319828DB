<?php
    /* SELECT * FROM ...;*/

    echo '<pre>';
    print_r($_POST);
    
    $filter = getPVar('filter', false);

    $neworderby = getPVar('neworderby', false);
    $orderby    = getPVar('orderby', false);
    $orderdir   = getPVar('orderdir', false);
    if($neworderby) {
        if($orderby == $neworderby) {
            if($orderdir == 'ASC') {
                $orderdir = 'DESC';
            } else if($orderdir == 'DESC') {
                $oderdir = false;
                $orderby = false;
            }
        } else {
            $orderby = $neworderby;
            $orderdir = 'ASC';
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
            if($key == $orderby) {
                $class          = 'ordered';
                if($orderdir == 'ASC') {
                    $buttonclass    = 'headline icon icon-arrow-down';
                } else {
                    $buttonclass    = 'headline icon icon-arrow-up';
                }
                
            } else {
                $class          = '';
                $buttonclass    = '';
            }
            echo '<th class="' . $class . '">';
            echo '<button class="' . $buttonclass . '" type="submit" name="neworderby" value="' . $key . '">' . $key . '</button>';

            if($filter) {
                $value = $filter[$key];
            }

            echo '<input type="text" name="filter[' . $key .  ']"/>';
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
