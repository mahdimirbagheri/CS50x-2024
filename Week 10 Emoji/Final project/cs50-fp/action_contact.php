<?php
include ("includes/header2.php");


$link = mysqli_connect("localhost", "root", "", "cs50");

if (mysqli_connect_errno())
    exit("Erorr :" . mysqli_connect_error());

if (isset($_POST['detail']))
	$detail=$_POST['detail'];

if (isset($_SESSION['username']))
	$username=$_SESSION['username'];

$query = "INSERT INTO cs50.contacts (username,detail) VALUES ('$username','$detail')";

if (mysqli_query($link, $query) === true){
?>
<script type="text/javascript">
<!--
location.replace("index.php");
-->
</script>
<?php
}
else
    echo ("<p style='color:red;'><b>Erorr</b></p>");

mysqli_close($link);

include ("includes/footer.php");
?>