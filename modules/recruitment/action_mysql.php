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
  id int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID ứng viên',
  lastname varchar(100)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Họ, tên đệm',
  firstname varchar(50)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Tên',
  birthday int(11) unsigned NOT NULL COMMENT 'Ngày sinh',
  gender tinyint(1) unsigned NOT NULL COMMENT 'Giới tính',
  marital varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Tình trạng  hôn nhân',
  nationality varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Quốc tịch',
  address varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Địa chỉ',
  position varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Vị trí',
  email varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Email',
  phone varchar(20)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Điện thoại',
  PRIMARY KEY (id)
) ENGINE=MyISAM ";
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_config (
  config_name varchar(30)  COLLATE utf8mb4_unicode_ci NOT NULL,
  config_value varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL,
  UNIQUE KEY config_name (config_name)
) ENGINE=MyISAM";
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_document (
  id smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  title varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Tên gọi hồ sơ',
  note tinytext  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Ghi chú',
  weight smallint(4) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) NOT NULL COMMENT 'Trạng thái',
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_document_type (
  id smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  title varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Tên gọi hình thức nộp hồ sơ',
  note tinytext  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Ghi chú',
  weight smallint(4) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) NOT NULL COMMENT 'Trạng thái',
  PRIMARY KEY (id)
) ENGINE=MyISAM";
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_job_jobs (
  job_id mediumint(8) unsigned NOT NULL,
  jobs_id smallint(4) unsigned NOT NULL,
  UNIQUE KEY provider_id (job_id,jobs_id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobprovider (
  id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  title varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Tên công ty',
  alias varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL,
  provinceid mediumint(4) NOT NULL COMMENT 'Địa điểm',
  districtid mediumint(4) NOT NULL COMMENT 'Địa điểm',
  wardid mediumint(4) NOT NULL COMMENT 'Địa điểm',
  address varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Địa chỉ',
  maps tinytext  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Google maps',
  taxcode varchar(50)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Mã số thuế',
  email varchar(50)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Email',
  fax varchar(20)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Fax',
  website varchar(100)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Website',
  image varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL,
  agent smallint(4) unsigned NOT NULL COMMENT 'Số nhân viên',
  descripion text  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Giới thiệu',
  contact_fullname varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Họ tên người đại diện',
  contact_email varchar(50)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Email người đại diện',
  contact_phone varchar(20)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Điên thoại người đại diện',
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
  title varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Tên gọi ngành nghề',
  alias varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL,
  note tinytext  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Ghi chú',
  weight smallint(4) unsigned NOT NULL DEFAULT '0',
  num_post mediumint(8) unsigned NOT NULL DEFAULT '0',
  num_record mediumint(8) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) NOT NULL COMMENT 'Trạng thái',
  PRIMARY KEY (id),
  UNIQUE KEY title (title)
) ENGINE=MyISAM";
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobseeker (
  id int(11) unsigned NOT NULL AUTO_INCREMENT,
  last_name varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Họ - tên đệm',
  first_name varchar(50)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Tên',
  birthday int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'Ngày sinh',
  gender tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Giới tính',
  marital tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Tình trạng hôn nhân',
  address varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Địa chỉ',
  province varchar(10)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Tỉnh / Thành phố',
  district varchar(10)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Quận / Huyện',
  ward varchar(10)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Phường / Xã',
  email varchar(100)  COLLATE utf8mb4_unicode_ci NOT NULL,
  phone varchar(20)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Điện thoai',
  userid int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'ID thành viên',
  addtime int(11) unsigned NOT NULL COMMENT 'Thời gian đăng ký',
  updatetime int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'Thời gian cập nhật',
  status tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Trạng thái',
  PRIMARY KEY (id)
) ENGINE=MyISAM";
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobseeker_rsave (
  userid int(11) unsigned NOT NULL,
  rows_id int(11) unsigned NOT NULL,
  UNIQUE KEY userid (userid,rows_id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_learning (
  id smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  title varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Tên gọi bộ phận',
  alias varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL,
  note tinytext  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Ghi chú',
  weight smallint(4) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) NOT NULL COMMENT 'Trạng thái',
  PRIMARY KEY (id)
) ENGINE=MyISAM";
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_money_units (
  id tinyint(2) unsigned NOT NULL AUTO_INCREMENT,
  title varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Tên gọi tiền tệ',
  note tinytext  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Ghi chú',
  weight smallint(4) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) NOT NULL COMMENT 'Trạng thái',
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_position (
  id smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  title varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Tên gọi vị trí',
  alias varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL,
  note tinytext  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Ghi chú',
  weight smallint(4) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) NOT NULL COMMENT 'Trạng thái',
  PRIMARY KEY (id)
) ENGINE=MyISAM";
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_record (
  id mediumint(8) NOT NULL AUTO_INCREMENT COMMENT 'ID hồ sơ',
  title varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Tiêu đề',
  alias varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL,
  jobs_id varchar(15)  COLLATE utf8mb4_unicode_ci NOT NULL,
  code varchar(10)  COLLATE utf8mb4_unicode_ci NOT NULL,
  position_id smallint(4) unsigned NOT NULL COMMENT 'ID vj trí tuyển dụng',
  salary_from double unsigned NOT NULL DEFAULT '0',
  salary_to double unsigned NOT NULL DEFAULT '0' COMMENT 'Mức lương mong muốn',
  money_units tinyint(2) unsigned NOT NULL,
  worktype_id smallint(4) NOT NULL COMMENT 'Hình thức làm việc mong muốn',
  learning_id smallint(4) NOT NULL,
  graduate_school varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Trường tốt nghiệp',
  graduate_year varchar(10)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Năm tốt nghiệp',
  degree text  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Bằng cấp',
  foreign_language text  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Ngoại ngữ',
  worked_company text  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Các công ty từng làm việc',
  worked_work text  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Các công việc đã từng làm',
  worked_position text  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Chức vụ từng làm',
  experience tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Số năm kinh nghiệm',
  target text  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Mục tiêu nghề nghiệp',
  achievement text  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Thành tích làm việc',
  skill text  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Kỹ năng',
  contact_fullname varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL,
  contact_email varchar(100)  COLLATE utf8mb4_unicode_ci NOT NULL,
  contact_phone varchar(20)  COLLATE utf8mb4_unicode_ci NOT NULL,
  contact_image varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL,
  contact_more text  COLLATE utf8mb4_unicode_ci NOT NULL,
  jobseeker_id int(11) unsigned NOT NULL COMMENT 'ID ứng viên',
  userid int(11) unsigned NOT NULL DEFAULT '0',
  addtime int(11) unsigned NOT NULL,
  updatetime int(11) unsigned NOT NULL DEFAULT '0',
  viewcount int(11) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) NOT NULL COMMENT 'Trạng thái. 0:  Không hiển thị, 1: Hiển thị, 2: Chờ kiểm duyệt, 3: Nháp',
  status_admin tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Trạng thái xác định bởi admin',
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_record_highlights (
  id int(11) unsigned NOT NULL AUTO_INCREMENT,
  record_id mediumint(8) unsigned NOT NULL,
  is_hot tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Tin hot',
  is_hot_icon tinyint(1) unsigned NOT NULL DEFAULT '0',
  is_highlights tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Tin nổi bật',
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
  jobprovider_id int(11) unsigned NOT NULL COMMENT 'ID công ty',
  title varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Tiêu đề tin',
  alias varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Liên kết tĩnh',
  address varchar(250)  COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  code varchar(15)  COLLATE utf8mb4_unicode_ci NOT NULL,
  position_id smallint(4) unsigned NOT NULL COMMENT 'ID vị trí tuyển dụng',
  jobs_id varchar(15)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ID ngành nghề',
  learning_id int(11) NOT NULL DEFAULT '0',
  worktype_id smallint(4) NOT NULL COMMENT 'ID loại hình công việc',
  salary_from float NOT NULL DEFAULT '0' COMMENT 'Lương từ',
  salary_to float NOT NULL DEFAULT '0' COMMENT 'Lương đến',
  money_units tinyint(2) unsigned NOT NULL,
  experience float NOT NULL DEFAULT '0' COMMENT 'Kinh nghiệm',
  degree text  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Yêu cầu bằng cấp',
  gender tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT 'Yêu cầu giới tính',
  age varchar(20)  COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'Yêu cầu độ tuổi',
  quantity smallint(4) NOT NULL DEFAULT '0' COMMENT 'Số lượng cần tuyển',
  job_description text  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Mô tả công việc',
  more_requirement text  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Yêu cầu khác',
  interests text  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Quyền lợi được hưởng',
  document_id varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Danh sách ID hồ sơ',
  document_exp int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'Hạn nộp hồ sơ',
  document_type_id varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Hình thức nộp hồ sơ',
  contact_fullname varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL,
  contact_email varchar(50)  COLLATE utf8mb4_unicode_ci NOT NULL,
  contact_phone varchar(20)  COLLATE utf8mb4_unicode_ci NOT NULL,
  adduser int(11) unsigned NOT NULL DEFAULT '0',
  addtime int(11) unsigned NOT NULL DEFAULT '0',
  edittime int(11) unsigned NOT NULL DEFAULT '0',
  viewcount int(11) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Trạng thái. 0: Không hiển thị, 1: Hiển thị. 2: Chờ duyệt',
  status_admin tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Trạng thái xác định bởi admin',
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
  is_highlights tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Tin nổi bật',
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
  title varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Tiêu đề đơn ứng tuyển',
  fulname varchar(100)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Tên người ứng tuyển',
  email varchar(100)  COLLATE utf8mb4_unicode_ci NOT NULL,
  phone varchar(20)  COLLATE utf8mb4_unicode_ci NOT NULL,
  introduction text  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Giới thiệu',
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
  title varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Tên gọi loại hình công việc',
  alias varchar(250)  COLLATE utf8mb4_unicode_ci NOT NULL,
  note tinytext  COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Ghi chú',
  weight smallint(4) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) NOT NULL COMMENT 'Trạng thái',
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
