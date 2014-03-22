var movieNum = 0;
var awardNum = 0;

$(document).ready(function(){

     $("#addMovie").click(function(){
        $("#appendMovie").append("<div id= 'm" + movieNum + "' style='display: none'></div>");
        $("#m" + movieNum).append('<fieldset><label>Movie Title</label><select id = "movie'+ movieNum + '" class="form-control myList"></select></fieldset>');        
        getMovies(movieNum);
        $("#m" + movieNum).append('<fieldset><label>Role</label><select id = "roles'+ movieNum + '" class="form-control myList"></select></fieldset>');
        getRoles(movieNum);
        $("#m" + movieNum).append('<input type="text" id = "charName'+ movieNum + '" class="form-control butt" placeholder="Character Name (optional)"></input>');
        $("#m" + movieNum).slideDown('400');
        movieNum += 1;
    });

    $("#addAward").click(function(){
        $("#appendAward").append("<div id= 'a" + awardNum + "' style='display: none'></div>");
        $("#a" + awardNum).append('<fieldset><label>Award</label><select id = "award'+ awardNum + '" class="form-control myList"></select></fieldset>');
        getAward(awardNum);
        $("#a" + awardNum).append('<fieldset><label>Awarded for Movie</label><select id = "award_movie'+ awardNum + '" class="form-control myList"></select></fieldset>');        
        getAward_Movies(awardNum);
        $("#a" + movieNum).append('<input type="text" id = "year_received'+ awardNum + '" class="form-control butt" placeholder="Year Received"></input>');
        $("#a" + awardNum).slideDown('400');
        awardNum += 1;
    });

  $("#submit").click(function(){
    
    $("#successAlert").slideUp('400');
    var movieArray = ["NULL"];
    var rolesArray = ["NULL"];
    var characterArray = ["NULL"];
    var awardArray = ["NULL"];
    var award_movieArray = ["NULL"];
    var year_receivedArray = ["NULL"];

    var firstname;
    var middlename;
    var lastname;
    var birthdate;

    var reg = new RegExp(/^(19|20)\d\d[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])$/);

    firstname = $("input[name='firstname']").val();
    middlename = $("input[name='middlename'").val();
    lastname = $("input[name=lastname]").val();
    birthdate = $("input[name=birthdate]").val();

    if (firstname == "")
    {   
        $("#emptyFirstNameAlert").slideDown('400');
        return;
    }
    else
        $("#emptyFirstNameAlert").slideUp('400');

    if (firstname.indexOf(';') != -1)
    {   
        $("#incorrectFirstNameAlert").slideDown('400');
        return;
    }
    else
        $("#incorrectFirstNameAlert").slideUp('400');

    if (middlename.indexOf(';') != -1)
    {   
        $("#incorrectMiddleNameAlert").slideDown('400');
        return;
    }
    else
        $("#incorrectMiddleNameAlert").slideUp('400');

    if (lastname == "")
    {   
        $("#emptyLastNameAlert").slideDown('400');
        return;
    }
    else
        $("#emptyLastNameAlert").slideUp('400');

    if (lastname.indexOf(';') != -1)
    {   
        $("#incorrectLastNameAlert").slideDown('400');
        return;
    }
    else
        $("#incorrectLastNameAlert").slideUp('400');

    if (birthdate != "" && !reg.test(birthdate))
    {
        $("#incorrectRangeAlert").slideDown('400');
        return;    
    }
    else
        $("#incorrectRangeAlert").slideUp('400');

    for(i = 0; i < movieNum; i++)
    {
        movieArray[i] = $("#movie" + i).val();
        rolesArray[i] = $("#roles" + i).val();
        characterArray[i] = $("#charName" + i).val();
    }

    for(i = 0; i < awardNum; i++)
    {
        awardArray[i] = $("#award" + i).val();
        award_movieArray[i] = $("#award_movie" + i).val();
        year_receivedArray[i] = $("#year_received" + i).val();
    }

    var request = $.ajax({
        url: "person.php",
        type: "POST",            
        data:{
            firstname: firstname,
            middlename: middlename,
            lastname: lastname,
            birthdate: birthdate,
            movieArray: movieArray,
            rolesArray: rolesArray,
            characterArray: characterArray,
            awardArray: awardArray,
            award_movieArray: award_movieArray,
            year_receivedArray: year_receivedArray
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

function getMovies(movieNum) {

    var request = $.ajax({
        url: "getMovies.php",
        type: "GET",            
        dataType: "html"
    });

    request.done(function(msg) {
        $("#movie" + movieNum).append(msg);          
    });

    request.fail(function(jqXHR, textStatus) {
        alert( "Request failed: " + textStatus );
    });
}

function getAward_Movies(movieNum) {

    var request = $.ajax({
        url: "getMovies.php",
        type: "GET",            
        dataType: "html"
    });

    request.done(function(msg) {
        $("#award_movie" + movieNum).append(msg);          
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

function getAward(awardNum) {

    var request = $.ajax({
        url: "getAward.php",
        type: "GET",            
        dataType: "html"
    });

    request.done(function(msg) {
        $("#award" + awardNum).append(msg);          
    });

    request.fail(function(jqXHR, textStatus) {
        alert( "Request failed: " + textStatus );
    });
}