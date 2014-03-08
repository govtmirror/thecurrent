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

        if(!isset($user_ID))
        {
            $user_ID_array =  TC_Authenticator::getUserIDAndInitialize();
            $user_ID = $user_ID_array[0];
        }


             ?>
<script type="text/javascript">
    $(document).ready(function(){

       startStopRefreshTimer(1);


       function reloadDashboardAndNav(entity_ID){
           // var containerEntityID = "<?php echo $updateId ; ?>";
           var userID = '<?php echo $user_ID;?>';
           // alert(entity_ID);
               $.ajax({
           //document.location.hostname+
                   url: 'bll/ajaxhandlers/loadDashboardContentAndNav.php',
                   data: {
                   entity_ID: entity_ID,
                   user_ID: userID
                   },
                   timeout: 0,
                   dataType : 'html',
                   error: function(jqXHR, textStatus, errorThrown) {
                       $('ul#navigation > li > a.current').click();
                   },
                   success: function(data){

                   //alert($(data).filter("#ajaxRenderNav").html());
                   $('#navdiv').html($(data).filter("#ajaxRenderNav").html());
                   $('#main').html($(data).filter("#ajaxRenderContent").html());




                   $(data).filter('script').each(function(){
                       $.globalEval(this.text || this.textContent || this.innerHTML || '');
                   });


                   // var currentSelected = $('#navdiv').find('.current').html();
                   // if(typeof currentSelected  == "undefined" || currentSelected  == null)
                   //         {
                   //             //alert('hi');
                   //             currentSelected = 'No Page Selected';
                   //         }
                   // $('.SelectedSourceTitle').html(currentSelected);





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
                                       text: "Update",
                                       click: function(){
                                           $.ajax({
                                               url: 'bll/ajaxhandlers/subscribeToDashboard.php',
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
                                                   reloadDashboardAndNav(entity_ID);
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
                       }
                       else {
                           $(this).dialog("option", "buttons", unsubPreviewButtons);

                       }
                       $('#tabPreviewContent *').unbind();
                       $('#tabPreviewContent *').die();
                       $('#tabPreviewContent').empty();
                       $('#tabPreviewContent').html('<div style="height:600px"><img src="/public/images/loading.gif" style="position:absolute; top:40%; left:42%;" /></div>');
                       $.ajax({
                           url: 'bll/ajaxhandlers/loadDashboardPreview.php',
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
               url: 'bll/ajaxhandlers/subscribeToDashboard.php',
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
                   reloadDashboardAndNav(entity_id);
               }
           });
       });

    });






</script>

       <div style="height:600px;">
           <img src="/public/images/loading.gif" style="position:absolute; top:40%; left:42%;" />
       </div>






        <?php
        require_once (ROOT . DS . 'footer.php');



        /////junk code below//////





        //echo VIEW_PATH;

        //$url = $_GET['url'];
        //require_once (ROOT . DS . 'library' . DS . 'bootstrap.php');
        /*
        $containers = unserialize(CONTAINERS_DBFIELDS);
        echo $containers['name'];
        $filt1 = new RepoStrategyFilter($containers['name'], 1, 'phil');
        $filt2 = new RepoStrategyFilter($containers['name'], 1, 'phil');
        $filt3 = new RepoStrategyFilter($filt1, 6, $filt2);
        $filt4 = new RepoStrategyFilter($filt3, 7, 'phil');
         *
         */

        //$filt1 = new RepoStrategyFilter($containers['name'], ValidSQLComparisons::EQUALS, 'phil');
        //$filt2 = new RepoStrategyFilter($containers['name'], ValidSQLComparisons::GREATER_OR_EQUAL, 'phil');
        //$filt3 = new RepoStrategyFilter($filt1, ValidSQLComparisons::AND_, $filt2);

        //$db = new PDO('currentsvc', 'currentsvc', 'P@ssword1', $options)
        //$ord = new RepoStrategyOrder(array($containers['name'] => 1));
        //echo $filt;
        //echo $filt->toSQL();
        //echo $filt->getColumn();
        //echo $filt->getOperator();
        //echo $filt->getParameter();
        //$rs = new DashboardWidgetStrategy();

        //$repo = new Repository($rs);
        //$tmp = $repo->getIDs();
        //print_r($tmp);
        //$widget = new GoogleRSSWidget('yahoo', 'yahoo search widget for president');
        //$widget->set_domain('yahoo.com');
        //$widget->set_search_term('president');
        //$dbEntity = new DatabaseEntity(WIDGETS);
        //$dbEntity->setHost($widget);


        //print_r($dbEntity);
        //$tmp = $repo->get();
        //print_r($tmp);

        //foreach($tmp as $value)
        //{
            //print_r($value);
            //echo '<br />';

       //     $tmpob = $value->getHost();
       //     if($tmpob instanceof DashboardWidget)
       //     {
               //print_r($tmpob);

                //$value->setIsDirty(true);

       //     }

            //echo $tmpob->get_search_term();
            //print_r($tmpob);
            /*
            print_r($tmpob->returnProperties());
            echo '<br />';
            foreach($tmpob as $thing)
            {
               // echo $thing;
            }
             */
       // }
        //$repo->emptyPool();
       // $repo->loadEntity($dbEntity);

       // print_r($repo->pool);
        //$repo->setPool($tmp);
        //$repo->save(array('container_id' => 1));

        //$url = 'http://feeds.gawker.com/kotaku/vip';
        //$rss = fetch_rss($url);

        //foreach($rss->items as $item)
        //{
        //    echo $item['link'];
        //    echo ' - ';
        //    echo $item['title'];
        //}




        //echo $tmpob->get_domain();
        //echo $repo->get();
        //echo ROOT;
        //echo $_SERVER['DOCUMENT_ROOT'];

        //render(CONTAINER_VIEW_PATH,'GenericTab.php',array('dog' => 1, 'cat => 2'));
        //$thing = new TC_Region();

        //$thing2 = new DatabaseEntity();
        //$thing2->setHost($thing);

        //echo regions;
        //require_once 'config/TC_MySQLAdapter.class.php';

        //echo ((array)unserialize(WIDGETS_DBFIELDS));

        //print_r(MySQLConfig::getTables());

        /*
        $containers = unserialize(CONTAINERS_DBFIELDS);
        $containerTypes = unserialize(CONTAINERTYPES_DBFIELDS);
        $containersFieldsValues = unserialize(CONTAINERS_FIELDS_VALUES_DBFIELDS);
        $containerFields = unserialize(CONTAINERPARAMFIELDS_DBFIELDS);
        $containerValues = unserialize(CONTAINERPARAMVALUES_DBFIELDS);
        //unserialize(CONTAINERS)['']
        $query = "SELECT * FROM ".DB_NAME.".".CONTAINERS.
        " INNER JOIN ".DB_NAME.".".CONTAINERTYPES.
        " ON ".DB_NAME.".".$containers['type_id']." = ".DB_NAME.".".$containerTypes['id'].
        " INNER JOIN "
        ;
        echo $query;
        */

        //$db->query('SELECT * FROM containers');
        //$row = $db->fetch();




?>



