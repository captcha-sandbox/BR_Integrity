<?php
   
  include "sql_connect.inc";
  include "backend/rule.php";
  include "backend/rule_head.php";
  include "backend/rule_body.php";
  include "backend/rule_manager.php";
  include "backend/expression.php";
  include "backend/builder.php";
  include "backend/querygen.php";

   // echo "It's working!!";
   if(isset($_POST['get_option']))
   {  
     $predicate = $_POST['get_option'];
     $b = new Builder();

     $stmt = $conn->prepare("SELECT id_aturan FROM idb i INNER JOIN predikat p ON i.id_predikat = p.id_predikat WHERE p.nama_predikat = '$predicate' ORDER BY id_aturan ASC");
     $stmt->execute();

     $ids = array(); $i=0;
     while ($res = $stmt->fetch()) {
       $ids[$i] = $res['id_aturan'];
       $i++;
     }

     $rules = $b->buildRule($predicate);
     $j=0;
     foreach ($rules as $rule) {
       echo $rule.'<br>';
       echo '<a href="delete_rule.php?id='.$ids[$j].'">Hapus</a><br><br>';
       $j++;
     }
     // print_r($rules);
     exit;
   }

?>