
<div class="widget">
    <h1><a href="http://telegrams.state.gov/aldac/tgrambody.cfm" target="_blank">ALDACs</a><div class="sourceExpandIcon opened"></div></h1> 
<ul class="mediafeed">
<?php
//Form Post array
$post = array();
if ($_POST)
$post['txt_subject'] = $_POST['searchinput'];
$date = date("m/d/Y");
$startDate = date('m/d/Y', strtotime("-30 day"));
$post['StartDate'] = $startDate;
$post['EndDate'] = $date;

//User Curl to get Post response
$response= Curl_lib::post('http://telegrams.state.gov/aldac/tgrambody.cfm', $post);

//Parse through the data
$totalstring = '';
foreach ($response['body'] as $value){
	$totalstring = $totalstring . $value;
}

$tablearray = array();
$tablearray = explode('</tr>',$totalstring);

$numEntries = GLOBAL_FEED_ITEM_CAP;
for($i = 2; $i < ($numEntries+2); $i++){  
	$expression = "view_telegram";
	$insertvalue = "http://telegrams.state.gov/aldac/"; 
	$tablearray2 = array();
	$tablearray2 = explode('</td>',$tablearray[$i]);
	echo '<li class="rssRow"><strong class="date">'.date("l, F j, Y",strtotime(trim(strip_tags($tablearray2[1])))).'</strong>'; 
	$aldaclink = str_replace($expression,$insertvalue.$expression,$tablearray2[3]);
	preg_match('/href="([^"]*)"/i', $aldaclink, $regs);
      $link = $regs[1];
      $linkTitle = trim(strip_tags($tablearray2[3]));
	echo '<strong><a href="'.$link.'" target="_blank">'.$linkTitle.'</a></strong>';

	  echo '<div class="shareContainer"><a class="share tooltip" title="Share in Corridor" target="_blank" href="'. generateCorridorShareALDACS($link, $linkTitle) .'"><div class="shareIcon corridorShare" ></div><span class="tttext classic">Share in Corridor</span></a><a class="share tooltip" title="Send by email" href="mailto:?Subject=Shared From the Current - '. $linkTitle .'&body='. $link .'"><div class="shareIcon mailShare" ></div><span class="tttext classic">Send by email</span></a></div>';
        echo '</li>';
}

?>
</ul>
</div>