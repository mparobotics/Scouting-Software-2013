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
    
    public static function getAlliance($alliance) {
        $data = explode("_", $alliance);
        analytics::display("team", $data[0]);
        analytics::display("team", $data[1]);
        analytics::display("team", $data[2]);
    }
    
    public static function getTeam($number) {
        $matches = analytics::getTeamMatches($number);
        $teamdata = analytics::getTeamData($number);
        $flags = "None";
        $won = 0;
        $lost = 0;
        $tied = 0;
        foreach ($matches as $row) {
            if ($row[3] == $row[4]) {
                #Tie
                $tied++;
            } elseif ($row[3] > $row[4]) {
                #Red win
                if ($row[5] == $number) {
                    $won++;
                } elseif ($row[6] == $number) {
                    $won++;
                } elseif ($row[7] == $number) {
                    $won++;
                } else {
                    $lost++;
                }
            } elseif ($row[3] < $row[4]) {
                #Blue win
                if ($row[5] == $number) {
                    $lost++;
                } elseif ($row[6] == $number) {
                    $lost++;
                } elseif ($row[7] == $number) {
                    $lost++;
                } else {
                    $won++;
                }
            }
        }
        $pct = round((($won/($lost+$won+$tied))*100));
        $data = Array($won, $lost, $tied, $pct, $matches, $teamdata, $flags);
        //print_r($data);
        return $data;
    }
    
    public static function getMatch($event, $type, $number) {
        #SELECT * FROM `matchdata` WHERE `Event` = "#FRCCAMA" AND `MatchType` = "Q" AND `MatchNumber` = 6
        $sql = "SELECT * FROM `matchdata` WHERE `Event` = '#".$event."' AND `MatchType` = '".$type."' AND `MatchNumber` = ".$number." ORDER BY `MatchType` DESC , `MatchNumber` ASC";
        $response = database::returnmultiplerows($sql);
        return $response;
    }
    
    public static function getStat($db,$cond) {
    
    }
    
    public static function getTeamData($number) {
        #SELECT * FROM `teamdata` WHERE `TeamNumber` = 1234
        $sql = "SELECT * FROM `teamdata` WHERE `TeamNumber` = ".$number." ORDER BY `MatchType` DESC , `MatchNumber` ASC";
        //echo $sql;
        $response = database::returnmultiplerows($sql);
        return $response;
    }
    
    public static function getTeamMatches($number) {
        #SELECT * FROM `matchdata` WHERE `Red1` = 701 OR `Red2` = 701 OR `Red3` = 701 OR `Blue1` = 701 OR `Blue2` = 701 OR `Blue3` = 701
        $sql = "SELECT * FROM `matchdata` WHERE `MatchType` != 'P' AND (`Red1` = ".$number." OR `Red2` = ".$number." OR `Red3` = ".$number." OR `Blue1` = ".$number." OR `Blue2` = ".$number." OR `Blue3` = ".$number.") ORDER BY `MatchType` DESC , `MatchNumber` ASC";
        //echo $sql;
        $response = database::returnmultiplerows($sql);
        return $response;
    }
    
    public static function display($view, $detail) {
    	$filename = '../Views/'.$view.'.php';
    	//echo $filename.' ';
    	//echo "current working directory is -> ". getcwd().'<br /><br />';
    	//include('Views/'.$view.'.php');
    	if (file_exists($filename)) {
    		include($filename);
    	}
// 		  if ($view == "event") {
//             include '/Views/event.php';
//         } elseif ($view == "team") {
//         	include 'Views/team.php';
//         } elseif ($view == "match") {
//             include 'Views/match.php';
//         } elseif ($view == "stat") {
// 			include 'Views/stat.php';
//         } elseif ($view == "trends") {
//             include 'Views/trends.php'
//         } elseif ($view == "leaderboards") {
//             include 'Views/leaderboards.php';
//         } 
		elseif ($view == "alliance") {
            analytics::getAlliance($detail);
        } else {
            echo "Invalid";
        }
    }
}
?>
