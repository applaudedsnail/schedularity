<?php
session_start();
?>
<html>
<head>
<title>manager</title>
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
$blank = '';

define('DB_NAME', 'id4019241_users');
define('DB_USER', 'id4019241_jesus');
define('DB_PASSWORD', 'jesus242');
define('DB_HOST', 'localhost');

$link = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

$sql = $link->query("INSERT INTO shift(month, day, hour, min, ehour, emin, user, covered) VALUES ('$month', '$day', '$hour', '$min', '$ehour', '$emin','$blank' , '0')");

mysqli_close($link);

?>


<script type ='text/javascript'>
	alert("Availability Submitted");
	window.location.replace('https://schedularity.000webhostapp.com/managerSchedule.php');
</script>

</body>
</html>
