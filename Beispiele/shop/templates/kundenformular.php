<form method="post">
    <table class="bordered">
        <thead>
            <tr>
               <th>
                   Attribut
               </th> 
               <th>
               </th>
            </tr>
        </thead>
        <tbody>
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
                    <input type="text" name="Vorname" value="<?php echo getPostVar('Vorname');?>">
                </td>
            </tr>
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
                    Strasse
                </td>
                <td>
                    <input type="text" name="Strasse" value="<?php echo getPostVar('Strasse');?>">
                </td>
            </tr>
            <tr>
                <td>
                    Hausnummer
                </td>
                <td>
                    <input type="text" name="Hausnummer" value="<?php echo getPostVar('Hausnummer');?>">
                </td>
            </tr>
            <tr>
                <td>
                    Plz
                </td>
                <td>
                    <input type="text" name="Plz" value="<?php echo getPostVar('Plz');?>">
                </td>
            </tr>
            <tr>
                <td>
                    Ort
                </td>
                <td>
                    <input type="text" name="Ort" value="<?php echo getPostVar('Ort');?>">
                </td>
            </tr>
            <tr>
                <td>
                    Email
                </td>
                <td>
                    <input type="text" name="Email" value="<?php echo getPostVar('Email');?>">
                </td>
            </tr>
        </tbody>
    </table>

    <button type="submit" name="action" value="insert">Datensatz einfügen</button>
    <button type="submit" name="action" value="update">Datensatz aktualisieren</button>
    <button type="submit" name="action" value="delete">Datensatz löschen</button>
    <input type="hidden" name="currentrecordid" value="<?php echo $currentrecordid;?>">
</form>    