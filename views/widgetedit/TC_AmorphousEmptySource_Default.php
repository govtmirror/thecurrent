<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TC_AmorphousEmptySource_Default
 *
 * @author kottkedp
 */

if(!isset($TC_AmorphousEmptySource_Default_priority))
{
    throw new Exception("cannot load dashboard page");
}
if(!isset($TC_AmorphousEmptySource_Default_containerEntity_ID))
{
    throw new Exception("cannot load dashboard page");
}
if(!isset($TC_AmorphousEmptySource_Default_IWL))
{
    throw new Exception("cannot load dashboard page");
    
}
else
{
    $internalWidgetList = deconstructArrayForTransit($TC_AmorphousEmptySource_Default_IWL);
    
}

if(!isset($TC_AmorphousEmptySource_Default_EWL))
{
    throw new Exception("cannot load dashboard page");
    
}
else
{
    $externalWidgetList = deconstructArrayForTransit($TC_AmorphousEmptySource_Default_EWL);
    
}
//$modelBuilder = new TC_DashboardTabBuilder($TC_AmorphousEmptySource_Default_containerEntity_ID);
//$model2 = $modelBuilder->getModel();
//$container_ID = $modelBuilder->get_model_id();
//unset($modelBuilder);
//unset($model2);

?>
             
  

<div class="widget add">
    <input type="hidden" value="<?php echo $TC_AmorphousEmptySource_Default_container_ID; ?>" class="containerID"  />
    <input type="hidden" value="<?php echo $TC_AmorphousEmptySource_Default_priority; ?>" class="widgetPriority"  />
    
    <h1>Empty Slot</h1>
        <ul class="widgetEmptyContainer">
                <li><a class="addWidget" href="#">Add a New Source</a>
                    <ul class="widgetSelect">
                         <li class="dropdownHeaderLi"><div class="dropdownHeader">- Custom Sources -</div></li>
                        
                         <li><a class="widgetSelection customWidget DirectRSS" id="dashboardwidget-custom-DirectRSS-<?php echo $TC_AmorphousEmptySource_Default_container_ID .'-' . $TC_AmorphousEmptySource_Default_priority; ?>" href="#">RSS Feed</a></li>
                         <li><a class="widgetSelection customWidget GoogleSearchFeed" id="dashboardwidget-custom-GoogleSearchFeed-<?php echo $TC_AmorphousEmptySource_Default_container_ID .'-' . $TC_AmorphousEmptySource_Default_priority; ?>" href="#">Website Search</a></li>
                        
                        
                        <li><a class="widgetSelection customWidget GoogleNewsSearchFeed" id="dashboardwidget-custom-GoogleNewsSearchFeed-<?php echo $TC_AmorphousEmptySource_Default_container_ID .'-' . $TC_AmorphousEmptySource_Default_priority; ?>" href="#">News Search</a></li>
                        <li><a class="widgetSelection customWidget YoutubeSearchFeed" id="dashboardwidget-custom-YoutubeSearchFeed-<?php echo $TC_AmorphousEmptySource_Default_container_ID .'-' . $TC_AmorphousEmptySource_Default_priority; ?>" href="#">Youtube Search</a></li>
                        <li><a class="widgetSelection customWidget CorridorUserFeed" id="dashboardwidget-custom-CorridorUserFeed-<?php echo $TC_AmorphousEmptySource_Default_container_ID .'-' . $TC_AmorphousEmptySource_Default_priority; ?>" href="#">Corridor Feed (Chrome)</a></li>
                        <li><a class="widgetSelection customWidget SMARTSearchFeed" id="dashboardwidget-custom-SMARTSearchFeed-<?php echo $TC_AmorphousEmptySource_Default_container_ID .'-' . $TC_AmorphousEmptySource_Default_priority; ?>" href="#">SMART Feed (Chrome)</a></li>
                        
                        
                        
                        <li class="dropdownHeaderLi"><div class="dropdownHeader">- Default Internal Sources -</div></li>
                        <?php 
                        foreach ( $internalWidgetList as $key => $value)
                        {
                            $qString = '';
                            $set = $value->get_properties();                                
                            $qString = addslashes(serialize($set));
                        ?>
                        
                        <li><a class="widgetSelection defaultWidget" id="dashboardwidget-<?php echo $TC_AmorphousEmptySource_Default_priority . '-' . $key . '-' . 'i'; ?>" href="#"><?php echo $value->get_title(); ?></a>
                            <input type="hidden" value="<?php echo htmlentities($qString, ENT_QUOTES); ?>" class="widgetParamString"  />
                            <input type="hidden" value="<?php echo $value->get_dashboardModel(); ?>" class="widgetType"  />
                            <input type="hidden" value="<?php echo htmlspecialchars($value->get_title()); ?>" class="widgetTitle"  />
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
                        
                        <li><a class="widgetSelection defaultWidget" id="dashboardwidget-<?php echo $TC_AmorphousEmptySource_Default_priority . '-' . $key . '-' . 'e'; ?>" href="#"><?php echo $value->get_title(); ?></a>
                            <input type="hidden" value="<?php echo htmlentities($qString, ENT_QUOTES); ?>" class="widgetParamString"  />
                            <input type="hidden" value="<?php echo $value->get_dashboardModel(); ?>" class="widgetType"  />
                            <input type="hidden" value="<?php echo htmlspecialchars($value->get_title()); ?>" class="widgetTitle"  />
                            <input type="hidden" value="<?php echo $value->get_viewType(); ?>" class="widgetViewType"  />
                        </li>
                            <?php } ?>
                        
                       
                    </ul>
                </li>
        </ul>
</div>  