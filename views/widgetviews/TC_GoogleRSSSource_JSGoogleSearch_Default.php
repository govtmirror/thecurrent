<?php


if(!isset($TC_GoogleRSSSource_JSGoogleSearch_Default_widgetEntity_ID))
{
    
    throw new Exception("cannot load Google widget.");
    
}


if(isset($TC_GoogleRSSSource_JSGoogleSearch_Default_widget))
{
    $model = $TC_GoogleRSSSource_JSGoogleSearch_Default_widget;
}
else
{
    $modelBuilder = new TC_GoogleRSSSource_Builder($TC_GoogleRSSSource_JSGoogleSearch_Default_widgetEntity_ID);
    $model = $modelBuilder->getModel();
    unset($modelBuilder);
    
    
}



//$feed = $modelBuilder->generateFeed();

//echo $model->get_search_term();

?>

        
<script type="text/javascript" >


function OnLoad<?php echo $TC_GoogleRSSSource_JSGoogleSearch_Default_widgetEntity_ID; ?>() {
  
  var query = 'site:<?php echo $model->get_domain()." ".addslashes($model->get_search_term());?>';
  google.feeds.findFeeds(query, findDone<?php echo $TC_GoogleRSSSource_JSGoogleSearch_Default_widgetEntity_ID; ?>);
  
}

function findDone<?php echo $TC_GoogleRSSSource_JSGoogleSearch_Default_widgetEntity_ID; ?>(result) {
  // Make sure we didn't get an error.
  if (!result.error) {
    // Get content div
    var content = document.getElementById('widget-<?php echo $TC_GoogleRSSSource_JSGoogleSearch_Default_widgetEntity_ID ;?>');
    var html = '';

    // Loop through the results and print out the title of the feed and link to
    // the url.
    if(result.entries.length == 0)
        {
            html+='<div class="feedMessage">There were no results retrieved from this feed. Please try refreshing the page or <a href="mailto:edipcurrentadmin@state.gov">contact us</a> for assistance.</div>';
        }
    for (var i = 0; i < result.entries.length && i < <?php echo GLOBAL_FEED_ITEM_CAP ; ?>; i++) {
      var entry = result.entries[i];
	var pubdate = new Date(entry.publishedDate);
	//pubdate=pubdate.toLocaleDateString();
        
        
        
        
        
        
        
html+='<li class="rssRow">';
html+='<div style="overflow:auto;">';
html+='<input type="hidden" class="feedLinkInput" value="'+ entry.link +'" ></input>';

html+='<a class="feedInnerLink" href="javascript:void(0);"  title="View this feed at '+entry.title+'"><span>'+entry.title+'</span>';
html+='</a>';
html+='<div class="feedContent"><div class="feedHiddenContent">';
html+='<a class="feedInnerLink" href="javascript:void(0);"  title="View this feed at '+entry.title+'">';
if(entry.hasOwnProperty('contentSnippet'))
    {
        html += '<p class="date">';
        html+=entry.contentSnippet.replace('\u003cbr\u003e','');
        html += '</p>';
    }
html+='</a>';
html+='</div>';
html+='<div class="feedFullContent" style="display:none;">';    

//if(entry.content != entry.contentSnippet)
//    {
 //       html+=entry.content;
 //   }
//else
//    {
html+='The feed provider did not include source content. <br /> <a target="_blank" href="'+entry.link+'">Click here</a> to read the full article from the source.';
 //   }


html+='</div>';
html+='<div class="feedContentMeta">';
html+='<a target="_blank"  href="'+entry.link+'">read full article</a>';
html+='</div>';
html+='</div>';

html+='<div class="shareContainer">';
html+='<a class="share tooltip" title="Share in Corridor" target="_blank" href="'+generateCorridorShare(entry)+'"><div class="shareIcon corridorShare"></div><span class="tttext classic">Share in Corridor</span></a>';
html+='<a class="share tooltip" title="Send by email" href="mailto:?Subject=Shared From the Current - '+strip(entry.title)+'&body='+strip(entry.link)+'" ><div class="shareIcon mailShare"></div><span class="tttext classic">Send by email</span></a>';
//html+='<form class="currentDiscussionForm" action="discussion/?page_id=23">';
//html+='<a class="share tooltip" title="Discuss in The Current" href="javascript:void(0);"  ><div class="shareIcon discussShare"></div><span class="tttext classic">Discuss in The Current</span></a>';
//html+='</form>'
html+='</div>';

html+="</div></li>"
        
        
        
        
        
        
      //html += '<li><a target="_blank" href="' + entry.link + '"><strong>' + entry.title + '</strong>';
      //html += '<p class="date">'+entry.contentSnippet.replace('\u003cbr\u003e','')+'</p>';
      //html += '<div class="feedContentMeta"><a target="_blank"  href="'+entry.link+'">read full article</a></div></a>';
      
      //html += '<div class="shareContainer"><a class="share" target="_blank" href="'+generateCorridorShare(entry)+'"><div class="shareIcon corridorShare"></div></a><a class="share"  href="mailto:?Subject=Shared From the Current - '+strip(entry.title)+'&body='+strip(entry.link)+'"><div class="shareIcon mailShare"></div></a><a class="share" href="javascript:void(0);"  ><div class="shareIcon discussShare"></div></a></li>';
    }
    content.innerHTML = html;
  }
}

$(document).ready(function(){
	
	OnLoad<?php echo $TC_GoogleRSSSource_JSGoogleSearch_Default_widgetEntity_ID; ?>();	

});




</script>


<div class="widget" >
    <h1><a target="_blank" href="<?php echo parse_url($model->get_domain(),PHP_URL_HOST)? $model->get_domain() : 'http://'.$model->get_domain() ; ?>"><?php echo $model->get_title() ;?></a><div class="sourceExpandIcon opened"></div></h1>
              <ul id="widget-<?php echo $TC_GoogleRSSSource_JSGoogleSearch_Default_widgetEntity_ID ;?>"  class="mediafeed">
            <img src="/public/images/loading2.gif" />
              </ul>
</div>
        