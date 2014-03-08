        <?php

        ?>
        <div id="catalog-search" >

            <fieldset>
            <legend>Search</legend>
            <table>
            <tr><td><label for="catalog-search-text">Title</label></td><td style="width:180px;"><input style="width:100%;" type="text" name="catalog-search-text" id="catalog-search-text" value="" /></td></tr>
            <tr><td><label for="catalog-search-tags" >Tags</label></td><td style="width:180px;"><input style="width:100%;" type="text" name="catalog-search-tags" id="catalog-search-tags" value="" /></td></tr>
            <tr><td></td><td><div id="catalog-search-submit" class="button">Search <img src="/public/images/magnifyingGlass.png" /></div></td></tr>
            </table>
            </fieldset>


        </div>

        <div class="suggestedFeed">

        </div>
        <div class="tagCloud" id="catalog-tagCloud"></div>
        <!-- <div class="pageList">
            <h1>Trending</h1>
            <ul>
                <li><h2>Page 1</h2><a href="#">Preview</a> - <a href="#">Follow</a></li>
                <li><h2>Page 2</h2><a href="#">Preview</a> - <a href="#">Follow</a></li>
                <li><h2>Page 3</h2><a href="#">Preview</a> - <a href="#">Follow</a></li>
                <li><h2>Page 4</h2><a href="#">Preview</a> - <a href="#">Follow</a></li>
                <li><h2>Page 5</h2><a href="#">Preview</a> - <a href="#">Follow</a></li>
            </ul>
        </div> -->
        <div class="pageList">

            <?php
            // $dataArr = TC_Utility::getCatalogPagesDataArray();

            // $pageCount = TC_Utility::getCatalogPageCount();


                    render(WIDGET_VIEW_PATH,
                            'TC_CatalogSideBarNewest.php',
                            array('entity_read_set' => $CatalogMainSidebar_entity_read_set, 'entity_unsub_set' => $CatalogMainSidebar_entity_unsub_set)
                    );
            ?>
        </div>