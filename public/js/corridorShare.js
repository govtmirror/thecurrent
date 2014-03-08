
function generateCorridorShare(entry)
{
    
    var link = 'http://corridor.state.gov/';
    var shareurl = entry.link;
    var sharetitle = entry.title;
    var blogtitle = 'The Current';
    
    var returnMe = link + "?shareurl=" + encodeURIComponent(shareurl) + "&sharetitle=" + encodeURIComponent(sharetitle) + "&blogtitle=" + encodeURIComponent(blogtitle);
    //alert(returnMe);
    return returnMe;
}

function generateCorridorShareGeneral(shareurl, sharetitle, blogtitle)
{
    var link = 'http://corridor.state.gov/';
    
    var returnMe = link + "?shareurl=" + encodeURIComponent(shareurl) + "&sharetitle=" + encodeURIComponent(sharetitle) + "&blogtitle=" + encodeURIComponent(blogtitle);
    return returnMe;
}