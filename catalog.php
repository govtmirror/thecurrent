<?php if (!(preg_match("/chrome/i", $_SERVER['HTTP_USER_AGENT']))) { ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php } ?>
<?php

        /*below goes on every page if you want it to work!*/

	if(!isset($_SERVER['DOCUMENT_ROOT'])){ if(isset($_SERVER['SCRIPT_FILENAME'])){
$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr($_SERVER['SCRIPT_FILENAME'], 0, 0-strlen($_SERVER['PHP_SELF'])));
}; };
if(!isset($_SERVER['DOCUMENT_ROOT'])){ if(isset($_SERVER['PATH_TRANSLATED'])){
$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr(str_replace('\\\\', '\\', $_SERVER['PATH_TRANSLATED']), 0, 0-strlen($_SERVER['PHP_SELF'])));
}; };


        require_once ($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'library' . DIRECTORY_SEPARATOR . 'bootstrap.php');
        require_once (ROOT . DS . 'header.php');

        $user_ID_array =  TC_Authenticator::getUserIDAndInitialize();
        $user_ID = $user_ID_array[0];

?>

<!-- Latest compiled and minified CSS -->
    <!--<link rel="stylesheet" href="/public/vendor/bootstrap/css/bootstrap.min.css">-->

        <!-- Optional theme -->
        <!--<link rel="stylesheet" href="/public/vendor/bootstrap/css/bootstrap-theme.min.css"> -->

        <!-- Latest compiled and minified JavaScript -->
    <!--<script src="/public/vendor/bootstrap/js/bootstrap.min.js"></script>-->

    <style type="text/css" media="screen">

        #catalog-page .clearfix:after {
           content: " ";
           display: block;
           height: 0;
           clear: both;
        }

        #catalog-page .button{
            -webkit-border-radius: 10px;
            -moz-border-radius: 10px;
            border-radius: 10px;
            background: #8600E3;
        }

        #catalog-page .highlightText{
            color:#8600E3;
        }


        #catalog-page .navIndex ul#navigation{
            margin:inherit !important;
        }

        #catalog-page{
            margin: 0 auto;
            width: 960px;
            background: #F4F4F4;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;

            box-shadow: 0 3px 7px 0 #e9e9e9;
        }

        #catalog-page .layout-container{
            float: left;
        }

        #catalog-page div{

        }
        #catalog-page  a {
            color: #666;
            /*color: #8600E3 !important;*/
        }
        #catalog-page h1 {
            font-size: 14px !important;
            color: #666 !important;
            line-height: inherit !important;
            border-bottom:none !important;
        }

        #catalog-page #catalog-content{
            width: 680px;
            background: #FFF;

        }

        #catalog-page #catalog-content-results-header{
            position:relative;
        }

        #catalog-page #catalog-content-sort{
            line-height:30px;
            /*-webkit-border-top-left-radius: 10px;
            -moz-border-top-left-radius: 10px;
            border-top-left-radius: 10px;*/
            -webkit-border-top-right-radius: 10px;
            -moz-border-top-right-radius: 10px;
            border-top-right-radius: 10px;
            padding:5px 0 0 5px;
            border-top: 1px solid #e9e9e9;
            border-right: 1px solid #e9e9e9;
            width: 350px;
            margin-bottom:5px;
            position:relative;
            top:7px;
            background: #fff;
        }
        #catalog-page #catalog-content #catalog-content-sort > *{
            margin-left:8px;
        }
        #catalog-page #catalog-content-sort-select{
            display:inline-block;
            vertical-align: top;
        }
        #catalog-page #catalog-content-sort-submit{
            display:inline-block;
            text-align:center;
            vertical-align: top;
            padding: 1px 8px;
        }
        #catalog-page #catalog-content-sort label{
            color:#8600E3;
            font-size:12px;
            display:inline-block;
            cursor:auto;
        }


        #catalog-page #catalog-content-results{
            border-top:solid 1px #e9e9e9;
        }

        #catalog-page #catalog-content-top-pagination{
            position:absolute;
            top:0px;
            right:0px;
            width:300px;
            padding:0;
            margin:0;
        }

        #catalog-page #catalog-content-top-pagination input[type=text]{
            width: 50px;
        }
        #catalog-page #catalog-content-top-pagination *{
            padding:0 5px;
        }

        #catalog-page #catalog-content-top-pagination #catalog-pagination-submit{
            padding:5px;
        }

        #catalog-page #catalog-content .pagination{
            clear:both;
            text-align: center;
            padding:10px;


        }
        #catalog-page #catalog-content .pagination a{
            padding: 5px;
            font-weight: bold;
            font-family: sans-serif;
            border:solid 1px #e9e9e9;

        }

        #catalog-page #catalog-sidebar{
            width: 260px;
            padding: 20px 10px;


        }
        #catalog-page .pageList{
            -webkit-border-radius: 10px;
            -moz-border-radius: 10px;
            border-radius: 10px;
            background: #fff;
            box-shadow: 0 3px 7px 0 #e9e9e9;
            padding:10px;

        }
        #catalog-page .pageList ul{
            list-style: none;
            padding: 0;
        }
        #catalog-page .pageList h2{
            font-size:14px ;
            font-weight: normal;
            color:#666;
            padding:0px;
            margin:0px;
        }
        #catalog-page .pageList div.description{
            padding:4px;
            font-weight: 200;
            font-size: 11px;
            font-style: italic;
            color: #666;

        }
        #catalog-page #catalog-search{
            line-height: 15px;
            vertical-align: middle;
            text-align: right;
        }
        #catalog-page #catalog-search input{
            /*-webkit-border-radius: 20px;*/
            /*-moz-border-radius: 20px;*/
            /*border-radius: 20px;*/
            /*border:1px solid #8600E3;*/
            background-color:#FFFFFF;
            /*width: 180px;*/
            display:inline-block;

        }

        #catalog-page #catalog-search .button {
            height: 20px;
            padding:7px 5px 3px 7px;
            margin-top: 0px;
            display:inline-block;
            vertical-align: top;
            text-align:center;
            background-color: #8600E3;
        }

        #catalog-page .pageList ul li {
            text-align: left;

        }

        #catalog-page .pageList ul li div.button {
            background-color: #8600E3;
            text-align: right;

        }

        #catalog-page #catalog-search .button:hover {
            background: #666;
        }


        #catalog-page .catalog-content-result{
            width:320px;
            height: 230px;
            float:left;
            margin-left: 7px;
            margin-bottom: 5px;
            position:relative;
            padding:5px;
            font-size:12px;
            box-shadow: 0 3px 7px 0 #e9e9e9;

            position:relative;

        }

        #catalog-page .catalog-content-result .button{
            width:42%;
            text-align: center;
            font-size:14px;
            font-weight: bold;
            position: relative;
            margin-top:10px;
        }

        #catalog-page .catalog-content-result .preview, #catalog-page .pageList .preview{
            background:url('/public/images/eye-over.png' ) no-repeat 8px 10px #666;
            min-width: 85px;
            bottom:4px;
        }
        #catalog-page .catalog-content-result .preview:hover, #catalog-page .pageList .preview:hover{
            background:url('/public/images/eye.png' ) no-repeat 8px 10px #8600E3;

        }
        #catalog-page .catalog-content-result .follow, #catalog-page .pageList .follow{
            background:url('/public/images/addWidget2.png' ) no-repeat 13px 9px #666;
            min-width: 85px;
            bottom:4px;
            right: 0px;
        }
        #catalog-page .catalog-content-result .follow:hover, #catalog-page .pageList .follow:hover{
            background:url('/public/images/addWidget2.png' ) no-repeat 13px -34px #8600E3;

        }

        #catalog-page .catalog-content-result .heading{

        }

        #catalog-page .catalog-content-result .image{

        }
        #catalog-page .catalog-content-result h1{
            margin:0px;
            float:left;
            width:220px;
            min-height: 50px;
            display: table-cell;
            vertical-align: middle;

        }
        #catalog-page .catalog-content-result .rating{
            float:right;
            width:90px;

        }
        #catalog-page .catalog-content-result .rating img{
            height: 15px;
            width: 15px;
        }
        #catalog-page .catalog-content-result .users{
            width:90px;
            font-style: italic;
            font-size:11px;
            color: #333;
            float:right;
        }

        #catalog-page .catalog-content-result .description{
            font-style: italic;
            font-size:11px;
            color: #333;
            min-height:90px;
            overflow:hidden;
        }

        #catalog-page .catalog-content-result .tags{
            font-weight: bold;

        }

        #catalog-page .catalog-content-result .admins{

        }
        #catalog-page .catalog-content-result .admins a{
            font-size:12px;
        }

        .tagCloud a
        {
            margin-right:8px;
            float: left;
        }

        .tagCloud{
            float: left;
            margin-bottom:10px;
        }

        .tags a{
            padding-right:5px;
        }

    </style>


    <div id="catalog-page" class="clearfix">

        <div id="catalog-sidebar" class="layout-container">
