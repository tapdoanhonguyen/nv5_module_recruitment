<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Fri, 19 Jun 2015 07:33:37 GMT
 */

if ( ! defined( 'NV_IS_MOD_RECRUITMENT' ) ) die( 'Stop!!!' );

$jobs_alias = isset( $array_op[1] ) ? $array_op[1] : '';
foreach( $array_jobs as $jobs )
{
	if( $jobs_alias == $jobs['alias'] )
	{
		$jobs_id = $jobs['id'];
		if( preg_match( '/^page\-([0-9]+)$/', ( isset( $array_op[2] ) ? $array_op[2] : '' ), $m ) )
		{
			$page = ( int )$m[1];
		}
	}
}

$table_name = NV_PREFIXLANG . '_' . $module_data;
$base_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp' . NV_OP_VARIABLE . '=' . $module_info['alias']['viewjobs-record'] . '/' . $array_jobs[$jobs_id]['alias'];

$array_data = array();

$db->sqlreset()
  ->select( 'COUNT(*)' )
  ->from( $table_name . '_record' )
  ->where( 'status=1 AND jobs_id=' . $jobs_id );

$num_items = $db->query( $db->sql() )->fetchColumn();

$db->select( '*' )
  ->order( 'id DESC' )
  ->limit( $per_page )
  ->offset( ($page - 1) * $per_page );

$_query = $db->query( $db->sql() );
while( $row = $_query->fetch() )
{
	$row['is_highlights'] = 0;
	$is_highlights = $db->query( 'SELECT COUNT(*) FROM ' . NV_PREFIXLANG . '_' . $module_data . '_record_highlights WHERE record_id=' . $row['id'] . ' AND status=1 AND is_highlights=1 AND time_begin<=' . NV_CURRENTTIME . ' AND (time_end = 0 OR time_end >= ' . NV_CURRENTTIME . ' )' )->fetchColumn();
	if( $is_highlights > 0 )
	{
		$row['is_highlights'] = 1;
	}

	$row['work_location'] = array();
	$result = $db->query( 'SELECT location_id FROM ' . NV_PREFIXLANG . '_' . $module_data . '_record_wlocation WHERE record_id=' . $row['id'] );
	while( list( $location_id ) = $result->fetch( 3 ) )
	{
		$row['work_location'][] = $location_id;
	}

	$row['jobseeker'] = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobseeker WHERE id=' . $row['jobseeker_id'] )->fetch();

	$array_data[] = $row;
}

$nv_alias_page = nv_alias_page( $page_title, $base_url, $num_items, $per_page, $page );
$page_title = $array_jobs[$jobs_id]['title'];

$contents = nv_theme_recruitment_viewjobs_record( $array_data, $nv_alias_page );

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';