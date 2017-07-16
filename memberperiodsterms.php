<?php

require_once 'memberperiodsterms.civix.php';


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
    $tabs[] = CRM_Memberperiodsterms_BAO_MembershipPeriods::tabset($tabsetName, $tabs, $context);
}


//Delete member should delete the whole record of period

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
    CRM_Memberperiodsterms_BAO_MembershipPeriods::memberperiod($op, $objectName, $objectId, $objectRef);
}


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

