<?php
	$con=mysqli_connect("127.0.0.1","root","","4ww3movie");
	// Check connection
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }

	$searchTerm = $_REQUEST["searchTerm"];

	$result = mysqli_query($con,"SELECT * FROM movie where title LIKE '%" . $searchTerm . "%' OR description LIKE '%" . $searchTerm . "%' OR year_released LIKE '%" . $searchTerm . "%'");

	while($row = mysqli_fetch_array($result))
	  {
	  	$title = $row["title"];
	  	$description = $row["description"];
	  	$year_released = $row["year_released"];
	  	echo '<tr><td>' . $title . '</td><td>' . $description . '</td><td>' . $year_released . '</td></tr>';	  	
	  }

	mysqli_close($con);
?>