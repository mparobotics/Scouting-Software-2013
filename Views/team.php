<?php
        $data = analytics::getTeam($detail);
                echo "<h1>Scouting Data for Team Number: ".$detail."</h1>";
                echo '<table border="1"><th>Matches Won</th><th>Matches Lost</th><th>Matches Tied</th><th>Win Pct.</th><tr><td>'.$data[0].'</td><td>'.$data[1].'</td><td>'.$data[2].'</td><td>'.$data[3].'</td></tr></table><br />';
                echo '<table border="1"><th>Event</th><th>Type</th><th>Number</th><th>Red Score</th><th>Blue Score</th><th>Red Alliance</th><th>Blue Alliance</th><th>Red Climb</th><th>Blue Climb</th><th>Red Auto</th><th>Blue Auto</th><th>Red Teleop</th><th>Blue Teleop</th><th>Red Fouls</th><th>Blue Fouls</th>';
                foreach ($data[4] as $response) {
                        $r1 = '';
                        $r2 = '';
                        $r3 = '';
                        $b1 = '';
                        $b2 = '';
                        $b3 = '';
                    $matchStatus = "Error";
                    $alliance = "Error";
                    if ($response[3] == $response[4]) {
                        #Tie
                        $matchStatus = "Tied";
                    }
                    else {
                        if (($response[5] == $detail) && ($response[3] > $response[4])) {
                            $matchStatus = "Won";
                            $alliance = "Red";
                            $r1 = '<strong>';
                        } elseif (($response[6] == $detail) && ($response[3] > $response[4])) {
                            $matchStatus = "Won";
                            $alliance = "Red";
                            $r2 = '<strong>';
                        } elseif (($response[7] == $detail) && ($response[3] > $response[4])) {
                            $matchStatus = "Won";
                            $alliance = "Red";
                            $r3 = '<strong>';
                        } elseif (($response[8] == $detail) && ($response[3] < $response[4])) {
                            $matchStatus = "Won";
                            $alliance = "Blue";
                            $b1 = '<strong>';
                        } elseif (($response[9] == $detail) && ($response[3] < $response[4])) {
                            $matchStatus = "Won";
                            $alliance = "Blue";
                            $b2 = '<strong>';
                        } elseif (($response[10] == $detail) && ($response[3] < $response[4])) {
                            $matchStatus = "Won";
                            $alliance = "Blue";
                            $b3 = '<strong>';
                        } elseif (($response[5] == $detail) && ($response[3] < $response[4])) {
                            $matchStatus = "Lost";
                            $alliance = "Red";
                            $r1 = '<strong>';
                        } elseif (($response[6] == $detail) && ($response[3] < $response[4])) {
                            $matchStatus = "Lost";
                            $alliance = "Red";
                            $r2 = '<strong>';
                        } elseif (($response[7] == $detail) && ($response[3] < $response[4])) {
                            $matchStatus = "Lost";
                            $alliance = "Red";
                            $r3 = '<strong>';
                        } elseif (($response[8] == $detail) && ($response[3] > $response[4])) {
                            $matchStatus = "Lost";
                            $alliance = "Blue";
                            $b1 = '<strong>';
                        } elseif (($response[9] == $detail) && ($response[3] > $response[4])) {
                            $matchStatus = "Lost";
                            $alliance = "Blue";
                            $b2 = '<strong>';
                        } elseif (($response[10] == $detail) && ($response[3] > $response[4])) {
                            $matchStatus = "Lost";
                            $alliance = "Blue";
                            $b3 = '<strong>';
                        }
                    }
                    
                    
                    #<td><a href="http://scouting.dbztech.com/Analytics/analytics.php?view=team&detail='.$response[5].'">'.$response[5].'</a>, <a href="http://scouting.dbztech.com/Analytics/analytics.php?view=team&detail='.$response[6].'">'.$response[6].'</a>, <a href="http://scouting.dbztech.com/Analytics/analytics.php?view=team&detail='.$response[7].'">'.$response[7].'</a></td>
                    #<td>'.$response[8].', '.$response[9].', '.$response[10].'</td>
                    
                    echo '<tr><td class="event">'.$response[0].'</td>
                    <td class="'.$alliance.'">'.$response[1].'</td>
                    <td class="'.$matchStatus.'">
                        <a href="http://scouting.dbztech.com/Analytics/analytics.php?view=match&detail='.str_replace("#", "", $response[0]).'_'.$response[1].'_'.$response[2].'">'.$response[2].'</a></td>
                    <td class="redscore">'.$response[3].'</td>
                    <td class="bluescore">'.$response[4].'</td>
                    <td class="redalliance">';
                        echo $r1.'<a href="/Analytics/analytics.php?view=team&detail='.$response[5].'">'.$response[5].'</a></strong>, '; 
                        echo $r2.'<a href="/Analytics/analytics.php?view=team&detail='.$response[6].'">'.$response[6].'</a></strong>, ';
                        echo $r3.'<a href="/Analytics/analytics.php?view=team&detail='.$response[7].'">'.$response[7].'</a></strong></td>';
                    echo '<td class="bluealliance">';
                        echo $b1.'<a href="/Analytics/analytics.php?view=team&detail='.$response[8].'">'.$response[8].'</a></strong>, ';
                        echo $b2.'<a href="/Analytics/analytics.php?view=team&detail='.$response[9].'">'.$response[9].'</a></strong>, ';
                        echo $b3.'<a href="/Analytics/analytics.php?view=team&detail='.$response[10].'">'.$response[10].'</a></strong></td>';
                    echo '<td>'.$response[11].'</td>
                    <td>'.$response[12].'</td>
                    <td>'.$response[15].'</td>
                    <td>'.$response[16].'</td>
                    <td>'.$response[17].'</td>
                    <td>'.$response[18].'</td>
                    <td>'.$response[13].'</td>
                    <td>'.$response[14].'</td></tr>';
                }
                echo '</table><br />';


                echo '<table border="1"><th>Event</th><th>Team Number</th><th>Match Number</th><th>Match Type</th><th>Overall</th><th>Schooting</th><th>Lifting</th><th>Autonymous</th><th>Penalties</th><th>Comments</th>';
                foreach ($data[5] as $response) {
                    echo '<tr><td>'.$response[0].'</td><td>'.$response[1].'</td><td>'.$response[2].'</td><td>'.$response[3].'</td><td>'.$response[4].'</td><td>'.$response[5].'</td><td>'.$response[6].'</td><td>'.$response[7].'</td><td>'.$response[9].'</td><td>'.$response[10].'</td></tr>';
                }
                echo '</table>';
?>
