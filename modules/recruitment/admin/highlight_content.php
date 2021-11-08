<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sat, 26 Sep 2015 23:53:29 GMT
 */

if ( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );

$row = array();
$error = '';
$row['id'] = $nv_Request->get_int( 'id', 'post,get', 0 );
$row['rows_id'] = $nv_Request->get_int( 'rows_id', 'post,get', 0 );
$is_modal = $nv_Request->get_int( 'is_modal', 'post,get', 0 );

if( $row['id'] > 0 )
{
	$row = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows_highlights WHERE id=' . $row['id'] )->fetch();
	if( empty( $row ) )
	{
		Header( 'Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op );
		die();
	}
	$row['is_edit'] = 1;
}
else
{
	$row['is_edit'] = 0;
	$row['id'] = 0;
	$row['is_hot'] = 0;
	$row['is_hot_icon'] = 0;
	$row['is_highlights'] = 1;
	$row['time_begin'] = NV_CURRENTTIME;
	$row['time_end'] = 0;
}
list( $row['title'], $row['code'] ) = $db->query( 'SELECT title, code FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows WHERE id=' . $row['rows_id'] )->fetch( 3 );

if ( $nv_Request->isset_request( 'submit', 'post' ) )
{
	$row['rows_id'] = $nv_Request->get_int( 'rows_id', 'post', 0 );
	$row['is_hot'] = $nv_Request->get_int( 'is_hot', 'post', 0 );
	$row['is_hot_icon'] = $nv_Request->get_int( 'is_hot_icon', 'post', 0 );
	$row['is_highlights'] = $nv_Request->get_int( 'is_highlights', 'post', 0 );

	if( preg_match( '/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $nv_Request->get_string( 'time_begin', 'post' ), $m ) )
	{
		$_hour = 0;
		$_min = 0;
		$row['time_begin'] = mktime( $_hour, $_min, 0, $m[2], $m[1], $m[3] );
	}
	else
	{
		$row['time_begin'] = 0;
	}
	if( preg_match( '/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $nv_Request->get_string( 'time_end', 'post' ), $m ) )
	{
		$row['time_end'] = mktime( 23, 59, 59, $m[2], $m[1], $m[3] );
	}
	else
	{
		$row['time_end'] = 0;
	}

	if( empty( $row['is_hot'] ) and empty( $row['is_highlights'] ) )
	{
		$error = $lang_module['error_required_hot'];
	}
	if( empty( $row['time_begin'] ) )
	{
		$error = $lang_module['error_required_time_begin'];
	}

	if( empty( $error ) )
	{
		try
		{
			if( empty( $row['id'] ) )
			{
				$stmt = $db->prepare( 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_rows_highlights (rows_id, is_hot, is_hot_icon, is_highlights, time_begin, time_end, add_time, add_userid, status) VALUES (:rows_id, :is_hot, :is_hot_icon, :is_highlights, :time_begin, :time_end, ' . NV_CURRENTTIME . ', :add_userid, 1)' );
				$stmt->bindParam( ':add_userid', $admin_info['userid'], PDO::PARAM_INT );
			}
			else
			{
				$stmt = $db->prepare( 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_rows_highlights SET rows_id = :rows_id, is_hot = :is_hot, is_hot_icon = :is_hot_icon, is_highlights = :is_highlights, time_begin = :time_begin, time_end = :time_end WHERE id=' . $row['id'] );
			}
			$stmt->bindParam( ':rows_id', $row['rows_id'], PDO::PARAM_INT );
			$stmt->bindParam( ':is_hot', $row['is_hot'], PDO::PARAM_INT );
			$stmt->bindParam( ':is_hot_icon', $row['is_hot_icon'], PDO::PARAM_INT );
			$stmt->bindParam( ':is_highlights', $row['is_highlights'], PDO::PARAM_INT );
			$stmt->bindParam( ':time_begin', $row['time_begin'], PDO::PARAM_INT );
			$stmt->bindParam( ':time_end', $row['time_end'], PDO::PARAM_INT );

			$exc = $stmt->execute();
			if( $exc )
			{
				$nv_Cache->delMod( $module_name );

				if( empty( $row['id'] ) )
				{
					$highlights_url = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=highlights';
					die( 'OK_' . sprintf( $lang_module['highlights_add_success'], $row['code'], $row['title'], $highlights_url ) );
				}
				else
				{
					die( 'OK_' . $lang_module['highlights_edit_success'] );
				}
			}
		}
		catch( PDOException $e )
		{
			trigger_error( $e->getMessage() );
			die( $e->getMessage() ); //Remove this line after checks finished
		}
	}
	else
	{
		die( 'NO_' . $error );
	}
}

if( empty( $row['time_begin'] ) )
{
	$row['time_begin'] = '';
}
else
{
	$row['time_begin'] = date( 'd/m/Y', $row['time_begin'] );
}

if( empty( $row['time_end'] ) )
{
	$row['time_end'] = '';
}
else
{
	$row['time_end'] = date( 'd/m/Y', $row['time_end'] );
}

$row['ck_is_hot'] = $row['is_hot'] ? 'checked="checked"' : '';
$row['ck_is_hot_icon'] = $row['is_hot_icon'] ? 'checked="checked"' : '';
$row['display_is_hot_icon'] = !$row['is_hot'] ? 'style="display: none"' : '';
$row['ck_is_highlights'] = $row['is_highlights'] ? 'checked="checked"' : '';

$xtpl = new XTemplate( $op . '.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'NV_LANG_VARIABLE', NV_LANG_VARIABLE );
$xtpl->assign( 'NV_LANG_DATA', NV_LANG_DATA );
$xtpl->assign( 'NV_BASE_ADMINURL', NV_BASE_ADMINURL );
$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
$xtpl->assign( 'NV_NAME_VARIABLE', NV_NAME_VARIABLE );
$xtpl->assign( 'NV_OP_VARIABLE', NV_OP_VARIABLE );
$xtpl->assign( 'MODULE_NAME', $module_name );
$xtpl->assign( 'MODULE_FILE', $module_file );
$xtpl->assign( 'MODULE_UPLOAD', $module_upload );
$xtpl->assign( 'NV_ASSETS_DIR', NV_ASSETS_DIR );
$xtpl->assign( 'OP', $op );
$xtpl->assign( 'ROW', $row );

if( empty( $row['rows_id'] ) )
{
	$xtpl->parse( 'main.empty' );
}
else
{
	$xtpl->parse( 'main.data' );
}

$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

$page_title = '[' . $row['code'] . ']' . ' ' . $row['title'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme( $contents, !$is_modal );
include NV_ROOTDIR . '/includes/footer.php';