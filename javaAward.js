var movieNum = 0;

$(document).ready(function(){

    var movieHash;

    getPHPlist("getAwardTablephp", "#table", 0);

    $("#addTable").click(function(){
        
        if (!$('#appendTable').is(':visible'))
        {
            $("#appendTable").slideDown('400');
        }
        else
        {
            $("#appendTable").slideUp('400');
        }
    });

     $("#addPerson").click(function(){

        movieHash = "#m" + movieNum;

        $("#appendPersonMovie").append("<div id= 'm" + movieNum + "' style='display: none'></div>");

        $(movieHash).append('<fieldset><label>Person</label><button type="button" class="close pull-right glyphicon glyphicon-remove-circle" onclick=closeDiv("#m' + movieNum + '")></button><select id = "persons'+ movieNum + '" class="form-control myList"></select></fieldset>');        
        getPHPlist("getPersonsphp", "#persons", movieNum);

        $(movieHash).append("<div id= 'm" + movieNum + "' style='display: none'></div>");
        $(movieHash).append('<fieldset><label>Movie Title</label><select id = "movie'+ movieNum + '" class="form-control myList"></select></fieldset>');        
        getPHPlist("getMoviesphp", "#movie", movieNum);
        
        $(movieHash).append('<input type="text" id = "year_received'+ movieNum + '" class="form-control butt" placeholder="Year Received"></input>');
        
        $(movieHash).slideDown('400');
        movieNum += 1;
    });

  $("#submit").click(function(){
    
    $("#successAlert").slideUp('400');
    var movieArray = ["NULL"];
    var personsArray = ["NULL"];
    var year_receivedArray = ["NULL"];

    var name;
    var reason;
   
    name = $("input[name='name']").val();
    reason = $("input[name='reason'").val();

    if (name == "")
    {   
        $("#emptyNameAlert").slideDown('400');
        return;
    }
    else
        $("#emptyNameAlert").slideUp('400');

    if (reason == "")
    {   
        $("#emptyReasonAlert").slideDown('400');
        return;
    }
    else
        $("#emptyReasonAlert").slideUp('400');
    

    ii = 0
    for(i = 0; i < movieNum; i++)
    {
        if($("#persons" + i).length)
        {
            movieArray[ii] = $("#movie" + i).val();
            personsArray[ii] = $("#persons" + i).val();
            year_receivedArray[ii] = $("#year_received" + i).val();
            ii++
        }
    }

    var request = $.ajax({

        url: "main_server.php",
        type: "POST",            
        data:{
            funct: "awardphp",
            name: name,
            reason: reason,
            movieArray: movieArray,
            personsArray: personsArray,
            year_receivedArray: year_receivedArray
        },
        success: function(data)
        {
           clearAll(); 
           $("#success").html(data);
           $("#successAlert").slideDown('400');
        },
        error: function(data)
        { 
           $("#failure").html(data);
           $("#failureAlert").slideDown('400');
        }
    });        
  }); 
});

function clearAll()
{
    $("input[name='name']").val("");
    $("input[name='reason'").val("");

    for(i=0; i < movieNum; i++)
    {
        $("#m" + i).remove();
    }

}