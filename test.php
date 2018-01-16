<html>
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
 <?php
 
session_start();

include "employee.inc";
include "shift.inc";
include "employeeSchedule.inc";
define('DB_NAME', 'id4019241_users');
define('DB_USER', 'id4019241_jesus');
define('DB_PASSWORD', 'jesus242');
define('DB_HOST', 'localhost');

$link = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

$sql = "SELECT id, month, day, hour, min, ehour, emin, user, covered FROM shift";

$sql2 = "SELECT id, month, day, hour, min, ehour, emin, user, avail FROM datetime";

$result = $link->query($sql);

$result2 = $link->query($sql2);

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
$avail = array();

$myEmployee = array();
$myShift = array();
$myEmployeeSchedule = array();

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

		$myShift[$i] = new shift($user[$i], $day[$i], $month[$i], $hour[$i], $min[$i], $ehour[$i], $emin[$i], $covered[$i]);

		$i++;
	}
}

//Stores information from employee schedulee
if ($result2->num_rows > 0) {
	while ($row2 = $result2->fetch_assoc()) {
		$user2[$i2] = $row2["user"];
		$month2[$i2] = $row2["month"];
		$day2[$i2] = $row2["day"];
		$hour2[$i2] = $row2["hour"];
		$min2[$i2] = $row2["min"];
		$ehour2[$i2] = $row2["ehour"];
		$emin2[$i2] = $row2["emin"];
		$avail[$i2] = $row2["avail"];
		$myEmployeeSchedule[$i2] = new employeeSchedule($user2[$i2], $day2[$i2], $month2[$i2], $hour2[$i2], $min2[$i2], $ehour2[$i2], $emin2[$i2], $avail[$i2]);

		$i2++;
	}
}

//Stores information from employee
$i3 = 0;
$userHour = array();
$userEmployee = array();
$currentUserHour = 0;
$currentLowHour = 999;

$selectHour = "SELECT name, assignedHour FROM employee";
$resultHour = $link->query($selectHour);

$scheduleList = array();

if ($resultHour->num_rows > 0) {
	while ($row = $resultHour->fetch_assoc()) {
		$userEmployee[$i3] = $row["name"];
		$userHour[$i3] = $row["assignedHour"];
		$myEmployee[$i3] = new employee($userEmployee[$i3], $userHour[$i3]);
		$i3++;
	}
}

function canCover($tempMyShift2, $tempEmployeeShift2) {
	if ($tempEmployeeShift2->month == $tempMyShift2->month) {
	} else {
		return FALSE;
	}

	if ($tempEmployeeShift2->day == $tempMyShift2->day) {} else {
		return FALSE;
	}

	if ($tempEmployeeShift2->hour <= $tempMyShift2->hour) {} else {
		return FALSE;
	}

	if ($tempEmployeeShift2->min <= $tempMyShift2->min) {} else {
		return FALSE;
	}

	if ($tempEmployeeShift2->endHour >= $tempMyShift2->endHour) {} else {
		return FALSE;
	}

	if ($tempEmployeeShift2->endMin >= $tempMyShift2->endMin) {} else {
		return FALSE;
	}

	return TRUE;
}

$employeeTaken = false;

for ($shiftCount = 0; $shiftCount < $i; $shiftCount++) {
	if ($covered[$shiftCount] == 0) {
		for ($availCount = 0; $availCount < $i2; $availCount++) {
			$tempMyShift2 = $myShift[$shiftCount];
			$tempEmployeeShift2 = $myEmployeeSchedule[$availCount];
			//Link the employee with his schedule
			foreach ($myEmployee as $value) {
				if ($value->name == $tempEmployeeShift2->name) {
					$tempEmployee = $value;
				}
			}
			if (canCover($tempMyShift2, $tempEmployeeShift2) && $tempEmployee->hoursAssigned < $currentLowHour) {
				$tempMyShift = $myShift[$shiftCount];
				$tempEmployeeShift = $myEmployeeSchedule[$availCount];

				$tempMyShift = $tempEmployeeShift;

				$user[$shiftCount] = $user2[$availCount];

				$scheduleList[$shiftCount] = $tempMyShift;

				$currentLowHour = $tempEmployee->hoursAssigned;
				$employeeTaken = true;
			} elseif (!$employeeTaken) {
				$tempMyShift = $myShift[$shiftCount];
				$tempMyShift->name = "Employee Not Available";
				$scheduleList[$shiftCount] = $tempMyShift;

			}
		}
		$employeeTaken = false;
	}
	$currentLowHour = $currentUserHour + 1;
	//Update Information
	foreach ($myEmployee as $value) {
		if ($value->name == $tempMyShift->name) {
			$value->hoursAssigned = $currentLowHour;
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

//Iterates through all the schedules the manager submitted and makes a table for them
for ($x = 0; $x < $i; $x++) {
	$tempScheduleList = $scheduleList[$x];
	echo "<tr>";
//Makes a cloumn for their name and date they are working
	echo "<td>" . $tempScheduleList->name . "</td>";
	echo "<td>" . $tempScheduleList->month . "/" . $tempScheduleList->day . "</td>";
//Makes a column for the time they are working
	//Checks to see if the time is before 10 mins because if it is then it adds a 0 before the minute
	if ($tempScheduleList->min < 10) {
//Checks to see whether the time is am or pm and formats the time into 12 hour loop
		if ($tempScheduleList->hour < 12) {
			echo "<td>" . $tempScheduleList->hour . ":0" . $tempScheduleList->min . " am</td>";
		} else {
			$temp = $tempScheduleList->hour % 12;
			if ($temp == 0) {
				$temp = 12;
			}
			echo "<td>" . $temp . ":0" . $tempScheduleList->min . " pm</td>";
		}
	} else {
		if ($tempScheduleList->hour < 12) {
			echo "<td>" . $tempScheduleList->hour . ":" . $tempScheduleList->min . " am</td>";
		} else {
			$temp = $tempScheduleList->hour % 12;
			if ($temp == 0) {
				$temp = 12;
			}

			echo "<td>" . $temp . ":" . $tempScheduleList->min . " pm</td>";
		}
	}
//Makes a column for the end time
	//Checks to see if the end time is before 10 mins because if it is then it adds a 0 before the minute
	if ($tempScheduleList->endMin < 10) {
//Checks to see whether the time is am or pm and formats the time into 12 hour loop
		if ($tempScheduleList->endHour < 12) {
			echo "<td>" . $tempScheduleList->endHour . ":0" . $tempScheduleList->endMin . " am</td>";
		} else {
			$temp = $tempScheduleList->endHour % 12;
			if ($temp == 0) {
				$temp = 12;
			}

			echo "<td>" . $temp . ":0" . $tempScheduleList->endMin . " pm</td>";
		}
	} else {
		if ($tempScheduleList->endHour < 12) {
			echo "<td>" . $tempScheduleList->endHour . ":" . $tempScheduleList->endMin . " am</td>";
		} else {
			$temp = $tempScheduleList->endHour % 12;
			if ($temp == 0) {
				$temp = 12;
			}

			echo "<td>" . $temp . ":" . $tempScheduleList->endMin . " pm</td>";
		}
	}
	echo "</tr>";
}

echo "</table>";

mysqli_close($link);

?>
</html>
