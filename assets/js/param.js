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
    //alert(last);
    $.get("http://localhost/sandbox/add_form.php", {order : index}, function (data){
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

  // here's our click function for when the forms submitted
  /*
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
  /*return false; 

  }); */

  });