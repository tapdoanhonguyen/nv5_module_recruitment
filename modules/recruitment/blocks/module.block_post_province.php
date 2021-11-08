<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sat, 10 Dec 2011 06:46:54 GMT
 */

if( ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );

if( ! nv_function_exists( 'nv_block_post_province' ) )
{
	function nv_block_config_post_province( $module, $data_block, $lang_block )
	{
		global $site_mods, $nv_Cache;

		$html = '';
		$html .= '<tr>';
		$html .= '<td>' . $lang_block['reject'] . '</td>';
		$sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $site_mods[$module]['module_data'] . '_province';
		$list = $nv_Cache->db( $sql, '', $module );
		$html .= '<td><div style="height: 200px; overflow: scroll"';
		foreach( $list as $l )
		{
			$html .= '<label><input type="checkbox" name="config_reject[]" value="' . $l['provinceid'] . '" ' . ( ( in_array( $l['provinceid'], empty( $data_block['reject'] ) ? array() : $data_block['reject'] ) ) ? ' checked="checked"' : '' ) . '</input>' . $l['name'] . '</label><br />';
		}
		$html .= '</td>';
		$html .= '</tr>';
		return $html;
	}

	function nv_block_config_post_province_submit( $module, $lang_block )
	{
		global $nv_Request;
		$return = array( );
		$return['error'] = array( );
		$return['config'] = array( );
		$return['config']['reject'] = $nv_Request->get_array( 'config_reject', 'post', array() );
		return $return;
	}

	function nv_block_post_province( $block_config )
	{
		global $db, $module_info, $site_mods, $module_name, $module_data, $module_file, $lang_module, $module_config, $global_config, $array_province;

		if( file_exists( NV_ROOTDIR . '/themes/' . $global_config['module_theme']  . '/modules/' . $module_file . '/block_post_province.tpl' ) )
		{
			$block_theme = $global_config['module_theme'] ;
		}
		else
		{
			$block_theme = 'default';
		}

		$xtpl = new XTemplate( 'block_post_province.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/modules/' . $module_file );

		if( !empty( $array_province ) )
		{
			foreach( $array_province as $province )
			{
				if( !in_array( $province['provinceid'], $block_config['reject'] ) )
				{
					$province['view_url'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $module_info['alias']['viewprovince'] . '/' . change_alias( $province['name'] ) . '-' . $province['provinceid'];
					$province['number'] = $db->query( 'SELECT COUNT(*) FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows_province WHERE province_id=' . $province['provinceid'] )->fetchColumn();
					$xtpl->assign( 'PROVINCE', $province );
					$xtpl->parse( 'main.province' );
				}
			}
		}

		$xtpl->parse( 'main' );
		return $xtpl->text( 'main' );
	}
}

if( defined( 'NV_SYSTEM' ) )
{
	$content = nv_block_post_province( $block_config );
}
