<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2016 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sat, 02 Jan 2016 03:59:40 GMT
 */

if ( ! defined( 'NV_IS_FILE_MODULES' ) ) die( 'Stop!!!' );

$sql_drop_module = array();
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_block";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_block_cat";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_candidate";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_config";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_document";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_document_type";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobprovider";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobprovider_jobs";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_job_jobs";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobs";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobseeker";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobseeker_rsave";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_learning";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_money_units";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_position";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_record";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_record_highlights";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_record_jobs";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_record_wlocation";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows_highlights";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows_province";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows_district";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows_ward";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows_record";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_worktype";

$sql_create_module = $sql_drop_module;
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_block (
  bid smallint(5) unsigned NOT NULL,
  id int(11) unsigned NOT NULL,
  weight int(11) unsigned NOT NULL,
  UNIQUE KEY bid (bid,id)
) ENGINE=MyISAM  ";


$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_block_cat (
  bid smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  adddefault tinyint(4) NOT NULL DEFAULT '0',
  numbers smallint(5) NOT NULL DEFAULT '10',
  title varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  alias varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  image varchar(250)  COLLATE utf8mb4_unicode_ci DEFAULT '',
  description varchar(250)  COLLATE utf8mb4_unicode_ci DEFAULT '',
  weight smallint(5) NOT NULL DEFAULT '0',
  keywords text  COLLATE utf8mb4_unicode_ci,
  add_time int(11) NOT NULL DEFAULT '0',
  edit_time int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (bid),
  UNIQUE KEY title (title),
  UNIQUE KEY alias (alias)
) ENGINE=MyISAM";
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_candidate (
  id int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID ???ng vi??n',
  lastname varchar(100)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'H???, t??n ?????m',
  firstname varchar(50)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'T??n',
  birthday int(11) unsigned NOT NULL COMMENT 'Ng??y sinh',
  gender tinyint(1) unsigned NOT NULL COMMENT 'Gi???i t??nh',
  marital varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'T??nh tr???ng  h??n nh??n',
  nationality varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Qu???c t???ch',
  address varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '?????a ch???',
  position varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'V??? tr??',
  email varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Email',
  phone varchar(20)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '??i???n tho???i',
  PRIMARY KEY (id)
) ENGINE=MyISAM ";
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_config (
  config_name varchar(30)  COLLATE utf8mb4_unicode_ci NOT NULL,
  config_value varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL,
  UNIQUE KEY config_name (config_name)
) ENGINE=MyISAM";
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_document (
  id smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  title varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'T??n g???i h??? s??',
  note tinytext  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Ghi ch??',
  weight smallint(4) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) NOT NULL COMMENT 'Tr???ng th??i',
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_document_type (
  id smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  title varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'T??n g???i h??nh th???c n???p h??? s??',
  note tinytext  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Ghi ch??',
  weight smallint(4) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) NOT NULL COMMENT 'Tr???ng th??i',
  PRIMARY KEY (id)
) ENGINE=MyISAM";
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_job_jobs (
  job_id mediumint(8) unsigned NOT NULL,
  jobs_id smallint(4) unsigned NOT NULL,
  UNIQUE KEY provider_id (job_id,jobs_id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobprovider (
  id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  title varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'T??n c??ng ty',
  alias varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL,
  provinceid mediumint(4) NOT NULL COMMENT '?????a ??i???m',
  districtid mediumint(4) NOT NULL COMMENT '?????a ??i???m',
  wardid mediumint(4) NOT NULL COMMENT '?????a ??i???m',
  address varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '?????a ch???',
  maps tinytext  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Google maps',
  taxcode varchar(50)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'M?? s??? thu???',
  email varchar(50)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Email',
  fax varchar(20)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Fax',
  website varchar(100)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Website',
  image varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL,
  agent smallint(4) unsigned NOT NULL COMMENT 'S??? nh??n vi??n',
  descripion text  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Gi???i thi???u',
  contact_fullname varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'H??? t??n ng?????i ?????i di???n',
  contact_email varchar(50)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Email ng?????i ?????i di???n',
  contact_phone varchar(20)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '??i??n tho???i ng?????i ?????i di???n',
  userid int(11) unsigned NOT NULL DEFAULT '0',
  is_real tinyint(1) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM";


$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobprovider_jobs (
  provider_id mediumint(8) unsigned NOT NULL,
  jobs_id smallint(4) unsigned NOT NULL,
  UNIQUE KEY provider_id (provider_id,jobs_id)
) ENGINE=MyISAM";
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobs (
  id smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  title varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'T??n g???i ng??nh ngh???',
  alias varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL,
  note tinytext  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Ghi ch??',
  weight smallint(4) unsigned NOT NULL DEFAULT '0',
  num_post mediumint(8) unsigned NOT NULL DEFAULT '0',
  num_record mediumint(8) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) NOT NULL COMMENT 'Tr???ng th??i',
  PRIMARY KEY (id),
  UNIQUE KEY title (title)
) ENGINE=MyISAM";
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobseeker (
  id int(11) unsigned NOT NULL AUTO_INCREMENT,
  last_name varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'H??? - t??n ?????m',
  first_name varchar(50)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'T??n',
  birthday int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'Ng??y sinh',
  gender tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Gi???i t??nh',
  marital tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'T??nh tr???ng h??n nh??n',
  address varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '?????a ch???',
  province varchar(10)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'T???nh / Th??nh ph???',
  district varchar(10)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Qu???n / Huy???n',
  ward varchar(10)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Ph?????ng / X??',
  email varchar(100)  COLLATE utf8mb4_unicode_ci NOT NULL,
  phone varchar(20)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '??i???n thoai',
  userid int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'ID th??nh vi??n',
  addtime int(11) unsigned NOT NULL COMMENT 'Th???i gian ????ng k??',
  updatetime int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'Th???i gian c???p nh???t',
  status tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Tr???ng th??i',
  PRIMARY KEY (id)
) ENGINE=MyISAM";
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobseeker_rsave (
  userid int(11) unsigned NOT NULL,
  rows_id int(11) unsigned NOT NULL,
  UNIQUE KEY userid (userid,rows_id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_learning (
  id smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  title varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'T??n g???i b??? ph???n',
  alias varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL,
  note tinytext  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Ghi ch??',
  weight smallint(4) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) NOT NULL COMMENT 'Tr???ng th??i',
  PRIMARY KEY (id)
) ENGINE=MyISAM";
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_money_units (
  id tinyint(2) unsigned NOT NULL AUTO_INCREMENT,
  title varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'T??n g???i ti???n t???',
  note tinytext  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Ghi ch??',
  weight smallint(4) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) NOT NULL COMMENT 'Tr???ng th??i',
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_position (
  id smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  title varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'T??n g???i v??? tr??',
  alias varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL,
  note tinytext  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Ghi ch??',
  weight smallint(4) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) NOT NULL COMMENT 'Tr???ng th??i',
  PRIMARY KEY (id)
) ENGINE=MyISAM";
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_record (
  id mediumint(8) NOT NULL AUTO_INCREMENT COMMENT 'ID h??? s??',
  title varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Ti??u ?????',
  alias varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL,
  jobs_id varchar(15)  COLLATE utf8mb4_unicode_ci NOT NULL,
  code varchar(10)  COLLATE utf8mb4_unicode_ci NOT NULL,
  position_id smallint(4) unsigned NOT NULL COMMENT 'ID vj tr?? tuy???n d???ng',
  salary_from double unsigned NOT NULL DEFAULT '0',
  salary_to double unsigned NOT NULL DEFAULT '0' COMMENT 'M???c l????ng mong mu???n',
  money_units tinyint(2) unsigned NOT NULL,
  worktype_id smallint(4) NOT NULL COMMENT 'H??nh th???c l??m vi???c mong mu???n',
  learning_id smallint(4) NOT NULL,
  graduate_school varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Tr?????ng t???t nghi???p',
  graduate_year varchar(10)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'N??m t???t nghi???p',
  degree text  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'B???ng c???p',
  foreign_language text  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Ngo???i ng???',
  worked_company text  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'C??c c??ng ty t???ng l??m vi???c',
  worked_work text  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'C??c c??ng vi???c ???? t???ng l??m',
  worked_position text  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Ch???c v??? t???ng l??m',
  experience tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'S??? n??m kinh nghi???m',
  target text  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'M???c ti??u ngh??? nghi???p',
  achievement text  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Th??nh t??ch l??m vi???c',
  skill text  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'K??? n??ng',
  contact_fullname varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL,
  contact_email varchar(100)  COLLATE utf8mb4_unicode_ci NOT NULL,
  contact_phone varchar(20)  COLLATE utf8mb4_unicode_ci NOT NULL,
  contact_image varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL,
  contact_more text  COLLATE utf8mb4_unicode_ci NOT NULL,
  jobseeker_id int(11) unsigned NOT NULL COMMENT 'ID ???ng vi??n',
  userid int(11) unsigned NOT NULL DEFAULT '0',
  addtime int(11) unsigned NOT NULL,
  updatetime int(11) unsigned NOT NULL DEFAULT '0',
  viewcount int(11) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) NOT NULL COMMENT 'Tr???ng th??i. 0:  Kh??ng hi???n th???, 1: Hi???n th???, 2: Ch??? ki???m duy???t, 3: Nh??p',
  status_admin tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Tr???ng th??i x??c ?????nh b???i admin',
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_record_highlights (
  id int(11) unsigned NOT NULL AUTO_INCREMENT,
  record_id mediumint(8) unsigned NOT NULL,
  is_hot tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Tin hot',
  is_hot_icon tinyint(1) unsigned NOT NULL DEFAULT '0',
  is_highlights tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Tin n???i b???t',
  time_begin int(11) unsigned NOT NULL DEFAULT '0',
  time_end int(11) unsigned NOT NULL DEFAULT '0',
  add_time int(11) unsigned NOT NULL,
  add_userid int(11) unsigned NOT NULL,
  status tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (id)
) ENGINE=MyISAM";
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_record_jobs (
  record_id mediumint(8) unsigned NOT NULL,
  jobs_id smallint(4) unsigned NOT NULL,
  UNIQUE KEY record_id (record_id,jobs_id)
) ENGINE=MyISAM";
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_record_wlocation (
  id int(250) NOT NULL AUTO_INCREMENT,
  record_id mediumint(8) unsigned NOT NULL,
  location_id int(11) NOT NULL DEFAULT '0',
  provinceid smallint(4) unsigned NOT NULL,
  districtid smallint(4) unsigned NOT NULL,
  wardid smallint(4) unsigned NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM";
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows (
  id int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID tin',
  jobprovider_id int(11) unsigned NOT NULL COMMENT 'ID c??ng ty',
  title varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Ti??u ????? tin',
  alias varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Li??n k???t t??nh',
  address varchar(250)  COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  code varchar(15)  COLLATE utf8mb4_unicode_ci NOT NULL,
  position_id smallint(4) unsigned NOT NULL COMMENT 'ID v??? tr?? tuy???n d???ng',
  jobs_id varchar(15)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ID ng??nh ngh???',
  learning_id int(11) NOT NULL DEFAULT '0',
  worktype_id smallint(4) NOT NULL COMMENT 'ID lo???i h??nh c??ng vi???c',
  salary_from float NOT NULL DEFAULT '0' COMMENT 'L????ng t???',
  salary_to float NOT NULL DEFAULT '0' COMMENT 'L????ng ?????n',
  money_units tinyint(2) unsigned NOT NULL,
  experience float NOT NULL DEFAULT '0' COMMENT 'Kinh nghi???m',
  degree text  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Y??u c???u b???ng c???p',
  gender tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT 'Y??u c???u gi???i t??nh',
  age varchar(20)  COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'Y??u c???u ????? tu???i',
  quantity smallint(4) NOT NULL DEFAULT '0' COMMENT 'S??? l?????ng c???n tuy???n',
  job_description text  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'M?? t??? c??ng vi???c',
  more_requirement text  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Y??u c???u kh??c',
  interests text  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Quy???n l???i ???????c h?????ng',
  document_id varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Danh s??ch ID h??? s??',
  document_exp int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'H???n n???p h??? s??',
  document_type_id varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'H??nh th???c n???p h??? s??',
  contact_fullname varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL,
  contact_email varchar(50)  COLLATE utf8mb4_unicode_ci NOT NULL,
  contact_phone varchar(20)  COLLATE utf8mb4_unicode_ci NOT NULL,
  adduser int(11) unsigned NOT NULL DEFAULT '0',
  addtime int(11) unsigned NOT NULL DEFAULT '0',
  edittime int(11) unsigned NOT NULL DEFAULT '0',
  viewcount int(11) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Tr???ng th??i. 0: Kh??ng hi???n th???, 1: Hi???n th???. 2: Ch??? duy???t',
  status_admin tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Tr???ng th??i x??c ?????nh b???i admin',
  PRIMARY KEY (id),
  UNIQUE KEY code (code)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows_district (
  rows_id int(11) unsigned NOT NULL DEFAULT '0',
  district_id smallint(4) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows_highlights (
  id int(11) unsigned NOT NULL AUTO_INCREMENT,
  rows_id mediumint(8) unsigned NOT NULL,
  is_hot tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Tin hot',
  is_hot_icon tinyint(1) unsigned NOT NULL DEFAULT '0',
  is_highlights tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Tin n???i b???t',
  time_begin int(11) unsigned NOT NULL DEFAULT '0',
  time_end int(11) unsigned NOT NULL DEFAULT '0',
  add_time int(11) unsigned NOT NULL,
  add_userid int(11) unsigned NOT NULL,
  status tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (id)
) ENGINE=MyISAM";
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows_province (
  rows_id int(11) unsigned NOT NULL DEFAULT '0',
  province_id smallint(4) unsigned NOT NULL
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows_record (
  id int(11) unsigned NOT NULL AUTO_INCREMENT,
  rows_id mediumint(8) unsigned NOT NULL,
  title varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Ti??u ????? ????n ???ng tuy???n',
  fulname varchar(100)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'T??n ng?????i ???ng tuy???n',
  email varchar(100)  COLLATE utf8mb4_unicode_ci NOT NULL,
  phone varchar(20)  COLLATE utf8mb4_unicode_ci NOT NULL,
  introduction text  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Gi???i thi???u',
  file varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL,
  jobseeker_id mediumint(8) unsigned NOT NULL,
  sendtime int(11) unsigned NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY rows_id (rows_id,jobseeker_id)
) ENGINE=MyISAM";
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows_ward (
  rows_id int(11) unsigned NOT NULL DEFAULT '0',
  ward_id smallint(4) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM";
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_worktype (
  id smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  title varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'T??n g???i lo???i h??nh c??ng vi???c',
  alias varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL,
  note tinytext  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Ghi ch??',
  weight smallint(4) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) NOT NULL COMMENT 'Tr???ng th??i',
  PRIMARY KEY (id)
) ENGINE=MyISAM";


$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_config (config_name, config_value) VALUES('record_queue', '0')";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_config (config_name, config_value) VALUES('show_info', '1')";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_config (config_name, config_value) VALUES('record_limit', '5')";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_config (config_name, config_value) VALUES('send_record', '1')";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_config (config_name, config_value) VALUES('post_queue', '1')";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_config (config_name, config_value) VALUES('group_jobseeker', '11')";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_config (config_name, config_value) VALUES('group_jobprovider', '10')";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_config (config_name, config_value) VALUES('maxfilesize', '2097152')";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_config (config_name, config_value) VALUES('upload_filetype', 'archives,documents')";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_config (config_name, config_value) VALUES('record_size_width', '3')";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_config (config_name, config_value) VALUES('record_size_height', '4')";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_config (config_name, config_value) VALUES('logo_size_width', '300')";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_config (config_name, config_value) VALUES('logo_size_height', '300')";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_config (config_name, config_value) VALUES('countryid', 'a:2:{i:0;i:1;i:1;i:6;}')";
