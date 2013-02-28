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
            return $result->fetch();
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
    public static function count($array) {
    	
    }
    
    public static function getTeam($number) {
    
    }
}
?>
