<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Tue, 11 Aug 2015 04:09:47 GMT
 */

if( ! defined( 'NV_IS_MOD_RECRUITMENT' ) ) die( 'Stop!!!' );

$row = $error = $row['jobs_old'] = array();
$row['id'] = $nv_Request->get_int( 'id', 'post,get', 0 );
$image_folder = 'jobprovider_images';

if( !defined( 'NV_IS_USER' ) )
{
	$url_redirect = nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $module_info['alias']['jobprovider-content'], true );
	Header( 'Location: ' . NV_BASE_SITEURL . 'index.php?' . NV_NAME_VARIABLE . '=users&' . NV_OP_VARIABLE . '=login&nv_redirect=' . nv_redirect_encrypt( $url_redirect ) );
	die( );
}

$row = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobprovider WHERE userid=' . $user_info['userid'] )->fetch();
if( empty( $row ) )
{
	$row['id'] = 0;
	$row['title'] = '';
	$row['jobs'] = array();
	$row['provinceid'] = 0;
	$row['address'] = '';
	$row['email'] = '';
	$row['fax'] = '';
	$row['website'] = '';
	$row['agent'] = '';
	$row['image'] = '';
	$row['descripion'] = '';
	$row['contact_fullname'] = '';
	$row['contact_email'] = '';
	$row['contact_phone'] = '';
	$row['userid'] = $user_info['userid'];
	$row['username'] = '';
	$row['status'] = 0;
	$row['maps'] = '';
	$row['taxcode'] = '';
}

$row['jobs'] = array();
$result = $db->query( 'SELECT jobs_id FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobprovider_jobs WHERE provider_id=' . $row['id'] );
while( list( $jobs_id ) = $result->fetch( 3 ) )
{
	$row['jobs'][] = $jobs_id;
}
$row['jobs_old'] = $row['jobs'];

