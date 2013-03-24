<?php
            $data = explode("_",$detail);
            $db = analytics::getMatch($data[0], $data[1], $data[2]);
            echo '<table border="1"><th>Event</th><th>Type</th><th>Number</th><th>Red Score</th><th>Blue Score</th><th>Red Alliance</th><th>Blue Alliance</th><th>Red Climb</th><th>Blue Climb</th><th>Red Auto</th><th>Blue Auto</th><th>Red Teleop</th><th>Blue Teleop</th><th>Red Fouls</th><th>Blue Fouls</th>';
            foreach ($db as $response) {
                echo '<tr><td>'.$response[0].'</td><td>'.$response[1].'</td><td>'.$response[2].'</td><td>'.$response[3].'</td><td>'.$response[4].'</td><td>'.$response[5].', '.$response[6].', '.$response[7].'</td><td>'.$response[8].', '.$response[9].', '.$response[10].'</td><td>'.$response[11].'</td><td>'.$response[12].'</td><td>'.$response[15].'</td><td>'.$response[16].'</td><td>'.$response[17].'</td><td>'.$response[18].'</td><td>'.$response[13].'</td><td>'.$response[14].'</td></tr>';
            }
            echo "</table>";
            #print_r($db);
?>