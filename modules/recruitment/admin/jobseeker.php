<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Tue, 11 Aug 2015 07:36:57 GMT
 */

if ( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );

//change status
if( $nv_Request->isset_request( 'change_status', 'post, get' ) )
{
	$id = $nv_Request->get_int( 'id', 'post, get', 0 );
	$content = 'NO_' . $id;

	$query = 'SELECT status FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobseeker WHERE id=' . $id;
	$row = $db->query( $query )->fetch();
	if( isset( $row['status'] ) )
	{
		$status = ( $row['status'] ) ? 0 : 1;
		$query = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_jobseeker SET status=' . intval( $status ) . ' WHERE id=' . $id;
		$db->query( $query );
		$content = 'OK_' . $id;
	}
	$nv_Cache->delMod( $module_name );
	include NV_ROOTDIR . '/includes/header.php';
	echo $content;
	include NV_ROOTDIR . '/includes/footer.php';
	exit();
}

if ( $nv_Request->isset_request( 'delete_id', 'get' ) and $nv_Request->isset_request( 'delete_checkss', 'get' ))
{
	$id = $nv_Request->get_int( 'delete_id', 'get' );
	$delete_checkss = $nv_Request->get_string( 'delete_checkss', 'get' );
	if( $id > 0 and $delete_checkss == md5( $id . NV_CACHE_PREFIX . $client_info['session_id'] ) )
	{
		nv_delete_jobseeker( $id );
		$nv_Cache->delMod( $module_name );
		Header( 'Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op );
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
			nv_delete_jobseeker( $id );
		}
		$nv_Cache->delMod( $module_name );
		die( 'OK' );
	}
	die( 'NO' );
}

$row = array();
$error = array();
$array_search = array(
	'is_search' => $nv_Request->isset_request( 'is_search', 'get' ),
	'q' => $nv_Request->get_title( 'q', 'get', '' ),
	'status' => $nv_Request->get_int( 'status', 'get', -1 ),
	'per_page' => $nv_Request->get_int( 'per_page', 'get', 15 )
);

$where = '';
$show_view = true;
$per_page = $array_search['per_page'];
$page = $nv_Request->get_int( 'page', 'post,get', 1 );
$base_url = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op;
$base_url_params = '';

$per_page = $array_search['per_page'];
$page = $nv_Request->get_int( 'page', 'post,get', 1 );
$db->sqlreset()
	->select( 'COUNT(*)' )
	->from( '' . NV_PREFIXLANG . '_' . $module_data . '_jobseeker' );

if( $array_search['is_search'] )
{
	if( ! empty( $array_search['q'] ) )
	{
		$base_url_params .= '&q=' . $array_search['q'];
		$where .= ' AND ( last_name LIKE :q_last_name OR first_name LIKE :q_first_name
		OR address LIKE :q_address OR email LIKE :q_email OR phone LIKE :q_phone )';
	}

	if( $array_search['status'] >= 0 )
	{
		$base_url_params .= '&status=' . $array_search['status'];
		$where .= ' AND status=' . $array_search['status'];
	}
	$base_url_params .= '&per_page=' . $array_search['per_page'];

	$db->where( '1=1 ' . $where );
}

$sth = $db->prepare( $db->sql() );

if( $array_search['is_search'] )
{
	if( ! empty( $array_search['q'] ) )
	{
		$sth->bindValue( ':q_last_name', '%' . $array_search['q'] . '%' );
		$sth->bindValue( ':q_first_name', '%' . $array_search['q'] . '%' );
		$sth->bindValue( ':q_address', '%' . $array_search['q'] . '%' );
		$sth->bindValue( ':q_email', '%' . $array_search['q'] . '%' );
		$sth->bindValue( ':q_phone', '%' . $array_search['q'] . '%' );
	}
}

$sth->execute();
$num_items = $sth->fetchColumn();

$db->select( '*' )
	->order( 'id DESC' )
	->limit( $per_page )
	->offset( ( $page - 1 ) * $per_page );
$sth = $db->prepare( $db->sql() );

if( $array_search['is_search'] )
{
	if( ! empty( $array_search['q'] ) )
	{
		$sth->bindValue( ':q_last_name', '%' . $array_search['q'] . '%' );
		$sth->bindValue( ':q_first_name', '%' . $array_search['q'] . '%' );
		$sth->bindValue( ':q_address', '%' . $array_search['q'] . '%' );
		$sth->bindValue( ':q_email', '%' . $array_search['q'] . '%' );
		$sth->bindValue( ':q_phone', '%' . $array_search['q'] . '%' );
	}
}

$sth->execute();

$xtpl = new XTemplate( $op . '.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'MODULE_NAME', $module_name );
$xtpl->assign( 'MODULE_UPLOAD', $module_upload );
$xtpl->assign( 'OP', $op );
$xtpl->assign( 'ROW', $row );
$xtpl->assign( 'SEARCH', $array_search );

$generate_page = nv_generate_page( $base_url . $base_url_params, $num_items, $per_page, $page );
if( !empty( $generate_page ) )
{
	$xtpl->assign( 'NV_GENERATE_PAGE', $generate_page );
	$xtpl->parse( 'main.generate_page' );
}
$number = $page > 1 ? ($per_page * ( $page - 1 ) ) + 1 : 0;
while( $view = $sth->fetch() )
{
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
	$view['birthday'] = ( empty( $view['birthday'] )) ? '' : nv_date( 'd/m/Y', $view['birthday'] );
	$view['gender'] = $array_gender[$view['gender']];
	$redirect = !empty( $base_url_params ) ? '&amp;redirect=' . nv_redirect_encrypt( $client_info['selfurl'] ) : '';
	$view['link_edit'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=jobseeker_content&amp;id=' . $view['id'] . $redirect;
	$view['link_delete'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;delete_id=' . $view['id'] . '&amp;delete_checkss=' . md5( $view['id'] . NV_CACHE_PREFIX . $client_info['session_id'] );
	$xtpl->assign( 'VIEW', $view );
	$xtpl->parse( 'main.loop' );
}

foreach( $array_status as $key => $value )
{
	$sl = $array_search['status'] == $key ? 'selected="selected"' : '';
	$xtpl->assign( 'STATUS', array( 'key' => $key, 'value' => $value, 'selected' => $sl ) );
	$xtpl->parse( 'main.status' );
}

for( $i = 10; $i <= 100; $i+=5 )
{
	$sl = $array_search['per_page'] == $i ? 'selected="selected"' : '';
	$xtpl->assign( 'PER_PAGE', array( 'key' => $i, 'selected' => $sl ) );
	$xtpl->parse( 'main.per_page' );
}

$array_action = array(
	'delete_list_id' => $lang_global['delete']
);
foreach( $array_action as $key => $value )
{
	$xtpl->assign( 'ACTION', array( 'key' => $key, 'value' => $value ) );
	$xtpl->parse( 'main.action' );
}

if( ! empty( $error ) )
{
	$xtpl->assign( 'ERROR', implode( '<br />', $error ) );
	$xtpl->parse( 'main.error' );
}

$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

$page_title = $lang_module['jobseeker'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';