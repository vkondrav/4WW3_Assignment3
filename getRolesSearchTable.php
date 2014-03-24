<?php
	$con=mysqli_connect("127.0.0.1","root","","4ww3movie");
	// Check connection
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }

	$searchTerm = $_REQUEST["searchTerm"];

	$result = mysqli_query($con,"SELECT * FROM movie_actor where title LIKE '%" . $searchTerm . "%' OR character_name LIKE '%" . $searchTerm . "%' OR type LIKE '%" . $searchTerm . "%' OR first_name LIKE '%" . $searchTerm . "%' OR last_name LIKE '%" . $searchTerm . "%'");

	while($row = mysqli_fetch_array($result))
	  {
	  	$title = $row["title"];
	  	$character_name = $row["character_name"];
	  	$type = $row["type"];
	  	$first_name = $row["first_name"];
	  	$last_name = $row["last_name"];
	  	echo '<tr><td>' . $title . '</td><td>' . $character_name . '</td><td>' . $type . '</td><td>' . $first_name . '</td><td>' . $last_name . '</td></tr>';	  	
	  }

	mysqli_close($con);
?>