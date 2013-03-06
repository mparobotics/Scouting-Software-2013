<html>
    <head><link href="/styles.css" rel="stylesheet" /></head>
    <body>
    <?php
    include('../classes.php');
    
    $view = $_GET['view'];
    $detail = $_GET['detail'];
    
    analytics::display($view, $detail);
    ?>
    </body>
</html>