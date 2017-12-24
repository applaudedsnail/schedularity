<?php
session_start();
?>
<html>
<head>
<title>employee</title>
</head>
<body>

<?php

$month = $_POST['month'];
$day = $_POST['day'];
$hour = $_POST['hour'];
$min = $_POST['min'];
$endTime = $_POST['eTime'];
$user = $_SESSION['user'];
$ehour = $_POST['ehour'];
$emin = $_POST['emin'];
/*
echo "You have submitted as a date: $month / $day <br>";
echo "You have submitted as a start time: $hour : $min <br>";
echo "You have submitted as a end time $ehour $emin: $endTime <br>";

echo "User is: $user <br>";
 */

define('DB_NAME', 'id4019241_users');
define('DB_USER', 'id4019241_jesus');
define('DB_PASSWORD', 'jesus242');
define('DB_HOST', 'localhost');

$link = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

$sql = $link->query("INSERT INTO datetime (month, day, hour, min, ehour, emin, user) VALUES ('$month', '$day', '$hour', '$min', '$ehour' , '$emin' , '$user')");

mysqli_close($link);

?>

<br>
<script type ='text/javascript'>
	alert("Availability Submitted");
	window.location.replace('https://schedularity.000webhostapp.com/employeeSchedule.php');
</script>
<br>
</font>


</body>
</html>