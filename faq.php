<?php
/* Redirect browser */
header("Location: http://diplopedia.state.gov/index.php?title=The_Current_FAQ");
/* Make sure that code below does not get executed when we redirect. */
exit;
?>

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

require('/header.php');
?>
<p>
    <a name="_Toc348433115"></a>
    <u><h1>FAQ</h1></u>
</p>

<div id="Table of Contents1" dir="LTR">
    <p>
        <a href="#__RefHeading__727_1629996216">What is The Current?</a>
    </p>
    <p>
        <a href="#__RefHeading__729_1629996216">What is the purpose of The Current?</a>
    </p>
    <p>
        <a href="#__RefHeading__731_1629996216">How can The Current help me?</a>
    </p>
    <p>
        <a href="#__RefHeading__733_1629996216">What kind of information can I view?</a>
    </p>
    <p>
        <a href="#__RefHeading__735_1629996216">What are the features of The Current?</a>
    </p>
    <p>
        <a href="#__RefHeading__737_1629996216">How do I find pages on The Current?</a>
    </p>
    <p>
        <a href="#__RefHeading__681_2102343495">What browser can/should I use?</a>
    </p>
    <p>
        <a href="#__RefHeading__739_1629996216">How do I get to Google Chrome?</a>
    </p>
    <p>
        <a href="#__RefHeading__741_1629996216">What steps do I need to take if I use Internet Explorer?</a>
    </p>
    <p>
        <a href="#__RefHeading__743_1629996216">Can I customize The Current? How?</a>
    </p>
    <p>
        <a href="#__RefHeading__745_1629996216">Why do I need to be a member of Corridor to to customize my version of The Current?</a>
    </p>
    <p>
        <a href="#__RefHeading__747_1629996216">How do I add a personal page?</a>
    </p>
    <p>
        <a href="#__RefHeading__749_1629996216">How do I delete a personal page?</a>
    </p>
    <p>
        <a href="#__RefHeading__751_1629996216">How do I add sources to my personal pages?</a>
    </p>
    <p>
        <a href="#__RefHeading__753_1629996216">How do I change the sources on my personal pages?</a>
    </p>
    <p>
        <a href="#__RefHeading__755_1629996216">How do I make The Current my homepage?</a>
    </p>
    <p>
        <a href="#__RefHeading__757_1629996216">How can I share content from The Current?</a>
    </p>
    <p>
        <a href="#__RefHeading__683_2102343495">Can I share personal pages with colleagues?</a>
    </p>
    <p>
        <a href="#__RefHeading__759_1629996216">How can I integrate The Current with other collaboration tools?</a>
    </p>
    <p>
        <a href="#__RefHeading__763_1629996216">Where can I find other information or provide feedback about The Current?</a>
    </p>
    <p>
        <a href="#__RefHeading__765_1629996216">I've got a question not answered here - whom should I contact?</a>
    </p>
</div>
<h1>
    <a name="_Toc332893518"></a>
    <a name="__RefHeading__727_1629996216"></a>
    <a name="_Toc348433116"></a>
    What is The Current?
</h1>
<p>
    The Current aggregates information sources and encourages discussion and comments about items of interest. A standard version of The Current is available
    to everyone with an OpenNet account. A customizable version is available to members of <a href="http://corridor.state.gov/" target="_blank"><u>Corridor</u></a>, the
    Department's professional networking service.
</p>
<h1>
    <a name="_Toc332893519"></a>
    <a name="__RefHeading__729_1629996216"></a>
    <a name="_Toc348433117"></a>
    What is the purpose of The Current?
</h1>
<ul>
    <li>
        <p>
            To bring a wide range of foreign affairs information to your desktop or mobile device.
        </p>
    </li>
    <li>
        <p>
            To enrich that information by encouraging informal exchanges and collaboration with interested colleagues all over the world.
        </p>
    </li>
</ul>
<h1>
    <a name="_Toc332893520"></a>
    <a name="__RefHeading__731_1629996216"></a>
    <a name="_Toc348433118"></a>
    How can The Current help me?
</h1>
<p>
    We all draw on current information from multiple sources to do our jobs. The Current lets you put many of these sources on a single web page. Sources are
    automatically refreshed to keep information up to date. If you see an item that would interest your colleagues, you can share it with them and can even
    start or join a discussion about it.
</p>
<h1>
    <a name="_Toc332893521"></a>
    <a name="__RefHeading__733_1629996216"></a>
    <a name="_Toc348433119"></a>
    What kind of information can I view?
</h1>
<p>
    You can view a wide array of sources including news media, social media, and Department of State information such as Communities @ State feeds and
    Department Notices. In the future, The Current may also display SMART messages.
