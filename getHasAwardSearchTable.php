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
		$first_name = $_REQUEST["actorFirstName"];
		$last_name = $_REQUEST["actorLastName"];
		$awardName = $_REQUEST["awardName"];
		$awardReason = $_REQUEST["awardReason"];

		
		if($movieTitle == "" and $awardName == "" and $awardReason == "" and $first_name == "" and $last_name == "")
		{
			$result = NULL;
		}
		else
		{
			$result = mysqli_query($con,"SELECT * FROM actor_movie_award where title LIKE '%" . $movieTitle . "%' AND first_name LIKE '%" . $first_name . "%' AND last_name LIKE '%" . $last_name . "%' AND name LIKE '%" . $awardName . "%' AND reason LIKE '%" . $awardReason . "%'");
		}
		
	}
	else
	{
		$searchTerm = $_REQUEST["searchTerm"];

		$result = mysqli_query($con,"SELECT * FROM actor_movie_award where title LIKE '%" . $searchTerm . "%' OR first_name LIKE '%" . $searchTerm . "%' OR last_name LIKE '%" . $searchTerm . "%' OR name LIKE '%" . $searchTerm . "%' OR reason LIKE '%" . $searchTerm . "%'");
	}

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