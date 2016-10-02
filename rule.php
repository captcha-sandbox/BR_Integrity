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

  $stmt = $conn->prepare("SELECT nama_predikat FROM `predikat` WHERE kelompok_predikat = 'IDB' ORDER BY nama_predikat ASC");
  $stmt->execute();
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
                    <a href="policy.php">Policy</a>
                </li>
                <li>
                    <a href="br_statement.php">Business Rule</a>
                </li>
                <li>
                    <a href="predikat.php">Predikat</a>
                </li>
                <li>
                    <a href="rule.php">Aturan</a>
                </li>
                <li>
                    <a href="allreference.php">Referensi</a>
                </li>
                <li>
                    <a href="schedule.php">Penjadwalan</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
          <div class="container-fluid">
            <form class="form-horizontal">
            <div class="form-group">
              <label class="control-label col-sm-2" for="source">Rule Name</label>
              <div class="col-sm-10">
              <select class="form-control" id="source" name="source" onchange="fetch_select(this.value)">
                <option selected="selected"></option>
                <?php
                  while ($result = $stmt->fetch()) {
                ?>    
                <option><?php echo $result['nama_predikat']; ?></option>
              <?php
                }
                $conn = null;
              ?>
              </select>
              </div>
            <br>
            </div>
            </form>
           <p id="rule"></p> 
          </div>
          <a href="add_rule.php?">Tambah Aturan</a>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

<script type="text/javascript" src="assets/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>

<!-- Menu Toggle Script -->
<script>
$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});
</script>

<script type="text/javascript">

function fetch_select(val)
{ 
   $.ajax({
     type: 'post',
     url: 'fetch_rule.php',
     data: {
       get_option:val
     },
     success: function (response) {
       document.getElementById("rule").innerHTML=response;
     }
     
   });
}
</script>
</body>

</html>
