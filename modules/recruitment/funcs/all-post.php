<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sat, 20 Jun 2015 07:24:04 GMT
 */

if( ! defined( 'NV_IS_MOD_RECRUITMENT' ) ) die( 'Stop!!!' );

$array_data = array();
$base_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=ajax&post_new=1&display=1&per_page=' . $per_page;

$db->sqlreset()
  ->select( 'COUNT(*)' )
  ->from( NV_PREFIXLANG . '_' . $module_data . '_rows' )
  ->where( 'status=1' );

$all_page = $db->query( $db->sql() )->fetchColumn();

$db->select( '*' )
  ->order( 'id DESC' )
  ->limit( $per_page )
  ->offset( ($page - 1) * $per_page );

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

	$row['jobprovider'] = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobprovider WHERE id=' . $row['jobprovider_id'] )->fetch();
	$array_data[] = $row;
}

$generate_page = nv_generate_page( $base_url, $all_page, $per_page, $page, true, true, 'nv_urldecode_ajax', 'list-post' );

$contents = nv_theme_recruitment_all_post( $array_data, $generate_page );

$page_title = $lang_module['all-post'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';