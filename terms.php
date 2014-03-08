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
    <u><h1>Terms of Use</h1></u>
</p>
<p>
    There are two ways users can interact with The Current. Users without a Corridor account are presented with a default, non-customizable group of news
    widgets and do not have the option to discuss items in The Current Forum (however they are able to send items by email). Users with a Corridor account will
    have the option to customize the widgets, create tabs and discuss all items to which they have access in The Current Forum. No personal user data is
    stored, but it is accessed by a web service to Corridor to authenticate and access information stored for the user. All Terms of Use that apply to Corridor
    apply for The Current as well.
</p>
<p>
    <strong>Terms of Use</strong>
</p>
<p>
    <strong>1. Privacy Policy</strong>
</p>
<p>
    The Current conforms to privacy rules and regulations as set out by the United States Department of State and the Foreign Affairs Manual (FAM). This
    includes but is not limited to the following:
</p>
<ol>
    <li>
        <p>
            The Current will ensure that personally identifiable information (PII) (see 5 FAM 463) is appropriately protected when collected, maintained and/or
            disseminated. The Department will not use The Current to solicit and collect sensitive PII from individuals. Sensitive PII is a specific set of PII
            data elements, such as Social Security numbers or dates of birth, for which loss of confidentiality, integrity, or availability could be expected
            to have at least a serious adverse effect on the individual based on an overall assessment of data element sensitivity, distinguishability, context
            of use of the PII, and the legal duty to protect the PII.
        </p>
    </li>
    <li>
        <p>
            Users will be notified of the purpose and use of any PII collected by The Current, regardless whether the PII is covered by the Privacy Act (see 5
            FAM 460). Users will be notified whether the Department, independent of the collection by the social media platform, will collect and maintain this
            information in any capacity. PII will only be used in accordance with its permissible statutory purpose. Information collected for one purpose will
            not be used for another purpose without notice to or consent of the subject of the information.
        </p>
    </li>
    <li>
        <p>
            Users are capable of posting unsolicited PII and Privacy Act-covered information on The Current. By default, the user grants permission to the
            Department to see this information when he or she joins The Current and enters this information.
        </p>
    </li>
    <li>
        <p>
            Information placed on The Current is subject to the same Privacy Act restrictions as when releasing non-electronic information.
        </p>
    </li>
    <li>
        <p>
            The Current administrators will report and respond to security incidents if they occur, per the guidance in 5 FAM 775. In the event that either PII
            or national security information is inadvertently lost or disclosed in an unauthorized manner, such loss or disclosure must be reported in
accordance with            <a target="_blank" href="http://a.m.state.sbu/sites/gis/ips/privacy/foremployees/Documents/PII%20Breach%20Brochure_070710.pdf"><u>established procedures</u></a>.
        </p>
    </li>
    <li>
        <p>
            The Current uses persistent cookies (e.g., to create user profiles and login information or website usage metrics) and will comply with the Office
            of Management and Budget Memorandum on persistent cookie usage, as well as Deparment of State social media policies.
        </p>
    </li>
    <li>
        <p>
            The Current is built on a custom PHP platform. Because The Current is built and hosted on the Department’s own servers, there is no additional
            third-party platform privacy policy that pertains to users and content.
        </p>
    </li>
    <li>
        <p>
            Upon signing up for The Current, users’ information will be used in accordance with guidelines set forth in 5 FAM 772.1. Collected data will be
            used to fine-tune the design and functionality of the site. The U.S. Department of State may also use data to perform statistical analyses of the
            collective characteristics, interests, and behaviors of our registered users. The Current does not release protected information to any outside
            companies, organizations, or governments, nor to any third parties not directly involved with administration and development of the site.
        </p>
    </li>
</ol>
<p>
    <strong>2. Sharing Your Content and Information</strong>
</p>
<p>
    Participation in The Current is completely voluntary. Users can choose to participate on two levels: either accessing the default version of the site, or
    by customizing what content to include and participating in the forum. The minimum condition for participation in the customizable version of The Current
    is a Corridor User Account.
</p>
<ol>
    <li>
        <p>
            Information will be displayed on the U.S. Department of State’s OpenNet, and will be accessible to authorized users of the system.
        </p>
    </li>
    <li>
        <p>
            The Department will monitor user-generated content (UGC) and will monitor for clearly inappropriate content (see Users’ Rights and Responsibilites
            below). Site administrators will remove content found to be in violation of any laws, rules, or regulations, if found to be a security breach, or
            in violation of this terms of use agreement.
        </p>
    </li>
    <li>
        <p>
            All user-generated content is subject to the policies and guidelines on records management. Site administrators will be responsible for the
            archiving of material in accordance with approved records disposition schedules. This includes but is not limited to:
        </p>
    </li>
</ol>
<ol>
</ol>
<ul>
    <li>
        <p>
            Content records including comments, links, and other social media communications;
        </p>
    </li>
    <li>
        <p>
            Site management and operations records including design, policy and procedures, and other web management records.
        </p>
    </li>
</ul>
<li>
    <p>
        Content will be archived in accordance with records management guidelines and policies.
    </p>
</li>
<p>
    <strong>3. Users’ Rights and Responsibilities</strong>