<?php
$latestArray = TC_Utility::getCatalogPagesDataArray(array(
                                                // 'pageNum' => 1,
                                                'isPaged' => false,
                                                'orderBy' => ValidCatalogOrderTypes::RECENCY
                                                  ));

        render(CONTAINER_VIEW_PATH,
                'CatalogMainSidebar.php',
                $latestArray
        );
?>
        </div>



        <div id="catalog-content" class="layout-container">


<?php
$dataArr = TC_Utility::getCatalogPagesDataArray();

// $pageCount = TC_Utility::getCatalogPageCount();


        render(CONTAINER_VIEW_PATH,
                'CatalogPanel.php',
                $dataArr
        );
?>
        </div>
            <!-- <div id="catalog-content-bottom-pagination" class="pagination">
                <a href="#">«</a>
                <a href="#">Previous</a>
                <a href="#">1</a>
                <a href="#">2</a>
                <a href="#">3</a>
                <a href="#">4</a>
                <a href="#">Next</a>
                <a href="#">»</a>
            </div> -->
        </div>



    </div>

    <input id="catalog-current-page-number" name="catalog-current-page-number" type="hidden" value="1" />
    <input id="catalog-current-tag-selections" name="catalog-current-tag-selections" type="hidden" value="" />
    <input id="catalog-current-search-term" name="catalog-current-search-term" type="hidden" value="" />
    <input id="catalog-current-order-by" name="catalog-current-order-by" type="hidden" value="<?php echo ValidCatalogOrderTypes::RECENCY;?>" />

