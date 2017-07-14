<?php

/**
 * https://docs.civicrm.org/dev/en/master/core/architecture/#page
 *
 * If a CiviCRM screen is not a Form, it is probably a page.
 * Pages files contain a class that extend CRM_Core_Page. Similar to the form class,
 * Pages have methods that are called before the page is displayed to control access,
 * set the title, etc. (preProcess), and when the page is displayed (run).
 * Pages tend to take information from the data access object (DAO) to be displayed to users.
 * In general, each page has an associated template (see below) which is used to create the html of the page.
 *
 */

/**
 * Class CRM_Memberperiodsterms_Page_MembershipPeriods
 *
 * CRM/Memberperiodsterms/Page/MembershipPeriods.php
 * is the controller which coordinates any parsing, validation, business-logic, or database operations.
 *
 */
class CRM_Memberperiodsterms_Page_MembershipPeriods extends CRM_Core_Page
{

    public function run()
    {
        // Example: Set the page-title dynamically; alternatively, declare a static title in xml/Menu/*.xml
        CRM_Utils_System::setTitle(ts('MembershipPeriods'));

        // Example: Assign a variable for use in a template
        $this->assign('currentTime', date('Y-m-d H:i:s'));

        parent::run();
    }

}
