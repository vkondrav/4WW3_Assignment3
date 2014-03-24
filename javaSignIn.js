$(document).ready(function(){

  $("#signIn").click(function(){

    user_id = $("user_id").val();
    password = $("password").val();

    var request = $.ajax({
        url: "signIn.php",
        type: "POST",            
        data:{
            user_id: user_id,
            password: password,
        },
        success: function(data)
        {
           if (data == "success")
            {
                startSession(user_id);
                window.location.href = 'movie.html';
            }
            else
            {
                $("#failure").html("Unable to find user or password");
                $("#failureAlert").slideDown('400');  
            }
           
        },
        error: function(data)
        { 
           $("#failure").html(data);
           $("#failureAlert").slideDown('400');
        }
    });        
  });  
});