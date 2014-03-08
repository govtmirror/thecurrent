<script type="text/javascript" src="/public/js/jquery-1.7.1.min.js"></script>
<script src="/public/js/functions.js" type="text/javascript"></script>
<?php

if(!isset($_SERVER['DOCUMENT_ROOT'])){ if(isset($_SERVER['SCRIPT_FILENAME'])){
$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr($_SERVER['SCRIPT_FILENAME'], 0, 0-strlen($_SERVER['PHP_SELF'])));
}; };
if(!isset($_SERVER['DOCUMENT_ROOT'])){ if(isset($_SERVER['PATH_TRANSLATED'])){
$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr(str_replace('\\\\', '\\', $_SERVER['PATH_TRANSLATED']), 0, 0-strlen($_SERVER['PHP_SELF'])));
}; };

        require_once ($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'library' . DIRECTORY_SEPARATOR . 'bootstrap.php');        

if(isset($_REQUEST["user_ID"]) && is_numeric($_REQUEST["user_ID"])) {$user_ID = (int)$_REQUEST["user_ID"];}
if(isset($_REQUEST["entity_ID"]) && is_numeric($_REQUEST["entity_ID"])) {$entity_ID = (int)$_REQUEST["entity_ID"];}
if(isset($_REQUEST["priority"]) && is_numeric($_REQUEST["priority"])) {$priority = (int)$_REQUEST["priority"];} 

error_reporting(0);

if(!isset($user_ID))
{
    $user_ID_array = TC_Authenticator::getUserIDAndInitialize();
    $user_ID = $user_ID_array[0];
    //throw new Exception("cannot reorder dashboard tab");
}
if(!isset($entity_ID))
{
    throw new Exception("cannot reorder dashboard tab");
}
if(!isset($priority))
{
    //$priority = 1;
    //throw new Exception("cannot reorder dashboard tab");
    $containerIDs = TC_Utility::getActiveContainerIDsForUser($user_ID,  new TC_DefaultAccessProfile()); //TC_PersistenceUtility::getActiveContainerIDsForUser($user_ID, new TC_DefaultAccessProfile());
    $priority = count($containerIDs) + 1;    
        
}        
        
        

    //$s = new SB_DipnoteWidget();
    //echo serialize($s);


try{
    
    $containerEntity = TC_Utility::shareDashboard($user_ID, $entity_ID, $priority); //TC_PersistenceUtility::shareDashboard($user_ID, $entity_ID, $priority);
    if(empty($containerEntity))
    {
        echo '<input type="hidden" id="isUserAtMaxTabs" name="isUserAtMaxTabs" value="2" />';
        throw new Exception('bad');
        
    }
    $newContainerId = $containerEntity->get_entity_id();
    echo '<input type="hidden" id="isUserAtMaxTabs" name="isUserAtMaxTabs" value="0" />';
    
    }
 catch (Exception $e)
 {
      echo '<input type="hidden" id="isUserAtMaxTabs" name="isUserAtMaxTabs" value="1" />';
     
 }
    
    
        
?>

<script type="text/javascript">
$(document).ready(function(){
    
    if($("#isUserAtMaxTabs").val() == '1')
        {
           alertUserMax(); 
        }
    if($("#isUserAtMaxTabs").val() == '2')
        {
           alert('You must have a Corridor account to accept a shared page. Join Corridor at http://corridor.state.gov'); 
        }
        window.location='/?entity_ID=<?php echo $newContainerId;?>';
});
    

</script>