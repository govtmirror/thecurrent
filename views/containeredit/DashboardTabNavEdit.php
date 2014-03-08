<?php


if(!isset($DashboardTabNavEdit_user_ID))
{
    throw new Exception("cannot load dashboard page");
}
/*
if(isset($DashboardTabNavEdit_entity))
{
    $entity = $DashboardTabNavEdit_entity;
    $model = $entity->get_host();
    $model_id = $entity->get_host_id();
    $accessprofile = new AccessProfile(ValidAccessProfiles::DASHBOARD_REORDER, ValidAccessTypes::REORDER, ValidAccessContexts::DASHBOARD, ValidAccessLevels::BASIC_ACCESS);
    $widgetsSimple = prioritySort(TC_PersistenceUtility::getActiveWidgetsForDashboard($DashboardTabNavEdit_user_ID, $accessprofile, $model_id));
}
else
{
    $idsArrReorder = array();
    $idsArrEdit = array();
    //$widgetIDs = null;
    //$widgetsSimple = array();
}
*/
if(!isset($DashboardTabNavEdit_entity_ID))
{
    $idsArrReorder = array();
    $idsArrEdit = array();
    $idsArrRename = array();
    $idsArrDelete = array();
    $idsArrPub = array();
    $idsArrUnsub = array();
}

    if(!isset($DashboardTabNavEdit_entity_reorder_set) || empty($DashboardTabNavEdit_entity_reorder_set))
    {
        //$idsArrReorder = array();
    }
    else
    {
        $idsArrReorder = prioritySort($DashboardTabNavEdit_entity_reorder_set);

    }
    if(!isset($DashboardTabNavEdit_entity_edit_set) || empty($DashboardTabNavEdit_entity_edit_set))
    {
        //$idsArrEdit = array();
    }
    else
    {
        $idsArrEdit = prioritySort($DashboardTabNavEdit_entity_edit_set);
    }





    if(!isset($DashboardTabNavEdit_entity_rename_set) || empty($DashboardTabNavEdit_entity_rename_set))
    {
    }
    else
    {
        $idsArrRename = prioritySort($DashboardTabNavEdit_entity_rename_set);
    }

    if(!isset($DashboardTabNavEdit_entity_delete_set) || empty($DashboardTabNavEdit_entity_delete_set))
    {
    }
    else
    {
        $idsArrDelete = prioritySort($DashboardTabNavEdit_entity_delete_set);
    }

    if(!isset($DashboardTabNavEdit_entity_publish_set) || empty($DashboardTabNavEdit_entity_publish_set))
    {
    }
    else
    {
        $idsArrPub = prioritySort($DashboardTabNavEdit_entity_publish_set);
    }
    if(!isset($DashboardTabNavEdit_entity_unsub_set) || empty($DashboardTabNavEdit_entity_unsub_set))
    {
    }
    else
    {
        $idsArrUnsub = prioritySort($DashboardTabNavEdit_entity_unsub_set);
    }




?>
<div name="navindex" id="navindex" class="navIndex navIndexButton">
<div name="SelectedSourceTitle" id="SelectedSourceTitle" class="SelectedSourceTitle"></div>
<ul id="navigation">
<?php
foreach($idsArrReorder AS $priority => $value){ ?>
<?php
    if(array_key_exists($priority, $idsArrEdit))
    {
?>
<li id="dashboardTabPriority-<?php echo $priority; ?>" class="dashboardEditTab <?php if($DashboardTabNavEdit_entity_ID == $value->get_entity_id()){echo ' current ';}?>">
        <a tabindex="0" id="container_link-<?php echo $value->get_host_id(); ?>-<?php echo $value->get_entity_id(); ?>" name="container_link-<?php echo $value->get_host_id(); ?>-<?php echo $value->get_entity_id(); ?>" class="dashboard_tab_link  <?php if($DashboardTabNavEdit_entity_ID == $value->get_entity_id()){echo ' current ';}?> dashboard_tab_link_edit <?php echo array_key_exists($priority, $idsArrUnsub) ? 'subscribedPageNav' : '' ;?>" href="#" ><?php echo stripSlashesDeep($value->get_host()->get_title());?></a>
        <?php if(array_key_exists($priority, $idsArrRename)) { ?>
        <span tabindex="0" id="edit_tab-<?php echo $value->get_entity_id(); ?>" class="editTabButton tooltip" title="Rename this page">
            <span class="tttext classic">Rename this page</span>
        </span>
        <?php } ?>

        <?php if(array_key_exists($priority, $idsArrDelete)) { ?>
        <span tabindex="0" id="delete_tab-<?php echo $value->get_entity_id(); ?>" class="deleteTabButton tooltip" title="Delete this page">
            <span class="tttext classic">Delete this page</span>
        </span>
        <?php } ?>

</li>
<?php
    }
    else
    {
?>
<li id="dashboardTabPriority-<?php echo $priority; ?>" class="dashboardEditTab <?php if($DashboardTabNavEdit_entity_ID == $value->get_entity_id()){echo ' current ';}?>">

        <?php if(array_key_exists($priority, $idsArrUnsub)) { ?>
        <a tabindex="0" id="container_link-<?php echo $value->get_host_id(); ?>-<?php echo $value->get_entity_id(); ?>" name="container_link-<?php echo $value->get_host_id(); ?>-<?php echo $value->get_entity_id(); ?>" class="dashboard_tab_link  <?php if($DashboardTabNavEdit_entity_ID == $value->get_entity_id()){echo ' current ';}?> dashboard_tab_link_edit <?php echo array_key_exists($priority, $idsArrUnsub) ? 'subscribedPageNav' : '' ;?>" href="#" ><?php echo stripSlashesDeep($value->get_host()->get_title());?></a>
        <span tabindex="0" id="unsub_tab-<?php echo $value->get_entity_id(); ?>" class="unsubTabButton tooltip" title="Unsubscribe from this page">
            <span class="tttext classic">Unsubscribe from this page</span>
        </span>
        <?php
        }
        else
        {
            ?>
            <div tabindex="0" id="container_link-<?php echo $value->get_host_id(); ?>-<?php echo $value->get_entity_id(); ?>" name="container_link-<?php echo $value->get_host_id(); ?>-<?php echo $value->get_entity_id(); ?>" class="reorderOnly dashboard_tab_link  <?php if($DashboardTabNavEdit_entity_ID == $value->get_entity_id()){echo ' current ';}?> <?php echo array_key_exists($priority, $idsArrUnsub) ? 'subscribedPageNav' : '' ;?>"  ><?php echo stripSlashesDeep($value->get_host()->get_title());?></div>
        <?php }?>
</li>
<?php
    }
?>

    <?php
}
?>
<li class="dashboardAddTab"><a class="tooltip addNewTab" id="add" href="#" title="Add a New Page">+ Add a New Page +<span class="tttext classic">Add a New Page</span></a></li>
</ul>
</div>
<div id="addTabIndexbutton" name="addTabIndexbutton" class="navIndexButton dashboardAddTab"><a class="tooltip addNewTab backgroundButton" href="#" title="Add a New Page"></a></div>
<script type="text/javascript">

    $(document).ready(function(){

        makeSortableNav();

    });

</script>

<?php



?>
