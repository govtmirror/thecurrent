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
?>

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>The Current</title>
        <![if !ie]><link rel="stylesheet" href="/public/css/style.css" type="text/css" media="screen" /><![endif]>
        <!--[if ie]><link rel="stylesheet" href="/public/css/ie.css" type="text/css" media="screen" /><![endif]-->
	<link rel="stylesheet" href="/public/css/ui-lightness/jquery-ui-1.8.18.custom.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="/public/AnythingSlider/css/anythingslider2.css" type="text/css" media="screen" />
      
        <script type="text/javascript" src="/public/js/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="/public/js/jquery.livequery.js"></script>
	<script type="text/javascript" src="/public/js/jquery-ui-1.8.18.custom.min.js"></script>	
	<script type="text/javascript" src="/public/js/jquery.cookie.js"></script>
        <script type="text/javascript" src="/public/js/corridorShare.js"></script>
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script src="/public/js/jquery.zrssfeed.min.js" type="text/javascript"></script>
	<script src="/public/js/jquery.zflickrfeed.min.js" type="text/javascript"></script>
        <script src="/public/js/jquery.zrssyoutubefeed.js" type="text/javascript"></script>
        <script src="/public/js/jquery.zrssmediafeed.js" type="text/javascript"></script>
        <script src="/public/js/jquery.ztwitterfeed.min.js" type="text/javascript"></script>
	<script src="/public/js/functions.js" type="text/javascript"></script>
        <script type="text/javascript" src="/public/player/jwplayer.js"></script>
        <script type="text/javascript" src="/public/AnythingSlider/js/jquery.anythingslider.js"></script>
        <script type="text/javascript" src="/public/AnythingSlider/js/jquery.anythingslider.video.js"></script>
        <script type="text/javascript" src="/public/AnythingSlider/js/jquery.anythingslider.fx.js"></script>
        <script type="text/javascript" src="/public/AnythingSlider/js/jquery.easing.1.2.js"></script>
        <script type="text/javascript" src="/public/AnythingSlider/js/swfobject.js"></script>
        <script type="text/javascript">
        $(document).ready(function(){
                
            $('#button').live('click', function(){
                
                
               
                     $.ajax({
                        //document.location.hostname+
                        url: '../../bll/ajaxhandlers/loadDashboardContentEditAndNavEdit.php',
                        data: {                        
                        entity_ID: '6064',
                        user_ID: '1234'
                              },timeout: 0,dataType : 'html', error: function(jqXHR, textStatus, errorThrown) {
        alert(textStatus); // this will be "timeout"
    },
                        success: function(data){                          
                        
                        
                        //alert($(data).filter("#ajaxRenderNav").html());
                        $('#main').html($(data).filter("#ajaxRenderContent").html());
                        $('#nav').html($(data).filter("#ajaxRenderNav").html());
                        
                        

                        $(data).filter('script').each(function(){
                            $.globalEval(this.text || this.textContent || this.innerHTML || '');
                        });
                        

                               

                        }

                    });
                
                
                
                
            })    
                
                
                
        });
    
        </script>  
    </head>
    <body>
       <div id="button">
            test
        </div>
        <div id="nav">
            
        </div>
        <div id="main">
            
        </div>
        
        
    </body>
</html>
        