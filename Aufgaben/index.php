<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>PHP Index Datei</title>
    </head>

    <body>
        <h1>PHP index - Datei</h1>
        <script>
            alert(document.location + '<?php echo basename(__FILE__);?>');
        </script>
    </body>
</html>
