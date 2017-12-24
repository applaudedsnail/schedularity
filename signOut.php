<?php
session_start();
?>
<html>
<head>
<title>signOut</title>
</head>
<body>
<header> Sign Out Successful! <br> </header>

<?php
session_unset();
session_destroy();

?>

<font size='5'>
<a href="sign.html" class="btn btn-primary">Click Here</a>
</font>

</body>
</html>
