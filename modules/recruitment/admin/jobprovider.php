<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Tue, 11 Aug 2015 04:09:04 GMT
 */

if ( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );

//change status
if( $nv_Request->isset_request( 'change_status', 'post, get' ) )
{
	$id = $nv_Request->get_int( 'id', 'post, get', 0 );
	$content = 'NO_' . $id;

	$query = 'SELECT status FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobprovider WHERE id=' . $id;
	$row = $db->query( $query )->fetch();
	if( isset( $row['status'] ) )
	{
		$status = ( $row['status'] ) ? 0 : 1;
		$query = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_jobprovider SET status=' . intval( $status ) . ' WHERE id=' . $id;
		$db->query( $query );
		$content = 'OK_' . $id;
	}
	$nv_Cache->delMod( $module_name );
	include NV_ROOTDIR . '/includes/header.php';
	echo $content;
	include NV_ROOTDIR . '/includes/footer.php';
	exit();
}

//change real
if( $nv_Request->isset_request( 'change_real', 'post, get' ) )
{
	$id = $nv_Request->get_int( 'id', 'post, get', 0 );
	$content = 'NO_' . $id;

	$query = 'SELECT is_real FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobprovider WHERE id=' . $id;
	$row = $db->query( $query )->fetch();
	if( isset( $row['is_real'] ) )
	{
		$status = ( $row['is_real'] ) ? 0 : 1;
		$query = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_jobprovider SET is_real=' . intval( $status ) . ' WHERE id=' . $id;
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
		$jobprovider = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobprovider WHERE id=' . $id )->fetch();
		if( !empty( $jobprovider ) )
		{
			// Xoa nha tuyen dung
			$result = $db->query( 'DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobprovider  WHERE id = ' . $db->quote( $id ) );
			if( $result )
			{
				// Xoa tat ca bai dang
				$result = $db->query( 'SELECT id FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows WHERE jobprovider_id=' . $id );
				while( list( $rows_id ) = $result->fetch( 3 ) )
				{
					nv_delete_rows( $rows_id );
				}

				// Xoa khoi nganh nghe
				$db->query('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobprovider_jobs  WHERE provider_id=' . $id );

				// Xoa khoi nhom thanh vien
				nv_remove_groups_user( $array_config['group_jobprovider'], $jobprovider['userid'] );

				// Xoa logo
				if( !empty( $jobprovider['image'] ) )
				{
					nv_deletefile( NV_ROOTDIR . NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/jobprovider_images/' . $jobprovider['image'] );
				}
			}

			$nv_Cache->delMod( $module_name );
		}
		Header( 'Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op );
		die();
	}
}

$array_search = array(
	'is_search' => $nv_Request->isset_request( 'is_search', 'get' ),
	'q' => $nv_Request->get_title( 'q', 'get', '' ),
	'status' => $nv_Request->get_int( 'status', 'get', '-1' ),
	'per_page' => $nv_Request->get_int( 'per_page', 'get', '15' )
);

$per_page = $array_search['per_page'];
$page = $nv_Request->get_int( 'page', 'post,get', 1 );
$base_url = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op;
$where = $base_url_params = '';

$db->sqlreset()
	->select( 'COUNT(*)' )
	->from( '' . NV_PREFIXLANG . '_' . $module_data . '_jobprovider' );

if( $array_search['is_search'] )
{
	if( ! empty( $array_search['q'] ) )
	{
		$base_url_params .= '&q=' . $array_search['q'];
		$where .= ' AND (title LIKE :q_title OR email LIKE :q_email OR website LIKE :q_website
		OR address LIKE :q_address OR fax LIKE :q_fax OR descripion LIKE :q_descripion
		OR contact_fullname LIKE :q_contact_fullname OR contact_email LIKE :q_contact_email
		OR contact_phone LIKE :q_contact_phone)';
	}
	if( $array_search['status'] >= 0 )
	{
		$base_url_params .= '&status=' . $array_search['status'];
		$where .= ' AND status=' . $array_search['status'];
	}
	$base_url .= '&per_page=' . $array_search['per_page'];

	if( !empty( $where ) )
	{
		$db->where( '1=1' . $where );
	}
}

$sth = $db->prepare( $db->sql() );

if( $array_search['is_search'] )
{
	if( ! empty( $array_search['q'] ) )
	{
		$sth->bindValue( ':q_title', '%' . $array_search['q'] . '%' );
		$sth->bindValue( ':q_email', '%' . $array_search['q'] . '%' );
		$sth->bindValue( ':q_fax', '%' . $array_search['q'] . '%' );
		$sth->bindValue( ':q_website', '%' . $array_search['q'] . '%' );
		$sth->bindValue( ':q_address', '%' . $array_search['q'] . '%' );
		$sth->bindValue( ':q_descripion', '%' . $array_search['q'] . '%' );
		$sth->bindValue( ':q_contact_fullname', '%' . $array_search['q'] . '%' );
		$sth->bindValue( ':q_contact_email', '%' . $array_search['q'] . '%' );
		$sth->bindValue( ':q_contact_phone', '%' . $array_search['q'] . '%' );
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
		$sth->bindValue( ':q_title', '%' . $array_search['q'] . '%' );
		$sth->bindValue( ':q_email', '%' . $array_search['q'] . '%' );
		$sth->bindValue( ':q_fax', '%' . $array_search['q'] . '%' );
		$sth->bindValue( ':q_website', '%' . $array_search['q'] . '%' );
		$sth->bindValue( ':q_address', '%' . $array_search['q'] . '%' );
		$sth->bindValue( ':q_descripion', '%' . $array_search['q'] . '%' );
		$sth->bindValue( ':q_contact_fullname', '%' . $array_search['q'] . '%' );
		$sth->bindValue( ':q_contact_email', '%' . $array_search['q'] . '%' );
		$sth->bindValue( ':q_contact_phone', '%' . $array_search['q'] . '%' );
	}
}
$sth->execute();

$xtpl = new XTemplate( $op . '.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'NV_LANG_VARIABLE', NV_LANG_VARIABLE );
$xtpl->assign( 'NV_LANG_DATA', NV_LANG_DATA );
$xtpl->assign( 'NV_BASE_ADMINURL', NV_BASE_ADMINURL );
$xtpl->assign( 'NV_NAME_VARIABLE', NV_NAME_VARIABLE );
$xtpl->assign( 'NV_OP_VARIABLE', NV_OP_VARIABLE );
$xtpl->assign( 'MODULE_NAME', $module_name );
$xtpl->assign( 'MODULE_UPLOAD', $module_upload );
$xtpl->assign( 'NV_ASSETS_DIR', NV_ASSETS_DIR );
$xtpl->assign( 'OP', $op );
$xtpl->assign( 'SEARCH', $array_search );

$generate_page = nv_generate_page( $base_url, $num_items, $per_page, $page );
if( !empty( $generate_page ) )
{
	$xtpl->assign( 'NV_GENERATE_PAGE', $generate_page );
	$xtpl->parse( 'main.generate_page' );
}

$redirect = !empty( $base_url_params ) ? '&amp;redirect=' . nv_redirect_encrypt( $client_info['selfurl'] ) : '';
$number = $page > 1 ? ($per_page * ( $page - 1 ) ) + 1 : 0;
while( $view = $sth->fetch() )
{
	$view['number'] = ++$number;
	$view['status'] = $view['status'] == 1 ? 'checked' : '';
	$view['is_real'] = $view['is_real'] == 1 ? 'checked' : '';
	$view['link_edit'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=jobprovider_content&amp;id=' . $view['id'] . $redirect;
	$view['link_delete'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;delete_id=' . $view['id'] . '&amp;delete_checkss=' . md5( $view['id'] . NV_CACHE_PREFIX . $client_info['session_id'] );
	$view['link_view'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $module_info['alias']['jobprovider'] . '/' . $view['alias'] . '-' . $view['id'];

	$xtpl->assign( 'VIEW', $view );

	if( !empty( $view['website'] ) )
	{
		$xtpl->parse( 'main.loop.website' );
	}

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

$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

$page_title = $lang_module['jobprovider'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';