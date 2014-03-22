<?php
	$con=mysqli_connect("127.0.0.1","root","","4ww3movie");
	// Check connection
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }

	$result = mysqli_query($con,"SELECT * FROM award");

	while($row = mysqli_fetch_array($result))
	  {
	  	$id = $row["award_id"];
	  	$n = $row["name"] . " for " . $row["reason"];
	  	echo '<option id ="textForm" value = ' . $id . '>'. $n . '</option>';	  	
	  }

	mysqli_close($con);
?>