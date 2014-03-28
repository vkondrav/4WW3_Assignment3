<?php
	session_start();
	$con=mysqli_connect("127.0.0.1","root","","4ww3movie");
	// Check connection
	if (mysqli_connect_errno())
	{
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$movie_id = $_REQUEST['movie_id'];
	$review = $_REQUEST['review'];

	if($review != "NULL")
	{
		$sql="INSERT INTO review (movie_id, user_id, comments)
		VALUES 
		(" . $movie_id . ", '" . $_SESSION['user_id'] . "', '" . $review . "')";

		if (!mysqli_query($con,$sql))
			  {
			  die('Error: ' . mysqli_error($con));
			  }
	}

	mysqli_close($con);
?>