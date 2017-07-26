<?php

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
 if(isset($_SESSION['id']))
{
	if(isset($_SESSION['tip']))
	{
		if($_SESSION['tip']=="admin" or $_SESSION['tip']=="teacher" or $_SESSION['tip']=="moderator")
		{
			
		}else
		{
			die("Nu ai voie aici");
		}
	}else
	{
		die("Nu ai voie aici");
	}
}else
{
	die("Nu ai voie aici");
}
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Username</th><th>Firstname</th><th>Lastname</th></tr>";

class TableRows extends RecursiveIteratorIterator { 
    function __construct($it) { 
        parent::__construct($it, self::LEAVES_ONLY); 
    }

    function current() {
        return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() { 
        echo "<tr>"; 
    } 

    function endChildren() { 
        echo "</tr>" . "\n";
    } 
} 

$servername = "localhost";
$username = "infoel_snac";
$password = "snac2017";
$dbname = "infoel_snac";


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", "infoel_snac", $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM ((actions INNER JOIN users ON users.id_user=actions.id_user) INNER JOIN activityes ON activityes.id_activity=actions.id_activity)"); 
	
	
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
        echo $v;
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?>