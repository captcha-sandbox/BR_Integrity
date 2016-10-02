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
    $data = $conn->prepare("SELECT id_ref, nama_predikat, db_name, table_name FROM `reference` ref INNER JOIN predikat p ON ref.predikat = p.id_predikat");
    $data->execute();

    // $stmt = $conn->prepare("SELECT attr_name FROM `ref_attribute` WHERE id_ref = '$ref'");
    // $stmt->execute();
    // $check = $stmt->fetchAll(PDO::FETCH_NUM);
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
            <h4>Referensi EDB</h4>
            <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Predikat</th>
                    <th>Basis Data</th>
                    <th>Tabel Referensi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    while ($res = $data->fetch()) {
                      $predikat = $res['nama_predikat'];
                      echo '<tr>';
                      echo '<td><a href="reference.php?id='.$predikat.'">'.$predikat.'</a></td>';
                      echo '<td>'.$res['db_name'].'</td>';
                      echo '<td>'.$res['table_name'].'</td>';
                      echo '<td><a href="edit_reference.php?id='.$res['id_ref'].'">Edit</a> </td>';
                      echo '<td><a href="delete_reference.php?id='.$res['id_ref'].'">Hapus</a></td>';
                      echo '</tr>';
                    }
                  ?>
                  <?php
                    $conn = null;
                  ?>
                </tbody>
              </table>
              <a href="add_reference.php?">Tambah Referensi</a>
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
