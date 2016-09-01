
    function copy_minute(val) {
      
      var regExp = /\((.*?)\)/; 
      var matches = regExp.exec(val);

      if(matches) {
        document.getElementById("minute").value = matches[1];  
      }
      else {
        document.getElementById("minute").value = "";
      }
      
    }



    function copy_hour(val) {
      
      var regExp = /\((.*?)\)/; 
      var matches = regExp.exec(val);

      if(matches) {
        document.getElementById("hour").value = matches[1];  
      }
      else {
        document.getElementById("hour").value = "";
      }
      
    }


    function copy_day(val) {
      
      var regExp = /\((.*?)\)/; 
      var matches = regExp.exec(val);

      if(matches) {
        document.getElementById("day").value = matches[1];  
      }
      else {
        document.getElementById("day").value = "";
      }
      
    }

    function copy_month(val) {
      
      var regExp = /\((.*?)\)/; 
      var matches = regExp.exec(val);

      if(matches) {
        document.getElementById("month").value = matches[1];  
      }
      else {
        document.getElementById("month").value = "";
      }
      
    }

    function copy_weekday(val) {
      
      var regExp = /\((.*?)\)/; 
      var matches = regExp.exec(val);

      if(matches) {
        document.getElementById("weekday").value = matches[1];  
      }
      else {
        document.getElementById("weekday").value = "";
      }
      
    }


    function fetch_setting(val)
    { 
       $.ajax({
         type: 'post',
         url: 'fetch_setting.php',
         data: {
           get_option:val
         },
         datatype: 'json',
       })
       .done(function (data) {
        // alert(data.month);
        document.getElementById("minute").value = data.minute;
        document.getElementById("hour").value = data.hour;
        document.getElementById("day").value = data.date;
        document.getElementById("month").value = data.month;
        document.getElementById("weekday").value = data.day;
       }); 
    }