<?php
/*
function is_assoc ($arr) {
        return (is_array($arr) && count(array_filter(array_keys($arr),'is_string')) == count($arr));
    }

 *
 */
function objectToArray($object)
{
    if(!is_object($object) && !is_array($object))
    {
        return $object;

    }
    if(is_object($object))
    {
        $object = get_object_vars($object);

    }
    return array_map('objectToArray', $object);
}

function render($dir,$template,$vars = array())
{
    extract($vars, EXTR_PREFIX_ALL, substr($template,0,strpos($template,'.')));

    if(!(is_string($template) && is_string($dir)))
    {
        return false;
    }

    foreach($vars as $key => $value)
    {
       //session_register($name);

    }

    include $dir.$template;

    foreach($vars as $key => $value)
    {
       //session_unregister($name);

    }



}

function generateCorridorShare($item)
{
    $link = 'http://corridor.state.gov/';
    $shareurl = $item->get_link();
    $sharetitle = $item->get_title();
    $blogtitle = 'The Current';

    $returnMe = $link . "?shareurl=" . urlencode($shareurl) . "&sharetitle=" . urlencode($sharetitle) . "&blogtitle=" . urlencode($blogtitle);
    return $returnMe;
}

function generateCorridorShareALDACS($shareurl, $sharetitle)
{
    $link = 'http://corridor.state.gov/';

    $blogtitle = 'The Current';

    $returnMe = $link . "?shareurl=" . urlencode($shareurl) . "&sharetitle=" . urlencode($sharetitle) . "&blogtitle=" . urlencode($blogtitle);
    return $returnMe;
}

function generateCorridorGeneral($shareurl, $sharetitle, $blogtitle)
{
    $link = 'http://corridor.state.gov/';

    $returnMe = $link . "?shareurl=" . urlencode($shareurl) . "&sharetitle=" . urlencode($sharetitle) . "&blogtitle=" . urlencode($blogtitle);
    return $returnMe;
}

function prepareArrayForTransit($arr)
{
    if( !is_array($arr))
    {
        return false;

    }

    return addslashes(serialize($arr));

}

function deconstructArrayForTransit($arr)
{
    if( !is_string($arr))
    {
        return false;

    }
    $returnMe = unserialize(stripslashes($arr));
    if( !is_array($returnMe))
    {
        return false;

    }


    return $returnMe;

}

function convertNoKeyPHPArrayToJS($arr)
{
    if( !is_array($arr))
    {
        return false;

    }

    $returnMe = ' var newArrayFromPHP = new Array(); ';

    foreach ($arr as $key => $value)
    {

        $returnMe .= ' newArrayFromPHP.push("'.$value.'") ; ';

    }

    return $returnMe;


}

function generateQueryString($model)
{

    $returnMe = "?";
    foreach($model->returnProperties() as $key => $value)
    {
        if(isset($value) && !empty($value))
        {
        $returnMe .= $key . '=' . addslashes($value);
        $returnMe .= '&';

        }
    }

    $returnMe = substr($returnMe, 0, strlen($returnMe) -1);

    return $returnMe;

}

function parseDomainFromURL($url)
{

    //$domain = "http://www.natelyman.com/component/content/article/36-social-media/50-facebook-fail";

    $pattern = "/[a-zA-Z]{3,5}\:\/\/(?:[a-zA-Z\-1-9]+\.)+?([a-zA-Z\-1-9]+(?:\.[a-zA-Z]{2,6}){1,2})(?:\Z|\/)/is";

    preg_match($pattern,$url,$matches);

    return $matches[1];

}

function truncateText($text, $limit)
{
    if (strlen($text) > $limit)
    {
          //$words = str_word_count($text, 2);
          //$pos = array_keys($words);
          //$text = substr($text, 0, $pos[$limit]) . '...';
        $text = substr($text, 0, $limit).'...';
      }
      return $text;

}

function pullIndex(&$array, $index)
{
    $returnMe = '';
    try
    {
        $returnMe = $array[$index];
    }
    catch (Exception $e)
    {
        //logError($index);
        //logError($array);
    }
    return $returnMe;

}


/*
function prioritySortIds($idsArray)
{
this will have to get fixed
    if(!is_array($idsArray))
    {
        throw new Exception("this only accepts arrays returned from GetIds function");
    }

    $idsArrayTemp = array();
    foreach ($idsArray as $id => $value)
    {
        $idsArrayTemp[$value['priority']] = $value;
    }
    $idsArray = $idsArrayTemp;

    unset($idsArrayTemp);

    return $idsArray;
}
*/

