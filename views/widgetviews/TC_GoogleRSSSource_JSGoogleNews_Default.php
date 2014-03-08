<?php


if(!isset($TC_GoogleRSSSource_JSGoogleNews_Default_widgetEntity_ID))
{
    
    throw new Exception("cannot load Google widget.");
    
}

if(isset($TC_GoogleRSSSource_JSGoogleNews_Default_widget))
{
    $model = $TC_GoogleRSSSource_JSGoogleNews_Default_widget;
}
else
{
    $modelBuilder = new TC_GoogleRSSSource_Builder($TC_GoogleRSSSource_JSGoogleNews_Default_widgetEntity_ID);
    $model = $modelBuilder->getModel();
    unset($modelBuilder);
    
    
}


//$feed = $modelBuilder->generateFeed();

//echo $model->get_search_term();

?>

        
<script type="text/javascript" >


  
 

$(document).ready(function(){
	
	$('#widget-<?php echo $TC_GoogleRSSSource_JSGoogleNews_Default_widgetEntity_ID ;?>').mediafeed('https://news.google.com/news/feeds?q=<?php echo addslashes($model->get_search_term()) ;?>&output=rss', {
            limit: <?php echo GLOBAL_FEED_ITEM_CAP ; ?>,
            header: false,
            content: false
  },function(e){
      var feedLink =$('#widget-<?php echo $TC_GoogleRSSSource_JSGoogleNews_Default_widgetEntity_ID ;?> .feedLinkInput').val();
      
      
      $('#widget-<?php echo $TC_GoogleRSSSource_JSGoogleNews_Default_widgetEntity_ID ;?>').parent().find('h1').first().html('<a target="_blank" href="'+feedLink+'" ><?php echo addslashes($model->get_title()); ?></a><div class="sourceExpandIcon opened"></div>') ;
  
        });	

});




</script>


<div class="widget" >
    <h1><?php echo $model->get_title() ;?></h1>
              <ul id="widget-<?php echo $TC_GoogleRSSSource_JSGoogleNews_Default_widgetEntity_ID ;?>"  class="mediafeed">
            <img src="/public/images/loading2.gif" />
              </ul>
</div>
        