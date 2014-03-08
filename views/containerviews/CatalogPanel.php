<?php //echo $CatalogPanel_pageCount . '-' . $CatalogPanel_results . "-" . $CatalogPanel_pageNum; ?>
<?php //var_dump(json_decode($CatalogPanel_tags)); ?>
<div id="catalog-content-results-header">
    <div id="catalog-content-sort">
        <label for="catalog-content-sort-select">Sort By</label>

        <select id="catalog-content-sort-select">
            <!-- <option <?php // echo ValidCatalogOrderTypes::RATING == $CatalogPanel_orderBy ? 'selected="selected"' : '' ;?> ><?php // echo ValidCatalogOrderTypes::RATING; ?></option> -->
            <option <?php echo ValidCatalogOrderTypes::RECENCY == $CatalogPanel_orderBy ? 'selected="selected"' : '' ;?> ><?php echo ValidCatalogOrderTypes::RECENCY; ?></option>
            <option <?php echo ValidCatalogOrderTypes::FOLLOWERS == $CatalogPanel_orderBy ? 'selected="selected"' : '' ;?> ><?php echo ValidCatalogOrderTypes::FOLLOWERS; ?></option>
        </select>

    </div>
    <div id="catalog-content-top-pagination" class="pagination">

    <span>Go to Page</span><input id="catalog-pagination-text-input" type="text" value="<?php echo $CatalogPanel_pageNum; ?>"></input><span>of <?php echo $CatalogPanel_pageCount; ?></span><div class="button" id="catalog-pagination-submit" >Go</div>

    </div>
</div>

