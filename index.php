<!DOCTYPE html>
<html lang="en">
<head>
     <title>PHP & Ajax : : Home</title>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
     <style>
          tr th, tr td {
               width: 20%;
          }
          #success_msg, #error_msg {
               display: none;
          }
     </style>
</head>
<body>

<div class="container">
     <h2>CRUD with PHP & Ajax</h2>
     <hr>
     <form id="add_data">
          Full Name : <input type="text" id="name">&nbsp;&nbsp;
          Gender : <input type="text" id="gender">&nbsp;&nbsp;
          Age : <input type="number" id="age">&nbsp;&nbsp;
          <input type="submit" id="save_data" value="Save" class="btn-xs btn-success">
     </form>
     <form id="edit_data"></form>
     <hr>
     <div class="alert alert-success" id="success_msg"></div>
     <div class="alert alert-danger" id="error_msg"></div>
     <table class="table table-responsive">
          <thead>
               <tr>
                    <th>Id</th>
                    <th>Full Name</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Action</th>
               </tr>
          </thead>
          <tbody id="ajax_table"></tbody>
     </table>
</div>

<script type="text/javascript">
     $(document).ready(function(){
          // Load All Data 
          function loadtable(){
               $.ajax({
                    url : "loadtable.php",
                    type : "POST",
                    success : function(data){
                         $("#ajax_table").html(data);  
                    }
               });
          }
          loadtable();
          // Insert Data
          $("#save_data").on("click", function(e){
               e.preventDefault();
               var name = $("#name").val();
               var gender = $("#gender").val();
               var age = $("#age").val();
               if(name == '' || gender == '' || age == ''){
                    $("#error_msg").html("All Fields Are Required!").slideDown();
                    $("#success_msg").slideUp();
               }
               else{
                    $.ajax({
                         url : "adddata.php",
                         type : "POST",
                         data : {name:name, gender:gender, age:age},
                         success : function(data){
                              if(data == 1){
                                   $("#add_data").trigger("reset");
                                   loadtable();
                                   $("#error_msg").slideUp();
                                   $("#success_msg").html("Data Insert Succesfully").slideDown();
                                   
                              }
                              else{
                                   $("#success_msg").slideUp();
                                   $("#error_msg").html("Data Insert Failed!").slideDown();
                              }                         
                         }
                    });
               }               
          });
          // Delete Data
          $(document).on("click", ".delete-btn", function(e){
               if(confirm("Do you want to delte this data?")){
                    var delid = $(this).data("delete");
                    var srow = this;
                    $.ajax({
                         url : "deldata.php",
                         type : "POST",
                         data : { id : delid },
                         success : function(data){
                              if(data == 1){
                                   $(srow).closest("tr").fadeOut();
                                   $("#error_msg").slideUp();
                                   $("#success_msg").html("Data Delete Succesfully").slideDown();
                                   
                              }
                              else{
                                   $("#success_msg").slideUp();
                                   $("#error_msg").html("Data Delete Failed!").slideDown();
                              }  
                         }
                    });
               }
          });
          //Edit Data
          $(document).on("click", ".edit-btn", function(e){
               var eid = $(this).data("edit");
               $.ajax({
                    url : "editdata.php",
                    type : "POST",
                    data : { id : eid },
                    success : function(data)
                    {
                         $("#add_data").hide();
                         $("#edit_data").show();                         
                         $("#edit_data").html(data);
                    }
               });
          });
          //Close Edit
          $(document).on("click", ".close-btn", function(e){
               $("#add_data").show();
               $("#edit_data").hide();
          });
          //Update Data
          $(document).on("click", "#update_data", function(e){
               e.preventDefault();
               var name = $("#ename").val();
               var gender = $("#egender").val();
               var age = $("#eage").val();
               var id = $("#eid").val();
               $.ajax({
                    url : "updatedata.php",
                    type : "POST",
                    data : { name : name, gender : gender, age : age, id : id },
                    success : function(data){
                         if(data == 1){
                              loadtable();
                              $("#add_data").show();
                              $("#edit_data").hide();
                              $("#error_msg").slideUp();
                              $("#success_msg").html("Data Update Succesfully").slideDown();
                              
                         }
                         else{
                              $("#success_msg").slideUp();
                              $("#error_msg").html("Data Update Failed!").slideDown();
                         } 
                    }
               });
          });
     });
</script>

</body>
</html>
