<!DOCTYPE html>
<html>
<title>
Marcus Awesome Adventure
</title>
<link rel=stylesheet href="index.css" type="text/css">
<link href="img/ridium.jpg" rel="shortcut icon" type="image/x-icon">
<meta charset="utf-8">

<?php

session_start();
if( isset($_SESSION[$myusername]) )
{
header("location:index.php");
}

$host="lamber.se.mysql"; // Host name 
$username="lamber_se"; // Mysql username 
$password="goknul93"; // Mysql password 
$db_name="lamber_se"; // Database name 
$tbl_name="login"; // Table name 

// Har ansluter den till databasen
mysqli_connect("$host", "$username", "$password", "$db_name")or die("cannot connect"); 
//mysql_select_db("$db_name")or die("cannot select DB");

// Skyddar mot MySQL injection
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysqli_real_escape_string($myusername);
$mypassword = mysqli_real_escape_string($mypassword);
$sql="SELECT * FROM $tbl_name WHERE username='$myusername' and password='$mypassword'";
$loginresult=mysqli_query($sql);

$count=mysqli_num_rows($loginresult);

if($count==1){


session_start();

$_SESSION['myusername'] = $myusername; 
 

$vadfanduvill=1; // inge markvardigt
}
else
{
$vadfanduvill=0;
}



?>



<body>

<h1>Hej</h1>

</body>
</html>