<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Tue, 11 Aug 2015 04:09:21 GMT
 */

if ( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );

if ( $nv_Request->isset_request( 'get_alias_title', 'post' ) )
{
	$alias = $nv_Request->get_title( 'get_alias_title', 'post', '' );
	$alias = change_alias( $alias );
	die( $alias );
}

if( $nv_Request->isset_request( 'get_user_json', 'post, get' ) )
{
	$q = $nv_Request->get_title( 'q', 'post, get', '' );

	$db->sqlreset()
		->select( 'userid, username, email, first_name, last_name' )
		->from( NV_USERS_GLOBALTABLE )
		->where( '( username LIKE :username OR email LIKE :email OR first_name like :first_name OR last_name like :last_name ) AND userid NOT IN (SELECT userid FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobprovider ) AND userid NOT IN (SELECT userid FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobseeker )' )
		->order( 'username ASC' )
		->limit( 20 );

	$sth = $db->prepare( $db->sql() );
	$sth->bindValue( ':username', '%' . $q . '%', PDO::PARAM_STR );
	$sth->bindValue( ':email', '%' . $q . '%', PDO::PARAM_STR );
	$sth->bindValue( ':first_name', '%' . $q . '%', PDO::PARAM_STR );
	$sth->bindValue( ':last_name', '%' . $q . '%', PDO::PARAM_STR );
	$sth->execute();

	$array_data = array();
	while( list( $userid, $username, $email, $first_name, $last_name ) = $sth->fetch( 3 ) )
	{
		$array_data[] = array( 'id' => $userid, 'username' => $username, 'fullname' => nv_show_name_user( $first_name, $last_name ) );
	}

	header( 'Cache-Control: no-cache, must-revalidate' );
	header( 'Content-type: application/json' );

	ob_start( 'ob_gzhandler' );
	echo json_encode( $array_data );
	exit();
}

$row = $error = array();
$row['id'] = $nv_Request->get_int( 'id', 'post,get', 0 );
$row['jobs_old'] = array();
$redirect = $nv_Request->get_title( 'redirect', 'get', '' );
$image_folder = 'jobprovider_images';

