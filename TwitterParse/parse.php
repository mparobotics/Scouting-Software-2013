<!doctype html>
<html>
<head>
<title>Twitter Parser</title>
</head>
<body>

<?php

########################################
###   A Few Notes to the User        ###
### 1.  Input is not Validated	     ###
### 2.  Input is not Sanitized       ### 
### 3.  There is probably a better way #
###     (Left as an exercise to reader)#
###                                  ###
### You have been warned.  Good Luck ###
########################################

#Dummy Query
#$sql = "INSERT INTO `scouting2013`.`matchdata` (`Event`, `MatchType`, `MatchNumber`, `RedFinal`, `BlueFinal`, `Red1`, `Red2`, `Red3`, `Blue1`, `Blue2`, `Blue3`, `RedClimb`, `BlueClimb`, `RedFoul`, `BlueFoul`, `RedAuto`, `BlueAuto`, `RedTeleop`, `BlueTeleop`, `Id`, `Timestamp`) VALUES (\'#FRCDEV1\', \'P\', \'5\', \'189\', \'43\', \'12\', \'1\', \'6\', \'11\', \'9\', \'7\', \'40\', \'30\', \'0\', \'0\', \'72\', \'6\', \'77\', \'7\', NULL, NOW());";

include('classes.php');

/*
  $doc = new DOMDocument();
  $doc->load('https://api.twitter.com/1/statuses/user_timeline.rss?screen_name=frcfms');
  $arrFeeds = array();
  foreach ($doc->getElementsByTagName('item') as $node) {
    $itemRSS = array ( 
      
      'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
      //'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
      //'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue
      );
    array_push($arrFeeds, $itemRSS);
  }

*/




/**
 * @file
 * 
 */

/* Load required lib files. */
require_once('twitteroauth/twitteroauth.php');
require_once('config.php');

/* Create a TwitterOauth object with consumer/user tokens. */
$connection = new TwitterOAuth($consumerKey, $consumerSceret, $accessToken, $accessSecret);

/* If method is set change API call made. Test is called by default. */
$content = $connection->get('account/rate_limit_status');
echo "Current API hits remaining: {$content->remaining_hits}.<br />";

/* Get logged in user to help with tests. */
$user = $connection->get('account/verify_credentials');

$twitterUser = "frcfms";
$count = 175;

$data = $connection->get('statuses/user_timeline', array('screen_name' => $twitterUser, 'count' => $count));

$arrFeeds = array();

foreach ($data as $d) {
    #echo $d->text."<br />";
    array_push($arrFeeds, $d->text);
}

#print_r($arrFeeds);



//Sample Tweet to Parse
//#FRCDEV1 TY P MC 6 RF 50 BF 179 RA 5 10 8 BA 4 2 3 RC 30 BC 30 RFP 0 BFP 0 RAS 0 BAS 60 RTS 20 BTS 89

echo('<table><tr><td>Event</td><td>Match Type</td><td>Match Number</td><td>Red Alliance Score</td><td>Blue Alliance Score</td><td>Red Alliance Team One</td><td>Red Alliance Team Two</td><td>Red Alliance Team Three</td><td>Blue Alliance Team One</td><td>Blue Alliance Team Two</td><td>Blue Alliance Team Three</td><td>Red Climb Score</td><td>Blue Climb Score</td><td>Red Penalties</td><td>Blue Penalties</td><td>Red Auto Score</td><td>Blue Auto Score</td><td>Red Teleop Score</td><td>Blue Teleop Score</td></tr>');

//print_r($arrFeeds);

/*
for ( $counter = 1; $counter <= 20; $counter += 1) {
echo('<br />');
print_r ($arrFeeds[$counter]['desc']);
}
*/

$itemDesc = array();

$a = 0;
$i = 0;

foreach ($arrFeeds as $itemDesc) {
    
  
    $itemContent = explode(" ",$itemDesc);
    
    #print_r($itemContent);
    
    $matchLocation = $itemContent[0];
    $matchType = $itemContent[2];
    $matchNum = $itemContent[4];
    $matchRF = $itemContent[6];
    $matchBF = $itemContent[8];
      
    $matchROne = $itemContent[10];
    $matchRTwo = $itemContent[11];
    $matchRThr = $itemContent[12];
    
    $matchBOne = $itemContent[14];
    $matchBTwo = $itemContent[15];
    $matchBThr = $itemContent[16];
      
    $matchRC = $itemContent[18];
    $matchBC = $itemContent[20];
    $matchRPen = $itemContent[22];
    $matchBPen = $itemContent[24];
      
    $matchRAuto = $itemContent[26];
    $matchBAuto = $itemContent[28];
    $matchRTele = $itemContent[30];
    $matchBTele = $itemContent[32];
     
    $isthereSQL = "SELECT *  FROM `matchdata` WHERE `Event` = '".$matchLocation."' AND `MatchType` = '".$matchType."' AND `MatchNumber` = ".$matchNum; 

     
    $sql = "INSERT INTO `scouting2013`.`matchdata` (`Event`, `MatchType`, `MatchNumber`, `RedFinal`, `BlueFinal`, `Red1`, `Red2`, `Red3`, `Blue1`, `Blue2`, `Blue3`, `RedClimb`, `BlueClimb`, `RedFoul`, `BlueFoul`, `RedAuto`, `BlueAuto`, `RedTeleop`, `BlueTeleop`, `Id`, `Timestamp`) VALUES ('".$matchLocation."', '".$matchType."', '".$matchNum."', '".$matchRF."', '".$matchBF."', '".$matchROne."', '".$matchRTwo."', '".$matchRThr."', '".$matchBOne."', '".$matchBTwo."', '".$matchBThr."', '".$matchRC."', '".$matchBC."', '".$matchRPen."', '".$matchBPen."', '".$matchRAuto."', '".$matchBAuto."', '".$matchRTele."', '".$matchBTele."', NULL, NOW());";
    echo('<tr><td>'.$matchLocation.'</td><td>'.$matchType.'</td><td>'.$matchNum.'</td><td>'.$matchRF.'</td><td>'.$matchBF.'</td><td>'.$matchROne.'</td><td>'.$matchRTwo.'</td><td>'.$matchRThr.'</td><td>'.$matchBOne.'</td><td>'.$matchBTwo.'</td><td>'.$matchBThr.'</td><td>'.$matchRC.'</td><td>'.$matchBC.'</td><td>'.$matchRPen.'</td><td>'.$matchBPen.'</td><td>'.$matchRAuto.'</td><td>'.$matchBAuto.'</td><td>'.$matchRTele.'</td><td>'.$matchBTele.'</td></tr>');
     
     if (database::returnmultiplerows($isthereSQL)) {
         $a++;
     } else {
         database::writedata($sql);
     }
     
    $i++;
    flush();
     

}
echo "<br />";
echo $i." rows were processed"."<br />";
echo $a." rows were omitted";

?>

</body>
</html>