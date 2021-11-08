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
  ->from( NV_PREFIXLANG . '_' . $module_data . '_rows t1' )
  ->join( 'INNER JOIN ' . NV_PREFIXLANG . '_' . $module_data . '_rows_highlights t2 ON t1.id=t2.rows_id' )
  ->where( 't1.status=1 AND t2.status=1 AND t2.is_hot=1 AND t2.time_begin<=' . NV_CURRENTTIME . ' AND (t2.time_end = 0 OR t2.time_end >= ' . NV_CURRENTTIME . ' )' );

$all_page = $db->query( $db->sql() )->fetchColumn();

$db->select( 't1.*, t2.is_hot, t2.is_hot_icon, t2.is_highlights, t2.time_begin, t2.time_end' )
  ->order( 't2.add_time DESC' )
  ->limit( $per_page )
  ->offset( ($page - 1) * $per_page );

$_query = $db->query( $db->sql() );
while( $row = $_query->fetch() )
{
	$row['jobprovider'] = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobprovider WHERE id=' . $row['jobprovider_id'] )->fetch();
	$array_data[] = $row;
}

$generate_page = nv_generate_page( $base_url, $all_page, $per_page, $page, true, true, 'nv_urldecode_ajax', 'list-post' );
$contents = nv_theme_recruitment_hot_post( $array_data, $generate_page );

$page_title = $lang_module['hot_post'];
$array_mod_title[] = array( 'title' => $page_title );

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';