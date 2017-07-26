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

$servername = "localhost";
$dbname = "infoel_snac";



	
	if (isset ($_POST['elev']) && !empty ($_POST['elev'])) 
	{
		$elev = $_POST['elev'];
	} else 
	{
    die("Lipsesc date");
	}
		
	if (isset ($_POST['ore']) && !empty ($_POST['ore'])) 
	{
		$ore = $_POST['ore'];
	} else 
	{
    die("Lipsesc date");
	}
if (isset ($_SESSION['activitate']) && !empty ($_SESSION['activitate'])) 
	{
		$activitate = $_SESSION['activitate'];
	} else 
	{
    die("Lipsesc date");
	}
	

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", "infoel_snac", "snac2017");
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $sql = "INSERT INTO actions (id_activity, id_user, hours) VALUES ( '$activitate', '$elev', '$ore')";
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