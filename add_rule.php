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
	$stmt = $conn->prepare("SELECT `name` FROM `table`");
  $stmt->execute();

?>

<body class="default">
<div class="wrapper">

 <form class="form-horizontal" role="form" method="post" action="insert_rule.php">
  <div class="form-group">
    <label class="control-label col-sm-2" for="rule_name">Rule Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="rule_name" name="rule_name" placeholder="Enter rulename">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="source">Source</label>
      <div class="col-sm-10">
        <select class="form-control" id="source" name="source" onchange="fetch_select(this.value);">
          <?php
            while ($result = $stmt->fetch()) {
          ?>    
          <option><?php echo $result['name']; ?></option>
          <?php
            }
            $conn = null;
          ?>
        </select>
      </div>
    <br>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="target">Target</label>
      <div class="col-sm-10">
        <select class="form-control" id="target" name="target">  
        
        </select>
       </div>
    <br>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="description">Description</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="description" name="description" placeholder="Enter description">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Submit</button>
    </div>
  </div>
</form>

<p id="demo"></p>

</div>

<script type="text/javascript" src="assets/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script>
function myFunction() {
    var x = document.getElementById("source").value;
    document.getElementById("demo").innerHTML = "You selected: " + x;
}
</script>

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
       document.getElementById("target").innerHTML=response; 
     }
     
   });
}

</script>

</body>
</html>