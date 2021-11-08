<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Tue, 11 Aug 2015 07:37:06 GMT
 */

if ( ! defined( 'NV_IS_MOD_RECRUITMENT' ) ) die( 'Stop!!!' );

$row = array();
$error = array();

if( !defined( 'NV_IS_USER' ) )
{
	$url_redirect = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $module_info['alias']['jobseeker'];
	Header( 'Location: ' . NV_BASE_SITEURL . 'index.php?' . NV_NAME_VARIABLE . '=users&' . NV_OP_VARIABLE . '=login&nv_redirect=' . nv_redirect_encrypt( $url_redirect ) );
	die( );
}

$row = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobseeker WHERE userid=' . $user_info['userid'] )->fetch();
if( empty( $row ) )
{
	$row['id'] = 0;
	$row['last_name'] = $user_info['last_name'];
	$row['first_name'] = $user_info['first_name'];
	$row['birthday'] = !empty( $user_info['birthday'] ) ? nv_date( 'd/m/Y', $user_info['birthday'] ) : '';
	$row['gender'] = 1;
	$row['marital'] = 0;
	$row['address'] = '';
	$row['province'] = '';
	$row['email'] = $user_info['email'];
	$row['phone'] = '';
	$row['addtime'] = 0;
	$row['updatetime'] = 0;
	$row['status'] = 1;
}

