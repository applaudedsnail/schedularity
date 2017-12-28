<html>
<head>
<title>signUpEmployee</title>
</head>
<body>


<?php

define('DB_NAME', 'id4019241_users');
define('DB_USER', 'id4019241_jesus');
define('DB_PASSWORD', 'jesus242');
define('DB_HOST', 'localhost');

$link = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

$name = $_POST['name'];
$password = $_POST['password'];
$team = $_POST['team'];

$sql = $link->query("INSERT INTO employee (name, password, team, assignedHour) VALUES ('$name', '$password', '$team', '0')");

mysqli_close($link);

?>

<script type ='text/javascript'>
	alert('User Not Found');
	window.location.replace('https://schedularity.000webhostapp.com/signInEmployeeForm.html');
</script>;

</body>
</html>
