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
  //$rulename = $_GET['rule'];
  //sql_connect('blog');
	$stmt = $conn->prepare("SELECT `name` FROM `table`");
  $stmt->execute();

?>

<body class="default">
<div class="wrapper">

  <div class="dynamic-form">

    <a href="#" id="add">Add</a> | <a href="#" id="remove">Remove</a>  | <a href="#" id="reset">Reset</a>  

    <form class="form-horizontal" role="form">
      <div class="inputs">
        <div class="form-group">
          <label class="control-label col-sm-2" for="conjunction"></label>
            <div class="col-sm-10">
              <input type="text" name="dynamic[]" class="form-control"/>
            </div>
          <br>
        </div>
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
      </div>
      <input name="submit" type="button" class="submit" value="Submit" />
    </form>
  </div>  

</div>

<script type="text/javascript" src="assets/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/param.js"></script>

</body>
</html>