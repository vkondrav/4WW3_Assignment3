var movieNum = 0;
var awardNum = 0;

$(document).ready(function(){

    var movieHash;
    var awardHash;
  
    getPHPlist("getPersonsTable.php", "#table", 0);

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

     $("#addMovie").click(function(){
        movieHash = "#m" + movieNum;
        $("#appendMovie").append("<div id= 'm" + movieNum + "' style='display: none'></div>");
        $(movieHash).append('<fieldset><label>Movie Title</label><button type="button" class="close pull-right glyphicon glyphicon-remove-circle" onclick=closeDiv("#m' + movieNum + '")></button><select id = "movie'+ movieNum + '" class="form-control myList"></select></fieldset>');        
        getPHPlist("getMovies.php", "#movie", movieNum);
        //getMovies(movieNum);
        $(movieHash).append('<fieldset><label>Role</label><select id = "roles'+ movieNum + '" class="form-control myList"></select></fieldset>');
        getPHPlist("getRoles.php", "#roles", movieNum)
        //getRoles(movieNum);
        $(movieHash).append('<input type="text" id = "charName'+ movieNum + '" class="form-control butt" placeholder="Character Name (optional)"></input>');
        $(movieHash).slideDown('400');
        movieNum += 1;
    });

    $("#addAward").click(function(){
        awardHash = "#a" + awardNum;

        $("#appendAward").append("<div id= 'a" + awardNum + "' style='display: none'></div>");
        $(awardHash).append('<fieldset><label>Award</label><button type="button" class="close pull-right glyphicon glyphicon-remove-circle" onclick=closeDiv("#a' + awardNum + '")></button><select id = "award'+ awardNum + '" class="form-control myList"></select></fieldset>');
        getPHPlist("getAward.php", "#award", awardNum);
        //getAward(awardNum);
        $(awardHash).append('<fieldset><label>Awarded for Movie</label><select id = "award_movie'+ awardNum + '" class="form-control myList"></select></fieldset>');        
        getPHPlist("getMovies.php", "#award_movie", awardNum);
        //getAward_Movies(awardNum);
        $(awardHash).append('<input type="text" id = "year_received'+ awardNum + '" class="form-control butt" placeholder="Year Received"></input>');
        $(awardHash).slideDown('400');
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

    ii = 0
    for(i = 0; i < movieNum; i++)
    {
        if($("#movie" + i).length)
        {
            movieArray[ii] = $("#movie" + i).val();
            rolesArray[ii] = $("#roles" + i).val();
            characterArray[ii] = $("#charName" + i).val();
            ii++
        }
    }

    ii = 0;
    for(i = 0; i < awardNum; i++)
    {
        if($("#award" + i).length)
        {
            awardArray[i] = $("#award" + i).val();
            award_movieArray[i] = $("#award_movie" + i).val();
            year_receivedArray[i] = $("#year_received" + i).val();
        }
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
    $("input[name='firstname']").val("");
    $("input[name='middlename'").val("");
    $("input[name=lastname]").val("");
    $("input[name=birthdate]").val("");

    for(i=0; i < movieNum; i++)
    {
        $("#m" + i).remove();
    }

    for(i=0; i < awardNum; i++)
    {
        $("#a" + i).remove();
    }

}