</p>
<p>
    The Current is an information aggregation and discussion forum for personnel who are authorized to use the Department of State intranet (OpenNet). Users
    are expected to maintain professional behavior, and to abide by all workplace rules and regulations. These include but are not limited to:
</p>
<ol>
    <li>
        <p>
            User-generated content must be relevant and accurate. Users must keep their language, conduct, and contributions professional, civil, and to the
            point.
        </p>
    </li>
    <li>
        <p>
            Users are responsible for their use of The Current, for any content they post to The Current and for any consequences thereof. When publishing
            information, the content must:
        </p>
    </li>
</ol>
<ol>
</ol>
<ul>
    <li>
        <p>
            Adhere to the content and security policies in 5 FAM 776.3 and 5 FAM 777;
        </p>
    </li>
    <li>
        <p>
            Not promote a personal business or political point of view.
        </p>
    </li>
</ul>
<li>
    <p>
        Users will adhere to copyright considerations as outlined in 5 FAM 794:
    </p>
    <ul>
        <li>
            <p>
                Copyrighted materials must be used only in accordance with current copyright laws, which typically require permission from the copyright owner.
                Refer to 5 FAM 490, Use of Copyrighted Material, for specific policy in this area.
            </p>
        </li>
        <li>
            <p>
                Public information produced by the Department and published on social media sites or applications cannot be copyrighted and is in the public
                domain. No copyright insignia or statement should appear on The Current.
            </p>
        </li>
    </ul>
</li>
<li>
    <p>
        Consistent with 5 FAM 776.4, any user-posted content must be Section 508 compliant.
    </p>
</li>
<li>
    <p>
        The Current is an UNCLASSIFIED service. Users will not contribute:
    </p>
    <ul>
        <li>
            <p>
                Classified information
            </p>
        </li>
        <li>
            <p>
                Sensitive But Unclassified (SBU) information
            </p>
        </li>
        <li>
            <p>
                Not Releasable to Foreign Nationals (NOFORN) information
            </p>
        </li>
        <li>
            <p>
                For Official Use Only (FOUO) information
            </p>
        </li>
        <li>
            <p>
                Personally Identifiable Information (PII) of other people
            </p>
        </li>
        <li>
            <p>
                Sensitive Personally Identifiable Information (PII) about themselves
            </p>
        </li>
    </ul>
</li>
<li>
    <p>
        Users are not permitted to post advertising or solicitation of any kind. Users may post links, but only for informational, not promotional, purposes.
        When non-Federal links are provided, it will be with the understanding that the links contained are for informational purposes only and do not
        necessarily reflect the views or endorsement of the U.S. Government or the U.S. Department of State; and
    </p>
    <ul>
        <li>
            <p>
                Users will not upload viruses or other malicious code.
            </p>
        </li>
        <li>
            <p>
                Users will not solicit login information or access an account belonging to someone else.
            </p>
        </li>
        <li>
            <p>
                Users will not bully, intimidate, or harass any user.
            </p>
        </li>
        <li>
            <p>
                Users will not use The Current to engage in unlawful, misleading, malicious, or discriminatory actions.
            </p>
        </li>
        <li>
            <p>
                Users will not post content or take any action on The Current that infringes or violates someone else’s rights or otherwise violates the law.
            </p>
        </li>
        <li>
            <p>
                The Current administrators reserve the right to remove any content or information posted on The Current if it is determined to violate the
                Terms of Use Agreement.
            </p>
        </li>
        <li>
            <p>
                Repeated violation of these Terms of Use may result in termination of the user’s participation in The Current.
            </p>
        </li>
    </ul>
</li>
<p>
    <strong>4. Changes</strong>
</p>
<ol>
    <li>
        <p>
            The Current may change its terms of use and privacy policy. Any change will be posted on the website so that users will always know what
            information is gathered and how it is used.
        </p>
    </li>
    <li>
        <p>
            The Current can make changes for legal or administrative reasons, or to correct an inaccurate statement, upon notice without opportunity to
            comment.
        </p>
    </li>
</ol>
<p>
    <strong>6. Other</strong>
</p>
<ol>
    <li>
        <p>
            These Terms of Use do not supersede any existing Department policies or regulations.
        </p>
    </li>
    <li>
        <p>
Any questions about the information contained herein can be asked using our contact form or by emailing            <a href="mailto:TheCurrent_admin@state.gov">TheCurrent_admin@state.gov</a>.
        </p>
    </li>
    <li>
        <p>
            As with other Department of State programs, unauthorized or improper use of The Current may result in disciplinary action as well as civil or
            criminal penalties.
        </p>
    </li>
</ol>
<p>
    <a target="_blank" href="http://thecurrent.state.gov/"><u>The Current</u></a>
    is administered by IRM's <a target="_blank" href="http://www.state.gov/m/irm/ediplomacy/"><u>Office of eDiplomacy</u></a>. Employees are responsible for the statements
    they make and the views they express. The information added by users throughout the site should be considered informative, not authoritative. SBU or any
    other USG category of restricted or controlled unclassified information must NOT be posted on The Current. Information discussed or ideas exchanged on this
    site should not be released without appropriate clearance and authorization from the content author and is protected from unauthorized disclosure. External
    links to other internet sites should not be construed as an endorsement of the sites' content.
</p>

<?php
require('/footer.php');
?>
