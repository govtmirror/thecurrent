<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>The Current</title>
        <![if !ie]><link rel="stylesheet" href="/public/css/style.css" type="text/css" media="screen" /><![endif]>
        <!--[if ie]><link rel="stylesheet" href="/public/css/ie.css" type="text/css" media="screen" /><![endif]-->
	<link rel="stylesheet" href="/public/css/ui-lightness/jquery-ui-1.8.18.custom.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="/public/AnythingSlider/css/anythingslider2.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="/public/js/select2-3.4.5/select2.css" type="text/css" media="screen" />

        <script type="text/javascript" src="/public/js/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="/public/js/jquery.livequery.js"></script>
	<script type="text/javascript" src="/public/js/jquery-ui-1.8.18.custom.min.js"></script>
	<script type="text/javascript" src="/public/js/jquery.cookie.js"></script>
        <script type="text/javascript" src="/public/js/jquery.jfeed.js"></script>
        <script type="text/javascript" src="/public/js/corridorShare.js"></script>
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script src="/public/js/jquery.zrssfeed.min.js" type="text/javascript"></script>
	<script src="/public/js/jquery.zflickrfeed.min.js" type="text/javascript"></script>
        <script src="/public/js/jquery.zrssyoutubefeed.js" type="text/javascript"></script>
        <script src="/public/js/jquery.zrssmediafeed.js" type="text/javascript"></script>
        <script src="/public/js/jquery.ztwitterfeed.min.js" type="text/javascript"></script>
	<script src="/public/js/functions.js" type="text/javascript"></script>
        <script type="text/javascript" src="/public/player/jwplayer.js"></script>
        <script type="text/javascript" src="/public/AnythingSlider/js/jquery.anythingslider.js"></script>
        <script type="text/javascript" src="/public/AnythingSlider/js/jquery.anythingslider.video.js"></script>
        <script type="text/javascript" src="/public/AnythingSlider/js/jquery.anythingslider.fx.js"></script>
        <script type="text/javascript" src="/public/AnythingSlider/js/jquery.easing.1.2.js"></script>
        <script type="text/javascript" src="/public/AnythingSlider/js/swfobject.js"></script>

        <script src="/public/js/underscore-min.js" type="text/javascript"></script>
        <script src="/public/js/backbone-min.js" type="text/javascript"></script>
        <script src="/public/js/select2-3.4.5/select2.min.js" type="text/javascript"></script>
        <script src="/public/js/jquery.tagcloud.js" type="text/javascript"></script>



        <style>
            #slider { width: 512px; height: 384px; }
	</style>
	<script type="text/javascript">

google.load("feeds", "1");


</script>
        <script type="text/javascript">
        <?php
        $user_ID_array =  TC_Authenticator::getUserIDAndInitialize();
        $user_ID = $user_ID_array[0];
        if($user_ID_array[1] !== false)
        {
            $accessgroup_id = $user_ID_array[1];
        }
        //$accessgroup_id = $user_ID_array[1];

        elseif($user_ID === SYSTEM_USER_ID)
        {
            $accessgroup_id = TC_Utility::verifyAndGetGlobalGroup()->get_keyValue();//TC_Utility::verifyAndGetGlobalGroup()->get_keyValue();
        }
        else
        {
            $accessgroup_id = TC_Utility::verifyAndGetPersonalGroup($user_id)->get_keyValue();//TC_PersistenceUtility::getPersonalGroupID($user_ID);
        }




        ?>

      //this is a jquery bug fix for scroll bars. Just include for now. Might break out later.
        (
            function( $, undefined )
            {
                if ($.ui && $.ui.dialog)
                {
                    $.ui.dialog.overlay.events = $.map('focus,keydown,keypress'.split(','), function(event) { return event + '.dialog-overlay'; }).join(' ');
                }
            }(jQuery)
        );
// end jquery fix.
        var contentEdit = undefined;
        var navEdit = undefined;

        function makeSortableNav()
        {
            $('#navigation').sortable({
                axis: 'y',
                items: 'li.dashboardEditTab',
                containment: '#navigation',
                start: function(event, ui){
                    //alert(ui.item.html());
                    //alert('hi');
                    //ui.item.find('.ui-widget-header').addClass('noClick');
                    ui.item.addClass('noClick');
                    //$(this).addClass('noClick');
                    //ui.item.bind("click.prevent", function(event){ event.preventDefault();});
                },
                stop: function(event, ui)
                {
                    ui.item.removeClass('noClick');
                }

                //
                //,
                //stop: function(event, ui){
                    //setTimeout(function(){ui.item.unbind("click.prevent");}, 300);
                //}
            });
        }
       function initializeNavDialog()
       {




       }


        var t;
        var timer_is_on = 0;

        function timerRefresh()
        {

            var id = $('ul#navigation > li > a.current').attr('id');
            if(typeof id  == "undefined")
                        {
                            id = null
                        }
                        else
                        {
                            var idArr = id.split('-');
                            id = idArr[idArr.length - 1];
                        }

//////////////////////////////////////////
            //if(typeof navEdit != "undefined")
            //    {
            //      //navEdit.abort();
            //    }

                if(typeof contentEdit != "undefined")
                {
                  //contentEdit.abort();
                }
                 contentEdit = $.ajax({

                    url: '../../bll/ajaxhandlers/loadDashboardContent.php',
                    data: {
                    entity_ID: id,
                    user_ID: '<?php echo $user_ID;?>'
                    },
                    dataType : 'text', error: function(jqXHR, textStatus, errorThrown) {
        $('ul#navigation > li > a.current').click();
    },
                    success: function(data2){
                    $('#main *').unbind();
                    $('#main *').die();
                    $('#main').empty();
                    $('#main').html(data2);

                    contentEdit = undefined;


                    }

                });





            t=setTimeout("timerRefresh()",3600000);

        }

        function startStopRefreshTimer(x)
        {
            if(x == 1)
            {
                if (!timer_is_on)
                {
                    timer_is_on=1;
                    timerRefresh();
                }


            }
            else
            {
                clearTimeout(t);
                timer_is_on=0;

            }
        }






function addTabInfo(title)
{
                    var id = $('ul#navigation > li > a.current').attr('id');

                    //var id = $(this).attr('id');

                    if(typeof id  == "undefined")
                        {
                            id = null
                        }
                        else
                        {
                            var idArr = id.split('-');
                            id = idArr[idArr.length - 1];
                        }
                    $('#main').html('<div style="height:600px"><img src="/public/images/loading.gif" style="position:absolute; top:40%; left:42%;" /></div>');




                    $.ajax({
                    //document.location.hostname+
                    url: '../../bll/ajaxhandlers/addDashboardTab.php',
                    data: {
                    user_ID: '<?php echo $user_ID; ?>',
                    title: title,
                    description: '',
                    accessgroup_ID: '<?php echo $accessgroup_id; ?>'
                    //params: id
                          },
                    success: function(data){
                    var newContId = parseInt(data);
                    if(isNaN(newContId))
                        {
                            alertUserMax();
                        }
                    $.ajax({
                    //document.location.hostname+
                        url: '../../bll/ajaxhandlers/loadDashboardContentEditAndNavEdit.php',
                        data: {
                        entity_ID: newContId,
                        user_ID: '<?php echo $user_ID;?>'
                                },timeout: 0,dataType : 'html', error: function(jqXHR, textStatus, errorThrown) {
        $('ul#navigation > li > a.current').click();
    },
                        success: function(data){


                        //alert($(data).filter("#ajaxRenderNav").html());
                        $('#main').html($(data).filter("#ajaxRenderContent").html());
                        $('#navdiv').html($(data).filter("#ajaxRenderNav").html());



                        $(data).filter('script').each(function(){
                            $.globalEval(this.text || this.textContent || this.innerHTML || '');
                        });




                        }

                    });




                    }

                });
                navEdit = undefined;
                contentEdit = undefined;
}

function editTabInfo(title, id)
{
               var cid = $('ul#navigation > li > a.current').attr('id');

                    //var id = $(this).attr('id');
                    if(typeof cid  == "undefined")
                        {
                            cid = null
                        }
                        else
                        {
                            var idArr = cid.split('-');
                            cid = idArr[idArr.length - 1];
                        }

               $.ajax({

                    url: '../../bll/ajaxhandlers/renameDashboardTab.php',
                    data: {
                    entity_ID: id,
                    user_ID: '<?php echo $user_ID;?>',
                    accessgroup_ID: '<?php echo $accessgroup_id;?>',
                    title: title
                          },
                    success: function(data){
                        if(typeof navEdit != "undefined")
                    {
                      //navEdit.abort();
                    }
                     navEdit = $.ajax({
                            url: '../../bll/ajaxhandlers/loadDashboardNavEdit.php',
                            data: {
                            user_ID: '<?php echo $user_ID;?>',
                            entity_ID: cid

                            //params: id
                              },timeout: 0,dataType : 'text', error: function(jqXHR, textStatus, errorThrown) {
        $('ul#navigation > li > a.current').click();
    },
                            success: function(data2){
                               // $('#navdiv *').unbind();
                                //$('#navdiv *').die();
                                //$('#navdiv').empty();
                                $('#navdiv').html(data2);
                                //initializeJS();
                            }
                        });

                    }

               });


            navEdit = undefined;
            contentEdit = undefined;
}



