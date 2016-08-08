<?php
   
   require ('sql_connect.inc');
   // echo "It's working!!";
   if(isset($_POST['get_option']))
   {  

     $predicate = trim($_POST['get_option'], '.');
     $stmt = $conn->prepare("SELECT nama_predikat FROM `predikat` WHERE nama_predikat = '$predicate'");
     $stmt->execute();

     while($row = $stmt->fetch()) {
       echo $row['nama_predikat'];
     }

     exit;
   }

?>