if ( $nv_Request->isset_request( 'submit', 'post' ) )
{
	$row['last_name'] = $nv_Request->get_title( 'last_name', 'post', '' );
	$row['first_name'] = $nv_Request->get_title( 'first_name', 'post', '' );
	if( preg_match( '/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $nv_Request->get_string( 'birthday', 'post' ), $m ) )
	{
		$_hour = 0;
		$_min = 0;
		$row['birthday'] = mktime( $_hour, $_min, 0, $m[2], $m[1], $m[3] );
	}
	else
	{
		$row['birthday'] = 0;
	}
	$row['gender'] = $nv_Request->get_int( 'gender', 'post', 0 );
	$row['marital'] = $nv_Request->get_int( 'marital', 'post', 0 );
	$row['address'] = $nv_Request->get_title( 'address', 'post', '' );
	$row['province'] = $nv_Request->get_int( 'provinceid', 'post', 0 );
	$row['email'] = $nv_Request->get_title( 'email', 'post', '' );
	$row['phone'] = $nv_Request->get_title( 'phone', 'post', '' );
	$row['addtime'] = $nv_Request->get_int( 'addtime', 'post', 0 );
	$row['updatetime'] = $nv_Request->get_int( 'updatetime', 'post', 0 );
	$row['status'] = $nv_Request->get_int( 'status', 'post', 0 );

	if( empty( $row['last_name'] ) )
	{
		$error[] = $lang_module['error_required_last_name'];
	}
	elseif( empty( $row['first_name'] ) )
	{
		$error[] = $lang_module['error_required_first_name'];
	}
	elseif( empty( $row['birthday'] ) )
	{
		$error[] = $lang_module['error_required_birthday'];
	}
	elseif( empty( $row['province'] ) )
	{
		$error[] = $lang_module['error_required_province'];
	}
	elseif( empty( $row['email'] ) )
	{
		$error[] = $lang_module['error_required_email'];
	}
	elseif( empty( $row['phone'] ) )
	{
		$error[] = $lang_module['error_required_phone'];
	}

	if( empty( $error ) )
	{
		try
		{
			if( empty( $row['id'] ) )
			{
				$stmt = $db->prepare( 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_jobseeker (last_name, first_name, birthday, gender, marital, address, province, email, phone, userid, addtime, updatetime, status) VALUES (:last_name, :first_name, :birthday, :gender, :marital, :address, :province, :email, :phone, :userid, :addtime, :updatetime, 1)' );
			}
			else
			{
				$stmt = $db->prepare( 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_jobseeker SET last_name = :last_name, first_name = :first_name, birthday = :birthday, gender = :gender, marital = :marital, address = :address, province = :province, email = :email, phone = :phone, userid = :userid, addtime = :addtime, updatetime = :updatetime WHERE id=' . $row['id'] );
			}
			$stmt->bindParam( ':last_name', $row['last_name'], PDO::PARAM_STR );
			$stmt->bindParam( ':first_name', $row['first_name'], PDO::PARAM_STR );
			$stmt->bindParam( ':birthday', $row['birthday'], PDO::PARAM_INT );
			$stmt->bindParam( ':gender', $row['gender'], PDO::PARAM_INT );
			$stmt->bindParam( ':marital', $row['marital'], PDO::PARAM_INT );
			$stmt->bindParam( ':address', $row['address'], PDO::PARAM_STR );
			$stmt->bindParam( ':province', $row['province'], PDO::PARAM_STR );
			$stmt->bindParam( ':email', $row['email'], PDO::PARAM_STR );
			$stmt->bindParam( ':phone', $row['phone'], PDO::PARAM_STR );
			$stmt->bindParam( ':userid', $user_info['userid'], PDO::PARAM_INT );
			$stmt->bindParam( ':addtime', $row['addtime'], PDO::PARAM_INT );
			$stmt->bindParam( ':updatetime', $row['updatetime'], PDO::PARAM_INT );

			$exc = $stmt->execute();
			if( $exc )
			{
				if( empty( $row['id'] ) )
				{
					nv_add_groups( $array_config['group_jobseeker'], $user_info['userid'] );
				}
				$nv_Cache->delMod( $module_name );
				$url_back = nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=jobseeker', true );
				nv_theme_recruitment_alert( $lang_module['jobseeker_info_update_success_title'], $lang_module['jobseeker_info_update_success_content'], 'info', $url_back );
			}
		}
		catch( PDOException $e )
		{
			trigger_error( $e->getMessage() );
			die( $e->getMessage() ); //Remove this line after checks finished
		}
	}
}

if( empty( $row['birthday'] ) )
{
	$row['birthday'] = '';
}
else
{
	$row['birthday'] = date( 'd/m/Y', $row['birthday'] );
}

$user_info['photo'] = !empty( $user_info['photo'] ) ? NV_BASE_SITEURL . $user_info['photo'] : '';
$user_info['url_password_change'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=users&amp;' . NV_OP_VARIABLE . '=editinfo/password';
$user_info['url_image_change'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=users&amp;' . NV_OP_VARIABLE . '=editinfo/avatar';

$xtpl = new XTemplate( $op . '.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'NV_LANG_VARIABLE', NV_LANG_VARIABLE );
$xtpl->assign( 'NV_LANG_DATA', NV_LANG_DATA );
$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
$xtpl->assign( 'NV_NAME_VARIABLE', NV_NAME_VARIABLE );
$xtpl->assign( 'NV_OP_VARIABLE', NV_OP_VARIABLE );
$xtpl->assign( 'MODULE_NAME', $module_name );
$xtpl->assign( 'MODULE_UPLOAD', $module_upload );
$xtpl->assign( 'NV_ASSETS_DIR', NV_ASSETS_DIR );
$xtpl->assign( 'OP', $op );
$xtpl->assign( 'ROW', $row );
$xtpl->assign( 'USER_INFO', $user_info );

foreach( $array_gender as $key => $title )
{
	$xtpl->assign( 'OPTION', array(
		'key' => $key,
		'title' => $title,
		'checked' => ($key == $row['gender']) ? ' checked="checked"' : ''
	) );
	$xtpl->parse( 'main.radio_gender' );
}

if( !empty( $array_marital ) )
{
	foreach( $array_marital as $key => $value )
	{
		$sl = $key == $row['marital'] ? 'selected="selected"' : '';
		$xtpl->assign( 'MARITAL', array( 'key' => $key, 'value' => $value, 'selected' => $sl ) );
		$xtpl->parse( 'main.marital' );
	}
}

$allow_country = !empty( $allow_country ) ? implode( ',', $allow_country ) : '';
$countryid = nv_location_get_countryid_from_province( $row['province'] );
$data_config = array(
	'select_countyid' => $countryid,
	'select_provinceid' => $row['province'],
	'allow_country' => $allow_country,
	'multiple_province' => false
);
$xtpl->assign( 'LOCATION', nv_location_build_input( $data_config ) );

if( !empty( $user_info['photo'] ) )
{
	$xtpl->parse( 'main.image' );
}
else
{
	$xtpl->parse( 'main.empty' );
}

if( ! empty( $error ) )
{
	$xtpl->assign( 'ERROR', implode( '<br />', $error ) );
	$xtpl->parse( 'main.error' );
}

$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

$page_title = $lang_module['jobseeker_info_update'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';