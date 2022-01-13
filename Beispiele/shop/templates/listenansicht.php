<?php

    $sql    = 'SELECT * FROM ' . $tablename;

    $filter             = getPostVar('filter', false);
    
    if($filter) {
        $conditions = [];
        foreach($defs[$tablename] as $key) {
            $value = strip_tags($filter[$key]);
            if($value) {
                $conditions[] = $key . " LIKE '%" . $value . "%'";
            }
        }
        if(count($conditions)) {
            $conditions = implode(' AND ', $conditions);
            $where = ' WHERE (' . $conditions . ')';
            if($currentrecordid) {
                $where .= ' OR id=' . $currentrecordid;
            }
            $sql .= $where;
        }
    }
    if($orderby) {
        $sql .= ' ORDER BY ' . $orderby . ' ' . $orderdir;
    }
    
    $result = mysqli_query($conn, $sql);

    if(!$result)
        die('Keine Tabelle');
      
    echo '<table class="bordered">';
    echo '<thead>';
    echo '<tr>';
    
    foreach($defs[$tablename] as $key) {
        if($key == $orderby) {
            $class = 'ordered';
            if($orderdir == 'ASC') {
                $class .= ' asc';
                $buttonclass = ' icon icon-arrow-down';
            } else {
                $class .= ' desc';
                $buttonclass = ' icon icon-arrow-up';
            }
        } else {
            $class = '';
            $buttonclass = '';
        }
        echo '<th class="' . $class . '">';
        echo '<button class="headline ' . $buttonclass . '" type="submit" name="neworderby" value="' . $key . '">';
        echo $key;
        echo '</button>';

        if($filter){
            $value = strip_tags($filter[$key]);
        } else {
            $value = '';
        }
        echo '<input class="inline" name="filter[' . $key . ']" value="' . $value . '">';
        echo '<button class="lookfor icon icon-search" type="submit" name="applyfiter"></button>';
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

            if($key == 'Bildurl') {
                if(file_exists(realpath('images/' . $record[$key])))
                    echo '<img width="160" src="images/' . $record[$key] . '"><br>';
            }
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