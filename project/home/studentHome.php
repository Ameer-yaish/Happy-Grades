<!DOCTYPE html>
<html>
	<?php 
	    include "../includes/header.php";
		include "../includes/student-navbar.php";
		include "../db_handler.php"; 
	?>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link rel="stylesheet" href="css/style.css?<?php echo time(); ?> /">
		<link rel="stylesheet" href="css/style1.css?<?php echo time(); ?> /">
		<link rel="stylesheet" href="css/tile.css?<?php echo time(); ?> /">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script> 
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
		<title>Home</title>
	</head>
	<body>
		<div class="container">
			<div class="wrapper">
			<h1>Welcome
			<?php
				$user = $_SESSION['id'];
				$sql = "SELECT * FROM users WHERE username = '$user'";
				$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

		        while($row = mysqli_fetch_array($result)) {
		        	$name = $row['name'];
					echo " "." Student " . $name ;
				}
			?>
		</h1>
		<hr>
			<h3>Modules You Are Enrolled For</h3>
            <div class="panel panel-primary filterable" style="border-color: #00bdaa;">
            <div class="panel-heading" style="background-color: #00bdaa;">
                <h3 class="panel-title">Modules:</h3>
            </div>
            <table class="table">
                <thead>
                    <tr class="filters">
                        <th>Module Code</th>
                        <th>Module Name</th>
                        <th>Module prof</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                	<?php 
                    	$user = $_SESSION['id']; 				
						$sql = "SELECT level FROM users WHERE username = '$user'"; 

						$res = mysqli_query($conn, $sql); // SAVES 'sql' QUERY RESULT
						$test = mysqli_fetch_array($res); // FETCHES THE DATA FROM THAT RESULT

						$level = $test['level']; // SAVES THE ARRAY AS A STRING
						$query = "SELECT * FROM module WHERE level = '$level'"; // SEARCHES THE 'module' TABLE BASED ON THE 'level' IN 'users' TABLE

						$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

						$output = '';				
				        while($row = mysqli_fetch_array($result)) {                               
	                    	$output .= '
	                    	<tr>
	                    	<td>'.$row["module_code"].'</td>
	                    	    <td>'.$row["module_name"].'</td>
	                        	
	                            <td>'.$row["module_leader"].'</td>';

	                            $lid = $row["module_leader"];


	                            $output .= '		                            
	                            	<td>'.$row["description"].'</td>
                        	</tr>                    
                          ';

	                    }
	                    echo $output;
                    ?>
                    </tbody>
                </table>
            </div>
            <hr>
			<h3>Marks and Feedback</h3>
            <div class="panel panel-primary filterable" style="border-color: #00bdaa;">
            <div class="panel-heading" style="background-color: #00bdaa;">
                <h3 class="panel-title">Marks:</h3>
            </div>
            <table class="table">
                <thead>
                    <tr class="filters">
                        <th>Module Code</th>
                        <th>Module Name</th>
                        <th>Assignment Name</th>
                        <th>weight</th>
                        <th>description</th>
                        <th>Deadline</th>


                    </tr>
                </thead>
                <tbody>
                	<?php  				
						$user = $_SESSION['id'];
						$query = "SELECT id FROM users WHERE username = '$user'";
						
						$res = mysqli_query($conn, $query); // SAVES 'sql' QUERY RESULT
						$test = mysqli_fetch_array($res); // FETCHES THE DATA FROM THAT RESULT

						$sid = $test['id']; // SAVES THE ARRAY AS A STRING

						$sql = "SELECT module_code, sub_assessment, final_mark, feedback FROM marks WHERE student_id = '$sid'"; 
						$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

						$check = mysqli_query($conn, $sql); // SAVES 'sql' QUERY RESULT
						$acheck = mysqli_fetch_array($check); // FETCHES THE DATA FROM THAT 

						$mcode = $acheck['module_code'];

						$state = "SELECT module_name FROM module WHERE module_code = '$mcode'";
						$aresult = mysqli_query($conn, $state);

						$acode = $acheck['sub_assessment'];

                    $query = "SELECT * FROM `assignment` WHERE `student id`='$sid' ";
                    $result = mysqli_query($conn, $query);
                    $output = '';
                    while($row = mysqli_fetch_array($result)) {
                        $output .= '
	                    	<tr>
	                    	<td>'.$row["course id"].'</td>
	                    	    <td>'.$row["course name"].'</td>
	                        	
	                            <td>'.$row["assignment name"].'</td>';




                        $output .= '		                            
	                            	<td>'.$row["weight"].'</td>
	                            	<td>'.$row["description"].'</td>
	                            	<td>'.$row["deadline"].'</td>
                        	</tr>                    
                          ';

                    }
                    echo $output;
                    ?>
                    </tbody>
                </table>
            </div>
		</div>
	</body>
	</div>
</html>

<style type="text/css">
	a, a:hover, a:active, a:visited { 
		color: white;
	}
</style>