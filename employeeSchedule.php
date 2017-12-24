<?php
session_start();
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>employeeSchedule</title>

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
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
            <a class = "navbar-brand" href="employee.html">Add Schedule</a>
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

define('DB_NAME', 'id4019241_users');
define('DB_USER', 'id4019241_jesus');
define('DB_PASSWORD', 'jesus242');
define('DB_HOST', 'localhost');

$link = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

$sql = "SELECT ID, month, day, hour, min, ehour, emin, user FROM datetime";

$result = $link->query($sql);

$name = $_SESSION['user'];

$i = 0;
$month = array();
$day = array();
$hour = array();
$min = array();
$ehour = array();
$emin = array();

if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		if ($name == $row["user"]) {
			$month[$i] = $row["month"];
			$day[$i] = $row["day"];
			$hour[$i] = $row["hour"];
			$min[$i] = $row["min"];
			$ehour[$i] = $row["ehour"];
			$emin[$i] = $row["emin"];
			$i++;
		}
	}
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

mysqli_close($link);

?>

	<script src =
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="jquery.datetimepicker.full.js"></script>


  </body>
</html>