<?php

$query = $_GET['query'];
$device = $_GET['device'];
$data = $_GET['data'];

$sync = array(true,true);

if ($query == "alive") {
    if ($device == 1) {
        if (sync[0]) {
            echo "alive";
        }
    } elseif ($device == 2) {
        if (sync[1]) {
            echo "alive";
        }
    }
} elseif ($query == "data") {
    $result = array();
    foreach (explode('_', $data) as $piece) {
        $result[] = explode(',', $piece);
    }
    print_r($result);
}
?>