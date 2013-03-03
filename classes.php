<?php
#Shared Class File

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

        if ($result) {
            while ($row = $result->fetch()) {
		      return($row);
            }
        }

		$dbh = NULL;
    }

    public static function returnmultiplerows($query) {
    	$dbh = database::sqlconn();

		$result = $dbh->query ($query);
        
        if ($result) {
            return $result->fetchAll();
        }

		$dbh = NULL;
    }
    
    public static function countRows($query) {
    	$dbh = database::sqlconn();

		$result = $dbh->query ($query);
        
        if ($result) {
            return count($result->fetchAll());
        }

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


class analytics
{
    public static function countArray($array) {
    	
    }
    
    public static function averageArray($array) {
    	
    }
    
    public static function getTeam($number) {
        $won = 5;
        $lost = 2;
        $pct = round((($won/($lost+$won))*100));
        $matches = analytics::getTeamMatches($number);
        $teamdata = analytics::getTeamData($number);
        $flags = "None";
        $data = Array($won, $lost, $pct, $matches, $teamdata, $flags);
        //print_r($data);
        return $data;
    }
    
    public static function getMatch($event, $type, $number) {
        #SELECT * FROM `matchdata` WHERE `Event` = "#FRCCAMA" AND `MatchType` = "Q" AND `MatchNumber` = 6
        $sql = "SELECT * FROM `matchdata` WHERE `Event` = '#".$event."' AND `MatchType` = '".$type."' AND `MatchNumber` = ".$number;
        $response = database::returnmultiplerows($sql);
        return $response;
    }
    
    public static function getStat($db,$cond) {
    
    }
    
    public static function getTeamData($number) {
        #SELECT * FROM `teamdata` WHERE `TeamNumber` = 1234
        $sql = "SELECT * FROM `teamdata` WHERE `TeamNumber` = ".$number;
        //echo $sql;
        $response = database::returnmultiplerows($sql);
        return $response;
    }
    
    public static function getTeamMatches($number) {
        #SELECT * FROM `matchdata` WHERE `Red1` = 701 OR `Red2` = 701 OR `Red3` = 701 OR `Blue1` = 701 OR `Blue2` = 701 OR `Blue3` = 701
        $sql = "SELECT * FROM `matchdata` WHERE `Red1` = ".$number." OR `Red2` = ".$number." OR `Red3` = ".$number." OR `Blue1` = ".$number." OR `Blue2` = ".$number." OR `Blue3` = ".$number;
        //echo $sql;
        $response = database::returnmultiplerows($sql);
        return $response;
    }
    
    public static function display($view, $detail) {
        if ($view == "event") {
            echo "Event";
        } elseif ($view == "team") {
            print_r(analytics::getTeam($detail));
        } elseif ($view == "match") {
            $data = explode("_",$detail);
            $response = analytics::getMatch($data[0], $data[1], $data[2]);
            echo '<table border="1"><th>Event</th><th>Type</th><th>Number</th><th>Red Score</th><th>Blue Score</th><th>Red Alliance</th><th>Blue Alliance</th><th>Red Climb</th><th>Blue Climb</th><th>Red Auto</th><th>Blue Auto</th><th>Red Teleop</th><th>Blue Teleop</th><th>Red Fouls</th><th>Blue Fouls</th>';
            echo '<tr><td>'.$response[0].'</td><td>'.$response[1].'</td><td>'.$response[2].'</td><td>'.$response[3].'</td><td>'.$response[4].'</td><td>'.$response[5].', '.$response[6].', '.$response[7].'</td><td>'.$response[8].', '.$response[9].', '.$response[10].'</td><td>'.$response[11].'</td><td>'.$response[12].'</td><td>'.$response[15].'</td><td>'.$response[16].'</td><td>'.$response[17].'</td><td>'.$response[18].'</td><td>'.$response[13].'</td><td>'.$response[14].'</td></tr></table>';
            //print_r($response);
        } elseif ($view == "stat") {
            echo "Stat";
        } elseif ($view == "trends") {
            echo "Trends";
        } elseif ($view == "leaderboards") {
            echo "Leaderboards";
        } else {
            echo "Invalid";
        }
    }
}
?>