</p>
<h1>
    <a name="_Toc332893522"></a>
    <a name="__RefHeading__735_1629996216"></a>
    <a name="_Toc348433120"></a>
    What are the features of The Current?
</h1>
<p>
    The Current has three basic features:
</p>
<ol>
    <li>
        <p>
            <em>Sources</em> display updates from specific intranet or internet based content, e.g., Department Notices, Department press briefings and public
            statements, ALDACs, Communities @ State, Google News, CNN, etc.
        </p>
    </li>

    <li>
        <p>
            <em>Pages</em> aggregate information from up to nine sources, usually of a similar subject matter. There are two types of pages:
        </p>
    
        <ul>
            <li>
                “Global” pages display information pertinent to all Department employees, are centrally managed, and are available to all OpenNet users on The Current.
                Currently, these include a State page, a News page, a Social Media page, and a page including updates about The Current. You cannot customize these, but
                The Current team welcomes suggestions about how to improve them.
            </li>
            <li>
                Corridor members can also create personal pages with up to nine sources, tailored to a specific interest or job requirement.
            </li>
        </ul>
    </li>

    <li>
        <p>
            <em>"Share in"</em> features let you share and begin a discussion about items of interest with colleagues in other collaboration spaces including Corridor
            or by email. You can also add to or join existing discussions if one of your sources is a Community@State website.
            <br/>
            <br/>
            <br/>
        </p>
    </li>
</ol>
<h1>
    <a name="_Toc332893523"></a>
    <a name="__RefHeading__737_1629996216"></a>
    <a name="_Toc348433121"></a>
    How do I find pages on The Current?
</h1>
<p>
    <a name="_Toc348433122"></a>
    In most cases, The Current will open with the State Sources page displayed. When you place your cursor over the "State Source" page tab, an index of global
    and personal pages will display.
</p>
<h1>
    <a name="_Toc348433123"></a>
    <a name="__RefHeading__681_2102343495"></a>
    What browser can/should I use?
</h1>
<p>
The Current is designed to take advantage of features that are common in most modern browsers. However, using the Department-approved    <strong>Google Chrome</strong> will give you the best possible viewing and editing experience.
</p>
<p>
    While The Current will work in <strong>Internet Explorer (IE) 7 and 8</strong>, you must first make an adjustment to your browser settings before the customization features
    will work correctly (see below). Also, we are working to fix a number of display issues. Please let us know about problems by
    using the Feedback button on The Current.
</p>
<h1>
    <a name="_Toc332893524"></a>
    <a name="__RefHeading__739_1629996216"></a>
    <a name="_Toc348433124"></a>
    How do I get to Google Chrome?
</h1>
<p>
    From your OpenNet machine, click on the Start menu, then "All Programs" and you should find Chrome under "Google." You can also add a shortcut to your
    desktop by right clicking on "Google Chrome" and sending it to the desktop.
</p>
<p>
    <em>
        Note: At this time users on Global OpenNet (GO) and at some overseas posts do not have access to Google Chrome and will need to use Internet Explorer
        8. For more information, see the FAQ below on Internet Explorer.
    </em>
</p>
<h1>
    <a name="_Toc332893525"></a>
    <a name="__RefHeading__741_1629996216"></a>
    <a name="_Toc348433125"></a>
    What steps do I need to take if I use Internet Explorer?
</h1>
<p>
    If you use Internet Explorer, you must change your browser settings to ensure that your personal pages and sources are saved and display correctly. From
    the Internet Explorer toolbar or menu, go to "Tools" ----&gt; "Internet Options" From the General Tab under "Browsing History" click on "Settings." Under
"Check for new versions of stored pages" the bubble should be set on "Automatically."    <strong>Change this to "Everytime I visit the webpage" and click "ok."</strong> Click "ok" again to exit the "Internet Options" window.
</p>
<h1>
    <a name="_Toc332893526"></a>
    <a name="__RefHeading__743_1629996216"></a>
    <a name="_Toc348433126"></a>
    Can I customize The Current? How?
</h1>
<p>
    Yes, if you are a member of <a href="http://corridor.state.gov/" target="_blank"><u>Corridor</u></a>, State's internal professional networking platform, you can customize
    your view of The Current. The link in the top right corner entitled "Customize Your Current" will open an edit view of The Current that enables you to add
    up to 10 personal pages, add sources to those pages, or edit and delete your personal pages and sources on them.
</p>
<p>
    If you are not a Corridor member, the link will first take you to the Corridor site where you must agree to the Terms of Use and become a member. Once you
    complete those steps you can customize The Current.
