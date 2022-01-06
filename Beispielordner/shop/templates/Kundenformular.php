  <?php
  ?>
    <form method="post">
        <table class="bordered">
            <tr>
                <th><label>Anrede</label></th>
                <td>
                    <select name="Anrede">
                        <option <?php echo isSelected('Anrede', '');?>></option>
                        <option <?php echo isSelected('Anrede', 'Frau');?>>Frau</option>
                        <option <?php echo isSelected('Anrede', 'Herr');?>>Herr</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th><label>Vorname</label></th>
                <td>
                    <input type="text" name="Vorname" value="<?php echo getPostVar('Vorname');?>"/>
                </td>
            </tr>
            <tr>
                <th>
                    <label>Name</label>
                </th>
                <td>
                    <input type="text" name="Name" value="<?php echo getPostVar('Name');?>"/>
                </td>
            </tr>
            <tr>
                <th>    
                    <label>Strasse</label>
                </th>
                <td>
                    <input type="text" name="Strasse" value="<?php echo getPostVar('Strasse');?>"/>
                </td>
            </tr>
            <tr>
                <th>
                    <label>Hausnummer</label>
                </th>
                <td>
                    <input type="text" name="Hausnummer" value="<?php echo getPostVar('Hausnummer');?>"/>
                </td>
            </tr>
            <tr>
                <th>
                    <label>Plz</label>
                </th>
                <td>
                    <input type="text" name="Plz" value="<?php echo getPostVar('Plz');?>"/>
                </td>
            </tr>
            <tr>
                <th>
                    <label>Ort</label>
                </th>
                <td>
                    <input type="text" name="Ort" value="<?php echo getPostVar('Ort');?>"/>
                </td>
            </tr>
            <tr>
                <th>
                    <label>Email</label>
                </th>
                <td>
                    <input type="text" name="Email" value="<?php echo getPostVar('Email');?>"/>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit" name="action" value="insert">Datensatz anlegen</button>
                    <button type="submit" name="action" value="update" <?php echo canEdit();?>>Datensatz aktualisieren</button>
                    <button type="submit" name="action" value="delete" <?php echo canEdit();?>>Datensatz löschen</button>
                </td>
            </tr>
        </table>
        <input type="hidden" name="currentrecordid" value="<?php echo $currentrecordid;?>"/>
    </form>
    
