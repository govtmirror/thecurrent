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

        require_once (ROOT . DS . 'header.php');
?>
<p>
    <u><h1>About</h1></u>
</p>

<p>
    The Current is an information aggregation tool that enables individuals to pull in a wide variety of sources from inside and outside the Department onto a single website -- a kind of personal, continually refreshed, online newspaper for their work. The Current also encourages discussion about items of interest by helping users to email the items to colleagues or begin a discussion by sharing an item in <a target="_blank" href="http://corridor.state.gov">Corridor</a>, the Department's internal professional networking service or in any of the more than 40 active sites in the <a target="_blank" href="http://wordpress.state.gov/cas">Communities @ State</a> program.
 </p>
 <p>
The Current is available on OpenNet. Anyone with an OpenNet account can use a standard version of The Current. Department personnel who are members of Corridor can tailor a personal version of The Current.
</p>
 <p>
     Further information about The Current is available in The Current FAQ and in <a target="_blank" href="http://diplopedia.state.gov">Diplopedia</a>.
</p>



<?php
require_once (ROOT . DS . 'footer.php');
?>
