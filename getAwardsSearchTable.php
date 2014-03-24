<?php
	$con=mysqli_connect("127.0.0.1","root","","4ww3movie");
	// Check connection
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }

	$searchTerm = $_REQUEST["searchTerm"];

	$result = mysqli_query($con,"SELECT * FROM award where name LIKE '%" . $searchTerm . "%' OR reason LIKE '%" . $searchTerm . "%'");

	while($row = mysqli_fetch_array($result))
	  {
	  	$name = $row["name"];
	  	$reason = $row["reason"];
	  	echo '<tr><td>' . $name . '</td><td>' . $reason . '</td></tr>';	  	
	  }

	mysqli_close($con);
?>