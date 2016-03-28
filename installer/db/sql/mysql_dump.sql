
--
-- Table structure for table `care_accesslog`
--

DROP TABLE IF EXISTS `care_accesslog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_accesslog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datetime` datetime NOT NULL,
  `ip` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lognote` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `userid` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `thisfile` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `fileforward` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `login_success` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_address_citytown`
--

DROP TABLE IF EXISTS `care_address_citytown`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_address_citytown` (
  `nr` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `unece_modifier` char(2) DEFAULT NULL,
  `unece_locode` varchar(15) DEFAULT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `zip_code` varchar(25) NOT NULL DEFAULT '',
  `iso_country_id` char(3) NOT NULL DEFAULT '',
  `unece_locode_type` tinyint(3) unsigned DEFAULT NULL,
  `unece_coordinates` varchar(25) DEFAULT NULL,
  `info_url` varchar(255) DEFAULT NULL,
  `use_frequency` bigint(20) unsigned NOT NULL DEFAULT '0',
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_additional` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`nr`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=491 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_appointment`
--

DROP TABLE IF EXISTS `care_appointment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_appointment` (
  `nr` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL DEFAULT '0',
  `date` date NOT NULL DEFAULT '0000-00-00',
  `time` time NOT NULL DEFAULT '00:00:00',
  `to_dept_id` varchar(25) NOT NULL DEFAULT '',
  `to_dept_nr` smallint(5) unsigned NOT NULL DEFAULT '0',
  `to_personell_nr` int(11) NOT NULL DEFAULT '0',
  `to_personell_name` varchar(60) DEFAULT NULL,
  `purpose` text NOT NULL,
  `urgency` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `remind` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `remind_email` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `remind_mail` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `remind_phone` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `appt_status` varchar(35) NOT NULL DEFAULT 'pending',
  `cancel_by` varchar(255) NOT NULL DEFAULT '',
  `cancel_date` date DEFAULT NULL,
  `cancel_reason` varchar(255) DEFAULT NULL,
  `encounter_class_nr` int(1) NOT NULL DEFAULT '0',
  `encounter_nr` int(11) NOT NULL DEFAULT '0',
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=5716 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_billing_archive`
--

