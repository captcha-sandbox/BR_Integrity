<?php
   
   require ('sql_master.inc');
   // echo "It's working!!";
   if(isset($_POST['get_option']))
   {  

     $db_name = trim($_POST['get_option'], '.');
     $stmt = $conn->prepare("SELECT table_name FROM tables WHERE table_schema = '$db_name'");
     $stmt->execute();

     // $col = $stmt->fetchAll();
     // print_r($col);
     $key = "Tables_in_".$db_name;
     while($row = $stmt->fetch()) {
       echo "<option>".$row['table_name']."</option>";
     }

     exit;
   }

?>