<?php

$name = $_POST['name'];
$gender = $_POST['gender'];
$age = $_POST['age'];
$id = $_POST['id'];

include 'config.php';

$sql = "UPDATE `person` SET `name` = '$name', `gender` = '$gender', `age` = '$age' WHERE `id` = '$id'";

$qry = mysqli_query($con, $sql) or die ("SQL Query Error!");

if($qry){
     echo 1;
}
else{
     echo 0;
}

?>