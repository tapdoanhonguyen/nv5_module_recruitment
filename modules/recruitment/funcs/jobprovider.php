<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Tue, 11 Aug 2015 04:09:47 GMT
 */

if( ! defined( 'NV_IS_MOD_RECRUITMENT' ) ) die( 'Stop!!!' );

$id = explode( '-', $array_op[1] );
$id = intval( end( $id ) );
$post_new = array();

$jobprovider_info = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobprovider WHERE id=' . $id )->fetch();
if( empty( $jobprovider_info ) )
{
	Header( 'Location: ' . nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name, true ) );
	die( );
}

$jobprovider_info['jobs_id'] = array();
$result = $db->query( 'SELECT jobs_id FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobprovider_jobs WHERE provider_id=' . $jobprovider_info['id'] );
while( list( $jobs_id ) = $result->fetch( 3 ) )
{
	$jobprovider_info['jobs_id'][] = $jobs_id;
}
$jobprovider_info['maps'] = !empty( $jobprovider_info['maps'] ) ? unserialize( $jobprovider_info['maps'] ) : array();

$province_info = nv_location_get_province_info( $jobprovider_info['provinceid'] );
$jobprovider_info['province'] = $province_info['title'];

// Danh sach tin dang
$db->sqlreset()
  ->select( '*' )
  ->from( NV_PREFIXLANG . '_' . $module_data . '_rows' )
  ->where( 'status=1 AND jobprovider_id=' . $jobprovider_info['id'] )
  ->order( 'id DESC' );

$_query = $db->query( $db->sql() );
while( $row = $_query->fetch() )
{
	$row['is_highlights'] = 0;
	$is_highlights = $db->query( 'SELECT COUNT(*) FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows_highlights WHERE rows_id=' . $row['id'] . ' AND status=1 AND is_highlights=1 AND time_begin<=' . NV_CURRENTTIME . ' AND (time_end = 0 OR time_end >= ' . NV_CURRENTTIME . ' )' )->fetchColumn();
	if( $is_highlights > 0 )
	{
		$row['is_highlights'] = 1;
	}

	$row['province_id'] = array();
	$_result = $db->query( 'SELECT province_id FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows_province WHERE rows_id=' . $row['id'] );
	while( list( $province_id ) = $_result->fetch( 3 ) )
	{
		$row['province_id'][] = $province_id;
	}

	$post_new[$row['id']] = $row;
}

$contents = nv_theme_recruitment_jobprovider( $jobprovider_info, $post_new );

$page_title = $jobprovider_info['title'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';