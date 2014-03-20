var actorNum = 0;
var genreNum = 0;
var reviewNum = 1;

$(document).ready(function(){
  $("#addPerson").click(function(){
    $("#appendPerson").append('<fieldset><label>Person</label><select id = "persons'+ actorNum + '" class="form-control myList"></select></fieldset>');
    getPersons(actorNum);
    $("#appendPerson").append('<fieldset><label>Responsibility</label><select id = "roles'+ actorNum + '" class="form-control myList"></select></fieldset>');
    getRoles(actorNum);
    actorNum += 1;
  });

  
});

$(document).ready(function(){
  $("#addGenre").click(function(){
    $("#appendGenre").append('<fieldset><label>Genre</label><select id = "genre'+ genreNum + '" class="form-control myList"></select></fieldset>');
    getGenre(genreNum);
    genreNum += 1;
  });
});

$(document).ready(function(){
  $("#addReview").click(function(){
        if (reviewNum > 0)
        {
            $("#appendReview").append('<label>Review</label><textarea class="form-control" rows="4" name="review" placeholder="Review"></textarea>');
            getGenre(genreNum);
            genreNum += 1;
            reviewNum -= 1;
        }
  });
  
});

$(document).ready(function(){
  $("#submit").click(function(){
        
        var request = $.ajax({
            url: "movie.php",
            type: "POST",            
            data:{
                title: $("input[name='title']").val(),
                description: $("textarea[name='description'").val(),
                year_released: $("input[name=year_released]").val(),
                rating: $("input[name='rating'").val()
            },
            success: function(data)
            {
               $("#appendSuccess").append('<label>' + data + '</label><br>'); 
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
        url: "getRespons.php",
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