<script type="text/javascript">

$.fn.tagcloud.defaults = {
  size: {start: 12, end: 24, unit: 'px'},
  color: {start: '#886A9C', end: '#8644E3'}
};




$(document).ready(function(){


    var catalogSearchTermsArray = new Array(
        {id:0,text:'* Loading Tags *'}
    );




    $('#catalog-search-tags').select2({
        minimumInputLength: 2,
        width: 'copy',
        multiple:true,
        data: function(){ return {results: catalogSearchTermsArray}; }
    });

    repopulateCorridorTagsInCatalog();

    $('#catalog-search-tags').on('select2-focus', function(e){

        repopulateCorridorTagsInCatalog();


    });

    function repopulateCorridorTagsInCatalog(){
        $.ajax({
            url: '<?php echo CORRIDOR_TAG_API_URL ;?>',
            data: {
            },
            dataType: 'json',
            success: function(data) {
                catalogSearchTermsArray = _.map(data.tags, function(term, key){
                    return { id: data.ids[key], text: term};
                });
                if($('#catalog-tagCloud').is(':empty'))
                {
                    // $('.tagCloud').html('');
                    var randomList = [];
                    var randomResults = [];
                    while(randomList.length < 15)
                    {
                        var random = catalogSearchTermsArray[Math.floor(Math.random() * catalogSearchTermsArray.length)];
                        // catalogSearchTermsArray[Math.floor(Math.random() * catalogSearchTermsArray.length)]
                        if(randomList.indexOf(random.id) == -1)
                        {
                            randomResults.push(random);
                            randomList.push(random.id);
                        }
                    }
                    // console.log(catalogSearchTermsArray);
                    // randomResults.push(catalogSearchTermsArray[31]);
                    var tagIds = JSON.stringify(randomResults);
                    // getTagCount
                    $.ajax({
                        url: '../../bll/ajaxhandlers/getTagCount.php',
                        data: {
                            tag_ids: tagIds
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                        },
                        success: function(data2){
                            var resultsArr = JSON.parse(data2);
                            _.each(randomResults, function(entry){
                                $('.tagCloud').append('<a rel="'+ resultsArr[entry.id] +'" href="#" class="catalogTag" data-tagid="' + entry.id + '">'+ entry.text +'</a>');
                            });
                            $('.tagCloud a').tagcloud();
                        }
                    });


                }

            }
        });
    }

    function resetInputs(){
        $('#catalog-current-page-number').val(1);
        $('#catalog-current-search-term').val('');
        $('#catalog-current-order-by').val('"<?php echo ValidCatalogOrderTypes::RECENCY;?>');
        $('#catalog-current-tag-selections').val('');
    }

    function resetSearchFields(){
        $('#catalog-search-text').val('');
        $('#catalog-search-tags').select2('val', '');
    }

    function resetCatalog(){
        resetInputs();
        resetSearchFields();
    }

    function reloadCatalogPanel(){
        $('#catalog-content').fadeOut('400', function() {
            $('#catalog-content').html('<div style="height:600px"><img src="/public/images/loading.gif" style="position:absolute; top:40%; left:42%;" /></div>');
            $('#catalog-content').fadeIn('400', function() {

            });
        });
        var user_id = '<?php echo $user_ID;?>';
        var pageNum = $('#catalog-current-page-number').val();
        var searchTerm = $('#catalog-current-search-term').val();
        var orderBy = $('#catalog-current-order-by').val();
        var tag_ids = $('#catalog-current-tag-selections').val();

        $.ajax({
            url: '../../bll/ajaxhandlers/loadCatalogPanel.php',
            data: {
                user_id: user_id,
                pageNum: pageNum,
                searchTerm: searchTerm,
                orderBy: orderBy,
                tag_ids: tag_ids
            },
            dataType : 'text',
            timeout: 0,
            error: function(jqXHR, textStatus, errorThrown) {
            },
            success: function(data){
                $('#catalog-content').fadeOut('400', function() {
                    $('#catalog-content').html(data);
                    $('#catalog-content').fadeIn('400', function() {

                    });
                });

                $.ajax({
                    url: '../../bll/ajaxhandlers/loadCatalogNewestWidget.php',
                    data: {
                    },
                    timeout: 0,
                    dataType : 'text',
                    error: function(jqXHR, textStatus, errorThrown) {
                    },
                    success: function(data3){
                        $('.pageList').html(data3);
                    }
                });

                $.ajax({
                    url: '../../bll/ajaxhandlers/loadDashboardNav.php',
                    data: {
                        user_ID: user_id
                    },
                    timeout: 0,
                    dataType : 'text',
                    error: function(jqXHR, textStatus, errorThrown) {
                    },
                    success: function(data2){
                        $('#navdiv').html(data2);
                    }
                });

                // $.ajax({
                //     url: '../../bll/ajaxhandlers/loadCatalogMainSidebar.php',
                //     data: {
                //         user_id: user_id,
                //         searchTerm: searchTerm,
                //         tag_ids: tag_ids
                //     },
                //     timeout: 0,
                //     dataType : 'text',
                //     error: function(jqXHR, textStatus, errorThrown) {
                //     },
                //     success: function(data2){
                //         $('#navdiv').html(data2);
                //     }
                // });


                var tagSelections = JSON.parse( $('#catalog-current-tag-selections').val() );
                tagSelections = tagSelections || [];
                $('#catalog-search-tags').select2('val', tagSelections);




                // $('#catalog-search-tags').val($('#catalog-current-tag-selections').val());

            }
        });
    }





    $('#previewTabDialogBox').dialog(
            {
                autoOpen: false,
                draggable:false,
                modal:true,
                width:1000,
                height:600,
                title: 'Page Preview',
                open: function(event, ui){
                    var entity_ID = $(this).data("entity_id");
                    var subscribed = $(this).data('subscribed');
                    var unsubPreviewButtons = [
                                {
                                    text: "Subscribe",
                                    click: function(){
                                        $.ajax({
                                            url: '../../bll/ajaxhandlers/subscribeToDashboard.php',
                                            contentType: "text/plain",
                                            dataType : 'text',
                                            data: {
                                                user_ID: '<?php echo $user_ID;?>',
                                                entity_ID: entity_ID,
                                                isActive: subscribed
                                            },
                                            success: function(data){
                                                var newContId = parseInt(data);
                                                if(isNaN(newContId))
                                                {
                                                    alertUserPubMax();
                                                }
                                                reloadCatalogPanel();
                                            }
                                        });
                                        $(this).dialog("close");
                                    }
                                },
                                {
                                    text: "Close",
                                    click: function(){$(this).dialog("close");}
                                }];

                    var subPreviewButtons = [

                                {
                                    text: "Close",
                                    click: function(){$(this).dialog("close");}
                                }];
                    if(subscribed == 0)
                    {
                        $(this).dialog("option", "buttons", subPreviewButtons);

                        // $(this).find('.ui-dialog-buttonpane').find('button:first').attr('disabled','disabled');
                        // // $(this).find('.ui-button:contains(Subscribe)').attr('disabled', 'disabled');

                        // var buttons = $(this).dialog('option', 'buttons');
                        // _.each(buttons, function(button){
                        //     if(button.text == 'Subscribe')
                        //     {

                        //         console.log(button);
                        //         // button.hide();
                        //     }
                        //     // console.log(button);
                        // });
                        // console.log(buttons);
                        // $('.ui-button:contains(Export)').hide()
                    }
                    else {
                        $(this).dialog("option", "buttons", unsubPreviewButtons);

                    }
                    $('#tabPreviewContent *').unbind();
                    $('#tabPreviewContent *').die();
                    $('#tabPreviewContent').empty();
                    $('#tabPreviewContent').html('<div style="height:600px"><img src="/public/images/loading.gif" style="position:absolute; top:40%; left:42%;" /></div>');
                    $.ajax({
                        url: '../../bll/ajaxhandlers/loadDashboardPreview.php',
                        data: {
                        entity_ID: entity_ID,
                        user_ID: '<?php echo $user_ID;?>'
                        },
                        dataType : 'text',
                        error: function(jqXHR, textStatus, errorThrown) {
                        },
                        success: function(data2){
                        $('#tabPreviewContent *').unbind();
                        $('#tabPreviewContent *').die();
                        $('#tabPreviewContent').empty();
                        $('#tabPreviewContent').html(data2);

                        // contentEdit = undefined;


                        }

                    });
                }
            }
    );

    $('.previewPageButton').live('click', function(){
        var entity_id = $(this).data("entityid");
        var subscribed = $(this).data('subscribed');
        $("#previewTabDialogBox").data('entity_id', entity_id);
        $("#previewTabDialogBox").data('subscribed', subscribed);
        $("#previewTabDialogBox").dialog('open');
    });

    $('.subscribePageButton').live('click', function(){
        var entity_id = $(this).data("entityid");
        var isActive = $(this).data('subscribed');
        $.ajax({
            url: '../../bll/ajaxhandlers/subscribeToDashboard.php',
            contentType: "text/plain",
            dataType : 'text',
            data: {
                user_ID: '<?php echo $user_ID;?>',
                entity_ID: entity_id,
                isActive: isActive
            },
            success: function(data){
                var newContId = parseInt(data);
                if(isNaN(newContId))
                {
                    alertUserPubMax();
                }
                reloadCatalogPanel();
            }
        });


    });





    $('.catalogTag').live('click', function(e){

        var tag_id = $(this).data("tagid");
        var tagArr = [tag_id];
        var tag_ids = JSON.stringify(tagArr);
        $('#catalog-current-tag-selections').val(JSON.stringify(tagArr));
        $('#catalog-current-page-number').val(1);
        $('#catalog-current-search-term').val('');


        reloadCatalogPanel();
        // $.ajax({
        //     url: '../../bll/ajaxhandlers/loadCatalogPanel.php',
        //     data: {
        //         user_id: '<?php echo $CatalogPanel_user_id ;?>',
        //         pageNum: $('#catalog-current-page-number').val(),
        //         searchTerm: $('#catalog-current-search-term').val(),
        //         orderBy: $('#catalog-current-order-by').val(),
        //         tag_ids: $('#catalog-current-tag-selections').val(),

        //     },
        //     success: function(data){
        //         $('#catalog-content').html(data);
        //     }
        // });
        // $("#previewTabDialogBox").data('tag_id', tag_id);

    });


    $('#catalog-search-submit').live('click',function(e){
        $('#catalog-current-tag-selections').val($('#catalog-search-tags').val());
        var tags = $('#catalog-current-tag-selections').val() ? $('#catalog-current-tag-selections').val().split(',') : null;
        var tag_ids = JSON.stringify(tags);



        $('#catalog-current-tag-selections').val(tag_ids);
        $('#catalog-current-page-number').val(1);
        $('#catalog-current-search-term').val($('#catalog-search-text').val());
        reloadCatalogPanel();
    });


        // $('.catalog-navigation-pagenum').live('click', function(){
        //     var pageNumArr = $(this).attr('id').split('-');
        //     var nextPage = pageNumArr[pageNumArr.length - 1];
        //     $('#catalog-current-page-number').val(nextPage);
        //     reloadCatalogPanel();
        // });

        // $('#catalog-navigation-first').live('click', function(){
        //     $('#catalog-current-page-number').val(1);
        //     reloadCatalogPanel();
        // });

        // $('#catalog-navigation-forward').live('click', function(){
        //     var nextPage = isNaN(parseInt('<?php echo $CatalogPanel_pageNum ;?>')) ? 1 : parseInt('<?php echo $CatalogPanel_pageNum ;?>') + 1;
        //     $('#catalog-current-page-number').val(nextPage);
        //     reloadCatalogPanel();
        // });

        // $('#catalog-navigation-last').live('click', function(){
        //     var nextPage = isNaN(parseInt('<?php echo $CatalogPanel_pageCount ;?>')) ? 1 : parseInt('<?php echo $CatalogPanel_pageCount ;?>');
        //     $('#catalog-current-page-number').val(nextPage);
        //     reloadCatalogPanel();
        // });

        // $('#catalog-navigation-back').live('click', function(){
        //     var nextPage = isNaN(parseInt('<?php echo $CatalogPanel_pageNum ;?>')) ?
        //         1 : parseInt('<?php echo $CatalogPanel_pageNum ;?>') > 1 ? parseInt('<?php echo $CatalogPanel_pageNum ;?>') - 1 : 1 ;
        //         $('#catalog-current-page-number').val(nextPage);
        //         reloadCatalogPanel();
        // });

        // $('#catalog-content-sort-select').live('change', function(){
        //     $('#catalog-current-page-number').val(1);
        //     $('#catalog-current-order-by').val($(this).val());
        //     reloadCatalogPanel();
        // });

});
</script>

<?php
        require('footer.php');
?>