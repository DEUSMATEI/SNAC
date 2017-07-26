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
	
	if (isset ($_POST['username']) && !empty ($_POST['username'])) 
	{
		$username = $_POST['username'];
	} else 
	{
    echo 'Error: username not provided!';
	}
	if (isset ($_POST['nume']) && !empty ($_POST['nume'])) 
	{
		$nume = $_POST['nume'];
	} else 
	{
    echo 'Error: nume not provided!';
	}
	if (isset ($_POST['prenume']) && !empty ($_POST['prenume'])) 
	{
		$prenume = $_POST['prenume'];
	} else 
	{
    echo 'Error: prenume not provided!';
	}
	if (isset ($_POST['email']) && !empty ($_POST['email'])) 
	{
		$email = $_POST['email'];
	} else 
	{
    echo 'Error: email not provided!';
	}
	if (isset ($_POST['parola']) && !empty ($_POST['parola'])) 
	{
		$parola = $_POST['parola'];
	} else 
	{
    echo 'Error: parola not provided!';
	}
	if (isset ($_POST['tel']) && !empty ($_POST['tel'])) 
	{
		$tel = $_POST['tel'];
	} else 
	{
    echo 'Error: telefon not provided!';
	}
	
	if(isset($_POST['tip']))
	{
		$tip = $_POST['tip'];  // Storing Selected Value In Variable
	}

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", "infoel_snac", "snac2017");
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $sql = "INSERT INTO users (username,password,surname,forename,email,phone,type,custom_password,active) VALUES ('$username','$parola','$nume','$prenume','$email','$tel','$tip', 'pending','yes')";
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