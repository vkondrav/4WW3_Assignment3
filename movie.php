<?php
	$con=mysqli_connect("127.0.0.1","root","","4ww3movie");
	// Check connection
	if (mysqli_connect_errno())
	{
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$sql="INSERT INTO Movie (title, description, year_released, rating)
	VALUES
	('$_POST[title]','$_POST[description]','$_POST[year_released]','$_POST[rating]')";

	if (!mysqli_query($con,$sql))
	  {
	  die('Error: ' . mysqli_error($con));
	  }

	$movieID = mysqli_insert_id($con);
	echo "1 record added as ID = " . $movieID;

	mysqli_close($con);
?>