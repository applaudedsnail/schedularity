<?php

class employeeSchedule
{
	public $name;
	public $day;
	public $month;
	public $hour;
	public $min;
	public $endHour;
	public $endMin;
	public $avail;

	function __construct($name, $day, $month, $hour, $min, $endHour, $endMin, $avail)
	{
		$this->name = $name;
		$this->day = $day;
		$this->month = $month;
		$this->hour = $hour;
		$this->min = $min;
		$this->endHour = $endHour;
		$this->endMin = $endMin;
		$this->avail = $avail;
	}
}



?>