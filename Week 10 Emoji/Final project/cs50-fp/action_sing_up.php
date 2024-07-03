<?php
include("includes/header2.php");

if(isset($_POST['name']) && !empty($_POST['name']) &&
isset($_POST['lastname']) && !empty($_POST['lastname'])&&
isset($_POST['username']) && !empty($_POST['username'])&&
isset($_POST['password']) && !empty($_POST['password'])&&
isset($_POST['re_password']) && !empty($_POST['re_password'])&&
isset($_POST['email']) && !empty($_POST['email']))
{
	$name = $_POST['name'];
	$lastname = $_POST['lastname'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$re_password = $_POST['re_password'];	
	$email = $_POST['email'];	
}
else
	exit("Some fields are not set");
		
if($password != $re_password)
	exit("Its password and repetition are not the same");

$link = mysqli_connect("localhost","root","","cs50");

if(mysqli_connect_errno())
	exit("Error description :".mysqli_connect_error());

$query = "INSERT INTO cs50.users(name,lastname,username,password,email,Type)
VALUES('$name','$lastname','$username','$password','$email','0')";

if(mysqli_query($link,$query)===true)
{
	echo("<p style='color:green;font-family: 'B Nazanin';'><b>You are registered</b></p>");
	?>
	<script type="text/javascript">
    <!--
    location.replace("sing_in.php");
    -->
	</script>
	<?php
	
}
	else
		echo("<p style='color:red;font-family: 'B Nazanin';'><b>You are not registered</b></p>");

mysqli_close($link);

include("includes/footer2.php");
?>
