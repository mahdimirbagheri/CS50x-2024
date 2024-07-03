<?php
include("includes/header2.php");

if(isset($_POST['username']) && !empty($_POST['username']) &&
isset($_POST['password']) && !empty($_POST['password']))
{
	$username = $_POST['username'];
	$password = $_POST['password'];
}
else
	exit("Some fields are not set");

$link = mysqli_connect("localhost","root","","cs50");

if(mysqli_connect_errno())
	exit("Error description :".mysqli_connect_error());

$query = "SELECT*FROM cs50.users 
		WHERE Username = '$username' AND Password = '$password'";

$result = mysqli_query($link,$query);

$row = mysqli_fetch_array($result);

if($row)
{
    $_SESSION["state_login"]=true;
    $_SESSION["name"]=$row['name'];
	$_SESSION["username"] = $row['username'];
	
	
	if($row["type"]==0)
    $_SESSION["user_type"]="public";
		
    elseif($row["type"]==1){
    $_SESSION["user_type"]="admin";
	?>
			<script type="text/javascript">
				<!--
    			location.replace("Admin products.php");
    			-->
			</script>
	<?php
		}
		
	echo("<p style='color:green;font-family: 'B Nazanin';'>
	<b> Wellcome {$row['name']}</b></p>");
	
	if (isset($_SESSION["state_login"]) && $_SESSION["state_login"]===true)
	{
	?>
	<script type="text/javascript">
    <!--
    location.replace("index.php");
    -->
	</script>
	<?php
	}
}
else
	echo("<p style='color:red;font-family: 'B Nazanin';'><b>The username or password is incorrect</b></p>");
mysqli_close($link);

include("includes/footer2.php");
?>