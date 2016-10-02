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
    $stmt = $conn->prepare("SELECT `name` FROM time_unit ORDER BY `name` ASC");
    $stmt->execute();

    $units = array(); $i=0;
    while ($baris = $stmt->fetch()) {
      $times[$i] = $baris['name'];
      $i++;
    }  

    $id = $_GET['id']; 
    $stmt = $conn->prepare("SELECT id_statement, jadwal, instruksi, keterangan FROM `schedule` WHERE id_jadwal = '$id'");
    $stmt->execute();

    $res = $stmt->fetch();
    $statement = $res['id_statement'];
    $time = $res['jadwal'];
    $command = $res['instruksi'];
    $desc = $res['keterangan'];
    $units = explode(" ", $time);

    $stmt = $conn->prepare("SELECT * FROM br_statement");
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
            <form class="form-horizontal" role="form" method="post" action="<?php echo 'update_schedule.php?' ?>">
  <div class="form-group">
    <label class="control-label col-sm-2" for="setting">BR Statement</label>
    <div class="col-sm-10">
      <select class="form-control" id="statement" name="statement">  
       <?php
        while ($res = $stmt->fetch()) {
          $result = $res['id_statement'];
          if($statement == $result) {
            echo '<option selected="selected">'.$result.'</option>';
          }
          else {
            echo '<option>'.$result.'</option>';  
          }
        }

        $conn = null;
       ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="setting">Common setting</label>
    <div class="col-sm-10">
        <select class="form-control" id="setting" name="setting" onchange="fetch_setting(this.value);">
          <option>-- Common Setting --</option>  
          <?php
            $idx=0;
            while ($idx<sizeof($times)) {
              echo '<option>'.$times[$idx].'</option>';
              $idx++;
            }
          ?>
        </select>
      </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="minute">Minute</label>
      <div class="col-sm-3">
        <input type="text" class="form-control" id="minute" name="minute" value="<?php echo $units[0]; ?>" required>
      </div>
      <div class="col-sm-7">
        <select class="form-control" id="minute2" name="minute2" onchange="copy_minute(this.value);">  
          <option>-- Common Setting --</option>
          <option>Every minute(*)</option>
          <option>Minute 0 (0)</option>
          <option>Minute 5 (5)</option>
          <option>Minute 10 (10)</option>
          <option>Minute 15 (15)</option>
          <option>Minute 45 (45)</option>
        </select>
      </div>
    <br>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="tipe">Hour</label>
      <div class="col-sm-3">
        <input type="text" class="form-control" id="hour" name="hour" value="<?php echo $units[1]; ?>" required>
      </div>
      <div class="col-sm-7">
        <select class="form-control" id="hour2" name="hour2" onchange="copy_hour(this.value);">  
          <option>-- Common Setting --</option>
          <option>Every hour(*)</option>
          <option>Midnight (0)</option>
          <option>2:00 (2)</option>
          <option>4:00 (4)</option>
          <option>6:00 (6)</option>
          <option>12:00 (12)</option>
          <option>18:00 (18)</option>
          <option>20:00 (20)</option>
          <option>22:00 (22)</option>
        </select>
      </div>
    <br>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="tipe">Day</label>
      <div class="col-sm-3">
        <input type="text" class="form-control" id="day" name="day" value="<?php echo $units[2]; ?>" required>
      </div>
      <div class="col-sm-7">
        <select class="form-control" id="day2" name="day2" onchange="copy_day(this.value);">  
          <option>-- Common Setting --</option>
          <option>Every day(*)</option>
          <option>1st day (1)</option>
          <option>2nd day (2)</option>
          <option>3rd day (3)</option>
          <option>4th day (4)</option>
          <option>5th day (5)</option>
          <option>6th day (6)</option>
          <option>7th day (7)</option>
          <option>8th day (8)</option>
          <option>9th day (9)</option>
          <option>10th day (10)</option>
        </select>
      </div>
    <br>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="tipe">Month</label>
      <div class="col-sm-3">
        <input type="text" class="form-control" id="month" name="month" value="<?php echo $units[3]; ?>" required>
      </div>
      <div class="col-sm-7">
        <select class="form-control" id="month2" name="month2" onchange="copy_month(this.value);">  
          <option>-- Common Setting --</option>
          <option>Every month(*)</option>
          <option>January (1)</option>
          <option>February (2)</option>
          <option>March (3)</option>
          <option>April (4)</option>
          <option>May (5)</option>
          <option>June (6)</option>
          <option>July (7)</option>
          <option>August (8)</option>
          <option>September (9)</option>
          <option>October (10)</option>
          <option>November (11)</option>
          <option>December (12)</option>
        </select>
      </div>
    <br>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="tipe">Weekdays</label>
      <div class="col-sm-3">
        <input type="text" class="form-control" id="weekday" name="weekday" value="<?php echo $units[4]; ?>" required>
      </div>
      <div class="col-sm-7">
        <select class="form-control" id="weekday2" name="weekday2" onchange="copy_weekday(this.value);">  
          <option>-- Common Setting --</option>
          <option>Every weekday(*)</option>
          <option>Sunday (0)</option>
          <option>Monday (1)</option>
          <option>Tuesday (2)</option>
          <option>Wednesday (3)</option>
          <option>Thursday (4)</option>
          <option>Friday (5)</option>
          <option>Saturday (6)</option>
        </select>
      </div>
    <br>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="description">Instruksi</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="instruction" name="instruction" value="<?php echo $command; ?>" required>
    </div>
  </div>
   <div class="form-group">
    <label class="control-label col-sm-2" for="keterangan">Keterangan</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?php echo $desc; ?>">
    </div>
  </div>
  <input type="hidden" name="prev_id" value="<?php echo $id; ?>">
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
    <script src="assets/js/jquery-1.10.2.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Custom JavaScript -->
    <script type="text/javascript" src="assets/js/schedule.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>



</body>

</html>
