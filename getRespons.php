<?php
	$con=mysqli_connect("127.0.0.1","root","","4ww3movie");
	// Check connection
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }

	$result = mysqli_query($con,"SELECT * FROM roletype");

	while($row = mysqli_fetch_array($result))
	  {
	  	$n = $row["TYPE"];
	  	echo '<option id ="textForm" value = "1">'. $n . '</option>';	  	
	  }

	mysqli_close($con);
?>