if( $row['id'] > 0 )
{
	$row = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobprovider WHERE id=' . $row['id'] )->fetch();
	if( empty( $row ) )
	{
		Header( 'Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op );
		die();
	}

	$row['jobs'] = array();
	$result = $db->query( 'SELECT jobs_id FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobprovider_jobs WHERE provider_id=' . $row['id'] );
	while( list( $jobs_id ) = $result->fetch( 3 ) )
	{
		$row['jobs'][] = $jobs_id;
	}
	$row['jobs_old'] = $row['jobs'];

	if( $row['userid'] > 0 )
	{
		$row['username'] = $db->query( 'SELECT username FROM ' . NV_USERS_GLOBALTABLE . ' WHERE userid=' . $row['userid'] )->fetchColumn();
	}

	$lang_module['jobprovider_add'] = $lang_module['jobprovider_edit'];
}
else
{
	$row['id'] = 0;
	$row['title'] = '';
	$row['alias'] = '';
	$row['jobs'] = array();
	$row['provinceid'] = 0;
	$row['districtid'] = 0;
	$row['wardid'] = 0;
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
	$row['userid'] = 0;
	$row['username'] = '';
	$row['status'] = 0;
	$row['maps'] = '';
	$row['taxcode'] = '';
}

if ( $nv_Request->isset_request( 'submit', 'post' ) )
{
	$row['title'] = $nv_Request->get_title( 'title', 'post', '' );
	$row['alias'] = $nv_Request->get_title( 'alias', 'post', '' );
	$row['alias'] = ( empty($row['alias'] ))? change_alias( $row['title'] ) : change_alias( $row['alias'] );
	$row['jobs'] = $nv_Request->get_typed_array( 'jobs', 'post', 'int', array() );
	$row['provinceid'] = $nv_Request->get_int( 'provinceid', 'post', 0 );
	$row['districtid'] = $nv_Request->get_int( 'districtid', 'post', 0 );
	$row['wardid'] = $nv_Request->get_int( 'wardid', 'post', 0 );
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
	$row['userid'] = $nv_Request->get_int( 'userid', 'post', 0 );

	$stmt = $db->prepare( 'SELECT COUNT(*) FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobprovider WHERE id !=' . $row['id'] . ' AND alias = :alias' );
	$stmt->bindParam( ':alias', $row['alias'], PDO::PARAM_STR );
	$stmt->execute();

	if( $stmt->fetchColumn() )
	{
		$weight = $db->query( 'SELECT MAX(id) FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows' )->fetchColumn();
		$weight = intval( $weight ) + 1;
		$row['alias'] = $row['alias'] . '-' . $weight;
	}

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
	elseif( empty( $row['userid'] ) )
	{
		$error[] = $lang_module['error_required_userid_jobprovider'];
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
			$upload_info = $upload->save_file( $_FILES['upload_fileupload'], NV_ROOTDIR . '/' . NV_TEMP_DIR, false );
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
				$sql = 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_jobprovider (title, alias, provinceid, districtid, wardid, address, maps, taxcode, email, fax, website, image, agent, descripion, contact_fullname, contact_email, contact_phone, userid, status) VALUES (:title, :alias, :provinceid, :districtid, :wardid, :address, :maps, :taxcode, :email, :fax, :website, :image, :agent, :descripion, :contact_fullname, :contact_email, :contact_phone, :userid, 1)';
				$data_insert = array();
				$data_insert['title'] = $row['title'];
				$data_insert['alias'] = $row['alias'];
				$data_insert['provinceid'] = $row['provinceid'];
				$data_insert['districtid'] = $row['districtid'];
				$data_insert['wardid'] = $row['wardid'];
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
				$data_insert['userid'] = $row['userid'];
				$id_new = $db->insert_id( $sql, 'id', $data_insert );
			}
			else
			{
				$id_new = $row['id'];
				$stmt = $db->prepare( 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_jobprovider SET title = :title, alias = :alias, provinceid = :provinceid, districtid = :districtid, wardid = :wardid, address = :address, maps = :maps, taxcode = :taxcode, email = :email, fax = :fax, website = :website, image = :image, agent = :agent, descripion = :descripion, contact_fullname = :contact_fullname, contact_email = :contact_email, contact_phone = :contact_phone, userid = :userid WHERE id=' . $row['id'] );
				$stmt->bindParam( ':title', $row['title'], PDO::PARAM_STR );
				$stmt->bindParam( ':alias', $row['alias'], PDO::PARAM_STR );
				$stmt->bindParam( ':provinceid', $row['provinceid'], PDO::PARAM_INT );
				$stmt->bindParam( ':districtid', $row['districtid'], PDO::PARAM_INT );
				$stmt->bindParam( ':wardid', $row['wardid'], PDO::PARAM_INT );
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
				$stmt->bindParam( ':userid', $row['userid'], PDO::PARAM_INT );
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
					nv_add_groups( $array_config['group_jobprovider'], $row['userid'], $admin_info['userid'] );
				}

				$nv_Cache->delMod( $module_name );

				if( !empty( $redirect ) )
				{
					$redirect = nv_redirect_decrypt( $redirect );
				}
				else
				{
					$redirect = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=jobprovider';
				}
				Header( 'Location: ' . $redirect );
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

if( defined( 'NV_EDITOR' ) ) require_once NV_ROOTDIR . '/' . NV_EDITORSDIR . '/' . NV_EDITOR . '/nv.php';
$row['descripion'] = htmlspecialchars( nv_editor_br2nl( $row['descripion'] ) );
if( defined( 'NV_EDITOR' ) and nv_function_exists( 'nv_aleditor' ) )
{
	$row['descripion'] = nv_aleditor( 'descripion', '100%', '300px', $row['descripion'] );
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
$xtpl->assign( 'ACTION', NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;id=' . $row['id'] . '&amp;redirect=' . $redirect );
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

if( empty( $row['id'] ) )
{
	$xtpl->parse( 'main.auto_get_alias' );
}

if( !empty( $row['username'] ) )
{
	$xtpl->parse( 'main.userid' );
}

if( $is_uploaded )
{
	$xtpl->parse( 'main.image' );
}

$allow_country = !empty( $allow_country ) ? implode( ',', $allow_country ) : '';
$allow_province = !empty( $allow_province ) ? implode( ',', $allow_province ) : '';
$allow_district = !empty( $allow_district ) ? implode( ',', $allow_district ) : '';
$allow_ward = !empty( $allow_ward ) ? implode( ',', $allow_ward ) : '';
$provinceid = !empty( $row['provinceid'] ) ?  $row['provinceid']  : 0;
$districtid = !empty( $row['districtid'] ) ?  $row['districtid'] : 0;
$wardid = !empty( $row['wardid'] ) ?  $row['wardid']  : 0;
$countryid = nv_location_get_countryid_from_province( $provinceid );

$data_config = array(
	'select_countyid' => $countryid,
	'select_provinceid' => $provinceid,
	'select_districtid' => $districtid,
	'select_wardid' => $wardid ,
	'allow_country' => $allow_country,
	'allow_province' => $allow_province,
	'allow_district' => $allow_district,
	'allow_ward' => $allow_ward,
	'is_district' => true,
	'is_ward' => true,
	'multiple_province' => false
);
$xtpl->assign( 'LOCATION', nv_location_build_input( $data_config ) );

if( ! empty( $error ) )
{
	$xtpl->assign( 'ERROR', implode( '<br />', $error ) );
	$xtpl->parse( 'main.error' );
}

$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

$page_title = $lang_module['jobprovider_add'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';