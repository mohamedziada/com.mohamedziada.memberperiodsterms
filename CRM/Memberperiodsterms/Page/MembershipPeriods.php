<?php

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
