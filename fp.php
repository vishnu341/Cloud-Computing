<?php
$db=mysqli_connect('localhost','root','','demo') or die("could not connect to database");
$username=mysqli_real_escape_string($db,$_POST['uname']);
$password=mysqli_real_escape_string($db,$_POST['psw']);

$query="UPDATE login  SET `password` = '$password'   WHERE `username` =  '$username';" or die("Failed to execute the Query :( . Try Again !");  
mysqli_query($db,$query);
header("Location:login.html");
  

?>