<?php

include 'config.php';

$sql = "SELECT * FROM `person` ";

$qry = mysqli_query($con, $sql) or die ("SQL Query Error!");

if(mysqli_num_rows($qry) > 0){

     $result = '';
     
     while($data = mysqli_fetch_assoc($qry)){
          $result .= "<tr>
               <td>".$data["id"]."</td>
               <td>".$data["name"]."</td>
               <td>".$data["gender"]."</td>
               <td>".$data["age"]."</td>
               <td>
                    <button class='btn-xs btn-primary edit-btn' data-edit='".$data["id"]."'>Edit</button>
                    &nbsp;<button class='btn-xs btn-danger delete-btn' data-delete='".$data["id"]."'>Delete</button>
               </td>
          </tr>";
     }

     mysqli_close($con);
     
     echo $result;

}
else{
     echo "<tr>
     <td colspan='4'>No Records Found...</td>
     </tr>";
}

?>