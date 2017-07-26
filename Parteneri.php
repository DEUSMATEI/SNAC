<?php
session_start();
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Id</th><th>Nume</th><th>Prenume</th><th>Email</th><th>Telefon</th></tr>";

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
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	if(isset($_SESSION['tip']))
	{
		if($_SESSION['tip']=="admin")
		{
			$stmt = $conn->prepare("SELECT * FROM partners"); 
		}else
		{
			$stmt = $conn->prepare("SELECT name, surname FROM partners"); 
		}
	}else
	{
		$stmt = $conn->prepare("SELECT name, surname FROM partners"); 
	}
    
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