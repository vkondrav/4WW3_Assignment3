function closeDiv(tag){
    
    tag = tag.split(',');

    for(i = 0; i < tag.length; i++)
    {
        $(tag[i]).slideUp(400, function() {
            $(tag[i]).remove();
        });

        if (tag[i] == "#r") 
        {
            reviewNum ++;
        }
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