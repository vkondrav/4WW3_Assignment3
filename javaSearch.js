var searchTerm;
var type;

var movieTitle;
var movieYear;
var movieDescription;
var genreName;
var actorFirstName;
var actorMiddleName;
var actorLastName;
var actorBirthday;
var awardName;
var awardReason;
var awardYear;
var user_id;
var comments;

var id;
var reviewNum = 1;

$(document).ready(function(){

  $(document).keyup(function(e) {
    if(e.which == 13) {
        showResults();
    }
  });

  $("#showResults").click(function(){
      showResults();
  });

  $("input[name='advancedSearch']").click(function(){
      if ($('#advancedHints').is(':visible'))
      {
        $("#advancedHints").slideUp('400');
      }
      else
      {
        $("#advancedHints").slideDown('400');
      }
  }); 

  $("#movie_results").on("click", "button[name='review']", function(){
    id = $(this).attr('id');

    if(reviewNum == 1)
    {
      $('<td colspan="3"><div id= "r" style="display: none"><label>Review</label><button type="button" class="close pull-right glyphicon glyphicon-remove-circle" onclick=closeDiv("#r,#sendr")></button><textarea class="form-control" rows="4" name="review" placeholder="Review"></textarea></div></td><td><div id="sendr" style="display: none"><button type="button" name="sendReview" class="btn btn-info">Send</button></div></td>').insertAfter("#t"+id);
      $("#r").slideDown('400');
      $("#sendr").slideDown('400');
      reviewNum --;
    }
  });

  $("#movie_results").on("click", "button[name='sendReview']", function(){
     review = $("textarea[name='review']").val();

     var request = $.ajax({
        url: "main_server.php",
        type: "POST",
        datatype: "html",
        data:{
            funct: "movieReviewphp",
            movie_id: id,
            review: review
        }
    });

    request.done(function(msg) {
        $("#success").html(" Request Processed:" + msg);
        $("#successAlert").slideDown('400');
        closeDiv("#r,#sendr");          
    });

    request.fail(function(jqXHR, textStatus) {
        $("#failure").html(" Request failed: " + textStatus);
        $("#failureAlert").slideDown('400');
    });    
  });
});

function showResults()
{
    movieTitle = "";
    movieYear = "";
    movieDescription = "";
    genreName = "";
    actorFirstName = "";
    actorMiddleName = "";
    actorLastName = "";
    actorBirthday = "";
    awardName = "";
    awardReason = "";
    awardYear = "";
    roleType = "";
    characterName = "";
    user_id = "";
    comments = "";

    if(reviewNum == 0){reviewNum++;}

    type = $("input[name='advancedSearch']").is(':checked');

    searchTerm = $("input[name='searchTerm']").val();

    if (searchTerm != "")
    {
      if (type)
      {
        if(!searchParser(searchTerm))
        {
          $("#results").slideUp('400');
          $("#failure").html(" Your advanced search term contains syntax errors. Please double check.");
          $("#failureAlert").slideDown('400');
          return;
        }
      }

      $("#failureAlert").slideUp('400');
      $("#results").slideUp('400', function(){ 
          $("#movie_results").html("");
          $("#person_results").html("");
          $("#award_results").html("");
          $("#role_results").html("");
          $("#hasaward_results").html("");
          $("#review_results").html("");

         getPHPSearchlist("getMoviesSearchTablephp", "#movie_results", searchTerm);
         getPHPSearchlist("getPersonsSearchTablephp", "#person_results", searchTerm);
         getPHPSearchlist("getAwardsSearchTablephp", "#award_results", searchTerm); 
         getPHPSearchlist("getRolesSearchTablephp", "#role_results", searchTerm); 
         getPHPSearchlist("getHasAwardSearchTablephp", "#hasaward_results", searchTerm); 
         getPHPSearchlist("getReviewSearchTablephp", "#review_results", searchTerm); 
      });

       $("#results").slideDown('400');
    }
    else
    {
      $("#results").slideUp('400');
      $("#failure").html(" Search Query Empty. Please input query");
      $("#failureAlert").slideDown('400');
    }
}

function getPHPSearchlist(url, hash, searchTerm){
    var request = $.ajax({
        url: "main_server.php",
        type: "POST",
        datatype: "html",
        data:{
            funct: url,
            searchTerm: searchTerm,
            type: type,
            movieTitle: movieTitle,
            movieYear: movieYear,
            movieDescription: movieDescription,
            genreName: genreName,
            actorFirstName: actorFirstName,
            actorMiddleName: actorMiddleName,
            actorLastName: actorLastName,
            actorBirthday: actorBirthday,
            roleType: roleType,
            characterName: characterName,
            awardName: awardName,
            awardReason: awardReason,
            awardYear: awardYear,
            user_id: user_id,
            comments: comments
        }
    });

    request.done(function(msg) {
        $(hash).append(msg);          
    });

    request.fail(function(jqXHR, textStatus) {
        $("#failure").html(" Request failed: " + textStatus);
        $("#failureAlert").slideDown('400');
    });
}

function searchParser(searchTerm)
{

  success = true;

  searchArray = searchTerm.split(',');

  var termsArray = new Array();

  for (i = 0; i < searchArray.length; i++) 
  {
      termsArray[i] = searchArray[i].split(':');
      termsArray[i][0] = termsArray[i][0].trim();    
  }

  for(i = 0; i < termsArray.length; i++)
  {
    term = termsArray[i][1];

    switch(termsArray[i][0])
    {
    case "movieTitle":
      movieTitle = term;
      break;
    case "movieDescription":
      movieDescription = term;
      break;
    case "movieYear":
      movieYear = term;
      break;
    case "actorFirstName":
      actorFirstName = term;
      break;
    case "actorMiddleName":
      actorMiddleName = term;
      break;
    case "actorLastName":
      actorLastName = term;
      break;
    case "actorBirthday":
      actorBirthday = term;
      break;
    case "awardName":
      awardName = term;
      break;
    case "awardReason":
      awardReason = term;
      break;
    case "awardYear":
      awardYear = term;
      break;
    case "user_id":
      user_id = term;
      break;
    case "comments":
      comments = term;
      break;
    case "roleType":
      roleType = term;
      break;
    case "characterName":
      characterName = term;
      break;
    default:
      success = false;
      break;
    }  
  }

  return success;
}