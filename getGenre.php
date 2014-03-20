<?php
	$con=mysqli_connect("127.0.0.1","root","","4ww3movie");
	// Check connection
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }

	$result = mysqli_query($con,"SELECT * FROM genre");

	while($row = mysqli_fetch_array($result))
	  {
	  	$n = $row["GENRE_NAME"];
	  	echo '<option id ="textForm">'. $n . '</option>';	  	
	  }

	mysqli_close($con);
?>