<?php


if(!isset($TC_GenericRSSSource_JSGoogleRSS_Default_widgetEntity_ID))
{
    
    throw new Exception("cannot load Google widget.");
    
}
if(isset($TC_GenericRSSSource_JSGoogleRSS_Default_widget))
{
    $model = $TC_GenericRSSSource_JSGoogleRSS_Default_widget;
}
else
{
    $modelBuilder = new TC_GenericRSSSource_Builder($TC_GenericRSSSource_JSGoogleRSS_Default_widgetEntity_ID);
    $model = $modelBuilder->getModel();
    unset($modelBuilder);
    
}





//$feed = $modelBuilder->generateFeed();

//echo $model->get_search_term();

?>
<script type="text/javascript">
$(document).ready(function () {

	

  $('#widget-<?php echo $TC_GenericRSSSource_JSGoogleRSS_Default_widgetEntity_ID ;?>').mediafeed('<?php echo $model->get_link() ;?>', 
        {
        limit: <?php echo GLOBAL_FEED_ITEM_CAP ; ?>,
        header: false,
        content: false
        },
        function(e){
        var feedLink = $('#widget-<?php echo $TC_GenericRSSSource_JSGoogleRSS_Default_widgetEntity_ID ;?> .feedLinkInput').val();
        $('#widget-<?php echo $TC_GenericRSSSource_JSGoogleRSS_Default_widgetEntity_ID ;?>').parent().find('h1').first().html('<a target="_blank" href="'+feedLink+'" ><?php echo addslashes($model->get_title()); ?></a><div class="sourceExpandIcon opened"></div>') ;
        //alert($(this).html());
        }
    );
  
                var domain = escapeRegExp('<?php echo SITE_DOMAIN .'/'. DISCUSSION_PAGE_FOLDER ;?>');
 
                
                
                var pattern = new RegExp('^' + domain + '(\\\/.*)?$');
                //alert(pattern);
                //var urlPattern = /^domain(\/.*)?$/i;
                //var wpPattern =  /^http(s?):\/\/wordpress\.state\.gov(\/.*)?$/i;
                if(pattern.test('<?php echo $model->get_link();?>'))
                    {
                            $('#widget-<?php echo $TC_GenericRSSSource_JSGoogleRSS_Default_widgetEntity_ID ;?>').find('.discussShare').livequery(function(){
                                $(this).remove();

                            })
                    }
                //initi
      
      //alert(feedLink);
     
 
  
  //('.feedLinkInput').val();
});


</script>
        



<div class="widget" >
    <h1><a target="_blank" href="<?php echo $model->get_link() ;?>"><?php echo $model->get_title() ;?></a></h1>
              <ul id="widget-<?php echo $TC_GenericRSSSource_JSGoogleRSS_Default_widgetEntity_ID ;?>">
            <img src="/public/images/loading2.gif" />
              </ul>
</div>
        