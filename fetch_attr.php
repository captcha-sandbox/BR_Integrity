<?php
   
   require ('sql_master.inc');
   // echo "It's working!!";
   if(isset($_POST['get_option']))
   {  

     $table = trim($_POST['get_option'], '.');
     $stmt = $conn->prepare("SELECT column_name FROM columns WHERE table_name = '$table' AND table_schema = 'akademik'");
     $stmt->execute();

     // $col = $stmt->fetchAll();
     // print_r($col);
     // $key = "Tables_in_".$db_name;
     while($row = $stmt->fetch()) {
       echo "<option>".$row['column_name']."</option>";
     }

     exit;
   }

?>