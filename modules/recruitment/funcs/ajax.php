<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Thu, 25 Jun 2015 07:06:22 GMT
 */

if( ! defined( 'NV_IS_MOD_RECRUITMENT' ) ) die( 'Stop!!!' );

if( $nv_Request->isset_request( 'post_new', 'post, get' ) )
{
	$page = $nv_Request->get_int( 'page', 'post, get', 1 );
	$per_page = $nv_Request->get_int( 'per_page', 'post, get', $per_page );
	$display = $nv_Request->get_int( 'display', 'post, get', 0 );
	$jobs_id = $nv_Request->get_int( 'jobs_id', 'post, get', 0 );
	$order_field = $nv_Request->get_title( 'order_field', 'post, get', 'id' );
	$order_sort = $nv_Request->get_title( 'order_sort', 'post, get', 'DESC' );
	$id_list = $nv_Request->get_title( 'id_list', 'post, get', 'list-post' );

	$post_new = array();
	$base_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=ajax&amp;post_new=1&amp;display=' . $display . '&amp;per_page=' . $per_page . '&amp;id_list=' . $id_list;

	$where = '';
	if( !empty( $jobs_id ) )
	{
		$where .= ' AND jobs_id=' . $jobs_id;
		$base_url .= '&amp;jobs_id=' . $jobs_id;
	}

	$db->sqlreset()
	  ->select( 'COUNT(*)' )
	  ->from( NV_PREFIXLANG . '_' . $module_data . '_rows' )
	  ->where( 'status=1' . $where );

	$all_page = $db->query( $db->sql() )->fetchColumn();

	$db->select( '*' )
	  ->order( $order_field . ' ' . $order_sort )
	  ->limit( $per_page )
	  ->offset( ($page - 1) * $per_page );

	$_query = $db->query( $db->sql() );
	while( $row = $_query->fetch() )
	{
		$row['is_highlights'] = 0;
		$is_highlights = $db->query( 'SELECT COUNT(*) FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows_highlights WHERE rows_id=' . $row['id'] . ' AND status=1 AND is_highlights=1 AND time_begin<=' . NV_CURRENTTIME . ' AND (time_end = 0 OR time_end >= ' . NV_CURRENTTIME . ' )' )->fetchColumn();
		if( $is_highlights > 0 )
		{
			$row['is_highlights'] = 1;
		}

		$row['province_id'] = array();
		$_result = $db->query( 'SELECT province_id FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows_province WHERE rows_id=' . $row['id'] );
		while( list( $province_id ) = $_result->fetch( 3 ) )
		{
			$row['province_id'][] = $province_id;
			$province_info = nv_location_get_province_info( $province_id );
		}
		
		
		$row['province'] = $province_info['title'];
	
	
		$row['jobprovider'] = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobprovider WHERE id=' . $row['jobprovider_id'] )->fetch();
		
		$row['jobs_id'] = first_view_job($row['jobs_id']);
		$row['link'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $array_jobs[$row['jobs_id']]['alias'] . '/' . $row['alias'] . '-' . $row['id'];
		$row['jobprovider_url'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $module_info['alias']['jobprovider'] . '/' . $row['jobprovider']['alias'] . '-' . $row['jobprovider']['id'];
		
		$post_new[$row['id']] = $row;
	}

	$generate_page = nv_generate_page( $base_url, $all_page, $per_page, $page, true, true, 'nv_urldecode_ajax', $id_list );

	if( $display )
	{
		$contents = nv_theme_recruitment_list_post_detail( $post_new, $generate_page );
	}
	else
	{
		$contents = nv_theme_recruitment_list_post( $post_new, $generate_page );
	}

	include NV_ROOTDIR . '/includes/header.php';
	echo $contents;
	include NV_ROOTDIR . '/includes/footer.php';
}

if( $nv_Request->isset_request( 'post_hot', 'post, get' ) )
{
	$page = $nv_Request->get_int( 'page', 'post, get', 1 );
	$per_page = $nv_Request->get_int( 'per_page', 'post, get', $per_page );
	$display = $nv_Request->get_int( 'display', 'post, get', 0 );
	$jobs_id = $nv_Request->get_int( 'jobs_id', 'post, get', 0 );
	$order_field = $nv_Request->get_title( 'order_field', 'post, get', 'id' );
	$order_sort = $nv_Request->get_title( 'order_sort', 'post, get', 'DESC' );

	$post_hot = array();
	$base_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=ajax&amp;post_hot=1&amp;display=' . $display . '&amp;per_page=' . $per_page;

	$where = '';
	if( !empty( $jobs_id ) )
	{
		$where .= ' AND t1.jobs_id=' . $jobs_id;
		$base_url .= '&amp;jobs_id=' . $jobs_id;
	}

	$db->sqlreset()
	  ->select( 'COUNT(*)' )
	  ->from( NV_PREFIXLANG . '_' . $module_data . '_rows t1' )
	  ->join( 'INNER JOIN ' . NV_PREFIXLANG . '_' . $module_data . '_rows_highlights t2 ON t1.id=t2.rows_id' )
	  ->where( 't1.status=1 AND t2.status=1 AND t2.is_hot=1 AND t2.time_begin<=' . NV_CURRENTTIME . ' AND (t2.time_end > 0 AND t2.time_end >= ' . NV_CURRENTTIME . ' )' . $where );

	$all_page = $db->query( $db->sql() )->fetchColumn();

	$db->select( 't1.*, t2.is_hot, t2.is_hot_icon, t2.is_highlights, t2.time_begin, t2.time_end' )
	  ->order( $order_field . ' ' . $order_sort )
	  ->limit( $per_page )
	  ->offset( ($page - 1) * $per_page );

	$_query = $db->query( $db->sql() );
	while( $row = $_query->fetch() )
	{
		$row['jobprovider'] = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobprovider WHERE id=' . $row['jobprovider_id'] )->fetch();
		$post_hot[$row['id']] = $row;
	}

	$generate_page = nv_generate_page( $base_url, $all_page, $per_page, $page, true, true, 'nv_urldecode_ajax', 'list-post' );

	if( $display )
	{
		$contents = nv_theme_recruitment_list_post_detail( $post_hot, $generate_page );
	}
	else
	{
		$contents = nv_theme_recruitment_list_post( $post_hot, $generate_page );
	}

	include NV_ROOTDIR . '/includes/header.php';
	echo $contents;
	include NV_ROOTDIR . '/includes/footer.php';
}

if( $nv_Request->isset_request( 'post_save', 'post' ) )
{
	$rows_id = $nv_Request->get_int( 'rows_id', 'post', 0 );
	$flag = $nv_Request->get_int( 'flag', 'post', 1 );

	if( empty( $rows_id ) ) die( 'NO' );

	if( $flag )
	{
		$result = $db->query( 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_jobseeker_rsave( userid, rows_id ) VALUES (' . $user_info['userid'] . ', ' . $rows_id . ')' );
	}
	else
	{
		$result = $db->query( 'DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobseeker_rsave WHERE userid=' . $user_info['userid'] . ' AND rows_id=' . $rows_id );
	}
	if( !$result ) die( 'NO' );
	die( 'OK' );
}

if( $nv_Request->isset_request( 'get_record', 'post, get' ) )
{
	$page = $nv_Request->get_int( 'page', 'post, get', 1 );
	$per_page = $nv_Request->get_int( 'per_page', 'post, get', $per_page );
	$display = $nv_Request->get_int( 'display', 'post, get', 0 );
	$jobs_id = $nv_Request->get_int( 'jobs_id', 'post, get', 0 );
	$order_field = $nv_Request->get_title( 'order_field', 'post, get', 'id' );
	$order_sort = $nv_Request->get_title( 'order_sort', 'post, get', 'DESC' );
	$id_list = $nv_Request->get_title( 'id_list', 'post, get', 'list-record' );

	$post_new = array();
	$base_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=ajax&amp;get_record=1&amp;display=' . $display . '&amp;per_page=' . $per_page . '&amp;id_list=' . $id_list;

	$where = '';
	if( !empty( $jobs_id ) )
	{
		$where .= ' AND jobs_id=' . $jobs_id;
		$base_url .= '&amp;jobs_id=' . $jobs_id;
	}

	$db->sqlreset()
	  ->select( 'COUNT(*)' )
	  ->from( NV_PREFIXLANG . '_' . $module_data . '_record' )
	  ->where( 'status=1' . $where );

	$all_page = $db->query( $db->sql() )->fetchColumn();

	$db->select( '*' )
	  ->order( $order_field . ' ' . $order_sort )
	  ->limit( $per_page )
	  ->offset( ($page - 1) * $per_page );

	$_query = $db->query( $db->sql() );
	while( $row = $_query->fetch() )
	{
		$row['is_highlights'] = 0;
		$is_highlights = $db->query( 'SELECT COUNT(*) FROM ' . NV_PREFIXLANG . '_' . $module_data . '_record_highlights WHERE record_id=' . $row['id'] . ' AND status=1 AND is_highlights=1 AND time_begin<=' . NV_CURRENTTIME . ' AND (time_end = 0 OR time_end >= ' . NV_CURRENTTIME . ' )' )->fetchColumn();
		if( $is_highlights > 0 )
		{
			$row['is_highlights'] = 1;
		}

		$row['jobseeker'] = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobseeker WHERE id=' . $row['jobseeker_id'] )->fetch();
		$post_new[$row['id']] = $row;
	}

	$generate_page = nv_generate_page( $base_url, $all_page, $per_page, $page, true, true, 'nv_urldecode_ajax', $id_list );

	if( $display )
	{
		$contents = nv_theme_recruitment_list_record_detail( $post_new, $generate_page );
	}
	else
	{
		$contents = nv_theme_recruitment_list_record( $post_new, $generate_page );
	}

	include NV_ROOTDIR . '/includes/header.php';
	echo $contents;
	include NV_ROOTDIR . '/includes/footer.php';
}