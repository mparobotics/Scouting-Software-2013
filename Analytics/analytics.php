<?php
include('../classes.php');

$view = $_GET['view'];
$detail = $_GET['detail'];

analytics::display($view, $detail);
?>