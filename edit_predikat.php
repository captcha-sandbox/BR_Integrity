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
    //sql_connect('blog');
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM `predikat` WHERE id_predikat = $id");
    $stmt->execute();

    $res = $stmt->fetch();
    $id_p = $res['id_predikat'];
    $nama = $res['nama_predikat'];
    $jumlah = $res['jumlah_argumen'];
    $tipe = $res['kelompok_predikat'];
    $desc = $res['deskripsi'];

    // print_r($res);
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
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
          <div class="container-fluid">
            <form class="form-horizontal" role="form" method="post" action="<?php echo 'update_predikat.php?' ?>">
  <div class="form-group">
    <label class="control-label col-sm-2" for="predikat">Nama predikat</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="predikat" name="predikat" value="<?php echo $nama; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="argumen">Jumlah argumen</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="argumen" name="argumen" value="<?php echo $jumlah; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="tipe">Tipe predikat</label>
      <div class="col-sm-10">
        <select class="form-control" id="tipe" name="tipe">
        <?php
          if($tipe == "EDB") {
            echo '<option selected="selected">EDB</option>';
            echo '<option>IDB</option>';
          }
          else {
            echo '<option>EDB</option>';
            echo '<option selected="selected">IDB</option>';
          }      
          
        ?>
        </select>
      </div>
    <br>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="description">Deskripsi</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="description" name="description" value="<?php echo $desc; ?>">
    </div>
  </div>
  <input type="hidden" name="prev_id" value="<?php echo $id_p; ?>">
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Update</button>
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

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

</body>

</html>