DROP TABLE IF EXISTS `care_billing_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_billing_archive` (
  `bill_no` bigint(20) NOT NULL DEFAULT '0',
  `encounter_nr` int(10) NOT NULL DEFAULT '0',
  `patient_name` tinytext NOT NULL,
  `vorname` varchar(35) NOT NULL DEFAULT '0',
  `bill_date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `bill_amt` double(16,4) NOT NULL DEFAULT '0.0000',
  `payment_date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `payment_mode` text NOT NULL,
  `cheque_no` varchar(10) NOT NULL DEFAULT '0',
  `creditcard_no` varchar(10) NOT NULL DEFAULT '0',
  `paid_by` varchar(15) NOT NULL DEFAULT '0',
  PRIMARY KEY (`bill_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_billing_bill`
--

DROP TABLE IF EXISTS `care_billing_bill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_billing_bill` (
  `bill_bill_no` bigint(20) NOT NULL DEFAULT '0',
  `bill_encounter_nr` int(10) unsigned NOT NULL DEFAULT '0',
  `bill_date_time` date DEFAULT NULL,
  `bill_amount` float(10,2) DEFAULT NULL,
  `bill_outstanding` float(10,2) DEFAULT NULL,
  PRIMARY KEY (`bill_bill_no`),
  KEY `index_bill_patnum` (`bill_encounter_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_billing_bill_item`
--

DROP TABLE IF EXISTS `care_billing_bill_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_billing_bill_item` (
  `bill_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_item_encounter_nr` int(10) unsigned NOT NULL DEFAULT '0',
  `bill_item_code` varchar(5) DEFAULT NULL,
  `bill_item_unit_cost` float(10,2) DEFAULT '0.00',
  `bill_item_units` tinyint(4) DEFAULT NULL,
  `bill_item_amount` float(10,2) DEFAULT NULL,
  `bill_item_date` datetime DEFAULT NULL,
  `bill_item_status` enum('0','1') DEFAULT '0',
  `bill_item_bill_no` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`bill_item_id`),
  KEY `index_bill_item_patnum` (`bill_item_encounter_nr`),
  KEY `index_bill_item_bill_no` (`bill_item_bill_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_billing_final`
--

DROP TABLE IF EXISTS `care_billing_final`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_billing_final` (
  `final_id` tinyint(3) NOT NULL AUTO_INCREMENT,
  `final_encounter_nr` int(10) unsigned NOT NULL DEFAULT '0',
  `final_bill_no` int(11) DEFAULT NULL,
  `final_date` date DEFAULT NULL,
  `final_total_bill_amount` float(10,2) DEFAULT NULL,
  `final_discount` tinyint(4) DEFAULT NULL,
  `final_total_receipt_amount` float(10,2) DEFAULT NULL,
  `final_amount_due` float(10,2) DEFAULT NULL,
  `final_amount_recieved` float(10,2) DEFAULT NULL,
  PRIMARY KEY (`final_id`),
  KEY `index_final_patnum` (`final_encounter_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_billing_item`
--

DROP TABLE IF EXISTS `care_billing_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_billing_item` (
  `item_code` varchar(5) NOT NULL DEFAULT '',
  `item_description` varchar(100) DEFAULT NULL,
  `item_unit_cost` float(10,2) DEFAULT '0.00',
  `item_type` tinytext,
  `item_discount_max_allowed` tinyint(4) unsigned DEFAULT '0',
  `group` varchar(6) DEFAULT '0',
  PRIMARY KEY (`item_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_billing_payment`
--

DROP TABLE IF EXISTS `care_billing_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_billing_payment` (
  `payment_id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `payment_encounter_nr` int(10) unsigned NOT NULL DEFAULT '0',
  `payment_receipt_no` int(11) NOT NULL DEFAULT '0',
  `payment_date` datetime DEFAULT '0000-00-00 00:00:00',
  `payment_cash_amount` float(10,2) DEFAULT '0.00',
  `payment_cheque_no` int(11) DEFAULT '0',
  `payment_cheque_amount` float(10,2) DEFAULT '0.00',
  `payment_creditcard_no` int(25) DEFAULT '0',
  `payment_creditcard_amount` float(10,2) DEFAULT '0.00',
  `payment_amount_total` float(10,2) DEFAULT '0.00',
  PRIMARY KEY (`payment_id`),
  KEY `index_payment_patnum` (`payment_encounter_nr`),
  KEY `index_payment_receipt_no` (`payment_receipt_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_cache`
--

DROP TABLE IF EXISTS `care_cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_cache` (
  `id` varchar(125) NOT NULL DEFAULT '',
  `ctext` text,
  `cbinary` blob,
  `tstamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_cafe_menu`
--

DROP TABLE IF EXISTS `care_cafe_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_cafe_menu` (
  `item` int(11) NOT NULL AUTO_INCREMENT,
  `lang` varchar(10) NOT NULL DEFAULT 'en',
  `cdate` date NOT NULL DEFAULT '0000-00-00',
  `menu` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  UNIQUE KEY `item_2` (`item`),
  KEY `item` (`item`,`lang`),
  KEY `cdate` (`cdate`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_cafe_prices`
--

DROP TABLE IF EXISTS `care_cafe_prices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_cafe_prices` (
  `item` int(11) NOT NULL AUTO_INCREMENT,
  `lang` varchar(10) NOT NULL DEFAULT 'en',
  `productgroup` tinytext NOT NULL,
  `article` tinytext NOT NULL,
  `description` tinytext NOT NULL,
  `price` varchar(10) NOT NULL DEFAULT '',
  `unit` tinytext NOT NULL,
  `pic_filename` tinytext NOT NULL,
  `modify_id` varchar(25) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(25) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `item` (`item`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_category_diagnosis`
--

DROP TABLE IF EXISTS `care_category_diagnosis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_category_diagnosis` (
  `nr` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `category` varchar(35) NOT NULL DEFAULT '',
  `name` varchar(35) NOT NULL DEFAULT '',
  `LD_var` varchar(35) NOT NULL DEFAULT '',
  `short_code` char(1) NOT NULL DEFAULT '',
  `LD_var_short_code` varchar(25) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `hide_from` varchar(255) NOT NULL DEFAULT '0',
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_category_disease`
--

DROP TABLE IF EXISTS `care_category_disease`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_category_disease` (
  `nr` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `group_nr` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `category` varchar(35) NOT NULL DEFAULT '',
  `name` varchar(35) NOT NULL DEFAULT '',
  `LD_var` varchar(35) NOT NULL DEFAULT '',
  `status` varchar(25) NOT NULL DEFAULT '',
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_category_procedure`
--

DROP TABLE IF EXISTS `care_category_procedure`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_category_procedure` (
  `nr` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `category` varchar(35) NOT NULL DEFAULT '',
  `name` varchar(35) NOT NULL DEFAULT '',
  `LD_var` varchar(35) NOT NULL DEFAULT '',
  `short_code` char(1) NOT NULL DEFAULT '',
  `LD_var_short_code` varchar(25) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `hide_from` varchar(255) NOT NULL DEFAULT '0',
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_class_encounter`
--

DROP TABLE IF EXISTS `care_class_encounter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_class_encounter` (
  `class_nr` smallint(6) unsigned NOT NULL DEFAULT '0',
  `class_id` varchar(35) NOT NULL DEFAULT '',
  `name` varchar(35) NOT NULL DEFAULT '',
  `LD_var` varchar(25) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `hide_from` tinyint(4) NOT NULL DEFAULT '0',
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`class_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_class_ethnic_orig`
--

DROP TABLE IF EXISTS `care_class_ethnic_orig`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_class_ethnic_orig` (
  `nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(35) NOT NULL DEFAULT '',
  `LD_var` varchar(35) NOT NULL DEFAULT '',
  `status` varchar(25) NOT NULL DEFAULT '',
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_class_financial`
--

DROP TABLE IF EXISTS `care_class_financial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_class_financial` (
  `class_nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `class_id` varchar(15) NOT NULL DEFAULT '0',
  `type` varchar(25) NOT NULL DEFAULT '0',
  `code` varchar(5) NOT NULL DEFAULT '',
  `name` varchar(35) NOT NULL DEFAULT '',
  `LD_var` varchar(25) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `policy` text NOT NULL,
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`class_nr`),
  KEY `class_2` (`class_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_class_insurance`
--

DROP TABLE IF EXISTS `care_class_insurance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_class_insurance` (
  `class_nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `class_id` varchar(35) NOT NULL DEFAULT '',
  `name` varchar(35) NOT NULL DEFAULT '',
  `LD_var` varchar(25) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`class_nr`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_class_therapy`
--

DROP TABLE IF EXISTS `care_class_therapy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_class_therapy` (
  `nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `group_nr` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `class` varchar(35) NOT NULL DEFAULT '',
  `name` varchar(35) NOT NULL DEFAULT '',
  `LD_var` varchar(25) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `status` varchar(25) NOT NULL DEFAULT '',
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_classif_neonatal`
--

DROP TABLE IF EXISTS `care_classif_neonatal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_classif_neonatal` (
  `nr` smallint(2) unsigned NOT NULL AUTO_INCREMENT,
  `id` varchar(35) NOT NULL DEFAULT '',
  `name` varchar(35) NOT NULL DEFAULT '',
  `LD_var` varchar(35) NOT NULL DEFAULT '',
  `description` varchar(255) DEFAULT NULL,
  `status` varchar(25) NOT NULL DEFAULT '',
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_complication`
--

DROP TABLE IF EXISTS `care_complication`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_complication` (
  `nr` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_nr` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(35) NOT NULL DEFAULT '',
  `LD_var` varchar(35) NOT NULL DEFAULT '',
  `code` varchar(25) DEFAULT NULL,
  `description` varchar(255) NOT NULL DEFAULT '',
  `status` varchar(25) NOT NULL DEFAULT '',
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_config_global`
--

DROP TABLE IF EXISTS `care_config_global`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_config_global` (
  `type` varchar(60) NOT NULL DEFAULT '',
  `value` varchar(255) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_config_user`
--

DROP TABLE IF EXISTS `care_config_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_config_user` (
  `user_id` varchar(100) NOT NULL DEFAULT '',
  `serial_config_data` text NOT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_currency`
--

DROP TABLE IF EXISTS `care_currency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_currency` (
  `item_no` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `short_name` varchar(10) NOT NULL DEFAULT '',
  `long_name` varchar(20) NOT NULL DEFAULT '',
  `info` varchar(50) NOT NULL DEFAULT '',
  `status` varchar(5) NOT NULL DEFAULT '',
  `modify_id` varchar(20) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(20) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `item_no` (`item_no`),
  KEY `short_name` (`short_name`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_department`
--

DROP TABLE IF EXISTS `care_department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_department` (
  `nr` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `id` varchar(60) NOT NULL DEFAULT '',
  `type` varchar(25) NOT NULL DEFAULT '',
  `name_formal` varchar(60) NOT NULL DEFAULT '',
  `name_short` varchar(35) NOT NULL DEFAULT '',
  `name_alternate` varchar(225) DEFAULT NULL,
  `LD_var` varchar(35) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `admit_inpatient` tinyint(1) NOT NULL DEFAULT '0',
  `admit_outpatient` tinyint(1) NOT NULL DEFAULT '0',
  `has_oncall_doc` tinyint(1) NOT NULL DEFAULT '1',
  `has_oncall_nurse` tinyint(1) NOT NULL DEFAULT '1',
  `does_surgery` tinyint(1) NOT NULL DEFAULT '0',
  `this_institution` tinyint(1) NOT NULL DEFAULT '1',
  `is_sub_dept` tinyint(1) NOT NULL DEFAULT '0',
  `parent_dept_nr` tinyint(3) unsigned DEFAULT NULL,
  `work_hours` varchar(100) DEFAULT NULL,
  `consult_hours` varchar(100) DEFAULT NULL,
  `is_inactive` tinyint(1) NOT NULL DEFAULT '0',
  `sort_order` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `address` text,
  `sig_line` varchar(60) DEFAULT NULL,
  `sig_stamp` text,
  `logo_mime_type` varchar(5) DEFAULT NULL,
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `care_dhis_view`
--

DROP TABLE IF EXISTS `care_dhis_view`;
/*!50001 DROP VIEW IF EXISTS `care_dhis_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `care_dhis_view` (
  `element` tinyint NOT NULL,
  `elementid` tinyint NOT NULL,
  `id` tinyint NOT NULL,
  `dhis_und5` tinyint NOT NULL,
  `dhis_und5id` tinyint NOT NULL,
  `age` tinyint NOT NULL,
  `endate` tinyint NOT NULL,
  `periodid` tinyint NOT NULL,
  `dstart` tinyint NOT NULL,
  `edate` tinyint NOT NULL,
  `Cases` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `care_dhis_view_above5`
--

DROP TABLE IF EXISTS `care_dhis_view_above5`;
/*!50001 DROP VIEW IF EXISTS `care_dhis_view_above5`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `care_dhis_view_above5` (
  `element` tinyint NOT NULL,
  `elementid` tinyint NOT NULL,
  `id` tinyint NOT NULL,
  `age` tinyint NOT NULL,
  `endate` tinyint NOT NULL,
  `periodid` tinyint NOT NULL,
  `dstart` tinyint NOT NULL,
  `edate` tinyint NOT NULL,
  `cases` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `care_dhis_view_under5`
--

DROP TABLE IF EXISTS `care_dhis_view_under5`;
/*!50001 DROP VIEW IF EXISTS `care_dhis_view_under5`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `care_dhis_view_under5` (
  `element` tinyint NOT NULL,
  `elementid` tinyint NOT NULL,
  `id` tinyint NOT NULL,
  `age` tinyint NOT NULL,
  `endate` tinyint NOT NULL,
  `periodid` tinyint NOT NULL,
  `dstart` tinyint NOT NULL,
  `edate` tinyint NOT NULL,
  `cases` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `care_diagnosis_localcode`
--

DROP TABLE IF EXISTS `care_diagnosis_localcode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_diagnosis_localcode` (
  `localcode` varchar(12) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `class_sub` varchar(5) NOT NULL DEFAULT '',
  `type` varchar(10) NOT NULL DEFAULT '',
  `inclusive` text NOT NULL,
  `exclusive` text NOT NULL,
  `notes` text NOT NULL,
  `std_code` char(1) NOT NULL DEFAULT '',
  `sub_level` tinyint(4) NOT NULL DEFAULT '0',
  `remarks` text NOT NULL,
  `extra_codes` text NOT NULL,
  `extra_subclass` text NOT NULL,
  `search_keys` varchar(255) NOT NULL DEFAULT '',
  `use_frequency` int(11) NOT NULL DEFAULT '0',
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`localcode`),
  KEY `diagnosis_code` (`localcode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_drg_intern`
--

DROP TABLE IF EXISTS `care_drg_intern`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_drg_intern` (
  `nr` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(12) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `synonyms` text NOT NULL,
  `notes` text,
  `std_code` char(1) NOT NULL DEFAULT '',
  `sub_level` tinyint(1) NOT NULL DEFAULT '0',
  `parent_code` varchar(12) NOT NULL DEFAULT '',
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(25) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(25) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`),
  KEY `nr` (`nr`),
  KEY `code` (`code`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_drg_quicklist`
--

DROP TABLE IF EXISTS `care_drg_quicklist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_drg_quicklist` (
  `nr` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(25) NOT NULL DEFAULT '',
  `code_parent` varchar(25) NOT NULL DEFAULT '',
  `dept_nr` smallint(5) unsigned NOT NULL DEFAULT '0',
  `qlist_type` varchar(25) NOT NULL DEFAULT '0',
  `rank` int(11) NOT NULL DEFAULT '0',
  `status` varchar(15) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(25) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(25) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_drg_related_codes`
--

DROP TABLE IF EXISTS `care_drg_related_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_drg_related_codes` (
  `nr` int(11) NOT NULL AUTO_INCREMENT,
  `group_nr` int(11) unsigned NOT NULL DEFAULT '0',
  `code` varchar(15) NOT NULL DEFAULT '',
  `code_parent` varchar(15) NOT NULL DEFAULT '',
  `code_type` varchar(15) NOT NULL DEFAULT '',
  `rank` int(11) NOT NULL DEFAULT '0',
  `status` varchar(15) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(25) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(25) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_dutyplan_oncall`
--

DROP TABLE IF EXISTS `care_dutyplan_oncall`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_dutyplan_oncall` (
  `nr` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `dept_nr` int(10) unsigned NOT NULL DEFAULT '0',
  `role_nr` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `year` year(4) NOT NULL DEFAULT '0000',
  `month` char(2) NOT NULL DEFAULT '',
  `duty_1_txt` text NOT NULL,
  `duty_2_txt` text NOT NULL,
  `duty_1_pnr` text NOT NULL,
  `duty_2_pnr` text NOT NULL,
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`),
  KEY `dept_nr` (`dept_nr`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_effective_day`
--

DROP TABLE IF EXISTS `care_effective_day`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_effective_day` (
  `eff_day_nr` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`eff_day_nr`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_encounter`
--

DROP TABLE IF EXISTS `care_encounter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_encounter` (
  `encounter_nr` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `encounter_nr_prev` bigint(11) unsigned NOT NULL DEFAULT '0',
  `pid` int(11) NOT NULL DEFAULT '0',
  `encounter_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `encounter_class_nr` smallint(5) unsigned NOT NULL DEFAULT '0',
  `encounter_type` varchar(35) NOT NULL DEFAULT '',
  `encounter_status` varchar(35) NOT NULL DEFAULT '',
  `referrer_diagnosis` varchar(255) NOT NULL DEFAULT '',
  `referrer_recom_therapy` varchar(255) DEFAULT NULL,
  `referrer_dr` varchar(60) NOT NULL DEFAULT '',
  `referrer_dept` varchar(255) NOT NULL DEFAULT '',
  `referrer_institution` varchar(255) NOT NULL DEFAULT '',
  `referrer_notes` text NOT NULL,
  `financial_class_nr` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `insurance_nr` varchar(25) DEFAULT '0',
  `insurance_firm_id` varchar(25) NOT NULL DEFAULT '0',
  `insurance_class_nr` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `insurance_2_nr` varchar(25) DEFAULT '0',
  `insurance_2_firm_id` varchar(25) NOT NULL DEFAULT '0',
  `guarantor_pid` int(11) NOT NULL DEFAULT '0',
  `contact_pid` int(11) NOT NULL DEFAULT '0',
  `contact_relation` varchar(35) NOT NULL DEFAULT '',
  `current_ward_nr` smallint(3) unsigned NOT NULL DEFAULT '0',
  `current_room_nr` smallint(5) unsigned NOT NULL DEFAULT '0',
  `in_ward` tinyint(1) NOT NULL DEFAULT '0',
  `current_dept_nr` smallint(3) unsigned NOT NULL DEFAULT '0',
  `in_dept` tinyint(1) NOT NULL DEFAULT '0',
  `current_firm_nr` smallint(5) unsigned NOT NULL DEFAULT '0',
  `current_att_dr_nr` int(10) NOT NULL DEFAULT '0',
  `consulting_dr` varchar(60) NOT NULL DEFAULT '',
  `extra_service` varchar(25) NOT NULL DEFAULT '',
  `is_discharged` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `discharge_date` date DEFAULT NULL,
  `discharge_time` time DEFAULT NULL,
  `followup_date` date NOT NULL DEFAULT '0000-00-00',
  `followup_responsibility` varchar(255) DEFAULT NULL,
  `post_encounter_notes` text NOT NULL,
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `room` varchar(50) NOT NULL DEFAULT 'GENERAL',
  `medical_service` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`encounter_nr`),
  KEY `pid` (`pid`),
  KEY `encounter_date` (`encounter_date`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_encounter_diagnosis`
--

DROP TABLE IF EXISTS `care_encounter_diagnosis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_encounter_diagnosis` (
  `diagnosis_nr` int(11) NOT NULL AUTO_INCREMENT,
  `encounter_nr` int(11) NOT NULL DEFAULT '0',
  `op_nr` int(10) unsigned NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `code` varchar(25) NOT NULL DEFAULT '',
  `code_parent` varchar(25) NOT NULL DEFAULT '',
  `group_nr` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `code_version` tinyint(4) NOT NULL DEFAULT '0',
  `localcode` varchar(35) NOT NULL DEFAULT '',
  `category_nr` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `type` varchar(35) NOT NULL DEFAULT '',
  `localization` varchar(35) NOT NULL DEFAULT '',
  `diagnosing_clinician` varchar(60) NOT NULL DEFAULT '',
  `diagnosing_dept_nr` smallint(5) unsigned NOT NULL DEFAULT '0',
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`diagnosis_nr`),
  KEY `encounter_nr` (`encounter_nr`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_encounter_diagnostics_report`
--

DROP TABLE IF EXISTS `care_encounter_diagnostics_report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_encounter_diagnostics_report` (
  `item_nr` int(11) NOT NULL AUTO_INCREMENT,
  `report_nr` int(11) NOT NULL DEFAULT '0',
  `reporting_dept_nr` smallint(5) unsigned NOT NULL DEFAULT '0',
  `reporting_dept` varchar(100) NOT NULL DEFAULT '',
  `report_date` date NOT NULL DEFAULT '0000-00-00',
  `report_time` time NOT NULL DEFAULT '00:00:00',
  `encounter_nr` int(10) NOT NULL DEFAULT '0',
  `script_call` varchar(255) NOT NULL DEFAULT '',
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`item_nr`,`report_nr`),
  KEY `report_nr` (`report_nr`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_encounter_drg_intern`
--

DROP TABLE IF EXISTS `care_encounter_drg_intern`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_encounter_drg_intern` (
  `nr` int(11) NOT NULL AUTO_INCREMENT,
  `encounter_nr` int(11) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `group_nr` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `clinician` varchar(60) NOT NULL DEFAULT '',
  `dept_nr` smallint(5) unsigned NOT NULL DEFAULT '0',
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`),
  KEY `encounter_nr` (`encounter_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_encounter_event_signaller`
--

DROP TABLE IF EXISTS `care_encounter_event_signaller`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_encounter_event_signaller` (
  `encounter_nr` int(10) unsigned NOT NULL DEFAULT '0',
  `yellow` tinyint(1) NOT NULL DEFAULT '0',
  `black` tinyint(1) NOT NULL DEFAULT '0',
  `blue_pale` tinyint(1) NOT NULL DEFAULT '0',
  `brown` tinyint(1) NOT NULL DEFAULT '0',
  `pink` tinyint(1) NOT NULL DEFAULT '0',
  `yellow_pale` tinyint(1) NOT NULL DEFAULT '0',
  `red` tinyint(1) NOT NULL DEFAULT '0',
  `green_pale` tinyint(1) NOT NULL DEFAULT '0',
  `violet` tinyint(1) NOT NULL DEFAULT '0',
  `blue` tinyint(1) NOT NULL DEFAULT '0',
  `biege` tinyint(1) NOT NULL DEFAULT '0',
  `orange` tinyint(1) NOT NULL DEFAULT '0',
  `green_1` tinyint(1) NOT NULL DEFAULT '0',
  `green_2` tinyint(1) NOT NULL DEFAULT '0',
  `green_3` tinyint(1) NOT NULL DEFAULT '0',
  `green_4` tinyint(1) NOT NULL DEFAULT '0',
  `green_5` tinyint(1) NOT NULL DEFAULT '0',
  `green_6` tinyint(1) NOT NULL DEFAULT '0',
  `green_7` tinyint(1) NOT NULL DEFAULT '0',
  `rose_1` tinyint(1) NOT NULL DEFAULT '0',
  `rose_2` tinyint(1) NOT NULL DEFAULT '0',
  `rose_3` tinyint(1) NOT NULL DEFAULT '0',
  `rose_4` tinyint(1) NOT NULL DEFAULT '0',
  `rose_5` tinyint(1) NOT NULL DEFAULT '0',
  `rose_6` tinyint(1) NOT NULL DEFAULT '0',
  `rose_7` tinyint(1) NOT NULL DEFAULT '0',
  `rose_8` tinyint(1) NOT NULL DEFAULT '0',
  `rose_9` tinyint(1) NOT NULL DEFAULT '0',
  `rose_10` tinyint(1) NOT NULL DEFAULT '0',
  `rose_11` tinyint(1) NOT NULL DEFAULT '0',
  `rose_12` tinyint(1) NOT NULL DEFAULT '0',
  `rose_13` tinyint(1) NOT NULL DEFAULT '0',
  `rose_14` tinyint(1) NOT NULL DEFAULT '0',
  `rose_15` tinyint(1) NOT NULL DEFAULT '0',
  `rose_16` tinyint(1) NOT NULL DEFAULT '0',
  `rose_17` tinyint(1) NOT NULL DEFAULT '0',
  `rose_18` tinyint(1) NOT NULL DEFAULT '0',
  `rose_19` tinyint(1) NOT NULL DEFAULT '0',
  `rose_20` tinyint(1) NOT NULL DEFAULT '0',
  `rose_21` tinyint(1) NOT NULL DEFAULT '0',
  `rose_22` tinyint(1) NOT NULL DEFAULT '0',
  `rose_23` tinyint(1) NOT NULL DEFAULT '0',
  `rose_24` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`encounter_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_encounter_financial_class`
--

DROP TABLE IF EXISTS `care_encounter_financial_class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_encounter_financial_class` (
  `nr` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `encounter_nr` int(11) NOT NULL DEFAULT '0',
  `class_nr` smallint(3) unsigned NOT NULL DEFAULT '0',
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `date_create` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_encounter_image`
--

DROP TABLE IF EXISTS `care_encounter_image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_encounter_image` (
  `nr` bigint(20) NOT NULL AUTO_INCREMENT,
  `encounter_nr` int(11) NOT NULL DEFAULT '0',
  `shot_date` date NOT NULL DEFAULT '0000-00-00',
  `shot_nr` smallint(6) NOT NULL DEFAULT '0',
  `mime_type` varchar(10) NOT NULL DEFAULT '',
  `upload_date` date NOT NULL DEFAULT '0000-00-00',
  `notes` text NOT NULL,
  `graphic_script` text NOT NULL,
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`),
  KEY `encounter_nr` (`encounter_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_encounter_immunization`
--

DROP TABLE IF EXISTS `care_encounter_immunization`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_encounter_immunization` (
  `nr` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `encounter_nr` int(11) NOT NULL DEFAULT '0',
  `date` date NOT NULL DEFAULT '0000-00-00',
  `type` varchar(60) NOT NULL DEFAULT '',
  `medicine` varchar(60) NOT NULL DEFAULT '',
  `dosage` varchar(60) DEFAULT NULL,
  `application_type_nr` smallint(5) unsigned NOT NULL DEFAULT '0',
  `application_by` varchar(60) DEFAULT NULL,
  `titer` varchar(15) DEFAULT NULL,
  `refresh_date` date DEFAULT NULL,
  `notes` text,
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_encounter_location`
--

DROP TABLE IF EXISTS `care_encounter_location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_encounter_location` (
  `nr` int(11) NOT NULL AUTO_INCREMENT,
  `encounter_nr` int(11) unsigned NOT NULL DEFAULT '0',
  `type_nr` smallint(5) unsigned NOT NULL DEFAULT '0',
  `location_nr` smallint(5) unsigned NOT NULL DEFAULT '0',
  `group_nr` smallint(5) unsigned NOT NULL DEFAULT '0',
  `date_from` date NOT NULL DEFAULT '0000-00-00',
  `date_to` date NOT NULL DEFAULT '0000-00-00',
  `time_from` time DEFAULT '00:00:00',
  `time_to` time DEFAULT NULL,
  `discharge_type_nr` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`,`location_nr`),
  KEY `type` (`type_nr`),
  KEY `location_id` (`location_nr`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_encounter_measurement`
--

DROP TABLE IF EXISTS `care_encounter_measurement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_encounter_measurement` (
  `nr` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `msr_date` date NOT NULL DEFAULT '0000-00-00',
  `msr_time` float(4,2) NOT NULL DEFAULT '0.00',
  `encounter_nr` int(11) unsigned NOT NULL DEFAULT '0',
  `msr_type_nr` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `value` varchar(255) DEFAULT NULL,
  `unit_nr` smallint(5) unsigned DEFAULT NULL,
  `unit_type_nr` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `notes` varchar(255) DEFAULT NULL,
  `measured_by` varchar(35) NOT NULL DEFAULT '',
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`),
  KEY `type` (`msr_type_nr`),
  KEY `encounter_nr` (`encounter_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_encounter_notes`
--

DROP TABLE IF EXISTS `care_encounter_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_encounter_notes` (
  `nr` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `encounter_nr` int(10) unsigned NOT NULL DEFAULT '0',
  `type_nr` smallint(5) unsigned NOT NULL DEFAULT '0',
  `notes` text NOT NULL,
  `short_notes` varchar(25) DEFAULT NULL,
  `aux_notes` varchar(255) DEFAULT NULL,
  `ref_notes_nr` int(10) unsigned NOT NULL DEFAULT '0',
  `personell_nr` int(10) unsigned NOT NULL DEFAULT '0',
  `personell_name` varchar(60) NOT NULL DEFAULT '',
  `send_to_pid` int(11) NOT NULL DEFAULT '0',
  `send_to_name` varchar(60) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `location_type` varchar(35) DEFAULT NULL,
  `location_type_nr` tinyint(3) NOT NULL DEFAULT '0',
  `location_nr` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `location_id` varchar(60) DEFAULT NULL,
  `ack_short_id` varchar(10) NOT NULL DEFAULT '',
  `date_ack` datetime DEFAULT NULL,
  `date_checked` datetime DEFAULT NULL,
  `date_printed` datetime DEFAULT NULL,
  `send_by_mail` tinyint(1) DEFAULT NULL,
  `send_by_email` tinyint(1) DEFAULT NULL,
  `send_by_fax` tinyint(1) DEFAULT NULL,
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`),
  KEY `encounter_nr` (`encounter_nr`),
  KEY `type_nr` (`type_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_encounter_obstetric`
--

DROP TABLE IF EXISTS `care_encounter_obstetric`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_encounter_obstetric` (
  `encounter_nr` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pregnancy_nr` int(11) unsigned NOT NULL DEFAULT '0',
  `hospital_adm_nr` int(11) unsigned NOT NULL DEFAULT '0',
  `patient_class` varchar(60) NOT NULL DEFAULT '',
  `is_discharged_not_in_labour` tinyint(1) DEFAULT NULL,
  `is_re_admission` tinyint(1) DEFAULT NULL,
  `referral_status` varchar(60) DEFAULT NULL,
  `referral_reason` text,
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`encounter_nr`),
  KEY `encounter_nr` (`pregnancy_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_encounter_op`
--

DROP TABLE IF EXISTS `care_encounter_op`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_encounter_op` (
  `nr` int(11) NOT NULL AUTO_INCREMENT,
  `year` varchar(4) NOT NULL DEFAULT '0',
  `dept_nr` smallint(5) unsigned NOT NULL DEFAULT '0',
  `op_room` varchar(10) NOT NULL DEFAULT '0',
  `op_nr` mediumint(9) NOT NULL DEFAULT '0',
  `op_date` date NOT NULL DEFAULT '0000-00-00',
  `op_src_date` varchar(8) NOT NULL DEFAULT '',
  `encounter_nr` int(10) unsigned NOT NULL DEFAULT '0',
  `diagnosis` text NOT NULL,
  `operator` text NOT NULL,
  `assistant` text NOT NULL,
  `scrub_nurse` text NOT NULL,
  `rotating_nurse` text NOT NULL,
  `anesthesia` varchar(30) NOT NULL DEFAULT '',
  `an_doctor` text NOT NULL,
  `op_therapy` text NOT NULL,
  `result_info` text NOT NULL,
  `entry_time` varchar(5) NOT NULL DEFAULT '',
  `cut_time` varchar(5) NOT NULL DEFAULT '',
  `close_time` varchar(5) NOT NULL DEFAULT '',
  `exit_time` varchar(5) NOT NULL DEFAULT '',
  `entry_out` text NOT NULL,
  `cut_close` text NOT NULL,
  `wait_time` text NOT NULL,
  `bandage_time` text NOT NULL,
  `repos_time` text NOT NULL,
  `encoding` longtext NOT NULL,
  `doc_date` varchar(10) NOT NULL DEFAULT '',
  `doc_time` varchar(5) NOT NULL DEFAULT '',
  `duty_type` varchar(15) NOT NULL DEFAULT '',
  `material_codedlist` text NOT NULL,
  `container_codedlist` text NOT NULL,
  `icd_code` text NOT NULL,
  `ops_code` text NOT NULL,
  `ops_intern_code` text NOT NULL,
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`),
  KEY `dept` (`dept_nr`),
  KEY `op_room` (`op_room`),
  KEY `op_date` (`op_date`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_encounter_prescription`
--

DROP TABLE IF EXISTS `care_encounter_prescription`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_encounter_prescription` (
  `nr` int(11) NOT NULL AUTO_INCREMENT,
  `encounter_nr` int(10) unsigned NOT NULL DEFAULT '0',
  `prescription_type_nr` smallint(5) unsigned NOT NULL DEFAULT '0',
  `article` varchar(100) NOT NULL DEFAULT '',
  `article_item_number` varchar(50) NOT NULL DEFAULT '',
  `price` varchar(255) NOT NULL DEFAULT '',
  `drug_class` varchar(60) NOT NULL DEFAULT '',
  `order_nr` int(11) NOT NULL DEFAULT '0',
  `dosage` varchar(255) NOT NULL,
  `times_per_day` smallint(10) NOT NULL DEFAULT '0',
  `days` smallint(10) NOT NULL DEFAULT '0',
  `total_dosage` varchar(255) NOT NULL,
  `application_type_nr` smallint(5) unsigned NOT NULL DEFAULT '0',
  `notes` text NOT NULL,
  `prescribe_date` date DEFAULT NULL,
  `prescriber` varchar(60) NOT NULL DEFAULT '',
  `taken` tinyint(1) NOT NULL,
  `color_marker` varchar(10) NOT NULL DEFAULT '',
  `is_stopped` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_outpatient_prescription` tinyint(11) unsigned NOT NULL DEFAULT '0',
  `issuer` varchar(35) NOT NULL,
  `is_disabled` varchar(255) DEFAULT NULL,
  `disable_id` varchar(35) NOT NULL,
  `disable_date` date NOT NULL,
  `stop_date` date DEFAULT NULL,
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `bill_number` bigint(20) NOT NULL DEFAULT '0',
  `bill_status` varchar(10) NOT NULL DEFAULT '',
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `priority` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`nr`),
  KEY `encounter_nr` (`encounter_nr`),
  KEY `IX_ARTICLE_ITEM_NUMBER` (`article_item_number`),
  KEY `article` (`article`),
  KEY `prescribe_date` (`prescribe_date`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_encounter_prescription_notes`
--

DROP TABLE IF EXISTS `care_encounter_prescription_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_encounter_prescription_notes` (
  `nr` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `prescription_nr` int(10) unsigned NOT NULL DEFAULT '0',
  `notes` varchar(35) DEFAULT NULL,
  `short_notes` varchar(25) DEFAULT NULL,
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_encounter_procedure`
--

DROP TABLE IF EXISTS `care_encounter_procedure`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_encounter_procedure` (
  `procedure_nr` int(11) NOT NULL AUTO_INCREMENT,
  `encounter_nr` int(11) NOT NULL DEFAULT '0',
  `op_nr` int(11) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `code` varchar(25) NOT NULL DEFAULT '',
  `code_parent` varchar(25) NOT NULL DEFAULT '',
  `group_nr` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `code_version` tinyint(4) NOT NULL DEFAULT '0',
  `localcode` varchar(35) NOT NULL DEFAULT '',
  `category_nr` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `localization` varchar(35) NOT NULL DEFAULT '',
  `responsible_clinician` varchar(60) NOT NULL DEFAULT '',
  `responsible_dept_nr` smallint(5) unsigned NOT NULL DEFAULT '0',
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`procedure_nr`),
  KEY `encounter_nr` (`encounter_nr`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_encounter_sickconfirm`
--

DROP TABLE IF EXISTS `care_encounter_sickconfirm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_encounter_sickconfirm` (
  `nr` int(11) NOT NULL AUTO_INCREMENT,
  `encounter_nr` int(11) NOT NULL DEFAULT '0',
  `date_confirm` date NOT NULL DEFAULT '0000-00-00',
  `date_start` date NOT NULL DEFAULT '0000-00-00',
  `date_end` date NOT NULL DEFAULT '0000-00-00',
  `date_create` date NOT NULL DEFAULT '0000-00-00',
  `diagnosis` text NOT NULL,
  `dept_nr` smallint(6) NOT NULL DEFAULT '0',
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`),
  KEY `encounter_nr` (`encounter_nr`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_group`
--

DROP TABLE IF EXISTS `care_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_group` (
  `nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `id` varchar(35) NOT NULL DEFAULT '',
  `name` varchar(35) NOT NULL DEFAULT '',
  `LD_var` varchar(35) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `status` varchar(25) NOT NULL DEFAULT '',
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_icd10_bs`
--

DROP TABLE IF EXISTS `care_icd10_bs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_icd10_bs` (
  `diagnosis_code` varchar(12) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `class_sub` varchar(5) NOT NULL DEFAULT '',
  `type` varchar(10) NOT NULL DEFAULT '',
  `inclusive` text NOT NULL,
  `exclusive` text NOT NULL,
  `notes` text NOT NULL,
  `std_code` char(1) NOT NULL DEFAULT '',
  `sub_level` tinyint(4) NOT NULL DEFAULT '0',
  `remarks` text NOT NULL,
  `extra_codes` text NOT NULL,
  `extra_subclass` text NOT NULL,
  PRIMARY KEY (`diagnosis_code`),
  KEY `diagnosis_code` (`diagnosis_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_icd10_de`
--

DROP TABLE IF EXISTS `care_icd10_de`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_icd10_de` (
  `diagnosis_code` varchar(12) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `class_sub` varchar(5) NOT NULL DEFAULT '',
  `type` varchar(10) NOT NULL DEFAULT '',
  `inclusive` text NOT NULL,
  `exclusive` text NOT NULL,
  `notes` text NOT NULL,
  `std_code` char(1) NOT NULL DEFAULT '',
  `sub_level` tinyint(4) NOT NULL DEFAULT '0',
  `remarks` text NOT NULL,
  `extra_codes` text NOT NULL,
  `extra_subclass` text NOT NULL,
  KEY `diagnosis_code` (`diagnosis_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_icd10_en`
--

DROP TABLE IF EXISTS `care_icd10_en`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_icd10_en` (
  `diagnosis_code` varchar(12) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `class_sub` varchar(5) NOT NULL DEFAULT '',
  `type` varchar(10) NOT NULL DEFAULT '',
  `inclusive` text NOT NULL,
  `exclusive` text NOT NULL,
  `notes` text NOT NULL,
  `std_code` char(1) NOT NULL DEFAULT '',
  `sub_level` tinyint(4) NOT NULL DEFAULT '0',
  `remarks` text NOT NULL,
  `extra_codes` text NOT NULL,
  `extra_subclass` text NOT NULL,
  PRIMARY KEY (`diagnosis_code`),
  KEY `diagnosis_code` (`diagnosis_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_icd10_es`
--

DROP TABLE IF EXISTS `care_icd10_es`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_icd10_es` (
  `diagnosis_code` varchar(12) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `class_sub` varchar(5) NOT NULL DEFAULT '',
  `type` varchar(10) NOT NULL DEFAULT '',
  `inclusive` text NOT NULL,
  `exclusive` text NOT NULL,
  `notes` text NOT NULL,
  `std_code` char(1) NOT NULL DEFAULT '',
  `sub_level` tinyint(4) NOT NULL DEFAULT '0',
  `remarks` text NOT NULL,
  `extra_codes` text NOT NULL,
  `extra_subclass` text NOT NULL,
  PRIMARY KEY (`diagnosis_code`),
  KEY `diagnosis_code` (`diagnosis_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_icd10_pt_br`
--

DROP TABLE IF EXISTS `care_icd10_pt_br`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_icd10_pt_br` (
  `diagnosis_code` varchar(12) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `class_sub` varchar(5) NOT NULL DEFAULT '',
  `type` varchar(10) NOT NULL DEFAULT '',
  `inclusive` text NOT NULL,
  `exclusive` text NOT NULL,
  `notes` text NOT NULL,
  `std_code` char(1) NOT NULL DEFAULT '',
  `sub_level` tinyint(4) NOT NULL DEFAULT '0',
  `remarks` text NOT NULL,
  `extra_codes` text NOT NULL,
  `extra_subclass` text NOT NULL,
  PRIMARY KEY (`diagnosis_code`),
  KEY `diagnosis_code` (`diagnosis_code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_img_diagnostic`
--

DROP TABLE IF EXISTS `care_img_diagnostic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_img_diagnostic` (
  `nr` bigint(20) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL DEFAULT '0',
  `encounter_nr` int(11) NOT NULL DEFAULT '0',
  `doc_ref_ids` varchar(255) DEFAULT NULL,
  `img_type` varchar(10) NOT NULL DEFAULT '',
  `max_nr` tinyint(2) DEFAULT '0',
  `upload_date` date NOT NULL DEFAULT '0000-00-00',
  `cancel_date` date NOT NULL DEFAULT '0000-00-00',
  `cancel_by` varchar(35) DEFAULT NULL,
  `notes` text,
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`),
  KEY `encounter_nr` (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_insurance_firm`
--

DROP TABLE IF EXISTS `care_insurance_firm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_insurance_firm` (
  `firm_id` varchar(40) NOT NULL DEFAULT '',
  `name` varchar(60) NOT NULL DEFAULT '',
  `iso_country_id` char(3) NOT NULL DEFAULT '',
  `sub_area` varchar(60) NOT NULL DEFAULT '',
  `type_nr` smallint(5) unsigned NOT NULL DEFAULT '0',
  `addr` varchar(255) DEFAULT NULL,
  `addr_mail` varchar(200) DEFAULT NULL,
  `addr_billing` varchar(200) DEFAULT NULL,
  `addr_email` varchar(60) DEFAULT NULL,
  `phone_main` varchar(35) DEFAULT NULL,
  `phone_aux` varchar(35) DEFAULT NULL,
  `fax_main` varchar(35) DEFAULT NULL,
  `fax_aux` varchar(35) DEFAULT NULL,
  `contact_person` varchar(60) DEFAULT NULL,
  `contact_phone` varchar(35) DEFAULT NULL,
  `contact_fax` varchar(35) DEFAULT NULL,
  `contact_email` varchar(60) DEFAULT NULL,
  `use_frequency` bigint(20) unsigned NOT NULL DEFAULT '0',
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`firm_id`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_mail_private`
--

DROP TABLE IF EXISTS `care_mail_private`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_mail_private` (
  `recipient` varchar(60) NOT NULL DEFAULT '',
  `sender` varchar(60) NOT NULL DEFAULT '',
  `sender_ip` varchar(60) NOT NULL DEFAULT '',
  `cc` varchar(255) NOT NULL DEFAULT '',
  `bcc` varchar(255) NOT NULL DEFAULT '',
  `subject` varchar(255) NOT NULL DEFAULT '',
  `body` text NOT NULL,
  `sign` varchar(255) NOT NULL DEFAULT '',
  `ask4ack` tinyint(4) NOT NULL DEFAULT '0',
  `reply2` varchar(255) NOT NULL DEFAULT '',
  `attachment` varchar(255) NOT NULL DEFAULT '',
  `attach_type` varchar(30) NOT NULL DEFAULT '',
  `read_flag` tinyint(4) NOT NULL DEFAULT '0',
  `mailgroup` varchar(60) NOT NULL DEFAULT '',
  `maildir` varchar(60) NOT NULL DEFAULT '',
  `exec_level` tinyint(4) NOT NULL DEFAULT '0',
  `exclude_addr` text NOT NULL,
  `send_dt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `send_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `uid` varchar(255) NOT NULL DEFAULT '',
  KEY `recipient` (`recipient`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_mail_private_users`
--

DROP TABLE IF EXISTS `care_mail_private_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_mail_private_users` (
  `user_name` varchar(60) NOT NULL DEFAULT '',
  `email` varchar(60) NOT NULL DEFAULT '',
  `alias` varchar(60) NOT NULL DEFAULT '',
  `pw` varchar(255) NOT NULL DEFAULT '',
  `inbox` longtext NOT NULL,
  `sent` longtext NOT NULL,
  `drafts` longtext NOT NULL,
  `trash` longtext NOT NULL,
  `lastcheck` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lock_flag` tinyint(4) NOT NULL DEFAULT '0',
  `addr_book` text NOT NULL,
  `addr_quick` tinytext NOT NULL,
  `secret_q` tinytext NOT NULL,
  `secret_q_ans` tinytext NOT NULL,
  `public` tinyint(4) NOT NULL DEFAULT '0',
  `sig` tinytext NOT NULL,
  `append_sig` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_med_ordercatalog`
--

DROP TABLE IF EXISTS `care_med_ordercatalog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_med_ordercatalog` (
  `item_no` int(11) NOT NULL AUTO_INCREMENT,
  `dept_nr` int(3) NOT NULL DEFAULT '0',
  `hit` int(11) NOT NULL DEFAULT '0',
  `artikelname` tinytext NOT NULL,
  `bestellnum` varchar(20) NOT NULL DEFAULT '',
  `minorder` int(4) NOT NULL DEFAULT '0',
  `maxorder` int(4) NOT NULL DEFAULT '0',
  `proorder` tinytext NOT NULL,
  PRIMARY KEY (`item_no`),
  KEY `item_no` (`item_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_med_orderlist`
--

DROP TABLE IF EXISTS `care_med_orderlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_med_orderlist` (
  `order_nr` int(11) NOT NULL AUTO_INCREMENT,
  `dept_nr` int(3) NOT NULL DEFAULT '0',
  `order_date` date NOT NULL DEFAULT '0000-00-00',
  `order_time` time NOT NULL DEFAULT '00:00:00',
  `articles` text NOT NULL,
  `extra1` tinytext NOT NULL,
  `extra2` text NOT NULL,
  `validator` tinytext NOT NULL,
  `ip_addr` tinytext NOT NULL,
  `priority` tinytext NOT NULL,
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `sent_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `process_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`order_nr`),
  KEY `item_nr` (`order_nr`),
  KEY `dept` (`dept_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_med_products_main`
--

DROP TABLE IF EXISTS `care_med_products_main`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_med_products_main` (
  `bestellnum` varchar(25) NOT NULL DEFAULT '',
  `artikelnum` tinytext NOT NULL,
  `industrynum` tinytext NOT NULL,
  `artikelname` tinytext NOT NULL,
  `generic` tinytext NOT NULL,
  `description` text NOT NULL,
  `packing` tinytext NOT NULL,
  `minorder` int(4) NOT NULL DEFAULT '0',
  `maxorder` int(4) NOT NULL DEFAULT '0',
  `proorder` tinytext NOT NULL,
  `picfile` tinytext NOT NULL,
  `encoder` tinytext NOT NULL,
  `enc_date` tinytext NOT NULL,
  `enc_time` tinytext NOT NULL,
  `lock_flag` tinyint(1) NOT NULL DEFAULT '0',
  `medgroup` text NOT NULL,
  `cave` tinytext NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`bestellnum`),
  KEY `bestellnum` (`bestellnum`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_med_report`
--

DROP TABLE IF EXISTS `care_med_report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_med_report` (
  `report_nr` int(11) NOT NULL AUTO_INCREMENT,
  `dept` varchar(15) NOT NULL DEFAULT '',
  `report` text NOT NULL,
  `reporter` varchar(25) NOT NULL DEFAULT '',
  `id_nr` varchar(15) NOT NULL DEFAULT '',
  `report_date` date NOT NULL DEFAULT '0000-00-00',
  `report_time` time NOT NULL DEFAULT '00:00:00',
  `status` varchar(20) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`report_nr`),
  KEY `report_nr` (`report_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_menu_main`
--

DROP TABLE IF EXISTS `care_menu_main`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_menu_main` (
  `nr` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `sort_nr` tinyint(2) NOT NULL DEFAULT '0',
  `name` varchar(35) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `LD_var` varchar(35) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `url` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `is_visible` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `hide_by` text COLLATE latin1_general_ci,
  `status` varchar(25) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `modify_id` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modify_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_menu_sub`
--

DROP TABLE IF EXISTS `care_menu_sub`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_menu_sub` (
  `s_nr` int(11) NOT NULL DEFAULT '0',
  `s_sort_nr` int(11) NOT NULL DEFAULT '0',
  `s_main_nr` int(11) NOT NULL DEFAULT '0',
  `s_ebene` int(11) NOT NULL DEFAULT '0',
  `s_name` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `s_LD_var` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `s_url` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `s_url_ext` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `s_image` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `s_open_image` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `s_is_visible` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `s_hide_by` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `s_status` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `s_modify_id` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `s_modify_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_method_induction`
--

DROP TABLE IF EXISTS `care_method_induction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_method_induction` (
  `nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `group_nr` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `method` varchar(35) NOT NULL DEFAULT '',
  `name` varchar(35) NOT NULL DEFAULT '',
  `LD_var` varchar(35) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `status` varchar(25) NOT NULL DEFAULT '',
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_mode_delivery`
--

DROP TABLE IF EXISTS `care_mode_delivery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_mode_delivery` (
  `nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `group_nr` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `mode` varchar(35) NOT NULL DEFAULT '',
  `name` varchar(35) NOT NULL DEFAULT '',
  `LD_var` varchar(35) NOT NULL DEFAULT '',
  `description` varchar(255) DEFAULT NULL,
  `status` varchar(25) NOT NULL DEFAULT '',
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_neonatal`
--

DROP TABLE IF EXISTS `care_neonatal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_neonatal` (
  `nr` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) unsigned NOT NULL DEFAULT '0',
  `delivery_date` date NOT NULL DEFAULT '0000-00-00',
  `parent_encounter_nr` int(11) unsigned NOT NULL DEFAULT '0',
  `delivery_nr` tinyint(4) NOT NULL DEFAULT '0',
  `encounter_nr` int(11) unsigned NOT NULL DEFAULT '0',
  `delivery_place` varchar(60) NOT NULL DEFAULT '',
  `delivery_mode` tinyint(2) NOT NULL DEFAULT '0',
  `c_s_reason` text,
  `born_before_arrival` tinyint(1) DEFAULT '0',
  `face_presentation` tinyint(1) NOT NULL DEFAULT '0',
  `posterio_occipital_position` tinyint(1) NOT NULL DEFAULT '0',
  `delivery_rank` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `apgar_1_min` tinyint(4) NOT NULL DEFAULT '0',
  `apgar_5_min` tinyint(4) NOT NULL DEFAULT '0',
  `apgar_10_min` tinyint(4) NOT NULL DEFAULT '0',
  `time_to_spont_resp` tinyint(2) DEFAULT NULL,
  `condition` varchar(60) DEFAULT '0',
  `weight` float(8,2) unsigned DEFAULT NULL,
  `length` float(8,2) unsigned DEFAULT NULL,
  `head_circumference` float(8,2) unsigned DEFAULT NULL,
  `scored_gestational_age` float(4,2) unsigned DEFAULT NULL,
  `feeding` tinyint(4) NOT NULL DEFAULT '0',
  `congenital_abnormality` varchar(125) NOT NULL DEFAULT '',
  `classification` varchar(255) NOT NULL DEFAULT '0',
  `disease_category` tinyint(2) NOT NULL DEFAULT '0',
  `outcome` tinyint(2) NOT NULL DEFAULT '0',
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`),
  KEY `pid` (`pid`),
  KEY `pregnancy_nr` (`parent_encounter_nr`),
  KEY `encounter_nr` (`encounter_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_news_article`
--

DROP TABLE IF EXISTS `care_news_article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_news_article` (
  `nr` int(11) NOT NULL AUTO_INCREMENT,
  `lang` varchar(10) NOT NULL DEFAULT 'en',
  `dept_nr` smallint(5) unsigned NOT NULL DEFAULT '0',
  `category` tinytext NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'pending',
  `title` varchar(255) NOT NULL DEFAULT '',
  `preface` text NOT NULL,
  `body` text NOT NULL,
  `pic` blob,
  `pic_mime` varchar(4) DEFAULT NULL,
  `art_num` tinyint(1) NOT NULL DEFAULT '0',
  `head_file` tinytext NOT NULL,
  `main_file` tinytext NOT NULL,
  `pic_file` tinytext NOT NULL,
  `author` varchar(30) NOT NULL DEFAULT '',
  `submit_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `encode_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_date` date NOT NULL DEFAULT '0000-00-00',
  `modify_id` varchar(30) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(30) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`),
  KEY `item_no` (`nr`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_op_med_doc`
--

DROP TABLE IF EXISTS `care_op_med_doc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_op_med_doc` (
  `nr` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `op_date` varchar(12) NOT NULL DEFAULT '',
  `operator` tinytext NOT NULL,
  `encounter_nr` int(11) unsigned NOT NULL DEFAULT '0',
  `dept_nr` smallint(5) unsigned NOT NULL DEFAULT '0',
  `diagnosis` text NOT NULL,
  `localize` text NOT NULL,
  `therapy` text NOT NULL,
  `special` text NOT NULL,
  `class_s` tinyint(4) NOT NULL DEFAULT '0',
  `class_m` tinyint(4) NOT NULL DEFAULT '0',
  `class_l` tinyint(4) NOT NULL DEFAULT '0',
  `op_start` varchar(8) NOT NULL DEFAULT '',
  `op_end` varchar(8) NOT NULL DEFAULT '',
  `scrub_nurse` varchar(70) NOT NULL DEFAULT '',
  `op_room` varchar(10) NOT NULL DEFAULT '',
  `status` varchar(15) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`),
  KEY `encounter_nr` (`encounter_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_ops301_de`
--

DROP TABLE IF EXISTS `care_ops301_de`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_ops301_de` (
  `code` varchar(12) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `inclusive` text NOT NULL,
  `exclusive` text NOT NULL,
  `notes` text NOT NULL,
  `std_code` char(1) NOT NULL DEFAULT '',
  `sub_level` tinyint(4) NOT NULL DEFAULT '0',
  `remarks` text NOT NULL,
  KEY `code` (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_ops301_es`
--

DROP TABLE IF EXISTS `care_ops301_es`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_ops301_es` (
  `code` varchar(12) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `inclusive` text NOT NULL,
  `exclusive` text NOT NULL,
  `notes` text NOT NULL,
  `std_code` char(1) NOT NULL DEFAULT '',
  `sub_level` tinyint(4) NOT NULL DEFAULT '0',
  `remarks` text NOT NULL,
  KEY `code` (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_person`
--

DROP TABLE IF EXISTS `care_person`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_person` (
  `pid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `selian_pid` bigint(20) NOT NULL DEFAULT '0',
  `date_reg` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name_first` varchar(60) NOT NULL DEFAULT '',
  `name_2` varchar(60) DEFAULT NULL,
  `name_3` varchar(60) DEFAULT NULL,
  `name_middle` varchar(60) DEFAULT NULL,
  `name_last` varchar(60) NOT NULL DEFAULT '',
  `name_maiden` varchar(60) DEFAULT NULL,
  `name_others` text NOT NULL,
  `education` varchar(50) DEFAULT NULL,
  `date_birth` date NOT NULL DEFAULT '0000-00-00',
  `blood_group` char(2) NOT NULL DEFAULT '',
  `rh` varchar(10) NOT NULL DEFAULT '',
  `addr_str` varchar(60) NOT NULL DEFAULT '',
  `addr_str_nr` varchar(10) NOT NULL DEFAULT '',
  `addr_zip` varchar(15) NOT NULL DEFAULT '',
  `addr_citytown_nr` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `addr_is_valid` tinyint(1) NOT NULL DEFAULT '0',
  `citizenship` varchar(35) DEFAULT NULL,
  `phone_1_code` varchar(15) DEFAULT '0',
  `phone_1_nr` varchar(35) DEFAULT NULL,
  `phone_2_code` varchar(15) DEFAULT '0',
  `phone_2_nr` varchar(35) DEFAULT NULL,
  `cellphone_1_nr` varchar(35) DEFAULT NULL,
  `cellphone_2_nr` varchar(35) DEFAULT NULL,
  `fax` varchar(35) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `civil_status` varchar(35) NOT NULL DEFAULT '',
  `sex` char(1) NOT NULL DEFAULT '',
  `title` varchar(25) DEFAULT NULL,
  `photo` blob,
  `photo_filename` varchar(60) NOT NULL DEFAULT '',
  `ethnic_orig` mediumint(8) unsigned DEFAULT NULL,
  `org_id` varchar(60) DEFAULT NULL,
  `sss_nr` varchar(60) DEFAULT NULL,
  `nat_id_nr` varchar(60) DEFAULT NULL,
  `religion` varchar(125) DEFAULT NULL,
  `region` varchar(50) DEFAULT NULL,
  `district` varchar(50) DEFAULT NULL,
  `ward` varchar(50) DEFAULT NULL,
  `mother_pid` int(11) unsigned NOT NULL DEFAULT '0',
  `father_pid` int(11) unsigned NOT NULL DEFAULT '0',
  `contact_person` varchar(255) DEFAULT NULL,
  `contact_pid` int(11) unsigned NOT NULL DEFAULT '0',
  `contact_relation` varchar(25) DEFAULT '0',
  `death_date` date NOT NULL DEFAULT '0000-00-00',
  `death_encounter_nr` int(10) unsigned NOT NULL DEFAULT '0',
  `death_cause` varchar(255) DEFAULT NULL,
  `death_cause_code` varchar(15) DEFAULT NULL,
  `date_update` datetime DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `addr_citytown_name` varchar(35) NOT NULL DEFAULT '',
  `is_transmit2ERP` tinyint(4) NOT NULL DEFAULT '0',
  `insurance_ID` smallint(5) NOT NULL,
  `insurance_head_pid` bigint(20) NOT NULL,
  `hiv_nr` varchar(20) NOT NULL DEFAULT ' ',
  `ctc_nr` varchar(20) NOT NULL DEFAULT ' ',
  `diabetic_nr` varchar(20) NOT NULL DEFAULT ' ',
  `allergy` varchar(20) NOT NULL DEFAULT ' ',
  `nhif_nr` varchar(20) NOT NULL DEFAULT ' ',
  `insuarance_code` varchar(200) NOT NULL DEFAULT ' ',
  PRIMARY KEY (`pid`),
  KEY `name_last` (`name_last`),
  KEY `name_first` (`name_first`),
  KEY `date_reg` (`date_reg`),
  KEY `date_birth` (`date_birth`),
  KEY `selian_pid` (`selian_pid`)
) ENGINE=MyISAM AUTO_INCREMENT=10000006 DEFAULT CHARSET=latin1 PACK_KEYS=0;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_person_insurance`
--

DROP TABLE IF EXISTS `care_person_insurance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_person_insurance` (
  `item_nr` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `type` varchar(60) NOT NULL DEFAULT '',
  `insurance_nr` varchar(50) NOT NULL DEFAULT '0',
  `firm_id` varchar(60) NOT NULL DEFAULT '',
  `class_nr` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `is_void` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`item_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_person_other_number`
--

DROP TABLE IF EXISTS `care_person_other_number`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_person_other_number` (
  `nr` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) unsigned NOT NULL DEFAULT '0',
  `other_nr` varchar(30) NOT NULL DEFAULT '',
  `org` varchar(35) NOT NULL DEFAULT '',
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`),
  KEY `pid` (`pid`),
  KEY `other_nr` (`other_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_personell`
--

DROP TABLE IF EXISTS `care_personell`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_personell` (
  `nr` int(11) NOT NULL AUTO_INCREMENT,
  `short_id` varchar(10) DEFAULT NULL,
  `pid` int(11) NOT NULL DEFAULT '0',
  `job_type_nr` int(11) NOT NULL DEFAULT '0',
  `job_function_title` smallint(60) NOT NULL,
  `date_join` date DEFAULT NULL,
  `date_exit` date DEFAULT NULL,
  `contract_class` varchar(35) NOT NULL DEFAULT '0',
  `contract_start` date DEFAULT NULL,
  `contract_end` date DEFAULT NULL,
  `is_discharged` tinyint(1) NOT NULL DEFAULT '0',
  `pay_class` varchar(25) NOT NULL DEFAULT '',
  `pay_class_sub` varchar(25) NOT NULL DEFAULT '',
  `local_premium_id` varchar(5) NOT NULL DEFAULT '',
  `tax_account_nr` varchar(60) NOT NULL DEFAULT '',
  `ir_code` varchar(25) NOT NULL DEFAULT '',
  `nr_workday` tinyint(1) NOT NULL DEFAULT '0',
  `nr_weekhour` float(10,2) NOT NULL DEFAULT '0.00',
  `nr_vacation_day` tinyint(2) NOT NULL DEFAULT '0',
  `multiple_employer` tinyint(1) NOT NULL DEFAULT '0',
  `nr_dependent` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`,`pid`,`job_type_nr`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=100031 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_personell_assignment`
--

DROP TABLE IF EXISTS `care_personell_assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_personell_assignment` (
  `nr` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `personell_nr` int(11) unsigned NOT NULL DEFAULT '0',
  `role_nr` smallint(5) unsigned NOT NULL DEFAULT '0',
  `location_type_nr` smallint(5) unsigned NOT NULL DEFAULT '0',
  `location_nr` smallint(5) unsigned NOT NULL DEFAULT '0',
  `date_start` date NOT NULL DEFAULT '0000-00-00',
  `date_end` date NOT NULL DEFAULT '0000-00-00',
  `is_temporary` tinyint(1) unsigned DEFAULT NULL,
  `list_frequency` int(11) unsigned NOT NULL DEFAULT '0',
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`,`personell_nr`,`role_nr`,`location_type_nr`,`location_nr`),
  KEY `personell_nr` (`personell_nr`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_personell_jobs`
--

DROP TABLE IF EXISTS `care_personell_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_personell_jobs` (
  `number` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_pharma_ordercatalog`
--

DROP TABLE IF EXISTS `care_pharma_ordercatalog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_pharma_ordercatalog` (
  `item_no` int(11) NOT NULL AUTO_INCREMENT,
  `dept_nr` int(3) NOT NULL DEFAULT '0',
  `hit` int(11) NOT NULL DEFAULT '0',
  `artikelname` tinytext NOT NULL,
  `bestellnum` varchar(20) NOT NULL DEFAULT '',
  `minorder` int(4) NOT NULL DEFAULT '0',
  `maxorder` int(4) NOT NULL DEFAULT '0',
  `proorder` tinytext NOT NULL,
  KEY `item_no` (`item_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_pharma_orderlist`
--

DROP TABLE IF EXISTS `care_pharma_orderlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_pharma_orderlist` (
  `order_nr` int(11) NOT NULL AUTO_INCREMENT,
  `dept_nr` int(3) NOT NULL DEFAULT '0',
  `order_date` date NOT NULL DEFAULT '0000-00-00',
  `order_time` time NOT NULL DEFAULT '00:00:00',
  `articles` text NOT NULL,
  `extra1` tinytext NOT NULL,
  `extra2` text NOT NULL,
  `validator` tinytext NOT NULL,
  `ip_addr` tinytext NOT NULL,
  `priority` tinytext NOT NULL,
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `sent_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `process_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`order_nr`,`dept_nr`),
  KEY `dept` (`dept_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_pharma_products_main`
--

DROP TABLE IF EXISTS `care_pharma_products_main`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_pharma_products_main` (
  `bestellnum` varchar(25) NOT NULL DEFAULT '',
  `artikelnum` tinytext NOT NULL,
  `industrynum` tinytext NOT NULL,
  `artikelname` tinytext NOT NULL,
  `generic` tinytext NOT NULL,
  `description` text NOT NULL,
  `packing` tinytext NOT NULL,
  `minorder` int(4) NOT NULL DEFAULT '0',
  `maxorder` int(4) NOT NULL DEFAULT '0',
  `proorder` tinytext NOT NULL,
  `picfile` tinytext NOT NULL,
  `encoder` tinytext NOT NULL,
  `enc_date` tinytext NOT NULL,
  `enc_time` tinytext NOT NULL,
  `lock_flag` tinyint(1) NOT NULL DEFAULT '0',
  `medgroup` text NOT NULL,
  `cave` tinytext NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`bestellnum`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_phone`
--

DROP TABLE IF EXISTS `care_phone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_phone` (
  `item_nr` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(25) DEFAULT NULL,
  `name` varchar(45) NOT NULL DEFAULT '',
  `vorname` varchar(45) NOT NULL DEFAULT '',
  `pid` int(11) unsigned NOT NULL DEFAULT '0',
  `personell_nr` int(10) unsigned NOT NULL DEFAULT '0',
  `dept_nr` smallint(3) unsigned NOT NULL DEFAULT '0',
  `beruf` varchar(25) DEFAULT NULL,
  `bereich1` varchar(25) DEFAULT NULL,
  `bereich2` varchar(25) DEFAULT NULL,
  `inphone1` varchar(15) DEFAULT NULL,
  `inphone2` varchar(15) DEFAULT NULL,
  `inphone3` varchar(15) DEFAULT NULL,
  `exphone1` varchar(25) DEFAULT NULL,
  `exphone2` varchar(25) DEFAULT NULL,
  `funk1` varchar(15) DEFAULT NULL,
  `funk2` varchar(15) DEFAULT NULL,
  `roomnr` varchar(10) DEFAULT NULL,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `time` time NOT NULL DEFAULT '00:00:00',
  `status` varchar(15) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`item_nr`,`pid`,`personell_nr`,`dept_nr`),
  KEY `name` (`name`),
  KEY `vorname` (`vorname`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_pregnancy`
--

DROP TABLE IF EXISTS `care_pregnancy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_pregnancy` (
  `nr` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `encounter_nr` int(11) unsigned NOT NULL DEFAULT '0',
  `this_pregnancy_nr` int(11) unsigned NOT NULL DEFAULT '0',
  `delivery_date` date NOT NULL DEFAULT '0000-00-00',
  `delivery_time` time NOT NULL DEFAULT '00:00:00',
  `gravida` tinyint(2) unsigned DEFAULT NULL,
  `para` tinyint(2) unsigned DEFAULT NULL,
  `pregnancy_gestational_age` tinyint(2) unsigned DEFAULT NULL,
  `nr_of_fetuses` tinyint(2) unsigned DEFAULT NULL,
  `child_encounter_nr` varchar(255) NOT NULL DEFAULT '',
  `is_booked` tinyint(1) NOT NULL DEFAULT '0',
  `vdrl` char(1) DEFAULT NULL,
  `rh` tinyint(1) DEFAULT NULL,
  `delivery_mode` tinyint(2) NOT NULL DEFAULT '0',
  `delivery_by` varchar(60) DEFAULT NULL,
  `bp_systolic_high` smallint(4) unsigned DEFAULT NULL,
  `bp_diastolic_high` smallint(4) unsigned DEFAULT NULL,
  `proteinuria` tinyint(1) DEFAULT NULL,
  `labour_duration` smallint(3) unsigned DEFAULT NULL,
  `induction_method` tinyint(2) NOT NULL DEFAULT '0',
  `induction_indication` varchar(125) DEFAULT NULL,
  `anaesth_type_nr` tinyint(2) NOT NULL DEFAULT '0',
  `is_epidural` char(1) DEFAULT NULL,
  `complications` varchar(255) DEFAULT NULL,
  `perineum` tinyint(2) NOT NULL DEFAULT '0',
  `blood_loss` float(8,2) unsigned DEFAULT NULL,
  `blood_loss_unit` varchar(10) DEFAULT NULL,
  `is_retained_placenta` char(1) NOT NULL DEFAULT '',
  `post_labour_condition` varchar(35) DEFAULT NULL,
  `outcome` varchar(35) NOT NULL DEFAULT '',
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`,`encounter_nr`),
  KEY `encounter_nr` (`encounter_nr`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_registry`
--

DROP TABLE IF EXISTS `care_registry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_registry` (
  `registry_id` varchar(35) NOT NULL DEFAULT '',
  `module_start_script` varchar(60) NOT NULL DEFAULT '',
  `news_start_script` varchar(60) NOT NULL DEFAULT '',
  `news_editor_script` varchar(255) NOT NULL DEFAULT '',
  `news_reader_script` varchar(255) NOT NULL DEFAULT '',
  `passcheck_script` varchar(255) NOT NULL DEFAULT '',
  `composite` text NOT NULL,
  `status` varchar(25) NOT NULL DEFAULT '',
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`registry_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_role_person`
--

DROP TABLE IF EXISTS `care_role_person`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_role_person` (
  `nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `group_nr` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `role` varchar(35) NOT NULL DEFAULT '',
  `name` varchar(35) NOT NULL DEFAULT '',
  `LD_var` varchar(35) NOT NULL DEFAULT '',
  `status` varchar(25) NOT NULL DEFAULT '',
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`,`group_nr`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_room`
--

DROP TABLE IF EXISTS `care_room`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_room` (
  `nr` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `type_nr` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `date_create` date NOT NULL DEFAULT '0000-00-00',
  `date_close` date NOT NULL DEFAULT '0000-00-00',
  `is_temp_closed` tinyint(1) DEFAULT '0',
  `room_nr` smallint(5) unsigned NOT NULL DEFAULT '0',
  `ward_nr` smallint(5) unsigned NOT NULL DEFAULT '0',
  `dept_nr` smallint(5) unsigned NOT NULL DEFAULT '0',
  `nr_of_beds` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `closed_beds` varchar(255) NOT NULL DEFAULT '',
  `info` varchar(60) DEFAULT NULL,
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`,`type_nr`,`ward_nr`,`dept_nr`),
  KEY `room_nr` (`room_nr`),
  KEY `ward_nr` (`ward_nr`),
  KEY `dept_nr` (`dept_nr`)
) ENGINE=MyISAM AUTO_INCREMENT=137 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_sessions`
--

DROP TABLE IF EXISTS `care_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_sessions` (
  `SESSKEY` varchar(32) NOT NULL DEFAULT '',
  `EXPIRY` int(11) unsigned NOT NULL DEFAULT '0',
  `expireref` varchar(64) NOT NULL DEFAULT '',
  `DATA` text NOT NULL,
  PRIMARY KEY (`SESSKEY`),
  KEY `EXPIRY` (`EXPIRY`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_standby_duty_report`
--

DROP TABLE IF EXISTS `care_standby_duty_report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_standby_duty_report` (
  `report_nr` int(11) NOT NULL AUTO_INCREMENT,
  `dept` varchar(15) NOT NULL DEFAULT '',
  `date` date NOT NULL DEFAULT '0000-00-00',
  `standby_name` varchar(35) NOT NULL DEFAULT '',
  `standby_start` time NOT NULL DEFAULT '00:00:00',
  `standby_end` time NOT NULL DEFAULT '00:00:00',
  `oncall_name` varchar(35) NOT NULL DEFAULT '',
  `oncall_start` time NOT NULL DEFAULT '00:00:00',
  `oncall_end` time NOT NULL DEFAULT '00:00:00',
  `op_room` char(2) NOT NULL DEFAULT '',
  `diagnosis_therapy` text NOT NULL,
  `encoding` text NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`report_nr`),
  KEY `report_nr` (`report_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_steri_products_main`
--

DROP TABLE IF EXISTS `care_steri_products_main`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_steri_products_main` (
  `bestellnum` int(15) unsigned NOT NULL DEFAULT '0',
  `containernum` varchar(15) NOT NULL DEFAULT '',
  `industrynum` tinytext NOT NULL,
  `containername` varchar(40) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `packing` tinytext NOT NULL,
  `minorder` int(4) unsigned NOT NULL DEFAULT '0',
  `maxorder` int(4) unsigned NOT NULL DEFAULT '0',
  `proorder` tinytext NOT NULL,
  `picfile` tinytext NOT NULL,
  `encoder` tinytext NOT NULL,
  `enc_date` tinytext NOT NULL,
  `enc_time` tinytext NOT NULL,
  `lock_flag` tinyint(1) NOT NULL DEFAULT '0',
  `medgroup` text NOT NULL,
  `cave` tinytext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tech_questions`
--

DROP TABLE IF EXISTS `care_tech_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tech_questions` (
  `batch_nr` int(11) NOT NULL AUTO_INCREMENT,
  `dept` varchar(60) NOT NULL DEFAULT '',
  `query` text NOT NULL,
  `inquirer` varchar(25) NOT NULL DEFAULT '',
  `tphone` varchar(30) NOT NULL DEFAULT '',
  `tdate` date NOT NULL DEFAULT '0000-00-00',
  `ttime` time NOT NULL DEFAULT '00:00:00',
  `tid` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `reply` text NOT NULL,
  `answered` tinyint(1) NOT NULL DEFAULT '0',
  `ansby` varchar(25) NOT NULL DEFAULT '',
  `astamp` varchar(16) NOT NULL DEFAULT '',
  `archive` tinyint(1) NOT NULL DEFAULT '0',
  `status` varchar(15) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`batch_nr`),
  KEY `batch_nr` (`batch_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tech_repair_done`
--

DROP TABLE IF EXISTS `care_tech_repair_done`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tech_repair_done` (
  `batch_nr` int(11) NOT NULL AUTO_INCREMENT,
  `dept` varchar(15) DEFAULT NULL,
  `dept_nr` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `job_id` varchar(15) NOT NULL DEFAULT '0',
  `job` text NOT NULL,
  `reporter` varchar(25) NOT NULL DEFAULT '',
  `id` varchar(15) NOT NULL DEFAULT '',
  `tdate` date NOT NULL DEFAULT '0000-00-00',
  `ttime` time NOT NULL DEFAULT '00:00:00',
  `tid` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  `d_idx` varchar(8) NOT NULL DEFAULT '',
  `status` varchar(15) NOT NULL DEFAULT '',
  `history` text,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`batch_nr`,`dept_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tech_repair_job`
--

DROP TABLE IF EXISTS `care_tech_repair_job`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tech_repair_job` (
  `batch_nr` tinyint(4) NOT NULL AUTO_INCREMENT,
  `dept` varchar(15) NOT NULL DEFAULT '',
  `job` text NOT NULL,
  `reporter` varchar(25) NOT NULL DEFAULT '',
  `id` varchar(15) NOT NULL DEFAULT '',
  `tphone` varchar(30) NOT NULL DEFAULT '',
  `tdate` date NOT NULL DEFAULT '0000-00-00',
  `ttime` time NOT NULL DEFAULT '00:00:00',
  `tid` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `done` tinyint(1) NOT NULL DEFAULT '0',
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  `seenby` varchar(25) NOT NULL DEFAULT '',
  `sstamp` varchar(16) NOT NULL DEFAULT '',
  `doneby` varchar(25) NOT NULL DEFAULT '',
  `dstamp` varchar(16) NOT NULL DEFAULT '',
  `d_idx` varchar(8) NOT NULL DEFAULT '',
  `archive` tinyint(1) NOT NULL DEFAULT '0',
  `status` varchar(20) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`batch_nr`),
  KEY `batch_nr` (`batch_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_test_findings_baclabor`
--

DROP TABLE IF EXISTS `care_test_findings_baclabor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_test_findings_baclabor` (
  `batch_nr` int(11) NOT NULL DEFAULT '0',
  `encounter_nr` int(11) unsigned NOT NULL DEFAULT '0',
  `room_nr` varchar(10) NOT NULL DEFAULT '',
  `dept_nr` smallint(5) unsigned NOT NULL DEFAULT '0',
  `notes` varchar(255) NOT NULL DEFAULT '',
  `findings_init` tinyint(1) NOT NULL DEFAULT '0',
  `findings_current` tinyint(1) NOT NULL DEFAULT '0',
  `findings_final` tinyint(1) NOT NULL DEFAULT '0',
  `entry_nr` varchar(10) NOT NULL DEFAULT '',
  `rec_date` date NOT NULL DEFAULT '0000-00-00',
  `type_general` text NOT NULL,
  `resist_anaerob` text NOT NULL,
  `resist_aerob` text NOT NULL,
  `findings` text NOT NULL,
  `doctor_id` varchar(35) NOT NULL DEFAULT '',
  `findings_date` date NOT NULL DEFAULT '0000-00-00',
  `findings_time` time NOT NULL DEFAULT '00:00:00',
  `status` varchar(10) NOT NULL DEFAULT '',
  `history` text,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`batch_nr`,`encounter_nr`,`room_nr`,`dept_nr`),
  KEY `findings_date` (`findings_date`),
  KEY `rec_date` (`rec_date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_test_findings_chemlab`
--

DROP TABLE IF EXISTS `care_test_findings_chemlab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_test_findings_chemlab` (
  `batch_nr` int(11) NOT NULL AUTO_INCREMENT,
  `encounter_nr` int(11) NOT NULL DEFAULT '0',
  `job_id` varchar(25) NOT NULL DEFAULT '',
  `test_date` date NOT NULL DEFAULT '0000-00-00',
  `test_time` time NOT NULL DEFAULT '00:00:00',
  `group_id` varchar(30) NOT NULL DEFAULT '',
  `serial_value` text NOT NULL,
  `add_value` text NOT NULL,
  `validator` varchar(15) NOT NULL DEFAULT '',
  `validate_dt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` varchar(20) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`batch_nr`,`encounter_nr`,`job_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_test_findings_chemlab_copy`
--

DROP TABLE IF EXISTS `care_test_findings_chemlab_copy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_test_findings_chemlab_copy` (
  `batch_nr` int(11) NOT NULL AUTO_INCREMENT,
  `encounter_nr` int(11) NOT NULL DEFAULT '0',
  `job_id` varchar(25) NOT NULL DEFAULT '',
  `test_date` date NOT NULL DEFAULT '0000-00-00',
  `test_time` time NOT NULL DEFAULT '00:00:00',
  `group_id` varchar(30) NOT NULL DEFAULT '',
  `serial_value` text NOT NULL,
  `add_value` text NOT NULL,
  `validator` varchar(15) NOT NULL DEFAULT '',
  `validate_dt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` varchar(20) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`batch_nr`,`encounter_nr`,`job_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_test_findings_chemlabor_sub`
--

DROP TABLE IF EXISTS `care_test_findings_chemlabor_sub`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_test_findings_chemlabor_sub` (
  `sub_id` int(40) NOT NULL AUTO_INCREMENT,
  `batch_nr` int(11) NOT NULL DEFAULT '0',
  `job_id` varchar(25) NOT NULL DEFAULT '0',
  `encounter_nr` int(11) NOT NULL DEFAULT '0',
  `paramater_name` varchar(255) DEFAULT '0',
  `parameter_value` varchar(255) DEFAULT '0',
  `status` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `history` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `test_date` date NOT NULL DEFAULT '0000-00-00',
  `test_time` time DEFAULT NULL,
  `create_id` varchar(35) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`sub_id`),
  KEY `batch_nr` (`batch_nr`,`job_id`,`encounter_nr`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_test_findings_laboratory`
--

DROP TABLE IF EXISTS `care_test_findings_laboratory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_test_findings_laboratory` (
  `findings_nr` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) DEFAULT NULL COMMENT 'Point to the HEAD finding_nr for follow up findings',
  `task_nr` int(11) NOT NULL DEFAULT '-1',
  `timestamp` bigint(20) NOT NULL,
  `finding` text NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT '',
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `history` text NOT NULL COMMENT 'Should be empty for follow ups, just for HEAD findings',
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`findings_nr`,`task_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_test_findings_patho`
--

DROP TABLE IF EXISTS `care_test_findings_patho`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_test_findings_patho` (
  `batch_nr` int(11) NOT NULL DEFAULT '0',
  `encounter_nr` int(11) unsigned NOT NULL DEFAULT '0',
  `room_nr` varchar(10) NOT NULL DEFAULT '',
  `dept_nr` smallint(5) unsigned NOT NULL DEFAULT '0',
  `material` text NOT NULL,
  `macro` text NOT NULL,
  `micro` text NOT NULL,
  `findings` text NOT NULL,
  `diagnosis` text NOT NULL,
  `doctor_id` varchar(35) NOT NULL DEFAULT '',
  `findings_date` date NOT NULL DEFAULT '0000-00-00',
  `findings_time` time NOT NULL DEFAULT '00:00:00',
  `status` varchar(10) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`batch_nr`,`encounter_nr`,`room_nr`,`dept_nr`),
  KEY `send_date` (`findings_date`),
  KEY `findings_date` (`findings_date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_test_findings_radio`
--

DROP TABLE IF EXISTS `care_test_findings_radio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_test_findings_radio` (
  `batch_nr` int(11) unsigned NOT NULL DEFAULT '0',
  `encounter_nr` int(11) unsigned NOT NULL DEFAULT '0',
  `room_nr` smallint(5) unsigned NOT NULL DEFAULT '0',
  `dept_nr` smallint(5) unsigned NOT NULL DEFAULT '0',
  `findings` text NOT NULL,
  `diagnosis` text NOT NULL,
  `doctor_id` varchar(35) NOT NULL DEFAULT '',
  `findings_date` date NOT NULL DEFAULT '0000-00-00',
  `findings_time` time NOT NULL DEFAULT '00:00:00',
  `status` varchar(10) NOT NULL DEFAULT '',
  `history` text,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_test_findings_radio_back`
--

DROP TABLE IF EXISTS `care_test_findings_radio_back`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_test_findings_radio_back` (
  `batch_nr` int(11) unsigned NOT NULL DEFAULT '0',
  `encounter_nr` int(11) unsigned NOT NULL DEFAULT '0',
  `room_nr` smallint(5) unsigned NOT NULL DEFAULT '0',
  `dept_nr` smallint(5) unsigned NOT NULL DEFAULT '0',
  `findings` text NOT NULL,
  `diagnosis` text NOT NULL,
  `doctor_id` varchar(35) NOT NULL DEFAULT '',
  `findings_date` date NOT NULL DEFAULT '0000-00-00',
  `findings_time` time NOT NULL DEFAULT '00:00:00',
  `status` varchar(10) NOT NULL DEFAULT '',
  `history` text,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_test_group`
--

DROP TABLE IF EXISTS `care_test_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_test_group` (
  `nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` varchar(35) NOT NULL DEFAULT '',
  `name` varchar(35) NOT NULL DEFAULT '',
  `sort_nr` tinyint(4) NOT NULL DEFAULT '0',
  `status` varchar(25) NOT NULL DEFAULT '',
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`,`group_id`),
  UNIQUE KEY `group_id` (`group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_test_param`
--

DROP TABLE IF EXISTS `care_test_param`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_test_param` (
  `nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` varchar(35) NOT NULL DEFAULT '',
  `name` varchar(35) NOT NULL DEFAULT '',
  `id` varchar(10) NOT NULL DEFAULT '',
  `msr_unit` varchar(15) NOT NULL DEFAULT '',
  `median` varchar(20) DEFAULT NULL,
  `hi_bound` varchar(20) DEFAULT NULL,
  `lo_bound` varchar(20) DEFAULT NULL,
  `hi_critical` varchar(20) DEFAULT NULL,
  `lo_critical` varchar(20) DEFAULT NULL,
  `hi_toxic` varchar(20) DEFAULT NULL,
  `lo_toxic` varchar(20) DEFAULT NULL,
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`,`group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=313 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_test_request_baclabor`
--

DROP TABLE IF EXISTS `care_test_request_baclabor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_test_request_baclabor` (
  `batch_nr` int(11) NOT NULL AUTO_INCREMENT,
  `encounter_nr` int(11) unsigned NOT NULL DEFAULT '0',
  `dept_nr` smallint(5) unsigned NOT NULL DEFAULT '0',
  `material` text NOT NULL,
  `test_type` text NOT NULL,
  `material_note` tinytext NOT NULL,
  `diagnosis_note` tinytext NOT NULL,
  `immune_supp` tinyint(4) NOT NULL DEFAULT '0',
  `send_date` date NOT NULL DEFAULT '0000-00-00',
  `sample_date` date NOT NULL DEFAULT '0000-00-00',
  `status` varchar(10) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`batch_nr`),
  KEY `send_date` (`send_date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_test_request_blood`
--

DROP TABLE IF EXISTS `care_test_request_blood`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_test_request_blood` (
  `batch_nr` int(11) NOT NULL AUTO_INCREMENT,
  `encounter_nr` int(11) unsigned NOT NULL DEFAULT '0',
  `dept_nr` smallint(5) unsigned NOT NULL DEFAULT '0',
  `blood_group` varchar(10) NOT NULL DEFAULT '',
  `rh_factor` varchar(10) NOT NULL DEFAULT '',
  `kell` varchar(10) NOT NULL DEFAULT '',
  `date_protoc_nr` varchar(45) NOT NULL DEFAULT '',
  `pure_blood` varchar(15) NOT NULL DEFAULT '',
  `red_blood` varchar(15) NOT NULL DEFAULT '',
  `leukoless_blood` varchar(15) NOT NULL DEFAULT '',
  `washed_blood` varchar(15) NOT NULL DEFAULT '',
  `prp_blood` varchar(15) NOT NULL DEFAULT '',
  `thrombo_con` varchar(15) NOT NULL DEFAULT '',
  `ffp_plasma` varchar(15) NOT NULL DEFAULT '',
  `transfusion_dev` varchar(15) NOT NULL DEFAULT '',
  `match_sample` tinyint(4) NOT NULL DEFAULT '0',
  `transfusion_date` date NOT NULL DEFAULT '0000-00-00',
  `diagnosis` tinytext NOT NULL,
  `notes` tinytext NOT NULL,
  `send_date` date NOT NULL DEFAULT '0000-00-00',
  `doctor` varchar(35) NOT NULL DEFAULT '',
  `phone_nr` varchar(40) NOT NULL DEFAULT '',
  `status` varchar(10) NOT NULL DEFAULT '',
  `blood_pb` tinytext NOT NULL,
  `blood_rb` tinytext NOT NULL,
  `blood_llrb` tinytext NOT NULL,
  `blood_wrb` tinytext NOT NULL,
  `blood_prp` tinyblob NOT NULL,
  `blood_tc` tinytext NOT NULL,
  `blood_ffp` tinytext NOT NULL,
  `b_group_count` mediumint(9) NOT NULL DEFAULT '0',
  `b_group_price` float(10,2) NOT NULL DEFAULT '0.00',
  `a_subgroup_count` mediumint(9) NOT NULL DEFAULT '0',
  `a_subgroup_price` float(10,2) NOT NULL DEFAULT '0.00',
  `extra_factors_count` mediumint(9) NOT NULL DEFAULT '0',
  `extra_factors_price` float(10,2) NOT NULL DEFAULT '0.00',
  `coombs_count` mediumint(9) NOT NULL DEFAULT '0',
  `coombs_price` float(10,2) NOT NULL DEFAULT '0.00',
  `ab_test_count` mediumint(9) NOT NULL DEFAULT '0',
  `ab_test_price` float(10,2) NOT NULL DEFAULT '0.00',
  `crosstest_count` mediumint(9) NOT NULL DEFAULT '0',
  `crosstest_price` float(10,2) NOT NULL DEFAULT '0.00',
  `ab_diff_count` mediumint(9) NOT NULL DEFAULT '0',
  `ab_diff_price` float(10,2) NOT NULL DEFAULT '0.00',
  `x_test_1_code` mediumint(9) NOT NULL DEFAULT '0',
  `x_test_1_name` varchar(35) NOT NULL DEFAULT '',
  `x_test_1_count` mediumint(9) NOT NULL DEFAULT '0',
  `x_test_1_price` float(10,2) NOT NULL DEFAULT '0.00',
  `x_test_2_code` mediumint(9) NOT NULL DEFAULT '0',
  `x_test_2_name` varchar(35) NOT NULL DEFAULT '',
  `x_test_2_count` mediumint(9) NOT NULL DEFAULT '0',
  `x_test_2_price` float(10,2) NOT NULL DEFAULT '0.00',
  `x_test_3_code` mediumint(9) NOT NULL DEFAULT '0',
  `x_test_3_name` varchar(35) NOT NULL DEFAULT '',
  `x_test_3_count` mediumint(9) NOT NULL DEFAULT '0',
  `x_test_3_price` float(10,2) NOT NULL DEFAULT '0.00',
  `lab_stamp` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `release_via` varchar(20) NOT NULL DEFAULT '',
  `receipt_ack` varchar(20) NOT NULL DEFAULT '',
  `mainlog_nr` varchar(7) NOT NULL DEFAULT '',
  `lab_nr` varchar(7) NOT NULL DEFAULT '',
  `mainlog_date` date NOT NULL DEFAULT '0000-00-00',
  `lab_date` date NOT NULL DEFAULT '0000-00-00',
  `mainlog_sign` varchar(20) NOT NULL DEFAULT '',
  `lab_sign` varchar(20) NOT NULL DEFAULT '',
  `history` text,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`batch_nr`),
  KEY `send_date` (`send_date`)
) ENGINE=MyISAM AUTO_INCREMENT=40000014 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_test_request_chemlabor`
--

DROP TABLE IF EXISTS `care_test_request_chemlabor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_test_request_chemlabor` (
  `batch_nr` int(11) NOT NULL AUTO_INCREMENT,
  `encounter_nr` int(11) unsigned NOT NULL DEFAULT '0',
  `item_id` varchar(20) NOT NULL DEFAULT '0',
  `room_nr` varchar(10) NOT NULL DEFAULT '',
  `dept_nr` smallint(5) unsigned NOT NULL DEFAULT '0',
  `parameters` text NOT NULL,
  `doctor_sign` varchar(35) NOT NULL DEFAULT '',
  `highrisk` smallint(1) NOT NULL DEFAULT '0',
  `notes` tinytext NOT NULL,
  `send_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `sample_time` time NOT NULL DEFAULT '00:00:00',
  `sample_weekday` smallint(1) NOT NULL DEFAULT '0',
  `status` varchar(15) NOT NULL DEFAULT '',
  `history` text,
  `bill_number` bigint(20) NOT NULL DEFAULT '0',
  `bill_status` varchar(10) NOT NULL DEFAULT '',
  `is_disabled` varchar(255) DEFAULT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `priority` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`batch_nr`),
  KEY `encounter_nr` (`encounter_nr`)
) ENGINE=MyISAM AUTO_INCREMENT=10000007 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_test_request_chemlabor_sub`
--

DROP TABLE IF EXISTS `care_test_request_chemlabor_sub`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_test_request_chemlabor_sub` (
  `sub_id` int(40) NOT NULL AUTO_INCREMENT,
  `batch_nr` int(11) NOT NULL DEFAULT '0',
  `encounter_nr` int(11) NOT NULL DEFAULT '0',
  `paramater_name` varchar(255) DEFAULT '0',
  `parameter_value` varchar(255) DEFAULT '0',
  `item_id` varchar(15) NOT NULL DEFAULT '',
  `bill_number` varchar(20) NOT NULL,
  `bill_status` varchar(15) NOT NULL,
  `is_disabled` int(4) NOT NULL,
  `disable_id` varchar(35) NOT NULL,
  `disable_date` date NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  PRIMARY KEY (`sub_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_test_request_generic`
--

DROP TABLE IF EXISTS `care_test_request_generic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_test_request_generic` (
  `batch_nr` int(11) NOT NULL DEFAULT '0',
  `encounter_nr` int(11) unsigned NOT NULL DEFAULT '0',
  `testing_dept` varchar(35) NOT NULL DEFAULT '',
  `visit` tinyint(1) NOT NULL DEFAULT '0',
  `order_patient` tinyint(1) NOT NULL DEFAULT '0',
  `diagnosis_quiry` text NOT NULL,
  `send_date` date NOT NULL DEFAULT '0000-00-00',
  `send_doctor` varchar(35) NOT NULL DEFAULT '',
  `result` text NOT NULL,
  `result_date` date NOT NULL DEFAULT '0000-00-00',
  `result_doctor` varchar(35) NOT NULL DEFAULT '',
  `status` varchar(10) NOT NULL DEFAULT '',
  `history` text,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`batch_nr`),
  KEY `batch_nr` (`batch_nr`,`encounter_nr`),
  KEY `send_date` (`send_date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_test_request_laboratory`
--

DROP TABLE IF EXISTS `care_test_request_laboratory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_test_request_laboratory` (
  `batch_nr` int(11) NOT NULL AUTO_INCREMENT,
  `encounter_nr` int(10) unsigned NOT NULL DEFAULT '0',
  `room_nr` int(11) unsigned NOT NULL DEFAULT '0',
  `dept_nr` smallint(5) unsigned NOT NULL DEFAULT '0',
  `doctor_sign` varchar(255) NOT NULL DEFAULT '',
  `highrisk` smallint(1) NOT NULL DEFAULT '0',
  `notes` varchar(255) NOT NULL DEFAULT '',
  `send_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `sample_time` time NOT NULL DEFAULT '00:00:00',
  `sample_weekday` smallint(1) NOT NULL DEFAULT '0',
  `status` varchar(15) NOT NULL DEFAULT '',
  `history` varchar(255) NOT NULL DEFAULT '',
  `is_disabled` varchar(255) DEFAULT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`batch_nr`),
  KEY `encounter_nr` (`encounter_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_test_request_laboratory_tasks`
--

DROP TABLE IF EXISTS `care_test_request_laboratory_tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_test_request_laboratory_tasks` (
  `task_nr` int(11) NOT NULL AUTO_INCREMENT,
  `batch_nr` int(11) NOT NULL,
  `test_nr` int(11) NOT NULL,
  `bill_number` bigint(20) NOT NULL DEFAULT '0',
  `bill_status` varchar(10) NOT NULL DEFAULT '',
  `send_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` varchar(15) NOT NULL DEFAULT '',
  `is_disabled` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`task_nr`),
  KEY `batch_nr` (`batch_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_test_request_patho`
--

DROP TABLE IF EXISTS `care_test_request_patho`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_test_request_patho` (
  `batch_nr` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `encounter_nr` int(11) unsigned NOT NULL DEFAULT '0',
  `dept_nr` smallint(5) unsigned NOT NULL DEFAULT '0',
  `quick_cut` tinyint(4) NOT NULL DEFAULT '0',
  `qc_phone` varchar(40) NOT NULL DEFAULT '',
  `quick_diagnosis` tinyint(4) NOT NULL DEFAULT '0',
  `qd_phone` varchar(40) NOT NULL DEFAULT '',
  `material_type` varchar(25) NOT NULL DEFAULT '',
  `material_desc` text NOT NULL,
  `localization` tinytext NOT NULL,
  `clinical_note` tinytext NOT NULL,
  `extra_note` tinytext NOT NULL,
  `repeat_note` tinytext NOT NULL,
  `gyn_last_period` varchar(25) NOT NULL DEFAULT '',
  `gyn_period_type` varchar(25) NOT NULL DEFAULT '',
  `gyn_gravida` varchar(25) NOT NULL DEFAULT '',
  `gyn_menopause_since` varchar(25) NOT NULL DEFAULT '0',
  `gyn_hysterectomy` varchar(25) NOT NULL DEFAULT '0',
  `gyn_contraceptive` varchar(25) NOT NULL DEFAULT '0',
  `gyn_iud` varchar(25) NOT NULL DEFAULT '',
  `gyn_hormone_therapy` varchar(25) NOT NULL DEFAULT '',
  `doctor_sign` varchar(35) NOT NULL DEFAULT '',
  `op_date` date NOT NULL DEFAULT '0000-00-00',
  `send_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` varchar(10) NOT NULL DEFAULT '',
  `entry_date` date NOT NULL DEFAULT '0000-00-00',
  `journal_nr` varchar(15) NOT NULL DEFAULT '',
  `blocks_nr` int(11) NOT NULL DEFAULT '0',
  `deep_cuts` int(11) NOT NULL DEFAULT '0',
  `special_dye` varchar(35) NOT NULL DEFAULT '',
  `immune_histochem` varchar(35) NOT NULL DEFAULT '',
  `hormone_receptors` varchar(35) NOT NULL DEFAULT '',
  `specials` varchar(35) NOT NULL DEFAULT '',
  `history` text,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `process_id` varchar(35) NOT NULL DEFAULT '',
  `process_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`batch_nr`),
  KEY `encounter_nr` (`encounter_nr`),
  KEY `send_date` (`send_date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_test_request_radio`
--

DROP TABLE IF EXISTS `care_test_request_radio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_test_request_radio` (
  `batch_nr` int(11) NOT NULL DEFAULT '0',
  `encounter_nr` int(11) unsigned NOT NULL DEFAULT '0',
  `dept_nr` smallint(5) unsigned NOT NULL DEFAULT '0',
  `xray` tinyint(1) NOT NULL DEFAULT '0',
  `ct` tinyint(1) NOT NULL DEFAULT '0',
  `sono` tinyint(1) NOT NULL DEFAULT '0',
  `mammograph` tinyint(1) NOT NULL DEFAULT '0',
  `mrt` tinyint(1) NOT NULL DEFAULT '0',
  `nuclear` tinyint(1) NOT NULL DEFAULT '0',
  `if_patmobile` tinyint(1) NOT NULL DEFAULT '0',
  `if_allergy` tinyint(1) NOT NULL DEFAULT '0',
  `if_hyperten` tinyint(1) NOT NULL DEFAULT '0',
  `if_pregnant` tinyint(1) NOT NULL DEFAULT '0',
  `clinical_info` text NOT NULL,
  `test_request` text NOT NULL,
  `number_of_tests` smallint(6) NOT NULL,
  `send_date` date NOT NULL DEFAULT '0000-00-00',
  `send_doctor` varchar(35) NOT NULL DEFAULT '0',
  `is_disabled` int(4) NOT NULL,
  `disable_id` varchar(35) NOT NULL,
  `disable_date` date NOT NULL,
  `xray_nr` varchar(9) NOT NULL DEFAULT '0',
  `r_cm_2` varchar(15) NOT NULL,
  `mtr` varchar(35) NOT NULL,
  `xray_date` date NOT NULL DEFAULT '0000-00-00',
  `xray_time` time NOT NULL DEFAULT '00:00:00',
  `results` text NOT NULL,
  `results_date` date NOT NULL DEFAULT '0000-00-00',
  `results_doctor` varchar(35) NOT NULL,
  `status` varchar(10) NOT NULL,
  `history` text NOT NULL,
  `bill_number` bigint(20) NOT NULL,
  `bill_status` varchar(10) NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `process_id` varchar(35) NOT NULL,
  `process_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`batch_nr`),
  UNIQUE KEY `batch_nr_2` (`batch_nr`),
  KEY `batch_nr` (`batch_nr`,`encounter_nr`),
  KEY `send_date` (`xray_time`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_test_request_radio_bac`
--

DROP TABLE IF EXISTS `care_test_request_radio_bac`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_test_request_radio_bac` (
  `batch_nr` int(11) NOT NULL DEFAULT '0',
  `encounter_nr` int(11) unsigned NOT NULL DEFAULT '0',
  `dept_nr` smallint(5) unsigned NOT NULL DEFAULT '0',
  `xray` tinyint(1) NOT NULL DEFAULT '0',
  `ct` tinyint(1) NOT NULL DEFAULT '0',
  `sono` tinyint(1) NOT NULL DEFAULT '0',
  `mammograph` tinyint(1) NOT NULL DEFAULT '0',
  `mrt` tinyint(1) NOT NULL DEFAULT '0',
  `nuclear` tinyint(1) NOT NULL DEFAULT '0',
  `if_patmobile` tinyint(1) NOT NULL DEFAULT '0',
  `if_allergy` tinyint(1) NOT NULL DEFAULT '0',
  `if_hyperten` tinyint(1) NOT NULL DEFAULT '0',
  `if_pregnant` tinyint(1) NOT NULL DEFAULT '0',
  `clinical_info` text NOT NULL,
  `test_request` text NOT NULL,
  `number_of_tests` smallint(6) NOT NULL,
  `send_date` date NOT NULL DEFAULT '0000-00-00',
  `send_doctor` varchar(35) NOT NULL DEFAULT '0',
  `is_disabled` int(4) NOT NULL,
  `disable_id` varchar(35) NOT NULL,
  `disable_date` date NOT NULL,
  `xray_nr` varchar(9) NOT NULL DEFAULT '0',
  `r_cm_2` varchar(15) NOT NULL,
  `mtr` varchar(35) NOT NULL,
  `xray_date` date NOT NULL DEFAULT '0000-00-00',
  `xray_time` time NOT NULL DEFAULT '00:00:00',
  `results` text NOT NULL,
  `results_date` date NOT NULL DEFAULT '0000-00-00',
  `results_doctor` varchar(35) NOT NULL,
  `status` varchar(10) NOT NULL,
  `history` text NOT NULL,
  `bill_number` bigint(20) NOT NULL,
  `bill_status` varchar(10) NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `process_id` varchar(35) NOT NULL,
  `process_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_test_request_radio_back`
--

DROP TABLE IF EXISTS `care_test_request_radio_back`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_test_request_radio_back` (
  `batch_nr` int(11) NOT NULL DEFAULT '0',
  `encounter_nr` int(11) unsigned NOT NULL DEFAULT '0',
  `dept_nr` smallint(5) unsigned NOT NULL DEFAULT '0',
  `xray` tinyint(1) NOT NULL DEFAULT '0',
  `ct` tinyint(1) NOT NULL DEFAULT '0',
  `sono` tinyint(1) NOT NULL DEFAULT '0',
  `mammograph` tinyint(1) NOT NULL DEFAULT '0',
  `mrt` tinyint(1) NOT NULL DEFAULT '0',
  `nuclear` tinyint(1) NOT NULL DEFAULT '0',
  `if_patmobile` tinyint(1) NOT NULL DEFAULT '0',
  `if_allergy` tinyint(1) NOT NULL DEFAULT '0',
  `if_hyperten` tinyint(1) NOT NULL DEFAULT '0',
  `if_pregnant` tinyint(1) NOT NULL DEFAULT '0',
  `clinical_info` text NOT NULL,
  `test_request` text NOT NULL,
  `number_of_tests` smallint(6) NOT NULL,
  `send_date` date NOT NULL DEFAULT '0000-00-00',
  `send_doctor` varchar(35) NOT NULL DEFAULT '0',
  `is_disabled` int(4) NOT NULL,
  `disable_id` varchar(35) NOT NULL,
  `disable_date` date NOT NULL,
  `xray_nr` varchar(9) NOT NULL DEFAULT '0',
  `r_cm_2` varchar(15) NOT NULL,
  `mtr` varchar(35) NOT NULL,
  `xray_date` date NOT NULL DEFAULT '0000-00-00',
  `xray_time` time NOT NULL DEFAULT '00:00:00',
  `results` text NOT NULL,
  `results_date` date NOT NULL DEFAULT '0000-00-00',
  `results_doctor` varchar(35) NOT NULL,
  `status` varchar(10) NOT NULL,
  `history` text NOT NULL,
  `bill_number` bigint(20) NOT NULL,
  `bill_status` varchar(10) NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `process_id` varchar(35) NOT NULL,
  `process_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_type_anaesthesia`
--

DROP TABLE IF EXISTS `care_type_anaesthesia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_type_anaesthesia` (
  `nr` smallint(2) unsigned NOT NULL AUTO_INCREMENT,
  `id` varchar(35) NOT NULL DEFAULT '',
  `name` varchar(35) NOT NULL DEFAULT '',
  `LD_var` varchar(35) NOT NULL DEFAULT '',
  `description` varchar(255) DEFAULT NULL,
  `status` varchar(25) NOT NULL DEFAULT '',
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_type_application`
--

DROP TABLE IF EXISTS `care_type_application`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_type_application` (
  `nr` int(11) NOT NULL AUTO_INCREMENT,
  `group_nr` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `type` varchar(35) NOT NULL DEFAULT '',
  `name` varchar(35) NOT NULL DEFAULT '',
  `LD_var` varchar(35) NOT NULL DEFAULT '',
  `description` varchar(255) DEFAULT NULL,
  `status` varchar(25) NOT NULL DEFAULT '',
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_type_assignment`
--

DROP TABLE IF EXISTS `care_type_assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_type_assignment` (
  `type_nr` int(10) unsigned NOT NULL DEFAULT '0',
  `type` varchar(35) NOT NULL DEFAULT '',
  `name` varchar(35) NOT NULL DEFAULT '',
  `LD_var` varchar(25) NOT NULL DEFAULT '0',
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_type_cause_opdelay`
--

DROP TABLE IF EXISTS `care_type_cause_opdelay`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_type_cause_opdelay` (
  `type_nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(35) NOT NULL DEFAULT '',
  `cause` varchar(255) NOT NULL DEFAULT '',
  `LD_var` varchar(35) NOT NULL DEFAULT '',
  `status` varchar(25) NOT NULL DEFAULT '',
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`type_nr`),
  KEY `type` (`type`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_type_color`
--

DROP TABLE IF EXISTS `care_type_color`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_type_color` (
  `color_id` varchar(25) NOT NULL DEFAULT '',
  `name` varchar(35) NOT NULL DEFAULT '',
  `LD_var` varchar(35) NOT NULL DEFAULT '',
  `status` varchar(25) NOT NULL DEFAULT '',
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`color_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_type_department`
--

DROP TABLE IF EXISTS `care_type_department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_type_department` (
  `nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(35) NOT NULL DEFAULT '',
  `name` varchar(35) NOT NULL DEFAULT '',
  `LD_var` varchar(35) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `status` varchar(25) NOT NULL DEFAULT '',
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`),
  KEY `type` (`type`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_type_discharge`
--

DROP TABLE IF EXISTS `care_type_discharge`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_type_discharge` (
  `nr` smallint(3) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(35) NOT NULL DEFAULT '',
  `name` varchar(100) NOT NULL DEFAULT '',
  `LD_var` varchar(35) NOT NULL DEFAULT '',
  `status` varchar(25) NOT NULL DEFAULT '',
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_type_duty`
--

DROP TABLE IF EXISTS `care_type_duty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_type_duty` (
  `type_nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(35) NOT NULL DEFAULT '',
  `name` varchar(35) NOT NULL DEFAULT '',
  `LD_var` varchar(35) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `status` varchar(25) NOT NULL DEFAULT '',
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`type_nr`),
  KEY `type` (`type`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_type_encounter`
--

DROP TABLE IF EXISTS `care_type_encounter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_type_encounter` (
  `type_nr` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(35) NOT NULL DEFAULT '',
  `name` varchar(35) NOT NULL DEFAULT '',
  `LD_var` varchar(25) NOT NULL DEFAULT '0',
  `description` varchar(255) NOT NULL DEFAULT '',
  `hide_from` tinyint(4) NOT NULL DEFAULT '0',
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`type_nr`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_type_ethnic_orig`
--

DROP TABLE IF EXISTS `care_type_ethnic_orig`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_type_ethnic_orig` (
  `nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `class_nr` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `name` varchar(35) NOT NULL DEFAULT '',
  `LD_var` varchar(35) NOT NULL DEFAULT '',
  `status` varchar(25) NOT NULL DEFAULT '',
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`),
  KEY `type` (`class_nr`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_type_feeding`
--

DROP TABLE IF EXISTS `care_type_feeding`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_type_feeding` (
  `nr` smallint(2) unsigned NOT NULL AUTO_INCREMENT,
  `group_nr` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `type` varchar(35) NOT NULL DEFAULT '',
  `name` varchar(35) NOT NULL DEFAULT '',
  `LD_var` varchar(35) NOT NULL DEFAULT '',
  `description` varchar(255) DEFAULT NULL,
  `status` varchar(25) NOT NULL DEFAULT '',
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_type_immunization`
--

DROP TABLE IF EXISTS `care_type_immunization`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_type_immunization` (
  `nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL DEFAULT '',
  `name` varchar(20) NOT NULL DEFAULT '',
  `LD_var` varchar(35) NOT NULL DEFAULT '',
  `period` smallint(6) DEFAULT '0',
  `tolerance` smallint(3) DEFAULT '0',
  `dosage` text,
  `medicine` text NOT NULL,
  `titer` text,
  `note` text,
  `application` tinyint(3) DEFAULT '0',
  `status` varchar(25) NOT NULL DEFAULT 'normal',
  `history` text,
  `modify_id` varchar(35) DEFAULT NULL,
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_type_insurance`
--

DROP TABLE IF EXISTS `care_type_insurance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_type_insurance` (
  `type_nr` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(35) NOT NULL DEFAULT '',
  `name` varchar(60) NOT NULL DEFAULT '',
  `LD_var` varchar(35) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`type_nr`),
  KEY `type` (`type`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_type_localization`
--

DROP TABLE IF EXISTS `care_type_localization`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_type_localization` (
  `nr` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(35) NOT NULL DEFAULT '',
  `name` varchar(35) NOT NULL DEFAULT '',
  `LD_var` varchar(35) NOT NULL DEFAULT '',
  `short_code` char(1) NOT NULL DEFAULT '',
  `LD_var_short_code` varchar(25) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `hide_from` varchar(255) NOT NULL DEFAULT '0',
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_type_location`
--

DROP TABLE IF EXISTS `care_type_location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_type_location` (
  `nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(35) NOT NULL DEFAULT '',
  `name` varchar(35) NOT NULL DEFAULT '',
  `LD_var` varchar(35) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `status` varchar(25) NOT NULL DEFAULT '',
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_type_measurement`
--

DROP TABLE IF EXISTS `care_type_measurement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_type_measurement` (
  `nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(35) NOT NULL DEFAULT '',
  `name` varchar(35) NOT NULL DEFAULT '',
  `LD_var` varchar(35) NOT NULL DEFAULT '',
  `status` varchar(25) NOT NULL DEFAULT '',
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_type_notes`
--

DROP TABLE IF EXISTS `care_type_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_type_notes` (
  `nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(35) NOT NULL DEFAULT '',
  `name` varchar(35) NOT NULL DEFAULT '',
  `LD_var` varchar(35) NOT NULL DEFAULT '',
  `sort_nr` smallint(6) NOT NULL DEFAULT '0',
  `status` varchar(25) NOT NULL DEFAULT '',
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`),
  UNIQUE KEY `type` (`type`)
) ENGINE=MyISAM AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_type_outcome`
--

DROP TABLE IF EXISTS `care_type_outcome`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_type_outcome` (
  `nr` smallint(2) unsigned NOT NULL AUTO_INCREMENT,
  `group_nr` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `type` varchar(35) NOT NULL DEFAULT '',
  `name` varchar(35) NOT NULL DEFAULT '',
  `LD_var` varchar(35) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `status` varchar(25) NOT NULL DEFAULT '',
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_type_perineum`
--

DROP TABLE IF EXISTS `care_type_perineum`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_type_perineum` (
  `nr` smallint(2) unsigned NOT NULL AUTO_INCREMENT,
  `id` varchar(35) NOT NULL DEFAULT '',
  `name` varchar(35) NOT NULL DEFAULT '',
  `LD_var` varchar(35) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `status` varchar(25) NOT NULL DEFAULT '',
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_type_prescription`
--

DROP TABLE IF EXISTS `care_type_prescription`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_type_prescription` (
  `nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(35) NOT NULL DEFAULT '',
  `name` varchar(35) NOT NULL DEFAULT '',
  `LD_var` varchar(35) NOT NULL DEFAULT '',
  `status` varchar(25) NOT NULL DEFAULT '',
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_type_room`
--

DROP TABLE IF EXISTS `care_type_room`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_type_room` (
  `nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(35) NOT NULL DEFAULT '',
  `name` varchar(35) NOT NULL DEFAULT '',
  `LD_var` varchar(35) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `status` varchar(25) NOT NULL DEFAULT '',
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_type_test`
--

DROP TABLE IF EXISTS `care_type_test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_type_test` (
  `type_nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(35) NOT NULL DEFAULT '',
  `name` varchar(35) NOT NULL DEFAULT '',
  `LD_var` varchar(35) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `status` varchar(25) NOT NULL DEFAULT '',
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`type_nr`),
  KEY `type` (`type`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_type_time`
--

DROP TABLE IF EXISTS `care_type_time`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_type_time` (
  `nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(35) NOT NULL DEFAULT '',
  `name` varchar(35) NOT NULL DEFAULT '',
  `LD_var` varchar(35) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `status` varchar(25) NOT NULL DEFAULT '',
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`),
  KEY `type` (`type`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_type_unit_measurement`
--

DROP TABLE IF EXISTS `care_type_unit_measurement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_type_unit_measurement` (
  `nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(35) NOT NULL DEFAULT '',
  `name` varchar(35) NOT NULL DEFAULT '',
  `LD_var` varchar(35) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `status` varchar(25) NOT NULL DEFAULT '',
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`),
  KEY `type` (`type`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_arv_adher_code`
--

DROP TABLE IF EXISTS `care_tz_arv_adher_code`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_arv_adher_code` (
  `care_tz_arv_adher_code_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` char(1) COLLATE latin1_general_ci DEFAULT NULL,
  `description` varchar(40) COLLATE latin1_general_ci DEFAULT NULL,
  `other` tinyint(1) NOT NULL,
  PRIMARY KEY (`care_tz_arv_adher_code_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_arv_adher_reas`
--

DROP TABLE IF EXISTS `care_tz_arv_adher_reas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_arv_adher_reas` (
  `care_tz_arv_adher_reas_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `care_tz_arv_visit_2_id` bigint(20) NOT NULL,
  `care_tz_arv_adher_reas_code_id` int(10) unsigned NOT NULL,
  `other` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`care_tz_arv_adher_reas_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_arv_adher_reas_code`
--

DROP TABLE IF EXISTS `care_tz_arv_adher_reas_code`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_arv_adher_reas_code` (
  `care_tz_arv_adher_reas_code_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` tinyint(3) unsigned DEFAULT NULL,
  `description` varchar(40) COLLATE latin1_general_ci DEFAULT NULL,
  `other` tinyint(1) NOT NULL,
  PRIMARY KEY (`care_tz_arv_adher_reas_code_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_arv_allergies`
--

DROP TABLE IF EXISTS `care_tz_arv_allergies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_arv_allergies` (
  `care_tz_arv_allergies_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `care_tz_arv_registration_id` bigint(20) DEFAULT NULL,
  `description` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`care_tz_arv_allergies_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_arv_case`
--

DROP TABLE IF EXISTS `care_tz_arv_case`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_arv_case` (
  `care_tz_arv_case_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) unsigned NOT NULL,
  `datetime_first_hivtest` datetime DEFAULT NULL,
  `datetime_start_arv` datetime DEFAULT NULL,
  `arv_pid` bigint(20) NOT NULL,
  `district` varchar(80) COLLATE latin1_general_ci DEFAULT NULL,
  `village` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  `street` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  `balozi` varchar(80) COLLATE latin1_general_ci DEFAULT NULL,
  `chairman_of_village` varchar(80) COLLATE latin1_general_ci DEFAULT NULL,
  `head_of_family` varchar(80) COLLATE latin1_general_ci DEFAULT NULL,
  `name_of_secretary` varchar(80) COLLATE latin1_general_ci DEFAULT NULL,
  `secretary_phone` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `secretary_adress` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `history` text COLLATE latin1_general_ci,
  `create_id` timestamp NULL DEFAULT NULL,
  `create_time` bigint(20) DEFAULT NULL,
  `modify_id` varchar(35) COLLATE latin1_general_ci DEFAULT NULL,
  `modify_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`care_tz_arv_case_id`),
  UNIQUE KEY `pid` (`pid`),
  UNIQUE KEY `arv_pid` (`arv_pid`),
  UNIQUE KEY `arv_pid_2` (`arv_pid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_arv_chairman`
--

DROP TABLE IF EXISTS `care_tz_arv_chairman`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_arv_chairman` (
  `care_tz_arv_chairman_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `care_tz_arv_registration_id` bigint(20) DEFAULT NULL,
  `vname` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  `nname` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  `street` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  `village` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  `hamlet` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`care_tz_arv_chairman_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_arv_co_medi`
--

DROP TABLE IF EXISTS `care_tz_arv_co_medi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_arv_co_medi` (
  `care_tz_arv_co_medi_id` int(11) NOT NULL AUTO_INCREMENT,
  `care_tz_arv_co_medi_other_id` int(10) unsigned DEFAULT NULL,
  `item_id` bigint(20) DEFAULT NULL,
  `care_tz_arv_visit_2_id` bigint(20) NOT NULL,
  PRIMARY KEY (`care_tz_arv_co_medi_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_arv_education`
--

DROP TABLE IF EXISTS `care_tz_arv_education`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_arv_education` (
  `care_tz_arv_education_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `care_tz_arv_education_topic_id` bigint(20) NOT NULL,
  `care_tz_arv_registration_id` bigint(20) NOT NULL,
  `comment` text COLLATE latin1_general_ci,
  `comment_date` date DEFAULT NULL,
  `create_id` varchar(35) COLLATE latin1_general_ci DEFAULT NULL,
  `modify_id` varchar(35) COLLATE latin1_general_ci DEFAULT NULL,
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `history` text COLLATE latin1_general_ci NOT NULL,
  `care_tz_arv_education_group_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`care_tz_arv_education_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_arv_education_group`
--

DROP TABLE IF EXISTS `care_tz_arv_education_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_arv_education_group` (
  `care_tz_arv_education_group_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`care_tz_arv_education_group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_arv_education_topic`
--

DROP TABLE IF EXISTS `care_tz_arv_education_topic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_arv_education_topic` (
  `care_tz_arv_education_topic_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `care_tz_arv_education_group_id` int(10) unsigned NOT NULL,
  `description` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`care_tz_arv_education_topic_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_arv_eligible_reason`
--

DROP TABLE IF EXISTS `care_tz_arv_eligible_reason`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_arv_eligible_reason` (
  `care_tz_arv_eligible_reason_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `care_tz_arv_eligible_reason_code_id` int(10) unsigned NOT NULL,
  `care_tz_arv_registration_id` bigint(20) NOT NULL,
  `care_tz_arv_lab_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`care_tz_arv_eligible_reason_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_arv_eligible_reason_code`
--

DROP TABLE IF EXISTS `care_tz_arv_eligible_reason_code`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_arv_eligible_reason_code` (
  `care_tz_arv_eligible_reason_code_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`care_tz_arv_eligible_reason_code_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_arv_events`
--

DROP TABLE IF EXISTS `care_tz_arv_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_arv_events` (
  `care_tz_arv_events_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `care_tz_arv_events_code_id` bigint(20) NOT NULL,
  `care_tz_arv_visit_id` bigint(20) NOT NULL,
  PRIMARY KEY (`care_tz_arv_events_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_arv_events_code`
--

DROP TABLE IF EXISTS `care_tz_arv_events_code`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_arv_events_code` (
  `care_tz_arv_events_code_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `who_code` int(10) unsigned DEFAULT NULL,
  `who_code_text` varchar(256) COLLATE latin1_general_ci DEFAULT NULL,
  `parent` int(4) DEFAULT NULL,
  PRIMARY KEY (`care_tz_arv_events_code_id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_arv_exposure`
--

DROP TABLE IF EXISTS `care_tz_arv_exposure`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_arv_exposure` (
  `care_tz_arv_exposure_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`care_tz_arv_exposure_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_arv_follow_status`
--

DROP TABLE IF EXISTS `care_tz_arv_follow_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_arv_follow_status` (
  `care_tz_arv_follow_status_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `care_tz_arv_follow_status_code_id` int(10) unsigned DEFAULT NULL,
  `care_tz_arv_visit_2_id` bigint(20) NOT NULL,
  `other` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`care_tz_arv_follow_status_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_arv_follow_status_code`
--

DROP TABLE IF EXISTS `care_tz_arv_follow_status_code`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_arv_follow_status_code` (
  `care_tz_arv_follow_status_code_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(8) COLLATE latin1_general_ci DEFAULT NULL,
  `description` varchar(80) COLLATE latin1_general_ci DEFAULT NULL,
  `other` tinyint(1) NOT NULL,
  PRIMARY KEY (`care_tz_arv_follow_status_code_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_arv_functional_status`
--

DROP TABLE IF EXISTS `care_tz_arv_functional_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_arv_functional_status` (
  `care_tz_arv_functional_status_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` char(1) COLLATE latin1_general_ci DEFAULT NULL,
  `description` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  `other` tinyint(1) NOT NULL,
  PRIMARY KEY (`care_tz_arv_functional_status_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_arv_illness`
--

DROP TABLE IF EXISTS `care_tz_arv_illness`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_arv_illness` (
  `care_tz_arv_illness_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `care_tz_arv_illness_code_id` bigint(20) NOT NULL,
  `care_tz_arv_visit_2_id` bigint(20) NOT NULL,
  `other` varchar(80) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`care_tz_arv_illness_id`),
  KEY `care_tz_arv_events_FKIndex2` (`care_tz_arv_visit_2_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_arv_illness_code`
--

DROP TABLE IF EXISTS `care_tz_arv_illness_code`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_arv_illness_code` (
  `care_tz_arv_illness_code_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `description` varchar(256) COLLATE latin1_general_ci NOT NULL,
  `other` tinyint(1) NOT NULL,
  PRIMARY KEY (`care_tz_arv_illness_code_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_arv_lab`
--

DROP TABLE IF EXISTS `care_tz_arv_lab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_arv_lab` (
  `care_tz_arv_lab_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nr` bigint(20) NOT NULL,
  `care_tz_arv_visit_2_id` bigint(20) DEFAULT NULL,
  `value` varchar(6) COLLATE latin1_general_ci DEFAULT NULL,
  `date_analyse` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`care_tz_arv_lab_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_arv_lab_param`
--

DROP TABLE IF EXISTS `care_tz_arv_lab_param`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_arv_lab_param` (
  `care_tz_arv_lab_param_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `lab_param` int(10) unsigned DEFAULT NULL,
  `unit` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `param_upper` int(10) unsigned DEFAULT NULL,
  `param_lower` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`care_tz_arv_lab_param_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_arv_referred`
--

DROP TABLE IF EXISTS `care_tz_arv_referred`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_arv_referred` (
  `care_tz_arv_referred_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `care_tz_arv_referred_code_id` bigint(20) DEFAULT NULL,
  `care_tz_arv_visit_2_id` bigint(20) NOT NULL,
  `other` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`care_tz_arv_referred_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_arv_referred_code`
--

DROP TABLE IF EXISTS `care_tz_arv_referred_code`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_arv_referred_code` (
  `care_tz_arv_referred_code_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` tinyint(3) unsigned DEFAULT NULL,
  `description` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  `other` tinyint(1) NOT NULL,
  PRIMARY KEY (`care_tz_arv_referred_code_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_arv_referred_from`
--

DROP TABLE IF EXISTS `care_tz_arv_referred_from`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_arv_referred_from` (
  `care_tz_arv_referred_from_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `care_tz_arv_referred_from_code_id` int(10) unsigned NOT NULL,
  `care_tz_arv_registration_id` bigint(20) NOT NULL,
  `other` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`care_tz_arv_referred_from_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_arv_referred_from_code`
--

DROP TABLE IF EXISTS `care_tz_arv_referred_from_code`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_arv_referred_from_code` (
  `care_tz_arv_referred_from_code_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(30) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`care_tz_arv_referred_from_code_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_arv_regimen`
--

DROP TABLE IF EXISTS `care_tz_arv_regimen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_arv_regimen` (
  `care_tz_arv_regimen_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `care_tz_arv_regimen_code_id` bigint(20) DEFAULT NULL,
  `care_tz_arv_visit_2_id` bigint(20) NOT NULL,
  `other` varchar(80) COLLATE latin1_general_ci DEFAULT NULL,
  `regimen_days` int(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`care_tz_arv_regimen_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_arv_regimen_code`
--

DROP TABLE IF EXISTS `care_tz_arv_regimen_code`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_arv_regimen_code` (
  `care_tz_arv_regimen_code_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `description` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  `parent` int(10) unsigned DEFAULT NULL,
  `other` tinyint(1) NOT NULL,
  PRIMARY KEY (`care_tz_arv_regimen_code_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_arv_registration`
--

DROP TABLE IF EXISTS `care_tz_arv_registration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_arv_registration` (
  `care_tz_arv_registration_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `care_tz_arv_lab_id` bigint(20) DEFAULT NULL,
  `care_tz_arv_functional_status_id` int(10) unsigned DEFAULT NULL,
  `care_tz_arv_exposure_id` int(10) unsigned DEFAULT NULL,
  `pid` int(11) unsigned NOT NULL,
  `ctc_id` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `ten_cell_leader` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  `head_of_household` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  `date_first_hiv_test` datetime DEFAULT NULL,
  `date_confirmed_hiv` datetime DEFAULT NULL,
  `date_eligible` datetime DEFAULT NULL,
  `date_enrolled` datetime DEFAULT NULL,
  `date_ready` datetime DEFAULT NULL,
  `date_start_art` datetime DEFAULT NULL,
  `status_clinical_stage` int(10) unsigned DEFAULT NULL,
  `status_weight` double DEFAULT NULL,
  `create_id` varchar(35) COLLATE latin1_general_ci DEFAULT NULL,
  `create_time` bigint(35) DEFAULT NULL,
  `modify_id` varchar(35) COLLATE latin1_general_ci DEFAULT NULL,
  `modify_time` timestamp NULL DEFAULT NULL,
  `history` text COLLATE latin1_general_ci,
  PRIMARY KEY (`care_tz_arv_registration_id`),
  UNIQUE KEY `pid` (`pid`),
  UNIQUE KEY `ctc_id` (`ctc_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_arv_status`
--

DROP TABLE IF EXISTS `care_tz_arv_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_arv_status` (
  `care_tz_arv_status_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` tinyint(1) NOT NULL,
  `description` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `other` tinyint(1) NOT NULL,
  PRIMARY KEY (`care_tz_arv_status_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_arv_status_txt`
--

DROP TABLE IF EXISTS `care_tz_arv_status_txt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_arv_status_txt` (
  `care_tz_arv_status_txt_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `care_tz_arv_visit_2_id` bigint(20) NOT NULL,
  `care_tz_arv_status_txt_code_id` bigint(50) NOT NULL,
  `other` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`care_tz_arv_status_txt_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_arv_status_txt_code`
--

DROP TABLE IF EXISTS `care_tz_arv_status_txt_code`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_arv_status_txt_code` (
  `care_tz_arv_status_txt_code_id` bigint(50) NOT NULL AUTO_INCREMENT,
  `code` tinyint(3) unsigned NOT NULL,
  `description` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `parent` int(4) NOT NULL,
  `other` tinyint(1) NOT NULL,
  PRIMARY KEY (`care_tz_arv_status_txt_code_id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_arv_tb_status`
--

DROP TABLE IF EXISTS `care_tz_arv_tb_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_arv_tb_status` (
  `care_tz_arv_tb_status_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `description` varchar(70) COLLATE latin1_general_ci DEFAULT NULL,
  `other` tinyint(1) NOT NULL,
  PRIMARY KEY (`care_tz_arv_tb_status_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_arv_treatment_supporter`
--

DROP TABLE IF EXISTS `care_tz_arv_treatment_supporter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_arv_treatment_supporter` (
  `care_tz_arv_treatment_supporter_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `care_tz_arv_registration_id` bigint(20) DEFAULT NULL,
  `vname` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  `nname` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  `street` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  `village` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  `telephone` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `organisation` varchar(30) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`care_tz_arv_treatment_supporter_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_arv_visit`
--

DROP TABLE IF EXISTS `care_tz_arv_visit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_arv_visit` (
  `care_tz_arv_visit_2_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `care_tz_arv_registration_id` bigint(20) NOT NULL,
  `care_tz_arv_adher_code_id` bigint(20) DEFAULT NULL,
  `care_tz_arv_functional_status_id` int(10) unsigned DEFAULT NULL,
  `care_tz_arv_tb_status_id` bigint(20) DEFAULT NULL,
  `care_tz_arv_status_id` bigint(20) DEFAULT NULL,
  `encounter_nr` bigint(20) NOT NULL,
  `visit_date` datetime DEFAULT NULL,
  `weight` double DEFAULT NULL,
  `height` double DEFAULT NULL,
  `clinical_stage` tinyint(3) unsigned DEFAULT NULL,
  `pregnant` tinyint(1) DEFAULT NULL,
  `date_of_delivery` date DEFAULT NULL,
  `cotrim` tinyint(1) DEFAULT '-1',
  `diflucan` tinyint(1) DEFAULT '-1',
  `nutrition_support` tinyint(1) unsigned DEFAULT NULL,
  `next_visit_date` date DEFAULT NULL,
  `create_id` varchar(35) COLLATE latin1_general_ci DEFAULT NULL,
  `create_time` bigint(20) DEFAULT NULL,
  `modify_id` varchar(35) COLLATE latin1_general_ci DEFAULT NULL,
  `modify_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `history` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`care_tz_arv_visit_2_id`),
  KEY `care_tz_arv_visit_FKIndex1` (`care_tz_arv_functional_status_id`),
  KEY `care_tz_arv_visit_FKIndex2` (`care_tz_arv_tb_status_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_arv_visit_2`
--

DROP TABLE IF EXISTS `care_tz_arv_visit_2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_arv_visit_2` (
  `care_tz_arv_visit_2_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `care_tz_arv_registration_id` bigint(20) NOT NULL,
  `care_tz_arv_adher_code_id` bigint(20) DEFAULT NULL,
  `care_tz_arv_functional_status_id` int(10) unsigned DEFAULT NULL,
  `care_tz_arv_tb_status_id` bigint(20) DEFAULT NULL,
  `care_tz_arv_status_id` bigint(20) DEFAULT NULL,
  `encounter_nr` bigint(20) NOT NULL,
  `visit_date` datetime DEFAULT NULL,
  `weight` double DEFAULT NULL,
  `height` double DEFAULT NULL,
  `clinical_stage` tinyint(3) unsigned DEFAULT NULL,
  `pregnant` tinyint(1) DEFAULT NULL,
  `date_of_delivery` date DEFAULT NULL,
  `cotrim` tinyint(1) DEFAULT '-1',
  `diflucan` tinyint(1) DEFAULT '-1',
  `nutrition_support` tinyint(1) unsigned DEFAULT NULL,
  `next_visit_date` date DEFAULT NULL,
  `create_id` varchar(35) COLLATE latin1_general_ci DEFAULT NULL,
  `create_time` bigint(20) DEFAULT NULL,
  `modify_id` varchar(35) COLLATE latin1_general_ci DEFAULT NULL,
  `modify_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `history` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`care_tz_arv_visit_2_id`),
  KEY `care_tz_arv_visit_FKIndex1` (`care_tz_arv_functional_status_id`),
  KEY `care_tz_arv_visit_FKIndex2` (`care_tz_arv_tb_status_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_billing`
--

DROP TABLE IF EXISTS `care_tz_billing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_billing` (
  `nr` bigint(20) NOT NULL AUTO_INCREMENT,
  `encounter_nr` bigint(20) NOT NULL DEFAULT '0',
  `first_date` bigint(20) NOT NULL DEFAULT '0',
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `creation_date` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_billing_archive`
--

DROP TABLE IF EXISTS `care_tz_billing_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_billing_archive` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nr` bigint(20) NOT NULL DEFAULT '0',
  `encounter_nr` bigint(20) NOT NULL DEFAULT '0',
  `first_date` bigint(20) NOT NULL DEFAULT '0',
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `creation_date` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `nr` (`nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_billing_archive_10_03_10_02`
--

DROP TABLE IF EXISTS `care_tz_billing_archive_10_03_10_02`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_billing_archive_10_03_10_02` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nr` bigint(20) NOT NULL DEFAULT '0',
  `encounter_nr` bigint(20) NOT NULL DEFAULT '0',
  `first_date` bigint(20) NOT NULL DEFAULT '0',
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `creation_date` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `nr` (`nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_billing_archive_elem`
--

DROP TABLE IF EXISTS `care_tz_billing_archive_elem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_billing_archive_elem` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `nr` bigint(20) NOT NULL DEFAULT '0',
  `date_change` bigint(20) NOT NULL DEFAULT '0',
  `is_labtest` tinyint(4) NOT NULL DEFAULT '0',
  `is_medicine` tinyint(4) NOT NULL DEFAULT '0',
  `is_radio_test` tinyint(4) NOT NULL DEFAULT '0',
  `is_comment` tinyint(4) NOT NULL DEFAULT '0',
  `is_paid` tinyint(4) NOT NULL DEFAULT '0',
  `amount` bigint(20) NOT NULL DEFAULT '0',
  `times_per_day` smallint(10) NOT NULL,
  `days` smallint(10) NOT NULL,
  `price` int(10) NOT NULL,
  `balanced_insurance` int(10) DEFAULT '0',
  `insurance_id` int(5) DEFAULT '0',
  `description` varchar(50) NOT NULL,
  `item_number` bigint(20) NOT NULL DEFAULT '0',
  `prescriptions_nr` bigint(20) NOT NULL DEFAULT '0',
  `User_Id` varchar(25) NOT NULL,
  `signed_by_follower` tinyint(1) NOT NULL DEFAULT '0',
  `is_transmit2ERP` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`),
  KEY `nr` (`nr`),
  KEY `prescriptions_nr` (`prescriptions_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_billing_archive_elem_advance`
--

DROP TABLE IF EXISTS `care_tz_billing_archive_elem_advance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_billing_archive_elem_advance` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `nr` bigint(20) NOT NULL DEFAULT '0',
  `date_change` bigint(20) NOT NULL DEFAULT '0',
  `is_labtest` tinyint(4) NOT NULL DEFAULT '0',
  `is_medicine` tinyint(4) NOT NULL DEFAULT '0',
  `is_radio_test` tinyint(4) NOT NULL DEFAULT '0',
  `is_comment` tinyint(4) NOT NULL DEFAULT '0',
  `is_paid` tinyint(4) NOT NULL DEFAULT '0',
  `amount` bigint(20) NOT NULL DEFAULT '0',
  `times_per_day` smallint(10) NOT NULL,
  `days` smallint(10) NOT NULL,
  `price` varchar(255) NOT NULL DEFAULT '',
  `balanced_insurance` varchar(20) DEFAULT NULL,
  `insurance_id` bigint(20) DEFAULT '0',
  `description` varchar(255) NOT NULL DEFAULT '',
  `item_number` bigint(20) NOT NULL DEFAULT '0',
  `prescriptions_nr` bigint(20) NOT NULL DEFAULT '0',
  `User_Id` varchar(100) NOT NULL,
  `signed_by_follower` tinyint(1) NOT NULL DEFAULT '0',
  `is_transmit2ERP` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`),
  KEY `nr` (`nr`),
  KEY `prescriptions_nr` (`prescriptions_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_billing_elem`
--

DROP TABLE IF EXISTS `care_tz_billing_elem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_billing_elem` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `nr` bigint(20) NOT NULL DEFAULT '0',
  `date_change` bigint(20) NOT NULL DEFAULT '0',
  `is_labtest` tinyint(4) NOT NULL DEFAULT '0',
  `is_radio_test` tinyint(4) NOT NULL DEFAULT '0',
  `is_medicine` tinyint(4) NOT NULL DEFAULT '0',
  `is_comment` tinyint(4) NOT NULL DEFAULT '0',
  `is_paid` tinyint(4) NOT NULL DEFAULT '0',
  `amount` bigint(20) NOT NULL DEFAULT '0',
  `amount_doc` bigint(20) NOT NULL DEFAULT '0',
  `times_per_day` smallint(10) NOT NULL,
  `days` smallint(10) NOT NULL,
  `price` varchar(255) NOT NULL DEFAULT '',
  `balanced_insurance` varchar(20) DEFAULT NULL,
  `insurance_id` bigint(20) DEFAULT NULL,
  `description` varchar(255) NOT NULL DEFAULT '',
  `notes` varchar(255) NOT NULL DEFAULT '',
  `item_number` bigint(20) NOT NULL DEFAULT '0',
  `prescriptions_nr` bigint(20) NOT NULL DEFAULT '0',
  `User_Id` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `nr` (`nr`),
  KEY `prescriptions_nr` (`prescriptions_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_billing_elem_advance`
--

DROP TABLE IF EXISTS `care_tz_billing_elem_advance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_billing_elem_advance` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `nr` bigint(20) NOT NULL DEFAULT '0',
  `date_change` bigint(20) NOT NULL DEFAULT '0',
  `is_labtest` tinyint(4) NOT NULL DEFAULT '0',
  `is_medicine` tinyint(4) NOT NULL DEFAULT '0',
  `is_radio_test` tinyint(4) NOT NULL DEFAULT '0',
  `is_comment` tinyint(4) NOT NULL DEFAULT '0',
  `is_paid` tinyint(4) NOT NULL DEFAULT '0',
  `amount` bigint(20) NOT NULL DEFAULT '0',
  `times_per_day` smallint(10) NOT NULL,
  `days` smallint(10) NOT NULL,
  `price` varchar(255) NOT NULL DEFAULT '',
  `balanced_insurance` varchar(20) DEFAULT NULL,
  `insurance_id` bigint(20) DEFAULT '0',
  `description` varchar(255) NOT NULL DEFAULT '',
  `item_number` bigint(20) NOT NULL DEFAULT '0',
  `prescriptions_nr` bigint(20) NOT NULL DEFAULT '0',
  `User_Id` varchar(100) NOT NULL,
  `signed_by_follower` tinyint(1) NOT NULL DEFAULT '0',
  `is_transmit2ERP` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`),
  KEY `nr` (`nr`),
  KEY `prescriptions_nr` (`prescriptions_nr`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_company`
--

DROP TABLE IF EXISTS `care_tz_company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_company` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `contact` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(60) DEFAULT '',
  `phone_code` bigint(15) NOT NULL DEFAULT '0',
  `phone_nr` varchar(35) NOT NULL DEFAULT '',
  `po_box` varchar(255) NOT NULL DEFAULT '',
  `city` varchar(255) NOT NULL DEFAULT '',
  `start_date` bigint(20) NOT NULL DEFAULT '0',
  `end_date` bigint(20) NOT NULL DEFAULT '0',
  `invoice_flag` tinyint(4) NOT NULL DEFAULT '0',
  `credit_preselection_flag` tinyint(4) NOT NULL DEFAULT '0',
  `hide_company_flag` tinyint(4) NOT NULL DEFAULT '0',
  `prepaid_amount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=237 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_dhis_element`
--

DROP TABLE IF EXISTS `care_tz_dhis_element`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_dhis_element` (
  `codeid` int(10) NOT NULL AUTO_INCREMENT,
  `icd_code` char(10) DEFAULT NULL,
  `dataelement_id` int(10) DEFAULT NULL,
  `icd_desease_name` text,
  `dhis_dataelement` text,
  `dhis_under5` text,
  `dhis_under5id` int(10) DEFAULT NULL,
  PRIMARY KEY (`codeid`)
) ENGINE=InnoDB AUTO_INCREMENT=758 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_dhis_period`
--

DROP TABLE IF EXISTS `care_tz_dhis_period`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_dhis_period` (
  `periodid` int(11) NOT NULL AUTO_INCREMENT,
  `periodtypeid` int(11) DEFAULT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  PRIMARY KEY (`periodid`),
  UNIQUE KEY `periodtypeid` (`periodtypeid`,`startdate`,`enddate`),
  KEY `fk_period_periodtypeid` (`periodtypeid`)
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_diagnosis`
--

DROP TABLE IF EXISTS `care_tz_diagnosis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_diagnosis` (
  `case_nr` bigint(20) NOT NULL AUTO_INCREMENT,
  `parent_case_nr` bigint(20) NOT NULL DEFAULT '-1',
  `PID` bigint(20) NOT NULL DEFAULT '0',
  `encounter_nr` bigint(20) NOT NULL DEFAULT '0',
  `timestamp` bigint(20) NOT NULL DEFAULT '0',
  `ICD_10_code` varchar(10) NOT NULL DEFAULT '',
  `ICD_10_description` varchar(50) NOT NULL DEFAULT '',
  `type` varchar(25) NOT NULL DEFAULT '',
  `comment` varchar(255) DEFAULT NULL,
  `doctor_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`case_nr`),
  KEY `parent_case_nr` (`parent_case_nr`,`PID`,`encounter_nr`,`timestamp`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_district`
--

DROP TABLE IF EXISTS `care_tz_district`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_district` (
  `district_id` int(11) NOT NULL AUTO_INCREMENT,
  `district_code` int(10) NOT NULL,
  `district_name` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `is_additional` tinyint(4) NOT NULL,
  PRIMARY KEY (`district_id`)
) ENGINE=MyISAM AUTO_INCREMENT=131 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_drugliststruc`
--

DROP TABLE IF EXISTS `care_tz_drugliststruc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_drugliststruc` (
  `item_id` bigint(20) NOT NULL DEFAULT '0',
  `item_number` varchar(5) NOT NULL DEFAULT '',
  `is_pediatric` smallint(6) NOT NULL DEFAULT '0',
  `is_adult` smallint(6) NOT NULL DEFAULT '0',
  `is_other` smallint(6) NOT NULL DEFAULT '0',
  `is_consumable` smallint(6) NOT NULL DEFAULT '0',
  `mems_item_code` varchar(255) NOT NULL DEFAULT '',
  `mems_item_description` varchar(255) NOT NULL DEFAULT '',
  `mems_pack_size` varchar(255) NOT NULL DEFAULT '',
  `mems_price_per_pack_size` double NOT NULL DEFAULT '0',
  `mems_sizes` varchar(50) NOT NULL DEFAULT '',
  `item_description` varchar(100) DEFAULT NULL,
  `item_full_description` varchar(255) NOT NULL DEFAULT '',
  `dosage` varchar(50) NOT NULL DEFAULT '',
  `unit_price` varchar(50) DEFAULT '0.00',
  `purchasing_class` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`item_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_drugsandservices`
--

DROP TABLE IF EXISTS `care_tz_drugsandservices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_drugsandservices` (
  `item_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `item_number` varchar(25) NOT NULL,
  `partcode` varchar(50) NOT NULL,
  `is_pediatric` smallint(6) NOT NULL DEFAULT '0',
  `is_adult` smallint(6) NOT NULL DEFAULT '0',
  `is_other` smallint(6) NOT NULL DEFAULT '0',
  `is_consumable` smallint(6) NOT NULL DEFAULT '0',
  `is_labtest` tinyint(4) NOT NULL DEFAULT '0',
  `is_radio_test` tinyint(4) NOT NULL DEFAULT '0',
  `item_description` varchar(255) NOT NULL DEFAULT '',
  `item_full_description` varchar(255) NOT NULL DEFAULT '',
  `unit_price` varchar(50) NOT NULL DEFAULT '',
  `unit_price_1` varchar(50) DEFAULT NULL,
  `unit_price_2` varchar(50) DEFAULT NULL,
  `unit_price_3` varchar(50) DEFAULT NULL,
  `purchasing_class` varchar(25) NOT NULL,
  `sub_class` varchar(50) NOT NULL,
  `not_in_use` int(1) NOT NULL DEFAULT '0',
  `unit_price_4` varchar(50) NOT NULL DEFAULT '0',
  `unit_price_5` varchar(50) NOT NULL DEFAULT '0',
  `unit_price_6` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`item_id`),
  KEY `IX_ITEM_NUMBER` (`item_number`)
) ENGINE=MyISAM AUTO_INCREMENT=1509 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_drugsandservices_description`
--

DROP TABLE IF EXISTS `care_tz_drugsandservices_description`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_drugsandservices_description` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `last_change` bigint(20) NOT NULL,
  `UID` varchar(50) NOT NULL,
  `Fieldname` varchar(50) NOT NULL,
  `ShowDescription` varchar(50) NOT NULL,
  `FullDescription` varchar(255) NOT NULL,
  `is_insurance_price` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_eye_anterior_segment`
--

DROP TABLE IF EXISTS `care_tz_eye_anterior_segment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_eye_anterior_segment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(30) DEFAULT NULL,
  `right_eye_test1` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test2` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test3` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test4` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test5` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test6` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test7` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test1` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test2` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test3` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test4` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test5` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test6` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test7` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `Signature` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `Examination_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_eye_conjunctiva`
--

DROP TABLE IF EXISTS `care_tz_eye_conjunctiva`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_eye_conjunctiva` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(30) DEFAULT NULL,
  `right_eye_test1` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test2` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test3` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test4` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test5` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test6` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test7` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test8` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test1` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test2` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test3` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test4` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test5` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test6` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test7` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test8` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `Signature` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `Examination_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_eye_cornea`
--

DROP TABLE IF EXISTS `care_tz_eye_cornea`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_eye_cornea` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(30) DEFAULT NULL,
  `right_eye_test1` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test2` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test3` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test4` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test5` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test6` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test7` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test1` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test2` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test3` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test4` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test5` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test6` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test7` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `Signature` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `Examination_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_eye_eyelids`
--

DROP TABLE IF EXISTS `care_tz_eye_eyelids`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_eye_eyelids` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(30) DEFAULT NULL,
  `right_eye_test1` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test2` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test3` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test4` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test5` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test6` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test7` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test8` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test9` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test1` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test2` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test3` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test4` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test5` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test6` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test7` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test8` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test9` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `Signature` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `Examination_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_eye_facial_ocular_orbitalsymmetry`
--

DROP TABLE IF EXISTS `care_tz_eye_facial_ocular_orbitalsymmetry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_eye_facial_ocular_orbitalsymmetry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(30) DEFAULT NULL,
  `right_eye_test1` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test2` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test3` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test4` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test5` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test6` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test7` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test1` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test2` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test3` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test4` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test5` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test6` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test7` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `Signature` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `Examination_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_eye_intraocularpressure`
--

DROP TABLE IF EXISTS `care_tz_eye_intraocularpressure`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_eye_intraocularpressure` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(30) DEFAULT NULL,
  `right_eye_test1` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test1` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `test3` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `Signature` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `Examination_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_eye_lens`
--

DROP TABLE IF EXISTS `care_tz_eye_lens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_eye_lens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(30) DEFAULT NULL,
  `right_eye_test1` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test2` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test3` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test4` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test5` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test6` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test7` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test8` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test9` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test1` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test2` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test3` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test4` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test5` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test6` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test7` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test8` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test9` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `Signature` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `Examination_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_eye_optic_disc`
--

DROP TABLE IF EXISTS `care_tz_eye_optic_disc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_eye_optic_disc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(30) DEFAULT NULL,
  `right_eye_test1` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test2` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test3` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test4` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test5` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test6` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test1` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test2` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test3` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test4` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test5` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test6` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `Signature` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `Examination_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_eye_posterior_segment`
--

DROP TABLE IF EXISTS `care_tz_eye_posterior_segment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_eye_posterior_segment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(30) DEFAULT NULL,
  `right_eye_test1` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test2` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test3` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test4` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test5` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test6` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test7` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test8` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test9` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test1` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test2` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test3` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test4` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test5` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test6` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test7` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test8` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test9` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `Signature` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `Examination_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_eye_pupils`
--

DROP TABLE IF EXISTS `care_tz_eye_pupils`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_eye_pupils` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(30) DEFAULT NULL,
  `right_eye_test1` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test2` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test3` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test4` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test5` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test6` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test7` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test1` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test2` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test3` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test4` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test5` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test6` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test7` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `Signature` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `Examination_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_eye_squint_strabismus`
--

DROP TABLE IF EXISTS `care_tz_eye_squint_strabismus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_eye_squint_strabismus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(30) DEFAULT NULL,
  `right_eye_test1` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test2` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test3` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test4` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test5` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test1` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test2` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test3` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test4` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test5` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `Signature` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `Examination_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_eye_trauma`
--

DROP TABLE IF EXISTS `care_tz_eye_trauma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_eye_trauma` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(30) DEFAULT NULL,
  `right_eye_test1` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test2` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test3` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test4` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test5` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test6` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test7` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test8` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test9` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test10` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test11` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test12` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test1` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test2` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test3` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test4` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test5` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test6` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test7` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test8` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test9` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test10` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test11` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test12` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `Signature` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `Examination_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_eye_visualacuity`
--

DROP TABLE IF EXISTS `care_tz_eye_visualacuity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_eye_visualacuity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(30) DEFAULT NULL,
  `right_eye_test1` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test2` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `right_eye_test3` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test1` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test2` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `left_eye_test3` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `Signature` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `Examination_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_hospital_doctor_history`
--

DROP TABLE IF EXISTS `care_tz_hospital_doctor_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_hospital_doctor_history` (
  `date` date NOT NULL DEFAULT '0000-00-00',
  `doctor` varchar(45) NOT NULL DEFAULT ' ',
  `dept` int(11) unsigned NOT NULL DEFAULT '0',
  `room` varchar(450) NOT NULL,
  `attend` int(11) unsigned NOT NULL DEFAULT '0',
  `patients` text NOT NULL,
  PRIMARY KEY (`date`,`doctor`,`dept`,`room`),
  KEY `date` (`date`),
  KEY `doctor` (`doctor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_hospital_rooms`
--

DROP TABLE IF EXISTS `care_tz_hospital_rooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_hospital_rooms` (
  `name` varchar(20) NOT NULL,
  `notes` varchar(250) NOT NULL,
  `active` int(1) unsigned NOT NULL,
  `dpt` int(11) NOT NULL DEFAULT '0' COMMENT 'department',
  `createdby` varchar(45) NOT NULL,
  `createdate` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`name`,`dpt`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='holds doctors rooms';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_hospital_rooms_conf`
--

DROP TABLE IF EXISTS `care_tz_hospital_rooms_conf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_hospital_rooms_conf` (
  `name` varchar(45) NOT NULL,
  `dpt` varchar(45) NOT NULL,
  `users` text NOT NULL,
  `date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`name`,`dpt`,`date`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_icd10_quicklist`
--

DROP TABLE IF EXISTS `care_tz_icd10_quicklist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_icd10_quicklist` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `parent` bigint(20) NOT NULL DEFAULT '0',
  `description` varchar(50) DEFAULT NULL,
  `diagnosis_code` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `parent` (`parent`)
) ENGINE=MyISAM AUTO_INCREMENT=9314 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_insurance`
--

DROP TABLE IF EXISTS `care_tz_insurance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_insurance` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `parent` bigint(20) NOT NULL DEFAULT '0',
  `company_parent` int(11) NOT NULL,
  `company_id` bigint(20) NOT NULL DEFAULT '0',
  `PID` bigint(20) NOT NULL DEFAULT '0',
  `ceiling` varchar(255) NOT NULL DEFAULT '',
  `ceiling_startup_subtraction` varchar(20) NOT NULL DEFAULT '',
  `plan` varchar(255) NOT NULL DEFAULT '',
  `start_date` bigint(20) NOT NULL DEFAULT '0',
  `end_date` bigint(20) NOT NULL DEFAULT '0',
  `timestamp` bigint(20) NOT NULL,
  `cancel_flag` tinyint(4) NOT NULL DEFAULT '0',
  `paid_flag` tinyint(4) NOT NULL DEFAULT '0',
  `gets_company_credit` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`,`company_id`,`PID`)
) ENGINE=MyISAM AUTO_INCREMENT=583 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_insurance_types`
--

DROP TABLE IF EXISTS `care_tz_insurance_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_insurance_types` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ceiling` varchar(20) NOT NULL DEFAULT '0',
  `prepaid_amount` int(11) NOT NULL,
  `name` varchar(30) NOT NULL DEFAULT '',
  `comment` varchar(255) NOT NULL DEFAULT '',
  `is_disabled` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_insurances_admin`
--

DROP TABLE IF EXISTS `care_tz_insurances_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_insurances_admin` (
  `insurance_ID` smallint(5) NOT NULL AUTO_INCREMENT,
  `insurer` smallint(5) NOT NULL DEFAULT '-1',
  `name` varchar(30) DEFAULT NULL,
  `max_pay` int(10) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `creation` text NOT NULL,
  `id_insurer_hist` text,
  `name_hist` text,
  `max_pay_hist` text,
  `deleted_hist` text,
  `contact_person` varchar(60) DEFAULT NULL,
  `contact_person_hist` text NOT NULL,
  `po_box` varchar(50) DEFAULT NULL,
  `po_box_hist` text NOT NULL,
  `city` varchar(60) DEFAULT NULL,
  `city_hist` text NOT NULL,
  `phone` varchar(35) DEFAULT NULL,
  `phone_hist` text NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `email_hist` text NOT NULL,
  PRIMARY KEY (`insurance_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_laboratory`
--

DROP TABLE IF EXISTS `care_tz_laboratory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_laboratory` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `encounter_nr` bigint(20) NOT NULL DEFAULT '0',
  `care_tz_laboratory_tests_id` bigint(20) NOT NULL DEFAULT '0',
  `timestamp` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `encounter_nr` (`encounter_nr`),
  KEY `care_tz_laboratory_tests_id` (`care_tz_laboratory_tests_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_laboratory_param`
--

DROP TABLE IF EXISTS `care_tz_laboratory_param`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_laboratory_param` (
  `nr` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` bigint(20) NOT NULL,
  `group_id` varchar(35) NOT NULL DEFAULT '',
  `name` varchar(35) NOT NULL DEFAULT '',
  `shortname` varchar(10) NOT NULL,
  `sort_nr` tinyint(4) NOT NULL DEFAULT '0',
  `id` varchar(100) NOT NULL,
  `msr_unit` varchar(15) NOT NULL DEFAULT '',
  `median` varchar(20) DEFAULT NULL,
  `hi_bound` varchar(20) DEFAULT NULL,
  `lo_bound` varchar(20) DEFAULT NULL,
  `hi_critical` varchar(20) DEFAULT NULL,
  `lo_critical` varchar(20) DEFAULT NULL,
  `hi_toxic` varchar(20) DEFAULT NULL,
  `lo_toxic` varchar(20) DEFAULT NULL,
  `median_f` varchar(20) DEFAULT NULL,
  `hi_bound_f` varchar(20) DEFAULT NULL,
  `lo_bound_f` varchar(20) DEFAULT NULL,
  `hi_critical_f` varchar(20) DEFAULT NULL,
  `lo_critical_f` varchar(20) DEFAULT NULL,
  `hi_toxic_f` varchar(20) DEFAULT NULL,
  `lo_toxic_f` varchar(20) DEFAULT NULL,
  `median_n` varchar(20) DEFAULT NULL,
  `hi_bound_n` varchar(20) DEFAULT NULL,
  `lo_bound_n` varchar(20) DEFAULT NULL,
  `hi_critical_n` varchar(20) DEFAULT NULL,
  `lo_critical_n` varchar(20) DEFAULT NULL,
  `hi_toxic_n` varchar(20) DEFAULT NULL,
  `lo_toxic_n` varchar(20) DEFAULT NULL,
  `median_y` varchar(20) DEFAULT NULL,
  `hi_bound_y` varchar(20) DEFAULT NULL,
  `lo_bound_y` varchar(20) DEFAULT NULL,
  `hi_critical_y` varchar(20) DEFAULT NULL,
  `lo_critical_y` varchar(20) DEFAULT NULL,
  `hi_toxic_y` varchar(20) DEFAULT NULL,
  `lo_toxic_y` varchar(20) DEFAULT NULL,
  `median_c` varchar(20) DEFAULT NULL,
  `hi_bound_c` varchar(20) DEFAULT NULL,
  `lo_bound_c` varchar(20) DEFAULT NULL,
  `hi_critical_c` varchar(20) DEFAULT NULL,
  `lo_critical_c` varchar(20) DEFAULT NULL,
  `hi_toxic_c` varchar(20) DEFAULT NULL,
  `lo_toxic_c` varchar(20) DEFAULT NULL,
  `method` varchar(255) DEFAULT NULL,
  `field_type` varchar(20) NOT NULL DEFAULT 'input_box' COMMENT 'values are input_box, dropdown and limited',
  `add_type` varchar(255) NOT NULL DEFAULT '',
  `add_label` varchar(255) NOT NULL DEFAULT '',
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `price` varchar(10) NOT NULL,
  `price_3` varchar(10) DEFAULT NULL,
  `price_2` varchar(10) DEFAULT NULL,
  `price_1` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`nr`)
) ENGINE=MyISAM AUTO_INCREMENT=110 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_laboratory_param_backup`
--

DROP TABLE IF EXISTS `care_tz_laboratory_param_backup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_laboratory_param_backup` (
  `nr` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` bigint(20) NOT NULL,
  `group_id` varchar(35) NOT NULL DEFAULT '',
  `name` varchar(35) NOT NULL DEFAULT '',
  `shortname` varchar(10) NOT NULL,
  `sort_nr` tinyint(4) NOT NULL DEFAULT '0',
  `id` varchar(100) NOT NULL,
  `msr_unit` varchar(15) NOT NULL DEFAULT '',
  `median` varchar(20) DEFAULT NULL,
  `hi_bound` varchar(20) DEFAULT NULL,
  `lo_bound` varchar(20) DEFAULT NULL,
  `hi_critical` varchar(20) DEFAULT NULL,
  `lo_critical` varchar(20) DEFAULT NULL,
  `hi_toxic` varchar(20) DEFAULT NULL,
  `lo_toxic` varchar(20) DEFAULT NULL,
  `median_f` varchar(20) DEFAULT NULL,
  `hi_bound_f` varchar(20) DEFAULT NULL,
  `lo_bound_f` varchar(20) DEFAULT NULL,
  `hi_critical_f` varchar(20) DEFAULT NULL,
  `lo_critical_f` varchar(20) DEFAULT NULL,
  `hi_toxic_f` varchar(20) DEFAULT NULL,
  `lo_toxic_f` varchar(20) DEFAULT NULL,
  `median_n` varchar(20) DEFAULT NULL,
  `hi_bound_n` varchar(20) DEFAULT NULL,
  `lo_bound_n` varchar(20) DEFAULT NULL,
  `hi_critical_n` varchar(20) DEFAULT NULL,
  `lo_critical_n` varchar(20) DEFAULT NULL,
  `hi_toxic_n` varchar(20) DEFAULT NULL,
  `lo_toxic_n` varchar(20) DEFAULT NULL,
  `median_y` varchar(20) DEFAULT NULL,
  `hi_bound_y` varchar(20) DEFAULT NULL,
  `lo_bound_y` varchar(20) DEFAULT NULL,
  `hi_critical_y` varchar(20) DEFAULT NULL,
  `lo_critical_y` varchar(20) DEFAULT NULL,
  `hi_toxic_y` varchar(20) DEFAULT NULL,
  `lo_toxic_y` varchar(20) DEFAULT NULL,
  `median_c` varchar(20) DEFAULT NULL,
  `hi_bound_c` varchar(20) DEFAULT NULL,
  `lo_bound_c` varchar(20) DEFAULT NULL,
  `hi_critical_c` varchar(20) DEFAULT NULL,
  `lo_critical_c` varchar(20) DEFAULT NULL,
  `hi_toxic_c` varchar(20) DEFAULT NULL,
  `lo_toxic_c` varchar(20) DEFAULT NULL,
  `method` varchar(255) DEFAULT NULL,
  `field_type` varchar(20) NOT NULL DEFAULT 'input_box' COMMENT 'values are input_box, dropdown and limited',
  `add_type` varchar(255) NOT NULL DEFAULT '',
  `add_label` varchar(255) NOT NULL DEFAULT '',
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `price` varchar(10) NOT NULL,
  `price_3` varchar(10) DEFAULT NULL,
  `price_2` varchar(10) DEFAULT NULL,
  `price_1` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`nr`)
) ENGINE=MyISAM AUTO_INCREMENT=103 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_laboratory_param_type`
--

DROP TABLE IF EXISTS `care_tz_laboratory_param_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_laboratory_param_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `param_id` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `input_value` varchar(35) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_laboratory_tests`
--

DROP TABLE IF EXISTS `care_tz_laboratory_tests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_laboratory_tests` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `parent` bigint(20) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `is_common` tinyint(4) NOT NULL DEFAULT '0',
  `is_comment_required` tinyint(4) NOT NULL DEFAULT '0',
  `comment` varchar(255) NOT NULL DEFAULT '',
  `price` double NOT NULL DEFAULT '0',
  `is_enabled` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`)
) ENGINE=MyISAM AUTO_INCREMENT=108 DEFAULT CHARSET=latin1 PACK_KEYS=0;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_mtuha_cat`
--

DROP TABLE IF EXISTS `care_tz_mtuha_cat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_mtuha_cat` (
  `cat_ID` int(50) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`cat_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_mtuha_cat_key`
--

DROP TABLE IF EXISTS `care_tz_mtuha_cat_key`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_mtuha_cat_key` (
  `cat_ID` int(50) NOT NULL,
  `icd10_key` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_person_insurance`
--

DROP TABLE IF EXISTS `care_tz_person_insurance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_person_insurance` (
  `person_insurance_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `insurance` smallint(5) NOT NULL,
  `person` int(11) unsigned NOT NULL,
  PRIMARY KEY (`person_insurance_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_region`
--

DROP TABLE IF EXISTS `care_tz_region`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_region` (
  `region_id` int(11) NOT NULL AUTO_INCREMENT,
  `region_code` int(10) NOT NULL,
  `region_name` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `is_additional` tinyint(4) NOT NULL,
  PRIMARY KEY (`region_id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_regions`
--

DROP TABLE IF EXISTS `care_tz_regions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_regions` (
  `CODE` varchar(6) DEFAULT NULL,
  `NAME` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_religion`
--

DROP TABLE IF EXISTS `care_tz_religion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_religion` (
  `nr` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(6) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `is_additional` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`nr`),
  KEY `CODE` (`code`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_stock_item_amount`
--

DROP TABLE IF EXISTS `care_tz_stock_item_amount`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_stock_item_amount` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `Drugsandservices_id` bigint(20) NOT NULL DEFAULT '0',
  `Amount` bigint(20) NOT NULL DEFAULT '0',
  `Stock_place_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_stock_item_properties`
--

DROP TABLE IF EXISTS `care_tz_stock_item_properties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_stock_item_properties` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `Drugsandservices_id` bigint(20) NOT NULL DEFAULT '0',
  `Stock_place_id` bigint(20) NOT NULL DEFAULT '0',
  `UnitOfIssue` varchar(25) NOT NULL,
  `Alternatives` varchar(255) NOT NULL,
  `Maximumlevel` bigint(20) NOT NULL DEFAULT '0',
  `Reorderlevel` bigint(20) NOT NULL DEFAULT '0',
  `Minimumlevel` bigint(20) NOT NULL DEFAULT '0',
  `Orderquantity` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_stock_place`
--

DROP TABLE IF EXISTS `care_tz_stock_place`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_stock_place` (
  `ID` bigint(20) NOT NULL,
  `Stockname` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_supplier_deatail`
--

DROP TABLE IF EXISTS `care_tz_supplier_deatail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_supplier_deatail` (
  `Suplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `Company_Name` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `Contact_Person` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `Address1` varchar(150) COLLATE latin1_general_ci NOT NULL,
  `Address2` varchar(150) COLLATE latin1_general_ci DEFAULT NULL,
  `Phone1` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `Phone2` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `Cell1` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `Cell2` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `Email` varchar(75) COLLATE latin1_general_ci NOT NULL,
  `Fax` varchar(75) COLLATE latin1_general_ci DEFAULT NULL,
  `Banker` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `Bank_Details` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `Account_no` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `Credit_Limit` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `Credit_Period` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`Suplier_id`),
  KEY `Company_Name` (`Company_Name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_tracker`
--

DROP TABLE IF EXISTS `care_tz_tracker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_tracker` (
  `tracker_ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `module` varchar(255) NOT NULL,
  `module_id` bigint(20) NOT NULL,
  `refering_module` varchar(255) NOT NULL,
  `refering_module_id` bigint(20) NOT NULL,
  `action` varchar(255) NOT NULL,
  `old_value` varchar(255) NOT NULL,
  `new_value` varchar(255) NOT NULL,
  `value_type` varchar(255) NOT NULL,
  `parameters` varchar(255) NOT NULL,
  `comment_user` varchar(255) NOT NULL,
  `session_user` varchar(255) NOT NULL,
  PRIMARY KEY (`tracker_ID`),
  KEY `time` (`time`,`session_user`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='tracking users action';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_tribes`
--

DROP TABLE IF EXISTS `care_tz_tribes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_tribes` (
  `tribe_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tribe_code` varchar(10) NOT NULL DEFAULT '',
  `tribe_name` varchar(20) NOT NULL DEFAULT '',
  `is_additional` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tribe_id`),
  KEY `tribe_id` (`tribe_id`)
) ENGINE=MyISAM AUTO_INCREMENT=352 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_tz_ward`
--

DROP TABLE IF EXISTS `care_tz_ward`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_tz_ward` (
  `ward_id` int(11) NOT NULL AUTO_INCREMENT,
  `ward_code` int(10) NOT NULL,
  `ward_name` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `is_additional` int(10) NOT NULL,
  PRIMARY KEY (`ward_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2785 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_unit_measurement`
--

DROP TABLE IF EXISTS `care_unit_measurement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_unit_measurement` (
  `nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `unit_type_nr` smallint(2) unsigned NOT NULL DEFAULT '0',
  `id` varchar(15) NOT NULL DEFAULT '',
  `name` varchar(35) NOT NULL DEFAULT '',
  `LD_var` varchar(35) NOT NULL DEFAULT '',
  `sytem` varchar(35) NOT NULL DEFAULT '',
  `use_frequency` bigint(20) DEFAULT NULL,
  `status` varchar(25) NOT NULL DEFAULT '',
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_users`
--

DROP TABLE IF EXISTS `care_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_users` (
  `name` varchar(60) NOT NULL DEFAULT '',
  `login_id` varchar(35) NOT NULL DEFAULT '',
  `password` varchar(255) DEFAULT NULL,
  `personell_nr` int(10) unsigned NOT NULL DEFAULT '0',
  `lockflag` tinyint(3) unsigned DEFAULT '0',
  `permission` text NOT NULL,
  `exc` tinyint(1) NOT NULL DEFAULT '0',
  `s_date` date NOT NULL DEFAULT '0000-00-00',
  `s_time` time NOT NULL DEFAULT '00:00:00',
  `expire_date` date NOT NULL DEFAULT '0000-00-00',
  `expire_time` time NOT NULL DEFAULT '00:00:00',
  `status` varchar(15) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL DEFAULT '',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`login_id`),
  KEY `login_id` (`login_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_version`
--

DROP TABLE IF EXISTS `care_version`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_version` (
  `name` varchar(20) NOT NULL DEFAULT '',
  `type` varchar(20) NOT NULL DEFAULT '',
  `number` varchar(10) NOT NULL DEFAULT '',
  `build` varchar(5) NOT NULL DEFAULT '',
  `date` date NOT NULL DEFAULT '0000-00-00',
  `time` time NOT NULL DEFAULT '00:00:00',
  `releaser` varchar(30) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `care_ward`
--

DROP TABLE IF EXISTS `care_ward`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care_ward` (
  `nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `ward_id` varchar(35) NOT NULL DEFAULT '',
  `name` varchar(35) NOT NULL DEFAULT '',
  `is_temp_closed` tinyint(1) NOT NULL DEFAULT '0',
  `date_create` date NOT NULL DEFAULT '0000-00-00',
  `date_close` date NOT NULL DEFAULT '0000-00-00',
  `description` text,
  `info` tinytext,
  `dept_nr` smallint(5) unsigned NOT NULL DEFAULT '0',
  `room_nr_start` smallint(6) NOT NULL DEFAULT '0',
  `room_nr_end` smallint(6) NOT NULL DEFAULT '0',
  `roomprefix` varchar(4) DEFAULT NULL,
  `status` varchar(25) NOT NULL DEFAULT '',
  `history` text NOT NULL,
  `modify_id` varchar(25) NOT NULL DEFAULT '0',
  `modify_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `create_id` varchar(25) NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`nr`),
  KEY `ward_id` (`ward_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mems_drug_list`
--

DROP TABLE IF EXISTS `mems_drug_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mems_drug_list` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Ped_list` varchar(255) DEFAULT NULL,
  `Adult_list` varchar(255) DEFAULT NULL,
  `Other` varchar(255) DEFAULT NULL,
  `Consumables` varchar(255) DEFAULT NULL,
  `Item_No` double DEFAULT NULL,
  `Item_Description` varchar(255) DEFAULT NULL,
  `Pack_Size` double DEFAULT NULL,
  `Price_Per_Pack_Size` double DEFAULT NULL,
  `selling_price` double DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `Item_No` (`Item_No`)
) ENGINE=MyISAM AUTO_INCREMENT=270 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mems_special_other`
--

DROP TABLE IF EXISTS `mems_special_other`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mems_special_other` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Ped_list` varchar(255) DEFAULT NULL,
  `Adult_list` varchar(255) DEFAULT NULL,
  `Other` varchar(255) DEFAULT NULL,
  `Consumables` varchar(255) DEFAULT NULL,
  `Item_No` double DEFAULT NULL,
  `Item_Description` varchar(255) DEFAULT NULL,
  `Pack_Size` varchar(255) DEFAULT NULL,
  `Price_Per_Pack_Size` double DEFAULT NULL,
  `selling_price` double DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `Item_No` (`Item_No`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mems_supplies`
--

DROP TABLE IF EXISTS `mems_supplies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mems_supplies` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Ped_list` varchar(255) DEFAULT NULL,
  `Adult_list` varchar(255) DEFAULT NULL,
  `Other` varchar(255) DEFAULT NULL,
  `Consumables` varchar(255) DEFAULT NULL,
  `Item_No` double DEFAULT NULL,
  `Item_Description` varchar(255) DEFAULT NULL,
  `Pack_Size` double DEFAULT NULL,
  `Price_Per_Pack_Size` double DEFAULT NULL,
  `selling_price` double DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `Item_No` (`Item_No`)
) ENGINE=MyISAM AUTO_INCREMENT=257 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mems_supplies_labor`
--

DROP TABLE IF EXISTS `mems_supplies_labor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mems_supplies_labor` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Ped_list` varchar(255) DEFAULT NULL,
  `Adult_list` varchar(255) DEFAULT NULL,
  `Other` varchar(255) DEFAULT NULL,
  `Consumables` varchar(255) DEFAULT NULL,
  `Item_No` double DEFAULT NULL,
  `Item_Description` varchar(255) DEFAULT NULL,
  `Pack_Size` double DEFAULT NULL,
  `Price_Per_Pack_Size` double DEFAULT NULL,
  `selling_price` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `Item_No` (`Item_No`)
) ENGINE=MyISAM AUTO_INCREMENT=109 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `SESSKEY` char(32) NOT NULL,
  `EXPIRY` int(11) unsigned NOT NULL,
  `EXPIREREF` varchar(64) DEFAULT NULL,
  `DATA` text NOT NULL,
  PRIMARY KEY (`SESSKEY`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `stockitemproperties`
--

DROP TABLE IF EXISTS `stockitemproperties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stockitemproperties` (
  `stockid` varchar(20) NOT NULL,
  `stkcatpropid` int(11) NOT NULL,
  `value` varchar(50) NOT NULL,
  PRIMARY KEY (`stockid`,`stkcatpropid`),
  KEY `stockid` (`stockid`),
  KEY `value` (`value`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;


-- The preloaded data follows -----------------------

--
-- Dumping data for table care_category_diagnosis
--

INSERT INTO care_category_diagnosis VALUES ('1', 'most_responsible', 'Most responsible', 'LDMostResponsible', 'M', 'LDMostResp_s', 'Most responsible diagnosis, must be only one per admission or visit', '0', '', '', '', 20030525120956, '', 00000000000000);
INSERT INTO care_category_diagnosis VALUES ('2', 'associated', 'Associated', 'LDAssociated', 'A', 'LDAssociated_s', 'Associated diagnosis, can be several per  admission or visit', '0', '', '', '', 20030525121005, '', 00000000000000);
INSERT INTO care_category_diagnosis VALUES ('3', 'nosocomial', 'Hospital acquired', 'LDNosocomial', 'N', 'LDNosocomial_s', 'Hospital acquired problem, can be several per admission or visit', '0', '', '', '', 20030525121015, '', 00000000000000);
INSERT INTO care_category_diagnosis VALUES ('4', 'iatrogenic', 'Iatrogenic', 'LDIatrogenic', 'I', 'LDIatrogenic_s', 'Problem resulting from a procedural/surgical complication or medication mistake', '0', '', '', '', 20030525121025, '', 00000000000000);
INSERT INTO care_category_diagnosis VALUES ('5', 'other', 'Other', 'LDOther', 'O', 'LDOther_s', 'Other  diagnosis', '0', '', '', '', 20030525121033, '', 00000000000000);

--
-- Dumping data for table care_category_disease
--

INSERT INTO care_category_disease VALUES ('1', '2', 'asphyxia', 'Asphyxia', 'LDAsphyxia', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_category_disease VALUES ('2', '2', 'infection', 'Infection', 'LDInfection', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_category_disease VALUES ('3', '2', 'congenital_abnomality', 'Congenital abnormality', 'LDCongenitalAbnormality', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_category_disease VALUES ('4', '2', 'trauma', 'Trauma', 'LDTrauma', '', '', 00000000000000, '', 00000000000000);

--
-- Dumping data for table care_category_procedure
--

INSERT INTO care_category_procedure VALUES ('1', 'main', 'Main', 'LDMain', 'M', 'LDMain_s', 'Main procedure, must be only one per op or intervention visit', '0', '', '', '', 20030614013508, '', 00000000000000);
INSERT INTO care_category_procedure VALUES ('2', 'supplemental', 'Supplemental', 'LDSupplemental', 'S', 'LDSupp_s', 'Supplemental procedure, can be several per  encounter op or intervention or visit', '0', '', '', '', 20030614015324, '', 00000000000000);

--
-- Dumping data for table care_class_encounter
--

INSERT INTO care_class_encounter VALUES (1, 'inpatient', 'Inpatient', 'LDStationary', 'Inpatient admission - stays at least in a ward and assigned a bed', '0', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_encounter VALUES (2, 'outpatient', 'Outpatient', 'LDAmbulant', 'Outpatient visit - does not stay in a ward nor assigned a bed', '0', '', '', '', 00000000000000, '', 00000000000000);

--
-- Dumping data for table care_class_ethnic_orig
--

INSERT INTO care_class_ethnic_orig VALUES (1, 'race', 'LDRace', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_ethnic_orig VALUES (2, 'country', 'LDCountry', '', '', 00000000000000, '', 00000000000000);

--
-- Dumping data for table care_class_financial
--

INSERT INTO care_class_financial VALUES (1, 'care_c', 'care', 'c', 'common', 'LDcommon', 'Common nursing care services. (Non-private)', 'Patient with common health fund insurance policy.', '', '', '', 20021229134050, '', 00000000000000);
INSERT INTO care_class_financial VALUES (2, 'care_pc', 'care', 'p/c', 'private + common', 'LDprivatecommon', 'Private services added to common services', 'Patient with common health fund insurance\r\npolicy with additional private insurance policy\r\nOR self paying components.', '', '', '', 20021229134451, '', 20021229134451);
INSERT INTO care_class_financial VALUES (3, 'care_p', 'care', 'p', 'private', 'LDprivate', 'Private nursing care services', 'Patient with private insurance policy\r\nOR self paying.', 'LDprivate', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_financial VALUES (4, 'care_pp', 'care', 'pp', 'private plus', 'LDprivateplus', '"Very private" nursing care services', 'Patient with private health insurance policy\r\nAND self paying components.', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_financial VALUES (5, 'room_c', 'room', 'c', 'common', 'LDcommon', 'Common room services (non-private)', 'Patient with common health fund insurance policy. ', 'LDcommon', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_financial VALUES (6, 'room_pc', 'room', 'p/c', 'private + common', '', 'Private services added to common services', 'Patient with common health fund insurance policy with additional private insurance policy OR self paying components.', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_financial VALUES (7, 'room_p', 'room', 'p', 'private', '', 'Private room services', 'Patient with private insurance policy OR self paying. ', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_financial VALUES (8, 'room_pp', 'room', 'pp', 'private plus', '', '"Very private" room services', 'Patient with private health insurance policy AND self paying components.', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_financial VALUES (9, 'att_dr_c', 'att_dr', 'c', 'common', '', 'Common clinician services', 'Patient with common health fund insurance policy. ', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_financial VALUES (10, 'att_dr_pc', 'att_dr', 'p/c', 'private + common', '', 'Private services added to common clinician services', 'Patient with common health fund insurance policy with additional private insurance policy OR self paying components.', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_financial VALUES (11, 'att_dr_p', 'att_dr', 'p', 'private', '', 'Private clinician services', 'Patient with private insurance policy OR self paying.', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_financial VALUES (12, 'att_dr_pp', 'att_dr', 'pp', 'private plus', '', '"Very private" clinician services', 'Patient with private health insurance policy AND self paying components.', '', '', '', 00000000000000, '', 00000000000000);

--
-- Dumping data for table care_class_insurance
--

INSERT INTO `care_class_insurance` (`class_nr`, `class_id`, `name`, `LD_var`, `description`, `status`, `history`, `modify_id`, `modify_time`, `create_id`, `create_time`) VALUES
(1, 'private', 'Private', 'LDPrivate', 'Private insurance plan (paid by insured alone)', 'active', '', '', '2008-10-21 18:25:25', '', '0000-00-00 00:00:00'),
(2, 'common', 'Health Fund', 'LDInsurance', 'Public (common) health fund - usually paid both by the insured and his employer, eventually paid by the state', 'active', '', '', '2008-10-21 18:25:25', '', '0000-00-00 00:00:00'),
(3, 'self_pay', 'Self pay', 'LDSelfPay', '', 'active', '', '', '2008-10-21 18:25:25', '', '0000-00-00 00:00:00');

--
-- Dumping data for table care_class_therapy
--

INSERT INTO care_class_therapy VALUES (1, '2', 'photo', 'Phototherapy', 'LDPhototherapy', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_therapy VALUES (2, '2', 'iv', 'IV Fluids', 'LDIVFluids', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_therapy VALUES (3, '2', 'oxygen', 'Oxygen therapy', 'LDOxygenTherapy', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_therapy VALUES (4, '2', 'cpap', 'CPAP', 'LDCPAP', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_therapy VALUES (5, '2', 'ippv', 'IPPV', 'LDIPPV', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_therapy VALUES (6, '2', 'nec', 'NEC', 'LDNEC', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_therapy VALUES (7, '2', 'tpn', 'TPN', 'LDTPN', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_class_therapy VALUES (8, '2', 'hie', 'HIE', 'LDHIE', '', '', '', 00000000000000, '', 00000000000000);

--
-- Dumping data for table care_classif_neonatal
--

INSERT INTO care_classif_neonatal VALUES (1, 'jaundice', 'Neonatal jaundice', 'LDNeonatalJaundice',  NULL, '', '', 20030807125731, '', 00000000000000);
INSERT INTO care_classif_neonatal VALUES (2, 'x_transfusion', 'Exchange transfusion', 'LDExchangeTransfusion',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_classif_neonatal VALUES (3, 'photo_therapy', 'Photo therapy', 'LDPhotoTherapy',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_classif_neonatal VALUES (4, 'h_i_encep', 'Hypoxic ischaemic encephalopathy', 'LDH_I_Encephalopathy',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_classif_neonatal VALUES (5, 'parenteral', 'Parenteral nutrition', 'LDParenteralNutrition',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_classif_neonatal VALUES (6, 'vent_support', 'Ventilatory support', 'LDVentilatorySupport',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_classif_neonatal VALUES (7, 'oxygen_therapy', 'Oxygen therapy', 'LDOxygenTherapy',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_classif_neonatal VALUES (8, 'cpap', 'CPAP', 'LDCPAP', 'Continuous positive airway pressure', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_classif_neonatal VALUES (9, 'congenital_abnormality', 'Congenital abnormality', 'LDCongenitalAbnormality',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_classif_neonatal VALUES (10, 'congenital_infection', 'Congenital infection', 'LDCongenitalInfection',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_classif_neonatal VALUES (11, 'acquired_infection', 'Acquired infection', 'LDAcquiredInfection',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_classif_neonatal VALUES (12, 'gbs_infection', 'GBS infection', 'LDGBSInfection', 'Group B Strep Infection', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_classif_neonatal VALUES (13, 'rds', 'Resp Distress Syndrome', 'LDRespDistressSyndrome',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_classif_neonatal VALUES (14, 'blood_transfusion', 'Blood transfusion', 'LDBloodTransfusion',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_classif_neonatal VALUES (15, 'antibiotic_therapy', 'Antibiotic therapy', 'LDAntibioticTherapy',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_classif_neonatal VALUES (16, 'necrotising_enterocolitis', 'Necrotising enterocolitis', 'LDNecrotisingEnterocolitis',  NULL, '', '', 20030807191727, '', 00000000000000);

--
-- Dumping data for table care_complication
--

INSERT INTO care_complication VALUES (1, 1, 'Previous C/S', 'LDPreviousCS', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_complication VALUES (2, 1, 'Pre-eclampsia', 'LDPreEclampsia', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_complication VALUES (3, 1, 'Eclampsia', 'LDEclampsia', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_complication VALUES (4, 1, 'Other hypertension', 'LDOtherHypertension', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_complication VALUES (5, 1, 'Other proteinuria', 'LDProteinuria', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_complication VALUES (6, 1, 'Cardiac', 'LDCardiac', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_complication VALUES (7, 1, 'Anaemia < 8.5g', 'LDAnaemia', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_complication VALUES (8, 1, 'Asthma', 'LDAsthma', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_complication VALUES (9, 1, 'Epilepsy', 'LDEpilepsy', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_complication VALUES (10, 1, 'Placenta praevia', 'LDPlacentaPraevia', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_complication VALUES (11, 1, 'Abruptio placentae', 'LDAbruptioPlacentae', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_complication VALUES (12, 1, 'Other APH', 'LDOtherAPH', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_complication VALUES (13, 1, 'Diabetes', 'LDDiabetes', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_complication VALUES (14, 1, 'Cord prolapse', 'LDCordProlapse', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_complication VALUES (15, 1, 'Ruptured uterus', 'LDRupturedUterus', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_complication VALUES (16, 1, 'Extrauterine pregnancy', 'LDExtraUterinePregnancy', '', '', '', '', 00000000000000, '', 00000000000000);

--
-- Dumping data for table care_config_global
--


INSERT INTO care_config_global VALUES ('date_format', 'dd/MM/yyyy', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('time_format', 'HH.MM', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('patient_reg_nr_adder', '10000000','', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('main_info_police_nr', '11?', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('main_info_fire_dept_nr', '12?', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('main_info_emgcy_nr', '13?', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('main_info_phone', '1234567', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('main_info_fax', '567890','', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('main_info_address', 'Virtualstr. 89AA\r\nCyberia 89300\r\nLas Vegas County', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('main_info_email', 'contact@care2x.com', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_id_nr_adder', '10000000', '', '', '', '', 00000000000000, '', 000000000000000);
INSERT INTO care_config_global VALUES ('patient_outpatient_nr_adder', '500000','', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('patient_inpatient_nr_adder', '0', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_name_2_hide', '0', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_name_3_hide', '0', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_name_middle_hide', '0', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_name_maiden_hide', '0', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_ethnic_orig_hide', '0', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_name_others_hide', '0', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_nat_id_nr_hide', '0', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_religion_hide', '0', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_cellphone_2_nr_hide', '0', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_phone_2_nr_hide', '0', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_citizenship_hide', '0', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_sss_nr_hide', '0', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('language_default', 'en', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('language_single', '0', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('gui_frame_left_nav_width', '150', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('gui_frame_left_nav_border', '1', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('news_photos_path', 'photos/news/', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('news_headline_title_font_size', '5', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('news_headline_title_font_face', 'arial,verdana,helvetica,sans serif', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('news_headline_title_font_color', '#CC3333', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('news_headline_preface_font_size', '2', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('news_headline_preface_font_face', 'arial,verdana,helvetica,sans serif','', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('news_headline_preface_font_color', '#336666', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('news_headline_body_font_size', '2', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('news_headline_body_font_face', 'arial,verdana,helvetica,sans serif', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('news_headline_body_font_color', '#000033', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('news_normal_preview_maxlen', '600', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('news_headline_title_font_bold', '1', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('news_headline_preface_font_bold', '', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('news_normal_display_width', '100%', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_fax_hide', '0', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_email_hide', '0', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_phone_1_nr_hide', '0', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_cellphone_1_nr_hide', '0', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_photo_path', 'photos/registration/', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('patient_service_care_hide', '1', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('patient_service_room_hide', '1', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('patient_service_att_dr_hide', '1', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('patient_financial_class_single_result', '0', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('patient_name_2_show', '1', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('patient_name_3_show', '1', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('patient_name_middle_show', '1', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('theme_control_buttons', 'default', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('gui_frame_left_nav_bdcolor', '#990000', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('theme_control_theme_list', 'default,blue_aqua', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('medocs_text_preview_maxlen', '100', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('staff_nr_adder', '100000', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('notes_preview_maxlen', '120', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_id_nr_init', '10000000', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('staff_nr_init', '100000', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('encounter_nr_init', '000000', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('encounter_nr_fullyear_prepend', '1', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('pagin_address_list_max_block_rows', '20', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('pagin_address_search_max_block_rows', '25', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('pagin_insurance_list_max_block_rows', '30', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('pagin_insurance_search_max_block_rows', '25', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('pagin_staff_search_max_block_rows', '20', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('pagin_person_search_max_block_rows', '20', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('pagin_staff_list_max_block_rows', '20', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('pagin_patient_search_max_block_rows', '20', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('pagin_or_patient_search_max_block_rows', '5', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('timeout_inactive', '0', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('timeout_time', '001500', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_title_hide', '0', NULL, 'normal', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_bloodgroup_hide', '0', NULL, 'normal', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_civilstatus_hide', '0', NULL, 'normal', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_insurance_hide', '0', NULL, 'normal', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_other_his_nr_hide', '0', NULL, 'normal', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('use_old_gui_style', '0', NULL, 'normal', '', '', 00000000000000, '', 00000000000000);

--
-- Dumping data for table care_config_user
--

INSERT INTO care_config_user VALUES ('default', 'a:19:{s:4:"mask";s:1:"1";s:11:"idx_bgcolor";s:7:"#ffffff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:0:"";s:8:"bversion";s:0:"";s:2:"ip";s:0:"";s:3:"cid";s:0:"";s:5:"dhtml";s:1:"1";s:4:"lang";s:0:"";}', 'default values', 'normal', 'installed', 'auto-installer', 0, 'auto-installer', 0);

--
-- Dumping data for table care_currency
--

INSERT INTO care_currency VALUES (1, 'S$', 'SG Dollar', 'Singapore Dollar (ISO = SGD)', 'main', '', 20100905190000, 'Ap Muthu', 20100905180000);
INSERT INTO care_currency VALUES (2, '$', 'US Dollar', 'US Dollar (ISO = USD)', '', '', 20100905190000, 'Ap Muthu', 20100905180000);
INSERT INTO care_currency VALUES (2, '€', 'Euro', 'European currency (ISO = EUR)', '', 'Elpidio Latorilla', 20030802190637, '', 20021126200534);
INSERT INTO care_currency VALUES (3, '€', 'Pound', 'GB British Pound (ISO = GBP)', '', '', 20030213173107, '', 20020816230349);
INSERT INTO care_currency VALUES (4, 'R', 'Rand', 'South African Rand (ISO = ZAR)', '', '', 20030802190637, 'Elpidio Latorilla', 20020817171805);
INSERT INTO care_currency VALUES (5, 'Rs', 'Rupees', 'Indian Rupees (ISO = INR)', '', '', 20030213173059, 'Elpidio Latorilla', 20020920234306);

--
-- Dumping data for table care_department
--

INSERT INTO care_department VALUES (1, 'pr', '2', 'Public Relations', 'PR', 'Press Relations', 'LDPressRelations', '', '0', '0', '1', '1', '0', '1', '0', '0', '', '', '0', '0',  NULL, '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (2, 'cafe', '2', 'Cafeteria', 'Cafe', 'Canteen', 'LDCafeteria', '', '0', '0', '1', '1', '0', '1', '0', '0', '', '', '0', '0',  NULL, '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (3, 'general_surgery', '1', 'General Surgery', 'General', 'General', 'LDGeneralSurgery', '', '1', '1', '1', '1', '1', '1', '0', '0', '8.30 - 21.00', '12.30 - 15.00 , 19.00 - 21.00', '0', '0', '', '', '', '', '', '', '', 20030828114327, '', 00000000000000, '','');
INSERT INTO care_department VALUES (4, 'emergency_surgery', '1', 'Emergency Surgery', 'Emergency', '', 'LDEmergencySurgery', '', '1', '1', '1', '1', '1', '1', '0', '0', '', '12.30 - 15.00 , 19.00 - 21.00', '0', '0',  NULL, '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (5, 'plastic_surgery', '1', 'Plastic Surgery', 'Plastic', 'Aesthetic Surgery', 'LDPlasticSurgery', '', '1', '1', '1', '1', '1', '1', '0', '0', '', '12.30 - 15.00 , 19.00 - 21.00', '0', '0',  NULL, '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (6, 'ent', '1', 'Ear-Nose-Throat', 'ENT', 'HNO', 'LDEarNoseThroat', 'Ear-Nose-Throat, in german Hals-Nasen-Ohren. The department with  very old traditions that date back to the early beginnings of premodern medicine.', '1', '1', '1', '1', '1', '1', '0', '0', '', '12.30 - 15.00 , 19.00 - 21.00', '0', '0',  NULL, '', 'kope akjdielj asdlkasdf', '', '', 'Update: 2003-08-13 23:24:16 Elpidio Latorilla\r\nUpdate: 2003-08-13 23:25:27 Elpidio Latorilla\r\nUpdate: 2003-08-13 23:29:05 Elpidio Latorilla\r\nUpdate: 2003-08-13 23:30:21 Elpidio Latorilla\r\nUpdate: 2003-08-13 23:31:52 Elpidio Latorilla\r\nUpdate: 2003-08-13 23:34:08 Elpidio Latorilla\r\n', 'Elpidio Latorilla', 20031019155346, '', 00000000000000, '','');
INSERT INTO care_department VALUES (7, 'opthalmology', '1', 'Opthalmology', 'Opthalmology', 'Eye Department', 'LDOpthalmology', '', '1', '1', '1', '1', '1', '1', '0', '0', '', '12.30 - 15.00 , 19.00 - 21.00', '0', '0',  NULL, '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (8, 'pathology', '1', 'Pathology', 'Pathology', 'Patho', 'LDPathology', '', '0', '0', '1', '1', '0', '1', '0', '0', '', '12.30 - 15.00 , 19.00 - 21.00', '0', '0', '', '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (9, 'ob_gyn', '1', 'Ob-Gynecology', 'Ob-Gyne', 'Gyn', 'LDObGynecology', '', '1', '1', '1', '1', '1', '1', '0', '0', '', '12.30 - 15.00 , 19.00 - 21.00', '0', '0',  NULL, '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (10, 'physical_therapy', '1', 'Physical Therapy', 'Physical', 'PT', 'LDPhysicalTherapy', 'Physical therapy department with on-call therapists. Day care clinics, training, rehab.', '1', '0', '1', '1', '0', '1', '1', '16', '8:00 - 15:00', '12.30 - 15.00 , 19.00 - 21.00', '0', '0', '', '', '', '', '', '', '', 20030828114351, '', 00000000000000, '','');
INSERT INTO care_department VALUES (11, 'internal_med', '1', 'Internal Medicine', 'Internal Med', 'InMed', 'LDInternalMedicine', '', '1', '1', '1', '1', '0', '1', '0', '0', '', '12.30 - 15.00 , 19.00 - 21.00', '0', '0', '', '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (12, 'imc', '1', 'Intermediate Care Unit', 'IMC', 'Intermediate', 'LDIntermediateCareUnit', '', '1', '1', '1', '1', '0', '1', '0', '0', '', '12.30 - 15.00 , 19.00 - 21.00', '0', '0', '', '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (13, 'icu', '1', 'Intensive Care Unit', 'ICU', 'Intensive', 'LDIntensiveCareUnit', '', '1', '1', '1', '1', '0', '1', '0', '0', '', '12.30 - 15.00 , 19.00 - 21.00', '0', '0', '', '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (14, 'emergency_ambulatory', '1', 'Emergency Ambulatory', 'Emergency', 'Emergency Amb', 'LDEmergencyAmbulatory', '', '0', '1', '1', '1', '0', '1', '1', '4', '', '12.30 - 15.00 , 19.00 - 21.00', '0', '0', '', '', '', '', '', 'Update: 2003-09-23 00:06:27 Elpidio Latorilla\n', 'Elpidio Latorilla', 20030923000627, '', 00000000000000, '','');
INSERT INTO care_department VALUES (15, 'general_ambulatory', '1', 'General Ambulatory', 'Ambulatory', 'General Amb', 'LDGeneralAmbulatory', '', '0', '1', '1', '1', '0', '1', '1', '3', 'round the clock', '12.30 - 15.00 , 19.00 - 21.00', '0', '0', '', '', '', '', '', '', '', 20030828114254, '', 00000000000000, '','');
INSERT INTO care_department VALUES (16, 'inmed_ambulatory', '1', 'Internal Medicine Ambulatory', 'InMed Ambulatory', 'InMed Amb', 'LDInternalMedicineAmbulatory', '', '0', '1', '1', '1', '0', '1', '1', '11', '', '12.30 - 15.00 , 19.00 - 21.00', '0', '0', '', '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (17, 'sonography', '1', 'Sonography', 'Sono', 'Ultrasound diagnostics', 'LDSonography', '', '0', '1', '1', '1', '0', '1', '1', '11', '', '12.30 - 15.00 , 19.00 - 21.00', '0', '0', '', '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (18, 'nuclear_diagnostics', '1', 'Nuclear Diagnostics', 'Nuclear', 'Nuclear Testing', 'LDNuclearDiagnostics', '', '0', '1', '1', '1', '0', '1', '1', '19', '', '12.30 - 15.00 , 19.00 - 21.00', '0', '0', '', '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (19, 'radiology', '1', 'Radiology', 'Radiology', 'Xray', 'LDRadiology', '', '0', '1', '1', '1', '0', '1', '0', '0', '', '12.30 - 15.00 , 19.00 - 21.00', '0', '0', '', '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (20, 'oncology', '1', 'Oncology', 'Oncology', 'Cancer Department', 'LDOncology', '', '1', '1', '1', '1', '1', '1', '0', '11', '', '12.30 - 15.00 , 19.00 - 21.00', '0', '0',  NULL, '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (21, 'neonatal', '1', 'Neonatal', 'Neonatal', 'Newborn Department', 'LDNeonatal', '', '1', '1', '1', '1', '1', '1', '1', '9', '', '12.30 - 15.00 , 19.00 - 21.00', '0', '0',  NULL, '343', '', '', '', 'Update: 2003-08-13 22:32:07 Elpidio Latorilla\nUpdate: 2003-08-13 22:33:10 Elpidio Latorilla\nUpdate: 2003-08-13 22:43:39 Elpidio Latorilla\nUpdate: 2003-08-13 22:43:59 Elpidio Latorilla\nUpdate: 2003-08-13 22:44:19 Elpidio Latorilla\n', 'Elpidio Latorilla', 20030813224419, '', 00000000000000, '','');
INSERT INTO care_department VALUES (22, 'central_lab', '1', 'Central Laboratory', 'Central Lab', 'General Lab', 'LDCentralLaboratory', '', '0', '0', '1', '1', '0', '1', '0', '0', '', '12.30 - 15.00 , 19.00 - 21.00', '0', '0', '', '', 'kdkdododospdfjdasljfda\r\nasdflasdjf\r\nasdfklasdjflasdjf', '', '', 'Update: 2003-08-13 23:12:30 Elpidio Latorilla\r\nUpdate: 2003-08-13 23:14:59 Elpidio Latorilla\r\nUpdate: 2003-08-13 23:15:28 Elpidio Latorilla\r\n', 'Elpidio Latorilla', 20030828114243, '', 00000000000000, '','');
INSERT INTO care_department VALUES (23, 'serological_lab', '1', 'Serological Laboratory', 'Serological Lab', 'Serum Lab', 'LDSerologicalLaboratory', '', '0', '1', '1', '1', '0', '1', '1', '22', '', '12.30 - 15.00 , 19.00 - 21.00', '0', '0', '', '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (24, 'chemical_lab', '1', 'Chemical Laboratory', 'Chemical Lab', 'Chem Lab', 'LDChemicalLaboratory', '', '0', '1', '1', '1', '0', '1', '1', '22', '', '12.30 - 15.00 , 19.00 - 21.00', '0', '0', '', '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (25, 'bacteriological_lab', '1', 'Bacteriological Laboratory', 'Bacteriological Lab', 'Bacteria Lab', 'LDBacteriologicalLaboratory', '', '0', '1', '1', '1', '0', '1', '1', '22', '', '12.30 - 15.00 , 19.00 - 21.00', '0', '0', '', '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (26, 'tech', '2', 'Technical Maintenance', 'Tech', 'Technical Support', 'LDTechnicalMaintenance', '', '0', '0', '1', '1', '0', '1', '0', '0', '', '', '0', '0', '', '', '', 'jpg', '', 'Update: 2003-08-10 23:42:30 Elpidio Latorilla\n', 'Elpidio Latorilla', 20030810234230, '', 00000000000000, '','');
INSERT INTO care_department VALUES (27, 'it', '2', 'IT Department', 'IT', 'EDP', 'LDITDepartment', '', '0', '0', '1', '1', '0', '1', '0', '0', '', '', '0', '0', '', '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (28, 'management', '2', 'Management', 'Management', 'Busines Administration', 'LDManagement', '', '0', '0', '1', '1', '0', '1', '0', '0', '', '', '0', '0', '', '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (29, 'exhibition', '3', 'Exhibitions', 'Exhibit', 'Showcases', 'LDExhibitions', '', '0', '0', '1', '1', '1', '1', '0', '0', '', '', '0', '0',  NULL, '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (30, 'edu', '3', 'Education', 'Edu', 'Training', 'LDEducation', 'Education news bulletin of the hospital.', '0', '0', '1', '1', '0', '1', '0', '0', '', '', '0', '0', '', '', '', '', '', 'Update: 2003-08-13 22:44:45 Elpidio Latorilla\nUpdate: 2003-08-13 23:00:37 Elpidio Latorilla\n', 'Elpidio Latorilla', 20030813230037, '', 00000000000000, '','');
INSERT INTO care_department VALUES (31, 'study', '3', 'Studies', 'Studies', 'Advance studies or on-the-job training', 'LDStudies', '', '0', '0', '1', '1', '1', '1', '0', '0', '', '', '0', '0',  NULL, '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (32, 'health_tip', '3', 'Health Tips', 'Tips', 'Health Information', 'LDHealthTips', '', '0', '0', '1', '1', '1', '1', '0', '0', '', '', '0', '0',  NULL, '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (33, 'admission', '2', 'Admission', 'Admit', 'Admission information', 'LDAdmission', '', '0', '0', '1', '1', '1', '0', '1', '0', '', '', '0', '0',  NULL, '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (34, 'news_headline', '3', 'Headline', 'News head', 'Major news', 'LDHeadline', '', '0', '0', '1', '1', '1', '1', '0', '0', '', '', '0', '0',  NULL, '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (35, 'cafenews', '3', 'Cafe News', 'Cafe news', 'Cafeteria news', 'LDCafeNews', '', '0', '0', '1', '1', '1', '0', '0', '0', '', '', '0', '0',  NULL, '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (36, 'nursing', '3', 'Nursing', 'Nursing', 'Nursing care', 'LDNursing', '', '1', '1', '1', '1', '1', '1', '1', '0', '', '', '0', '0',  NULL, '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (37, 'doctors', '3', 'Doctors', 'Doctors', 'Medical staff', 'LDDoctors', '', '0', '0', '1', '1', '1', '1', '0', '0', '', '', '0', '0',  NULL, '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (38, 'pharmacy', '2', 'Pharmacy', 'Pharma', 'Drugstore', 'LDPharmacy', '', '0', '0', '1', '1', '1', '1', '0', '0', '', '', '0', '0',  NULL, '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (39, 'anaesthesiology', '1', 'Anesthesiology', 'ana', 'Anesthesia Department', 'LDAnesthesiology', 'Anesthesiology', '0', '0', '1', '1', '1', '1', '0', '0', '', '', '0', '0', '', '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (40, 'general_ambulant', '1', 'General Outpatient Clinic', 'General Clinic', 'General Ambulatory Clinic', 'LDGeneralOutpatientClinic', 'Outpatient/Ambulant Clinic for general/internal medicine', '0', '1', '1', '1', '0', '0', '1', '16', 'round the clock', '8:30 AM - 11:30 AM , 2:00 PM - 5:30 PM', '0', '0', '', '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (41, 'blood_bank', '1', 'Blood Bank', 'Blood Blank', 'Blood Lab', 'LDBloodBank', '', '0', '0', '1', '1', '0', '1', '0', '0', '', '', '0', '0', '', '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');


--
-- Dumping data for table care_effective_day
--

INSERT INTO care_effective_day VALUES ('1', 'entire stay', 'effective starting from admission date & ending on discharge date', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_effective_day VALUES ('2', 'admission day', 'Effective only on admission day', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_effective_day VALUES ('3', 'discharge day', 'Effective only on discharge day', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_effective_day VALUES ('4', 'op day', 'Effective only on operation day', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_effective_day VALUES ('5', 'transfer day', 'Effective only on transfer day', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_effective_day VALUES ('6', 'period', 'defined start and end dates', '', '', '', 00000000000000, '', 00000000000000);

--
-- Dumping data for table care_group
--

INSERT INTO care_group VALUES (1, 'pregnancy', 'Pregnancy', 'LDPregnancy', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_group VALUES (2, 'neonatal', 'Neonatal', 'LDNeonatal', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_group VALUES (3, 'encounter', 'Encounter', 'LDEncounter', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_group VALUES (4, 'op', 'OP', 'LDOP', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_group VALUES (5, 'anesthesia', 'Anesthesia', 'LDAnesthesia', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_group VALUES (6, 'prescription', 'Prescription', 'LDPrescription', '', '', '', 00000000000000, '', 00000000000000);

--
-- Dumping data for table care_menu_main
--
INSERT INTO `care_menu_main` VALUES
(2, 5, 0, 'Patient', '', '', 'LDPatient', 'modules/registration_admission/patient_register_pass.php', 1, '', '', '20030922232015', '0000-00-00 00:00:00'),
(3, 10, 0, 'Admission', 'admission', '', 'LDAdmission', 'modules/registration_admission/admission_pass.php', 1, '', '', '20030922232015', '0000-00-00 00:00:00'),
(4, 15, 0, 'Ambulatory', '', '', 'LDAmbulatory', 'modules/ambulatory/ambulatory.php', 1, '', '', '20030922232015', '0000-00-00 00:00:00'),
(5, 20, 7, 'Medocs', 'medocs', '', 'LDMedocs', 'modules/medocs/medocs_pass.php', 1, '', '', '20030922232015', '0000-00-00 00:00:00'),
(6, 25, 29, 'Doctors', 'doctors', '', 'LDDoctors', 'modules/doctors/doctors.php', 1, '', '', '20030922232015', '0000-00-00 00:00:00'),
(7, 35, 0, 'Nursing', 'nursing', '', 'LDNursing', 'modules/nursing/nursing.php', 1, '', '', '20030922232015', '0000-00-00 00:00:00'),
(8, 40, 0, 'OR', 'op', 'LDOR', '', 'main/op-docu.php', 1, '', '', '20030922232015', '0000-00-00 00:00:00'),
(9, 45, 31, 'Laboratories', 'lab', '', 'LDLabs', 'modules/laboratory/labor.php', 1, '', '', '20030922232015', '0000-00-00 00:00:00'),
(10, 50, 31, 'Radiology', 'radio', '', 'LDRadiology', 'modules/radiology/radiolog.php', 1, '', '', '20030922232015', '0000-00-00 00:00:00'),
(11, 55, 30, 'Pharmacy', 'pharma', '', 'LDPharmacy', 'modules/pharmacy/pharmacy.php', 1, '', '', '20030922232015', '0000-00-00 00:00:00'),
(12, 60, 30, 'Medical Depot', 'meddepot', '', 'LDMedDepot', 'modules/medstock/medstock.php ', 1, '', '', '20030922232015', '0000-00-00 00:00:00'),
(13, 65, 29, 'Directory', 'teldir', '', 'LDDirectory', 'modules/phone_directory/phone.php', 1, '', '', '20030922232015', '0000-00-00 00:00:00'),
(14, 70, 29, 'Tech Support', 'tech', '', 'LDTechSupport', 'modules/tech/tech.php', 1, '', '', '20030922232015', '0000-00-00 00:00:00'),
(15, 72, 29, 'System Admin', 'System Admin', '', 'LDEDP', 'modules/system_admin/admin.php', 1, '', '', '20030922232015', '0000-00-00 00:00:00'),
(16, 75, 29, 'Intranet Email', '', '', 'LDIntraEmail', 'modules/intranet_email/intra-email-pass.php', 1, '', '', '20030922232015', '0000-00-00 00:00:00'),
(18, 85, 29, 'Modules', '', '', 'LDSpecials', 'main/plugin.php', 1, '', '', '20030922232015', '0000-00-00 00:00:00'),
(19, 90, 0, 'Login', '', '', 'LDLogin', 'main/login.php', 1, '', '', '20030922232015', '0000-00-00 00:00:00'),
(20, 7, 2, 'Appointments', '', '', 'LDAppointments', 'modules/appointment_scheduler/appt_main_pass.php', 1, '', '', '20030922232015', '2003-04-05 00:01:45'),
(21, 0, 2, 'Admission', '', NULL, 'LDAdmission', 'modules/registration_admission/patient_register_pass.php', 1, NULL, '', NULL, '2011-08-24 22:01:58'),
(22, 0, 2, 'Registration', '', 'gui/img/common/default/post_discussion.gif', '', 'modules/registration_admission/patient_register_pass.php', 1, NULL, '', NULL, '2011-08-24 22:04:17'),
(23, 0, 2, 'Search', '', 'gui/img/common/default/findnew.gif', 'LDSearch', 'modules/registration_admission/patient_register_pass.php&target=search', 1, NULL, '', NULL, '2011-08-24 22:04:59'),
(24, 0, 2, 'Archive', '', 'LDArchive', '', 'modules/registration_admission/patient_register_pass.php?target=archiv', 1, NULL, '', NULL, '2011-08-24 22:05:50'),
(25, 0, 7, 'Wards', '', 'gui/img/common/default/bul_arrowgrnsm.gif', '', 'modules/nursing/nursing.php', 1, NULL, '', NULL, '2011-08-24 22:07:09'),
(26, 0, 3, 'Archive', '', NULL, 'LDArchive', 'modules/registration_admission/admission_pass.php?target=archiv', 1, NULL, '', NULL, '2011-08-24 22:07:39'),
(27, 0, 7, 'Search', '', 'gui/img/common/default/findnew.gif', '', 'modules/nursing/nursing-patient-search-start.php', 1, NULL, '', NULL, '2011-08-24 22:08:06'),
(28, 0, 7, 'Quick view', '', 'gui/img/common/default/eye_s.gif', '', 'modules/nursing/nursing-quickview.php', 1, NULL, '', NULL, '2011-08-24 22:08:36'),
(29, 0, 0, 'Special Tools', '', NULL, '', '', 1, NULL, '', NULL, '2011-08-29 19:12:10'),
(30, 0, 0, 'Medicaments', '', NULL, '', '', 1, NULL, '', NULL, '2011-08-29 19:20:15'),
(31, 0, 0, 'Analysis', '', NULL, '', '', 1, NULL, '', NULL, '2011-08-29 19:23:08');

--
-- Dumping data for table care_method_induction
--

INSERT INTO care_method_induction VALUES (1, '1', 'not_induced', 'Not induced', 'LDNotInduced', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_method_induction VALUES (2, '1', 'unknown', 'Unknown', 'LDUnknown', '', '', '', 20030805191240, '', 00000000000000);
INSERT INTO care_method_induction VALUES (3, '1', 'prostaglandin', 'Prostaglandin', 'LDProstaglandin', '', '', '', 20030805191247, '', 00000000000000);
INSERT INTO care_method_induction VALUES (4, '1', 'oxytocin', 'Oxytocin', 'LDOxytocin', '', '', '', 20030805191254, '', 00000000000000);
INSERT INTO care_method_induction VALUES (5, '1', 'arom', 'AROM', 'LDAROM', '', '', '', 20030805191302, '', 00000000000000);

--
-- Dumping data for table care_mode_delivery
--

INSERT INTO care_mode_delivery VALUES (1, '2', 'normal', 'Normal', 'LDNormal', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_mode_delivery VALUES (2, '2', 'breech', 'Breech', 'LDBreech', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_mode_delivery VALUES (3, '2', 'caesarian', 'Caesarian', 'LDCaesarian', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_mode_delivery VALUES (4, '2', 'forceps', 'Forceps', 'LDForceps', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_mode_delivery VALUES (5, '2', 'vacuum', 'Vacuum', 'LDVacuum', '', '', '', 00000000000000, '', 00000000000000);

--
-- Dumping data for table care_registry
--

INSERT INTO care_registry VALUES ('amb', 'modules/ambulatory/ambulatory.php', 'modules/news/newscolumns.php', '', '', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_registry VALUES ('dept', 'modules/news/departments.php', 'modules/news/newscolumns.php', '', '', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_registry VALUES ('radiology', 'modules/radiology/radiolog.php', 'modules/news/newscolumns.php', '', '', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_registry VALUES ('doctors', 'modules/doctors/doctors.php', 'modules/news/newscolumns.php', '', '', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_registry VALUES ('nursing', 'modules/nursing/pflege.php', 'modules/news/newscolumns.php', '', '', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_registry VALUES ('edp', 'modules/admin/admin.php', 'modules/news/newscolumns.php', '', '', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_registry VALUES ('pharmacy', 'modules/pharmacy/pharmacy.php', 'modules/news/newscolumns.php', '', '', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_registry VALUES ('pr', 'modules/news/start_page.php', 'modules/news/start_page.php', 'modules/news/headline-edit.php', 'modules/news/headline-read.php', 'modules/news/editor-pass.php', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_registry VALUES ('cafe', 'modules/cafeteria/cafenews.php', 'modules/cafeteria/cafenews.php', 'modules/cafenews/cafenews-edit.php', 'modules/cafenews/cafenews-read.php', 'modules/cafenews/cafenews-edit-pass.php', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_registry VALUES ('main_start', 'modules/news/start_page.php', 'modules/news/start_page.php', 'modules/news/headline-edit-select-art.php', 'modules/news/headline-read.php', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_registry VALUES ('it', 'modules/system_admin/admin.php', 'modules/news/newscolumns.php', 'modules/news/editor-4plus1-select-art.php', 'modules/news/editor-4plus1-read.php', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_registry VALUES ('admission_module', 'modules/admission/admission_start.php', '', '', '', 'modules/admission/admission_pass.php', '', '', '', 00000000000000, '', 00000000000000);

--
-- Dumping data for table care_role_person
--

INSERT INTO care_role_person VALUES (1, '3', 'contact', 'Contact person', 'LDContactPerson', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (2, '3', 'guarantor', 'Guarantor', 'LDGuarantor', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (3, '3', 'doctor_att', 'Attending doctor', 'LDAttDoctor', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (4, '3', 'supervisor', 'Supervisor', 'LDSupervisor', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (5, '3', 'doctor_admit', 'Admitting doctor', 'LDAdmittingDoctor', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (6, '3', 'doctor_consult', 'Consulting doctor', 'LDConsultingDoctor', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (7, '4', 'surgeon', 'Surgeon', 'LDSurgeon', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (8, '4', 'surgeon_asst', 'Assisting surgeon', 'LDAssistingSurgeon', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (9, '4', 'nurse_scrub', 'Scrub nurse', 'LDScrubNurse', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (10, '4', 'nurse_rotating', 'Rotating nurse', 'LDRotatingNurse', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (11, '4', 'nurse_anesthesia', 'Anesthesia nurse', 'LDAnesthesiaNurse', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (12, '4', 'anesthesiologist', 'Anesthesiologist', 'LDAnesthesiologist', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (13, '4', 'anesthesiologist_asst', 'Assisting anesthesiologist', 'LDAssistingAnesthesiologist', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (14, '0', 'nurse_on_call', 'Nurse On Call', 'LDNurseOnCall', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (15, '0', 'doctor_on_call', 'Doctor On Call', 'LDDoctorOnCall', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (16, '0', 'nurse', 'Nurse', 'LDNurse', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_role_person VALUES (17, '0', 'doctor', 'Doctor', 'LDDoctor', '', '', 00000000000000, '', 00000000000000);

--
-- Dumping data for table care_room
--

INSERT INTO care_room VALUES ('1', '2', '2003-04-27', '0000-00-00', '0', 1, 0, 0, '1', '',  NULL, '', '', '', 20030427175459, '', 20030427175459);
INSERT INTO care_room VALUES ('2', '2', '2003-04-27', '0000-00-00', '0', 2, 0, 0, '1', '',  NULL, '', '', '', 20030427175704, '', 20030427175631);
INSERT INTO care_room VALUES ('3', '2', '2003-04-27', '0000-00-00', '0', 3, 0, 0, '1', '',  NULL, '', '', '', 20030427175813, '', 20030427175727);
INSERT INTO care_room VALUES ('4', '2', '2003-04-27', '0000-00-00', '0', 4, 0, 0, '1', '',  NULL, '', '', '', 20030427180021, '', 20030427175846);
INSERT INTO care_room VALUES ('5', '2', '2003-04-27', '0000-00-00', '0', 5, 0, 0, '1', '',  NULL, '', '', '', 20030427180132, '', 20030427175927);
INSERT INTO care_room VALUES ('6', '2', '2003-04-27', '0000-00-00', '0', 6, 0, 0, '1', '',  NULL, '', '', '', 20030427180122, '', 20030427180105);
INSERT INTO care_room VALUES ('7', '2', '2003-04-27', '0000-00-00', '0', 7, 0, 0, '1', '',  NULL, '', '', '', 20030427180310, '', 20030427180310);
INSERT INTO care_room VALUES ('8', '2', '2003-04-27', '0000-00-00', '0', 8, 0, 0, '1', '',  NULL, '', '', '', 20030427180350, '', 20030427180350);
INSERT INTO care_room VALUES ('9', '2', '2003-04-27', '0000-00-00', '0', 9, 0, 0, '1', '',  NULL, '', '', '', 20030427180433, '', 20030427180433);
INSERT INTO care_room VALUES ('10', '2', '2003-04-27', '0000-00-00', '0', 10, 0, 0, '1', '',  NULL, '', '', '', 20030427180503, '', 20030427180503);
INSERT INTO care_room VALUES ('11', '2', '2003-04-27', '0000-00-00', '0', 11, 0, 0, '1', '',  NULL, '', '', '', 20030427180636, '', 20030427180636);
INSERT INTO care_room VALUES ('12', '2', '2003-04-27', '0000-00-00', '0', 12, 0, 0, '1', '',  NULL, '', '', '', 20030427180759, '', 20030427180759);
INSERT INTO care_room VALUES ('13', '2', '2003-04-27', '0000-00-00', '0', 13, 0, 0, '1', '',  NULL, '', '', '', 20030427180826, '', 20030427180826);
INSERT INTO care_room VALUES ('14', '2', '2003-04-27', '0000-00-00', '0', 14, 0, 0, '1', '',  NULL, '', '', '', 20030427180852, '', 20030427180852);
INSERT INTO care_room VALUES ('15', '2', '2003-04-27', '0000-00-00', '0', 15, 0, 0, '1', '',  NULL, '', '', '', 20030427180918, '', 20030427180918);

--
-- Dumping data for table care_test_param
--

INSERT INTO `care_test_param` (`nr`, `group_id`, `name`, `id`, `sort_nr`, `msr_unit`, `status`, `median`, `hi_bound`, `lo_bound`, `hi_critical`, `lo_critical`, `hi_toxic`, `lo_toxic`, `median_f`, `hi_bound_f`, `lo_bound_f`, `hi_critical_f`, `lo_critical_f`, `hi_toxic_f`, `lo_toxic_f`, `median_n`, `hi_bound_n`, `lo_bound_n`, `hi_critical_n`, `lo_critical_n`, `hi_toxic_n`, `lo_toxic_n`, `median_y`, `hi_bound_y`, `lo_bound_y`, `hi_critical_y`, `lo_critical_y`, `hi_toxic_y`, `lo_toxic_y`, `median_c`, `hi_bound_c`, `lo_bound_c`, `hi_critical_c`, `lo_critical_c`, `hi_toxic_c`, `lo_toxic_c`, `method`, `history`, `modify_id`, `modify_time`, `create_id`, `create_time`) VALUES
(1, 'priority', 'Quick', '00q', 0, 'mm/s', '', '15', '', '', '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(2, 'priority', 'PTT', '00ptt', 0, 'mm/s', '', '', '', '', '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(3, 'priority', 'Hb', '00hb', 0, 'g/dl', '', '12', '', '', '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(4, 'priority', 'Hk', '00hc', 0, '%', '', '36', '', '', '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(5, 'priority', 'Platelets', '00pla', 0, 'c/cmm', '', '200000', '', '', '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(6, 'priority', 'RBC', '00rbc', 0, 'mil/cmm', '', '4.5', '', '', '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(7, 'priority', 'WBC', '00wbc', 0, 'c/ccm', '', '5000', '', '', '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(8, 'priority', 'Calcium', '00ca', 0, 'mEq/ml', '', '', '', '', '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(9, 'priority', 'Sodium', '00na', 0, 'mEq/ml', '', '20', '', '', '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(10, 'priority', 'Potassium', '00k', 0, 'mEq/ml', '', '10', '', '', '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(11, 'priority', 'Blood sugar', '00sug', 0, 'mg/dL', '', '', '', '', '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(12, 'clinical_chem', 'Alk. Ph.', '0aph', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(13, 'clinical_chem', 'Alpha GT', '0agt', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(14, 'clinical_chem', 'Ammonia', '0amm', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(15, 'clinical_chem', 'Amylase', '0amy', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(16, 'clinical_chem', 'Bili total', '0bit', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(17, 'clinical_chem', 'Bili direct', '0bid', 0, '', '', '', '', '', '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(18, 'clinical_chem', 'Calcium', '0ca', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(19, 'clinical_chem', 'Chloride', '0chl', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(20, 'clinical_chem', 'Chol', '0cho', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(21, 'clinical_chem', 'Cholinesterase', '0chol', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(22, 'clinical_chem', 'CKMB', '0ccmb', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(23, 'clinical_chem', 'CPK', '0cpc', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(24, 'clinical_chem', 'CRP', '0crp', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(25, 'clinical_chem', 'Iron', '0fe', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(26, 'clinical_chem', 'RBC', '0rbc', 0, 'c/ccm', '', '', '', '', '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(27, 'clinical_chem', 'free HgB', '0fhb', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(28, 'clinical_chem', 'GLDH', '0gldh', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(29, 'clinical_chem', 'GOT', '0got', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(30, 'clinical_chem', 'GPT', '0gpt', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(31, 'clinical_chem', 'Uric acid', '0ucid', 0, '', '', '', '', '', '', 'Update 2003-09-05 17', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(32, 'clinical_chem', 'Urea', '0urea', 0, '', '', '', '', '', '', 'Update 2003-09-05 17', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(33, 'clinical_chem', 'HBDH', '0hbdh', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(34, 'clinical_chem', 'HDL Chol', '0hdlc', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(35, 'clinical_chem', 'Potassium', '0pot', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(36, 'clinical_chem', 'Creatinine', '0cre', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(37, 'clinical_chem', 'Copper', '0co', 0, '', '', '', '', '', '', 'Update 2003-09-05 17', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(38, 'clinical_chem', 'Lactate i.P.', '0lac', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(39, 'clinical_chem', 'LDH', '0ldh', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(40, 'clinical_chem', 'LDL Chol', '0ldlc', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(41, 'clinical_chem', 'Lipase', '0lip', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(42, 'clinical_chem', 'Lipid Elpho', '0lpid', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(43, 'clinical_chem', 'Magnesium', '0mg', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(44, 'clinical_chem', 'Myoglobin', '0myo', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(45, 'clinical_chem', 'Sodium', '0na', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(46, 'clinical_chem', 'Osmolal.', '0osm', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(47, 'clinical_chem', 'Phosphor', '0pho', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(48, 'clinical_chem', 'Serum sugar', '0glo', 0, 'mg/dL', '', '', '', '', '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(49, 'clinical_chem', 'Tri', '0tri', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(50, 'clinical_chem', 'Troponin T', '0tro', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(51, 'liquor', 'Liquor status', '1stat', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(52, 'liquor', 'Liquor elpho', '1elp', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(53, 'liquor', 'Oligoclonales IgG', '1oli', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(54, 'liquor', 'Reiber Scheme', '1sch', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(55, 'liquor', 'A1', '1a1', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(56, 'coagulation', 'Fibrinolysis', '2fiby', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(57, 'coagulation', 'Quick', '2q', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(58, 'coagulation', 'PTT', '2ptt', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(59, 'coagulation', 'PTZ', '2ptz', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(60, 'coagulation', 'Fibrinogen', '2fibg', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(61, 'coagulation', 'Sol.Fibr.mon.', '2fibs', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(62, 'coagulation', 'FSP dimer', '2fsp', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(63, 'coagulation', 'Thr.Coag.', '2coag', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(64, 'coagulation', 'AT III', '2at3', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(65, 'coagulation', 'Faktor VII', '2f8', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(66, 'coagulation', 'APC Resistance', '2apc', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(67, 'coagulation', 'Protein C', '2prc', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(68, 'coagulation', 'Protein S', '2prs', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(69, 'coagulation', 'Bleeding time', '2bt', 0, 'ml/s', '', '', '', '', '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(70, 'hematology', 'Retikulocytes', '3ret', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(71, 'hematology', 'Malaria', '3mal', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(72, 'hematology', 'Hb Elpho', '3hbe', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(73, 'hematology', 'HLA B 27', '3hla', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(74, 'hematology', 'Platelets AB', '3tab', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(75, 'hematology', 'WBC Phosp.', '3wbp', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(76, 'blood_sugar', 'Blood sugar fasting', '4bsf', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(77, 'blood_sugar', 'Blood sugar 9:00', '4bs9', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(78, 'blood_sugar', 'Blood sugar p.prandial', '4bsp', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(79, 'blood_sugar', 'Bl15:00', '4bs15', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(80, 'blood_sugar', 'Blood sugar 1', '4bs1', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(81, 'blood_sugar', 'Blood sugar 2', '4bs2', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(82, 'blood_sugar', 'Glucose stress.', '4glo', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(83, 'blood_sugar', 'Lactose stress', '4lac', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(84, 'blood_sugar', 'HBA 1c', '4hba', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(85, 'blood_sugar', 'Fructosamine', '4fru', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(86, 'neonate', 'Neonate bilirubin', '5bil', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(87, 'neonate', 'Cord bilirubin', '5bilc', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(88, 'neonate', 'Bilirubin direct', '5bild', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(89, 'neonate', 'Neonate sugar 1', '5glo1', 0, 'mg/dL', '', '', '', '', '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(90, 'neonate', 'Neonate sugar 2', '5glo2', 0, 'mg/DL', '', '30', '', '', '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(91, 'neonate', 'Reticulocytes', '5ret', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(92, 'neonate', 'B1', '5b1', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(93, 'proteins', 'Total proteins', '6tot', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(94, 'proteins', 'Albumin', '6alb', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(95, 'proteins', 'Elpho', '6elp', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(96, 'proteins', 'Immune fixation', '6imm', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(97, 'proteins', 'Beta2 Microglobulin.i.S', '6b2', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(98, 'proteins', 'Immune globulin quant.', '6img', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(99, 'proteins', 'IgE', '6ige', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(100, 'proteins', 'Haptoglobin', '6hap', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(101, 'proteins', 'Transferrin', '6tra', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(102, 'proteins', 'Ferritin', '6fer', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(103, 'proteins', 'Coeruloplasmin', '6coe', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(104, 'proteins', 'Alpha 1 Antitrypsin', '6alp', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(105, 'proteins', 'AFP Grav.', '6afp', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(106, 'proteins', 'SSW:', '6ssw', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(107, 'proteins', 'Alpha 1 Microglobulin', '6mic', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(108, 'thyroid', 'T3', '7t3', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(109, 'thyroid', 'Thyroxin/T4', '7t4', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(110, 'thyroid', 'TSH basal', '7tshb', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(111, 'thyroid', 'TSH stim.', '7tshs', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(112, 'thyroid', 'TAB', '7tab', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(113, 'thyroid', 'MAB', '7mab', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(114, 'thyroid', 'TRAB', '7trab', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(115, 'thyroid', 'Thyreoglobulin', '7glob', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(116, 'thyroid', 'Thyroxinbind.Glob.', '7thx', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(117, 'thyroid', 'free T3', '7ft3', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(118, 'thyroid', 'free T4', '7ft4', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(119, 'hormones', 'ACTH', '8acth', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(120, 'hormones', 'Aldosteron', '8ald', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(121, 'hormones', 'Calcitonin', '8cal', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(122, 'hormones', 'Cortisol', '8cor', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(123, 'hormones', 'Cortisol day', '8dcor', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(124, 'hormones', 'FSH', '8fsh', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(125, 'hormones', 'Gastrin', '8gas', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(126, 'hormones', 'HCG', '8hcg', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(127, 'hormones', 'Insulin', '8ins', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(128, 'hormones', 'Catecholam.i.P.', '8cat', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(129, 'hormones', 'LH', '8lh', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(130, 'hormones', 'Ostriol', '8osd', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(131, 'hormones', 'SSW:', '8ssw', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(132, 'hormones', 'Parat hormone', '8par', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(133, 'hormones', 'Progesteron', '8prg', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(134, 'hormones', 'Prolactin I', '8pr1', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(135, 'hormones', 'Prolactin II', '8pr2', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(136, 'hormones', 'Renin', '8ren', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(137, 'hormones', 'Serotonin', '8ser', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(138, 'hormones', 'Somatomedin C', '8som', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(139, 'hormones', 'Testosteron', '8tes', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(140, 'hormones', 'C1', '8c1', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(141, 'tumor_marker', 'AFP', '9afp', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(142, 'tumor_marker', 'CA. 15 3', '9c153', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(143, 'tumor_marker', 'CA. 19 9', '9c199', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(144, 'tumor_marker', 'CA. 125', '9c125', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(145, 'tumor_marker', 'CEA', '9cea', 0, '', '', '', '', '', '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(146, 'tumor_marker', 'Cyfra. 21 2', '9c212', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(147, 'tumor_marker', 'HCG', '9hcg', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(148, 'tumor_marker', 'NSE', '9nse', 0, 'test', '', '', '', '', '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(149, 'tumor_marker', 'PSA', '9psa', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00');
INSERT INTO `care_test_param` (`nr`, `group_id`, `name`, `id`, `sort_nr`, `msr_unit`, `status`, `median`, `hi_bound`, `lo_bound`, `hi_critical`, `lo_critical`, `hi_toxic`, `lo_toxic`, `median_f`, `hi_bound_f`, `lo_bound_f`, `hi_critical_f`, `lo_critical_f`, `hi_toxic_f`, `lo_toxic_f`, `median_n`, `hi_bound_n`, `lo_bound_n`, `hi_critical_n`, `lo_critical_n`, `hi_toxic_n`, `lo_toxic_n`, `median_y`, `hi_bound_y`, `lo_bound_y`, `hi_critical_y`, `lo_critical_y`, `hi_toxic_y`, `lo_toxic_y`, `median_c`, `hi_bound_c`, `lo_bound_c`, `hi_critical_c`, `lo_critical_c`, `hi_toxic_c`, `lo_toxic_c`, `method`, `history`, `modify_id`, `modify_time`, `create_id`, `create_time`) VALUES
(150, 'tumor_marker', 'SCC', '9scc', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(151, 'tumor_marker', 'TPA', '9tpa', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(152, 'tissue_antibody', 'ANA', '10ana', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(153, 'tissue_antibody', 'AMA', 'ama', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(154, 'tissue_antibody', 'DNS AB', '10dnsab', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(155, 'tissue_antibody', 'ASMA', '10asm', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(156, 'tissue_antibody', 'ENA', '10ena', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(157, 'tissue_antibody', 'ANCA', '10anc', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(158, 'rheuma_factor', 'Anti Strepto Titer', '11ast', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(159, 'rheuma_factor', 'Lat. RF', '11lrf', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(160, 'rheuma_factor', 'Streptozym', '11stz', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(161, 'rheuma_factor', 'Waaler Rose', '11waa', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(162, 'hepatitis', 'Anti HAV', '12hav', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(163, 'hepatitis', 'Anti HAV IgM', '12hai', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(164, 'hepatitis', 'Hbs Antigen', '12hba', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(165, 'hepatitis', 'Anti HBs Titer', '12hbt', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(166, 'hepatitis', 'Anti HBe', '12hbe', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(167, 'hepatitis', 'Anti HBc', '12hbc', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(168, 'hepatitis', 'Anti HBc.IgM', '12hci', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(169, 'hepatitis', 'Anti HCV', '12hcv', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(170, 'hepatitis', 'Hep.D Delta A.', '12hda', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(171, 'hepatitis', 'Anti HEV', '12hev', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(172, 'biopsy', 'Protein i.biopsy', '13pro', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(173, 'biopsy', 'LDH i.biopsy', '13ldh', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(174, 'biopsy', 'Chol.i.biopsy', '13cho', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(175, 'biopsy', 'CEA i.biopsy', '13cea', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(176, 'biopsy', 'AFP i.biopsy', '13afp', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(177, 'biopsy', 'Uric acid.i.biopsy', '13ure', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(178, 'biopsy', 'Rheuma fact.i.biopsy', '13rhe', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(179, 'biopsy', 'D1', '13d1', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(180, 'biopsy', 'D2', '13d2', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(181, 'infection_serology', 'Antistaph.Titer', '14stap', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(182, 'infection_serology', 'Adenovirus AB', '14ade', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(183, 'infection_serology', 'Borrelia AB', '14bor', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(184, 'infection_serology', 'Borr.Immunoblot', '14bori', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(185, 'infection_serology', 'Brucellia AB', '14bru', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(186, 'infection_serology', 'Campylob. AB', '14cam', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(187, 'infection_serology', 'Candida AB', '14can', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(188, 'infection_serology', 'Cardiotr.Virus', '14car', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(189, 'infection_serology', 'Chlamydia AB', '14chl', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(190, 'infection_serology', 'C.psittaci AB', '14psi', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(191, 'infection_serology', 'Coxsack. AB', '14cox', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(192, 'infection_serology', 'Cox.burn. AB(Q fever)', '14qf', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(193, 'infection_serology', 'Cytomegaly AB', '14cyt', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(194, 'infection_serology', 'EBV AB', '14ebv', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(195, 'infection_serology', 'Echinococcus AB', '14ecc', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(196, 'infection_serology', 'Echo Virus AB', '14ecv', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(197, 'infection_serology', 'FSME AB', '14fsme', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(198, 'infection_serology', 'Herpes simp. I AB', '14hs1', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(199, 'infection_serology', 'Herpes simp. II AB', '14hs2', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(200, 'infection_serology', 'HIV1/HIV2 AB', '14hiv', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(201, 'infection_serology', 'Influenza A AB', '14ina', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(202, 'infection_serology', 'Influenza B AB', '14inb', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(203, 'infection_serology', 'LCM AB', '14lcm', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(204, 'infection_serology', 'Leg.pneum AB', '14leg', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(205, 'infection_serology', 'Leptospiria AB', '14lep', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(206, 'infection_serology', 'Listeria AB', '14lis', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(207, 'infection_serology', 'Masern AB', '14mas', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(208, 'infection_serology', 'Mononucleose', '14mon', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(209, 'infection_serology', 'Mumps AB', '14mum', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(210, 'infection_serology', 'Mycoplas.pneum AB', '14myc', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(211, 'infection_serology', 'Neutrop Virus AB', '14neu', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(212, 'infection_serology', 'Parainfluenza II AB', '14pi2', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(213, 'infection_serology', 'Parainfluenza III AB', '14pi3', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(214, 'infection_serology', 'Picorna Virus AB', '14pic', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(215, 'infection_serology', 'Rickettsia AB', '14vric', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(216, 'infection_serology', 'R?teln AB', '14rot', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(217, 'infection_serology', 'R?teln Immune status', '14roi', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(218, 'infection_serology', 'RS Virus AB', '14rsv', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(219, 'infection_serology', 'Shigella/Salm AB', '14shi', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(220, 'infection_serology', 'Toxoplasma AB', '14tox', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(221, 'infection_serology', 'TPHA', '14tpha', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(222, 'infection_serology', 'Varicella AB', '14vrc', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(223, 'infection_serology', 'Yersinia AB', '14yer', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(224, 'infection_serology', 'E1', '14e1', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(225, 'infection_serology', 'E2', '14e2', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(226, 'infection_serology', 'E3', '14e3', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(227, 'infection_serology', 'E4', '14e4', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(228, 'medicines', 'Amiodaron', '15ami', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(229, 'medicines', 'Barbiturate.i.S.', '15bar', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(230, 'medicines', 'Benzodiazep.i.S.', '15ben', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(231, 'medicines', 'Carbamazepin', '15car', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(232, 'medicines', 'Clonazepam', '15clo', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(233, 'medicines', 'Digitoxin', '15dig', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(234, 'medicines', 'Digoxin', '15dgo', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(235, 'medicines', 'Gentamycin', '15gen', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(236, 'medicines', 'Lithium', '15lit', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(237, 'medicines', 'Phenobarbital', '15phe', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(238, 'medicines', 'Phenytoin', '15pny', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(239, 'medicines', 'Primidon', '15pri', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(240, 'medicines', 'Salicylic acid', '15sal', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(241, 'medicines', 'Theophyllin', '15the', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(242, 'medicines', 'Tobramycin', '15tob', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(243, 'medicines', 'Valproin acid', '15val', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(244, 'medicines', 'Vancomycin', '15van', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(245, 'medicines', 'Amphetamine.i.u.', '15amp', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(246, 'medicines', 'Antidepressant.i.u.', '15ant', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(247, 'medicines', 'Barbiturate.i.u.', '15bau', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(248, 'medicines', 'Benzodiazep.i.u.', '15beu', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(249, 'medicines', 'Cannabinol.i.u.', '15can', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(250, 'medicines', 'Cocain.i.u', '15coc', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(251, 'medicines', 'Methadon.i.u.', '15met', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(252, 'medicines', 'Opiate.i.u.', '15opi', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(253, 'prenatal', 'Chlamyd.cult./SSW', '16chl', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(254, 'prenatal', 'SSW:', '16ssw', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(255, 'prenatal', 'Down Screening', '16dow', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(256, 'prenatal', 'Strep B quick test', '16stb', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(257, 'prenatal', 'TPHA', '16tpha', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(258, 'prenatal', 'HBs Ag', '16hbs', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(259, 'prenatal', 'HIV1/HIV2 AV', '16hiv', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(260, 'stool', 'Chymotrypsin', '17chy', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(261, 'stool', 'Occult blood 1', '17ob1', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(262, 'stool', 'Occult blood 2', '17ob2', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(263, 'stool', 'Occult blood 3', '17ob3', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(264, 'rare', 'Rare H.', '18rh', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(265, 'rare', 'Rare E.', '18re', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(266, 'rare', 'Rare S.', '18rs', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(267, 'rare', 'Urine rare', '18uri', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(268, 'rare', 'F1', '18f1', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(269, 'rare', 'F2', '18f2', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(270, 'rare', 'F3', '18f3', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(271, 'urine', 'Urine amylase', '19amy', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(272, 'urine', 'Urine sugar', '19sug', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(273, 'urine', 'Protein.i.u.', '19pro', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(274, 'urine', 'Albumin.i.u.', '19alb', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(275, 'urine', 'Osmol.i.u.', '19osm', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(276, 'urine', 'Pregnancy test.', '19pre', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(277, 'urine', 'Cytomeg.i.urine', '19cym', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(278, 'urine', 'Urine cytology', '19cyt', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(279, 'urine', 'Bence Jones', '19bj', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(280, 'urine', 'Urine elpho', '19elp', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(281, 'urine', 'Beta2 microglobulin.i.u.', '19bm2', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(282, 'total_urine', 'Addis Count', '20adc', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(283, 'total_urine', 'Sodium i.u.', '20na', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(284, 'total_urine', 'Potass. i.u.', '20k', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(285, 'total_urine', 'Calcium i.u.', '20ca', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(286, 'total_urine', 'Phospor i.u.', '20pho', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(287, 'total_urine', 'Uric acid i.u.', '20ura', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(288, 'total_urine', 'Creatinin i.u.', '20cre', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(289, 'total_urine', 'Porphyrine i.u.', '20por', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(290, 'total_urine', 'Cortisol i.u.', '20cor', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(291, 'total_urine', 'Hydroxyprolin i.u.', '20hyd', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(292, 'total_urine', 'Catecholamins i.u.', '20cat', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(293, 'total_urine', 'Pancreol.', '20pan', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(294, 'total_urine', 'Gamma Aminol?bulinsre.i.u.', '20gam', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(295, 'special_params', 'Blood alcohol', '21bal', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00');
INSERT INTO `care_test_param` (`nr`, `group_id`, `name`, `id`, `sort_nr`, `msr_unit`, `status`, `median`, `hi_bound`, `lo_bound`, `hi_critical`, `lo_critical`, `hi_toxic`, `lo_toxic`, `median_f`, `hi_bound_f`, `lo_bound_f`, `hi_critical_f`, `lo_critical_f`, `hi_toxic_f`, `lo_toxic_f`, `median_n`, `hi_bound_n`, `lo_bound_n`, `hi_critical_n`, `lo_critical_n`, `hi_toxic_n`, `lo_toxic_n`, `median_y`, `hi_bound_y`, `lo_bound_y`, `hi_critical_y`, `lo_critical_y`, `hi_toxic_y`, `lo_toxic_y`, `median_c`, `hi_bound_c`, `lo_bound_c`, `hi_critical_c`, `lo_critical_c`, `hi_toxic_c`, `lo_toxic_c`, `method`, `history`, `modify_id`, `modify_time`, `create_id`, `create_time`) VALUES
(296, 'special_params', 'CDT', '21cdt', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(297, 'special_params', 'Vitamin B12', '21vb12', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(298, 'special_params', 'Folic acid', '21fol', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(299, 'special_params', 'Insulin AB', '21inab', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(300, 'special_params', 'Intrinsic AB', '21iab', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(301, 'special_params', 'Stone analysis', '21sto', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(302, 'special_params', 'ACE', '21ace', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(303, 'special_params', 'G1', '21g1', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(304, 'special_params', 'G2', '21g2', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(305, 'special_params', 'G3', '21g3', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(306, 'special_params', 'G4', '21g4', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(307, 'special_params', 'G5', '21g5', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(308, 'special_params', 'G6', '21g6', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(309, 'special_params', 'G7', '21g7', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(310, 'special_params', 'G8', '21g8', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(311, 'special_params', 'G9', '21g9', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(312, 'special_params', 'G10', '21g10', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(315, '-1', 'Priority', 'priority', 5, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '2003-07-11 16:44:02'),
(316, '-1', 'Clinical chemistry', 'clinical_chem', 10, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '2003-07-11 16:45:49'),
(317, '-1', 'Liquor', 'liquor', 15, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(318, '-1', 'Coagulation', 'coagulation', 20, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(319, '-1', 'Hematology', 'hematology', 25, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(320, '-1', 'Blood sugar', 'blood_sugar', 30, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(321, '-1', 'Neonate', 'neonate', 35, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(322, '-1', 'Proteins', 'proteins', 40, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(323, '-1', 'Thyroid', 'thyroid', 45, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(324, '-1', 'Hormones', 'hormones', 50, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(325, '-1', 'Tumor marker', 'tumor_marker', 55, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(326, '-1', 'Tissue antibody', 'tissue_antibody', 60, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(327, '-1', 'Rheuma factor', 'rheuma_factor', 65, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(328, '-1', 'Hepatitis', 'hepatitis', 70, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(329, '-1', 'Biopsy', 'biopsy', 75, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(330, '-1', 'Infection serology', 'infection_serology', 80, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(331, '-1', 'Medicines', 'medicines', 85, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(332, '-1', 'Prenatal', 'prenatal', 90, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(333, '-1', 'Stool', 'stool', 95, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(334, '-1', 'Rare', 'rare', 100, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(335, '-1', 'Urine', 'urine', 105, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(336, '-1', 'Total urine', 'total_urine', 110, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00'),
(337, '-1', 'Special', 'special_params', 115, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2008-10-21 17:10:54', 'install script', '0000-00-00 00:00:00');

--
-- Dumping data for table care_type_anaesthesia
--

INSERT INTO care_type_anaesthesia VALUES (1, 'none', 'None', 'LDNone', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_anaesthesia VALUES (2, 'unknown', 'Unknown', 'LDUnknown', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_anaesthesia VALUES (3, 'general', 'General', 'LDGeneral', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_anaesthesia VALUES (4, 'spinal', 'Spinal', 'LDSpinal', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_anaesthesia VALUES (5, 'epidural', 'Epidural', 'LDEpidural', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_anaesthesia VALUES (6, 'pudendal', 'Pudendal', 'LDPudendal', '', '', '', 00000000000000, '', 00000000000000);

--
-- Dumping data for table care_type_application
--

INSERT INTO care_type_application VALUES (1, '5', 'ita', 'ITA', 'LDITA', 'Intratracheal anesthesia', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_application VALUES (2, '5', 'la', 'LA', 'LDLA', 'Locally applied anesthesia', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_application VALUES (3, '5', 'as', 'AS', 'LDAS', 'Analgesic sedation', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_application VALUES (4, '5', 'mask', 'Mask', 'LDMask', 'Gas anesthesia through breathing mask', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_application VALUES (5, '6', 'oral', 'Oral', 'LDOral', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_application VALUES (6, '6', 'iv', 'Intravenous', 'LDIntravenous', '', '', '', 00000000000000, 'preload', 00000000000000);
INSERT INTO care_type_application VALUES (7, '6', 'sc', 'Subcutaneous', 'LDSubcutaneous', '', '', '', 00000000000000, 'preload', 00000000000000);
INSERT INTO care_type_application VALUES (8, '6', 'im', 'Intramuscular', 'LDIntramuscular', '', '', '', 00000000000000, 'preload', 00000000000000);
INSERT INTO care_type_application VALUES (9, '6', 'sublingual', 'Sublingual', 'LDSublingual', 'Applied under the tounge', '', '', 00000000000000, 'preload', 00000000000000);
INSERT INTO care_type_application VALUES (10, '6', 'ia', 'Intraarterial', 'LDIntraArterial', '', '', '', 00000000000000, 'preload', 00000000000000);
INSERT INTO care_type_application VALUES (11, '6', 'pre_admit', 'Pre-admission', 'LDPreAdmission', '', '', '', 00000000000000, 'preload', 00000000000000);

--
-- Dumping data for table care_type_assignment
--

INSERT INTO care_type_assignment VALUES (1, 'ward', 'Ward', 'LDWard', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_assignment VALUES (2, 'dept', 'Department', 'LDDepartment', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_assignment VALUES (3, 'firm', 'Firm', 'LDFirm', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_assignment VALUES (4, 'clinic', 'Clinic', 'LDClinic', '', '', '', 00000000000000, '', 00000000000000);

--
-- Dumping data for table care_type_cause_opdelay
--

INSERT INTO care_type_cause_opdelay VALUES (1, 'patient', 'Patient was delayed', 'LDPatientDelayed', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_cause_opdelay VALUES (2, 'nurse', 'Nurses were delayed', 'LDNursesDelayed', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_cause_opdelay VALUES (3, 'surgeon', 'Surgeons were delayed', 'LDSurgeonsDelayed', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_cause_opdelay VALUES (4, 'cleaning', 'Cleaning delayed', 'LDCleaningDelayed', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_cause_opdelay VALUES (5, 'anesthesia', 'Anesthesiologist was delayed', 'LDAnesthesiologistDelayed', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_cause_opdelay VALUES (0, 'other', 'Other causes', 'LDOtherCauses', '', '', 00000000000000, '', 00000000000000);

--
-- Dumping data for table care_type_color
--

INSERT INTO care_type_color VALUES ('yellow', 'yellow', 'LDyellow', '', '', 00000000000000);
INSERT INTO care_type_color VALUES ('black', 'black', 'LDblack', '', '', 00000000000000);
INSERT INTO care_type_color VALUES ('blue_pale', 'pale blue', 'LDpaleblue', '', '', 00000000000000);
INSERT INTO care_type_color VALUES ('brown', 'brown', 'LDbrown', '', '', 00000000000000);
INSERT INTO care_type_color VALUES ('pink', 'pink', 'LDpink', '', '', 00000000000000);
INSERT INTO care_type_color VALUES ('yellow_pale', 'pale yellow', 'LDpaleyellow', '', '', 00000000000000);
INSERT INTO care_type_color VALUES ('red', 'red', 'LDred', '', '', 00000000000000);
INSERT INTO care_type_color VALUES ('green_pale', 'pale green', 'LDpalegreen', '', '', 00000000000000);
INSERT INTO care_type_color VALUES ('violet', 'violet', 'LDviolet', '', '', 00000000000000);
INSERT INTO care_type_color VALUES ('blue', 'blue', 'LDblue', '', '', 00000000000000);
INSERT INTO care_type_color VALUES ('biege', 'biege', 'LDbiege', '', '', 00000000000000);
INSERT INTO care_type_color VALUES ('orange', 'orange', 'LDorange', '', '', 00000000000000);
INSERT INTO care_type_color VALUES ('green', 'green', 'LDgreen', '', '', 00000000000000);
INSERT INTO care_type_color VALUES ('rose', 'rose', 'LDrose', '', '', 00000000000000);

--
-- Dumping data for table care_type_department
--

INSERT INTO care_type_department VALUES (1, 'medical', 'Medical', 'LDMedical', 'Medical, Nursing, Diagnostics, Labs, OR', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_department VALUES (2, 'support', 'Support (non-medical)', 'LDSupport', 'non-medical departments', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_department VALUES (3, 'news', 'News', 'LDNews', 'News group or category', '', '', 00000000000000, '', 00000000000000);

--
-- Dumping data for table care_type_discharge
--

INSERT INTO care_type_discharge VALUES (1, 'regular', 'Regular discharge', 'LDRegularRelease', '', '', 20030415010555, '', 20030413121226);
INSERT INTO care_type_discharge VALUES (2, 'own', 'Patient left hospital on his own will', 'LDSelfRelease', '', '', 20030415010606, '', 20030413121317);
INSERT INTO care_type_discharge VALUES (3, 'emergency', 'Emergency discharge', 'LDEmRelease', '', '', 20030415010617, '', 20030413121452);
INSERT INTO care_type_discharge VALUES (4, 'change_ward', 'Change of ward', 'LDChangeWard', '', '', 00000000000000, '', 20030413121526);
INSERT INTO care_type_discharge VALUES (6, 'change_bed', 'Change of bed', 'LDChangeBed', '', '', 20030415000942, '', 20030413121619);
INSERT INTO care_type_discharge VALUES (7, 'death', 'Death of patient', 'LDPatientDied', '', '', 20030415010642, '', 00000000000000);
INSERT INTO care_type_discharge VALUES (5, 'change_room', 'Change of room', 'LDChangeRoom', '', '', 20030415010659, '', 00000000000000);
INSERT INTO care_type_discharge VALUES (8, 'change_dept', 'Change of department', 'LDChangeDept', '', '', 00000000000000, '', 00000000000000);

--
-- Dumping data for table care_type_duty
--

INSERT INTO care_type_duty VALUES (1, 'regular', 'Regular duty', 'LDRegularDuty', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_duty VALUES (2, 'standby', 'Standby duty', 'LDStandbyDuty', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_duty VALUES (3, 'morning', 'Morning duty', 'LDMorningDuty', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_duty VALUES (4, 'afternoon', 'Afternoon duty', 'LDAfternoonDuty', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_duty VALUES (5, 'night', 'Night duty', 'LDNightDuty', '', '', '', 00000000000000, '', 00000000000000);

--
-- Dumping data for table care_type_encounter
--

INSERT INTO care_type_encounter VALUES (1, 'referral', 'Referral', 'LDEncounterReferral', 'Referral admission or visit', '0', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_encounter VALUES (2, 'emergency', 'Emergency', 'LDEmergency', 'Emergency admission or visit', '0', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_encounter VALUES (3, 'birth_delivery', 'Birth delivery', 'LDBirthDelivery', 'Admission or visit for birth delivery', '0', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_encounter VALUES (4, 'walk_in', 'Walk-in', 'LDWalkIn', 'Walk -in admission or visit (non-referred)', '0', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_encounter VALUES (5, 'accident', 'Accident', 'LDAccident', 'Emergency admission due to accident', '0', '', '', '', 00000000000000, '', 00000000000000);

--
-- Dumping data for table care_type_ethnic_orig
--

INSERT INTO care_type_ethnic_orig VALUES (1, '1', 'asian', 'LDAsian', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_ethnic_orig VALUES (2, '1', 'black', 'LDBlack', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_ethnic_orig VALUES (3, '1', 'caucasian', 'LDCaucasian', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_ethnic_orig VALUES (4, '1', 'white', 'LDWhite', '', '', 00000000000000, '', 00000000000000);

--
-- Dumping data for table care_type_feeding
--

INSERT INTO care_type_feeding VALUES (1, '2', 'breast', 'Breast', 'LDBreast', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_feeding VALUES (2, '2', 'formula', 'Formula', 'LDFormula', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_feeding VALUES (3, '2', 'both', 'Both', 'LDBoth', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_feeding VALUES (4, '2', 'parenteral', 'Parenteral', 'LDParenteral', '', '', '', 20030727221351, '', 00000000000000);
INSERT INTO care_type_feeding VALUES (5, '2', 'never_fed', 'Never fed', 'LDNeverFed', '', '', '', 00000000000000, '', 00000000000000);

--
-- Dumping data for table care_type_insurance
--

INSERT INTO care_type_insurance VALUES (1, 'medical_main', 'Medical insurance', 'LDMedInsurance', 'Main (default) medical insurance', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_insurance VALUES (2, 'medical_extra', 'Extra medical insurance', 'LDExtraMedInsurance', 'Extra medical insurance (evt. pays extra services)', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_insurance VALUES (3, 'dental', 'Dental insurance', 'LDDentalInsurance', 'Separate dental plan in case not included in medical plan or simply additional private plan', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_insurance VALUES (4, 'disability', 'Disability plan', 'LDDisabilityPlan', 'Disability insurance plan - general , both long term & short term', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_insurance VALUES (5, 'disability_short', 'Disability plan (short term)', 'LDDisabilityPlanShort', 'Short term disability plan', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_insurance VALUES (6, 'disability_long', 'Disability plan (long term)', 'LDDisabilityPlanLong', 'Long term disability plan', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_insurance VALUES (7, 'retirement_income', 'Retirement  income plan (general)', 'LDRetirementIncomePlan', 'Retirement income plan - either private or income/employer supported', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_insurance VALUES (8, 'edu_reimbursement', 'Educational Reimbursement Plan', 'LDEduReimbursementPlan', 'Reimbursement plan for education, either private or employer supported', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_insurance VALUES (9, 'retirement_medical', 'Retirement medical plan', 'LDRetirementMedPlan', 'Medical plan in retirement  - might include other care services', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_insurance VALUES (10, 'liability', 'Liability Insurance Plan', 'LDLiabilityPlan', 'General liability insurance - either private or employer supported', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_insurance VALUES (11, 'malpractice', 'Malpractice Insurance Plan', 'LDMalpracticeInsurancePlan', 'Insurance plan against possible malpractice', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_insurance VALUES (12, 'unemployment', 'Unemployment Insurance Plan', 'LDUnemploymentPlan', 'Unemployment insurance , in case compulsory unemployment funds are guaranteed by the state, this plan is usually privately paid by the insured', '', '', '', 00000000000000, '', 00000000000000);

--
-- Dumping data for table care_type_localization
--

INSERT INTO care_type_localization VALUES ('1', 'left', 'Left', 'LDLeft', 'L', 'LDLeft_s', '', '0', '', '', '', 20030525150414, '', 20030525150414);
INSERT INTO care_type_localization VALUES ('2', 'right', 'Right', 'LDRight', 'R', 'LDRight_s', '', '0', '', '', '', 20030525150522, '', 20030525150500);
INSERT INTO care_type_localization VALUES ('3', 'both_side', 'Both sides', 'LDBothSides', 'B', 'LDBothSides_s', '', '0', '', '', '', 20030525150618, '', 20030525150618);

--
-- Dumping data for table care_type_location
--

INSERT INTO care_type_location VALUES (1, 'dept', 'Department', 'LDDepartment', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_location VALUES (2, 'ward', 'Ward', 'LDWard', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_location VALUES (3, 'firm', 'Firm', 'LDFirm', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_location VALUES (4, 'room', 'Room', 'LDRoom', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_location VALUES (5, 'bed', 'Bed', 'LDBed', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_location VALUES (6, 'clinic', 'Clinic', 'LDClinic', '', '', '', 00000000000000, '', 00000000000000);

--
-- Dumping data for table care_type_measurement
--

INSERT INTO care_type_measurement VALUES (1, 'bp_systolic', 'Systolic', 'LDSystolic', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_measurement VALUES (2, 'bp_diastolic', 'Diastolic', 'LDDiastolic', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_measurement VALUES (3, 'temp', 'Temperature', 'LDTemperature', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_measurement VALUES (4, 'fluid_intake', 'Fluid intake', 'LDFluidIntake', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_measurement VALUES (5, 'fluid_output', 'Fluid output', 'LDFluidOutput', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_measurement VALUES (6, 'weight', 'Weight', 'LDWeight', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_measurement VALUES (7, 'height', 'Height', 'LDHeight', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_measurement VALUES (8, 'bp_composite', 'Sys/Dias', 'LDSysDias', '', '', 20030419143920, '', 20030419143920);
INSERT INTO care_type_measurement VALUES (9, 'head_circumference', 'Head circumference', 'LDHeadCircumference', '', '', 00000000000000, '', 00000000000000);

--
-- Dumping data for table care_type_notes
--

INSERT INTO care_type_notes VALUES (1, 'histo_physical', 'Admission History and Physical', 'LDAdmitHistoPhysical', 5, '', '', 20030517182939, '', 00000000000000);
INSERT INTO care_type_notes VALUES (2, 'daily_doctor', 'Doctor\'s daily notes', 'LDDoctorDailyNotes', 55, '', '', 20030517183835, '', 00000000000000);
INSERT INTO care_type_notes VALUES (3, 'discharge', 'Discharge summary', 'LDDischargeSummary', 50, '', '', 20030517183707, '', 00000000000000);
INSERT INTO care_type_notes VALUES (4, 'consult', 'Consultation notes', 'LDConsultNotes', 25, '', '', 20030517183151, '', 00000000000000);
INSERT INTO care_type_notes VALUES (5, 'op', 'Operation notes', 'LDOpNotes', 100, '', '', 20030517184314, '', 00000000000000);
INSERT INTO care_type_notes VALUES (6, 'daily_ward', 'Daily ward\'s notes', 'LDDailyNurseNotes', 30, '', '', 20030517183212, '', 00000000000000);
INSERT INTO care_type_notes VALUES (7, 'daily_chart_notes', 'Chart notes', 'LDChartNotes', 20, '', '', 20030517183141, '', 00000000000000);
INSERT INTO care_type_notes VALUES (8, 'chart_notes_etc', 'PT,ATG,etc. daily notes', 'LDPTATGetc', 115, '', '', 20030517184356, '', 00000000000000);
INSERT INTO care_type_notes VALUES (9, 'daily_iv_notes', 'IV daily notes', 'LDIVDailyNotes', 75, '', '', 20030517184024, '', 00000000000000);
INSERT INTO care_type_notes VALUES (10, 'daily_anticoag', 'Anticoagulant daily notes', 'LDAnticoagDailyNotes', 15, '', '', 20030517183117, '', 00000000000000);
INSERT INTO care_type_notes VALUES (11, 'lot_charge_nr', 'Material LOT, Charge Nr.', 'LDMaterialLOTChargeNr', 80, '', '', 20030517184039, '', 00000000000000);
INSERT INTO care_type_notes VALUES (12, 'text_diagnosis', 'Diagnosis text', 'LDDiagnosis', 40, '', '', 20030517183530, '', 00000000000000);
INSERT INTO care_type_notes VALUES (13, 'text_therapy', 'Therapy text', 'LDTherapy', 120, '', '', 20030517184408, '', 00000000000000);
INSERT INTO care_type_notes VALUES (14, 'chart_extra', 'Extra notes on therapy & diagnosis', 'LDExtraNotes', 65, '', '', 20030517183912, '', 00000000000000);
INSERT INTO care_type_notes VALUES (15, 'nursing_report', 'Nursing care report', 'LDNursingReport', 85, '', '', 20030517184141, '', 00000000000000);
INSERT INTO care_type_notes VALUES (16, 'nursing_problem', 'Nursing problem report', 'LDNursingProblemReport', 95, '', '', 20030517184208, '', 00000000000000);
INSERT INTO care_type_notes VALUES (17, 'nursing_effectivity', 'Nursing effectivity report', 'LDNursingEffectivityReport', 90, '', '', 20030517184156, '', 00000000000000);
INSERT INTO care_type_notes VALUES (18, 'nursing_inquiry', 'Inquiry to doctor', 'LDInquiryToDoctor', 70, '', '', 20030517183951, '', 00000000000000);
INSERT INTO care_type_notes VALUES (19, 'doctor_directive', 'Doctor\'s directive', 'LDDoctorDirective', 60, '', '', 20030517183859, '', 00000000000000);
INSERT INTO care_type_notes VALUES (20, 'problem', 'Problem', 'LDProblem', 110, '', '', 20030517184345, '', 00000000000000);
INSERT INTO care_type_notes VALUES (21, 'development', 'Development', 'LDDevelopment', 35, '', '', 20030517183228, '', 00000000000000);
INSERT INTO care_type_notes VALUES (22, 'allergy', 'Allergy', 'LDAllergy', 10, '', '', 20030517184439, '', 00000000000000);
INSERT INTO care_type_notes VALUES (23, 'daily_diet', 'Diet plan', 'LDDietPlan', 45, '', '', 20030517183545, '', 00000000000000);
INSERT INTO care_type_notes VALUES (99, 'other', 'Other', 'LDOther', 105, '', '', 20030517184331, '', 00000000000000);

--
-- Dumping data for table care_type_outcome
--

INSERT INTO care_type_outcome VALUES (1, '2', 'alive', 'Alive', 'LDAlive', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_outcome VALUES (2, '2', 'stillborn', 'Stillborn', 'LDStillborn', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_outcome VALUES (3, '2', 'early_neonatal_death', 'Early neonatal death', 'LDEarlyNeonatalDeath', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_outcome VALUES (4, '2', 'late_neonatal_death', 'Late neonatal death', 'LDLateNeonatalDeath', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_outcome VALUES (5, '2', 'death_uncertain_timing', 'Death uncertain timing', 'LDDeathUncertainTiming', '', '', '', 00000000000000, '', 00000000000000);

--
-- Dumping data for table care_type_perineum
--

INSERT INTO care_type_perineum VALUES (1, 'intact', 'Intact', 'LDIntact', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_perineum VALUES (2, '1_degree', '1st degree tear', 'LDFirstDegreeTear', '', '', '', 20030727212219, '', 00000000000000);
INSERT INTO care_type_perineum VALUES (3, '2_degree', '2nd degree tear', 'LDSecondDegreeTear', '', '', '', 20030727212231, '', 00000000000000);
INSERT INTO care_type_perineum VALUES (4, '3_degree', '3rd degree tear', 'LDThirdDegreeTear', '', '', '', 20030727212242, '', 00000000000000);
INSERT INTO care_type_perineum VALUES (5, 'episiotomy', 'Episiotomy', 'LDEpisiotomy', '', '', '', 00000000000000, '', 00000000000000);

--
-- Dumping data for table care_type_prescription
--

INSERT INTO care_type_prescription VALUES (1, 'anticoag', 'Anticoagulant', 'LDAnticoagulant', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_prescription VALUES (2, 'hemolytic', 'Hemolytic', 'LDHemolytic', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_prescription VALUES (3, 'diuretic', 'Diuretic', 'LDDiuretic', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_prescription VALUES (4, 'antibiotic', 'Antibiotic', 'LDAntibiotic', '', '', 00000000000000, '', 00000000000000);

--
-- Dumping data for table care_type_room
--

INSERT INTO care_type_room VALUES (1, 'ward', 'Ward room', 'LDWard', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_room VALUES (2, 'op', 'Operating room', 'LDOperatingRoom', '', '', '', 00000000000000, '', 00000000000000);

--
-- Dumping data for table care_type_test
--

INSERT INTO care_type_test VALUES (1, 'chemlabor', 'Chemical-Serology Lab', 'LDChemSerologyLab', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_test VALUES (2, 'patho', 'Pathological Lab', 'LDPathoLab', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_test VALUES (3, 'baclabor', 'Bacteriological Lab', 'LDBacteriologicalLab', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_test VALUES (4, 'radio', 'Radiological Lab', 'LDRadiologicalLab', 'Lab for X-ray, Mammography, Computer Tomography, NMR', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_test VALUES (5, 'blood', 'Blood test & product', 'LDBloodTestProduct', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_test VALUES (6, 'generic', 'Generic test program', 'LDGenericTestProgram', '', '', '', 00000000000000, '', 00000000000000);

--
-- Dumping data for table care_type_time
--

INSERT INTO care_type_time VALUES (1, 'patient_entry_exit', 'Patient entry/exit', 'LDPatientEntryExit', 'Times when patient entered and left the op room', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_time VALUES (2, 'op_start_end', 'OP start/end', 'LDOPStartEnd', 'Times when op started (1st incision) and ended (last suture)', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_time VALUES (3, 'delay', 'Delay time', 'LDDelayTime', 'Times when the op was delayed due to any reason', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_time VALUES (4, 'plaster_cast', 'Plaster cast', 'LDPlasterCast', 'Times when the plaster cast was made', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_time VALUES (5, 'reposition', 'Reposition', 'LDReposition', 'Times when a dislocated joint(s) was repositioned (non invasive op)', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_time VALUES (6, 'coro', 'Coronary catheter', 'LDCoronaryCatheter', 'Times when a coronary catherer op was done (minimal invasive op)', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_time VALUES (7, 'bandage', 'Bandage', 'LDBandage', 'Times when the bandage was made', '', '', 00000000000000, '', 00000000000000);

--
-- Dumping data for table care_type_unit_measurement
--

INSERT INTO care_type_unit_measurement VALUES (1, 'volume', 'Volume', 'LDVolume', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_unit_measurement VALUES (2, 'weight', 'Weight', 'LDWeight', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_unit_measurement VALUES (3, 'length', 'Length', 'LDLength', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_unit_measurement VALUES (4, 'pressure', 'Pressure', 'LDPressure', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_type_unit_measurement VALUES (5, 'temperature', 'Temperature', 'LDTemperature', '', '', '', 20030419144724, '', 20030419144724);

--
-- Dumping data for table care_unit_measurement
--

INSERT INTO care_unit_measurement VALUES (1, 1, 'ml', 'Milliliter', 'LDMilliliter', 'metric',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (2, 2, 'mg', 'Milligram', 'LDMilligram', 'metric',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (3, 3, 'mm', 'Millimeter', 'LDMillimeter', 'metric',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (4, 1, 'ltr', 'liter', 'LDLiter', 'metric',  NULL, '', '', 20030727131658, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (5, 2, 'gm', 'gram', 'LDGram', 'metric',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (6, 2, 'kg', 'kilogram', 'LDKilogram', 'metric',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (7, 3, 'cm', 'centimeter', 'LDCentimeter', 'metric',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (8, 3, 'm', 'meter', 'LDMeter', 'metric',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (9, 3, 'km', 'kilometer', 'LDKilometer', 'metric',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (10, 3, 'in', 'inch', 'LDInch', 'english',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (11, 3, 'ft', 'foot', 'LDFoot', 'english',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (12, 3, 'yd', 'yard', 'LDYard', 'english',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (14, 4, 'mmHg', 'mmHg', 'LDmmHg', 'metric',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (15, 5, 'celsius', 'Celsius', 'LDCelsius', 'metric',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (16, 1, 'dl', 'deciliter', 'LDDeciliter', 'metric',  NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (17, 1, 'cl', 'centiliter', 'LDCentiliter', 'metric', 0, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (18, 1, '�l', 'microliter', 'LDMicroliter', 'metric', 0, '', '', 00000000000000, '', 00000000000000);


--
-- Constrains
--
--
-- Constraints for table `care_encounter`
--
ALTER TABLE `care_encounter`
  ADD CONSTRAINT `fk_care_person_encounter` FOREIGN KEY (`pid`) REFERENCES `care_person` (`pid`);
--
-- Constraints for table `care_encounter_prescription_sub`
--
ALTER TABLE `care_encounter_prescription_sub`
  ADD CONSTRAINT `care_encounter_prescription_sub_fk` FOREIGN KEY (`prescription_nr`) REFERENCES `care_encounter_prescription` (`nr`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Dumping data for table care_version
--


INSERT INTO `care_version` (`name`, `type`, `number`, `build`, `date`, `time`, `releaser`) VALUES ('CARE2X', 'beta', '3.0', '7110', '2011-08-18', '00:00:00', 'Gjergj Sheldija/Robert Meggle');
