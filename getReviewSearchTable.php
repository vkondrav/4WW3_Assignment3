<?php
	$con=mysqli_connect("127.0.0.1","root","","4ww3movie");
	// Check connection
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }

	$searchTerm = $_REQUEST["searchTerm"];

	$result = mysqli_query($con,"SELECT * FROM movie_review where title LIKE '%" . $searchTerm . "%' OR user_id LIKE '%" . $searchTerm . "%' OR comments LIKE '%" . $searchTerm . "%'");

	echo '<tr><th>Movie Title</th><th>User ID</th><th>Comments</th></tr>';
	while($row = mysqli_fetch_array($result))
	  {
	  	$title = $row["title"];
	  	$user_id = $row["user_id"];
	  	$comments = $row["comments"];
	  	echo '<tr><td>' . $title . '</td><td>' . $user_id . '</td><td>' . $comments . '</td></tr>';	  	
	  }

	mysqli_close($con);
?>