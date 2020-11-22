<?php
session_start();

    
$con = mysqli_connect('localhost', 'root');

mysqli_select_db($con, 'userregistration2');

$email=$_SESSION['email'];

$wins = $_SESSION['wins']+1;
$games = $_SESSION['games']+1;


if($_POST['has_won']){//true
    $_SESSION['wins'] = $wins;
    $reg="Update usertable2 set wins = '$wins' where email = '$email'";
    mysqli_query($con,$reg);
}
$_SESSION['games'] = $wins;
$reg="Update usertable2 set games = '$games' where email = '$email'";
mysqli_query($con,$reg);



?>