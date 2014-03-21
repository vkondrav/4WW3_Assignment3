var actorNum = 0;
var genreNum = 0;
var reviewNum = 1;

$(document).ready(function(){

     $("#addPerson").click(function(){
        $("#appendPerson").append("<div id= 'a" + actorNum + "' style='display: none'></div>");
        $("#a" + actorNum).append('<fieldset><label>Person</label><select id = "persons'+ actorNum + '" class="form-control myList"></select></fieldset>');        
        getPersons(actorNum);
        $("#a" + actorNum).append('<fieldset><label>Responsibility</label><select id = "roles'+ actorNum + '" class="form-control myList"></select></fieldset>');
        getRoles(actorNum);
        $("#a" + actorNum).append('<input type="text" id = "charName'+ actorNum + '" class="form-control" placeholder="Character Name (optional)"></input>');
        $("#a" + actorNum).slideDown('400');
        actorNum += 1;
    });

    $("#addGenre").click(function(){
        $("#appendGenre").append("<div id= 'g" + genreNum + "' style='display: none'></div>");
        $("#g" + genreNum).append('<fieldset><label>Genre</label><select id = "genre'+ genreNum + '" class="form-control myList"></select></fieldset>');
        getGenre(genreNum);
        $("#g" + genreNum).slideDown('400');
        genreNum += 1;
    });

    $("#addReview").click(function(){
        if (reviewNum > 0)
        {
            $("#appendReview").append('<div id= "r" style="display: none"><label>Review</label><textarea class="form-control" rows="4" name="review" placeholder="Review"></textarea></div>');
            $("#r").slideDown('400');
            reviewNum -= 1;
        }
    });

  $("#submit").click(function(){
    
    $("#successAlert").slideUp('400');
    var actorArray = [];
    var rolesArray = [];
    var characterArray = [];
    var title;
    var description;
    var year_released;
    var review;

    var reg = new RegExp(/^[0-9]*$/);

    title = $("input[name='title']").val();
    description = $("textarea[name='description'").val();
    year_released = $("input[name=year_released]").val();
    review = $("textarea[name=review]").val();

    if (title == "")
    {   
        $("#emptyTitleAlert").slideDown('400');
        return;
    }
    else
        $("#emptyTitleAlert").slideUp('400');

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

    for(i = 0; i < actorNum; i++)
    {
        actorArray[i] = $("#persons" + i).val();
        rolesArray[i] = $("#roles" + i).val();
        characterArray[i] = $("#charName" + i).val();
    }

    var request = $.ajax({
        url: "movie.php",
        type: "POST",            
        data:{
            title: title,
            description: description,
            year_released: year_released,
            rating: $("input[name='rating'").val(),
            actorArray: actorArray,
            rolesArray: rolesArray,
            characterArray: characterArray
        },
        success: function(data)
        {
           //$("#appendSuccess").append('<label>' + data + '</label><br>'); 
           $("#success").html(data);
           $("#successAlert").slideDown('400');
        }
    });        
  });  
});

function getPersons(actorNum) {

    var request = $.ajax({
        url: "getPersons.php",
        type: "GET",            
        dataType: "html"
    });

    request.done(function(msg) {
        $("#persons" + actorNum).append(msg);          
    });

    request.fail(function(jqXHR, textStatus) {
        alert( "Request failed: " + textStatus );
    });
}

function getRoles(actorNum) {

    var request = $.ajax({
        url: "getRoles.php",
        type: "GET",            
        dataType: "html"
    });

    request.done(function(msg) {
        $("#roles" + actorNum).append(msg);          
    });

    request.fail(function(jqXHR, textStatus) {
        alert( "Request failed: " + textStatus );
    });
}

function getGenre(genreNum) {

    var request = $.ajax({
        url: "getGenre.php",
        type: "GET",            
        dataType: "html"
    });

    request.done(function(msg) {
        $("#genre" + genreNum).append(msg);          
    });

    request.fail(function(jqXHR, textStatus) {
        alert( "Request failed: " + textStatus );
    });
}