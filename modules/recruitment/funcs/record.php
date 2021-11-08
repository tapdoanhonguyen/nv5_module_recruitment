<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Thu, 25 Jun 2015 07:04:29 GMT
 */

if( ! defined( 'NV_IS_MOD_RECRUITMENT' ) ) die( 'Stop!!!' );

if( !defined( 'NV_IS_USER' ) )
{
	$url_redirect = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $module_info['alias']['record'];
	Header( 'Location: ' . NV_BASE_SITEURL . 'index.php?' . NV_NAME_VARIABLE . '=users&' . NV_OP_VARIABLE . '=login&nv_redirect=' . nv_redirect_encrypt( $url_redirect ) );
	die( );
}

$jobseeker_info = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobseeker WHERE userid=' . $user_info['userid'] )->fetch();
if( empty( $jobseeker_info ) )
{
	Header( 'Location: ' . nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name, true ) );
	die( );
}

//change status
if( $nv_Request->isset_request( 'change_status', 'post, get' ) )
{
	$id = $nv_Request->get_int( 'id', 'post, get', 0 );
	$content = 'NO_' . $id;

	$query = 'SELECT status FROM ' . NV_PREFIXLANG . '_' . $module_data . '_record WHERE id=' . $id;
	$row = $db->query( $query )->fetch();
	if( isset( $row['status'] ) )
	{
		$status = ( $row['status'] ) ? 0 : 1;
		$query = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_record SET status=' . intval( $status ) . ' WHERE id=' . $id;
		$db->query( $query );
		$content = 'OK_' . $id;
	}
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
		nv_delete_record( $id );
		Header( 'Location: ' . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op );
		die();
	}
}

$row = array();
$base_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op;

// Fetch Limit
$show_view = false;
if ( ! $nv_Request->isset_request( 'id', 'post,get' ) )
{
	$show_view = true;
	$per_page = 20;
	$page = $nv_Request->get_int( 'page', 'post,get', 1 );
	$db->sqlreset()
		->select( 'COUNT(*)' )
		->from( '' . NV_PREFIXLANG . '_' . $module_data . '_record' )
		->where( 'jobseeker_id=' . $jobseeker_info['id'] );

	$sth = $db->prepare( $db->sql() );
	$sth->execute();
	$num_items = $sth->fetchColumn();

	$db->select( '*' )
		->order( 'id' )
		->limit( $per_page )
		->offset( ( $page - 1 ) * $per_page );
	$sth = $db->prepare( $db->sql() );
	$sth->execute();
}

if( !$num_items )
{
	$url_record_add = nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $module_info['alias']['record-content'], true );
	$lang_module['record_empty'] = sprintf( $lang_module['record_empty'], $url_record_add );
}

$lang_module['record_limit_content'] = sprintf( $lang_module['record_limit_content'], $array_config['record_limit'] );

$xtpl = new XTemplate( $op . '.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
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

if( $num_items > 0 )
{
	$generate_page = nv_generate_page( $base_url, $num_items, $per_page, $page );
	if( !empty( $generate_page ) )
	{
		$xtpl->assign( 'NV_GENERATE_PAGE', $generate_page );
		$xtpl->parse( 'main.view.generate_page' );
	}
	$number = $page > 1 ? $per_page * ( $page - 1 ) : 1;
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
		$view['jobs'] = $array_jobs[$view['jobs_id']]['title'];
		$view['position_id'] = $array_position[$view['position_id']]['title'];
		if( !in_array( $view['status'], array( 2, 3 ) ) ) // 2: Cho kiem duyet, 3: Nhap
		{
			$view['link_view'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $module_info['alias']['view-record'] . '/' . $array_jobs[$view['jobs_id']]['alias'] . '-' . $view['id'];
		}
		$view['link_edit'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $module_info['alias']['record-content'] . '&amp;id=' . $view['id'];
		$view['link_delete'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;delete_id=' . $view['id'] . '&amp;delete_checkss=' . md5( $view['id'] . NV_CACHE_PREFIX . $client_info['session_id'] );
		
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
		
		$view['jobs_id'] = $view['jobs'];

		$xtpl->assign( 'VIEW', $view );

		if( $view['status'] == 3 ) // 3: Nhap
		{
			$xtpl->parse( 'main.view.loop.draft' );
			$xtpl->parse( 'main.view.loop.label' );
		}
		elseif( $view['status'] == 2 ) // 2: Cho duyet
		{
			$xtpl->parse( 'main.view.loop.queue' );
			$xtpl->parse( 'main.view.loop.label' );
		}
		else
		{
			if( !$view['status_admin'] )
			{
				$xtpl->parse( 'main.view.loop.lock_display' );
				$xtpl->parse( 'main.view.loop.label' );
			}
			elseif( $view['status'] == 1 )
			{
				$xtpl->parse( 'main.view.loop.display' );
				$xtpl->parse( 'main.view.loop.url' );
			}
			else
			{
				$xtpl->parse( 'main.view.loop.display' );
				$xtpl->parse( 'main.view.loop.label' );
			}
		}

		$xtpl->parse( 'main.view.loop' );
	}
	$xtpl->parse( 'main.view' );
}
else
{
	$xtpl->parse( 'main.empty' );
}

$count = $db->query( 'SELECT COUNT(*) FROM ' . NV_PREFIXLANG . '_' . $module_data . '_record WHERE userid=' . $user_info['userid'] )->fetchColumn();

if( $count >= $array_config['record_limit'] )
{
	$xtpl->parse( 'main.record_create_dis' );
}
else
{
	$xtpl->assign( 'URL_CREATE', nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $module_info['alias']['record-content'], true ) );
}

$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

$array_mod_title[] = array('title' => $lang_module['record_list'], 'link' => $base_url );
$page_title = $lang_module['record_list'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';