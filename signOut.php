<?php
session_start();
?>
<html>
<head>
<title>signOut</title>
</head>
<body>

<?php
session_unset();
session_destroy();

?>

<script type ='text/javascript'>
	alert("Sign Out Successful");
	window.location.replace('https://schedularity.000webhostapp.com/index.html');
</script>
</body>
</html>
