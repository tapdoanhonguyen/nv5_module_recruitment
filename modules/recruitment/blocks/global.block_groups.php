<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sat, 10 Dec 2011 06:46:54 GMT
 */

if( ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );

if( ! nv_function_exists( 'nv_block_groups' ) )
{
	function nv_block_config_groups( $module, $data_block, $lang_block )
	{
		global $site_mods;

		$html_input = '';
		$html = '';
		$html .= '<tr>';
		$html .= '<td>' . $lang_block['blockid'] . '</td>';
		$html .= '<td><select name="config_blockid" class="form-control w200">';
		$html .= '<option value="0"> -- </option>';
		$sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $site_mods[$module]['module_data'] . '_block_cat ORDER BY weight ASC';
		$list = nv_db_cache( $sql, '', $module );
		foreach( $list as $l )
		{
			$html_input .= '<input type="hidden" id="config_blockid_' . $l['bid'] . '" value="' . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module . '&amp;' . NV_OP_VARIABLE . '=' . $site_mods[$module]['alias']['groups'] . '/' . $l['alias'] . '" />';
			$html .= '<option value="' . $l['bid'] . '" ' . ( ( $data_block['blockid'] == $l['bid'] ) ? ' selected="selected"' : '' ) . '>' . $l['title'] . '</option>';
		}
		$html .= '</select>';
		$html .= $html_input;
		$html .= '<script type="text/javascript">';
		$html .= '	$("select[name=config_blockid]").change(function() {';
		$html .= '		$("input[name=title]").val($("select[name=config_blockid] option:selected").text());';
		$html .= '		$("input[name=link]").val($("#config_blockid_" + $("select[name=config_blockid]").val()).val());';
		$html .= '	});';
		$html .= '</script>';
		$html .= '</tr>';
		$html .= '<tr>';
		$html .= '<td>' . $lang_block['numrow'] . '</td>';
		$html .= '<td><input type="text" class="form-control w200" name="config_numrow" size="5" value="' . $data_block['numrow'] . '"/></td>';
		$html .= '</tr>';
		return $html;
	}

	function nv_block_config_groups_submit( $module, $lang_block )
	{
		global $nv_Request;
		$return = array();
		$return['error'] = array();
		$return['config'] = array();
		$return['config']['blockid'] = $nv_Request->get_int( 'config_blockid', 'post', 0 );
		$return['config']['numrow'] = $nv_Request->get_int( 'config_numrow', 'post', 0 );
		return $return;
	}

	function nv_block_groups( $block_config )
	{
		global $module_info, $site_mods, $module_config, $global_config, $db, $array_jobs;

		$module = $block_config['module'];

		$db->sqlreset()
			->select( 't1.id, t1.title, t1.alias, t1.jobs_id, t1.jobprovider_id' )
			->from( NV_PREFIXLANG . '_' . $site_mods[$module]['module_data'] . '_rows t1' )
			->join( 'INNER JOIN ' . NV_PREFIXLANG . '_' . $site_mods[$module]['module_data'] . '_block t2 ON t1.id = t2.id' )
			->where( 't2.bid= ' . $block_config['blockid'] . ' AND t1.status= 1' )
			->order( 't2.weight ASC' )
			->limit( $block_config['numrow'] );

		$list = nv_db_cache( $db->sql(), '', $module );

		if( ! empty( $list ) )
		{
			if( file_exists( NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/news/block_groups.tpl' ) )
			{
				$block_theme = $global_config['module_theme'];
			}
			else
			{
				$block_theme = 'default';
			}
			$xtpl = new XTemplate( 'block_groups.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/modules/news' );
			$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
			$xtpl->assign( 'TEMPLATE', $block_theme );

			foreach( $list as $l )
			{
				$l['link'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module . '&amp;' . NV_OP_VARIABLE . '=' . $array_jobs[$l['jobs_id']]['alias'] . '/' . $l['alias'] . '-' . $l['id'];
				$xtpl->assign( 'ROW', $l );
				$xtpl->parse( 'main.loop' );
			}

			$xtpl->parse( 'main' );
			return $xtpl->text( 'main' );
		}
	}
}

if( defined( 'NV_SYSTEM' ) )
{
	global $site_mods, $module_name, $array_jobs;

	$module = $block_config['module'];

	if( isset( $site_mods[$module] ) )
	{
		if( $module != $module_name )
		{
			$sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $site_mods[$module]['module_data'] . '_jobs WHERE status=1 ORDER BY weight';
			$array_jobs = nv_db_cache( $sql, 'id', $module );
		}
		$content = nv_block_groups( $block_config );
	}
}
