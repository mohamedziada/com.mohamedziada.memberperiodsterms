{include file="CRM/common/jsortable.tpl"}
<div id="membereriods">
    <h3>{ts}All Memberships Periods{/ts}</h3>

    {if $activeContents}
        {strip}
            <table id="active_membership" class="display">
                <thead>
                <tr>
                    <th>{ts}Term/Period{/ts} #</th>
                    <th>{ts}Start Date{/ts}</th>
                    <th>{ts}End Date{/ts}</th>
                    <th>{ts}Created At{/ts}</th>
                    <th>{ts}Actions{/ts}</th>
                </tr>
                </thead>
                {*{foreach from=$activeMembers item=activeMember}*}
                {foreach from=$contents  key=arrayIndex item=memberVal}
                    <tr id="zMembership_{$memberVal.membership}" class="{cycle values="odd-row,even-row"}">

                        <td class="count" data-order="{$arrayIndex+1}">{ts}Term/Period{/ts} {$arrayIndex+1}</td>
                        <td class="crm-membership-start_date"
                            data-order="{$memberVal.startdate}">{$memberVal.startdate|crmDate}</td>
                        <td class="crm-membership-end_date"
                            data-order="{$memberVal.enddate}">{$memberVal.enddate|crmDate}</td>
                        <td class="crm-membership-createdAt"
                            data-order="{$memberVal.created}">{$memberVal.created|crmDate}</td>
                        <td>
                            <a href="{crmURL p='civicrm/membership/view' q="reset=1&id=`$memberVal.membership`&action=view&context=membership&selectedChild=member"}"
                               title="{ts}View member record{/ts}"
                               class="crm-hover-button action-item">{ts}View Membership{/ts}</a>

                        </td>
                    </tr>
                {/foreach}
            </table>
        {/strip}

    {else}
<p>
    No membership periods records
</p>
    {/if}
</div>