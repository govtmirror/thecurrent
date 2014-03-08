<?php


if(!isset($_SERVER['DOCUMENT_ROOT'])){ if(isset($_SERVER['SCRIPT_FILENAME'])){
$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr($_SERVER['SCRIPT_FILENAME'], 0, 0-strlen($_SERVER['PHP_SELF'])));
}; };
if(!isset($_SERVER['DOCUMENT_ROOT'])){ if(isset($_SERVER['PATH_TRANSLATED'])){
$_SERVER['DOCUMENT_ROOT'] = str_replace( '\\', '/', substr(str_replace('\\\\', '\\', $_SERVER['PATH_TRANSLATED']), 0, 0-strlen($_SERVER['PHP_SELF'])));
}; };

require_once ($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'library' . DIRECTORY_SEPARATOR . 'bootstrap.php');
require_once (ROOT . DS . 'header.php');

        error_reporting(E_ALL & ~E_DEPRECATED & ~E_WARNING & ~E_STRICT & ~E_NOTICE);
        ini_set('display_errors','On');

?>
<script type="text/javascript">
    // $(document).ready(function(){

    //     $.ajax({
    //         url: '../../bll/ajaxhandlers/loadCatalog.php',
    //         data: {

    //         },
    //         dataType : 'html',
    //         error: function(jqXHR, textStatus, errorThrown) {
    //             $("#mainer").html(data);
    //             console.log(errorThrown);
    //         },
    //         success: function(data){
    //             $("#mainer").html(data);
    //             console.log(data);
    //         }
    //     });

    // });
</script>

<div id="mainer">

</div>

<?php

$ret = TC_Utility::getFollowers(2);
echo count($ret);
        // $tag = TC_Utility::verifyAndGetTaxonomy('tags');
         // var_dump(verifyAndGetTaxonomyTerm(5, $tag->get_keyValue()));
        //var_dump(TC_Utility::verifyAndGetTag(5));
        // TC_Utility::verifyAndGetTaxonomyTerm(5, $taxonomy_id, $is_active = true)
        // $thing = new TC_THOR_GetContainersForPublicCatalogView_GetRepo();
        // $getPar = new THOR_GetParameterCapsule(array(),
                                                // array(
                                                   // 'searchTerm' => 'a'
                                                    /*'user_id' => SYSTEM_USER_ID,*/
                                                            // 'accessGroupID' => $versionedGroup_id
                                                            /*,
                                                            'accessprofile' => new AccessProfile(ValidAccessProfiles::VOID_VOID,
                                                            ValidAccessTypes::VOID,
                                                            ValidAccessContexts::VOID,
                                                            ValidAccessLevels::BASIC_ACCESS)*///),
                                                // array(),
                                                // array());
        // var_dump($thing->get($getPar));

?>

