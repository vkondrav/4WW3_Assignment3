function closeDiv(tag){
    
    $(tag).slideUp(400, function() {
        $(tag).remove();
    });

    if (tag == "#r") 
    {
        reviewNum ++;
    }
}

function getPHPlist(url, hash, num){

    var request = $.ajax({
        url: url,
        type: "GET",            
        dataType: "html"
    });

    request.done(function(msg) {
        $(hash + num).append(msg);          
    });

    request.fail(function(jqXHR, textStatus) {
        $("#failure").html("Request failed: " + textStatus);
        $("#failureAlert").slideDown('400');
    });
}