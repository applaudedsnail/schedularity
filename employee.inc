<?php

class employee
{
	public $name;
	public $day;
	public $month;
	public $hour;
	public $min;
	public $endHour;
	public $endMin;
	public $covered;
	public $numHoursWorking;

	function __construct($name, $day, $month, $hour, $min, $endHour, $endMin, $covered)
	{
		$this->name = $name;
		$this->day = $day;
		$this->month = $month;
		$this->hour = $hour;
		$this->min = $min;
		$this->endHour = $endHour;
		$this->endMin = $endMin;
		$this->covered = $covered;
	}
}

?>