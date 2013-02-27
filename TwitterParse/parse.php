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

#Basic database interaction class
class database
{
	#initialize variables. These are later changed in settings.php
    static protected $dbuser = 'scoutinguser';
    static protected $dbpassword = 'hunter3';
    #Do Not Set to localhost, does not work in all environments
    static protected $dbhost = '127.0.0.1';
    static protected $database = 'scouting2013';
    static protected $prefix = '';

	public static function setcredentials($user, $password, $host = '127.0.0.1', $db = 'scouting2013', $pre = '') {
    	// property declaration
    	$result = 'Credential(s) not set: ';
    	$error = 0;
    	if (is_string($user)) {
	    	database::$dbuser = $user;
	    } else {
    		$error = 1;
    		$result .= '$dbuser ';
    	}
    	
    	if (is_string($password)) {
	    	database::$dbpassword = $password;
	    } else {
    		$error = 1;
    		$result .= '$dbpassword ';
    	}
    	
    	if (!$error) {
    		database::$dbhost = $host;
    		database::$database = $db;
    		database::$prefix = $pre;
	    	$result = 'Success!';
	    } else {
	    	$result = 'Error!';
	    }

    	return $result;
    }
    
    public static function sqlconn() {	
		try {
    		$dbh = new PDO('mysql:host='.database::$dbhost.';dbname='.database::$database, database::$dbuser, database::$dbpassword);
    	}
    	catch (PDOException $e) {
			print ("Could not connect to server.n");
			die ("getMessage(): " . $e->getMessage () . "n");
		}
		return $dbh;
	}

    // method declaration
    public static function info() {
    	echo "Database: ".database::$database."<br />";
        echo "Database User: ".database::$dbuser."<br />";
        echo "Database Host: ".database::$dbhost."<br />";
        echo "Database Prefix: ".database::$prefix."<br />";
    }

    public static function test() {
    	$dbh = database::sqlconn();
    	if ($dbh) {
            echo "Connection Successful!";
    		return true;
    		$dbh = NULL;
    	}
    	else {
    		return false;
    	}
    }

    public static function returndata($query) {
    	$dbh = database::sqlconn();

		// Perform Query
		$result = $dbh->query ($query);


		while ($row = $result->fetch()) {
		    return($row);
		}

		$dbh = NULL;
    }

    public static function returnmultiplerows($query) {
    	$dbh = database::sqlconn();

		$result = $dbh->query ($query);

		return $result;

		$dbh = NULL;
    }

    public static function writedata($query) {
    	$dbh = database::sqlconn();

		// Perform Query
		try {
			$result = $dbh->exec ($query);
		}

		// Check result
		// This shows the actual query sent to MySQL, and the error. Useful for debugging.
  		catch (PDOException $e) {
			print ("Could not connect to server.n");
			die ("getMessage(): " . $e->getMessage () . "n");
		}

		return("Query Successful");

		$dbh = NULL;
    }
}







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

for ( $i = 0; $i < 20; $i++) {
 foreach ($arrFeeds[$i] as $itemDesc) {
  
  $itemContent = explode(" ",$itemDesc);
 
  $matchLocation = $itemContent[1];
  $matchType = $itemContent[3];
  $matchNum = $itemContent[5];
  $matchRF = $itemContent[7];
  $matchBF = $itemContent[9];
  
  $matchROne = $itemContent[11];
  $matchRTwo = $itemContent[12];
  $matchRThr = $itemContent[13];

  $matchBOne = $itemContent[15];
  $matchBTwo = $itemContent[16];
  $matchBThr = $itemContent[17];
  
  $matchRC = $itemContent[19];
  $matchBC = $itemContent[21];
  $matchRPen = $itemContent[23];
  $matchBPen = $itemContent[25];
  
  $matchRAuto = $itemContent[27];
  $matchBAuto = $itemContent[29];
  $matchRTele = $itemContent[31];
  $matchBTele = $itemContent[33];
     
     $sql = "INSERT INTO `scouting2013`.`matchdata` (`Event`, `MatchType`, `MatchNumber`, `RedFinal`, `BlueFinal`, `Red1`, `Red2`, `Red3`, `Blue1`, `Blue2`, `Blue3`, `RedClimb`, `BlueClimb`, `RedFoul`, `BlueFoul`, `RedAuto`, `BlueAuto`, `RedTeleop`, `BlueTeleop`, `Id`, `Timestamp`) VALUES ('".$matchLocation."', '".$matchType."', '".$matchNum."', '".$matchRF."', '".$matchBF."', '".$matchROne."', '".$matchRTwo."', '".$matchRThr."', '".$matchBOne."', '".$matchBTwo."', '".$matchBThr."', '".$matchRC."', '".$matchBC."', '".$matchRPen."', '".$matchBPen."', '".$matchRAuto."', '".$matchBAuto."', '".$matchRTele."', '".$matchBTele."', NULL, NOW());";
     echo $sql;
     echo('<tr><td>'.$matchLocation.'</td><td>'.$matchType.'</td><td>'.$matchNum.'</td><td>'.$matchRF.'</td><td>'.$matchBF.'</td><td>'.$matchROne.'</td><td>'.$matchRTwo.'</td><td>'.$matchRThr.'</td><td>'.$matchBOne.'</td><td>'.$matchBTwo.'</td><td>'.$matchBThr.'</td><td>'.$matchRC.'</td><td>'.$matchBC.'</td><td>'.$matchRPen.'</td><td>'.$matchBPen.'</td><td>'.$matchRAuto.'</td><td>'.$matchBAuto.'</td><td>'.$matchRTele.'</td><td>'.$matchBTele.'</td></tr>');
     

  }
}

?>

</body>
</html>