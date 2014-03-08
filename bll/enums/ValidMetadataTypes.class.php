<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ValidMetadataTypes
 *
 * @author KottkeDP
 */
class ValidMetadataTypes {

    const DASHBOARD_PRIORITY = 'dashboard_priority';
    const DASHBOARDSOURCE_PRIORITY = 'dashboardsource_priority';


    const TAG = 'tag';
    const CATEGORY = 'category';
    const RATING = 'rating';

    //const CREATED_BY = 'created_by';

    //versioning metadata one per

    const VERSION_INFO = "version_info";
    const USER_VERSION = "user_version";

    const NUMBER_OF_FOLLOWERS = "number_of_followers";

    /*
    const BOUND_PAGE_FOR_VERSION_GROUP = 'bound_page_for_version_group';
    const IS_VERSIONED = 'is_versioned';
    const IS_CURRENT_VERSION = 'is_current_version';
    const VERSION_ORDER_NUMBER = 'version_order_number';
    const VERSION_GROUP_ID = 'version_group_id';
     *
     */

    //versioning metadata many per
    const IS_ACTIVE_VERSION_FOR_USER = 'is_active_version_for_user';


    //const USER = 'user';
    const SHARED_FROM_ENTITY = 'shared_from_entity';


}

?>
