<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 3-6-2010 0:14
 */

 if( ! defined( 'NV_IS_MOD_RECRUITMENT' ) ) die( 'Stop!!!' );

if( isset( $array_op[1] ) )
{
	$alias = trim( $array_op[1] );
	$page = (isset( $array_op[2] ) and substr( $array_op[2], 0, 5 ) == 'page-') ? intval( substr( $array_op[2], 5 ) ) : 1;

	$stmt = $db->prepare( 'SELECT bid, title, alias, image, description, keywords FROM ' . NV_PREFIXLANG . '_' . $module_data . '_block_cat WHERE alias= :alias' );
	$stmt->bindParam( ':alias', $alias, PDO::PARAM_STR );
	$stmt->execute();
	list( $bid, $page_title, $alias, $image_group, $description, $key_words ) = $stmt->fetch( 3 );
	if( $bid > 0 )
	{
		$base_url_rewrite = $base_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $module_info['alias']['groups'] . '/' . $alias;

		if( $page > 1 )
		{
			$page_title .= ' ' . NV_TITLEBAR_DEFIS . ' ' . $lang_global['page'] . ' ' . $page;
			$base_url_rewrite .= '/page-' . $page;
		}
		$base_url_rewrite = nv_url_rewrite( $base_url_rewrite, true );
		if( $_SERVER['REQUEST_URI'] != $base_url_rewrite and NV_MAIN_DOMAIN . $_SERVER['REQUEST_URI'] != $base_url_rewrite )
		{
			Header( 'Location: ' . $base_url_rewrite );
			die();
		}

		$array_mod_title[] = array(
			'catid' => 0,
			'title' => $page_title,
			'link' => $base_url
		);

		$item_array = array();
		$end_weight = 0;

		$db->sqlreset()
			->select( 'COUNT(*)' )
			->from( NV_PREFIXLANG . '_' . $module_data . '_rows t1' )
			->join( 'INNER JOIN ' . NV_PREFIXLANG . '_' . $module_data . '_block t2 ON t1.id = t2.id' )
			->where( 't2.bid= ' . $bid . ' AND t1.status= 1' );

		$num_items = $db->query( $db->sql() )->fetchColumn();

		$db->select( '*' )
			->order( 't2.weight ASC' )
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
			}

			$row['jobprovider'] = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobprovider WHERE id=' . $row['jobprovider_id'] )->fetch();
			$array_data[] = $row;
		}

		if( ! empty( $image_group ) )
		{
			$image_group = NV_BASE_SITEURL . NV_FILES_DIR . '/' . $module_upload . '/' . $image_group;
		}
		$generate_page = nv_alias_page( $page_title, $base_url, $num_items, $per_page, $page );

		$contents = nv_theme_recruitment_list_post_detail( $array_data, $generate_page );
	}
}
else
{
	Header( 'Location: ' . NV_BASE_SITEURL );
	die();
}

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';
