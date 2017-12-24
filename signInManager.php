<?php
session_start();
?>
<html>
<head>
<title>signInManager</title>
</head>
<body>


<?php

define('DB_NAME', 'id4019241_users');
define('DB_USER', 'id4019241_jesus');
define('DB_PASSWORD', 'jesus242');
define('DB_HOST', 'localhost');

$link = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

$sql = "SELECT id, name, password, team FROM manager";

$result = $link->query($sql);

$v1 = $_POST['name'];
$v2 = $_POST['password'];
$v3 = $_POST['team'];

$_SESSION['user'] = $v1;

$f = "";

if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		if ($v1 == $row["name"] && $v2 == $row["password"] && $v3 == $row["team"]) {
			$f = "User Found";
		}
	}
}

if ($f == 'User Found') {
	echo "<script type ='text/javascript'>
	alert('User Found');
	window.location.replace('https://schedularity.000webhostapp.com/managerSchedule.php');
	</script>";
} else {
	echo "<script type ='text/javascript'>
	alert('User Not Found');
	window.location.replace('https://schedularity.000webhostapp.com/signInManagerForm.html');
	</script>";
}

mysqli_close($link);

?>



</body>
</html>