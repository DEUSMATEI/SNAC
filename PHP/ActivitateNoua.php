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



	
	if (isset ($_POST['Proiect']) && !empty ($_POST['Proiect'])) 
	{
		$proiect = $_POST['Proiect'];
	} else 
	{
    die("Lipsesc date");
	}
	if (isset ($_POST['title']) && !empty ($_POST['title'])) 
	{
		$title = $_POST['title'];
	} else 
	{
    die("Lipsesc date");
	}
	if (isset ($_POST['place']) && !empty ($_POST['place'])) 
	{
		$place = $_POST['place'];
	} else 
	{
    die("Lipsesc date");
	}
if (isset ($_POST['date']) && !empty ($_POST['date'])) 
	{
		$date = $_POST['date'];
	} else 
	{
    die("Lipsesc date");
	}
	if (isset ($_POST['master']) && !empty ($_POST['master'])) 
	{
		$master = $_POST['master'];
	} else 
	{
    die("Lipsesc date");
	}
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", "infoel_snac", "snac2017");
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $sql = "INSERT INTO activityes (title, place, date, id_project, id_master) VALUES ('$title', '$place', '$date','$proiect', '$master')";
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