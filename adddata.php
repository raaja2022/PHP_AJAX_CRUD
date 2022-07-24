<?php

$name = $_POST['name'];
$gender = $_POST['gender'];
$age = $_POST['age'];

include 'config.php';

$sql = "INSERT INTO `person` (`name`, `gender`, `age`) VALUES ('$name', '$gender', '$age')";

$qry = mysqli_query($con, $sql) or die ("SQL Query Error!");

if($qry){
     echo 1;
}
else{
     echo 0;
}

?>