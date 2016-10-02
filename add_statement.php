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
    $stmt = $conn->prepare("SELECT id_policy FROM `policy`");
    $stmt->execute();

    $ids = array(); $i=0;
    while ($id = $stmt->fetch()) {
      $ids[$i] = $id['id_policy'];
      $i++;
    }

    $stmt = $conn->prepare("SELECT nama_predikat FROM `predikat` WHERE kelompok_predikat = 'IDB' ORDER BY nama_predikat ASC");
    $stmt->execute();

    $predicates = array(); $i=0;
    while ($res = $stmt->fetch()) {
      $predicates[$i] = $res['nama_predikat'];
      $i++;
    }

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
            <form class="form-horizontal" role="form" method="post" action="<?php echo 'insert_statement.php?' ?>">
  <div class="form-group">
    <label class="control-label col-sm-2" for="predikat">ID Statement</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="statement" name="statement">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="argumen">ID Policy</label>
    <div class="col-sm-10">
      <select class="form-control" id="policy" name="policy">
        <?php
          $i=0;
          while ($i<sizeof($ids)) {
            echo '<option>'.$ids[$i].'</option>';
            $i++;
          }  
        ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="definition">Definisi</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="definition" name="definition">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="argumen">Predikat</label>
    <div class="col-sm-10">
      <select class="form-control" id="predicate" name="predicate">
        <?php
          $i=0;
          while ($i<sizeof($predicates)) {
            echo '<option>'.$predicates[$i].'</option>';
            $i++;
          }  
        ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="argumen">Target</label>
    <div class="col-sm-10">
      <select class="form-control" id="target" name="target">
        <?php
          $i=0;
          while ($i<sizeof($predicates)) {
            echo '<option>'.$predicates[$i].'</option>';
            $i++;
          }  
        ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="argumen">Tipe</label>
    <div class="col-sm-10">
      <select class="form-control" id="type" name="type">
        <option selected="selected">Optional</option>
        <option>Mandatory</option>
      </select>
    </div>
  </div>
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

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

</body>

</html>