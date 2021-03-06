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
  id int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID ???ng vi??n',
  lastname varchar(100) NOT NULL COMMENT 'H???, t??n ?????m',
  firstname varchar(50) NOT NULL COMMENT 'T??n',
  birthday int(11) unsigned NOT NULL COMMENT 'Ng??y sinh',
  gender tinyint(1) unsigned NOT NULL COMMENT 'Gi???i t??nh',
  marital varchar(255) NOT NULL COMMENT 'T??nh tr???ng  h??n nh??n',
  nationality varchar(255) NOT NULL COMMENT 'Qu???c t???ch',
  address varchar(255) NOT NULL COMMENT '?????a ch???',
  position varchar(255) NOT NULL COMMENT 'V??? tr??',
  email varchar(255) NOT NULL COMMENT 'Email',
  phone varchar(20) NOT NULL COMMENT '??i???n tho???i',
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_config(
  config_name varchar(30) NOT NULL,
  config_value varchar(255) NOT NULL,
  UNIQUE KEY config_name (config_name)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_document(
  id smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL COMMENT 'T??n g???i h??? s??',
  note tinytext NOT NULL COMMENT 'Ghi ch??',
  weight smallint(4) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) NOT NULL COMMENT 'Tr???ng th??i',
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_document_type(
  id smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL COMMENT 'T??n g???i h??nh th???c n???p h??? s??',
  note tinytext NOT NULL COMMENT 'Ghi ch??',
  weight smallint(4) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) NOT NULL COMMENT 'Tr???ng th??i',
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobprovider(
  id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL COMMENT 'T??n c??ng ty',
  alias varchar(255) NOT NULL,
  address varchar(255) NOT NULL COMMENT '?????a ch???',
  email varchar(50) NOT NULL COMMENT 'Email',
  fax varchar(20) NOT NULL COMMENT 'Fax',
  website varchar(100) NOT NULL COMMENT 'Website',
  agent smallint(4) unsigned NOT NULL COMMENT 'S??? nh??n vi??n',
  descripion text NOT NULL COMMENT 'Gi???i thi???u',
  contact_fullname varchar(255) NOT NULL COMMENT 'H??? t??n ng?????i ?????i di???n',
  contact_email varchar(50) NOT NULL COMMENT 'Email ng?????i ?????i di???n',
  contact_phone varchar(20) NOT NULL COMMENT '??i??n tho???i ng?????i ?????i di???n',
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
  title varchar(255) NOT NULL COMMENT 'T??n g???i ng??nh ngh???',
  alias varchar(255) NOT NULL,
  note tinytext NOT NULL COMMENT 'Ghi ch??',
  weight smallint(4) unsigned NOT NULL DEFAULT '0',
  numitems mediumint(8) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) NOT NULL COMMENT 'Tr???ng th??i',
  PRIMARY KEY (id),
  UNIQUE KEY title (title)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobseeker(
  id int(11) unsigned NOT NULL AUTO_INCREMENT,
  last_name varchar(255) NOT NULL COMMENT 'H??? - t??n ?????m',
  first_name varchar(50) NOT NULL COMMENT 'T??n',
  birthday int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'Ng??y sinh',
  gender tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Gi???i t??nh',
  marital tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'T??nh tr???ng h??n nh??n',
  address varchar(255) NOT NULL COMMENT '?????a ch???',
  province varchar(10) NOT NULL COMMENT 'T???nh / Th??nh ph???',
  phone varchar(20) NOT NULL COMMENT '??i???n thoai',
  userid int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'ID th??nh vi??n',
  addtime int(11) unsigned NOT NULL COMMENT 'Th???i gian ????ng k??',
  updatetime int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'Th???i gian c???p nh???t',
  status tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Tr???ng th??i',
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobseeker_rsave(
  userid int(11) unsigned NOT NULL,
  rows_id int(11) unsigned NOT NULL,
  UNIQUE KEY userid (userid,rows_id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_learning(
  id smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL COMMENT 'T??n g???i b??? ph???n',
  note tinytext NOT NULL COMMENT 'Ghi ch??',
  weight smallint(4) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) NOT NULL COMMENT 'Tr???ng th??i',
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_money_units(
  id tinyint(2) unsigned NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL COMMENT 'T??n g???i ti???n t???',
  note tinytext NOT NULL COMMENT 'Ghi ch??',
  weight smallint(4) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) NOT NULL COMMENT 'Tr???ng th??i',
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_position(
  id smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL COMMENT 'T??n g???i v??? tr??',
  note tinytext NOT NULL COMMENT 'Ghi ch??',
  weight smallint(4) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) NOT NULL COMMENT 'Tr???ng th??i',
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province(
  provinceid varchar(5) NOT NULL,
  name varchar(100) NOT NULL,
  type varchar(30) NOT NULL,
  PRIMARY KEY (provinceid)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_record(
  id mediumint(8) NOT NULL AUTO_INCREMENT COMMENT 'ID h??? s??',
  title varchar(255) NOT NULL COMMENT 'Ti??u ?????',
  jobs_id smallint(4) unsigned NOT NULL COMMENT 'ID Ng??nh ngh???',
  position_id smallint(4) unsigned NOT NULL COMMENT 'ID vj tr?? tuy???n d???ng',
  salary varchar(50) NOT NULL COMMENT 'M???c l????ng mong mu???n',
  worktype_id smallint(4) NOT NULL COMMENT 'H??nh th???c l??m vi???c mong mu???n',
  graduate_school varchar(255) NOT NULL COMMENT 'Tr?????ng t???t nghi???p',
  graduate_year varchar(10) NOT NULL COMMENT 'N??m t???t nghi???p',
  degree text NOT NULL COMMENT 'B???ng c???p',
  worked_company text NOT NULL COMMENT 'C??c c??ng ty t???ng l??m vi???c',
  worked_work text NOT NULL COMMENT 'C??c c??ng vi???c ???? t???ng l??m',
  worked_position text NOT NULL COMMENT 'Ch???c v??? t???ng l??m',
  experience tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'S??? n??m kinh nghi???m',
  target text NOT NULL COMMENT 'M???c ti??u ngh??? nghi???p',
  achievement text NOT NULL COMMENT 'Th??nh t??ch l??m vi???c',
  worked_experience text NOT NULL COMMENT 'Kinh nghi???m l??m vi???c',
  skill text NOT NULL COMMENT 'K??? n??ng',
  userid int(11) unsigned NOT NULL DEFAULT '0',
  addtime int(11) unsigned NOT NULL,
  updatetime int(11) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) NOT NULL COMMENT 'Tr???ng th??i',
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_record_wlocation(
  record_id mediumint(8) unsigned NOT NULL,
  location_id varchar(10) NOT NULL,
  UNIQUE KEY record_id (record_id,location_id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows(
  id int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID tin',
  jobprovider_id int(11) unsigned NOT NULL COMMENT 'ID c??ng ty',
  title varchar(255) NOT NULL COMMENT 'Ti??u ????? tin',
  alias varchar(255) NOT NULL COMMENT 'Li??n k???t t??nh',
  code varchar(15) NOT NULL,
  position_id smallint(4) unsigned NOT NULL COMMENT 'ID v??? tr?? tuy???n d???ng',
  jobs_id smallint(4) unsigned NOT NULL COMMENT 'ID ng??nh ngh???',
  worktype_id smallint(4) NOT NULL COMMENT 'ID lo???i h??nh c??ng vi???c',
  salary_from float NOT NULL DEFAULT '0' COMMENT 'L????ng t???',
  salary_to float NOT NULL DEFAULT '0' COMMENT 'L????ng ?????n',
  money_units tinyint(2) unsigned NOT NULL,
  experience float NOT NULL DEFAULT '0' COMMENT 'Kinh nghi???m',
  degree text NOT NULL COMMENT 'Y??u c???u b???ng c???p',
  gender tinyint(1) unsigned NOT NULL DEFAULT '2' COMMENT 'Y??u c???u gi???i t??nh',
  age varchar(20) NOT NULL DEFAULT '' COMMENT 'Y??u c???u ????? tu???i',
  quantity smallint(4) NOT NULL DEFAULT '0' COMMENT 'S??? l?????ng c???n tuy???n',
  job_description text NOT NULL COMMENT 'M?? t??? c??ng vi???c',
  more_requirement text NOT NULL COMMENT 'Y??u c???u kh??c',
  document_id varchar(255) NOT NULL COMMENT 'Danh s??ch ID h??? s??',
  document_exp int(11) unsigned NOT NULL DEFAULT '0' COMMENT 'H???n n???p h??? s??',
  document_type_id varchar(255) NOT NULL COMMENT 'H??nh th???c n???p h??? s??',
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
  title varchar(255) NOT NULL COMMENT 'T??n g???i lo???i h??nh c??ng vi???c',
  note tinytext NOT NULL COMMENT 'Ghi ch??',
  weight smallint(4) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) NOT NULL COMMENT 'Tr???ng th??i',
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_candidate (id, lastname, firstname, birthday, gender, marital, nationality, address, position, email, phone) VALUES('1', 'H??? Ng???c', 'Tri???n', '716490000', '1', '?????c th??n', 'Vi???t Nam', 'Anh Tu???n - Tri???u T??i - Tri???u Phong', '', 'hongoctrien@vinades.vn', '01692777914');";

$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_config (config_name, config_value) VALUES('record_queue', '1');";

$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_document (id, title, note, weight, status) VALUES('1', 'Gi???y ch???ng nh???n t???t nghi???p', '', '1', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_document (id, title, note, weight, status) VALUES('2', 'B???n sao gi???y khai sinh (C??ng ch???ng)', '', '2', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_document (id, title, note, weight, status) VALUES('3', 'B???n sao CMND (C??ng ch???ng)', '', '3', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_document (id, title, note, weight, status) VALUES('4', 'B???n sao c??c b???ng c???p, ch???ng ch??? kh??c (N???u c??)', '', '4', '1');";

$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_document_type (id, title, note, weight, status) VALUES('1', 'Tr???c ti???p t???i v??n ph??ng', '', '1', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_document_type (id, title, note, weight, status) VALUES('2', 'Qua email contact@hapuonine.com', '', '2', '1');";

$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobprovider (id, title, alias, address, email, fax, website, agent, descripion, contact_fullname, contact_email, contact_phone, userid, status) VALUES('2', 'C??ng ty TNHH th????ng m???i ABC', 'Cong-ty-TNHH-thuong-mai-ABC', 'Anh Tu???n - Tri???u T??i - Tri???u Phong', 'hoaquynhanh.anhtuan@gmail.com', '0650.3.xxx.xxx', 'http://mynukeviet.net', '0', 'C??ng ty Thang m??y Th??i B??nh c?? ???????c n???n t???ng v???ng ch???c nh?? hi???n nay ch??nh l?? th??nh qu??? c???a m???t ch???ng ???????ng d??i t???p th??? ch??ng t??i c??ng nhau x??y d???ng v?? ph??t tri???n. Tr??n ch???ng ???????ng ???y c?? nh???ng d???u m???c quan tr???ng, g??p ph???n t???o d???ng th????ng hi???u Thang m??y Th??i B??nh v???ng m???nh h??m nay.<br  />
<br  />
L???CH S??? H??NH TH??NH V?? PH??T TRI???N<br  />
<br  />
C??ng ty Thang m??y Th??i B??nh c?? ???????c n???n t???ng v???ng ch???c nh?? hi???n nay ch??nh l?? th??nh qu??? c???a m???t ch???ng ???????ng d??i t???p th??? ch??ng t??i c??ng nhau x??y d???ng v?? ph??t tri???n. Tr??n ch???ng ???????ng ???y c?? nh???ng d???u m???c quan tr???ng, g??p ph???n t???o d???ng th????ng hi???u Thang m??y Th??i B??nh v???ng m???nh h??m nay.<br  />
<br  />
N??m 1995: C??ng ty Thang m??y Th??i B??nh ???????c th??nh l???p v???i ?????nh h?????ng ph??t tri???n th??? tr?????ng to??n qu???c, c??c n?????c trong khu v???c v?? c??c n?????c Trung ????ng.<br  />
<br  />
N??m 1996:Th??nh l???p VPKV H??? Ch?? Minh c?? vai tr?? qu???n l?? c??c c??ng tr??nh thu???c khu v???c ph??a Nam Vi???t Nam, th??? tr?????ng Campuchia v?? c??c n?????c Trung ????ng. Hi???n nay, VPKV H??? Ch?? Minh ???? c?? tr???m b???o tr??- s???a ch???a t???i V??ng T??u, ?????m b???o ????p ???ng nhanh ch??ng v?? k???p th???i nhu c???u c???a kh??ch h??ng.<br  />
<br  />
N??m 1999: VPKV H?? N???i ???????c th??nh l???p nh???m ?????y m???nh hi???u qu??? trong vi???c khai th??c th??? tr?????ng v?? khu v???c ph??a B???c t??? H?? Giang ?????n H?? T??nh. VPKV H?? N???i c??ng ???? ph??t tri???n th??m 03 tr???m b???o tr?? s???a ch???a t???i Qu???ng Ninh, Vinh v?? Thanh H??a, ????? kh??ch h??ng c?? th??m ni???m tin khi l???a ch???n Thang m??y Th??i B??nh.<br  />
<br  />
N??m 2001: Thang m??y Th??i B??nh th??nh l???p VPKV ???? N???ng qu???n l?? khu v???c t??? Qu???ng B??nh ?????n Qu???ng Ng??i. Theo qu?? tr??nh ph??t tri???n, VPKV ???? N???ng ???? th??nh l???p tr???m Qu???ng Ng??i ????? n??ng cao ch???t l?????ng ph???c v??? kh??ch h??ng c???a VPKV ???? N???ng.<br  />
<br  />
N??m 2002: VPKV Nha Trang th??nh l???p qu???n l?? c??c t???nh th??nh mi???n Trung, t??? B??nh ?????nh ?????n Ninh Thu???n, khu v???c T??y Nguy??n t??? Kontum ?????n L??m ?????ng v?? th??? tr?????ng t???i L??o. ?????n th???i ??i???m hi???n t???i, VPNT ???? x??y d???ng 05 tr???m b???o tr?? ??? s???a ch???a t???i Gia Lai, ??ak lak, ???? L???t, Ph?? Y??n v?? B??nh ?????nh.<br  />
<br  />
N??m 2003: Nh?? m??y s???n xu???t ???????c d???i v??? KCN T??y B???c C??? Chi, TP.HCM ????? m??? r???ng quy m?? s???n xu???t.<br  />
<br  />
N??m 2005: C??ng ty Thang m??y Th??i B??nh ????n nh???n ch???ng nh???n ISO 9001:2000 m???t ch???ng nh???n uy t??n minh ch???ng cho ti??u chu???n ch???t l?????ng s???n ph???m Thang m??y Th??i B??nh.<br  />
<br  />
N??m 2007: V???i n??ng l???c v?? b??? d??y kinh nghi???m t???i th??? tr?????ng Vi???t Nam, Thang m??y Th??i B??nh ???? ???????c TECNO - m???t th????ng hi???u thang m??y, thang cu???n h??ng ?????u c???a Italy, ???? c?? m???t tr??n 43 qu???c gia - ???y quy???n cung c???p s???n ph???m nh??n hi???u TECNO cho th??? tr?????ng Vi???t Nam, L??o v?? Campuchia.<br  />
<br  />
N??m 2010: Th??nh l???p VPKV C???n Th??, khai th??c th??? tr?????ng mi???n T??y t??? ?????ng Th??p ?????n ?????t m??i C?? Mau, Ph?? Qu???c. ?????ng th???i, Thang m??y Th??i B??nh c??n vinh d??? nh???n ???????c gi???i b???c Ch???t l?????ng Qu???c Gia.<br  />
<br  />
N??m 2011: N??ng c???p Nh?? m??y s???n xu???t, to??n b??? s???n ph???m ???????c s???n xu???t theo d??y chuy???n t??? ?????ng h??a v???i c??ng ngh??? ???????c chuy???n giao t??? th????ng hi???u thang m??y, thang cu???n TECNO (Italy), n??ng cao ch???t l?????ng s???n ph???m ?????ng th???i n??ng cao hi???u qu??? v??? th???i gian s???n xu???t.<br  />
<br  />
N??m 2012: D???i tr??? s??? l??m vi???c c???a VP T???ng c??ng ty v?? VPKV H??? Ch?? Minh ?????n t??a nh?? SENTOSA t???i 219 Th???ch Lam, P. Ph?? Th???nh, Q. T??n Ph??, Tp.HCM ??? m???t v??n ph??ng khang trang, ???????c x??y d???ng theo ki???n tr??c hi???n ?????i v?? ??p d???ng c??c quy tr??nh qu???n l?? ti??n ti???n.', 'w45y 6', 'admin@mail.com', '0983456898', '2', '1');";

$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobprovider_jobs (provider_id, jobs_id) VALUES('2', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobprovider_jobs (provider_id, jobs_id) VALUES('2', '4');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobprovider_jobs (provider_id, jobs_id) VALUES('3', '1');";

$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobs (id, title, alias, note, weight, numitems, status) VALUES('1', 'Tr??nh d?????c vi??n', 'Trinh-duoc-vien', '', '1', '0', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobs (id, title, alias, note, weight, numitems, status) VALUES('2', 'Nh??n vi??n b??n h??ng', 'Nhan-vien-ban-hang', '', '2', '4', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobs (id, title, alias, note, weight, numitems, status) VALUES('3', 'Nh??n vi??n giao h??ng', 'Nhan-vien-giao-hang', '', '3', '7', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobs (id, title, alias, note, weight, numitems, status) VALUES('4', 'Nghi??n c???u - Ph??t tri???n s???n ph???m', 'Nghien-cuu-Phat-trien-san-pham', '', '4', '1', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobs (id, title, alias, note, weight, numitems, status) VALUES('5', 'Marketing - Truy???n th??ng', 'Marketing-Truyen-thong', '', '5', '0', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobs (id, title, alias, note, weight, numitems, status) VALUES('6', 'Qu???n l??', 'Quan-ly', 'B??n h??ng, truy???n th??ng, marketing, ??????', '6', '0', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobs (id, title, alias, note, weight, numitems, status) VALUES('7', 'K??? to??n - Th??? kho', 'Ke-toan-Thu-kho', '', '7', '0', '1');";

$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_jobseeker (id, last_name, first_name, birthday, gender, marital, address, province, phone, userid, addtime, updatetime, status) VALUES('2', 't t', 'w45y 4y5', '1439398800', '1', '0', '', '25', '01692777913', '1', '0', '0', '1');";


$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_learning (id, title, note, weight, status) VALUES('1', 'Ph??? th??ng', '', '1', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_learning (id, title, note, weight, status) VALUES('2', 'D???y ngh???', '', '2', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_learning (id, title, note, weight, status) VALUES('3', 'Trung c???p', '', '3', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_learning (id, title, note, weight, status) VALUES('4', 'Cao ?????ng', '', '4', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_learning (id, title, note, weight, status) VALUES('5', '?????i h???c', '', '5', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_learning (id, title, note, weight, status) VALUES('6', 'Tr??n ?????i h???c', '', '6', '1');";

$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_money_units (id, title, note, weight, status) VALUES('1', 'VND', 'Vietnam Dong', '1', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_money_units (id, title, note, weight, status) VALUES('2', 'USD', 'US Dollar', '2', '1');";

$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_position (id, title, note, weight, status) VALUES('1', 'Qu???n l??', '', '3', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_position (id, title, note, weight, status) VALUES('2', 'Nh??n vi??n', '', '4', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_position (id, title, note, weight, status) VALUES('4', 'Gi??m ?????c', '', '1', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_position (id, title, note, weight, status) VALUES('5', 'Ph?? gi??m ?????c', '', '2', '1');";

$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('01', 'H?? N???i', 'Th??nh Ph???');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('02', 'H?? Giang', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('04', 'Cao B???ng', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('06', 'B???c K???n', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('08', 'Tuy??n Quang', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('10', 'L??o Cai', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('11', '??i???n Bi??n', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('12', 'Lai Ch??u', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('14', 'S??n La', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('15', 'Y??n B??i', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('17', 'H??a B??nh', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('19', 'Th??i Nguy??n', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('20', 'L???ng S??n', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('22', 'Qu???ng Ninh', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('24', 'B???c Giang', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('25', 'Ph?? Th???', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('26', 'V??nh Ph??c', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('27', 'B???c Ninh', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('30', 'H???i D????ng', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('31', 'H???i Ph??ng', 'Th??nh Ph???');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('33', 'H??ng Y??n', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('34', 'Th??i B??nh', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('35', 'H?? Nam', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('36', 'Nam ?????nh', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('37', 'Ninh B??nh', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('38', 'Thanh H??a', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('40', 'Ngh??? An', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('42', 'H?? T??nh', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('44', 'Qu???ng B??nh', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('45', 'Qu???ng Tr???', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('46', 'Th???a Thi??n Hu???', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('48', '???? N???ng', 'Th??nh Ph???');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('49', 'Qu???ng Nam', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('51', 'Qu???ng Ng??i', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('52', 'B??nh ?????nh', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('54', 'Ph?? Y??n', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('56', 'Kh??nh H??a', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('58', 'Ninh Thu???n', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('60', 'B??nh Thu???n', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('62', 'Kon Tum', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('64', 'Gia Lai', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('66', '?????k L???k', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('67', '?????k N??ng', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('68', 'L??m ?????ng', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('70', 'B??nh Ph?????c', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('72', 'T??y Ninh', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('74', 'B??nh D????ng', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('75', '?????ng Nai', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('77', 'B?? R???a - V??ng T??u', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('79', 'H??? Ch?? Minh', 'Th??nh Ph???');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('80', 'Long An', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('82', 'Ti???n Giang', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('83', 'B???n Tre', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('84', 'Tr?? Vinh', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('86', 'V??nh Long', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('87', '?????ng Th??p', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('89', 'An Giang', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('91', 'Ki??n Giang', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('92', 'C???n Th??', 'Th??nh Ph???');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('93', 'H???u Giang', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('94', 'S??c Tr??ng', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('95', 'B???c Li??u', 'T???nh');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_province (provinceid, name, type) VALUES('96', 'C?? Mau', 'T???nh');";

$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_record (id, title, jobs_id, position_id, salary, worktype_id, graduate_school, graduate_year, degree, worked_company, worked_work, worked_position, experience, target, achievement, worked_experience, skill, userid, addtime, updatetime, status) VALUES('5', 'Bn3n', '3', '2', '', '2', '', '', '', '', '', '', '3', '', '', '', '', '1', '0', '1440323921', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_record (id, title, jobs_id, position_id, salary, worktype_id, graduate_school, graduate_year, degree, worked_company, worked_work, worked_position, experience, target, achievement, worked_experience, skill, userid, addtime, updatetime, status) VALUES('7', '5??y ??45', '2', '2', '', '0', '', '', '111', '', '', '', '2', '', '', '5y 54', '', '1', '1439537034', '1440318357', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_record (id, title, jobs_id, position_id, salary, worktype_id, graduate_school, graduate_year, degree, worked_company, worked_work, worked_position, experience, target, achievement, worked_experience, skill, userid, addtime, updatetime, status) VALUES('8', '6 56u 5u', '3', '2', '', '0', '', '', '', '', '', '', '2', '', '', '', '', '1', '1440320399', '1440322754', '3');";

$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_record_wlocation (record_id, location_id) VALUES('0', '02');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_record_wlocation (record_id, location_id) VALUES('5', '22');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_record_wlocation (record_id, location_id) VALUES('5', '25');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_record_wlocation (record_id, location_id) VALUES('7', '04');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_record_wlocation (record_id, location_id) VALUES('7', '08');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_record_wlocation (record_id, location_id) VALUES('8', '04');";

$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows (id, jobprovider_id, title, alias, code, position_id, jobs_id, worktype_id, salary_from, salary_to, money_units, experience, degree, gender, age, quantity, job_description, more_requirement, document_id, document_exp, document_type_id, contact_fullname, contact_email, contact_phone, adduser, addtime, edittime, viewcount, status) VALUES('3', '2', 'Tuy???n d???ng nh??n vi??n b??n h??ng', 'Tuyen-dung-nhan-vien-ban-hang', 'TD000003', '2', '3', '1', '3000000', '0', '2', '12', '', '0', '20-30', '12', 'B??n h??ng t???i c??c nh?? thu???c tr??n ?????a b??n t???nh H?? Giang', '', '1,2,3,4', '1433869200', '1,2', '', '', '', '1', '1434792280', '1434877247', '2', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows (id, jobprovider_id, title, alias, code, position_id, jobs_id, worktype_id, salary_from, salary_to, money_units, experience, degree, gender, age, quantity, job_description, more_requirement, document_id, document_exp, document_type_id, contact_fullname, contact_email, contact_phone, adduser, addtime, edittime, viewcount, status) VALUES('15', '2', 'K??? to??n tr?????ng', 'Ke-toan-truong', 'TD000015', '1', '3', '1', '0', '0', '1', '0', '', '1', '', '0', '&nbsp;w5 4y 36&nbsp;', '', '1,2,3', '0', '1', '', '', '', '1', '1434878280', '1435196751', '0', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows (id, jobprovider_id, title, alias, code, position_id, jobs_id, worktype_id, salary_from, salary_to, money_units, experience, degree, gender, age, quantity, job_description, more_requirement, document_id, document_exp, document_type_id, contact_fullname, contact_email, contact_phone, adduser, addtime, edittime, viewcount, status) VALUES('16', '2', 'Nh??n vi??n b???o v???', 'Nhan-vien-bao-ve', 'TD000016', '1', '3', '1', '0', '0', '1', '0', '', '1', '', '0', '&nbsp;w5 4y 36&nbsp;', '', '1,2,3', '0', '1', '', '', '', '1', '1434878283', '1435196727', '2', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows (id, jobprovider_id, title, alias, code, position_id, jobs_id, worktype_id, salary_from, salary_to, money_units, experience, degree, gender, age, quantity, job_description, more_requirement, document_id, document_exp, document_type_id, contact_fullname, contact_email, contact_phone, adduser, addtime, edittime, viewcount, status) VALUES('17', '2', 'Nh??n vi??n giao nh???n', 'Nhan-vien-giao-nhan', 'TD000017', '1', '3', '1', '0', '0', '1', '0', '', '1', '', '0', '&nbsp;w5 4y 36&nbsp;', '', '1,2,3', '0', '1', '', '', '', '1', '1434878284', '1435196705', '2', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows (id, jobprovider_id, title, alias, code, position_id, jobs_id, worktype_id, salary_from, salary_to, money_units, experience, degree, gender, age, quantity, job_description, more_requirement, document_id, document_exp, document_type_id, contact_fullname, contact_email, contact_phone, adduser, addtime, edittime, viewcount, status) VALUES('18', '2', 'Nh??n vi??n kinh doanh', 'Nhan-vien-kinh-doanh', 'TD000018', '1', '3', '1', '0', '0', '1', '0', '', '1', '', '0', '&nbsp;w5 4y 36&nbsp;', '', '1,2,3', '0', '1', '', '', '', '1', '1434878286', '1435196688', '3', '1');";

$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows_province (rows_id, province_id) VALUES('3', '15');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows_province (rows_id, province_id) VALUES('15', '04');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows_province (rows_id, province_id) VALUES('16', '04');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows_province (rows_id, province_id) VALUES('17', '04');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows_province (rows_id, province_id) VALUES('18', '04');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows_province (rows_id, province_id) VALUES('16', '14');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows_province (rows_id, province_id) VALUES('21', '04');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows_province (rows_id, province_id) VALUES('22', '01');";

$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_worktype (id, title, note, weight, status) VALUES('1', 'To??n th???i gian', '', '1', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_worktype (id, title, note, weight, status) VALUES('2', 'B??n th???i gian', '', '2', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_worktype (id, title, note, weight, status) VALUES('3', 'L??m th??m', '', '3', '1');";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_worktype (id, title, note, weight, status) VALUES('4', 'Lao ?????ng th???i v???', '', '4', '1');";