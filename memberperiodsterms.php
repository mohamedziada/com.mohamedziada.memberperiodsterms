<?php

require_once 'memberperiodsterms.civix.php';

require_once 'CRM/Core/DAO.php';

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function memberperiodsterms_civicrm_config(&$config)
{
    _memberperiodsterms_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function memberperiodsterms_civicrm_xmlMenu(&$files)
{
    _memberperiodsterms_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function memberperiodsterms_civicrm_install()
{
    _memberperiodsterms_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function memberperiodsterms_civicrm_postInstall()
{
    _memberperiodsterms_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function memberperiodsterms_civicrm_uninstall()
{
    _memberperiodsterms_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function memberperiodsterms_civicrm_enable()
{
    _memberperiodsterms_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function memberperiodsterms_civicrm_disable()
{
    _memberperiodsterms_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function memberperiodsterms_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL)
{
    return _memberperiodsterms_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function memberperiodsterms_civicrm_managed(&$entities)
{
    _memberperiodsterms_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function memberperiodsterms_civicrm_caseTypes(&$caseTypes)
{
    _memberperiodsterms_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_angularModules
 */
function memberperiodsterms_civicrm_angularModules(&$angularModules)
{
    _memberperiodsterms_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function memberperiodsterms_civicrm_alterSettingsFolders(&$metaDataFolders = NULL)
{
    _memberperiodsterms_civix_civicrm_alterSettingsFolders($metaDataFolders);
}


/**
 * This hook is called when composing the tabs interface used for contacts, contributions and events.
 *
 * @link https://docs.civicrm.org/dev/en/master/hooks/hook_civicrm_tabset/
 *
 * @param string $tabsetName -name of the screen or visual element
 * @param array $tabs - the array of tabs that will be displayed
 * @param array $context - extra data about the screen or context in which the tab is used
 *
 * @return null - the return value is ignored
 */
function memberperiodsterms_civicrm_tabset($tabsetName, &$tabs, $context)
{
    $tableName = 'civicrm_membership_period';

    //check if the tabset is Contact Summary Page
    if ($tabsetName == 'civicrm/contact/view') {


        $contactId = $context['contact_id'];
        // let's add a new "Membership period" tab.
        $url = CRM_Utils_System::url('civicrm/membership_periods?cid=' . $contactId);


//        var_dump($url);
//        die();

//        $results = CRM_Core_DAO::executeQuery($period_count);
//        $pcount = 0;
//        while ($results->fetch()) {
//            $pcount++;
//        }
        $tabs[] = [
            'id' => 'membershipPeriodsTermsTab', // unique value for TAB
            'url' => $url, // URL for click
            'title' => 'Membership Periods/Terms', // Display title
            'weight' => 140,// for order details
            'count' => '9', // display after title
        ];

    }
}


function civitest_civicrm_tabset($tabsetName, &$tabs, $context)
{
    //check if the tab set is Event manage
    if ($tabsetName == 'civicrm/event/manage') {
        if (!empty($context)) {
            $eventID = $context['event_id'];
            $url = CRM_Utils_System::url('civicrm/event/manage/volunteer',
                "reset=1&snippet=5&force=1&id=$eventID&action=update&component=event");
            //add a new Volunteer tab along with url
            $tab['volunteer'] = array(
                'title' => ts('Volunteers'),
                'link' => $url,
                'valid' => 1,
                'active' => 1,
                'current' => false,
            );
        } else {
            $tab['volunteer'] = array(
                'title' => ts('Volunteers'),
                'url' => 'civicrm/event/manage/volunteer',
            );
        }
        //Insert this tab into position 4
        $tabs = array_merge(
            array_slice($tabs, 0, 4),
            $tab,
            array_slice($tabs, 4)
        );
    }

    //check if the tabset is Contribution Page
    if ($tabsetName == 'civicrm/admin/contribute') {
        if (!empty($context['contribution_page_id'])) {
            $contribID = $context['contribution_page_id'];
            $url = CRM_Utils_System::url('civicrm/admin/contribute/newtab',
                "reset=1&snippet=5&force=1&id=$contribID&action=update&component=contribution");
            //add a new Volunteer tab along with url
            $tab['newTab'] = array(
                'title' => ts('newTab'),
                'link' => $url,
                'valid' => 1,
                'active' => 1,
                'current' => false,
            );
        }
        if (!empty($context['urlString']) && !empty($context['urlParams'])) {
            $tab[] = array(
                'title' => ts('newTab'),
                'name' => ts('newTab'),
                'url' => $context['urlString'] . 'newtab',
                'qs' => $context['urlParams'],
                'uniqueName' => 'newtab',
            );
        }
        //Insert this tab into position 4
        $tabs = array_merge(
            array_slice($tabs, 0, 4),
            $tab,
            array_slice($tabs, 4)
        );
    }

    //check if the tabset is Contact Summary Page
    if ($tabsetName == 'civicrm/contact/view') {
        // unset the contribition tab, i.e. remove it from the page
        unset($tabs[1]);
        $contactId = $context['contact_id'];
        // let's add a new "contribution" tab with a different name and put it last
        // this is just a demo, in the real world, you would create a url which would
        // return an html snippet etc.
        $url = CRM_Utils_System::url('civicrm/contact/view/contribution',
            "reset=1&snippet=1&force=1&cid=$contactID");
        // $url should return in 4.4 and prior an HTML snippet e.g. '<div><p>....';
        // in 4.5 and higher this needs to be encoded in json.
        // E.g. json_encode(array('content' => <html form snippet as previously provided>));
        // or CRM_Core_Page_AJAX::returnJsonResponse($content) where $content is the html code
        // in the first cases you need to echo the return and then exit,
        // if you use CRM_Core_Page method you do not need to worry about this.
        $tabs[] = array('id' => 'mySupercoolTab',
            'url' => $url,
            'title' => 'Contribution Tab Renamed',
            'weight' => 300,
        );
    }
}


/**
 *  membershipperiods hook_civicrm_post().
 */
/**
 * hook_civicrm_post() This hook is called after a db write on some core objects.
 * @link https://docs.civicrm.org/dev/en/master/hooks/hook_civicrm_post/
 *
 * post hooks are useful for developers building more complex applications and need to perform operations
 * before CiviCRM takes action.
 * This is very applicable when you need to maintain foreign key constraints etc.
 * (when deleting an object, the child objects have to be deleted first).
 *
 * @param string $op - operation being performed with CiviCRM object. ['view' | 'create' | 'edit'| 'delete' | 'trash' |'restore']
 * @param string $objectName -  ['Activity' | 'Contribution' | 'Membership' | 'MembershipPayment' |'Organization' ... ]
 * @param string $objectId -  the unique identifier for the object.
 * @param object $objectRef - the reference to the object if available - call by reference
 */
function memberperiodsterms_civicrm_post($op, $objectName, $objectId, &$objectRef)
{

    $tableName = 'civicrm_membership_period';
    // 1- check Object name 'Membership' || 'MembershipPayment'
    // 2- check the Operation "create" || "edit"
    // 3- get the membership Id and membership dates " start & end "


}
