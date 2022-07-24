<?php

$id = $_POST['id'];

include 'config.php';

$sql = "SELECT * FROM `person` WHERE `id`='$id'";

$qry = mysqli_query($con, $sql) or die ("SQL Query Error!");

if(mysqli_num_rows($qry) > 0){
     
     $data = mysqli_fetch_assoc($qry);
     $result = 'Full Name : <input type="text" id="ename" value="'.$data['name'].'">&nbsp;&nbsp;
     Gender : <input type="text" id="egender" value="'.$data['gender'].'">&nbsp;&nbsp;
     Age : <input type="number" id="eage" value="'.$data['age'].'">&nbsp;&nbsp;
     <input type="hidden" id="eid" value="'.$data['id'].'">
     <input type="submit" id="update_data" value="Update" class="btn-xs btn-success">
     <input type="button" value="Close" class="btn-xs btn-warning close-btn">';

     mysqli_close($con);
     
     echo $result;

}

?>