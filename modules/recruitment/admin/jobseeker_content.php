<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Tue, 11 Aug 2015 07:37:06 GMT
 */

if ( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );

if( $nv_Request->isset_request( 'get_user_json', 'post, get' ) )
{
	$q = $nv_Request->get_title( 'q', 'post, get', '' );

	$db->sqlreset()
		->select( 'birthday, userid, username, email, first_name, last_name' )
		->from( NV_USERS_GLOBALTABLE )
		->where( '( username LIKE :username OR email LIKE :email OR first_name like :first_name OR last_name like :last_name ) AND userid NOT IN (SELECT userid FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobseeker ) AND userid NOT IN (SELECT userid FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobprovider )' )
		->order( 'username ASC' )
		->limit( 20 );

	$sth = $db->prepare( $db->sql() );
	$sth->bindValue( ':username', '%' . $q . '%', PDO::PARAM_STR );
	$sth->bindValue( ':email', '%' . $q . '%', PDO::PARAM_STR );
	$sth->bindValue( ':first_name', '%' . $q . '%', PDO::PARAM_STR );
	$sth->bindValue( ':last_name', '%' . $q . '%', PDO::PARAM_STR );
	$sth->execute();

	$array_data = array();
	while( list($birthday, $userid, $username, $email, $last_name, $first_name ) = $sth->fetch( 3 ) )
	{
		$array_data[] = array(
		'id' => $userid,
		'username' => $username,
		'first_name' => $first_name,
		'birthday' => date('d/m/Y',$birthday),
		'last_name' => $last_name,
		'fullname' => nv_show_name_user( $first_name, $last_name ) );
	}

	header( 'Cache-Control: no-cache, must-revalidate' );
	header( 'Content-type: application/json' );

	ob_start( 'ob_gzhandler' );
	echo json_encode( $array_data );
	exit();
}

$row = array();
$error = array();
$row['id'] = $nv_Request->get_int( 'id', 'post,get', 0 );
$redirect = $nv_Request->get_title( 'redirect', 'get', '' );

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
	$row['userid'] = $nv_Request->get_int( 'userid', 'post', 0 );
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
	elseif( empty( $row['userid'] ) )
	{
		$error[] = $lang_module['error_required_userid_jobprovider'];
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
			$stmt->bindParam( ':userid', $row['userid'], PDO::PARAM_INT );
			$stmt->bindParam( ':addtime', $row['addtime'], PDO::PARAM_INT );
			$stmt->bindParam( ':updatetime', $row['updatetime'], PDO::PARAM_INT );

			$exc = $stmt->execute();
			if( $exc )
			{
				if( empty( $row['id'] ) )
				{
					nv_add_groups( $array_config['group_jobseeker'], $row['userid'], $admin_info['userid'] );
				}

				$nv_Cache->delMod( $module_name );

				if( !empty( $redirect ) )
				{
					$redirect = nv_redirect_decrypt( $redirect );
				}
				else
				{
					$redirect = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=jobseeker';
				}
				Header( 'Location: ' . $redirect );
			}
		}
		catch( PDOException $e )
		{
			trigger_error( $e->getMessage() );
			die( $e->getMessage() ); //Remove this line after checks finished
		}
	}
}
elseif( $row['id'] > 0 )
{
	$row = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobseeker WHERE id=' . $row['id'] )->fetch();
	if( empty( $row ) )
	{
		Header( 'Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op );
		die();
	}

	if( $row['userid'] > 0 )
	{
		$row['username'] = $db->query( 'SELECT username, email FROM ' . NV_USERS_GLOBALTABLE . ' WHERE userid=' . $row['userid'] )->fetchColumn();
	}
}
else
{
	$row['id'] = 0;
	$row['last_name'] = '';
	$row['first_name'] = '';
	$row['birthday'] = 0;
	$row['gender'] = 1;
	$row['marital'] = 0;
	$row['address'] = '';
	$row['province'] = '';
	$row['email'] = '';
	$row['phone'] = '';
	$row['userid'] = 0;
	$row['addtime'] = 0;
	$row['updatetime'] = 0;
	$row['status'] = 1;
}

if( empty( $row['birthday'] ) )
{
	$row['birthday'] = '';
}
else
{
	$row['birthday'] = date( 'd/m/Y', $row['birthday'] );
}

$xtpl = new XTemplate( $op . '.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'MODULE_NAME', $module_name );
$xtpl->assign( 'MODULE_UPLOAD', $module_upload );
$xtpl->assign( 'OP', $op );
$xtpl->assign( 'ROW', $row );
$xtpl->assign( 'ACTION', NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;id=' . $row['id'] . '&amp;redirect=' . $redirect );

foreach( $array_gender as $key => $title )
{
	$xtpl->assign( 'OPTION', array(
		'key' => $key,
		'title' => $title,
		'checked' => ($key == $row['gender']) ? ' checked="checked"' : ''
	) );
	$xtpl->parse( 'main.radio_gender' );
}

foreach( $array_marital as $key => $value )
{
	$sl = $key == $row['marital'] ? 'selected="selected"' : '';
	$xtpl->assign( 'MARITAL', array( 'key' => $key, 'value' => $value, 'selected' => $sl ) );
	$xtpl->parse( 'main.marital' );
}

if( !empty( $row['username'] ) )
{
	$xtpl->parse( 'main.userid' );
}

$allow_country = !empty( $allow_country ) ? implode( ',', $allow_country ) : '';
$countryid = nv_location_get_countryid_from_province( $row['province'] );
$data_config = array(
	'select_countyid' => $countryid,
	'select_provinceid' => $row['province'],
	'allow_country' => $allow_country
);
$xtpl->assign( 'LOCATION', nv_location_build_input( $data_config ) );

if( ! empty( $error ) )
{
	$xtpl->assign( 'ERROR', implode( '<br />', $error ) );
	$xtpl->parse( 'main.error' );
}

$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

$page_title = $lang_module['jobseeker_add'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';