<?php
/**
 *
 * The function civicrm_api3() is easier to remember.
 * The version => 3 parameter is not required.
 * Errors are reported as PHP exceptions. You may catch the exceptions or (by default) allow them to bubble up.
 *
 */


/**
 * @param array $params
 */
function civicrm_api3_membership_periods_terms_get($params)
{

    try {
        $contacts = civicrm_api3('Contact', 'get', array(
            'first_name' => 'Alice',
            'last_name' => 'Roberts',
        ));
    }
    catch (CiviCRM_API3_Exception $e) {
        $error = $e->getMessage();
    }
    printf("Found %d item(s)\n", $contacts['count']);

}