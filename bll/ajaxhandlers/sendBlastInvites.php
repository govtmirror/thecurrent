<?php

if(!isset($_SERVER['DOCUMENT_ROOT'])){ if(isset($_SERVER['SCRIPT_FILENAME'])){
$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr($_SERVER['SCRIPT_FILENAME'], 0, 0-strlen($_SERVER['PHP_SELF'])));
}; };
if(!isset($_SERVER['DOCUMENT_ROOT'])){ if(isset($_SERVER['PATH_TRANSLATED'])){
$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr(str_replace('\\\\', '\\', $_SERVER['PATH_TRANSLATED']), 0, 0-strlen($_SERVER['PHP_SELF'])));
}; };

require_once ($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'library' . DIRECTORY_SEPARATOR . 'bootstrap.php'); 
error_reporting(0);

if(isset($_REQUEST["emailList"]) && is_string($_REQUEST["emailList"])) {$emailList = $_REQUEST["emailList"];}
if(isset($_REQUEST["user_ID"]) && is_numeric($_REQUEST["user_ID"])) {$user_ID = (int)$_REQUEST["user_ID"];}
if(isset($_REQUEST["user_email"]) && is_string($_REQUEST["user_email"])) {$user_email = $_REQUEST["user_email"];}
else{$user_email = ADMIN_EMAIL;}
if(isset($_REQUEST["user_name"]) && is_string($_REQUEST["user_name"])) {$user_name = $_REQUEST["user_name"];}
else{$user_name = 'Me';}
//else{return false;}

//$emailList = "this     is a ,test,just, ;; testing ,, some,,,stuff;out;ok  ";

$output = preg_replace('/\s/', ',', $emailList);
$output = preg_replace('/;/', ',', $output);
$output = preg_replace('/\'/', ',', $output);
$output = preg_replace('/[,]+/', ',', $output);

$emailArray = explode(',', $output);
$emailArray = array_filter($emailArray);

$subject = 'Join '.$user_name.' & Try The Current';

$message = '
      
        
<div>
<p class="MsoNormal" align="center" style="text-align:center"><a href="'. SITE_DOMAIN .'" target="_blank"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;color:windowtext;text-decoration:none"><img border="0" width="319" height="107" src="'. SITE_DOMAIN .'/public/images/currentInviteLogo.jpg" alt="cid:image001.jpg@01CE0877.3BA5DFE0"></span></a><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;"><u></u><u></u></span></p>
<p class="MsoNormal"><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;"><u></u>&nbsp;<u></u></span></p>
<p class="MsoNormal"><span style="font-size:14.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;">Join me and try
<i>The Current</i>, a new collaborative tool from IRM/BMP\'s <a href="http://ediplomacy.state.gov/" target="_blank">
<span style="color:blue">Office of eDiplomacy</span></a> that allows you to pull in a wide variety of sources from inside and outside the Department onto a single website -- a kind of personal, continually refreshed, online newspaper for your work. You can
 also discuss items of interest within <i>The Current </i>by sharing items in <a href="http://corridor.state.gov/" target="_blank">
Corridor</a>, the Department\'s internal professional networking service, or in any of the more than 40 active sites in the
<a href="http://wordpress.state.gov/cas" target="_blank"><span style="color:blue">Communities@State program</span></a>.
<u></u><u></u></span></p>
<p class="MsoNormal"><span style="font-size:14.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;"><u></u>&nbsp;<u></u></span></p>
<p class="MsoNormal"><b><span style="font-size:14.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;color:#7030a0">Get Started:<u></u><u></u></span></b></p>
<p class="MsoNormal"><span style="font-size:14.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;">To begin, go to
<a href="'. SITE_DOMAIN .'" target="_blank"><span style="color:blue">'. SITE_DOMAIN .'</span></a>.&nbsp; Please note that although
<i>The Current</i> works with Internet Explorer, it works best in Google Chrome (please see the
<u><span style="color:blue"><a href="'. SITE_DOMAIN .'/faq.php" target="_blank">FAQ</a></span></u> on
<i>The Current </i>for information on using Chrome or Internet Explorer).&nbsp; <span style="">
<u></u><u></u></span></span></p>
<p class="MsoNormal"><b><span style="font-size:14.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;"><u></u>&nbsp;<u></u></span></b></p>
<p class="MsoNormal"><span style="font-size:14.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;">The standard version you see is available to everyone with an OpenNet account.&nbsp; Members of Corridor, the Department\'s professional networking service, can customize their
 version of <i>The Current </i>and share personalized pages with their colleagues or offices.&nbsp; For more information on how to use these customizable features and answers to other questions you may have, check out the
<a href="'. SITE_DOMAIN .'/faq.php" target="_blank"><span style="color:blue">FAQ page</span></a>.&nbsp; For ideas on how to use
<i>The Current</i> in your daily work, see these sample <a href="http://diplopedia.state.gov/index.php?title=The_Current_Use_Cases" target="_blank">
<span style="color:blue">use cases</span></a>.<u></u><u></u></span></p>
<p class="MsoNormal"><b><span style="font-size:14.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;color:#7030a0"><u></u>&nbsp;<u></u></span></b></p>
<p class="MsoNormal"><b><span style="font-size:14.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;color:#7030a0">Share This Invitation:<u></u><u></u></span></b></p>
<p class="MsoNormal"><span style="font-size:14.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;">Feel free share this invitation with interested colleagues in your offices and posts.&nbsp; You can also invite them from
<i>The Current </i>by clicking the <b>Invite Your Colleagues</b> link at the top of the page.<u></u><u></u></span></p>
</div>
        
';

$headers = 'From: eDip Current Admin <'.ADMIN_EMAIL.'>' . "\r\n";
$headers .= 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";


//echo $message;
foreach($emailArray as $key => $value)
{
    mail($value, $subject, $message, $headers);
}


//$output = preg_split( "/ (,| |;) /", $emailList );


?>