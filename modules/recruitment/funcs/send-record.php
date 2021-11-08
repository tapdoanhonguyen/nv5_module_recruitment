<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Wed, 30 Sep 2015 07:44:07 GMT
 */

if( ! defined( 'NV_IS_MOD_RECRUITMENT' ) ) die( 'Stop!!!' );

$row = array();
$error = array();
$row['id'] = $nv_Request->get_int( 'id', 'post,get', 0 );
$row['rows_id'] = explode( '-', $array_op[1] );
$row['rows_id'] = intval( end( $row['rows_id'] ) );

$post_data = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows WHERE id=' . $row['rows_id'] )->fetch();
if( empty( $post_data ) or empty( $jobseeker_id ) or !$array_config['send_record'] )
{
	Header( 'Location: ' . nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name, true ) );
	die();
}

$post_data['jobs_id'] = first_view_job($post_data['jobs_id']);
$url_back = nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $array_jobs[$post_data['jobs_id']]['alias'] . '/' . $post_data['alias'] . '-' . $post_data['id'], true );

if( !defined( 'NV_IS_USER' ) )
{
	$url_redirect = nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $module_info['alias']['send-record'] . '/' . $post_data['alias'] . '-' . $post_data['id'], true );
	Header( 'Location: ' . NV_BASE_SITEURL . 'index.php?' . NV_NAME_VARIABLE . '=users&' . NV_OP_VARIABLE . '=login&nv_redirect=' . nv_redirect_encrypt( $url_redirect ) );
	die( );
}

$jobseeker = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobseeker WHERE userid=' . $user_info['userid'] )->fetch();
$jobprovider = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobprovider WHERE id=' . $post_data['jobprovider_id'] )->fetch();

$count = $db->query( 'SELECT COUNT(*) FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows_record WHERE rows_id=' . $row['rows_id'] . ' AND jobseeker_id=' . $jobseeker['id'] )->fetchColumn();
if( $count > 0 )
{
	nv_theme_recruitment_alert( $lang_module['sended_record'], $lang_module['sended_record_error_content'], 'warning', $url_back, 5 );
}

