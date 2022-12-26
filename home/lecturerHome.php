<!DOCTYPE html>
<html>	
	<?php 
		include "../includes/lecturer-navbar.php";
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
					echo " "." Teacher " . $name  ;
				}
			?>
		</h1>
		<hr>
			<div>
				<button type="button" class="btn btn-success"><a href="../lecturer/view-modules.php">View Modules</a></button>
				<?php 
					$leader = $_SESSION['id'];

                     $select = "SELECT id FROM users WHERE username = '$leader'";
                     $res = mysqli_query($conn, $select);

                     while($getting = mysqli_fetch_array($res))
                     {
                        $leaderid = $getting['id'];
                     }

                     $query = "
                          SELECT DISTINCT module_code, module_name, description, assessment1, assessment2, assessment3 FROM module WHERE module_leader = '$leaderid' ORDER BY module_code asc
                         ";

                    $result = mysqli_query($conn, $query);
                    if(mysqli_num_rows($result) > 0) {
            	?>
					<button type="button" class="btn btn-danger"><a href="../lecturer/manage-module.php">Manage Modules</a></button>
				<?php
                    }
				?>
                <form method="post">
				<button type="submit" class="btn btn-primary"><a href="../lecturer/view-assessments.php">View Assessments</a></button>
				<button type="submit" class="btn btn-warning"><a href="../lecturer/view-marking-schemes.php">View Marking Schemes</a></button>
				<button type="submit" class="btn btn-info"><a href="../lecturer/view-students.php">View Students</a></button>





            </div>

		<br>
		<hr>
			<div>
				<h3>Students You Have Access To</h3>
				<div class="panel panel-primary filterable" style="border-color: #00bdaa;">
	            <div class="panel-heading" style="background-color: #00bdaa;">
	                <h3 class="panel-title">Assessments</h3>
	                <div class="pull-right">
	                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter Search</button>
	                </div>
	            </div>
	            <table class="table">
	                <thead>
	                    <tr class="filters">
	                        <th><input type="text" class="form-control" placeholder="Module Code" disabled></th>
	                        <th><input type="text" class="form-control" placeholder="Module Name" disabled></th>
	                        <th><input type="text" class="form-control" placeholder="Student ID" disabled></th>
	                       <!-- <th><input type="text" class="form-control" placeholder="Add Single Mark" disabled></th> -->
	                    </tr>
	                </thead>
	                <tbody>
	                    <?php
	                        $output = '';
	                        if(isset($_POST["query"]))
	                        {
	                         $search = mysqli_real_escape_string($conn, $_POST["query"]);
	                         $query = "
	                          SELECT * FROM lecturers 
	                          WHERE module_code LIKE '%".$search."%'
	                          OR module_name LIKE '%".$search."%' 
	                          OR student_id LIKE '%".$search."%' 
	                         ";
	                        }
	                        else
	                        {

	                         $query = "
	                          SELECT * FROM lecturers where lecturer_id = '$leaderid'
	                         ";
	                        }
	                        $result = mysqli_query($conn, $query);
	                        if(mysqli_num_rows($result) > 0)
	                        {
	                         while($row = mysqli_fetch_array($result))
	                         {   
	                        	 $lid = $row["lecturer_id"];                         
		                          $output .= '
		                           <tr>
		                            <td>'.$row["module_code"].'</td>
		                            <td>'.$row["module_name"].'</td>
		                            <td>'.$row["student_id"].'</td>
		       <!--                     <td>
		                            	<button type="button" class="btn btn-success"><a href="../lecturer/add-single-mark.php?id=' . $lid . '">Add Mark</a></button>
		                            </td> -->
	                              </tr>
		                          ';
	                         }
	                         echo $output;
	                        }
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
                            <th>Student id</th>

                            <th>Module Code</th>
                            <th>Assessment code</th>
                            <th>Assignment Name</th>
                            <th>Mark1</th>
                            <th>Mark2</th>
                            <th>Mark3</th>
                            <th>Final mark</th>
                            <th>Feedback</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $user = $_SESSION['id'];
                        $query = "SELECT id FROM users WHERE username = '$user'";

                        $res = mysqli_query($conn, $query); // SAVES 'sql' QUERY RESULT
                        $test = mysqli_fetch_array($res); // FETCHES THE DATA FROM THAT RESULT

                        $sid = $test['id']; // SAVES THE ARRAY AS A STRING

                        $sql = "SELECT module_code, sub_assessment, final_mark, feedback FROM marks";
                        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                        $check = mysqli_query($conn, $sql); // SAVES 'sql' QUERY RESULT
                        $acheck = mysqli_fetch_array($check); // FETCHES THE DATA FROM THAT

                        $mcode = $acheck['module_code'];

                        $state = "SELECT module_name FROM module WHERE module_code = '$mcode'";
                        $aresult = mysqli_query($conn, $state);

                        $acode = $acheck['sub_assessment'];

                        $astate = "SELECT `module_code`, `assessment_code`, `sub_assessment`, `student_id`, `mark1`, `mark2`, `mark3`, `final_mark`, `feedback` FROM `marks` WHERE 1";
                        $bresult = mysqli_query($conn, $astate);

                        $output = '';
                        while($row = mysqli_fetch_array($bresult)) {
                            $output .= '
	                    	<tr>
	                    	<td>'.$row["student_id"].'</td>
	                    	     <td>'.$row["module_code"].'</td>
		                    	<td>'.$row["assessment_code"].'</td>
		                    	<td>'.$row["sub_assessment"].'</td>
		                    	<td>'.$row["mark1"].'</td>
		                    	<td>'.$row["mark2"].'</td>
		                    	<td>'.$row["mark3"].'</td>  
		                    	<td>'.$row["final_mark"].'</td> 
		                    	<td>'.$row["feedback"].'</td> 
		                    	</tr>              
	                          ';

                            while($arow = mysqli_fetch_array($aresult)) {
                                $output .= '
		                          
		                          ';
                            }



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
    .filterable {
    margin-top: 15px;
    }
    .filterable .panel-heading .pull-right {
        margin-top: -20px;
    }
    .filterable .filters input[disabled] {
        background-color: transparent;
        border: none;
        cursor: auto;
        box-shadow: none;
        padding: 0;
        height: auto;
    }
    .filterable .filters input[disabled]::-webkit-input-placeholder {
        color: #333;
    }
    .filterable .filters input[disabled]::-moz-placeholder {
        color: #333;
    }
    .filterable .filters input[disabled]:-ms-input-placeholder {
        color: #333;
    }
</style>

<script type="text/javascript">
    $(document).ready(function(){
        $('.filterable .btn-filter').click(function(){
            var $panel = $(this).parents('.filterable'),
            $filters = $panel.find('.filters input'),
            $tbody = $panel.find('.table tbody');
            if ($filters.prop('disabled') == true) {
                $filters.prop('disabled', false);
                $filters.first().focus();
            } else {
                $filters.val('').prop('disabled', true);
                $tbody.find('.no-result').remove();
                $tbody.find('tr').show();
            }
        });

        $('.filterable .filters input').keyup(function(e){
            var code = e.keyCode || e.which;
            if (code == '9') return;

            var $input = $(this),
            inputContent = $input.val().toLowerCase(),
            $panel = $input.parents('.filterable'),
            column = $panel.find('.filters th').index($input.parents('th')),
            $table = $panel.find('.table'),
            $rows = $table.find('tbody tr');

            var $filteredRows = $rows.filter(function(){
                var value = $(this).find('td').eq(column).text().toLowerCase();
                return value.indexOf(inputContent) === -1;
            });

            $table.find('tbody .no-result').remove();
            
            $rows.show();
            $filteredRows.hide();
            if ($filteredRows.length === $rows.length) {
                $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
            }
        });
    });
</script>