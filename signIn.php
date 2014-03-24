<?php

	$con=mysqli_connect("127.0.0.1","root","","4ww3movie");
	// Check connection
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }

	$user_id = $_REQUEST['user_id'];
	$password = $_REQUEST['password'];

	$result = mysqli_query($con,"SELECT * FROM user WHERE user_id = " . $user_id);

	$x = count($result);

	if ($x == 1)
	{
		while($row = mysqli_fetch_array($result))
		{
			if($row['password'] == $password)
			{
				echo "success";
			}
			else
			{
				echo "failure";
			}	  	
		}
	}
	else
	{
		echo "failure";
	}

	mysqli_close($con);

?>