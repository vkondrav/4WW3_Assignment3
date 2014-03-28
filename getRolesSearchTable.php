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
		$character_name = $_REQUEST["characterName"];
		$roleType = $_REQUEST["roleType"];
		
		if($movieTitle == "" and $first_name == "" and $last_name == "" and $character_name == "" and $roleType == "")
		{
			$result = NULL;
		}
		else
		{
			$result = mysqli_query($con,"SELECT * FROM movie_actor where title LIKE '%" . $movieTitle . "%' AND character_name LIKE '%" . $character_name . "%' AND type LIKE '%" . $roleType . "%' AND first_name LIKE '%" . $first_name . "%' AND last_name LIKE '%" . $last_name . "%'");
		}
		
	}
	else
	{
		$searchTerm = $_REQUEST["searchTerm"];

		$result = mysqli_query($con,"SELECT * FROM movie_actor where title LIKE '%" . $searchTerm . "%' OR character_name LIKE '%" . $searchTerm . "%' OR type LIKE '%" . $searchTerm . "%' OR first_name LIKE '%" . $searchTerm . "%' OR last_name LIKE '%" . $searchTerm . "%'");
	}

	echo '<tr><th>Movie Title</th><th>Character Name</th><th>Role Type</th><th>First Name</th><th>Last Name</th></tr>';
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