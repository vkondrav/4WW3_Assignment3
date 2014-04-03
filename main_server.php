<?php
	function movie($con)
	{
		$actorArray = $_REQUEST['actorArray'];
		$rolesArray = $_REQUEST['rolesArray'];
		$characterArray = $_REQUEST['characterArray'];
		$length = count($actorArray);

		$genreArray = $_REQUEST['genreArray'];
		$glength = count($genreArray);

		$review = mysqli_real_escape_string($con, $_REQUEST['review']);
        
        $title = mysqli_real_escape_string($con, $_REQUEST['title']);
        $description = mysqli_real_escape_string($con, $_REQUEST['description']);

		$sql="INSERT INTO movie (title, description, year_released, rating)
		VALUES
		('" . $title . "', '" . $description . "' ,'$_POST[year_released]','$_POST[rating]')";

		if (!mysqli_query($con,$sql))
		  {
		  die('Error: ' . mysqli_error($con));
		  }

		$movieID = mysqli_insert_id($con);

		if ($actorArray[0] != "NULL")
		{
			for ($i = 0; $i < $length; $i++)
			{
                $characterName = mysqli_real_escape_string($con, $characterArray[$i]);
				$sql="INSERT INTO role (actor_id, type, movie_id, character_name)
				VALUES
				(" . $actorArray[$i] . ", '" . $rolesArray[$i] . "' ," . $movieID . ", '" . $characterName . "')";

				if (!mysqli_query($con,$sql))
				  {
				  die('Error: ' . mysqli_error($con));
				  }
			}
		}

		if($genreArray[0] != "NULL")
		{
			for ($i = 0; $i < $glength; $i++)
			{
				$sql="INSERT INTO whatgenres (movie_id, genre_name)
				VALUES
				(" . $movieID . ", '" . $genreArray[$i] . "')";

				if (!mysqli_query($con,$sql))
				  {
				  die('Error: ' . mysqli_error($con));
				  }
			}
		}

		if($review != "NULL")
		{
			$sql="INSERT INTO review (movie_id, user_id, comments)
			VALUES 
			(" . $movieID . ", '" . $_SESSION['user_id'] . "', '" . $review . "')";

			if (!mysqli_query($con,$sql))
				  {
				  die('Error: ' . mysqli_error($con));
				  }
		}

		echo "1 record added as ID = " . $movieID;

		mysqli_close($con);
	}

	function getRolesSearchTable ($con)
	{
		$type = $_REQUEST["type"];

		if ($type == "true")
		{
			$movieTitle = mysqli_real_escape_string($con, $_REQUEST["movieTitle"]);
			$first_name = mysqli_real_escape_string($con, $_REQUEST["actorFirstName"]);
			$last_name = mysqli_real_escape_string($con, $_REQUEST["actorLastName"]);
			$character_name = mysqli_real_escape_string($con, $_REQUEST["characterName"]);
			$roleType = mysqli_real_escape_string($con, $_REQUEST["roleType"]);
			
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
			$searchTerm = mysqli_real_escape_string($con, $_REQUEST["searchTerm"]);

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
	}

	function movieReview($con)
	{
		$movie_id = $_REQUEST['movie_id'];
		$review = mysqli_real_escape_string($con, $_REQUEST['review']);

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
	}

	function person($con)
	{
		$movieArray = $_REQUEST['movieArray'];
		$rolesArray = $_REQUEST['rolesArray'];
		$characterArray = $_REQUEST['characterArray'];
		$length = count($movieArray);

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

		if ($movieArray[0] != "NULL")
		{
			for ($i = 0; $i < $length; $i++)
			{
				$characterName = mysqli_real_escape_string($con, $characterArray[$i]);
				$sql="INSERT INTO role (actor_id, type, movie_id, character_name)
				VALUES
				(" . $actorID . ", '" . $rolesArray[$i] . "' ," . $movieArray[$i] . ", '" . $characterName . "')";

				if (!mysqli_query($con,$sql))
				  {
				  die('Error 1: ' . mysqli_error($con));
				  }
			}
		}

		if ($awardArray[0] != "NULL")
		{
			for ($i = 0; $i < $alength; $i++)
			{
				echo $year_receivedArray[$i];
				$sql="INSERT INTO hasaward (actor_id, award_id, movie_id, year_received)
				VALUES
				(" . $actorID . ", " . $awardArray[$i] . ", " . $movieArray[$i] . ", '" . $year_receivedArray[$i] . "')";

				if (!mysqli_query($con,$sql))
				  {
				  die('Error 2:' . mysqli_error($con));
				  }
			}
		}

		echo "1 record added as ID = " . $actorID;

		mysqli_close($con);
	}

	function signIn($con)
	{
		$user_id = mysqli_real_escape_string($con, $_REQUEST['user_id']);
		$password = mysqli_real_escape_string($con, $_REQUEST['password']);

		$result = mysqli_query($con,"SELECT * FROM user WHERE user_id = '" . $user_id . "'") or die ("Error in query. " . mysql_error());

		$x = mysqli_num_rows($result); 

		if ($x == 1)
		{
			while($row = mysqli_fetch_array($result))
			{

				if($row['password'] == $password)
				{
					echo "success";
					$_SESSION['user_id'] = $user_id;
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
	}

	function award($con)
	{
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
			for ($i = 0; $i < $alength; $i++)
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

		echo "1 record added as ID = " . $awardID;

		mysqli_close($con);
	}

	function getAward($con)
	{
		$result = mysqli_query($con,"SELECT * FROM award");

		while($row = mysqli_fetch_array($result))
		  {
		  	$id = $row["award_id"];
		  	$n = $row["name"] . " for " . $row["reason"];
		  	echo '<option id ="textForm" value = ' . $id . '>'. $n . '</option>';	  	
		  }

		mysqli_close($con);
	}

	function getAwardTable($con)
	{
		$result = mysqli_query($con,"SELECT * FROM award");

		while($row = mysqli_fetch_array($result))
		  {
		  	$id = $row["award_id"];
		  	$n = $row["name"] . " for " . $row["reason"];
		  	echo '<tr><td>' . $id . '</td><td>' . $n . '</td></tr>';	  	
		  }

		mysqli_close($con);
	}

	function getAwardsSearchTable($con)
	{
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
	}

	function getGenre($con)
	{
		$result = mysqli_query($con,"SELECT * FROM genre");

		while($row = mysqli_fetch_array($result))
		  {
		  	$n = $row["genre_name"];
		  	echo '<option id ="textForm">'. $n . '</option>';	  	
		  }

		mysqli_close($con);
	}

	function getHasAwardSearchTable($con)
	{
		$type = $_REQUEST["type"];

		if ($type == "true")
		{
			$movieTitle = mysqli_real_escape_string($con, $_REQUEST["movieTitle"]);
			$first_name = mysqli_real_escape_string($con, $_REQUEST["actorFirstName"]);
			$last_name = mysqli_real_escape_string($con, $_REQUEST["actorLastName"]);
			$awardName = mysqli_real_escape_string($con, $_REQUEST["awardName"]);
			$awardReason = mysqli_real_escape_string($con, $_REQUEST["awardReason"]);

			
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
			$searchTerm = mysqli_real_escape_string($con, $_REQUEST["searchTerm"]);

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
	}

	function getMovies($con)
	{
		$result = mysqli_query($con,"SELECT * FROM movie");

		while($row = mysqli_fetch_array($result))
		  {
		  	$id = $row["movie_id"];
		  	$n = $row["title"] . " " . $row["year_released"];
		  	echo '<option id ="textForm" value = ' . $id . '>'. $n . '</option>';	  	
		  }

		mysqli_close($con);
	}

	function getMoviesSearchTable($con)
	{
		$type = $_REQUEST["type"];

		if ($type == "true")
		{
			$movieTitle = mysqli_real_escape_string($con, $_REQUEST["movieTitle"]);
			$movieYear = mysqli_real_escape_string($con, $_REQUEST["movieYear"]);
			$movieDescription = mysqli_real_escape_string($con, $_REQUEST["movieDescription"]);

			
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
			$searchTerm = mysqli_real_escape_string($con, $_REQUEST["searchTerm"]);

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
	}

	function getMoviesTable($con)
	{
		$result = mysqli_query($con,"SELECT * FROM movie");

		while($row = mysqli_fetch_array($result))
		  {
		  	$id = $row["movie_id"];
		  	$n = $row["title"] . " " . $row["year_released"];
		  	echo '<tr><td>' . $id . '</td><td>'. $n . '</td></tr>';	  	
		  }

		mysqli_close($con);
	}

	function getPersons($con)
	{
		$result = mysqli_query($con,"SELECT * FROM actor");

		while($row = mysqli_fetch_array($result))
		  {
		  	$id = $row["actor_id"];
		  	$n = $row["first_name"] . " " . $row["last_name"];
		  	echo '<option id ="textForm" value = ' . $id . '>'. $n . '</option>';	  	
		  }

		mysqli_close($con);
	}

	function getPersonsSearchTable($con)
	{
		$type = $_REQUEST["type"];

		if ($type == "true")
		{
			$first_name = mysqli_real_escape_string($con, $_REQUEST["actorFirstName"]);
			$middle_name = mysqli_real_escape_string($con, $_REQUEST["actorMiddleName"]);
			$last_name = mysqli_real_escape_string($con, $_REQUEST["actorLastName"]);
			$birth_date = mysqli_real_escape_string($con, $_REQUEST["actorBirthday"]);
			
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
			$searchTerm = mysqli_real_escape_string($con, $_REQUEST["searchTerm"]);

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
	}

	function getPersonsTable($con)
	{
		$result = mysqli_query($con,"SELECT * FROM actor");

		while($row = mysqli_fetch_array($result))
		  {
		  	$id = $row["actor_id"];
		  	$n = $row["first_name"] . " " . $row["last_name"];
		  	echo '<tr><td>' . $id . '</td><td>'. $n . '</td></tr>';	  	
		  }

		mysqli_close($con);
	}

	function getReviewSearchTable($con)
	{
		$type = $_REQUEST["type"];

		if ($type == "true")
		{
			$movieTitle = mysqli_real_escape_string($con, $_REQUEST["movieTitle"]);
			$user_id = mysqli_real_escape_string($con, $_REQUEST["user_id"]);
			$comments = mysqli_real_escape_string($con, $_REQUEST["comments"]);

			
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
			$searchTerm = mysqli_real_escape_string($con, $_REQUEST["searchTerm"]);

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
	}

	function getRoles($con)
	{
		$result = mysqli_query($con,"SELECT * FROM roletype");

		while($row = mysqli_fetch_array($result))
		  {
		  	$n = $row["type"];
		  	echo '<option id ="textForm">'. $n . '</option>';	  	
		  }

		mysqli_close($con);
	}

	session_start();
	$con=mysqli_connect("mysqlsrv1.cas.mcmaster.ca","kondrav","kondrav","kondrav");
	// Check connection
	if (mysqli_connect_errno())
	{
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$funct = $_REQUEST["funct"];

	switch ($funct) 
	{
	    case "moviephp":
	        movie($con);
	        break;
	    case "personphp":
	        person($con);
	        break;
	    case "movieReviewphp":
	        movieReview($con);
	        break;
	    case "getMoviesSearchTablephp":
	    	getMoviesSearchTable($con);
	    	break;
	    case "getPersonsSearchTablephp":
	    	getPersonsSearchTable($con);
	    	break;
	    case "getAwardsSearchTablephp":
	    	getAwardsSearchTable($con);
	    	break;
	    case "getRolesSearchTablephp":
	    	getRolesSearchTable($con);
	    	break;
	    case "getHasAwardSearchTablephp":
	    	getHasAwardSearchTable($con);
	    	break;
	    case "getReviewSearchTablephp":
	    	getReviewSearchTable($con);
	    	break;
	    case "signInphp":
	    	signIn($con);
	    	break;
	    case "awardphp":
	    	award($con);
	    	break;
	    case "getMoviesTablephp":
	    	getMoviesTable($con);
	    	break;
	    case "getPersonsTablephp":
	    	getPersonsTable($con);
	    	break;
	    case "getGenrephp":
	    	getGenre($con);
	    	break;
	    case "getAwardphp":
	    	getAward($con);
	    	break;
	    case "getMoviesphp":
	    	getMovies($con);
	    	break;
	    case "getPersonsphp":
	    	getPersons($con);
	    	break;
	    case "getRolesphp":
	    	getRoles($con);
	    	break;
	    case "getAwardTablephp":
	    	getAwardTable($con);
	    	break;
	    default:
	        echo "FAILURE";
	        break;
	}
?>