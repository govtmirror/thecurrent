<?php

if(isset($_REQUEST["paramString"]) && is_string($_REQUEST["paramString"])) {$paramString = $_REQUEST["paramString"];}
if(isset($_REQUEST["paramKeyString"]) && is_string($_REQUEST["paramKeyString"])) {$paramKeyString = $_REQUEST["paramKeyString"];}

$tarr = explode('$$$$$', $paramString);
$tarr2 = explode('$$$$$', $paramKeyString);
$tarr3 = array();
for($i = 0; $i < count($tarr); $i++)
{
    $tarr3[$tarr2[$i]] = $tarr[$i];
}
unset($tarr);
unset($tarr2);
echo addslashes(serialize($tarr3));
unset($tarr3);


?>
