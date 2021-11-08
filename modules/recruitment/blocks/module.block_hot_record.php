<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sat, 10 Dec 2011 06:46:54 GMT
 */

if( ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );

if( ! nv_function_exists( 'nv_block_recruitment_hot_record' ) )
{
	function nv_block_config_recruitment_hot_record( $module, $data_block, $lang_block )
	{
		global $site_mods;

		$html = '';
		$html .= '<tr>';
		$html .= '<td>' . $lang_block['numrow'] . '</td>';
		$html .= '<td><input type="text" class="form-control w200" name="config_numrow" size="5" value="' . $data_block['numrow'] . '"/></td>';
		$html .= '</tr>';
		return $html;
	}

	function nv_block_config_recruitment_hot_record_submit( $module, $lang_block )
	{
		global $nv_Request;
		$return = array( );
		$return['error'] = array( );
		$return['config'] = array( );
		$return['config']['numrow'] = $nv_Request->get_int( 'numrow', 'post', 24 );
		return $return;
	}

	function nv_block_recruitment_hot_record( $block_config )
	{
		global $db, $module_info, $site_mods, $module_name, $module_data, $module_file, $lang_module, $module_config, $global_config, $array_jobs;

		$module = $block_config['module'];
		$mod_upload = $site_mods[$module]['module_upload'];

		if( file_exists( NV_ROOTDIR . '/themes/' . $global_config['module_theme']  . '/modules/' . $module_file . '/block_hot_record.tpl' ) )
		{
			$block_theme = $global_config['module_theme'] ;
		}
		else
		{
			$block_theme = 'default';
		}

		$array_data = array();
		$db->sqlreset()
		  ->select( 'record_id, time_begin, time_end, is_hot, is_hot_icon, is_highlights' )
		  ->from( NV_PREFIXLANG . '_' . $module_data . '_record_highlights' )
		  ->where( 'status=1 AND is_hot=1 AND time_begin<=' . NV_CURRENTTIME . ' AND (time_end = 0 OR time_end >= ' . NV_CURRENTTIME . ' )' )
		  ->order( 'add_time DESC' )
		  ->limit( $block_config['numrow'] );

		$_query = $db->query( $db->sql() );
		$num = $_query->rowCount();
		while( $row = $_query->fetch() )
		{
			$post = $db->query( 'SELECT id, title, jobseeker_id, jobs_id, contact_image image FROM ' . NV_PREFIXLANG . '_' . $module_data . '_record WHERE status=1 AND id=' . $row['record_id'] )->fetch();
			if( !empty( $post ) )
			{
				$row += $post;
			}
			else
			{
				continue;
			}
			$row['jobseeker'] = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobseeker WHERE id=' . $post['jobseeker_id'] )->fetch();

			if( !empty( $post['image'] ) and file_exists( NV_ROOTDIR . '/' . NV_UPLOADS_DIR . '/' . $mod_upload . '/record_images/' . $post['image'] ) )
			{
				$row['image'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $mod_upload . '/record_images/' . $post['image'];
			}
			else
			{
				$row['image'] = NV_BASE_SITEURL . 'themes/' . $block_theme . '/images/' . $module_file . '/no_photo_icon.jpg';
			}

			$array_data[] = $row;
		}

		if( empty( $array_data ) ) return '';

		$xtpl = new XTemplate( 'block_hot_record.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/modules/' . $module_file );
		$xtpl->assign( 'LANG', $lang_module );

		if( !empty( $array_data ) )
		{
			$i=1;
			foreach( $array_data as $data )
			{
				$data['title'] = !empty( $data['title'] ) ? $data['title'] : $array_jobs[$data['jobs_id']]['title'];
				$data['title0'] = nv_clean60( $data['title'], 30 );
				$data['url_view_record'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $module_info['alias']['view-record'] . '/' . $array_jobs[$data['jobs_id']]['alias'] . '-' . $data['id'];

				$xtpl->assign( 'DATA', $data );

				if ($i==3) {
					$i=0;
					$xtpl->parse( 'main.data.loop.clearfix' );
				}

				$xtpl->parse( 'main.data.loop' );
				$i++;
			}

			if( !empty( $generate_page ) )
			{
				$xtpl->assign( 'PAGE', $generate_page );
				$xtpl->parse( 'main.data.generate_page' );
			}

			$xtpl->parse( 'main.data' );
		}

		if( $num > $block_config['numrow'] )
		{
			$xtpl->assign( 'URL_VIEW', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $module_info['alias']['hot-record'] );
			$xtpl->parse( 'main.viewall' );
		}

		$xtpl->parse( 'main' );
		return $xtpl->text( 'main' );
	}
}

if( defined( 'NV_SYSTEM' ) )
{
	global $site_mods, $module_name, $module_data, $module_file, $array_jobs;

	$content = nv_block_recruitment_hot_record( $block_config );
}
