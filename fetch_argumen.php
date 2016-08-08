<?php
   
   require ('sql_connect.inc');
   // echo "It's working!!";
   if(isset($_POST['get_option']))
   {  

     $predicate = trim($_POST['get_option'], '.');
     $stmt = $conn->prepare("SELECT jumlah_argumen FROM `predikat` WHERE nama_predikat = '$predicate'");
     $stmt->execute();

     $number = $stmt->fetch();
     $arguments = $number[0];

     $i=1;
     while ($i<=$arguments) {
       echo '<div class="form-group"><label class="control-label col-sm-2" for="tabel">Atribut '.$i.'</label><div class="col-sm-10"><select class="form-control" name="dynamic[]" id="attr'.$i.'"></select></div></div>';
       $i++;
     }

     exit;
   }

?>