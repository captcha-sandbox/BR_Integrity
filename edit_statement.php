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
    $stmt = $conn->prepare("SELECT id_statement, id_policy, definition, p.nama_predikat AS a, q.nama_predikat AS b FROM br_statement br, predikat p, predikat q WHERE id_statement = '$id' AND br.predikat = p.id_predikat AND br.target = q.id_predikat");
    $stmt->execute();

    $res = $stmt->fetch();
    $id_stmt = $res['id_statement'];
    $id_pol = $res['id_policy'];
    $def = $res['definition'];
    $predikat = $res['a'];
    $target = $res['b'];

    $stmt = $conn->prepare("SELECT id_policy FROM `policy`");
    $stmt->execute();

    $ids = array(); $i=0;
    while ($id = $stmt->fetch()) {
      $ids[$i] = $id['id_policy'];
      $i++;
    }

    $stmt = $conn->prepare("SELECT nama_predikat FROM `predikat` WHERE kelompok_predikat = 'IDB'");
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
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
          <div class="container-fluid">
            <form class="form-horizontal" role="form" method="post" action="<?php echo 'update_statement.php?' ?>">
  <div class="form-group">
    <label class="control-label col-sm-2" for="predikat">ID Statement</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="statement" name="statement" value="<?php echo $id_stmt; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="argumen">ID Policy</label>
    <div class="col-sm-10">
      <select class="form-control" id="policy" name="policy">
        <?php
          $i=0;
          while ($i<sizeof($ids)) {
            if($ids[$i] == $id_pol) {
              echo '<option selected="selected">'.$ids[$i].'</option>';
            }
            else{
              echo '<option>'.$ids[$i].'</option>';
            }
            $i++;
          }  
        ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="definition">Definisi</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="definition" name="definition" value="<?php echo $def; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="argumen">Predikat</label>
    <div class="col-sm-10">
      <select class="form-control" id="predicate" name="predicate">
        <?php
          $i=0;
          while ($i<sizeof($predicates)) {
            if($predicates[$i] == $predikat) {
              echo '<option selected="selected">'.$predicates[$i].'</option>';
            }
            else {
              echo '<option>'.$predicates[$i].'</option>';
            }
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
            if($predicates[$i] == $target) {
              echo '<option selected="selected">'.$predicates[$i].'</option>';
            }
            else {
              echo '<option>'.$predicates[$i].'</option>';  
            }
            $i++;
          }  
        ?>
      </select>
    </div>
  </div>
  <input type="hidden" name="prev_id" value="<?php echo $id_stmt; ?>">
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