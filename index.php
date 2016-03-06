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
	$stmt = $conn->prepare("SELECT rule_name, target, source, description FROM business_rule");
  $stmt->execute();

?>

<body class="default">
<div class="wrapper">
<h3>Business Rules</h3> <br>
<table class="table table-hover">
    <thead>
      <tr>
        <th>Rule Name</th>
        <th>Target</th>
        <th>Source</th>
         <th>Description</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        while($baris = $stmt->fetch()) {
      ?>
      <tr>
        <td><a href="rule.php?rule=<?php echo $baris['rule_name']; ?>"><?php echo $baris['rule_name']; ?>,</a></td>
        <td><?php echo $baris['target']; ?></td>
        <td><?php echo $baris['source']; ?></td>
        <td><?php echo $baris['description']; ?></td>
      </tr>
      <?php
        }
        $conn = null;
      ?>
    </tbody>
  </table>

  <a href="add_rule.php">Add Rule</a>
</div>

<script type="text/javascript" src="assets/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>

</body>
</html>