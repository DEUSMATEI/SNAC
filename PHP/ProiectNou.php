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



	
	if (isset ($_POST['Nume']) && !empty ($_POST['Nume'])) 
	{
		$titlu = $_POST['Nume'];
	} else 
	{
    die("Lipsesc date");
	}
	if (isset ($_POST['DataI']) && !empty ($_POST['DataI'])) 
	{
		$DataI = $_POST['DataI'];
	} else 
	{
    die("Lipsesc date");
	}
	if (isset ($_POST['DataF']) && !empty ($_POST['DataF'])) 
	{
		$DataF = $_POST['DataF'];
	} else 
	{
    die("Lipsesc date");
	}
	if (isset ($_POST['Descriere']) && !empty ($_POST['Descriere'])) 
	{
		$desc = $_POST['Descriere'];
	} else 
	{
    die("Lipsesc date");
	}
	


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", "infoel_snac", "snac2017");
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $sql = "INSERT INTO projects (title,description,date_start,date_end ,id_master) VALUES ('$titlu', '$desc','$DataI','$DataF','".$_SESSION['id']."')";
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