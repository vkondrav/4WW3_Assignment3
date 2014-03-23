<?php
	$con=mysqli_connect("127.0.0.1","root","","4ww3movie");
	// Check connection
	if (mysqli_connect_errno())
	{
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$movieArray = $_REQUEST['movieArray'];
	$personsArray = $_REQUEST['personsArray'];
	$year_receivedArray = $_REQUEST['year_receivedArray'];
	$alength = count($movieArray);

	$sql="INSERT INTO award (name, reason)
	VALUES
	('$_POST[name]','$_POST[reason]')";

	if (!mysqli_query($con,$sql))
	  {
	  die('Error: ' . mysqli_error($con));
	  }

	$awardID = mysqli_insert_id($con);

	if ($movieArray[0] != "NULL")
	{
		for ($i = 0; $i < $length; $i++)
		{
			$sql="INSERT INTO hasaward (actor_id, award_id, movie_id, year_received)
			VALUES
			(" . $personsArray[$i] . ", '" . $awardID . "' ," . $movieArray[$i] . ", '" . $year_receivedArray[$i] . "')";

			if (!mysqli_query($con,$sql))
			  {
			  die('Error 1: ' . mysqli_error($con));
			  }
		}
	}

	if ($movieArray[0] != "NULL")
	{
		for ($i = 0; $i < $alength; $i++)
		{
			echo $year_receivedArray[$i];
			$sql="INSERT INTO hasaward (actor_id, award_id, movie_id, year_received)
			VALUES
			(" . $actorID . ", " . $awardID . ", " . $movieArray[$i] . ", '" . $year_receivedArray[$i] . "')";

			if (!mysqli_query($con,$sql))
			  {
			  die('Error 2:' . mysqli_error($con));
			  }
		}
	}

	echo "1 record added as ID = " . $awardID;

	mysqli_close($con);
?>