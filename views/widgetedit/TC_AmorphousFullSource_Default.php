<?php


if(!isset($TC_AmorphousFullSource_Default_widgetEntity_ID))
{
    
    throw new Exception("cannot load Amorphous widget.");
    
}
if(!isset($TC_AmorphousFullSource_Default_priority))
{
    throw new Exception("cannot load dashboard page");
}
if(!isset($TC_AmorphousFullSource_Default_containerEntity_ID))
{
    throw new Exception("cannot load dashboard page");
}
if(!isset($TC_AmorphousFullSource_Default_IWL))
{
    throw new Exception("cannot load dashboard page");
    
}
else
{
    $internalWidgetList = deconstructArrayForTransit($TC_AmorphousFullSource_Default_IWL);
    
}

if(!isset($TC_AmorphousFullSource_Default_EWL))
{
    throw new Exception("cannot load dashboard page");
    
}
else
{
    $externalWidgetList = deconstructArrayForTransit($TC_AmorphousFullSource_Default_EWL);
    
}

if(isset($TC_AmorphousFullSource_Default_widget))
{
    $model = $TC_AmorphousFullSource_Default_widget;
}
else
{
    $modelBuilder = new TC_AmorphousFullSource_Builder($TC_AmorphousFullSource_Default_widgetEntity_ID);
    $model = $modelBuilder->getModel();
    unset($modelBuilder);
    
}



//$logID = logTiming(null,"test",null,null,1);
//$modelBuilder = new TC_DashboardTabBuilder($TC_AmorphousFullSource_Default_containerEntity_ID);
//$model2 = $modelBuilder->getModel();
//$container_ID = $modelBuilder->get_model_id();

//unset($model2);
//logTiming(null, null, 1, $logID);
?>

