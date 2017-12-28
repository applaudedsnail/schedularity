<?php
session_start();
?>
<html>
<head>
<title>signInEmployee</title>
</head>
<body>


<?php

define('DB_NAME', 'id4019241_users');
define('DB_USER', 'id4019241_jesus');
define('DB_PASSWORD', 'jesus242');
define('DB_HOST', 'localhost');

$link = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

$sql = "SELECT id, name, password, team FROM employee";

$result = $link->query($sql);

$name = $_POST['name'];
$password = $_POST['password'];
$team = $_POST['team'];

$_SESSION["user"] = $name;

$f = "";

if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		if ($name == $row["name"] && $password == $row["password"] && $team == $row["team"]) {
			$f = "User Found";
		}
	}
}

if ($f == 'User Found') {
	echo "<script type ='text/javascript'>
    alert('User Found');
	window.location.replace('https://schedularity.000webhostapp.com/employeeSchedule.php');
	</script>";
} else {
	echo "<script type ='text/javascript'>
	alert('User Not Found');
	window.location.replace('https://schedularity.000webhostapp.com/signInEmployeeForm.html');
	</script>";
}

mysqli_close($link);

?>



</body>
</html>