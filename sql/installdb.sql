CREATE TABLE IF NOT EXISTS  `civicrm_membership_period` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,

  `membership_id` int(10) unsigned NOT NULL COMMENT 'FK to Membership table, Soft relation for this ext. memberperiodsterms.',
  `contribution_id` int(10) unsigned DEFAULT NULL COMMENT 'FK to contribution table, Soft relation for this ext. memberperiodsterms.',

  `start_date` date DEFAULT NULL COMMENT 'Beginning of current membership period.',
  `end_date` date DEFAULT NULL COMMENT 'Current membership period expire date.',

  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;