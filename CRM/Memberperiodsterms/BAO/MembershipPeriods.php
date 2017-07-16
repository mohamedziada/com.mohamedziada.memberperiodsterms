<?php

/**
 * Created by PhpStorm.
 * User: mohamedziada
 * Time: 9:39 PM
 *
 * @package  com.mohamedziada.memberperiodsterms
 *
 * @copyright MohamedZiada (c) 2017
 *
 * BAO stands for business access object.
 * BAOs map to DAOs and extend them with the business logic of CiviCRM.
 */
class CRM_Memberperiodsterms_BAO_MembershipPeriods extends CRM_Memberperiodsterms_DAO_MembershipPeriods
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * This hook is called when composing the tabs interface used for contacts, contributions and events.
     *
     * @link https://docs.civicrm.org/dev/en/master/hooks/hook_civicrm_tabset/
     *
     * @param string $tabsetName -name of the screen or visual element
     * @param array $tabs - the array of tabs that will be displayed
     * @param array $context - extra data about the screen or context in which the tab is used
     * @access public
     * @static
     * @return null - the return value is ignored
     */
    public static function tabset($tabsetName, &$tabs, $context)
    {
        $tableName = 'civicrm_membership_period';
        $rowCount = 0; // number of rows "peroids" for member

        //check if the tabset is Contact Summary Page
        if ($tabsetName == 'civicrm/contact/view') {

            $contactId = $context['contact_id'];
            $queryCount = "SELECT count(*) as rows_count
				  FROM $tableName p
				  INNER JOIN civicrm_membership m ON m.id = p.membership_id
				  WHERE m.contact_id =  $contactId;
				 ";

            $results = CRM_Core_DAO::executeQuery($queryCount, CRM_Core_DAO::$_nullArray);

            if ($results->fetch() && !empty($results->rows_count)) {
                $rowCount = $results->rows_count;
            }

//        echo "<pre>";
//        var_dump($rowCount, $tabs);
//        die();

            // Add a new "Membership Periods/Terms" tab.
            // As long as it is new tab so we add new element in tab array
            $tabs[] = [
                'id' => 'membershipPeriodsTermsTab', // unique value for TAB
                'url' => CRM_Utils_System::url('civicrm/membership_periods?cid=' . $contactId), // URL for click
                'title' => ts('Membership Periods/Terms'), // Display title
                'weight' => 77,// for order details
                'count' => $rowCount, // display after title
//            'class' => 'customOne', // can add custom CSS for the li
//            'valid' => 1,
//            'active' => 1,
//            'current' => false,
            ];

        }
    }


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
     * @access public
     * @static
     * @return null - the return value is ignored
     */
    public static function memberperiod($op, $objectName, $objectId, &$objectRef)
    {


        $tableName = 'civicrm_membership_period';
        // 1- check Object name 'Membership' || 'MembershipPayment'
        // 2- check the Operation "create" || "edit"
        // 3- get the membership Id and membership dates " start & end "
        if ($objectName == "Membership" && ($op == "edit" || $op == "create")) {

            $membershipID = $objectRef->id;
            $membershipStartDate = $objectRef->start_date;
            $membershipEndDate = $objectRef->end_date;
            $membershipJoinDate = $objectRef->join_date;
            $contactID = $objectRef->contact_id;
            $membershipTypeId = $objectRef->membership_type_id;

            ###########
            //Query to get period row with membership if EndDate not changed
            // End Date very impt here cuz it is the period end
            $query = "SELECT * FROM $tableName
                    WHERE end_date = $membershipEndDate 
                    AND membership_id = $membershipID";

            $result = CRM_Core_DAO::executeQuery($query);

            ###########
            // if the membership exit and has been edit
            // maybe edit Start date || join_date || membership_type_id
            if ($result->fetch()) {
                //update row to new date and get row by membershipID and EndDate
                $query = "UPDATE $tableName
                      SET start_date = $membershipStartDate 
                      WHERE membership_id = $membershipID 
                     AND end_date = $membershipEndDate";

            } else {
                ####
                // if membership not exit with end_date OR new membership
                //get last period for membership id, last End_Date
                $queryEndDate = "SELECT end_date 
                        FROM $tableName
                        WHERE membership_id = $membershipID 
                        ORDER BY end_date DESC
                        LIMIT 1";

                $result = CRM_Core_DAO::executeQuery($queryEndDate);

                if (!empty($result->end_date)) {// renewal or edit end_date

                    $newEndDate = new DateTime($result->end_date);
                    $newEndDate->modify('+1 day');// add one day for renewal
                    $newEndDate = $newEndDate->format('Y-m-d');

                    $queryInsert = "INSERT INTO $tableName 
                            (start_date, end_date, membership_id, contribution_id, created_at)
                            VALUES 
                            ('$newEndDate', '$membershipEndDate', $membershipID , null, NOW())";

                } else {// new membership
                    $queryInsert = "INSERT INTO $tableName
                                (start_date, end_date, membership_id, contribution_id, created_at) 
                                VALUES 
                                ('$membershipStartDate', '$membershipEndDate', $membershipID, null, NOW())";
                    // Will update contribution_id when payment made , check code down
                }
                 CRM_Core_DAO::executeQuery($queryInsert);
            }


            ############
            ## The membership period should be connected to a contribution record if a payment is taken for this membership.
            ################
            // updates membership period when membership payment is made.
        } else if ($objectName == "MembershipPayment" && $op == "create") {
            $membershipID = $objectRef->membership_id;
            $contributionID = $objectRef->contribution_id;

            $result = CRM_Core_DAO::executeQuery(
                "SELECT * FROM $tableName WHERE contribution_id = $contributionID AND membership_id = $membershipID "
            );

            // if no row exist with this contribution ID
            if (!($result->fetch())) {
                // update last row with membership ID and contribution ID = null
                $query = "UPDATE $tableName
                      SET contribution_id = $contributionID
                      WHERE membership_id = $membershipID
                      AND contribution_id = null
                      ORDER BY id DESC 
                      LIMIT 1";

                CRM_Core_DAO::executeQuery($query);
            }
        }

    }


}