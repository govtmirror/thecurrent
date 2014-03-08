<?php

require_once('MySQLAdapter.php');
ini_set('display_errors',1);
error_reporting(E_ALL|E_STRICT);

$db = MySQLAdapter::getInstance(array('localhost', 'currentsvc', 'P@ssword1', 'the_current'));

$query = "SELECT DISTINCT user_id from containers";

$db->query($query);

$returnMe = '';
while ($row = $db->fetch()) 
{

	$returnMe .= $row->user_id;
	$returnMe .= ',';
	//array_push($tagarray,$row);
	//array_push($autoTagArray, $row->id . ' / ' .$row->tag);	
}
$returnMe = substr($returnMe, 0, strlen($returnMe) -1);  


$client = new SoapClient('http://thecurrent.state.gov/custom/CorridorUserService.wsdl');
echo $client->getUserInfo($returnMe);


      
//echo $returnMe;

?>