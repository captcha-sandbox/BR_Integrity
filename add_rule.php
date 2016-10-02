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
	$stmt = $conn->prepare("SELECT `nama_predikat` FROM `predikat` WHERE kelompok_predikat = 'IDB' ORDER BY nama_predikat ASC");
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
            <form class="form-horizontal" role="form" method="post" action="insert_rule.php">
      <div class="form-group">
        <label class="control-label col-sm-2" for="source">Rule Name</label>
          <div class="col-sm-10">
            <select class="form-control" id="source" name="source" onchange="fetch_select(this.value);">
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
      <div class="form-group">
        <label class="control-label col-sm-2" for="description">Description</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="description" name="description" placeholder="Enter rule description">
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
<script type="text/javascript" src="assets/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript">

function fetch_select(val)
{
   $.ajax({
     type: 'post',
     url: 'fetch_data.php',
     data: {
       get_option:val
     },
     success: function (response) {
       document.getElementById("description").value=response; 
     }
     
   });
}

</script>

</body>
</html>