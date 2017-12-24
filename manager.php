<?php
session_start();
?>
<html>
<head>
<title>manager</title>
</head>
<body>

<?php
/*class Shifts {
public $month;
public $day;
public $hour;
public $min;
public $ehour;
public $emin;
public $user;
function Shifts($month, $day, $hour, $min, $ehour, $emin, $user) {
$this->$month = $month;
$this->$day = $day;
$this->$hour = $hour;
$this->$min = $min;
$this->$ehour = $ehour;
$this->$emin = $emin;
$this->$user = $user;
}
}
 */

$month = $_POST['month'];
$day = $_POST['day'];
$hour = $_POST['hour'];
$min = $_POST['min'];
$endTime = $_POST['eTime'];
$user = $_SESSION['user'];
$ehour = $_POST['ehour'];
$emin = $_POST['emin'];
$blank = '';

echo "You have submitted as a date: $month / $day <br>";
echo "You have submitted as a start time: $hour : $min <br>";
echo "You have submitted as a end time $ehour $emin: $endTime <br>";

//$ava = new Shifts($month, $day, $hour, $min, $ehour, $emin);

define('DB_NAME', 'id4019241_users');
define('DB_USER', 'id4019241_jesus');
define('DB_PASSWORD', 'jesus242');
define('DB_HOST', 'localhost');

$link = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

$sql = $link->query("INSERT INTO shift(month, day, hour, min, ehour, emin, user, covered) VALUES ('$month', '$day', '$hour', '$min', '$ehour', '$emin','$blank' , '0')");

mysqli_close($link);

?>

<br>
<a href='manager.html' class='btn btn-primary'> Submit another schedule? </a>
<br>
<br>
<a href ='managerSchedule.php' class = 'btn btn-primary'> Go to my schedule</a>
</font>


</body>
</html>
