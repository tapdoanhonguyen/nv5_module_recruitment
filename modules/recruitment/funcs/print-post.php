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

// Thong tin tin tuyen dung
$post_data = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows WHERE id=' . $id . ' AND status=1' )->fetch();
if( empty( $post_data ) )
{
	Header( 'Location: ' . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name );
	die();
}

// Dia diem lam viec
$result = $db->query( 'SELECT province_id FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows_province WHERE rows_id=' . $id  );
while( list( $province_id ) = $result->fetch( 3 ) )
{
	$province_info = nv_location_get_province_info( $province_id );
	$post_data['province'][] = $province_info['title'];
}

$post_data['province'] = implode( ', ', $post_data['province'] );
$post_data['position'] = $array_position[$post_data['position_id']]['title'];
$post_data['jobs'] = $array_jobs[$post_data['jobs_id']]['title'];
$post_data['worktype'] = $array_worktype[$post_data['worktype_id']]['title'];
$post_data['gender'] = $array_gender[$post_data['gender']];
if( !empty( $post_data['document_id'] ) )
{
	$post_data['document_id'] = explode( ',', $post_data['document_id'] );
}
if( !empty( $post_data['document_type_id'] ) )
{
	$post_data['document_type_id'] = explode( ',', $post_data['document_type_id'] );
}

// Thong tin nha tuyen dung
$jobprovider_info = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobprovider WHERE id=' . $post_data['jobprovider_id'] )->fetch();
if( empty( $jobprovider_info ) )
{
	Header( 'Location: ' . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name );
	die( );
}

$page_title = $post_data['title'];

$contents = nv_theme_recruitment_print_post( $post_data, $jobprovider_info );

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme( $contents, false );
include NV_ROOTDIR . '/includes/footer.php';