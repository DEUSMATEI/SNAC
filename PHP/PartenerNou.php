<?php
session_start();
if(isset($_SESSION['id']))
{
	if(isset($_SESSION['tip']))
	{
		if($_SESSION['tip']=="admin")
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


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	session_start();     
    //Array to store validation errors
    $errmsg_arr = array();

    //Validation error flag
    $errflag = false;
	// email  VARCHAR( 50 ) NOT NULL , phone  VARCHAR( 50 ) NOT NULL 
	if (isset ($_POST['nume']) && !empty ($_POST['nume'])) 
	{
		$Nume = $_POST['nume'];
	} else 
	{
    die("Nu ai completat toate datele");
	}
	if (isset ($_POST['prenume']) && !empty ($_POST['prenume'])) 
	{
		$prenume = $_POST['prenume'];
	} else 
	{
   die("Nu ai completat toate datele");
	}
	if (isset ($_POST['email']) && !empty ($_POST['email'])) 
	{
		$email = $_POST['email'];
	} else 
	{
    die("Nu ai completat toate datele");
	}
	if (isset ($_POST['tel']) && !empty ($_POST['tel'])) 
	{
		$tel = $_POST['tel'];
	} else 
	{
  die("Nu ai completat toate datele");
	}
	


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", "infoel_snac", "snac2017");
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $sql = "INSERT INTO partners (name,surname,email,phone) VALUES ('$Nume','$prenume','$email','$tel')";
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