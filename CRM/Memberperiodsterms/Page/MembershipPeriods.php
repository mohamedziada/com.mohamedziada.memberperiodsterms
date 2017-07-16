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
        CRM_Utils_System::setTitle(ts('Membership Periods/Terms'));
        $tableName = 'civicrm_membership_period';
        $content = [];
        $activeContents = false;
        if (!empty($_GET['cid'])) {
            $contactId = $_GET['cid'];


            $query = "SELECT p.* FROM $tableName p
				  INNER JOIN civicrm_membership m ON m.id = p.membership_id
				  WHERE m.contact_id = %1;
				 ";
            $params = [1 => [$contactId, 'Integer'],];
            $result = CRM_Core_DAO::executeQuery($query, $params);

            if ($result->N > 0) {// if result exits
                $activeContents = true;

                while ($result->fetch()) {
                    $content[] = [
                        'startdate' => $result->start_date,
                        'enddate' => $result->end_date,
                        'membership' => $result->membership_id,
                        'contribution' => $result->contribution_id,
                        'created' => $result->created_at,

                    ];
                }

            } else {
                $activeContents = false;
            }


        }// if $_GET

        $this->assign('contents', $content);
        $this->assign('activeContents', $activeContents);

        parent::run();
    }

}
