<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Fri, 19 Jun 2015 07:33:37 GMT
 */

if ( ! defined( 'NV_IS_MOD_RECRUITMENT' ) ) die( 'Stop!!!' );

$id = explode( '-', $array_op[1] );
$id = intval( end( $id ) );
$print = ( isset( $array_op[2] ) and $array_op[2] == 'print' ) ? 1 : 0;

$record_data = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_record WHERE id=' . $id )->fetch();
if( empty( $record_data ) )
{
	Header( 'Location: ' . nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $module_info['alias']['jobprovider-area'], true ) );
	die();
}
$record_data['title'] = !empty( $record_data['title'] ) ? $record_data['title'] : $array_jobs[$record_data['jobs_id']]['title'];

$record_data['province_id'] = array();
	
$_result = $db->query( 'SELECT distinct provinceid FROM ' . NV_PREFIXLANG . '_' . $module_data . '_record_wlocation WHERE record_id=' . $record_data['id'] );
			while( list( $province_id ) = $_result->fetch( 3 ) )
			{
				$record_data['province_id'][] = $province_id;
			}

$jobseeker_info = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobseeker WHERE userid=' . $record_data['userid'] )->fetch();
if( empty( $jobseeker_info ) )
{
	Header( 'Location: ' . nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $module_info['alias']['jobprovider-area'], true ) );
	die( );
}
$jobseeker_info['photo'] = NV_BASE_SITEURL . 'themes/default/images/users/no_avatar.png';
if( !empty( $record_data['contact_image'] ) )
{
	$jobseeker_info['photo'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/record_images/' . $record_data['contact_image'];
}

// Cap nhat luot xem
$time_set = $nv_Request->get_int( $module_data . '_' . str_replace( '-', '_', $op ) . '_' . $id, 'session' );
if( empty( $time_set ) )
{
	$nv_Request->set_Session( $module_data . '_' . str_replace( '-', '_', $op ) . '_' . $id, NV_CURRENTTIME );
	$query = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_record SET viewcount=viewcount+1 WHERE id=' . $id;
	$db->query( $query );
}

$record_data['foreign_language'] = nv_nl2br( $record_data['foreign_language'] );

$page_title = $record_data['title'];
$contents = nv_theme_recruitment_viewrecord( $record_data, $jobseeker_info, $print );

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme( $contents, !$print );
include NV_ROOTDIR . '/includes/footer.php';