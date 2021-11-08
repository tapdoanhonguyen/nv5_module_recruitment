<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sat, 20 Jun 2015 07:24:04 GMT
 */

if( ! defined( 'NV_IS_MOD_RECRUITMENT' ) ) die( 'Stop!!!' );

if( !defined( 'NV_IS_USER' ) )
{
	$url_redirect = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $module_info['alias']['list-post'];
	Header( 'Location: ' . NV_BASE_SITEURL . 'index.php?' . NV_NAME_VARIABLE . '=users&' . NV_OP_VARIABLE . '=login&nv_redirect=' . nv_redirect_encrypt( $url_redirect ) );
	die( );
}

//change status
if( $nv_Request->isset_request( 'change_status', 'post, get' ) )
{
	$id = $nv_Request->get_int( 'id', 'post, get', 0 );
	$content = 'NO_' . $id;

	$query = 'SELECT status FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows WHERE id=' . $id;
	$row = $db->query( $query )->fetch();
	if( isset( $row['status'] ) )
	{
		$status = ( $row['status'] ) ? 0 : 1;
		$query = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_rows SET status=' . intval( $status ) . ' WHERE id=' . $id;
		$db->query( $query );
		$content = 'OK_' . $id;
	}
	$nv_Cache->delMod( $module_name );
	include NV_ROOTDIR . '/includes/header.php';
	echo $content;
	include NV_ROOTDIR . '/includes/footer.php';
	exit();
}

if ( $nv_Request->isset_request( 'delete_id', 'get' ) and $nv_Request->isset_request( 'delete_checkss', 'get' ) )
{
	$id = $nv_Request->get_int( 'delete_id', 'get' );
	$delete_checkss = $nv_Request->get_string( 'delete_checkss', 'get' );
	if( $id > 0 and $delete_checkss == md5( $id . NV_CACHE_PREFIX . $client_info['session_id'] ) )
	{
		nv_delete_rows( $id, $jobprovider_id );
		$nv_Cache->delMod( $module_name );
		Header( 'Location: ' . nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op, true ) );
		die();
	}
}
elseif ( $nv_Request->isset_request( 'delete_list', 'post' ) )
{
	$listall = $nv_Request->get_title( 'listall', 'post', '' );
	$array_id = explode( ',', $listall );

	if( !empty( $array_id ) )
	{
		foreach( $array_id as $id )
		{
			nv_delete_rows( $id, $jobprovider_id );
		}
		$nv_Cache->delMod( $module_name );
		die( 'OK' );
	}
	die( 'NO' );
}

$base_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op;
$row = array();
$jobprovider_info = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobprovider WHERE userid=' . $user_info['userid'] )->fetch();
if( empty( $jobprovider_info ) )
{
	Header( 'Location: ' . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name );
	die( );
}

// Fetch Limit
if ( ! $nv_Request->isset_request( 'id', 'post,get' ) )
{
	$per_page = 20;
	$page = $nv_Request->get_int( 'page', 'post,get', 1 );
	$db->sqlreset()
		->select( 'COUNT(*)' )
		->from( NV_PREFIXLANG . '_' . $module_data . '_rows' )
		->where( 'jobprovider_id=' . $jobprovider_info['id'] );

	$sth = $db->prepare( $db->sql() );

	$sth->execute();
	$num_items = $sth->fetchColumn();

	$db->select( '*' )
		->order( 'id DESC' )
		->limit( $per_page )
		->offset( ( $page - 1 ) * $per_page );
	$sth = $db->prepare( $db->sql() );
	$sth->execute();
}

$xtpl = new XTemplate( 'list.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'NV_LANG_VARIABLE', NV_LANG_VARIABLE );
$xtpl->assign( 'NV_LANG_DATA', NV_LANG_DATA );
$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
$xtpl->assign( 'NV_NAME_VARIABLE', NV_NAME_VARIABLE );
$xtpl->assign( 'NV_OP_VARIABLE', NV_OP_VARIABLE );
$xtpl->assign( 'MODULE_NAME', $module_name );
$xtpl->assign( 'MODULE_UPLOAD', $module_upload );
$xtpl->assign( 'OP', $op );
$xtpl->assign( 'ROW', $row );
$xtpl->assign( 'BASE_URL', $base_url );
$xtpl->assign( 'POST_URL', nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $module_info['alias']['content'], true ) );

$generate_page = nv_generate_page( $base_url, $num_items, $per_page, $page );
if( !empty( $generate_page ) )
{
	$xtpl->assign( 'NV_GENERATE_PAGE', $generate_page );
	$xtpl->parse( 'main.view.generate_page' );
}
$number = $page > 1 ? $per_page * ( $page - 1 ) : 0;
while( $view = $sth->fetch() )
{
	$view['num_record'] = $db->query( 'SELECT COUNT(*) FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows_record WHERE rows_id=' . $view['id'] )->fetchColumn();
	$view['number'] = ++$number;
	if( $view['status'] == 1 )
	{
		$check = 'checked';
	}
	else
	{
		$check = '';
	}
	$xtpl->assign( 'CHECK', $check );
	$view['addtime'] = !empty( $view['addtime'] ) ? nv_date( 'H:i d/m/Y', $view['addtime'] ) : '';
	$view['link_edit'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $module_info['alias']['content'] . '/' . $view['id'];
	$view['link_delete'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;delete_id=' . $view['id'] . '&amp;delete_checkss=' . md5( $view['id'] . NV_CACHE_PREFIX . $client_info['session_id'] );
	$view['link_view'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $array_jobs[$view['jobs_id']]['alias'] . '/' . $view['alias'] . '-' . $view['id'];
	$view['sended_record_url'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $module_info['alias']['sended-record'] . '/' . $view['alias'] . '-' . $view['id'];

	$xtpl->assign( 'VIEW', $view );

	if( $view['status'] == 2 ) // 2: Cho duyet
	{
		$xtpl->parse( 'main.loop.queue' );
		$xtpl->parse( 'main.loop.label' );
	}
	else
	{
		$xtpl->parse( 'main.loop.display' );
		$xtpl->parse( 'main.loop.url' );
	}

	$xtpl->parse( 'main.loop' );
}

$array_action = array(
	'delete_list_id' => $lang_global['delete']
);
foreach( $array_action as $key => $value )
{
	$xtpl->assign( 'ACTION', array( 'key' => $key, 'value' => $value ) );
	$xtpl->parse( 'main.action' );
}

$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

$array_mod_title[] = array( 'title' => $lang_module['jobprovider'], 'link' => NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $module_info['alias']['jobprovider-area'] );
$array_mod_title[] = array( 'title' => $lang_module['list'], 'link' => $base_url );
$page_title = $lang_module['list'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';