<?php


if(!isset($TC_CorridorUserSource_JSCORS_Default_widgetEntity_ID))
{
    
    throw new Exception("cannot load Corridor widget.");
    
}

$modelBuilder = new TC_CorridorUserSource_Builder($TC_CorridorUserSource_JSCORS_Default_widgetEntity_ID);
$model = $modelBuilder->getModel();
unset($modelBuilder);




//$feed = $modelBuilder->generateFeed();

//echo $model->get_search_term();

?>
<script type="text/javascript">
$(document).ready(function () {
if(!$.browser.msie)
{
	
        
        $.getFeed({                
                url: '<?php echo CORRIDOR_WEB_SERVICE_URL ;?>',
                headers: {

                        },
                        xhrFields: {
                        withCredentials: true
                        },
                data: {        
                content_type: '<?php echo $model->get_content_type() ;?>',
		    groupID: '<?php echo $model->get_groupID() ;?>'
                },
                success: function(feed){
                    
                    
                    // Get content div
                    var content = document.getElementById('widget-<?php echo $TC_CorridorUserSource_JSCORS_Default_widgetEntity_ID ;?>');
                    var html = '';

                    // Loop through the results and print out the title of the feed and link to
                    // the url.
                    if(feed.items.length == 0)
                        {
                            html+='<div class="feedMessage">There were no results retrieved from this feed. Please try refreshing the page or <a href="mailto:edipcurrentadmin@state.gov">contact us</a> for assistance.</div>';
                        }
                        html+='<ul class="mediafeed">';
                    for (var i = 0; i < feed.items.length && i < <?php echo GLOBAL_FEED_ITEM_CAP ; ?>; i++) {
                        var entry = feed.items[i];
                        //var pubdate = new Date(entry.pubDate);
                            //pubdate=pubdate.toLocaleDateString();

                        html+='<li class="rssRow">';
                        html+='<div style="overflow:auto;">';
                        html+='<input type="hidden" class="feedLinkInput" value="'+ entry.link +'" ></input>';
                        
                        
                        
                        var thumbnail = '';



                        
									
					if(entry.hasOwnProperty('thumbnail'))
					{


						if(entry.thumbnail.length > 0)
	                              {
      	                              
                  	                      
                              	          	thumbnail = entry.thumbnail;
                                    	    

	                                    
                                	}

					}
				

                            if(thumbnail != '')
                                {
                        html+='<div style="padding-bottom:7px; float:left;">';            
                        html+='<a class="feedInnerLink" style="float:left; width:85px;" href="javascript:void(0);" title="View this feed at '+entry.title+'"><img style="float:left;width:75px;height:75px;" src="'+thumbnail+'" />';
                        html+='</a>';
                        html+='</div>';
                                }
                        
                        
                        
                        
                        
                        
                        var numberDate = Date.parse(entry.updated);
                        var d = new Date(numberDate);
                        var curr_date = d.getDate();
                        var curr_month = d.getMonth();
                        curr_month++;
                        var curr_year = d.getFullYear();
                        var newDate = curr_month + "/" + curr_date + "/" + curr_year;


                        html+='<strong class="date">' + newDate + '</strong>';
                        html+='<a class="feedInnerLink" href="javascript:void(0);"  title="View this feed at '+entry.title+'"><span>'+entry.title+'</span>';
                        html+='</a>';
                        html+='<div class="feedContent"><div class="feedHiddenContent">';
                        html+='<a class="feedInnerLink" href="javascript:void(0);"  title="View this feed at '+entry.title+'">';
                        if(entry.hasOwnProperty('description'))
                            {
                                html += '<p class="date">';
                                html+=entry.description.replace('\u003cbr\u003e','');
                                html += '</p>';
                            }
                        html+='</a>';
                        html+='</div>';
                        html+='<div class="feedFullContent" style="display:none;">';    

                        if(entry.hasOwnProperty('content'))
                            {
                                
                                html+=entry.content.replace('\u003cbr\u003e','');
                                
                            } 
                            else if(entry.hasOwnProperty('description'))
                            {
                                html+=entry.description.replace('\u003cbr\u003e','');
                            }
                            
                            else
                            {
                                html+='The feed provider did not include source content. <br /> <a target="_blank" href="'+entry.link+'">Click here</a> to read the full article from the source.';
                            }
                        



                        html+='</div>';
                        html+='<div class="feedContentMeta">';
                        html+='<a target="_blank"  href="'+entry.link+'">read full article</a>';
                        html+='</div>';
                        html+='</div>';

                        html+='<div class="shareContainer">';
                        
                        html+='<a class="share tooltip" title="Send by email" href="mailto:?Subject=Shared From the Current - '+strip(entry.title)+'&body='+strip(entry.link)+'" ><div class="shareIcon mailShare"></div><span class="tttext classic">Send by email</span></a>';

                        html+='</div>';

                        html+="</div></li>";


                    }
html+="</ul>";
                    content.innerHTML = html;
                
                    
                    
                    
                        var feedLink = $('#widget-<?php echo $TC_CorridorUserSource_JSCORS_Default_widgetEntity_ID ;?> .feedLinkInput').val();
                        feedLink= '<?php echo CORRIDOR_URL; ?>';
                        $('#widget-<?php echo $TC_CorridorUserSource_JSCORS_Default_widgetEntity_ID ;?>').parent().find('h1').first().html('<a target="_blank" href="'+feedLink+'" ><?php echo addslashes($model->get_title()); ?></a><div class="sourceExpandIcon opened"></div>') ;
        

                }
                

        }); 
        
 }
else
{
var content = document.getElementById('widget-<?php echo $TC_CorridorUserSource_JSCORS_Default_widgetEntity_ID ;?>');
var html='<div class="feedMessage">This source type relies on cutting-edge technology and is only available in modern browsers. View The Current in Google Chrome for best results.</div>';

                    content.innerHTML = html;
}       
        

});


</script>
        



<div class="widget" >
    <h1><a target="_blank" href="<?php echo CORRIDOR_WEB_SERVICE_URL ;?>"><?php echo $model->get_title() ;?></a></h1>
              <ul id="widget-<?php echo $TC_CorridorUserSource_JSCORS_Default_widgetEntity_ID ;?>">
            <img src="/public/images/loading2.gif" />
              </ul>
</div>
        
