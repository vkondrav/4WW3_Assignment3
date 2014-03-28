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
		$movieYear = $_REQUEST["movieYear"];
		$movieDescription = $_REQUEST["movieDescription"];

		
		if($movieTitle == "" and $movieYear == "" and $movieDescription == "")
		{
			$result = NULL;
		}
		else
		{
			$result = mysqli_query($con,"SELECT * FROM movie where title LIKE '%" . $movieTitle . "%' AND description LIKE '%" . $movieDescription . "%' AND year_released LIKE '%" . $movieYear . "%'");
		}

	}
	else
	{
		$searchTerm = $_REQUEST["searchTerm"];

		$result = mysqli_query($con,"SELECT * FROM movie where title LIKE '%" . $searchTerm . "%' OR description LIKE '%" . $searchTerm . "%' OR year_released LIKE '%" . $searchTerm . "%'");
	}

	echo '<tr><th>Title</th><th>Description</th><th>Year Released</th><th>Write Review</th></tr>';
	while($row = mysqli_fetch_array($result))
	  {
	  	$title = $row["title"];
	  	$description = $row["description"];
	  	$year_released = $row["year_released"];
	  	$movie_id = $row["movie_id"];
	  	echo '<tr id="t' . $movie_id . '"><td>' . $title . '</td><td>' . $description . '</td><td>' . $year_released . '</td><td><button id="'. $movie_id . '" name="review" type="button" class="btn btn-success">Review</button></td></tr>';
	  }

	mysqli_close($con);
?>