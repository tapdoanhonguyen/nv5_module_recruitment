<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Wed, 02 Sep 2015 09:53:52 GMT
 */

if ( ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );

$sql_drop_module = array();
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_candidate";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_config";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_document";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_document_type";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobprovider";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobprovider_jobs";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobs";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobseeker";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobseeker_rsave";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_learning";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_money_units";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_position";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_record";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_record_wlocation";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows_province";
$sql_drop_module[] = "DROP TABLE IF EXISTS " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_worktype";

$sql_create_module = $sql_drop_module;
$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_candidate(
  id int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID ứng viên',
  lastname varchar(100) NOT NULL COMMENT 'Họ, tên đệm',
  firstname varchar(50) NOT NULL COMMENT 'Tên',
  birthday int(11) unsigned NOT NULL COMMENT 'Ngày sinh',
  gender tinyint(1) unsigned NOT NULL COMMENT 'Giới tính',
  marital varchar(255) NOT NULL COMMENT 'Tình trạng  hôn nhân',
  nationality varchar(255) NOT NULL COMMENT 'Quốc tịch',
  address varchar(255) NOT NULL COMMENT 'Địa chỉ',
  position varchar(255) NOT NULL COMMENT 'Vị trí',
  email varchar(255) NOT NULL COMMENT 'Email',
  phone varchar(20) NOT NULL COMMENT 'Điện thoại',
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_config(
  config_name varchar(30) NOT NULL,
  config_value varchar(255) NOT NULL,
  UNIQUE KEY config_name (config_name)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_document(
  id smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL COMMENT 'Tên gọi hồ sơ',
  note tinytext NOT NULL COMMENT 'Ghi chú',
  weight smallint(4) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) NOT NULL COMMENT 'Trạng thái',
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_document_type(
  id smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL COMMENT 'Tên gọi hình thức nộp hồ sơ',
  note tinytext NOT NULL COMMENT 'Ghi chú',
  weight smallint(4) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) NOT NULL COMMENT 'Trạng thái',
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobprovider(
  id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL COMMENT 'Tên công ty',
  alias varchar(255) NOT NULL,
  address varchar(255) NOT NULL COMMENT 'Địa chỉ',
  email varchar(50) NOT NULL COMMENT 'Email',
  fax varchar(20) NOT NULL COMMENT 'Fax',
  website varchar(100) NOT NULL COMMENT 'Website',
  agent smallint(4) unsigned NOT NULL COMMENT 'Số nhân viên',
  descripion text NOT NULL COMMENT 'Giới thiệu',
  contact_fullname varchar(255) NOT NULL COMMENT 'Họ tên người đại diện',
  contact_email varchar(50) NOT NULL COMMENT 'Email người đại diện',
  contact_phone varchar(20) NOT NULL COMMENT 'Điên thoại người đại diện',
  userid int(11) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobprovider_jobs(
  provider_id mediumint(8) unsigned NOT NULL,
  jobs_id smallint(4) unsigned NOT NULL,
  UNIQUE KEY provider_id (provider_id,jobs_id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobs(
  id smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL COMMENT 'Tên gọi ngành nghề',
  alias varchar(255) NOT NULL,
  note tinytext NOT NULL COMMENT 'Ghi chú',
  weight smallint(4) unsigned NOT NULL DEFAULT '0',
  numitems mediumint(8) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) NOT NULL COMMENT 'Trạng thái',
  PRIMARY KEY (id),
  UNIQUE KEY title (title)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobseeker(
  id int(11) unsigned NOT NULL AUTO_INCREMENT,
  last_name varchar(255) NOT NULL COMMENT 'Họ - tên đệm',
  first_name varchar(50) NOT NULL COMMENT 'Tên',
  birthday int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'Ngày sinh',
  gender tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Giới tính',
  marital tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Tình trạng hôn nhân',
  address varchar(255) NOT NULL COMMENT 'Địa chỉ',
  province varchar(10) NOT NULL COMMENT 'Tỉnh / Thành phố',
  phone varchar(20) NOT NULL COMMENT 'Điện thoai',
  userid int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'ID thành viên',
  addtime int(11) unsigned NOT NULL COMMENT 'Thời gian đăng ký',
  updatetime int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'Thời gian cập nhật',
  status tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Trạng thái',
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobseeker_rsave(
  userid int(11) unsigned NOT NULL,
  rows_id int(11) unsigned NOT NULL,
  UNIQUE KEY userid (userid,rows_id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_learning(
  id smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL COMMENT 'Tên gọi bộ phận',
  note tinytext NOT NULL COMMENT 'Ghi chú',
  weight smallint(4) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) NOT NULL COMMENT 'Trạng thái',
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_money_units(
  id tinyint(2) unsigned NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL COMMENT 'Tên gọi tiền tệ',
  note tinytext NOT NULL COMMENT 'Ghi chú',
  weight smallint(4) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) NOT NULL COMMENT 'Trạng thái',
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_position(
  id smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL COMMENT 'Tên gọi vị trí',
  note tinytext NOT NULL COMMENT 'Ghi chú',
  weight smallint(4) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) NOT NULL COMMENT 'Trạng thái',
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province(
  provinceid varchar(5) NOT NULL,
  name varchar(100) NOT NULL,
  type varchar(30) NOT NULL,
  PRIMARY KEY (provinceid)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_record(
  id mediumint(8) NOT NULL AUTO_INCREMENT COMMENT 'ID hồ sơ',
  title varchar(255) NOT NULL COMMENT 'Tiêu đề',
  jobs_id smallint(4) unsigned NOT NULL COMMENT 'ID Ngành nghề',
  position_id smallint(4) unsigned NOT NULL COMMENT 'ID vj trí tuyển dụng',
  salary varchar(50) NOT NULL COMMENT 'Mức lương mong muốn',
  worktype_id smallint(4) NOT NULL COMMENT 'Hình thức làm việc mong muốn',
  graduate_school varchar(255) NOT NULL COMMENT 'Trường tốt nghiệp',
  graduate_year varchar(10) NOT NULL COMMENT 'Năm tốt nghiệp',
  degree text NOT NULL COMMENT 'Bằng cấp',
  worked_company text NOT NULL COMMENT 'Các công ty từng làm việc',
  worked_work text NOT NULL COMMENT 'Các công việc đã từng làm',
  worked_position text NOT NULL COMMENT 'Chức vụ từng làm',
  experience tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Số năm kinh nghiệm',
  target text NOT NULL COMMENT 'Mục tiêu nghề nghiệp',
  achievement text NOT NULL COMMENT 'Thành tích làm việc',
  worked_experience text NOT NULL COMMENT 'Kinh nghiệm làm việc',
  skill text NOT NULL COMMENT 'Kỹ năng',
  userid int(11) unsigned NOT NULL DEFAULT '0',
  addtime int(11) unsigned NOT NULL,
  updatetime int(11) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) NOT NULL COMMENT 'Trạng thái',
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_record_wlocation(
  record_id mediumint(8) unsigned NOT NULL,
  location_id varchar(10) NOT NULL,
  UNIQUE KEY record_id (record_id,location_id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows(
  id int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID tin',
  jobprovider_id int(11) unsigned NOT NULL COMMENT 'ID công ty',
  title varchar(255) NOT NULL COMMENT 'Tiêu đề tin',
  alias varchar(255) NOT NULL COMMENT 'Liên kết tĩnh',
  code varchar(15) NOT NULL,
  position_id smallint(4) unsigned NOT NULL COMMENT 'ID vị trí tuyển dụng',
  jobs_id smallint(4) unsigned NOT NULL COMMENT 'ID ngành nghề',
  worktype_id smallint(4) NOT NULL COMMENT 'ID loại hình công việc',
  salary_from float NOT NULL DEFAULT '0' COMMENT 'Lương từ',
  salary_to float NOT NULL DEFAULT '0' COMMENT 'Lương đến',
  money_units tinyint(2) unsigned NOT NULL,
  experience float NOT NULL DEFAULT '0' COMMENT 'Kinh nghiệm',
  degree text NOT NULL COMMENT 'Yêu cầu bằng cấp',
  gender tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT 'Yêu cầu giới tính',
  age varchar(20) NOT NULL DEFAULT '' COMMENT 'Yêu cầu độ tuổi',
  quantity smallint(4) NOT NULL DEFAULT '0' COMMENT 'Số lượng cần tuyển',
  job_description text NOT NULL COMMENT 'Mô tả công việc',
  more_requirement text NOT NULL COMMENT 'Yêu cầu khác',
  document_id varchar(255) NOT NULL COMMENT 'Danh sách ID hồ sơ',
  document_exp int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'Hạn nộp hồ sơ',
  document_type_id varchar(255) NOT NULL COMMENT 'Hình thức nộp hồ sơ',
  contact_fullname varchar(255) NOT NULL,
  contact_email varchar(50) NOT NULL,
  contact_phone varchar(20) NOT NULL,
  adduser int(11) unsigned NOT NULL DEFAULT '0',
  addtime int(11) unsigned NOT NULL DEFAULT '0',
  edittime int(11) unsigned NOT NULL DEFAULT '0',
  viewcount int(11) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (id),
  UNIQUE KEY code (code)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows_province(
  rows_id int(11) unsigned NOT NULL DEFAULT '0',
  province_id varchar(10) NOT NULL
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_worktype(
  id smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL COMMENT 'Tên gọi loại hình công việc',
  note tinytext NOT NULL COMMENT 'Ghi chú',
  weight smallint(4) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) NOT NULL COMMENT 'Trạng thái',
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_candidate (id, lastname, firstname, birthday, gender, marital, nationality, address, position, email, phone) VALUES('1', 'Hồ Ngọc', 'Triển', '716490000', '1', 'Độc thân', 'Việt Nam', 'Anh Tuấn - Triệu Tài - Triệu Phong', '', 'hongoctrien@vinades.vn', '01692777914');";

$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_config (config_name, config_value) VALUES('record_queue', '1');";

$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_document (id, title, note, weight, status) VALUES('1', 'Giấy chứng nhận tốt nghiệp', '', '1', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_document (id, title, note, weight, status) VALUES('2', 'Bản sao giấy khai sinh (Công chứng)', '', '2', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_document (id, title, note, weight, status) VALUES('3', 'Bản sao CMND (Công chứng)', '', '3', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_document (id, title, note, weight, status) VALUES('4', 'Bản sao các bằng cấp, chứng chỉ khác (Nếu có)', '', '4', '1');";

$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_document_type (id, title, note, weight, status) VALUES('1', 'Trực tiếp tại văn phòng', '', '1', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_document_type (id, title, note, weight, status) VALUES('2', 'Qua email contact@hapuonine.com', '', '2', '1');";

$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobprovider (id, title, alias, address, email, fax, website, agent, descripion, contact_fullname, contact_email, contact_phone, userid, status) VALUES('2', 'Công ty TNHH thương mại ABC', 'Cong-ty-TNHH-thuong-mai-ABC', 'Anh Tuấn - Triệu Tài - Triệu Phong', 'hoaquynhanh.anhtuan@gmail.com', '0650.3.xxx.xxx', 'http://mynukeviet.net', '0', 'Công ty Thang máy Thái Bình có được nền tảng vững chắc như hiện nay chính là thành quả của một chặng đường dài tập thể chúng tôi cùng nhau xây dựng và phát triển. Trên chặng đường ấy có những dấu mốc quan trọng, góp phần tạo dựng thương hiệu Thang máy Thái Bình vững mạnh hôm nay.<br  />
<br  />
LỊCH SỬ HÌNH THÀNH VÀ PHÁT TRIỂN<br  />
<br  />
Công ty Thang máy Thái Bình có được nền tảng vững chắc như hiện nay chính là thành quả của một chặng đường dài tập thể chúng tôi cùng nhau xây dựng và phát triển. Trên chặng đường ấy có những dấu mốc quan trọng, góp phần tạo dựng thương hiệu Thang máy Thái Bình vững mạnh hôm nay.<br  />
<br  />
Năm 1995: Công ty Thang máy Thái Bình được thành lập với định hướng phát triển thị trường toàn quốc, các nước trong khu vực và các nước Trung Đông.<br  />
<br  />
Năm 1996:Thành lập VPKV Hồ Chí Minh có vai trò quản lý các công trình thuộc khu vực phía Nam Việt Nam, thị trường Campuchia và các nước Trung Đông. Hiện nay, VPKV Hồ Chí Minh đã có trạm bảo trì- sửa chữa tại Vũng Tàu, đảm bảo đáp ứng nhanh chóng và kịp thời nhu cầu của khách hàng.<br  />
<br  />
Năm 1999: VPKV Hà Nội được thành lập nhằm đẩy mạnh hiệu quả trong việc khai thác thị trường và khu vực phía Bắc từ Hà Giang đến Hà Tĩnh. VPKV Hà Nội cũng đã phát triển thêm 03 trạm bảo trì sửa chữa tại Quảng Ninh, Vinh và Thanh Hóa, để khách hàng có thêm niềm tin khi lựa chọn Thang máy Thái Bình.<br  />
<br  />
Năm 2001: Thang máy Thái Bình thành lập VPKV Đà Nẵng quản lý khu vực từ Quảng Bình đến Quảng Ngãi. Theo quá trình phát triển, VPKV Đà Nẵng đã thành lập trạm Quảng Ngãi để nâng cao chất lượng phục vụ khách hàng của VPKV Đà Nẵng.<br  />
<br  />
Năm 2002: VPKV Nha Trang thành lập quản lý các tỉnh thành miền Trung, từ Bình Định đến Ninh Thuận, khu vực Tây Nguyên từ Kontum đến Lâm Đồng và thị trường tại Lào. Đến thời điểm hiện tại, VPNT đã xây dựng 05 trạm bảo trì – sửa chữa tại Gia Lai, Đak lak, Đà Lạt, Phú Yên và Bình Định.<br  />
<br  />
Năm 2003: Nhà máy sản xuất được dời về KCN Tây Bắc Củ Chi, TP.HCM để mở rộng quy mô sản xuất.<br  />
<br  />
Năm 2005: Công ty Thang máy Thái Bình đón nhận chứng nhận ISO 9001:2000 một chứng nhận uy tín minh chứng cho tiêu chuẩn chất lượng sản phẩm Thang máy Thái Bình.<br  />
<br  />
Năm 2007: Với năng lực và bề dày kinh nghiệm tại thị trường Việt Nam, Thang máy Thái Bình đã được TECNO - một thương hiệu thang máy, thang cuốn hàng đầu của Italy, đã có mặt trên 43 quốc gia - ủy quyền cung cấp sản phẩm nhãn hiệu TECNO cho thị trường Việt Nam, Lào và Campuchia.<br  />
<br  />
Năm 2010: Thành lập VPKV Cần Thơ, khai thác thị trường miền Tây từ Đồng Tháp đến đất mũi Cà Mau, Phú Quốc. Đồng thời, Thang máy Thái Bình còn vinh dự nhận được giải bạc Chất lượng Quốc Gia.<br  />
<br  />
Năm 2011: Nâng cấp Nhà máy sản xuất, toàn bộ sản phẩm được sản xuất theo dây chuyền tự động hóa với công nghệ được chuyển giao từ thương hiệu thang máy, thang cuốn TECNO (Italy), nâng cao chất lượng sản phẩm đồng thời nâng cao hiệu quả về thời gian sản xuất.<br  />
<br  />
Năm 2012: Dời trụ sở làm việc của VP Tổng công ty và VPKV Hồ Chí Minh đến tòa nhà SENTOSA tại 219 Thạch Lam, P. Phú Thạnh, Q. Tân Phú, Tp.HCM – một văn phòng khang trang, được xây dựng theo kiến trúc hiện đại và áp dụng các quy trình quản lý tiên tiến.', 'w45y 6', 'admin@mail.com', '0983456898', '2', '1');";

$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobprovider_jobs (provider_id, jobs_id) VALUES('2', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobprovider_jobs (provider_id, jobs_id) VALUES('2', '4');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobprovider_jobs (provider_id, jobs_id) VALUES('3', '1');";

$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobs (id, title, alias, note, weight, numitems, status) VALUES('1', 'Trình dược viên', 'Trinh-duoc-vien', '', '1', '0', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobs (id, title, alias, note, weight, numitems, status) VALUES('2', 'Nhân viên bán hàng', 'Nhan-vien-ban-hang', '', '2', '4', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobs (id, title, alias, note, weight, numitems, status) VALUES('3', 'Nhân viên giao hàng', 'Nhan-vien-giao-hang', '', '3', '7', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobs (id, title, alias, note, weight, numitems, status) VALUES('4', 'Nghiên cứu - Phát triển sản phẩm', 'Nghien-cuu-Phat-trien-san-pham', '', '4', '1', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobs (id, title, alias, note, weight, numitems, status) VALUES('5', 'Marketing - Truyền thông', 'Marketing-Truyen-thong', '', '5', '0', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobs (id, title, alias, note, weight, numitems, status) VALUES('6', 'Quản lý', 'Quan-ly', 'Bán hàng, truyền thông, marketing, ……', '6', '0', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobs (id, title, alias, note, weight, numitems, status) VALUES('7', 'Kế toán - Thủ kho', 'Ke-toan-Thu-kho', '', '7', '0', '1');";

$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobseeker (id, last_name, first_name, birthday, gender, marital, address, province, phone, userid, addtime, updatetime, status) VALUES('2', 't t', 'w45y 4y5', '1439398800', '1', '0', '', '25', '01692777913', '1', '0', '0', '1');";


$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_learning (id, title, note, weight, status) VALUES('1', 'Phổ thông', '', '1', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_learning (id, title, note, weight, status) VALUES('2', 'Dạy nghề', '', '2', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_learning (id, title, note, weight, status) VALUES('3', 'Trung cấp', '', '3', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_learning (id, title, note, weight, status) VALUES('4', 'Cao đẳng', '', '4', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_learning (id, title, note, weight, status) VALUES('5', 'Đại học', '', '5', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_learning (id, title, note, weight, status) VALUES('6', 'Trên đại học', '', '6', '1');";

$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_money_units (id, title, note, weight, status) VALUES('1', 'VND', 'Vietnam Dong', '1', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_money_units (id, title, note, weight, status) VALUES('2', 'USD', 'US Dollar', '2', '1');";

$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_position (id, title, note, weight, status) VALUES('1', 'Quản lý', '', '3', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_position (id, title, note, weight, status) VALUES('2', 'Nhân viên', '', '4', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_position (id, title, note, weight, status) VALUES('4', 'Giám đốc', '', '1', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_position (id, title, note, weight, status) VALUES('5', 'Phó giám đốc', '', '2', '1');";

$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('01', 'Hà Nội', 'Thành Phố');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('02', 'Hà Giang', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('04', 'Cao Bằng', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('06', 'Bắc Kạn', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('08', 'Tuyên Quang', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('10', 'Lào Cai', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('11', 'Điện Biên', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('12', 'Lai Châu', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('14', 'Sơn La', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('15', 'Yên Bái', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('17', 'Hòa Bình', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('19', 'Thái Nguyên', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('20', 'Lạng Sơn', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('22', 'Quảng Ninh', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('24', 'Bắc Giang', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('25', 'Phú Thọ', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('26', 'Vĩnh Phúc', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('27', 'Bắc Ninh', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('30', 'Hải Dương', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('31', 'Hải Phòng', 'Thành Phố');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('33', 'Hưng Yên', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('34', 'Thái Bình', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('35', 'Hà Nam', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('36', 'Nam Định', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('37', 'Ninh Bình', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('38', 'Thanh Hóa', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('40', 'Nghệ An', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('42', 'Hà Tĩnh', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('44', 'Quảng Bình', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('45', 'Quảng Trị', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('46', 'Thừa Thiên Huế', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('48', 'Đà Nẵng', 'Thành Phố');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('49', 'Quảng Nam', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('51', 'Quảng Ngãi', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('52', 'Bình Định', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('54', 'Phú Yên', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('56', 'Khánh Hòa', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('58', 'Ninh Thuận', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('60', 'Bình Thuận', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('62', 'Kon Tum', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('64', 'Gia Lai', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('66', 'Đắk Lắk', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('67', 'Đắk Nông', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('68', 'Lâm Đồng', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('70', 'Bình Phước', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('72', 'Tây Ninh', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('74', 'Bình Dương', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('75', 'Đồng Nai', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('77', 'Bà Rịa - Vũng Tàu', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('79', 'Hồ Chí Minh', 'Thành Phố');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('80', 'Long An', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('82', 'Tiền Giang', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('83', 'Bến Tre', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('84', 'Trà Vinh', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('86', 'Vĩnh Long', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('87', 'Đồng Tháp', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('89', 'An Giang', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('91', 'Kiên Giang', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('92', 'Cần Thơ', 'Thành Phố');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('93', 'Hậu Giang', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('94', 'Sóc Trăng', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('95', 'Bạc Liêu', 'Tỉnh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('96', 'Cà Mau', 'Tỉnh');";

$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_record (id, title, jobs_id, position_id, salary, worktype_id, graduate_school, graduate_year, degree, worked_company, worked_work, worked_position, experience, target, achievement, worked_experience, skill, userid, addtime, updatetime, status) VALUES('5', 'Bn3n', '3', '2', '', '2', '', '', '', '', '', '', '3', '', '', '', '', '1', '0', '1440323921', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_record (id, title, jobs_id, position_id, salary, worktype_id, graduate_school, graduate_year, degree, worked_company, worked_work, worked_position, experience, target, achievement, worked_experience, skill, userid, addtime, updatetime, status) VALUES('7', '5ưy ư45', '2', '2', '', '0', '', '', '111', '', '', '', '2', '', '', '5y 54', '', '1', '1439537034', '1440318357', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_record (id, title, jobs_id, position_id, salary, worktype_id, graduate_school, graduate_year, degree, worked_company, worked_work, worked_position, experience, target, achievement, worked_experience, skill, userid, addtime, updatetime, status) VALUES('8', '6 56u 5u', '3', '2', '', '0', '', '', '', '', '', '', '2', '', '', '', '', '1', '1440320399', '1440322754', '3');";

$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_record_wlocation (record_id, location_id) VALUES('0', '02');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_record_wlocation (record_id, location_id) VALUES('5', '22');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_record_wlocation (record_id, location_id) VALUES('5', '25');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_record_wlocation (record_id, location_id) VALUES('7', '04');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_record_wlocation (record_id, location_id) VALUES('7', '08');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_record_wlocation (record_id, location_id) VALUES('8', '04');";

$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows (id, jobprovider_id, title, alias, code, position_id, jobs_id, worktype_id, salary_from, salary_to, money_units, experience, degree, gender, age, quantity, job_description, more_requirement, document_id, document_exp, document_type_id, contact_fullname, contact_email, contact_phone, adduser, addtime, edittime, viewcount, status) VALUES('3', '2', 'Tuyển dụng nhân viên bán hàng', 'Tuyen-dung-nhan-vien-ban-hang', 'TD000003', '2', '3', '1', '3000000', '0', '2', '12', '', '0', '20-30', '12', 'Bán hàng tại các nhà thuốc trên địa bàn tỉnh Hà Giang', '', '1,2,3,4', '1433869200', '1,2', '', '', '', '1', '1434792280', '1434877247', '2', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows (id, jobprovider_id, title, alias, code, position_id, jobs_id, worktype_id, salary_from, salary_to, money_units, experience, degree, gender, age, quantity, job_description, more_requirement, document_id, document_exp, document_type_id, contact_fullname, contact_email, contact_phone, adduser, addtime, edittime, viewcount, status) VALUES('15', '2', 'Kế toán trưởng', 'Ke-toan-truong', 'TD000015', '1', '3', '1', '0', '0', '1', '0', '', '1', '', '0', '&nbsp;w5 4y 36&nbsp;', '', '1,2,3', '0', '1', '', '', '', '1', '1434878280', '1435196751', '0', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows (id, jobprovider_id, title, alias, code, position_id, jobs_id, worktype_id, salary_from, salary_to, money_units, experience, degree, gender, age, quantity, job_description, more_requirement, document_id, document_exp, document_type_id, contact_fullname, contact_email, contact_phone, adduser, addtime, edittime, viewcount, status) VALUES('16', '2', 'Nhân viên bảo vệ', 'Nhan-vien-bao-ve', 'TD000016', '1', '3', '1', '0', '0', '1', '0', '', '1', '', '0', '&nbsp;w5 4y 36&nbsp;', '', '1,2,3', '0', '1', '', '', '', '1', '1434878283', '1435196727', '2', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows (id, jobprovider_id, title, alias, code, position_id, jobs_id, worktype_id, salary_from, salary_to, money_units, experience, degree, gender, age, quantity, job_description, more_requirement, document_id, document_exp, document_type_id, contact_fullname, contact_email, contact_phone, adduser, addtime, edittime, viewcount, status) VALUES('17', '2', 'Nhân viên giao nhận', 'Nhan-vien-giao-nhan', 'TD000017', '1', '3', '1', '0', '0', '1', '0', '', '1', '', '0', '&nbsp;w5 4y 36&nbsp;', '', '1,2,3', '0', '1', '', '', '', '1', '1434878284', '1435196705', '2', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows (id, jobprovider_id, title, alias, code, position_id, jobs_id, worktype_id, salary_from, salary_to, money_units, experience, degree, gender, age, quantity, job_description, more_requirement, document_id, document_exp, document_type_id, contact_fullname, contact_email, contact_phone, adduser, addtime, edittime, viewcount, status) VALUES('18', '2', 'Nhân viên kinh doanh', 'Nhan-vien-kinh-doanh', 'TD000018', '1', '3', '1', '0', '0', '1', '0', '', '1', '', '0', '&nbsp;w5 4y 36&nbsp;', '', '1,2,3', '0', '1', '', '', '', '1', '1434878286', '1435196688', '3', '1');";

$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows_province (rows_id, province_id) VALUES('3', '15');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows_province (rows_id, province_id) VALUES('15', '04');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows_province (rows_id, province_id) VALUES('16', '04');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows_province (rows_id, province_id) VALUES('17', '04');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows_province (rows_id, province_id) VALUES('18', '04');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows_province (rows_id, province_id) VALUES('16', '14');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows_province (rows_id, province_id) VALUES('21', '04');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows_province (rows_id, province_id) VALUES('22', '01');";

$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_worktype (id, title, note, weight, status) VALUES('1', 'Toàn thời gian', '', '1', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_worktype (id, title, note, weight, status) VALUES('2', 'Bán thời gian', '', '2', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_worktype (id, title, note, weight, status) VALUES('3', 'Làm thêm', '', '3', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_worktype (id, title, note, weight, status) VALUES('4', 'Lao động thời vụ', '', '4', '1');";