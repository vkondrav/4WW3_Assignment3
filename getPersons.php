<?php
	$con=mysqli_connect("127.0.0.1","root","","4ww3movie");
	// Check connection
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }

	$result = mysqli_query($con,"SELECT * FROM actor");

	while($row = mysqli_fetch_array($result))
	  {
	  	$id = $row["ACTOR_ID"];
	  	$n = $row["FIRST_NAME"] . " " . $row["LAST_NAME"];
	  	echo '<option id ="textForm" value = ' . $id . '>'. $n . '</option>';	  	
	  }

	mysqli_close($con);
?>