$(document).ready(function(){

  var searchTerm;

  $(document).keypress(function(e) {
    if(e.which == 13) {
        showResults();
    }
});

  $("#showResults").click(function(){
      showResults();
  });  
});

function showResults()
{
    searchTerm = $("input[name='searchTerm']").val();
    $("#results").slideUp('400', function(){ 
        $("#movie_results").html("");
        $("#person_results").html("");
        $("#award_results").html("");
        $("#role_results").html("");
        $("#hasaward_results").html("");
        $("#review_results").html("");

       getPHPSearchlist("getMoviesSearchTable.php", "#movie_results", searchTerm);
       getPHPSearchlist("getPersonsSearchTable.php", "#person_results", searchTerm);
       getPHPSearchlist("getAwardsSearchTable.php", "#award_results", searchTerm); 
       getPHPSearchlist("getRolesSearchTable.php", "#role_results", searchTerm); 
       getPHPSearchlist("getHasAwardSearchTable.php", "#hasaward_results", searchTerm); 
       getPHPSearchlist("getReviewSearchTable.php", "#review_results", searchTerm); 
    });

     $("#results").slideDown('400');
}

function getPHPSearchlist(url, hash, searchTerm){
    var request = $.ajax({
        url: url,
        type: "POST",
        datatype: "html",
        data:{
            searchTerm: searchTerm
        }
    });

    request.done(function(msg) {
        $(hash).append(msg);          
    });

    request.fail(function(jqXHR, textStatus) {
        $("#failure").html("Request failed: " + textStatus);
        $("#failureAlert").slideDown('400');
    });
}