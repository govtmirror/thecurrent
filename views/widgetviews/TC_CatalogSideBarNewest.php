<h1>Newest</h1>
<ul>
<?php
$quit = 0;
// $unSubbed = array_diff($TC_CatalogSideBarNewest_entity_read_set, $TC_CatalogSideBarNewest_entity_edit_set);
foreach($TC_CatalogSideBarNewest_entity_read_set as $page){
    if(!getEntityFromRepoPool($page->get_entity_id(), $TC_CatalogSideBarNewest_entity_unsub_set, 'get_entity_id')){
        $quit++;
    ?>
    <li><h2><?php echo $page->get_host()->get_title() ; ?></h2>
    <div class="description"><?php echo $page->get_host()->get_description() ; ?></div>
    <div class="button preview previewPageButton" data-entityid="<?php echo $page->get_entity_id() ; ?>">Preview</div>
    <div class="button follow subscribePageButton" data-entityid="<?php echo $page->get_entity_id() ; ?>" data-subscribed="1">
    Subscribe
    </div>
    <hr />
    </li>
<?php
    }
    if($quit >= 5)
    {
        break;
    }
} ?>

</ul>