//This file handles the jqeury, javascript and ajax for movie.html

var actorNum = 0;
var genreNum = 0;
var reviewNum = 1;

var movieNum = 0;
var awardNum = 0;

$(document).ready(function(){

    var actorHash;
    var genreHash;

    //$("#appendTable").append("<table class='table' id='table0'></table>");  
    getPHPlist("getMoviesTablephp", "#table", 0);

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
        actorHash = "#a" + actorNum;

        $("#appendPerson").append("<div id= 'a" + actorNum + "' style='display: none'></div>");  

        $(actorHash).append('<fieldset><label>Person</label><button type="button" class="close pull-right glyphicon glyphicon-remove-circle" onclick=closeDiv("#a' + actorNum + '")></button><select id = "persons'+ actorNum + '" class="form-control myList"></select></fieldset>');        
        getPHPlist("getPersonsphp", "#persons", actorNum);

        $(actorHash).append('<fieldset><label>Responsibility</label><select id = "roles'+ actorNum + '" class="form-control myList"></select></fieldset>');
        getPHPlist("getRolesphp", "#roles", actorNum);

        $(actorHash).append('<input type="text" id = "charName'+ actorNum + '" class="form-control" placeholder="Character Name (optional)"></input>');
        $(actorHash).slideDown('400');
        actorNum += 1;
    });

    $("#addGenre").click(function(){
        genreHash = "#g" + genreNum;

        $("#appendGenre").append("<div id= 'g" + genreNum + "' style='display: none'></div>");

        $(genreHash).append('<fieldset><label>Genre</label><button type="button" class="close pull-right glyphicon glyphicon-remove-circle" onclick=closeDiv("#g' + genreNum + '")></button><select id = "genre'+ genreNum + '" class="form-control myList"></select></fieldset>');
        getPHPlist("getGenrephp", "#genre", genreNum);
        $(genreHash).slideDown('400');
        genreNum += 1;
    });

    $("#addReview").click(function(){
        if (reviewNum > 0)
        {
            $("#appendReview").append('<div id= "r" style="display: none"><label>Review</label><button type="button" class="close pull-right glyphicon glyphicon-remove-circle" onclick=closeDiv("#r")></button><textarea class="form-control" rows="4" name="review" placeholder="Review"></textarea></div>');
            $("#r").slideDown('400');
            reviewNum -= 1;
        }
    });

  $("#submit").click(function(){
    
    $("#successAlert").slideUp('400');
    var actorArray = ["NULL"];
    var rolesArray = ["NULL"];
    var characterArray = ["NULL"];

    var genreArray = ["NULL"];

    var title;
    var description;
    var year_released;
    var review = "NULL";

    var reg = new RegExp(/^[0-9]*$/);

    title = $("input[name='title']").val();
    description = $("textarea[name='description'").val();
    year_released = $("input[name=year_released]").val();

    if (reviewNum == 0)
    {
        if($("textarea[name=review]").val() != "")
        {
            review = $("textarea[name=review]").val();
        }
    }

    if (title == "")
    {   
        $("#emptyTitleAlert").slideDown('400');
        return;
    }
    else
        $("#emptyTitleAlert").slideUp('400');

    if (title.indexOf(';') != -1)
    {   
        $("#incorrectTitleAlert").slideDown('400');
        return;
    }
    else
        $("#incorrectTitleAlert").slideUp('400');

    if (description.indexOf(';') != -1)
    {   
        $("#incorrectDescriptionAlert").slideDown('400');
        return;
    }
    else
        $("#incorrectDescriptionAlert").slideUp('400');

    if (!reg.test(year_released))
    {
        $("#incorrectYearAlert").slideDown('400');
        return;    
    }
    else
        $("#incorrectYearAlert").slideUp('400');

    if (parseInt(year_released) < 1901 || parseInt(year_released) > 2155)
    {
        $("#incorrectRangeAlert").slideDown('400');
        return;    
    }
    else
        $("#incorrectRangeAlert").slideUp('400');

    if (review != null && review.indexOf(';') != -1)
    {   
        $("#incorrectReviewAlert").slideDown('400');
        return;
    }
    else
        $("#incorrectReviewAlert").slideUp('400');

    ii = 0;
    for(i = 0; i < actorNum; i++)
    {
        if($("#persons" + i).length)
        {
            actorArray[ii] = $("#persons" + i).val();
            rolesArray[ii] = $("#roles" + i).val();
            characterArray[ii] = $("#charName" + i).val();
            ii ++;
        }

    }

    ii = 0;
    for(i = 0; i < genreNum; i++)
    {
        if($("#genre" + i).val())
        {
            genreArray[i] = $("#genre" + i).val();
            ii ++;
        }
    }

    var request = $.ajax({
        url: "main_server.php",
        type: "POST",            
        data:{
            funct: "moviephp",
            title: title,
            description: description,
            year_released: year_released,
            rating: $("input[name='rating'").val(),
            actorArray: actorArray,
            rolesArray: rolesArray,
            characterArray: characterArray,
            genreArray: genreArray,
            review: review
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
    $("input[name='title']").val("");
    $("textarea[name='description'").val("");
    $("input[name=year_released]").val("");
    $("textarea[name=review]").val("");

    for(i=0; i < actorNum; i++)
    {
        $("#a" + i).remove();
    }

    for(i=0; i < genreNum; i++)
    {
        $("#g" + i).remove();
    }

}