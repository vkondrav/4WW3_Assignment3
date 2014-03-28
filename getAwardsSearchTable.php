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
		$awardName = $_REQUEST["awardName"];
		$awardReason = $_REQUEST["awardReason"];
		
		if($awardName == "" and $awardReason == "")
		{
			$result = NULL;
		}
		else
		{
			$result = mysqli_query($con,"SELECT * FROM award where name LIKE '%" . $awardName . "%' AND reason LIKE '%" . $awardReason . "%'");
		}		
	}
	else
	{
		$searchTerm = $_REQUEST["searchTerm"];

		$result = mysqli_query($con,"SELECT * FROM award where name LIKE '%" . $searchTerm . "%' OR reason LIKE '%" . $searchTerm . "%'");
	}

	echo '<tr><th>Name</th><th>Reason</th></tr>';
	while($row = mysqli_fetch_array($result))
	  {
	  	$name = $row["name"];
	  	$reason = $row["reason"];
	  	echo '<tr><td>' . $name . '</td><td>' . $reason . '</td></tr>';	  	
	  }

	mysqli_close($con);
?>