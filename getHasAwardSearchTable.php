<?php
	$con=mysqli_connect("127.0.0.1","root","","4ww3movie");
	// Check connection
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }

	$searchTerm = $_REQUEST["searchTerm"];

	$result = mysqli_query($con,"SELECT * FROM actor_movie_award where title LIKE '%" . $searchTerm . "%' OR first_name LIKE '%" . $searchTerm . "%' OR last_name LIKE '%" . $searchTerm . "%' OR name LIKE '%" . $searchTerm . "%' OR reason LIKE '%" . $searchTerm . "%'");

	echo '<tr><th>Title</th><th>Name</th><th>Award</th></tr>';
	while($row = mysqli_fetch_array($result))
	  {
	  	$title = $row["title"];
	  	$first_name = $row["first_name"];
	  	$last_name = $row["last_name"];
	  	$name = $row["name"];
	  	$reason = $row["reason"];
	  	echo '<tr><td>' . $title . '</td><td>' . $first_name . ' ' . $last_name . '</td><td>' . $name . ' for ' . $reason . '</td></tr>';	  	
	  }

	mysqli_close($con);
?>