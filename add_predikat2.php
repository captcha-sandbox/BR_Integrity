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

<body class="default">
<div class="wrapper">

 <form class="form-horizontal" role="form" method="post" action="<?php echo 'insert_predikat.php?' ?>">
  <div class="form-group">
    <label class="control-label col-sm-2" for="predikat">Nama predikat</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="predikat" name="predikat">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="argumen">Jumlah argumen</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="argumen" name="argumen">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="tipe">Tipe predikat</label>
      <div class="col-sm-10">
        <select class="form-control" id="tipe" name="tipe">  
          <option>EDB</option>
          <option>IDB</option>
        </select>
      </div>
    <br>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="description">Deskripsi</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="description" name="description">
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