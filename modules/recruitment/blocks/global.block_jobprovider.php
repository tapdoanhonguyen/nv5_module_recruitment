<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 3/9/2010 23:25
 */

if( ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );

if( ! nv_function_exists( 'nv_block_jobprovider' ) )
{
	function nv_block_config_jobprovider_blocks( $module, $data_block, $lang_block )
	{
		global $site_mods;
		$html = '';
		/*
		$html .= '<tr>';
		$html .= '	<td>' . $lang_block['number_day'] . '</td>';
		$html .= '	<td><input type="text" name="config_number_day" class="form-control w100" size="5" value="' . $data_block['number_day'] . '"/></td>';
		$html .= '</tr>';
		 *
		 */
		$html .= '<tr>';
		$html .= '	<td>' . $lang_block['numrow'] . '</td>';
		$html .= '	<td><input type="text" name="config_numrow" class="form-control w100" size="5" value="' . $data_block['numrow'] . '"/></td>';
		$html .= '</tr>';

		return $html;
	}

	function nv_block_config_jobprovider_blocks_submit( $module, $lang_block )
	{
		global $nv_Request;
		$return = array();
		$return['error'] = array();
		$return['config'] = array();
		/*
		$return['config']['number_day'] = $nv_Request->get_int( 'config_number_day', 'post', 0 );
		 *
		 */
		$return['config']['numrow'] = $nv_Request->get_int( 'config_numrow', 'post', 0 );
		return $return;
	}

	function nv_block_jobprovider( $block_config )
	{
		global $site_mods, $db, $module_config, $global_config, $module_file;

		$array_data = array();
		$module = $block_config['module'];
		$mod_file = $site_mods[$module]['module_file'];
		$mod_data = $site_mods[$module]['module_data'];
		$mod_upload = $site_mods[$module]['module_upload'];

		//$publtime = NV_CURRENTTIME - $block_config['number_day'] * 86400;

		if( file_exists( NV_ROOTDIR . '/themes/' . $global_config['module_theme']  . '/modules/' . $mod_file . '/block_jobprovider.tpl' ) )
		{
			$block_theme = $global_config['module_theme'] ;
		}
		else
		{
			$block_theme = 'default';
		}

		$db->sqlreset()
		  ->select( 'id, title, alias, image' )
		  ->from( NV_PREFIXLANG . '_' . $mod_data . '_jobprovider' )
		  ->where( 'status=1' )
		  ->order( 'id DESC' )
		  ->limit( $block_config['numrow'] );
		$_query = $db->query( $db->sql() );
		while( $row = $_query->fetch() )
		{
			if( !empty( $row['image'] ) and file_exists( NV_ROOTDIR . '/' . NV_UPLOADS_DIR . '/' . $mod_upload . '/jobprovider_images/' . $row['image'] ))
			{
				$row['image'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $mod_upload . '/jobprovider_images/' . $row['image'];
			}
			else
			{
				$row['image'] = NV_BASE_SITEURL . 'themes/' . $block_theme . '/images/' . $module_file . '/no_photo_icon.jpg';
			}
			$row['link'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module . '&amp;' . NV_OP_VARIABLE . '=' . $site_mods[$module]['alias']['jobprovider'] . '/' . $row['alias'] . '-' . $row['id'];
			$array_data[$row['id']] = $row;
		}

		$xtpl = new XTemplate( 'block_jobprovider.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/modules/'. $mod_file );
		$xtpl->assign( 'TEMPLATE', $block_theme );

		if( !empty( $array_data ) )
		{
			foreach( $array_data as $data )
			{
				$xtpl->assign( 'DATA', $data );
				$xtpl->parse( 'main.loop' );
			}
		}

		$xtpl->parse( 'main' );
		return $xtpl->text( 'main' );
	}
}

if( defined( 'NV_SYSTEM' ) )
{
	global $site_mods, $module_name;

	$module = $block_config['module'];
	$content = nv_block_jobprovider( $block_config );
}