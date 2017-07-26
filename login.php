<?php

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
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
if (isset ($_POST['username']) && !empty ($_POST['username'])) 
	{
		$musername = $_POST['username'];
	} else 
	{
    echo 'Error: username not provided!';
	}
	if (isset ($_POST['password']) && !empty ($_POST['password'])) 
	{
		$mpassword = $_POST['password'];
	} else 
	{
    echo 'Error: username not provided!';
	}
$servername = "localhost";
$username = "infoel_snac";
$password = "snac2017";
$dbname = "infoel_snac";

$r=0;

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", "infoel_snac", $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //$stmt = $conn->prepare("SELECT * FROM users"); 
	$stmt = $conn->prepare("SELECT  * FROM users WHERE (username='$musername' AND password='$mpassword')"); 
	
    $stmt->execute(); 

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
        	$r++;
	
    }
	if($r>0)
	{	
		echo"admis";
	}else	
	{
		echo"respins";
	}
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", "infoel_snac", $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //$stmt = $conn->prepare("SELECT * FROM users"); 
	$stmt = $conn->prepare("SELECT  * FROM users WHERE (username='$musername' AND password='$mpassword' AND type!='')"); 
	
    $stmt->execute(); 

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
	$data=$stmt->fetchAll();

//echo var_dump($data);		echo "DAte ";echo $data[0]["id_user"];
   
	if($r>0)
	{	
		//$data=$stmt->fetchAll();

		//echo var_dump($data);		
		//echo $data[0]["id_user"];
		//echo $data[0]["type"];
		$_SESSION["tip"] = $data[0]["type"];
		$_SESSION["id"] = $data[0]["id_user"];
		echo $_SESSION["tip"] ;
		echo $_SESSION["id"];
		echo '<br><br> Te-ai autentificat cu succes <br><a href="Home1.html">Revino la pagina initiala</a>';
	}else	
	{
		echo"respins";
	}
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

echo "</table>";



$conn = null;