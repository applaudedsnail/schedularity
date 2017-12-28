<?php
session_start();
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>managerSchedule</title>

    <!-- Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="jquery.datetimepicker.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>

  </head>
  <body>
  	<header class="navbar-inverse">
		<div class="container navbar-inverse">
			<nav class="navbar navbar-inverse">
		    <div class="container-fluid">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <a class="navbar-brand" href="manager.html">Add Shift</a>
		    </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">

            <li><a href="signOut.php">Sign Out</a></li>
          </ul>

          </div>
		  </nav>
	   </div>
	</header>
	<br>

  <?php
include "employee.inc";
define('DB_NAME', 'id4019241_users');
define('DB_USER', 'id4019241_jesus');
define('DB_PASSWORD', 'jesus242');
define('DB_HOST', 'localhost');

$link = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

$sql = "SELECT id, month, day, hour, min, ehour, emin, user, covered FROM shift";

$result = $link->query($sql);

$name = $_SESSION['user'];

//Stores information of shift
$i = 0;
$month = array();
$day = array();
$hour = array();
$min = array();
$ehour = array();
$emin = array();
$user = array();
$covered = array();

//Initializes information from employee schedulee
$i2 = 0;
$month2 = array();
$day2 = array();
$hour2 = array();
$min2 = array();
$ehour2 = array();
$emin2 = array();
$user2 = array();
$tshift = array();

$sql2 = "SELECT avail
			FROM datetime
				WHERE month = ? AND day = ?";

$stmt = $link->prepare($sql2);

$myEmployee = array();

//Stores information of shift
if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$user[$i] = $row["user"];
		$month[$i] = $row["month"];
		$day[$i] = $row["day"];
		$hour[$i] = $row["hour"];
		$min[$i] = $row["min"];
		$ehour[$i] = $row["ehour"];
		$emin[$i] = $row["emin"];
		$covered[$i] = $row["covered"];

		$myEmployee[$i] = new employee($user[$i], $day[$i], $month[$i], $hour[$i], $min[$i], $ehour[$i], $emin[$i], $covered[$i]);

		/*
			echo "This is user: $user[$i] <br>";

			$mTest = $month[$i];
			$dTest = $day[$i];

			echo "This is mTest: $mTest <br>";
			echo "This is dTest: $dTest <br>";

			$stmt->bind_param("ii", $mTest, $dTest);

			$stmt->execute();
			$stmt->bind_result($res);

			$tshift[$i] = $res;

			echo "This is: $tshift[$i] <br>";
		*/
		$i++;
	}
}
foreach ($myEmployee as $value) {
	if ($value->day == 6) {
		echo "Success <br>";
	}

}
var_dump($myEmployee);

