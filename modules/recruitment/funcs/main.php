<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sat, 20 Jun 2015 07:15:10 GMT
 */

if( ! defined( 'NV_IS_MOD_RECRUITMENT' ) ) die( 'Stop!!!' );



if ( $nv_Request->isset_request( 'get_alias_key', 'post' ) )
{
	$keyword = $nv_Request->get_title( 'get_alias_key', 'post', '' );
	$_SESSION['keyword'] = $keyword;
	die(ok);
}


if ( $nv_Request->isset_request( 'get_alias_title', 'post' ) )
{
	$alias = $nv_Request->get_title( 'get_alias_title', 'post', '' );
	$alias = change_alias( $alias );
	$alias = str_replace('-undefined', '', $alias);
	$alias = str_replace('undefined-', '', $alias);
	//$alias = nv_strtolower($alias);
	$link = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $alias;
	
	$link = nv_url_rewrite($link, true);
	die($link);
}

		
	
	

 
 
$array_data = array();
if( $nv_Request->isset_request( 'post_new', 'post, get' ) )
{
	$per_page = 30;
	$page = $nv_Request->get_int( 'page', 'post, get', 1 );
	$order_field = $nv_Request->get_title( 'order_field', 'post, get', 'id' );
	$order_sort = $nv_Request->get_title( 'order_sort', 'post, get', 'DESC' );
	$post_new = array();
	$base_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;post_new=1';

	$db->sqlreset()
	  ->select( 'COUNT(*)' )
	  ->from( NV_PREFIXLANG . '_' . $module_data . '_rows' )
	  ->where( 'status=1' );

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

		$row['jobprovider'] = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobprovider WHERE id=' . $row['jobprovider_id'] )->fetch();
		$post_new[$row['id']] = $row;

	
	}
		

	$generate_page = nv_generate_page( $base_url, $all_page, $per_page, $page, true, true, 'nv_urldecode_ajax', 'post_new' );

	$contents = nv_theme_recruitment_list_post( $post_new, $generate_page );

	include NV_ROOTDIR . '/includes/header.php';
	echo $contents;
	include NV_ROOTDIR . '/includes/footer.php';

}


$contents = nv_theme_recruitment_main( $array_data);
$page_title = $module_info['custom_title'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';