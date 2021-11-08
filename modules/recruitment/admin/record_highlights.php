<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sat, 26 Sep 2015 23:49:13 GMT
 */

if ( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );

//change status
if( $nv_Request->isset_request( 'change_status', 'post, get' ) )
{
	$id = $nv_Request->get_int( 'id', 'post, get', 0 );
	$content = 'NO_' . $id;

	$query = 'SELECT status FROM ' . NV_PREFIXLANG . '_' . $module_data . '_record_highlights WHERE id=' . $id;
	$row = $db->query( $query )->fetch();
	if( isset( $row['status'] ) )
	{
		$status = ( $row['status'] ) ? 0 : 1;
		$query = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_record_highlights SET status=' . intval( $status ) . ' WHERE id=' . $id;
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
		$db->query('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_record_highlights  WHERE id = ' . $db->quote( $id ) );
		$nv_Cache->delMod( $module_name );
		Header( 'Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op );
		die();
	}
}

$row = array();
$error = array();

$base_url = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op;
$base_url_params = '';

$array_search = array(
	'is_search' => $nv_Request->isset_request( 'is_search', 'get' ),
	'q' => $nv_Request->get_title( 'q', 'get', '' ),
	'jobs_id' => $nv_Request->get_int( 'jobs_id', 'get', 0 ),
	'position_id' => $nv_Request->get_int( 'position_id', 'get', 0 ),
	'provinceid' => $nv_Request->get_int( 'provinceid', 'get', 0 ),
	'status' => $nv_Request->get_int( 'status', 'get', -1 )
);

$where = ' AND t1.status IN (0,1,2)';
$join = 'INNER JOIN ' . NV_PREFIXLANG . '_' . $module_data . '_record t2 ON t1.record_id=t2.id';

$per_page = 15;
$page = $nv_Request->get_int( 'page', 'post,get', 1 );
$db->sqlreset()
	->select( 'COUNT(*)' )
	->from( NV_PREFIXLANG . '_' . $module_data . '_record_highlights t1' );

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

	if( ! empty( $array_search['provinceid'] ) )
	{
		$join .= ' INNER JOIN ' . NV_PREFIXLANG . '_' . $module_data . '_record_wlocation t3 ON t2.id=t3.record_id';

		$base_url_params .= '&provinceid=' . $array_search['provinceid'];
		$where .= ' AND t3.location_id=' . $array_search['provinceid'];
	}

	if( $array_search['status'] >= 0 )
	{
		$base_url_params .= '&status=' . $array_search['status'];
		$where .= ' AND t1.status=' . $array_search['status'];
	}

	$db->where( '1=1 ' . $where );
}

$db->join( $join );
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

$db->select( '*, t1.id record_id' )
	->order( 't1.id DESC' )
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

$generate_page = nv_generate_page( $base_url, $num_items, $per_page, $page );
if( !empty( $generate_page ) )
{
	$xtpl->assign( 'NV_GENERATE_PAGE', $generate_page );
	$xtpl->parse( 'main.generate_page' );
}
$number = $page > 1 ? ($per_page * ( $page - 1 ) ) + 1 : 1;
while( $view = $sth->fetch() )
{
	$view['number'] = $number++;
	if( $view['status'] == 1 )
	{
		$check = 'checked';
	}
	else
	{
		$check = '';
	}
	$xtpl->assign( 'CHECK', $check );
	$view['title'] = !empty( $view['title'] ) ? $view['title'] : $array_jobs[$view['jobs_id']]['title'];
	$view['time_begin'] = ( empty( $view['time_begin'] )) ? '' : nv_date( 'd/m/Y', $view['time_begin'] );
	$view['time_end'] = ( empty( $view['time_end'] )) ? '' : nv_date( 'd/m/Y', $view['time_end'] );
	$view['link_edit'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=record_highlight_content&amp;id=' . $view['record_id'];
	$view['link_delete'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;delete_id=' . $view['record_id'] . '&amp;delete_checkss=' . md5( $view['record_id'] . NV_CACHE_PREFIX . $client_info['session_id'] );

	$xtpl->assign( 'VIEW', $view );

	if( $view['is_hot'] )
	{
		$xtpl->parse( 'main.loop.is_hot' );
	}
	else
	{
		$xtpl->parse( 'main.loop.n_is_hot' );
	}

	if( $view['is_highlights'] )
	{
		$xtpl->parse( 'main.loop.is_highlights' );
	}
	else
	{
		$xtpl->parse( 'main.loop.n_is_highlights' );
	}

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

$array_status = array(
	'1' => $lang_module['active'],
	'0' => $lang_module['deactive']
);
foreach( $array_status as $key => $value )
{
	$sl = $array_search['status'] == $key ? 'selected="selected"' : '';
	$xtpl->assign( 'STATUS', array( 'key' => $key, 'value' => $value, 'selected' => $sl ) );
	$xtpl->parse( 'main.status' );
}

$allow_country = !empty( $allow_country ) ? implode( ',', $allow_country ) : '';
$countryid = nv_location_get_countryid_from_province( $array_search['provinceid'] );
$data_config = array(
	'select_countyid' => $countryid,
	'select_provinceid' => $array_search['provinceid'],
	'allow_country' => $allow_country,
	'blank_title_province' => true
);
$xtpl->assign( 'LOCATION', nv_location_build_input( $data_config ) );

$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

$page_title = $lang_module['record_highlights'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';