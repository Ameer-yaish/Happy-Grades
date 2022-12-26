<!-- MAKE REMOVE STUDENT A POP UP INSTEAD OF A FORM IF POSSIBLE -->

<!DOCTYPE html>
<html>
	<?php 
		include "../includes/header.php";
		include "../includes/prof-navbar.php";
    include "../db_handler.php";
	?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
    <title></title>
</head>
<body>
<div class="container">
    <div class="row">
      <form class="form-horizontal" style="float: right;" action="view-students.php" method="post" name="export" enctype="multipart/form-data">
          <div class="form-group">

          </div>                    
        </form> 
    	<h1>List Of Students</h1>
    	<hr>      
        <div class="panel panel-primary filterable" style="border-color: #00bdaa;">
            <div class="panel-heading" style="background-color: #00bdaa;">
                <h3 class="panel-title">Students</h3>
                <div class="pull-right">
                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter Search</button>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr class="filters">
                        <th><input type="text" class="form-control" placeholder="Student ID" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Full Name" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Email" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Level" disabled></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM users WHERE rank = 'student'"; 
                        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                      
                        $output = '';
                        if(isset($_POST["query"]))
                        {
                         $search = mysqli_real_escape_string($conn, $_POST["query"]);
                         $query = "
                          SELECT * FROM users 
                          WHERE name LIKE '%".$search."%'
                          OR surname LIKE '%".$search."%' 
                          OR email LIKE '%".$search."%' 
                          OR username LIKE '%".$search."%' 
                          OR level LIKE '%".$search."%'  
                         ";
                        }
                        else
                        {

                          $query = "SELECT * FROM users WHERE rank='student' ORDER BY name asc";
                        }

                        $result = mysqli_query($conn, $query);
                        if(mysqli_num_rows($result) > 0)
                        {

                         while($row = mysqli_fetch_array($result))
                         {
                        $username = $row["username"];
                            
                          $output .= '
                           <tr>
                            <td>'.$row["id"].'</td>
                            <td>'.$row["name"]. ' ' .$row["surname"].'</td>
                            <td>'.$row["email"].'</td>
                            <td>'.$row["level"].'</td>
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
</html>

<style type="text/css">
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

<?php 
   if(isset($_POST["export"])){
     
      $result = "SELECT * FROM users WHERE rank = 'student'";
      $row = mysqli_query($conn, $result) or die(mysqli_error($conn));

      $fp = fopen('../spreadsheets/students.csv', 'w');

      while($val = mysqli_fetch_array($row, MYSQLI_ASSOC)){
          fputcsv($fp, $val);
      }
      fclose($fp); 
    }  
?>