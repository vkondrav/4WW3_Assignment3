<?php
	$con=mysqli_connect("127.0.0.1","root","","4ww3movie");
	// Check connection
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }

	$searchTerm = $_REQUEST["searchTerm"];

	$result = mysqli_query($con,"SELECT * FROM actor where first_name LIKE '%" . $searchTerm . "%' OR middle_name LIKE '%" . $searchTerm . "%' OR last_name LIKE '%" . $searchTerm . "%' OR date_of_birth LIKE '%" . $searchTerm . "%'");

	while($row = mysqli_fetch_array($result))
	  {
	  	$first_name = $row["first_name"];
	  	$middle_name = $row["middle_name"];
	  	$last_name = $row["last_name"];
	  	$birth_date = $row["date_of_birth"];
	  	echo '<tr><td>' . $first_name . '</td><td>' . $middle_name . '</td><td>' . $last_name . '</td><td>' . $birth_date . '</td></tr>';	  	
	  }

	mysqli_close($con);
?>