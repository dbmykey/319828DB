<?php
    /* SELECT * FROM tablename */
    $sql = 'SELECT * FROM ' . $tablename;
    $result = mysqli_query($conn, $sql);
    
?>
<h2><?php echo $tablename;?></h2>
<form method="post">

<?php
    if($result) {
        echo '<table class="bordered multisel">';

        $columns = $defs[$tablename];

        echo '<thead>';
        echo '<tr>';
        foreach($columns as $column) {
            echo '<th>';
            echo $column;
            echo '</th>';
        }

        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        while($record = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            foreach($columns as $column) {
                echo '<td>';
                echo $record[$column];
                echo '</td>';
            }
            echo '<td>';
            echo '<button type="submit" name="select" value="' . $record['id'] . '">...';
            echo '</button>';
            echo '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    }
?>




</form>