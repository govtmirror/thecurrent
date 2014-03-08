<?php


if(!isset($TC_MergedRSSSource_JSServerDiverted_Default_widgetEntity_ID))
{
    
    throw new Exception("cannot load Google widget.");
    
}

if(isset($TC_MergedRSSSource_JSServerDiverted_Default_widget))
{
    $model = $TC_MergedRSSSource_JSServerDiverted_Default_widget;
}
else
{
    $modelBuilder = new TC_MergedRSSSource_Builder($TC_MergedRSSSource_JSServerDiverted_Default_widgetEntity_ID);
    $model = $modelBuilder->getModel();
    unset($modelBuilder);
    
    
}






//$feed = $modelBuilder->generateFeed();

//echo $model->get_search_term();

?>
<script type="text/javascript">
$(document).ready(function () {
    
        $.ajax({
            
            url: '../../bll/ajaxhandlers/handleServerDiverted_MergedRSSSource_SimplePie.php',
            data: {                                        

            widgetEntity_ID: '<?php echo $TC_MergedRSSSource_JSServerDiverted_Default_widgetEntity_ID ;?>'

            //params: id
                },
            success: function(data){
                //$('#main *').unbind();
                //$('#main *').die();
                //$('#main').empty();
                $('#widget-<?php echo $TC_MergedRSSSource_JSServerDiverted_Default_widgetEntity_ID ;?>').parent(".widget").replaceWith(data);
                
                if($.trim($('#widget-<?php echo $TC_MergedRSSSource_JSServerDiverted_Default_widgetEntity_ID ;?>').html()) == '')
                    {
                        $('#widget-<?php echo $TC_MergedRSSSource_JSServerDiverted_Default_widgetEntity_ID ;?>').html('<div class="feedMessage">There were no results retrieved from this feed. Please try refreshing the page or <a href="mailto:edipcurrentadmin@state.gov">contact us</a> for assistance.</div>');
                        //data = '<div class="feedMessage">There were no results retrieved from this feed. Please try refreshing the page or <a href="mailto:edipcurrentadmin@state.gov">contact us</a> for assistance.</div>';
                    }
                //initializeJS();
            }
        });
    
});    

	

</script>
        



<div class="widget" >
    <h1><?php echo $model->get_title() ;?></h1>
              <ul id="widget-<?php echo $TC_MergedRSSSource_JSServerDiverted_Default_widgetEntity_ID ;?>">
            <img src="/public/images/loading2.gif" />
              </ul>
</div>
        