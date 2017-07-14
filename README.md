# CiviMembershipPeriodsTerms
CiviCRM  stand alone extension 'Membership periods/terms table'

## Overview:
Currently, when a membership is renewed in CiviCRM the “end date” field on the membership itself is extended by the length of the membership as defined in CiviCRM membership type configuration but no record of the actual length of any one period or term is recorded. As such it is not possible to see how many “terms” or “periods” of membership a contact may have had.

I.e. If a membership commenced on 1 Jan 2014 and each term was of 12 months in length, by 1 Jan 2016 the member would be renewing for their 3rd term. 

The terms would be:
* Term/Period 1: 1 Jan 2014 - 31 Dec 2015
* Term/Period 2: 1 Jan 2015 - 31 Dec 2016 
* Term/Period 3: 1 Jan 2016 - 31 Dec 2017

* The aim of this extension is to extend the CiviCRM membership component so that when a membership is created or renewed a record for the membership “period” is recorded.

* The membership period should be connected to a contribution record if a payment is taken for this membership or renewal.

## Requirement:
Create a new CiviCRM extension that creates a new entity (inc database schema install) for the membership period. 
The membership period should have a start date, end date, should be linked to a membership and it should also be possible to display a linked contribution record.

Create an API for this new entity that can be used like a normal CiviCRM API.

Create new functionality that will populate the membership period when a membership record is created or updated. 
Use an appropriate CiviCRM approach for this  (Hint : Check Civicrm Hooks https://wiki.civicrm.org/confluence/display/CRMDOC/Hook+Reference ).

Create a simple but appropriate display somewhere on the contact record to show the membership periods with a link to contribution records if a payment was recorded for the renewal. 

We would suggest that either some modification of the display of memberships to show within each membership the periods, or failing that, a new contact tab would work well.
