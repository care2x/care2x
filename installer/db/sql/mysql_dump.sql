-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 09, 2010  at 07:09 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.5

ALTER DATABASE DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `care2x`
--

-- --------------------------------------------------------

--
-- Table structure for table `care_accesslog`
--

CREATE TABLE IF NOT EXISTS `care_accesslog` (
  `id` int(11) NOT NULL auto_increment,
  `datetime` datetime NOT NULL,
  `ip` varchar(255) NOT NULL,
  `lognote` text NOT NULL,
  `userid` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `thisfile` text NOT NULL,
  `fileforward` text NOT NULL,
  `login_success` int(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB ;


-- --------------------------------------------------------

--
-- Table structure for table `care_address_citytown`
--

CREATE TABLE IF NOT EXISTS `care_address_citytown` (
  `nr` mediumint(8) unsigned NOT NULL auto_increment,
  `unece_modifier` char(2)  default NULL,
  `unece_locode` varchar(15)  default NULL,
  `name` varchar(100) NOT NULL default '',
  `zip_code` varchar(25)  default NULL,
  `iso_country_id` char(3) NOT NULL default '',
  `unece_locode_type` tinyint(3) unsigned default NULL,
  `unece_coordinates` varchar(25)  default NULL,
  `info_url` varchar(255)  default NULL,
  `use_frequency` bigint(20) unsigned NOT NULL default '0',
  `status` varchar(25)  default NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL default '',
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  KEY `name` (`name`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_address_citytown`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_encounter_appointment`
--

CREATE TABLE IF NOT EXISTS `care_encounter_appointment` (
  `nr` bigint(20) unsigned NOT NULL auto_increment,
  `pid` int(11) NOT NULL default '0',
  `date` date NOT NULL default '0000-00-00',
  `time` time NOT NULL default '00:00:00',
  `to_dept_id` varchar(25) NOT NULL,
  `to_dept_nr` smallint(5) unsigned NOT NULL default '0',
  `to_personell_nr` int(11) NOT NULL default '0',
  `to_personell_name` varchar(60)  default NULL,
  `purpose` text NOT NULL,
  `urgency` tinyint(2) unsigned NOT NULL default '0',
  `remind` tinyint(1) unsigned NOT NULL default '0',
  `remind_email` tinyint(1) unsigned NOT NULL default '0',
  `remind_mail` tinyint(1) unsigned NOT NULL default '0',
  `remind_phone` tinyint(1) unsigned NOT NULL default '0',
  `appt_status` varchar(35) NOT NULL default 'pending',
  `cancel_by` varchar(255) NOT NULL,
  `cancel_date` date default NULL,
  `cancel_reason` varchar(255)  default NULL,
  `encounter_class_nr` int(1) NOT NULL default '0',
  `encounter_nr` int(11) NOT NULL default '0',
  `status` varchar(25) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_encounter_appointment`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_billing_archive`
--

CREATE TABLE IF NOT EXISTS `care_billing_archive` (
  `bill_no` bigint(20) NOT NULL default '0',
  `encounter_nr` int(10) NOT NULL default '0',
  `patient_name` tinytext NOT NULL,
  `vorname` varchar(35) NOT NULL default '0',
  `bill_date_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `bill_amt` double(16,4) NOT NULL default '0.0000',
  `payment_date_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `payment_mode` text NOT NULL,
  `cheque_no` varchar(10) NOT NULL default '0',
  `creditcard_no` varchar(10) NOT NULL default '0',
  `paid_by` varchar(15) NOT NULL default '0',
  PRIMARY KEY  (`bill_no`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_billing_archive`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_billing_bill`
--

CREATE TABLE IF NOT EXISTS `care_billing_bill` (
  `bill_bill_no` bigint(20) NOT NULL default '0',
  `bill_encounter_nr` int(10) unsigned NOT NULL default '0',
  `bill_date_time` date default NULL,
  `bill_amount` float(10,2) default NULL,
  `bill_outstanding` float(10,2) default NULL,
  PRIMARY KEY  (`bill_bill_no`),
  KEY `index_bill_patnum` (`bill_encounter_nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_billing_bill`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_billing_bill_item`
--

CREATE TABLE IF NOT EXISTS `care_billing_bill_item` (
  `bill_item_id` int(11) NOT NULL auto_increment,
  `bill_item_encounter_nr` int(10) unsigned NOT NULL default '0',
  `bill_item_code` varchar(5)  default NULL,
  `bill_item_unit_cost` float(10,2) default '0.00',
  `bill_item_units` tinyint(4) default NULL,
  `bill_item_amount` float(10,2) default NULL,
  `bill_item_date` datetime default NULL,
  `bill_item_status` enum('0','1')  default '0',
  `bill_item_bill_no` int(11) NOT NULL default '0',
  PRIMARY KEY  (`bill_item_id`),
  KEY `index_bill_item_patnum` (`bill_item_encounter_nr`),
  KEY `index_bill_item_bill_no` (`bill_item_bill_no`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_billing_bill_item`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_billing_final`
--

CREATE TABLE IF NOT EXISTS `care_billing_final` (
  `final_id` tinyint(3) NOT NULL auto_increment,
  `final_encounter_nr` int(10) unsigned NOT NULL default '0',
  `final_bill_no` int(11) default NULL,
  `final_date` date default NULL,
  `final_total_bill_amount` float(10,2) default NULL,
  `final_discount` tinyint(4) default NULL,
  `final_total_receipt_amount` float(10,2) default NULL,
  `final_amount_due` float(10,2) default NULL,
  `final_amount_recieved` float(10,2) default NULL,
  PRIMARY KEY  (`final_id`),
  KEY `index_final_patnum` (`final_encounter_nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_billing_final`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_billing_item`
--

CREATE TABLE IF NOT EXISTS `care_billing_item` (
  `item_code` varchar(5) NOT NULL,
  `item_description` varchar(100)  default NULL,
  `item_unit_cost` float(10,2) default '0.00',
  `item_type` tinytext ,
  `item_discount_max_allowed` tinyint(4) unsigned default '0',
  PRIMARY KEY  (`item_code`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_billing_item`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_billing_payment`
--

CREATE TABLE IF NOT EXISTS `care_billing_payment` (
  `payment_id` tinyint(5) NOT NULL auto_increment,
  `payment_encounter_nr` int(10) unsigned NOT NULL default '0',
  `payment_receipt_no` int(11) NOT NULL default '0',
  `payment_date` datetime default '0000-00-00 00:00:00',
  `payment_cash_amount` float(10,2) default '0.00',
  `payment_cheque_no` int(11) default '0',
  `payment_cheque_amount` float(10,2) default '0.00',
  `payment_creditcard_no` int(25) default '0',
  `payment_creditcard_amount` float(10,2) default '0.00',
  `payment_amount_total` float(10,2) default '0.00',
  PRIMARY KEY  (`payment_id`),
  KEY `index_payment_patnum` (`payment_encounter_nr`),
  KEY `index_payment_receipt_no` (`payment_receipt_no`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_billing_payment`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_cache`
--

CREATE TABLE IF NOT EXISTS `care_cache` (
  `id` varchar(125) NOT NULL,
  `ctext` text ,
  `cbinary` blob,
  `tstamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_cache`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_cafe_menu`
--

CREATE TABLE IF NOT EXISTS `care_cafe_menu` (
  `item` int(11) NOT NULL auto_increment,
  `lang` varchar(10) NOT NULL default 'en',
  `cdate` date NOT NULL default '0000-00-00',
  `menu` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  UNIQUE KEY `item_2` (`item`),
  KEY `item` (`item`,`lang`),
  KEY `cdate` (`cdate`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_cafe_menu`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_cafe_prices`
--

CREATE TABLE IF NOT EXISTS `care_cafe_prices` (
  `item` int(11) NOT NULL auto_increment,
  `lang` varchar(10) NOT NULL default 'en',
  `productgroup` tinytext NOT NULL,
  `article` tinytext NOT NULL,
  `description` tinytext NOT NULL,
  `price` varchar(10) NOT NULL,
  `unit` tinytext NOT NULL,
  `pic_filename` tinytext NOT NULL,
  `modify_id` varchar(25) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(25) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  KEY `item` (`item`),
  KEY `lang` (`lang`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_cafe_prices`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_category_diagnosis`
--

CREATE TABLE IF NOT EXISTS `care_category_diagnosis` (
  `nr` tinyint(3) unsigned NOT NULL default '0',
  `category` varchar(35) NOT NULL,
  `name` varchar(35) NOT NULL,
  `LD_var` varchar(35) NOT NULL,
  `short_code` char(1) NOT NULL,
  `LD_var_short_code` varchar(25) NOT NULL,
  `description` varchar(255) NOT NULL,
  `hide_from` varchar(255) NOT NULL default '0',
  `status` varchar(25) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_category_diagnosis`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_category_disease`
--

CREATE TABLE IF NOT EXISTS `care_category_disease` (
  `nr` tinyint(3) unsigned NOT NULL auto_increment,
  `group_nr` tinyint(3) unsigned NOT NULL default '0',
  `category` varchar(35) NOT NULL,
  `name` varchar(35) NOT NULL,
  `LD_var` varchar(35) NOT NULL,
  `status` varchar(25) NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_category_disease`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_category_procedure`
--

CREATE TABLE IF NOT EXISTS `care_category_procedure` (
  `nr` tinyint(3) unsigned NOT NULL default '0',
  `category` varchar(35) NOT NULL,
  `name` varchar(35) NOT NULL,
  `LD_var` varchar(35) NOT NULL,
  `short_code` char(1) NOT NULL,
  `LD_var_short_code` varchar(25) NOT NULL,
  `description` varchar(255) NOT NULL,
  `hide_from` varchar(255) NOT NULL default '0',
  `status` varchar(25) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_category_procedure`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_classif_neonatal`
--

CREATE TABLE IF NOT EXISTS `care_classif_neonatal` (
  `nr` smallint(2) unsigned NOT NULL auto_increment,
  `id` varchar(35) NOT NULL,
  `name` varchar(35) NOT NULL,
  `LD_var` varchar(35) NOT NULL,
  `description` varchar(255)  default NULL,
  `status` varchar(25) NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_classif_neonatal`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_class_encounter`
--

CREATE TABLE IF NOT EXISTS `care_class_encounter` (
  `class_nr` smallint(6) unsigned NOT NULL default '0',
  `class_id` varchar(35) NOT NULL,
  `name` varchar(35) NOT NULL,
  `LD_var` varchar(25) NOT NULL,
  `description` varchar(255) NOT NULL,
  `hide_from` tinyint(4) NOT NULL default '0',
  `status` varchar(25) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`class_nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_class_encounter`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_class_ethnic_orig`
--

CREATE TABLE IF NOT EXISTS `care_class_ethnic_orig` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `name` varchar(35) NOT NULL,
  `LD_var` varchar(35) NOT NULL,
  `status` varchar(25) NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_class_ethnic_orig`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_class_financial`
--

CREATE TABLE IF NOT EXISTS `care_class_financial` (
  `class_nr` smallint(5) unsigned NOT NULL auto_increment,
  `class_id` varchar(15) NOT NULL default '0',
  `type` varchar(25) NOT NULL default '0',
  `code` varchar(5) NOT NULL,
  `name` varchar(35) NOT NULL,
  `LD_var` varchar(25) NOT NULL,
  `description` varchar(255) NOT NULL,
  `policy` text NOT NULL,
  `status` varchar(25) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`class_nr`),
  KEY `class_2` (`class_id`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_class_financial`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_class_insurance`
--

CREATE TABLE IF NOT EXISTS `care_class_insurance` (
  `class_nr` smallint(5) unsigned NOT NULL auto_increment,
  `class_id` varchar(35) NOT NULL,
  `name` varchar(35) NOT NULL,
  `LD_var` varchar(25) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(25) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`class_nr`)
) ENGINE=InnoDB ;

-- --------------------------------------------------------

--
-- Table structure for table `care_class_therapy`
--

CREATE TABLE IF NOT EXISTS `care_class_therapy` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `group_nr` tinyint(3) unsigned NOT NULL default '0',
  `class` varchar(35) NOT NULL,
  `name` varchar(35) NOT NULL,
  `LD_var` varchar(25) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(25) NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_class_therapy`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_complication`
--

CREATE TABLE IF NOT EXISTS `care_complication` (
  `nr` int(10) unsigned NOT NULL auto_increment,
  `group_nr` int(11) unsigned NOT NULL default '0',
  `name` varchar(35) NOT NULL,
  `LD_var` varchar(35) NOT NULL,
  `code` varchar(25)  default NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(25) NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_complication`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_config_global`
--

CREATE TABLE IF NOT EXISTS `care_config_global` (
  `type` varchar(60) NOT NULL,
  `value` varchar(255)  default NULL,
  `notes` varchar(255)  default NULL,
  `status` varchar(25) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`type`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_config_global`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_config_user`
--

CREATE TABLE IF NOT EXISTS `care_config_user` (
  `user_id` varchar(100) NOT NULL,
  `serial_config_data` text NOT NULL,
  `notes` varchar(255)  default NULL,
  `status` varchar(25) NOT NULL,
  `history` text ,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`user_id`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_config_user`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_currency`
--

CREATE TABLE IF NOT EXISTS `care_currency` (
  `item_no` smallint(5) unsigned NOT NULL auto_increment,
  `short_name` varchar(5) NOT NULL,
  `long_name` varchar(20) NOT NULL,
  `info` varchar(50) NOT NULL,
  `status` varchar(5) NOT NULL,
  `modify_id` varchar(20) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(20) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  KEY `item_no` (`item_no`),
  KEY `short_name` (`short_name`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_currency`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_department`
--

CREATE TABLE IF NOT EXISTS `care_department` (
  `nr` mediumint(8) unsigned NOT NULL auto_increment,
  `id` varchar(60) NOT NULL,
  `type` varchar(25) NOT NULL,
  `name_formal` varchar(60) NOT NULL,
  `name_short` varchar(35) NOT NULL,
  `name_alternate` varchar(225)  default NULL,
  `LD_var` varchar(35) NOT NULL,
  `description` text NOT NULL,
  `admit_inpatient` tinyint(1) NOT NULL default '0',
  `admit_outpatient` tinyint(1) NOT NULL default '0',
  `has_oncall_doc` tinyint(1) NOT NULL default '1',
  `has_oncall_nurse` tinyint(1) NOT NULL default '1',
  `does_surgery` tinyint(1) NOT NULL default '0',
  `this_institution` tinyint(1) NOT NULL default '1',
  `is_sub_dept` tinyint(1) NOT NULL default '0',
  `parent_dept_nr` tinyint(3) unsigned NOT NULL default '0',
  `work_hours` varchar(100)  default NULL,
  `consult_hours` varchar(100)  default NULL,
  `is_inactive` tinyint(1) NOT NULL default '0',
  `sort_order` tinyint(3) unsigned NOT NULL default '0',
  `address` text ,
  `sig_line` varchar(60)  default NULL,
  `sig_stamp` text ,
  `logo_mime_type` varchar(5)  default NULL,
  `status` varchar(25) NOT NULL,
  `history` text ,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  `is_pharmacy` tinyint(4) NOT NULL COMMENT 'is a pharmacy, or a normal dept ?',
  `pharma_dept_nr` tinyint(3) unsigned default '0' COMMENT 'the pharmacy to which the department is connected',
  PRIMARY KEY  (`nr`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_department`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_diagnosis_localcode`
--

CREATE TABLE IF NOT EXISTS `care_diagnosis_localcode` (
  `localcode` varchar(12) NOT NULL,
  `description` text NOT NULL,
  `class_sub` varchar(5) NOT NULL,
  `type` varchar(10) NOT NULL,
  `inclusive` text NOT NULL,
  `exclusive` text NOT NULL,
  `notes` text NOT NULL,
  `std_code` char(1) NOT NULL,
  `sub_level` tinyint(4) NOT NULL default '0',
  `remarks` text NOT NULL,
  `extra_codes` text NOT NULL,
  `extra_subclass` text NOT NULL,
  `search_keys` varchar(255) NOT NULL,
  `use_frequency` int(11) NOT NULL default '0',
  `status` varchar(25) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`localcode`),
  KEY `diagnosis_code` (`localcode`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_diagnosis_localcode`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_drg_intern`
--

CREATE TABLE IF NOT EXISTS `care_drg_intern` (
  `nr` int(11) NOT NULL auto_increment,
  `code` varchar(12) NOT NULL,
  `description` text NOT NULL,
  `synonyms` text NOT NULL,
  `notes` text ,
  `std_code` char(1) NOT NULL,
  `sub_level` tinyint(1) NOT NULL default '0',
  `parent_code` varchar(12) NOT NULL,
  `status` varchar(25) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(25) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(25) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  KEY `nr` (`nr`),
  KEY `code` (`code`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_drg_intern`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_drg_quicklist`
--

CREATE TABLE IF NOT EXISTS `care_drg_quicklist` (
  `nr` int(11) NOT NULL auto_increment,
  `code` varchar(25) NOT NULL,
  `code_parent` varchar(25) NOT NULL,
  `dept_nr` smallint(5) unsigned NOT NULL default '0',
  `qlist_type` varchar(25) NOT NULL default '0',
  `rank` int(11) NOT NULL default '0',
  `status` varchar(15) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(25) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(25) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_drg_quicklist`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_drg_related_codes`
--

CREATE TABLE IF NOT EXISTS `care_drg_related_codes` (
  `nr` int(11) NOT NULL auto_increment,
  `group_nr` int(11) unsigned NOT NULL default '0',
  `code` varchar(15) NOT NULL,
  `code_parent` varchar(15) NOT NULL,
  `code_type` varchar(15) NOT NULL,
  `rank` int(11) NOT NULL default '0',
  `status` varchar(15) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(25) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(25) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_drg_related_codes`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_dutyplan_oncall`
--

CREATE TABLE IF NOT EXISTS `care_dutyplan_oncall` (
  `nr` bigint(20) unsigned NOT NULL auto_increment,
  `dept_nr` int(10) unsigned NOT NULL default '0',
  `role_nr` tinyint(3) unsigned NOT NULL default '0',
  `year` year(4) NOT NULL default '0000',
  `month` char(2) NOT NULL,
  `duty_1_txt` text NOT NULL,
  `duty_2_txt` text NOT NULL,
  `duty_1_pnr` text NOT NULL,
  `duty_2_pnr` text NOT NULL,
  `status` varchar(25) NOT NULL,
  `history` text ,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  KEY `dept_nr` (`dept_nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_dutyplan_oncall`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_effective_day`
--

CREATE TABLE IF NOT EXISTS `care_effective_day` (
  `eff_day_nr` tinyint(4) NOT NULL auto_increment,
  `name` varchar(25) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(25) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`eff_day_nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_effective_day`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_encounter`
--

CREATE TABLE IF NOT EXISTS `care_encounter` (
  `encounter_nr` bigint(11) unsigned NOT NULL auto_increment,
  `pid` int(11) unsigned NOT NULL default '0',
  `encounter_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `encounter_class_nr` smallint(5) unsigned NOT NULL default '0',
  `encounter_type` varchar(35) NOT NULL,
  `encounter_status` varchar(35) NOT NULL,
  `referrer_diagnosis` varchar(255) NOT NULL,
  `referrer_recom_therapy` varchar(255)  default NULL,
  `referrer_dr` varchar(60) NOT NULL,
  `referrer_dept` varchar(255) NOT NULL,
  `referrer_institution` varchar(255) NOT NULL,
  `referrer_notes` text NOT NULL,
  `regional_code` varchar(60)  default NULL,
  `triage` varchar(20) NOT NULL default 'white',
  `admit_type` int(10) NOT NULL default '0',
  `financial_class_nr` tinyint(3) unsigned NOT NULL default '0',
  `insurance_nr` varchar(25)  default '0',
  `insurance_firm_id` varchar(25) NOT NULL default '0',
  `insurance_class_nr` tinyint(3) unsigned NOT NULL default '0',
  `insurance_2_nr` varchar(25)  default '0',
  `insurance_2_firm_id` varchar(25) NOT NULL default '0',
  `guarantor_pid` int(11) NOT NULL default '0',
  `contact_pid` int(11) NOT NULL default '0',
  `contact_relation` varchar(35) NOT NULL,
  `current_ward_nr` smallint(3) unsigned NOT NULL default '0',
  `current_room_nr` smallint(5) unsigned NOT NULL default '0',
  `in_ward` tinyint(1) NOT NULL default '0',
  `current_dept_nr` smallint(3) unsigned NOT NULL default '0',
  `in_dept` tinyint(1) NOT NULL default '0',
  `current_firm_nr` smallint(5) unsigned NOT NULL default '0',
  `current_att_dr_nr` int(10) NOT NULL default '0',
  `consulting_dr` varchar(60) NOT NULL,
  `extra_service` varchar(25) NOT NULL,
  `is_discharged` tinyint(1) unsigned NOT NULL default '0',
  `discharge_date` date default NULL,
  `discharge_time` time default NULL,
  `followup_date` date NOT NULL default '0000-00-00',
  `followup_responsibility` varchar(255)  default NULL,
  `post_encounter_notes` text NOT NULL,
  `status` varchar(25) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`encounter_nr`),
  KEY `pid` (`pid`),
  KEY `encounter_date` (`encounter_date`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_encounter`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_encounter_custom_ddc`
--

CREATE TABLE IF NOT EXISTS `care_encounter_custom_ddc` (
  `nr` int(11) NOT NULL auto_increment,
  `encounter_nr` int(11) NOT NULL,
  `indatetime` datetime NOT NULL,
  `urinesugar` varchar(35) NOT NULL,
  `acetone` varchar(35) NOT NULL,
  `bloodsugar` decimal(10,2) NOT NULL,
  `tablets` varchar(35) NOT NULL,
  `insulin` decimal(10,2) NOT NULL,
  `createid` varchar(64) NOT NULL,
  `createtime` timestamp NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_encounter_custom_ddc`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_encounter_custom_inout`
--

CREATE TABLE IF NOT EXISTS `care_encounter_custom_inout` (
  `nr` int(11) NOT NULL auto_increment,
  `encounter_nr` int(11) NOT NULL,
  `indatetime` datetime NOT NULL,
  `pint` decimal(10,2) NOT NULL,
  `solution` varchar(32) NOT NULL,
  `solutionamount` decimal(10,2) NOT NULL,
  `initial` varchar(6) NOT NULL,
  `oralfluid` varchar(32) NOT NULL,
  `oralfluidamount` decimal(10,2) NOT NULL,
  `urinetime` time NOT NULL,
  `urineamount` decimal(10,2) NOT NULL,
  `rta` decimal(10,2) NOT NULL,
  `drain` decimal(10,2) NOT NULL,
  `createid` varchar(64) NOT NULL,
  `createtime` timestamp NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_encounter_custom_inout`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_encounter_custom_noc`
--

CREATE TABLE IF NOT EXISTS `care_encounter_custom_noc` (
  `nr` int(11) NOT NULL auto_increment,
  `encounter_nr` int(11) NOT NULL,
  `indatetime` datetime NOT NULL,
  `verbal` tinyint(1) NOT NULL,
  `moton` tinyint(1) NOT NULL,
  `eyes` tinyint(1) NOT NULL,
  `createid` varchar(64) NOT NULL,
  `createtime` timestamp NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_encounter_custom_noc`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_encounter_custom_tc`
--

CREATE TABLE IF NOT EXISTS `care_encounter_custom_tc` (
  `nr` int(11) NOT NULL auto_increment,
  `encounter_nr` int(11) NOT NULL,
  `createid` varchar(64) NOT NULL,
  `createtime` timestamp NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `indatetime` datetime NOT NULL,
  `time` time NOT NULL,
  `position` varchar(32) NOT NULL,
  PRIMARY KEY  (`nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_encounter_custom_tc`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_encounter_diagnosis`
--

CREATE TABLE IF NOT EXISTS `care_encounter_diagnosis` (
  `diagnosis_nr` int(11) NOT NULL auto_increment,
  `encounter_nr` int(11) NOT NULL default '0',
  `op_nr` int(10) unsigned NOT NULL default '0',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `code` varchar(25) NOT NULL,
  `code_parent` varchar(25) NOT NULL,
  `group_nr` mediumint(8) unsigned NOT NULL default '0',
  `code_version` tinyint(4) NOT NULL default '0',
  `localcode` varchar(35) NOT NULL,
  `category_nr` tinyint(3) unsigned NOT NULL default '0',
  `type` varchar(35) NOT NULL,
  `localization` varchar(35) NOT NULL,
  `diagnosing_clinician` varchar(60) NOT NULL,
  `diagnosing_dept_nr` smallint(5) unsigned NOT NULL default '0',
  `status` varchar(25) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`diagnosis_nr`),
  KEY `encounter_nr` (`encounter_nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_encounter_diagnosis`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_encounter_diagnostics_report`
--

CREATE TABLE IF NOT EXISTS `care_encounter_diagnostics_report` (
  `item_nr` int(11) NOT NULL auto_increment,
  `report_nr` int(11) NOT NULL default '0',
  `reporting_dept_nr` smallint(5) unsigned NOT NULL default '0',
  `reporting_dept` varchar(100) NOT NULL,
  `report_date` date NOT NULL default '0000-00-00',
  `report_time` time NOT NULL default '00:00:00',
  `encounter_nr` int(10) NOT NULL default '0',
  `script_call` varchar(255) NOT NULL,
  `status` varchar(25) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`item_nr`,`report_nr`),
  KEY `report_nr` (`report_nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_encounter_diagnostics_report`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_encounter_drg_intern`
--

CREATE TABLE IF NOT EXISTS `care_encounter_drg_intern` (
  `nr` int(11) NOT NULL auto_increment,
  `encounter_nr` int(11) NOT NULL default '0',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `group_nr` mediumint(8) unsigned NOT NULL default '0',
  `clinician` varchar(60) NOT NULL,
  `dept_nr` smallint(5) unsigned NOT NULL default '0',
  `status` varchar(25) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  KEY `encounter_nr` (`encounter_nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_encounter_drg_intern`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_encounter_event_signaller`
--

CREATE TABLE IF NOT EXISTS `care_encounter_event_signaller` (
  `encounter_nr` int(10) unsigned NOT NULL default '0',
  `yellow` tinyint(1) NOT NULL default '0',
  `black` tinyint(1) NOT NULL default '0',
  `blue_pale` tinyint(1) NOT NULL default '0',
  `brown` tinyint(1) NOT NULL default '0',
  `pink` tinyint(1) NOT NULL default '0',
  `yellow_pale` tinyint(1) NOT NULL default '0',
  `red` tinyint(1) NOT NULL default '0',
  `green_pale` tinyint(1) NOT NULL default '0',
  `violet` tinyint(1) NOT NULL default '0',
  `blue` tinyint(1) NOT NULL default '0',
  `biege` tinyint(1) NOT NULL default '0',
  `orange` tinyint(1) NOT NULL default '0',
  `green_1` tinyint(1) NOT NULL default '0',
  `green_2` tinyint(1) NOT NULL default '0',
  `green_3` tinyint(1) NOT NULL default '0',
  `green_4` tinyint(1) NOT NULL default '0',
  `green_5` tinyint(1) NOT NULL default '0',
  `green_6` tinyint(1) NOT NULL default '0',
  `green_7` tinyint(1) NOT NULL default '0',
  `rose_1` tinyint(1) NOT NULL default '0',
  `rose_2` tinyint(1) NOT NULL default '0',
  `rose_3` tinyint(1) NOT NULL default '0',
  `rose_4` tinyint(1) NOT NULL default '0',
  `rose_5` tinyint(1) NOT NULL default '0',
  `rose_6` tinyint(1) NOT NULL default '0',
  `rose_7` tinyint(1) NOT NULL default '0',
  `rose_8` tinyint(1) NOT NULL default '0',
  `rose_9` tinyint(1) NOT NULL default '0',
  `rose_10` tinyint(1) NOT NULL default '0',
  `rose_11` tinyint(1) NOT NULL default '0',
  `rose_12` tinyint(1) NOT NULL default '0',
  `rose_13` tinyint(1) NOT NULL default '0',
  `rose_14` tinyint(1) NOT NULL default '0',
  `rose_15` tinyint(1) NOT NULL default '0',
  `rose_16` tinyint(1) NOT NULL default '0',
  `rose_17` tinyint(1) NOT NULL default '0',
  `rose_18` tinyint(1) NOT NULL default '0',
  `rose_19` tinyint(1) NOT NULL default '0',
  `rose_20` tinyint(1) NOT NULL default '0',
  `rose_21` tinyint(1) NOT NULL default '0',
  `rose_22` tinyint(1) NOT NULL default '0',
  `rose_23` tinyint(1) NOT NULL default '0',
  `rose_24` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`encounter_nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_encounter_event_signaller`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_encounter_financial_class`
--

CREATE TABLE IF NOT EXISTS `care_encounter_financial_class` (
  `nr` bigint(20) unsigned NOT NULL auto_increment,
  `encounter_nr` int(11) NOT NULL default '0',
  `class_nr` smallint(3) unsigned NOT NULL default '0',
  `date_start` date default NULL,
  `date_end` date default NULL,
  `date_create` datetime NOT NULL default '0000-00-00 00:00:00',
  `status` varchar(25) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_encounter_financial_class`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_encounter_image`
--

CREATE TABLE IF NOT EXISTS `care_encounter_image` (
  `nr` bigint(20) NOT NULL auto_increment,
  `encounter_nr` int(11) NOT NULL default '0',
  `shot_date` date NOT NULL default '0000-00-00',
  `shot_nr` smallint(6) NOT NULL default '0',
  `mime_type` varchar(10) NOT NULL,
  `upload_date` date NOT NULL default '0000-00-00',
  `notes` text NOT NULL,
  `graphic_script` text NOT NULL,
  `status` varchar(25) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  KEY `encounter_nr` (`encounter_nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_encounter_image`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_encounter_immunization`
--

CREATE TABLE IF NOT EXISTS `care_encounter_immunization` (
  `nr` int(10) unsigned NOT NULL auto_increment,
  `encounter_nr` int(11) NOT NULL default '0',
  `date` date NOT NULL default '0000-00-00',
  `type` varchar(60) NOT NULL,
  `medicine` varchar(60) NOT NULL,
  `dosage` varchar(60)  default NULL,
  `application_type_nr` smallint(5) unsigned NOT NULL default '0',
  `application_by` varchar(60)  default NULL,
  `titer` varchar(15)  default NULL,
  `refresh_date` date default NULL,
  `notes` text ,
  `status` varchar(25) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_encounter_immunization`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_encounter_location`
--

CREATE TABLE IF NOT EXISTS `care_encounter_location` (
  `nr` int(11) NOT NULL auto_increment,
  `encounter_nr` int(11) unsigned NOT NULL default '0',
  `type_nr` smallint(5) unsigned NOT NULL default '0',
  `location_nr` smallint(5) unsigned NOT NULL default '0',
  `group_nr` smallint(5) unsigned NOT NULL default '0',
  `date_from` date NOT NULL default '0000-00-00',
  `date_to` date NOT NULL default '0000-00-00',
  `time_from` time default '00:00:00',
  `time_to` time default NULL,
  `discharge_type_nr` tinyint(3) unsigned NOT NULL default '0',
  `status` varchar(25) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`,`location_nr`),
  KEY `type` (`type_nr`),
  KEY `location_id` (`location_nr`),
  KEY `encounter_nr` (`encounter_nr`),
  KEY `location_nr` (`location_nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_encounter_location`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_encounter_measurement`
--

CREATE TABLE IF NOT EXISTS `care_encounter_measurement` (
  `nr` int(11) unsigned NOT NULL auto_increment,
  `msr_date` date NOT NULL default '0000-00-00',
  `msr_time` float(4,2) NOT NULL default '0.00',
  `encounter_nr` int(11) unsigned NOT NULL default '0',
  `msr_type_nr` tinyint(3) unsigned NOT NULL default '0',
  `value` varchar(255)  default NULL,
  `unit_nr` smallint(5) unsigned default NULL,
  `unit_type_nr` tinyint(2) unsigned NOT NULL default '0',
  `notes` varchar(255)  default NULL,
  `measured_by` varchar(35) NOT NULL,
  `status` varchar(25) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  KEY `type` (`msr_type_nr`),
  KEY `encounter_nr` (`encounter_nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_encounter_measurement`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_encounter_notes`
--

CREATE TABLE IF NOT EXISTS `care_encounter_notes` (
  `nr` int(10) unsigned NOT NULL auto_increment,
  `encounter_nr` int(10) unsigned NOT NULL default '0',
  `type_nr` smallint(5) unsigned NOT NULL default '0',
  `notes` text NOT NULL,
  `short_notes` varchar(25)  default NULL,
  `aux_notes` varchar(255)  default NULL,
  `ref_notes_nr` int(10) unsigned NOT NULL default '0',
  `personell_nr` int(10) unsigned NOT NULL default '0',
  `personell_name` varchar(60) NOT NULL,
  `send_to_pid` int(11) NOT NULL default '0',
  `send_to_name` varchar(60)  default NULL,
  `date` date default NULL,
  `time` time default NULL,
  `location_type` varchar(35)  default NULL,
  `location_type_nr` tinyint(3) NOT NULL default '0',
  `location_nr` mediumint(8) unsigned NOT NULL default '0',
  `location_id` varchar(60)  default NULL,
  `ack_short_id` varchar(10) NOT NULL,
  `date_ack` datetime default NULL,
  `date_checked` datetime default NULL,
  `date_printed` datetime default NULL,
  `send_by_mail` tinyint(1) default NULL,
  `send_by_email` tinyint(1) default NULL,
  `send_by_fax` tinyint(1) default NULL,
  `status` varchar(25) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  KEY `encounter_nr` (`encounter_nr`),
  KEY `type_nr` (`type_nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_encounter_notes`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_encounter_obstetric`
--

CREATE TABLE IF NOT EXISTS `care_encounter_obstetric` (
  `encounter_nr` int(11) unsigned NOT NULL auto_increment,
  `pregnancy_nr` int(11) unsigned NOT NULL default '0',
  `hospital_adm_nr` int(11) unsigned NOT NULL default '0',
  `patient_class` varchar(60) NOT NULL,
  `is_discharged_not_in_labour` tinyint(1) default NULL,
  `is_re_admission` tinyint(1) default NULL,
  `referral_status` varchar(60)  default NULL,
  `referral_reason` text ,
  `status` varchar(25) NOT NULL,
  `history` text ,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`encounter_nr`),
  KEY `encounter_nr` (`pregnancy_nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_encounter_obstetric`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_encounter_op`
--

CREATE TABLE IF NOT EXISTS `care_encounter_op` (
  `nr` int(11) NOT NULL auto_increment,
  `year` varchar(4) NOT NULL default '0',
  `dept_nr` smallint(5) unsigned NOT NULL default '0',
  `op_room` varchar(10) NOT NULL default '0',
  `op_nr` mediumint(9) NOT NULL default '0',
  `op_date` date NOT NULL default '0000-00-00',
  `op_src_date` varchar(8) NOT NULL,
  `encounter_nr` int(10) unsigned NOT NULL default '0',
  `diagnosis` text NOT NULL,
  `operator` text NOT NULL,
  `assistant` text NOT NULL,
  `scrub_nurse` text NOT NULL,
  `rotating_nurse` text NOT NULL,
  `anesthesia` varchar(30) NOT NULL,
  `an_doctor` text NOT NULL,
  `op_therapy` text NOT NULL,
  `result_info` text NOT NULL,
  `entry_time` varchar(5) NOT NULL,
  `cut_time` varchar(5) NOT NULL,
  `close_time` varchar(5) NOT NULL,
  `exit_time` varchar(5) NOT NULL,
  `entry_out` text NOT NULL,
  `cut_close` text NOT NULL,
  `wait_time` text NOT NULL,
  `bandage_time` text NOT NULL,
  `repos_time` text NOT NULL,
  `encoding` longtext NOT NULL,
  `doc_date` varchar(10) NOT NULL,
  `doc_time` varchar(5) NOT NULL,
  `duty_type` varchar(15) NOT NULL,
  `material_codedlist` text NOT NULL,
  `container_codedlist` text NOT NULL,
  `icd_code` text NOT NULL,
  `ops_code` text NOT NULL,
  `ops_intern_code` text NOT NULL,
  `status` varchar(25) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  KEY `dept` (`dept_nr`),
  KEY `op_room` (`op_room`),
  KEY `op_date` (`op_date`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_encounter_op`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_encounter_prescription`
--

CREATE TABLE IF NOT EXISTS `care_encounter_prescription` (
  `nr` int(11) NOT NULL auto_increment,
  `encounter_nr` int(10) unsigned NOT NULL default '0',
  `prescribe_date` date default NULL,
  `notes` text ,
  `status` varchar(25) NOT NULL,
  `prescriber` varchar(60) NOT NULL,
  `dept_nr` int(11) NOT NULL default '0' COMMENT 'the dept from which the prescription is being made',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  KEY `encounter_nr` (`encounter_nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_encounter_prescription`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_encounter_prescription_notes`
--

CREATE TABLE IF NOT EXISTS `care_encounter_prescription_notes` (
  `nr` bigint(20) unsigned NOT NULL auto_increment,
  `date` date NOT NULL default '0000-00-00',
  `prescription_nr` int(10) unsigned NOT NULL default '0',
  `notes` varchar(35)  default NULL,
  `short_notes` varchar(25)  default NULL,
  `status` varchar(25) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_encounter_prescription_notes`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_encounter_prescription_sub`
--

CREATE TABLE IF NOT EXISTS `care_encounter_prescription_sub` (
  `nr` int(11) NOT NULL auto_increment,
  `prescription_nr` int(11) NOT NULL default '0',
  `prescription_type_nr` smallint(5) NOT NULL default '0',
  `bestellnum` varchar(20) NOT NULL default '0',
  `article` varchar(100) NOT NULL,
  `drug_class` varchar(60) NOT NULL,
  `dosage` varchar(255) NOT NULL,
  `admin_time` varchar(50) NOT NULL default '00',
  `quantity` varchar(10) NOT NULL default '0',
  `application_type_nr` smallint(5) NOT NULL default '0',
  `sub_speed` double(5,3) default NULL,
  `notes_sub` text ,
  `color_marker` varchar(10) NOT NULL,
  `is_stopped` tinyint(1) NOT NULL default '0',
  `stop_date` date default NULL,
  `status` varchar(25) NOT NULL,
  `companion` varchar(50) NOT NULL default '-1',
  `price` decimal(10,2) NOT NULL default '0.00',
  PRIMARY KEY  (`nr`),
  KEY `prescription_nr` (`prescription_nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_encounter_prescription_sub`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_encounter_procedure`
--

CREATE TABLE IF NOT EXISTS `care_encounter_procedure` (
  `procedure_nr` int(11) NOT NULL auto_increment,
  `encounter_nr` int(11) NOT NULL default '0',
  `op_nr` int(11) NOT NULL default '0',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `code` varchar(25) NOT NULL,
  `code_parent` varchar(25) NOT NULL,
  `group_nr` mediumint(8) unsigned NOT NULL default '0',
  `code_version` tinyint(4) NOT NULL default '0',
  `localcode` varchar(35) NOT NULL,
  `category_nr` tinyint(3) unsigned NOT NULL default '0',
  `localization` varchar(35) NOT NULL,
  `responsible_clinician` varchar(60) NOT NULL,
  `responsible_dept_nr` smallint(5) unsigned NOT NULL default '0',
  `status` varchar(25) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`procedure_nr`),
  KEY `encounter_nr` (`encounter_nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_encounter_procedure`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_encounter_sickconfirm`
--

CREATE TABLE IF NOT EXISTS `care_encounter_sickconfirm` (
  `nr` int(11) NOT NULL auto_increment,
  `encounter_nr` int(11) NOT NULL default '0',
  `date_confirm` date NOT NULL default '0000-00-00',
  `date_start` date NOT NULL default '0000-00-00',
  `date_end` date NOT NULL default '0000-00-00',
  `date_create` date NOT NULL default '0000-00-00',
  `diagnosis` text NOT NULL,
  `dept_nr` smallint(6) NOT NULL default '0',
  `status` varchar(25) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  KEY `encounter_nr` (`encounter_nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_encounter_sickconfirm`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_group`
--

CREATE TABLE IF NOT EXISTS `care_group` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `id` varchar(35) NOT NULL,
  `name` varchar(35) NOT NULL,
  `LD_var` varchar(35) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(25) NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=InnoDB ;

-- --------------------------------------------------------

--
-- Table structure for table `care_icd10_it`
--

CREATE TABLE IF NOT EXISTS `care_icd10_it` (
  `diagnosis_code` varchar(12) NOT NULL,
  `description` text NOT NULL,
  `class_sub` varchar(5) NOT NULL,
  `type` varchar(10) NOT NULL,
  `inclusive` text NOT NULL,
  `exclusive` text NOT NULL,
  `notes` text NOT NULL,
  `std_code` char(1) NOT NULL,
  `sub_level` tinyint(4) NOT NULL default '0',
  `remarks` text NOT NULL,
  `extra_codes` text NOT NULL,
  `extra_subclass` text NOT NULL,
  PRIMARY KEY  (`diagnosis_code`),
  KEY `diagnosis_code` (`diagnosis_code`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

--
-- Table structure for table `care_icd10_en`
--

CREATE TABLE IF NOT EXISTS `care_icd10_en` (
  `diagnosis_code` varchar(12) NOT NULL,
  `description` text NOT NULL,
  `class_sub` varchar(5) NOT NULL,
  `type` varchar(10) NOT NULL,
  `inclusive` text NOT NULL,
  `exclusive` text NOT NULL,
  `notes` text NOT NULL,
  `std_code` char(1) NOT NULL,
  `sub_level` tinyint(4) NOT NULL default '0',
  `remarks` text NOT NULL,
  `extra_codes` text NOT NULL,
  `extra_subclass` text NOT NULL,
  PRIMARY KEY  (`diagnosis_code`),
  KEY `diagnosis_code` (`diagnosis_code`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

--
-- Table structure for table `care_icd10_bg`
--

CREATE TABLE IF NOT EXISTS `care_icd10_bg` (
  `diagnosis_code` varchar(12) NOT NULL,
  `description` text NOT NULL,
  `class_sub` varchar(5) NOT NULL,
  `type` varchar(10) NOT NULL,
  `inclusive` text NOT NULL,
  `exclusive` text NOT NULL,
  `notes` text NOT NULL,
  `std_code` char(1) NOT NULL,
  `sub_level` tinyint(4) NOT NULL default '0',
  `remarks` text NOT NULL,
  `extra_codes` text NOT NULL,
  `extra_subclass` text NOT NULL,
  PRIMARY KEY  (`diagnosis_code`),
  KEY `diagnosis_code` (`diagnosis_code`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

--
-- Table structure for table `care_icd10_bs`
--

CREATE TABLE IF NOT EXISTS `care_icd10_bs` (
  `diagnosis_code` varchar(12) NOT NULL,
  `description` text NOT NULL,
  `class_sub` varchar(5) NOT NULL,
  `type` varchar(10) NOT NULL,
  `inclusive` text NOT NULL,
  `exclusive` text NOT NULL,
  `notes` text NOT NULL,
  `std_code` char(1) NOT NULL,
  `sub_level` tinyint(4) NOT NULL default '0',
  `remarks` text NOT NULL,
  `extra_codes` text NOT NULL,
  `extra_subclass` text NOT NULL,
  PRIMARY KEY  (`diagnosis_code`),
  KEY `diagnosis_code` (`diagnosis_code`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

--
-- Table structure for table `care_icd10_de`
--

CREATE TABLE IF NOT EXISTS `care_icd10_de` (
  `diagnosis_code` varchar(12) NOT NULL,
  `description` text NOT NULL,
  `class_sub` varchar(5) NOT NULL,
  `type` varchar(10) NOT NULL,
  `inclusive` text NOT NULL,
  `exclusive` text NOT NULL,
  `notes` text NOT NULL,
  `std_code` char(1) NOT NULL,
  `sub_level` tinyint(4) NOT NULL default '0',
  `remarks` text NOT NULL,
  `extra_codes` text NOT NULL,
  `extra_subclass` text NOT NULL,
  PRIMARY KEY  (`diagnosis_code`),
  KEY `diagnosis_code` (`diagnosis_code`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

--
-- Table structure for table `care_icd10_es`
--

CREATE TABLE IF NOT EXISTS `care_icd10_es` (
  `diagnosis_code` varchar(12) NOT NULL,
  `description` text NOT NULL,
  `class_sub` varchar(5) NOT NULL,
  `type` varchar(10) NOT NULL,
  `inclusive` text NOT NULL,
  `exclusive` text NOT NULL,
  `notes` text NOT NULL,
  `std_code` char(1) NOT NULL,
  `sub_level` tinyint(4) NOT NULL default '0',
  `remarks` text NOT NULL,
  `extra_codes` text NOT NULL,
  `extra_subclass` text NOT NULL,
  PRIMARY KEY  (`diagnosis_code`),
  KEY `diagnosis_code` (`diagnosis_code`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

--
-- Table structure for table `care_icd10_pt_br`
--

CREATE TABLE IF NOT EXISTS `care_icd10_pt_br` (
  `diagnosis_code` varchar(12) NOT NULL,
  `description` text NOT NULL,
  `class_sub` varchar(5) NOT NULL,
  `type` varchar(10) NOT NULL,
  `inclusive` text NOT NULL,
  `exclusive` text NOT NULL,
  `notes` text NOT NULL,
  `std_code` char(1) NOT NULL,
  `sub_level` tinyint(4) NOT NULL default '0',
  `remarks` text NOT NULL,
  `extra_codes` text NOT NULL,
  `extra_subclass` text NOT NULL,
  PRIMARY KEY  (`diagnosis_code`),
  KEY `diagnosis_code` (`diagnosis_code`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

--
-- Table structure for table `care_icd10_tr`
--

CREATE TABLE IF NOT EXISTS `care_icd10_tr` (
  `diagnosis_code` varchar(12) NOT NULL,
  `description` text NOT NULL,
  `class_sub` varchar(5) NOT NULL,
  `type` varchar(10) NOT NULL,
  `inclusive` text NOT NULL,
  `exclusive` text NOT NULL,
  `notes` text NOT NULL,
  `std_code` char(1) NOT NULL,
  `sub_level` tinyint(4) NOT NULL default '0',
  `remarks` text NOT NULL,
  `extra_codes` text NOT NULL,
  `extra_subclass` text NOT NULL,
  PRIMARY KEY  (`diagnosis_code`),
  KEY `diagnosis_code` (`diagnosis_code`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

--
-- Table structure for table `care_img_diagnostic`
--

CREATE TABLE IF NOT EXISTS `care_img_diagnostic` (
  `nr` bigint(20) NOT NULL auto_increment,
  `pid` int(11) NOT NULL default '0',
  `encounter_nr` int(11) NOT NULL default '0',
  `doc_ref_ids` varchar(255)  default NULL,
  `img_type` varchar(10) NOT NULL,
  `max_nr` tinyint(2) default '0',
  `upload_date` date NOT NULL default '0000-00-00',
  `cancel_date` date NOT NULL default '0000-00-00',
  `cancel_by` varchar(35)  default NULL,
  `notes` text ,
  `status` varchar(25) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  KEY `encounter_nr` (`pid`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_img_diagnostic`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_insurance_firm`
--

CREATE TABLE IF NOT EXISTS `care_insurance_firm` (
  `firm_id` varchar(40) NOT NULL,
  `name` varchar(60) NOT NULL,
  `iso_country_id` char(3) NOT NULL,
  `sub_area` varchar(60) NOT NULL,
  `type_nr` smallint(5) unsigned NOT NULL default '0',
  `addr` varchar(255)  default NULL,
  `addr_mail` varchar(200)  default NULL,
  `addr_billing` varchar(200)  default NULL,
  `addr_email` varchar(60)  default NULL,
  `phone_main` varchar(35)  default NULL,
  `phone_aux` varchar(35)  default NULL,
  `fax_main` varchar(35)  default NULL,
  `fax_aux` varchar(35)  default NULL,
  `contact_person` varchar(60)  default NULL,
  `contact_phone` varchar(35)  default NULL,
  `contact_fax` varchar(35)  default NULL,
  `contact_email` varchar(60)  default NULL,
  `use_frequency` bigint(20) unsigned NOT NULL default '0',
  `status` varchar(25) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`firm_id`),
  KEY `name` (`name`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_insurance_firm`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_mail_private`
--

CREATE TABLE IF NOT EXISTS `care_mail_private` (
  `recipient` varchar(60) NOT NULL,
  `sender` varchar(60) NOT NULL,
  `sender_ip` varchar(60) NOT NULL,
  `cc` varchar(255) NOT NULL,
  `bcc` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `sign` varchar(255) NOT NULL,
  `ask4ack` tinyint(4) NOT NULL default '0',
  `reply2` varchar(255) NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `attach_type` varchar(30) NOT NULL,
  `read_flag` tinyint(4) NOT NULL default '0',
  `mailgroup` varchar(60) NOT NULL,
  `maildir` varchar(60) NOT NULL,
  `exec_level` tinyint(4) NOT NULL default '0',
  `exclude_addr` text NOT NULL,
  `send_dt` datetime NOT NULL default '0000-00-00 00:00:00',
  `send_stamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `uid` varchar(255) NOT NULL,
  KEY `recipient` (`recipient`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_mail_private`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_mail_private_users`
--

CREATE TABLE IF NOT EXISTS `care_mail_private_users` (
  `user_name` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `alias` varchar(60) NOT NULL,
  `pw` varchar(255) NOT NULL,
  `inbox` longtext NOT NULL,
  `sent` longtext NOT NULL,
  `drafts` longtext NOT NULL,
  `trash` longtext NOT NULL,
  `lastcheck` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `lock_flag` tinyint(4) NOT NULL default '0',
  `addr_book` text NOT NULL,
  `addr_quick` tinytext NOT NULL,
  `secret_q` tinytext NOT NULL,
  `secret_q_ans` tinytext NOT NULL,
  `public` tinyint(4) NOT NULL default '0',
  `sig` tinytext NOT NULL,
  `append_sig` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`email`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_mail_private_users`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_med_ordercatalog`
--

CREATE TABLE IF NOT EXISTS `care_med_ordercatalog` (
  `item_no` int(11) NOT NULL auto_increment,
  `dept_nr` int(3) NOT NULL default '0',
  `hit` int(11) NOT NULL default '0',
  `artikelname` tinytext NOT NULL,
  `bestellnum` varchar(20) NOT NULL,
  `minorder` int(4) NOT NULL default '0',
  `maxorder` int(4) NOT NULL default '0',
  `proorder` tinytext NOT NULL,
  `dose` tinytext ,
  `packing` tinytext ,
  PRIMARY KEY  (`item_no`),
  KEY `item_no` (`item_no`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_med_ordercatalog`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_med_orderlist`
--

CREATE TABLE IF NOT EXISTS `care_med_orderlist` (
  `order_nr` int(11) NOT NULL auto_increment,
  `dept_nr` int(3) NOT NULL default '0',
  `order_date` date NOT NULL default '0000-00-00',
  `order_time` time NOT NULL default '00:00:00',
  `articles` text NOT NULL,
  `extra1` tinytext NOT NULL,
  `extra2` text NOT NULL,
  `validator` tinytext NOT NULL,
  `ip_addr` tinytext NOT NULL,
  `priority` tinytext NOT NULL,
  `status` varchar(25) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  `sent_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `process_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`order_nr`),
  KEY `item_nr` (`order_nr`),
  KEY `dept` (`dept_nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_med_orderlist`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_med_products_main`
--

CREATE TABLE IF NOT EXISTS `care_med_products_main` (
  `bestellnum` varchar(25) NOT NULL,
  `artikelnum` tinytext NOT NULL,
  `industrynum` tinytext NOT NULL,
  `artikelname` tinytext NOT NULL,
  `generic` tinytext NOT NULL,
  `description` text NOT NULL,
  `packing` tinytext NOT NULL,
  `dose` tinytext ,
  `minorder` int(4) NOT NULL default '0',
  `maxorder` int(4) NOT NULL default '0',
  `proorder` tinytext NOT NULL,
  `picfile` tinytext NOT NULL,
  `encoder` tinytext NOT NULL,
  `enc_date` tinytext NOT NULL,
  `enc_time` tinytext NOT NULL,
  `lock_flag` tinyint(1) NOT NULL default '0',
  `medgroup` text NOT NULL,
  `cave` tinytext NOT NULL,
  `status` varchar(20) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  `depot` tinytext ,
  `minpcs` int(99) unsigned NOT NULL default '0',
  PRIMARY KEY  (`bestellnum`),
  KEY `bestellnum` (`bestellnum`)
) ENGINE=InnoDB;

--
-- Dumping data for table `care_med_products_main`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_menu_main`
--

CREATE TABLE IF NOT EXISTS `care_menu_main` (
  `nr` tinyint(3) unsigned NOT NULL auto_increment,
  `sort_nr` tinyint(2) NOT NULL default '0',
  `name` varchar(35) NOT NULL,
  `image` varchar(100)  default NULL,
  `LD_var` varchar(35) NOT NULL,
  `url` varchar(255) NOT NULL,
  `is_visible` tinyint(1) unsigned NOT NULL default '1',
  `hide_by` text ,
  `status` varchar(25) NOT NULL,
  `modify_id` varchar(60)  default NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_menu_main`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_menu_sub`
--

CREATE TABLE IF NOT EXISTS `care_menu_sub` (
  `s_nr` int(11) NOT NULL default '0',
  `s_sort_nr` int(11) NOT NULL default '0',
  `s_main_nr` int(11) NOT NULL default '0',
  `s_ebene` int(11) NOT NULL default '0',
  `s_name` varchar(100) NOT NULL default '',
  `s_LD_var` varchar(100) NOT NULL default '',
  `s_url` varchar(100) NOT NULL default '',
  `s_url_ext` varchar(100) NOT NULL default '',
  `s_image` varchar(100) NOT NULL default '',
  `s_open_image` varchar(100) NOT NULL default '',
  `s_is_visible` varchar(100) NOT NULL default '',
  `s_hide_by` varchar(100) NOT NULL default '',
  `s_status` varchar(100) NOT NULL default '',
  `s_modify_id` varchar(100) NOT NULL default '',
  `s_modify_time` datetime NOT NULL default '0000-00-00 00:00:00'
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_menu_sub`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_method_induction`
--

CREATE TABLE IF NOT EXISTS `care_method_induction` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `group_nr` tinyint(3) unsigned NOT NULL default '0',
  `method` varchar(35) NOT NULL,
  `name` varchar(35) NOT NULL,
  `LD_var` varchar(35) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(25) NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_method_induction`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_mode_delivery`
--

CREATE TABLE IF NOT EXISTS `care_mode_delivery` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `group_nr` tinyint(3) unsigned NOT NULL default '0',
  `mode` varchar(35) NOT NULL,
  `name` varchar(35) NOT NULL,
  `LD_var` varchar(35) NOT NULL,
  `description` varchar(255)  default NULL,
  `status` varchar(25) NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_mode_delivery`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_neonatal`
--

CREATE TABLE IF NOT EXISTS `care_neonatal` (
  `nr` int(11) unsigned NOT NULL auto_increment,
  `pid` int(11) unsigned NOT NULL default '0',
  `delivery_date` date NOT NULL default '0000-00-00',
  `parent_encounter_nr` int(11) unsigned NOT NULL default '0',
  `delivery_nr` tinyint(4) NOT NULL default '0',
  `encounter_nr` int(11) unsigned NOT NULL default '0',
  `delivery_place` varchar(60) NOT NULL,
  `delivery_mode` tinyint(2) NOT NULL default '0',
  `c_s_reason` text ,
  `born_before_arrival` tinyint(1) default '0',
  `face_presentation` tinyint(1) NOT NULL default '0',
  `posterio_occipital_position` tinyint(1) NOT NULL default '0',
  `delivery_rank` tinyint(2) unsigned NOT NULL default '1',
  `apgar_1_min` tinyint(4) NOT NULL default '0',
  `apgar_5_min` tinyint(4) NOT NULL default '0',
  `apgar_10_min` tinyint(4) NOT NULL default '0',
  `time_to_spont_resp` tinyint(2) default NULL,
  `condition` varchar(60)  default '0',
  `weight` float(8,2) unsigned default NULL,
  `length` float(8,2) unsigned default NULL,
  `head_circumference` float(8,2) unsigned default NULL,
  `scored_gestational_age` float(4,2) unsigned default NULL,
  `feeding` tinyint(4) NOT NULL default '0',
  `congenital_abnormality` varchar(125) NOT NULL,
  `classification` varchar(255) NOT NULL default '0',
  `disease_category` tinyint(2) NOT NULL default '0',
  `outcome` tinyint(2) NOT NULL default '0',
  `status` varchar(25) NOT NULL,
  `history` text ,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  KEY `pid` (`pid`),
  KEY `pregnancy_nr` (`parent_encounter_nr`),
  KEY `encounter_nr` (`encounter_nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_neonatal`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_news_article`
--

CREATE TABLE IF NOT EXISTS `care_news_article` (
  `nr` int(11) NOT NULL auto_increment,
  `lang` varchar(10) NOT NULL default 'en',
  `dept_nr` smallint(5) unsigned NOT NULL default '0',
  `category` tinytext NOT NULL,
  `status` varchar(10) NOT NULL default 'pending',
  `title` varchar(255) NOT NULL,
  `preface` text NOT NULL,
  `body` text NOT NULL,
  `pic` blob,
  `pic_mime` varchar(4)  default NULL,
  `art_num` tinyint(1) NOT NULL default '0',
  `head_file` tinytext NOT NULL,
  `main_file` tinytext NOT NULL,
  `pic_file` tinytext NOT NULL,
  `author` varchar(30) NOT NULL,
  `submit_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `encode_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `publish_date` date NOT NULL default '0000-00-00',
  `modify_id` varchar(30) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(30) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  KEY `item_no` (`nr`)
) ENGINE=InnoDB ;


-- --------------------------------------------------------

--
-- Table structure for table `care_ops301_en`
--

CREATE TABLE IF NOT EXISTS `care_ops301_en` (
  `code` varchar(12) NOT NULL,
  `description` text NOT NULL,
  `inclusive` text NOT NULL,
  `exclusive` text NOT NULL,
  `notes` text NOT NULL,
  `std_code` char(1) NOT NULL,
  `sub_level` tinyint(4) NOT NULL default '0',
  `remarks` text NOT NULL,
  KEY `code` (`code`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

--
-- Table structure for table `care_ops301_it`
--

CREATE TABLE IF NOT EXISTS `care_ops301_it` (
  `code` varchar(12) NOT NULL,
  `description` text NOT NULL,
  `inclusive` text NOT NULL,
  `exclusive` text NOT NULL,
  `notes` text NOT NULL,
  `std_code` char(1) NOT NULL,
  `sub_level` tinyint(4) NOT NULL default '0',
  `remarks` text NOT NULL,
  KEY `code` (`code`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

--
-- Table structure for table `care_ops301_es`
--

CREATE TABLE IF NOT EXISTS `care_ops301_es` (
  `code` varchar(12) NOT NULL,
  `description` text NOT NULL,
  `inclusive` text NOT NULL,
  `exclusive` text NOT NULL,
  `notes` text NOT NULL,
  `std_code` char(1) NOT NULL,
  `sub_level` tinyint(4) NOT NULL default '0',
  `remarks` text NOT NULL,
  KEY `code` (`code`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

--
-- Table structure for table `care_ops301_de`
--

CREATE TABLE IF NOT EXISTS `care_ops301_de` (
  `code` varchar(12) NOT NULL,
  `description` text NOT NULL,
  `inclusive` text NOT NULL,
  `exclusive` text NOT NULL,
  `notes` text NOT NULL,
  `std_code` char(1) NOT NULL,
  `sub_level` tinyint(4) NOT NULL default '0',
  `remarks` text NOT NULL,
  KEY `code` (`code`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

--
-- Table structure for table `care_op_med_doc`
--

CREATE TABLE IF NOT EXISTS `care_op_med_doc` (
  `nr` bigint(20) unsigned NOT NULL auto_increment,
  `op_date` varchar(12) NOT NULL,
  `operator` tinytext NOT NULL,
  `encounter_nr` int(11) unsigned NOT NULL default '0',
  `dept_nr` smallint(5) unsigned NOT NULL default '0',
  `diagnosis` text NOT NULL,
  `localize` text NOT NULL,
  `therapy` text NOT NULL,
  `special` text NOT NULL,
  `class_s` tinyint(4) NOT NULL default '0',
  `class_m` tinyint(4) NOT NULL default '0',
  `class_l` tinyint(4) NOT NULL default '0',
  `op_start` varchar(8) NOT NULL,
  `op_end` varchar(8) NOT NULL,
  `scrub_nurse` varchar(70) NOT NULL,
  `op_room` varchar(10) NOT NULL,
  `status` varchar(15) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  KEY `encounter_nr` (`encounter_nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_op_med_doc`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_person`
--

CREATE TABLE IF NOT EXISTS `care_person` (
  `pid` int(11) unsigned NOT NULL auto_increment,
  `date_reg` datetime NOT NULL default '0000-00-00 00:00:00',
  `name_first` varchar(60) NOT NULL,
  `name_2` varchar(60)  default NULL,
  `name_3` varchar(60)  default NULL,
  `name_middle` varchar(60)  default NULL,
  `name_last` varchar(60) NOT NULL,
  `name_maiden` varchar(60)  default NULL,
  `name_others` text NOT NULL,
  `date_birth` date NOT NULL default '0000-00-00',
  `blood_group` char(2) NOT NULL,
  `addr_str` varchar(60) NOT NULL,
  `addr_str_nr` varchar(10) NOT NULL,
  `addr_zip` varchar(15) NOT NULL,
  `addr_citytown_nr` mediumint(8) unsigned NOT NULL default '0',
  `addr_is_valid` tinyint(1) NOT NULL default '0',
  `citizenship` varchar(35)  default NULL,
  `phone_1_code` varchar(15)  default '0',
  `phone_1_nr` varchar(35)  default NULL,
  `phone_2_code` varchar(15)  default '0',
  `phone_2_nr` varchar(35)  default NULL,
  `cellphone_1_nr` varchar(35)  default NULL,
  `cellphone_2_nr` varchar(35)  default NULL,
  `fax` varchar(35)  default NULL,
  `email` varchar(60)  default NULL,
  `civil_status` varchar(35) NOT NULL,
  `sex` char(1) NOT NULL,
  `title` varchar(25)  default NULL,
  `photo` blob,
  `photo_filename` varchar(60) NOT NULL,
  `ethnic_orig` mediumint(8) unsigned default NULL,
  `org_id` varchar(60)  default NULL,
  `sss_nr` varchar(60)  default NULL,
  `nat_id_nr` varchar(60)  default NULL,
  `religion` varchar(125)  default NULL,
  `mother_pid` int(11) unsigned NOT NULL default '0',
  `father_pid` int(11) unsigned NOT NULL default '0',
  `contact_person` varchar(255)  default NULL,
  `contact_pid` int(11) unsigned NOT NULL default '0',
  `contact_relation` varchar(25)  default '0',
  `death_date` date NOT NULL default '0000-00-00',
  `death_encounter_nr` int(10) unsigned NOT NULL default '0',
  `death_cause` varchar(255)  default NULL,
  `death_cause_code` varchar(15)  default NULL,
  `date_update` datetime default NULL,
  `status` varchar(20) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  `relative_name_first` varchar(60)  default NULL,
  `relative_name_last` varchar(60)  default NULL,
  `relative_phone` varchar(35)  default NULL,
  PRIMARY KEY  (`pid`),
  KEY `name_last` (`name_last`),
  KEY `name_first` (`name_first`),
  KEY `date_reg` (`date_reg`),
  KEY `date_birth` (`date_birth`)
) ENGINE=InnoDB ;

ALTER TABLE `care_encounter`
  ADD CONSTRAINT `care_encounter_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `care_person` (`pid`);

--
-- Dumping data for table `care_person`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_personell`
--

CREATE TABLE IF NOT EXISTS `care_personell` (
  `nr` int(11) NOT NULL auto_increment,
  `short_id` varchar(10)  default NULL,
  `pid` int(11) NOT NULL default '0',
  `job_type_nr` int(11) NOT NULL default '0',
  `job_function_title` varchar(60)  default NULL,
  `date_join` date default NULL,
  `date_exit` date default NULL,
  `contract_class` varchar(35) NOT NULL default '0',
  `contract_start` date default NULL,
  `contract_end` date default NULL,
  `is_discharged` tinyint(1) NOT NULL default '0',
  `pay_class` varchar(25) NOT NULL,
  `pay_class_sub` varchar(25) NOT NULL,
  `local_premium_id` varchar(5) NOT NULL,
  `tax_account_nr` varchar(60) NOT NULL,
  `ir_code` varchar(25) NOT NULL,
  `nr_workday` tinyint(1) NOT NULL default '0',
  `nr_weekhour` float(10,2) NOT NULL default '0.00',
  `nr_vacation_day` tinyint(2) NOT NULL default '0',
  `multiple_employer` tinyint(1) NOT NULL default '0',
  `nr_dependent` tinyint(2) unsigned NOT NULL default '0',
  `status` varchar(25) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`,`pid`,`job_type_nr`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_personell`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_personell_assignment`
--

CREATE TABLE IF NOT EXISTS `care_personell_assignment` (
  `nr` int(10) unsigned NOT NULL auto_increment,
  `personell_nr` int(11) unsigned NOT NULL default '0',
  `role_nr` smallint(5) unsigned NOT NULL default '0',
  `location_type_nr` smallint(5) unsigned NOT NULL default '0',
  `location_nr` smallint(5) unsigned NOT NULL default '0',
  `date_start` date NOT NULL default '0000-00-00',
  `date_end` date NOT NULL default '0000-00-00',
  `is_temporary` tinyint(1) unsigned default NULL,
  `list_frequency` int(11) unsigned NOT NULL default '0',
  `status` varchar(25) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`,`personell_nr`,`role_nr`,`location_type_nr`,`location_nr`),
  KEY `personell_nr` (`personell_nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_personell_assignment`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_person_insurance`
--

CREATE TABLE IF NOT EXISTS `care_person_insurance` (
  `item_nr` int(10) unsigned NOT NULL auto_increment,
  `pid` int(10) unsigned NOT NULL default '0',
  `type` varchar(60) NOT NULL,
  `insurance_nr` varchar(50) NOT NULL default '0',
  `firm_id` varchar(60) NOT NULL,
  `class_nr` tinyint(2) unsigned NOT NULL default '0',
  `is_void` tinyint(1) unsigned NOT NULL default '0',
  `status` varchar(25) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`item_nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_person_insurance`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_person_other_number`
--

CREATE TABLE IF NOT EXISTS `care_person_other_number` (
  `nr` int(10) unsigned NOT NULL auto_increment,
  `pid` int(11) unsigned NOT NULL default '0',
  `other_nr` varchar(30) NOT NULL,
  `org` varchar(35) NOT NULL,
  `status` varchar(25) NOT NULL,
  `history` text ,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  KEY `pid` (`pid`),
  KEY `other_nr` (`other_nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_person_other_number`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_pharma_ordercatalog`
--

CREATE TABLE IF NOT EXISTS `care_pharma_ordercatalog` (
  `item_no` int(11) NOT NULL auto_increment,
  `dept_nr` int(3) NOT NULL default '0',
  `hit` int(11) NOT NULL default '0',
  `artikelname` tinytext NOT NULL,
  `bestellnum` varchar(20) NOT NULL,
  `minorder` int(4) NOT NULL default '0',
  `maxorder` int(4) NOT NULL default '0',
  `proorder` tinytext NOT NULL,
  `dose` tinytext ,
  `packing` tinytext ,
  `quantity` double NOT NULL default '0',
  KEY `item_no` (`item_no`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_pharma_ordercatalog`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_pharma_orderlist`
--

CREATE TABLE IF NOT EXISTS `care_pharma_orderlist` (
  `order_nr` int(11) NOT NULL auto_increment,
  `dept_nr` int(3) NOT NULL default '0',
  `order_date` date NOT NULL default '0000-00-00',
  `order_time` time NOT NULL default '00:00:00',
  `articles` text NOT NULL,
  `extra1` tinytext NOT NULL,
  `extra2` text NOT NULL,
  `validator` tinytext NOT NULL,
  `ip_addr` tinytext NOT NULL,
  `priority` tinytext NOT NULL,
  `status` varchar(25) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  `sent_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `process_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`order_nr`,`dept_nr`),
  KEY `dept` (`dept_nr`),
  KEY `order_nr` (`order_nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_pharma_orderlist`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_pharma_products_main`
--

CREATE TABLE IF NOT EXISTS `care_pharma_products_main` (
  `bestellnum` varchar(25) NOT NULL,
  `id_sub` int(11) NOT NULL COMMENT 'connection with the product under card ',
  `artikelnum` tinytext NOT NULL,
  `industrynum` tinytext NOT NULL,
  `artikelname` tinytext NOT NULL,
  `generic` tinytext NOT NULL,
  `description` text NOT NULL,
  `packing` tinytext NOT NULL,
  `dose` tinytext NOT NULL,
  `minorder` int(4) NOT NULL default '0',
  `maxorder` int(4) NOT NULL default '0',
  `proorder` tinytext NOT NULL,
  `picfile` tinytext NOT NULL,
  `encoder` tinytext NOT NULL,
  `enc_date` tinytext NOT NULL,
  `enc_time` tinytext NOT NULL,
  `lock_flag` tinyint(1) NOT NULL default '0',
  `medgroup` text NOT NULL,
  `cave` tinytext NOT NULL,
  `status` varchar(20) NOT NULL,
  `minpcs` int(99) unsigned NOT NULL default '0',
  `depot` tinytext NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`bestellnum`)
) ENGINE=InnoDB;

--
-- Dumping data for table `care_pharma_products_main`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_phone`
--

CREATE TABLE IF NOT EXISTS `care_phone` (
  `item_nr` bigint(20) unsigned NOT NULL auto_increment,
  `title` varchar(25)  default NULL,
  `name` varchar(45) NOT NULL,
  `vorname` varchar(45) NOT NULL,
  `pid` int(11) unsigned NOT NULL default '0',
  `personell_nr` int(10) unsigned NOT NULL default '0',
  `dept_nr` smallint(3) unsigned NOT NULL default '0',
  `beruf` varchar(25)  default NULL,
  `bereich1` varchar(25)  default NULL,
  `bereich2` varchar(25)  default NULL,
  `inphone1` varchar(15)  default NULL,
  `inphone2` varchar(15)  default NULL,
  `inphone3` varchar(15)  default NULL,
  `exphone1` varchar(25)  default NULL,
  `exphone2` varchar(25)  default NULL,
  `funk1` varchar(15)  default NULL,
  `funk2` varchar(15)  default NULL,
  `roomnr` varchar(10)  default NULL,
  `date` date NOT NULL default '0000-00-00',
  `time` time NOT NULL default '00:00:00',
  `status` varchar(15) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`item_nr`,`pid`,`personell_nr`,`dept_nr`),
  KEY `name` (`name`),
  KEY `vorname` (`vorname`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_phone`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_pregnancy`
--

CREATE TABLE IF NOT EXISTS `care_pregnancy` (
  `nr` int(10) unsigned NOT NULL auto_increment,
  `encounter_nr` int(11) unsigned NOT NULL default '0',
  `this_pregnancy_nr` int(11) unsigned NOT NULL default '0',
  `delivery_date` date NOT NULL default '0000-00-00',
  `delivery_time` time NOT NULL default '00:00:00',
  `gravida` tinyint(2) unsigned default NULL,
  `para` tinyint(2) unsigned default NULL,
  `pregnancy_gestational_age` tinyint(2) unsigned default NULL,
  `nr_of_fetuses` tinyint(2) unsigned default NULL,
  `child_encounter_nr` varchar(255) NOT NULL,
  `is_booked` tinyint(1) NOT NULL default '0',
  `vdrl` char(1)  default NULL,
  `rh` tinyint(1) default NULL,
  `delivery_mode` tinyint(2) NOT NULL default '0',
  `delivery_by` varchar(60)  default NULL,
  `bp_systolic_high` smallint(4) unsigned default NULL,
  `bp_diastolic_high` smallint(4) unsigned default NULL,
  `proteinuria` tinyint(1) default NULL,
  `labour_duration` smallint(3) unsigned default NULL,
  `induction_method` tinyint(2) NOT NULL default '0',
  `induction_indication` varchar(125)  default NULL,
  `anaesth_type_nr` tinyint(2) NOT NULL default '0',
  `is_epidural` char(1)  default NULL,
  `complications` varchar(255)  default NULL,
  `perineum` tinyint(2) NOT NULL default '0',
  `blood_loss` float(8,2) unsigned default NULL,
  `blood_loss_unit` varchar(10)  default NULL,
  `is_retained_placenta` char(1) NOT NULL,
  `post_labour_condition` varchar(35)  default NULL,
  `outcome` varchar(35) NOT NULL,
  `status` varchar(25) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`,`encounter_nr`),
  KEY `encounter_nr` (`encounter_nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_pregnancy`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_registry`
--

CREATE TABLE IF NOT EXISTS `care_registry` (
  `registry_id` varchar(35) NOT NULL,
  `module_start_script` varchar(60) NOT NULL,
  `news_start_script` varchar(60) NOT NULL,
  `news_editor_script` varchar(255) NOT NULL,
  `news_reader_script` varchar(255) NOT NULL,
  `passcheck_script` varchar(255) NOT NULL,
  `composite` text NOT NULL,
  `status` varchar(25) NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`registry_id`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_registry`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_role_person`
--

CREATE TABLE IF NOT EXISTS `care_role_person` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `group_nr` tinyint(3) unsigned NOT NULL default '0',
  `role` varchar(35) NOT NULL,
  `name` varchar(35) NOT NULL,
  `LD_var` varchar(35) NOT NULL,
  `status` varchar(25) NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`,`group_nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_role_person`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_room`
--

CREATE TABLE IF NOT EXISTS `care_room` (
  `nr` int(8) unsigned NOT NULL auto_increment,
  `type_nr` tinyint(3) unsigned NOT NULL default '0',
  `date_create` date NOT NULL default '0000-00-00',
  `date_close` date NOT NULL default '0000-00-00',
  `is_temp_closed` tinyint(1) default '0',
  `room_nr` smallint(5) unsigned NOT NULL default '0',
  `ward_nr` smallint(5) unsigned NOT NULL default '0',
  `dept_nr` smallint(5) unsigned NOT NULL default '0',
  `nr_of_beds` tinyint(3) unsigned NOT NULL default '1',
  `closed_beds` varchar(255) NOT NULL,
  `info` varchar(60)  default NULL,
  `status` varchar(25) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`,`type_nr`,`ward_nr`,`dept_nr`),
  KEY `room_nr` (`room_nr`),
  KEY `ward_nr` (`ward_nr`),
  KEY `dept_nr` (`dept_nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_room`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_sessions`
--

CREATE TABLE IF NOT EXISTS `care_sessions` (
  `SESSKEY` varchar(32) NOT NULL,
  `EXPIRY` int(11) unsigned NOT NULL default '0',
  `expireref` varchar(64) NOT NULL,
  `DATA` text NOT NULL,
  PRIMARY KEY  (`SESSKEY`),
  KEY `EXPIRY` (`EXPIRY`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_sessions`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_standby_duty_report`
--

CREATE TABLE IF NOT EXISTS `care_standby_duty_report` (
  `report_nr` int(11) NOT NULL auto_increment,
  `dept` varchar(15) NOT NULL,
  `date` date NOT NULL default '0000-00-00',
  `standby_name` varchar(35) NOT NULL,
  `standby_start` time NOT NULL default '00:00:00',
  `standby_end` time NOT NULL default '00:00:00',
  `oncall_name` varchar(35) NOT NULL,
  `oncall_start` time NOT NULL default '00:00:00',
  `oncall_end` time NOT NULL default '00:00:00',
  `op_room` char(2) NOT NULL,
  `diagnosis_therapy` text NOT NULL,
  `encoding` text NOT NULL,
  `status` varchar(20) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`report_nr`),
  KEY `report_nr` (`report_nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_standby_duty_report`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_steri_products_main`
--

CREATE TABLE IF NOT EXISTS `care_steri_products_main` (
  `bestellnum` int(15) unsigned NOT NULL default '0',
  `containernum` varchar(15) NOT NULL,
  `industrynum` tinytext NOT NULL,
  `containername` varchar(40) NOT NULL,
  `description` text NOT NULL,
  `packing` tinytext NOT NULL,
  `minorder` int(4) unsigned NOT NULL default '0',
  `maxorder` int(4) unsigned NOT NULL default '0',
  `proorder` tinytext NOT NULL,
  `picfile` tinytext NOT NULL,
  `encoder` tinytext NOT NULL,
  `enc_date` tinytext NOT NULL,
  `enc_time` tinytext NOT NULL,
  `lock_flag` tinyint(1) NOT NULL default '0',
  `medgroup` text NOT NULL,
  `cave` tinytext NOT NULL
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_steri_products_main`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_target_test`
--

CREATE TABLE IF NOT EXISTS `care_target_test` (
  `nr` bigint(20) NOT NULL auto_increment,
  `encounter_nr` varchar(20) NOT NULL,
  `personell_nr` varchar(20) NOT NULL,
  `personell_name` varchar(255)  default NULL,
  `location_id` varchar(20) NOT NULL,
  `history` varchar(255) NOT NULL,
  `modify_id` varchar(255) NOT NULL,
  `modify_time` varchar(255) NOT NULL,
  `create_id` varchar(255) NOT NULL,
  `create_time` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `tipo_costituzionale` varchar(255)  default NULL,
  `condizioni_generali` varchar(255)  default NULL,
  `stato_nutrizione` varchar(255)  default NULL,
  `decubito` varchar(255)  default NULL,
  `psiche` varchar(255)  default NULL,
  `cute` varchar(255)  default NULL,
  `descrizione_mucose` varchar(255)  default NULL,
  `annessi_cutanei` varchar(255)  default NULL,
  `edemi` varchar(255)  default NULL,
  `sottocutaneo_descrizione` varchar(255)  default NULL,
  `temperatura` varchar(255)  default NULL,
  `polso_battiti` varchar(255)  default NULL,
  `polso` varchar(255)  default NULL,
  `pressione_max` varchar(255)  default NULL,
  `pressione_min` varchar(255)  default NULL,
  `linfoghiandolare_descrizione` varchar(255)  default NULL,
  `capo_descrizione` varchar(255)  default NULL,
  `globi_oculari` varchar(255)  default NULL,
  `sclere_descrizione` varchar(255)  default NULL,
  `pupille` varchar(255)  default NULL,
  `riflesso_corneale` varchar(255)  default NULL,
  `orecchie` varchar(255)  default NULL,
  `naso` varchar(255)  default NULL,
  `cavo_orofaringeo` varchar(255)  default NULL,
  `lingua` varchar(255)  default NULL,
  `dentatura` varchar(255)  default NULL,
  `tonsille` varchar(255)  default NULL,
  `collo_forma` varchar(255)  default NULL,
  `mobilita` varchar(255)  default NULL,
  `atteggiamento` varchar(255)  default NULL,
  `giugulari_turgide` varchar(255)  default NULL,
  `tiroide_normale` varchar(255)  default NULL,
  `collo_descrizione` varchar(255)  default NULL,
  `mammelle` varchar(255)  default NULL,
  `torace_forma` varchar(255)  default NULL,
  `reperti_torace` varchar(255)  default NULL,
  `ispezione_respiratoria` varchar(255)  default NULL,
  `palpazione_respiratoria` varchar(255)  default NULL,
  `percussione_respiratoria` varchar(255)  default NULL,
  `ascoltazione_respiratoria` varchar(255)  default NULL,
  `reperti_respiratoria` varchar(255)  default NULL,
  `fegato_descrizione` varchar(255)  default NULL,
  `epatomegalia` varchar(255)  default NULL,
  `murphy` varchar(255)  default NULL,
  `colecisti_palpabile` varchar(255)  default NULL,
  `reperti_fegato` varchar(255)  default NULL,
  `milza_descrizione` varchar(255)  default NULL,
  `reperti_milza` varchar(255)  default NULL,
  `urogenitale_descrizione` varchar(255)  default NULL,
  `esplorazione_vaginale` varchar(255)  default NULL,
  `reperti_genitale` varchar(255)  default NULL,
  `osteoarticolare_descrizione` varchar(255)  default NULL,
  `muscolare_descrizione` varchar(255)  default NULL,
  `reperti_muscolare` varchar(255)  default NULL,
  `nervoso_descrizione` varchar(255)  default NULL,
  `nervi_cranici` varchar(255)  default NULL,
  `riflessi_superficiali` varchar(255)  default NULL,
  `reperti_nervoso` varchar(255)  default NULL,
  `ispezione_cuore` varchar(255)  default NULL,
  `palpazione_cuore` varchar(255)  default NULL,
  `percussione_cuore` varchar(255)  default NULL,
  `ascoltazione_cuore` varchar(255)  default NULL,
  `reperti_cuore` varchar(255)  default NULL,
  `vasi_periferici_descrizione` varchar(255)  default NULL,
  `arterie` varchar(255)  default NULL,
  `vene` varchar(255)  default NULL,
  `reperti_vasi` varchar(255)  default NULL,
  `addome_descrizione` varchar(255)  default NULL,
  `addome_ispezione` varchar(255)  default NULL,
  `addome_palpazione` varchar(255)  default NULL,
  `addome_percussione` varchar(255)  default NULL,
  `addome_ascoltazione` varchar(255)  default NULL,
  `rettale` varchar(255)  default NULL,
  `reperti_addome` varchar(255)  default NULL,
  PRIMARY KEY  (`nr`),
  UNIQUE KEY `nr` (`nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_target_test`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_tech_questions`
--

CREATE TABLE IF NOT EXISTS `care_tech_questions` (
  `batch_nr` int(11) NOT NULL auto_increment,
  `dept` varchar(60) NOT NULL,
  `query` text NOT NULL,
  `inquirer` varchar(25) NOT NULL,
  `tphone` varchar(30) NOT NULL,
  `tdate` date NOT NULL default '0000-00-00',
  `ttime` time NOT NULL default '00:00:00',
  `tid` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `reply` text NOT NULL,
  `answered` tinyint(1) NOT NULL default '0',
  `ansby` varchar(25) NOT NULL,
  `astamp` varchar(16) NOT NULL,
  `archive` tinyint(1) NOT NULL default '0',
  `status` varchar(15) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`batch_nr`),
  KEY `batch_nr` (`batch_nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_tech_questions`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_tech_repair_done`
--

CREATE TABLE IF NOT EXISTS `care_tech_repair_done` (
  `batch_nr` int(11) NOT NULL auto_increment,
  `dept` varchar(15)  default NULL,
  `dept_nr` tinyint(3) unsigned NOT NULL default '0',
  `job_id` varchar(15) NOT NULL default '0',
  `job` text NOT NULL,
  `reporter` varchar(25) NOT NULL,
  `id` varchar(15) NOT NULL,
  `tdate` date NOT NULL default '0000-00-00',
  `ttime` time NOT NULL default '00:00:00',
  `tid` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `seen` tinyint(1) NOT NULL default '0',
  `d_idx` varchar(8) NOT NULL,
  `status` varchar(15) NOT NULL,
  `history` text ,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`batch_nr`,`dept_nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_tech_repair_done`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_tech_repair_job`
--

CREATE TABLE IF NOT EXISTS `care_tech_repair_job` (
  `batch_nr` tinyint(4) NOT NULL auto_increment,
  `dept` varchar(15) NOT NULL,
  `job` text NOT NULL,
  `reporter` varchar(25) NOT NULL,
  `id` varchar(15) NOT NULL,
  `tphone` varchar(30) NOT NULL,
  `tdate` date NOT NULL default '0000-00-00',
  `ttime` time NOT NULL default '00:00:00',
  `tid` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `done` tinyint(1) NOT NULL default '0',
  `seen` tinyint(1) NOT NULL default '0',
  `seenby` varchar(25) NOT NULL,
  `sstamp` varchar(16) NOT NULL,
  `doneby` varchar(25) NOT NULL,
  `dstamp` varchar(16) NOT NULL,
  `d_idx` varchar(8) NOT NULL,
  `archive` tinyint(1) NOT NULL default '0',
  `status` varchar(20) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`batch_nr`),
  KEY `batch_nr` (`batch_nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_tech_repair_job`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_test_findings_baclabor`
--

CREATE TABLE IF NOT EXISTS `care_test_findings_baclabor` (
  `batch_nr` int(11) NOT NULL default '0' COMMENT 'Test findings report number. Primary key',
  `encounter_nr` int(11) unsigned NOT NULL default '0' COMMENT 'Related encounter number',
  `room_nr` varchar(10) NOT NULL COMMENT 'Room number, e.g. OP room. (foreign key)',
  `dept_nr` smallint(5) unsigned NOT NULL default '0' COMMENT 'Department number (foreign key)',
  `notes` varchar(255) NOT NULL COMMENT 'Supplementary remarks',
  `findings_init` tinyint(1) NOT NULL default '0' COMMENT 'Initial findings text',
  `findings_current` tinyint(1) NOT NULL default '0' COMMENT 'Current findings text',
  `findings_final` tinyint(1) NOT NULL default '0' COMMENT 'Final findings report text',
  `entry_nr` varchar(10) NOT NULL COMMENT 'Entry number',
  `rec_date` date NOT NULL default '0000-00-00' COMMENT 'Reception date',
  `type_general` text NOT NULL COMMENT 'General type',
  `resist_anaerob` text NOT NULL COMMENT 'Flag if resistant to anaerobic',
  `resist_aerob` text NOT NULL COMMENT 'Flag if resistant to aerobic',
  `findings` text NOT NULL COMMENT 'General findings',
  `doctor_id` varchar(35) NOT NULL COMMENT 'Doctors id',
  `findings_date` date NOT NULL default '0000-00-00' COMMENT 'Date of findings report',
  `findings_time` time NOT NULL default '00:00:00' COMMENT 'Time of findings report',
  `status` varchar(10) NOT NULL COMMENT 'This record''s status - initial or done',
  `history` text ,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`batch_nr`,`encounter_nr`,`room_nr`,`dept_nr`),
  KEY `findings_date` (`findings_date`),
  KEY `rec_date` (`rec_date`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_test_findings_baclabor`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_test_findings_baclabor_sub`
--

CREATE TABLE IF NOT EXISTS `care_test_findings_baclabor_sub` (
  `sub_id` int(40) NOT NULL auto_increment,
  `batch_nr` int(11) NOT NULL default '0',
  `encounter_nr` int(11) NOT NULL default '0',
  `type_general` varchar(255) CHARACTER SET utf8 NOT NULL default '0' COMMENT 'General type',
  `resist_anaerob` varchar(255) CHARACTER SET utf8 NOT NULL default '0' COMMENT 'Flag if resistant to anaerobic',
  `resist_aerob` varchar(255) CHARACTER SET utf8 NOT NULL default '0' COMMENT 'Flag if resistant to aerobic',
  `findings` varchar(255) CHARACTER SET utf8 NOT NULL default '0' COMMENT 'General findings',
  `findings_date` date NOT NULL default '0000-00-00' COMMENT 'Date of findings report',
  `findings_time` time NOT NULL default '00:00:00' COMMENT 'Time of findings report',
  `status` varchar(255) CHARACTER SET utf8  default NULL,
  `history` text CHARACTER SET utf8 ,
  `modify_id` varchar(35) CHARACTER SET utf8 NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) CHARACTER SET utf8  default NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`sub_id`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_test_findings_baclabor_sub`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_test_findings_chemlab`
--

CREATE TABLE IF NOT EXISTS `care_test_findings_chemlab` (
  `batch_nr` int(11) NOT NULL auto_increment,
  `encounter_nr` int(11) NOT NULL default '0',
  `job_id` varchar(25) NOT NULL,
  `test_date` date NOT NULL default '0000-00-00',
  `test_time` time NOT NULL default '00:00:00',
  `group_id` varchar(30) NOT NULL,
  `serial_value` text NOT NULL,
  `validator` varchar(15) NOT NULL,
  `validate_dt` datetime NOT NULL default '0000-00-00 00:00:00',
  `status` varchar(20) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`batch_nr`,`encounter_nr`,`job_id`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_test_findings_chemlab`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_test_findings_chemlabor_sub`
--

CREATE TABLE IF NOT EXISTS `care_test_findings_chemlabor_sub` (
  `sub_id` int(40) NOT NULL auto_increment,
  `batch_nr` int(11) NOT NULL default '0',
  `job_id` varchar(25) CHARACTER SET utf8 NOT NULL default '0',
  `encounter_nr` int(11) NOT NULL default '0',
  `paramater_name` varchar(255) default '0',
  `parameter_value` varchar(255) default '0',
  `status` varchar(255) CHARACTER SET utf8  default NULL,
  `history` text CHARACTER SET utf8 ,
  `test_date` date NOT NULL default '0000-00-00',
  `test_time` time default NULL,
  `create_id` varchar(35) CHARACTER SET utf8  default NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`sub_id`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_test_findings_chemlabor_sub`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_test_findings_patho`
--

CREATE TABLE IF NOT EXISTS `care_test_findings_patho` (
  `batch_nr` int(11) NOT NULL default '0',
  `encounter_nr` int(11) unsigned NOT NULL default '0',
  `room_nr` varchar(10) NOT NULL,
  `dept_nr` smallint(5) unsigned NOT NULL default '0',
  `material` text NOT NULL,
  `macro` text NOT NULL,
  `micro` text NOT NULL,
  `findings` text NOT NULL,
  `diagnosis` text NOT NULL,
  `doctor_id` varchar(35) NOT NULL,
  `findings_date` date NOT NULL default '0000-00-00',
  `findings_time` time NOT NULL default '00:00:00',
  `status` varchar(10) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`batch_nr`,`encounter_nr`,`room_nr`,`dept_nr`),
  KEY `send_date` (`findings_date`),
  KEY `findings_date` (`findings_date`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_test_findings_patho`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_test_findings_radio`
--

CREATE TABLE IF NOT EXISTS `care_test_findings_radio` (
  `batch_nr` int(11) unsigned NOT NULL default '0',
  `encounter_nr` int(11) unsigned NOT NULL default '0',
  `room_nr` smallint(5) unsigned NOT NULL default '0',
  `dept_nr` smallint(5) unsigned NOT NULL default '0',
  `findings` text NOT NULL,
  `diagnosis` text NOT NULL,
  `doctor_id` varchar(35) NOT NULL,
  `findings_date` date NOT NULL default '0000-00-00',
  `findings_time` time NOT NULL default '00:00:00',
  `status` varchar(10) NOT NULL,
  `history` text ,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`batch_nr`,`encounter_nr`),
  KEY `send_date` (`findings_date`),
  KEY `findings_date` (`findings_date`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_test_findings_radio`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_test_param`
--

CREATE TABLE IF NOT EXISTS `care_test_param` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `group_id` varchar(35) NOT NULL,
  `name` varchar(35) NOT NULL,
  `id` varchar(50) NOT NULL,
  `sort_nr` tinyint(4) NOT NULL default '0',
  `msr_unit` varchar(15) NOT NULL,
  `status` varchar(25) NOT NULL,
  `median` varchar(20)  default ' ' COMMENT 'for males',
  `hi_bound` varchar(20)  default ' ',
  `lo_bound` varchar(20)  default ' ',
  `hi_critical` varchar(20)  default ' ',
  `lo_critical` varchar(20)  default ' ',
  `hi_toxic` varchar(20)  default ' ',
  `lo_toxic` varchar(20)  default ' ',
  `median_f` varchar(20)  default ' ' COMMENT '_f for females',
  `hi_bound_f` varchar(20)  default ' ',
  `lo_bound_f` varchar(20)  default ' ',
  `hi_critical_f` varchar(20)  default ' ',
  `lo_critical_f` varchar(20)  default ' ',
  `hi_toxic_f` varchar(20)  default ' ',
  `lo_toxic_f` varchar(20)  default ' ',
  `median_n` varchar(20)  default ' ' COMMENT '_n for neonatal from 0 to 1 month',
  `hi_bound_n` varchar(20)  default ' ',
  `lo_bound_n` varchar(20)  default ' ',
  `hi_critical_n` varchar(20)  default ' ',
  `lo_critical_n` varchar(20)  default ' ',
  `hi_toxic_n` varchar(20)  default ' ',
  `lo_toxic_n` varchar(20)  default ' ',
  `median_y` varchar(20)  default ' ' COMMENT '_y for children form 1 month to 12 months',
  `hi_bound_y` varchar(20)  default ' ',
  `lo_bound_y` varchar(20)  default ' ',
  `hi_critical_y` varchar(20)  default ' ',
  `lo_critical_y` varchar(20)  default ' ',
  `hi_toxic_y` varchar(20)  default ' ',
  `lo_toxic_y` varchar(20)  default ' ',
  `median_c` varchar(20)  default ' ' COMMENT '_c for children form 1 to 14 years',
  `hi_bound_c` varchar(20)  default ' ',
  `lo_bound_c` varchar(20)  default ' ',
  `hi_critical_c` varchar(20)  default ' ',
  `lo_critical_c` varchar(20)  default ' ',
  `hi_toxic_c` varchar(20)  default ' ',
  `lo_toxic_c` varchar(20)  default ' ',
  `method` varchar(255)  default ' ',
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  UNIQUE KEY (`id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB ;


-- --------------------------------------------------------

--
-- Table structure for table `care_test_request_baclabor`
--

CREATE TABLE IF NOT EXISTS `care_test_request_baclabor` (
  `batch_nr` int(11) NOT NULL auto_increment COMMENT 'Test request batch number. primary key',
  `encounter_nr` int(11) unsigned NOT NULL default '0' COMMENT 'Related encounter number',
  `dept_nr` smallint(5) unsigned NOT NULL default '0' COMMENT 'Department number (foreign key)',
  `material` text NOT NULL COMMENT 'Material type',
  `test_type` text NOT NULL,
  `material_note` tinytext NOT NULL,
  `diagnosis_note` tinytext NOT NULL COMMENT 'Supplementary diagnosis notes',
  `immune_supp` tinyint(4) NOT NULL default '0' COMMENT 'Flag if immune suppressed. 1 = YES, 0 = NO',
  `send_date` date NOT NULL default '0000-00-00',
  `sample_date` date NOT NULL default '0000-00-00' COMMENT 'Date when sample was taken',
  `status` varchar(10) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`batch_nr`),
  KEY `send_date` (`send_date`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_test_request_baclabor`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_test_request_baclabor_sub`
--

CREATE TABLE IF NOT EXISTS `care_test_request_baclabor_sub` (
  `sub_id` int(40) NOT NULL auto_increment COMMENT 'primary key',
  `batch_nr` int(11) NOT NULL default '0' COMMENT 'connects to care_test_request_baclabor.batch_nr',
  `encounter_nr` int(11) NOT NULL default '0' COMMENT 'Related encounter number',
  `test_type` varchar(255) NOT NULL default '0' COMMENT 'Type of test requested',
  `test_type_value` varchar(255) NOT NULL default '0',
  `material` varchar(255) NOT NULL default '0' COMMENT 'Material notes and remarks',
  `material_value` varchar(255) NOT NULL default '0',
  PRIMARY KEY  (`sub_id`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_test_request_baclabor_sub`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_test_request_blood`
--

CREATE TABLE IF NOT EXISTS `care_test_request_blood` (
  `batch_nr` int(11) NOT NULL auto_increment,
  `encounter_nr` int(11) unsigned NOT NULL default '0',
  `dept_nr` smallint(5) unsigned NOT NULL default '0',
  `blood_group` varchar(10) NOT NULL,
  `rh_factor` varchar(10) NOT NULL,
  `kell` varchar(10) NOT NULL,
  `date_protoc_nr` varchar(45) NOT NULL,
  `pure_blood` varchar(15) NOT NULL,
  `red_blood` varchar(15) NOT NULL,
  `leukoless_blood` varchar(15) NOT NULL,
  `washed_blood` varchar(15) NOT NULL,
  `prp_blood` varchar(15) NOT NULL,
  `thrombo_con` varchar(15) NOT NULL,
  `ffp_plasma` varchar(15) NOT NULL,
  `transfusion_dev` varchar(15) NOT NULL,
  `match_sample` tinyint(4) NOT NULL default '0',
  `transfusion_date` date NOT NULL default '0000-00-00',
  `diagnosis` tinytext NOT NULL,
  `notes` tinytext NOT NULL,
  `send_date` date NOT NULL default '0000-00-00',
  `doctor` varchar(35) NOT NULL,
  `phone_nr` varchar(40) NOT NULL,
  `status` varchar(10) NOT NULL,
  `blood_pb` tinytext NOT NULL,
  `blood_rb` tinytext NOT NULL,
  `blood_llrb` tinytext NOT NULL,
  `blood_wrb` tinytext NOT NULL,
  `blood_prp` tinyblob NOT NULL,
  `blood_tc` tinytext NOT NULL,
  `blood_ffp` tinytext NOT NULL,
  `b_group_count` mediumint(9) NOT NULL default '0',
  `b_group_price` float(10,2) NOT NULL default '0.00',
  `a_subgroup_count` mediumint(9) NOT NULL default '0',
  `a_subgroup_price` float(10,2) NOT NULL default '0.00',
  `extra_factors_count` mediumint(9) NOT NULL default '0',
  `extra_factors_price` float(10,2) NOT NULL default '0.00',
  `coombs_count` mediumint(9) NOT NULL default '0',
  `coombs_price` float(10,2) NOT NULL default '0.00',
  `ab_test_count` mediumint(9) NOT NULL default '0',
  `ab_test_price` float(10,2) NOT NULL default '0.00',
  `crosstest_count` mediumint(9) NOT NULL default '0',
  `crosstest_price` float(10,2) NOT NULL default '0.00',
  `ab_diff_count` mediumint(9) NOT NULL default '0',
  `ab_diff_price` float(10,2) NOT NULL default '0.00',
  `x_test_1_code` mediumint(9) NOT NULL default '0',
  `x_test_1_name` varchar(35) NOT NULL,
  `x_test_1_count` mediumint(9) NOT NULL default '0',
  `x_test_1_price` float(10,2) NOT NULL default '0.00',
  `x_test_2_code` mediumint(9) NOT NULL default '0',
  `x_test_2_name` varchar(35) NOT NULL,
  `x_test_2_count` mediumint(9) NOT NULL default '0',
  `x_test_2_price` float(10,2) NOT NULL default '0.00',
  `x_test_3_code` mediumint(9) NOT NULL default '0',
  `x_test_3_name` varchar(35) NOT NULL,
  `x_test_3_count` mediumint(9) NOT NULL default '0',
  `x_test_3_price` float(10,2) NOT NULL default '0.00',
  `lab_stamp` datetime NOT NULL default '0000-00-00 00:00:00',
  `release_via` varchar(20) NOT NULL,
  `receipt_ack` varchar(20) NOT NULL,
  `mainlog_nr` varchar(7) NOT NULL,
  `lab_nr` varchar(7) NOT NULL,
  `mainlog_date` date NOT NULL default '0000-00-00',
  `lab_date` date NOT NULL default '0000-00-00',
  `mainlog_sign` varchar(20) NOT NULL,
  `lab_sign` varchar(20) NOT NULL,
  `history` text ,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`batch_nr`),
  KEY `send_date` (`send_date`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_test_request_blood`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_test_request_chemlabor`
--

CREATE TABLE IF NOT EXISTS `care_test_request_chemlabor` (
  `batch_nr` int(11) NOT NULL auto_increment,
  `encounter_nr` int(11) unsigned NOT NULL default '0',
  `room_nr` varchar(10) NOT NULL,
  `dept_nr` smallint(5) unsigned NOT NULL default '0',
  `parameters` text NOT NULL,
  `doctor_sign` varchar(35) NOT NULL,
  `highrisk` smallint(1) NOT NULL default '0',
  `notes` tinytext NOT NULL,
  `send_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `sample_time` time NOT NULL default '00:00:00',
  `urgent` tinyint(4) NOT NULL default '0',
  `sample_weekday` smallint(1) NOT NULL default '0',
  `status` varchar(15) NOT NULL,
  `history` text ,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`batch_nr`),
  KEY `encounter_nr` (`encounter_nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_test_request_chemlabor`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_test_request_chemlabor_sub`
--

CREATE TABLE IF NOT EXISTS `care_test_request_chemlabor_sub` (
  `sub_id` int(40) NOT NULL auto_increment,
  `batch_nr` int(11) NOT NULL default '0',
  `encounter_nr` int(11) NOT NULL default '0',
  `paramater_name` varchar(255) default '0',
  `parameter_value` varchar(255) default '0',
  PRIMARY KEY  (`sub_id`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_test_request_chemlabor_sub`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_test_request_generic`
--

CREATE TABLE IF NOT EXISTS `care_test_request_generic` (
  `batch_nr` int(11) NOT NULL default '0',
  `encounter_nr` int(11) unsigned NOT NULL default '0',
  `testing_dept` varchar(35) NOT NULL,
  `visit` tinyint(1) NOT NULL default '0',
  `order_patient` tinyint(1) NOT NULL default '0',
  `diagnosis_quiry` text NOT NULL,
  `send_date` date NOT NULL default '0000-00-00',
  `send_doctor` varchar(35) NOT NULL,
  `result` text NOT NULL,
  `result_date` date NOT NULL default '0000-00-00',
  `result_doctor` varchar(35) NOT NULL,
  `status` varchar(10) NOT NULL,
  `history` text ,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`batch_nr`),
  KEY `batch_nr` (`batch_nr`,`encounter_nr`),
  KEY `send_date` (`send_date`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_test_request_generic`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_test_request_patho`
--

CREATE TABLE IF NOT EXISTS `care_test_request_patho` (
  `batch_nr` int(11) unsigned NOT NULL auto_increment,
  `encounter_nr` int(11) unsigned NOT NULL default '0',
  `dept_nr` smallint(5) unsigned NOT NULL default '0',
  `quick_cut` tinyint(4) NOT NULL default '0',
  `qc_phone` varchar(40) NOT NULL,
  `quick_diagnosis` tinyint(4) NOT NULL default '0',
  `qd_phone` varchar(40) NOT NULL,
  `material_type` varchar(25) NOT NULL,
  `material_desc` text NOT NULL,
  `localization` tinytext NOT NULL,
  `clinical_note` tinytext NOT NULL,
  `extra_note` tinytext NOT NULL,
  `repeat_note` tinytext NOT NULL,
  `gyn_last_period` varchar(25) NOT NULL,
  `gyn_period_type` varchar(25) NOT NULL,
  `gyn_gravida` varchar(25) NOT NULL,
  `gyn_menopause_since` varchar(25) NOT NULL default '0',
  `gyn_hysterectomy` varchar(25) NOT NULL default '0',
  `gyn_contraceptive` varchar(25) NOT NULL default '0',
  `gyn_iud` varchar(25) NOT NULL,
  `gyn_hormone_therapy` varchar(25) NOT NULL,
  `doctor_sign` varchar(35) NOT NULL,
  `op_date` date NOT NULL default '0000-00-00',
  `send_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `status` varchar(10) NOT NULL,
  `entry_date` date NOT NULL default '0000-00-00',
  `journal_nr` varchar(15) NOT NULL,
  `blocks_nr` int(11) NOT NULL default '0',
  `deep_cuts` int(11) NOT NULL default '0',
  `special_dye` varchar(35) NOT NULL,
  `immune_histochem` varchar(35) NOT NULL,
  `hormone_receptors` varchar(35) NOT NULL,
  `specials` varchar(35) NOT NULL,
  `history` text ,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  `process_id` varchar(35) NOT NULL,
  `process_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`batch_nr`),
  KEY `encounter_nr` (`encounter_nr`),
  KEY `send_date` (`send_date`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_test_request_patho`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_test_request_radio`
--

CREATE TABLE IF NOT EXISTS `care_test_request_radio` (
  `batch_nr` int(11) NOT NULL default '0',
  `encounter_nr` int(11) unsigned NOT NULL default '0',
  `dept_nr` smallint(5) unsigned NOT NULL default '0',
  `xray` tinyint(1) NOT NULL default '0',
  `ct` tinyint(1) NOT NULL default '0',
  `sono` tinyint(1) NOT NULL default '0',
  `mammograph` tinyint(1) NOT NULL default '0',
  `mrt` tinyint(1) NOT NULL default '0',
  `nuclear` tinyint(1) NOT NULL default '0',
  `if_patmobile` tinyint(1) NOT NULL default '0',
  `if_allergy` tinyint(1) NOT NULL default '0',
  `if_hyperten` tinyint(1) NOT NULL default '0',
  `if_pregnant` tinyint(1) NOT NULL default '0',
  `clinical_info` text NOT NULL,
  `test_request` text NOT NULL,
  `send_date` date NOT NULL default '0000-00-00',
  `send_doctor` varchar(35) NOT NULL default '0',
  `xray_nr` varchar(9) NOT NULL default '0',
  `r_cm_2` varchar(15) NOT NULL,
  `mtr` varchar(35) NOT NULL,
  `xray_date` date NOT NULL default '0000-00-00',
  `xray_time` time NOT NULL default '00:00:00',
  `results` text NOT NULL,
  `results_date` date NOT NULL default '0000-00-00',
  `results_doctor` varchar(35) NOT NULL,
  `status` varchar(10) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  `process_id` varchar(35) NOT NULL,
  `process_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`batch_nr`),
  UNIQUE KEY `batch_nr_2` (`batch_nr`),
  KEY `batch_nr` (`batch_nr`,`encounter_nr`),
  KEY `send_date` (`xray_time`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_test_request_radio`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_type_anaesthesia`
--

CREATE TABLE IF NOT EXISTS `care_type_anaesthesia` (
  `nr` smallint(2) unsigned NOT NULL auto_increment,
  `id` varchar(35) NOT NULL,
  `name` varchar(35) NOT NULL,
  `LD_var` varchar(35) NOT NULL,
  `description` varchar(255)  default NULL,
  `status` varchar(25) NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_type_anaesthesia`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_type_application`
--

CREATE TABLE IF NOT EXISTS `care_type_application` (
  `nr` int(11) NOT NULL auto_increment,
  `group_nr` tinyint(3) unsigned NOT NULL default '0',
  `type` varchar(35) NOT NULL,
  `name` varchar(35) NOT NULL,
  `LD_var` varchar(35) NOT NULL,
  `description` varchar(255)  default NULL,
  `status` varchar(25) NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_type_application`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_type_assignment`
--

CREATE TABLE IF NOT EXISTS `care_type_assignment` (
  `type_nr` int(10) unsigned NOT NULL default '0',
  `type` varchar(35) NOT NULL,
  `name` varchar(35) NOT NULL,
  `LD_var` varchar(25) NOT NULL default '0',
  `status` varchar(25) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`type`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_type_assignment`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_type_cause_opdelay`
--

CREATE TABLE IF NOT EXISTS `care_type_cause_opdelay` (
  `type_nr` smallint(5) unsigned NOT NULL auto_increment,
  `type` varchar(35) NOT NULL,
  `cause` varchar(255) NOT NULL,
  `LD_var` varchar(35) NOT NULL,
  `status` varchar(25) NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`type_nr`),
  KEY `type` (`type`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_type_cause_opdelay`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_type_color`
--

CREATE TABLE IF NOT EXISTS `care_type_color` (
  `color_id` varchar(25) NOT NULL,
  `name` varchar(35) NOT NULL,
  `LD_var` varchar(35) NOT NULL,
  `status` varchar(25) NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`color_id`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_type_color`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_type_department`
--

CREATE TABLE IF NOT EXISTS `care_type_department` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `type` varchar(35) NOT NULL,
  `name` varchar(35) NOT NULL,
  `LD_var` varchar(35) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(25) NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  KEY `type` (`type`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_type_department`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_type_discharge`
--

CREATE TABLE IF NOT EXISTS `care_type_discharge` (
  `nr` smallint(3) unsigned NOT NULL auto_increment,
  `type` varchar(35) NOT NULL,
  `name` varchar(100) NOT NULL,
  `LD_var` varchar(35) NOT NULL,
  `status` varchar(25) NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_type_discharge`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_type_duty`
--

CREATE TABLE IF NOT EXISTS `care_type_duty` (
  `type_nr` smallint(5) unsigned NOT NULL auto_increment,
  `type` varchar(35) NOT NULL,
  `name` varchar(35) NOT NULL,
  `LD_var` varchar(35) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(25) NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`type_nr`),
  KEY `type` (`type`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_type_duty`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_type_encounter`
--

CREATE TABLE IF NOT EXISTS `care_type_encounter` (
  `type_nr` int(10) unsigned NOT NULL auto_increment,
  `type` varchar(35) NOT NULL,
  `name` varchar(35) NOT NULL,
  `LD_var` varchar(25) NOT NULL default '0',
  `description` varchar(255) NOT NULL,
  `hide_from` tinyint(4) NOT NULL default '0',
  `status` varchar(25) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`type_nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_type_encounter`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_type_ethnic_orig`
--

CREATE TABLE IF NOT EXISTS `care_type_ethnic_orig` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `class_nr` tinyint(3) unsigned NOT NULL default '0',
  `name` varchar(35) NOT NULL,
  `LD_var` varchar(35) NOT NULL,
  `status` varchar(25) NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  KEY `type` (`class_nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_type_ethnic_orig`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_type_feeding`
--

CREATE TABLE IF NOT EXISTS `care_type_feeding` (
  `nr` smallint(2) unsigned NOT NULL auto_increment,
  `group_nr` tinyint(3) unsigned NOT NULL default '0',
  `type` varchar(35) NOT NULL,
  `name` varchar(35) NOT NULL,
  `LD_var` varchar(35) NOT NULL,
  `description` varchar(255)  default NULL,
  `status` varchar(25) NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_type_feeding`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_type_immunization`
--

CREATE TABLE IF NOT EXISTS `care_type_immunization` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `type` varchar(20) NOT NULL default '' COMMENT 'Immunization type',
  `name` varchar(20) NOT NULL default '',
  `LD_var` varchar(35) NOT NULL default '',
  `period` smallint(6) default '0' COMMENT 'period...in days ?',
  `tolerance` smallint(3) default '0',
  `dosage` text ,
  `medicine` text NOT NULL,
  `titer` text ,
  `note` text ,
  `application` tinyint(3) default '0' COMMENT 'from care_type_application...application type',
  `status` varchar(25) NOT NULL default 'normal',
  `history` text ,
  `modify_id` varchar(35)  default NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL default '',
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_type_immunization`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_type_insurance`
--

CREATE TABLE IF NOT EXISTS `care_type_insurance` (
  `type_nr` int(11) NOT NULL auto_increment,
  `type` varchar(35) NOT NULL,
  `name` varchar(60) NOT NULL,
  `LD_var` varchar(35) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(25) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`type_nr`),
  KEY `type` (`type`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_type_insurance`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_type_localization`
--

CREATE TABLE IF NOT EXISTS `care_type_localization` (
  `nr` tinyint(3) unsigned NOT NULL auto_increment,
  `category` varchar(35) NOT NULL,
  `name` varchar(35) NOT NULL,
  `LD_var` varchar(35) NOT NULL,
  `short_code` char(1) NOT NULL,
  `LD_var_short_code` varchar(25) NOT NULL,
  `description` varchar(255) NOT NULL,
  `hide_from` varchar(255) NOT NULL default '0',
  `status` varchar(25) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_type_localization`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_type_location`
--

CREATE TABLE IF NOT EXISTS `care_type_location` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `type` varchar(35) NOT NULL,
  `name` varchar(35) NOT NULL,
  `LD_var` varchar(35) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(25) NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_type_location`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_type_measurement`
--

CREATE TABLE IF NOT EXISTS `care_type_measurement` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `type` varchar(35) NOT NULL,
  `name` varchar(35) NOT NULL,
  `LD_var` varchar(35) NOT NULL,
  `status` varchar(25) NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_type_measurement`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_type_notes`
--

CREATE TABLE IF NOT EXISTS `care_type_notes` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `type` varchar(35) NOT NULL,
  `name` varchar(35) NOT NULL,
  `LD_var` varchar(35) NOT NULL,
  `sort_nr` smallint(6) NOT NULL default '0',
  `status` varchar(25) NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  UNIQUE KEY `type` (`type`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_type_notes`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_type_outcome`
--

CREATE TABLE IF NOT EXISTS `care_type_outcome` (
  `nr` smallint(2) unsigned NOT NULL auto_increment,
  `group_nr` tinyint(3) unsigned NOT NULL default '0',
  `type` varchar(35) NOT NULL,
  `name` varchar(35) NOT NULL,
  `LD_var` varchar(35) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(25) NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_type_outcome`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_type_perineum`
--

CREATE TABLE IF NOT EXISTS `care_type_perineum` (
  `nr` smallint(2) unsigned NOT NULL auto_increment,
  `id` varchar(35) NOT NULL,
  `name` varchar(35) NOT NULL,
  `LD_var` varchar(35) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(25) NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_type_perineum`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_type_prescription`
--

CREATE TABLE IF NOT EXISTS `care_type_prescription` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `type` varchar(35) NOT NULL,
  `name` varchar(35) NOT NULL,
  `LD_var` varchar(35) NOT NULL,
  `status` varchar(25) NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_type_prescription`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_type_room`
--

CREATE TABLE IF NOT EXISTS `care_type_room` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `type` varchar(35) NOT NULL,
  `name` varchar(35) NOT NULL,
  `LD_var` varchar(35) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(25) NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_type_room`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_type_test`
--

CREATE TABLE IF NOT EXISTS `care_type_test` (
  `type_nr` smallint(5) unsigned NOT NULL auto_increment,
  `type` varchar(35) NOT NULL,
  `name` varchar(35) NOT NULL,
  `LD_var` varchar(35) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(25) NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`type_nr`),
  KEY `type` (`type`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_type_test`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_type_time`
--

CREATE TABLE IF NOT EXISTS `care_type_time` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `type` varchar(35) NOT NULL,
  `name` varchar(35) NOT NULL,
  `LD_var` varchar(35) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(25) NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  KEY `type` (`type`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_type_time`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_type_unit_measurement`
--

CREATE TABLE IF NOT EXISTS `care_type_unit_measurement` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `type` varchar(35) NOT NULL,
  `name` varchar(35) NOT NULL,
  `LD_var` varchar(35) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(25) NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  KEY `type` (`type`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_type_unit_measurement`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_unit_measurement`
--

CREATE TABLE IF NOT EXISTS `care_unit_measurement` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `unit_type_nr` smallint(2) unsigned NOT NULL default '0',
  `id` varchar(15) NOT NULL,
  `name` varchar(35) NOT NULL,
  `LD_var` varchar(35) NOT NULL,
  `sytem` varchar(35) NOT NULL,
  `use_frequency` bigint(20) default NULL,
  `status` varchar(25) NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_unit_measurement`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_users`
--

CREATE TABLE IF NOT EXISTS `care_users` (
  `name` varchar(60) NOT NULL,
  `login_id` varchar(35) NOT NULL,
  `password` varchar(255)  default NULL,
  `personell_nr` int(10) unsigned NOT NULL default '0',
  `lockflag` tinyint(3) unsigned default '0',
  `permission` text NOT NULL,
  `exc` tinyint(1) NOT NULL default '0',
  `s_date` date NOT NULL default '0000-00-00',
  `s_time` time NOT NULL default '00:00:00',
  `expire_date` date NOT NULL default '0000-00-00',
  `expire_time` time NOT NULL default '00:00:00',
  `dept_nr` text NOT NULL COMMENT 'the department in which the user is allowed to enter / view',
  `user_role` tinyint(4) NOT NULL default '0',
  `status` varchar(15) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`login_id`),
  KEY `login_id` (`login_id`),
  KEY `user_role` (`user_role`)
) ENGINE=InnoDB;

--
-- Dumping data for table `care_users`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_user_roles`
--

CREATE TABLE IF NOT EXISTS `care_user_roles` (
  `id` int(11) NOT NULL auto_increment,
  `role_name` varchar(50) NOT NULL default 'no_name',
  `permission` text ,
  `history` text ,
  `modify_id` varchar(35) NOT NULL,
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(35) NOT NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_user_roles`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_version`
--

CREATE TABLE IF NOT EXISTS `care_version` (
  `name` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `build` varchar(5) NOT NULL,
  `date` date NOT NULL default '0000-00-00',
  `time` time NOT NULL default '00:00:00',
  `releaser` varchar(30) NOT NULL
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_version`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_ward`
--

CREATE TABLE IF NOT EXISTS `care_ward` (
  `nr` smallint(5) unsigned NOT NULL auto_increment,
  `ward_id` varchar(35) NOT NULL,
  `name` varchar(35) NOT NULL,
  `is_temp_closed` tinyint(1) NOT NULL default '0',
  `date_create` date NOT NULL default '0000-00-00',
  `date_close` date NOT NULL default '0000-00-00',
  `description` text ,
  `info` tinytext ,
  `dept_nr` smallint(5) unsigned NOT NULL default '0',
  `room_nr_start` smallint(6) NOT NULL default '0',
  `room_nr_end` smallint(6) NOT NULL default '0',
  `roomprefix` varchar(4)  default NULL,
  `status` varchar(25) NOT NULL,
  `history` text NOT NULL,
  `modify_id` varchar(25) NOT NULL default '0',
  `modify_time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `create_id` varchar(25) NOT NULL default '0',
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  KEY `ward_id` (`ward_id`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_ward`
--


-- --------------------------------------------------------

--
-- Table structure for table `care_yellow_paper`
--

CREATE TABLE IF NOT EXISTS `care_yellow_paper` (
  `encounter_nr` bigint(20) NOT NULL,
  `personell_name` varchar(20)  default NULL,
  `location_id` varchar(20)  default NULL,
  `history` text ,
  `create_id` varchar(20)  default NULL,
  `create_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  `sunto_anamnestico` text ,
  `stato_presente` text ,
  `altezza` double(15,3) default NULL,
  `peso` double(15,3) default NULL,
  `norm` varchar(20)  default NULL,
  `dati_urine` varchar(20)  default NULL,
  `dati_sangue` varchar(20)  default NULL,
  `dati_altro` varchar(20)  default NULL,
  `diagnosi` text ,
  `terapia` text ,
  `malattie_ereditarie` text ,
  `padre` text ,
  `madre` text ,
  `fratelli` text ,
  `coniuge` text ,
  `figli` text ,
  `paesi_esteri` text ,
  `abitazione` text ,
  `lavoro_pregresso` text ,
  `lavoro_presente` text ,
  `lavoro_attuale` text ,
  `ambiente_lavoro` text ,
  `gas_lavoro` text ,
  `tossiche_lavoro` text ,
  `conviventi` text ,
  `prematuro` varchar(4)  default NULL,
  `eutocico` varchar(4)  default NULL,
  `fisiologici_normali` varchar(4)  default NULL,
  `fisiologici_tardivi` varchar(4)  default NULL,
  `mestruazione` text ,
  `gravidanze` text ,
  `militare` text ,
  `alcolici` varchar(20)  default NULL,
  `caffe` varchar(20)  default NULL,
  `fumo` varchar(20)  default NULL,
  `droghe` varchar(20)  default NULL,
  `sete` varchar(20)  default NULL,
  `alvo` varchar(20)  default NULL,
  `diuresi` varchar(20)  default NULL,
  `anamnesi_remota` text ,
  `anamnesi_prossima` text ,
  `nr` bigint(20) NOT NULL auto_increment,
  `modify_id` text ,
  `modify_time` timestamp NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`nr`),
  UNIQUE KEY `nr` (`nr`)
) ENGINE=InnoDB ;

--
-- Dumping data for table `care_yellow_paper`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `care_encounter_prescription_sub`
--
ALTER TABLE `care_encounter_prescription_sub`
  ADD CONSTRAINT `care_encounter_prescription_sub_fk` FOREIGN KEY (`prescription_nr`) REFERENCES `care_encounter_prescription` (`nr`) ON DELETE CASCADE ON UPDATE CASCADE;
  
 
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

INSERT INTO care_classif_neonatal VALUES (1, 'jaundice', 'Neonatal jaundice', 'LDNeonatalJaundice', NULL, '', '', 20030807125731, '', 00000000000000);
INSERT INTO care_classif_neonatal VALUES (2, 'x_transfusion', 'Exchange transfusion', 'LDExchangeTransfusion', NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_classif_neonatal VALUES (3, 'photo_therapy', 'Photo therapy', 'LDPhotoTherapy', NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_classif_neonatal VALUES (4, 'h_i_encep', 'Hypoxic ischaemic encephalopathy', 'LDH_I_Encephalopathy', NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_classif_neonatal VALUES (5, 'parenteral', 'Parenteral nutrition', 'LDParenteralNutrition', NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_classif_neonatal VALUES (6, 'vent_support', 'Ventilatory support', 'LDVentilatorySupport', NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_classif_neonatal VALUES (7, 'oxygen_therapy', 'Oxygen therapy', 'LDOxygenTherapy', NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_classif_neonatal VALUES (8, 'cpap', 'CPAP', 'LDCPAP', 'Continuous positive airway pressure', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_classif_neonatal VALUES (9, 'congenital_abnormality', 'Congenital abnormality', 'LDCongenitalAbnormality', NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_classif_neonatal VALUES (10, 'congenital_infection', 'Congenital infection', 'LDCongenitalInfection', NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_classif_neonatal VALUES (11, 'acquired_infection', 'Acquired infection', 'LDAcquiredInfection', NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_classif_neonatal VALUES (12, 'gbs_infection', 'GBS infection', 'LDGBSInfection', 'Group B Strep Infection', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_classif_neonatal VALUES (13, 'rds', 'Resp Distress Syndrome', 'LDRespDistressSyndrome', NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_classif_neonatal VALUES (14, 'blood_transfusion', 'Blood transfusion', 'LDBloodTransfusion', NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_classif_neonatal VALUES (15, 'antibiotic_therapy', 'Antibiotic therapy', 'LDAntibioticTherapy', NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_classif_neonatal VALUES (16, 'necrotising_enterocolitis', 'Necrotising enterocolitis', 'LDNecrotisingEnterocolitis', NULL, '', '', 20030807191727, '', 00000000000000);

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
INSERT INTO care_config_global VALUES ('mascot_hide', '', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('mascot_style', 'default', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('gui_frame_left_nav_width', '150', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('gui_frame_left_nav_border', '1', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('news_fotos_path', 'uploads/photos/news/', '', '', '', '', 00000000000000, '', 00000000000000);
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
INSERT INTO care_config_global VALUES ('person_foto_path', 'uploads/photos/registration', '', '', '', '', 00000000000000, '', 00000000000000);
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
INSERT INTO care_config_global VALUES ('personell_nr_adder', '100000', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('notes_preview_maxlen', '120', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_id_nr_init', '10000000', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('personell_nr_init', '100000', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('encounter_nr_init', '000000', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('encounter_nr_fullyear_prepend', '1', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('theme_mascot', 'default', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('pagin_address_list_max_block_rows', '20', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('pagin_address_search_max_block_rows', '25', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('pagin_insurance_list_max_block_rows', '30', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('pagin_insurance_search_max_block_rows', '25', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('pagin_personell_search_max_block_rows', '20', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('pagin_person_search_max_block_rows', '20', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('pagin_personell_list_max_block_rows', '20', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('pagin_patient_search_max_block_rows', '20', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('pagin_or_patient_search_max_block_rows', '5', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('timeout_inactive', '0', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('timeout_time', '001500', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_title_hide', '0', NULL, 'normal', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_bloodgroup_hide', '0', NULL, 'normal', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_civilstatus_hide', '0', NULL, 'normal', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_insurance_hide', '0', NULL, 'normal', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_other_his_nr_hide', '0', NULL, 'normal', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_config_global VALUES ('person_insurance_1_nr_hide', '1', NULL, '', '', '', 00000000000000, '', '0000-00-00 00:00:00');

--
-- Dumping data for table care_config_user
--

INSERT INTO care_config_user VALUES ('default', 'a:19:{s:4:"mask";s:1:"1";s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:0:"";s:8:"bversion";s:0:"";s:2:"ip";s:0:"";s:3:"cid";s:0:"";s:5:"dhtml";s:1:"1";s:4:"lang";s:0:"";}', 'default values', 'normal', 'installed', 'auto-installer', 0, 'auto-installer', 0);

--
-- Dumping data for table care_currency
--

INSERT INTO care_currency VALUES (1, 'S$', 'SG Dollar', 'Singapore Dollar (ISO = SGD)', 'main', '', 20100905190000, 'Ap Muthu', 20100905180000);
INSERT INTO care_currency VALUES (2, '$', 'US Dollar', 'US Dollar (ISO = USD)', '', '', 20100905190000, 'Ap Muthu', 20100905180000);
INSERT INTO care_currency VALUES (2, '€', 'Euro', 'European currency (ISO = EUR)', '', 'Elpidio Latorilla', 20030802190637, '', 20021126200534);
INSERT INTO care_currency VALUES (3, '£', 'Pound', 'GB British Pound (ISO = GBP)', '', '', 20030213173107, '', 20020816230349);
INSERT INTO care_currency VALUES (4, 'R', 'Rand', 'South African Rand (ISO = ZAR)', '', '', 20030802190637, 'Elpidio Latorilla', 20020817171805);
INSERT INTO care_currency VALUES (5, 'Rs', 'Rupees', 'Indian Rupees (ISO = INR)', '', '', 20030213173059, 'Elpidio Latorilla', 20020920234306);

--
-- Dumping data for table care_department
--

INSERT INTO care_department VALUES (1, 'pr', '2', 'Public Relations', 'PR', 'Press Relations', 'LDPressRelations', '', '0', '0', '1', '1', '0', '1', '0', '0', '', '', '0', '0', NULL, '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (2, 'cafe', '2', 'Cafeteria', 'Cafe', 'Canteen', 'LDCafeteria', '', '0', '0', '1', '1', '0', '1', '0', '0', '', '', '0', '0', NULL, '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (3, 'general_surgery', '1', 'General Surgery', 'General', 'General', 'LDGeneralSurgery', '', '1', '1', '1', '1', '1', '1', '0', '0', '8.30 - 21.00', '12.30 - 15.00 , 19.00 - 21.00', '0', '0', '', '', '', '', '', '', '', 20030828114327, '', 00000000000000, '','');
INSERT INTO care_department VALUES (4, 'emergency_surgery', '1', 'Emergency Surgery', 'Emergency', '', 'LDEmergencySurgery', '', '1', '1', '1', '1', '1', '1', '0', '0', '', '12.30 - 15.00 , 19.00 - 21.00', '0', '0', NULL, '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (5, 'plastic_surgery', '1', 'Plastic Surgery', 'Plastic', 'Aesthetic Surgery', 'LDPlasticSurgery', '', '1', '1', '1', '1', '1', '1', '0', '0', '', '12.30 - 15.00 , 19.00 - 21.00', '0', '0', NULL, '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (6, 'ent', '1', 'Ear-Nose-Throat', 'ENT', 'HNO', 'LDEarNoseThroat', 'Ear-Nose-Throat, in german Hals-Nasen-Ohren. The department with  very old traditions that date back to the early beginnings of premodern medicine.', '1', '1', '1', '1', '1', '1', '0', '0', '', '12.30 - 15.00 , 19.00 - 21.00', '0', '0', NULL, '', 'kope akjdielj asdlkasdf', '', '', 'Update: 2003-08-13 23:24:16 Elpidio Latorilla\r\nUpdate: 2003-08-13 23:25:27 Elpidio Latorilla\r\nUpdate: 2003-08-13 23:29:05 Elpidio Latorilla\r\nUpdate: 2003-08-13 23:30:21 Elpidio Latorilla\r\nUpdate: 2003-08-13 23:31:52 Elpidio Latorilla\r\nUpdate: 2003-08-13 23:34:08 Elpidio Latorilla\r\n', 'Elpidio Latorilla', 20031019155346, '', 00000000000000, '','');
INSERT INTO care_department VALUES (7, 'opthalmology', '1', 'Opthalmology', 'Opthalmology', 'Eye Department', 'LDOpthalmology', '', '1', '1', '1', '1', '1', '1', '0', '0', '', '12.30 - 15.00 , 19.00 - 21.00', '0', '0', NULL, '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (8, 'pathology', '1', 'Pathology', 'Pathology', 'Patho', 'LDPathology', '', '0', '0', '1', '1', '0', '1', '0', '0', '', '12.30 - 15.00 , 19.00 - 21.00', '0', '0', '', '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (9, 'ob_gyn', '1', 'Ob-Gynecology', 'Ob-Gyne', 'Gyn', 'LDObGynecology', '', '1', '1', '1', '1', '1', '1', '0', '0', '', '12.30 - 15.00 , 19.00 - 21.00', '0', '0', NULL, '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
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
INSERT INTO care_department VALUES (20, 'oncology', '1', 'Oncology', 'Oncology', 'Cancer Department', 'LDOncology', '', '1', '1', '1', '1', '1', '1', '0', '11', '', '12.30 - 15.00 , 19.00 - 21.00', '0', '0', NULL, '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (21, 'neonatal', '1', 'Neonatal', 'Neonatal', 'Newborn Department', 'LDNeonatal', '', '1', '1', '1', '1', '1', '1', '1', '9', '', '12.30 - 15.00 , 19.00 - 21.00', '0', '0', NULL, '343', '', '', '', 'Update: 2003-08-13 22:32:07 Elpidio Latorilla\nUpdate: 2003-08-13 22:33:10 Elpidio Latorilla\nUpdate: 2003-08-13 22:43:39 Elpidio Latorilla\nUpdate: 2003-08-13 22:43:59 Elpidio Latorilla\nUpdate: 2003-08-13 22:44:19 Elpidio Latorilla\n', 'Elpidio Latorilla', 20030813224419, '', 00000000000000, '','');
INSERT INTO care_department VALUES (22, 'central_lab', '1', 'Central Laboratory', 'Central Lab', 'General Lab', 'LDCentralLaboratory', '', '0', '0', '1', '1', '0', '1', '0', '0', '', '12.30 - 15.00 , 19.00 - 21.00', '0', '0', '', '', 'kdkdododospdfjdasljfda\r\nasdflasdjf\r\nasdfklasdjflasdjf', '', '', 'Update: 2003-08-13 23:12:30 Elpidio Latorilla\r\nUpdate: 2003-08-13 23:14:59 Elpidio Latorilla\r\nUpdate: 2003-08-13 23:15:28 Elpidio Latorilla\r\n', 'Elpidio Latorilla', 20030828114243, '', 00000000000000, '','');
INSERT INTO care_department VALUES (23, 'serological_lab', '1', 'Serological Laboratory', 'Serological Lab', 'Serum Lab', 'LDSerologicalLaboratory', '', '0', '1', '1', '1', '0', '1', '1', '22', '', '12.30 - 15.00 , 19.00 - 21.00', '0', '0', '', '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (24, 'chemical_lab', '1', 'Chemical Laboratory', 'Chemical Lab', 'Chem Lab', 'LDChemicalLaboratory', '', '0', '1', '1', '1', '0', '1', '1', '22', '', '12.30 - 15.00 , 19.00 - 21.00', '0', '0', '', '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (25, 'bacteriological_lab', '1', 'Bacteriological Laboratory', 'Bacteriological Lab', 'Bacteria Lab', 'LDBacteriologicalLaboratory', '', '0', '1', '1', '1', '0', '1', '1', '22', '', '12.30 - 15.00 , 19.00 - 21.00', '0', '0', '', '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (26, 'tech', '2', 'Technical Maintenance', 'Tech', 'Technical Support', 'LDTechnicalMaintenance', '', '0', '0', '1', '1', '0', '1', '0', '0', '', '', '0', '0', '', '', '', 'jpg', '', 'Update: 2003-08-10 23:42:30 Elpidio Latorilla\n', 'Elpidio Latorilla', 20030810234230, '', 00000000000000, '','');
INSERT INTO care_department VALUES (27, 'it', '2', 'IT Department', 'IT', 'EDP', 'LDITDepartment', '', '0', '0', '1', '1', '0', '1', '0', '0', '', '', '0', '0', '', '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (28, 'management', '2', 'Management', 'Management', 'Busines Administration', 'LDManagement', '', '0', '0', '1', '1', '0', '1', '0', '0', '', '', '0', '0', '', '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (29, 'exhibition', '3', 'Exhibitions', 'Exhibit', 'Showcases', 'LDExhibitions', '', '0', '0', '1', '1', '1', '1', '0', '0', '', '', '0', '0', NULL, '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (30, 'edu', '3', 'Education', 'Edu', 'Training', 'LDEducation', 'Education news bulletin of the hospital.', '0', '0', '1', '1', '0', '1', '0', '0', '', '', '0', '0', '', '', '', '', '', 'Update: 2003-08-13 22:44:45 Elpidio Latorilla\nUpdate: 2003-08-13 23:00:37 Elpidio Latorilla\n', 'Elpidio Latorilla', 20030813230037, '', 00000000000000, '','');
INSERT INTO care_department VALUES (31, 'study', '3', 'Studies', 'Studies', 'Advance studies or on-the-job training', 'LDStudies', '', '0', '0', '1', '1', '1', '1', '0', '0', '', '', '0', '0', NULL, '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (32, 'health_tip', '3', 'Health Tips', 'Tips', 'Health Information', 'LDHealthTips', '', '0', '0', '1', '1', '1', '1', '0', '0', '', '', '0', '0', NULL, '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (33, 'admission', '2', 'Admission', 'Admit', 'Admission information', 'LDAdmission', '', '0', '0', '1', '1', '1', '0', '1', '0', '', '', '0', '0', NULL, '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (34, 'news_headline', '3', 'Headline', 'News head', 'Major news', 'LDHeadline', '', '0', '0', '1', '1', '1', '1', '0', '0', '', '', '0', '0', NULL, '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (35, 'cafenews', '3', 'Cafe News', 'Cafe news', 'Cafeteria news', 'LDCafeNews', '', '0', '0', '1', '1', '1', '0', '0', '0', '', '', '0', '0', NULL, '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (36, 'nursing', '3', 'Nursing', 'Nursing', 'Nursing care', 'LDNursing', '', '1', '1', '1', '1', '1', '1', '1', '0', '', '', '0', '0', NULL, '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (37, 'doctors', '3', 'Doctors', 'Doctors', 'Medical personell', 'LDDoctors', '', '0', '0', '1', '1', '1', '1', '0', '0', '', '', '0', '0', NULL, '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
INSERT INTO care_department VALUES (38, 'pharmacy', '2', 'Pharmacy', 'Pharma', 'Drugstore', 'LDPharmacy', '', '0', '0', '1', '1', '1', '1', '0', '0', '', '', '0', '0', NULL, '', '', '', '', '', '', 00000000000000, '', 00000000000000, '','');
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


INSERT INTO care_menu_main VALUES ('1', '1', 'Home', '','LDHome', 'main/startframe.php', '1', '', '', 20030922232015, 00000000000000);
INSERT INTO care_menu_main VALUES ('2', '5', 'Patient', '', 'LDPatient', 'modules/registration_admission/patient_register_pass.php', '1', '', '', 20030922232015, 00000000000000);
INSERT INTO care_menu_main VALUES ('3', '10', 'Admission', '', 'LDAdmission', 'modules/registration_admission/aufnahme_pass.php', '1', '', '', 20030922232015, 00000000000000);
INSERT INTO care_menu_main VALUES ('4', '15', 'Ambulatory', '', 'LDAmbulatory', 'modules/ambulatory/ambulatory.php', '1', '', '', 20030922232015, 00000000000000);
INSERT INTO care_menu_main VALUES ('5', '20', 'Medocs', '', 'LDMedocs', 'modules/medocs/medocs_pass.php', '1', '', '', 20030922232015, 00000000000000);
INSERT INTO care_menu_main VALUES ('6', '25', 'Doctors', '', 'LDDoctors', 'modules/doctors/doctors.php', '1', '', '', 20030922232015, 00000000000000);
INSERT INTO care_menu_main VALUES ('7', '35', 'Nursing',  '','LDNursing', 'modules/nursing/nursing.php', '1', '', '', 20030922232015, 00000000000000);
INSERT INTO care_menu_main VALUES ('8', '40', 'OR', 'LDOR', '', 'main/op-doku.php', '1', '', '', 20030922232015, 00000000000000);
INSERT INTO care_menu_main VALUES ('9', '45', 'Laboratories', '', 'LDLabs', 'modules/laboratory/labor.php', '1', '', '', 20030922232015, 00000000000000);
INSERT INTO care_menu_main VALUES ('10', '50', 'Radiology', '', 'LDRadiology', 'modules/radiology/radiolog.php', '1', '', '', 20030922232015, 00000000000000);
INSERT INTO care_menu_main VALUES ('11', '55', 'Pharmacy', '', 'LDPharmacy', 'modules/pharmacy/apotheke.php', '1', '', '', 20030922232015, 00000000000000);
INSERT INTO care_menu_main VALUES ('12', '60', 'Medical Depot', '', 'LDMedDepot', 'modules/med_depot/medlager.php', '1', '', '', 20030922232015, 00000000000000);
INSERT INTO care_menu_main VALUES ('13', '65', 'Directory', '', 'LDDirectory', 'modules/phone_directory/phone.php', '1', '', '', 20030922232015, 00000000000000);
INSERT INTO care_menu_main VALUES ('14', '70', 'Tech Support', '', 'LDTechSupport', 'modules/tech/technik.php', '1', '', '', 20030922232015, 00000000000000);
INSERT INTO care_menu_main VALUES ('15', '72', 'System Admin', '', 'LDEDP', 'modules/system_admin/edv.php', '1', '', '', 20030922232015, 00000000000000);
INSERT INTO care_menu_main VALUES ('16', '75', 'Intranet Email', '', 'LDIntraEmail', 'modules/intranet_email/intra-email-pass.php', '1', '', '', 20030922232015, 00000000000000);
INSERT INTO care_menu_main VALUES ('18', '85', 'Special Tools', '', 'LDSpecials', 'main/spediens.php', '1', '', '', 20030922232015, 00000000000000);
INSERT INTO care_menu_main VALUES ('19', '90', 'Login', '', 'LDLogin', 'main/login.php', '1', '', '', 20030922232015, 00000000000000);
INSERT INTO care_menu_main VALUES ('20', '7', 'Appointments',  '','LDAppointments', 'modules/appointment_scheduler/appt_main_pass.php', '1', '',  '', 20030922232015, 20030405000145);

--
-- Dumping data for table `care_menu_sub`
--


INSERT INTO care_menu_sub  VALUES ('3', '0', '2', '0', '', '', '', '', '../gui/img/common/default/new_group.gif', '../gui/img/common/default/new_group.gif', '1', '', '', '', '0001-01-01 00:00:00');
INSERT INTO care_menu_sub  VALUES ('70', '0', '7', '0', '', '', '', '', '../gui/img/common/default/nurse.gif', '../gui/img/common/default/nurse.gif', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO care_menu_sub  VALUES ('20', '0', '1', '0', '', '', '', '', '../gui/img/common/default/articles.gif', '../gui/img/common/default/home.gif', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO care_menu_sub  VALUES ('30', '0', '20', '0', '', '', '', '', '../gui/img/common/default/calendar.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO care_menu_sub  VALUES ('5', '2', '2', '1', 'Admission', 'LDAdmission', '../modules/registration_admission/aufnahme_pass.php', '', '../gui/img/common/default/bn.gif', '../gui/img/common/default/bn.gif', '1', '', '', '', '0001-01-01 00:00:00');
INSERT INTO care_menu_sub  VALUES ('1', '1', '2', '1', 'Registration', 'LDRegistration', '../modules/registration_admission/patient_register_pass.php', '&target=entry', '../gui/img/common/default/post_discussion.gif', '', '1', '', '', '', '0001-01-01 00:00:00');
INSERT INTO care_menu_sub  VALUES ('130', '1', '2', '1', 'Search', 'LDSearch', '../modules/registration_admission/patient_register_pass.php', '&target=search', '../gui/img/common/default/findnew.gif', '../gui/img/common/default/findnew.gif', '1', '', '', '', '0001-01-01 00:00:00');
INSERT INTO care_menu_sub  VALUES ('135', '1', '2', '1', 'Archive', 'LDArchive', '../modules/registration_admission/patient_register_pass.php', '&target=archiv', '', '', '1', '', '', '', '0001-01-01 00:00:00');
INSERT INTO care_menu_sub  VALUES ('140', '5', '2', '2', 'Search', 'LDSearch', '../modules/registration_admission/aufnahme_pass.php', '&target=search', '../gui/img/common/default/findnew.gif', '../gui/img/common/default/findnew.gif', '1', '', '', '', '0001-01-01 00:00:00');
INSERT INTO care_menu_sub  VALUES ('145', '6', '2', '2', 'Archive', 'LDArchive', '../modules/registration_admission/aufnahme_pass.php', '&target=archiv', '', '', '1', '', '', '', '0001-01-01 00:00:00');
INSERT INTO care_menu_sub  VALUES ('71', '1', '7', '1', 'Wards', 'LDWards', '../modules/nursing/nursing.php', '', '../gui/img/common/default/bul_arrowgrnsm.gif', '../gui/img/common/default/bul_arrowgrnsm.gif', '', '', '[station]', '', '0001-01-01 00:00:00');
INSERT INTO care_menu_sub  VALUES ('155', '1', '3', '1', 'Archive', 'LDArchive', '../modules/registration_admission/aufnahme_pass.php', '&target=archiv', '', '', '1', '', '', '', '0001-01-01 00:00:00');
INSERT INTO care_menu_sub  VALUES ('40', '0', '3', '0', '', '', '', '', '../gui/img/common/default/bn.gif', '../gui/img/common/default/bn.gif', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO care_menu_sub  VALUES ('165', '0', '13', '0', '', '', '', '', '../gui/img/common/default/violet_phone.gif', '../gui/img/common/default/violet_phone.gif', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO care_menu_sub  VALUES ('7', '3', '7', '1', 'Search', 'LDSearch', '../modules/nursing/nursing-patient-such-start.php', '', '../gui/img/common/default/findnew.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO care_menu_sub  VALUES ('72', '2', '7', '1', 'Quick view', 'LDQuickView', '../modules/nursing/nursing-fastview.php', '', '../gui/img/common/default/eye_s.gif', '', '1', '', '', '', '0001-01-01 00:00:00');
INSERT INTO care_menu_sub  VALUES ('50', '0', '4', '0', '', '', '', '', '../gui/img/common/default/disc_unrd.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO care_menu_sub  VALUES ('120', '0', '6', '0', '', '', '', '', '../gui/img/common/default/forums.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO care_menu_sub  VALUES ('160', '0', '17', '0', '', '', '', '', '../gui/img/common/default/c-mail.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO care_menu_sub  VALUES ('190', '0', '16', '0', '', '', '', '', '../gui/img/common/default/bubble2.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO care_menu_sub  VALUES ('195', '0', '10', '0', '', '', '', '', '../gui/img/common/default/torso.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO care_menu_sub  VALUES ('200', '0', '18', '0', '', '', '', '', '../gui/img/common/default/settings_tree.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO care_menu_sub  VALUES ('205', '0', '11', '0', '', '', '', '', '../gui/img/common/default/add.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO care_menu_sub  VALUES ('160', '0', '19', '0', '', '', '', '', '../gui/img/common/default/padlock.gif', '../gui/img/common/default/bul_arrowgrnsm.gif', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO care_menu_sub  VALUES ('215', '0', '15', '0', '', '', '', '', '../gui/img/common/default/sections.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO care_menu_sub  VALUES ('220', '0', '12', '0', '', '', '', '', '../gui/img/common/default/storage.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO care_menu_sub  VALUES ('225', '0', '8', '0', '', '', '', '', '../gui/img/common/default/people_search_online.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO care_menu_sub  VALUES ('230', '0', '9', '0', '', '', '', '', '../gui/img/common/default/chart.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO care_menu_sub  VALUES ('235', '0', '14', '0', '', '', '', '', '../gui/img/common/default/settings_tree.gif', '', '', '', '', '', '0001-01-01 00:00:00');

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
INSERT INTO care_registry VALUES ('edp', 'modules/admin/edv.php', 'modules/news/newscolumns.php', '', '', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_registry VALUES ('pharmacy', 'modules/pharmacy/apotheke.php', 'modules/news/newscolumns.php', '', '', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_registry VALUES ('pr', 'modules/news/start_page.php', 'modules/news/start_page.php', 'modules/news/headline-edit.php', 'modules/news/headline-read.php', 'modules/news/editor-pass.php', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_registry VALUES ('cafe', 'modules/cafeteria/cafenews.php', 'modules/cafeteria/cafenews.php', 'modules/cafenews/cafenews-edit.php', 'modules/cafenews/cafenews-read.php', 'modules/cafenews/cafenews-edit-pass.php', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_registry VALUES ('main_start', 'modules/news/start_page.php', 'modules/news/start_page.php', 'modules/news/headline-edit-select-art.php', 'modules/news/headline-read.php', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_registry VALUES ('it', 'modules/system_admin/edv.php', 'modules/news/newscolumns.php', 'modules/news/editor-4plus1-select-art.php', 'modules/news/editor-4plus1-read.php', '', '', '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_registry VALUES ('admission_module', 'modules/admission/aufnahme_start.php', '', '', '', 'modules/admission/aufnahme_pass.php', '', '', '', 00000000000000, '', 00000000000000);

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

INSERT INTO care_room VALUES ('1', '2', '2003-04-27', '0000-00-00', '0', 1, 0, 0, '1', '', NULL, '', '', '', 20030427175459, '', 20030427175459);
INSERT INTO care_room VALUES ('2', '2', '2003-04-27', '0000-00-00', '0', 2, 0, 0, '1', '', NULL, '', '', '', 20030427175704, '', 20030427175631);
INSERT INTO care_room VALUES ('3', '2', '2003-04-27', '0000-00-00', '0', 3, 0, 0, '1', '', NULL, '', '', '', 20030427175813, '', 20030427175727);
INSERT INTO care_room VALUES ('4', '2', '2003-04-27', '0000-00-00', '0', 4, 0, 0, '1', '', NULL, '', '', '', 20030427180021, '', 20030427175846);
INSERT INTO care_room VALUES ('5', '2', '2003-04-27', '0000-00-00', '0', 5, 0, 0, '1', '', NULL, '', '', '', 20030427180132, '', 20030427175927);
INSERT INTO care_room VALUES ('6', '2', '2003-04-27', '0000-00-00', '0', 6, 0, 0, '1', '', NULL, '', '', '', 20030427180122, '', 20030427180105);
INSERT INTO care_room VALUES ('7', '2', '2003-04-27', '0000-00-00', '0', 7, 0, 0, '1', '', NULL, '', '', '', 20030427180310, '', 20030427180310);
INSERT INTO care_room VALUES ('8', '2', '2003-04-27', '0000-00-00', '0', 8, 0, 0, '1', '', NULL, '', '', '', 20030427180350, '', 20030427180350);
INSERT INTO care_room VALUES ('9', '2', '2003-04-27', '0000-00-00', '0', 9, 0, 0, '1', '', NULL, '', '', '', 20030427180433, '', 20030427180433);
INSERT INTO care_room VALUES ('10', '2', '2003-04-27', '0000-00-00', '0', 10, 0, 0, '1', '', NULL, '', '', '', 20030427180503, '', 20030427180503);
INSERT INTO care_room VALUES ('11', '2', '2003-04-27', '0000-00-00', '0', 11, 0, 0, '1', '', NULL, '', '', '', 20030427180636, '', 20030427180636);
INSERT INTO care_room VALUES ('12', '2', '2003-04-27', '0000-00-00', '0', 12, 0, 0, '1', '', NULL, '', '', '', 20030427180759, '', 20030427180759);
INSERT INTO care_room VALUES ('13', '2', '2003-04-27', '0000-00-00', '0', 13, 0, 0, '1', '', NULL, '', '', '', 20030427180826, '', 20030427180826);
INSERT INTO care_room VALUES ('14', '2', '2003-04-27', '0000-00-00', '0', 14, 0, 0, '1', '', NULL, '', '', '', 20030427180852, '', 20030427180852);
INSERT INTO care_room VALUES ('15', '2', '2003-04-27', '0000-00-00', '0', 15, 0, 0, '1', '', NULL, '', '', '', 20030427180918, '', 20030427180918);

--
-- Dumping data for table care_test_param
--

INSERT INTO `care_test_param` (`nr`, `group_id`, `name`, `id`, `sort_nr`, `msr_unit`, `status`, `median`, `hi_bound`, `lo_bound`, `hi_critical`, `lo_critical`, `hi_toxic`, `lo_toxic`, `median_f`, `hi_bound_f`, `lo_bound_f`, `hi_critical_f`, `lo_critical_f`, `hi_toxic_f`, `lo_toxic_f`, `median_n`, `hi_bound_n`, `lo_bound_n`, `hi_critical_n`, `lo_critical_n`, `hi_toxic_n`, `lo_toxic_n`, `median_y`, `hi_bound_y`, `lo_bound_y`, `hi_critical_y`, `lo_critical_y`, `hi_toxic_y`, `lo_toxic_y`, `median_c`, `hi_bound_c`, `lo_bound_c`, `hi_critical_c`, `lo_critical_c`, `hi_toxic_c`, `lo_toxic_c`, `method`, `history`, `modify_id`, `modify_time`, `create_id`, `create_time`) VALUES
(1, 'priority', 'Quick', '_00q', 0, 'mm/s', '', '15', '', '', '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(2, 'priority', 'PTT', '_00ptt', 0, 'mm/s', '', '', '', '', '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(3, 'priority', 'Hb', '_00hb', 0, 'g/dl', '', '12', '', '', '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(4, 'priority', 'Hk', '_00hc', 0, '%', '', '36', '', '', '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(5, 'priority', 'Platelets', '_00pla', 0, 'c/cmm', '', '200000', '', '', '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(6, 'priority', 'RBC', '_00rbc', 0, 'mil/cmm', '', '4.5', '', '', '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(7, 'priority', 'WBC', '_00wbc', 0, 'c/ccm', '', '5000', '', '', '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(8, 'priority', 'Calcium', '_00ca', 0, 'mEq/ml', '', '', '', '', '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(9, 'priority', 'Sodium', '_00na', 0, 'mEq/ml', '', '20', '', '', '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(10, 'priority', 'Potassium', '_00k', 0, 'mEq/ml', '', '10', '', '', '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(11, 'priority', 'Blood sugar', '_00sug', 0, 'mg/dL', '', '', '', '', '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(12, 'clinical_chem', 'Alk. Ph.', '_0aph', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(13, 'clinical_chem', 'Alpha GT', '_0agt', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(14, 'clinical_chem', 'Ammonia', '_0amm', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(15, 'clinical_chem', 'Amylase', '_0amy', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(16, 'clinical_chem', 'Bili total', '_0bit', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(17, 'clinical_chem', 'Bili direct', '_0bid', 0, '', '', '', '', '', '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(18, 'clinical_chem', 'Calcium', '_0ca', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(19, 'clinical_chem', 'Chloride', '_0chl', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(20, 'clinical_chem', 'Chol', '_0cho', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(21, 'clinical_chem', 'Cholinesterase', '_0chol', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(22, 'clinical_chem', 'CKMB', '_0ccmb', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(23, 'clinical_chem', 'CPK', '_0cpc', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(24, 'clinical_chem', 'CRP', '_0crp', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(25, 'clinical_chem', 'Iron', '_0fe', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(26, 'clinical_chem', 'RBC', '_0rbc', 0, 'c/ccm', '', '', '', '', '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(27, 'clinical_chem', 'free HgB', '_0fhb', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(28, 'clinical_chem', 'GLDH', '_0gldh', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(29, 'clinical_chem', 'GOT', '_0got', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(30, 'clinical_chem', 'GPT', '_0gpt', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(31, 'clinical_chem', 'Uric acid', '_0ucid', 0, '', '', '', '', '', '', 'Update 2003-09-05 17', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(32, 'clinical_chem', 'Urea', '_0urea', 0, '', '', '', '', '', '', 'Update 2003-09-05 17', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(33, 'clinical_chem', 'HBDH', '_0hbdh', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(34, 'clinical_chem', 'HDL Chol', '_0hdlc', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(35, 'clinical_chem', 'Potassium', '_0pot', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(36, 'clinical_chem', 'Creatinine', '_0cre', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(37, 'clinical_chem', 'Copper', '_0co', 0, '', '', '', '', '', '', 'Update 2003-09-05 17', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(38, 'clinical_chem', 'Lactate i.P.', '_0lac', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(39, 'clinical_chem', 'LDH', '_0ldh', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(40, 'clinical_chem', 'LDL Chol', '_0ldlc', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(41, 'clinical_chem', 'Lipase', '_0lip', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(42, 'clinical_chem', 'Lipid Elpho', '_0lpid', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(43, 'clinical_chem', 'Magnesium', '_0mg', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(44, 'clinical_chem', 'Myoglobin', '_0myo', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(45, 'clinical_chem', 'Sodium', '_0na', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(46, 'clinical_chem', 'Osmolal.', '_0osm', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(47, 'clinical_chem', 'Phosphor', '_0pho', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(48, 'clinical_chem', 'Serum sugar', '_0glo', 0, 'mg/dL', '', '', '', '', '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(49, 'clinical_chem', 'Tri', '_0tri', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(50, 'clinical_chem', 'Troponin T', '_0tro', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(51, 'liquor', 'Liquor status', '_1stat', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(52, 'liquor', 'Liquor elpho', '_1elp', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(53, 'liquor', 'Oligoclonales IgG', '_1oli', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(54, 'liquor', 'Reiber Scheme', '_1sch', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(55, 'liquor', 'A1', '_1a1', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(56, 'coagulation', 'Fibrinolysis', '_2fiby', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(57, 'coagulation', 'Quick', '_2q', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(58, 'coagulation', 'PTT', '_2ptt', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(59, 'coagulation', 'PTZ', '_2ptz', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(60, 'coagulation', 'Fibrinogen', '_2fibg', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(61, 'coagulation', 'Sol.Fibr.mon.', '_2fibs', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(62, 'coagulation', 'FSP dimer', '_2fsp', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(63, 'coagulation', 'Thr.Coag.', '_2coag', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(64, 'coagulation', 'AT III', '_2at3', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(65, 'coagulation', 'Faktor VII', '_2f8', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(66, 'coagulation', 'APC Resistance', '_2apc', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(67, 'coagulation', 'Protein C', '_2prc', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(68, 'coagulation', 'Protein S', '_2prs', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(69, 'coagulation', 'Bleeding time', '_2bt', 0, 'ml/s', '', '', '', '', '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(70, 'hematology', 'Retikulocytes', '_3ret', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(71, 'hematology', 'Malaria', '_3mal', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(72, 'hematology', 'Hb Elpho', '_3hbe', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(73, 'hematology', 'HLA B 27', '_3hla', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(74, 'hematology', 'Platelets AB', '_3tab', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(75, 'hematology', 'WBC Phosp.', '_3wbp', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(76, 'blood_sugar', 'Blood sugar fasting', '_4bsf', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(77, 'blood_sugar', 'Blood sugar 9:00', '_4bs9', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(78, 'blood_sugar', 'Blood sugar p.prandial', '_4bsp', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(79, 'blood_sugar', 'Bl15:00', '_4bs15', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(80, 'blood_sugar', 'Blood sugar 1', '_4bs1', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(81, 'blood_sugar', 'Blood sugar 2', '_4bs2', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(82, 'blood_sugar', 'Glucose stress.', '_4glo', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(83, 'blood_sugar', 'Lactose stress', '_4lac', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(84, 'blood_sugar', 'HBA 1c', '_4hba', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(85, 'blood_sugar', 'Fructosamine', '_4fru', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(86, 'neonate', 'Neonate bilirubin', '_5bil', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(87, 'neonate', 'Cord bilirubin', '_5bilc', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(88, 'neonate', 'Bilirubin direct', '_5bild', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(89, 'neonate', 'Neonate sugar 1', '_5glo1', 0, 'mg/dL', '', '', '', '', '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(90, 'neonate', 'Neonate sugar 2', '_5glo2', 0, 'mg/DL', '', '30', '', '', '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(91, 'neonate', 'Reticulocytes', '_5ret', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(92, 'neonate', 'B1', '_5b1', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(93, 'proteins', 'Total proteins', '_6tot', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(94, 'proteins', 'Albumin', '_6alb', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(95, 'proteins', 'Elpho', '_6elp', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(96, 'proteins', 'Immune fixation', '_6imm', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(97, 'proteins', 'Beta2 Microglobulin.i.S', '_6b2', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(98, 'proteins', 'Immune globulin quant.', '_6img', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(99, 'proteins', 'IgE', '_6ige', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(100, 'proteins', 'Haptoglobin', '_6hap', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(101, 'proteins', 'Transferrin', '_6tra', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(102, 'proteins', 'Ferritin', '_6fer', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(103, 'proteins', 'Coeruloplasmin', '_6coe', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(104, 'proteins', 'Alpha 1 Antitrypsin', '_6alp', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(105, 'proteins', 'AFP Grav.', '_6afp', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(106, 'proteins', 'SSW:', '_6ssw', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(107, 'proteins', 'Alpha 1 Microglobulin', '_6mic', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(108, 'thyroid', 'T3', '_7t3', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(109, 'thyroid', 'Thyroxin/T4', '_7t4', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(110, 'thyroid', 'TSH basal', '_7tshb', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(111, 'thyroid', 'TSH stim.', '_7tshs', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(112, 'thyroid', 'TAB', '_7tab', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(113, 'thyroid', 'MAB', '_7mab', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(114, 'thyroid', 'TRAB', '_7trab', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(115, 'thyroid', 'Thyreoglobulin', '_7glob', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(116, 'thyroid', 'Thyroxinbind.Glob.', '_7thx', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(117, 'thyroid', 'free T3', '_7ft3', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(118, 'thyroid', 'free T4', '_7ft4', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(119, 'hormones', 'ACTH', '_8acth', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(120, 'hormones', 'Aldosteron', '_8ald', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(121, 'hormones', 'Calcitonin', '_8cal', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(122, 'hormones', 'Cortisol', '_8cor', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(123, 'hormones', 'Cortisol day', '_8dcor', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(124, 'hormones', 'FSH', '_8fsh', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(125, 'hormones', 'Gastrin', '_8gas', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(126, 'hormones', 'HCG', '_8hcg', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(127, 'hormones', 'Insulin', '_8ins', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(128, 'hormones', 'Catecholam.i.P.', '_8cat', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(129, 'hormones', 'LH', '_8lh', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(130, 'hormones', 'Ostriol', '_8osd', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(131, 'hormones', 'SSW:', '_8ssw', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(132, 'hormones', 'Parat hormone', '_8par', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(133, 'hormones', 'Progesteron', '_8prg', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(134, 'hormones', 'Prolactin I', '_8pr1', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(135, 'hormones', 'Prolactin II', '_8pr2', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(136, 'hormones', 'Renin', '_8ren', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(137, 'hormones', 'Serotonin', '_8ser', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(138, 'hormones', 'Somatomedin C', '_8som', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(139, 'hormones', 'Testosteron', '_8tes', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(140, 'hormones', 'C1', '_8c1', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(141, 'tumor_marker', 'AFP', '_9afp', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(142, 'tumor_marker', 'CA. 15 3', '_9c153', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(143, 'tumor_marker', 'CA. 19 9', '_9c199', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(144, 'tumor_marker', 'CA. 125', '_9c125', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(145, 'tumor_marker', 'CEA', '_9cea', 0, '', '', '', '', '', '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(146, 'tumor_marker', 'Cyfra. 21 2', '_9c212', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(147, 'tumor_marker', 'HCG', '_9hcg', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(148, 'tumor_marker', 'NSE', '_9nse', 0, 'test', '', '', '', '', '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00');
INSERT INTO `care_test_param` (`nr`, `group_id`, `name`, `id`, `sort_nr`, `msr_unit`, `status`, `median`, `hi_bound`, `lo_bound`, `hi_critical`, `lo_critical`, `hi_toxic`, `lo_toxic`, `median_f`, `hi_bound_f`, `lo_bound_f`, `hi_critical_f`, `lo_critical_f`, `hi_toxic_f`, `lo_toxic_f`, `median_n`, `hi_bound_n`, `lo_bound_n`, `hi_critical_n`, `lo_critical_n`, `hi_toxic_n`, `lo_toxic_n`, `median_y`, `hi_bound_y`, `lo_bound_y`, `hi_critical_y`, `lo_critical_y`, `hi_toxic_y`, `lo_toxic_y`, `median_c`, `hi_bound_c`, `lo_bound_c`, `hi_critical_c`, `lo_critical_c`, `hi_toxic_c`, `lo_toxic_c`, `method`, `history`, `modify_id`, `modify_time`, `create_id`, `create_time`) VALUES
(149, 'tumor_marker', 'PSA', '_9psa', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(150, 'tumor_marker', 'SCC', '_9scc', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(151, 'tumor_marker', 'TPA', '_9tpa', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(152, 'tissue_antibody', 'ANA', '_10ana', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(153, 'tissue_antibody', 'AMA', '_ama', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(154, 'tissue_antibody', 'DNS AB', '_10dnsab', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(155, 'tissue_antibody', 'ASMA', '_10asm', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(156, 'tissue_antibody', 'ENA', '_10ena', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(157, 'tissue_antibody', 'ANCA', '_10anc', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(158, 'rheuma_factor', 'Anti Strepto Titer', '_11ast', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(159, 'rheuma_factor', 'Lat. RF', '_11lrf', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(160, 'rheuma_factor', 'Streptozym', '_11stz', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(161, 'rheuma_factor', 'Waaler Rose', '_11waa', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(162, 'hepatitis', 'Anti HAV', '_12hav', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(163, 'hepatitis', 'Anti HAV IgM', '_12hai', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(164, 'hepatitis', 'Hbs Antigen', '_12hba', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(165, 'hepatitis', 'Anti HBs Titer', '_12hbt', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(166, 'hepatitis', 'Anti HBe', '_12hbe', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(167, 'hepatitis', 'Anti HBc', '_12hbc', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(168, 'hepatitis', 'Anti HBc.IgM', '_12hci', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(169, 'hepatitis', 'Anti HCV', '_12hcv', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(170, 'hepatitis', 'Hep.D Delta A.', '_12hda', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(171, 'hepatitis', 'Anti HEV', '_12hev', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(172, 'biopsy', 'Protein i.biopsy', '_13pro', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(173, 'biopsy', 'LDH i.biopsy', '_13ldh', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(174, 'biopsy', 'Chol.i.biopsy', '_13cho', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(175, 'biopsy', 'CEA i.biopsy', '_13cea', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(176, 'biopsy', 'AFP i.biopsy', '_13afp', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(177, 'biopsy', 'Uric acid.i.biopsy', '_13ure', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(178, 'biopsy', 'Rheuma fact.i.biopsy', '_13rhe', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(179, 'biopsy', 'D1', '_13d1', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(180, 'biopsy', 'D2', '_13d2', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(181, 'infection_serology', 'Antistaph.Titer', '_14stap', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(182, 'infection_serology', 'Adenovirus AB', '_14ade', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(183, 'infection_serology', 'Borrelia AB', '_14bor', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(184, 'infection_serology', 'Borr.Immunoblot', '_14bori', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(185, 'infection_serology', 'Brucellia AB', '_14bru', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(186, 'infection_serology', 'Campylob. AB', '_14cam', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(187, 'infection_serology', 'Candida AB', '_14can', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(188, 'infection_serology', 'Cardiotr.Virus', '_14car', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(189, 'infection_serology', 'Chlamydia AB', '_14chl', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(190, 'infection_serology', 'C.psittaci AB', '_14psi', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(191, 'infection_serology', 'Coxsack. AB', '_14cox', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(192, 'infection_serology', 'Cox.burn. AB(Q fever)', '_14qf', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(193, 'infection_serology', 'Cytomegaly AB', '_14cyt', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(194, 'infection_serology', 'EBV AB', '_14ebv', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(195, 'infection_serology', 'Echinococcus AB', '_14ecc', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(196, 'infection_serology', 'Echo Virus AB', '_14ecv', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(197, 'infection_serology', 'FSME AB', '_14fsme', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(198, 'infection_serology', 'Herpes simp. I AB', '_14hs1', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(199, 'infection_serology', 'Herpes simp. II AB', '_14hs2', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(200, 'infection_serology', 'HIV1/HIV2 AB', '_14hiv', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(201, 'infection_serology', 'Influenza A AB', '_14ina', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(202, 'infection_serology', 'Influenza B AB', '_14inb', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(203, 'infection_serology', 'LCM AB', '_14lcm', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(204, 'infection_serology', 'Leg.pneum AB', '_14leg', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(205, 'infection_serology', 'Leptospiria AB', '_14lep', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(206, 'infection_serology', 'Listeria AB', '_14lis', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(207, 'infection_serology', 'Masern AB', '_14mas', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(208, 'infection_serology', 'Mononucleose', '_14mon', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(209, 'infection_serology', 'Mumps AB', '_14mum', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(210, 'infection_serology', 'Mycoplas.pneum AB', '_14myc', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(211, 'infection_serology', 'Neutrop Virus AB', '_14neu', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(212, 'infection_serology', 'Parainfluenza II AB', '_14pi2', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(213, 'infection_serology', 'Parainfluenza III AB', '_14pi3', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(214, 'infection_serology', 'Picorna Virus AB', '_14pic', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(215, 'infection_serology', 'Rickettsia AB', '_14vric', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(216, 'infection_serology', 'R?teln AB', '_14rot', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(217, 'infection_serology', 'R?teln Immune status', '_14roi', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(218, 'infection_serology', 'RS Virus AB', '_14rsv', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(219, 'infection_serology', 'Shigella/Salm AB', '_14shi', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(220, 'infection_serology', 'Toxoplasma AB', '_14tox', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(221, 'infection_serology', 'TPHA', '_14tpha', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(222, 'infection_serology', 'Varicella AB', '_14vrc', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(223, 'infection_serology', 'Yersinia AB', '_14yer', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(224, 'infection_serology', 'E1', '_14e1', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(225, 'infection_serology', 'E2', '_14e2', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(226, 'infection_serology', 'E3', '_14e3', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(227, 'infection_serology', 'E4', '_14e4', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(228, 'medicines', 'Amiodaron', '_15ami', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(229, 'medicines', 'Barbiturate.i.S.', '_15bar', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(230, 'medicines', 'Benzodiazep.i.S.', '_15ben', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(231, 'medicines', 'Carbamazepin', '_15car', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(232, 'medicines', 'Clonazepam', '_15clo', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(233, 'medicines', 'Digitoxin', '_15dig', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(234, 'medicines', 'Digoxin', '_15dgo', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(235, 'medicines', 'Gentamycin', '_15gen', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(236, 'medicines', 'Lithium', '_15lit', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(237, 'medicines', 'Phenobarbital', '_15phe', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(238, 'medicines', 'Phenytoin', '_15pny', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(239, 'medicines', 'Primidon', '_15pri', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(240, 'medicines', 'Salicylic acid', '_15sal', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(241, 'medicines', 'Theophyllin', '_15the', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(242, 'medicines', 'Tobramycin', '_15tob', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(243, 'medicines', 'Valproin acid', '_15val', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(244, 'medicines', 'Vancomycin', '_15van', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(245, 'medicines', 'Amphetamine.i.u.', '_15amp', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(246, 'medicines', 'Antidepressant.i.u.', '_15ant', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(247, 'medicines', 'Barbiturate.i.u.', '_15bau', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(248, 'medicines', 'Benzodiazep.i.u.', '_15beu', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(249, 'medicines', 'Cannabinol.i.u.', '_15can', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(250, 'medicines', 'Cocain.i.u', '_15coc', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(251, 'medicines', 'Methadon.i.u.', '_15met', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(252, 'medicines', 'Opiate.i.u.', '_15opi', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(253, 'prenatal', 'Chlamyd.cult./SSW', '_16chl', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(254, 'prenatal', 'SSW:', '_16ssw', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(255, 'prenatal', 'Down Screening', '_16dow', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(256, 'prenatal', 'Strep B quick test', '_16stb', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(257, 'prenatal', 'TPHA', '_16tpha', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(258, 'prenatal', 'HBs Ag', '_16hbs', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(259, 'prenatal', 'HIV1/HIV2 AV', '_16hiv', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(260, 'stool', 'Chymotrypsin', '_17chy', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(261, 'stool', 'Occult blood 1', '_17ob1', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(262, 'stool', 'Occult blood 2', '_17ob2', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(263, 'stool', 'Occult blood 3', '_17ob3', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(264, 'rare', 'Rare H.', '_18rh', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(265, 'rare', 'Rare E.', '_18re', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(266, 'rare', 'Rare S.', '_18rs', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(267, 'rare', 'Urine rare', '_18uri', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(268, 'rare', 'F1', '_18f1', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(269, 'rare', 'F2', '_18f2', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(270, 'rare', 'F3', '_18f3', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(271, 'urine', 'Urine amylase', '_19amy', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(272, 'urine', 'Urine sugar', '_19sug', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(273, 'urine', 'Protein.i.u.', '_19pro', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(274, 'urine', 'Albumin.i.u.', '_19alb', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(275, 'urine', 'Osmol.i.u.', '_19osm', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(276, 'urine', 'Pregnancy test.', '_19pre', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(277, 'urine', 'Cytomeg.i.urine', '_19cym', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(278, 'urine', 'Urine cytology', '_19cyt', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(279, 'urine', 'Bence Jones', '_19bj', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(280, 'urine', 'Urine elpho', '_19elp', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(281, 'urine', 'Beta2 microglobulin.i.u.', '_19bm2', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(282, 'total_urine', 'Addis Count', '_20adc', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(283, 'total_urine', 'Sodium i.u.', '_20na', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(284, 'total_urine', 'Potass. i.u.', '_20k', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(285, 'total_urine', 'Calcium i.u.', '_20ca', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(286, 'total_urine', 'Phospor i.u.', '_20pho', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(287, 'total_urine', 'Uric acid i.u.', '_20ura', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(288, 'total_urine', 'Creatinin i.u.', '_20cre', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(289, 'total_urine', 'Porphyrine i.u.', '_20por', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(290, 'total_urine', 'Cortisol i.u.', '_20cor', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(291, 'total_urine', 'Hydroxyprolin i.u.', '_20hyd', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(292, 'total_urine', 'Catecholamins i.u.', '_20cat', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(293, 'total_urine', 'Pancreol.', '_20pan', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(294, 'total_urine', 'Gamma Aminol?bulinsre.i.u.', '_20gam', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00');
INSERT INTO `care_test_param` (`nr`, `group_id`, `name`, `id`, `sort_nr`, `msr_unit`, `status`, `median`, `hi_bound`, `lo_bound`, `hi_critical`, `lo_critical`, `hi_toxic`, `lo_toxic`, `median_f`, `hi_bound_f`, `lo_bound_f`, `hi_critical_f`, `lo_critical_f`, `hi_toxic_f`, `lo_toxic_f`, `median_n`, `hi_bound_n`, `lo_bound_n`, `hi_critical_n`, `lo_critical_n`, `hi_toxic_n`, `lo_toxic_n`, `median_y`, `hi_bound_y`, `lo_bound_y`, `hi_critical_y`, `lo_critical_y`, `hi_toxic_y`, `lo_toxic_y`, `median_c`, `hi_bound_c`, `lo_bound_c`, `hi_critical_c`, `lo_critical_c`, `hi_toxic_c`, `lo_toxic_c`, `method`, `history`, `modify_id`, `modify_time`, `create_id`, `create_time`) VALUES
(295, 'special_params', 'Blood alcohol', '_21bal', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(296, 'special_params', 'CDT', '_21cdt', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(297, 'special_params', 'Vitamin B12', '_21vb12', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(298, 'special_params', 'Folic acid', '_21fol', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(299, 'special_params', 'Insulin AB', '_21inab', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(300, 'special_params', 'Intrinsic AB', '_21iab', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(301, 'special_params', 'Stone analysis', '_21sto', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(302, 'special_params', 'ACE', '_21ace', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(303, 'special_params', 'G1', '_21g1', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(304, 'special_params', 'G2', '_21g2', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(305, 'special_params', 'G3', '_21g3', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(306, 'special_params', 'G4', '_21g4', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(307, 'special_params', 'G5', '_21g5', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(308, 'special_params', 'G6', '_21g6', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(309, 'special_params', 'G7', '_21g7', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(310, 'special_params', 'G8', '_21g8', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(311, 'special_params', 'G9', '_21g9', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(312, 'special_params', 'G10', '_21g10', 0, '', '', NULL, NULL, NULL, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:13:52', 'install script', '0000-00-00 00:00:00'),
(315, '-1', 'Priority', 'priority', 5, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:16:37', 'install script', '2003-07-11 16:44:02'),
(316, '-1', 'Clinical chemistry', 'clinical_chem', 10, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:16:37', 'install script', '2003-07-11 16:45:49'),
(317, '-1', 'Liquor', 'liquor', 15, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:16:37', 'install script', '0000-00-00 00:00:00'),
(318, '-1', 'Coagulation', 'coagulation', 20, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:16:37', 'install script', '0000-00-00 00:00:00'),
(319, '-1', 'Hematology', 'hematology', 25, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:16:37', 'install script', '0000-00-00 00:00:00'),
(320, '-1', 'Blood sugar', 'blood_sugar', 30, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:16:37', 'install script', '0000-00-00 00:00:00'),
(321, '-1', 'Neonate', 'neonate', 35, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:16:37', 'install script', '0000-00-00 00:00:00'),
(322, '-1', 'Proteins', 'proteins', 40, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:16:37', 'install script', '0000-00-00 00:00:00'),
(323, '-1', 'Thyroid', 'thyroid', 45, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:16:36', 'install script', '0000-00-00 00:00:00'),
(324, '-1', 'Hormones', 'hormones', 50, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:16:37', 'install script', '0000-00-00 00:00:00'),
(325, '-1', 'Tumor marker', 'tumor_marker', 55, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:16:36', 'install script', '0000-00-00 00:00:00'),
(326, '-1', 'Tissue antibody', 'tissue_antibody', 60, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:16:36', 'install script', '0000-00-00 00:00:00'),
(327, '-1', 'Rheuma factor', 'rheuma_factor', 65, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:16:37', 'install script', '0000-00-00 00:00:00'),
(328, '-1', 'Hepatitis', 'hepatitis', 70, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:16:37', 'install script', '0000-00-00 00:00:00'),
(329, '-1', 'Biopsy', 'biopsy', 75, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:16:37', 'install script', '0000-00-00 00:00:00'),
(330, '-1', 'Infection serology', 'infection_serology', 80, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:16:37', 'install script', '0000-00-00 00:00:00'),
(331, '-1', 'Medicines', 'medicines', 85, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:16:37', 'install script', '0000-00-00 00:00:00'),
(332, '-1', 'Prenatal', 'prenatal', 90, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:16:37', 'install script', '0000-00-00 00:00:00'),
(333, '-1', 'Stool', 'stool', 95, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:16:36', 'install script', '0000-00-00 00:00:00'),
(334, '-1', 'Rare', 'rare', 100, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:16:37', 'install script', '0000-00-00 00:00:00'),
(335, '-1', 'Urine', 'urine', 105, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:16:36', 'install script', '0000-00-00 00:00:00'),
(336, '-1', 'Total urine', 'total_urine', 110, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:16:36', 'install script', '0000-00-00 00:00:00'),
(337, '-1', 'Special', 'special_params', 115, '', '', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', '', 'install script', 'install script', '2010-09-19 17:16:36', 'install script', '0000-00-00 00:00:00');

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

INSERT INTO care_unit_measurement VALUES (1, 1, 'ml', 'Milliliter', 'LDMilliliter', 'metric', NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (2, 2, 'mg', 'Milligram', 'LDMilligram', 'metric', NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (3, 3, 'mm', 'Millimeter', 'LDMillimeter', 'metric', NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (4, 1, 'ltr', 'liter', 'LDLiter', 'metric', NULL, '', '', 20030727131658, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (5, 2, 'gm', 'gram', 'LDGram', 'metric', NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (6, 2, 'kg', 'kilogram', 'LDKilogram', 'metric', NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (7, 3, 'cm', 'centimeter', 'LDCentimeter', 'metric', NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (8, 3, 'm', 'meter', 'LDMeter', 'metric', NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (9, 3, 'km', 'kilometer', 'LDKilometer', 'metric', NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (10, 3, 'in', 'inch', 'LDInch', 'english', NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (11, 3, 'ft', 'foot', 'LDFoot', 'english', NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (12, 3, 'yd', 'yard', 'LDYard', 'english', NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (14, 4, 'mmHg', 'mmHg', 'LDmmHg', 'metric', NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (15, 5, 'celsius', 'Celsius', 'LDCelsius', 'metric', NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (16, 1, 'dl', 'deciliter', 'LDDeciliter', 'metric', NULL, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (17, 1, 'cl', 'centiliter', 'LDCentiliter', 'metric', 0, '', '', 00000000000000, '', 00000000000000);
INSERT INTO care_unit_measurement VALUES (18, 1, 'µl', 'microliter', 'LDMicroliter', 'metric', 0, '', '', 00000000000000, '', 00000000000000);


--
-- Dumping data for table care_version
--


INSERT INTO `care_version` (`name`, `type`, `number`, `build`, `date`, `time`, `releaser`) VALUES ('CARE2X', 'beta', '2.6.1', '6670', '2009-08-01', '00:00:00', 'Gjergj Sheldija/Robert Meggle');

