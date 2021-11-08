<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Fri, 19 Jun 2015 07:33:37 GMT
 */

if ( ! defined( 'NV_IS_MOD_RECRUITMENT' ) ) die( 'Stop!!!' );

$province_id = explode( '-', $array_op[1] );
$province_id = end( $province_id );

$table_name = NV_PREFIXLANG . '_' . $module_data;
$base_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $module_info['alias']['viewprovince'] . '/' . $array_op[1];

$array_data = array();

$db->sqlreset()
  ->select( 'COUNT(*)' )
  ->from( $table_name . '_rows t1' )
  ->join( 'INNER JOIN ' . $table_name . '_rows_province t2 ON t1.id=t2.rows_id' )
  ->where( 't1.status=1 AND t2.province_id=' . $province_id );

$num_items = $db->query( $db->sql() )->fetchColumn();

$db->select( '*' )
  ->order( 't1.id DESC' )
  ->limit( $per_page )
  ->offset( ($page - 1) * $per_page );

$_query = $db->query( $db->sql() );
while( $row = $_query->fetch() )
{
	$row['jobprovider'] = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobprovider WHERE id=' . $row['jobprovider_id'] )->fetch();

	$row['province_id'] = array();
	$_result = $db->query( 'SELECT province_id FROM ' . $table_name . '_rows_province WHERE rows_id=' . $row['id'] );
	while( list( $province ) = $_result->fetch( 3 ) )
	{
		$row['province_id'][] = $province;
	}
	$array_data[] = $row;
}

$nv_alias_page = nv_alias_page( $page_title, $base_url, $num_items, $per_page, $page );
$province_info = nv_location_get_province_info( $province_id );
$page_title = $province_info['title'];

$contents = nv_theme_recruitment_viewprovince( $array_data, $nv_alias_page );

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';
