<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Tue, 01 Sep 2015 15:25:47 GMT
 */

if ( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );

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

if ( $nv_Request->isset_request( 'delete_id', 'get' ) and $nv_Request->isset_request( 'delete_checkss', 'get' ))
{
	$id = $nv_Request->get_int( 'delete_id', 'get' );
	$jobprovider_id = $nv_Request->get_int( 'jobprovider_id', 'get' );
	$delete_checkss = $nv_Request->get_string( 'delete_checkss', 'get' );
	if( $id > 0 and $delete_checkss == md5( $id . NV_CACHE_PREFIX . $client_info['session_id'] ) )
	{
		nv_delete_rows( $id, $jobprovider_id );
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
			nv_delete_rows( $id );
		}
		$nv_Cache->delMod( $module_name );
		die( 'OK' );
	}
	die( 'NO' );
}

$row = array();
$base_url = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op;
$base_url_params = '';

$array_search = array(
	'is_search' => $nv_Request->isset_request( 'is_search', 'get' ),
	'q' => $nv_Request->get_title( 'q', 'get', '' ),
	'jobs_id' => $nv_Request->get_int( 'jobs_id', 'get', 0 ),
	'position_id' => $nv_Request->get_int( 'position_id', 'get', 0 ),
	'status' => $nv_Request->get_int( 'status', 'get', -1 ),
	'per_page' => $nv_Request->get_int( 'per_page', 'get', 15 )
);

$where = '';
$per_page = $array_search['per_page'];
$page = $nv_Request->get_int( 'page', 'post,get', 1 );

$db->sqlreset()
	->select( 'COUNT(*)' )
	->from( '' . NV_PREFIXLANG . '_' . $module_data . '_rows' );

if( $array_search['is_search'] )
{
	if( ! empty( $array_search['q'] ) )
	{
		$base_url_params .= '&q=' . $array_search['q'];
		$where .= ' AND ( title LIKE :q_title OR code LIKE :q_code OR degree LIKE :q_degree OR job_description LIKE :q_job_description OR more_requirement LIKE :q_more_requirement OR document_id LIKE :q_document_id OR document_type_id LIKE :q_document_type_id OR contact_fullname LIKE :q_contact_fullname OR contact_email LIKE :q_contact_email OR contact_phone LIKE :q_contact_phone )';
	}

	if( ! empty( $array_search['jobs_id'] ) )
	{
		$base_url_params .= '&jobs_id=' . $array_search['jobs_id'];
		$where .= ' AND jobs_id=' . $array_search['jobs_id'];
	}

	if( ! empty( $array_search['position_id'] ) )
	{
		$base_url_params .= '&position_id=' . $array_search['position_id'];
		$where .= ' AND position_id=' . $array_search['position_id'];
	}

	if( $array_search['status'] >= 0 )
	{
		$base_url_params .= '&status=' . $array_search['status'];
		$where .= ' AND status=' . $array_search['status'];
	}
	$base_url_params .= '&per_page=' . $array_search['per_page'];

	$db->where( '1=1 ' . $where );
}
else
{

$db->where( 'status = 1');

}

$sth = $db->prepare( $db->sql() );

