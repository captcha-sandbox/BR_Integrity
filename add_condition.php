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
  $rulename = $_GET['rule'];
  //sql_connect('blog');
	$stmt = $conn->prepare("SELECT `name` FROM `table`");
  $stmt->execute();

?>

<body class="default">
<div class="wrapper">

 <form class="form-horizontal" role="form" method="post" action="<?php echo 'insert_condition.php?rule='.$rulename ?>">
  <div class="form-group">
    <label class="control-label col-sm-2" for="conjunction"></label>
      <div class="col-sm-10">
        <select class="form-control" id="conjunction" name="conjunction">  
          <option>AND</option>
          <option>OR</option>
          <option></option>  
        </select>
      </div>
    <br>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="source">Source</label>
      <div class="col-sm-10">
        <select class="form-control" id="source" name="source">
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
    <label class="control-label col-sm-2" for="ordered">Ordered</label>
    <div class="col-sm-10">
      <input type="checkbox" id="ordered" name="ordered" value="1">
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
<script type="text/javascript">
  $(document).ready(function(){

  var i = $('input').size() + 1;

  $('#add').click(function() {
  $('<div><input type="text" class="field" name="dynamic[]" value="' + i + '" /></div>').fadeIn('slow').appendTo('.inputs');
  i++;
  });

  $('#remove').click(function() {
  if(i > 1) {
  $('.field:last').remove();
  i--;
  }
  });

  $('#reset').click(function() {
  while(i > 2) {
  $('.field:last').remove();
  i--;
  }
  });

  // here's our click function for when the forms submitted

  $('.submit').click(function(){

  var answers = [];
  $.each($('.field'), function() {
  answers.push($(this).val());
  });

  if(answers.length == 0) {
  answers = "none";
  }

  alert(answers);

  return false;

  });

  });
</script>

</body>
</html>