</p>
<h1>
    <a name="_Toc332893527"></a>
    <a name="__RefHeading__745_1629996216"></a>
    <a name="_Toc348433127"></a>
    Why do I need to be a member of Corridor to to customize my version of The Current?
</h1>
<p>
    In order for your changes to be saved, the application needs to know who you are. The Current uses the identification and authentication scheme developed
    for Corridor to remember you. In addition, we encourage the use of Corridor and other Knowledge Leadership programs such as Communities @ State and
    Diplopedia as a means to connect, communicate, and collaborate across the Department.
</p>
<h1>
    <a name="_Toc332893528"></a>
    <a name="__RefHeading__747_1629996216"></a>
    <a name="_Toc348433128"></a>
    How do I add a personal page?
</h1>
<p>
    Click on the "Customize Your Current" link in the top right corner of your display. That will open The Current to the edit mode. To add a Page, click on
    the + that you see immediately after the last listed Page. A popup window will prompt you to name your new Page. Enter the desired Title and select OK. The
    Page will appear at the top with the other Pages. Click on "View Your Current" to save your changes and exit the edit mode.
</p>
<h1>
    <a name="_Toc332893529"></a>
    <a name="__RefHeading__749_1629996216"></a>
    <a name="_Toc348433129"></a>
    How do I delete a personal page?
</h1>
<p>
    Click on the "Customize Your Current" link in the top right corner of your display. That will open The Current to the Edit mode. Find the Page that you
    wish to delete and click on the X that you see to the side. A popup box will ask if you are sure you want to delete the Page. Select OK and the Page will
    disappear. Click on "View Your Current" to exit the edit mode.
</p>
<h1>
    <a name="_Toc332893530"></a>
    <a name="__RefHeading__751_1629996216"></a>
    <a name="_Toc348433130"></a>
    How do I add sources to my personal pages?
</h1>
<p>
    Click on the "Customize Your Current" link in the top right corner of your display. That will open The Current to the Edit mode. Click on the Page where
    you want to add content. The Current allows for nine sources on each Page. Find an open space on your page, indicated by the "Add a New Source +" button.
    Clicking on this button will display a drop down menu with the following options:
</p>
<ul>
    <li>
        <p>
            Custom Sources - Create a Custom Source
        </p>
        <ul>
            <li>
                <p>
                    Website Search - Use a specific term or keyword to find information about a topic on a website.
                </p>
            </li>
            <li>
                <p>
                    RSS Feed - Pull in a known <a href="http://diplopedia.state.gov/index.php?title=Really_Simple_Syndication" target="_blank"><u>RSS Feed</u></a>. Most blogs
                    and websites offer RSS feeds with a specific URL (web address) so you can subscribe to updates from their site. You will need to copy the
                    URL and then paste it into the RSS feed box in The Current.
                </p>
            </li>
            <li>
                <p>
                    Google News Search - Search Google News for a specific keyword.
                </p>
            </li>
            <li>
                <p>
                    YouTube Search - Search YouTube for a specific keyword.
                </p>
            </li>
        </ul>
    </li>
</ul>
<p>
    If a blog does not offer an RSS feed, choose the Website Search option and enter the title and URL as you would for a website search. You do not need to
    enter a search term.
</p>
<p>
    The Current Help Center provides short videos on adding website search, RSS and Google News search sources to your page.
</p>
<ul>
    <li>
        <p>
            Default Internal Sources - Select from a list of default internal sources
        </p>
    </li>
    <li>
        <p>
            Default External Sources - Select from a list of default external sources
        </p>
    </li>
</ul>
<p>
    These options will let you enter the information about the source you want to access. "Title" refers to the title of the source within The Current.
    "Website"or "Feed URL" (where relevant) refer to the web address of the site or source. "Search Term" (where relevant) refers to the words or phrases of
    interest you want searched and pulled into your source.
</p>
<p>
    Once you make your changes click on the "View My Changes" at the bottom right corner to view the new source on the page.
</p>
<h1>
    <a name="_Toc332893531"></a>
    <a name="__RefHeading__753_1629996216"></a>
    <a name="_Toc348433131"></a>
    How do I change the sources on my personal pages?
</h1>
<p>
    Click on the "Customize Your Current" link in the top right corner of your display. That will open The Current to the edit mode. Find the source that you
    wish to change. Click on the icon that looks like a pencil. This will allow you to:
</p>
<ul>
    <li>
        <p>
            Change the position of the source on the page
        </p>
    </li>
    <li>
        <p>
            Create a Custom Source
        </p>
        <ul>
            <li>
                <p>
                    Search a term within a website
                </p>
            </li>
            <li>
                <p>
                    Pull in an RSS Feed
                </p>
            </li>
            <li>
                <p>
                    Search Google News for a specific Keyword
                </p>
            </li>
            <li>
                <p>
                    Search YouTube for a specific Keyword
                </p>
            </li>
        </ul>
    </li>
    <li>
        <p>
            Select from a list of default internal sources
        </p>
    </li>
    <li>
        <p>
            Select from a list of default external sources
        </p>
    </li>
