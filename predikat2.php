<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
<link href="assets/css/simple-sidebar.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="assets/css/styles.css" />


<title>Business Rule</title>
</head>

<?php 
  require ('sql_connect.inc');
    //sql_connect('blog');
	$stmt = $conn->prepare("SELECT * FROM `predikat` WHERE kelompok_predikat = 'EDB' OR kelompok_predikat = 'IDB'");
  $stmt->execute();

?>

<body class="default">
<div class="wrapper">
<!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                        Start Bootstrap
                    </a>
                </li>
                <li>
                    <a href="#">Dashboard</a>
                </li>
                <li>
                    <a href="#">Shortcuts</a>
                </li>
                <li>
                    <a href="#">Overview</a>
                </li>
                <li>
                    <a href="#">Events</a>
                </li>
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="#">Services</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->
<!--<h3><?php echo $rulename; ?></h3> <br> -->
<h4>Predikat</h4>
<table class="table table-hover">
    <thead>
      <tr>
        <th>Nama Predikat</th>
        <th>Jumlah Argumen</th>
        <th>Tipe Predikat</th>
        <th>Deskripsi</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        while($baris = $stmt->fetch()) {
      ?>
      <tr>
        <td><?php echo $baris['nama_predikat']; ?></td>
        <td><?php echo $baris['jumlah_argumen']; ?></td>
        <td><?php echo $baris['kelompok_predikat']; ?></td>
        <td><?php echo $baris['deskripsi']; ?></td>
        <td><?php
          if($baris['kelompok_predikat'] == "EDB") {
            echo '<a href="">Lihat referensi</a>';
          }  
        ?></td>
      </tr>
      <?php
        }
        $conn = null;
      ?>
    </tbody>
  </table>

  <a href="add_predikat.php?">Tambah Predikat</a>
</div>

<script type="text/javascript" src="assets/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

</body>
</html>