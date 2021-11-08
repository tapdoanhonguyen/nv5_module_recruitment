<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Fri, 19 Jun 2015 07:33:37 GMT
 */

if ( ! defined( 'NV_ADMIN' ) or ! defined( 'NV_MAINFILE' ) or ! defined( 'NV_IS_MODADMIN' ) ) die( 'Stop!!!' );

define( 'NV_IS_FILE_ADMIN', true );

$allow_func = array( 'main', 'config', 'learning', 'jobs', 'worktype', 'position',
'document', 'document_type', 'money_units', 'jobprovider', 'jobprovider_content',
'jobseeker', 'jobseeker_content', 'record', 'record_content', 'content', 'highlights',
'highlight_content', 'record_highlight_content', 'record_highlights', 'groups', 'list_block_cat',
'chang_block_cat', 'block', 'change_block', 'list_block', 'approved' );

require_once NV_ROOTDIR . '/modules/' . $module_file . '/global.functions.php';
require_once NV_ROOTDIR . '/modules/location/data.functions.php';

/**
 * nv_show_groups_list()
 *
 * @return
 */
function nv_show_groups_list()
{
	global $db, $lang_module, $lang_global, $module_name, $module_data, $op, $module_file, $global_config, $module_info;

	$sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_block_cat ORDER BY weight ASC';
	$_array_block_cat = $db->query( $sql )->fetchAll();
	$num = sizeof( $_array_block_cat );

	if( $num > 0 )
	{
		$array_adddefault = array(
			$lang_global['no'],
			$lang_global['yes']
		);

		$xtpl = new XTemplate( 'blockcat_lists.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
		$xtpl->assign( 'LANG', $lang_module );
		$xtpl->assign( 'GLANG', $lang_global );

		foreach ( $_array_block_cat as $row)
		{
			$numnews = $db->query( 'SELECT COUNT(*) FROM ' . NV_PREFIXLANG . '_' . $module_data . '_block where bid=' . $row['bid'] )->fetchColumn();

			$xtpl->assign( 'ROW', array(
				'bid' => $row['bid'],
				'title' => $row['title'],
				'numnews' => $numnews,
				'link' => NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=block&amp;bid=' . $row['bid'],
				'linksite' => NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $module_info['alias']['groups'] . '/' . $row['alias'],
				'url_edit' => NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;bid=' . $row['bid'] . '#edit'
			) );

			for( $i = 1; $i <= $num; ++$i )
			{
				$xtpl->assign( 'WEIGHT', array(
					'key' => $i,
					'title' => $i,
					'selected' => $i == $row['weight'] ? ' selected="selected"' : ''
				) );
				$xtpl->parse( 'main.loop.weight' );
			}

			foreach( $array_adddefault as $key => $val )
			{
				$xtpl->assign( 'ADDDEFAULT', array(
					'key' => $key,
					'title' => $val,
					'selected' => $key == $row['adddefault'] ? ' selected="selected"' : ''
				) );
				$xtpl->parse( 'main.loop.adddefault' );
			}

			for( $i = 1; $i <= 30; ++$i )
			{
				$xtpl->assign( 'NUMBER', array(
					'key' => $i,
					'title' => $i,
					'selected' => $i == $row['numbers'] ? ' selected="selected"' : ''
				) );
				$xtpl->parse( 'main.loop.number' );
			}

			$xtpl->parse( 'main.loop' );
		}

		$xtpl->parse( 'main' );
		$contents = $xtpl->text( 'main' );
	}
	else
	{
		$contents = '&nbsp;';
	}

	return $contents;
}

/**
 * nv_fix_block_cat()
 *
 * @return
 */
function nv_fix_block_cat()
{
	global $db, $module_data;

	$sql = 'SELECT bid FROM ' . NV_PREFIXLANG . '_' . $module_data . '_block_cat ORDER BY weight ASC';
	$weight = 0;
	$result = $db->query( $sql );
	while( $row = $result->fetch() )
	{
		++$weight;
		$sql = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_block_cat SET weight=' . $weight . ' WHERE bid=' . intval( $row['bid'] );
		$db->query( $sql );
	}
	$result->closeCursor();
}

/**
 * nv_show_block_list()
 *
 * @param mixed $bid
 * @return
 */
function nv_show_block_list( $bid )
{
	global $db, $lang_module, $lang_global, $module_name, $module_data, $op, $module_file, $global_config, $array_jobs;

	$xtpl = new XTemplate( 'block_list.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'GLANG', $lang_global );
	$xtpl->assign( 'NV_BASE_ADMINURL', NV_BASE_ADMINURL );
	$xtpl->assign( 'NV_NAME_VARIABLE', NV_NAME_VARIABLE );
	$xtpl->assign( 'NV_OP_VARIABLE', NV_OP_VARIABLE );
	$xtpl->assign( 'MODULE_NAME', $module_name );
	$xtpl->assign( 'OP', $op );
	$xtpl->assign( 'BID', $bid );

	$array_jobs[0] = array( 'alias' => 'Other' );

	$sql = 'SELECT t1.id, t1.jobs_id, t1.title, t1.alias, t2.weight FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows t1 INNER JOIN ' . NV_PREFIXLANG . '_' . $module_data . '_block t2 ON t1.id = t2.id WHERE t2.bid= ' . $bid . ' AND t1.status=1 ORDER BY t2.weight ASC';
	$array_block = $db->query( $sql )->fetchAll();

	$num = sizeof( $array_block );
	if( $num > 0 )
	{
		
		foreach ($array_block as $row)
		{
			$jobs = explode( ',', $row['jobs_id'] );
			
			$xtpl->assign( 'ROW', array(
				'id' => $row['id'],
				'link' => NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $array_jobs[$jobs[0]]['alias'] . '/' . $row['alias'] . '-' . $row['id'] . $global_config['rewrite_exturl'],
				'title' => $row['title']
			) );

			for( $i = 1; $i <= $num; ++$i )
			{
				$xtpl->assign( 'WEIGHT', array(
					'key' => $i,
					'title' => $i,
					'selected' => $i == $row['weight'] ? ' selected="selected"' : ''
				) );
				$xtpl->parse( 'main.loop.weight' );
			}

			$xtpl->parse( 'main.loop' );
		}

		$xtpl->parse( 'main' );
		$contents = $xtpl->text( 'main' );
	}
	else
	{
		$contents = '&nbsp;';
	}

	return $contents;
}

/**
 * nv_fix_block()
 *
 * @param mixed $bid
 * @param bool $repairtable
 * @return
 */
function nv_fix_block( $bid, $repairtable = true )
{
	global $db, $module_data;
	$bid = intval( $bid );
	if( $bid > 0 )
	{
		$sql = 'SELECT id FROM ' . NV_PREFIXLANG . '_' . $module_data . '_block where bid=' . $bid . ' ORDER BY weight ASC';
		$result = $db->query( $sql );
		$weight = 0;
		while( $row = $result->fetch() )
		{
			++$weight;
			if( $weight <= 100 )
			{
				$sql = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_block SET weight=' . $weight . ' WHERE bid=' . $bid . ' AND id=' . $row['id'];
			}
			else
			{
				$sql = 'DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_block WHERE bid=' . $bid . ' AND id=' . $row['id'];
			}
			$db->query( $sql );
		}
		$result->closeCursor();
		if( $repairtable )
		{
			$db->query( 'OPTIMIZE TABLE ' . NV_PREFIXLANG . '_' . $module_data . '_block' );
		}
	}
}