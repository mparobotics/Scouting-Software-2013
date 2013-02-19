<?php

$query = $_GET['query'];
$data = $_GET['data'];

if ($query == "alive") {
    echo "alive";
} elseif ($query == "data") {
    $result = array();
    foreach (explode('_', $data) as $piece) {
        $result[] = explode(',', $piece);
    }
    print_r($result);
}
?>