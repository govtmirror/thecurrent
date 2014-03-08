<?php

if(!isset($TC_GenericRSSSource_SSSimplePie_Default_widgetEntity_ID))
{
    
    throw new Exception("cannot load RSS widget.");
    
}

if(isset($TC_GenericRSSSource_SSSimplePie_Default_widget))
{
    $model = $TC_GenericRSSSource_SSSimplePie_Default_widget;
}
else
{
    $modelBuilder = new TC_GenericRSSSource_Builder($TC_GenericRSSSource_SSSimplePie_Default_widgetEntity_ID);
    $model = $modelBuilder->getModel();
    
    
}


$feedStrategy = new SimplePieStrategy($model);
$feedBuilder = new FeedBuilder($feedStrategy);
$feed = $feedBuilder->getFeed();
//unset($modelBuilder);
unset($feedBuilder);

$config = HTMLPurifier_Config::createDefault();
$purifier = new HTMLPurifier($config);
?>

<div class="widget">
    <h1><a target="_blank" href="<?php echo $feed->get_link() ;?>"><?php echo $model->get_title() ;?></a><div class="sourceExpandIcon opened"></div></h1>
              <ul id="widget-<?php echo $TC_GenericRSSSource_SSSimplePie_Default_widgetEntity_ID ;?>" class="mediafeed">
            <?php 
                foreach($feed->get_items(0,GLOBAL_FEED_ITEM_CAP) as $item):
            ?>
                <li class="rssRow">
                    <div style="overflow:auto;">
                        <input type="hidden" class="feedLinkInput" value="<?php echo $feed->get_link() ;?>" ></input>
                       
                <?php 
                
                    //$htmlDOM = new simple_html_dom();
                    //$htmlDOM->load($item->get_description());
                    $image = $item->get_enclosure();//->get_thumbnail();//$htmlDOM->find('img', 0); 
                    //echo $item->get_enclosure()->get_thumbnail();
                    
                    if(is_object($image) && $image_url = $image->get_thumbnail())
                    {                        
                        
                        //$image->outertext = '';
                        //$strippedContent = $htmlDOM;
                        ?>
                        <div style="padding-bottom:7px; float:left;">
                        <a  style="float:left; width:85px;" class="feedInnerLink" href="javascript:void(0);"  title="View this feed at <?php echo $purifier->purify($item->get_title()) ; ?>" ><img style="float:left;width:75px;height:75px;" src="<?php echo $image_url ;?>" /></a>
                </div>
                
                        <?php
                        
                    }
                    
                        ?>
                <strong class="date"><?php echo $item->get_date($date_format = 'l, F j, Y, g:i a') ;?></strong>
                <a  class="feedInnerLink" href="javascript:void(0);" ><span><?php echo $purifier->purify($item->get_title()) ; ?></span>
                </a>
                    <div class="feedContent">
                        <div class="feedHiddenContent">
                          <a class="feedInnerLink" href="javascript:void(0);" >  
                              <p class="date">
                            <?php
                        if(strip_tags($item->get_content()) != strip_tags($item->get_description()) )
                        {  
                        
                
                            echo truncateText(strip_tags($purifier->purify($item->get_description())),GLOBAL_FEED_DESCRIPTION_CHAR_CAP);
                        
                        }
                        ?>
                              </p>
                          </a>
                        </div>
                        <div class="feedFullContent" style="display:none;">
                        <?php
                        
                            if($item->get_content() )
                            {
                                echo $purifier->purify($item->get_content()); 
                            }
                            else
                            {
                                echo 'The feed provider did not include source content. <br /> <a target="_blank" href="'.$item->get_link().'">Click here</a> to read the full article from the source.';
                            }
                            
                        ?>
                        </div>
                        <div class="feedContentMeta">
                            <a target="_blank" href="<?php echo $item->get_link(); ?>">read full article</a>
                            <?php
                            $comments = $item->get_item_tags('http://purl.org/rss/1.0/modules/slash/',"comments");
                            if(!empty($comments) && !empty($comments[0]['data']) && $comments[0]['data'] != 0)
                            {
                            ?>
                            <div style="float:right; padding-right:5px;">comments:
                            <?php
                       echo $comments[0]['data'];
                       ?>
                                </div>
                            <?php } ?>
                        

                        </div>
                    </div>
                         
                
                
              
                            
                     <div class="shareContainer">
			<a class="share tooltip" title="Share in Corridor" target="_blank" href="<?php echo generateCorridorShare($item) ;?>"><div class="shareIcon corridorShare"></div><span class="tttext classic">Share in Corridor</span></a>
			<a class="share tooltip" title="Send by email"  href="mailto:?Subject=Shared From the Current - <?php echo strip_tags($purifier->purify($item->get_title())) ;?>&body=<?php echo strip_tags($item->get_link()); ?>"><div class="shareIcon mailShare"></div><span class="tttext classic">Send by email</span></a>		
                        <!--<a class="share tooltip" title="Discuss in The Current" href="javascript:void(0);"  ><div class="shareIcon discussShare"></div><span class="tttext classic">Discuss in The Current</span></a>-->
		    </div>
                          </div> 
                </li>
            <?php
                endforeach;
            ?>    
              </ul>
</div>