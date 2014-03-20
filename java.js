var actorNum = 0;
var genreNum = 0;

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