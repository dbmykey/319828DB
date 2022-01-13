
    <table class="bordered">
        <thead>
            <tr>
               <th>
                   Produkt
               </th> 
               <th>
               </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                   Name
                </td>
                <td>
                    <input type="text" name="Name" value="<?php echo getPostVar('Name');?>">
                </td>
            </tr>
            <tr>
                <td>
                    Beschreibung
                </td>
                <td>
                    <textarea name="Beschreibung"><?php echo getPostVar('Beschreibung');?></textarea>
                </td>
            </tr>
            <tr>
                <td>
                    Bildurl
                </td>
                <td>
                    <?php 
                    $file =  getPostVar('Bildurl');
                    if(file_exists(realpath('images/' . $file))) { ?>
                    <img width="320" src="images/<?php echo $file;?>"><br>
                    <?php 
                    }
                    echo $file;
                    ?><br>
                    <input type="file" name="produktbildupload"/>
                    <input type="hidden" name="Bildurl" value="<?php echo $file;?>">
                </td>
            </tr>
            <tr>
                <td>
                    Einheit
                </td>
                <td>
                    <input type="text" name="Einheit" value="<?php echo getPostVar('Einheit');?>">
                </td>
            </tr>
            <tr>
                <td>
                    Preis
                </td>
                <td>
                    <input type="text" name="Preis" value="<?php echo getPostVar('Preis');?>">
                </td>
            </tr>
        </tbody>
    </table>

    <button type="submit" name="action" value="insert">Datensatz einfügen</button>
    <button type="submit" name="action" value="update" <?php echo canEdit();?>>Datensatz aktualisieren</button>
    <button type="submit" name="action" value="delete" <?php echo canEdit();?>>Datensatz löschen</button>
    <input type="hidden" name="currentrecordid" value="<?php echo $currentrecordid;?>">
    <input type="hidden" name="orderby" value="<?php echo $orderby;?>">
    <input type="hidden" name="orderdir" value="<?php echo $orderdir;?>">