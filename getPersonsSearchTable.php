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
		$first_name = $_REQUEST["actorFirstName"];
		$middle_name = $_REQUEST["actorMiddleName"];
		$last_name = $_REQUEST["actorLastName"];
		$birth_date = $_REQUEST["actorBirthday"];
		
		if($first_name == "" and $last_name == "" and $middle_name == "" and $birth_date == "")
		{
			$result = NULL;
		}
		else
		{
			$result = mysqli_query($con,"SELECT * FROM actor where first_name LIKE '%" . $first_name . "%' AND middle_name LIKE '%" . $middle_name . "%' AND last_name LIKE '%" . $last_name . "%' OR date_of_birth LIKE '%" . $birth_date . "%'");
		}
		
	}
	else
	{
		$searchTerm = $_REQUEST["searchTerm"];

		$result = mysqli_query($con,"SELECT * FROM actor where first_name LIKE '%" . $searchTerm . "%' OR middle_name LIKE '%" . $searchTerm . "%' OR last_name LIKE '%" . $searchTerm . "%' OR date_of_birth LIKE '%" . $searchTerm . "%'");
	}
	
	echo '<tr><th>First Name</th><th>Middle Name</th><th>Last Name</th><th>Birth Date</th></tr>';

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