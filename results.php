<?php 
session_start();
if (isset($_SESSION['username'])) 
{
?>
<!DOCTYPE html>
<html>
<head>
	<title>check</title>
	<!-- <style>
	.aaaa
	{
		border-collapse: collapse;
		width: 100%;
		height: 100%;
	}
	.b
	{
		top: 55%;
		left: 51%;
   	 	width:30em;
    		height:14em;
		margin-top: -32em;
    		margin-left: 90em;
	}
	.abc
	{
		top: 55%;
    		left: 51%;
   	 	width:31em;
    		height:15em;
		margin-top: 20em;
    		margin-left: 30em; 
	}
		body
		{
			background-image: url('Images/blood1.jpg');
			background-size: 1600px 1000px;
			background-repeat: no-repeat;
    			color:white ;
		}
		h1
		{
    			font-family: "Lucida Console", "Courier New", monospace;
		}
	</style> -->
</head>
<body>
	<div class="abc">
		<center>
			
			<h1><?php echo $_SESSION['username']; ?>,your slot has been booked successfully with <?php echo $_SESSION['ph_no'];?>,
		 	on <?php echo $_SESSION['date'];?>
		 	at <?php echo $_SESSION['hospital_name'];?>,<?php echo $_SESSION['area'];?> </h1>
		</center>
	</div>
	<div class='b'> 
		<a href="login.php">logout</a>
	</div>
    <a href="home.php">reschedule</a>
</body>
</html>
<?php 
}
else
{
     header("Location: home.php");
     exit();
}
?>