<?php

    if(!isset($DashboardTabEdit_user_ID))
    {

        $DashboardTabEdit_user_ID = SYSTEM_USER_ID;
    }

    if(isset($DashboardTabEdit_entity))
    {
        $entity = $DashboardTabEdit_entity;
        $model = $entity->get_host();
        $model_id = $entity->get_host_id();
        // $accessprofile = new AccessProfile(ValidAccessProfiles::DASHBOARD_REORDER, ValidAccessTypes::REORDER, ValidAccessContexts::DASHBOARD, ValidAccessLevels::BASIC_ACCESS);
        $widgetsSimple = prioritySort(TC_Utility::getActiveWidgetsForDashboard($model_id));
    }
    else
    {
        $widgetIDs = null;
        $widgetsSimple = array();
    }


    /*
    if(!isset($DashboardTabEdit_entity_ID))
    {

        //throw new Exception("cannot load dashboard tab");
        $widgetIDs = null;
        $widgetsSimple = array();
    }
    else
    {
        if($DashboardTabEdit_model_ID)
        {
            $model_id = $DashboardTabEdit_model_ID;
        }
        else
        {
                $modelBuilder = new TC_DashboardTabBuilder($DashboardTabEdit_entity_ID);
                $model = $modelBuilder->getModel();
                $model_id = $modelBuilder->get_model_id();
        }



        $accessprofile = new AccessProfile(ValidAccessProfiles::DASHBOARD_REORDER, ValidAccessTypes::REORDER, ValidAccessContexts::DASHBOARD, ValidAccessLevels::BASIC_ACCESS);
        $widgetsSimple = prioritySort(TC_PersistenceUtility::getActiveWidgetsForDashboard($DashboardTabEdit_user_ID, $accessprofile, $model_id));
        unset($modelBuilder);

    }
    */
    if(!isset($DashboardTabEdit_entity_ID))
    {//return false;

    }

    $DashboardTabEdit_showPublish = $DashboardTabEdit_showPublish ? $DashboardTabEdit_showPublish : false;
    $DashboardTabEdit_showUnsub = $DashboardTabEdit_showUnsub ? $DashboardTabEdit_showUnsub : false;
    $DashboardTabEdit_showClone = $DashboardTabEdit_showClone ? $DashboardTabEdit_showClone : false;


    $externalWidgetList = array();
    $internalWidgetList = array();

    foreach(SidebarGrabber::getExternalSidebarWidgets() as $key => $value) {
        $externalWidgetList[$key]= $value;
    }
    foreach(SidebarGrabber::getInternalSidebarWidgets() as $key => $value) {
        $internalWidgetList[$key]= $value;
    }

    $EWL = prepareArrayForTransit($externalWidgetList);
    $IWL = prepareArrayForTransit($internalWidgetList);

    ?>


<div style="overflow:visible;" class="contentEditContainer" id="containerEdit-<?php echo $DashboardTabEdit_entity_ID; ?>">
            <?php

            if(isset($DashboardTabEdit_entity_ID))
            {
                for($columnIteration = 1; $columnIteration <= MAX_COLUMNS_PER_DASHBOARD__TAB; $columnIteration++)
                {
                ?>
                    <div id="column-<?php echo $columnIteration;?>" class="column <?php echo ($columnIteration == MAX_COLUMNS_PER_DASHBOARD__TAB)?' column-last':''; ?>" >


                <?php

                            //$colPriorities = array();
                            for($j = 1; $j <= MAX_DASHBOARD_WIDGETS_PER_TAB; $j++)
                            {
                                if(($j - $columnIteration) % MAX_COLUMNS_PER_DASHBOARD__TAB == 0)
                                {
                                    if(array_key_exists($j, $widgetsSimple))
                                    {
                                        $template = "TC_AmorphousFullSource_Default.php";
                                        $widgetValue = $widgetsSimple[$j];

                                        //$logID = logTiming(null,"full",null,null,1);
                                        render(WIDGET_EDIT_PATH, $template, array( 'containerEntity_ID' => $DashboardTabEdit_entity_ID, 'widgetEntity_ID' => $widgetValue->get_entity_id(), 'priority' => $widgetValue->get_dashboard_priority(), 'EWL' => $EWL, 'IWL' => $IWL, 'container_ID' => $model_id, 'widget' => $widgetValue->get_host()));
                                        //logTiming(null, null, 1, $logID);

                                    }
                                    else
                                    {
                                        $template = "TC_AmorphousEmptySource_Default.php";
                                        //echo $j;
                                        //$widgetValue = $widgetsSimple[$j];
                                        //$logID = logTiming(null,"empty",null,null,1);
                                        render(WIDGET_EDIT_PATH, $template, array('priority' => $j, 'containerEntity_ID' => $DashboardTabEdit_entity_ID, 'EWL' => $EWL, 'IWL' => $IWL, 'container_ID' => $model_id));
                                        //logTiming(null, null, 1, $logID);
                                    }
                                }
                            }


                ?>

                    </div>

                <?php
                }
            }
            else
            {
                echo '<div class="no_content_default">You must add a new page to begin customizing content.</div>';
            }
            ?>
    </div>

<div tabindex="0" class="button" id="doneCustomizationButton" name="doneCustomizationButton" style="float:right;margin-bottom: 10px;">
    View My Changes
</div>
<?php if(isset($DashboardTabEdit_entity_ID))
    { ?>
    <?php if($DashboardTabEdit_showClone)
        { ?>
<div tabindex="0" class="greybutton" id="shareTabButton" name="shareTabButton" style="float:right;margin-bottom: 10px; margin-right:10px;">
    Clone This Page
</div>
<?php } ?>

<?php if($DashboardTabEdit_showUnsub)
    { ?>
<div tabindex="1" class="greybutton" id="unsubscribeTabButton" name="unsubscribeTabButton" style="float:right;margin-bottom: 10px; margin-right:10px;">
    Unsubscribe This Page
</div>
<?php } ?>

<?php if($DashboardTabEdit_showPublish)
    { ?>
<div tabindex="1" class="greybutton" id="publishTabButton" name="publishTabButton" style="float:right;margin-bottom: 10px; margin-right:10px;">
    Publish This Page
</div>
<?php } ?>
<?php } ?>