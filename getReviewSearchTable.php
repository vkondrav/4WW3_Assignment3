<?php
	$con=mysqli_connect("127.0.0.1","root","","4ww3movie");
	// Check connection
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }

	$type = $_REQUEST["type"];

	if ($type == "true")
	{
		$movieTitle = $_REQUEST["movieTitle"];
		$user_id = $_REQUEST["user_id"];
		$comments = $_REQUEST["comments"];

		
		if($movieTitle == "" and $user_id == "" and $comments == "")
		{
			$result = NULL;
		}
		else
		{
			$result = mysqli_query($con,"SELECT * FROM movie_review where title LIKE '%" . $movieTitle . "%' AND user_id LIKE '%" . $user_id . "%' AND comments LIKE '%" . $comments . "%'");
		}
		
	}
	else
	{
		$searchTerm = $_REQUEST["searchTerm"];

		$result = mysqli_query($con,"SELECT * FROM movie_review where title LIKE '%" . $searchTerm . "%' OR user_id LIKE '%" . $searchTerm . "%' OR comments LIKE '%" . $searchTerm . "%'");
	}


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