if ( $nv_Request->isset_request( 'submit', 'post' ) )
{
	$row['rows_id'] = $nv_Request->get_int( 'rows_id', 'post', 0 );
	$row['title'] = $nv_Request->get_title( 'title', 'post', '' );
	$row['fulname'] = $nv_Request->get_title( 'fulname', 'post', '' );
	$row['email'] = $nv_Request->get_title( 'email', 'post', '' );
	$row['phone'] = $nv_Request->get_title( 'phone', 'post', '' );
	$row['introduction'] = $nv_Request->get_string( 'introduction', 'post', '' );

	if( empty( $row['title'] ) )
	{
		$error[] = $lang_module['error_required_title'];
	}
	elseif( empty( $row['fulname'] ) )
	{
		$error[] = $lang_module['error_required_fulname'];
	}
	elseif( empty( $row['email'] ) )
	{
		$error[] = $lang_module['error_required_email'];
	}
	elseif( empty( $row['phone'] ) )
	{
		$error[] = $lang_module['error_required_phone'];
	}
	elseif( empty( $row['introduction'] ) )
	{
		$error[] = $lang_module['error_required_introduction'];
	}
	else
	{
		$fileupload = '';
		$array_config['is_upload_allow'] = 1;
		if( $array_config['is_upload_allow'] )
		{
			$array_config['upload_filetype'] = ! empty( $array_config['upload_filetype'] ) ? explode( ',', $array_config['upload_filetype'] ) : array();
			if( isset( $_FILES['upload_fileupload'] ) and is_uploaded_file( $_FILES['upload_fileupload']['tmp_name'] ) )
			{
				if( !file_exists( NV_UPLOADS_REAL_DIR . '/' . $module_upload . '/record' ) )
				{
					nv_mkdir( NV_UPLOADS_REAL_DIR . '/' . $module_upload, 'record' );
				}

				$file_allowed_ext = !empty( $array_config['upload_filetype'] ) ? $array_config['upload_filetype'] : $global_config['file_allowed_ext'];
				$upload = new upload( $file_allowed_ext, $global_config['forbid_extensions'], $global_config['forbid_mimes'], $array_config['maxfilesize'], NV_MAX_WIDTH, NV_MAX_HEIGHT );
				$upload_info = $upload->save_file( $_FILES['upload_fileupload'], NV_UPLOADS_REAL_DIR . '/' . $module_upload . '/record', false );
				@unlink( $_FILES['upload_fileupload']['tmp_name'] );
				if( empty( $upload_info['error'] ) )
				{
					mt_srand( ( double )microtime() * 1000000 );
					$maxran = 1000000;
					$random_num = mt_rand( 0, $maxran );
					$random_num = md5( $random_num );
					$nv_pathinfo_filename = nv_pathinfo_filename( $upload_info['name'] );
					$new_name = NV_UPLOADS_REAL_DIR . '/' . $module_upload . '/record/' . $nv_pathinfo_filename . '.' . $random_num . '.' . $upload_info['ext'];
					$rename = nv_renamefile( $upload_info['name'], $new_name );
					if( $rename[0] == 1 )
					{
						$fileupload = $new_name;
					}
					else
					{
						$fileupload = $upload_info['name'];
					}
					@chmod( $fileupload, 0644 );
					$fileupload = str_replace( NV_ROOTDIR . '/' . NV_UPLOADS_DIR . '/' . $module_upload . '/record/', '', $fileupload );
				}
				else
				{
					$is_error = true;
					$error[] = $upload_info['error'];
				}
				unset( $upload, $upload_info );
			}
		}
	}

	if( empty( $error ) )
	{
		try
		{
			if( empty( $row['id'] ) )
			{
				$stmt = $db->prepare( 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_rows_record (rows_id, title, fulname, email, phone, introduction, file, jobseeker_id, sendtime) VALUES (:rows_id, :title, :fulname, :email, :phone, :introduction, :file, :jobseeker_id, ' . NV_CURRENTTIME . ')' );
			}
			else
			{
				$stmt = $db->prepare( 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_rows_record SET rows_id = :rows_id, title = :title, fulname = :fulname, email = :email, phone = :phone, introduction = :introduction, file = :file, jobseeker_id = :jobseeker_id, sendtime = :sendtime WHERE id=' . $row['id'] );
			}
			$stmt->bindParam( ':rows_id', $row['rows_id'], PDO::PARAM_INT );
			$stmt->bindParam( ':title', $row['title'], PDO::PARAM_STR );
			$stmt->bindParam( ':fulname', $row['fulname'], PDO::PARAM_STR );
			$stmt->bindParam( ':email', $row['email'], PDO::PARAM_STR );
			$stmt->bindParam( ':phone', $row['phone'], PDO::PARAM_STR );
			$stmt->bindParam( ':introduction', $row['introduction'], PDO::PARAM_STR, strlen($row['introduction']) );
			$stmt->bindParam( ':file', $fileupload, PDO::PARAM_STR );
			$stmt->bindParam( ':jobseeker_id', $jobseeker['id'], PDO::PARAM_INT );

			$exc = $stmt->execute();
			if( $exc )
			{
				$nv_Cache->delMod( $module_name );
				nv_theme_recruitment_alert( $lang_module['send_record_success_title'], sprintf( $lang_module['send_record_success_content'], $post_data['title'] ), 'info', $url_back, 5 );
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
	$row = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows_record WHERE id=' . $row['id'] )->fetch();
	if( empty( $row ) )
	{
		Header( 'Location: ' . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op );
		die();
	}
}
else
{
	$row['id'] = 0;
	$row['title'] = '';
	$row['fulname'] = $jobseeker['last_name']  . ' ' . $jobseeker['first_name'];
	$row['email'] = $jobseeker['email'];
	$row['phone'] = $jobseeker['phone'];
	$row['introduction'] = '';
	$row['file'] = '';
	$row['jobseeker_id'] = 0;
}

$post_data['url_view_jobs'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $array_jobs[$post_data['jobs_id']]['alias'] . '/' . $post_data['alias'] . '-' . $post_data['id'];
$jobprovider['link'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $module_info['alias']['jobprovider'] . '/' . $jobprovider['alias'] . '-' . $jobprovider['id'];

if( defined( 'NV_EDITOR' ) )
{
	require_once NV_ROOTDIR . '/' . NV_EDITORSDIR . '/' . NV_EDITOR . '/nv.php';
}
elseif( ! nv_function_exists( 'nv_aleditor' ) and file_exists( NV_ROOTDIR . '/' . NV_EDITORSDIR . '/ckeditor/ckeditor.js' ) )
{
	define( 'NV_EDITOR', true );
	define( 'NV_IS_CKEDITOR', true );
	$my_head .= '<script type="text/javascript" src="' . NV_BASE_SITEURL . NV_EDITORSDIR . '/ckeditor/ckeditor.js"></script>';

	function nv_aleditor( $textareaname, $width = '100%', $height = '450px', $val = '', $customtoolbar = '' )
	{
		global  $module_data;
		$return = '<textarea style="width: ' . $width . '; height:' . $height . ';" id="' . $module_data . '_' . $textareaname . '" name="' . $textareaname . '">' . $val . '</textarea>';
		$return .= "<script type=\"text/javascript\">
		CKEDITOR.replace( '" . $module_data . "_" . $textareaname . "', {" . ( ! empty( $customtoolbar ) ? 'toolbar : "' . $customtoolbar . '",' : '' ) . " width: '" . $width . "',height: '" . $height . "',});
		</script>";
		return $return;
	}
}

$row['introduction'] = htmlspecialchars( nv_editor_br2nl( $row['introduction'] ) );

if( defined( 'NV_EDITOR' ) and nv_function_exists( 'nv_aleditor' ) )
{
	$row['introduction'] = nv_aleditor( 'introduction', '100%', '300px', $row['introduction'], 'Basic' );
}
else
{
	$row['introduction'] = '<textarea style="width:100%;height:300px" name="introduction">' . $row['introduction'] . '</textarea>';
}

$xtpl = new XTemplate( 'send-record.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'ROW', $row );
$xtpl->assign( 'POST', $post_data );
$xtpl->assign( 'JOBPROVIDER', $jobprovider );
$xtpl->assign( 'EXT_ALLOWED', $array_config['upload_filetype'] );

if( ! empty( $error ) )
{
	$xtpl->assign( 'ERROR', implode( '<br />', $error ) );
	$xtpl->parse( 'main.error' );
}

$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

$page_title = $lang_module['send_record'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';