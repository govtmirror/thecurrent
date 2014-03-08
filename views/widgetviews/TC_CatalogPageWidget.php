
<div class="catalog-content-result" id="catalog-content-result-<?php echo $TC_CatalogPageWidget_container->get_entity_id() ; ?>">

    <div class="heading clearfix">
        <div class="resultimage"></div>
        <h1><p><?php echo $TC_CatalogPageWidget_container->get_host()->get_title() ; ?></p></h1>
        <!-- <div class="rating">
            <img src="/public/images/goldstar.png"/>
            <img src="/public/images/goldstar.png"/>
            <img src="/public/images/goldstar.png"/>
            <img src="/public/images/goldstar.png"/>
            <img src="/public/images/goldstar.png"/>
        </div> -->
        <div class="users"><span class="highlightText"><?php echo $TC_CatalogPageWidget_followerCount ;?></span> users following</div>
    </div>

    <div class="description"><?php echo $TC_CatalogPageWidget_container->get_host()->get_description() ; ?></div>

    <div class="tags">
    <strong>Tags: </strong>
    <?php
        foreach($TC_CatalogPageWidget_container->get_tags() as $tagId)
        {
            if(!empty($tagId)){
                $tagKey = array_search($tagId, $TC_CatalogPageWidget_tags->ids);
                $tagTerm = $TC_CatalogPageWidget_tags->tags[$tagKey];

    ?>
        <a href="#" class="catalogTag" data-tagid="<?php echo $tagId;?>"><?php echo $tagTerm;?></a>
    <?php
            }
        }
    ?>
    </div>


    <!--<div class="admins"><a href="#">Page Admin</a></div>-->

    <div class="button preview previewPageButton" data-entityid="<?php echo $TC_CatalogPageWidget_container->get_entity_id() ; ?>" data-subscribed="<?php
        switch($TC_CatalogPageWidget_isSubscribed){
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
    <div class="button follow subscribePageButton" data-entityid="<?php echo $TC_CatalogPageWidget_container->get_entity_id() ; ?>" data-subscribed="<?php
        switch($TC_CatalogPageWidget_isSubscribed){
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
        switch($TC_CatalogPageWidget_isSubscribed){
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
        switch($TC_CatalogPageWidget_isSubscribed){
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

</div>

<script>
$(document).ready(function(){

    $('#catalog-content-result-<?php echo $TC_CatalogPageWidget_container->get_entity_id() ; ?>').on('click', "a", function(){});
});
</script>