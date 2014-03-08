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
        //require_once (ROOT . DS . 'header.php');     
        
        
        $accessgroup_id = TC_PersistenceUtility::getSystemGroupID();   
        
        
    for($i = 1001657; $i < 1010000; $i++)
    {
         
        $strat = new TC_DashboardTabRepoStrategy();
        $repo = new Repository($strat);
        TC_PersistenceUtility::initializeNewUser($i);        
        $universalGroupID = TC_PersistenceUtility::getPersonalGroupID($i);
        
        
        
        $statefeedstab = new TC_DashboardTab('State Sources', 'Global State Feeds Tab', ValidDashboardTabViews::STANDARD);
        $statefeeds = new TC_DashboardTab_EntityModel(null, null, $statefeedstab, 1, 1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), $i, 1);
        $repo->loadEntity($statefeeds);
        
        $externalfeedstab = new TC_DashboardTab('News Sources', 'Global External Feeds Tab', ValidDashboardTabViews::STANDARD);
        $externalfeeds = new TC_DashboardTab_EntityModel(null, null, $externalfeedstab, 1, 1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), $i, 2);
        $repo->loadEntity($externalfeeds);
        
        $smfeedstab = new TC_DashboardTab('Social Media', 'Global Social Media Feeds Tab', ValidDashboardTabViews::STANDARD);
        $smfeeds = new TC_DashboardTab_EntityModel(null, null, $smfeedstab, 1, 1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), $i, 3);
        $repo->loadEntity($smfeeds);
        
        $pilotfeedstab = new TC_DashboardTab('The Current', 'Global The Current Feeds Tab', ValidDashboardTabViews::STANDARD);
        $pilotfeeds = new TC_DashboardTab_EntityModel(null, null, $pilotfeedstab, 1, 1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), $i, 4);
        $repo->loadEntity($pilotfeeds);
        
        
        $tabs1 = $repo->save($i, $universalGroupID);
        $tabs = array();
        foreach($tabs1 as $ent)
        {
            $tabs[] = $ent->get_entity_id();
        }
        
        
        $widStrat = new TC_DashboardSourceRepoStrategy();
        $repo->set_strategy($widStrat);
        
        
        $source = new TC_BlankSource('ALDACS', 'ALDACS', 'SSALDACS_Default');
        $sourceEntity = new TC_DashboardSource_EntityModel(null, null, $source, 1, 1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), $i, 1);
        $repo->loadEntity($sourceEntity);
        
        $source = new TC_GenericRSSSource('Department Notices', 'Department Notices', 'JSServerDiverted_Default', 'http://mmsweb.a.state.gov/GpsWeb/RSS/TodaysNotices.aspx');
        $sourceEntity = new TC_DashboardSource_EntityModel(null, null, $source, 1, 1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), $i, 4);
        $repo->loadEntity($sourceEntity);
        
        $source = new TC_GenericRSSSource('Press Briefings', 'Press Briefings', 'JSServerDiverted_Default', 'http://www.state.gov/rss/channels/brief.xml');
        $sourceEntity = new TC_DashboardSource_EntityModel(null, null, $source, 1, 1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), $i, 5);
        $repo->loadEntity($sourceEntity);
        
        $source = new TC_GenericRSSSource('Press Releases', 'Press Releases', 'JSGoogleRSS_Default', 'http://www.state.gov/rss/channels/press.xml');
        $sourceEntity = new TC_DashboardSource_EntityModel(null, null, $source, 1, 1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), $i, 6);
        $repo->loadEntity($sourceEntity);
        
        $source = new TC_GenericRSSSource('Department Announcements', 'Department Announcements', 'JSServerDiverted_Default', 'http://mmsweb.a.state.gov/GpsWeb/RSS/TodaysAnnouncements.aspx');
        $sourceEntity = new TC_DashboardSource_EntityModel(null, null, $source, 1, 1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), $i, 7);
        $repo->loadEntity($sourceEntity);
        
        $source = new TC_MergedRSSSource('Communities @ State Global', 'Communities @ State Global', 'JSServerDiverted_CAS', 'link1=http://wordpress.state.gov/?wpmu-feed$$$full-feed&link2=http://cas.state.gov/?wpmu-feed$$$full-feed');
        $sourceEntity = new TC_DashboardSource_EntityModel(null, null, $source, 1, 1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), $i, 8);
        $repo->loadEntity($sourceEntity);
        
        
        $repo->save($i, $universalGroupID, array('container_id' => $tabs[0]));
        
        
        $source = new TC_GoogleRSSSource('Google News', 'Google News', 'JSGoogleNews_Default', 'news', '');
        $sourceEntity = new TC_DashboardSource_EntityModel(null, null, $source, 1, 1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), $i, 4);
        $repo->loadEntity($sourceEntity);
        
        $source = new TC_GenericRSSSource('AP - World News', 'AP - World News', 'JSGoogleRSS_Default', 'http://hosted.ap.org/lineups/WORLDHEADS-rss_2.0.xml?SITE=WVEC&SECTION=HOME');
        $sourceEntity = new TC_DashboardSource_EntityModel(null, null, $source, 1, 1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), $i, 5);
        $repo->loadEntity($sourceEntity);
        
        $source = new TC_GenericRSSSource('Washington Post - World', 'Washington Post - World', 'JSGoogleRSS_Default', 'http://feeds.washingtonpost.com/rss/world');
        $sourceEntity = new TC_DashboardSource_EntityModel(null, null, $source, 1, 1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), $i, 6);
        $repo->loadEntity($sourceEntity);
        
        $repo->save($i, $universalGroupID, array('container_id' => $tabs[1]));
        
        $source = new TC_GenericRSSSource('Flickr - DoS Channel', 'Flickr - DoS Channel', 'JSGoogleRSS_Default', 'http://api.flickr.com/services/feeds/photos_public.gne?lang=en-us&format=rss2&id=9364837@N06');
        $sourceEntity = new TC_DashboardSource_EntityModel(null, null, $source, 1, 1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), $i, 4);
        $repo->loadEntity($sourceEntity);
        
        $source = new TC_GenericRSSSource('State Youtube Channel', 'State Youtube Channel', 'JSGoogleRSS_Default', 'https://gdata.youtube.com/feeds/api/users/statevideo/uploads?alt=rss');
        $sourceEntity = new TC_DashboardSource_EntityModel(null, null, $source, 1, 1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), $i, 5);
        $repo->loadEntity($sourceEntity);
        
        $source = new TC_GenericRSSSource('Dipnote', 'Dipnote', 'JSGoogleRSS_Default', 'http://feeds.feedburner.com/dipnote');
        $sourceEntity = new TC_DashboardSource_EntityModel(null, null, $source, 1, 1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), $i, 6);
        $repo->loadEntity($sourceEntity);
        
        $repo->save($i, $universalGroupID, array('container_id' => $tabs[2]));
        
        $source = new TC_GenericRSSSource('The Current Discussion', 'The Current Discussion', 'JSServerDiverted_CAS', SITE_DOMAIN .'/'. DISCUSSION_PAGE_FOLDER. '/' . '?feed=rss2');
        $sourceEntity = new TC_DashboardSource_EntityModel(null, null, $source, 1, 1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), $i, 4);
        $repo->loadEntity($sourceEntity);
        
        $source = new TC_GenericRSSSource('The Current Buzz', 'The Current Buzz', 'JSServerDiverted_CAS', 'http://cas.state.gov/thecurrentbuzz/feed/');
        $sourceEntity = new TC_DashboardSource_EntityModel(null, null, $source, 1, 1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), $i, 5);
        $repo->loadEntity($sourceEntity);
        
        $source = new TC_GenericRSSSource('The Current Buzz', 'The Current - Feedback', 'JSServerDiverted_CAS', 'http://cas.state.gov/thecurrentbuzz/feedback/feed/');
        $sourceEntity = new TC_DashboardSource_EntityModel(null, null, $source, 1, 1, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), $i, 6);
        $repo->loadEntity($sourceEntity);
        
        
        $repo->save($i, $universalGroupID, array('container_id' => $tabs[3]));
         
         
        $exampleTabId = array_pop($tabs);
         
        TC_PersistenceUtility::cloneDashboard($i, $exampleTabId, $accessgroup_id);
        TC_PersistenceUtility::cloneDashboard($i, $exampleTabId, $accessgroup_id);
        TC_PersistenceUtility::cloneDashboard($i, $exampleTabId, $accessgroup_id);
        
        
        
        
         
    }
        
        
        
        
?>
