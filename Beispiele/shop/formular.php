<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Shop: Formulare</title>
        <link rel="stylesheet" href="../../css/jscourse.css"/>
	</head>

	<body>
        <h1>Emmas shop</h1>
        <pre>
<?php
    function isSelected($key, $comparewith) {
        if(getPVar($key) == $comparewith)
            return 'selected';
        return '';
    }
    function getPVar($key, $default = '') {
        if(isset($_GET[$key]))
            return $_GET[$key];
        return $default;
    }
    print_r($_GET);
?>
        </pre>
        <form>
            <table>
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
                        <input type="text" name="Vorname" value="<?php echo getPVar('Vorname');?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        Name
                    </td>
                    <td>
                        <input type="text" name="Name" value="<?php echo getPVar('Name');?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        Strasse
                    </td>
                    <td>
                        <input type="text" name="Strasse" value="<?php echo getPVar('Strasse');?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        Hausnummer
                    </td>
                    <td>
                        <input type="text" name="Hausnummer" value="<?php echo getPVar('Hausnummer');?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        Plz
                    </td>
                    <td>
                        <input type="text" name="Plz" value="<?php echo getPVar('Plz');?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        Ort
                    </td>
                    <td>
                        <input type="text" name="Ort" value="<?php echo getPVar('Ort');?>">
                    </td>
                </tr>
            </table>
            <button type="submit" name="action" value="insert">Datensatz einfügen</button>
        </form>

    </body>
</html>