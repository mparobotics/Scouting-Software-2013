<html>
    <head><link href="/styles.css" rel="stylesheet" /></head>
    <body>
    <?php
    include('../classes.php');
    
    $view = $_GET['view'];
    $detail = $_GET['detail'];

    if ($_GET['event'] == 'All') {
        analytics::$event = "";
    } else {
        analytics::$event = "`Event` = '#".$_GET['event']."' AND ";
    }
    
    analytics::display($view, $detail);
    ?>
    </body>
</html>