function addUpdateTabInfo(title, id)
{
                    var cid = $('ul#navigation > li > a.current').attr('id');

                    //var id = $(this).attr('id');
                    if(typeof cid  == "undefined")
                        {
                            cid = null
                        }
                        else
                        {
                            var idArr = cid.split('-');
                            cid = idArr[idArr.length - 1];
                        }

               $.ajax({
                    //document.location.hostname+
                    /*
                    -$renameDashboardTab_user_ID
-$renameDashboardTab_container_ID
-$renameDashboardTab_title
-$renameDashboardTab_description
-$renameDashboardTab_params
*/
                    url: '../../bll/ajaxhandlers/renameDashboardTab.php',
                    data: {
                    entity_ID: id,
                    user_ID: '<?php echo $user_ID;?>',
                    accessgroup_ID: '<?php echo $accessgroup_id;?>',
                    title: title
                          },
                    success: function(data){
                        if(typeof navEdit != "undefined")
                    {
                      //navEdit.abort();
                    }
                     navEdit = $.ajax({
                            url: '../../bll/ajaxhandlers/loadDashboardNavEdit.php',
                            data: {
                            user_ID: '<?php echo $user_ID;?>',
                            entity_ID: cid

                            //params: id
                              },timeout: 0,dataType : 'text', error: function(jqXHR, textStatus, errorThrown) {
        $('ul#navigation > li > a.current').click();
    },
                            success: function(data2){
                               // $('#navdiv *').unbind();
                                //$('#navdiv *').die();
                                //$('#navdiv').empty();
                                $('#navdiv').html(data2);
                                //initializeJS();
                            }
                        });

                    }

               });


            navEdit = undefined;
            contentEdit = undefined;
}
        $(document).ready(function(){

            $("#navdiv").ajaxSuccess(function(){
                enableCursor();
            });
            $("#main").ajaxSuccess(function(){
                enableCursor();
            });
            $("#navdiv").ajaxStart(function(){
                disableCursor();
            });
            $("#main").ajaxStart(function(){
                disableCursor();
            });
            //initializeNavDialog();


            // $('#catalogLink').click(function(e){
            //     $.ajax({
            //         url: '../../bll/ajaxhandlers/loadCatalog.php',
            //         success: function(data){
            //             var side = $('<div>');
            //             var panel = $('<div>');
            //             side.attr('id','catalog_side');
            //             panel.attr('id','catalog_main');
            //             $('#main').html(side);
            //             $('#main').append(panel);


            //             side.html($(data).filter("#ajaxRenderSidebar").html());
            //             panel.html($(data).filter("#ajaxRenderPanel").html());



            //             $(data).filter('script').each(function(){
            //                 $.globalEval(this.text || this.textContent || this.innerHTML || '');
            //             });
            //         }
            //     });

            // });





    // function reloadCatalogPanel(){
    //     var containerEntityID = $('ul#navigation > li > a.current').attr('id');//$(this).parent().find('.contentEditContainer').attr("id");
    //     containerEntityID = containerEntityID.split('-');
    //     containerEntityID = containerEntityID[containerEntityID.length - 1];
    //     var userID = '<?php echo $user_ID;?>';

    //         $.ajax({
    //     //document.location.hostname+
    //             url: '../../bll/ajaxhandlers/loadDashboardContentEditAndNavEdit.php',
    //             data: {
    //             entity_ID: containerEntityID,
    //             user_ID: userID
    //             },
    //             timeout: 0,
    //             dataType : 'html',
    //             error: function(jqXHR, textStatus, errorThrown) {
    //                 $('ul#navigation > li > a.current').click();
    //             },
    //             success: function(data){

    //             //alert($(data).filter("#ajaxRenderNav").html());
    //             $('#main').html($(data).filter("#ajaxRenderContent").html());
    //             $('#navdiv').html($(data).filter("#ajaxRenderNav").html());



    //             $(data).filter('script').each(function(){
    //                 $.globalEval(this.text || this.textContent || this.innerHTML || '');
    //             });

    //             navEdit = undefined;
    //             contentEdit = undefined;


    //             }

    //         });
    // }


    // $('#previewTabDialogBox').dialog(
    //         {
    //             autoOpen: false,
    //             draggable:false,
    //             modal:true,
    //             width:1000,
    //             height:600,
    //             title: 'Page Preview',
    //             open: function(event, ui){
    //                 var entity_ID = $(this).data("entity_id");
    //                 var subscribed = $(this).data('subscribed');
    //                 var unsubPreviewButtons = [
    //                             {
    //                                 text: "Subscribe",
    //                                 click: function(){
    //                                     $.ajax({
    //                                         url: '../../bll/ajaxhandlers/subscribeToDashboard.php',
    //                                         contentType: "text/plain",
    //                                         dataType : 'text',
    //                                         data: {
    //                                             user_ID: '<?php echo $user_ID;?>',
    //                                             entity_ID: entity_ID,
    //                                             isActive: subscribed
    //                                         },
    //                                         success: function(data){
    //                                             var newContId = parseInt(data);
    //                                             if(isNaN(newContId))
    //                                             {
    //                                                 alertUserPubMax();
    //                                             }
    //                                             reloadCatalogPanel();
    //                                         }
    //                                     });
    //                                     $(this).dialog("close");
    //                                 }
    //                             },
    //                             {
    //                                 text: "Close",
    //                                 click: function(){$(this).dialog("close");}
    //                             }];

    //                 var subPreviewButtons = [

    //                             {
    //                                 text: "Close",
    //                                 click: function(){$(this).dialog("close");}
    //                             }];
    //                 if(subscribed == 0)
    //                 {
    //                     $(this).dialog("option", "buttons", subPreviewButtons);
    //                 }
    //                 else {
    //                     $(this).dialog("option", "buttons", unsubPreviewButtons);

    //                 }
    //                 $('#tabPreviewContent *').unbind();
    //                 $('#tabPreviewContent *').die();
    //                 $('#tabPreviewContent').empty();
    //                 $('#tabPreviewContent').html('<div style="height:600px"><img src="/public/images/loading.gif" style="position:absolute; top:40%; left:42%;" /></div>');
    //                 $.ajax({
    //                     url: '../../bll/ajaxhandlers/loadDashboardPreview.php',
    //                     data: {
    //                     entity_ID: entity_ID,
    //                     user_ID: '<?php echo $user_ID;?>'
    //                     },
    //                     dataType : 'text',
    //                     error: function(jqXHR, textStatus, errorThrown) {
    //                     },
    //                     success: function(data2){
    //                     $('#tabPreviewContent *').unbind();
    //                     $('#tabPreviewContent *').die();
    //                     $('#tabPreviewContent').empty();
    //                     $('#tabPreviewContent').html(data2);

    //                     }

    //                 });
    //             }
    //         }
    // );

    // $('.previewPageButton').live('click', function(){
    //     var entity_id = $(this).data("entityid");
    //     var subscribed = $(this).data('subscribed');
    //     $("#previewTabDialogBox").data('entity_id', entity_id);
    //     $("#previewTabDialogBox").data('subscribed', subscribed);
    //     $("#previewTabDialogBox").dialog('open');
    // });

    // $('.subscribePageButton').live('click', function(){
    //     var entity_id = $(this).data("entityid");
    //     var isActive = $(this).data('subscribed');
    //     $.ajax({
    //         url: '../../bll/ajaxhandlers/subscribeToDashboard.php',
    //         contentType: "text/plain",
    //         dataType : 'text',
    //         data: {
    //             user_ID: '<?php echo $user_ID;?>',
    //             entity_ID: entity_id,
    //             isActive: isActive
    //         },
    //         success: function(data){
    //             var newContId = parseInt(data);
    //             if(isNaN(newContId))
    //             {
    //                 alertUserPubMax();
    //             }
    //             reloadCatalogPanel();
    //         }
    //     });
    // });





            $('.SelectedSourceTitle').livequery(function(){
                //alert($(this).html());

                //var currentSelected = $(this).parent().find('.current').find('a').html();
                //$(this).find('a').html(currentSelected);
                var currentSelected = $(this).parent().find('.current').html();
                //alert(currentSelected);
                if(typeof currentSelected  == "undefined" || currentSelected  == null)
                        {
                            //alert('hi');
                            currentSelected = 'No Page Selected';
                        }


                $(this).html(currentSelected);

            });






            $('.unsubTabButton').live('click', function(){
                // var entity_id = $(this).data("entityid");

                if(!genericConfirm())
                    {return false;}
                var id = $(this).attr('id');

                var idArr = id.split('-');

                id = idArr[idArr.length - 1];

                var cid = $('ul#navigation > li > a.current').attr('id');

                        //var id = $(this).attr('id');
                        if(typeof cid  == "undefined")
                        {
                            cid = null
                        }
                        else
                        {
                            var idArr = cid.split('-');
                            cid = idArr[idArr.length - 1];
                        }


                // var isActive = $(this).data('subscribed');
                $.ajax({
                    url: '../../bll/ajaxhandlers/subscribeToDashboard.php',
                    contentType: "text/plain",
                    dataType : 'text',
                    data: {
                        user_ID: '<?php echo $user_ID;?>',
                        entity_ID: id,
                        isActive: 0
                    },
                    success: function(data){
                        $.ajax({
                    //document.location.hostname+
                            url: '../../bll/ajaxhandlers/loadDashboardContentEditAndNavEdit.php',
                            data: {
                            entity_ID: cid,
                            user_ID: '<?php echo $user_ID;?>'
                                    },timeout: 0,dataType : 'html', error: function(jqXHR, textStatus, errorThrown) {
            $('ul#navigation > li > a.current').click();
        },
                            success: function(data){


                            //alert($(data).filter("#ajaxRenderNav").html());
                            $('#main').html($(data).filter("#ajaxRenderContent").html());
                            $('#navdiv').html($(data).filter("#ajaxRenderNav").html());



                            $(data).filter('script').each(function(){
                                $.globalEval(this.text || this.textContent || this.innerHTML || '');
                            });




                            }

                        });

                        navEdit = undefined;
                        contentEdit = undefined;
                    }
                });


            });
            /////////
            $("#navigation").live('sortupdate', function(event, ui){
                    //alert(ui.item.count);
                        var id = $(ui.item).find(">:first-child").attr('id');

                        var idArr = id.split('-');

                        id = idArr[idArr.length - 1];

                        //var id = $(ui.item).find("span:first").html();
                        var priority = ui.item.index() + 1;
                        //alert(priority);
                        //alert(id);
                        var cid = $('ul#navigation > li > a.current').attr('id');

                        //var id = $(this).attr('id');
                        if(typeof cid  == "undefined")
                        {
                            cid = null
                        }
                        else
                        {
                            var idArr = cid.split('-');
                            cid = idArr[idArr.length - 1];
                        }
                        // var accessgroup = '';
                        // if($(ui.item).find(">:first-child").get(0).tagName == "DIV" )
                        //     {
                        //         accessgroup = '<?php echo TC_Utility::verifyAndGetGlobalGroup()->get_keyValue(); //TC_PersistenceUtility::getGlobalGroupID();?>';
                        //     }
                        // if($(ui.item).find(">:first-child").get(0).tagName == "A" )
                        //     {
                        //         accessgroup = '<?php echo $accessgroup_id;?>';
                        //     }

                        $.ajax({
                            url: '../../bll/ajaxhandlers/reorderDashboardTab.php',
                            data: {
                                        entity_ID: id,
                                        user_ID: '<?php echo $user_ID;?>',
                                        // accessgroup_ID: accessgroup,
                                        priority: priority
                                    },
                            success: function(data){
                                    if(typeof navEdit != "undefined")
                        {
                          //navEdit.abort();
                        }
                        navEdit = $.ajax({
                                        url: '../../bll/ajaxhandlers/loadDashboardNavEdit.php',
                                        data: {
                                        user_ID: '<?php echo $user_ID;?>',
                                        entity_ID: cid

                                        //params: id
                                        },timeout: 0,dataType : 'text', error: function(jqXHR, textStatus, errorThrown) {
        $('ul#navigation > li > a.current').click();
    },
                                        success: function(data2){
                                            //$('#navdiv *').unbind();
                                            //$('#navdiv *').die();
                                            //$('#navdiv').empty();
                                            $('#navdiv').html(data2);
                                            //initializeJS();
                                        }
                                    });



                            }


                        }) ;
                        navEdit = undefined;
                        contentEdit = undefined;
            });

            //$('#editDialogBox').unbind();

             //$('#editDialogBox').dialog("destroy");
            $('#editDialogBox').dialog({
                autoOpen: false,
                draggable:false,
                modal:true,
                buttons: [{
                            text: 'OK',
                            click: function(){

                                var title = $('#dashboardTitleTB').val();
                                var id = $('#dashboardIdIN').val();
                                if(id)
                                    {
                                        editTabInfo(title, id);
                                    }
                                    else
                                        {
                                            addTabInfo(title);
                                        }
                                //addUpdateTabInfo(title, id);
                                $(this).dialog('close');
                            }
                        },
                        {
                            text: 'Cancel',
                            click: function(){
                                $(this).dialog('close');
                            }
                        }]
                });



    var publishDialogTermsArray = new Array(
                    {id:0,text:'* Loading Tags *'}
    );

    $('#widgetTagsTBP').select2({
        minimumInputLength: 2,
        width: 'copy',
        multiple:true,
        data: function(){ return {results: publishDialogTermsArray}; }
    });

    var publishDialogTagTerms = new Array();
    var publishDialogTagIds = new Array();

    $('#publishTabDialogBox').dialog({
        autoOpen: false,
        draggable:false,
        title: "Publish Page to Catalog",
        modal:true,
        width:'600px',
        open: function(event, ui){

            $('#widgetTagsTBP').select2("container").hide();

            $('#widgetDescriptionTBP').hide();

            $.ajax({
                url: '<?php echo CORRIDOR_TAG_API_URL ;?>',
                data: {

                },
                dataType: 'json',
                success: function(data) {
                    //data = $.parseJSON(data);
                    publishDialogTagTerms = data.tags;
                    // console.log(publishDialogTagTerms);
                    publishDialogTagIds = data.ids;
                    // console.log(publishDialogTagIds);
                    publishDialogTermsArray = _.map(publishDialogTagTerms, function(term, key){
                        return { id: publishDialogTagIds[key], text: term};
                    });
                    // $("#widgetTagsTBP").select2("updateResults");
                    // $('#widgetTagsTBP').select2({
                    //     minimumInputLength: 2,
                    //     width: 'copy',
                    //     multiple:true,
                    //     data: publishDialogTermsArray
                    // });
                    // publishDialogTermsArray = publishDialogTagTerms;
                    var containerEntityID = $('ul#navigation > li > a.current').attr('id');//$(this).parent().find('.contentEditContainer').attr("id");
                    containerEntityID = containerEntityID.split('-');
                    containerEntityID = containerEntityID[containerEntityID.length - 1];
                    var selectedTags = new Array();
                    // set prior values
                    // alert(containerEntityID);
                    $.ajax({
                        url: '../../bll/ajaxhandlers/getTagsForEntity.php',
                        data: {
                            entity_ID: containerEntityID
                        },
                        // dataType: 'json',
                        success: function(data){
                            // console.log(data);
                            // alert(data);
                            data = JSON.parse(data);
                            var tagIds = data['tagIds'] || new Array();

                            var description = data.description || '';

                            // selectedTags = _.map(tagIds, function(tagId){
                            //     // console.log(tagId);
                            //     // console.log(publishDialogTagIds);
                            //     var tagKey = publishDialogTagIds.indexOf(tagId.toString());
                            //     // console.log(tagKey);
                            //     var tag = publishDialogTagTerms[tagKey];
                            //     // console.log(tag);
                            //     return { id: tagId, text: tag};
                            // });
                            selectedTags = tagIds;

                            // console.log(selectedTags);
                            // _.each(tagIds, function(tagId){

                            //     var tagKey = publishDialogTagIds.indexOf(tagId);
                            //     var tag = publishDialogTagTerms[tagKey];
                            //     selectedTags.push(tag);

                            // });
                            // console.log(selectedTags);
                            $('#widgetTagsTBP').select2('val', selectedTags);

                            // $('#widgetTagsTBP').val(selectedTags);
                            $('#widgetDescriptionTBP').val(description);

                        },
                        complete: function(jaXHR, textStatus){
                            $('#publishTagsLoadedComplete').val('1');
                            $('#widgetTagsTBP').select2("container").show();

                            $('#widgetDescriptionTBP').show();
                        }
                    });

                    //$('#widgetTagsTBP').select2({
                    //    minimumInputLength: 2,
                    //    width: 'copy',
                    //    multiple:true,
                    //    data: publishDialogTagTerms
                    //});

                    //$('#widgetTagsTBP').select2('data', publishDialogTagTerms);

                }
            });

            // todo: delete this next line after debugging
            // $('#publishTagsLoadedComplete').val('1');




            // $('#widgetDescriptionTBP').val();
            // $('#widgetTagsTBP').select2('data', '');
        },
        close: function(event, ui){
            $('#publishTagsLoadedComplete').val('0');
            $('#widgetTagsTBP').select2('val', '');

            publishDialogTermsArray = new Array(
                                {id:0,text:'* Loading Tags *'}
            );

            //$('#widgetTagsTBP').select2({
            //    minimumInputLength: 2,
            //    width: 'copy',
            //    multiple:true,
            //    data: [
            //        {id:0,text:'* Loading Tags *'},
            //        {id:1,text:'* Loading Tags2 *'},
            //        {id:2,text:'* Loading Tags3 *'}
            //    ]
            //});



            $('#widgetDescriptionTBP').val('');
        },
        buttons: [{
                    text: 'Publish',
                    click: function(){
                        if($('#publishTagsLoadedComplete').val() == '1')
                        {
                            var containerEntityID = $('ul#navigation > li > a.current').attr('id'); //$(this).parent().find('.contentEditContainer').attr("id");
                            containerEntityID = containerEntityID.split('-');
                            containerEntityID = containerEntityID[containerEntityID.length - 1];
                            var userID = '<?php echo $user_ID;?>';

                            var tags = $('#widgetTagsTBP').val() ? $('#widgetTagsTBP').val().split(',') : null;

                            // var tagIds = new Array();
                            // _.each(tags, function(tag){

                            //     var tagKey = publishDialogTagTerms.indexOf(tag);
                            //     var tagId = publishDialogTagIds[tagKey];
                            //     tagIds.push(tagId);

                            // });
                            // console.log(tags);


                            //var tagKeys = publishDialogTagTerms.indexOf();
                            //var tags = JSON.stringify($('#widgetTagsTBP').val());
                            // var title = $('#widgetNameTBP').val();
                            var description = $('#widgetDescriptionTBP').val();
                            // alert(description);
                            // return;

                            $('#main').html('<div style="height:600px"><img src="/public/images/loading.gif" style="position:absolute; top:40%; left:42%;" /></div>');



                            $.ajax({
                                url: '../../bll/ajaxhandlers/publishDashboardTab.php',
                                data: {
                                    user_ID: userID,
                                    entity_ID: containerEntityID,
                                    // title: title,
                                    tags: JSON.stringify(tags),
                                    description: description
                                },
                                success: function(data){
                                    var newContId = parseInt(data);
                                    if(isNaN(newContId))
                                    {
                                        alertUserPubMax();
                                    }


                                    $.ajax({
                                //document.location.hostname+
                                        url: '../../bll/ajaxhandlers/loadDashboardContentEditAndNavEdit.php',
                                        data: {
                                        entity_ID: containerEntityID,
                                        user_ID: userID
                                        },
                                        timeout: 0,
                                        dataType : 'html',
                                        error: function(jqXHR, textStatus, errorThrown) {
                                            $('ul#navigation > li > a.current').click();
                                        },
                                        success: function(data){

                                        //alert($(data).filter("#ajaxRenderNav").html());
                                        $('#main').html($(data).filter("#ajaxRenderContent").html());
                                        $('#navdiv').html($(data).filter("#ajaxRenderNav").html());



                                        $(data).filter('script').each(function(){
                                            $.globalEval(this.text || this.textContent || this.innerHTML || '');
                                        });

                                        navEdit = undefined;
                                        contentEdit = undefined;


                                        }

                                    });



                                }
                            });

                            $(this).dialog('close');

                        }
                        else
                        {
                            alert('Please wait until tags are loaded to publish your Page.');
                        }


                    }
                },
                {
                    text: 'Cancel',
                    click: function(){
                        $(this).dialog('close');

                    }
                }]
        });




    // });









            /////////

            //////////////
            //initializeBodyDialogJS();



            $('#customCorridorUserDialogBox').dialog(
                    {
                        autoOpen: false,
                        draggable:false,
                        modal:true,
                            width: 'auto',
		            height: 'auto',


                        beforeClose: function(event, ui){

					$('#widgetContentTypeTBCUG').empty();

                        },
                        //title: "Edit Tab - " + $('#dashboardTitleTB').val(),
                        buttons: [{
                                text: "OK",
                                click: function(){


                                    var type = $('#widgetContentTypeTBCU').val();
                                    var title = $('#widgetTitleTBCU').val();
                                    var widgetID = $('#widgetIdCU').val();
                                    var priority = $('#widgetPriorityCU').val();
                                    var key1 = 'content_type';
						var key2 = 'groupID';
                                    var containerEntityID = $('ul#navigation > li > a.current').attr('id');
                                    var containerID = $('ul#navigation > li > a.current').attr('id');

						var groupID = $('#widgetContentTypeTBCUG').val();



                                    if(typeof containerEntityID  == "undefined")
                                    {
                                        containerEntityID = null
                                    }
                                    else
                                    {
                                        var idArr = containerEntityID.split('-');
                                        containerEntityID = idArr[idArr.length - 1];
                                    }
                                    if(typeof containerID  == "undefined")
                                    {
                                        containerID = null
                                    }
                                    else
                                    {
                                        var idArr = containerID.split('-');
                                        containerID = idArr[idArr.length - 2];
                                    }
                                    var viewType = "JSCORS_Default";

                                    $('#main').html('<div style="height:600px"><img src="/public/images/loading.gif" style="position:absolute; top:40%; left:42%;" /></div>');

                                    if(typeof widgetID != "undefined" && widgetID != "")
                                    {
                                        $.ajax({
                                            url: '../../bll/ajaxhandlers/removeDashboardWidget.php',
                                            data: {
                                                    container_ID: containerID,
                                                    entity_ID: widgetID,
                                                    user_ID: '<?php echo $user_ID;?>',
                                                    accessgroup_ID: '<?php echo $accessgroup_id;?>'
                                            },
                                            success: function(data4){
                                                $.ajax({
                                                        url: '../../bll/ajaxhandlers/phpserialize.php',
                                                        data: {
                                                                paramString: type  + '$$$$$' + groupID,
                                                                paramKeyString: key1  + '$$$$$' + key2
                                                            },
                                                    success: function(data){

                                                    var paramString = data;


                                                                $.ajax({
                                                                    url: '../../bll/ajaxhandlers/addDashboardWidget.php',
                                                                    data: {
                                                                            container_ID: containerID,
                                                                            widgetType: 'TC_CorridorUserSource',
                                                                            title: title,
                                                                            description: '',
                                                                            params: paramString,
                                                                            priority: priority,
                                                                            viewType: viewType,
                                                                            user_ID: '<?php echo $user_ID;?>',
                                                                            accessgroup_ID: '<?php echo $accessgroup_id;?>'
                                                                        },
                                                                    success: function(data2){
                                                                        if(typeof contentEdit != "undefined")
                                                                    {
                                                                    //contentEdit.abort();
                                                                    }
                                                                        contentEdit = $.ajax({
                                                                            url: '../../bll/ajaxhandlers/loadDashboardContentEdit.php',
                                                                            data: {
                                                                            user_ID: '<?php echo $user_ID;?>',
                                                                            entity_ID: containerEntityID

                                                                            //params: id
                                                                                },timeout: 0,dataType : 'text', error: function(jqXHR, textStatus, errorThrown) {
                $('ul#navigation > li > a.current').click();
            },
                                                                            success: function(data3){
                                                                                //$('#main *').unbind();
                                                                                //$('#main *').die();
                                                                                //$('#main').empty();
                                                                                $('#main').html(data3);
                                                                                contentEdit = undefined;
                                                                                //initializeJS();
                                                                            }
                                                                        });

                                                                    }


                                                                }) ;






                                                    }
                                                });
                                            }
                                        });
                                    }
                                    else
                                    {

                                        $.ajax({
                                            url: '../../bll/ajaxhandlers/phpserialize.php',
                                            data: {
                                                                paramString: type  + '$$$$$' + groupID,
                                                                paramKeyString: key1  + '$$$$$' + key2
                                            },
                                            success: function(data){

                                                var paramString = data;


                                                $.ajax({
                                                    url: '../../bll/ajaxhandlers/addDashboardWidget.php',
                                                    data: {
                                                            container_ID: containerID,
                                                            widgetType: 'TC_CorridorUserSource',
                                                            title: title,
                                                            description: '',
                                                            params: paramString,
                                                            priority: priority,
                                                            viewType: viewType,
                                                            user_ID: '<?php echo $user_ID;?>',
                                                            accessgroup_ID: '<?php echo $accessgroup_id;?>'
                                                        },
                                                    success: function(data2){
                                                        if(typeof contentEdit != "undefined")
                                                            {
                                                              //contentEdit.abort();
                                                            }
                                                        contentEdit = $.ajax({
                                                            url: '../../bll/ajaxhandlers/loadDashboardContentEdit.php',
                                                            data: {
                                                            user_ID: '<?php echo $user_ID;?>',
                                                            entity_ID: containerEntityID

                                                            //params: id
                                                                },timeout: 0,dataType : 'text', error: function(jqXHR, textStatus, errorThrown) {
        $('ul#navigation > li > a.current').click();
    },
                                                            success: function(data3){
                                                                //$('#main *').unbind();
                                                                //$('#main *').die();
                                                                //$('#main').empty();
                                                                $('#main').html(data3);
                                                                contentEdit = undefined;
                                                                //initializeJS();
                                                            }
                                                        });





                                                    }


                                                }) ;
                                            }
                                        }) ;
                                    }



                                    $(this).dialog("close");
                                }
                        },
                        {
                            text: "Cancel",
                            click: function(){$(this).dialog("close");}
                        }]
                    }
            );








            $('#customDirectFeedDialogBox').dialog(
                    {
                        autoOpen: false,
                        draggable:false,
                        modal:true,
                        //title: "Edit Tab - " + $('#dashboardTitleTB').val(),
                        buttons: [{
                                text: "OK",
                                click: function(){

                                    var url = $('#widgetURLTBDF').val();
                                    var title = $('#widgetTitleTBDF').val();
                                    var widgetID = $('#widgetIdDF').val();
                                    var priority = $('#widgetPriorityDF').val();
                                    var urlKey = 'link';
                                    var containerEntityID = $('ul#navigation > li > a.current').attr('id');
                                    var containerID = $('ul#navigation > li > a.current').attr('id');

                                    if(typeof containerEntityID  == "undefined")
                                    {
                                        containerEntityID = null
                                    }
                                    else
                                    {
                                        var idArr = containerEntityID.split('-');
                                        containerEntityID = idArr[idArr.length - 1];
                                    }
                                    if(typeof containerID  == "undefined")
                                    {
                                        containerID = null
                                    }
                                    else
                                    {
                                        var idArr = containerID.split('-');
                                        containerID = idArr[idArr.length - 2];
                                    }

                                    var viewType = '';
                                    var urlPattern = /^http(s?):\/\/(.*?[^www])\.state\.(gov|sbu)(\/.*)?$/i;
                                    var casPattern = /^http(s?):\/\/cas\.state\.gov(\/.*)?$/i;
                                    var wpPattern =  /^http(s?):\/\/wordpress\.state\.gov(\/.*)?$/i;
                                    var usaidPattern =  /^http(s?):\/\/(.*?[^www])\.usaid.gov(\/.*)?$/i;
                                    if(urlPattern.test(url))
                                        {
                                            if(casPattern.test(url) || wpPattern.test(url))
                                                {
                                                    viewType = 'JSServerDiverted_CAS';
                                                }
                                            else
                                                {
                                                    viewType = 'JSServerDiverted_Default';
                                                }

                                        }
                                    else if(usaidPattern.test(url))
                                    {
                                        viewType = 'JSServerDiverted_Default';
                                    }
                                    else
                                        {

                                            viewType = 'JSGoogleRSS_Default';
                                        }
                                    $('#main').html('<div style="height:600px"><img src="/public/images/loading.gif" style="position:absolute; top:40%; left:42%;" /></div>');

                                    if(typeof widgetID != "undefined" && widgetID != "")
                                    {

                                        $.ajax({
                                            url: '../../bll/ajaxhandlers/removeDashboardWidget.php',
                                            data: {
                                                    container_ID: containerID,
                                                    entity_ID: widgetID,
                                                    user_ID: '<?php echo $user_ID;?>',
                                                    accessgroup_ID: '<?php echo $accessgroup_id;?>'
                                            },
                                            success: function(data4){
                                                $.ajax({
                                                    url: '../../bll/ajaxhandlers/phpserialize.php',
                                                    data: {
                                                            paramString: url,
                                                            paramKeyString: urlKey
                                                        },
                                                    success: function(data){

                                                        var paramString = data;


                                                        $.ajax({
                                                            url: '../../bll/ajaxhandlers/addDashboardWidget.php',
                                                            data: {
                                                                    container_ID: containerID,
                                                                    widgetType: 'TC_GenericRSSSource',
                                                                    title: title,
                                                                    description: '',
                                                                    params: paramString,
                                                                    priority: priority,
                                                                    viewType: viewType,
                                                                    user_ID: '<?php echo $user_ID;?>',
                                                                    accessgroup_ID: '<?php echo $accessgroup_id;?>'
                                                                },
                                                            success: function(data2){
                                                                if(typeof contentEdit != "undefined")
                                                            {
                                                              //contentEdit.abort();
                                                            }
                                                                 contentEdit = $.ajax({
                                                                    url: '../../bll/ajaxhandlers/loadDashboardContentEdit.php',
                                                                    data: {
                                                                    user_ID: '<?php echo $user_ID;?>',
                                                                    entity_ID: containerEntityID

                                                                    //params: id
                                                                        },timeout: 0,dataType : 'text', error: function(jqXHR, textStatus, errorThrown) {
        $('ul#navigation > li > a.current').click();
    },
                                                                    success: function(data3){
                                                                        //$('#main *').unbind();
                                                                        //$('#main *').die();
                                                                        //$('#main').empty();
                                                                        $('#main').html(data3);
                                                                        //initializeJS();

                                                                        contentEdit = undefined;
                                                                    }
                                                                });


                                                            }


                                                        }) ;


                                                    }


                                                }) ;
                                            }
                                        });

                                    }
                                    else
                                    {

                                        $.ajax({
                                            url: '../../bll/ajaxhandlers/phpserialize.php',
                                            data: {
                                                    paramString: url,
                                                    paramKeyString: urlKey
                                                },
                                            success: function(data){

                                                var paramString = data;
                                                /*
                                                var id = $('ul#navigation > li > a.current').attr('id');

                                                //var id = $(this).attr('id');

                                                if(typeof id  == "undefined")
                                                {
                                                    id = null
                                                }
                                                else
                                                {
                                                    var idArr = id.split('-');
                                                    id = idArr[idArr.length - 1];
                                                }
                                                */

                                                $.ajax({
                                                    url: '../../bll/ajaxhandlers/addDashboardWidget.php',
                                                    data: {
                                                            container_ID: containerID,
                                                            widgetType: 'TC_GenericRSSSource',
                                                            title: title,
                                                            description: '',
                                                            params: paramString,
                                                            priority: priority,
                                                            viewType: viewType,
                                                            user_ID: '<?php echo $user_ID;?>',
                                                            accessgroup_ID: '<?php echo $accessgroup_id;?>'
                                                        },
                                                    success: function(data2){
                                                        if(typeof contentEdit != "undefined")
                                                            {
                                                              //contentEdit.abort();
                                                            }
                                                         contentEdit = $.ajax({
                                                            url: '../../bll/ajaxhandlers/loadDashboardContentEdit.php',
                                                            data: {
                                                            user_ID: '<?php echo $user_ID;?>',
                                                            entity_ID: containerEntityID

                                                            //params: id
                                                                },timeout: 0,dataType : 'text', error: function(jqXHR, textStatus, errorThrown) {
        $('ul#navigation > li > a.current').click();
    },
                                                            success: function(data3){
                                                                //$('#main *').unbind();
                                                                //$('#main *').die();
                                                                //$('#main').empty();
                                                                $('#main').html(data3);

                                                                contentEdit = undefined;
                                                                //initializeJS();
                                                            }
                                                        });


                                                    }


                                                }) ;


                                            }


                                        }) ;

                                    }






                                    $(this).dialog("close");
                                }
                        },
                        {
                            text: "Cancel",
                            click: function(){$(this).dialog("close");}
                        }]
                    }
            );

            //$('#customGoogleSearchDialogBox').dialog("destroy");
            //$('#customGoogleSearchDialogBox').unbind();
            $('#customGoogleSearchDialogBox').dialog(
                    {
                        autoOpen: false,
                        draggable:false,
                        modal:true,
                        //title: "Edit Tab - " + $('#dashboardTitleTB').val(),
                        buttons: [{
                                text: "OK",
                                click: function(){

                                    var domain = $('#widgetDomainTBGS').val();
                                    var term = $('#widgetSearchTermTBGS').val();
                                    var title = $('#widgetTitleTBGS').val();
                                    var widgetID = $('#widgetIdGS').val();
                                    var priority = $('#widgetPriorityGS').val();
                                    var domainKey = 'domain';
                                    var termKey = 'search_term';
                                    var regex= /^(([\w]+:)?\/\/)?(([\d\w]|%[a-fA-f\d]{2,2})+(:([\d\w]|%[a-fA-f\d]{2,2})+)?@)?([\d\w][-\d\w]{0,253}[\d\w]\.)+[\w]{2,4}(:[\d]+)?(\/([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)*(\?(&amp;?([-+_~.\d\w]|%[a-fA-f\d]{2,2})=?)*)?(#([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)?$/;
                                    var regex2=/'/;

                                    var containerEntityID = $('ul#navigation > li > a.current').attr('id');
                                    var containerID = $('ul#navigation > li > a.current').attr('id');

                                    if(typeof containerEntityID  == "undefined")
                                    {
                                        containerEntityID = null
                                    }
                                    else
                                    {
                                        var idArr = containerEntityID.split('-');
                                        containerEntityID = idArr[idArr.length - 1];
                                    }
                                    if(typeof containerID  == "undefined")
                                    {
                                        containerID = null
                                    }
                                    else
                                    {
                                        var idArr = containerID.split('-');
                                        containerID = idArr[idArr.length - 2];
                                    }

                                    if(!regex.test(domain))
                                        {
                                            alert('Website domain is not formatted correctly.')
                                            return false;
                                        }
                                    if(regex2.test(term))
                                        {
                                            alert('Website search term is invalid.')
                                            return false;
                                        }
                                    $('#main').html('<div style="height:600px"><img src="/public/images/loading.gif" style="position:absolute; top:40%; left:42%;" /></div>');

                                    if(typeof widgetID != "undefined" && widgetID != "")
                                    {

                                        $.ajax({
                                            url: '../../bll/ajaxhandlers/removeDashboardWidget.php',
                                            data: {
                                                    container_ID: containerID,
                                                    entity_ID: widgetID,
                                                    user_ID: '<?php echo $user_ID;?>',
                                                    accessgroup_ID: '<?php echo $accessgroup_id;?>'
                                            },
                                            success: function(data4){
                                                $.ajax({
                                                    url: '../../bll/ajaxhandlers/phpserialize.php',
                                                    data: {
                                                            paramString: domain + '$$$$$' + term,
                                                            paramKeyString: domainKey + '$$$$$' + termKey
                                                        },
                                                    success: function(data){

                                                        var paramString = data;



                                                        $.ajax({
                                                            url: '../../bll/ajaxhandlers/addDashboardWidget.php',
                                                            data: {
                                                                    container_ID: containerID,
                                                                    widgetType: 'TC_GoogleRSSSource',
                                                                    title: title,
                                                                    description: '',
                                                                    params: paramString,
                                                                    priority: priority,
                                                                    viewType: 'JSGoogleSearch_Default',
                                                                    user_ID: '<?php echo $user_ID;?>',
                                                                    accessgroup_ID: '<?php echo $accessgroup_id;?>'
                                                                },
                                                            success: function(data2){
                                                                if(typeof contentEdit != "undefined")
                                                            {
                                                              //contentEdit.abort();
                                                            }
                                                                 contentEdit = $.ajax({
                                                                    url: '../../bll/ajaxhandlers/loadDashboardContentEdit.php',
                                                                    data: {
                                                                    user_ID: '<?php echo $user_ID;?>',
                                                                    entity_ID: containerEntityID

                                                                    //params: id
                                                                        },timeout: 0,dataType : 'text', error: function(jqXHR, textStatus, errorThrown) {
        $('ul#navigation > li > a.current').click();
    },
                                                                    success: function(data3){
                                                                        //$('#main *').unbind();
                                                                        //$('#main *').die();
                                                                        //$('#main').empty();
                                                                        $('#main').html(data3);
                                                                        //initializeJS();

                                                                        contentEdit = undefined;
                                                                    }
                                                                });


                                                            }


                                                        }) ;


                                                    }


                                                }) ;
                                            }
                                        });

                                    }
                                    else
                                    {

                                        $.ajax({
                                            url: '../../bll/ajaxhandlers/phpserialize.php',
                                            data: {
                                                    paramString: domain + '$$$$$' + term,
                                                    paramKeyString: domainKey + '$$$$$' + termKey
                                                },
                                            success: function(data){

                                                var paramString = data;


                                                $.ajax({
                                                    url: '../../bll/ajaxhandlers/addDashboardWidget.php',
                                                    data: {
                                                            container_ID: containerID,
                                                            widgetType: 'TC_GoogleRSSSource',
                                                            title: title,
                                                            description: '',
                                                            params: paramString,
                                                            priority: priority,
                                                            viewType: 'JSGoogleSearch_Default',
                                                            user_ID: '<?php echo $user_ID;?>',
                                                            accessgroup_ID: '<?php echo $accessgroup_id;?>'
                                                        },
                                                    success: function(data2){
                                                        if(typeof contentEdit != "undefined")
                                                            {
                                                              //contentEdit.abort();
                                                            }
                                                         contentEdit = $.ajax({
                                                            url: '../../bll/ajaxhandlers/loadDashboardContentEdit.php',
                                                            data: {
                                                            user_ID: '<?php echo $user_ID;?>',
                                                            entity_ID: containerEntityID

                                                            //params: id
                                                                },timeout: 0,dataType : 'text', error: function(jqXHR, textStatus, errorThrown) {
        $('ul#navigation > li > a.current').click();
    },
                                                            success: function(data3){
                                                                //$('#main *').unbind();
                                                                //$('#main *').die();
                                                                //$('#main').empty();
                                                                $('#main').html(data3);
                                                                //initializeJS();
                                                                contentEdit = undefined;
                                                            }
                                                        });


                                                    }


                                                }) ;


                                            }


                                        }) ;

                                    }






                                    $(this).dialog("close");
                                }
                        },
                        {
                            text: "Cancel",
                            click: function(){$(this).dialog("close");}
                        }]
                    }
            );








            $('#customGoogleNewsSearchDialogBox').dialog(
                    {
                        autoOpen: false,
                        draggable:false,
                        modal:true,
                        //title: "Edit Tab - " + $('#dashboardTitleTB').val(),
                        buttons: [{
                                text: "OK",
                                click: function(){


                                    var term = $('#widgetSearchTermTBGN').val();
                                    var title = $('#widgetTitleTBGN').val();
                                    var widgetID = $('#widgetIdGN').val();
                                    var priority = $('#widgetPriorityGN').val();

                                    var domain = "news";
                                    var termKey = 'search_term';
                                    var domainKey = "domain";

                                    var regex2= /'/;

                                    var containerEntityID = $('ul#navigation > li > a.current').attr('id');
                                    var containerID = $('ul#navigation > li > a.current').attr('id');

                                    if(typeof containerEntityID  == "undefined")
                                    {
                                        containerEntityID = null
                                    }
                                    else
                                    {
                                        var idArr = containerEntityID.split('-');
                                        containerEntityID = idArr[idArr.length - 1];
                                    }
                                    if(typeof containerID  == "undefined")
                                    {
                                        containerID = null
                                    }
                                    else
                                    {
                                        var idArr = containerID.split('-');
                                        containerID = idArr[idArr.length - 2];
                                    }
                                    if(regex2.test(term))
                                        {
                                            alert('Website search term is invalid.')
                                            return false;
                                        }



                                    $('#main').html('<div style="height:600px"><img src="/public/images/loading.gif" style="position:absolute; top:40%; left:42%;" /></div>');

                                    if(typeof widgetID != "undefined" && widgetID != "")
                                    {
                                        $.ajax({
                                            url: '../../bll/ajaxhandlers/removeDashboardWidget.php',
                                            data: {
                                                    container_ID: containerID,
                                                    entity_ID: widgetID,
                                                    user_ID: '<?php echo $user_ID;?>',
                                                    accessgroup_ID: '<?php echo $accessgroup_id;?>'
                                            },
                                            success: function(data4){
                                                $.ajax({
                                                    url: '../../bll/ajaxhandlers/phpserialize.php',
                                                    data: {
                                                            //paramString: term,
                                                            //paramKeyString: termKey


                                                            paramString: domain + '$$$$$' + term,
                                                            paramKeyString: domainKey + '$$$$$' + termKey
                                                        },
                                                    success: function(data){

                                                        var paramString = data;



                                                        $.ajax({
                                                            url: '../../bll/ajaxhandlers/addDashboardWidget.php',
                                                            data: {
                                                                    container_ID: containerID,
                                                                    widgetType: 'TC_GoogleRSSSource',
                                                                    title: title,
                                                                    description: '',
                                                                    params: paramString,
                                                                    priority: priority,
                                                                    viewType: 'JSGoogleNews_Default',
                                                                    user_ID: '<?php echo $user_ID;?>',
                                                                    accessgroup_ID: '<?php echo $accessgroup_id;?>'
                                                                },
                                                            success: function(data2){
                                                                if(typeof contentEdit != "undefined")
                                                            {
                                                              //contentEdit.abort();
                                                            }
                                                                 contentEdit = $.ajax({
                                                                    url: '../../bll/ajaxhandlers/loadDashboardContentEdit.php',
                                                                    data: {
                                                                    user_ID: '<?php echo $user_ID;?>',
                                                                    entity_ID: containerEntityID

                                                                    //params: id
                                                                        },timeout: 0,dataType : 'text', error: function(jqXHR, textStatus, errorThrown) {
        $('ul#navigation > li > a.current').click();
    },
                                                                    success: function(data3){
                                                                        //$('#main *').unbind();
                                                                        //$('#main *').die();
                                                                        //$('#main').empty();
                                                                        $('#main').html(data3);
                                                                        //initializeJS();
                                                                        contentEdit = undefined;
                                                                    }
                                                                });


                                                            }


                                                        }) ;


                                                    }


                                                }) ;
                                            }
                                        });
                                    }
                                    else
                                    {
                                        $.ajax({
                                            url: '../../bll/ajaxhandlers/phpserialize.php',
                                            data: {
                                                    //paramString: term,
                                                    //paramKeyString: termKey
                                                     paramString: domain + '$$$$$' + term,
                                                            paramKeyString: domainKey + '$$$$$' + termKey
                                                },
                                            success: function(data){

                                                var paramString = data;



                                                $.ajax({
                                                    url: '../../bll/ajaxhandlers/addDashboardWidget.php',
                                                    data: {
                                                            container_ID: containerID,
                                                            widgetType: 'TC_GoogleRSSSource',
                                                            title: title,
                                                            description: '',
                                                            params: paramString,
                                                            priority: priority,
                                                            viewType: 'JSGoogleNews_Default',
                                                            user_ID: '<?php echo $user_ID;?>',
                                                            accessgroup_ID: '<?php echo $accessgroup_id;?>'
                                                        },
                                                    success: function(data2){
                                                        if(typeof contentEdit != "undefined")
                                                            {
                                                              //contentEdit.abort();
                                                            }
                                                         contentEdit = $.ajax({
                                                            url: '../../bll/ajaxhandlers/loadDashboardContentEdit.php',
                                                            data: {
                                                            user_ID: '<?php echo $user_ID;?>',
                                                            entity_ID: containerEntityID

                                                            //params: id
                                                                },timeout: 0,dataType : 'text', error: function(jqXHR, textStatus, errorThrown) {
        $('ul#navigation > li > a.current').click();
    },
                                                            success: function(data3){
                                                                //$('#main *').unbind();
                                                                //$('#main *').die();
                                                                //$('#main').empty();
                                                                $('#main').html(data3);
                                                                contentEdit = undefined;
                                                                //initializeJS();
                                                            }
                                                        });


                                                    }


                                                }) ;


                                            }


                                        }) ;
                                    }






                                    $(this).dialog("close");
                                }
                        },
                        {
                            text: "Cancel",
                            click: function(){$(this).dialog("close");}
                        }]
                    }
            );





            $('#fullArticleContentDialogBox').dialog(
                    {
                        autoOpen: false,
                        draggable:false,
                        modal:true,
                        width:700,
                        open: function(event, ui){
                                        if ($(this).parent().height() > $(window).height()) {
        					$(this).height($(window).height()*0.7);
    					}
    					$(this).dialog({position: "center"});

                                        /*
                                        $('<a />', {
                                            'class': 'linkClass',
                                            text: 'Read Full Article',
                                            href: '#'
                                        })
                                        .appendTo($(".ui-dialog-buttonpane"))
                                        .click(function(){

                                            //$('#fullArticleContentDialogBox').html($(this).closest('.rssRow').find('.feedContent').find('.feedFullContent').html());
                                            var linkUrl = $(this).closest('.rssRow').find('.feedContent').find('.feedContentMeta').find('a').attr('href');
                                            alert(linkUrl);
                                            //$('#fullArticleContentDialogBox').dialog("option","title",$(this).closest('.rssRow').find('.feedContent').prev('a').find('span').html());
                                            //window.open(linkUrl);






                                            //$(event.target).dialog('close');
                                        });

                                        */
                        },
                        beforeClose: function(event, ui){

                            $('body').css('overflow','scroll');
                            $('.ReadFullArticleButtonContainer').remove();


                        },
                        //title: "Edit Tab - " + $('#dashboardTitleTB').val(),
                        buttons: [

                        {
                            text: "Close",
                            click: function(){$(this).dialog("close");}
                        }

                        ]
                    }
            );


            $('#emailColleaguesDialogBox').dialog(
                    {
                        autoOpen: false,
                        draggable:false,
                        modal:true,
                        title: 'Invite Colleagues',
                        width:500,

                        buttons: [
                        {
                            text: "Send",
                            click: function(){

                                var user_name = $.trim($('#inviteNameTB').val());
                                var user_email = $.trim($('#inviteEmailTB').val());
                                var emailList = $.trim($('#colleagueEmailSubmissionTB').val());
                                //alert(user_name);
                                //alert(user_email);
                                //alert(emailList)

                                $.ajax({
                                    url: '../../bll/ajaxhandlers/sendBlastInvites.php',
                                    data: {
                                    user_ID: '<?php echo $user_ID;?>',
                                    user_name: user_name,
                                    user_email: user_email,
                                    emailList: emailList

                                        },
                                    success: function(data3){
                                        //$('#main *').unbind();
                                        //$('#main *').die();
                                        //$('#main').empty();
                                        //$('#main').html(data3);
                                        //contentEdit = undefined;
                                        //initializeJS();
                                    }
                                });

                                //emailList
                                $(this).dialog("close");
                            }
                        },
                        {
                            text: "Cancel",
                            click: function(){$(this).dialog("close");}
                        }

                        ]
                    }
            );
            /*
            $('#discussionDialogBox').dialog(
                    {
                        autoOpen: false,
                        draggable:false,
                        modal:true,
                        width:700,
                        //title: "Edit Tab - " + $('#dashboardTitleTB').val(),
                        buttons: [
                        {
                            text: "Close",
                            click: function(){$(this).dialog("close");}
                        }]
                    }
            );
            */
            $('#joinCorridorTooltipDialogBox').dialog(
                    {
                        autoOpen: false,
                        draggable:false,
                        modal:true,
                        width:300,
                        title: 'Customization available to Corridor members',
                        buttons: [
                        {
                            text: "Close",
                            click: function(){$(this).dialog("close");}
                        }]
                    }
            );




            $('#IEIssuesTooltipDialogBox').dialog(
                    {
                        autoOpen: false,
                        draggable:false,
                        modal:true,
                        width:400,
                        title: 'You are using Internet Explorer',
                        buttons: [
                        {
                            text: "Accept",
                            click: function(){$(this).dialog("close");}
                        }]
                    }
            );

            $('#shareTabDialogBox').dialog(
                    {
                        autoOpen: false,
                        draggable:false,
                        modal:true,
                        width:420,
                        title: 'Share Current Page',
                        buttons: [
                        /*{
                            text: "Publish",
                            click: function(){

                            }
                        },*/
                        {
                            id: "shareOnEmailButton",
                            text: "Email Page",
                            click: function(){

                                if($('#sharedPageComplete').val() == 1)
                                {
                                    var link = $(this).find('.embedLink').val();
                                    var subject = $('ul#navigation > li > a.current').html();
                                    //var body = "A user has created a Page for you! Click the link below to add the "+subject+" Page to your personal Pages within The Current.%0D%0A%0D%0A";


                                    var body = "A colleague would like to share a page he or she created on The Current.  By clicking on the link below, the page will be added to your index of pages on your version of The Current.  Please note that only members of Corridor can share and add shared pages at this time.  Visit Corridor at http://corridor.state.gov. %0D%0A%0D%0A";
                                    body += subject+" - "+link+"%0D%0A%0D%0A";
                                    body += "To access The Current after you've added the page, visit <?php echo SITE_DOMAIN;?>.";

                                    link = "mailto:?subject="+subject+" - Page shared from The Current&body="+body;
                                    //alert(link);
                                    //window.open(link);
                                    window.location.href = link;


                                    $(this).dialog("close");
                                    $('#sharedPageComplete').val('0');
                                }
                                else
                                {
                                    alert('Please wait until your link is created.');
                                }
                            }
                        },
                        {
                            id: "shareOnCorridorButton",
                            text: "Share on Corridor",
                            click: function(){
                                if($('#sharedPageComplete').val() == 1)
                                {
                                var subject = $('ul#navigation > li > a.current').html();
                                var link = $(this).find('.embedLink').val();
                                link = generateCorridorShareGeneral(link, subject, "The Current");

                                window.open(link);
                                $(this).dialog("close");
                                $('#sharedPageComplete').val('0');
                                }
                                else
                                {
                                    alert('Please wait until your link is created.');
                                }
                            }
                        },
                        {
                            text: "Close",
                            click: function(){$(this).dialog("close");$('#sharedPageComplete').val('0');}
                        }
                        ]
                    }
            );
            $('#instructionalVideoDialogBox').dialog(
                    {
                        autoOpen: false,
                        draggable:false,
                        modal:true,
                        width:700,
                        height:610,
                        title: 'Help Center',
                        beforeClose: function(event, ui){

                            var i = 0;
                            while (true) {
                                var player = jwplayer(i);
                                if (!player)
                                    break;

                                player.stop();
                                i++;
                            }
                            //jwplayer().stop();
                            //$('.videoPlayer').each(function(){
                                //var currId = $(this).attr('id');
                                //jwplayer(currId).pause(true);
                               // jwplayer('addingRSSPlayer').stop();
                                //this.sendEvent('stop');
                            //});
                        },
                        open: function(event, ui){

                        },
                        buttons: [
                        /*{
                            text: "Publish",
                            click: function(){

                            }
                        },*/
                        {
                            text: "Close",
                            click: function(){

                                $(this).dialog("close");
                            }
                        }]
                    }
            );






            $('#customSMARTSearchDialogBox').dialog(
                    {
                        autoOpen: false,
                        draggable:false,
                        modal:true,
                        //title: "Edit Tab - " + $('#dashboardTitleTB').val(),
                        buttons: [{
                                text: "OK",
                                click: function(){




                                    var subject = $('#widgetSubjectTBSS').val().length > 0 ? parseSMARTSearchString($('#widgetSubjectTBSS').val(), 'SUBJECT') : '';
                                    var title = $('#widgetTitleTBSS').val();
                                    var tags = $('#widgetTAGSTBSS').val().length > 0 ? parseSMARTSearchString($('#widgetTAGSTBSS').val(),'TAGS') : '';
                                    var widgetID = $('#widgetIdSS').val();
                                    var priority = $('#widgetPrioritySS').val();
                                    var addressee = $('#widgetAddresseeTBSS').val().length > 0 ? parseSMARTSearchString($('#widgetAddresseeTBSS').val(),'ADDRESSEE') : '';
                                    var captions = $('#widgetCaptionsTBSS').val().length > 0 ? parseSMARTSearchString($('#widgetCaptionsTBSS').val(),'CAPTIONS') : '';
                                    var originator = $('#widgetOriginatorTBSS').val().length > 0 ? parseSMARTSearchString($('#widgetOriginatorTBSS').val(),'ORIGINATOR') : '';

                                    var term = subject + ' ' + tags + ' ' + addressee + ' ' + captions + ' ' + originator;

                                    var termKey = 'terms';
                                    var regex2= /'/;
                                    var containerEntityID = $('ul#navigation > li > a.current').attr('id');
                                    var containerID = $('ul#navigation > li > a.current').attr('id');

                                    if(typeof containerEntityID  == "undefined")
                                    {
                                        containerEntityID = null
                                    }
                                    else
                                    {
                                        var idArr = containerEntityID.split('-');
                                        containerEntityID = idArr[idArr.length - 1];
                                    }
                                    if(typeof containerID  == "undefined")
                                    {
                                        containerID = null
                                    }
                                    else
                                    {
                                        var idArr = containerID.split('-');
                                        containerID = idArr[idArr.length - 2];
                                    }
                                    var viewType = "JSCORS_Default";
                                    if(regex2.test(term))
                                        {
                                            alert('Website search term is invalid.')
                                            return false;
                                        }
                                    $('#main').html('<div style="height:600px"><img src="/public/images/loading.gif" style="position:absolute; top:40%; left:42%;" /></div>');

                                    if(typeof widgetID != "undefined" && widgetID != "")
                                    {
                                        $.ajax({
                                            url: '../../bll/ajaxhandlers/removeDashboardWidget.php',
                                            data: {
                                                    container_ID: containerID,
                                                    entity_ID: widgetID,
                                                    user_ID: '<?php echo $user_ID;?>',
                                                    accessgroup_ID: '<?php echo $accessgroup_id;?>'
                                            },
                                            success: function(data4){
                                                $.ajax({
                                                    url: '../../bll/ajaxhandlers/phpserialize.php',
                                                    data: {
                                                            paramString: term,
                                                            paramKeyString: termKey
                                                        },
                                                    success: function(data){

                                                        var paramString = data;



                                                        $.ajax({
                                                            url: '../../bll/ajaxhandlers/addDashboardWidget.php',
                                                            data: {
                                                                    container_ID: containerID,
                                                                    widgetType: 'TC_SMARTSource',
                                                                    title: title,
                                                                    description: '',
                                                                    params: paramString,
                                                                    priority: priority,
                                                                    viewType: viewType,
                                                                    user_ID: '<?php echo $user_ID;?>',
                                                                    accessgroup_ID: '<?php echo $accessgroup_id;?>'
                                                                },
                                                            success: function(data2){
                                                                if(typeof contentEdit != "undefined")
                                                            {
                                                              //contentEdit.abort();
                                                            }
                                                                 contentEdit = $.ajax({
                                                                    url: '../../bll/ajaxhandlers/loadDashboardContentEdit.php',
                                                                    data: {
                                                                    user_ID: '<?php echo $user_ID;?>',
                                                                    entity_ID: containerEntityID

                                                                    //params: id
                                                                        },timeout: 0,dataType : 'text', error: function(jqXHR, textStatus, errorThrown) {
        $('ul#navigation > li > a.current').click();
    },
                                                                    success: function(data3){
                                                                        //$('#main *').unbind();
                                                                        //$('#main *').die();
                                                                        //$('#main').empty();
                                                                        $('#main').html(data3);
                                                                        contentEdit = undefined;
                                                                        //initializeJS();
                                                                    }
                                                                });


                                                            }


                                                        }) ;


                                                    }


                                                }) ;
                                            }
                                        });
                                    }
                                    else
                                    {
                                        $.ajax({
                                            url: '../../bll/ajaxhandlers/phpserialize.php',
                                            data: {
                                                    paramString: term,
                                                    paramKeyString: termKey
                                                },
                                            success: function(data){

                                                var paramString = data;



                                                $.ajax({
                                                    url: '../../bll/ajaxhandlers/addDashboardWidget.php',
                                                    data: {
                                                            container_ID: containerID,
                                                            widgetType: 'TC_SMARTSource',
                                                            title: title,
                                                            description: '',
                                                            params: paramString,
                                                            priority: priority,
                                                            viewType: viewType,
                                                            user_ID: '<?php echo $user_ID;?>',
                                                            accessgroup_ID: '<?php echo $accessgroup_id;?>'
                                                        },
                                                    success: function(data2){
                                                        if(typeof contentEdit != "undefined")
                                                            {
                                                              //contentEdit.abort();
                                                            }
                                                         contentEdit = $.ajax({
                                                            url: '../../bll/ajaxhandlers/loadDashboardContentEdit.php',
                                                            data: {
                                                            user_ID: '<?php echo $user_ID;?>',
                                                            entity_ID: containerEntityID

                                                            //params: id
                                                                },timeout: 0,dataType : 'text', error: function(jqXHR, textStatus, errorThrown) {
        $('ul#navigation > li > a.current').click();
    },
                                                            success: function(data3){
                                                                //$('#main *').unbind();
                                                                //$('#main *').die();
                                                                //$('#main').empty();
                                                                $('#main').html(data3);
                                                                contentEdit = undefined;
                                                                //initializeJS();
                                                            }
                                                        });


                                                    }


                                                }) ;


                                            }


                                        }) ;
                                    }



                                    $(this).dialog("close");
                                }
                        },
                        {
                            text: "Cancel",
                            click: function(){$(this).dialog("close");}
                        }]
                    }
            );



















            $('#customYoutubeSearchDialogBox').dialog(
                    {
                        autoOpen: false,
                        draggable:false,
                        modal:true,
                        //title: "Edit Tab - " + $('#dashboardTitleTB').val(),
                        buttons: [{
                                text: "OK",
                                click: function(){


                                    var term = $('#widgetSearchTermTBYS').val();
                                    var title = $('#widgetTitleTBYS').val();
                                    var widgetID = $('#widgetIdYS').val();
                                    var priority = $('#widgetPriorityYS').val();

                                    var termKey = 'q';
                                    var regex2= /'/;
                                    var containerEntityID = $('ul#navigation > li > a.current').attr('id');
                                    var containerID = $('ul#navigation > li > a.current').attr('id');

                                    if(typeof containerEntityID  == "undefined")
                                    {
                                        containerEntityID = null
                                    }
                                    else
                                    {
                                        var idArr = containerEntityID.split('-');
                                        containerEntityID = idArr[idArr.length - 1];
                                    }
                                    if(typeof containerID  == "undefined")
                                    {
                                        containerID = null
                                    }
                                    else
                                    {
                                        var idArr = containerID.split('-');
                                        containerID = idArr[idArr.length - 2];
                                    }
                                    var viewType = "JSYoutubeSearch_Default";
                                    if(regex2.test(term))
                                        {
                                            alert('Website search term is invalid.')
                                            return false;
                                        }
                                    $('#main').html('<div style="height:600px"><img src="/public/images/loading.gif" style="position:absolute; top:40%; left:42%;" /></div>');

                                    if(typeof widgetID != "undefined" && widgetID != "")
                                    {
                                        $.ajax({
                                            url: '../../bll/ajaxhandlers/removeDashboardWidget.php',
                                            data: {
                                                    container_ID: containerID,
                                                    entity_ID: widgetID,
                                                    user_ID: '<?php echo $user_ID;?>',
                                                    accessgroup_ID: '<?php echo $accessgroup_id;?>'
                                            },
                                            success: function(data4){
                                                $.ajax({
                                                    url: '../../bll/ajaxhandlers/phpserialize.php',
                                                    data: {
                                                            paramString: term,
                                                            paramKeyString: termKey
                                                        },
                                                    success: function(data){

                                                        var paramString = data;



                                                        $.ajax({
                                                            url: '../../bll/ajaxhandlers/addDashboardWidget.php',
                                                            data: {
                                                                    container_ID: containerID,
                                                                    widgetType: 'TC_YoutubeMediaSearchSource',
                                                                    title: title,
                                                                    description: '',
                                                                    params: paramString,
                                                                    priority: priority,
                                                                    viewType: viewType,
                                                                    user_ID: '<?php echo $user_ID;?>',
                                                                    accessgroup_ID: '<?php echo $accessgroup_id;?>'
                                                                },
                                                            success: function(data2){
                                                                if(typeof contentEdit != "undefined")
                                                            {
                                                              //contentEdit.abort();
                                                            }
                                                                 contentEdit = $.ajax({
                                                                    url: '../../bll/ajaxhandlers/loadDashboardContentEdit.php',
                                                                    data: {
                                                                    user_ID: '<?php echo $user_ID;?>',
                                                                    entity_ID: containerEntityID

                                                                    //params: id
                                                                        },timeout: 0,dataType : 'text', error: function(jqXHR, textStatus, errorThrown) {
        $('ul#navigation > li > a.current').click();
    },
                                                                    success: function(data3){
                                                                        //$('#main *').unbind();
                                                                        //$('#main *').die();
                                                                        //$('#main').empty();
                                                                        $('#main').html(data3);
                                                                        contentEdit = undefined;
                                                                        //initializeJS();
                                                                    }
                                                                });


                                                            }


                                                        }) ;


                                                    }


                                                }) ;
                                            }
                                        });
                                    }
                                    else
                                    {
                                        $.ajax({
                                            url: '../../bll/ajaxhandlers/phpserialize.php',
                                            data: {
                                                    paramString: term,
                                                    paramKeyString: termKey
                                                },
                                            success: function(data){

                                                var paramString = data;



                                                $.ajax({
                                                    url: '../../bll/ajaxhandlers/addDashboardWidget.php',
                                                    data: {
                                                            container_ID: containerID,
                                                            widgetType: 'TC_YoutubeMediaSearchSource',
                                                            title: title,
                                                            description: '',
                                                            params: paramString,
                                                            priority: priority,
                                                            viewType: viewType,
                                                            user_ID: '<?php echo $user_ID;?>',
                                                            accessgroup_ID: '<?php echo $accessgroup_id;?>'
                                                        },
                                                    success: function(data2){
                                                        if(typeof contentEdit != "undefined")
                                                            {
                                                              //contentEdit.abort();
                                                            }
                                                         contentEdit = $.ajax({
                                                            url: '../../bll/ajaxhandlers/loadDashboardContentEdit.php',
                                                            data: {
                                                            user_ID: '<?php echo $user_ID;?>',
                                                            entity_ID: containerEntityID

                                                            //params: id
                                                                },timeout: 0,dataType : 'text', error: function(jqXHR, textStatus, errorThrown) {
        $('ul#navigation > li > a.current').click();
    },
                                                            success: function(data3){
                                                                //$('#main *').unbind();
                                                                //$('#main *').die();
                                                                //$('#main').empty();
                                                                $('#main').html(data3);
                                                                contentEdit = undefined;
                                                                //initializeJS();
                                                            }
                                                        });


                                                    }


                                                }) ;


                                            }


                                        }) ;
                                    }



                                    $(this).dialog("close");
                                }
                        },
                        {
                            text: "Cancel",
                            click: function(){$(this).dialog("close");}
                        }]
                    }
            );









            //////////////
            makeSortableNav();
            //timerRefresh();

            //startStopRefreshTimer(1);

            $('#publishTabButton').live("click", function(){
                // var containerEntityID = $('ul#navigation > li > a.current').attr('id');
                // var containerID = $('ul#navigation > li > a.current').attr('id');

                // if(typeof containerEntityID  == "undefined")
                // {
                //     containerEntityID = null
                // }
                // else
                // {
                //     var idArr = containerEntityID.split('-');
                //     containerEntityID = idArr[idArr.length - 1];
                // }
                // if(typeof containerID  == "undefined")
                // {
                //     containerID = null
                // }
                // else
                // {
                //     var idArr = containerID.split('-');
                //     containerID = idArr[idArr.length - 2];
                // }

                var containerEntityID = $(this).parent().find('.contentEditContainer').attr("id");
                containerEntityID = containerEntityID.split('-');
                containerEntityID = containerEntityID[containerEntityID.length - 1];
                var userID = '<?php echo $user_ID;?>';
                // $.ajax({
                //     url: '../../bll/ajaxhandlers/createshare.php',
                //     data: {
                //             entity_ID: containerEntityID,
                //             user_ID: userID
                //         },
                //     success: function(data2){

                //        shareUrl = $.trim(data2);
                //        $('#shareTabDialogBox').find(".embedLink").val(shareUrl);
                //        $('#sharedPageComplete').val('1');

                //     }


                // }) ;

                $("#publishTabDialogBox").dialog('open');





                // var containerEntityID = $(this).parent().find('.contentEditContainer').attr("id");
                // containerEntityID = containerEntityID.split('-');
                // containerEntityID = containerEntityID[containerEntityID.length - 1];
                // var userID = '<?php echo $user_ID;?>';
                // $.ajax({
                //     url: '../../bll/ajaxhandlers/publishDashboardTab.php',
                //     data: {
                //         user_ID: userID,
                //         entity_ID: containerEntityID
                //     },
                //     success: function(data){
                //         console.log(data);
                //     }
                // });

            });


            // $('.catalogTag').live('click', function(e){
            //     var tag_id = $(this).data("tagid");

            //     $.ajax({
            //         url: '../../bll/ajaxhandlers/loadCatalogPanel.php',
            //         data: {
            //                 tag_ids: new Array(tag_id)
            //             },
            //         success: function(data){
            //             $('#catalog-content').html(data);
            //         }
            //     });
            //     // $("#previewTabDialogBox").data('tag_id', tag_id);
            // });




            $('.addNewTab').live("click", function(){
                resetDialogInputValues();

                $('#dashboardTitleTB').val('');
                $('#dashboardIdIN').val('');
                $('#editDialogBox').dialog("option","title",'New Page');

                $('#editDialogBox').dialog("open");

            });
            $('.editTabButton').live("click", function(event){
                //initializeNavDialog();

                resetDialogInputValues();
                var id = $(this).attr('id');

                var idArr = id.split('-');

                id = idArr[idArr.length - 1];
                var title = $(this).parent().find('a').html();

                $('#dashboardTitleTB').val(title);
                $('#dashboardIdIN').val(id);

                $('#editDialogBox').dialog("option","title",title);

                $('#editDialogBox').dialog("open");
            });
            $('.editTabButton').live("keyup", function(event){

                if(event.keyCode == 13 || event.keyCode == 32){
                    $(this).click();
                    event.stopPropagation();
                }

                /*
                initializeNavDialog();
                resetDialogInputValues();
                var id = $(this).attr('id');

                var idArr = id.split('-');

                id = idArr[idArr.length - 1];
                var title = $(this).parent().find('a').html();

                $('#dashboardTitleTB').val(title);
                $('#dashboardIdIN').val(id);

                $('#editDialogBox').dialog("option","title",title);

                $('#editDialogBox').dialog("open");*/
            });
            //$('#searchSubmit').unbind();
            //$('#searchField').unbind();
            //$('#customizeLink').unbind();
            //$('#searchSubmit').die();
            //$('#searchField').die();
            //$('#customizeLink').die();

            $('#searchSubmit').click(function(){ $('#stateSearchForm').submit(); });
            $('#searchField').click(function(){ $('#searchField').val('') ;});



            $('.mediafeed').livequery(function(){

            //alert('node inserted');
            //if(this.html() == '')
                //{
                    //alert($(this).html());
                //}

            });

            $('.deleteWidgetButton').live("keyup", function(event){
                if(event.keyCode == 13 || event.keyCode == 32){
                    $(this).click();
                    event.stopPropagation();
                }
            });
            $('.deleteWidgetButton').live("click", function(){

                var widgetID = $(this).closest('.widget').find('.widgetID').val();// $(this).siblings('.editWidgetButton').find('.widgetID').val();
                var widgetPriority = $(this).closest('.widget').find('.widgetPriority').val();
                //var containerID = $(this).closest('.widget').find('.containerID').val();
                var containerEntityID = $('ul#navigation > li > a.current').attr('id');
                var containerID = $('ul#navigation > li > a.current').attr('id');

                if(typeof containerEntityID  == "undefined")
                {
                    containerEntityID = null
                }
                else
                {
                    var idArr = containerEntityID.split('-');
                    containerEntityID = idArr[idArr.length - 1];
                }
                if(typeof containerID  == "undefined")
                {
                    containerID = null
                }
                else
                {
                    var idArr = containerID.split('-');
                    containerID = idArr[idArr.length - 2];
                }
                if(!genericConfirm())
                        {return false;}
                $('#main').html('<div style="height:600px"><img src="/public/images/loading.gif" style="position:absolute; top:40%; left:42%;" /></div>');


                $.ajax({
                    url: '../../bll/ajaxhandlers/removeDashboardWidget.php',
                    data: {
                            container_ID: containerID,
                            entity_ID: widgetID,
                            user_ID: '<?php echo $user_ID;?>',
                            accessgroup_ID: '<?php echo $accessgroup_id;?>'

                        },
                    success: function(data){
                        if(typeof contentEdit != "undefined")
                        {
                          //contentEdit.abort();
                        }
                         contentEdit = $.ajax({
                            url: '../../bll/ajaxhandlers/loadDashboardContentEdit.php',
                            data: {
                            user_ID: '<?php echo $user_ID;?>',
                            entity_ID: containerEntityID

                            //params: id
                                },timeout: 0,dataType : 'text', error: function(jqXHR, textStatus, errorThrown) {
        $('ul#navigation > li > a.current').click();
    },
                            success: function(data2){
                                //$('#main *').unbind();
                                //$('#main *').die();
                                //$('#main').empty();
                                $('#main').html(data2);

                                contentEdit = undefined;
                                //initializeJS();
                            }
                        });


                    }


                }) ;

            });




            $('.iconEditWidgetButton').live("click", function(event){

                //var widgetID = $(this).closest('.widget').find('.widgetID').val();// $(this).siblings('.editWidgetButton').find('.widgetID').val();
                //var widgetPriority = $(this).closest('.widget').find('.widgetPriority').val();
                //var containerID = $(this).closest('.widget').find('.containerID').val();

                $(this).closest('.editWidgetButton').find('ul').show();
                // main overlay container
                createWidgetSelectionOverlay();

                //if (/MSIE (\d+\.\d+);/.test(navigator.userAgent))
                //{
                //var ieversion=new Number(RegExp.$1)
                //if (ieversion)
                //    {

                            //$(this).closest('.WidgetHeader').css('z-index','999');

                //    }

                //}

                event.stopPropagation();
            });
            $('.iconEditWidgetButton').live("keyup", function(event){

                if(event.keyCode == 13 || event.keyCode == 32){
                    $(this).click();
                    event.stopPropagation();
                }

            });


            $('.addWidget').live('click',function(){


                    $(this).next('.widgetSelect').show();
                    // main overlay container
                    //createWidgetSelectionOverlay();
                    event.stopPropagation();



            });



            $('.addWidget').live('keyup',function(){

                if(event.keyCode == 13 || event.keyCode == 32){
                    $(this).click();
                    event.stopPropagation();

                }


            });





            $('.defaultWidget').live("click", function(event){


                var paramString = unescape($(this).siblings('.widgetParamString').val());
                var widgetType = $(this).siblings('.widgetType').val();
                var widgetTitle = $(this).siblings('.widgetTitle').val();
                var widgetViewType = $(this).siblings('.widgetViewType').val();

                var widgetID = $(this).closest('.widget').find('.widgetID').val();// $(this).siblings('.editWidgetButton').find('.widgetID').val();
                var widgetPriority = $(this).closest('.widget').find('.widgetPriority').val();
                //var containerID = $(this).closest('.widget').find('.containerID').val();
                var containerEntityID = $('ul#navigation > li > a.current').attr('id');
                var containerID = $('ul#navigation > li > a.current').attr('id');

                if(typeof containerEntityID  == "undefined")
                {
                    containerEntityID = null
                }
                else
                {
                    var idArr = containerEntityID.split('-');
                    containerEntityID = idArr[idArr.length - 1];
                }
                if(typeof containerID  == "undefined")
                {
                    containerID = null
                }
                else
                {
                    var idArr = containerID.split('-');
                    containerID = idArr[idArr.length - 2];
                }
                $('#main').html('<div style="height:600px"><img src="/public/images/loading.gif" style="position:absolute; top:40%; left:42%;" /></div>');

                if(typeof widgetID != "undefined")
                {
                    $.ajax({
                        url: '../../bll/ajaxhandlers/removeDashboardWidget.php',
                        data: {
                                container_ID: containerID,
                                entity_ID: widgetID,
                                user_ID: '<?php echo $user_ID;?>',
                                accessgroup_ID: '<?php echo $accessgroup_id;?>'
                        },
                        success: function(data){
                            $.ajax({
                                url: '../../bll/ajaxhandlers/addDashboardWidget.php',
                                data: {
                                        container_ID: containerID,
                                        widgetType: widgetType,
                                        title: widgetTitle,
                                        description: '',
                                        params: paramString,
                                        priority: widgetPriority,
                                        viewType: widgetViewType,
                                        user_ID: '<?php echo $user_ID;?>',
                                        accessgroup_ID: '<?php echo $accessgroup_id;?>'
                                    },
                                success: function(data2){
                                    if(typeof contentEdit != "undefined")
                                    {
                                      //contentEdit.abort();
                                    }
                                     contentEdit = $.ajax({
                                        url: '../../bll/ajaxhandlers/loadDashboardContentEdit.php',
                                        data: {
                                        user_ID: '<?php echo $user_ID;?>',
                                        entity_ID: containerEntityID

                                        //params: id
                                            },timeout: 0,dataType : 'text', error: function(jqXHR, textStatus, errorThrown) {
        $('ul#navigation > li > a.current').click();
    },
                                        success: function(data3){

                                            //$('.widgetDialogBox').each(function(){
                                            //    $(this).remove();
                                            //});
                                            //$('#main *').unbind();
                                            //$('#main *').die();
                                            //$('#main').empty();
                                            $('#main').html(data3);
                                            //initializeJS();
                                            contentEdit = undefined;

                                        }
                                    });


                                }


                            }) ;
                        }

                    }) ;
                }
                else
                {
                    $.ajax({
                        url: '../../bll/ajaxhandlers/addDashboardWidget.php',
                        data: {
                                container_ID: containerID,
                                widgetType: widgetType,
                                title: widgetTitle,
                                description: '',
                                params: paramString,
                                priority: widgetPriority,
                                viewType: widgetViewType,
                                user_ID: '<?php echo $user_ID;?>',
                                accessgroup_ID: '<?php echo $accessgroup_id;?>'
                            },
                        success: function(data2){
                            if(typeof contentEdit != "undefined")
                            {
                              //contentEdit.abort();
                            }
                             contentEdit = $.ajax({
                                url: '../../bll/ajaxhandlers/loadDashboardContentEdit.php',
                                data: {
                                user_ID: '<?php echo $user_ID;?>',
                                entity_ID: containerEntityID

                                //params: id
                                    },timeout: 0,dataType : 'text', error: function(jqXHR, textStatus, errorThrown) {
        $('ul#navigation > li > a.current').click();
    },
                                success: function(data3){

                                    //$('.widgetDialogBox').each(function(){
                                    //    $(this).remove();
                                    //});
                                    //$('#main *').unbind();
                                    //$('#main *').die();
                                    //$('#main').empty();
                                    $('#main').html(data3);
                                    contentEdit = undefined;
                                    //initializeJS();

                                }
                            });


                        }


                    }) ;
                }



                destroyWidgetSelectionOverlay();
                event.stopPropagation();
            });


            $('.discussShare').live('click',function(){


                var dg = $(this).closest('.rssRow').find('.feedContentMeta').find('a').attr('href');
                var dl = $(this).closest('.rssRow').find('.feedContentMeta').find('a').attr('href');
                var dt = $(this).closest('.rssRow').find('a > span').html();
                var dd = $(this).closest('.rssRow').find('.feedHiddenContent').html();
                var dc = $(this).closest('.rssRow').find('.feedFullContent').html();
                var dpd = $(this).closest('.rssRow').find('.date').html();




                var casPattern = /^http(s?):\/\/cas\.state\.gov(\/.*)?$/i;
                var wpPattern = /^http(s?):\/\/wordpress\.state\.gov(\/.*)?$/i;

                if(casPattern.test(dg) || wpPattern.test(dg))
                    {
                        return true;
                        //viewType = 'JSServerDiverted_CAS';
                    }




                $('#dg').val(dg);
                $('#dl').val(dl);
                $('#dt').val(dt);
                $('#dd').val(dd);
                $('#dc').val(dc);
                $('#dpd').val(dpd);

                $('#currentDiscussionForm').submit();


            });

            $('body').click(function(event) {
                if (!$(event.target).closest('.editWidgetButton').length) {
                    if(!($('.widgetSelection').is(':focus') || $('.widgetPrioritySelect').is(':focus')     )){
                        destroyWidgetSelectionOverlay();
                    }
                }
                if (!$(event.target).closest('.widgetEmptyContainer').length) {
                    if(!($('.widgetSelect').is(':focus')||  $('.widgetSelection').is(':focus'))){
                        destroyAddWidgetOverlay();
                    }
                }
                else{
                    if($(event.target).hasClass('addWidget') )
                        {
                            destroyAddWidgetOverlay();
                        }
                }
            });

            $('body').keyup(function(event){

                        $(this).click();



            });

            $('.DirectRSS').live("click", function(event){
                var prio = $(this).attr('id');

                var prioArr = prio.split('-');

                prio = prioArr[prioArr.length - 1];
                        resetDialogInputValues();
                var widgetID = $(this).closest('.widget').find('.widgetID').val();
                var widgetTitle = $(this).closest('li').find('.savedDirectInternalTitle').val();
                var widgetLink = $(this).closest('li').find('.savedDirectInternalLink').val();

                $('#widgetIdDF').val(widgetID);
                $('#widgetPriorityDF').val(prio);

                $('#widgetTitleTBDF').val(widgetTitle);
                $('#widgetURLTBDF').val(widgetLink);

                $('#customDirectFeedDialogBox').dialog("option","title",'New Custom Source');

                $('#customDirectFeedDialogBox').dialog("open");
            });

            $('.GoogleSearchFeed').live("click", function(event){
                var prio = $(this).attr('id');

                var prioArr = prio.split('-');

                prio = prioArr[prioArr.length - 1];
                        resetDialogInputValues();
                var widgetID = $(this).closest('.widget').find('.widgetID').val();

                var widgetTitle = $(this).closest('li').find('.savedCustomDomainSearchTitle').val();
                var widgetDomain = $(this).closest('li').find('.savedCustomDomainSearchDomain').val();
                var widgetSearchTerm = $(this).closest('li').find('.savedCustomDomainSearchSearchTerm').val();

                $('#widgetIdGS').val(widgetID);
                $('#widgetPriorityGS').val(prio);

                $('#widgetTitleTBGS').val(widgetTitle);
                $('#widgetDomainTBGS').val(widgetDomain);
                $('#widgetSearchTermTBGS').val(widgetSearchTerm);


                $('#customGoogleSearchDialogBox').dialog("option","title",'New Custom Source');

                $('#customGoogleSearchDialogBox').dialog("open");
            });

            $('.GoogleNewsSearchFeed').live("click", function(event){
                var prio = $(this).attr('id');

                var prioArr = prio.split('-');

                prio = prioArr[prioArr.length - 1];
                        resetDialogInputValues();
                var widgetID = $(this).closest('.widget').find('.widgetID').val();

                var widgetTitle = $(this).closest('li').find('.savedCustomDomainSearchTitle').val();
                var widgetSearchTerm = $(this).closest('li').find('.savedCustomDomainSearchSearchTerm').val();

                $('#widgetIdGN').val(widgetID);
                $('#widgetPriorityGN').val(prio);

                $('#widgetTitleTBGN').val(widgetTitle);
                $('#widgetSearchTermTBGN').val(widgetSearchTerm);


                $('#customGoogleNewsSearchDialogBox').dialog("option","title",'New Custom Source');

                $('#customGoogleNewsSearchDialogBox').dialog("open");
            });

            $('.YoutubeSearchFeed').live("click", function(event){
                var prio = $(this).attr('id');

                var prioArr = prio.split('-');

                prio = prioArr[prioArr.length - 1];
                        resetDialogInputValues();
                var widgetID = $(this).closest('.widget').find('.widgetID').val();

                var widgetTitle = $(this).closest('li').find('.savedCustomDomainSearchTitle').val();
                var widgetSearchTerm = $(this).closest('li').find('.savedCustomDomainSearchSearchTerm').val();

                $('#widgetIdYS').val(widgetID);
                $('#widgetPriorityYS').val(prio);

                $('#widgetTitleTBYS').val(widgetTitle);
                $('#widgetSearchTermTBYS').val(widgetSearchTerm);


                $('#customYoutubeSearchDialogBox').dialog("option","title",'New Custom Source');

                $('#customYoutubeSearchDialogBox').dialog("open");
            });



            $('.SMARTSearchFeed').live("click", function(event){
                var prio = $(this).attr('id');

                var prioArr = prio.split('-');

                prio = prioArr[prioArr.length - 1];
                        resetDialogInputValues();
                var widgetID = $(this).closest('.widget').find('.widgetID').val();

                var widgetTitle = $(this).closest('li').find('.savedSMARTSearchSourceTitle').val();
                var widgetSearchTerm = $(this).closest('li').find('.savedSMARTSearchSourceSearchTerm').val();

                if(typeof widgetSearchTerm != "undefined")
                {
                var widgetAddressee = reverseParseSMARTSearchString(widgetSearchTerm,'ADDRESSEE');
                var widgetSubject = reverseParseSMARTSearchString(widgetSearchTerm,'SUBJECT');
                var widgetTAGS = reverseParseSMARTSearchString(widgetSearchTerm,'TAGS');
                var widgetCaptions = reverseParseSMARTSearchString(widgetSearchTerm,'CAPTIONS');
                var widgetOriginator = reverseParseSMARTSearchString(widgetSearchTerm,'ORIGINATOR');

                $('#widgetAddresseeTBSS').val(widgetAddressee);
                $('#widgetSubjectTBSS').val(widgetSubject);
                $('#widgetTAGSTBSS').val(widgetTAGS);
                $('#widgetCaptionsTBSS').val(widgetCaptions);
                $('#widgetOriginatorTBSS').val(widgetOriginator);
                }
                else
                {
                $('#widgetAddresseeTBSS').val('');
                $('#widgetSubjectTBSS').val('');
                $('#widgetTAGSTBSS').val('');
                $('#widgetCaptionsTBSS').val('');
                $('#widgetOriginatorTBSS').val('');
                }

                $('#widgetIdSS').val(widgetID);
                $('#widgetPrioritySS').val(prio);

                $('#widgetTitleTBSS').val(widgetTitle);


                //$('#widgetSearchTermTBSS').val(widgetSearchTerm);


                $('#customSMARTSearchDialogBox').dialog("option","title",'New SMART Custom Source');

                $('#customSMARTSearchDialogBox').dialog("open");
            });



            $('#widgetContentTypeTBCU').live("change", function(){

                //var widgetContentType = $(this).closest('li').find('.savedCorridorSourceContentType').val();
		    //alert(widgetContentType );
			if($(this).val() == "group")
						{
							$('#widgetContentTypeTBCUG').show();
						}
			else
			{
							$('#widgetContentTypeTBCUG').hide();
			}

		});


            $('.CorridorUserFeed').live("click", function(event){
                var prio = $(this).attr('id');

                var prioArr = prio.split('-');

                prio = prioArr[prioArr.length - 1];
                        resetDialogInputValues();
                var widgetID = $(this).closest('.widget').find('.widgetID').val();

                var widgetTitle = $(this).closest('li').find('.savedCorridorSourceTitle').val();
                var widgetContentType = $(this).closest('li').find('.savedCorridorSourceContentType').val();
       	    //var widgetGroup = $(this).closest('li').find('.savedCorridorSourceGroup').val();
                var widgetGroup = $(this).closest('li').find('.savedCorridorSourceGroup').val();

                $('#widgetIdCU').val(widgetID);
                $('#widgetPriorityCU').val(prio);

                $('#widgetTitleTBCU').val(widgetTitle);

                $('#widgetContentTypeTBCU').val(widgetContentType);





	$.ajax({
                url: '<?php echo CORRIDOR_GROUP_WEB_SERVICE_URL ;?>',

				type: 'POST',
		        	dataType: "json",
                        processData: false,
                        xhrFields: {
                        withCredentials: true
                        },

                		dataType:"json",
                success: function(feed){

			$.each(feed , function (key, value) {


				$('#widgetContentTypeTBCUG').append($('<option/>', {
        				value: key,
        				text : value
    				}));




			});

			$('#widgetContentTypeTBCUG').val(widgetGroup);


                },
		   error: function(jqXHR, textStatus, errorThrown)
			{
				//alert(errorThrown);
			}


	});






			if(widgetContentType == "group")
						{
							$('#widgetContentTypeTBCUG').show();

						}
			else
			{
							$('#widgetContentTypeTBCUG').hide();
			}



			//				$('#widgetContentTypeTBCUG').val(widgetGroup);


                $('#customCorridorUserDialogBox').dialog("option","title",'Corridor Feed');

                $('#customCorridorUserDialogBox').dialog("open");
            });


            $('.feedInnerLink').live("click", function(){

                $('#fullArticleContentDialogBox').html($(this).closest('.rssRow').find('.feedContent').find('.feedFullContent').html());
                var linkUrl = $(this).closest('.rssRow').find('.feedContent').find('.feedContentMeta').find('a').attr('href');
                $('#fullArticleContentDialogBox').dialog("option","title",$(this).closest('.rssRow').find('.feedContent').prev('a').find('span').html());

                var newbuttons = {
                    //"Read Full Article": function () { window.open(linkUrl);},
                    "Close" : function(){$(this).dialog("close");}

                };

                //var generateURL = function(event, ui){$('<a />', {'class': 'linkClass',text: 'Cancel',href: '#'}).appendTo($(".ui-dialog-buttonpane")).click(function(){$(event.target).dialog('close');});});


                $('#fullArticleContentDialogBox').dialog("option", "buttons", newbuttons); // setter


                $('<div />', {
                        //'class': 'ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only',
                        'class': 'ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ReadFullArticleButtonContainer'

                    })
                    .prependTo($(".ui-dialog-buttonset"))
                    .hover(function(){
                        $(this).toggleClass('ui-state-hover');
                    })
                    ;


                $('<a />', {
                        //'class': 'ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only',
                        'class': 'ui-button-text',
                        text: 'Read Full Article',
                        href: linkUrl,
                        target: '_blank'
                    })
                    .prependTo($(".ReadFullArticleButtonContainer"))
                    //.click(function(){
                        //$(event.target).dialog('close');
                    //})
                    ;

                /*
                $('#fullArticleContentDialogBox').bind( "dialogcreate", function(event, ui) {
                    $('<a />', {
                        'class': 'linkClass',
                        text: 'Cancel',
                        href: '#'
                    })
                    .appendTo($(".ui-dialog-buttonpane"))
                    .click(function(){
                        $(event.target).dialog('close');
                    });
                });
                */


                $('body').css('overflow','hidden');
                $('#fullArticleContentDialogBox').dialog("open");

            });


            $('.discussShare').live("click", function(){


            });


            $('.widgetPrioritySelect').live("keyup",function(event){
                if(event.keyCode == 13 || event.keyCode == 32){
                    $(this).click();
                    event.stopPropagation();
                }

            });


            $('.widgetPrioritySelect').live("click",function(event){

                var widgetID = $(this).closest('.widget').find('.widgetID').val();
                var containerID2 = $(this).closest('.widget').find('.containerID').val();
                var widgetPriority = $(this).find(".widgetPrioritySelectInput").val();

                var containerEntityID = $('ul#navigation > li > a.current').attr('id');
                var containerID = $('ul#navigation > li > a.current').attr('id');



                if(typeof containerEntityID  == "undefined")
                {
                    containerEntityID = null
                }
                else
                {
                    var idArr = containerEntityID.split('-');
                    containerEntityID = idArr[idArr.length - 1];
                }
                if(typeof containerID  == "undefined")
                {
                    containerID = null
                }
                else
                {
                    var idArr = containerID.split('-');
                    containerID = idArr[idArr.length - 2];
                }
                $('#main').html('<div style="height:600px"><img src="/public/images/loading.gif" style="position:absolute; top:40%; left:42%;" /></div>');


                $.ajax({
                    url: '../../bll/ajaxhandlers/reorderDashboardWidget.php',
                    data: {
                            container_ID: containerID,
                            entity_ID: widgetID,
                            priority: widgetPriority,
                            user_ID: '<?php echo $user_ID;?>',
                            accessgroup_ID: '<?php echo $accessgroup_id;?>'
                        },
                    success: function(data2){

                        if(typeof contentEdit != "undefined")
                        {
                          //contentEdit.abort();
                        }
                         contentEdit = $.ajax({
                            url: '../../bll/ajaxhandlers/loadDashboardContentEdit.php',
                            data: {
                            user_ID: '<?php echo $user_ID;?>',
                            entity_ID: containerEntityID

                            //params: id
                                },timeout: 0,dataType : 'text', error: function(jqXHR, textStatus, errorThrown) {
        $('ul#navigation > li > a.current').click();
    },
                            success: function(data3){

                                //$('.widgetDialogBox').each(function(){
                                //    $(this).remove();
                                //});
                                //$('#main *').unbind();
                                //$('#main *').die();
                                //$('#main').empty();
                                $('#main').html(data3);
                                contentEdit = undefined;
                                //initializeJS();

                            }
                        });


                    }


                }) ;

                destroyWidgetSelectionOverlay();
                event.stopPropagation();

            });

            $('#inviteColleaguesLink').live('click', function(){
                $('#emailColleaguesDialogBox').dialog('open');
                return false;

            });


            $('#instructionalVideoLink').live('click', function(){
                $('#instructionalVideoDialogBox').dialog('open');

            });
            $('#instructionalVideoLink').live("keyup", function(event){

                if(event.keyCode == 13 || event.keyCode == 32){
                    $(this).click();
                    event.stopPropagation();
                }


            });




            $('#shareTabButton').live('click', function(){
                $('#shareTabDialogBox').find(".embedLink").val('working...');
                var containerEntityID = $(this).parent().find('.contentEditContainer').attr("id");
                containerEntityID = containerEntityID.split('-');
                containerEntityID = containerEntityID[containerEntityID.length - 1];
                var userID = '<?php echo $user_ID;?>';
                var shareUrl = '';
                $.ajax({
                    url: '../../bll/ajaxhandlers/createshare.php',
                    data: {
                            entity_ID: containerEntityID,
                            user_ID: userID
                        },
                    success: function(data2){

                       shareUrl = $.trim(data2);
                       $('#shareTabDialogBox').find(".embedLink").val(shareUrl);
                       $('#sharedPageComplete').val('1');






                    }


                }) ;

                $("#shareTabDialogBox").dialog('open');

            });
            $('#shareTabButton').live("keyup", function(event){

                if(event.keyCode == 13 || event.keyCode == 32){
                    $(this).click();
                    event.stopPropagation();
                }


            });

            $(".embedLink").live('click',function(){
                var $this = $(this);
                $this.focus();
                $this.select();

            });

            $('#doneCustomizationButton').live('click',function(){
                $('#customizeLink').click();

            });

            $('#doneCustomizationButton').live("keyup", function(event){

                if(event.keyCode == 13 || event.keyCode == 32){
                    $(this).click();
                    event.stopPropagation();
                }


            });

            $('#customizeLink').click(function(){

                if('<?php echo $user_ID;?>' == '<?php echo SYSTEM_USER_ID; ?>')
                {
                    $('#joinCorridorTooltipDialogBox').dialog('open');
                    return false;
                }

                var isChrome = window.chrome;
                if(isChrome) {
                   // is chrome
                   //alert('yes');
                } else {
                   //alert('no');
                   // not chrome
                   if($(this).html() != "View This Page")
                       {
                           $('#IEIssuesTooltipDialogBox').dialog('open');
                       }



                }


                if($(this).html() == "View This Page")
                {
                    $('#main').html('<div style="height:600px"><img src="/public/images/loading.gif" style="position:absolute; top:40%; left:42%;" /></div>');


                    var id = $('ul#navigation > li > a.current').attr('id');

                    //var id = $(this).attr('id');
                    if(typeof id  == "undefined")
                        {
                            id = null
                        }
                    else
                        {
                            var idArr = id.split('-');
                            id = idArr[idArr.length - 1];
                        }



                    $.ajax({
                        //document.location.hostname+
                        url: '../../bll/ajaxhandlers/loadDashboardContentAndNav.php',
                        data: {
                        entity_ID: id,
                        user_ID: '<?php echo $user_ID;?>'
                              },timeout: 0,dataType : 'html', error: function(jqXHR, textStatus, errorThrown) {
        $('ul#navigation > li > a.current').click();
    },
                        success: function(data){


                        //alert($(data).filter("#ajaxRenderNav").html());
                        $('#main').html($(data).filter("#ajaxRenderContent").html());
                        $('#navdiv').html($(data).filter("#ajaxRenderNav").html());



                        $(data).filter('script').each(function(){
                            $.globalEval(this.text || this.textContent || this.innerHTML || '');
                        });

                        $('#customizeLink').html("Customize");



                        }

                    });

                    startStopRefreshTimer(1);







                    //$.cookie("viewMode", 0, { expires: 999999 });

                }
                else
                {
                    $('#main').html('<div style="height:600px"><img src="/public/images/loading.gif" style="position:absolute; top:40%; left:42%;" /></div>');


                    var id = $('ul#navigation > li > a.current').attr('id');

                    //var id = $(this).attr('id');

                    if(typeof id  == "undefined")
                        {
                            id = null
                        }
                    else
                        {
                            var idArr = id.split('-');
                            id = idArr[idArr.length - 1];
                        }

                    $.ajax({
                    //document.location.hostname+
                        url: '../../bll/ajaxhandlers/loadDashboardContentEditAndNavEdit.php',
                        data: {
                        entity_ID: id,
                        user_ID: '<?php echo $user_ID;?>'
                                },timeout: 0,dataType : 'html', error: function(jqXHR, textStatus, errorThrown) {
        $('ul#navigation > li > a.current').click();
    },
                        success: function(data){


                        //alert($(data).filter("#ajaxRenderNav").html());
                        $('#main').html($(data).filter("#ajaxRenderContent").html());
                        $('#navdiv').html($(data).filter("#ajaxRenderNav").html());



                        $(data).filter('script').each(function(){
                            $.globalEval(this.text || this.textContent || this.innerHTML || '');
                        });


                        $('#customizeLink').html("View This Page");


                        }

                    });
                    startStopRefreshTimer(0);
                    //$.cookie("viewMode", 1, { expires: 999999 });

                }






                //$('#navdiv').val('') ;

            });

            jwplayer("addingRSSPlayer").setup({
                flashplayer: "/public/player/player.swf",
                file: "/public/player/videos/The Current - RSS Search.mp4",
                image: "/public/player/img/Adding an RSS.jpg",
		    streching: "exactfit",
		    plugins: {
			"captions-2":{
				file: "/public/player/videos/Captions_The-Current_Adding-an-RSS-Feed.srt",
				back:true
			}
		    },
                height: 384,
                width: 512
            });

            jwplayer("addingGoogleNewsPlayer").setup({
                flashplayer: "/public/player/player.swf",
                file: "/public/player/videos/The Current - News Search.mp4",
                image: "/public/player/img/Adding Google News Feed.jpg",
		    streching: "exactfit",
		    plugins: {
			"captions-2":{
				file: "/public/player/videos/Captions_The-Current_Adding-a-Custom-News Search.srt",
				back:true
			}
		    },
                height: 384,
                width: 512
            });
            jwplayer("addingWebsiteSearchPlayer").setup({
                flashplayer: "/public/player/player.swf",
                file: "/public/player/videos/The Current - Website Search.mp4",
                image: "/public/player/img/Adding Website Search.jpg",
	 	    streching: "exactfit",
		    plugins: {
			"captions-2":{
				file: "/public/player/videos/Captions_The-Current_Adding-a-Website-Search.srt",
				back:true
			}
		    },
                height: 384,
                width: 512
            });
            jwplayer("IEFixesPlayer").setup({
                flashplayer: "/public/player/player.swf",
                file: "/public/player/videos/The Current - IE Fixes.mp4",
		    streching: "exactfit",
		    plugins: {
			"captions-2":{
				file: "/public/player/videos/Captions_The-Current_Using-Internet-Explorer.srt",
				back:true
			}
		    },

                height: 384,
                width: 512
            });


            $('.feedInnerLink').live('click',function(){

                //$(this).parent().parent('.feedContent').find('.feedFullContent').toggle();
                //$(this).parent().parent('.feedContent').find('.feedHiddenContent').toggle();
                //toggleFeedShowHideLinkText($(this));

            });

            $('.dashboard_tab_link_edit').live('click', function(){

                if($(this).parent().hasClass('noClick'))
                {
                    $(this).parent().removeClass('noClick');
                }
                else
                {
                //alert($(this).attr("class"));


                    $('#main').html('<div style="height:600px"><img src="/public/images/loading.gif" style="position:absolute; top:40%; left:42%;" /></div>');


                    var id = $(this).attr('id');

                    var idArr = id.split('-');

                    id = idArr[idArr.length - 1];

                    //$.cookie("openTab", id, { expires: 999999 });
                    /*
                    $('#dashboardIdIN').val(id);
                    $('#dashboardTitleTB').val($(this).html());

                    var priority = $(this).parent().attr('id');

                    var priorityArr = priority.split('-');

                    priority = priorityArr[priorityArr.length - 1];
                    $('#dashboardIdIN').val(priority);

                    $('#editDialogBox').dialog("open");
                */

                    $.ajax({
                    //document.location.hostname+
                        url: '../../bll/ajaxhandlers/loadDashboardContentEditAndNavEdit.php',
                        data: {
                        entity_ID: id,
                        user_ID: '<?php echo $user_ID;?>'
                                },timeout: 0,dataType : 'html', error: function(jqXHR, textStatus, errorThrown) {
        $('ul#navigation > li > a.current').click();
    },
                        success: function(data){


                        //alert($(data).filter("#ajaxRenderNav").html());
                        $('#main').html($(data).filter("#ajaxRenderContent").html());
                        $('#navdiv').html($(data).filter("#ajaxRenderNav").html());



                        $(data).filter('script').each(function(){
                            $.globalEval(this.text || this.textContent || this.innerHTML || '');
                        });




                        }

                    });



                }

            });

            $('.dashboard_tab_link_view').live('click',function(){

        	$('#main').html('<div style="height:600px"><img src="/public/images/loading.gif" style="position:absolute; top:40%; left:42%;" /></div>');
                var id = $(this).attr('id');

                var idArr = id.split('-');

                id = idArr[idArr.length - 1];
                //$.cookie("openTab", id, { expires: 999999 });
                $.ajax({
                    //document.location.hostname+
                    url: '../../bll/ajaxhandlers/loadDashboardContentAndNav.php',
                    data: {
                    entity_ID: id,
                    user_ID: '<?php echo $user_ID;?>'
                            },timeout: 0,dataType : 'html', error: function(jqXHR, textStatus, errorThrown) {
    $('ul#navigation > li > a.current').click();
},
                    success: function(data){


                    //alert($(data).filter("#ajaxRenderNav").html());
                    $('#main').html($(data).filter("#ajaxRenderContent").html());
                    $('#navdiv').html($(data).filter("#ajaxRenderNav").html());



                    $(data).filter('script').each(function(){
                        $.globalEval(this.text || this.textContent || this.innerHTML || '');
                    });




                    }

                });

            });

            $('.deleteTabButton').live('click', function(){
                if(!genericConfirm())
                    {return false;}
                var id = $(this).attr('id');

                var idArr = id.split('-');

                id = idArr[idArr.length - 1];

                var cid = $('ul#navigation > li > a.current').attr('id');

                        //var id = $(this).attr('id');
                        if(typeof cid  == "undefined")
                        {
                            cid = null
                        }
                        else
                        {
                            var idArr = cid.split('-');
                            cid = idArr[idArr.length - 1];
                        }

                //var title = $(this).parent().find('a').html();
                $('#main').html('<div style="height:600px"><img src="/public/images/loading.gif" style="position:absolute; top:40%; left:42%;" /></div>');

                $.ajax({
                    //document.location.hostname+
                    url: '../../bll/ajaxhandlers/removeDashboardTab.php',
                    data: {
                    entity_ID: id,
                    user_ID: '<?php echo $user_ID;?>',
                    accessgroup_ID: '<?php echo $accessgroup_id;?>'

                    //params: id
                        },
                    success: function(data){
                        $.ajax({
                    //document.location.hostname+
                            url: '../../bll/ajaxhandlers/loadDashboardContentEditAndNavEdit.php',
                            data: {
                            entity_ID: cid,
                            user_ID: '<?php echo $user_ID;?>'
                                    },timeout: 0,dataType : 'html', error: function(jqXHR, textStatus, errorThrown) {
            $('ul#navigation > li > a.current').click();
        },
                            success: function(data){


                            //alert($(data).filter("#ajaxRenderNav").html());
                            $('#main').html($(data).filter("#ajaxRenderContent").html());
                            $('#navdiv').html($(data).filter("#ajaxRenderNav").html());



                            $(data).filter('script').each(function(){
                                $.globalEval(this.text || this.textContent || this.innerHTML || '');
                            });




                            }

                        });

                        navEdit = undefined;
                        contentEdit = undefined;
                    }

                });
            });

            $('.deleteTabButton').live('keydown', function(){
                if(event.keyCode == 13 || event.keyCode == 32){
                $(this).click();
                }
            });


            $('.sourceExpandIcon').live('click', function(){

                if($(this).hasClass('opened')){
                    $(this).removeClass('opened');
                    $(this).addClass('closed');
                    $(this).closest('.widget').find('.mediafeed').toggle();
                }
                else if($(this).hasClass('closed')){
                    $(this).removeClass('closed');
                    $(this).addClass('opened');
                    $(this).closest('.widget').find('.mediafeed').toggle();
                }
                else{

                    $(this).addClass('opened');
                }
                clearSelection();
            });


		// DOM Ready

            $('#slider').anythingSlider({
                                buildStartStop:false,
                                theme:'default',
                                onSlideComplete : function(slider){

                                    var i = 0;
                            while (true) {
                                var player = jwplayer(i);
                                if (!player)
                                    break;

                                player.stop();
                                i++;
                            }
                                },
                                       // mode                : 'f',   // fade mode - new in v1.8!
				resizeContents      : false, // If true, solitary images/objects in the panel will expand to fit the viewport
				//navigationSize      : 3,     // Set this to the maximum number of visible navigation tabs; false to disable
				navigationFormatter : function(index, panel){ // Format navigation labels with text
					//return " Panel #" + index;
                                        return {
                                        'class'  : 'panel',
                                        'data-x' : 'Adding an RSS feed into The Current', // "Title#" is in the h2
                                        'title'  : panel.find('h1').text(),
                                        'html'   : '<a href="#" class="friendlyText" style="padding-top:' + (index == 1 || index == 4 ? "12px;" : "0;") + '" ><span style="overflow:visible;">' + panel.find('h1').text() + '</span></a>'
                                        };


				},
				onSlideBegin: function(e,slider) {
					// keep the current navigation tab in view
					slider.navWindow( slider.targetPage );

				}
            });






        });

        function resetDialogInputValues()
        {
           $('#dashboardTitleTB').val('');
           //$('#widgetTitleTBGF').val('');
           //$('#widgetURLTBGF').val('');
           $('#widgetTitleTBDF').val('');
           $('#widgetURLTBDF').val('');
           $('#widgetTitleTBGS').val('');
           $('#widgetDomainTBGS').val('');
           $('#widgetSearchTermTBGS').val('');
           $('#widgetTitleTBGN').val('');
           $('#widgetSearchTermTBGN').val('');
           $('#widgetTitleTBYS').val('');
           $('#widgetSearchTermTBYS').val('');

        }
        </script>
    </head>

    <body style="cursor: auto; ">
        <style type="text/css">
div#eDipBanner
{
	background: #cecece url(http://corridor.state.gov/eDipBanner/bg.gif) top left repeat-x;
	float: left;
	width: 100%;
	height: 31px;
	margin-bottom: 2px;
	}
div#eDipBanner ul
{
	font: 12px/1.5em Arial, Helvetica, sans-serif;
	float: right;
	height: 31px;
	list-style: none;
	padding: 0 10px 0 0;
	margin: 0;
	border-right: 0px solid #2296c6;
      overflow:hidden;
}
div#eDipBanner ul li
{
	float: left;
	background: url(http://corridor.state.gov/eDipBanner/bg-item.gif) top right repeat-y;
	cursor:pointer;
}
div#eDipBanner ul li a:hover
{
	background: url(http://corridor.state.gov/eDipBanner/bg-item.gif) #e4e2e2 top right repeat-y;
}
div#eDipBanner ul li a
{
	display:block;

}
span.searchclick:hover{
    /*color:#fff;*/
}

</style>
<div id="eDipBanner">
<ul>
<li><a href="http://ediplomacy.state.gov" style="padding: 6px 6px 1px 5px;"><img src="http://corridor.state.gov/eDipBanner/eDiplomacy.png" alt="eDiplomacy" width="96" height="23" border="0" /></a></li>
<li><a href="http://wordpress.state.gov/cas/" style="padding: 10px 5px 4px 5px;"  ><img src="http://corridor.state.gov/eDipBanner/commState.png" alt="Communities@State" width="114" height="16" border="0" /></a></li>
<li><a href="http://corridor.state.gov" style="padding: 8px 5px 5px 5px;"><img src="http://corridor.state.gov/eDipBanner/corridor.png" alt="Corridor" width="86" height="17" border="0" /></a></li>
<li><a href="http://thecurrent.state.gov" style="padding: 8px 5px 5px 5px;"><img src="http://corridor.state.gov/eDipBanner/theCurrent.png" alt="The Current" width="86" height="17" border="0" /></a></li>
<li><a href="http://diplopedia.state.gov"  style="padding: 9px 5px 7px 5px; "><img src="http://corridor.state.gov/eDipBanner/diplopedia.png" alt="Diplopedia" width="92" height="14" border="0" /></a></li>
<![if !IE]>
<li>
    <div style ="padding: 4px 5px 4px 5px;">
        <div style="display: inline-block; float:left;position:relative;box-shadow:inset 0 0 4px 0 rgba(0,0,0,0.1); -webkit-box-shadow: inset 0 0 4px 0 rgba(0,0,0,0.1); border-radius:13px; -webkit-border-radius:13px; background:#ebeff1; height:22px;padding:0 10px 0 10px;">
            <form id="searchstate" method="get" action="http://search.state.sbu">
            <input name="search" onclick="this.style.background='#ebeff1';" style="font-size: 12px; color:#999; background:#ebeff1 url(http://corridor.state.gov/eDipBanner/searchState2.png) no-repeat left 3px; width:111px; resize:none; outline:none; padding:4px 0 0 0; margin:0; border:none; border-radius:0;box-sizing:content-box; box-shadow:none;" />
            </form>
        </div>
        <span id="searchclick" class="searchclick" onClick="javascript:document.getElementById('searchstate').submit()" style="color:#888; padding-left:4px;text-decoration:none; font-size:10px;"><img src="http://corridor.state.gov/eDipBanner/searchbutton.png" /></span>
    </div>
</li>
<![endif]>
<!--[if IE]>
<li><a href="http://search.state.sbu"  style="padding: 9px 5px 7px 5px; "><img src="http://corridor.state.gov/eDipBanner/searchState.png" alt="SearchState" width="96" height="14" border="0" /></a></li>
<![endif]-->
<li><a href="http://soundingboard.state.gov"  style="padding: 5px 5px 0px 5px; "><img src="http://corridor.state.gov/eDipBanner/soundingBoard.png" width="138" height="25" alt="The Sounding Board" /></a></li>
</ul>
</div>

        <div id="header">
            <div id="headerContent">
            <a href="/"><img src="/public/images/theCurrent.png" width="217" height="44" alt="The Current" /></a>

            <!--
            <div id="IEWarningLabel">
                Note: You are viewing this page with Internet Explorer. You may encounter technical problems when trying to customize your Current in IE. Please use Google Chrome or follow the instructions in the <a href="http://diplopedia.state.gov/index.php?title=The_Current_FAQ#What_steps_do_I_need_to_take_if_I_use_Internet_Explorer.3F" target="_blank">FAQs</a> to continue working in IE.
            </div>
            -->

            <div id="betaTag"><a href="#" id="inviteColleaguesLink">Invite Your Colleagues</a><div></div><span></span></div>

            <div id="defaultNavDiv" class="defaultNavDiv">
                <ul class="navigation">
                    <li class="first"><a href="about.php">About The Current</a></li>
                    <li ><a href="http://diplopedia.state.gov/index.php?title=The_Current_FAQ" target="_blank" >FAQ</a></li>
                    <li ><a id="instructionalVideoLink" href="javascript:void(0);" >Help Center</a></li>
                    <li ><a href="mailto:edipcurrentadmin@state.gov" >Feedback</a></li>
                </ul>

            </div>
            <div id="navdiv" class="navDiv">

            <?php
            render(AJAX_PATH,'loadDashboardNav.php', array('user_ID' => $user_ID));
            ?>

            </div>
            <div id="staticNavDiv" class="staticNavDiv">
                <ul class="navigation">
                    <li><a  id="catalogLink" name="catalogLink" href="catalog.php" >Catalog</a></li>
                    <li><a  href="http://corridor.state.gov/activity/?s=%23the_current" target="_blank" >Discuss</a></li>
                    <li><a  href="http://cas.state.gov/thecurrentbuzz" target="_blank">The Current Buzz</a></li>
                    <li><a id="customizeLink" name="customizeLink" href="#">Customize</a></li>
                </ul>
            </div>
            <div style="position:absolute;left:-999px;">
            <input type="hidden" id="currentContainerId" name="currentContainerId" value="" />
            <div id="editDialogBox" class="dialogBox">
                <input id="dashboardIdIN" name="dashboardIdIN" type="hidden" value="" />
                <input id="dashboardPriorityIN" name="dashboardPriorityIN" type="hidden" value="" />
                <label for="dashboardTitleTB">Title: </label><input id="dashboardTitleTB" name="dashboardTitleTB" class="dialogTB" type="text" />
            </div>

            <div id="customDirectFeedDialogBox" class="dialogBox widgetDialogBox">
                <input id="widgetIdDF" name="widgetIdDF" type="hidden" value="" />
                <input id="widgetPriorityDF" name="widgetPriorityDF" type="hidden" value="" />
                <table>
                <tr><td><label for="widgetTitleTBDF">Title: </label></td><td><input id="widgetTitleTBDF" name="widgetTitleTBDF" class="dialogTB" type="text" /></td></tr>
                <tr><td><label for="widgetURLTBDF">Feed URL: </label></td><td><input id="widgetURLTBDF" name="widgetURLTBDF" class="dialogTB" type="text" /></td></tr>
            </table>
            </div>
            <div id="customGoogleSearchDialogBox" class="dialogBox widgetDialogBox">
                <input id="widgetIdGS" name="widgetIdGS" type="hidden" value="" />
                <input id="widgetPriorityGS" name="widgetPriorityGS" type="hidden" value="" />
                <table>
                <tr><td><label for="widgetTitleTBGS">Title: </label></td><td><input id="widgetTitleTBGS" name="widgetTitleTBGS" class="dialogTB" type="text" /></td></tr>
                <tr><td><label for="widgetDomainTBGS">Website: </label></td><td><input id="widgetDomainTBGS" name="widgetDomainTBGS" class="dialogTB" type="text" /></td></tr>
                <tr><td><label for="widgetSearchTermTBGS">Search Term: (optional) </label></td><td><input id="widgetSearchTermTBGS" name="widgetSearchTermTBGS" class="dialogTB" type="text" /></td></tr>
            </table>
            </div>
            <div id="customGoogleNewsSearchDialogBox" class="dialogBox widgetDialogBox">
                <input id="widgetIdGN" name="widgetIdGN" type="hidden" value="" />
                <input id="widgetPriorityGN" name="widgetPriorityGN" type="hidden" value="" />
                <table>
                <tr><td><label for="widgetTitleTBGN">Title: </label></td><td><input id="widgetTitleTBGN" name="widgetTitleTBGN" class="dialogTB" type="text" /></td></tr>

                <tr><td><label for="widgetSearchTermTBGN">Search Term: (optional) </label></td><td><input id="widgetSearchTermTBGN" name="widgetSearchTermTBGN" class="dialogTB" type="text" /></td></tr>
            </table>
            </div>
            <div id="customYoutubeSearchDialogBox" class="dialogBox widgetDialogBox">
                <input id="widgetIdYS" name="widgetIdYS" type="hidden" value="" />
                <input id="widgetPriorityYS" name="widgetPriorityYS" type="hidden" value="" />
                <table>

                <tr><td><label for="widgetTitleTBYS">Title: </label></td><td><input id="widgetTitleTBYS" name="widgetTitleTBYS" class="dialogTB" type="text" /></td></tr>

                <tr><td><label for="widgetSearchTermTBYS">Search Term: (optional) </label></td><td><input id="widgetSearchTermTBYS" name="widgetSearchTermTBYS" class="dialogTB" type="text" /></td></tr>
            </table>
            </div>

            <div id="customSMARTSearchDialogBox" class="dialogBox widgetDialogBox">
                <input id="widgetIdSS" name="widgetIdSS" type="hidden" value="" />
                <input id="widgetPrioritySS" name="widgetPrioritySS" type="hidden" value="" />

                <table>

                <tr><td><label for="widgetTitleTBSS"><strong>Title:</strong> </label></td><td><input id="widgetTitleTBSS" name="widgetTitleTBSS" class="dialogTB" type="text" /></td></tr>


                <tr><td colspan="2"><p><span style="font-size:12px"><strong>Note:</strong> This source only returns information permitted by your role-based access. If the optional fields below are left blank, this source will return ALL SMART data permitted by RBAC.</span></p></td></tr>
                <tr><td><label for="widgetSubjectTBSS"><strong>Subject:</strong> * </label></td><td><input id="widgetSubjectTBSS" name="widgetSubjectTBSS" class="dialogTB" type="text" /></td></tr>

                <tr><td><label for="widgetTAGSTBSS"><strong>TAGS:</strong> * </label></td><td><input id="widgetTAGSTBSS" name="widgetTAGSTBSS" class="dialogTB" type="text" /></td></tr>




                <tr><td><label for="widgetAddresseeTBSS"><strong>To:</strong> * </label></td><td><input id="widgetAddresseeTBSS" name="widgetAddresseeTBSS" class="dialogTB" type="text" /></td></tr>
                <tr><td><label for="widgetOriginatorTBSS"><strong>From:</strong> * </label></td><td><input id="widgetOriginatorTBSS" name="widgetOriginatorTBSS" class="dialogTB" type="text" /></td></tr>
                <tr><td><label for="widgetCaptionsTBSS"><strong>Caption:</strong> * </label></td><td><input id="widgetCaptionsTBSS" name="widgetCaptionsTBSS" class="dialogTB" type="text" /></td></tr>
                <tr><td colspan="2">(* denotes an optional field)</td></tr>
                <tr><td colspan="2"><p><span style="font-size:12px">Please visit <a href="http://search.smart.state.gov/Smart/index.do" target="_blank">SMART Search</a> for the most powerful SMART Search experience.</span></p></td></tr>



            </table>
            </div>

            <div id="customCorridorUserDialogBox" class="dialogBox widgetDialogBox">
                <input id="widgetIdCU" name="widgetIdCU" type="hidden" value="" />
                <input id="widgetPriorityCU" name="widgetPriorityCU" type="hidden" value="" />
                <table>

                <tr><td><label for="widgetTitleTBCU">Title: </label></td><td><input id="widgetTitleTBCU" name="widgetTitleTBCU" class="dialogTB" type="text" /></td></tr>

                <tr><td><label for="widgetContentTypeTBCU">Feed Type: </label></td>
                    <td>
                        <select id="widgetContentTypeTBCU" name="widgetContentTypeTBCU">
                            <option id="widgetContentTypeTBCUSitewide" name="widgetContentTypeTBCUSitewide" value="sitewide">Site-Wide</option>
                            <option id="widgetContentTypeTBCUMyConnections" name="widgetContentTypeTBCUMyConnections" value="myconnections">My Connections</option>
                            <option id="widgetContentTypeTBCUMyGroups" name="widgetContentTypeTBCUMyGroups" value="mygroups">My Groups</option>
                            <option id="widgetContentTypeTBCUGroup" name="widgetContentTypeTBCUGroup" value="group">Single Group</option>
				</select>

                    </td>
                </tr>
                <tr><td></td>
                    <td>
				<select id="widgetContentTypeTBCUG" name="widgetContentTypeTBCUG">
				</select>


                    </td>
                </tr>
            </table>
            </div>


            <div id="fullArticleContentDialogBox" class="dialogBox" >

            </div>
            <div id="emailColleaguesDialogBox" class="dialogBox" >
                <p>
                    To invite your colleagues to join The Current, fill in the form below. Multiple email addresses should be separated by semicolons or commas (for instance email1@state.gov; email2@state.gov ...)

                </p>
                <table>

                <tr><td><label for="inviteNameTB">Your Name: </label></td><td><input id="inviteNameTB" name="inviteNameTB" class="dialogTB" type="text" /></td></tr>

                <tr><td><label for="inviteEmailTB">Your Email Address: </label></td><td><input id="inviteEmailTB" name="inviteEmailTB" class="dialogTB" type="text" /></td></tr>
                </table>
                <p>Enter colleague email addresses below:</p>
                <textarea style="width:460px;" id="colleagueEmailSubmissionTB"></textarea>

            </div>
            <form id="currentDiscussionForm" target="_blank" name="currentDiscussionForm" method="POST" action="../../<?php echo DISCUSSION_PAGE_FOLDER;?>/?page_id=<?php echo DISCUSSION_PAGE_ID;?>">
                <input type="hidden" value="" id="dg" name="dg" />
                <input type="hidden" value="" id="dl" name="dl" />
                <input type="hidden" value="" id="dt" name="dt" />
                <input type="hidden" value="" id="dd" name="dd" />
                <input type="hidden" value="" id="dc" name="dc" />
                <input type="hidden" value="" id="dpd" name="dpd" />


            </form>
            <div id="joinCorridorTooltipDialogBox" class="dialogBox" >
                <p>The customization feature is only available to <a href="http://corridor.state.gov" target="">Corridor</a> members.</p>
                <p>To unlock the power to customize your Pages and Sources, please join <a href="http://corridor.state.gov" target="">Corridor</a>.</p>
            </div>

            <div id="IEIssuesTooltipDialogBox" class="dialogBox" >
                <p><strong>Note:</strong> You are viewing this page with <strong>Microsoft Internet Explorer</strong>.</p>
                <p> You may encounter technical problems when trying to customize your Current in IE. Please use <strong>Google Chrome</strong> or follow the instructions in the <a href="http://diplopedia.state.gov/index.php?title=The_Current_FAQ#What_steps_do_I_need_to_take_if_I_use_Internet_Explorer.3F" target="_blank">FAQs</a> to perform customizations in IE.</p>
                <p>The following Sources are not supported in IE
                    <ul style="text-align:center;">
			<li>SMART Feed</li>
			<li>Corridor Feed</li>
		    </ul>
                </p>
            </div>

            <div id="shareTabDialogBox" class="dialogBox" >
                <p>To share this page with others, email this link to them:</p>
                <textarea  class="embedLink" readonly="true" rows="2"></textarea >

                <!--<p>Or publish your tab to the public catalog by selecting the "Publish" option.</p>-->
            </div>


            <div id="publishTabDialogBox" class="dialogBox" >
                <p>Publish your hard work to the Page Catalog!</p>
                <table style="width:550px;">
                   <!-- <tr><td><label for="widgetNameTBP"><strong>Name:</strong> * </label></td><td style="width:400px;"><input id="widgetNameTBP" name="widgetNameTBP" class="dialogTB" type="text" /></td></tr> -->
                    <tr><td><label for="widgetTagsTBP"><strong>Tags:</strong> * </label></td><td style="width:420px;"><input id="widgetTagsTBP" name="widgetTagsTBP" class="dialogTB" ></input></td></tr>
                    <tr><td><label for="widgetDescriptionTBP"><strong>Description:</strong> * </label></td><td><textarea id="widgetDescriptionTBP" name="widgetDescriptionTBP" class="dialogTB" rows="2"></textarea ></td></tr>
                    <tr><td colspan="2">(* denotes an optional field)</td></tr>

                </table>


                <!--<p>Or publish your tab to the public catalog by selecting the "Publish" option.</p>-->
            </div>

            <div id="previewTabDialogBox" class="dialogBox" >
                <div id="tabPreviewContent">

                </div>
                <!--<p>Or publish your tab to the public catalog by selecting the "Publish" option.</p>-->
            </div>



            <div id="instructionalVideoDialogBox" class="dialogBox" >

            <ul id="slider">

				<li class="panel1"><div class="videoBox">
                                        <h1>Adding an RSS feed into The Current</h1>
                <embed src="/public/player/player.swf"
                       id="addingRSSPlayer"
                       name="addingRSSPlayer"
                       class="videoPlayer"
                       width="512"
                       height="384"
                       allowscriptaccess="always"
                       allowfullscreen="true"
                       flashvars="height=384&width=512&file=/public/player/videos/The Current - RSS Search.mp4"/>
                        </div></li>

				<li class="panel2"><div class="videoBox">
                                        <h1>Adding Google News into The Current</h1>
                <embed src="/public/player/player.swf"
                       id="addingGoogleNewsPlayer"
                       name="addingGoogleNewsPlayer"
                       class="videoPlayer"
                       width="512"
                       height="384"
                       allowscriptaccess="always"
                       allowfullscreen="true"
                       flashvars="height=384&width=512&file=/public/player/videos/The Current - News Search.mp4"/>
                    </div></li>

				<li class="panel3"><div class="videoBox">
                                        <h1>Adding Website Search into The Current</h1>
                <embed src="/public/player/player.swf"
                       id="addingWebsiteSearchPlayer"
                       title="Adding Website Search into The Current"
                       name="addingWebsiteSearchPlayer"
                       class="videoPlayer"
                       width="512"
                       height="384"
                       allowscriptaccess="always"
                       allowfullscreen="true"
                       flashvars="height=384&width=512&file=/public/player/videos/The Current - Website Search.mp4"/>
                    </div></li>

			<li class="panel4"><div class="videoBox">
                                        <h1>IE Fixes for The Current</h1>
                <embed src="/public/player/player.swf"
                       id="IEFixesPlayer"
                       title="IE Fixes for The Current"
                       name="IEFixesPlayer"
                       class="videoPlayer"
                       width="512"
                       height="384"
                       allowscriptaccess="always"
                       allowfullscreen="true"
                       flashvars="height=384&width=512&file=/public/player/videos/The Current - IE Fixes.mp4"/>
                    </div></li>



			</ul>


            </div>


            </div>
            </div>
        </div>

        <div id="pilotTag"><span>Eight Quick Questions -- </span><a target="_blank" href="http://cas.state.gov/thecurrentbuzz/feedback/">How do you use The Current?</a></div>

        <input id="sharedPageComplete" name="sharedPageComplete" type="hidden" value="0" />
        <input id="publishTagsLoadedComplete" name="publishTagsLoadedComplete" type="hidden" value="0" />

        <div id="main">