</ul>
<p>
    To change the order of a page in your index, drag and drop the title to the position you want.
</p>
<p>
    To change the location of a source on a page, click the section in the location grid where you want the source to appear.
</p>
<p>
    Once you make your changes click on the "View My Changes" at the bottom right corner to view the new sources on the page.
</p>
<h1>
    <a name="_What_extra_steps"></a>
    <a name="_Toc332893532"></a>
    <a name="__RefHeading__755_1629996216"></a>
    <a name="_Toc348433132"></a>
    How do I make The Current my homepage?
</h1>
<p>
    In Google Chrome, find the triple-bar icon in the upper right corner next to the address bar and click on it. Select "Settings" from the dropdown list. Go
    to the "Appearance" section of the Settings Page and select "Show Home button" then select "Change". Select "Open this page" and, in the new window, type
    http://thecurrent.state.gov, then press "ok'. The Current is now set as your homepage in Google Chrome.
</p>
<p>
    In Internet Explorer click on the 'Tools' menu and then select 'Internet Options'. The first option under the 'General' tab in the new window is labeled
    'Home Page'. Press 'Enter' and type 'http://thecurrent.state.gov', then press 'OK' at the bottom of the window. The Current is now set as one of your home
    page tabs in Internet Explorer.
</p>
<h1>
    <a name="_Toc332893533"></a>
    <a name="__RefHeading__757_1629996216"></a>
    <a name="_Toc348433133"></a>
    How can I share content from The Current?
</h1>
<p>
    Hover your mouse over the article in The Current you wish to share or start a discussion about. To the right of the article, two small gray icons will
    appear. The first icon allows you to share a link directly to the article in Corridor. The second icon allows you to share a link directly to the article
    via email.
</p>
<p>
    If one of your sources is a Community@State or belongs to the Community@State Global Feed on the global State page, a third icon will be available that
    allows you to join an ongoing discussion in the Community where that discussion resides.
</p>
<h1>
    <a name="_Toc348433134"></a>
    <a name="__RefHeading__683_2102343495"></a>
    Can I share personal pages with colleagues?
</h1>
<p>
    <em>Share this page</em>
    enables individuals to email a link to a personal page to colleagues. This could be handy, for instance, when a group of people in an office or embassy
    section needs to receive information from a common set of sources. When the recipient clicks on the link in the email, the page is automatically added as a
    personal (customizable) page to his or her version of The Current. To share a page, click “Customize My Current,” navigate to the page you wish to share
    and click the “Share My Page” button on the bottom right corner of the screen. This will provide you a URL (web address) for the page. Copy this and put it
    in an email to your colleague(s).
</p>
<h1>
    <a name="_Toc332893534"></a>
    <a name="__RefHeading__759_1629996216"></a>
    <a name="_Toc348433135"></a>
    How can I integrate The Current with other collaboration tools?
</h1>
<p>
    If you use other collaboration tools, The Current can simplify the way you interact with the information on those sites. The Current can display data from
    any site that uses RSS feeds and can be accessed by a server on OpenNet. In addition, because Communities@State is hosted on OpenNet, The Current displays
    recent comments to posts directly in the feed, so you can track conversation on specific topics and easily join the conversation.
</p>
<h1>
    <a name="_Toc332893535"></a>
    <a name="__RefHeading__761_1629996216"></a>
    <a name="_Toc332893536"></a>
    <a name="__RefHeading__763_1629996216"></a>
    <a name="_Toc348433136"></a>
    Where can I find other information or provide feedback about The Current?
</h1>
<p>
    The Current's Help Center provides videos and other useful information about The Current (a link to the Help Center is in the toolbar above the Pages). You
    can find tips and updates about The Current and its features on <a href="http://cas.state.gov/thecurrentbuzz/" target="_blank"><u>The Current Buzz</u></a>. You can also
    help make The Current a better resource for all Department of State personnel by sharing any feedback with us at eDipCurrentAdmin@state.sbu.
</p>
<h1>
    <a name="_Toc332893537"></a>
    <a name="__RefHeading__765_1629996216"></a>
    <a name="_Toc348433137"></a>
    I've got a question not answered here - whom should I contact?
</h1>
<p>
    Please contact The Current Team via <a href="mailto:edipcurrentadmin@state.sbu"><u>eDipCurrentAdmin@state.gov</u></a>.
</p>
 <?php
require('/footer.php');
?>