if ( $nv_Request->isset_request( 'submit', 'post' ) )
{
	$row['title'] = $nv_Request->get_title( 'title', 'post', '' );
	$row['alias'] = ( empty( $row['alias'] )) ? change_alias( $row['title'] ) : change_alias( $row['alias'] );
	$row['jobs'] = $nv_Request->get_typed_array( 'jobs', 'post', 'int', array() );
	$row['provinceid'] = $nv_Request->get_int( 'provinceid', 'post', 0 );
	$row['address'] = $nv_Request->get_title( 'address', 'post', '' );
	$row['maps'] = $nv_Request->get_array( 'maps', 'post', array() );
	$row['maps'] = serialize( $row['maps'] );
	$row['taxcode'] = $nv_Request->get_title( 'taxcode', 'post', '' );
	$row['email'] = $nv_Request->get_title( 'email', 'post', '' );
	$row['fax'] = $nv_Request->get_title( 'fax', 'post', '' );
	$row['website'] = $nv_Request->get_title( 'website', 'post', '' );
	$row['agent'] = $nv_Request->get_int( 'agent', 'post', 0 );
	$row['descripion'] = $nv_Request->get_editor( 'descripion', '', NV_ALLOWED_HTML_TAGS );
	$row['contact_fullname'] = $nv_Request->get_title( 'contact_fullname', 'post', '' );
	$row['contact_email'] = $nv_Request->get_title( 'contact_email', 'post', '' );
	$row['contact_phone'] = $nv_Request->get_title( 'contact_phone', 'post', '' );

	if( empty( $row['title'] ) )
	{
		$error[] = $lang_module['error_required_title'];
	}
	elseif( empty( $row['jobs'] ) )
	{
		$error[] = $lang_module['error_required_jobs'];
	}
	elseif( empty( $row['email'] ) )
	{
		$error[] = $lang_module['error_required_email'];
	}
	elseif( empty( $row['contact_fullname'] ) )
	{
		$error[] = $lang_module['error_required_contact_fullname'];
	}
	elseif( empty( $row['contact_email'] ) )
	{
		$error[] = $lang_module['error_required_contact_email'];
	}
	elseif( empty( $row['contact_phone'] ) )
	{
		$error[] = $lang_module['error_required_contact_phone'];
	}
	elseif( ! empty( $row['email'] ) and ( $error_email = nv_check_valid_email( $row['email'] ) ) != '' )
	{
		$error[] = $error_email;
	}
	elseif( ! empty( $row['website'] ) and ! nv_is_url( $row['website'] ) )
	{
		$error[] = $lang_module['error_url_website'];
	}
	elseif( ! empty( $row['contact_email'] ) and ( $error_email = nv_check_valid_email( $row['contact_email'] ) ) != '' )
	{
		$error[] = $error_email;
	}
	else
	{
		$fileupload = '';
		$array_config['upload_filetype'] = array( 'images' );
		if( isset( $_FILES['upload_fileupload'] ) and is_uploaded_file( $_FILES['upload_fileupload']['tmp_name'] ) )
		{
			if( !file_exists( NV_UPLOADS_REAL_DIR . '/' . $module_upload . '/' . $image_folder ) )
			{
				nv_mkdir( NV_UPLOADS_REAL_DIR . '/' . $module_upload, $image_folder );
			}

			// Xoa file cu neu ton tai
			if( !empty( $row['contact_image'] ) and file_exists( NV_UPLOADS_REAL_DIR . '/' . $module_upload . '/record_images/' . $row['contact_image'] ) )
			{
				nv_deletefile( NV_UPLOADS_REAL_DIR . '/' . $module_upload . '/record_images/' . $row['contact_image'] );
			}

			$file_allowed_ext = !empty( $array_config['upload_filetype'] ) ? $array_config['upload_filetype'] : $global_config['file_allowed_ext'];
			$upload = new NukeViet\Files\Upload( $file_allowed_ext, $global_config['forbid_extensions'], $global_config['forbid_mimes'], $array_config['maxfilesize'], NV_MAX_WIDTH, NV_MAX_HEIGHT );
			$upload_info = save( $_FILES['upload_fileupload'], NV_ROOTDIR . '/' . NV_TEMP_DIR, false );
			@unlink( $_FILES['upload_fileupload']['tmp_name'] );
			if( empty( $upload_info['error'] ) )
			{
				mt_srand( ( double )microtime() * 1000000 );
				$maxran = 1000000;
				$random_num = mt_rand( 0, $maxran );
				$random_num = md5( $random_num );
				$nv_pathinfo_filename = nv_pathinfo_filename( $upload_info['name'] );
				$new_name = NV_ROOTDIR . '/' . NV_TEMP_DIR . '/' . $nv_pathinfo_filename . '.' . $random_num . '.' . $upload_info['ext'];
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

				// resize
				$width = $array_config['logo_size_width'];
				$height = $array_config['logo_size_height'];
				$basename = basename( $fileupload );

				// Thay doi kich thuoc anh
                $_image = new NukeViet\Files\Image( $fileupload, NV_MAX_WIDTH, NV_MAX_HEIGHT );
                $_image->resizeXY( $width, $height );
                $_image->save( NV_UPLOADS_REAL_DIR . '/' . $module_upload . '/' . $image_folder, $basename );
                if ( file_exists( NV_UPLOADS_REAL_DIR . '/' . $module_upload . '/' . $image_folder . '/' . $basename ) )
                {
                    $fileupload = NV_UPLOADS_REAL_DIR . '/' . $module_upload . '/' . $image_folder . '/' . $basename;
                }
				$fileupload = str_replace( NV_ROOTDIR . '/' . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $image_folder . '/', '', $fileupload );
			}
			else
			{
				$is_error = true;
				$error[] = $upload_info['error'];
			}
			unset( $upload, $upload_info );
		}
	}

	if( empty( $error ) )
	{
		try
		{
			$id_new = 0;
			$exec = false;
			if( empty( $row['id'] ) )
			{
				$sql = 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_jobprovider (title, alias, provinceid, address, maps, taxcode, email, fax, website, image, agent, descripion, contact_fullname, contact_email, contact_phone, userid, status) VALUES (:title, :alias, :provinceid, :address, :maps, :taxcode, :email, :fax, :website, :image, :agent, :descripion, :contact_fullname, :contact_email, :contact_phone, :userid, 1)';
				$data_insert = array();
				$data_insert['title'] = $row['title'];
				$data_insert['alias'] = $row['alias'];
				$data_insert['provinceid'] = $row['provinceid'];
				$data_insert['address'] = $row['address'];
				$data_insert['maps'] = $row['maps'];
				$data_insert['taxcode'] = $row['taxcode'];
				$data_insert['email'] = $row['email'];
				$data_insert['fax'] = $row['fax'];
				$data_insert['website'] = $row['website'];
				$data_insert['image'] = $fileupload;
				$data_insert['agent'] = $row['agent'];
				$data_insert['descripion'] = $row['descripion'];
				$data_insert['contact_fullname'] = $row['contact_fullname'];
				$data_insert['contact_email'] = $row['contact_email'];
				$data_insert['contact_phone'] = $row['contact_phone'];
				$data_insert['userid'] = $user_info['userid'];

				$id_new = $db->insert_id( $sql, 'id', $data_insert );
			}
			else
			{
				$id_new = $row['id'];
				$stmt = $db->prepare( 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_jobprovider SET title = :title, provinceid = :provinceid, address = :address, maps = :maps, taxcode = :taxcode, email = :email, fax = :fax, website = :website, image = :image, agent = :agent, descripion = :descripion, contact_fullname = :contact_fullname, contact_email = :contact_email, contact_phone = :contact_phone, userid = :userid WHERE id=' . $row['id'] );
				$stmt->bindParam( ':title', $row['title'], PDO::PARAM_STR );
				$stmt->bindParam( ':provinceid', $row['provinceid'], PDO::PARAM_INT );
				$stmt->bindParam( ':address', $row['address'], PDO::PARAM_STR );
				$stmt->bindParam( ':maps', $row['maps'], PDO::PARAM_STR );
				$stmt->bindParam( ':taxcode', $row['taxcode'], PDO::PARAM_STR );
				$stmt->bindParam( ':email', $row['email'], PDO::PARAM_STR );
				$stmt->bindParam( ':fax', $row['fax'], PDO::PARAM_STR );
				$stmt->bindParam( ':website', $row['website'], PDO::PARAM_STR );
				$stmt->bindParam( ':image', $fileupload, PDO::PARAM_STR );
				$stmt->bindParam( ':agent', $row['agent'], PDO::PARAM_INT );
				$stmt->bindParam( ':descripion', $row['descripion'], PDO::PARAM_STR, strlen($row['descripion']) );
				$stmt->bindParam( ':contact_fullname', $row['contact_fullname'], PDO::PARAM_STR );
				$stmt->bindParam( ':contact_email', $row['contact_email'], PDO::PARAM_STR );
				$stmt->bindParam( ':contact_phone', $row['contact_phone'], PDO::PARAM_STR );
				$stmt->bindParam( ':userid', $user_info['userid'], PDO::PARAM_INT );
				$exec = $stmt->execute();
			}

			if( $id_new > 0 or $exec )
			{
				
				if( $row['jobs'] != $row['jobs_old'] )
				{
					$sth = $db->prepare( 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_jobprovider_jobs (provider_id, jobs_id) VALUES( :provider_id, :jobs_id )' );
					foreach( $row['jobs'] as $jobs_id )
					{
						if( !in_array( $jobs_id, $row['jobs_old'] ) )
						{
							$sth->bindParam( ':provider_id', $id_new, PDO::PARAM_INT );
							$sth->bindParam( ':jobs_id', $jobs_id, PDO::PARAM_INT );
							$sth->execute();
						}
					}

					foreach( $row['jobs_old'] as $jobs_id_old )
					{
						if( !in_array( $jobs_id_old, $row['jobs'] ) )
						{
							$db->query( 'DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobprovider_jobs WHERE jobs_id = ' . $jobs_id_old . ' AND provider_id=' . $id_new );
						}
					}
				}

				// Them thanh vien vao nhom
				if( $id_new > 0 )
				{
					nv_add_groups( $array_config['group_jobprovider'], $user_info['userid'] );
				}

				$nv_Cache->delMod( $module_name );

				$url_back = nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $module_info['alias']['jobprovider'] . '/' . $row['alias'] . '-' . $row['id'], true );
				nv_theme_recruitment_alert( $lang_module['update_success_title'], $lang_module['jobprovider_content_succes'], 'info', $url_back );

				Header( 'Location: ' . nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $module_info['alias']['jobprovider-content'], true ) );
				die();
			}
		}
		catch( PDOException $e )
		{
			trigger_error( $e->getMessage() );
			die( $e->getMessage() ); //Remove this line after checks finished
		}
	}
}

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

