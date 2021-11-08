<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Wed, 30 Sep 2015 07:45:28 GMT
 */

if( ! defined( 'NV_IS_MOD_RECRUITMENT' ) ) die( 'Stop!!!' );

if( $nv_Request->isset_request( 'download', 'get' ) )
{
	$record_id = $nv_Request->get_int( 'record_id', 'get', 0 );
	$path = $db->query( 'SELECT file FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows_record WHERE id=' . $record_id )->fetchColumn();

	if( !empty( $path ) )
	{
		$download = new download( NV_ROOTDIR . '/' . NV_UPLOADS_DIR . '/' . $module_upload .'/record/'. $path, NV_UPLOADS_REAL_DIR );
		$download->download_file();
	}
	die();
}

$row = array();
$error = array();

$row['id'] = explode( '-', $array_op[1] );
$row['id'] = intval( end( $row['id'] ) );

$sended_data = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows_record WHERE id=' . $row['id'] )->fetch();
if( empty( $sended_data ) )
{
	Header( 'Location: ' . nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name, true ) );
	die();
}

$post_data = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows WHERE id=' . $sended_data['rows_id'] )->fetch();

$lang_module['sended_record_list_s'] = sprintf( $lang_module['sended_record_list_s'], $post_data['code'] . ' - ' . $post_data['title'] );
$sended_data['sended_record_url'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $module_info['alias']['sended-record'] . '/' . $post_data['alias'] . '-' . $post_data['id'];
$post_data['url_view'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $array_jobs[$post_data['jobs_id']]['alias'] . '/' . $post_data['alias'] . '-' . $post_data['id'];

$xtpl = new XTemplate( 'sended-record-view.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'DATA', $sended_data );
$xtpl->assign( 'POST', $post_data );

$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

$page_title = $sended_data['title'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';