<div class="widget delete" id="widget-<?php echo $TC_AmorphousFullSource_Default_widgetEntity_ID; ?>" name="widget-<?php echo $TC_AmorphousFullSource_Default_widgetEntity_ID; ?>" >
    <input type="hidden" value="<?php echo $TC_AmorphousFullSource_Default_container_ID; ?>" class="containerID" id="container_id-<?php echo $TC_AmorphousFullSource_Default_widgetEntity_ID; ?>" name="container_id-<?php echo $TC_AmorphousFullSource_Default_widgetEntity_ID; ?>" />
    <input type="hidden" value="<?php echo $TC_AmorphousFullSource_Default_widgetEntity_ID; ?>" class="widgetID" id="widget_id-<?php echo $TC_AmorphousFullSource_Default_widgetEntity_ID; ?>" name="widget_id-<?php echo $TC_AmorphousFullSource_Default_widgetEntity_ID; ?>" />
    <input type="hidden" value="<?php echo $TC_AmorphousFullSource_Default_priority; ?>" class="widgetPriority" id="priority-<?php echo $TC_AmorphousFullSource_Default_widgetEntity_ID; ?>" name="priority-<?php echo $TC_AmorphousFullSource_Default_widgetEntity_ID; ?>" />
    
    <div id="alpha_wrapper">
        <div id="alpha_2"></div>
        <div id="text_holder_2">
            <div class="widgetHeader">
                <h1><?php echo stripSlashesDeep($model->get_title()) ;?></h1><span tabindex="0" id="delete_widget-<?php echo $TC_AmorphousFullSource_Default_widgetEntity_ID; ?>" class="deleteWidgetButton tooltip" title="Delete this source"><span class="tttext classic">Delete this source</span></span><div  id="edit_widget-<?php echo $TC_AmorphousFullSource_Default_widgetEntity_ID; ?>" class="editWidgetButton"><div tabindex="0" class="iconEditWidgetButton tooltip" title="Edit this source"><span class="tttext classic">Edit this source</span></div><ul>
                    <li>
                        <ul class="widgetSelect">
                            <li class="dropdownHeaderLi" style="border-bottom:none;"><span class="dropdownHeader"  >- Change Grid Position -</span></li>
                            <li class="gridSelectionLi"><div>
                                <table cellspacing="3px" class="widgetPositionTable dropdownHeader">
                                    <?php 
                                        for($j = 0; $j < ceil(MAX_DASHBOARD_WIDGETS_PER_TAB/MAX_COLUMNS_PER_DASHBOARD__TAB); $j++ )
                                        {
                                            ?><tr><?php
                                            for($i = 1; $i <= MAX_COLUMNS_PER_DASHBOARD__TAB; $i++)
                                            {
                                    ?>
                                              <td tabindex="0" class="widgetPrioritySelect <?php if($TC_AmorphousFullSource_Default_priority == ( $j * MAX_COLUMNS_PER_DASHBOARD__TAB + $i)){ echo "widgetPositionSlotSelected";} ?>">
                                                  <input class="widgetPrioritySelectInput" type="hidden" value="<?php echo $j*MAX_COLUMNS_PER_DASHBOARD__TAB + $i ;?>" />
                                              </td>  
                                    <?php
                                            }
                                            ?></tr><?php
                                        }
                                    ?>
                                    
                                </table>
                                    </div>
                                </li>
                                <li class="dropdownHeaderLi"><div class="dropdownHeader">- Custom Sources -</div></li>
                                
                            <li><a class="widgetSelection customWidget DirectRSS" id="dashboardwidget-custom-DirectRSS-<?php echo $TC_AmorphousFullSource_Default_container_ID .'-' . $TC_AmorphousFullSource_Default_priority; ?>" href="#">RSS Feed</a>
                                <?php if(get_class($model) == 'TC_GenericRSSSource'){ ?>
                                <input type="hidden" class="savedDirectInternalTitle" value="<?php echo htmlspecialchars(stripSlashesDeep($model->get_title())) ;?>" />
                                <input type="hidden" class="savedDirectInternalLink" value="<?php echo $model->get_link() ;?>" />
                                <?php } ?>
                            </li>
                            
                            <li><a class="widgetSelection customWidget GoogleSearchFeed" id="dashboardwidget-custom-GoogleSearchFeed-<?php echo $TC_AmorphousFullSource_Default_container_ID .'-' . $TC_AmorphousFullSource_Default_priority; ?>" href="#">Website Search</a>
                                <?php if(get_class($model) ==  'TC_GoogleRSSSource'){ ?>
                                <input type="hidden" class="savedCustomDomainSearchTitle" value="<?php echo htmlspecialchars(stripSlashesDeep($model->get_title())) ;?>" />
                                <input type="hidden" class="savedCustomDomainSearchDomain" value="<?php echo $model->get_domain() ;?>" />
                                <input type="hidden" class="savedCustomDomainSearchSearchTerm" value="<?php echo htmlspecialchars($model->get_search_term()) ;?>" />
                                <?php } ?>
                            </li>
                            
                            
                            <li><a class="widgetSelection customWidget GoogleNewsSearchFeed" id="dashboardwidget-custom-GoogleNewsSearchFeed-<?php echo $TC_AmorphousFullSource_Default_container_ID .'-' . $TC_AmorphousFullSource_Default_priority; ?>" href="#">News Search</a>
                                <?php if(get_class($model) == 'TC_GoogleRSSSource'){ ?>
                                <input type="hidden" class="savedCustomDomainSearchTitle" value="<?php echo htmlspecialchars(stripSlashesDeep($model->get_title())) ;?>" />
                                <input type="hidden" class="savedCustomDomainSearchSearchTerm" value="<?php echo htmlspecialchars($model->get_search_term()) ;?>" />
                                <?php } ?>
                            </li>
                            <li><a class="widgetSelection customWidget YoutubeSearchFeed" id="dashboardwidget-custom-YoutubeSearchFeed-<?php echo $TC_AmorphousFullSource_Default_container_ID .'-' . $TC_AmorphousFullSource_Default_priority; ?>" href="#">Youtube Search</a>
                                <?php if(get_class($model) == 'TC_YoutubeMediaSearchSource'){ ?>
                                <input type="hidden" class="savedCustomDomainSearchTitle" value="<?php echo htmlspecialchars(stripSlashesDeep($model->get_title())) ;?>" />
                                <input type="hidden" class="savedCustomDomainSearchSearchTerm" value="<?php echo htmlspecialchars($model->get_q()) ;?>" />
                                <?php } ?>
                            </li>
                            <li><a class="widgetSelection customWidget CorridorUserFeed" id="dashboardwidget-custom-CorridorUserFeed-<?php echo $TC_AmorphousFullSource_Default_container_ID .'-' . $TC_AmorphousFullSource_Default_priority; ?>" href="#">Corridor Feed (Chrome)</a>
                                <?php if(get_class($model) == 'TC_CorridorUserSource'){ ?>
                                <input type="hidden" class="savedCorridorSourceTitle" value="<?php echo htmlspecialchars(stripSlashesDeep($model->get_title())) ;?>" />
                                <input type="hidden" class="savedCorridorSourceContentType" value="<?php echo htmlspecialchars($model->get_content_type()) ;?>" />
                                <input type="hidden" class="savedCorridorSourceGroup" value="<?php echo htmlspecialchars($model->get_groupID()) ;?>" />

                                    <?php } ?>
                            </li>
                            <li><a class="widgetSelection customWidget SMARTSearchFeed" id="dashboardwidget-custom-SMARTSearchFeed-<?php echo $TC_AmorphousFullSource_Default_container_ID .'-' . $TC_AmorphousFullSource_Default_priority; ?>" href="#">SMART Feed (Chrome)</a>
                                <?php if(get_class($model) == 'TC_SMARTSource'){ ?>
                                <input type="hidden" class="savedSMARTSearchSourceTitle" value="<?php echo htmlspecialchars(stripSlashesDeep($model->get_title())) ;?>" />
                                <input type="hidden" class="savedSMARTSearchSourceSearchTerm" value="<?php echo htmlspecialchars($model->get_terms()) ;?>" />
                                <?php } ?>
                            </li>
                            
                            
                            
                            <li class="dropdownHeaderLi"><div class="dropdownHeader">- Default Internal Sources -</div></li>
                            <?php 
                            foreach ( $internalWidgetList as $key => $value)
                            {
                                $qString = '';
                                $set = $value->get_properties();                                
                                $qString = addslashes(serialize($set));
                            ?>

                            <li><a class="widgetSelection defaultWidget" id="dashboardwidget-<?php echo $TC_AmorphousFullSource_Default_priority . '-' . $key . '-' . 'i'; ?>" href="#"><?php echo $value->get_title(); ?></a>
                                <input type="hidden" value="<?php echo htmlentities($qString, ENT_QUOTES); ?>" class="widgetParamString"  />
                                <input type="hidden" value="<?php echo $value->get_dashboardModel(); ?>" class="widgetType"  />
                                <input type="hidden" value="<?php echo htmlspecialchars(stripSlashesDeep($value->get_title())); ?>" class="widgetTitle"  />
                                <input type="hidden" value="<?php echo $value->get_viewType(); ?>" class="widgetViewType"  />
                            </li>

                                <?php } ?>
                             
                            <li class="dropdownHeaderLi"><div class="dropdownHeader">- Default External Sources -</div></li>
                            <?php 
                            foreach ( $externalWidgetList as $key => $value)
                            {
                                $qString = '';
                                $set = $value->get_properties();                                
                                $qString = addslashes(serialize($set));
                            ?>

                            <li><a class="widgetSelection defaultWidget" id="dashboardwidget-<?php echo $TC_AmorphousFullSource_Default_priority . '-' . $key . '-' . 'e'; ?>" href="#"><?php echo $value->get_title(); ?></a>
                                <input type="hidden" value="<?php echo htmlentities($qString, ENT_QUOTES); ?>" class="widgetParamString"  />
                                <input type="hidden" value="<?php echo $value->get_dashboardModel(); ?>" class="widgetType"  />
                                <input type="hidden" value="<?php echo htmlspecialchars(stripSlashesDeep($value->get_title())); ?>" class="widgetTitle"  />
                                <input type="hidden" value="<?php echo $value->get_viewType(); ?>" class="widgetViewType"  />
                            </li>

                            <?php } ?>
                            
                            
                        

                        </ul>
                    </li>
                </ul></div>
                
            </div>
            <div class="deleteWidgetContent" id="widget-<?php echo $TC_AmorphousFullSource_Default_widgetEntity_ID ;?>">
                 
        <!--<img src="/public/images/loading2.gif" />-->
            </div>
        </div>
    </div>
</div>  