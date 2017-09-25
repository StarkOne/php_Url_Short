$(function() {
        $('#form').submit(function(){          
            $.ajax({
               type: "POST",
               url: "ref.php",
               data: $(this).serialize(),
               success: function(data){
                 $('#app').text(data);
               }
             });
            return false;
        });
  });