function prioritySort($entitiesArray)
{

    if(!is_array($entitiesArray))
    {
        throw new Exception("this only accepts arrays returned from Get function");
    }

    $ArrayTemp = array();
    foreach ($entitiesArray as $id => $value)
    {
        $tempPriority = $value->get_dashboard_priority();
        $ArrayTemp[$tempPriority] = $value;
    }
    $entitiesArray = $ArrayTemp;

    unset($ArrayTemp);

    return $entitiesArray;
}

function getEntityFromRepoPool($needle, $haystack, $getFunction)
{
    foreach ($haystack as $key => $value) {
        //var_dump($value);
        // echo $value->$getFunction();
        // echo $value->get_entity_id();
        // echo $value->$getFunction() . "-" . $needle;
        // echo '<br/>';
        if($value->$getFunction() == $needle)
        {
            return $value;
        }
    }
    return false;
}


function logError($test)
{
        $sRoot = $_SERVER['DOCUMENT_ROOT'];
        $myFile = $sRoot."/tmp/logs/diagnostic.log";

	$fh = fopen($myFile, 'a') or die("can't open file");

	$stringData = "\n timestamp - " ;
	fwrite($fh, $stringData);
	$startTime = microtime_float();
	fwrite($fh, $startTime );

        $stringData = " = $test " ;
	fwrite($fh, $stringData);

	fclose($fh);
}

