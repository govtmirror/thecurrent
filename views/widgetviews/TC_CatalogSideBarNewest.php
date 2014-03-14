<h1>Newest</h1>
<ul>
<?php
$quit = 0;
// $unSubbed = array_diff($TC_CatalogSideBarNewest_entity_read_set, $TC_CatalogSideBarNewest_entity_edit_set);
foreach($TC_CatalogSideBarNewest_entity_read_set as $page){
    if(!getEntityFromRepoPool($page->get_entity_id(), $TC_CatalogSideBarNewest_entity_unsub_set, 'get_entity_id')){
        $quit++;

        $isSubscribed = 0;

        if(getEntityFromRepoPool($page->get_entity_id(), $TC_CatalogSideBarNewest_entity_update_set, 'get_entity_id'))
        {
            $isSubscribed = 2;
        }
        elseif(getEntityFromRepoPool($page->get_entity_id(), $TC_CatalogSideBarNewest_entity_unsub_set, 'get_entity_id'))
        {
            $isSubscribed = 1;

        }
    ?>
    <li><h2><?php echo $page->get_host()->get_title() ; ?></h2>
    <div class="description"><?php echo $page->get_host()->get_description() ; ?></div>


    <div class="button preview previewPageButton" data-entityid="<?php echo $page->get_entity_id() ; ?>" data-subscribed="<?php
        switch($isSubscribed){
            case 0:
                echo 1;
                break;
            case 1:
                echo 0;
                break;
            case 2:
                echo 2;
                break;
            default:
                echo 1;
                break;
        }
        // echo $TC_CatalogPageWidget_isSubscribed ? 0 : 1;
    ?>">Preview</div>
    <div class="button follow subscribePageButton" data-entityid="<?php echo $page->get_entity_id() ; ?>" data-subscribed="<?php
        switch($isSubscribed){
            case 0:
                echo 1;
                break;
            case 1:
                echo 0;
                break;
            case 2:
                echo 2;
                break;
            default:
                echo 1;
                break;
        }
        // echo $TC_CatalogPageWidget_isSubscribed ? 0 : 1;
    ?>" style="<?php
        switch($isSubscribed){
            case 0:
                echo "";
                break;
            case 1:
                echo "background:#8600E3;";
                break;
            case 2:
                echo "background:#8600E3;";
                break;
            default:
                echo "";
                break;
        }
        // echo $TC_CatalogPageWidget_isSubscribed ? "background:#8600E3;" : ""
    ?>">
    <?php
        switch($isSubscribed){
            case 0:
                echo "Subscribe";
                break;
            case 1:
                echo "Unsubscribe";
                break;
            case 2:
                echo "Update";
                break;
            default:
                echo "Subscribe";
                break;
        }
        // echo $TC_CatalogPageWidget_isSubscribed ? "Unsubscribe" : "Subscribe"
    ?>
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