<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="assets/css/styles.css" />


<title>Business Rule</title>
</head>

<?php 
  require ('sql_connect.inc');
    //sql_connect('blog');
  $rulename = $_GET['rule'];
	$stmt = $conn->prepare("SELECT * FROM `condition` WHERE rule_name = '$rulename'");
  $stmt->execute();

?>

<body class="default">
<div class="wrapper">
<h3><?php echo $rulename; ?></h3> <br>
<h4>Condition</h4><br>
<table class="table table-hover">
    <thead>
      <tr>
        <th>Source</th>
        <th>Conjunction</th>
        <th>Ordered</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        while($baris = $stmt->fetch()) {
      ?>
      <tr>
        <td><?php echo $baris['source']; ?></td>
        <td><?php echo $baris['conj_type']; ?></td>
        <td><?php echo $baris['ordered']; ?></td>
      </tr>
      <?php
        }
        $conn = null;
      ?>
    </tbody>
  </table>

  <a href="add_condition.php?rule=<?php echo $rulename; ?>">Add Condition</a>
</div>

<script type="text/javascript" src="assets/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>

</body>
</html>