/*

//Stores information from employee schedulee
if ($result2->num_rows > 0) {
while ($row = $result2->fetch_assoc()) {
$user2[$i2] = $row["user"];
$month2[$i2] = $row["month"];
$day2[$i2] = $row["day"];
$hour2[$i2] = $row["hour"];
$min2[$i2] = $row["min"];
$ehour2[$i2] = $row["ehour"];
$emin2[$i2] = $row["emin"];
$i2++;
}
}

//Stores information from employee
$i3 = 0;
$userHour = array();
$userEmployee = array();
$jesusHour = 0;
$joseHour = 0;
$davidHour = 0;
$currentUserHour = 0;
$currentLowHour = 999;
$winner = 0;
$selectHour = "SELECT id, name, password, team, assignedHour FROM employee";
$resultHour = $link->query($selectHour);

if ($resultHour->num_rows > 0) {
while ($row = $resultHour->fetch_assoc()) {
$userEmployee[$i3] = $row["name"];
$userHour[$i3] = $row["assignedHour"];
$i3++;
}
}

function canCover($intshiftIndex, $availabilityIndex) {
if ($month2[$availabilityIndex] == $month[$shiftIndex]){} else return FALSE;
if ($day2[$availabilityIndex] == $day[$shiftIndex]){} else return FALSE;
if ($hour2[$availabilityIndex] <= $hour[$shiftIndex]){} else return FALSE;
if ($min2[$availabilityIndex] <= $min[$shiftIndex]){} else return FALSE;
if ($ehour2[$availabilityIndex] >= $ehour[$shiftIndex]){} else return FALSE;
if ($emin2[$availabilityIndex] >= $emin[$shiftIndex]){} else return FALSE;

return TRUE;
}

for($sCount = 0; $sCount < $i; $sCount++)
{
if($covered[$sCount] == 0)
{
for ($aCount = 0; $aCount < $i2; $aCount++) {
$nameTime = $user2[$aCount];
for ($u = 0; $u < $i3; $u++)
{
if($nameTime == "Jesus Salcedo")
{
if($jesusHour == 0)
{
$jesusHour = $userHour[$u];
}
$currentUserHour = $jesusHour;
}
if($nameTime == "Jose Gonzalez")
{
if($joseHour == 0)
{
$joseHour = $userHour[$u];
}
$currentUserHour = $joseHour;
}
if($nameTime == "David Cruz")
{
if($davidHour == 0)
{
$davidHour = $userHour[$u];
}
$currentUserHour = $davidHour;
}
}

if (canCover($i, $i2) && $currentUserHour < $currentLowHour) {
$user[$sCount] = $user2[$aCount];
$currentLowHour = $currentUserHour;
}
}
for ($u = 0; $u < $i3; $u++)
{
if($user[$sCount] == "Jesus Salcedo")
{
$jesusHour = $jesusHour + 1;
$winner = $jesusHour;
break;
}
if($user[$sCount] == "Jose Gonzalez")
{
$joseHour = $joseHour + 1;
$winner = $joseHour;
break;
}
if($user[$sCount] == "David Cruz")
{
$davidHour = $davidHour + 1;
$winner = $davidHour;
break;
}
}
}

$currentLowHour = $winner;
}

echo "<table>";
echo "<tr>";
echo "<th>Name</th>";
echo "<th>Date</th>";
echo "<th>Start Time</th>";
echo "<th>End Time</th>";
echo "</tr>";

//Iterates through all the schedules the emplyoee submitted and makes a table for them
for ($x = 0; $x < $i; $x++) {
echo "<tr>";
//Makes a cloumn for their name
echo "<td>" . $name . "</td>";
//Makes a column for the date they are working
echo "<td>" . $month[$x] . "/" . $day[$x] . "</td>";
//Makes a column for the time they are working
//Checks to see if the time is before 10 mins because if it is then it adds a 0 before the minute
if ($min[$x] < 10) {
//Checks to see whether the time is am or pm and formats the time into 12 hour loop
if ($hour[$x] < 12) {
$temp = $hour[$x] % 12;
echo "<td>" . $temp . ":0" . $min[$x] . " am</td>";
} else {
$temp = $hour[$x] % 12;
echo "<td>" . $temp . ":0" . $min[$x] . " pm</td>";
}
} else {
//Checks to see whether the time is am or pm and formats the time into 12 hour loop
if ($hour[$x] < 12) {
$temp = $hour[$x] % 12;
echo "<td>" . $temp . ":" . $hour[$x] . " am</td>";
} else {
$temp = $hour[$x] % 12;
echo "<td>" . $temp . ":" . $hour[$x] . " pm</td>";
}
}
//Makes a column for the end time
//Checks to see if the end time is before 10 mins because if it is then it adds a 0 before the minute
if ($emin[$x] < 10) {
//Checks to see whether the time is am or pm and formats the time into 12 hour loop
if ($ehour[$x] < 12) {
$temp = $ehour[$x] % 12;
echo "<td>" . $temp . ":0" . $emin[$x] . " am</td>";
} else {
$temp = $ehour[$x] % 12;
echo "<td>" . $temp . ":0" . $emin[$x] . " pm</td>";
}
} else {
//Checks to see whether the time is am or pm and formats the time into 12 hour loop
if ($ehour[$x] < 12) {
$temp = $ehour[$x] % 12;
echo "<td>" . $temp . ":" . $emin[$x] . " am</td>";
} else {
$temp = $ehour[$x] % 12;
echo "<td>" . $temp . ":" . $emin[$x] . " pm</td>";
}
}
echo "</tr>";
}

echo "</table>";
 */

mysqli_close($link);

?>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="jquery.datetimepicker.full.js"></script>


  </body>
</html>
