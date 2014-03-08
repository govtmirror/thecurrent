<?php if (!(preg_match("/chrome/i", $_SERVER['HTTP_USER_AGENT']))) { ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php } ?>
<?php
                      
        /*below goes on every page if you want it to work!*/

	if(!isset($_SERVER['DOCUMENT_ROOT'])){ if(isset($_SERVER['SCRIPT_FILENAME'])){
$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr($_SERVER['SCRIPT_FILENAME'], 0, 0-strlen($_SERVER['PHP_SELF'])));
}; };
if(!isset($_SERVER['DOCUMENT_ROOT'])){ if(isset($_SERVER['PATH_TRANSLATED'])){
$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr(str_replace('\\\\', '\\', $_SERVER['PATH_TRANSLATED']), 0, 0-strlen($_SERVER['PHP_SELF'])));
}; };

        require_once ($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'library' . DIRECTORY_SEPARATOR . 'bootstrap.php');   

require('/header.php');
?>

<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<script type="text/javascript">

$(document).ready(function(){
   
   jwplayer("addingRSSPlayer").setup({
                flashplayer: "/public/player/player.swf",
                file: "/public/player/videos/The Current - RSS Search.mp4",
                image: "/public/player/img/Adding an RSS.jpg",
                height: 384,
                width: 512
            });
            
            jwplayer("addingGoogleNewsPlayer").setup({
                flashplayer: "/public/player/player.swf",
                file: "/public/player/videos/The Current - News Search.mp4",
                image: "/public/player/img/Adding Google News Feed.jpg",
                height: 384,
                width: 512
            });
            jwplayer("addingWebsiteSearchPlayer").setup({
                flashplayer: "/public/player/player.swf",
                file: "/public/player/videos/The Current - Website Search.mp4",
                image: "/public/player/img/Adding Website Search.jpg",
                height: 384,
                width: 512
            });
            jwplayer("IEFixesPlayer").setup({
                flashplayer: "/public/player/player.swf",
                file: "/public/player/videos/The Current - IE Fixes.mp4",
                
                height: 384,
                width: 512
            });
            
            
            
            
            $('#slider').anythingSlider({
                                buildStartStop:false,
                                theme:'default',
                                onSlideComplete : function(slider){
                                    
                                    var i = 0;
                            while (true) {
                                var player = jwplayer(i);
                                if (!player)
                                    break;

                                player.stop();
                                i++;
                            }
                                },
                                       // mode                : 'f',   // fade mode - new in v1.8!
				resizeContents      : false, // If true, solitary images/objects in the panel will expand to fit the viewport
				//navigationSize      : 3,     // Set this to the maximum number of visible navigation tabs; false to disable
				navigationFormatter : function(index, panel){ // Format navigation labels with text
					//return " Panel #" + index;
                                        return {
                                        'class'  : 'panel',
                                        'data-x' : 'Adding an RSS feed into The Current', // "Title#" is in the h2
                                        'title'  : panel.find('h1').text(),
                                        'html'   : '<a href="#" class="friendlyText" style="padding-top:' + (index == 1 || index == 4 ? "12px;" : "0;") + '" ><span style="overflow:visible;">' + panel.find('h1').text() + '</span></a>'
                                        };
                                        
                                        
				},
				onSlideBegin: function(e,slider) {
					// keep the current navigation tab in view
					slider.navWindow( slider.targetPage );
                                        
				}
            });
            
            
            
            
    
});



</script>

<div id="instructionalVideoDialogBox" >
                
            <ul id="slider">

				<li class="panel1"><div class="videoBox">
                                        <h1>Adding an RSS feed into The Current</h1>
                <embed src="/public/player/player.swf"
                       id="addingRSSPlayer"
                       name="addingRSSPlayer"
                       class="videoPlayer"
                       width="512"
                       height="384"
                       allowscriptaccess="always"
                       allowfullscreen="true"
                       flashvars="height=384&width=512&file=/public/player/videos/The Current - RSS Search.mp4"/>
                        </div></li>

				<li class="panel2"><div class="videoBox">
                                        <h1>Adding Google News into The Current</h1>
                <embed src="/public/player/player.swf"
                       id="addingGoogleNewsPlayer"
                       name="addingGoogleNewsPlayer"
                       class="videoPlayer"
                       width="512"
                       height="384"
                       allowscriptaccess="always"
                       allowfullscreen="true"
                       flashvars="height=384&width=512&file=/public/player/videos/The Current - News Search.mp4"/>
                    </div></li>

				<li class="panel3"><div class="videoBox">
                                        <h1>Adding Website Search into The Current</h1>
                <embed src="/public/player/player.swf"
                       id="addingWebsiteSearchPlayer"
                       title="Adding Website Search into The Current"
                       name="addingWebsiteSearchPlayer"
                       class="videoPlayer"
                       width="512"
                       height="384"
                       allowscriptaccess="always"
                       allowfullscreen="true"
                       flashvars="height=384&width=512&file=/public/player/videos/The Current - Website Search.mp4"/>
                    </div></li>

			<li class="panel4"><div class="videoBox">
                                        <h1>IE Fixes for The Current</h1>
                <embed src="/public/player/player.swf"
                       id="IEFixesPlayer"
                       title="IE Fixes for The Current"
                       name="IEFixesPlayer"
                       class="videoPlayer"
                       width="512"
                       height="384"
                       allowscriptaccess="always"
                       allowfullscreen="true"
                       flashvars="height=384&width=512&file=/public/player/videos/The Current - IE Fixes.mp4"/>
                    </div></li>	

			

                </ul>
                
               
    </div>


<?php
require('/footer.php');
?>