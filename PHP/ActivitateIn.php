<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
if(isset($_SESSION['id']))
{
	if(isset($_SESSION['tip']))
	{
		
	}else
	{
		die("Nu ai voie aici");
	}
}else
{
	die("Nu ai voie aici");
}

$servername = "localhost";
$dbname = "infoel_snac";



	
	if (isset ($_POST['activitate']) && !empty ($_POST['activitate'])) 
	{
		$activitate = $_POST['activitate'];
	} else 
	{
    die("Lipsesc date");
	}

	

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", "infoel_snac", "snac2017");
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $sql = "INSERT INTO regitrations (valide,id_activity, id_user) VALUES ('pending', '$activitate', '".$_SESSION['id']."')";
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "New record created successfully";
    }
	catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;

?>