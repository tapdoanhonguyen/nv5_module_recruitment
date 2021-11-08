<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VIETNAM DIGITAL TRADING TECHNOLOGY COMPANY LIMITED (contact@thuongmaiso.vn)
 * @Copyright (C) 2014 VIETNAM DIGITAL TRADING TECHNOLOGY COMPANY LIMITED. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 2-10-2010 20:59
 */

if ( ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );

$module_version = array(
	'name' => 'Recruitment',
	'modfuncs' => 'main,content,list-post,detail,search,viewjobs,record,record-content,jobseeker,jobprovider-content,jobprovider,all-post,ajax,list-post-saved,print-post,jobprovider-area,view-record,viewjobs-record,hot-post,hot-record,send-record,sended-record,sended-record-view,confirm-page,viewprovince,viewprovince-record,groups,config',
	'change_alias' => 'main,list-post,search,jobprovider,record-content,all-post,list-post-saved,print-post,jobprovider-area,view-record,viewjobs-record,hot-post,hot-record,send-record,sended-record,sended-record-view,confirm-page,viewprovince-record,groups',
	'submenu' => 'main,content,list-post,detail,search,viewjobs,record,record-content,jobseeker,jobprovider-content,jobprovider,all-post,ajax,list-post-saved,print-post,jobprovider-area,view-record,viewjobs-record,hot-post,hot-record,send-record,sended-record,sended-record-view,confirm-page,viewprovince,viewprovince-record,groups',
	'is_sysmod' => 0,
	'virtual' => 1,
	'version' => '4.3.4',
	'date' => 'Fri, 19 Jun 2018 07:33:37 GMT',
	'author' => 'VIETNAM DIGITAL TRADING  COMPANY LIMITED (contact@thuongmaiso.vn)',
	'uploads_dir' => array( $module_upload, $module_upload . '/record', $module_upload . '/record_images', $module_upload . '/jobprovider_images' ),
	'note' => 'Module tuyển dụng NukeViet 4'
);