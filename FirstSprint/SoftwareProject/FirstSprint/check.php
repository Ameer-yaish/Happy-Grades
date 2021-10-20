<?php
session_start();
?>

<html dir=rtl>

<head>

    <title>Control Panel </title>

    <meta http-equiv="Content-Type" content="text/html; charset=windows-1256">

</head>

<body >

<?php

$user1=addslashes(strip_tags($_POST["user"]));

$pass1=addslashes(strip_tags($_POST["pass"]));


include("db.php");
$xx=mysqli_query($con,"select * from users where id  ='$user1' and pass='$pass1'");

$x=mysqli_fetch_array($xx);

if(!empty($x[1]))
{
    $s=$x[4];
    if($s==1) {
        $_SESSION['account'] = $x[1];
        echo '<meta http-equiv="refresh" content="0;url=Student.html">';
    }
    elseif ($s==2)
    {
        $_SESSION['account'] = $x[1];
        echo '<meta http-equiv="refresh" content="0;url=Co-Teacher.html">';
    }
    elseif ($s==3)
    {
        $_SESSION['account'] = $x[1];
        echo '<meta http-equiv="refresh" content="0;url=Prof.html">';
    }

}
else
{
    echo '<meta http-equiv="refresh" content="0;url=index.php">';
    echo '<script>alert("Wrong Username or Password")</script>';


}


?>


</body>

</html>