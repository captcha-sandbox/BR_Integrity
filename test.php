<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Simple Sidebar - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="assets/css/simple-sidebar.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<?php 
  require ('sql_connect.inc');
  $stmt = $conn->prepare("SELECT nama_predikat FROM predikat WHERE kelompok_predikat = 'EDB'");
  $stmt->execute();

  $edb = array(); $i=0;
  while ($result = $stmt->fetch()) {
    $edb[$i] = $result['nama_predikat'];
    $i++;
  }

  $conn = null;
?>
<body>

    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                        BR Checking
                    </a>
                </li>
                <li>
                    <a href="#">Predikat</a>
                </li>
                <li>
                    <a href="#">Aturan</a>
                </li>
                <li>
                    <a href="#">Referensi</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
          <div class="container-fluid">
            <form class="form-horizontal" role="form" method="post" action="<?php echo 'insert_reference.php?' ?>">
  <div class="form-group">
    <label class="control-label col-sm-2" for="referensi">Nama referensi</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="referensi" name="referensi">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="predikat">Predikat</label>
    <div class="col-sm-10">
      <select class="form-control" id="source1" name="predikat" onchange="fetch_argumen(this.value);">
        <option value="">Pilih predikat</option>
        <?php
          $i = 0;
          while ($i<sizeof($edb)) {
        ?>    
        <option><?php echo $edb[$i]; ?></option>
        <?php
          $i++; 
          }
          //$conn = null;
        ?>
      </select>
    </div>
  <br><br><br>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="database">Basis data</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="database" name="database" onblur="fetch_table();">
    </div>  
    <br>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="tabel">Nama tabel</label>
    <div class="col-sm-10">
      <select class="form-control" id="tabel" name="tabel" onchange="fetch_attr(this.value);">
      </select>
    </div>
  </div>
          
  <p id="arguments"></p>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Submit</button>
    </div>
  </div>
</form>
      </div>
    </div>
    <!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->

    <!-- jQuery -->
<script src="assets/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript">

function fetch_argumen(val)
{
   $.ajax({
     type: 'post',
     url: 'fetch_argumen.php',
     data: {
       get_option:val
     },
     success: function (response) {
      alert(var);
       document.getElementById("arguments").innerHTML=response;
     }
     
   });
}
</script>

<script type="text/javascript">
  function fetch_table()
  {
    var val = document.getElementById("database").value;
    // alert(val);
     $.ajax({
       type: 'post',
       url: 'fetch_table.php',
       data: {
         get_option:val
       },
       success: function (response) {
         document.getElementById("tabel").innerHTML=response;
       }
       
     }); 
  }
</script>

<script type="text/javascript">
  function fetch_attr(val)
  {
    // alert(val);
    var total = document.getElementsByName("dynamic[]").length;
    alert(total);
     $.ajax({
       type: 'post',
       url: 'fetch_attr.php',
       data: {
         get_option:val
       },
       success: function (response) {
         var i = 1;
         while(i<=total) {
          var id = "attr"+i;
          document.getElementById(id).innerHTML=response;
          i++; 
         }
         
       }
       
     }); 
  }
</script>
<!-- Menu Toggle Script -->
<script>
$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});
</script>
</body>

</html>
