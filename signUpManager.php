<html>
<head>
<title>signUpManager</title>
</head>
<body>


<?php

define('DB_NAME', 'id4019241_users');
define('DB_USER', 'id4019241_jesus');
define('DB_PASSWORD', 'jesus242');
define('DB_HOST', 'localhost');

$link = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

$v1 = $_POST['name'];
$v2 = $_POST['password'];
$v3 = $_POST['team'];

$sql = $link->query("INSERT INTO manager (name, password, team) VALUES ('$v1', '$v2', '$v3')");

mysqli_close($link);

?>

<font size='5'>
<a href="signInManagerForm.html" class="btn btn-primary">Click Here</a>
</font>

</body>
</html>
