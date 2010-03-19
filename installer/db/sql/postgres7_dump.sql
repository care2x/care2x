--
-- Selected TOC Entries:
--
-- \connect - postgres

--
-- TOC Entry ID 202 (OID 18698)
--
-- Name: care_address_citytown Type: TABLE Owner: postgres
--

CREATE TABLE "care_address_citytown" (
	"nr" integer DEFAULT nextval('"addr_ct_nr_seq"'::text) NOT NULL,
	"unece_modifier" character(2),
	"unece_locode" character varying(15),
	"name" character varying(100) NOT NULL,
	"zip_code" character varying(25),
	"iso_country_id" character(3) NOT NULL,
	"unece_locode_type" smallint,
	"unece_coordinates" character varying(25),
	"info_url" character varying(255),
	"use_frequency" bigint DEFAULT '0' NOT NULL,
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "addr_ct_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 2 (OID 18704)
--
-- Name: addr_ct_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "addr_ct_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 203 (OID 18707)
--
-- Name: care_appointment Type: TABLE Owner: postgres
--

CREATE TABLE "care_appointment" (
	"nr" bigint DEFAULT nextval('"appt_nr_seq"'::text) NOT NULL,
	"pid" integer DEFAULT '0' NOT NULL,
	"date" date DEFAULT '0001-01-01' NOT NULL,
	"time" time without time zone DEFAULT '00:00:00',
	"to_dept_id" character varying(25),
	"to_dept_nr" smallint,
	"to_personell_nr" integer,
	"to_personell_name" character varying(60),
	"purpose" text NOT NULL,
	"urgency" smallint DEFAULT '0',
	"remind" smallint DEFAULT '0',
	"remind_email" smallint DEFAULT '0',
	"remind_mail" smallint DEFAULT '0',
	"remind_phone" smallint DEFAULT '0',
	"appt_status" character varying(35) DEFAULT 'pending',
	"cancel_by" character varying(255),
	"cancel_date" date,
	"cancel_reason" character varying(255),
	"encounter_class_nr" integer DEFAULT '0',
	"encounter_nr" integer DEFAULT '0',
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "appt_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 4 (OID 18713)
--
-- Name: appt_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "appt_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 204 (OID 18716)
--
-- Name: care_billing_archive Type: TABLE Owner: postgres
--

CREATE TABLE "care_billing_archive" (
	"bill_no" bigint DEFAULT '0' NOT NULL,
	"encounter_nr" integer DEFAULT '0',
	"patient_name" text NOT NULL,
	"vorname" character varying(35) DEFAULT '0',
	"bill_date_time" timestamp with time zone DEFAULT '0001-01-01 00:00:00',
	"bill_amt" double precision DEFAULT '0.0000',
	"payment_date_time" timestamp with time zone DEFAULT '0001-01-01 00:00:00',
	"payment_mode" text NOT NULL,
	"cheque_no" character varying(10) DEFAULT '0',
	"creditcard_no" character varying(10) DEFAULT '0',
	"paid_by" character varying(15) DEFAULT '0',
	Constraint "bill_arch_pkey" Primary Key ("bill_no")
);

--
-- TOC Entry ID 205 (OID 18722)
--
-- Name: care_billing_bill Type: TABLE Owner: postgres
--

CREATE TABLE "care_billing_bill" (
	"bill_bill_no" character varying(16) DEFAULT '0' NOT NULL,
	"bill_encounter_nr" integer DEFAULT '0',
	"bill_date_time" date NOT NULL,
	"bill_amount" real,
	"bill_outstanding" real,
	Constraint "bill_bill_pkey" Primary Key ("bill_bill_no")
);

--
-- TOC Entry ID 206 (OID 18726)
--
-- Name: care_billing_bill_item Type: TABLE Owner: postgres
--

CREATE TABLE "care_billing_bill_item" (
	"bill_item_id" bigint DEFAULT nextval('"bill_item_id_seq"'::text) NOT NULL,
	"bill_item_encounter_nr" integer DEFAULT '0',
	"bill_item_code" character varying(5) NOT NULL,
	"bill_item_unit_cost" real DEFAULT '0.00',
	"bill_item_units" smallint NOT NULL,
	"bill_item_amount" real,
	"bill_item_date" timestamp with time zone NOT NULL,
	"bill_item_status" character varying(1) DEFAULT '0' NOT NULL,
	"bill_item_bill_no" bigint DEFAULT '0',
	CONSTRAINT "bill_item_status" CHECK (((lower((bill_item_status)::text) = '0'::text) OR (lower((bill_item_status)::text) = '1'::text))),
	Constraint "bill_item_pkey" Primary Key ("bill_item_id")
);


--
-- TOC Entry ID 6 (OID 18729)
--
-- Name: bill_item_id_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "bill_item_id_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 207 (OID 18733)
--
-- Name: care_billing_final Type: TABLE Owner: postgres
--

CREATE TABLE "care_billing_final" (
	"final_id" bigint DEFAULT nextval('"bill_final_id_seq"'::text) NOT NULL,
	"final_encounter_nr" integer DEFAULT '0',
	"final_bill_no" bigint NOT NULL,
	"final_date" date NOT NULL,
	"final_total_bill_amount" real,
	"final_discount" smallint NOT NULL,
	"final_total_receipt_amount" real,
	"final_amount_due" real,
	"final_amount_recieved" real,
	Constraint "bill_final_pkey" Primary Key ("final_id")
);

--
-- TOC Entry ID 8 (OID 18736)
--
-- Name: bill_final_id_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "bill_final_id_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 208 (OID 18739)
--
-- Name: care_billing_item Type: TABLE Owner: postgres
--

CREATE TABLE "care_billing_item" (
	"item_code" character varying(5) NOT NULL,
	"item_description" character varying(100) NOT NULL,
	"item_unit_cost" real DEFAULT '0.00',
	"item_type" text NOT NULL,
	"item_discount_max_allowed" smallint DEFAULT '0',
	Constraint "billing_item_pkey" Primary Key ("item_code")
);

--
-- TOC Entry ID 209 (OID 18745)
--
-- Name: care_billing_payment Type: TABLE Owner: postgres
--

CREATE TABLE "care_billing_payment" (
	"payment_id" bigint DEFAULT nextval('"bill_pay_id_seq"'::text) NOT NULL,
	"payment_encounter_nr" integer DEFAULT '0',
	"payment_receipt_no" bigint DEFAULT '0',
	"payment_date" timestamp with time zone DEFAULT '0001-01-01 00:00:00',
	"payment_cash_amount" real DEFAULT '0.00',
	"payment_cheque_no" bigint DEFAULT '0',
	"payment_cheque_amount" real DEFAULT '0.00',
	"payment_creditcard_no" bigint DEFAULT '0',
	"payment_creditcard_amount" real DEFAULT '0.00',
	"payment_amount_total" real DEFAULT '0.00',
	Constraint "bill_pay_pkey" Primary Key ("payment_id")
);

--
-- TOC Entry ID 10 (OID 18748)
--
-- Name: bill_pay_id_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "bill_pay_id_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 210 (OID 18752)
--
-- Name: care_cache Type: TABLE Owner: postgres
--

CREATE TABLE "care_cache" (
	"id" character varying(125) NOT NULL,
	"ctext" text NOT NULL,
	"cbinary" bytea,
	"tstamp" bigint NOT NULL,
	Constraint "cache_pkey" Primary Key ("id")
);

--
-- TOC Entry ID 211 (OID 18758)
--
-- Name: care_cafe_menu Type: TABLE Owner: postgres
--

CREATE TABLE "care_cafe_menu" (
	"item" bigint DEFAULT nextval('"cafe_menu_item_seq"'::text) NOT NULL,
	"lang" character varying(10) DEFAULT 'en',
	"cdate" date DEFAULT '0001-01-01',
	"menu" text NOT NULL,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "menu_item_pkey" Primary Key ("item")
);

--
-- TOC Entry ID 12 (OID 18764)
--
-- Name: cafe_menu_item_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "cafe_menu_item_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 212 (OID 18767)
--
-- Name: care_cafe_prices Type: TABLE Owner: postgres
--

CREATE TABLE "care_cafe_prices" (
	"item" bigint DEFAULT nextval('"cafe_prices_item_seq"'::text) NOT NULL,
	"lang" character varying(10) DEFAULT 'en',
	"productgroup" text,
	"article" text,
	"description" text,
	"price" character varying(10),
	"unit" text,
	"pic_filename" text,
	"modify_id" character varying(25),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(25),
	"create_time" bigint DEFAULT '0' NOT NULL,
	Constraint "cafe_prices_item_pkey" Primary Key ("item")
);

--
-- TOC Entry ID 14 (OID 18773)
--
-- Name: cafe_prices_item_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "cafe_prices_item_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 213 (OID 18775)
--
-- Name: care_category_diagnosis Type: TABLE Owner: postgres
--

CREATE TABLE "care_category_diagnosis" (
	"nr" smallint DEFAULT nextval('"cat_diag_nr_seq"'::text) NOT NULL,
	"category" character varying(35) NOT NULL,
	"name" character varying(35) NOT NULL,
	"ld_var" character varying(35) NOT NULL,
	"short_code" character(1) NOT NULL,
	"ld_var_short_code" character varying(25) NOT NULL,
	"description" character varying(255),
	"hide_from" character varying(255) DEFAULT '0',
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "cat_diag_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 16 (OID 18781)
--
-- Name: cat_diag_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "cat_diag_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 214 (OID 18783)
--
-- Name: care_category_disease Type: TABLE Owner: postgres
--

CREATE TABLE "care_category_disease" (
	"nr" smallint DEFAULT nextval('"cat_disease_nr_seq"'::text) NOT NULL,
	"group_nr" smallint DEFAULT '0',
	"category" character varying(35) NOT NULL,
	"name" character varying(35) NOT NULL,
	"ld_var" character varying(35) NOT NULL,
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "cat_disease_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 18 (OID 18786)
--
-- Name: cat_disease_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "cat_disease_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 20 (OID 18794)
--
-- Name: cat_proc_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "cat_proc_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 215 (OID 18796)
--
-- Name: care_class_encounter Type: TABLE Owner: postgres
--

CREATE TABLE "care_class_encounter" (
	"class_nr" smallint DEFAULT nextval('"class_enc_nr_seq"'::text) NOT NULL,
	"class_id" character varying(35) NOT NULL,
	"name" character varying(35) NOT NULL,
	"ld_var" character varying(25) NOT NULL,
	"description" character varying(255),
	"hide_from" smallint DEFAULT '0',
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "class_enc_pkey" Primary Key ("class_nr")
);

--
-- TOC Entry ID 22 (OID 18802)
--
-- Name: class_enc_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "class_enc_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 216 (OID 18804)
--
-- Name: care_class_ethnic_orig Type: TABLE Owner: postgres
--

CREATE TABLE "care_class_ethnic_orig" (
	"nr" smallint DEFAULT nextval('"class_eorig_nr_seq"'::text) NOT NULL,
	"name" character varying(35) NOT NULL,
	"ld_var" character varying(35) NOT NULL,
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "class_eorig_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 24 (OID 18807)
--
-- Name: class_eorig_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "class_eorig_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 217 (OID 18809)
--
-- Name: care_class_financial Type: TABLE Owner: postgres
--

CREATE TABLE "care_class_financial" (
	"class_nr" smallint DEFAULT nextval('"class_fin_nr_seq"'::text) NOT NULL,
	"class_id" character varying(15) DEFAULT '0',
	"type" character varying(25) DEFAULT '0',
	"code" character varying(5) NOT NULL,
	"name" character varying(35) NOT NULL,
	"ld_var" character varying(25) NOT NULL,
	"description" character varying(255),
	"policy" text NOT NULL,
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "class_fin_pkey" Primary Key ("class_nr")
);

--
-- TOC Entry ID 26 (OID 18815)
--
-- Name: class_fin_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "class_fin_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 218 (OID 18818)
--
-- Name: care_class_insurance Type: TABLE Owner: postgres
--

CREATE TABLE "care_class_insurance" (
	"class_nr" smallint DEFAULT nextval('"class_ins_nr_seq"'::text) NOT NULL,
	"class_id" character varying(35) NOT NULL,
	"name" character varying(35) NOT NULL,
	"ld_var" character varying(25) NOT NULL,
	"description" character varying(255),
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "class_ins_pkey" Primary Key ("class_nr")
);

--
-- TOC Entry ID 28 (OID 18824)
--
-- Name: class_ins_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "class_ins_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 219 (OID 18826)
--
-- Name: care_class_therapy Type: TABLE Owner: postgres
--

CREATE TABLE "care_class_therapy" (
	"nr" smallint DEFAULT nextval('"class_ther_nr_seq"'::text) NOT NULL,
	"group_nr" smallint DEFAULT '0',
	"class" character varying(35) NOT NULL,
	"name" character varying(35) NOT NULL,
	"ld_var" character varying(25) NOT NULL,
	"description" character varying(255),
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "class_ther_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 30 (OID 18829)
--
-- Name: class_ther_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "class_ther_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 220 (OID 18831)
--
-- Name: care_classif_neonatal Type: TABLE Owner: postgres
--

CREATE TABLE "care_classif_neonatal" (
	"nr" smallint DEFAULT nextval('"classif_neo_nr_seq"'::text) NOT NULL,
	"id" character varying(35) NOT NULL,
	"name" character varying(35) NOT NULL,
	"ld_var" character varying(35) NOT NULL,
	"description" character varying(255),
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "classif_neo_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 32 (OID 18835)
--
-- Name: classif_neo_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "classif_neo_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 221 (OID 18837)
--
-- Name: care_complication Type: TABLE Owner: postgres
--

CREATE TABLE "care_complication" (
	"nr" smallint DEFAULT nextval('"complic_nr_seq"'::text) NOT NULL,
	"group_nr" integer DEFAULT '0',
	"name" character varying(35) NOT NULL,
	"ld_var" character varying(35) NOT NULL,
	"code" character varying(25),
	"description" character varying(255) NOT NULL,
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "complic_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 34 (OID 18840)
--
-- Name: complic_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "complic_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 222 (OID 18842)
--
-- Name: care_config_global Type: TABLE Owner: postgres
--

CREATE TABLE "care_config_global" (
	"type" character varying(60) NOT NULL,
	"value" character varying(255) NOT NULL,
	"notes" character varying(255),
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "config_global_pkey" Primary Key ("type")
);

--
-- TOC Entry ID 223 (OID 18848)
--
-- Name: care_config_user Type: TABLE Owner: postgres
--

CREATE TABLE "care_config_user" (
	"user_id" character varying(100) NOT NULL,
	"serial_config_data" text NOT NULL,
	"notes" character varying(255),
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) DEFAULT 'system' NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "config_user_pkey" Primary Key ("user_id")
);

--
-- TOC Entry ID 36 (OID 18857)
--
-- Name: cur_item_no_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "cur_item_no_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 224 (OID 18860)
--
-- Name: care_department Type: TABLE Owner: postgres
--

CREATE TABLE "care_department" (
	"nr" smallint DEFAULT nextval('"dept_nr_seq"'::text) NOT NULL,
	"id" character varying(60) NOT NULL,
	"type" character varying(25) NOT NULL,
	"name_formal" character varying(60) NOT NULL,
	"name_short" character varying(35),
	"name_alternate" character varying(225),
	"ld_var" character varying(35),
	"description" text NOT NULL,
	"admit_inpatient" smallint DEFAULT '0',
	"admit_outpatient" smallint DEFAULT '0',
	"has_oncall_doc" smallint DEFAULT '1',
	"has_oncall_nurse" smallint DEFAULT '1',
	"does_surgery" smallint DEFAULT '0',
	"this_institution" smallint DEFAULT '1',
	"is_sub_dept" smallint DEFAULT '0',
	"parent_dept_nr" smallint,
	"work_hours" character varying(100),
	"consult_hours" character varying(100),
	"is_inactive" smallint DEFAULT '0',
	"sort_order" smallint DEFAULT '0',
	"address" text,
	"sig_line" character varying(60),
	"sig_stamp" text,
	"logo_mime_type" character varying(5),
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "care_department_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 225 (OID 18869)
--
-- Name: care_diagnosis_localcode Type: TABLE Owner: postgres
--

CREATE TABLE "care_diagnosis_localcode" (
	"localcode" character varying(12) NOT NULL,
	"description" text NOT NULL,
	"class_sub" character varying(5),
	"type" character varying(10),
	"inclusive" text,
	"exclusive" text,
	"notes" text,
	"std_code" character(1) NOT NULL,
	"sub_level" smallint DEFAULT '0',
	"remarks" text,
	"extra_codes" text,
	"extra_subclass" text,
	"search_keys" character varying(255),
	"use_frequency" bigint DEFAULT '0',
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "diag_localcode_pkey" Primary Key ("localcode")
);

--
-- TOC Entry ID 226 (OID 18875)
--
-- Name: care_drg_intern Type: TABLE Owner: postgres
--

CREATE TABLE "care_drg_intern" (
	"nr" bigint DEFAULT nextval('"drg_int_nr_seq"'::text) NOT NULL,
	"code" character varying(12) NOT NULL,
	"description" text NOT NULL,
	"synonyms" text,
	"notes" text,
	"std_code" character(1),
	"sub_level" smallint DEFAULT '0',
	"parent_code" character varying(12),
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(25),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(25) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "drg_int_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 38 (OID 18881)
--
-- Name: drg_int_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "drg_int_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 227 (OID 18884)
--
-- Name: care_drg_quicklist Type: TABLE Owner: postgres
--

CREATE TABLE "care_drg_quicklist" (
	"nr" bigint DEFAULT nextval('"drg_qlist_nr_seq"'::text) NOT NULL,
	"code" character varying(25) NOT NULL,
	"code_parent" character varying(25) NOT NULL,
	"dept_nr" smallint DEFAULT '0',
	"qlist_type" character varying(25) DEFAULT '0',
	"rank" bigint DEFAULT '0',
	"status" character varying(15) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(25),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(25) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "drg_qlist_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 40 (OID 18890)
--
-- Name: drg_qlist_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "drg_qlist_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 228 (OID 18892)
--
-- Name: care_drg_related_codes Type: TABLE Owner: postgres
--

CREATE TABLE "care_drg_related_codes" (
	"nr" bigint DEFAULT nextval('"drg_relcodes_nr_seq"'::text) NOT NULL,
	"group_nr" smallint NOT NULL,
	"code" character varying(15) NOT NULL,
	"code_parent" character varying(15) NOT NULL,
	"code_type" character varying(15) NOT NULL,
	"rank" bigint DEFAULT '0',
	"status" character varying(15) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(25),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(25) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "drg_relcodes_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 42 (OID 18898)
--
-- Name: drg_relcodes_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "drg_relcodes_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 229 (OID 18900)
--
-- Name: care_dutyplan_oncall Type: TABLE Owner: postgres
--

CREATE TABLE "care_dutyplan_oncall" (
	"nr" bigint DEFAULT nextval('"oncall_nr_seq"'::text) NOT NULL,
	"dept_nr" integer NOT NULL,
	"role_nr" smallint NOT NULL,
	"year" integer NOT NULL,
	"month" character(2) NOT NULL,
	"duty_1_txt" text NOT NULL,
	"duty_2_txt" text NOT NULL,
	"duty_1_pnr" text NOT NULL,
	"duty_2_pnr" text NOT NULL,
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	CONSTRAINT "oncall_year" CHECK ((("year" = 0) OR (("year" > 1900) AND ("year" < 2155)))),
	Constraint "oncall_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 44 (OID 18906)
--
-- Name: oncall_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "oncall_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 230 (OID 18909)
--
-- Name: care_effective_day Type: TABLE Owner: postgres
--

CREATE TABLE "care_effective_day" (
	"eff_day_nr" integer DEFAULT nextval('"effday_nr_seq"'::text) NOT NULL,
	"name" character varying(25) NOT NULL,
	"description" character varying(255) NOT NULL,
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "effday_pkey" Primary Key ("eff_day_nr")
);

--
-- TOC Entry ID 46 (OID 18915)
--
-- Name: effday_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "effday_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 231 (OID 18917)
--
-- Name: care_encounter Type: TABLE Owner: postgres
--

CREATE TABLE "care_encounter" (
	"encounter_nr" bigint DEFAULT nextval('"enc_enc_nr_seq"'::text) NOT NULL,
	"pid" bigint NOT NULL,
	"encounter_date" timestamp with time zone DEFAULT '0001-01-01 00:00:00',
	"encounter_class_nr" smallint DEFAULT '0',
	"encounter_type" character varying(35) DEFAULT '',
	"encounter_status" character varying(35) DEFAULT '',
	"referrer_diagnosis" character varying(255) DEFAULT '',
	"referrer_recom_therapy" character varying(255) DEFAULT '',
	"referrer_dr" character varying(60) DEFAULT '',
	"referrer_dept" character varying(255) DEFAULT '',
	"referrer_institution" character varying(255) DEFAULT '',
	"referrer_notes" text DEFAULT '',
	"financial_class_nr" smallint DEFAULT '0',
	"insurance_nr" character varying(25) DEFAULT '0',
	"insurance_firm_id" character varying(25) DEFAULT '0',
	"insurance_class_nr" smallint DEFAULT '0',
	"insurance_2_nr" character varying(25) DEFAULT '0',
	"insurance_2_firm_id" character varying(25) DEFAULT '0',
	"guarantor_pid" bigint DEFAULT '0',
	"contact_pid" bigint DEFAULT '0',
	"contact_relation" character varying(35) DEFAULT '',
	"current_ward_nr" smallint DEFAULT '0',
	"current_room_nr" smallint DEFAULT '0',
	"in_ward" smallint DEFAULT '0',
	"current_dept_nr" smallint DEFAULT '0',
	"in_dept" smallint DEFAULT '0',
	"current_firm_nr" smallint DEFAULT '0',
	"current_att_dr_nr" integer DEFAULT '0',
	"consulting_dr" character varying(60) DEFAULT '',
	"extra_service" character varying(25) DEFAULT '',
	"is_discharged" smallint DEFAULT '0',
	"discharge_date" date,
	"discharge_time" time without time zone,
	"followup_date" date DEFAULT '0001-01-01',
	"followup_responsibility" character varying(255),
	"post_encounter_notes" text,
	"status" character varying(25) DEFAULT '' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "encounter_pkey" Primary Key ("encounter_nr")
);

--
-- TOC Entry ID 48 (OID 18923)
--
-- Name: enc_enc_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "enc_enc_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 232 (OID 18927)
--
-- Name: care_encounter_diagnosis Type: TABLE Owner: postgres
--

CREATE TABLE "care_encounter_diagnosis" (
	"diagnosis_nr" bigint DEFAULT nextval('"enc_diag_nr_seq"'::text) NOT NULL,
	"encounter_nr" integer NOT NULL,
	"op_nr" bigint DEFAULT '0',
	"date" timestamp with time zone NOT NULL,
	"code" character varying(25) NOT NULL,
	"code_parent" character varying(25),
	"group_nr" integer DEFAULT '0',
	"code_version" smallint DEFAULT '0',
	"localcode" character varying(35),
	"category_nr" smallint DEFAULT '0',
	"type" character varying(35),
	"localization" character varying(35),
	"diagnosing_clinician" character varying(60),
	"diagnosing_dept_nr" smallint DEFAULT '0',
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "enc_diag_pkey" Primary Key ("diagnosis_nr")
);

--
-- TOC Entry ID 50 (OID 18933)
--
-- Name: enc_diag_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "enc_diag_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 233 (OID 18936)
--
-- Name: care_encounter_diagnostics_report Type: TABLE Owner: postgres
--

CREATE TABLE "care_encounter_diagnostics_report" (
	"item_nr" bigint DEFAULT nextval('"enc_rep_item_nr_seq"'::text) NOT NULL,
	"report_nr" bigint DEFAULT '0' NOT NULL,
	"reporting_dept_nr" smallint DEFAULT '0',
	"reporting_dept" character varying(100),
	"report_date" date DEFAULT '0001-01-01' NOT NULL,
	"report_time" time without time zone DEFAULT '00:00:00',
	"encounter_nr" integer NOT NULL,
	"script_call" character varying(255),
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "enc_rep_pkey" Primary Key ("item_nr")
);

--
-- TOC Entry ID 52 (OID 18942)
--
-- Name: enc_rep_item_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "enc_rep_item_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 234 (OID 18945)
--
-- Name: care_encounter_drg_intern Type: TABLE Owner: postgres
--

CREATE TABLE "care_encounter_drg_intern" (
	"nr" bigint DEFAULT nextval('"enc_drg_int_nr_seq"'::text) NOT NULL,
	"encounter_nr" integer NOT NULL,
	"date" timestamp with time zone NOT NULL,
	"group_nr" integer DEFAULT '0',
	"clinician" character varying(60),
	"dept_nr" smallint DEFAULT '0',
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "enc_drg_int_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 54 (OID 18951)
--
-- Name: enc_drg_int_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "enc_drg_int_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 235 (OID 18954)
--
-- Name: care_encounter_event_signaller Type: TABLE Owner: postgres
--

CREATE TABLE "care_encounter_event_signaller" (
	"encounter_nr" integer NOT NULL,
	"yellow" smallint DEFAULT '0',
	"black" smallint DEFAULT '0',
	"blue_pale" smallint DEFAULT '0',
	"brown" smallint DEFAULT '0',
	"pink" smallint DEFAULT '0',
	"yellow_pale" smallint DEFAULT '0',
	"red" smallint DEFAULT '0',
	"green_pale" smallint DEFAULT '0',
	"violet" smallint DEFAULT '0',
	"blue" smallint DEFAULT '0',
	"biege" smallint DEFAULT '0',
	"orange" smallint DEFAULT '0',
	"green_1" smallint DEFAULT '0',
	"green_2" smallint DEFAULT '0',
	"green_3" smallint DEFAULT '0',
	"green_4" smallint DEFAULT '0',
	"green_5" smallint DEFAULT '0',
	"green_6" smallint DEFAULT '0',
	"green_7" smallint DEFAULT '0',
	"rose_1" smallint DEFAULT '0',
	"rose_2" smallint DEFAULT '0',
	"rose_3" smallint DEFAULT '0',
	"rose_4" smallint DEFAULT '0',
	"rose_5" smallint DEFAULT '0',
	"rose_6" smallint DEFAULT '0',
	"rose_7" smallint DEFAULT '0',
	"rose_8" smallint DEFAULT '0',
	"rose_9" smallint DEFAULT '0',
	"rose_10" smallint DEFAULT '0',
	"rose_11" smallint DEFAULT '0',
	"rose_12" smallint DEFAULT '0',
	"rose_13" smallint DEFAULT '0',
	"rose_14" smallint DEFAULT '0',
	"rose_15" smallint DEFAULT '0',
	"rose_16" smallint DEFAULT '0',
	"rose_17" smallint DEFAULT '0',
	"rose_18" smallint DEFAULT '0',
	"rose_19" smallint DEFAULT '0',
	"rose_20" smallint DEFAULT '0',
	"rose_21" smallint DEFAULT '0',
	"rose_22" smallint DEFAULT '0',
	"rose_23" smallint DEFAULT '0',
	"rose_24" smallint DEFAULT '0',
	Constraint "enc_event_sig_pkey" Primary Key ("encounter_nr")
);

--
-- TOC Entry ID 236 (OID 18957)
--
-- Name: care_encounter_financial_class Type: TABLE Owner: postgres
--

CREATE TABLE "care_encounter_financial_class" (
	"nr" bigint DEFAULT nextval('"enc_fin_nr_seq"'::text) NOT NULL,
	"encounter_nr" integer NOT NULL,
	"class_nr" smallint DEFAULT '0',
	"date_start" date DEFAULT '0001-01-01' NOT NULL,
	"date_end" date,
	"date_create" timestamp with time zone DEFAULT '0001-01-01 00:00:00',
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "enc_fin_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 56 (OID 18963)
--
-- Name: enc_fin_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "enc_fin_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 237 (OID 18965)
--
-- Name: care_encounter_image Type: TABLE Owner: postgres
--

CREATE TABLE "care_encounter_image" (
	"nr" bigint DEFAULT nextval('"enc_img_nr_seq"'::text) NOT NULL,
	"encounter_nr" integer NOT NULL,
	"shot_date" date DEFAULT '0001-01-01',
	"shot_nr" smallint DEFAULT '0',
	"mime_type" character varying(10) DEFAULT '' NOT NULL,
	"upload_date" date DEFAULT '0001-01-01',
	"notes" text DEFAULT '' NOT NULL,
	"graphic_script" text DEFAULT '' NOT NULL,
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) DEFAULT 'system' NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "enc_img_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 58 (OID 18971)
--
-- Name: enc_img_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "enc_img_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 238 (OID 18974)
--
-- Name: care_encounter_immunization Type: TABLE Owner: postgres
--

CREATE TABLE "care_encounter_immunization" (
	"nr" bigint DEFAULT nextval('"enc_imm_nr_seq"'::text) NOT NULL,
	"encounter_nr" integer NOT NULL,
	"date" date DEFAULT '0001-01-01',
	"type" character varying(60) NOT NULL,
	"medicine" character varying(60) NOT NULL,
	"dosage" character varying(60) NOT NULL,
	"application_type_nr" smallint DEFAULT '0',
	"application_by" character varying(60),
	"titer" character varying(15),
	"refresh_date" date,
	"notes" text,
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "enc_imm_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 60 (OID 18980)
--
-- Name: enc_imm_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "enc_imm_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 239 (OID 18982)
--
-- Name: care_encounter_location Type: TABLE Owner: postgres
--

CREATE TABLE "care_encounter_location" (
	"nr" bigint DEFAULT nextval('"enc_loc_nr_seq"'::text) NOT NULL,
	"encounter_nr" integer NOT NULL,
	"type_nr" smallint DEFAULT '0',
	"location_nr" smallint DEFAULT '0' NOT NULL,
	"group_nr" smallint DEFAULT '0',
	"date_from" date DEFAULT '0001-01-01',
	"date_to" date DEFAULT '0001-01-01',
	"time_from" time without time zone DEFAULT '00:00:00',
	"time_to" time without time zone DEFAULT '00:00:00',
	"discharge_type_nr" smallint DEFAULT '0',
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "enc_loc_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 62 (OID 18988)
--
-- Name: enc_loc_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "enc_loc_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 240 (OID 18992)
--
-- Name: care_encounter_measurement Type: TABLE Owner: postgres
--

CREATE TABLE "care_encounter_measurement" (
	"nr" bigint DEFAULT nextval('"enc_msr_nr_seq"'::text) NOT NULL,
	"msr_date" date DEFAULT '0001-01-01',
	"msr_time" real DEFAULT '0.00',
	"encounter_nr" integer NOT NULL,
	"msr_type_nr" smallint DEFAULT '0',
	"value" character varying(255) NOT NULL,
	"unit_nr" smallint NOT NULL,
	"unit_type_nr" smallint DEFAULT '0',
	"notes" character varying(255),
	"measured_by" character varying(35) NOT NULL,
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "enc_msr_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 64 (OID 18998)
--
-- Name: enc_msr_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "enc_msr_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 241 (OID 19002)
--
-- Name: care_encounter_notes Type: TABLE Owner: postgres
--

CREATE TABLE "care_encounter_notes" (
	"nr" bigint DEFAULT nextval('"enc_notes_nr_seq"'::text) NOT NULL,
	"encounter_nr" integer NOT NULL,
	"type_nr" smallint DEFAULT '0',
	"notes" text DEFAULT '' NOT NULL,
	"short_notes" character varying(25),
	"aux_notes" character varying(255),
	"ref_notes_nr" bigint DEFAULT '0',
	"personell_nr" integer DEFAULT '0',
	"personell_name" character varying(60),
	"send_to_pid" integer DEFAULT '0',
	"send_to_name" character varying(60),
	"date" date NOT NULL,
	"time" time without time zone NOT NULL,
	"location_type" character varying(35),
	"location_type_nr" smallint DEFAULT '0',
	"location_nr" bigint DEFAULT '0',
	"location_id" character varying(60),
	"ack_short_id" character varying(10),
	"date_ack" timestamp with time zone,
	"date_checked" timestamp with time zone,
	"date_printed" timestamp with time zone,
	"send_by_mail" smallint DEFAULT '0',
	"send_by_email" smallint DEFAULT '0',
	"send_by_fax" smallint DEFAULT '0',
	"status" character varying(25) DEFAULT '' NOT NULL,
	"history" text DEFAULT '',
	"modify_id" character varying(35) DEFAULT '',
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "enc_notes_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 66 (OID 19008)
--
-- Name: enc_notes_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "enc_notes_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 242 (OID 19012)
--
-- Name: care_encounter_obstetric Type: TABLE Owner: postgres
--

CREATE TABLE "care_encounter_obstetric" (
	"encounter_nr" integer NOT NULL,
	"pregnancy_nr" bigint DEFAULT '0',
	"hospital_adm_nr" integer DEFAULT '0',
	"patient_class" character varying(60) NOT NULL,
	"is_discharged_not_in_labour" smallint NOT NULL,
	"is_re_admission" smallint NOT NULL,
	"referral_status" character varying(60) NOT NULL,
	"referral_reason" text NOT NULL,
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "enc_obs_pkey" Primary Key ("encounter_nr")
);

--
-- TOC Entry ID 243 (OID 19019)
--
-- Name: care_encounter_op Type: TABLE Owner: postgres
--

CREATE TABLE "care_encounter_op" (
	"nr" bigint DEFAULT nextval('"enc_op_nr_seq"'::text) NOT NULL,
	"year" character varying(4) DEFAULT '0',
	"dept_nr" smallint NOT NULL,
	"op_room" character varying(10),
	"op_nr" bigint NOT NULL,
	"op_date" date NOT NULL,
	"op_src_date" character varying(8),
	"encounter_nr" integer NOT NULL,
	"diagnosis" text NOT NULL,
	"operator" text,
	"assistant" text,
	"scrub_nurse" text,
	"rotating_nurse" text,
	"anesthesia" character varying(30),
	"an_doctor" text,
	"op_therapy" text,
	"result_info" text,
	"entry_time" character varying(5),
	"cut_time" character varying(5),
	"close_time" character varying(5),
	"exit_time" character varying(5),
	"entry_out" text,
	"cut_close" text,
	"wait_time" text,
	"bandage_time" text,
	"repos_time" text,
	"encoding" text,
	"doc_date" date DEFAULT '0001-01-01' NOT NULL,
	"doc_time" time without time zone DEFAULT '00:00:00' NOT NULL,
	"duty_type" character varying(15),
	"material_codedlist" text,
	"container_codedlist" text,
	"icd_code" text,
	"ops_code" text,
	"ops_intern_code" text,
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "enc_op_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 68 (OID 19025)
--
-- Name: enc_op_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "enc_op_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 244 (OID 19030)
--
-- Name: care_encounter_prescription Type: TABLE Owner: postgres
--

CREATE TABLE "care_encounter_prescription" (
	"nr" bigint DEFAULT nextval('"enc_presc_nr_seq"'::text) NOT NULL,
	"encounter_nr" integer NOT NULL,
	"prescription_type_nr" smallint DEFAULT '0',
	"article" character varying(100) NOT NULL,
	"drug_class" character varying(60),
	"order_nr" bigint DEFAULT '0',
	"dosage" character varying(255) NOT NULL,
	"application_type_nr" smallint DEFAULT '0',
	"notes" text,
	"prescribe_date" date NOT NULL,
	"prescriber" character varying(60) NOT NULL,
	"color_marker" character varying(10),
	"is_stopped" smallint DEFAULT '0',
	"stop_date" date,
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "enc_presc_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 70 (OID 19036)
--
-- Name: enc_presc_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "enc_presc_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 245 (OID 19039)
--
-- Name: care_encounter_prescription_notes Type: TABLE Owner: postgres
--

CREATE TABLE "care_encounter_prescription_notes" (
	"nr" bigint DEFAULT nextval('"enc_prescnotes_nr_seq"'::text) NOT NULL,
	"date" date DEFAULT '0001-01-01' NOT NULL,
	"prescription_nr" bigint DEFAULT '0',
	"notes" character varying(35) DEFAULT '' NOT NULL,
	"short_notes" character varying(25) DEFAULT '' NOT NULL,
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "enc_prescnotes_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 72 (OID 19045)
--
-- Name: enc_prescnotes_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "enc_prescnotes_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 246 (OID 19047)
--
-- Name: care_encounter_procedure Type: TABLE Owner: postgres
--

CREATE TABLE "care_encounter_procedure" (
	"procedure_nr" bigint DEFAULT nextval('"enc_proc_nr_seq"'::text) NOT NULL,
	"encounter_nr" integer NOT NULL,
	"op_nr" bigint DEFAULT '0',
	"date" timestamp with time zone NOT NULL,
	"code" character varying(25) NOT NULL,
	"code_parent" character varying(25),
	"group_nr" integer DEFAULT '0',
	"code_version" smallint DEFAULT '0',
	"localcode" character varying(35),
	"category_nr" smallint DEFAULT '0',
	"localization" character varying(35),
	"responsible_clinician" character varying(60),
	"responsible_dept_nr" smallint DEFAULT '0',
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "enc_proc_pkey" Primary Key ("procedure_nr")
);

--
-- TOC Entry ID 74 (OID 19053)
--
-- Name: enc_proc_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "enc_proc_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 247 (OID 19056)
--
-- Name: care_encounter_sickconfirm Type: TABLE Owner: postgres
--

CREATE TABLE "care_encounter_sickconfirm" (
	"nr" bigint DEFAULT nextval('"enc_sick_nr_seq"'::text) NOT NULL,
	"encounter_nr" integer NOT NULL,
	"date_confirm" date DEFAULT '0001-01-01',
	"date_start" date DEFAULT '0001-01-01',
	"date_end" date DEFAULT '0001-01-01',
	"date_create" date DEFAULT '0001-01-01',
	"diagnosis" text,
	"dept_nr" smallint DEFAULT '0',
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"history" text DEFAULT '',
	"modify_id" character varying(35) DEFAULT 'system',
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) DEFAULT 'system',
	"create_time" bigint DEFAULT '0',
	Constraint "enc_sick_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 76 (OID 19062)
--
-- Name: enc_sick_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "enc_sick_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 248 (OID 19065)
--
-- Name: care_group Type: TABLE Owner: postgres
--

CREATE TABLE "care_group" (
	"nr" integer DEFAULT nextval('"group_nr_seq"'::text) NOT NULL,
	"id" character varying(35) NOT NULL,
	"name" character varying(35) NOT NULL,
	"ld_var" character varying(35) NOT NULL,
	"description" character varying(255) NOT NULL,
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "group_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 78 (OID 19068)
--
-- Name: group_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "group_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 249 (OID 19070)
--
-- Name: care_icd10_de Type: TABLE Owner: postgres
--

CREATE TABLE "care_icd10_de" (
	"diagnosis_code" character varying(12),
	"description" text,
	"class_sub" character varying(5),
	"type" character varying(10),
	"inclusive" text,
	"exclusive" text,
	"notes" text,
	"std_code" character(1),
	"sub_level" smallint DEFAULT '0',
	"remarks" text,
	"extra_codes" text,
	"extra_subclass" text
);

--
-- TOC Entry ID 250 (OID 19076)
--
-- Name: care_icd10_en Type: TABLE Owner: postgres
--

CREATE TABLE "care_icd10_en" (
	"diagnosis_code" character varying(12),
	"description" text,
	"class_sub" character varying(5),
	"type" character varying(10),
	"inclusive" text,
	"exclusive" text,
	"notes" text,
	"std_code" character(1),
	"sub_level" smallint DEFAULT '0',
	"remarks" text,
	"extra_codes" text,
	"extra_subclass" text
);

--
-- TOC Entry ID 251 (OID 19082)
--
-- Name: care_icd10_pt_br Type: TABLE Owner: postgres
--

CREATE TABLE "care_icd10_pt_br" (
	"diagnosis_code" character varying(12),
	"description" text,
	"class_sub" character varying(5),
	"type" character varying(10),
	"inclusive" text,
	"exclusive" text,
	"notes" text,
	"std_code" character(1),
	"sub_level" smallint DEFAULT '0',
	"remarks" text,
	"extra_codes" text,
	"extra_subclass" text
);

--
-- TOC Entry ID 252 (OID 19088)
--
-- Name: care_img_diagnostic Type: TABLE Owner: postgres
--

CREATE TABLE "care_img_diagnostic" (
	"nr" bigint DEFAULT nextval('"img_diag_nr_seq"'::text) NOT NULL,
	"pid" integer NOT NULL,
	"encounter_nr" integer DEFAULT '0',
	"doc_ref_ids" character varying(255),
	"img_type" character varying(10) NOT NULL,
	"max_nr" smallint DEFAULT 1,
	"upload_date" date DEFAULT '0001-01-01' NOT NULL,
	"cancel_date" date DEFAULT '0001-01-01',
	"cancel_by" character varying(35),
	"notes" text,
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "img_diag_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 80 (OID 19094)
--
-- Name: img_diag_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "img_diag_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 253 (OID 19097)
--
-- Name: care_insurance_firm Type: TABLE Owner: postgres
--

CREATE TABLE "care_insurance_firm" (
	"firm_id" character varying(40) NOT NULL,
	"name" character varying(60) NOT NULL,
	"iso_country_id" character(3),
	"sub_area" character varying(60),
	"type_nr" smallint DEFAULT '0',
	"addr" character varying(255),
	"addr_mail" character varying(200) NOT NULL,
	"addr_billing" character varying(200) NOT NULL,
	"addr_email" character varying(60),
	"phone_main" character varying(35),
	"phone_aux" character varying(35),
	"fax_main" character varying(35),
	"fax_aux" character varying(35),
	"contact_person" character varying(60),
	"contact_phone" character varying(35),
	"contact_fax" character varying(35),
	"contact_email" character varying(60),
	"use_frequency" bigint DEFAULT '0',
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) DEFAULT 'system' NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "ins_firm_pkey" Primary Key ("firm_id")
);

--
-- TOC Entry ID 254 (OID 19104)
--
-- Name: care_mail_private Type: TABLE Owner: postgres
--

CREATE TABLE "care_mail_private" (
	"recipient" character varying(60) NOT NULL,
	"sender" character varying(60) NOT NULL,
	"sender_ip" character varying(60),
	"cc" character varying(255),
	"bcc" character varying(255),
	"subject" character varying(255),
	"body" text NOT NULL,
	"sign" character varying(255),
	"ask4ack" smallint DEFAULT '0',
	"reply2" character varying(255),
	"attachment" character varying(255),
	"attach_type" character varying(30),
	"read_flag" smallint DEFAULT '0',
	"mailgroup" character varying(60),
	"maildir" character varying(60),
	"exec_level" smallint DEFAULT '0',
	"exclude_addr" text,
	"send_dt" timestamp without time zone DEFAULT '0001-01-01 00:00:00',
	"send_stamp" timestamp without time zone DEFAULT '0001-01-01 00:00:00',
	"uid" character varying(255)
);

--
-- TOC Entry ID 255 (OID 19110)
--
-- Name: care_mail_private_users Type: TABLE Owner: postgres
--

CREATE TABLE "care_mail_private_users" (
	"user_name" character varying(60) NOT NULL,
	"email" character varying(60) NOT NULL,
	"alias" character varying(60),
	"pw" character varying(255) NOT NULL,
	"inbox" text,
	"sent" text,
	"drafts" text,
	"trash" text,
	"lastcheck" timestamp with time zone,
	"lock_flag" smallint DEFAULT '0',
	"addr_book" text,
	"addr_quick" text,
	"secret_q" text,
	"secret_q_ans" text,
	"public" smallint DEFAULT '0',
	"sig" text,
	"append_sig" smallint DEFAULT '0',
	Constraint "mail_users_pkey" Primary Key ("email")
);

--
-- TOC Entry ID 256 (OID 19116)
--
-- Name: care_med_ordercatalog Type: TABLE Owner: postgres
--

CREATE TABLE "care_med_ordercatalog" (
	"item_no" bigint DEFAULT nextval('"med_ocat_inr_seq"'::text) NOT NULL,
	"dept_nr" smallint DEFAULT '0',
	"hit" bigint DEFAULT '0',
	"artikelname" text NOT NULL,
	"bestellnum" character varying(20) NOT NULL,
	"minorder" smallint DEFAULT '0',
	"maxorder" smallint DEFAULT '0',
	"proorder" text NOT NULL,
	Constraint "med_ocat_pkey" Primary Key ("item_no")
);

--
-- TOC Entry ID 82 (OID 19122)
--
-- Name: med_ocat_inr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "med_ocat_inr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 257 (OID 19125)
--
-- Name: care_med_orderlist Type: TABLE Owner: postgres
--

CREATE TABLE "care_med_orderlist" (
	"order_nr" bigint DEFAULT nextval('"med_olist_onr_seq"'::text) NOT NULL,
	"dept_nr" integer NOT NULL,
	"order_date" date DEFAULT '0001-01-01' NOT NULL,
	"order_time" time without time zone DEFAULT '00:00:00',
	"articles" text NOT NULL,
	"extra1" text,
	"extra2" text,
	"validator" text DEFAULT '',
	"ip_addr" text,
	"priority" text,
	"status" character varying(25) DEFAULT 'draft' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	"sent_datetime" timestamp with time zone DEFAULT '0001-01-01 00:00:00',
	"process_datetime" timestamp with time zone DEFAULT '0001-01-01 00:00:00',
	Constraint "med_olist_pkey" Primary Key ("order_nr")
);

--
-- TOC Entry ID 84 (OID 19131)
--
-- Name: med_olist_onr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "med_olist_onr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 258 (OID 19134)
--
-- Name: care_med_products_main Type: TABLE Owner: postgres
--

CREATE TABLE "care_med_products_main" (
	"bestellnum" character varying(25) NOT NULL,
	"artikelnum" text,
	"industrynum" text,
	"artikelname" text NOT NULL,
	"generic" text,
	"description" text NOT NULL,
	"packing" text NOT NULL,
	"minorder" integer NOT NULL,
	"maxorder" integer,
	"proorder" text DEFAULT 1,
	"picfile" text,
	"encoder" text NOT NULL,
	"enc_date" text DEFAULT '0001-01-01' NOT NULL,
	"enc_time" text,
	"lock_flag" smallint DEFAULT '0',
	"medgroup" text,
	"cave" text,
	"status" character varying(20) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "med_prod_pkey" Primary Key ("bestellnum")
);

--
-- TOC Entry ID 259 (OID 19141)
--
-- Name: care_med_report Type: TABLE Owner: postgres
--

CREATE TABLE "care_med_report" (
	"report_nr" bigint DEFAULT nextval('"med_report_nr_seq"'::text) NOT NULL,
	"dept" character varying(15),
	"report" text NOT NULL,
	"reporter" character varying(25) NOT NULL,
	"id_nr" character varying(15),
	"report_date" date DEFAULT '0001-01-01' NOT NULL,
	"report_time" time without time zone DEFAULT '00:00:00',
	"status" character varying(20) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "med_report_pkey" Primary Key ("report_nr")
);

--
-- TOC Entry ID 86 (OID 19147)
--
-- Name: med_report_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "med_report_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 88 (OID 19155)
--
-- Name: menu_main_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "menu_main_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 260 (OID 19157)
--
-- Name: care_method_induction Type: TABLE Owner: postgres
--

CREATE TABLE "care_method_induction" (
	"nr" smallint DEFAULT nextval('"induction_nr_seq"'::text) NOT NULL,
	"group_nr" smallint DEFAULT '0',
	"method" character varying(35) NOT NULL,
	"name" character varying(35) NOT NULL,
	"ld_var" character varying(35) NOT NULL,
	"description" character varying(255),
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "induction_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 90 (OID 19160)
--
-- Name: induction_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "induction_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 261 (OID 19162)
--
-- Name: care_mode_delivery Type: TABLE Owner: postgres
--

CREATE TABLE "care_mode_delivery" (
	"nr" smallint DEFAULT nextval('"delivery_nr_seq"'::text) NOT NULL,
	"group_nr" smallint DEFAULT '0',
	"mode" character varying(35) NOT NULL,
	"name" character varying(35) NOT NULL,
	"ld_var" character varying(35) NOT NULL,
	"description" character varying(255),
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "delivery_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 92 (OID 19165)
--
-- Name: delivery_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "delivery_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 262 (OID 19167)
--
-- Name: care_neonatal Type: TABLE Owner: postgres
--

CREATE TABLE "care_neonatal" (
	"nr" bigint DEFAULT nextval('"neo_nr_seq"'::text) NOT NULL,
	"pid" bigint NOT NULL,
	"delivery_date" date NOT NULL,
	"parent_encounter_nr" bigint DEFAULT '0',
	"delivery_nr" smallint DEFAULT '0',
	"encounter_nr" bigint DEFAULT '0',
	"delivery_place" character varying(60),
	"delivery_mode" smallint DEFAULT '0',
	"c_s_reason" text,
	"born_before_arrival" smallint DEFAULT '0',
	"face_presentation" smallint DEFAULT '0',
	"posterio_occipital_position" smallint DEFAULT '0',
	"delivery_rank" smallint DEFAULT '1',
	"apgar_1_min" smallint DEFAULT '0',
	"apgar_5_min" smallint DEFAULT '0',
	"apgar_10_min" smallint DEFAULT '0',
	"time_to_spont_resp" smallint,
	"condition" character varying(60) DEFAULT '0',
	"weight" real,
	"length" real,
	"head_circumference" real,
	"scored_gestational_age" real,
	"feeding" smallint DEFAULT '0',
	"congenital_abnormality" character varying(125),
	"classification" character varying(255) DEFAULT '0',
	"disease_category" smallint DEFAULT '0',
	"outcome" smallint DEFAULT '0',
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "neonatal_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 94 (OID 19173)
--
-- Name: neo_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "neo_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 263 (OID 19178)
--
-- Name: care_news_article Type: TABLE Owner: postgres
--

CREATE TABLE "care_news_article" (
	"nr" bigint DEFAULT nextval('"news_nr_seq"'::text) NOT NULL,
	"lang" character varying(10) DEFAULT 'en',
	"dept_nr" smallint DEFAULT '0',
	"category" text NOT NULL,
	"status" character varying(10) DEFAULT 'pending',
	"title" character varying(255) NOT NULL,
	"preface" text DEFAULT '' NOT NULL,
	"body" text NOT NULL,
	"pic" bytea,
	"pic_mime" character varying(4) NOT NULL,
	"art_num" smallint DEFAULT '0',
	"head_file" text DEFAULT '' NOT NULL,
	"main_file" text DEFAULT '' NOT NULL,
	"pic_file" text DEFAULT '' NOT NULL,
	"author" character varying(30) DEFAULT '' NOT NULL,
	"submit_date" timestamp with time zone DEFAULT '0001-01-01 00:00:00',
	"encode_date" timestamp with time zone DEFAULT '0001-01-01 00:00:00',
	"publish_date" date DEFAULT '0001-01-01',
	"modify_id" character varying(30),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(30) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "news_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 96 (OID 19184)
--
-- Name: news_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "news_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 264 (OID 19186)
--
-- Name: care_op_med_doc Type: TABLE Owner: postgres
--

CREATE TABLE "care_op_med_doc" (
	"nr" bigint DEFAULT nextval('"opmed_nr_seq"'::text) NOT NULL,
	"op_date" character varying(12) NOT NULL,
	"operator" text NOT NULL,
	"encounter_nr" bigint NOT NULL,
	"dept_nr" smallint DEFAULT '0',
	"diagnosis" text NOT NULL,
	"localize" text NOT NULL,
	"therapy" text NOT NULL,
	"special" text,
	"class_s" smallint DEFAULT '0',
	"class_m" smallint DEFAULT '0',
	"class_l" smallint DEFAULT '0',
	"op_start" character varying(8),
	"op_end" character varying(8),
	"scrub_nurse" character varying(70),
	"op_room" character varying(10) NOT NULL,
	"status" character varying(15) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "opmed_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 98 (OID 19192)
--
-- Name: opmed_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "opmed_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 265 (OID 19195)
--
-- Name: care_ops301_de Type: TABLE Owner: postgres
--

CREATE TABLE "care_ops301_de" (
	"code" character varying(12),
	"description" text,
	"inclusive" text,
	"exclusive" text,
	"notes" text,
	"std_code" character(1),
	"sub_level" smallint DEFAULT '0',
	"remarks" text
);

--
-- TOC Entry ID 266 (OID 19213)
--
-- Name: care_person_insurance Type: TABLE Owner: postgres
--

CREATE TABLE "care_person_insurance" (
	"item_nr" bigint DEFAULT nextval('"person_ins_inr_seq"'::text) NOT NULL,
	"pid" bigint NOT NULL,
	"type" character varying(60),
	"insurance_nr" character varying(50) NOT NULL,
	"firm_id" character varying(60) NOT NULL,
	"class_nr" smallint DEFAULT '0',
	"is_void" smallint DEFAULT '0',
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "person_ins_pkey" Primary Key ("item_nr")
);

--
-- TOC Entry ID 100 (OID 19219)
--
-- Name: person_ins_inr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "person_ins_inr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 267 (OID 19221)
--
-- Name: care_person_other_number Type: TABLE Owner: postgres
--

CREATE TABLE "care_person_other_number" (
	"nr" bigint DEFAULT nextval('"person_onr_nr_seq"'::text) NOT NULL,
	"pid" bigint DEFAULT '0',
	"other_nr" character varying(30) NOT NULL,
	"org" character varying(35) NOT NULL,
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "person_onr_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 102 (OID 19224)
--
-- Name: person_onr_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "person_onr_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 268 (OID 19228)
--
-- Name: care_personell Type: TABLE Owner: postgres
--

CREATE TABLE "care_personell" (
	"nr" integer DEFAULT nextval('"personell_nr_seq"'::text) NOT NULL,
	"short_id" character varying(10),
	"pid" bigint DEFAULT '0' NOT NULL,
	"job_type_nr" smallint,
	"job_function_title" character varying(60) NOT NULL,
	"date_join" date NOT NULL,
	"date_exit" date,
	"contract_class" character varying(35) DEFAULT '0',
	"contract_start" date NOT NULL,
	"contract_end" date,
	"is_discharged" smallint DEFAULT '0' NOT NULL,
	"pay_class" character varying(25),
	"pay_class_sub" character varying(25),
	"local_premium_id" character varying(5),
	"tax_account_nr" character varying(60),
	"ir_code" character varying(25),
	"nr_workday" smallint DEFAULT '0',
	"nr_weekhour" real DEFAULT '0.00',
	"nr_vacation_day" smallint DEFAULT '0',
	"multiple_employer" smallint DEFAULT '0',
	"nr_dependent" smallint DEFAULT '0',
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "personell_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 269 (OID 19237)
--
-- Name: care_personell_assignment Type: TABLE Owner: postgres
--

CREATE TABLE "care_personell_assignment" (
	"nr" bigint DEFAULT nextval('"passign_nr_seq"'::text) NOT NULL,
	"personell_nr" integer DEFAULT '0' NOT NULL,
	"role_nr" smallint DEFAULT '0' NOT NULL,
	"location_type_nr" smallint DEFAULT '0' NOT NULL,
	"location_nr" smallint DEFAULT '0' NOT NULL,
	"date_start" date DEFAULT '0001-01-01',
	"date_end" date DEFAULT '0001-01-01',
	"is_temporary" smallint DEFAULT '0' NOT NULL,
	"list_frequency" integer DEFAULT '0',
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "passign_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 104 (OID 19243)
--
-- Name: passign_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "passign_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 270 (OID 19246)
--
-- Name: care_pharma_ordercatalog Type: TABLE Owner: postgres
--

CREATE TABLE "care_pharma_ordercatalog" (
	"item_no" bigint DEFAULT nextval('"pharma_ocat_inr_seq"'::text) NOT NULL,
	"dept_nr" smallint DEFAULT '0',
	"hit" bigint DEFAULT '0',
	"artikelname" text NOT NULL,
	"bestellnum" character varying(20) NOT NULL,
	"minorder" smallint DEFAULT '0',
	"maxorder" smallint DEFAULT '0',
	"proorder" text NOT NULL,
	Constraint "pharma_ocat_pkey" Primary Key ("item_no")
);

--
-- TOC Entry ID 106 (OID 19252)
--
-- Name: pharma_ocat_inr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "pharma_ocat_inr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 271 (OID 19254)
--
-- Name: care_pharma_orderlist Type: TABLE Owner: postgres
--

CREATE TABLE "care_pharma_orderlist" (
	"order_nr" bigint DEFAULT nextval('"pharma_olist_onr_seq"'::text) NOT NULL,
	"dept_nr" smallint NOT NULL,
	"order_date" date DEFAULT '0001-01-01' NOT NULL,
	"order_time" time without time zone DEFAULT '00:00:00' NOT NULL,
	"articles" text NOT NULL,
	"extra1" text,
	"extra2" text,
	"validator" text DEFAULT '' NOT NULL,
	"ip_addr" text,
	"priority" text,
	"status" character varying(25) DEFAULT 'draft' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	"sent_datetime" timestamp with time zone DEFAULT '0001-01-01 00:00:00',
	"process_datetime" timestamp with time zone DEFAULT '0001-01-01 00:00:00',
	Constraint "pharma_olist_pkey" Primary Key ("order_nr")
);

--
-- TOC Entry ID 108 (OID 19260)
--
-- Name: pharma_olist_onr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "pharma_olist_onr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 272 (OID 19263)
--
-- Name: care_pharma_products_main Type: TABLE Owner: postgres
--

CREATE TABLE "care_pharma_products_main" (
	"bestellnum" character varying(25) NOT NULL,
	"artikelnum" text,
	"industrynum" text,
	"artikelname" text NOT NULL,
	"generic" text,
	"description" text NOT NULL,
	"packing" text,
	"minorder" integer DEFAULT '0',
	"maxorder" integer DEFAULT '0',
	"proorder" text,
	"picfile" text,
	"encoder" text NOT NULL,
	"enc_date" text NOT NULL,
	"enc_time" text NOT NULL,
	"lock_flag" smallint DEFAULT '0',
	"medgroup" text,
	"cave" text,
	"status" character varying(20) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "pharma_prod_pkey" Primary Key ("bestellnum")
);

--
-- TOC Entry ID 273 (OID 19269)
--
-- Name: care_phone Type: TABLE Owner: postgres
--

CREATE TABLE "care_phone" (
	"item_nr" bigint DEFAULT nextval('"phone_inr_seq"'::text) NOT NULL,
	"title" character varying(25),
	"name" character varying(45) NOT NULL,
	"vorname" character varying(45) NOT NULL,
	"pid" bigint DEFAULT '0',
	"personell_nr" integer,
	"dept_nr" smallint DEFAULT '0',
	"beruf" character varying(25),
	"bereich1" character varying(25),
	"bereich2" character varying(25),
	"inphone1" character varying(15),
	"inphone2" character varying(15),
	"inphone3" character varying(15),
	"exphone1" character varying(25),
	"exphone2" character varying(25),
	"funk1" character varying(15),
	"funk2" character varying(15),
	"roomnr" character varying(10),
	"date" date DEFAULT '0001-01-01',
	"time" time without time zone DEFAULT '00:00:00',
	"status" character varying(15) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "care_phone_pkey" Primary Key ("item_nr")
);

--
-- TOC Entry ID 110 (OID 19275)
--
-- Name: phone_inr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "phone_inr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 274 (OID 19279)
--
-- Name: care_pregnancy Type: TABLE Owner: postgres
--

CREATE TABLE "care_pregnancy" (
	"nr" bigint DEFAULT nextval('"preg_nr_seq"'::text) NOT NULL,
	"encounter_nr" bigint DEFAULT '0' NOT NULL,
	"this_pregnancy_nr" smallint DEFAULT '0',
	"delivery_date" date NOT NULL,
	"delivery_time" time without time zone DEFAULT '00:00:00',
	"gravida" smallint,
	"para" smallint,
	"pregnancy_gestational_age" smallint,
	"nr_of_fetuses" smallint NOT NULL,
	"child_encounter_nr" character varying(255),
	"is_booked" smallint NOT NULL,
	"vdrl" character(1),
	"rh" smallint,
	"delivery_mode" smallint NOT NULL,
	"delivery_by" character varying(60),
	"bp_systolic_high" smallint,
	"bp_diastolic_high" smallint,
	"proteinuria" smallint DEFAULT '0',
	"labour_duration" smallint,
	"induction_method" smallint NOT NULL,
	"induction_indication" character varying(125),
	"anaesth_type_nr" smallint NOT NULL,
	"is_epidural" character(1),
	"complications" character varying(255),
	"perineum" smallint NOT NULL,
	"blood_loss" real,
	"blood_loss_unit" character varying(10),
	"is_retained_placenta" character(1),
	"post_labour_condition" character varying(35),
	"outcome" character varying(35) NOT NULL,
	"status" character varying(25) DEFAULT 'normal',
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "preg_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 112 (OID 19285)
--
-- Name: preg_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "preg_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 275 (OID 19288)
--
-- Name: care_registry Type: TABLE Owner: postgres
--

CREATE TABLE "care_registry" (
	"registry_id" character varying(35) NOT NULL,
	"module_start_script" character varying(60) NOT NULL,
	"news_start_script" character varying(60) NOT NULL,
	"news_editor_script" character varying(255) NOT NULL,
	"news_reader_script" character varying(255) NOT NULL,
	"passcheck_script" character varying(255) NOT NULL,
	"composite" text NOT NULL,
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "registry_pkey" Primary Key ("registry_id")
);

--
-- TOC Entry ID 276 (OID 19294)
--
-- Name: care_role_person Type: TABLE Owner: postgres
--

CREATE TABLE "care_role_person" (
	"nr" smallint DEFAULT nextval('"roleperson_nr_seq"'::text) NOT NULL,
	"group_nr" smallint DEFAULT '0' NOT NULL,
	"role" character varying(35) NOT NULL,
	"name" character varying(35) NOT NULL,
	"ld_var" character varying(35) NOT NULL,
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "roleperson_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 114 (OID 19297)
--
-- Name: roleperson_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "roleperson_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 277 (OID 19299)
--
-- Name: care_room Type: TABLE Owner: postgres
--

CREATE TABLE "care_room" (
	"nr" bigint DEFAULT nextval('"room_nr_seq"'::text) NOT NULL,
	"type_nr" smallint DEFAULT '0' NOT NULL,
	"date_create" date DEFAULT '0001-01-01' NOT NULL,
	"date_close" date DEFAULT '0001-01-01',
	"is_temp_closed" smallint DEFAULT '0',
	"room_nr" smallint DEFAULT '0',
	"ward_nr" smallint DEFAULT '0',
	"dept_nr" smallint DEFAULT '0',
	"nr_of_beds" smallint DEFAULT '1',
	"closed_beds" character varying(255) DEFAULT '' NOT NULL,
	"info" character varying(60),
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "room_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 116 (OID 19305)
--
-- Name: room_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "room_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 278 (OID 19310)
--
-- Name: care_sessions Type: TABLE Owner: postgres
--

CREATE TABLE "care_sessions" (
	"sesskey" character varying(32) NOT NULL,
	"expiry" integer DEFAULT '0',
	"expireref" character varying(64),
	"data" text NOT NULL,
	Constraint "care_sessions_pkey" Primary Key ("sesskey")
);

--
-- TOC Entry ID 279 (OID 19317)
--
-- Name: care_standby_duty_report Type: TABLE Owner: postgres
--

CREATE TABLE "care_standby_duty_report" (
	"report_nr" bigint DEFAULT nextval('"sduty_rep_nr_seq"'::text) NOT NULL,
	"dept" character varying(15) NOT NULL,
	"date" date DEFAULT '0001-01-01',
	"standby_name" character varying(35) NOT NULL,
	"standby_start" time without time zone DEFAULT '00:00:00',
	"standby_end" time without time zone DEFAULT '00:00:00',
	"oncall_name" character varying(35) NOT NULL,
	"oncall_start" time without time zone DEFAULT '00:00:00',
	"oncall_end" time without time zone DEFAULT '00:00:00',
	"op_room" character(2) NOT NULL,
	"diagnosis_therapy" text NOT NULL,
	"encoding" text NOT NULL,
	"status" character varying(20) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "sduty_report_pkey" Primary Key ("report_nr")
);

--
-- TOC Entry ID 118 (OID 19323)
--
-- Name: sduty_rep_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "sduty_rep_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 280 (OID 19325)
--
-- Name: care_steri_products_main Type: TABLE Owner: postgres
--

CREATE TABLE "care_steri_products_main" (
	"bestellnum" bigint NOT NULL,
	"containernum" character varying(15) NOT NULL,
	"industrynum" text,
	"containername" character varying(40) NOT NULL,
	"description" text NOT NULL,
	"packing" text,
	"minorder" integer DEFAULT '0',
	"maxorder" integer DEFAULT '0',
	"proorder" text,
	"picfile" text,
	"encoder" text NOT NULL,
	"enc_date" text NOT NULL,
	"enc_time" text,
	"lock_flag" smallint DEFAULT '0',
	"medgroup" text,
	"cave" text
);

--
-- TOC Entry ID 281 (OID 19330)
--
-- Name: care_tech_questions Type: TABLE Owner: postgres
--

CREATE TABLE "care_tech_questions" (
	"batch_nr" bigint DEFAULT nextval('"techq_bnr_seq"'::text) NOT NULL,
	"dept" character varying(60) NOT NULL,
	"query" text NOT NULL,
	"inquirer" character varying(25) NOT NULL,
	"tphone" character varying(30),
	"tdate" date DEFAULT '0001-01-01' NOT NULL,
	"ttime" time without time zone DEFAULT '00:00:00',
	"tid" bigint,
	"reply" text,
	"answered" smallint DEFAULT '0',
	"ansby" character varying(25),
	"astamp" timestamp without time zone DEFAULT '0001-01-01 00:00:00',
	"archive" smallint DEFAULT '0',
	"status" character varying(15) DEFAULT 'pending' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "care_tech_questions_pkey" Primary Key ("batch_nr")
);

--
-- TOC Entry ID 120 (OID 19336)
--
-- Name: techq_bnr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "techq_bnr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 282 (OID 19338)
--
-- Name: care_tech_repair_done Type: TABLE Owner: postgres
--

CREATE TABLE "care_tech_repair_done" (
	"batch_nr" bigint DEFAULT nextval('"techdo_bnr_seq"'::text) NOT NULL,
	"dept" character varying(15) NOT NULL,
	"dept_nr" smallint,
	"job_id" character varying(15),
	"job" text NOT NULL,
	"reporter" character varying(25) NOT NULL,
	"id" character varying(15) NOT NULL,
	"tdate" date DEFAULT '0001-01-01' NOT NULL,
	"ttime" time without time zone DEFAULT '00:00:00',
	"tid" bigint,
	"seen" smallint DEFAULT '0',
	"d_idx" character varying(8),
	"status" character varying(15) DEFAULT 'pending' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "techdo_pkey" Primary Key ("batch_nr")
);

--
-- TOC Entry ID 122 (OID 19344)
--
-- Name: techdo_bnr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "techdo_bnr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 283 (OID 19346)
--
-- Name: care_tech_repair_job Type: TABLE Owner: postgres
--

CREATE TABLE "care_tech_repair_job" (
	"batch_nr" bigint DEFAULT nextval('"techjob_bnr_seq"'::text) NOT NULL,
	"dept" character varying(15) NOT NULL,
	"job" text NOT NULL,
	"reporter" character varying(25) NOT NULL,
	"id" character varying(15) NOT NULL,
	"tphone" character varying(30),
	"tdate" date DEFAULT '0001-01-01',
	"ttime" time without time zone DEFAULT '00:00:00',
	"tid" bigint,
	"done" smallint DEFAULT '0',
	"seen" smallint DEFAULT '0',
	"seenby" character varying(25),
	"sstamp" character varying(16),
	"doneby" character varying(25),
	"dstamp" character varying(16),
	"d_idx" character varying(8),
	"archive" smallint DEFAULT '0',
	"status" character varying(20) DEFAULT 'pending' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "techjob_pkey" Primary Key ("batch_nr")
);

--
-- TOC Entry ID 124 (OID 19352)
--
-- Name: techjob_bnr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "techjob_bnr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 284 (OID 19354)
--
-- Name: care_test_findings_baclabor Type: TABLE Owner: postgres
--

CREATE TABLE "care_test_findings_baclabor" (
	"batch_nr" bigint DEFAULT '0' NOT NULL,
	"encounter_nr" bigint DEFAULT '0' NOT NULL,
	"room_nr" character varying(10),
	"dept_nr" smallint DEFAULT '0' NOT NULL,
	"notes" character varying(255),
	"findings_init" smallint DEFAULT '0',
	"findings_current" smallint DEFAULT '0',
	"findings_final" smallint DEFAULT '0',
	"entry_nr" character varying(10) NOT NULL,
	"rec_date" date DEFAULT '0001-01-01',
	"type_general" text,
	"resist_anaerob" text,
	"resist_aerob" text,
	"findings" text,
	"doctor_id" character varying(35) NOT NULL,
	"findings_date" date DEFAULT '0001-01-01' NOT NULL,
	"findings_time" time without time zone DEFAULT '00:00:00',
	"status" character varying(10) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "testfind_baclab_pkey" Primary Key ("batch_nr")
);

--
-- TOC Entry ID 285 (OID 19364)
--
-- Name: care_test_findings_chemlab Type: TABLE Owner: postgres
--

CREATE TABLE "care_test_findings_chemlab" (
	"batch_nr" bigint DEFAULT nextval('"testfinclab_bnr_seq"'::text) NOT NULL,
	"encounter_nr" bigint NOT NULL,
	"job_id" character varying(25) NOT NULL,
	"test_date" date DEFAULT '0001-01-01',
	"test_time" time without time zone DEFAULT '00:00:00',
	"group_id" character varying(30) NOT NULL,
	"serial_value" text NOT NULL,
	"validator" character varying(15),
	"validate_dt" timestamp with time zone DEFAULT '0001-01-01 00:00:00',
	"status" character varying(20) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35),
	"create_time" bigint DEFAULT '0',
	Constraint "testfind_clab_pkey" Primary Key ("batch_nr")
);


--
-- TOC Entry ID
--
-- Name: testfinclab_bnr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "testfinclab_bnr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 286 (OID 19372)
--
-- Name: care_test_findings_patho Type: TABLE Owner: postgres
--

CREATE TABLE "care_test_findings_patho" (
	"batch_nr" bigint NOT NULL,
	"encounter_nr" bigint NOT NULL,
	"room_nr" character varying(10),
	"dept_nr" smallint NOT NULL,
	"material" text NOT NULL,
	"macro" text,
	"micro" text,
	"findings" text,
	"diagnosis" text,
	"doctor_id" character varying(35) NOT NULL,
	"findings_date" date DEFAULT '0001-01-01' NOT NULL,
	"findings_time" time without time zone DEFAULT '00:00:00',
	"status" character varying(10) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "testfind_path_pkey" Primary Key ("batch_nr")
);

--
-- TOC Entry ID 287 (OID 19379)
--
-- Name: care_test_findings_radio Type: TABLE Owner: postgres
--

CREATE TABLE "care_test_findings_radio" (
	"batch_nr" bigint DEFAULT '0' NOT NULL,
	"encounter_nr" bigint DEFAULT '0' NOT NULL,
	"room_nr" smallint DEFAULT '0',
	"dept_nr" smallint DEFAULT '0',
	"findings" text NOT NULL,
	"diagnosis" text,
	"doctor_id" character varying(35) NOT NULL,
	"findings_date" date DEFAULT '0001-01-01',
	"findings_time" time without time zone DEFAULT '00:00:00',
	"status" character varying(10) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "testfind_radio_pkey" Primary Key ("batch_nr")
);

--
-- TOC Entry ID 288 (OID 19386)
--
-- Name: care_test_group Type: TABLE Owner: postgres
--

CREATE TABLE "care_test_group" (
	"nr" integer DEFAULT nextval('"testgroup_nr_seq"'::text) NOT NULL,
	"group_id" character varying(35) NOT NULL,
	"name" character varying(35) NOT NULL,
	"sort_nr" smallint DEFAULT '0',
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "testgroup_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 130 (OID 19390)
--
-- Name: testgroup_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "testgroup_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 289 (OID 19392)
--
-- Name: care_test_param Type: TABLE Owner: postgres
--

CREATE TABLE "care_test_param" (
	"nr" integer DEFAULT nextval('"testparam_nr_seq"'::text) NOT NULL,
	"group_id" character varying(35) NOT NULL,
	"name" character varying(35) NOT NULL,
	"id" character varying(10) NOT NULL,
	"msr_unit" character varying(15) NOT NULL,
	"median" character varying(20),
	"hi_bound" character varying(20),
	"lo_bound" character varying(20),
	"hi_critical" character varying(20),
	"lo_critical" character varying(20),
	"hi_toxic" character varying(20),
	"lo_toxic" character varying(20),
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "testparam_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 132 (OID 19398)
--
-- Name: testparam_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "testparam_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 290 (OID 19400)
--
-- Name: care_test_request_baclabor Type: TABLE Owner: postgres
--

CREATE TABLE "care_test_request_baclabor" (
	"batch_nr" bigint DEFAULT nextval('"testreq_blab_bnr_seq"'::text) NOT NULL,
	"encounter_nr" bigint NOT NULL,
	"dept_nr" smallint DEFAULT '0',
	"material" text,
	"test_type" text,
	"material_note" text NOT NULL,
	"diagnosis_note" text NOT NULL,
	"immune_supp" smallint DEFAULT '0',
	"send_date" date DEFAULT '0001-01-01' NOT NULL,
	"sample_date" date DEFAULT '0001-01-01' NOT NULL,
	"status" character varying(10) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "testreq_blab_pkey" Primary Key ("batch_nr")
);

--
-- TOC Entry ID 134 (OID 19406)
--
-- Name: testreq_blab_bnr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "testreq_blab_bnr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 291 (OID 19409)
--
-- Name: care_test_request_blood Type: TABLE Owner: postgres
--

CREATE TABLE "care_test_request_blood" (
	"batch_nr" bigint DEFAULT nextval('"testreqblood_bnr_seq"'::text) NOT NULL,
	"encounter_nr" bigint NOT NULL,
	"dept_nr" smallint,
	"blood_group" character varying(10) NOT NULL,
	"rh_factor" character varying(10) NOT NULL,
	"kell" character varying(10),
	"date_protoc_nr" character varying(45) NOT NULL,
	"pure_blood" character varying(15),
	"red_blood" character varying(15),
	"leukoless_blood" character varying(15),
	"washed_blood" character varying(15),
	"prp_blood" character varying(15),
	"thrombo_con" character varying(15),
	"ffp_plasma" character varying(15),
	"transfusion_dev" character varying(15),
	"match_sample" smallint DEFAULT '0',
	"transfusion_date" date DEFAULT '0001-01-01' NOT NULL,
	"diagnosis" text,
	"notes" text,
	"send_date" date DEFAULT '0001-01-01' NOT NULL,
	"doctor" character varying(35) NOT NULL,
	"phone_nr" character varying(40),
	"status" character varying(10) DEFAULT 'pending' NOT NULL,
	"blood_pb" text,
	"blood_rb" text,
	"blood_llrb" text,
	"blood_wrb" text,
	"blood_prp" bytea,
	"blood_tc" text,
	"blood_ffp" text,
	"b_group_count" integer DEFAULT '0',
	"b_group_price" real DEFAULT '0.00',
	"a_subgroup_count" integer DEFAULT '0',
	"a_subgroup_price" real DEFAULT '0.00',
	"extra_factors_count" integer DEFAULT '0',
	"extra_factors_price" real DEFAULT '0.00',
	"coombs_count" integer DEFAULT '0',
	"coombs_price" real DEFAULT '0.00',
	"ab_test_count" integer DEFAULT '0',
	"ab_test_price" real DEFAULT '0.00',
	"crosstest_count" integer DEFAULT '0',
	"crosstest_price" real DEFAULT '0.00',
	"ab_diff_count" integer DEFAULT '0',
	"ab_diff_price" real DEFAULT '0.00',
	"x_test_1_code" integer DEFAULT '0',
	"x_test_1_name" character varying(35),
	"x_test_1_count" integer DEFAULT '0',
	"x_test_1_price" real DEFAULT '0.00',
	"x_test_2_code" integer DEFAULT '0',
	"x_test_2_name" character varying(35),
	"x_test_2_count" integer DEFAULT '0',
	"x_test_2_price" real DEFAULT '0.00',
	"x_test_3_code" integer DEFAULT '0',
	"x_test_3_name" character varying(35),
	"x_test_3_count" integer DEFAULT '0',
	"x_test_3_price" real DEFAULT '0.00',
	"lab_stamp" timestamp with time zone DEFAULT '0001-01-01 00:00:00',
	"release_via" character varying(20),
	"receipt_ack" character varying(20),
	"mainlog_nr" character varying(7),
	"lab_nr" character varying(7),
	"mainlog_date" date DEFAULT '0001-01-01',
	"lab_date" date DEFAULT '0001-01-01',
	"mainlog_sign" character varying(20),
	"lab_sign" character varying(20),
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "testreqblood_pkey" Primary Key ("batch_nr")
);

--
-- TOC Entry ID 136 (OID 19415)
--
-- Name: testreqblood_bnr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "testreqblood_bnr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 292 (OID 19418)
--
-- Name: care_test_request_chemlabor Type: TABLE Owner: postgres
--

CREATE TABLE "care_test_request_chemlabor" (
	"batch_nr" bigint DEFAULT nextval('"testreqclab_bnr_seq"'::text) NOT NULL,
	"encounter_nr" bigint NOT NULL,
	"room_nr" character varying(10),
	"dept_nr" smallint DEFAULT '0',
	"parameters" text NOT NULL,
	"doctor_sign" character varying(35),
	"highrisk" smallint DEFAULT '0',
	"notes" text,
	"send_date" timestamp with time zone DEFAULT '0001-01-01 00:00:00',
	"sample_time" time without time zone DEFAULT '00:00:00',
	"sample_weekday" smallint DEFAULT '0',
	"status" character varying(15) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35),
	"create_time" bigint DEFAULT '0',
	Constraint "testreqclab_pkey" Primary Key ("batch_nr")
);

--
-- TOC Entry ID 138 (OID 19424)
--
-- Name: testreqclab_bnr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "testreqclab_bnr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 293 (OID 19427)
--
-- Name: care_test_request_generic Type: TABLE Owner: postgres
--

CREATE TABLE "care_test_request_generic" (
	"batch_nr" bigint DEFAULT nextval('"testreqgen_bnr_seq"'::text) NOT NULL,
	"encounter_nr" bigint NOT NULL,
	"testing_dept" character varying(35) NOT NULL,
	"visit" smallint DEFAULT '0',
	"order_patient" smallint DEFAULT '0',
	"diagnosis_quiry" text NOT NULL,
	"send_date" date DEFAULT '0001-01-01' NOT NULL,
	"send_doctor" character varying(35) NOT NULL,
	"result" text,
	"result_date" date DEFAULT '0001-01-01',
	"result_doctor" character varying(35),
	"status" character varying(10) DEFAULT 'pending' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "testreqgen_pkey" Primary Key ("batch_nr")
);

--
-- TOC Entry ID 140 (OID 19433)
--
-- Name: testreqgen_bnr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "testreqgen_bnr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 294 (OID 19447)
--
-- Name: care_test_request_radio Type: TABLE Owner: postgres
--

CREATE TABLE "care_test_request_radio" (
	"batch_nr" bigint DEFAULT nextval('"testreqradio_bnr_seq"'::text) NOT NULL,
	"encounter_nr" bigint NOT NULL,
	"dept_nr" smallint DEFAULT '0',
	"xray" smallint DEFAULT '0',
	"ct" smallint DEFAULT '0',
	"sono" smallint DEFAULT '0',
	"mammograph" smallint DEFAULT '0',
	"mrt" smallint DEFAULT '0',
	"nuclear" smallint DEFAULT '0',
	"if_patmobile" smallint DEFAULT '0',
	"if_allergy" smallint DEFAULT '0',
	"if_hyperten" smallint DEFAULT '0',
	"if_pregnant" smallint DEFAULT '0',
	"clinical_info" text,
	"test_request" text NOT NULL,
	"send_date" date NOT NULL,
	"send_doctor" character varying(35) NOT NULL,
	"xray_nr" character varying(9) DEFAULT '0',
	"r_cm_2" character varying(15),
	"mtr" character varying(35),
	"xray_date" date DEFAULT '0001-01-01',
	"xray_time" time without time zone,
	"results" text,
	"results_date" date DEFAULT '0001-01-01',
	"results_doctor" character varying(35),
	"status" character varying(10) DEFAULT 'pending' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	"process_id" character varying(35),
	"process_time" timestamp with time zone,
	Constraint "testreqradio_pkey" Primary Key ("batch_nr")
);

--
-- TOC Entry ID 142 (OID 19453)
--
-- Name: testreqradio_bnr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "testreqradio_bnr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 295 (OID 19583)
--
-- Name: care_unit_measurement Type: TABLE Owner: postgres
--

CREATE TABLE "care_unit_measurement" (
	"nr" smallint DEFAULT nextval('"unit_msr_nr_seq"'::text) NOT NULL,
	"unit_type_nr" smallint DEFAULT '0',
	"id" character varying(15) NOT NULL,
	"name" character varying(35) NOT NULL,
	"ld_var" character varying(35) NOT NULL,
	"sytem" character varying(35) NOT NULL,
	"use_frequency" bigint DEFAULT 0,
	"status" character varying(25) DEFAULT 'normal',
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35),
	"create_time" bigint DEFAULT '0',
	Constraint "unit_msr_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 144 (OID 19586)
--
-- Name: unit_msr_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "unit_msr_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 296 (OID 19588)
--
-- Name: care_users Type: TABLE Owner: postgres
--

CREATE TABLE "care_users" (
	"name" character varying(60) NOT NULL,
	"login_id" character varying(35) NOT NULL,
	"password" character varying(255) NOT NULL,
	"personell_nr" integer DEFAULT '0',
	"lockflag" smallint DEFAULT '0',
	"permission" text NOT NULL,
	"exc" smallint DEFAULT '0',
	"s_date" date DEFAULT '0001-01-01',
	"s_time" time without time zone DEFAULT '00:00:00',
	"expire_date" date DEFAULT '0001-01-01',
	"expire_time" time without time zone DEFAULT '00:00:00',
	"status" character varying(15) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "users_pkey" Primary Key ("login_id")
);

--
-- TOC Entry ID 297 (OID 19595)
--
-- Name: care_version Type: TABLE Owner: postgres
--

CREATE TABLE "care_version" (
	"name" character varying(20) NOT NULL,
	"type" character varying(20) NOT NULL,
	"number" character varying(10) NOT NULL,
	"build" character varying(5) NOT NULL,
	"date" date DEFAULT '0001-01-01',
	"time" time without time zone DEFAULT '00:00:00',
	"releaser" character varying(30) NOT NULL
);

--
-- TOC Entry ID 298 (OID 19597)
--
-- Name: care_ward Type: TABLE Owner: postgres
--

CREATE TABLE "care_ward" (
	"nr" smallint DEFAULT nextval('"ward_nr_seq"'::text) NOT NULL,
	"ward_id" character varying(35) NOT NULL,
	"name" character varying(35) NOT NULL,
	"is_temp_closed" smallint DEFAULT '0',
	"date_create" date DEFAULT '0001-01-01',
	"date_close" date DEFAULT '0001-01-01',
	"description" text,
	"info" text,
	"dept_nr" smallint DEFAULT '0',
	"room_nr_start" smallint DEFAULT '0',
	"room_nr_end" smallint DEFAULT '0',
	"roomprefix" character varying(4) DEFAULT '',
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(25) DEFAULT '0',
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(25) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "ward_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 146 (OID 19603)
--
-- Name: ward_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "ward_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 299 (OID 19687)
--
-- Name: care_menu_main Type: TABLE Owner: postgres
--

CREATE TABLE "care_menu_main" (
	"nr" smallint DEFAULT nextval('"menu_main_nr_seq"'::text) NOT NULL,
	"sort_nr" smallint DEFAULT '0',
	"name" character varying(35) NOT NULL,
	"ld_var" character varying(35) NOT NULL,
	"url" character varying(255) NOT NULL,
	"is_visible" smallint DEFAULT '1',
	"hide_by" text DEFAULT '' NOT NULL,
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"modify_id" character varying(60),
	"modify_time" bigint DEFAULT '0',
	Constraint "menu_main_pkey" Primary Key ("nr")
);

CREATE TABLE "care_menu_sub" (
    "s_nr" integer NOT NULL DEFAULT '0',
    "s_sort_nr" integer NOT NULL DEFAULT '0',
    "s_main_nr" integer NOT NULL DEFAULT '0',
    "s_ebene" integer NOT NULL DEFAULT '0',
    "s_name" character varying(100) NOT NULL DEFAULT '',
    "s_ld_var" character varying(100) NOT NULL DEFAULT '',
    "s_url" character varying(100) NOT NULL DEFAULT '',
    "s_url_ext" character varying(100) NOT NULL DEFAULT '',
    "s_image" character varying(100) NOT NULL DEFAULT '',
    "s_open_image" character varying(100) NOT NULL DEFAULT '',
    "s_is_visible" character varying(100) NOT NULL DEFAULT '',
    "s_hide_by" character varying(100) NOT NULL DEFAULT '',
    "s_status" character varying(100) NOT NULL DEFAULT '',
    "s_modify_id" character varying(100) NOT NULL DEFAULT '',
    "s_modify_time" timestamp with time zone DEFAULT '0001-01-01 00:00:00'
);

--
-- TOC Entry ID 300 (OID 19733)
--
-- Name: care_type_anaesthesia Type: TABLE Owner: postgres
--

CREATE TABLE "care_type_anaesthesia" (
	"nr" smallint DEFAULT nextval('"type_ana_nr_seq"'::text) NOT NULL,
	"id" character varying(35) NOT NULL,
	"name" character varying(35) NOT NULL,
	"ld_var" character varying(35) NOT NULL,
	"description" character varying(255),
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "type_ana_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 148 (OID 19736)
--
-- Name: type_ana_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "type_ana_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 301 (OID 19739)
--
-- Name: care_type_application Type: TABLE Owner: postgres
--

CREATE TABLE "care_type_application" (
	"nr" smallint DEFAULT nextval('"type_app_nr_seq"'::text) NOT NULL,
	"group_nr" smallint DEFAULT '0',
	"type" character varying(35) NOT NULL,
	"name" character varying(35) NOT NULL,
	"ld_var" character varying(35) NOT NULL,
	"description" character varying(255),
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "type_app_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 150 (OID 19742)
--
-- Name: type_app_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "type_app_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 302 (OID 19744)
--
-- Name: care_type_assignment Type: TABLE Owner: postgres
--

CREATE TABLE "care_type_assignment" (
	"type_nr" smallint DEFAULT nextval('"type_assign_tnr_seq"'::text) NOT NULL,
	"type" character varying(35) NOT NULL,
	"name" character varying(35) NOT NULL,
	"ld_var" character varying(25) DEFAULT '0',
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "type_assign_pkey" Primary Key ("type_nr")
);

--
-- TOC Entry ID 152 (OID 19750)
--
-- Name: type_assign_tnr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "type_assign_tnr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 303 (OID 19752)
--
-- Name: care_type_cause_opdelay Type: TABLE Owner: postgres
--

CREATE TABLE "care_type_cause_opdelay" (
	"type_nr" smallint DEFAULT nextval('"type_opd_tnr_seq"'::text) NOT NULL,
	"type" character varying(35) NOT NULL,
	"cause" character varying(255) NOT NULL,
	"ld_var" character varying(35) NOT NULL,
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "type_opd_pkey" Primary Key ("type_nr")
);

--
-- TOC Entry ID 154 (OID 19755)
--
-- Name: type_opd_tnr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "type_opd_tnr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 304 (OID 19757)
--
-- Name: care_type_color Type: TABLE Owner: postgres
--

CREATE TABLE "care_type_color" (
	"color_id" character varying(25) NOT NULL,
	"name" character varying(35) NOT NULL,
	"ld_var" character varying(35) NOT NULL,
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	Constraint "type_color_pkey" Primary Key ("color_id")
);

--
-- TOC Entry ID 305 (OID 19760)
--
-- Name: care_type_department Type: TABLE Owner: postgres
--

CREATE TABLE "care_type_department" (
	"nr" smallint DEFAULT nextval('"type_dept_nr_seq"'::text) NOT NULL,
	"type" character varying(35) NOT NULL,
	"name" character varying(35) NOT NULL,
	"ld_var" character varying(35) NOT NULL,
	"description" character varying(255),
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "type_dept_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 156 (OID 19763)
--
-- Name: type_dept_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "type_dept_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 306 (OID 19765)
--
-- Name: care_type_discharge Type: TABLE Owner: postgres
--

CREATE TABLE "care_type_discharge" (
	"nr" smallint DEFAULT nextval('"type_disch_nr_seq"'::text) NOT NULL,
	"type" character varying(35) NOT NULL,
	"name" character varying(100) NOT NULL,
	"ld_var" character varying(35) NOT NULL,
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "type_disch_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 158 (OID 19768)
--
-- Name: type_disch_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "type_disch_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 307 (OID 19770)
--
-- Name: care_type_duty Type: TABLE Owner: postgres
--

CREATE TABLE "care_type_duty" (
	"type_nr" smallint DEFAULT nextval('"type_duty_tnr_seq"'::text) NOT NULL,
	"type" character varying(35) NOT NULL,
	"name" character varying(35) NOT NULL,
	"ld_var" character varying(35) NOT NULL,
	"description" character varying(255),
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "type_duty_pkey" Primary Key ("type_nr")
);

--
-- TOC Entry ID 160 (OID 19773)
--
-- Name: type_duty_tnr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "type_duty_tnr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 308 (OID 19775)
--
-- Name: care_type_encounter Type: TABLE Owner: postgres
--

CREATE TABLE "care_type_encounter" (
	"type_nr" smallint DEFAULT nextval('"type_enc_tnr_seq"'::text) NOT NULL,
	"type" character varying(35) NOT NULL,
	"name" character varying(35) NOT NULL,
	"ld_var" character varying(25) NOT NULL,
	"description" character varying(255),
	"hide_from" smallint DEFAULT '0',
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "type_enc_pkey" Primary Key ("type_nr")
);

--
-- TOC Entry ID 162 (OID 19781)
--
-- Name: type_enc_tnr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "type_enc_tnr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 309 (OID 19783)
--
-- Name: care_type_ethnic_orig Type: TABLE Owner: postgres
--

CREATE TABLE "care_type_ethnic_orig" (
	"nr" smallint DEFAULT nextval('"type_eorig_nr_seq"'::text) NOT NULL,
	"class_nr" smallint DEFAULT '0',
	"name" character varying(35) NOT NULL,
	"ld_var" character varying(35) NOT NULL,
	"status" character varying(25) DEFAULT 'normal',
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "type_eorig_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 164 (OID 19786)
--
-- Name: type_eorig_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "type_eorig_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 310 (OID 19788)
--
-- Name: care_type_feeding Type: TABLE Owner: postgres
--

CREATE TABLE "care_type_feeding" (
	"nr" smallint DEFAULT nextval('"type_feed_nr_seq"'::text) NOT NULL,
	"group_nr" smallint DEFAULT '0',
	"type" character varying(35) NOT NULL,
	"name" character varying(35) NOT NULL,
	"ld_var" character varying(35) NOT NULL,
	"description" character varying(255),
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "type_feed_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 166 (OID 19791)
--
-- Name: type_feed_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "type_feed_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 311 (OID 19793)
--
-- Name: care_type_insurance Type: TABLE Owner: postgres
--

CREATE TABLE "care_type_insurance" (
	"type_nr" smallint DEFAULT nextval('"type_ins_tnr_seq"'::text) NOT NULL,
	"type" character varying(35) NOT NULL,
	"name" character varying(60) NOT NULL,
	"ld_var" character varying(35) NOT NULL,
	"description" character varying(255),
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "type_ins_pkey" Primary Key ("type_nr")
);

--
-- TOC Entry ID 168 (OID 19799)
--
-- Name: type_ins_tnr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "type_ins_tnr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 312 (OID 19801)
--
-- Name: care_type_localization Type: TABLE Owner: postgres
--

CREATE TABLE "care_type_localization" (
	"nr" smallint DEFAULT nextval('"type_loc_nr_seq"'::text) NOT NULL,
	"category" character varying(35) NOT NULL,
	"name" character varying(35) NOT NULL,
	"ld_var" character varying(35) NOT NULL,
	"short_code" character(1) NOT NULL,
	"ld_var_short_code" character varying(25) NOT NULL,
	"description" character varying(255),
	"hide_from" character varying(255) DEFAULT '0',
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "type_loc_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 170 (OID 19807)
--
-- Name: type_loc_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "type_loc_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 313 (OID 19809)
--
-- Name: care_type_location Type: TABLE Owner: postgres
--

CREATE TABLE "care_type_location" (
	"nr" smallint DEFAULT nextval('"type_locat_nr_seq"'::text) NOT NULL,
	"type" character varying(35) NOT NULL,
	"name" character varying(35) NOT NULL,
	"ld_var" character varying(35) NOT NULL,
	"description" character varying(255),
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "type_locat_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 172 (OID 19812)
--
-- Name: type_locat_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "type_locat_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 314 (OID 19814)
--
-- Name: care_type_measurement Type: TABLE Owner: postgres
--

CREATE TABLE "care_type_measurement" (
	"nr" smallint DEFAULT nextval('"type_msr_nr_seq"'::text) NOT NULL,
	"type" character varying(35) NOT NULL,
	"name" character varying(35) NOT NULL,
	"ld_var" character varying(35) NOT NULL,
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "type_msr_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 174 (OID 19817)
--
-- Name: type_msr_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "type_msr_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 315 (OID 19819)
--
-- Name: care_type_notes Type: TABLE Owner: postgres
--

CREATE TABLE "care_type_notes" (
	"nr" smallint DEFAULT nextval('"type_notes_nr_seq"'::text) NOT NULL,
	"type" character varying(35) NOT NULL,
	"name" character varying(35) NOT NULL,
	"ld_var" character varying(35) NOT NULL,
	"sort_nr" smallint DEFAULT '0',
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "type_notes_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 176 (OID 19822)
--
-- Name: type_notes_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "type_notes_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 316 (OID 19824)
--
-- Name: care_type_outcome Type: TABLE Owner: postgres
--

CREATE TABLE "care_type_outcome" (
	"nr" smallint DEFAULT nextval('"type_outc_nr_seq"'::text) NOT NULL,
	"group_nr" smallint DEFAULT '0',
	"type" character varying(35) NOT NULL,
	"name" character varying(35) NOT NULL,
	"ld_var" character varying(35) NOT NULL,
	"description" character varying(255),
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "type_outc_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 178 (OID 19827)
--
-- Name: type_outc_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "type_outc_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 317 (OID 19829)
--
-- Name: care_type_perineum Type: TABLE Owner: postgres
--

CREATE TABLE "care_type_perineum" (
	"nr" smallint DEFAULT nextval('"type_peri_nr_seq"'::text) NOT NULL,
	"id" character varying(35) NOT NULL,
	"name" character varying(35) NOT NULL,
	"ld_var" character varying(35) NOT NULL,
	"description" character varying(255),
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "type_peri_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 180 (OID 19832)
--
-- Name: type_peri_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "type_peri_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 318 (OID 19834)
--
-- Name: care_type_prescription Type: TABLE Owner: postgres
--

CREATE TABLE "care_type_prescription" (
	"nr" smallint DEFAULT nextval('"type_presc_nr_seq"'::text) NOT NULL,
	"type" character varying(35) NOT NULL,
	"name" character varying(35) NOT NULL,
	"ld_var" character varying(35) NOT NULL,
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "type_presc_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 182 (OID 19837)
--
-- Name: type_presc_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "type_presc_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 319 (OID 19839)
--
-- Name: care_type_room Type: TABLE Owner: postgres
--

CREATE TABLE "care_type_room" (
	"nr" smallint DEFAULT nextval('"type_room_nr_seq"'::text) NOT NULL,
	"type" character varying(35) NOT NULL,
	"name" character varying(35) NOT NULL,
	"ld_var" character varying(35) NOT NULL,
	"description" character varying(255),
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "type_room_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 184 (OID 19842)
--
-- Name: type_room_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "type_room_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 320 (OID 19844)
--
-- Name: care_type_test Type: TABLE Owner: postgres
--

CREATE TABLE "care_type_test" (
	"type_nr" smallint DEFAULT nextval('"type_test_tnr_seq"'::text) NOT NULL,
	"type" character varying(35) NOT NULL,
	"name" character varying(35) NOT NULL,
	"ld_var" character varying(35) NOT NULL,
	"description" character varying(255),
	"status" character varying(25)  DEFAULT 'normal' NOT NULL,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "type_test_pkey" Primary Key ("type_nr")
);

--
-- TOC Entry ID 186 (OID 19847)
--
-- Name: type_test_tnr_sec Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "type_test_tnr_sec" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 321 (OID 19849)
--
-- Name: care_type_time Type: TABLE Owner: postgres
--

CREATE TABLE "care_type_time" (
	"nr" smallint DEFAULT nextval('"type_time_nr_seq"'::text) NOT NULL,
	"type" character varying(35) NOT NULL,
	"name" character varying(35) NOT NULL,
	"ld_var" character varying(35) NOT NULL,
	"description" character varying(255),
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "type_time_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 188 (OID 19852)
--
-- Name: type_time_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "type_time_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 322 (OID 19854)
--
-- Name: care_type_unit_measurement Type: TABLE Owner: postgres
--

CREATE TABLE "care_type_unit_measurement" (
	"nr" smallint DEFAULT nextval('"type_umsr_nr_seq"'::text) NOT NULL,
	"type" character varying(35) NOT NULL,
	"name" character varying(35) NOT NULL,
	"ld_var" character varying(35) NOT NULL,
	"description" character varying(255),
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "type_umsr_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 190 (OID 19857)
--
-- Name: type_umsr_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "type_umsr_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 323 (OID 19859)
--
-- Name: care_test_request_patho Type: TABLE Owner: postgres
--

CREATE TABLE "care_test_request_patho" (
	"batch_nr" bigint DEFAULT nextval('"testreqpath_bnr_seq"'::text) NOT NULL,
	"encounter_nr" bigint NOT NULL,
	"dept_nr" smallint DEFAULT '0',
	"quick_cut" smallint DEFAULT '0',
	"qc_phone" character varying(40),
	"quick_diagnosis" smallint DEFAULT '0',
	"qd_phone" character varying(40),
	"material_type" character varying(25),
	"material_desc" text,
	"localization" text,
	"clinical_note" text,
	"extra_note" text,
	"repeat_note" text,
	"gyn_last_period" character varying(25),
	"gyn_period_type" character varying(25),
	"gyn_gravida" character varying(25),
	"gyn_menopause_since" character varying(25),
	"gyn_hysterectomy" character varying(25),
	"gyn_contraceptive" character varying(25),
	"gyn_iud" character varying(25),
	"gyn_hormone_therapy" character varying(25),
	"doctor_sign" character varying(35) NOT NULL,
	"op_date" date DEFAULT '0001-01-01',
	"send_date" timestamp with time zone DEFAULT '0001-01-01 00:00:00',
	"status" character varying(10) DEFAULT 'pending' NOT NULL,
	"entry_date" date DEFAULT '0001-01-01',
	"journal_nr" character varying(15),
	"blocks_nr" smallint DEFAULT '0',
	"deep_cuts" smallint DEFAULT '0',
	"special_dye" character varying(35),
	"immune_histochem" character varying(35),
	"hormone_receptors" character varying(35),
	"specials" character varying(35),
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	"process_id" character varying(35),
	"process_time" timestamp with time zone,
	Constraint "testreqpath_pkey" Primary Key ("batch_nr")
);

--
-- TOC Entry ID 192 (OID 19865)
--
-- Name: testreqpath_bnr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "testreqpath_bnr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 324 (OID 19942)
--
-- Name: care_category_procedure Type: TABLE Owner: postgres
--

CREATE TABLE "care_category_procedure" (
	"nr" smallint DEFAULT nextval('"cat_proc_nr_seq"'::text) NOT NULL,
	"category" character varying(35) NOT NULL,
	"name" character varying(35) NOT NULL,
	"ld_var" character varying(35) NOT NULL,
	"short_code" character(1) NOT NULL,
	"ld_var_short_code" character varying(25) NOT NULL,
	"description" character varying(255),
	"hide_from" character varying(255) DEFAULT '0',
	"status" character varying(25) DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying(35),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "cat_proc_pkey" Primary Key ("nr")
);

--
-- TOC Entry ID 325 (OID 20009)
--
-- Name: care_currency Type: TABLE Owner: postgres
--

CREATE TABLE "care_currency" (
	"item_no" smallint DEFAULT nextval('"cur_item_no_seq"'::text) NOT NULL,
	"short_name" character varying(10) NOT NULL,
	"long_name" character varying(20),
	"info" character varying(50),
	"status" character varying(5) DEFAULT '' NOT NULL,
	"modify_id" character varying(20),
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(20) NOT NULL,
	"create_time" bigint DEFAULT '0' NOT NULL,
	Constraint "cur_item_no_pkey" Primary Key ("item_no")
);

--
-- TOC Entry ID 326 (OID 20154)
--
-- Name: care_person Type: TABLE Owner: postgres
--

CREATE TABLE "care_person" (
	"pid" bigint DEFAULT nextval('"person_pid_seq"'::text) NOT NULL,
	"date_reg" timestamp with time zone DEFAULT '0001-01-01 00:00:00',
	"name_first" character varying(60) NOT NULL,
	"name_2" character varying(60) DEFAULT '',
	"name_3" character varying(60) DEFAULT '',
	"name_middle" character varying(60) DEFAULT '',
	"name_last" character varying(60) NOT NULL,
	"name_maiden" character varying(60) DEFAULT '',
	"name_others" text DEFAULT '',
	"date_birth" date DEFAULT '0001-01-01',
	"blood_group" character(2) DEFAULT '',
	"addr_str" character varying(60) DEFAULT '',
	"addr_str_nr" character varying(10) DEFAULT '',
	"addr_zip" character varying(15) DEFAULT '',
	"addr_citytown_nr" integer DEFAULT '0',
	"addr_is_valid" smallint DEFAULT '0',
	"citizenship" character varying(35) DEFAULT '',
	"phone_1_code" character varying(15) DEFAULT '0',
	"phone_1_nr" character varying(35) DEFAULT '',
	"phone_2_code" character varying(15) DEFAULT '0',
	"phone_2_nr" character varying(35) DEFAULT '',
	"cellphone_1_nr" character varying(35) DEFAULT '',
	"cellphone_2_nr" character varying(35) DEFAULT '',
	"fax" character varying(35) DEFAULT '',
	"email" character varying(60) DEFAULT '',
	"civil_status" character varying(35) DEFAULT '',
	"sex" character(1) DEFAULT '',
	"title" character varying(25) DEFAULT '',
	"photo" bytea,
	"photo_filename" character varying(60) DEFAULT '',
	"ethnic_orig" character varying(30),
	"org_id" character varying(60) DEFAULT '',
	"sss_nr" character varying(60) DEFAULT '',
	"nat_id_nr" character varying(60) DEFAULT '',
	"religion" character varying(125) DEFAULT '',
	"mother_pid" bigint DEFAULT '0',
	"father_pid" bigint DEFAULT '0',
	"contact_person" character varying(255) DEFAULT '',
	"contact_pid" bigint DEFAULT '0',
	"contact_relation" character varying(25) DEFAULT '0',
	"death_date" date DEFAULT '0001-01-01',
	"death_encounter_nr" bigint DEFAULT '0',
	"death_cause" character varying(255) DEFAULT '',
	"death_cause_code" character varying(15) DEFAULT '',
	"date_update" timestamp with time zone DEFAULT '0001-01-01 00:00:00',
	"status" character varying(20) DEFAULT '',
	"history" text DEFAULT '',
	"modify_id" character varying(35) DEFAULT '',
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0',
	Constraint "person_pkey" Primary Key ("pid")
);

--
-- TOC Entry ID 194 (OID 20160)
--
-- Name: person_pid_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "person_pid_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 196 (OID 29435)
--
-- Name: personell_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "personell_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 198 (OID 76542)
--
-- Name: dept_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "dept_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 327 (OID 76645)
--
-- Name: care_icd10_es Type: TABLE Owner: postgres
--

CREATE TABLE "care_icd10_es" (
	"diagnosis_code" character varying(12),
	"description" text,
	"class_sub" character varying(5),
	"type" character varying(10),
	"inclusive" text,
	"exclusive" text,
	"notes" text,
	"std_code" character(1),
	"sub_level" smallint DEFAULT '0',
	"remarks" text,
	"extra_codes" text,
	"extra_subclass" text
);

--
-- TOC Entry ID 328 (OID 111960)
--
-- Name: care_ops301_es Type: TABLE Owner: postgres
--

CREATE TABLE "care_ops301_es" (
	"code" character varying(12),
	"description" text,
	"inclusive" text,
	"exclusive" text,
	"notes" text,
	"std_code" character(1),
	"sub_level" smallint DEFAULT '0',
	"remarks" text
);

-- ICD10 table for Bosnian/latin language
-- Name: care_icd10_bs Type: TABLE Owner: postgres
--

CREATE TABLE "care_icd10_bs" (
	"diagnosis_code" character varying(12),
	"description" text,
	"class_sub" character varying(5),
	"type" character varying(10),
	"inclusive" text,
	"exclusive" text,
	"notes" text,
	"std_code" character(1),
	"sub_level" smallint DEFAULT '0',
	"remarks" text,
	"extra_codes" text,
	"extra_subclass" text
);

-- ICD10 table for Bulgarian language
-- Name: care_icd10_bg Type: TABLE Owner: postgres
--

CREATE TABLE "care_icd10_bg" (
	"diagnosis_code" character varying(12),
	"description" text,
	"class_sub" character varying(5),
	"type" character varying(10),
	"inclusive" text,
	"exclusive" text,
	"notes" text,
	"std_code" character(1),
	"sub_level" smallint DEFAULT '0',
	"remarks" text,
	"extra_codes" text,
	"extra_subclass" text
);

-- ICD10 table for Turkish language
-- Name: care_icd10_tr Type: TABLE Owner: postgres
--

CREATE TABLE "care_icd10_tr" (
	"diagnosis_code" character varying(12),
	"description" text,
	"class_sub" character varying(5),
	"type" character varying(10),
	"inclusive" text,
	"exclusive" text,
	"notes" text,
	"std_code" character(1),
	"sub_level" smallint DEFAULT '0',
	"remarks" text,
	"extra_codes" text,
	"extra_subclass" text
);

--
-- TOC Entry ID 200 (OID 141829)
--
-- Name: care_type_immunization_nr_seq Type: SEQUENCE Owner: postgres
--

CREATE SEQUENCE "care_type_immunization_nr_seq" start 1 increment 1 maxvalue 9223372036854775807 minvalue 1 cache 1;

--
-- TOC Entry ID 329 (OID 141831)
--
-- Name: care_type_immunization Type: TABLE Owner: postgres
--

CREATE TABLE "care_type_immunization" (
	"nr" bigint DEFAULT nextval('"care_type_immunization_nr_seq"'::text) NOT NULL,
	"type" character varying NOT NULL,
	"name" character varying NOT NULL,
	"ld_var" character varying,
	"period" integer,
	"tolerance" integer,
	"dosage" text,
	"medicine" text,
	"titer" character varying,
	"note" text,
	"application" integer,
	"status" character varying DEFAULT 'normal' NOT NULL,
	"history" text,
	"modify_id" character varying,
	"modify_time" bigint DEFAULT '0',
	"create_id" character varying(35) NOT NULL,
	"create_time" bigint DEFAULT '0'
) WITHOUT OIDS;

--
-- Data for TOC Entry ID 416 (OID 18698)
--
-- Name: care_address_citytown Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 417 (OID 18707)
--
-- Name: care_appointment Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 418 (OID 18716)
--
-- Name: care_billing_archive Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 419 (OID 18722)
--
-- Name: care_billing_bill Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 420 (OID 18726)
--
-- Name: care_billing_bill_item Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 421 (OID 18733)
--
-- Name: care_billing_final Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 422 (OID 18739)
--
-- Name: care_billing_item Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 423 (OID 18745)
--
-- Name: care_billing_payment Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 424 (OID 18752)
--
-- Name: care_cache Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 425 (OID 18758)
--
-- Name: care_cafe_menu Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 426 (OID 18767)
--
-- Name: care_cafe_prices Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 427 (OID 18775)
--
-- Name: care_category_diagnosis Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_category_diagnosis" VALUES (1,'most_responsible','Most responsible','LDMostResponsible','M','LDMostResp_s','Most responsible diagnosis, must be only one per admission or visit','0','','','','0','','0');
INSERT INTO "care_category_diagnosis" VALUES (2,'associated','Associated','LDAssociated','A','LDAssociated_s','Associated diagnosis, can be several per  admission or visit','0','','','','0','','0');
INSERT INTO "care_category_diagnosis" VALUES (3,'nosocomial','Hospital acquired','LDNosocomial','N','LDNosocomial_s','Hospital acquired problem, can be several per admission or visit','0','','','','0','','0');
INSERT INTO "care_category_diagnosis" VALUES (4,'iatrogenic','Iatrogenic','LDIatrogenic','I','LDIatrogenic_s','Problem resulting from a procedural/surgical complication or medication mistake','0','','','','0','','0');
INSERT INTO "care_category_diagnosis" VALUES (5,'other','Other','LDOther','O','LDOther_s','Other  diagnosis','0','','','','0','','0');
--
-- Data for TOC Entry ID 428 (OID 18783)
--
-- Name: care_category_disease Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_category_disease" VALUES (1,2,'asphyxia','Asphyxia','LDAsphyxia','','','0','','0');
INSERT INTO "care_category_disease" VALUES (2,2,'infection','Infection','LDInfection','','','0','','0');
INSERT INTO "care_category_disease" VALUES (3,2,'congenital_abnomality','Congenital abnormality','LDCongenitalAbnormality','','','0','','0');
INSERT INTO "care_category_disease" VALUES (4,2,'trauma','Trauma','LDTrauma','','','0','','0');
--
-- Data for TOC Entry ID 429 (OID 18796)
--
-- Name: care_class_encounter Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_class_encounter" VALUES (1,'inpatient','Inpatient','LDStationary','Inpatient admission - stays at least in a ward and assigned a bed',0,'','','',0,'',0);
INSERT INTO "care_class_encounter" VALUES (2,'outpatient','Outpatient','LDAmbulant','Outpatient visit - does not stay in a ward nor assigned a bed',0,'','','',0,'',0);
--
-- Data for TOC Entry ID 430 (OID 18804)
--
-- Name: care_class_ethnic_orig Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_class_ethnic_orig" VALUES (1,'race','LDRace','','','0','','0');
INSERT INTO "care_class_ethnic_orig" VALUES (2,'country','LDCountry','','','0','','0');
--
-- Data for TOC Entry ID 431 (OID 18809)
--
-- Name: care_class_financial Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_class_financial" VALUES (1,'care_c','care','c','common','LDcommon','Common nursing care services. (Non-private)','Patient with common health fund insurance policy.','','','','0','','0');
INSERT INTO "care_class_financial" VALUES (2,'care_pc','care','p/c','private + common','LDprivatecommon','Private services added to common services','Patient with common health fund insurance\015\012policy with additional private insurance policy\015\012OR self paying components.','','','','0','','0');
INSERT INTO "care_class_financial" VALUES (3,'care_p','care','p','private','LDprivate','Private nursing care services','Patient with private insurance policy\015\012OR self paying.','LDprivate','','','0','','0');
INSERT INTO "care_class_financial" VALUES (4,'care_pp','care','pp','private plus','LDprivateplus','"Very private" nursing care services','Patient with private health insurance policy\015\012AND self paying components.','','','','0','','0');
INSERT INTO "care_class_financial" VALUES (5,'room_c','room','c','common','LDcommon','Common room services (non-private)','Patient with common health fund insurance policy. ','LDcommon','','','0','','0');
INSERT INTO "care_class_financial" VALUES (6,'room_pc','room','p/c','private + common','','Private services added to common services','Patient with common health fund insurance policy with additional private insurance policy OR self paying components.','','','','0','','0');
INSERT INTO "care_class_financial" VALUES (7,'room_p','room','p','private','','Private room services','Patient with private insurance policy OR self paying. ','','','','0','','0');
INSERT INTO "care_class_financial" VALUES (8,'room_pp','room','pp','private plus','','"Very private" room services','Patient with private health insurance policy AND self paying components.','','','','0','','0');
INSERT INTO "care_class_financial" VALUES (9,'att_dr_c','att_dr','c','common','','Common clinician services','Patient with common health fund insurance policy. ','','','','0','','0');
INSERT INTO "care_class_financial" VALUES (10,'att_dr_pc','att_dr','p/c','private + common','','Private services added to common clinician services','Patient with common health fund insurance policy with additional private insurance policy OR self paying components.','','','','0','','0');
INSERT INTO "care_class_financial" VALUES (11,'att_dr_p','att_dr','p','private','','Private clinician services','Patient with private insurance policy OR self paying.','','','','0','','0');
INSERT INTO "care_class_financial" VALUES (12,'att_dr_pp','att_dr','pp','private plus','','"Very private" clinician services','Patient with private health insurance policy AND self paying components.','','','','0','','0');
--
-- Data for TOC Entry ID 432 (OID 18818)
--
-- Name: care_class_insurance Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_class_insurance" VALUES (1,'private','Private','LDPrivate','Private insurance plan (paid by insured alone)','','','','0','','0');
INSERT INTO "care_class_insurance" VALUES (2,'common','Health Fund','LDInsurance','Public (common) health fund - usually paid both by the insured and his employer, eventually paid by the state','','','','0','','0');
INSERT INTO "care_class_insurance" VALUES (3,'self_pay','Self pay','LDSelfPay','','','','','0','','0');
--
-- Data for TOC Entry ID 433 (OID 18826)
--
-- Name: care_class_therapy Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_class_therapy" VALUES (1,2,'photo','Phototherapy','LDPhototherapy','','','','0','','0');
INSERT INTO "care_class_therapy" VALUES (2,2,'iv','IV Fluids','LDIVFluids','','','','0','','0');
INSERT INTO "care_class_therapy" VALUES (3,2,'oxygen','Oxygen therapy','LDOxygenTherapy','','','','0','','0');
INSERT INTO "care_class_therapy" VALUES (4,2,'cpap','CPAP','LDCPAP','','','','0','','0');
INSERT INTO "care_class_therapy" VALUES (5,2,'ippv','IPPV','LDIPPV','','','','0','','0');
INSERT INTO "care_class_therapy" VALUES (6,2,'nec','NEC','LDNEC','','','','0','','0');
INSERT INTO "care_class_therapy" VALUES (7,2,'tpn','TPN','LDTPN','','','','0','','0');
INSERT INTO "care_class_therapy" VALUES (8,2,'hie','HIE','LDHIE','','','','0','','0');
--
-- Data for TOC Entry ID 434 (OID 18831)
--
-- Name: care_classif_neonatal Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_classif_neonatal" VALUES (1,'jaundice','Neonatal jaundice','LDNeonatalJaundice','','','','0','','0');
INSERT INTO "care_classif_neonatal" VALUES (2,'x_transfusion','Exchange transfusion','LDExchangeTransfusion','','','','0','','0');
INSERT INTO "care_classif_neonatal" VALUES (3,'photo_therapy','Photo therapy','LDPhotoTherapy','','','','0','','0');
INSERT INTO "care_classif_neonatal" VALUES (4,'h_i_encep','Hypoxic ischaemic encephalopathy','LDH_I_Encephalopathy','','','','0','','0');
INSERT INTO "care_classif_neonatal" VALUES (5,'parenteral','Parenteral nutrition','LDParenteralNutrition','','','','0','','0');
INSERT INTO "care_classif_neonatal" VALUES (6,'vent_support','Ventilatory support','LDVentilatorySupport','','','','0','','0');
INSERT INTO "care_classif_neonatal" VALUES (7,'oxygen_therapy','Oxygen therapy','LDOxygenTherapy','','','','0','','0');
INSERT INTO "care_classif_neonatal" VALUES (8,'cpap','CPAP','LDCPAP','Continuous positive airway pressure','','','0','','0');
INSERT INTO "care_classif_neonatal" VALUES (9,'congenital_abnormality','Congenital abnormality','LDCongenitalAbnormality','','','','0','','0');
INSERT INTO "care_classif_neonatal" VALUES (10,'congenital_infection','Congenital infection','LDCongenitalInfection','','','','0','','0');
INSERT INTO "care_classif_neonatal" VALUES (11,'acquired_infection','Acquired infection','LDAcquiredInfection','','','','0','','0');
INSERT INTO "care_classif_neonatal" VALUES (12,'gbs_infection','GBS infection','LDGBSInfection','Group B Strep Infection','','','0','','0');
INSERT INTO "care_classif_neonatal" VALUES (13,'rds','Resp Distress Syndrome','LDRespDistressSyndrome','','','','0','','0');
INSERT INTO "care_classif_neonatal" VALUES (14,'blood_transfusion','Blood transfusion','LDBloodTransfusion','','','','0','','0');
INSERT INTO "care_classif_neonatal" VALUES (15,'antibiotic_therapy','Antibiotic therapy','LDAntibioticTherapy','','','','0','','0');
INSERT INTO "care_classif_neonatal" VALUES (16,'necrotising_enterocolitis','Necrotising enterocolitis','LDNecrotisingEnterocolitis','','','','0','','0');
--
-- Data for TOC Entry ID 435 (OID 18837)
--
-- Name: care_complication Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_complication" VALUES (1,1,'Previous C/S','LDPreviousCS','','','','','0','','0');
INSERT INTO "care_complication" VALUES (2,1,'Pre-eclampsia','LDPreEclampsia','','','','','0','','0');
INSERT INTO "care_complication" VALUES (3,1,'Eclampsia','LDEclampsia','','','','','0','','0');
INSERT INTO "care_complication" VALUES (4,1,'Other hypertension','LDOtherHypertension','','','','','0','','0');
INSERT INTO "care_complication" VALUES (5,1,'Other proteinuria','LDProteinuria','','','','','0','','0');
INSERT INTO "care_complication" VALUES (6,1,'Cardiac','LDCardiac','','','','','0','','0');
INSERT INTO "care_complication" VALUES (7,1,'Anaemia < 8.5g','LDAnaemia','','','','','0','','0');
INSERT INTO "care_complication" VALUES (8,1,'Asthma','LDAsthma','','','','','0','','0');
INSERT INTO "care_complication" VALUES (9,1,'Epilepsy','LDEpilepsy','','','','','0','','0');
INSERT INTO "care_complication" VALUES (10,1,'Placenta praevia','LDPlacentaPraevia','','','','','0','','0');
INSERT INTO "care_complication" VALUES (11,1,'Abruptio placentae','LDAbruptioPlacentae','','','','','0','','0');
INSERT INTO "care_complication" VALUES (12,1,'Other APH','LDOtherAPH','','','','','0','','0');
INSERT INTO "care_complication" VALUES (13,1,'Diabetes','LDDiabetes','','','','','0','','0');
INSERT INTO "care_complication" VALUES (14,1,'Cord prolapse','LDCordProlapse','','','','','0','','0');
INSERT INTO "care_complication" VALUES (15,1,'Ruptured uterus','LDRupturedUterus','','','','','0','','0');
INSERT INTO "care_complication" VALUES (16,1,'Extrauterine pregnancy','LDExtraUterinePregnancy','','','','','0','','0');
--
-- Data for TOC Entry ID 436 (OID 18842)
--
-- Name: care_config_global Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_config_global" VALUES ('time_format','HH.MM','','','','','0','','0');
INSERT INTO "care_config_global" VALUES ('patient_reg_nr_adder','10000000','','','','','0','','0');
INSERT INTO "care_config_global" VALUES ('person_id_nr_adder','10000000','','','','','0','','0');
INSERT INTO "care_config_global" VALUES ('patient_outpatient_nr_adder','500000','','','','','0','','0');
INSERT INTO "care_config_global" VALUES ('patient_inpatient_nr_adder','0','','','','','0','','0');
INSERT INTO "care_config_global" VALUES ('mascot_hide','','','','','','0','','0');
INSERT INTO "care_config_global" VALUES ('mascot_style','default','','','','','0','','0');
INSERT INTO "care_config_global" VALUES ('news_fotos_path','fotos/news/','','','','','0','','0');
INSERT INTO "care_config_global" VALUES ('news_headline_preface_font_bold','',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('person_foto_path','fotos/registration/','','','','','0','','0');
INSERT INTO "care_config_global" VALUES ('patient_financial_class_single_result','0','','','','','0','','0');
INSERT INTO "care_config_global" VALUES ('theme_control_theme_list','default,blue_aqua','','','','','0','','0');
INSERT INTO "care_config_global" VALUES ('medocs_text_preview_maxlen','100','','','','','0','','0');
INSERT INTO "care_config_global" VALUES ('personell_nr_adder','100000','','','','','0','','0');
INSERT INTO "care_config_global" VALUES ('notes_preview_maxlen','120',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('person_id_nr_init','10000000',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('personell_nr_init','100000',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('encounter_nr_init','000000',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('encounter_nr_fullyear_prepend','1',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('theme_mascot','default',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('news_headline_title_font_bold','',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('main_info_police_nr','789',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('main_info_fire_dept_nr','4444',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('main_info_emgcy_nr','33',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('main_info_phone','1111',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('main_info_fax','88888',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('main_info_address','Ofogocountry 89AA\015\012Cyberia 89300\015\012Las Vegas County',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('main_info_email','info@care2x.com',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('pagin_address_list_max_block_rows','6',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('pagin_address_search_max_block_rows','7',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('pagin_insurance_list_max_block_rows','8',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('pagin_insurance_search_max_block_rows','9',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('pagin_personell_list_max_block_rows','10',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('pagin_personell_search_max_block_rows','22',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('pagin_person_search_max_block_rows','12',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('pagin_patient_search_max_block_rows','11',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('pagin_or_patient_search_max_block_rows','4',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('person_name_2_hide','1',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('person_name_3_hide','0',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('person_name_middle_hide','0',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('person_name_maiden_hide','0',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('person_ethnic_orig_hide','0',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('person_name_others_hide','0',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('person_nat_id_nr_hide','0',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('person_religion_hide','0',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('news_headline_title_font_size','5',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('news_headline_title_font_face','arial,verdana,helvetica,sans serif',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('news_headline_title_font_color','#333399',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('person_cellphone_2_nr_hide','0',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('news_headline_preface_font_size','3',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('news_headline_preface_font_face','arial,verdana,helvetica,sans serif',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('news_headline_preface_font_color','#CCCCFF',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('person_phone_2_nr_hide','0',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('news_headline_body_font_size','3',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('news_headline_body_font_face','arial,verdana,helvetica,sans serif',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('news_headline_body_font_color','#663300',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('news_normal_preview_maxlen','300',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('news_normal_display_width','100%',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('person_citizenship_hide','0',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('person_sss_nr_hide','0',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('person_fax_hide','0',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('person_email_hide','0',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('person_phone_1_nr_hide','0',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('person_cellphone_1_nr_hide','0',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('patient_service_care_hide','0',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('gui_frame_left_nav_border','1',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('gui_frame_left_nav_width','150',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('gui_frame_left_nav_bdcolor','#990000',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('language_single','0',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('language_default','en',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('patient_service_room_hide','0',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('patient_service_att_dr_hide','0',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('patient_name_2_show','1',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('patient_name_3_show','1',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('patient_name_middle_show','1',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('theme_control_buttons','default',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('date_format','MM/dd/yyyy',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('timeout_inactive','1',NULL,'','Created 2004-02-20 21:23:08','','0','System','20040220212308');
INSERT INTO "care_config_global" VALUES ('timeout_time','003001',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('person_title_hide','0',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('person_bloodgroup_hide','0',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('person_civilstatus_hide','0',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('person_insurance_hide','0',NULL,'','','','0','','0');
INSERT INTO "care_config_global" VALUES ('person_other_his_nr_hide','0',NULL,'','','','0','','0');

--
-- Name: care_config_user Type: TABLE DATA Owner: postgres
--

INSERT INTO "care_config_user" VALUES ('default', 'a:19:{s:4:"mask";s:1:"1";s:11:"idx_bgcolor";s:7:"#99ccff";s:12:"idx_txtcolor";s:7:"#000066";s:9:"idx_hover";s:7:"#ffffcc";s:9:"idx_alink";s:7:"#ffffff";s:11:"top_bgcolor";s:7:"#99ccff";s:12:"top_txtcolor";s:7:"#330066";s:12:"body_bgcolor";s:7:"#ffffff";s:13:"body_txtcolor";s:7:"#000066";s:10:"body_hover";s:7:"#cc0033";s:10:"body_alink";s:7:"#cc0000";s:11:"bot_bgcolor";s:7:"#cccccc";s:12:"bot_txtcolor";s:4:"gray";s:5:"bname";s:0:"";s:8:"bversion";s:0:"";s:2:"ip";s:0:"";s:3:"cid";s:0:"";s:5:"dhtml";s:1:"1";s:4:"lang";s:0:"";}', 'default values', 'normal', 'installed', 'auto-installer', 0, 'auto-installer', 0);

--
-- Data for TOC Entry ID 438 (OID 18860)
--
-- Name: care_department Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_department" VALUES (1,'pr','2','Public Relations','PR','Press Relations','LDPressRelations','',0,0,1,1,0,1,0,0,'','',0,0,'','','','','','','','0','','0');
INSERT INTO "care_department" VALUES (4,'emergency_surgery','1','Emergency Surgery','Emergency','','LDEmergencySurgery','',1,1,1,1,1,1,0,0,'','12.30 - 15.00 , 19.00 - 21.00',0,0,'','','','','','','','0','','0');
INSERT INTO "care_department" VALUES (5,'plastic_surgery','1','Plastic Surgery','Plastic','Aesthetic Surgery','LDPlasticSurgery','',1,1,1,1,1,1,0,0,'','12.30 - 15.00 , 19.00 - 21.00',0,0,'','','','','','','','0','','0');
INSERT INTO "care_department" VALUES (6,'ent','1','Ear-Nose-Throath','ENT','HNO','LDEarNoseThroath','Ear-Nose-Throath, in german Hals-Nasen-Ohren. The department with  very old traditions that date back to the early beginnings of premodern medicine.',1,1,1,1,1,1,0,0,'','12.30 - 15.00 , 19.00 - 21.00',0,0,'','','kope akjdielj asdlkasdf','','','Update: 2003-08-13 23:24:16 Elpidio Latorilla\015\012Update: 2003-08-13 23:25:27 Elpidio Latorilla\015\012Update: 2003-08-13 23:29:05 Elpidio Latorilla\015\012Update: 2003-08-13 23:30:21 Elpidio Latorilla\015\012Update: 2003-08-13 23:31:52 Elpidio Latorilla\015\012Update: 2003-08-13 23:34:08 Elpidio Latorilla\015\012','Elpidio Latorilla','20031019155346','','0');
INSERT INTO "care_department" VALUES (7,'opthalmology','1','Opthalmology','Opthalmology','Eye Department','LDOpthalmology','',1,1,1,1,1,1,0,0,'','12.30 - 15.00 , 19.00 - 21.00',0,0,'','','','','','','','0','','0');
INSERT INTO "care_department" VALUES (8,'pathology','1','Pathology','Pathology','Patho','LDPathology','',0,0,1,1,0,1,0,0,'','12.30 - 15.00 , 19.00 - 21.00',0,0,'','','','','','','','0','','0');
INSERT INTO "care_department" VALUES (9,'ob_gyn','1','Ob-Gynecology','Ob-Gyne','Gyn','LDObGynecology','',1,1,1,1,1,1,0,0,'','12.30 - 15.00 , 19.00 - 21.00',0,0,'','','','','','','','0','','0');
INSERT INTO "care_department" VALUES (10,'physical_therapy','1','Physical Therapy','Physical','PT','LDPhysicalTherapy','Physical therapy department with on-call therapists. Day care clinics, training, rehab.',1,0,1,1,0,1,1,16,'8:00 - 15:00','12.30 - 15.00 , 19.00 - 21.00',0,0,'','','','','','','','20030828114351','','0');
INSERT INTO "care_department" VALUES (11,'internal_med','1','Internal Medicine','Internal Med','InMed','LDInternalMedicine','',1,1,1,1,0,1,0,0,'','12.30 - 15.00 , 19.00 - 21.00',0,0,'','','','','','','','0','','0');
INSERT INTO "care_department" VALUES (12,'imc','1','Intermediate Care Unit','IMC','Intermediate','LDIntermediateCareUnit','',1,1,1,1,0,1,0,0,'','12.30 - 15.00 , 19.00 - 21.00',0,0,'','','','','','','','0','','0');
INSERT INTO "care_department" VALUES (16,'inmed_ambulatory','1','Internal Medicine Ambulatory','InMed Ambulatory','InMed Amb','LDInternalMedicineAmbulatory','',0,1,1,1,0,1,1,11,'','12.30 - 15.00 , 19.00 - 21.00',0,0,'','','','','','','','0','','0');
INSERT INTO "care_department" VALUES (17,'sonography','1','Sonography','Sono','Ultrasound diagnostics','LDSonography','',0,1,1,1,0,1,1,11,'','12.30 - 15.00 , 19.00 - 21.00',0,0,'','','','','','','','0','','0');
INSERT INTO "care_department" VALUES (18,'nuclear_diagnostics','1','Nuclear Diagnostics','Nuclear','Nuclear Testing','LDNuclearDiagnostics','',0,1,1,1,0,1,1,19,'','12.30 - 15.00 , 19.00 - 21.00',0,0,'','','','','','','','0','','0');
INSERT INTO "care_department" VALUES (19,'radiology','1','Radiology','Radiology','Xray','LDRadiology','',0,1,1,1,0,1,0,0,'','12.30 - 15.00 , 19.00 - 21.00',0,0,'','','','','','','','0','','0');
INSERT INTO "care_department" VALUES (20,'oncology','1','Oncology','Oncology','Cancer Department','LDOncology','',1,1,1,1,1,1,0,11,'','12.30 - 15.00 , 19.00 - 21.00',0,0,'','','','','','','','0','','0');
INSERT INTO "care_department" VALUES (21,'neonatal','1','Neonatal','Neonatal','Newborn Department','LDNeonatal','',1,1,1,1,1,1,1,9,'','12.30 - 15.00 , 19.00 - 21.00',0,0,'','343','','','','Update: 2003-08-13 22:32:07 Elpidio Latorilla\012Update: 2003-08-13 22:33:10 Elpidio Latorilla\012Update: 2003-08-13 22:43:39 Elpidio Latorilla\012Update: 2003-08-13 22:43:59 Elpidio Latorilla\012Update: 2003-08-13 22:44:19 Elpidio Latorilla\012','Elpidio Latorilla','20030813224419','','0');
INSERT INTO "care_department" VALUES (23,'serological_lab','1','Serological Laboratory','Serological Lab','Serum Lab','LDSerologicalLaboratory','',0,1,1,1,0,1,1,22,'','12.30 - 15.00 , 19.00 - 21.00',0,0,'','','','','','','','0','','0');
INSERT INTO "care_department" VALUES (24,'chemical_lab','1','Chemical Laboratory','Chemical Lab','Chem Lab','LDChemicalLaboratory','',0,1,1,1,0,1,1,22,'','12.30 - 15.00 , 19.00 - 21.00',0,0,'','','','','','','','0','','0');
INSERT INTO "care_department" VALUES (25,'bacteriological_lab','1','Bacteriological Laboratory','Bacteriological Lab','Bacteria Lab','LDBacteriologicalLaboratory','',0,1,1,1,0,1,1,22,'','12.30 - 15.00 , 19.00 - 21.00',0,0,'','','','','','','','0','','0');
INSERT INTO "care_department" VALUES (26,'tech','2','Technical Maintenance','Tech','Technical Support','LDTechnicalMaintenance','',0,0,1,1,0,1,0,0,'','',0,0,'','','','jpg','','Update: 2003-08-10 23:42:30 Elpidio Latorilla\012','Elpidio Latorilla','20030810234230','','0');
INSERT INTO "care_department" VALUES (28,'management','2','Management','Management','Busines Administration','LDManagement','',0,0,1,1,0,1,0,0,'','',0,0,'','','','','','','','0','','0');
INSERT INTO "care_department" VALUES (31,'study','3','Studies','Studies','Advance studies or on-the-job training','LDStudies','',0,0,1,1,1,1,0,0,'','',0,0,'','','','','','','','0','','0');
INSERT INTO "care_department" VALUES (32,'health_tip','3','Health Tips','Tips','Health Information','LDHealthTips','',0,0,1,1,1,1,0,0,'','',0,0,'','','','','','','','0','','0');
INSERT INTO "care_department" VALUES (33,'admission','2','Admission','Admit','Admission information','LDAdmission','',0,0,1,1,1,0,1,0,'','',0,0,'','','','','','','','0','','0');
INSERT INTO "care_department" VALUES (35,'cafenews','3','Cafe News','Cafe news','Cafeteria news','LDCafeNews','',0,0,1,1,1,0,0,0,'','',0,0,'','','','','','','','0','','0');
INSERT INTO "care_department" VALUES (36,'nursing','3','Nursing','Nursing','Nursing care','LDNursing','',1,1,1,1,1,1,1,0,'','',0,0,'','','','','','','','0','','0');
INSERT INTO "care_department" VALUES (37,'doctors','3','Doctors','Doctors','Medical personell','LDDoctors','',0,0,1,1,1,1,0,0,'','',0,0,'','','','','','','','0','','0');
INSERT INTO "care_department" VALUES (38,'pharmacy','2','Pharmacy','Pharma','Drugstore','LDPharmacy','',0,0,1,1,1,1,0,0,'','',0,0,'','','','','','','','0','','0');
INSERT INTO "care_department" VALUES (39,'anaesthesiology','1','Anesthesiology','ana','Anesthesia Department','LDAnesthesiology','Anesthesiology',0,0,1,1,1,1,0,0,'','',0,0,'','','','','','','','0','','0');
INSERT INTO "care_department" VALUES (40,'general_ambulant','1','General Outpatient Clinic','General Clinic','General Ambulatory Clinic','LDGeneralOutpatientClinic','Outpatient/Ambulant Clinic for general/internal medicine',0,1,1,1,0,0,1,16,'round the clock','8:30 AM - 11:30 AM , 2:00 PM - 5:30 PM',0,0,'','','','','','','','0','','0');
INSERT INTO "care_department" VALUES (29,'exhibition','3','Exhibitions','Exhibit','Showcases','LDExhibitions','',0,0,1,1,1,1,0,0,'','',0,0,'','','','','normal','Update: 2004-04-19 14:08:13 = e\012Update: 2004-04-19 14:10:42 = e\012Update: 2004-04-19 14:10:57 = e\012Update: 2004-04-19 14:11:02 = e\012Update: 2004-04-19 14:11:16 = e\012Update: 2004-04-19 14:11:32 = e\012Update: 2004-04-19 14:13:29 = e\012','e','20040419141329','','0');
INSERT INTO "care_department" VALUES (41,'blood_bank','1','Blood Bank','Blood Blank','Blood Lab','LDBloodBank','',0,0,1,1,0,1,0,0,'','',0,0,'','','','','','','','0','','0');
INSERT INTO "care_department" VALUES (14,'emergency_ambulatory','1','Emergency Ambulatory','Emergency','Emergency Amb','LDEmergencyAmbulatory','',0,1,1,1,0,1,1,4,'','12.30 - 15.00 , 19.00 - 21.00',0,0,'','','','','visible','Update: 2003-09-23 00:06:27 Elpidio Latorilla\012Update: 2004-04-19 14:15:36 = e\012Update: 2004-04-19 14:15:51 = e\012Update: 2004-04-19 14:17:48 = e\012','e','20040419141748','','0');
INSERT INTO "care_department" VALUES (15,'general_ambulatory','1','General Ambulatory','Ambulatory','General Amb','LDGeneralAmbulatory','',0,1,1,1,0,1,1,3,'round the clock','12.30 - 15.00 , 19.00 - 21.00',1,0,'','','','','hidden','Update: 2004-04-19 14:16:04 = e\012Update: 2004-04-19 14:17:59 = e\012Update: 2004-04-19 14:19:52 = e\012Update: 2004-04-19 14:36:24 = e\012','e','20040419143624','','0');
INSERT INTO "care_department" VALUES (34,'news_headline','3','Headline','News head','Major news','LDHeadline','',0,0,1,1,1,1,0,0,'','',0,0,'','','','','hidden','Update: 2004-04-19 14:36:51 = e\012','e','20040419143651','','0');
INSERT INTO "care_department" VALUES (3,'general_surgery','1','General Surgery','General','General','LDGeneralSurgery','',1,1,1,1,1,1,0,0,'8.30 - 21.00','12.30 - 15.00 , 19.00 - 21.00',0,0,'','','','','visible','Update: 2004-04-19 14:36:03 = e\012Update: 2004-04-19 14:36:16 = e\012','e','20040419143616','','0');
INSERT INTO "care_department" VALUES (27,'it','2','IT Department','IT','EDP','LDITDepartment','',0,0,1,1,0,1,0,0,'','',0,0,'','','','','visible','','e','0','','0');
INSERT INTO "care_department" VALUES (13,'icu','1','Intensive Care Unit','ICU','Intensive','LDIntensiveCareUnit','',1,1,1,1,0,1,0,0,'','12.30 - 15.00 , 19.00 - 21.00',1,0,'','','','','hidden','','e','0','','0');
INSERT INTO "care_department" VALUES (30,'edu','3','Education','Edu','Training','LDEducation','Education news bulletin of the hospital.',0,0,1,1,0,1,0,0,'','',1,0,'','','','','hidden','Update: 2003-08-13 22:44:45 Elpidio Latorilla\012Update: 2003-08-13 23:00:37 Elpidio Latorilla\012','e','20030813230037','','0');
INSERT INTO "care_department" VALUES (2,'cafe','2','Cafeteria','Cafe','Canteen','LDCafeteria','',0,0,1,1,0,1,0,0,'','',0,0,'','','','','visible','Update: 2004-05-04 21:56:43 = e\012','e','20040504215643','','0');
INSERT INTO "care_department" VALUES (22,'central_lab','1','Central Laboratory','Central Lab','General Lab','LDCentralLaboratory','',0,0,1,1,0,1,0,0,'','12.30 - 15.00 , 19.00 - 21.00',1,0,'','','kdkdododospdfjdasljfda\015\012asdflasdjf\015\012asdfklasdjflasdjf','','visible','Update: 2003-08-13 23:12:30 Elpidio Latorilla\015\012Update: 2003-08-13 23:14:59 Elpidio Latorilla\015\012Update: 2003-08-13 23:15:28 Elpidio Latorilla\015\012Update: 2004-05-04 21:56:31 = e\012','e','20040504215631','','0');
--
-- Data for TOC Entry ID 439 (OID 18869)
--
-- Name: care_diagnosis_localcode Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 440 (OID 18875)
--
-- Name: care_drg_intern Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 441 (OID 18884)
--
-- Name: care_drg_quicklist Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 442 (OID 18892)
--
-- Name: care_drg_related_codes Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 443 (OID 18900)
--
-- Name: care_dutyplan_oncall Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 444 (OID 18909)
--
-- Name: care_effective_day Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_effective_day" VALUES (1,'entire stay','effective starting from admission date & ending on discharge date','','','','0','','0');
INSERT INTO "care_effective_day" VALUES (2,'admission day','Effective only on admission day','','','','0','','0');
INSERT INTO "care_effective_day" VALUES (3,'discharge day','Effective only on discharge day','','','','0','','0');
INSERT INTO "care_effective_day" VALUES (4,'op day','Effective only on operation day','','','','0','','0');
INSERT INTO "care_effective_day" VALUES (5,'transfer day','Effective only on transfer day','','','','0','','0');
INSERT INTO "care_effective_day" VALUES (6,'period','defined start and end dates','','','','0','','0');
--
-- Data for TOC Entry ID 445 (OID 18917)
--
-- Name: care_encounter Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 446 (OID 18927)
--
-- Name: care_encounter_diagnosis Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 447 (OID 18936)
--
-- Name: care_encounter_diagnostics_repo Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 448 (OID 18945)
--
-- Name: care_encounter_drg_intern Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 449 (OID 18954)
--
-- Name: care_encounter_event_signaller Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 450 (OID 18957)
--
-- Name: care_encounter_financial_class Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 451 (OID 18965)
--
-- Name: care_encounter_image Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 452 (OID 18974)
--
-- Name: care_encounter_immunization Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 453 (OID 18982)
--
-- Name: care_encounter_location Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 454 (OID 18992)
--
-- Name: care_encounter_measurement Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 455 (OID 19002)
--
-- Name: care_encounter_notes Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 456 (OID 19012)
--
-- Name: care_encounter_obstetric Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 457 (OID 19019)
--
-- Name: care_encounter_op Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 458 (OID 19030)
--
-- Name: care_encounter_prescription Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 459 (OID 19039)
--
-- Name: care_encounter_prescription_notes Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 460 (OID 19047)
--
-- Name: care_encounter_procedure Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 461 (OID 19056)
--
-- Name: care_encounter_sickconfirm Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 462 (OID 19065)
--
-- Name: care_group Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_group" VALUES (1,'pregnancy','Pregnancy','LDPregnancy','','','','0','','0');
INSERT INTO "care_group" VALUES (2,'neonatal','Neonatal','LDNeonatal','','','','0','','0');
INSERT INTO "care_group" VALUES (3,'encounter','Encounter','LDEncounter','','','','0','','0');
INSERT INTO "care_group" VALUES (4,'op','OP','LDOP','','','','0','','0');
INSERT INTO "care_group" VALUES (5,'anesthesia','Anesthesia','LDAnesthesia','','','','0','','0');
INSERT INTO "care_group" VALUES (6,'prescription','Prescription','LDPrescription','','','','0','','0');
--
-- Data for TOC Entry ID 463 (OID 19070)
--
-- Name: care_icd10_de Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 464 (OID 19076)
--
-- Name: care_icd10_en Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 465 (OID 19082)
--
-- Name: care_icd10_pt_br Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 466 (OID 19088)
--
-- Name: care_img_diagnostic Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 467 (OID 19097)
--
-- Name: care_insurance_firm Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 468 (OID 19104)
--
-- Name: care_mail_private Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 469 (OID 19110)
--
-- Name: care_mail_private_users Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 470 (OID 19116)
--
-- Name: care_med_ordercatalog Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 471 (OID 19125)
--
-- Name: care_med_orderlist Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 472 (OID 19134)
--
-- Name: care_med_products_main Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 473 (OID 19141)
--
-- Name: care_med_report Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 474 (OID 19157)
--
-- Name: care_method_induction Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_method_induction" VALUES (3,1,'prostaglandin','Prostaglandin','LDProstaglandin','','','','20030805191247','','0');
INSERT INTO "care_method_induction" VALUES (4,1,'oxytocin','Oxytocin','LDOxytocin','','','','20030805191254','','0');
INSERT INTO "care_method_induction" VALUES (5,1,'arom','AROM','LDAROM','','','','20030805191302','','0');
INSERT INTO "care_method_induction" VALUES (2,1,'unknown','Unknown','LDUnknown','','','','20030805191240','','0');
INSERT INTO "care_method_induction" VALUES (1,1,'not_induced','Not induced','LDNotInduced','','','','0','','0');
--
-- Data for TOC Entry ID 475 (OID 19162)
--
-- Name: care_mode_delivery Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_mode_delivery" VALUES (1,2,'normal','Normal','LDNormal','','','','0','','0');
INSERT INTO "care_mode_delivery" VALUES (2,2,'breech','Breech','LDBreech','','','','0','','0');
INSERT INTO "care_mode_delivery" VALUES (3,2,'caesarian','Caesarian','LDCaesarian','','','','0','','0');
INSERT INTO "care_mode_delivery" VALUES (4,2,'forceps','Forceps','LDForceps','','','','0','','0');
INSERT INTO "care_mode_delivery" VALUES (5,2,'vacuum','Vacuum','LDVacuum','','','','0','','0');
--
-- Data for TOC Entry ID 476 (OID 19167)
--
-- Name: care_neonatal Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 477 (OID 19178)
--
-- Name: care_news_article Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 478 (OID 19186)
--
-- Name: care_op_med_doc Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 479 (OID 19195)
--
-- Name: care_ops301_de Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 480 (OID 19213)
--
-- Name: care_person_insurance Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 481 (OID 19221)
--
-- Name: care_person_other_number Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 482 (OID 19228)
--
-- Name: care_personell Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 483 (OID 19237)
--
-- Name: care_personell_assignment Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 484 (OID 19246)
--
-- Name: care_pharma_ordercatalog Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 485 (OID 19254)
--
-- Name: care_pharma_orderlist Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 486 (OID 19263)
--
-- Name: care_pharma_products_main Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 487 (OID 19269)
--
-- Name: care_phone Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 488 (OID 19279)
--
-- Name: care_pregnancy Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 489 (OID 19288)
--
-- Name: care_registry Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_registry" VALUES ('amb','modules/ambulatory/ambulatory.php','modules/news/newscolumns.php','','','','','','','0','','0');
INSERT INTO "care_registry" VALUES ('dept','modules/news/departments.php','modules/news/newscolumns.php','','','','','','','0','','0');
INSERT INTO "care_registry" VALUES ('radiology','modules/radiology/radiolog.php','modules/news/newscolumns.php','','','','','','','0','','0');
INSERT INTO "care_registry" VALUES ('doctors','modules/doctors/doctors.php','modules/news/newscolumns.php','','','','','','','0','','0');
INSERT INTO "care_registry" VALUES ('nursing','modules/nursing/pflege.php','modules/news/newscolumns.php','','','','','','','0','','0');
INSERT INTO "care_registry" VALUES ('edp','modules/admin/edv.php','modules/news/newscolumns.php','','','','','','','0','','0');
INSERT INTO "care_registry" VALUES ('pharmacy','modules/pharmacy/apotheke.php','modules/news/newscolumns.php','','','','','','','0','','0');
INSERT INTO "care_registry" VALUES ('pr','modules/news/start_page.php','modules/news/start_page.php','modules/news/headline-edit.php','modules/news/headline-read.php','modules/news/editor-pass.php','','','','0','','0');
INSERT INTO "care_registry" VALUES ('cafe','modules/cafeteria/cafenews.php','modules/cafeteria/cafenews.php','modules/cafenews/cafenews-edit.php','modules/cafenews/cafenews-read.php','modules/cafenews/cafenews-edit-pass.php','','','','0','','0');
INSERT INTO "care_registry" VALUES ('main_start','modules/news/start_page.php','modules/news/start_page.php','modules/news/headline-edit-select-art.php','modules/news/headline-read.php','','','','','0','','0');
INSERT INTO "care_registry" VALUES ('it','modules/system_admin/edv.php','modules/news/newscolumns.php','modules/news/editor-4plus1-select-art.php','modules/news/editor-4plus1-read.php','','','','','0','','0');
INSERT INTO "care_registry" VALUES ('admission_module','modules/admission/aufnahme_start.php','','','','modules/admission/aufnahme_pass.php','','','','0','','0');
--
-- Data for TOC Entry ID 490 (OID 19294)
--
-- Name: care_role_person Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_role_person" VALUES (1,3,'contact','Contact person','LDContactPerson','','','0','','0');
INSERT INTO "care_role_person" VALUES (2,3,'guarantor','Guarantor','LDGuarantor','','','0','','0');
INSERT INTO "care_role_person" VALUES (3,3,'doctor_att','Attending doctor','LDAttDoctor','','','0','','0');
INSERT INTO "care_role_person" VALUES (4,3,'supervisor','Supervisor','LDSupervisor','','','0','','0');
INSERT INTO "care_role_person" VALUES (5,3,'doctor_admit','Admitting doctor','LDAdmittingDoctor','','','0','','0');
INSERT INTO "care_role_person" VALUES (6,3,'doctor_consult','Consulting doctor','LDConsultingDoctor','','','0','','0');
INSERT INTO "care_role_person" VALUES (7,4,'surgeon','Surgeon','LDSurgeon','','','0','','0');
INSERT INTO "care_role_person" VALUES (8,4,'surgeon_asst','Assisting surgeon','LDAssistingSurgeon','','','0','','0');
INSERT INTO "care_role_person" VALUES (9,4,'nurse_scrub','Scrub nurse','LDScrubNurse','','','0','','0');
INSERT INTO "care_role_person" VALUES (10,4,'nurse_rotating','Rotating nurse','LDRotatingNurse','','','0','','0');
INSERT INTO "care_role_person" VALUES (11,4,'nurse_anesthesia','Anesthesia nurse','LDAnesthesiaNurse','','','0','','0');
INSERT INTO "care_role_person" VALUES (12,4,'anesthesiologist','Anesthesiologist','LDAnesthesiologist','','','0','','0');
INSERT INTO "care_role_person" VALUES (13,4,'anesthesiologist_asst','Assisting anesthesiologist','LDAssistingAnesthesiologist','','','0','','0');
INSERT INTO "care_role_person" VALUES (14,0,'nurse_on_call','Nurse On Call','LDNurseOnCall','','','0','','0');
INSERT INTO "care_role_person" VALUES (15,0,'doctor_on_call','Doctor On Call','LDDoctorOnCall','','','0','','0');
INSERT INTO "care_role_person" VALUES (16,0,'nurse','Nurse','LDNurse','','','0','','0');
INSERT INTO "care_role_person" VALUES (17,0,'doctor','Doctor','LDDoctor','','','0','','0');
--
-- Data for TOC Entry ID 491 (OID 19299)
--
-- Name: care_room Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_room" VALUES (2,2,'2003-04-27','0001-01-01',0,2,0,0,1,'','','','','','0','','0');
INSERT INTO "care_room" VALUES (3,2,'2003-04-27','0001-01-01',0,3,0,0,1,'','','','','','0','','0');
INSERT INTO "care_room" VALUES (4,2,'2003-04-27','0001-01-01',0,4,0,0,1,'','','','','','0','','0');
INSERT INTO "care_room" VALUES (5,2,'2003-04-27','0001-01-01',0,5,0,0,1,'','','','','','0','','0');
INSERT INTO "care_room" VALUES (6,2,'2003-04-27','0001-01-01',0,6,0,0,1,'','','','','','0','','0');
INSERT INTO "care_room" VALUES (7,2,'2003-04-27','0001-01-01',0,7,0,0,1,'','','','','','0','','0');
INSERT INTO "care_room" VALUES (8,2,'2003-04-27','0001-01-01',0,8,0,0,1,'','','','','','0','','0');
INSERT INTO "care_room" VALUES (9,2,'2003-04-27','0001-01-01',0,9,0,0,1,'','','','','','0','','0');
INSERT INTO "care_room" VALUES (10,2,'2003-04-27','0001-01-01',0,10,0,0,1,'','','','','','0','','0');
INSERT INTO "care_room" VALUES (11,2,'2003-04-27','0001-01-01',0,11,0,0,1,'','','','','','0','','0');
INSERT INTO "care_room" VALUES (12,2,'2003-04-27','0001-01-01',0,12,0,0,1,'','','','','','0','','0');
INSERT INTO "care_room" VALUES (13,2,'2003-04-27','0001-01-01',0,13,0,0,1,'','','','','','0','','0');
INSERT INTO "care_room" VALUES (14,2,'2003-04-27','0001-01-01',0,14,0,0,1,'','','','','','0','','0');
INSERT INTO "care_room" VALUES (15,2,'2003-04-27','0001-01-01',0,15,0,0,1,'','','','','','0','','0');
INSERT INTO "care_room" VALUES (1,2,'2003-04-27','0001-01-01',0,1,0,0,1,'','','','Update: 2004-05-04 22:29:46 e name=System: bed=1: ward=: dept=: closed=0\015\012Update: 2004-05-04 22:29:56 e name=: bed=1: ward=: dept=: closed=0\015\012','e','20040504222956','','0');
--
-- Data for TOC Entry ID 492 (OID 19310)
--
-- Name: care_sessions Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 493 (OID 19317)
--
-- Name: care_standby_duty_report Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 494 (OID 19325)
--
-- Name: care_steri_products_main Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 495 (OID 19330)
--
-- Name: care_tech_questions Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 496 (OID 19338)
--
-- Name: care_tech_repair_done Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 497 (OID 19346)
--
-- Name: care_tech_repair_job Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 498 (OID 19354)
--
-- Name: care_test_findings_baclabor Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 499 (OID 19364)
--
-- Name: care_test_findings_chemlab Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 500 (OID 19372)
--
-- Name: care_test_findings_patho Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 501 (OID 19379)
--
-- Name: care_test_findings_radio Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 502 (OID 19386)
--
-- Name: care_test_group Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_test_group" VALUES (1,'priority','Priority',5,'','','0','','0');
INSERT INTO "care_test_group" VALUES (2,'clinical_chem','Clinical chemistry',10,'','','0','','0');
INSERT INTO "care_test_group" VALUES (3,'liquor','Liquor',15,'','','0','','0');
INSERT INTO "care_test_group" VALUES (4,'coagulation','Coagulation',20,'','','0','','0');
INSERT INTO "care_test_group" VALUES (5,'hematology','Hematology',25,'','','0','','0');
INSERT INTO "care_test_group" VALUES (6,'blood_sugar','Blood sugar',30,'','','0','','0');
INSERT INTO "care_test_group" VALUES (7,'neonate','Neonate',35,'','','0','','0');
INSERT INTO "care_test_group" VALUES (8,'proteins','Proteins',40,'','','0','','0');
INSERT INTO "care_test_group" VALUES (9,'thyroid','Thyroid',45,'','','0','','0');
INSERT INTO "care_test_group" VALUES (10,'hormones','Hormones',50,'','','0','','0');
INSERT INTO "care_test_group" VALUES (11,'tumor_marker','Tumor marker',55,'','','0','','0');
INSERT INTO "care_test_group" VALUES (12,'tissue_antibody','Tissue antibody',60,'','','0','','0');
INSERT INTO "care_test_group" VALUES (13,'rheuma_factor','Rheuma factor',65,'','','0','','0');
INSERT INTO "care_test_group" VALUES (14,'hepatitis','Hepatitis',70,'','','0','','0');
INSERT INTO "care_test_group" VALUES (15,'biopsy','Biopsy',75,'','','0','','0');
INSERT INTO "care_test_group" VALUES (16,'infection_serology','Infection serology',80,'','','0','','0');
INSERT INTO "care_test_group" VALUES (17,'medicines','Medicines',85,'','','0','','0');
INSERT INTO "care_test_group" VALUES (18,'prenatal','Prenatal',90,'','','0','','0');
INSERT INTO "care_test_group" VALUES (19,'stool','Stool',95,'','','0','','0');
INSERT INTO "care_test_group" VALUES (20,'rare','Rare',100,'','','0','','0');
INSERT INTO "care_test_group" VALUES (21,'urine','Urine',105,'','','0','','0');
INSERT INTO "care_test_group" VALUES (22,'total_urine','Total urine',110,'','','0','','0');
INSERT INTO "care_test_group" VALUES (23,'special_params','Special',115,'','','0','','0');
--
-- Data for TOC Entry ID 503 (OID 19392)
--
-- Name: care_test_param Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_test_param" VALUES (1,'priority','Quick','00q','mm/s','','','15','','','','','','','','0','','0');
INSERT INTO "care_test_param" VALUES (2,'priority','PTT','00ptt','mm/s','','350','','','','','','','','','0','','0');
INSERT INTO "care_test_param" VALUES (3,'priority','Hb','00hb','g/dl','','18','12','','','','','','','','0','','0');
INSERT INTO "care_test_param" VALUES (4,'priority','Hk','00hc','%','48','58','36','','','','','','','','0','','0');
INSERT INTO "care_test_param" VALUES (5,'priority','Platelets','00pla','c/cmm','','500000','200000','','','','','','','','0','','0');
INSERT INTO "care_test_param" VALUES (6,'priority','RBC','00rbc','mil/cmm','','5.5','4.5','','','','','','','','0','','0');
INSERT INTO "care_test_param" VALUES (7,'priority','WBC','00wbc','c/ccm','','9000','5000','','','','','','','','0','','0');
INSERT INTO "care_test_param" VALUES (8,'priority','Calcium','00ca','mEq/ml','','','','67','','','','','','','0','','0');
INSERT INTO "care_test_param" VALUES (9,'priority','Sodium','00na','mEq/ml','','100','20','','','','','','','','0','','0');
INSERT INTO "care_test_param" VALUES (10,'priority','Potassium','00k','mEq/ml','','100','10','','','','','','','','0','','0');
INSERT INTO "care_test_param" VALUES (11,'priority','Blood sugar','00sug','mg/dL','','140','','260','','','','','','','0','','0');
INSERT INTO "care_test_param" VALUES (12,'clinical_chem','Alk. Ph.','0aph','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (13,'clinical_chem','Alpha GT','0agt','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (14,'clinical_chem','Ammonia','0amm','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (15,'clinical_chem','Amylase','0amy','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (16,'clinical_chem','Bili total','0bit','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (17,'clinical_chem','Bili direct','0bid','','56','','','','','','','','','','0','','0');
INSERT INTO "care_test_param" VALUES (18,'clinical_chem','Calcium','0ca','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (19,'clinical_chem','Chloride','0chl','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (20,'clinical_chem','Chol','0cho','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (21,'clinical_chem','Cholinesterase','0chol','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (22,'clinical_chem','CKMB','0ccmb','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (23,'clinical_chem','CPK','0cpc','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (24,'clinical_chem','CRP','0crp','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (25,'clinical_chem','Iron','0fe','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (26,'clinical_chem','RBC','0rbc','c/ccm','','','','','','','','','','','0','','0');
INSERT INTO "care_test_param" VALUES (27,'clinical_chem','free HgB','0fhb','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (28,'clinical_chem','GLDH','0gldh','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (29,'clinical_chem','GOT','0got','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (30,'clinical_chem','GPT','0gpt','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (31,'clinical_chem','Uric acid','0ucid','','','','','','','','','','Update 2003-09-05 17:34:05 Elpidio Latorilla\012','','0','','0');
INSERT INTO "care_test_param" VALUES (32,'clinical_chem','Urea','0urea','','','','','','','','','','Update 2003-09-05 17:34:33 Elpidio Latorilla\012','','0','','0');
INSERT INTO "care_test_param" VALUES (33,'clinical_chem','HBDH','0hbdh','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (34,'clinical_chem','HDL Chol','0hdlc','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (35,'clinical_chem','Potassium','0pot','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (36,'clinical_chem','Creatinine','0cre','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (37,'clinical_chem','Copper','0co','','','','','','','','','','Update 2003-09-05 17:22:10 Elpidio Latorilla\012','','0','','0');
INSERT INTO "care_test_param" VALUES (38,'clinical_chem','Lactate i.P.','0lac','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (39,'clinical_chem','LDH','0ldh','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (40,'clinical_chem','LDL Chol','0ldlc','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (41,'clinical_chem','Lipase','0lip','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (42,'clinical_chem','Lipid Elpho','0lpid','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (43,'clinical_chem','Magnesium','0mg','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (44,'clinical_chem','Myoglobin','0myo','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (45,'clinical_chem','Sodium','0na','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (46,'clinical_chem','Osmolal.','0osm','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (47,'clinical_chem','Phosphor','0pho','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (48,'clinical_chem','Serum sugar','0glo','mg/dL','','140','','','','','','','','','0','','0');
INSERT INTO "care_test_param" VALUES (49,'clinical_chem','Tri','0tri','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (50,'clinical_chem','Troponin T','0tro','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (51,'liquor','Liquor status','1stat','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (52,'liquor','Liquor elpho','1elp','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (53,'liquor','Oligoclonales IgG','1oli','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (54,'liquor','Reiber Scheme','1sch','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (55,'liquor','A1','1a1','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (56,'coagulation','Fibrinolysis','2fiby','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (57,'coagulation','Quick','2q','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (58,'coagulation','PTT','2ptt','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (59,'coagulation','PTZ','2ptz','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (60,'coagulation','Fibrinogen','2fibg','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (61,'coagulation','Sol.Fibr.mon.','2fibs','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (62,'coagulation','FSP dimer','2fsp','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (63,'coagulation','Thr.Coag.','2coag','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (64,'coagulation','AT III','2at3','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (65,'coagulation','Faktor VII','2f8','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (66,'coagulation','APC Resistance','2apc','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (67,'coagulation','Protein C','2prc','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (68,'coagulation','Protein S','2prs','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (69,'coagulation','Bleeding time','2bt','ml/s','','','','','','','','','','','0','','0');
INSERT INTO "care_test_param" VALUES (70,'hematology','Retikulocytes','3ret','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (71,'hematology','Malaria','3mal','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (72,'hematology','Hb Elpho','3hbe','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (73,'hematology','HLA B 27','3hla','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (74,'hematology','Platelets AB','3tab','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (75,'hematology','WBC Phosp.','3wbp','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (76,'blood_sugar','Blood sugar fasting','4bsf','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (77,'blood_sugar','Blood sugar 9:00','4bs9','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (78,'blood_sugar','Blood sugar p.prandial','4bsp','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (79,'blood_sugar','Bl15:00','4bs15','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (80,'blood_sugar','Blood sugar 1','4bs1','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (81,'blood_sugar','Blood sugar 2','4bs2','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (82,'blood_sugar','Glucose stress.','4glo','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (83,'blood_sugar','Lactose stress','4lac','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (84,'blood_sugar','HBA 1c','4hba','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (86,'neonate','Neonate bilirubin','5bil','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (88,'neonate','Bilirubin direct','5bild','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (89,'neonate','Neonate sugar 1','5glo1','mg/dL','','','','','','','','','','','0','','0');
INSERT INTO "care_test_param" VALUES (90,'neonate','Neonate sugar 2','5glo2','mg/DL','','','30','','','','','','','','0','','0');
INSERT INTO "care_test_param" VALUES (91,'neonate','Reticulocytes','5ret','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (92,'neonate','B1','5b1','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (93,'proteins','Total proteins','6tot','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (94,'proteins','Albumin','6alb','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (95,'proteins','Elpho','6elp','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (96,'proteins','Immune fixation','6imm','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (97,'proteins','Beta2 Microglobulin.i.S','6b2','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (98,'proteins','Immune globulin quant.','6img','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (99,'proteins','IgE','6ige','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (100,'proteins','Haptoglobin','6hap','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (101,'proteins','Transferrin','6tra','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (102,'proteins','Ferritin','6fer','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (103,'proteins','Coeruloplasmin','6coe','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (104,'proteins','Alpha 1 Antitrypsin','6alp','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (105,'proteins','AFP Grav.','6afp','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (106,'proteins','SSW:','6ssw','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (107,'proteins','Alpha 1 Microglobulin','6mic','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (108,'thyroid','T3','7t3','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (109,'thyroid','Thyroxin/T4','7t4','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (110,'thyroid','TSH basal','7tshb','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (111,'thyroid','TSH stim.','7tshs','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (112,'thyroid','TAB','7tab','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (113,'thyroid','MAB','7mab','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (114,'thyroid','TRAB','7trab','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (115,'thyroid','Thyreoglobulin','7glob','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (116,'thyroid','Thyroxinbind.Glob.','7thx','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (117,'thyroid','free T3','7ft3','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (118,'thyroid','free T4','7ft4','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (119,'hormones','ACTH','8acth','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (120,'hormones','Aldosteron','8ald','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (121,'hormones','Calcitonin','8cal','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (122,'hormones','Cortisol','8cor','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (123,'hormones','Cortisol day','8dcor','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (124,'hormones','FSH','8fsh','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (125,'hormones','Gastrin','8gas','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (126,'hormones','HCG','8hcg','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (127,'hormones','Insulin','8ins','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (128,'hormones','Catecholam.i.P.','8cat','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (129,'hormones','LH','8lh','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (130,'hormones','Ostriol','8osd','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (131,'hormones','SSW:','8ssw','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (132,'hormones','Parat hormone','8par','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (133,'hormones','Progesteron','8prg','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (134,'hormones','Prolactin I','8pr1','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (135,'hormones','Prolactin II','8pr2','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (136,'hormones','Renin','8ren','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (137,'hormones','Serotonin','8ser','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (138,'hormones','Somatomedin C','8som','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (139,'hormones','Testosteron','8tes','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (140,'hormones','C1','8c1','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (141,'tumor_marker','AFP','9afp','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (142,'tumor_marker','CA. 15 3','9c153','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (143,'tumor_marker','CA. 19 9','9c199','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (144,'tumor_marker','CA. 125','9c125','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (145,'tumor_marker','CEA','9cea','','','','','','','','','','','','0','','0');
INSERT INTO "care_test_param" VALUES (146,'tumor_marker','Cyfra. 21 2','9c212','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (147,'tumor_marker','HCG','9hcg','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (148,'tumor_marker','NSE','9nse','test','','','','','','','','','','','0','','0');
INSERT INTO "care_test_param" VALUES (149,'tumor_marker','PSA','9psa','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (150,'tumor_marker','SCC','9scc','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (151,'tumor_marker','TPA','9tpa','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (152,'tissue_antibody','ANA','10ana','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (153,'tissue_antibody','AMA','ama','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (154,'tissue_antibody','DNS AB','10dnsab','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (155,'tissue_antibody','ASMA','10asm','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (156,'tissue_antibody','ENA','10ena','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (157,'tissue_antibody','ANCA','10anc','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (158,'rheuma_factor','Anti Strepto Titer','11ast','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (159,'rheuma_factor','Lat. RF','11lrf','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (160,'rheuma_factor','Streptozym','11stz','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (161,'rheuma_factor','Waaler Rose','11waa','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (162,'hepatitis','Anti HAV','12hav','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (163,'hepatitis','Anti HAV IgM','12hai','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (164,'hepatitis','Hbs Antigen','12hba','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (165,'hepatitis','Anti HBs Titer','12hbt','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (166,'hepatitis','Anti HBe','12hbe','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (167,'hepatitis','Anti HBc','12hbc','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (168,'hepatitis','Anti HBc.IgM','12hci','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (169,'hepatitis','Anti HCV','12hcv','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (170,'hepatitis','Hep.D Delta A.','12hda','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (171,'hepatitis','Anti HEV','12hev','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (172,'biopsy','Protein i.biopsy','13pro','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (173,'biopsy','LDH i.biopsy','13ldh','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (174,'biopsy','Chol.i.biopsy','13cho','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (175,'biopsy','CEA i.biopsy','13cea','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (176,'biopsy','AFP i.biopsy','13afp','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (177,'biopsy','Uric acid.i.biopsy','13ure','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (178,'biopsy','Rheuma fact.i.biopsy','13rhe','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (179,'biopsy','D1','13d1','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (180,'biopsy','D2','13d2','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (181,'infection_serology','Antistaph.Titer','14stap','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (182,'infection_serology','Adenovirus AB','14ade','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (185,'infection_serology','Brucellia AB','14bru','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (186,'infection_serology','Campylob. AB','14cam','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (187,'infection_serology','Candida AB','14can','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (188,'infection_serology','Cardiotr.Virus','14car','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (190,'infection_serology','C.psittaci AB','14psi','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (191,'infection_serology','Coxsack. AB','14cox','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (193,'infection_serology','Cytomegaly AB','14cyt','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (194,'infection_serology','EBV AB','14ebv','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (195,'infection_serology','Echinococcus AB','14ecc','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (196,'infection_serology','Echo Virus AB','14ecv','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (197,'infection_serology','FSME AB','14fsme','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (198,'infection_serology','Herpes simp. I AB','14hs1','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (199,'infection_serology','Herpes simp. II AB','14hs2','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (200,'infection_serology','HIV1/HIV2 AB','14hiv','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (201,'infection_serology','Influenza A AB','14ina','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (202,'infection_serology','Influenza B AB','14inb','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (203,'infection_serology','LCM AB','14lcm','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (204,'infection_serology','Leg.pneum AB','14leg','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (205,'infection_serology','Leptospiria AB','14lep','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (206,'infection_serology','Listeria AB','14lis','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (207,'infection_serology','Masern AB','14mas','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (208,'infection_serology','Mononucleose','14mon','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (209,'infection_serology','Mumps AB','14mum','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (210,'infection_serology','Mycoplas.pneum AB','14myc','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (211,'infection_serology','Neutrop Virus AB','14neu','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (212,'infection_serology','Parainfluenza II AB','14pi2','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (213,'infection_serology','Parainfluenza III AB','14pi3','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (214,'infection_serology','Picorna Virus AB','14pic','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (215,'infection_serology','Rickettsia AB','14vric','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (216,'infection_serology','Röteln AB','14rot','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (217,'infection_serology','Röteln Immune status','14roi','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (218,'infection_serology','RS Virus AB','14rsv','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (219,'infection_serology','Shigella/Salm AB','14shi','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (220,'infection_serology','Toxoplasma AB','14tox','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (221,'infection_serology','TPHA','14tpha','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (222,'infection_serology','Varicella AB','14vrc','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (223,'infection_serology','Yersinia AB','14yer','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (224,'infection_serology','E1','14e1','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (225,'infection_serology','E2','14e2','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (226,'infection_serology','E3','14e3','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (227,'infection_serology','E4','14e4','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (228,'medicines','Amiodaron','15ami','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (229,'medicines','Barbiturate.i.S.','15bar','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (230,'medicines','Benzodiazep.i.S.','15ben','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (231,'medicines','Carbamazepin','15car','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (232,'medicines','Clonazepam','15clo','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (233,'medicines','Digitoxin','15dig','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (234,'medicines','Digoxin','15dgo','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (235,'medicines','Gentamycin','15gen','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (236,'medicines','Lithium','15lit','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (237,'medicines','Phenobarbital','15phe','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (238,'medicines','Phenytoin','15pny','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (239,'medicines','Primidon','15pri','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (240,'medicines','Salicylic acid','15sal','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (241,'medicines','Theophyllin','15the','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (242,'medicines','Tobramycin','15tob','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (243,'medicines','Valproin acid','15val','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (244,'medicines','Vancomycin','15van','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (245,'medicines','Amphetamine.i.u.','15amp','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (246,'medicines','Antidepressant.i.u.','15ant','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (247,'medicines','Barbiturate.i.u.','15bau','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (248,'medicines','Benzodiazep.i.u.','15beu','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (249,'medicines','Cannabinol.i.u.','15can','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (250,'medicines','Cocain.i.u','15coc','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (251,'medicines','Methadon.i.u.','15met','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (252,'medicines','Opiate.i.u.','15opi','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (253,'prenatal','Chlamyd.cult./SSW','16chl','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (254,'prenatal','SSW:','16ssw','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (255,'prenatal','Down Screening','16dow','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (256,'prenatal','Strep B quick test','16stb','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (257,'prenatal','TPHA','16tpha','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (258,'prenatal','HBs Ag','16hbs','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (259,'prenatal','HIV1/HIV2 AV','16hiv','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (260,'stool','Chymotrypsin','17chy','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (261,'stool','Occult blood 1','17ob1','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (262,'stool','Occult blood 2','17ob2','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (263,'stool','Occult blood 3','17ob3','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (264,'rare','Rare H.','18rh','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (265,'rare','Rare E.','18re','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (266,'rare','Rare S.','18rs','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (267,'rare','Urine rare','18uri','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (268,'rare','F1','18f1','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (269,'rare','F2','18f2','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (270,'rare','F3','18f3','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (271,'urine','Urine amylase','19amy','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (272,'urine','Urine sugar','19sug','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (273,'urine','Protein.i.u.','19pro','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (274,'urine','Albumin.i.u.','19alb','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (275,'urine','Osmol.i.u.','19osm','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (276,'urine','Pregnancy test.','19pre','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (277,'urine','Cytomeg.i.urine','19cym','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (278,'urine','Urine cytology','19cyt','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (279,'urine','Bence Jones','19bj','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (280,'urine','Urine elpho','19elp','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (281,'urine','Beta2 microglobulin.i.u.','19bm2','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (282,'total_urine','Addis Count','20adc','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (283,'total_urine','Sodium i.u.','20na','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (284,'total_urine','Potass. i.u.','20k','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (285,'total_urine','Calcium i.u.','20ca','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (286,'total_urine','Phospor i.u.','20pho','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (287,'total_urine','Uric acid i.u.','20ura','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (288,'total_urine','Creatinin i.u.','20cre','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (289,'total_urine','Porphyrine i.u.','20por','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (290,'total_urine','Cortisol i.u.','20cor','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (291,'total_urine','Hydroxyprolin i.u.','20hyd','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (292,'total_urine','Catecholamins i.u.','20cat','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (293,'total_urine','Pancreol.','20pan','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (294,'total_urine','Gamma Aminoläbulinsre.i.u.','20gam','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (295,'special_params','Blood alcohol','21bal','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (296,'special_params','CDT','21cdt','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (297,'special_params','Vitamin B12','21vb12','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (298,'special_params','Folic acid','21fol','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (299,'special_params','Insulin AB','21inab','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (300,'special_params','Intrinsic AB','21iab','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (301,'special_params','Stone analysis','21sto','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (302,'special_params','ACE','21ace','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (303,'special_params','G1','21g1','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (304,'special_params','G2','21g2','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (305,'special_params','G3','21g3','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (306,'special_params','G4','21g4','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (307,'special_params','G5','21g5','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (308,'special_params','G6','21g6','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (309,'special_params','G7','21g7','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (310,'special_params','G8','21g8','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (311,'special_params','G9','21g9','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (312,'special_params','G10','21g10','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','','','0','','0');
INSERT INTO "care_test_param" VALUES (189,'infection_serology','Chlamydia AB','14chl','33','asdfa',NULL,NULL,NULL,NULL,NULL,NULL,'','Update 2004-04-17 03:05:32 e\012','e','0','','0');
INSERT INTO "care_test_param" VALUES (183,'infection_serology','Borrelia AB','14bor','cm','33','33','33',NULL,NULL,NULL,NULL,'','Update 2004-04-17 03:07:11 e\012','e','0','','0');
INSERT INTO "care_test_param" VALUES (184,'infection_serology','Borr.Immunoblot','14bori','cm','66','66','66',NULL,NULL,NULL,NULL,'','Update 2004-04-17 03:09:59 e\012','e','0','','0');
INSERT INTO "care_test_param" VALUES (192,'infection_serology','Cox.burn. AB(Q fever)','14qf','mm','345','2342','533',NULL,NULL,NULL,NULL,'','Update 2004-04-17 03:16:02 e\012','e','0','','0');
INSERT INTO "care_test_param" VALUES (85,'blood_sugar','Fructosamine','4fru','µnn','32','3','555',NULL,NULL,NULL,NULL,'','Update 2004-04-17 03:18:37 e\012','e','0','','0');
INSERT INTO "care_test_param" VALUES (87,'neonate','Cord bilirubin','5bilc','cm','33','56','12',NULL,NULL,NULL,NULL,'','Update 2004-04-20 18:49:06 e\012','e','0','','0');
--
-- Data for TOC Entry ID 504 (OID 19400)
--
-- Name: care_test_request_baclabor Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 505 (OID 19409)
--
-- Name: care_test_request_blood Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 506 (OID 19418)
--
-- Name: care_test_request_chemlabor Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 507 (OID 19427)
--
-- Name: care_test_request_generic Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 508 (OID 19447)
--
-- Name: care_test_request_radio Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 509 (OID 19583)
--
-- Name: care_unit_measurement Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_unit_measurement" VALUES (1,1,'ml','Milliliter','LDMilliliter','metric','0','','','0','','0');
INSERT INTO "care_unit_measurement" VALUES (2,2,'mg','Milligram','LDMilligram','metric','0','','','0','','0');
INSERT INTO "care_unit_measurement" VALUES (3,3,'mm','Millimeter','LDMillimeter','metric','0','','','0','','0');
INSERT INTO "care_unit_measurement" VALUES (4,1,'ltr','liter','LDLiter','metric','0','','','20030727131658','','0');
INSERT INTO "care_unit_measurement" VALUES (5,2,'gm','gram','LDGram','metric','0','','','0','','0');
INSERT INTO "care_unit_measurement" VALUES (6,2,'kg','kilogram','LDKilogram','metric','0','','','0','','0');
INSERT INTO "care_unit_measurement" VALUES (7,3,'cm','centimeter','LDCentimeter','metric','0','','','0','','0');
INSERT INTO "care_unit_measurement" VALUES (8,3,'m','meter','LDMeter','metric','0','','','0','','0');
INSERT INTO "care_unit_measurement" VALUES (9,3,'km','kilometer','LDKilometer','metric','0','','','0','','0');
INSERT INTO "care_unit_measurement" VALUES (10,3,'in','inch','LDInch','english','0','','','0','','0');
INSERT INTO "care_unit_measurement" VALUES (11,3,'ft','foot','LDFoot','english','0','','','0','','0');
INSERT INTO "care_unit_measurement" VALUES (12,3,'yd','yard','LDYard','english','0','','','0','','0');
INSERT INTO "care_unit_measurement" VALUES (14,4,'mmHg','mmHg','LDmmHg','metric','0','','','0','','0');
INSERT INTO "care_unit_measurement" VALUES (15,5,'celsius','Celsius','LDCelsius','metric','0','','','0','','0');
INSERT INTO "care_unit_measurement" VALUES (16,1,'dl','deciliter','LDDeciliter','metric','0','','','0','','0');
INSERT INTO "care_unit_measurement" VALUES (17,1,'cl','centiliter','LDCentiliter','metric','0','','','0','','0');
INSERT INTO "care_unit_measurement" VALUES (18,1,'µl','microliter','LDMicroliter','metric','0','','','0','','0');

--
-- Data for TOC Entry ID 511 (OID 19595)
--
-- Name: care_version Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_version" VALUES ('CARE2X','beta','2.0.0','1.0','2004-05-30','00:00:00','Elpidio Latorilla');
--
-- Data for TOC Entry ID 512 (OID 19597)
--
-- Name: care_ward Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 513 (OID 19687)
--
-- Name: care_menu_main Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_menu_main" VALUES (1,1,'Home','LDHome','main/startframe.php',1,'','','20030922232015','0');
INSERT INTO "care_menu_main" VALUES (2,5,'Patient','LDPatient','modules/registration_admission/patient_register_pass.php',1,'','','20030922232015','0');
INSERT INTO "care_menu_main" VALUES (3,10,'Admission','LDAdmission','modules/registration_admission/aufnahme_pass.php',1,'','','20030922232015','0');
INSERT INTO "care_menu_main" VALUES (4,15,'Ambulatory','LDAmbulatory','modules/ambulatory/ambulatory.php',1,'','','20030922232015','0');
INSERT INTO "care_menu_main" VALUES (5,20,'Medocs','LDMedocs','modules/medocs/medocs_pass.php',1,'','','20030922232015','0');
INSERT INTO "care_menu_main" VALUES (6,25,'Doctors','LDDoctors','modules/doctors/doctors.php',1,'','','20030922232015','0');
INSERT INTO "care_menu_main" VALUES (7,35,'Nursing','LDNursing','modules/nursing/nursing.php',1,'','','20030922232015','0');
INSERT INTO "care_menu_main" VALUES (8,40,'OR','LDOR','main/op-doku.php',1,'','','20030922232015','0');
INSERT INTO "care_menu_main" VALUES (9,45,'Laboratories','LDLabs','modules/laboratory/labor.php',1,'','','20030922232015','0');
INSERT INTO "care_menu_main" VALUES (10,50,'Radiology','LDRadiology','modules/radiology/radiolog.php',1,'','','20030922232015','0');
INSERT INTO "care_menu_main" VALUES (11,55,'Pharmacy','LDPharmacy','modules/pharmacy/apotheke.php',1,'','','20030922232015','0');
INSERT INTO "care_menu_main" VALUES (12,60,'Medical Depot','LDMedDepot','modules/med_depot/medlager.php',1,'','','20030922232015','0');
INSERT INTO "care_menu_main" VALUES (13,82,'Directory','LDDirectory','modules/phone_directory/phone.php',1,'','','20030922232015','0');
INSERT INTO "care_menu_main" VALUES (14,70,'Tech Support','LDTechSupport','modules/tech/technik.php',1,'','','20030922232015','0');
INSERT INTO "care_menu_main" VALUES (15,72,'System Admin','LDEDP','modules/system_admin/edv.php',1,'','','20030922232015','0');
INSERT INTO "care_menu_main" VALUES (16,75,'Intranet Email','LDIntraEmail','modules/intranet_email/intra-email-pass.php',1,'','','20030922232015','0');
INSERT INTO "care_menu_main" VALUES (17,80,'Internet Email','LDInterEmail','modules/nocc/index.php',1,'','','20030922232015','0');
INSERT INTO "care_menu_main" VALUES (18,85,'Special Tools','LDSpecials','main/spediens.php',1,'','','20030922232015','0');
INSERT INTO "care_menu_main" VALUES (19,99,'Login','LDLogin','main/login.php',1,'','','20030922232015','0');
INSERT INTO "care_menu_main" VALUES (20,7,'Appointments','LDAppointments','modules/appointment_scheduler/appt_main_pass.php',1,'','','20030922232015','20030405000145');

-- Data for care_menu_sub

INSERT INTO "care_menu_sub"  VALUES ('3', '0', '2', '0', '', '', '', '', '../gui/img/common/default/new_group.gif', '../gui/img/common/default/new_group.gif', '1', '', '', '', '0001-01-01 00:00:00');
INSERT INTO "care_menu_sub"  VALUES ('70', '0', '7', '0', '', '', '', '', '../gui/img/common/default/nurse.gif', '../gui/img/common/default/nurse.gif', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO "care_menu_sub"  VALUES ('20', '0', '1', '0', '', '', '', '', '../gui/img/common/default/articles.gif', '../gui/img/common/default/home.gif', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO "care_menu_sub"  VALUES ('30', '0', '20', '0', '', '', '', '', '../gui/img/common/default/calendar.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO "care_menu_sub"  VALUES ('5', '2', '2', '1', 'Admission', 'LDAdmission', '../modules/registration_admission/aufnahme_pass.php', '', '../gui/img/common/default/bn.gif', '../gui/img/common/default/bn.gif', '1', '', '', '', '0001-01-01 00:00:00');
INSERT INTO "care_menu_sub"  VALUES ('1', '1', '2', '1', 'Registration', '', '../modules/registration_admission/patient_register_pass.php', '&target=entry', '../gui/img/common/default/post_discussion.gif', '', '1', '', '', '', '0001-01-01 00:00:00');
INSERT INTO "care_menu_sub"  VALUES ('130', '1', '2', '1', 'Search', 'LDSearch', '../modules/registration_admission/patient_register_pass.php', '&target=search', '../gui/img/common/default/findnew.gif', '../gui/img/common/default/findnew.gif', '1', '', '', '', '0001-01-01 00:00:00');
INSERT INTO "care_menu_sub"  VALUES ('135', '1', '2', '1', 'Archive', 'LDArchive', '../modules/registration_admission/patient_register_pass.php', '&target=archiv', '', '', '1', '', '', '', '0001-01-01 00:00:00');
INSERT INTO "care_menu_sub"  VALUES ('140', '5', '2', '2', 'Search', 'LDSearch', '../modules/registration_admission/aufnahme_pass.php', '&target=search', '../gui/img/common/default/findnew.gif', '../gui/img/common/default/findnew.gif', '1', '', '', '', '0001-01-01 00:00:00');
INSERT INTO "care_menu_sub"  VALUES ('145', '6', '2', '2', 'Archive', 'LDArchive', '../modules/registration_admission/aufnahme_pass.php', '&target=archiv', '', '', '1', '', '', '', '0001-01-01 00:00:00');
INSERT INTO "care_menu_sub"  VALUES ('71', '1', '7', '1', 'Wards', '', '../modules/nursing/nursing.php', '', '../gui/img/common/default/bul_arrowgrnsm.gif', '../gui/img/common/default/bul_arrowgrnsm.gif', '', '', '[station]', '', '0001-01-01 00:00:00');
INSERT INTO "care_menu_sub"  VALUES ('155', '1', '3', '1', 'Archive', 'LDArchive', '../modules/registration_admission/aufnahme_pass.php', '&target=archiv', '', '', '1', '', '', '', '0001-01-01 00:00:00');
INSERT INTO "care_menu_sub"  VALUES ('40', '0', '3', '0', '', '', '', '', '../gui/img/common/default/bn.gif', '../gui/img/common/default/bn.gif', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO "care_menu_sub"  VALUES ('165', '0', '13', '0', '', '', '', '', '../gui/img/common/default/violet_phone.gif', '../gui/img/common/default/violet_phone.gif', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO "care_menu_sub"  VALUES ('7', '3', '7', '1', 'Search', '', '../modules/nursing/nursing-patient-such-start.php', '', '../gui/img/common/default/findnew.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO "care_menu_sub"  VALUES ('72', '2', '7', '1', 'Quick view', '', '../modules/nursing/nursing-schnellsicht.php', '', '../gui/img/common/default/eye_s.gif', '', '1', '', '', '', '0001-01-01 00:00:00');
INSERT INTO "care_menu_sub"  VALUES ('50', '0', '4', '0', '', '', '', '', '../gui/img/common/default/disc_unrd.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO "care_menu_sub"  VALUES ('120', '0', '6', '0', '', '', '', '', '../gui/img/common/default/forums.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO "care_menu_sub"  VALUES ('160', '0', '17', '0', '', '', '', '', '../gui/img/common/default/c-mail.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO "care_menu_sub"  VALUES ('190', '0', '16', '0', '', '', '', '', '../gui/img/common/default/bubble2.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO "care_menu_sub"  VALUES ('195', '0', '10', '0', '', '', '', '', '../gui/img/common/default/torso.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO "care_menu_sub"  VALUES ('200', '0', '18', '0', '', '', '', '', '../gui/img/common/default/settings_tree.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO "care_menu_sub"  VALUES ('205', '0', '11', '0', '', '', '', '', '../gui/img/common/default/add.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO "care_menu_sub"  VALUES ('160', '0', '19', '0', '', '', '', '', '../gui/img/common/default/padlock.gif', '../gui/img/common/default/bul_arrowgrnsm.gif', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO "care_menu_sub"  VALUES ('215', '0', '15', '0', '', '', '', '', '../gui/img/common/default/sections.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO "care_menu_sub"  VALUES ('220', '0', '12', '0', '', '', '', '', '../gui/img/common/default/storage.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO "care_menu_sub"  VALUES ('225', '0', '8', '0', '', '', '', '', '../gui/img/common/default/people_search_online.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO "care_menu_sub"  VALUES ('230', '0', '9', '0', '', '', '', '', '../gui/img/common/default/chart.gif', '', '', '', '', '', '0001-01-01 00:00:00');
INSERT INTO "care_menu_sub"  VALUES ('235', '0', '14', '0', '', '', '', '', '../gui/img/common/default/settings_tree.gif', '', '', '', '', '', '0001-01-01 00:00:00');


--
-- Data for TOC Entry ID 514 (OID 19733)
--
-- Name: care_type_anaesthesia Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_type_anaesthesia" VALUES (1,'none','None','LDNone','','','','0','','0');
INSERT INTO "care_type_anaesthesia" VALUES (2,'unknown','Unknown','LDUnknown','','','','0','','0');
INSERT INTO "care_type_anaesthesia" VALUES (3,'general','General','LDGeneral','','','','0','','0');
INSERT INTO "care_type_anaesthesia" VALUES (4,'spinal','Spinal','LDSpinal','','','','0','','0');
INSERT INTO "care_type_anaesthesia" VALUES (5,'epidural','Epidural','LDEpidural','','','','0','','0');
INSERT INTO "care_type_anaesthesia" VALUES (6,'pudendal','Pudendal','LDPudendal','','','','0','','0');
--
-- Data for TOC Entry ID 515 (OID 19739)
--
-- Name: care_type_application Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_type_application" VALUES (1,5,'ita','ITA','LDITA','Intratracheal anesthesia','','','0','','0');
INSERT INTO "care_type_application" VALUES (2,5,'la','LA','LDLA','Locally applied anesthesia','','','0','','0');
INSERT INTO "care_type_application" VALUES (3,5,'as','AS','LDAS','Analgesic sedation','','','0','','0');
INSERT INTO "care_type_application" VALUES (4,5,'mask','Mask','LDMask','Gas anesthesia through breathing mask','','','0','','0');
INSERT INTO "care_type_application" VALUES (5,6,'oral','Oral','LDOral','','','','0','','0');
INSERT INTO "care_type_application" VALUES (6,6,'iv','Intravenous','LDIntravenous','','','','0','preload','0');
INSERT INTO "care_type_application" VALUES (7,6,'sc','Subcutaneous','LDSubcutaneous','','','','0','preload','0');
INSERT INTO "care_type_application" VALUES (8,6,'im','Intramuscular','LDIntramuscular','','','','0','preload','0');
INSERT INTO "care_type_application" VALUES (9,6,'sublingual','Sublingual','LDSublingual','Applied under the tounge','','','0','preload','0');
INSERT INTO "care_type_application" VALUES (10,6,'ia','Intraarterial','LDIntraArterial','','','','0','preload','0');
INSERT INTO "care_type_application" VALUES (11,6,'pre_admit','Pre-admission','LDPreAdmission','','','','0','preload','0');
--
-- Data for TOC Entry ID 516 (OID 19744)
--
-- Name: care_type_assignment Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_type_assignment" VALUES (1,'ward','Ward','LDWard','','','','0','','0');
INSERT INTO "care_type_assignment" VALUES (2,'dept','Department','LDDepartment','','','','0','','0');
INSERT INTO "care_type_assignment" VALUES (3,'firm','Firm','LDFirm','','','','0','','0');
INSERT INTO "care_type_assignment" VALUES (4,'clinic','Clinic','LDClinic','','','','0','','0');
--
-- Data for TOC Entry ID 517 (OID 19752)
--
-- Name: care_type_cause_opdelay Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_type_cause_opdelay" VALUES (1,'patient','Patient was delayed','LDPatientDelayed','','','0','','0');
INSERT INTO "care_type_cause_opdelay" VALUES (2,'nurse','Nurses were delayed','LDNursesDelayed','','','0','','0');
INSERT INTO "care_type_cause_opdelay" VALUES (3,'surgeon','Surgeons were delayed','LDSurgeonsDelayed','','','0','','0');
INSERT INTO "care_type_cause_opdelay" VALUES (4,'cleaning','Cleaning delayed','LDCleaningDelayed','','','0','','0');
INSERT INTO "care_type_cause_opdelay" VALUES (5,'anesthesia','Anesthesiologist was delayed','LDAnesthesiologistDelayed','','','0','','0');
INSERT INTO "care_type_cause_opdelay" VALUES (0,'other','Other causes','LDOtherCauses','','','0','','0');
--
-- Data for TOC Entry ID 518 (OID 19757)
--
-- Name: care_type_color Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_type_color" VALUES ('yellow','yellow','LDyellow','','','0');
INSERT INTO "care_type_color" VALUES ('black','black','LDblack','','','0');
INSERT INTO "care_type_color" VALUES ('blue_pale','pale blue','LDpaleblue','','','0');
INSERT INTO "care_type_color" VALUES ('brown','brown','LDbrown','','','0');
INSERT INTO "care_type_color" VALUES ('pink','pink','LDpink','','','0');
INSERT INTO "care_type_color" VALUES ('yellow_pale','pale yellow','LDpaleyellow','','','0');
INSERT INTO "care_type_color" VALUES ('red','red','LDred','','','0');
INSERT INTO "care_type_color" VALUES ('green_pale','pale green','LDpalegreen','','','0');
INSERT INTO "care_type_color" VALUES ('violet','violet','LDviolet','','','0');
INSERT INTO "care_type_color" VALUES ('blue','blue','LDblue','','','0');
INSERT INTO "care_type_color" VALUES ('biege','biege','LDbiege','','','0');
INSERT INTO "care_type_color" VALUES ('orange','orange','LDorange','','','0');
INSERT INTO "care_type_color" VALUES ('green','green','LDgreen','','','0');
INSERT INTO "care_type_color" VALUES ('rose','rose','LDrose','','','0');
--
-- Data for TOC Entry ID 519 (OID 19760)
--
-- Name: care_type_department Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_type_department" VALUES (1,'medical','Medical','LDMedical','Medical, Nursing, Diagnostics, Labs, OR','','','0','','0');
INSERT INTO "care_type_department" VALUES (2,'support','Support (non-medical)','LDSupport','non-medical departments','','','0','','0');
INSERT INTO "care_type_department" VALUES (3,'news','News','LDNews','News group or category','','','0','','0');
--
-- Data for TOC Entry ID 520 (OID 19765)
--
-- Name: care_type_discharge Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_type_discharge" VALUES (1,'regular','Regular discharge','LDRegularRelease','','','20030415010555','','20030413121226');
INSERT INTO "care_type_discharge" VALUES (2,'own','Patient left hospital on his own will','LDSelfRelease','','','20030415010606','','20030413121317');
INSERT INTO "care_type_discharge" VALUES (3,'emergency','Emergency discharge','LDEmRelease','','','20030415010617','','20030413121452');
INSERT INTO "care_type_discharge" VALUES (4,'change_ward','Change of ward','LDChangeWard','','','0','','20030413121526');
INSERT INTO "care_type_discharge" VALUES (6,'change_bed','Change of bed','LDChangeBed','','','20030415000942','','20030413121619');
INSERT INTO "care_type_discharge" VALUES (7,'death','Death of patient','LDPatientDied','','','20030415010642','','0');
INSERT INTO "care_type_discharge" VALUES (5,'change_room','Change of room','LDChangeRoom','','','20030415010659','','0');
INSERT INTO "care_type_discharge" VALUES (8,'change_dept','Change of department','LDChangeDept','','','0','','0');
--
-- Data for TOC Entry ID 521 (OID 19770)
--
-- Name: care_type_duty Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_type_duty" VALUES (1,'regular','Regular duty','LDRegularDuty','','','','0','','0');
INSERT INTO "care_type_duty" VALUES (2,'standby','Standby duty','LDStandbyDuty','','','','0','','0');
INSERT INTO "care_type_duty" VALUES (3,'morning','Morning duty','LDMorningDuty','','','','0','','0');
INSERT INTO "care_type_duty" VALUES (4,'afternoon','Afternoon duty','LDAfternoonDuty','','','','0','','0');
INSERT INTO "care_type_duty" VALUES (5,'night','Night duty','LDNightDuty','','','','0','','0');
--
-- Data for TOC Entry ID 522 (OID 19775)
--
-- Name: care_type_encounter Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_type_encounter" VALUES (1,'referral','Referral','LDEncounterReferral','Referral admission or visit',0,'','','','0','','0');
INSERT INTO "care_type_encounter" VALUES (2,'emergency','Emergency','LDEmergency','Emergency admission or visit',0,'','','','0','','0');
INSERT INTO "care_type_encounter" VALUES (3,'birth_delivery','Birth delivery','LDBirthDelivery','Admission or visit for birth delivery',0,'','','','0','','0');
INSERT INTO "care_type_encounter" VALUES (4,'walk_in','Walk-in','LDWalkIn','Walk -in admission or visit (non-referred)',0,'','','','0','','0');
INSERT INTO "care_type_encounter" VALUES (5,'accident','Accident','LDAccident','Emergency admission due to accident',0,'','','','0','','0');
--
-- Data for TOC Entry ID 523 (OID 19783)
--
-- Name: care_type_ethnic_orig Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_type_ethnic_orig" VALUES (1,1,'asian','LDAsian','','','0','','0');
INSERT INTO "care_type_ethnic_orig" VALUES (2,1,'black','LDBlack','','','0','','0');
INSERT INTO "care_type_ethnic_orig" VALUES (3,1,'caucasian','LDCaucasian','','','0','','0');
INSERT INTO "care_type_ethnic_orig" VALUES (4,1,'white','LDWhite','','','0','','0');
--
-- Data for TOC Entry ID 524 (OID 19788)
--
-- Name: care_type_feeding Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_type_feeding" VALUES (1,2,'breast','Breast','LDBreast','','','','0','','0');
INSERT INTO "care_type_feeding" VALUES (2,2,'formula','Formula','LDFormula','','','','0','','0');
INSERT INTO "care_type_feeding" VALUES (3,2,'both','Both','LDBoth','','','','0','','0');
INSERT INTO "care_type_feeding" VALUES (4,2,'parenteral','Parenteral','LDParenteral','','','','20030727221351','','0');
INSERT INTO "care_type_feeding" VALUES (5,2,'never_fed','Never fed','LDNeverFed','','','','0','','0');
--
-- Data for TOC Entry ID 525 (OID 19793)
--
-- Name: care_type_insurance Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_type_insurance" VALUES (1,'medical_main','Medical insurance','LDMedInsurance','Main (default) medical insurance','','','','0','','0');
INSERT INTO "care_type_insurance" VALUES (2,'medical_extra','Extra medical insurance','LDExtraMedInsurance','Extra medical insurance (evt. pays extra services)','','','','0','','0');
INSERT INTO "care_type_insurance" VALUES (3,'dental','Dental insurance','LDDentalInsurance','Separate dental plan in case not included in medical plan or simply additional private plan','','','','0','','0');
INSERT INTO "care_type_insurance" VALUES (4,'disability','Disability plan','LDDisabilityPlan','Disability insurance plan - general , both long term & short term','','','','0','','0');
INSERT INTO "care_type_insurance" VALUES (5,'disability_short','Disability plan (short term)','LDDisabilityPlanShort','Short term disability plan','','','','0','','0');
INSERT INTO "care_type_insurance" VALUES (6,'disability_long','Disability plan (long term)','LDDisabilityPlanLong','Long term disability plan','','','','0','','0');
INSERT INTO "care_type_insurance" VALUES (7,'retirement_income','Retirement  income plan (general)','LDRetirementIncomePlan','Retirement income plan - either private or income/employer supported','','','','0','','0');
INSERT INTO "care_type_insurance" VALUES (8,'edu_reimbursement','Educational Reimbursement Plan','LDEduReimbursementPlan','Reimbursement plan for education, either private or employer supported','','','','0','','0');
INSERT INTO "care_type_insurance" VALUES (9,'retirement_medical','Retirement medical plan','LDRetirementMedPlan','Medical plan in retirement  - might include other care services','','','','0','','0');
INSERT INTO "care_type_insurance" VALUES (10,'liability','Liability Insurance Plan','LDLiabilityPlan','General liability insurance - either private or employer supported','','','','0','','0');
INSERT INTO "care_type_insurance" VALUES (11,'malpractice','Malpractice Insurance Plan','LDMalpracticeInsurancePlan','Insurance plan against possible malpractice','','','','0','','0');
INSERT INTO "care_type_insurance" VALUES (12,'unemployment','Unemployment Insurance Plan','LDUnemploymentPlan','Unemployment insurance , in case compulsory unemployment funds are guaranteed by the state, this plan is usually privately paid by the insured','','','','0','','0');
--
-- Data for TOC Entry ID 526 (OID 19801)
--
-- Name: care_type_localization Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_type_localization" VALUES (1,'left','Left','LDLeft','L','LDLeft_s','','0','','','','20030525150414','','20030525150414');
INSERT INTO "care_type_localization" VALUES (2,'right','Right','LDRight','R','LDRight_s','','0','','','','20030525150522','','20030525150500');
INSERT INTO "care_type_localization" VALUES (3,'both_side','Both sides','LDBothSides','B','LDBothSides_s','','0','','','','20030525150618','','20030525150618');
--
-- Data for TOC Entry ID 527 (OID 19809)
--
-- Name: care_type_location Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_type_location" VALUES (1,'dept','Department','LDDepartment','','','','0','','0');
INSERT INTO "care_type_location" VALUES (2,'ward','Ward','LDWard','','','','0','','0');
INSERT INTO "care_type_location" VALUES (3,'firm','Firm','LDFirm','','','','0','','0');
INSERT INTO "care_type_location" VALUES (4,'room','Room','LDRoom','','','','0','','0');
INSERT INTO "care_type_location" VALUES (5,'bed','Bed','LDBed','','','','0','','0');
INSERT INTO "care_type_location" VALUES (6,'clinic','Clinic','LDClinic','','','','0','','0');
--
-- Data for TOC Entry ID 528 (OID 19814)
--
-- Name: care_type_measurement Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_type_measurement" VALUES (1,'bp_systolic','Systolic','LDSystolic','','','0','','0');
INSERT INTO "care_type_measurement" VALUES (2,'bp_diastolic','Diastolic','LDDiastolic','','','0','','0');
INSERT INTO "care_type_measurement" VALUES (3,'temp','Temperature','LDTemperature','','','0','','0');
INSERT INTO "care_type_measurement" VALUES (4,'fluid_intake','Fluid intake','LDFluidIntake','','','0','','0');
INSERT INTO "care_type_measurement" VALUES (5,'fluid_output','Fluid output','LDFluidOutput','','','0','','0');
INSERT INTO "care_type_measurement" VALUES (6,'weight','Weight','LDWeight','','','0','','0');
INSERT INTO "care_type_measurement" VALUES (7,'height','Height','LDHeight','','','0','','0');
INSERT INTO "care_type_measurement" VALUES (8,'bp_composite','Sys/Dias','LDSysDias','','','20030419143920','','20030419143920');
INSERT INTO "care_type_measurement" VALUES (9,'head_circumference','Head circumference','LDHeadCircumference','','','0','','0');
--
-- Data for TOC Entry ID 529 (OID 19819)
--
-- Name: care_type_notes Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_type_notes" VALUES (1,'histo_physical','Admission History and Physical','LDAdmitHistoPhysical',5,'','','0','','0');
INSERT INTO "care_type_notes" VALUES (2,'daily_doctor','Doctor''s daily notes','LDDoctorDailyNotes',55,'','','0','','0');
INSERT INTO "care_type_notes" VALUES (3,'discharge','Discharge summary','LDDischargeSummary',50,'','','0','','0');
INSERT INTO "care_type_notes" VALUES (4,'consult','Consultation notes','LDConsultNotes',25,'','','0','','0');
INSERT INTO "care_type_notes" VALUES (5,'op','Operation notes','LDOpNotes',100,'','','0','','0');
INSERT INTO "care_type_notes" VALUES (6,'daily_ward','Daily ward''s notes','LDDailyNurseNotes',30,'','','0','','0');
INSERT INTO "care_type_notes" VALUES (7,'daily_chart_notes','Chart notes','LDChartNotes',20,'','','0','','0');
INSERT INTO "care_type_notes" VALUES (8,'chart_notes_etc','PT,ATG,etc. daily notes','LDPTATGetc',115,'','','0','','0');
INSERT INTO "care_type_notes" VALUES (9,'daily_iv_notes','IV daily notes','LDIVDailyNotes',75,'','','0','','0');
INSERT INTO "care_type_notes" VALUES (10,'daily_anticoag','Anticoagulant daily notes','LDAnticoagDailyNotes',15,'','','0','','0');
INSERT INTO "care_type_notes" VALUES (11,'lot_charge_nr','Material LOT, Charge Nr.','LDMaterialLOTChargeNr',80,'','','0','','0');
INSERT INTO "care_type_notes" VALUES (12,'text_diagnosis','Diagnosis text','LDDiagnosis',40,'','','0','','0');
INSERT INTO "care_type_notes" VALUES (13,'text_therapy','Therapy text','LDTherapy',120,'','','0','','0');
INSERT INTO "care_type_notes" VALUES (14,'chart_extra','Extra notes on therapy & diagnosis','LDExtraNotes',65,'','','0','','0');
INSERT INTO "care_type_notes" VALUES (15,'nursing_report','Nursing care report','LDNursingReport',85,'','','0','','0');
INSERT INTO "care_type_notes" VALUES (16,'nursing_problem','Nursing problem report','LDNursingProblemReport',95,'','','0','','0');
INSERT INTO "care_type_notes" VALUES (17,'nursing_effectivity','Nursing effectivity report','LDNursingEffectivityReport',90,'','','0','','0');
INSERT INTO "care_type_notes" VALUES (18,'nursing_inquiry','Inquiry to doctor','LDInquiryToDoctor',70,'','','0','','0');
INSERT INTO "care_type_notes" VALUES (19,'doctor_directive','Doctor''s directive','LDDoctorDirective',60,'','','0','','0');
INSERT INTO "care_type_notes" VALUES (20,'problem','Problem','LDProblem',110,'','','0','','0');
INSERT INTO "care_type_notes" VALUES (21,'development','Development','LDDevelopment',35,'','','0','','0');
INSERT INTO "care_type_notes" VALUES (22,'allergy','Allergy','LDAllergy',10,'','','0','','0');
INSERT INTO "care_type_notes" VALUES (23,'daily_diet','Diet plan','LDDietPlan',45,'','','0','','0');
INSERT INTO "care_type_notes" VALUES (99,'other','Other','LDOther',105,'','','0','','0');
--
-- Data for TOC Entry ID 530 (OID 19824)
--
-- Name: care_type_outcome Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_type_outcome" VALUES (1,2,'alive','Alive','LDAlive','','','','0','','0');
INSERT INTO "care_type_outcome" VALUES (2,2,'stillborn','Stillborn','LDStillborn','','','','0','','0');
INSERT INTO "care_type_outcome" VALUES (3,2,'early_neonatal_death','Early neonatal death','LDEarlyNeonatalDeath','','','','0','','0');
INSERT INTO "care_type_outcome" VALUES (4,2,'late_neonatal_death','Late neonatal death','LDLateNeonatalDeath','','','','0','','0');
INSERT INTO "care_type_outcome" VALUES (5,2,'death_uncertain_timing','Death uncertain timing','LDDeathUncertainTiming','','','','0','','0');
--
-- Data for TOC Entry ID 531 (OID 19829)
--
-- Name: care_type_perineum Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_type_perineum" VALUES (1,'intact','Intact','LDIntact','','','','0','','0');
INSERT INTO "care_type_perineum" VALUES (2,'1_degree','1st degree tear','LDFirstDegreeTear','','','','20030727212219','','0');
INSERT INTO "care_type_perineum" VALUES (3,'2_degree','2nd degree tear','LDSecondDegreeTear','','','','20030727212231','','0');
INSERT INTO "care_type_perineum" VALUES (4,'3_degree','3rd degree tear','LDThirdDegreeTear','','','','20030727212242','','0');
INSERT INTO "care_type_perineum" VALUES (5,'episiotomy','Episiotomy','LDEpisiotomy','','','','0','','0');
--
-- Data for TOC Entry ID 532 (OID 19834)
--
-- Name: care_type_prescription Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_type_prescription" VALUES (1,'anticoag','Anticoagulant','LDAnticoagulant','','','0','','0');
INSERT INTO "care_type_prescription" VALUES (2,'hemolytic','Hemolytic','LDHemolytic','','','0','','0');
INSERT INTO "care_type_prescription" VALUES (3,'diuretic','Diuretic','LDDiuretic','','','0','','0');
INSERT INTO "care_type_prescription" VALUES (4,'antibiotic','Antibiotic','LDAntibiotic','','','0','','0');
--
-- Data for TOC Entry ID 533 (OID 19839)
--
-- Name: care_type_room Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_type_room" VALUES (1,'ward','Ward room','LDWard','','','','0','','0');
INSERT INTO "care_type_room" VALUES (2,'op','Operating room','LDOperatingRoom','','','','0','','0');
--
-- Data for TOC Entry ID 534 (OID 19844)
--
-- Name: care_type_test Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_type_test" VALUES (1,'chemlabor','Chemical-Serology Lab','LDChemSerologyLab','','','','0','','0');
INSERT INTO "care_type_test" VALUES (2,'patho','Pathological Lab','LDPathoLab','','','','0','','0');
INSERT INTO "care_type_test" VALUES (3,'baclabor','Bacteriological Lab','LDBacteriologicalLab','','','','0','','0');
INSERT INTO "care_type_test" VALUES (4,'radio','Radiological Lab','LDRadiologicalLab','Lab for X-ray, Mammography, Computer Tomography, NMR','','','0','','0');
INSERT INTO "care_type_test" VALUES (5,'blood','Blood test & product','LDBloodTestProduct','','','','0','','0');
INSERT INTO "care_type_test" VALUES (6,'generic','Generic test program','LDGenericTestProgram','','','','0','','0');
--
-- Data for TOC Entry ID 535 (OID 19849)
--
-- Name: care_type_time Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_type_time" VALUES (1,'patient_entry_exit','Patient entry/exit','LDPatientEntryExit','Times when patient entered and left the op room','','','0','','0');
INSERT INTO "care_type_time" VALUES (2,'op_start_end','OP start/end','LDOPStartEnd','Times when op started (1st incision) and ended (last suture)','','','0','','0');
INSERT INTO "care_type_time" VALUES (3,'delay','Delay time','LDDelayTime','Times when the op was delayed due to any reason','','','0','','0');
INSERT INTO "care_type_time" VALUES (4,'plaster_cast','Plaster cast','LDPlasterCast','Times when the plaster cast was made','','','0','','0');
INSERT INTO "care_type_time" VALUES (5,'reposition','Reposition','LDReposition','Times when a dislocated joint(s) was repositioned (non invasive op)','','','0','','0');
INSERT INTO "care_type_time" VALUES (6,'coro','Coronary catheter','LDCoronaryCatheter','Times when a coronary catherer op was done (minimal invasive op)','','','0','','0');
INSERT INTO "care_type_time" VALUES (7,'bandage','Bandage','LDBandage','Times when the bandage was made','','','0','','0');
--
-- Data for TOC Entry ID 536 (OID 19854)
--
-- Name: care_type_unit_measurement Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_type_unit_measurement" VALUES (1,'volume','Volume','LDVolume','','','','0','','0');
INSERT INTO "care_type_unit_measurement" VALUES (2,'weight','Weight','LDWeight','','','','0','','0');
INSERT INTO "care_type_unit_measurement" VALUES (3,'length','Length','LDLength','','','','0','','0');
INSERT INTO "care_type_unit_measurement" VALUES (4,'pressure','Pressure','LDPressure','','','','0','','0');
INSERT INTO "care_type_unit_measurement" VALUES (5,'temperature','Temperature','LDTemperature','','','','20030419144724','','20030419144724');
--
-- Data for TOC Entry ID 537 (OID 19859)
--
-- Name: care_test_request_patho Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 538 (OID 19942)
--
-- Name: care_category_procedure Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_category_procedure" VALUES (1,'main','Main','LDMain','M','LDMain_s','Main procedure, must be only one per op or intervention visit','0','','','','0','','0');
INSERT INTO "care_category_procedure" VALUES (2,'supplemental','Supplemental','LDSupplemental','S','LDSupp_s','Supplemental procedure, can be several per  encounter op or intervention or visit','0','','','','0','','0');
--
-- Data for TOC Entry ID 539 (OID 20009)
--
-- Name: care_currency Type: TABLE DATA Owner: postgres
--


INSERT INTO "care_currency" VALUES (2,'L','Pound','GB British Pound (ISO = GBP)','','e','20040104002235','','0');
INSERT INTO "care_currency" VALUES (4,'R','Rand','South African Rand (ISO = ZAR)','','e','0','Elpidio Latorilla','0');
INSERT INTO "care_currency" VALUES (5,'$','US Dollar','USA dollar','',NULL,'0','e','20040512123933');
INSERT INTO "care_currency" VALUES (3,'R','Rupees','Indian Rupees (ISO = INR)','','','20040504174926','Elpidio Latorilla','0');
INSERT INTO "care_currency" VALUES (1,'€','Euro','European currency of the European Community','main','e','20040504174942','','0');
--
-- Data for TOC Entry ID 540 (OID 20154)
--
-- Name: care_person Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 541 (OID 76645)
--
-- Name: care_icd10_es Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 542 (OID 111960)
--
-- Name: care_ops301_es Type: TABLE DATA Owner: postgres
--


--
-- Data for TOC Entry ID 543 (OID 141831)
--
-- Name: care_type_immunization Type: TABLE DATA Owner: postgres
--


--
-- TOC Entry ID 330 (OID 18706)
--
-- Name: "addr_ct_name" Type: INDEX Owner: postgres
--

CREATE INDEX addr_ct_name ON care_address_citytown USING btree (name);

--
-- TOC Entry ID 331 (OID 18715)
--
-- Name: "appt_pid" Type: INDEX Owner: postgres
--

CREATE INDEX appt_pid ON care_appointment USING btree (pid);

--
-- TOC Entry ID 332 (OID 18725)
--
-- Name: "bill_bill_enr" Type: INDEX Owner: postgres
--

CREATE INDEX bill_bill_enr ON care_billing_bill USING btree (bill_encounter_nr);

--
-- TOC Entry ID 333 (OID 18731)
--
-- Name: "bill_item_bill_no" Type: INDEX Owner: postgres
--

CREATE INDEX bill_item_bill_no ON care_billing_bill_item USING btree (bill_item_bill_no);

--
-- TOC Entry ID 334 (OID 18732)
--
-- Name: "bill_item_enr" Type: INDEX Owner: postgres
--

CREATE INDEX bill_item_enr ON care_billing_bill_item USING btree (bill_item_encounter_nr);

--
-- TOC Entry ID 335 (OID 18738)
--
-- Name: "bill_final_enr" Type: INDEX Owner: postgres
--

CREATE INDEX bill_final_enr ON care_billing_final USING btree (final_encounter_nr);

--
-- TOC Entry ID 336 (OID 18750)
--
-- Name: "bill_pay_enr" Type: INDEX Owner: postgres
--

CREATE INDEX bill_pay_enr ON care_billing_payment USING btree (payment_encounter_nr);

--
-- TOC Entry ID 337 (OID 18751)
--
-- Name: "bill_pay_rcptnr" Type: INDEX Owner: postgres
--

CREATE INDEX bill_pay_rcptnr ON care_billing_payment USING btree (payment_receipt_no);

--
-- TOC Entry ID 338 (OID 18766)
--
-- Name: "cafe_cdate" Type: INDEX Owner: postgres
--

CREATE INDEX cafe_cdate ON care_cafe_menu USING btree (cdate);

--
-- TOC Entry ID 339 (OID 18817)
--
-- Name: "class_fin_id" Type: INDEX Owner: postgres
--

CREATE INDEX class_fin_id ON care_class_financial USING btree (class_id);

--
-- TOC Entry ID 340 (OID 18834)
--
-- Name: "classif_id" Type: INDEX Owner: postgres
--

CREATE UNIQUE INDEX classif_id ON care_classif_neonatal USING btree (id);

--
-- TOC Entry ID 341 (OID 18868)
--
-- Name: "dept_id" Type: INDEX Owner: postgres
--

CREATE UNIQUE INDEX dept_id ON care_department USING btree (id);

--
-- TOC Entry ID 342 (OID 18883)
--
-- Name: "drg_int_code" Type: INDEX Owner: postgres
--

CREATE INDEX drg_int_code ON care_drg_intern USING btree (code);

--
-- TOC Entry ID 343 (OID 18908)
--
-- Name: "oncall_dept_nr" Type: INDEX Owner: postgres
--

CREATE INDEX oncall_dept_nr ON care_dutyplan_oncall USING btree (dept_nr);

--
-- TOC Entry ID 344 (OID 18925)
--
-- Name: "encounter_date" Type: INDEX Owner: postgres
--

CREATE INDEX encounter_date ON care_encounter USING btree (encounter_date);

--
-- TOC Entry ID 345 (OID 18926)
--
-- Name: "encounter_pid" Type: INDEX Owner: postgres
--

CREATE INDEX encounter_pid ON care_encounter USING btree (pid);

--
-- TOC Entry ID 346 (OID 18935)
--
-- Name: "enc_diag_nr" Type: INDEX Owner: postgres
--

CREATE INDEX enc_diag_nr ON care_encounter_diagnosis USING btree (encounter_nr);

--
-- TOC Entry ID 347 (OID 18944)
--
-- Name: "enc_report_nr" Type: INDEX Owner: postgres
--

CREATE INDEX enc_report_nr ON care_encounter_diagnostics_report USING btree (report_nr);

--
-- TOC Entry ID 348 (OID 18953)
--
-- Name: "enc_drg_int_nr" Type: INDEX Owner: postgres
--

CREATE INDEX enc_drg_int_nr ON care_encounter_drg_intern USING btree (encounter_nr);

--
-- TOC Entry ID 349 (OID 18973)
--
-- Name: "enc_img_enc_nr" Type: INDEX Owner: postgres
--

CREATE INDEX enc_img_enc_nr ON care_encounter_image USING btree (encounter_nr);

--
-- TOC Entry ID 350 (OID 18990)
--
-- Name: "enc_loc_nr" Type: INDEX Owner: postgres
--

CREATE INDEX enc_loc_nr ON care_encounter_location USING btree (location_nr);

--
-- TOC Entry ID 351 (OID 18991)
--
-- Name: "enc_loc_type" Type: INDEX Owner: postgres
--

CREATE INDEX enc_loc_type ON care_encounter_location USING btree (type_nr);

--
-- TOC Entry ID 352 (OID 19000)
--
-- Name: "enc_msr_type" Type: INDEX Owner: postgres
--

CREATE INDEX enc_msr_type ON care_encounter_measurement USING btree (msr_type_nr);

--
-- TOC Entry ID 353 (OID 19001)
--
-- Name: "enc_msr_enr" Type: INDEX Owner: postgres
--

CREATE INDEX enc_msr_enr ON care_encounter_measurement USING btree (encounter_nr);

--
-- TOC Entry ID 354 (OID 19010)
--
-- Name: "enc_notes_nr" Type: INDEX Owner: postgres
--

CREATE INDEX enc_notes_nr ON care_encounter_notes USING btree (encounter_nr);

--
-- TOC Entry ID 355 (OID 19011)
--
-- Name: "enc_notes_type_nr" Type: INDEX Owner: postgres
--

CREATE INDEX enc_notes_type_nr ON care_encounter_notes USING btree (type_nr);

--
-- TOC Entry ID 356 (OID 19018)
--
-- Name: "enc_obs_pregnr" Type: INDEX Owner: postgres
--

CREATE INDEX enc_obs_pregnr ON care_encounter_obstetric USING btree (pregnancy_nr);

--
-- TOC Entry ID 357 (OID 19027)
--
-- Name: "enc_op_dept_nr" Type: INDEX Owner: postgres
--

CREATE INDEX enc_op_dept_nr ON care_encounter_op USING btree (dept_nr);

--
-- TOC Entry ID 358 (OID 19028)
--
-- Name: "enc_op_date" Type: INDEX Owner: postgres
--

CREATE INDEX enc_op_date ON care_encounter_op USING btree (op_date);

--
-- TOC Entry ID 359 (OID 19029)
--
-- Name: "enc_op_room" Type: INDEX Owner: postgres
--

CREATE INDEX enc_op_room ON care_encounter_op USING btree (op_room);

--
-- TOC Entry ID 360 (OID 19038)
--
-- Name: "enc_presc_enr" Type: INDEX Owner: postgres
--

CREATE INDEX enc_presc_enr ON care_encounter_prescription USING btree (encounter_nr);

--
-- TOC Entry ID 361 (OID 19055)
--
-- Name: "enc_proc_enr" Type: INDEX Owner: postgres
--

CREATE INDEX enc_proc_enr ON care_encounter_procedure USING btree (encounter_nr);

--
-- TOC Entry ID 362 (OID 19064)
--
-- Name: "enc_sick_enr" Type: INDEX Owner: postgres
--

CREATE INDEX enc_sick_enr ON care_encounter_sickconfirm USING btree (encounter_nr);

--
-- TOC Entry ID 363 (OID 19075)
--
-- Name: "icd10de_code" Type: INDEX Owner: postgres
--

CREATE INDEX icd10de_code ON care_icd10_de USING btree (diagnosis_code);

--
-- TOC Entry ID 364 (OID 19081)
--
-- Name: "icd10en_code" Type: INDEX Owner: postgres
--

CREATE INDEX icd10en_code ON care_icd10_en USING btree (diagnosis_code);

--
-- TOC Entry ID 365 (OID 19087)
--
-- Name: "icd10ptbr_code" Type: INDEX Owner: postgres
--

CREATE INDEX icd10ptbr_code ON care_icd10_pt_br USING btree (diagnosis_code);

--
-- TOC Entry ID 366 (OID 19096)
--
-- Name: "img_diag_pid" Type: INDEX Owner: postgres
--

CREATE INDEX img_diag_pid ON care_img_diagnostic USING btree (pid);

--
-- TOC Entry ID 367 (OID 19103)
--
-- Name: "ins_firm_name" Type: INDEX Owner: postgres
--

CREATE INDEX ins_firm_name ON care_insurance_firm USING btree (name);

--
-- TOC Entry ID 368 (OID 19109)
--
-- Name: "mail_recipient" Type: INDEX Owner: postgres
--

CREATE INDEX mail_recipient ON care_mail_private USING btree (recipient);

--
-- TOC Entry ID 369 (OID 19124)
--
-- Name: "med_ocat_inr" Type: INDEX Owner: postgres
--

CREATE INDEX med_ocat_inr ON care_med_ordercatalog USING btree (item_no);

--
-- TOC Entry ID 370 (OID 19133)
--
-- Name: "med_olist_dept" Type: INDEX Owner: postgres
--

CREATE INDEX med_olist_dept ON care_med_orderlist USING btree (dept_nr);

--
-- TOC Entry ID 371 (OID 19140)
--
-- Name: "med_prod_onr" Type: INDEX Owner: postgres
--

CREATE INDEX med_prod_onr ON care_med_products_main USING btree (bestellnum);

--
-- TOC Entry ID 372 (OID 19175)
--
-- Name: "neo_pregnr" Type: INDEX Owner: postgres
--

CREATE INDEX neo_pregnr ON care_neonatal USING btree (parent_encounter_nr);

--
-- TOC Entry ID 373 (OID 19176)
--
-- Name: "neo_pid" Type: INDEX Owner: postgres
--

CREATE INDEX neo_pid ON care_neonatal USING btree (pid);

--
-- TOC Entry ID 374 (OID 19177)
--
-- Name: "neo_enr" Type: INDEX Owner: postgres
--

CREATE INDEX neo_enr ON care_neonatal USING btree (encounter_nr);

--
-- TOC Entry ID 375 (OID 19194)
--
-- Name: "opmed_enr" Type: INDEX Owner: postgres
--

CREATE INDEX opmed_enr ON care_op_med_doc USING btree (encounter_nr);

--
-- TOC Entry ID 376 (OID 19200)
--
-- Name: "ops301de_code" Type: INDEX Owner: postgres
--

CREATE INDEX ops301de_code ON care_ops301_de USING btree (code);

--
-- TOC Entry ID 377 (OID 19226)
--
-- Name: "person_onr" Type: INDEX Owner: postgres
--

CREATE INDEX person_onr ON care_person_other_number USING btree (other_nr);

--
-- TOC Entry ID 378 (OID 19227)
--
-- Name: "person_onr_pid" Type: INDEX Owner: postgres
--

CREATE INDEX person_onr_pid ON care_person_other_number USING btree (pid);

--
-- TOC Entry ID 379 (OID 19236)
--
-- Name: "personell_pid" Type: INDEX Owner: postgres
--

CREATE INDEX personell_pid ON care_personell USING btree (pid);

--
-- TOC Entry ID 380 (OID 19245)
--
-- Name: "passign_pnr" Type: INDEX Owner: postgres
--

CREATE INDEX passign_pnr ON care_personell_assignment USING btree (personell_nr);

--
-- TOC Entry ID 381 (OID 19262)
--
-- Name: "pharma_olist_dept" Type: INDEX Owner: postgres
--

CREATE INDEX pharma_olist_dept ON care_pharma_orderlist USING btree (dept_nr);

--
-- TOC Entry ID 382 (OID 19277)
--
-- Name: "phone_fname" Type: INDEX Owner: postgres
--

CREATE INDEX phone_fname ON care_phone USING btree (vorname);

--
-- TOC Entry ID 383 (OID 19278)
--
-- Name: "phone_lname" Type: INDEX Owner: postgres
--

CREATE INDEX phone_lname ON care_phone USING btree (name);

--
-- TOC Entry ID 384 (OID 19287)
--
-- Name: "preg_enr" Type: INDEX Owner: postgres
--

CREATE INDEX preg_enr ON care_pregnancy USING btree (encounter_nr);

--
-- TOC Entry ID 385 (OID 19307)
--
-- Name: "room_roomnr" Type: INDEX Owner: postgres
--

CREATE INDEX room_roomnr ON care_room USING btree (room_nr);

--
-- TOC Entry ID 386 (OID 19308)
--
-- Name: "room_wardnr" Type: INDEX Owner: postgres
--

CREATE INDEX room_wardnr ON care_room USING btree (ward_nr);

--
-- TOC Entry ID 387 (OID 19309)
--
-- Name: "room_deptnr" Type: INDEX Owner: postgres
--

CREATE INDEX room_deptnr ON care_room USING btree (dept_nr);

--
-- TOC Entry ID 388 (OID 19316)
--
-- Name: "expiry" Type: INDEX Owner: postgres
--

CREATE INDEX expiry ON care_sessions USING btree (expiry);

--
-- TOC Entry ID 389 (OID 19362)
--
-- Name: "testfind_date" Type: INDEX Owner: postgres
--

CREATE INDEX testfind_date ON care_test_findings_baclabor USING btree (findings_date);

--
-- TOC Entry ID 390 (OID 19363)
--
-- Name: "testfind_rec_date" Type: INDEX Owner: postgres
--

CREATE INDEX testfind_rec_date ON care_test_findings_baclabor USING btree (rec_date);

--
-- TOC Entry ID 391 (OID 19378)
--
-- Name: "testfind_path_fdate" Type: INDEX Owner: postgres
--

CREATE INDEX testfind_path_fdate ON care_test_findings_patho USING btree (findings_date);

--
-- TOC Entry ID 392 (OID 19385)
--
-- Name: "testfind_radio_fdate" Type: INDEX Owner: postgres
--

CREATE INDEX testfind_radio_fdate ON care_test_findings_radio USING btree (findings_date);

--
-- TOC Entry ID 393 (OID 19389)
--
-- Name: "testgroup_id" Type: INDEX Owner: postgres
--

CREATE UNIQUE INDEX testgroup_id ON care_test_group USING btree (group_id);

--
-- TOC Entry ID 394 (OID 19408)
--
-- Name: "testreq_blab_sdate" Type: INDEX Owner: postgres
--

CREATE INDEX testreq_blab_sdate ON care_test_request_baclabor USING btree (send_date);

--
-- TOC Entry ID 395 (OID 19417)
--
-- Name: "testreqblood_sdate" Type: INDEX Owner: postgres
--

CREATE INDEX testreqblood_sdate ON care_test_request_blood USING btree (send_date);

--
-- TOC Entry ID 396 (OID 19426)
--
-- Name: "testreqclab_enr" Type: INDEX Owner: postgres
--

CREATE INDEX testreqclab_enr ON care_test_request_chemlabor USING btree (encounter_nr);

--
-- TOC Entry ID 397 (OID 19435)
--
-- Name: "testreqgen_enr" Type: INDEX Owner: postgres
--

CREATE INDEX testreqgen_enr ON care_test_request_generic USING btree (encounter_nr);

--
-- TOC Entry ID 398 (OID 19436)
--
-- Name: "testreqgen_sdate" Type: INDEX Owner: postgres
--

CREATE INDEX testreqgen_sdate ON care_test_request_generic USING btree (send_date);

--
-- TOC Entry ID 399 (OID 19455)
--
-- Name: "testreqradio_enr" Type: INDEX Owner: postgres
--

CREATE INDEX testreqradio_enr ON care_test_request_radio USING btree (encounter_nr);

--
-- TOC Entry ID 400 (OID 19456)
--
-- Name: "testreqradio_xtime" Type: INDEX Owner: postgres
--

CREATE INDEX testreqradio_xtime ON care_test_request_radio USING btree (xray_time);

--
-- TOC Entry ID 401 (OID 19594)
--
-- Name: "login_id" Type: INDEX Owner: postgres
--

CREATE INDEX login_id ON care_users USING btree (login_id);

--
-- TOC Entry ID 402 (OID 19605)
--
-- Name: "ward_id" Type: INDEX Owner: postgres
--

CREATE INDEX ward_id ON care_ward USING btree (ward_id);

--
-- TOC Entry ID 403 (OID 19738)
--
-- Name: "type_ana_id" Type: INDEX Owner: postgres
--

CREATE UNIQUE INDEX type_ana_id ON care_type_anaesthesia USING btree (id);

--
-- TOC Entry ID 404 (OID 19867)
--
-- Name: "testreqpath_enr" Type: INDEX Owner: postgres
--

CREATE INDEX testreqpath_enr ON care_test_request_patho USING btree (encounter_nr);

--
-- TOC Entry ID 405 (OID 19868)
--
-- Name: "testreqpath_sdate" Type: INDEX Owner: postgres
--

CREATE INDEX testreqpath_sdate ON care_test_request_patho USING btree (send_date);

--
-- TOC Entry ID 406 (OID 20162)
--
-- Name: "person_dob" Type: INDEX Owner: postgres
--

CREATE INDEX person_dob ON care_person USING btree (date_birth);

--
-- TOC Entry ID 407 (OID 20163)
--
-- Name: "person_dtreg" Type: INDEX Owner: postgres
--

CREATE INDEX person_dtreg ON care_person USING btree (date_reg);

--
-- TOC Entry ID 408 (OID 20164)
--
-- Name: "person_fname" Type: INDEX Owner: postgres
--

CREATE INDEX person_fname ON care_person USING btree (name_first);

--
-- TOC Entry ID 409 (OID 20165)
--
-- Name: "person_lname" Type: INDEX Owner: postgres
--

CREATE INDEX person_lname ON care_person USING btree (name_last);

--
-- TOC Entry ID 410 (OID 29470)
--
-- Name: "care_phone_personell_nr_key" Type: INDEX Owner: postgres
--

CREATE UNIQUE INDEX care_phone_personell_nr_key ON care_phone USING btree (personell_nr);

--
-- TOC Entry ID 411 (OID 76636)
--
-- Name: "care_steri_produ_bestellnum_key" Type: INDEX Owner: postgres
--

CREATE UNIQUE INDEX care_steri_produ_bestellnum_key ON care_steri_products_main USING btree (bestellnum);

--
-- TOC Entry ID 412 (OID 76637)
--
-- Name: "care_steri_pro_containernum_key" Type: INDEX Owner: postgres
--

CREATE UNIQUE INDEX care_steri_pro_containernum_key ON care_steri_products_main USING btree (containernum);

--
-- TOC Entry ID 413 (OID 76650)
--
-- Name: "icd10es_code" Type: INDEX Owner: postgres
--

CREATE INDEX icd10es_code ON care_icd10_es USING btree (diagnosis_code);

--
-- TOC Entry ID 414 (OID 111965)
--
-- Name: "ops301es_code" Type: INDEX Owner: postgres
--

CREATE INDEX ops301es_code ON care_ops301_es USING btree (code);

--
-- Name: "icd10bg_code" Type: INDEX Owner: postgres
--

CREATE INDEX icd10bg_code ON care_icd10_bg USING btree (diagnosis_code);

--
-- Name: "icd10tr_code" Type: INDEX Owner: postgres
--

CREATE INDEX icd10tr_code ON care_icd10_tr USING btree (diagnosis_code);

--
-- TOC Entry ID 415 (OID 141836)
--
-- Name: "care_type_immunization_nr_key" Type: INDEX Owner: postgres
--

CREATE UNIQUE INDEX care_type_immunization_nr_key ON care_type_immunization USING btree (nr);

--
-- TOC Entry ID 3 (OID 18704)
--
-- Name: addr_ct_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"addr_ct_nr_seq"', 1, false);

--
-- TOC Entry ID 5 (OID 18713)
--
-- Name: appt_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"appt_nr_seq"', 1, false);

--
-- TOC Entry ID 7 (OID 18729)
--
-- Name: bill_item_id_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"bill_item_id_seq"', 1, false);

--
-- TOC Entry ID 9 (OID 18736)
--
-- Name: bill_final_id_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"bill_final_id_seq"', 1, false);

--
-- TOC Entry ID 11 (OID 18748)
--
-- Name: bill_pay_id_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"bill_pay_id_seq"', 1, false);

--
-- TOC Entry ID 13 (OID 18764)
--
-- Name: cafe_menu_item_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"cafe_menu_item_seq"', 1, false);

--
-- TOC Entry ID 15 (OID 18773)
--
-- Name: cafe_prices_item_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"cafe_prices_item_seq"', 1, false);

--
-- TOC Entry ID 17 (OID 18781)
--
-- Name: cat_diag_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"cat_diag_nr_seq"', 5, true);

--
-- TOC Entry ID 19 (OID 18786)
--
-- Name: cat_disease_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"cat_disease_nr_seq"', 4, true);

--
-- TOC Entry ID 21 (OID 18794)
--
-- Name: cat_proc_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"cat_proc_nr_seq"', 2, true);

--
-- TOC Entry ID 23 (OID 18802)
--
-- Name: class_enc_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"class_enc_nr_seq"', 2, true);

--
-- TOC Entry ID 25 (OID 18807)
--
-- Name: class_eorig_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"class_eorig_nr_seq"', 2, true);

--
-- TOC Entry ID 27 (OID 18815)
--
-- Name: class_fin_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"class_fin_nr_seq"', 12, true);

--
-- TOC Entry ID 29 (OID 18824)
--
-- Name: class_ins_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"class_ins_nr_seq"', 3, true);

--
-- TOC Entry ID 31 (OID 18829)
--
-- Name: class_ther_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"class_ther_nr_seq"', 8, true);

--
-- TOC Entry ID 33 (OID 18835)
--
-- Name: classif_neo_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"classif_neo_nr_seq"', 16, true);

--
-- TOC Entry ID 35 (OID 18840)
--
-- Name: complic_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"complic_nr_seq"', 16, true);

--
-- TOC Entry ID 37 (OID 18857)
--
-- Name: cur_item_no_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"cur_item_no_seq"', 5, true);

--
-- TOC Entry ID 39 (OID 18881)
--
-- Name: drg_int_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"drg_int_nr_seq"', 1, false);

--
-- TOC Entry ID 41 (OID 18890)
--
-- Name: drg_qlist_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"drg_qlist_nr_seq"', 1, false);

--
-- TOC Entry ID 43 (OID 18898)
--
-- Name: drg_relcodes_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"drg_relcodes_nr_seq"', 1, false);

--
-- TOC Entry ID 45 (OID 18906)
--
-- Name: oncall_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"oncall_nr_seq"', 1, false);

--
-- TOC Entry ID 47 (OID 18915)
--
-- Name: effday_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"effday_nr_seq"', 1, false);

--
-- TOC Entry ID 49 (OID 18923)
--
-- Name: enc_enc_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"enc_enc_nr_seq"', 1, false);

--
-- TOC Entry ID 51 (OID 18933)
--
-- Name: enc_diag_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"enc_diag_nr_seq"', 1, false);

--
-- TOC Entry ID 53 (OID 18942)
--
-- Name: enc_rep_item_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"enc_rep_item_nr_seq"', 1, false);

--
-- TOC Entry ID 55 (OID 18951)
--
-- Name: enc_drg_int_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"enc_drg_int_nr_seq"', 1, false);

--
-- TOC Entry ID 57 (OID 18963)
--
-- Name: enc_fin_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"enc_fin_nr_seq"', 1, false);

--
-- TOC Entry ID 59 (OID 18971)
--
-- Name: enc_img_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"enc_img_nr_seq"', 1, false);

--
-- TOC Entry ID 61 (OID 18980)
--
-- Name: enc_imm_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"enc_imm_nr_seq"', 1, false);

--
-- TOC Entry ID 63 (OID 18988)
--
-- Name: enc_loc_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"enc_loc_nr_seq"', 1, false);

--
-- TOC Entry ID 65 (OID 18998)
--
-- Name: enc_msr_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"enc_msr_nr_seq"', 1, false);

--
-- TOC Entry ID 67 (OID 19008)
--
-- Name: enc_notes_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"enc_notes_nr_seq"', 1, false);

--
-- TOC Entry ID 69 (OID 19025)
--
-- Name: enc_op_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"enc_op_nr_seq"', 1, false);

--
-- TOC Entry ID 71 (OID 19036)
--
-- Name: enc_presc_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"enc_presc_nr_seq"', 1, false);

--
-- TOC Entry ID 73 (OID 19045)
--
-- Name: enc_prescnotes_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"enc_prescnotes_nr_seq"', 1, false);

--
-- TOC Entry ID 75 (OID 19053)
--
-- Name: enc_proc_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"enc_proc_nr_seq"', 1, false);

--
-- TOC Entry ID 77 (OID 19062)
--
-- Name: enc_sick_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"enc_sick_nr_seq"', 1, false);

--
-- TOC Entry ID 79 (OID 19068)
--
-- Name: group_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"group_nr_seq"', 6, true);

--
-- TOC Entry ID 81 (OID 19094)
--
-- Name: img_diag_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"img_diag_nr_seq"', 1, false);

--
-- TOC Entry ID 83 (OID 19122)
--
-- Name: med_ocat_inr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"med_ocat_inr_seq"', 1, false);

--
-- TOC Entry ID 85 (OID 19131)
--
-- Name: med_olist_onr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"med_olist_onr_seq"', 1, false);

--
-- TOC Entry ID 87 (OID 19147)
--
-- Name: med_report_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"med_report_nr_seq"', 1, false);

--
-- TOC Entry ID 89 (OID 19155)
--
-- Name: menu_main_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"menu_main_nr_seq"', 20, true);

--
-- TOC Entry ID 91 (OID 19160)
--
-- Name: induction_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"induction_nr_seq"', 5, true);

--
-- TOC Entry ID 93 (OID 19165)
--
-- Name: delivery_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"delivery_nr_seq"', 5, true);

--
-- TOC Entry ID 95 (OID 19173)
--
-- Name: neo_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"neo_nr_seq"', 1, false);

--
-- TOC Entry ID 97 (OID 19184)
--
-- Name: news_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"news_nr_seq"', 1, false);

--
-- TOC Entry ID 99 (OID 19192)
--
-- Name: opmed_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"opmed_nr_seq"', 1, false);

--
-- TOC Entry ID 101 (OID 19219)
--
-- Name: person_ins_inr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"person_ins_inr_seq"', 1, false);

--
-- TOC Entry ID 103 (OID 19224)
--
-- Name: person_onr_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"person_onr_nr_seq"', 1, false);

--
-- TOC Entry ID 105 (OID 19243)
--
-- Name: passign_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"passign_nr_seq"', 1, false);

--
-- TOC Entry ID 107 (OID 19252)
--
-- Name: pharma_ocat_inr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"pharma_ocat_inr_seq"', 1, false);

--
-- TOC Entry ID 109 (OID 19260)
--
-- Name: pharma_olist_onr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"pharma_olist_onr_seq"', 1, false);

--
-- TOC Entry ID 111 (OID 19275)
--
-- Name: phone_inr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"phone_inr_seq"', 1, false);

--
-- TOC Entry ID 113 (OID 19285)
--
-- Name: preg_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"preg_nr_seq"', 1, false);

--
-- TOC Entry ID 115 (OID 19297)
--
-- Name: roleperson_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"roleperson_nr_seq"', 17, true);

--
-- TOC Entry ID 117 (OID 19305)
--
-- Name: room_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"room_nr_seq"', 15, true);

--
-- TOC Entry ID 119 (OID 19323)
--
-- Name: sduty_rep_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"sduty_rep_nr_seq"', 1, false);

--
-- TOC Entry ID 121 (OID 19336)
--
-- Name: techq_bnr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"techq_bnr_seq"', 1, false);

--
-- TOC Entry ID 123 (OID 19344)
--
-- Name: techdo_bnr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"techdo_bnr_seq"', 1, false);

--
-- TOC Entry ID 125 (OID 19352)
--
-- Name: techjob_bnr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"techjob_bnr_seq"', 1, false);

--
-- TOC Entry ID 131 (OID 19390)
--
-- Name: testgroup_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"testgroup_nr_seq"', 23, true);

--
-- TOC Entry ID 133 (OID 19398)
--
-- Name: testparam_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"testparam_nr_seq"', 312, true);

--
-- TOC Entry ID
--
-- Name: testfinclab_bnr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"testfinclab_bnr_seq"', 1, false);

--
-- TOC Entry ID 135 (OID 19406)
--
-- Name: testreq_blab_bnr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"testreq_blab_bnr_seq"', 1, false);

--
-- TOC Entry ID 137 (OID 19415)
--
-- Name: testreqblood_bnr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"testreqblood_bnr_seq"', 1, false);

--
-- TOC Entry ID 139 (OID 19424)
--
-- Name: testreqclab_bnr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"testreqclab_bnr_seq"', 1, false);

--
-- TOC Entry ID 141 (OID 19433)
--
-- Name: testreqgen_bnr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"testreqgen_bnr_seq"', 1, false);

--
-- TOC Entry ID 143 (OID 19453)
--
-- Name: testreqradio_bnr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"testreqradio_bnr_seq"', 1, false);

--
-- TOC Entry ID 145 (OID 19586)
--
-- Name: unit_msr_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"unit_msr_nr_seq"', 18, true);

--
-- TOC Entry ID 147 (OID 19603)
--
-- Name: ward_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"ward_nr_seq"', 1, false);

--
-- TOC Entry ID 149 (OID 19736)
--
-- Name: type_ana_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"type_ana_nr_seq"', 6, true);

--
-- TOC Entry ID 151 (OID 19742)
--
-- Name: type_app_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"type_app_nr_seq"', 11, true);

--
-- TOC Entry ID 153 (OID 19750)
--
-- Name: type_assign_tnr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"type_assign_tnr_seq"', 4, true);

--
-- TOC Entry ID 155 (OID 19755)
--
-- Name: type_opd_tnr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"type_opd_tnr_seq"', 5, true);

--
-- TOC Entry ID 157 (OID 19763)
--
-- Name: type_dept_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"type_dept_nr_seq"', 3, true);

--
-- TOC Entry ID 159 (OID 19768)
--
-- Name: type_disch_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"type_disch_nr_seq"', 8, true);

--
-- TOC Entry ID 161 (OID 19773)
--
-- Name: type_duty_tnr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"type_duty_tnr_seq"', 5, true);

--
-- TOC Entry ID 163 (OID 19781)
--
-- Name: type_enc_tnr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"type_enc_tnr_seq"', 5, true);

--
-- TOC Entry ID 165 (OID 19786)
--
-- Name: type_eorig_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"type_eorig_nr_seq"', 4, true);

--
-- TOC Entry ID 167 (OID 19791)
--
-- Name: type_feed_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"type_feed_nr_seq"', 5, true);

--
-- TOC Entry ID 169 (OID 19799)
--
-- Name: type_ins_tnr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"type_ins_tnr_seq"', 12, true);

--
-- TOC Entry ID 171 (OID 19807)
--
-- Name: type_loc_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"type_loc_nr_seq"', 3, true);

--
-- TOC Entry ID 173 (OID 19812)
--
-- Name: type_locat_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"type_locat_nr_seq"', 6, true);

--
-- TOC Entry ID 175 (OID 19817)
--
-- Name: type_msr_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"type_msr_nr_seq"', 9, true);

--
-- TOC Entry ID 177 (OID 19822)
--
-- Name: type_notes_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"type_notes_nr_seq"', 23, true);

--
-- TOC Entry ID 179 (OID 19827)
--
-- Name: type_outc_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"type_outc_nr_seq"', 5, true);

--
-- TOC Entry ID 181 (OID 19832)
--
-- Name: type_peri_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"type_peri_nr_seq"', 5, true);

--
-- TOC Entry ID 183 (OID 19837)
--
-- Name: type_presc_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"type_presc_nr_seq"', 4, true);

--
-- TOC Entry ID 185 (OID 19842)
--
-- Name: type_room_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"type_room_nr_seq"', 2, true);

--
-- TOC Entry ID 187 (OID 19847)
--
-- Name: type_test_tnr_sec Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"type_test_tnr_sec"', 6, true);

--
-- TOC Entry ID 189 (OID 19852)
--
-- Name: type_time_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"type_time_nr_seq"', 7, true);

--
-- TOC Entry ID 191 (OID 19857)
--
-- Name: type_umsr_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"type_umsr_nr_seq"', 5, true);

--
-- TOC Entry ID 193 (OID 19865)
--
-- Name: testreqpath_bnr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"testreqpath_bnr_seq"', 1, false);

--
-- TOC Entry ID 195 (OID 20160)
--
-- Name: person_pid_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"person_pid_seq"', 10000000, false);

--
-- TOC Entry ID 197 (OID 29435)
--
-- Name: personell_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"personell_nr_seq"', 100000, true);

--
-- TOC Entry ID 199 (OID 76542)
--
-- Name: dept_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"dept_nr_seq"', 99, true);

--
-- TOC Entry ID 201 (OID 141829)
--
-- Name: care_type_immunization_nr_seq Type: SEQUENCE SET Owner: postgres
--

SELECT setval ('"care_type_immunization_nr_seq"', 1, false);

