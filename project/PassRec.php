<?php
if(!isset($_SESSION))
{
    session_start();
}




include("db_handler.php");




$select= "select * from users";
$query = mysqli_query($conn, $select);
$data = mysqli_fetch_assoc($query);
$idnu = $data['id'];
if(isset($_POST['save'])) {
    $current = $_POST['current'];
    $new = $_POST['new'];
    $confirm = $_POST['confirm'];


    if ($current == $idnu) {
        if ($new == $confirm) {
            $update = "update users set password = '$new' where id = $current";
            $query1 = mysqli_query($conn, $update);
            if ($query1) {

                echo '<meta http-equiv="refresh" content="0;url=login.php">';
                echo '<script>alert("Your password changed successfully")</script>';
            }
        } else {

            echo '<meta http-equiv="refresh" content="0;url=PassRec.php">';
            echo '<script>alert("Your both passwords doesnt match")</script>';


        }
    } else {

        echo '<meta http-equiv="refresh" content="0;url=PassRec.php">';
        echo '<script>alert("identity number doesnt exist")</script>';
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password-Rec</title>
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
            background: #62a8ea;a
        opacity: .7;
            transition:opacity .3s ease;
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
<section>
    <div  class="form-container">
        <h1>Password Recovery </h1>
        <form action="PassRec.php" method="post">
            <div class="control">
                <label for="name">Identity number</label>
                <input type="text" id="user" name="current" >
            </div>
            <div class="control">
                <label for="psw">New Password</label>
                <input type="password" id="pass" name="new">
            </div>
            <div class="control">
                <label for="psw">Confirm Password</label>
                <input type="password" id="pass" name="confirm">
            </div>

            <div class="control">
                <input type="submit" class="btn" value="Confirm" name="save">
            </div>
        </form>
        <p><a href="index.php">Back to log in page</a></p>
    </div>
</section>
</body>
</html>