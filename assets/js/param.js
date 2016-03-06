  $(document).ready(function(){

  var i = $('input').size() + 1;

  $('#add').click(function() {
  $('<div class="form-group"><label class="control-label col-sm-2" for="conjunction">Parameter</label><div class="col-sm-10"><input type="text" name="dynamic[]" class="form-control"/></div><br></div><div class="form-group"><label class="control-label col-sm-2" for="conjunction"></label><div class="col-sm-10"><select class="form-control" id="conjunction" name="conjunction"><option>AND</option><option>OR</option><option></option></select></div><br></div>').fadeIn('slow').appendTo('.inputs');
  i++;
  });

  $('#remove').click(function() {
  if(i > 1) {
  $('.form-group:last').remove();
  i--;
  }
  });

  $('#reset').click(function() {
  while(i > 2) {
  $('.form-group:last').remove();
  i--;
  }
  });

  // here's our click function for when the forms submitted

  $('.submit').click(function(){

  var answers = [];
  $.each($('.form-control'), function() {
  answers.push($(this).val());
  });

  if(answers.length == 0) {
  answers = "none";
  }

  alert(answers);


/*
  $.ajax({
     type: 'post',
     url: 'insert_param.php',
     data: {
       get_params:answers
     },
     success: function (response) { 
        alert("success");
     }
     
   });
*/
  return false;

  });

  });