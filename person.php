<?php
	$con=mysqli_connect("127.0.0.1","root","","4ww3movie");
	// Check connection
	if (mysqli_connect_errno())
	{
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$movieArray = $_REQUEST['movieArray'];
	$rolesArray = $_REQUEST['rolesArray'];
	$characterArray = $_REQUEST['characterArray'];
	$length = count($actorArray);

	$awardArray = $_REQUEST['awardArray'];
	$award_movieArray = $_REQUEST['award_movieArray'];
	$year_receivedArray = $_REQUEST['year_receivedArray'];
	$alength = count($award_movieArray);

	$sql="INSERT INTO actor (first_name, middle_name, last_name, date_of_birth)
	VALUES
	('$_POST[firstname]','$_POST[middlename]','$_POST[lastname]','$_POST[birthdate]')";

	if (!mysqli_query($con,$sql))
	  {
	  die('Error: ' . mysqli_error($con));
	  }

	$actorID = mysqli_insert_id($con);

	for ($i = 0; $i < $length; $i++)
	{
		$sql="INSERT INTO role (actor_id, type, movie_id, character_name)
		VALUES
		(" . $actorID . ", '" . $rolesArray[$i] . "' ," . $movieArray[$i] . ", '" . $characterArray[$i] . "')";

		if (!mysqli_query($con,$sql))
		  {
		  die('Error: ' . mysqli_error($con));
		  }
	}

	for ($i = 0; $i < $alength; $i++)
	{
		$sql="INSERT INTO hasaward (actor_id, award_id, movie_id, year_received)
		VALUES
		(" . $actorID . ", " . $awardArray[$i] . " ," . $movieArray[$i] . ", " . $year_receivedArray[$i] . ")";

		if (!mysqli_query($con,$sql))
		  {
		  die('Error: ' . mysqli_error($con));
		  }
	}

	echo "1 record added as ID = " . $actorID;

	mysqli_close($con);
?>