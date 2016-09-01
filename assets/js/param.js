  $(document).ready(function(){

  //document.getElementById("source").id = "source2";  
  var i = $('input').size() + 1;
/*
  $('#add').click(function() {
  $(response).fadeIn('slow').appendTo('.inputs');
  alert(response);
  i++;
  });
*/
  $('#add').click(function() {
    var last = $('.input:last').find('select').attr('id');
    var index = parseInt(last.substring(6));
    var cond = $('.inputs').find('input').attr('value');
    var rule = $('.inputs').find('input').attr('id');
    
    $.get("http://localhost/sandbox/add_form.php", {order: index, condition: cond, name: rule}, function (data){
        $('.inputs').append(data);
        // $(data).fadeIn('slow').appendTo('.inputs');
    });
  });

  $('#remove').click(function() {
    $('.input:last').remove();
  });

  $('#reset').click(function() {
  while(i > 2) {
  $('.form-group:last').remove();
  i--;
  }
  });

  });