function logTiming($message = null, $logName = null, $flushAfter = null, $timingId = null, $backtrace = null)
{
    if(DEVELOPMENT_ENVIRONMENT == false)
    {
        return false;
    }
    $stamp = microtime_float();
     error_reporting(0);

       /*
        $sRoot = $_SERVER['DOCUMENT_ROOT'];
        $myFile = $sRoot."/tmp/logs/diagnostic.php";
        $f = @fopen($myFile, "r+");
        if ($f !== false)
        {
            ftruncate($f, 0);
            fclose($f);
        }
          */

    if(session_id()!= '')
    {
        /*
        $sRoot = $_SERVER['DOCUMENT_ROOT'];
        $myFile = $sRoot."/tmp/logs/diagnostic.php";
        $f = @fopen($myFile, "r+");
        if ($f !== false)
        {
            ftruncate($f, 0);
            fclose($f);
        }
         *
         */
        session_start();
    }
    if(isset($timingId) && $_SESSION[$timingId] == 1)
    {


    }
    else
    {


        $timingId = com_create_guid();

        $_SESSION['DEBUG_ONLOAD_SCRIPT'] = '<script type="text/javascript">';
        $_SESSION['DEBUG_ONLOAD_SCRIPT'] .= 'function show_sub(cat) { cat.parentNode.getElementsByTagName("table")[0].style.display = (cat.parentNode.getElementsByTagName("table")[0].style.display == "none") ? "block" : "none";}';
        $_SESSION['DEBUG_ONLOAD_SCRIPT'] .= '</script>';
        $_SESSION[$timingId] = 1;
        $_SESSION[$timingId.'_CONTENT'] = '<style>';
        $_SESSION[$timingId.'_CONTENT'] .= 'td,th{border:solid 1px black;}';
        $_SESSION[$timingId.'_CONTENT'] .= 'h3{cursor:pointer;font-size:13px; font-weight:normal; padding:0px; margin:0px;}';
        $_SESSION[$timingId.'_CONTENT'] .= '.collapsibleArray li table{display:none;}';
        $_SESSION[$timingId.'_CONTENT'] .= '.collapsibleArray {line-height:1.0;}';
        $_SESSION[$timingId.'_CONTENT'] .= '</style>';
        $_SESSION[$timingId.'_CONTENT'] .= '<table style="border:solid 1px black;border-collapse:collapse;">';
        $_SESSION[$timingId.'_CONTENT'] .= '<tr>';
        $_SESSION[$timingId.'_CONTENT'] .= '<th>';
        $_SESSION[$timingId.'_CONTENT'] .= '#';
        $_SESSION[$timingId.'_CONTENT'] .= '</th>';
        $_SESSION[$timingId.'_CONTENT'] .= '<th>';
        $_SESSION[$timingId.'_CONTENT'] .= 'NOTE';
        $_SESSION[$timingId.'_CONTENT'] .= '</th>';
        $_SESSION[$timingId.'_CONTENT'] .= '<th>';
        $_SESSION[$timingId.'_CONTENT'] .= 'TIME - STAMP';
        $_SESSION[$timingId.'_CONTENT'] .= '</th>';
        $_SESSION[$timingId.'_CONTENT'] .= '<th>';
        $_SESSION[$timingId.'_CONTENT'] .= 'TIME - DIFFERENCE';
        $_SESSION[$timingId.'_CONTENT'] .= '</th>';
        $_SESSION[$timingId.'_CONTENT'] .= '<th>';
        $_SESSION[$timingId.'_CONTENT'] .= 'TIME - TOTAL';
        $_SESSION[$timingId.'_CONTENT'] .= '</th>';

        $_SESSION[$timingId.'_CONTENT'] .= '</tr>';

        $_SESSION[$timingId.'_NAME'] = $logName;
        $_SESSION[$timingId.'_LASTTIME'] = $stamp;
        $_SESSION[$timingId.'_TOTALTIME'] = 0;
        $_SESSION[$timingId.'_BACKTRACE'] = null;
        $_SESSION[$timingId.'_COUNT'] = 0;
        if($backtrace)
        {
            $backtraceOriginalContent = debug_backtrace();
            $backtraceContent = '<ul class="collapsibleArray">';
            foreach($backtraceOriginalContent as $key => $value)
            {

                $backtraceContent .= '<li><h3 onclick="javascript:show_sub(this)"><strong>'.$value["function"].'</strong> <br /> '.$value["file"].'</h3><table>';
                foreach($value as $key2 => $value2)
                {
                    $backtraceContent .= '<tr><td>'.$key2.'</td><td>'.htmlentities($value2).'</td></tr>';
                }
                $backtraceContent .= '</table></li>';
            }
            $backtraceContent .= '</ul>';
            $_SESSION[$timingId.'_BACKTRACE'] = $backtraceContent;
        }

    }


    $difference = $stamp - $_SESSION[$timingId.'_LASTTIME'];
    $total = $difference + $_SESSION[$timingId.'_TOTALTIME'];



    $_SESSION[$timingId.'_CONTENT'] .= '<tr>';

    $_SESSION[$timingId.'_CONTENT'] .= '<td>';
    $_SESSION[$timingId.'_CONTENT'] .= ++$_SESSION[$timingId.'_COUNT'];
    $_SESSION[$timingId.'_CONTENT'] .= '</td>';
    $_SESSION[$timingId.'_CONTENT'] .= '<td>';
    $_SESSION[$timingId.'_CONTENT'] .= $message;
    $_SESSION[$timingId.'_CONTENT'] .= '</td>';
    $_SESSION[$timingId.'_CONTENT'] .= '<td>';
    $_SESSION[$timingId.'_CONTENT'] .= microtime_float();
    $_SESSION[$timingId.'_CONTENT'] .= '</td>';
    $_SESSION[$timingId.'_CONTENT'] .= '<td>';
    $_SESSION[$timingId.'_CONTENT'] .= $difference;
    $_SESSION[$timingId.'_CONTENT'] .= '</td>';
    $_SESSION[$timingId.'_CONTENT'] .= '<td>';
    $_SESSION[$timingId.'_CONTENT'] .= $total;
    $_SESSION[$timingId.'_CONTENT'] .= '</td>';

    $_SESSION[$timingId.'_CONTENT'] .= '</tr>';

    $_SESSION[$timingId.'_LASTTIME'] = $stamp;
    $_SESSION[$timingId.'_TOTALTIME'] = $total;



    if($flushAfter)
    {
        $_SESSION[$timingId.'_CONTENT'] .= '</table>';

        $sRoot = $_SERVER['DOCUMENT_ROOT'];
        $myFile = $sRoot."/tmp/logs/diagnostic.php";

        $fh = fopen($myFile, 'a') or die("can't open file");

        $stringData = "<h2>".$_SESSION[$timingId.'_NAME']."</h2>".$_SESSION['DEBUG_ONLOAD_SCRIPT'].$_SESSION[$timingId.'_CONTENT'] ;
        $stringData .= $_SESSION[$timingId.'_BACKTRACE'];

        fwrite($fh, $stringData);


        fclose($fh);

        unset($_SESSION[$timingId]);
        unset($_SESSION[$timingId.'_NAME']);
        unset($_SESSION[$timingId.'_CONTENT']);
        unset($_SESSION[$timingId.'_BACKTRACE']);
        unset($_SESSION[$timingId.'_LASTTIME']);
        unset($_SESSION[$timingId.'_TOTALTIME']);
        unset($_SESSION[$timingId.'_COUNT']);

        unset($_SESSION['DEBUG_ONLOAD_SCRIPT']);
    }
    return $timingId;
}

function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

function prefixArrayKeys($prefix, array $arr)
{
    $returnMe = array();
    foreach($arr as $key => $value)
    {
        $returnMe[$prefix . "___" . $key] = $value;
    }

    return $returnMe;
}

?>
