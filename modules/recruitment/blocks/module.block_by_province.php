<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sat, 10 Dec 2011 06:46:54 GMT
 */

if( ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );

if( ! nv_function_exists( 'nv_block_by_province' ) )
{
	function nv_block_config_by_province( $module, $data_block, $lang_block )
	{
		global $db, $db_config, $site_mods, $nv_Request;

		require_once NV_ROOTDIR . '/modules/location/data.functions.php';

		$html = '';
		$html .= '<tr>';
		$html .= '<td>' . $lang_block['ob'] . '</td>';
		$html .= '<td>';
		$html .= '<select class="form-control" name="config_ob">';
		$sl = $data_block['ob'] == 'post' ? 'selected="selected"' : '';
		$html .= '<option value="post" ' . $sl . '>' . $lang_block['ob_post'] . '</option>';
		$sl = $data_block['ob'] == 'record' ? 'selected="selected"' : '';
		$html .= '<option value="record" ' . $sl . '>' . $lang_block['ob_record'] . '</option>';
		$html .= '</select>';
		$html .= '</td>';
		$html .= '</tr>';
		$html .= '<tr>';
		$html .= '<td>' . $lang_block['reject'] . '</td>';
		$list = nv_location_get_province( 1 );
		$html .= '<td><div style="height: 200px; overflow: scroll"';
		foreach( $list as $l )
		{
			$html .= '<label><input type="checkbox" name="config_reject[]" value="' . $l['provinceid'] . '" ' . ( ( in_array( $l['provinceid'], empty( $data_block['reject'] ) ? array() : $data_block['reject'] ) ) ? ' checked="checked"' : '' ) . '</input>' . $l['title'] . '</label><br />';
		}
		$html .= '</td>';
		$html .= '</tr>';
		return $html;
	}

	function nv_block_config_by_province_submit( $module, $lang_block )
	{
		global $nv_Request;
		$return = array( );
		$return['error'] = array( );
		$return['config'] = array( );
		$return['config']['ob'] = $nv_Request->get_title( 'config_ob', 'post', 'post' );
		$return['config']['reject'] = $nv_Request->get_array( 'config_reject', 'by', array() );
		return $return;
	}

	function nv_block_by_province( $block_config )
	{
		global $db, $module_info, $site_mods, $module_name, $module_data, $module_file, $lang_module, $module_config, $global_config, $array_province;

		if( file_exists( NV_ROOTDIR . '/themes/' . $global_config['module_theme']  . '/modules/' . $module_file . '/block_by_province.tpl' ) )
		{
			$block_theme = $global_config['module_theme'] ;
		}
		else
		{
			$block_theme = 'default';
		}

		$xtpl = new XTemplate( 'block_by_province.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/modules/' . $module_file );

		$array_province = nv_location_get_province( 1 );
		if( !empty( $array_province ) )
		{
			foreach( $array_province as $province )
			{
				if( !in_array( $province['provinceid'], $block_config['reject'] ) )
				{
					if( $block_config['ob'] == 'post' )
					{
						$province['view_url'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $lang_module[$block_config['ob']] . '-' . change_alias( $province['type'] . '-' .$province['title']);
						$province['number'] = $db->query( 'SELECT COUNT(*) FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows_province WHERE province_id=' . $province['provinceid'] )->fetchColumn();
					}
					else
					{
						$province['view_url'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $lang_module[$block_config['ob']] . '-' . change_alias( $province['type'] . '-' .$province['title']);

						$province['number'] = $db->query( 'SELECT COUNT(*) FROM ' . NV_PREFIXLANG . '_' . $module_data . '_record_wlocation WHERE location_id=' . $province['provinceid'] )->fetchColumn();
					}
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
	$content = nv_block_by_province( $block_config );
}