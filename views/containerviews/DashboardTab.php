<?php

if(!isset($DashboardTab_user_ID))
{

    $DashboardTab_user_ID = SYSTEM_USER_ID;
}

if(isset($DashboardTab_entity))
{
    $entity = $DashboardTab_entity;
    $model = $entity->get_host();
    $model_id = $entity->get_host_id();
    $widgetsSimple = prioritySort(TC_Utility::getActiveWidgetsForDashboard($model_id));



}
else
{
    $widgetIDs = null;
    $widgetsSimple = array();
}
    /*
if(!isset($DashboardTab_entity_ID))
{

    //throw new Exception("cannot load dashboard tab");
    $widgetIDs = null;
    $widgetsSimple = array();
}

else
{
    //echo $DashboardTab_model_ID;
    if($DashboardTab_model_ID)
    {
        $model_id = $DashboardTab_model_ID;
    }
    else
    {
            $modelBuilder = new TC_DashboardTabBuilder($DashboardTab_entity_ID);
            $model = $modelBuilder->getModel();
            $model_id = $modelBuilder->get_model_id();
    }

    $widgetsSimple = prioritySort(TC_PersistenceUtility::getActiveWidgetsForDashboard($DashboardTab_user_ID, new TC_DefaultAccessProfile(), $model_id));

    //echo "<pre>";
    //var_dump($widgetsSimple);
    //echo "</pre>";
    //echo get_class(array_pop($whatever)->get_host());

    //$widgetsSimple = TC_PersistenceUtility::prioritySortIds(TC_PersistenceUtility::getActiveWidgetIDsForDashboard($DashboardTab_user_ID, new TC_DefaultAccessProfile(), $modelBuilder->get_model_id()));


    unset($modelBuilder);
}
*/

?>



            <?php
            // echo 'hi';
            if($DashboardTab_updateAvailable)
            {
                ?>
                <div class="dashboard-pageUpdateAvailable">
                    An update is available for this Page.
                    <div class="button preview previewPageButton" data-entityid="<?php echo $DashboardTab_updateId ; ?>">Preview</div>
                    <div class="button follow subscribePageButton" data-entityid="<?php echo $DashboardTab_updateId ; ?>" data-subscribed="1">
                        Update
                    </div>
                </div>
                <?php
                //$DashboardTab_updateId
            }

            if(!empty($widgetsSimple))
            {
                //$widgetIteration = 0;
                for($columnIteration = 1; $columnIteration <= MAX_COLUMNS_PER_DASHBOARD__TAB; $columnIteration++)
                {
                ?>
                    <div id="column-<?php echo $columnIteration;?>" class="column <?php echo ($columnIteration == MAX_COLUMNS_PER_DASHBOARD__TAB)?' column-last':''; ?>" >

                <?php
                            foreach($widgetsSimple AS $widgetPriority => $widgetValue)
                            {
                                if(($widgetPriority - $columnIteration) % MAX_COLUMNS_PER_DASHBOARD__TAB == 0)
                                {
                                    $hostTemp = $widgetValue->get_host();
                                    $template = get_class($hostTemp)."_".$hostTemp->get_viewtype().".php";
                                    // echo $template . " - ";
                                    // echo $widgetValue->get_host_id() . " - ";
                                    // echo $widgetValue->get_entity_id() . " - ";
                                    // var_dump($hostTemp);
                                    //$logID = logTiming(null,"test",null,null,1);
                                    render(WIDGET_VIEW_PATH, $template, array('widget_ID' => $widgetValue->get_host_id(), 'widgetEntity_ID' => $widgetValue->get_entity_id(), 'widget' => $hostTemp));
                                    //logTiming(null, null, 1, $logID);
                                    //echo $widgetValue['id'];
                                    //unset($widgetsSimple[$widgetPriority]);
                                }
                                //$widgetIteration++;

                            }

                ?>

                    </div>
                <?php
                }
            }
            else
            {
                echo '<div class="no_content_default">You must add custom sources to see content inside this page.</div>';
            }
            ?>


