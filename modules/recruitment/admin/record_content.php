<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Thu, 25 Jun 2015 07:06:22 GMT
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
		->where( '( username LIKE :username OR email LIKE :email OR first_name like :first_name OR last_name like :last_name )' )
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
		// KIỂM TRA USERID NÀY CÓ TRONG BẢNG 
		$tontai = $db->query('SELECT id FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobseeker WHERE userid ='.$userid)->fetchColumn();
		if($tontai)
		$array_data[] = array( 'id' => $userid, 'username' => $username, 'fullname' => nv_show_name_user( $first_name, $last_name ) );
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
$image_folder = 'record_images';

if( $row['id'] > 0 )
{
	$row = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_record WHERE id=' . $row['id'] )->fetch();
	if( empty( $row ) )
	{
		Header( 'Location: ' . NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=record' );
		die();
	}

	
	$provinceid_old = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_record_wlocation WHERE record_id=' . $row['id'] .' ORDER BY id ASC' )->fetchAll();
	
	
}
else
{
	$row['id'] = 0;
	$row['title'] = '';
	$row['alias'] = '';
	$row['code'] = '';
	$row['jobs_id'] = '';
	$row['position_id'] = 0;
	$row['provinceid'] = array();
	$row['districtid'] = array();
	$row['wardid'] = array();
	$row['salary_to'] = 0;
	$row['salary_from'] = 0;
	$row['money_units'] = 0;
	$row['worktype_id'] = 0;
	$row['learning_id'] = 0;
	$row['graduate_school'] = '';
	$row['graduate_year'] = '';
	$row['degree'] = '';
	$row['foreign_language'] = '';
	$row['worked_company'] = '';
	$row['worked_work'] = '';
	$row['worked_position'] = '';
	$row['experience'] = 0;
	$row['target'] = '';
	$row['achievement'] = '';
	$row['skill'] = '';
	$row['contact_fullname'] = '';
	$row['contact_email'] = '';
	$row['contact_phone'] = '';
	$row['contact_image'] = '';
	$row['contact_more'] = '';
	$row['status'] = 1;
	$row['userid'] = 0;
}

if ( $nv_Request->isset_request( 'submit', 'post' ) )
{
	$row['code'] = $nv_Request->get_title( 'code', 'post', '' );
	$row['title'] = $nv_Request->get_title( 'title', 'post', '' );
	
	$row['alias'] = $nv_Request->get_title( 'alias', 'post', '' );
	$row['alias'] = ( empty($row['alias'] ))? change_alias( $row['title'] ) : change_alias( $row['alias'] );
	
	$row['jobs_id'] = $nv_Request->get_array( 'jobs_id', 'post', array() );
	$row['jobs_id'] = implode(',',$row['jobs_id']);
	
	$row['position_id'] = $nv_Request->get_int( 'position_id', 'post', 0 );
	
	$row['provinceid'] = $nv_Request->get_typed_array( 'province', 'post', 'int' );
	$row['districtid'] = $nv_Request->get_typed_array( 'district', 'post', 'int' );
	$row['wardid'] = $nv_Request->get_typed_array( 'wards', 'post', 'int' );
	
	
	$row['salary_from'] = $nv_Request->get_title( 'salary_from', 'post', '' );
	$row['salary_to'] = $nv_Request->get_title( 'salary_to', 'post', '' );
	$row['money_units'] = $nv_Request->get_int( 'money_units', 'post', 0 );
	$row['worktype_id'] = $nv_Request->get_int( 'worktype_id', 'post', 0 );
	$row['learning_id'] = $nv_Request->get_int( 'learning_id', 'post', 0 );
	$row['graduate_school'] = $nv_Request->get_title( 'graduate_school', 'post', '' );
	$row['graduate_year'] = $nv_Request->get_title( 'graduate_year', 'post', '' );
	$row['foreign_language'] = $nv_Request->get_textarea( 'foreign_language', '', 'br' );
	$row['degree'] = $nv_Request->get_textarea( 'degree', '', 'br' );
	$row['worked_company'] = $nv_Request->get_string( 'worked_company', 'post', '' );
	$row['worked_work'] = $nv_Request->get_string( 'worked_work', 'post', '' );
	$row['worked_position'] = $nv_Request->get_string( 'worked_position', 'post', '' );
	$row['experience'] = $nv_Request->get_int( 'experience', 'post', 0 );
	$row['target'] = $nv_Request->get_string( 'target', 'post', '' );
	$row['achievement'] = $nv_Request->get_string( 'achievement', 'post', '' );
	$row['skill'] = $nv_Request->get_string( 'skill', 'post', '' );
	$row['contact_fullname'] = $nv_Request->get_title( 'contact_fullname', 'post', '' );
	$row['contact_email'] = $nv_Request->get_title( 'contact_email', 'post', '' );
	$row['contact_phone'] = $nv_Request->get_title( 'contact_phone', 'post', '' );
	$row['contact_more'] = $nv_Request->get_textarea( 'contact_more', '', 'br' );
	$row['userid'] = $nv_Request->get_int( 'userid', 'post', 0 );

	if( $row['status'] == 2 )
	{
		$row['status'] = $nv_Request->get_int( 'status', 'post', 2 );
	}

	if( empty( $row['jobs_id'] ) )
	{
		$error[] = $lang_module['error_required_jobs_id'];
	}
	elseif( empty( $row['position_id'] ) )
	{
		$error[] = $lang_module['error_required_position_id'];
	}
	elseif( empty( $row['provinceid'] ) )
	{
		$error[] = $lang_module['error_required_work_location'];
	}
	elseif( empty( $row['userid'] ) )
	{
		$error[] = $lang_module['error_required_userid'];
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
	else
	{
		$fileupload = $row['contact_image'];
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
			$upload = new upload( $file_allowed_ext, $global_config['forbid_extensions'], $global_config['forbid_mimes'], $array_config['maxfilesize'], NV_MAX_WIDTH, NV_MAX_HEIGHT );
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
				$width = $array_config['record_size_width'] * 38; // 1cm=38px
				$height = $array_config['record_size_height'] * 38;
				$basename = basename( $fileupload );

                $_image = new image( $fileupload, NV_MAX_WIDTH, NV_MAX_HEIGHT );
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

		$jobseeker_info = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobseeker WHERE userid=' . $row['userid'] )->fetch();
		if( empty( $jobseeker_info ) )
		{
			$error[] = $lang_module['error_required_userid_jobprovider_no_exist'];
		}
	}

	if( empty( $error ) )
	{
		try
		{
			$exc = 0;
			if( empty( $row['id'] ) )
			{
				$sql = 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_record (title, alias, jobs_id, code, position_id, salary_from, salary_to, money_units, worktype_id, learning_id, graduate_school, graduate_year, degree, foreign_language, worked_company, worked_work, worked_position, experience, target, achievement, skill, contact_fullname, contact_email, contact_phone, contact_image, contact_more, jobseeker_id, userid, addtime, updatetime, status) VALUES (:title, :alias, :jobs_id, :code, :position_id, :salary_from, :salary_to, :money_units, :worktype_id, :learning_id, :graduate_school, :graduate_year, :degree, :foreign_language, :worked_company, :worked_work, :worked_position, :experience, :target, :achievement, :skill, :contact_fullname, :contact_email, :contact_phone, :contact_image, :contact_more, :jobseeker_id, :userid, '  . NV_CURRENTTIME . ', 0, :status )';
				$data_insert = array();
				$data_insert['jobseeker_id'] = $jobseeker_info['id'];
				$data_insert['userid'] = $row['userid'];
				$data_insert['title'] = $row['title'];
				$data_insert['alias'] = $row['alias'];
				$data_insert['jobs_id'] = $row['jobs_id'];
				$data_insert['code'] = $row['code'];
				$data_insert['position_id'] = $row['position_id'];
				$data_insert['salary_from'] = $row['salary_from'];
				$data_insert['salary_to'] = $row['salary_to'];
				$data_insert['money_units'] = $row['money_units'];
				$data_insert['worktype_id'] = $row['worktype_id'];
				$data_insert['learning_id'] = $row['learning_id'];
				$data_insert['graduate_school'] = $row['graduate_school'];
				$data_insert['graduate_year'] = $row['graduate_year'];
				$data_insert['degree'] = $row['degree'];
				$data_insert['foreign_language'] = $row['foreign_language'];
				$data_insert['worked_company'] = $row['worked_company'];
				$data_insert['worked_work'] = $row['worked_work'];
				$data_insert['worked_position'] = $row['worked_position'];
				$data_insert['experience'] = $row['experience'];
				$data_insert['target'] = $row['target'];
				$data_insert['achievement'] = $row['achievement'];
				$data_insert['skill'] = $row['skill'];
				$data_insert['contact_fullname'] = $row['contact_fullname'];
				$data_insert['contact_email'] = $row['contact_email'];
				$data_insert['contact_phone'] = $row['contact_phone'];
				$data_insert['contact_image'] = $fileupload;
				$data_insert['contact_more'] = $row['contact_more'];
				$data_insert['status'] = $row['status'];
				$insert_id = $db->insert_id( $sql, 'id', $data_insert );
			}
			else
			{
				$stmt = $db->prepare( 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_record SET title = :title, alias =:alias, jobs_id = :jobs_id, code = :code, position_id = :position_id, salary_from = :salary_from, salary_to = :salary_to, money_units = :money_units, worktype_id = :worktype_id, learning_id = :learning_id, graduate_school = :graduate_school, graduate_year = :graduate_year, degree = :degree, foreign_language = :foreign_language, worked_company = :worked_company, worked_work = :worked_work, worked_position = :worked_position, experience = :experience, target = :target, achievement = :achievement, skill = :skill, contact_fullname = :contact_fullname, contact_email = :contact_email, contact_phone = :contact_phone, contact_image = :contact_image, contact_more = :contact_more, updatetime = ' . NV_CURRENTTIME . ', status = :status WHERE id=' . $row['id'] );
				$stmt->bindParam( ':title', $row['title'], PDO::PARAM_STR );
				$stmt->bindParam( ':alias', $row['alias'], PDO::PARAM_STR );
				$stmt->bindParam( ':jobs_id', $row['jobs_id'], PDO::PARAM_STR );
				$stmt->bindParam( ':code', $row['code'], PDO::PARAM_STR );
				$stmt->bindParam( ':position_id', $row['position_id'], PDO::PARAM_INT );
				$stmt->bindParam( ':salary_from', $row['salary_from'], PDO::PARAM_STR );
				$stmt->bindParam( ':salary_to', $row['salary_to'], PDO::PARAM_STR );
				$stmt->bindParam( ':money_units', $row['money_units'], PDO::PARAM_STR );
				$stmt->bindParam( ':worktype_id', $row['worktype_id'], PDO::PARAM_INT );
				$stmt->bindParam( ':learning_id', $row['learning_id'], PDO::PARAM_INT );
				$stmt->bindParam( ':graduate_school', $row['graduate_school'], PDO::PARAM_STR );
				$stmt->bindParam( ':graduate_year', $row['graduate_year'], PDO::PARAM_STR );
				$stmt->bindParam( ':degree', $row['degree'], PDO::PARAM_STR, strlen($row['degree']) );
				$stmt->bindParam( ':foreign_language', $row['foreign_language'], PDO::PARAM_STR, strlen($row['foreign_language']) );
				$stmt->bindParam( ':worked_company', $row['worked_company'], PDO::PARAM_STR, strlen($row['worked_company']) );
				$stmt->bindParam( ':worked_work', $row['worked_work'], PDO::PARAM_STR, strlen($row['worked_work']) );
				$stmt->bindParam( ':worked_position', $row['worked_position'], PDO::PARAM_STR, strlen($row['worked_position']) );
				$stmt->bindParam( ':experience', $row['experience'], PDO::PARAM_INT );
				$stmt->bindParam( ':target', $row['target'], PDO::PARAM_STR, strlen($row['target']) );
				$stmt->bindParam( ':achievement', $row['achievement'], PDO::PARAM_STR, strlen($row['achievement']) );
				$stmt->bindParam( ':skill', $row['skill'], PDO::PARAM_STR, strlen($row['skill']) );
				$stmt->bindParam( ':contact_fullname', $row['contact_fullname'], PDO::PARAM_STR, strlen($row['contact_fullname']) );
				$stmt->bindParam( ':contact_email', $row['contact_email'], PDO::PARAM_STR, strlen($row['contact_email']) );
				$stmt->bindParam( ':contact_phone', $row['contact_phone'], PDO::PARAM_STR, strlen($row['contact_phone']) );
				$stmt->bindParam( ':contact_image', $fileupload, PDO::PARAM_STR, strlen($fileupload) );
				$stmt->bindParam( ':contact_more', $row['contact_more'], PDO::PARAM_STR, strlen($row['contact_more']) );
				$stmt->bindParam( ':status', $row['status'], PDO::PARAM_INT );
				$exc = $stmt->execute();
			}
			if( $exc or $insert_id > 0 )
			{
				// Cap nhat ma tin dang
				$auto_code = '';
				if( empty( $row['code'] ) )
				{
					$i = 1;
					$format_code = !empty( $array_config['record_code'] ) ? $array_config['record_code'] : 'HS%06s';
					$auto_code = vsprintf( $format_code, $insert_id );

					$stmt = $db->prepare( 'SELECT id FROM ' . NV_PREFIXLANG . '_' . $module_data . '_record WHERE code= :code' );
					$stmt->bindParam( ':code', $auto_code, PDO::PARAM_STR );
					$stmt->execute( );
					while( $stmt->rowCount( ) )
					{
						$auto_code = vsprintf( $format_code, ($insert_id + $i++) );
					}

					$stmt = $db->prepare( 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_record SET code= :code WHERE id=' . $insert_id );
					$stmt->bindParam( ':code', $auto_code, PDO::PARAM_STR );
					$stmt->execute( );
				}
				
				if(!$insert_id)
				$insert_id = $row['id'];
				
				// XÓA ĐI
				$delete = $db->query('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_record_wlocation WHERE record_id=' . $insert_id);
					
				//THÊM VÀO
				$i = 0;
				
				foreach($row['provinceid'] as $provinceid)
				{
					if($provinceid > 0)
					{
						$sth = $db->prepare( 'INSERT INTO  ' . NV_PREFIXLANG . '_' . $module_data . '_record_wlocation (record_id, location_id, provinceid, districtid, wardid) VALUES(' . $insert_id . ', 0, :provinceid, :districtid , :wardid )' );
						
						$sth->bindParam( ':provinceid', $provinceid, PDO::PARAM_INT );
						$sth->bindParam( ':districtid', $row['districtid'][$i], PDO::PARAM_INT );
						$sth->bindParam( ':wardid', $row['wardid'][$i], PDO::PARAM_INT );
						
						$sth->execute( );
					}
					
					$i++;
				
				}
				
				// Cap nhat lai so luong ho so o moi nganh nghe
				
				//$db->query( 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_jobs SET num_record=(SELECT COUNT(*) FROM ' . NV_PREFIXLANG . '_' . $module_data . '_record WHERE jobs_id=' . $row['jobs_id'] . ') WHERE id=' . $row['jobs_id'] );
				
				// XÓA record_id TRÊN BẢNG _record_jobs
				if( $insert_id > 0 )
				{
					$db->query( 'DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_record_jobs WHERE record_id=' . $insert_id );
					
					// THÊM LẠI DANH SÁCH record_id TRÊN BẢNG _record_jobs
					$array_job = explode(',',$row['jobs_id']);
					foreach($array_job as $job)
					{
						if($job > 0)
						{
							// insert vào bảng
							$db->query('INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data . '_record_jobs (record_id, jobs_id) value ('. $insert_id .', '. $job .') ');
						
						}
					}
				
				}
				
				

				$nv_Cache->delMod( $module_name );

				if( !empty( $redirect ) )
				{
					$redirect = nv_redirect_decrypt( $redirect );
				}
				else
				{
					$redirect = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=record';
				}
				Header( 'Location: ' . $redirect );
				die( );
			}
		}
		catch( PDOException $e )
		{
			trigger_error( $e->getMessage() );
			die( $e->getMessage() ); //Remove this line after checks finished
		}
	}
}

$row['salary_from'] = !empty( $row['salary_from'] ) ? $row['salary_from'] : '';
$row['salary_to'] = !empty( $row['salary_to'] ) ? $row['salary_to'] : '';
$row['ck_record_acept'] = $row['status'] == 2 ? 'checked="checked"' : '';

$is_uploaded = 0;
if( !empty( $row['contact_image'] ) and file_exists( NV_UPLOADS_REAL_DIR . '/' . $module_upload . '/' . $image_folder . '/' . $row['contact_image'] ) )
{
	$row['contact_image'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/' . $image_folder . '/' . $row['contact_image'];
	$is_uploaded = 1;
}

if( $row['userid'] > 0 )
{
	$row['username'] = $db->query( 'SELECT username FROM ' . NV_USERS_GLOBALTABLE . ' WHERE userid=' . $row['userid'] )->fetchColumn();
}

$xtpl = new XTemplate( $op . '.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'NV_LANG_VARIABLE', NV_LANG_VARIABLE );
$xtpl->assign( 'NV_LANG_DATA', NV_LANG_DATA );
$xtpl->assign( 'NV_BASE_ADMINURL', NV_BASE_ADMINURL );
$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
$xtpl->assign( 'NV_NAME_VARIABLE', NV_NAME_VARIABLE );
$xtpl->assign( 'NV_OP_VARIABLE', NV_OP_VARIABLE );
$xtpl->assign( 'MODULE_NAME', $module_name );
$xtpl->assign( 'MODULE_UPLOAD', $module_upload );
$xtpl->assign( 'NV_ASSETS_DIR', NV_ASSETS_DIR );
$xtpl->assign( 'NV_LANG_INTERFACE', NV_LANG_INTERFACE );
$xtpl->assign( 'OP', $op );
$xtpl->assign( 'ROW', $row );
$xtpl->assign( 'ACTION', NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op . '&amp;id=' . $row['id'] . '&amp;redirect=' . $redirect );


$array_job = explode(',',$row['jobs_id']);
foreach( $array_jobs as $value )
{
	$xtpl->assign( 'OPTION', array(
		'key' => $value['id'],
		'title' => $value['title'],
		'selected' => (in_array($value['id'],$array_job)) ? 'selected="selected"' : ''
	) );
	$xtpl->parse( 'main.select_jobs_id' );
}

foreach( $array_position as $value )
{
	$xtpl->assign( 'OPTION', array(
		'key' => $value['id'],
		'title' => $value['title'],
		'selected' => ($value['id'] == $row['position_id']) ? ' selected="selected"' : ''
	) );
	$xtpl->parse( 'main.select_position_id' );
}

foreach( $array_worktype as $value )
{
	$xtpl->assign( 'OPTION', array(
		'key' => $value['id'],
		'title' => $value['title'],
		'selected' => ($value['id'] == $row['worktype_id']) ? ' selected="selected"' : ''
	) );
	$xtpl->parse( 'main.select_worktype_id' );
}

/*
$allow_country = !empty( $allow_country ) ? implode( ',', $allow_country ) : '';
$provinceid = !empty( $row['provinceid'] ) ? end( $row['provinceid'] ) : 0;
$allow_province = !empty( $allow_province ) ? implode( ',', $allow_province ) : '';
$allow_district = !empty( $allow_district ) ? implode( ',', $allow_district ) : '';
$allow_ward = !empty( $allow_ward ) ? implode( ',', $allow_ward ) : '';
$provinceid = !empty( $row['provinceid'] ) ? end( $row['provinceid'] ) : 0;
$districtid = !empty( $row['districtid'] ) ? end( $row['districtid'] ) : 0;
$wardid = !empty( $row['wardid'] ) ? end( $row['wardid'] ) : 0;
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

*/


//print_r($ward_old);die;
	// LẤY DANH SÁCH 
	$i = 0;
	if(empty($provinceid_old))
		$provinceid_old['provinceid'] = 0;
		
	foreach($provinceid_old as $province)
	{
		// LẤY TỈNH THÀNH RA
		$list_tinhthanh = $db->query('SELECT provinceid, title, type FROM ' . $db_config['prefix'] . '_location_province WHERE status = 1 ORDER BY weight ASC')->fetchAll();
		
		foreach($list_tinhthanh as $tinhthanh)
		{
			if($tinhthanh['provinceid'] == $province['provinceid'])
			{
			$tinhthanh['selected'] = 'selected=selected';
			}
			else $tinhthanh['selected'] = '';
			$xtpl->assign('l', $tinhthanh);
			$xtpl->parse('main.address.tinh');
		}
		
		// LẤY QUẬN HUYỆN RA
		if($province['provinceid'] > 0)
		{
		$list_quan = $db->query('SELECT districtid, title, type FROM ' . $db_config['prefix'] . '_location_district WHERE provinceid = '. $province['provinceid'] .' and status = 1 ORDER BY weight DESC')->fetchAll();
		
		foreach($list_quan as $tinhthanh)
		{	
			if($tinhthanh['districtid'] == $province['districtid'])
			{
			$tinhthanh['selected'] = 'selected=selected';
			}
			else $tinhthanh['selected'] = '';
			$xtpl->assign('l', $tinhthanh);
			$xtpl->parse('main.address.quan');
		}
		
		}
		// LẤY XÃ PHƯỜNG RA
		
		if($province['districtid'] > 0)
		{
		$list_xaphuong = $db->query('SELECT wardid, title ,type FROM ' . $db_config['prefix'] . '_location_ward WHERE districtid = '. $province['districtid'] .' and status = 1')->fetchAll();
		$mang_wardid = explode(',',$row['wards']);
		foreach($list_xaphuong as $tinhthanh)
		{
			if($tinhthanh['wardid'] == $province['wardid'])
			{
			$tinhthanh['selected'] = 'selected=selected';
			}
			else $tinhthanh['selected'] = '';
			$xtpl->assign('l', $tinhthanh);
			$xtpl->parse('main.address.xa');
		}
		
		}
		
		if($i != 0)
		$xtpl->parse('main.address.delete');
		
		$i++;
		$xtpl->parse('main.address');
		
}

if( !empty( $array_money_units ) )
{
	foreach( $array_money_units as $money_units )
	{//print_r($money_units );die;
		$money_units['selected'] = $money_units['id'] == $row['money_units'] ? 'selected="selected"' : '';
		$xtpl->assign( 'MONEY_UNITS', $money_units );
		$xtpl->parse( 'main.money_units' );
	}
}

if( !empty( $array_learning ) )
{
	foreach( $array_learning as $learning )
	{
		$learning['selected'] = $learning['id'] == $row['learning_id'] ? 'selected="selected"' : '';
		$xtpl->assign( 'LEARNING', $learning );
		$xtpl->parse( 'main.learning' );
	}
}

if( !empty( $row['username'] ) )
{
	$xtpl->parse( 'main.userid' );
}

if( $row['status'] == 2 )
{
	$xtpl->parse( 'main.record_acept' );
}

if( $is_uploaded )
{
	$xtpl->parse( 'main.contact_image' );
}

if( ! empty( $error ) )
{
	$xtpl->assign( 'ERROR', implode( '<br />', $error ) );
	$xtpl->parse( 'main.error' );
}

$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

$page_title = $lang_module['record_add'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';