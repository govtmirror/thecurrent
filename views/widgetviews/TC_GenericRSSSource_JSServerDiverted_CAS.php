<?php


if(!isset($TC_GenericRSSSource_JSServerDiverted_CAS_widgetEntity_ID))
{
    
    throw new Exception("cannot load Google widget.");
    
}

if(isset($TC_GenericRSSSource_JSServerDiverted_CAS_widget))
{
    $model = $TC_GenericRSSSource_JSServerDiverted_CAS_widget;
}
else
{
    $modelBuilder = new TC_GenericRSSSource_Builder($TC_GenericRSSSource_JSServerDiverted_CAS_widgetEntity_ID);
    $model = $modelBuilder->getModel();
    unset($modelBuilder);
    
}






//$feed = $modelBuilder->generateFeed();

//echo $model->get_search_term();

?>
<script type="text/javascript">
$(document).ready(function () {
    
        $.ajax({
            
            url: '../../bll/ajaxhandlers/handleServerDiverted_GenericRSSSource_CASSimplePie.php',
            data: {                                        

            widgetEntity_ID: '<?php echo $TC_GenericRSSSource_JSServerDiverted_CAS_widgetEntity_ID ;?>'

            //params: id
                },
            success: function(data){
                //$('#main *').unbind();
                //$('#main *').die();
                //$('#main').empty();
                $('#widget-<?php echo $TC_GenericRSSSource_JSServerDiverted_CAS_widgetEntity_ID ;?>').parent(".widget").replaceWith(data);
                var feedLink =$('#widget-<?php echo $TC_GenericRSSSource_JSServerDiverted_CAS_widgetEntity_ID ;?> .feedLinkInput').val();
                $('#widget-<?php echo $TC_GenericRSSSource_JSServerDiverted_CAS_widgetEntity_ID ;?>').parent().find('h1').first().html('<a target="_blank" href="http://wordpress.state.gov/cas" ><?php echo addslashes($model->get_title()); ?></a><div class="sourceExpandIcon opened"></div>') ;
                
                
                if($.trim($('#widget-<?php echo $TC_GenericRSSSource_JSServerDiverted_CAS_widgetEntity_ID ;?>').html()) == '')
                    {
                        $('#widget-<?php echo $TC_GenericRSSSource_JSServerDiverted_CAS_widgetEntity_ID ;?>').html('<div class="feedMessage">There were no results retrieved from this feed. Please try refreshing the page or <a href="mailto:edipcurrentadmin@state.gov">contact us</a> for assistance.</div>');
                        //data = '<div class="feedMessage">There were no results retrieved from this feed. Please try refreshing the page or <a href="mailto:edipcurrentadmin@state.gov">contact us</a> for assistance.</div>';
                    }
                
                //var urlPattern = /^http(s?):\/\/(.*?[^www])\.state\.(gov|sbu)(\/.*)?$/i;
                var domain = escapeRegExp('<?php echo SITE_DOMAIN .'/'. DISCUSSION_PAGE_FOLDER ;?>');
                var pattern = new RegExp('^' + domain + '(\\\/.*)?$');
                //alert(pattern);
                //var urlPattern = /^domain(\/.*)?$/i;
                //var wpPattern =  /^http(s?):\/\/wordpress\.state\.gov(\/.*)?$/i;
                if(pattern.test('<?php echo $model->get_link();?>'))
                    {
                            $('#widget-<?php echo $TC_GenericRSSSource_JSServerDiverted_CAS_widgetEntity_ID ;?>').find('.discussShare').livequery(function(){
                                $(this).remove();

                            })
                    }
                //initializeJS();
            }
        });
    
});    

	

</script>
        


<div class="widget" >
    <h1><a target="_blank" href="http://wordpress.state.gov/cas"><?php echo $model->get_title() ;?></a></h1>
              <ul id="widget-<?php echo $TC_GenericRSSSource_JSServerDiverted_CAS_widgetEntity_ID ;?>">
            <img src="/public/images/loading2.gif" />
              </ul>
</div>
        