<?php
   
   require ('sql_connect.inc');
   echo "It's working!!";
   if(isset($_POST['get_option']))
   {  

     $table = $_POST['get_option'];
     $stmt = $conn->prepare("SELECT attribute FROM table_attributes WHERE table_name = '$table'");
     $stmt->execute();

     while($row = $stmt->fetch()) {
       echo "<option>".$row['attribute']."</option>";
     }
   
     exit;
   }

?>