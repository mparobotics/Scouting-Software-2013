<?php

#Demo SQL Code
#$sql = "INSERT INTO `scouting2013`.`teamdata` (`TeamNumber`, `MatchNumber`, `Overall`, `Shooting`, `Lifting`, `Assisting`, `Penalties`, `Comments`, `Id`, `Timestamp`) VALUES (\'1234\', \'2\', \'3\', \'2\', \'0\', \'2\', \'Yellow Card\', \'N/A\', NULL, NOW());";


$query = $_GET['query'];
$device = $_GET['device'];
$data = $_GET['data'];

$sync = array(true,false);

if ($query == "alive") {
    if ($device == 1) {
        if ($sync[0]) {
            echo "alive";
        }
    } elseif ($device == 2) {
        if ($sync[1]) {
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