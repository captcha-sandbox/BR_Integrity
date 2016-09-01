<?php
   
   require ('sql_connect.inc');
   // echo "It's working!!";
   if(isset($_POST['get_option']))
   {  

     // $predicate = trim($_POST['get_option'], '.');
     $name = $_POST['get_option'];
     $stmt = $conn->prepare("SELECT * FROM `time_unit` WHERE `name` = '$name'");
     $stmt->execute();

     $unit = array();
     while($res = $stmt->fetch()) {
      $unit['minute'] = $res['minute'];
      $unit['hour'] = $res['hour'];
      $unit['date'] = $res['date'];
      $unit['month'] = $res['month'];
      $unit['day'] = $res['day'];
     }
     // print_r($unit);
     // json_encode($unit);
     $example = array(
      "one" => "apple",
      "two" => "banana"
      );
     header('Content-Type: application/json');
     echo json_encode($unit);
     exit;
   }

?>