<?php


if(!isset($DashboardTabNav_user_ID))
{
    throw new Exception("cannot load dashboard page");
}
if(!isset($DashboardTabNav_entity_ID))
{
    $idsArr = array();
    //throw new Exception("cannot load dashboard tab");
}
elseif(isset($DashboardTabNav_entity_set))
{
    //$modelBuilder = new TC_DashboardTabBuilder($DashboardTabNav_entity_ID);
    //$model2 = $modelBuilder->getModel();
    //$container_ID = $modelBuilder->get_model_id();
    //unset($modelBuilder);
    //unset($model2);
}
if(!isset($DashboardTabNav_entity_set))
{
    $idsArr = array();
    //throw new Exception("cannot load dashboard tabs");
}
else
{
    $idsArr = prioritySort($DashboardTabNav_entity_set);
}
?>
<div name="navindex" id="navindex" class="navIndex navIndexButton">
<div name="SelectedSourceTitle" id="SelectedSourceTitle" class="SelectedSourceTitle"></div>
<ul id="navigation">
<?php
foreach($idsArr AS $priority => $value){?>
    <li class="<?php if($DashboardTabNav_entity_ID == $value->get_entity_id()){echo ' current ';}?>"><a id="container_link-<?php echo $value->get_host_id(); ?>-<?php echo $value->get_entity_id(); ?>"  name="container_link-<?php echo $value->get_host_id(); ?>-<?php echo $value->get_entity_id(); ?>" class="dashboard_tab_link <?php if($DashboardTabNav_entity_ID == $value->get_entity_id()){echo ' current ';}?> dashboard_tab_link_view" href="#" ><?php echo stripSlashesDeep($value->get_host()->get_title()); ?></a></li>
    <?php } ?>
</ul>
</div>