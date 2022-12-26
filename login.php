<?php
if(!isset($_SESSION)) {
    session_start();
}
include "db_handler.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <style>

        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body{
            font-family: "Open Sans";
            color: #6248;
        }
        section{
            background-image: url("https://www-cdn.najah.edu/media/filer_public_thumbnails/filer_public/71/ea/71eab57a-b2aa-448d-aec1-5aa3ec55eac5/image0.jpeg__1320x740_q95_crop_subject_location-1924%2C2171_subsampling-2_upscale.jpg");
            height: 100vh;
            width: 100%;
            background-size: cover;
            background-position: center center;
        }
        .form-container{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            width: 380px;
            padding: 50px 30px;
            border-radius: 10px;
            box-shadow:7px 7px 60px #62a8ea;
            background: azure;
        }
        h1{
            color: #62a8ea;
            font-size: 2em;
            text-transform: uppercase;
            text-align: center;
            margin-bottom: 2rem;
        }
        .control input{
            padding: 10px;
            font-size: 16px;
            display: block;
            width: 100%;
            color:#62a8ea;
            background: #ddd;
            outline: none;
            border: none;
            margin: 1em 0;

        }

        .control .btn{
            color: #fff;
            text-transform: uppercase;
            background: #62a8ea;
            opacity: .7;
            transition:opacity .3s ease;
            padding: 10px;
            font-size: 16px;
            display: block;
            width: 100%;

            outline: none;
            border: none;
            margin: 1em 0;



        }
        .btn:hover{
            background: #0b47c6;
            transition: all .5s;

        }
        p{
            text-align: center;
        }
        a{
            text-decoration: none;
            color: #62a8ea;
            opacity: .7;
        }
        a:hover{
            opacity: 1;
        }
    </style>

</head>
<body>

<?php
if(isset($_POST['submit'])) {

    $username = $_POST['userid'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$pass'";
    $result = mysqli_query($conn, $sql)  or die("Could not connect database " .mysqli_error($conn));

    if (!$row = $result->fetch_assoc()) {
        echo "<div class='login-form'>

          <h2>Incorrect Credentials Entered</h2>
          Username or Password is incorrect.<br><br>
          Click here to <a href='login.php'>retry</a></div>";
    }
}
?>

<section>
    <div  class="form-container">
        <h1>Login </h1>
        <form method="post">
            <div class="control">
                <label for="name">User ID</label>
                <input type="text" id="user" name="userid" >
            </div>
            <div class="control">
                <label for="psw">Password</label>
                <input type="password" id="pass" name="password">
            </div>

            <div class="control">
                <button type="submit" class="btn" name="submit" >Login</button>

            </div>
            <div>
                <a class="btn" href="MessageSystem/index.php" > Messages </a>
            </div>
        </form>
        <p><a href="PassRec.php">Forgot your password?</a></p>
    </div>
</section>


</body>
</html>



<?php
if(isset($_POST['submit'])) {

    $username = $_POST['userid'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$pass'";
    $result = mysqli_query($conn, $sql)  or die("Could not connect database " .mysqli_error($conn));

    if (!$row = $result->fetch_assoc()) {
        // ERROR MESSAGE SHOWS AT THE TOP OF THE PAGE
    } else {
        $_SESSION['id'] = $row['username'];

        if($row['rank'] == 'Admin' || $row['rank'] == 'prof' || $row['rank'] == 'Lecturer' || $row['rank'] == 'lecturer' || $row['rank'] == 'Student' || $row['rank'] == 'student') {

            $_SESSION['rank'] = $row['rank'];

            if(isset($_SESSION['rank'])) {
                if($_SESSION['rank'] == 'Admin' || $row['rank'] == 'prof') {
                    header("Location: home/profHome.php");
                }
                else if($_SESSION['rank'] == 'Lecturer' || $row['rank'] == 'lecturer') {
                    header("Location: home/lecturerHome.php");
                }
                else if($_SESSION['rank'] == 'Student' || $row['rank'] == 'student') {
                    header("Location: home/studentHome.php");
                }
            }
        }
        else {
            echo "Role not found.";
        }
    }
}
?>