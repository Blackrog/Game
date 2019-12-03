<!DOCTYPE html>
<html>
<title>
Marcus Awesome Adventure
</title>
<link rel=stylesheet href="index.css" type="text/css"> <!-- lankar till css -->
<meta charset="utf-8"> <!-- bestammer verisonen/texttyp av dokumentet (kan inte skriva svenska bokstavar) -->
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
//mysqli_select_db("$db_name")or die("cannot select DB");

// Anvandar namn och losenord skickas (Fungerar inte i slut andan sa inge markvardigt)
$myusername=$_POST['username']; 
$mypassword=$_POST['password']; 

// Skyddar mot MySQL injection
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysqli_real_escape_string($myusername);
$mypassword = mysqli_real_escape_string($mypassword);
$sql="SELECT * FROM $tbl_name WHERE username='$myusername' and password='$mypassword'";
$loginresult=mysqli_query($sql);

// Den raknar tabel rad
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

<?php

$nisse=Marcus; // inge markvardigt
$balle=Lämber;

 
 if (isset($_POST['username'])) // Kollar om man ar inloggad (fungerar inte)
		{
		$loggainte=$_POST['username'];
		}
		else
		{
		$loggainte="Ej in loggad";
		}
		
if (isset($_POST['id'])) $roomid=$_POST['id']; 
	else
	$roomid=1;
?>	
<?php
$con=mysqli_connect("lamber.se.mysql","lamber_se","goknul93","lamber_se");
// Har kollar den om man kommer at databasen eller inte
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
 $result = mysqli_query($con,"SELECT * FROM locations where id = $roomid");
  
?>
<link href="img/ridium.jpg" rel="shortcut icon" type="image/x-icon"> <!-- Iconen som visas pa flikarna -->
<body>
<div id="experiment"> <!-- background bilderna som ror pa sig om man haller over dom -->
    <div id="background" data-alt=""></div>
</div>

<div class="ruta"> <!-- Det ar hela rutan omkring de andra rutorna -->

<div class="divbanner"> <!-- Banner bilds rutan -->

<div id="cf"> <!-- Bilderna i rutan (behovde gora en till div for animatonen) -->
<img class="bottom" src="img/bild2.jpg" alt=""/>
<img class="top" src="img/island.jpg" alt=""/>
</div>

</div>

<div class="divusername"> <!-- Har skriver du in anvandar namn och losen for att logga in (Lyckades inte fixa det) -->
<?php
//$usernametitta=$_SESSION['mysername'];

// echo $usernametitta;
// echo $vadfanduvill;
// echo $_POST['username'];
// echo $_POST['password'];
 echo $_SESSION['myusername'];

if ($vadfanduvill==0) // Har kollar den om ett varde ar = 0, om det ar skriver den ut det under annars skriver den ut Gustav. Den skriver ut inloggnings falten. (Inge viktigt)
	{
	echo '<form name="login" method="post" action="index.php">
	<br>
	Username:<input type="text" name="username" size=20 maxlength="65" class="optionfalt"><br><br>
	Password: <input type="password" name="password" size=20 maxlength="65" class="optionfalt">

	
	<input type="submit" name="Submit" value="Login" style="margin-top:10px" class="optionin">
    

	</form>';
	}
	else
	{
	echo 'gustav';
	}
?>

    <form action="http://lamber.se/game/register.html"> <!-- Register knappen, addresen den skickar dig till -->
        <input type="submit" value="Register" style="margin-top:1px" class="optionin">
    </form>
   
    
</div>

<div class="divmitt"> <!-- Rutan i mitten som innehaller texten -->
<img src="img/background.jpg" alt=""/> <!-- en bild som ger rutan lite mer djup -->
<table class="texttable">
<tr><td class=tdtext colspan=3>

<?php while($row = mysqli_fetch_array($result)) // Har hamtar den varden fran databasen till knapparna
  
  {
  $option1=$row['option1'];
  $option2=$row['option2'];
  $option3=$row['option3'];
//  echo $option3."option3";
//  echo $row['option1'] . ":Option<br>";
//  echo $row['id'] . ":ID<br>";
//  echo $roomid . "<br>";
// echo $row['id'] . "<br>";
  echo $row['roomnr'] . "<br>";
  echo nl2br( $row['roomstory']) . "<br>";
  
  }
 ?>
  
  
  </td></tr>
<tr> <td class="knappar"> <!-- den gor en tabel for option knapparna -->
	<form action="index.php" method="post"> <!-- skapar ett formular for knapparna som man klickar pa dom skickar den den vidare for sedan se vilket rum man kommer till -->
		<input type="hidden" name="id" value="<?php echo $option1; ?>"> <!-- skriv ut knappen med vardet fran kolumnen option 1 fran Mysql databasen. -->
		<input type="submit" value="Option 1" class="option">
    </form></td>	

		<td class="knappar"><?php if ($option2==0) // Om option 2 inte har nagot varde, avaktivera knappen. Om den har ett varde sa far den vardet fran kolumnen option 2.
						{ 
						echo '<input type="submit" disabled value="Option 2" class="optionav">';
						}
						else
						{
						echo '<form action="index.php" method="post">';
						echo '<input type="hidden" name="id" value="'.$option2.'">';
						echo '<input type="submit" value="Option 2" class="option">';
						}
					?>
		</form></td>
		
		<td class="knappar"><?php if ($option3==0) // Om option 3 inte har nagot varde, avaktivera knappen. Om den har ett varde sa far den vardet fran kolumnen option 3.
						{ 
						echo '<input type="submit" disabled value="Option 3" class="optionav">';
						}
						else
						{
						echo '<form action="index.php" method="post">';
						echo '<input type="hidden" name="id" value="'.$option3.'">';
						echo '<input type="submit" value="Option 3" class="option">';
						}
						
//		<input type="submit" value="Option 3">;' } 
?>
</form></td></tr>

		
</table>
</div>

<div class="divbotten"> <!-- Rutan langst ner som skriver ut Email addresen -->
<footer><h1>Email: Marcus (at) lamber.se</h1></footer>
    
</div>
</div>

<ul id="menu"> <!-- Menyn langst upp till vanster -->
    <li>
        <a>Menu</a>
        <ul>
            <li><a href="http://lamber.se/game/index.php">The Game</a></li>
            <li><a href="http://lamber.se/game/register.html">Register</a></li>
            <li><a href="http://lamber.se/game/email.html">Email me</a></li>
            <li><a href="http://lamber.se/game/video.html">Video</a></li>
        </ul>
    </li>
</ul>


</body>
</html>