if( defined( 'NV_EDITOR' ) and nv_function_exists( 'nv_aleditor' ) )
{
	$row['descripion'] = nv_aleditor( 'descripion', '100%', '300px', $row['descripion'], 'Basic' );
}
else
{
	$row['descripion'] = '<textarea style="width:100%;height:300px" name="descripion">' . $row['descripion'] . '</textarea>';
}

$is_uploaded = 0;
if( !empty( $row['image'] ) and file_exists( NV_UPLOADS_REAL_DIR . '/' . $module_upload . '/' . $image_folder . '/' . $row['image'] ) )
{
	$row['image'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $image_folder . '/' . $row['image'];
	$is_uploaded = 1;
}

$row['maps'] = !empty( $row['maps'] ) ? unserialize( $row['maps'] ) : array();

$xtpl = new XTemplate( $op . '.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'NV_LANG_VARIABLE', NV_LANG_VARIABLE );
$xtpl->assign( 'NV_LANG_DATA', NV_LANG_DATA );
$xtpl->assign( 'NV_NAME_VARIABLE', NV_NAME_VARIABLE );
$xtpl->assign( 'NV_OP_VARIABLE', NV_OP_VARIABLE );
$xtpl->assign( 'MODULE_NAME', $module_name );
$xtpl->assign( 'MODULE_UPLOAD', $module_upload );
$xtpl->assign( 'NV_ASSETS_DIR', NV_ASSETS_DIR );
$xtpl->assign( 'NV_LANG_INTERFACE', NV_LANG_INTERFACE );
$xtpl->assign( 'OP', $op );
$xtpl->assign( 'ROW', $row );

if( !empty( $array_jobs ) )
{
	foreach( $array_jobs as $jobs )
	{
		$jobs['checked'] = in_array( $jobs['id'], $row['jobs'] ) ? 'checked="checked"' : '';
		$xtpl->assign( 'JOBS', $jobs );
		$xtpl->parse( 'main.jobs' );
	}
}

if( $is_uploaded )
{
	$xtpl->parse( 'main.image' );
}

$allow_country = !empty( $allow_country ) ? implode( ',', $allow_country ) : '';
$countryid = nv_location_get_countryid_from_province( $row['provinceid'] );
$data_config = array(
	'select_countyid' => $countryid,
	'select_provinceid' => $row['provinceid'],
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

$page_title = $lang_module['jobprovider_info_update'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';