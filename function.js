	function myFunction(){
		date = document.getElementById('datetimepicker').value;
		var str = date;
    	var time = str.split(" ");
    	var hour = time[1].split(":");
    	var monthDay = time[0];
   		monthDay = monthDay.split("/");

   		document.getElementById('month').value = monthDay[1];
   		document.getElementById('day').value = monthDay[2];
   		document.getElementById('hour').value = hour[0];
   		document.getElementById('min').value = hour[1];

   		eTime = document.getElementById('eTime').value;
   		var h = eTime.split(":");
   		document.getElementById('ehour').value = h[0];
   		document.getElementById('emin').value = h[1];



	}
