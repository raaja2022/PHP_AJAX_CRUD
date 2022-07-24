<?php

$id = $_POST['id'];

include 'config.php';

$sql = "DELETE FROM `person` WHERE `id`='$id'";

$qry = mysqli_query($con, $sql) or die ("SQL Query Error!");

if($qry){
     echo 1;
}
else{
     echo 0;
}

?>