<div id="catalog-content-results">
<?php foreach($CatalogPanel_entity_read_set as $container) { ?>
<?php
		$isSubscribed = 0;
		// var_dump($CatalogPanel_entity_unsub_set);
		// foreach($CatalogPanel_entity_unsub_set as $ent){
		// 	echo '(' . $ent->get_entity_id() . "-" . $CatalogPanel_entity_id . ")";
		// 	if($CatalogPanel_entity_id == $ent->get_entity_id()){
		// 		$isSubscribed = true;
		// 	}
		// }
		if(getEntityFromRepoPool($container->get_entity_id(), $CatalogPanel_entity_update_set, 'get_entity_id'))
		{
			$isSubscribed = 2;
		}
		elseif(getEntityFromRepoPool($container->get_entity_id(), $CatalogPanel_entity_unsub_set, 'get_entity_id'))
		{
			// if(getEntityFromRepoPool($container->get_entity_id(), $CatalogPanel_mostRecentPages, 'get_entity_id'))
			// {
				$isSubscribed = 1;
			// }
			// else
			// {
			// 	$isSubscribed = 2;
			// }



		}

		$followerCount = $container->get_follower_count();
	render(WIDGET_VIEW_PATH,
	        'TC_CatalogPageWidget.php',
	        array('user_id' =>$CatalogPanel_user_id,
		            'container' => $container,
		            'isSubscribed' => $isSubscribed,
		            'followerCount' => $followerCount,
		            'tags' => json_decode($CatalogPanel_tags)
  				)
	);
?>

    <?php }?>
  </div>
    <div id="catalog-content-bottom-pagination" class="pagination">
    <?php if($CatalogPanel_isPaged && $CatalogPanel_pageCount > 1 && $CatalogPanel_pageNum > 1){?>
    <a href="#" id="catalog-navigation-first">«</a>
    <a href="#" id="catalog-navigation-back"><</a>
    <?php }?>
    <?php
    	if($CatalogPanel_pageCount != 1){
    ?>
    <a href="#" id="catalog-navigation-pagenum-1" class="catalog-navigation-pagenum <?php echo $CatalogPanel_pageNum == 1 ? 'current' : '' ;?>">1</a>
    <?php
  		}
    ?>
    <?php
    if(($CatalogPanel_pageNum - 1) > 2 )
    {
    	echo '...';
    }

    for($pageNum = 2; $pageNum <= $CatalogPanel_pageCount - 1; $pageNum++){
    	if(abs($pageNum - $CatalogPanel_pageNum) < 2 )
    	{
  	?>
    <a href="#" id="catalog-navigation-pagenum-<?php echo $pageNum ; ?>" class="catalog-navigation-pagenum <?php echo $CatalogPanel_pageNum == $pageNum ? 'current' : '' ;?>"><?php echo $pageNum; ?></a>
    <?php
    	}
    	else
    	{

    	}
    }

    if(($CatalogPanel_pageCount - $CatalogPanel_pageNum) > 2 )
    {
    	echo '...';
    }
    ?>
    <a href="#" id="catalog-navigation-pagenum-<?php echo $CatalogPanel_pageCount ; ?>" class="catalog-navigation-pagenum <?php echo $CatalogPanel_pageNum == $CatalogPanel_pageCount ? 'current' : '' ;?>"><?php echo $CatalogPanel_pageCount; ?></a>

    <?php if($CatalogPanel_isPaged && $CatalogPanel_pageCount > 1 && $CatalogPanel_pageNum < $CatalogPanel_pageCount){?>
    <a href="#" id="catalog-navigation-forward">></a>
    <a href="#" id="catalog-navigation-last">»</a>
    <?php }?>

    </div>
  <style>
    #catalog-content-bottom-pagination a.current {
    	font-weight: bold;
    	color: #8600E3;
    }
  </style>
  <script>
  $(document).ready(function(){
  	// $('#catalog-content-top-pagination').on('click', 'a', function(){
  	// 	$.ajax({
  	// 		url: '../../bll/ajaxhandlers/loadCatalogPanel.php',
  	// 		data: {
  	// 		        user_id: '<?php echo $CatalogPanel_user_id ;?>',
  	// 		        pageNum: '<?php echo $CatalogPanel_pageNum ;?>'
  	// 		    },
  	// 		success: function(data){
  	// 		    $('#catalog-content').html(data);
  	// 		}

  	// 	});

  	// });
		// var termsArray = new Array();
		// $.ajax({
		//     url: '<?php echo CORRIDOR_TAG_API_URL ;?>',
		//     data: {

		//     },
		//     dataType: 'json',
		//     success: function(data) {
		//         //data = $.parseJSON(data);
		//         // publishDialogTagTerms = data.tags;
		//         // console.log(publishDialogTagTerms);
		//         // publishDialogTagIds = data.ids;
		//         // console.log(publishDialogTagIds);
		//         termsArray = _.map(data.tags, function(term, key){
		//             return { id: data.ids[key], text: term};
		//         });



		//     }
		// });

		// function handleCatalogPagination(){
		// 	$.ajax({
		// 		url: '../../bll/ajaxhandlers/loadCatalogPanel.php',
		// 		data: {
		// 		        user_id: '<?php echo $CatalogPanel_user_id ;?>',
		// 		        pageNum: $('#catalog-current-page-number').val()
		// 		    },
		// 		success: function(data){
		// 		    $('#catalog-content').html(data);
		// 		}
		// 	});
		// }
		function reloadCatalogPanel(){
			$('#catalog-content').fadeOut('400', function() {
				$('#catalog-content').html('<div style="height:600px"><img src="/public/images/loading.gif" style="position:absolute; top:40%; left:42%;" /></div>');
				$('#catalog-content').fadeIn('400', function() {

				});
			});
	    $.ajax({
	        url: '../../bll/ajaxhandlers/loadCatalogPanel.php',
	        data: {
	            user_id: '<?php echo $CatalogPanel_user_id ;?>',
	            pageNum: $('#catalog-current-page-number').val(),
	            searchTerm: $('#catalog-current-search-term').val(),
	            orderBy: $('#catalog-current-order-by').val(),
	            tag_ids: $('#catalog-current-tag-selections').val(),

	        },
	        success: function(data){
	        	$('#catalog-content').fadeOut('400', function() {
	        		$('#catalog-content').html(data);
	        		$('#catalog-content').fadeIn('400', function() {

	        		});
	        	});

	            //var tagSelections = JSON.parse($('#catalog-current-tag-selections').val());
	            // console.log(tagSelections);
	            //$('#catalog-search-tags').select2('val', tagSelections);
	            // console.log($('#catalog-current-tag-selections').val());
	            // $('#catalog-search-tags').select2('val', $('#catalog-current-tag-selections').val());

	        }
	    });
		}

		$('#catalog-pagination-submit').on('click', function(){
			var nextPage = parseInt($('#catalog-pagination-text-input').val());
			if(nextPage > parseInt('<?php echo $CatalogPanel_pageCount ;?>'))
			{nextPage = parseInt('<?php echo $CatalogPanel_pageCount ;?>')}
			$('#catalog-current-page-number').val(nextPage);
  		reloadCatalogPanel();
  	});

		$('.catalog-navigation-pagenum').on('click', function(){
			var pageNumArr = $(this).attr('id').split('-');
			var nextPage = pageNumArr[pageNumArr.length - 1];
			$('#catalog-current-page-number').val(nextPage);
  		reloadCatalogPanel();
  	});

  	$('#catalog-navigation-first').on('click', function(){
  		$('#catalog-current-page-number').val(1);
  		reloadCatalogPanel();
  	});

  	$('#catalog-navigation-forward').on('click', function(){
  		var nextPage = isNaN(parseInt('<?php echo $CatalogPanel_pageNum ;?>')) ? 1 : parseInt('<?php echo $CatalogPanel_pageNum ;?>') + 1;
  		$('#catalog-current-page-number').val(nextPage);
  		reloadCatalogPanel();
  	});

  	$('#catalog-navigation-last').on('click', function(){
  		var nextPage = isNaN(parseInt('<?php echo $CatalogPanel_pageCount ;?>')) ? 1 : parseInt('<?php echo $CatalogPanel_pageCount ;?>');
  		$('#catalog-current-page-number').val(nextPage);
  		reloadCatalogPanel();
  	});

  	$('#catalog-navigation-back').on('click', function(){
  		var nextPage = isNaN(parseInt('<?php echo $CatalogPanel_pageNum ;?>')) ?
  			1 : parseInt('<?php echo $CatalogPanel_pageNum ;?>') > 1 ? parseInt('<?php echo $CatalogPanel_pageNum ;?>') - 1 : 1 ;
  			$('#catalog-current-page-number').val(nextPage);
			reloadCatalogPanel();
  	});

  	$('#catalog-content-sort-select').on('change', function(){
  		$('#catalog-current-page-number').val(1);
  		$('#catalog-current-order-by').val($(this).val());
  		reloadCatalogPanel();
  	});

  });
  </script>