if( $array_search['is_search'] )
{
	if( ! empty( $array_search['q'] ) )
	{
		$sth->bindValue( ':q_title', '%' . $array_search['q'] . '%' );
		$sth->bindValue( ':q_code', '%' . $array_search['q'] . '%' );
		$sth->bindValue( ':q_degree', '%' . $array_search['q'] . '%' );
		$sth->bindValue( ':q_job_description', '%' . $array_search['q'] . '%' );
		$sth->bindValue( ':q_more_requirement', '%' . $array_search['q'] . '%' );
		$sth->bindValue( ':q_document_id', '%' . $array_search['q'] . '%' );
		$sth->bindValue( ':q_document_type_id', '%' . $array_search['q'] . '%' );
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
		$sth->bindValue( ':q_code', '%' . $array_search['q'] . '%' );
		$sth->bindValue( ':q_degree', '%' . $array_search['q'] . '%' );
		$sth->bindValue( ':q_job_description', '%' . $array_search['q'] . '%' );
		$sth->bindValue( ':q_more_requirement', '%' . $array_search['q'] . '%' );
		$sth->bindValue( ':q_document_id', '%' . $array_search['q'] . '%' );
		$sth->bindValue( ':q_document_type_id', '%' . $array_search['q'] . '%' );
		$sth->bindValue( ':q_contact_fullname', '%' . $array_search['q'] . '%' );
		$sth->bindValue( ':q_contact_email', '%' . $array_search['q'] . '%' );
		$sth->bindValue( ':q_contact_phone', '%' . $array_search['q'] . '%' );
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
$xtpl->assign( 'CHECKSS', md5( session_id() ) );

$generate_page = nv_generate_page( $base_url . $base_url_params, $num_items, $per_page, $page );
if( !empty( $generate_page ) )
{
	$xtpl->assign( 'NV_GENERATE_PAGE', $generate_page );
	$xtpl->parse( 'main.generate_page' );
}
while( $view = $sth->fetch() )
{
	$xtpl->assign( 'CHECK', $view['status'] ? 'checked' : '' );
	$view['jobprovider'] = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobprovider WHERE id=' . $view['jobprovider_id'] )->fetch();
	$view['position'] = $array_position[$view['position_id']]['title'];
	
	$view['addtime'] = ( empty( $view['addtime'] )) ? '' : nv_date( 'd/m/Y', $view['addtime'] );
	$view['jobs_id'] = first_view_job($view['jobs_id']);
	$view['link_view_post'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $array_jobs[$view['jobs_id']]['alias'] . '/' . $view['alias'] . '-' . $view['id'];
	$view['link_view_jobprovider'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $module_info['alias']['jobprovider'] . '/' . $view['jobprovider']['alias'] . '-' . $view['jobprovider']['id'];
	$redirect = !empty( $base_url_params ) ? '&amp;redirect=' . nv_redirect_encrypt( $client_info['selfurl'] ) : '';
	$view['link_edit'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=content&amp;id=' . $view['id'] . $redirect;
	$view['link_delete'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;jobprovider_id=' . $view['jobprovider']['id'] . '&amp;delete_id=' . $view['id'] . '&amp;delete_checkss=' . md5( $view['id'] . NV_CACHE_PREFIX . $client_info['session_id'] );
	$view['link_highlights'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=highlight_content&amp;rows_id=' . $view['id'];
	
	$view['jobs'] = '';
	
	if(!empty($view['jobs_id']))
	{
		$array_job = explode(',',$view['jobs_id']);
		foreach($array_job as $job)
		{
			if(empty($view['jobs']))
				$view['jobs'] = $array_jobs[$job]['title'];
			else
				$view['jobs'] .= ', '. $array_jobs[$job]['title'];
		}
	}
	
	$xtpl->assign( 'VIEW', $view );
	$xtpl->parse( 'main.loop' );
}

if( !empty( $array_jobs ) )
{
	foreach( $array_jobs as $key => $value )
	{
		$xtpl->assign( 'JOBS', array(
			'key' => $value['id'],
			'title' => $value['title'],
			'selected' => $value['id'] == $array_search['jobs_id'] ? 'selected="selected"' : ''
		) );
		$xtpl->parse( 'main.jobs' );
	}
}

if( !empty( $array_position ) )
{
	foreach( $array_position as $key => $value )
	{
		$xtpl->assign( 'POSITION', array(
			'key' => $value['id'],
			'title' => $value['title'],
			'selected' => $value['id'] == $array_search['position_id'] ? 'selected="selected"' : ''
		) );
		$xtpl->parse( 'main.position' );
	}
}

foreach( $array_post_status as $key => $value )
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
	'delete_list_id' => $lang_global['delete'],
	'addgroups' => $lang_module['groups_add']
);
foreach( $array_action as $key => $value )
{
	$xtpl->assign( 'ACTION', array( 'key' => $key, 'value' => $value ) );
	$xtpl->parse( 'main.action' );
}

$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

$page_title = $lang_module['post_list'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';