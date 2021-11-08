<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sat, 20 Jun 2015 07:14:33 GMT
 */

if( !defined( 'NV_IS_MOD_RECRUITMENT' ) ) die( 'Stop!!!' );

$table_name = NV_PREFIXLANG . '_' . $module_data;
$row = array( );
$province_old = array( );
$error = array( );
$row['id'] = 0;
$jobprovider_id = 0;
if( sizeof( $array_op ) == 2 and !empty( $array_op[1] ) )
{
	$row['id'] = $array_op[1];
}

if( !defined( 'NV_IS_USER' ) )
{
	$url_redirect = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $module_info['alias']['content'];
	Header( 'Location: ' . NV_BASE_SITEURL . 'index.php?' . NV_NAME_VARIABLE . '=users&' . NV_OP_VARIABLE . '=login&nv_redirect=' . nv_redirect_encrypt( $url_redirect ) );
	die( );
}

$jobprovider_info = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobprovider WHERE userid=' . $user_info['userid'] )->fetch();
if( empty( $jobprovider_info ) )
{
	Header( 'Location: ' . nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name, true ) );
	die( );
}

if( $row['id'] > 0 )
{
	$row = $db->query( 'SELECT * FROM ' . $table_name . '_rows WHERE id=' . $row['id'] )->fetch( );
	if( empty( $row ) )
	{
		Header( 'Location: ' . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $op );
		die( );
	}
	

	$row['provinceid'] = array( );
	$row['districtid'] = array( );
	$row['wardid'] = array( );
	$result = $db->query( 'SELECT province_id FROM ' . $table_name . '_rows_province WHERE rows_id=' . $row['id'] );
	if( $result )
	{
		while( list( $provinceid ) = $result->fetch( 3 ) )
		{
			$row['provinceid'][] = $provinceid;
			$province_old[] = $provinceid;
		}
	}
	
	
	$result = $db->query( 'SELECT district_id FROM ' . $table_name . '_rows_district WHERE rows_id=' . $row['id'] );
	if( $result )
	{
		while( list( $districtid ) = $result->fetch( 3 ) )
		{
			$row['districtid'][] = $districtid;
			$district_old[] = $districtid;
		}
	}
	$result = $db->query( 'SELECT ward_id FROM ' . $table_name . '_rows_ward WHERE rows_id=' . $row['id'] );
	if( $result )
	{
		while( list( $wardid ) = $result->fetch( 3 ) )
		{
			$row['wardid'][] = $wardid;
			$ward_old[] = $wardid;
		}
	}
	
	
}
else
{
	$row['id'] = 0;
	$row['title'] = '';
	$row['alias'] = '';
	$row['address'] = '';
	$row['code'] = '';
	$row['position_id'] = 0;
	$row['jobs_id'] = 0;
	$row['worktype_id'] = 0;
	$row['provinceid'] = array( );
	$row['districtid'] = array( );
	$row['wardid'] = array( );
	$row['salary_from'] = 0;
	$row['salary_to'] = 0;
	$row['money_units'] = 0;
	$row['experience'] = 0;
	$row['degree'] = '';
	$row['gender'] = 1;
	$row['age'] = '';
	$row['quantity'] = '';
	$row['job_description'] = '';
	$row['more_requirement'] = '';
	$row['interest'] = '';
	$row['document_id'] = '';
	$row['document_exp'] = 0;
	$row['document_type_id'] = 0;
	$row['contact_fullname'] = $jobprovider_info['contact_fullname'];
	$row['contact_email'] = $jobprovider_info['contact_email'];
	$row['contact_phone'] = $jobprovider_info['contact_phone'];
}

if( $nv_Request->isset_request( 'submit', 'post' ) )
{
	$row['title'] = $nv_Request->get_title( 'title', 'post', '' );
	$row['address'] = $nv_Request->get_title( 'address', 'post', '' );
	$row['alias'] = $nv_Request->get_title( 'alias', 'post', '' );
	$row['alias'] = ( empty( $row['alias'] )) ? change_alias( $row['title'] ) : change_alias( $row['alias'] );
	$row['position_id'] = $nv_Request->get_int( 'position_id', 'post', 0 );
	
	$row['jobs_id'] = $nv_Request->get_array( 'jobs_id', 'post', array() );
	$row['jobs_id'] = implode(',',$row['jobs_id']);
	
	$row['worktype_id'] = $nv_Request->get_int( 'worktype_id', 'post', 0 );
	
	$row['provinceid'] = $nv_Request->get_typed_array( 'province', 'post', 'int' );
	$row['districtid'] = $nv_Request->get_typed_array( 'district', 'post', 'int' );
	$row['wardid'] = $nv_Request->get_typed_array( 'wards', 'post', 'int' );
	
	$row['salary_from'] = $nv_Request->get_title( 'salary_from', 'post', '' );
	$row['salary_to'] = $nv_Request->get_title( 'salary_to', 'post', '' );
	$row['money_units'] = $nv_Request->get_int( 'money_units', 'post', 0 );
	$row['experience'] = $nv_Request->get_title( 'experience', 'post', '' );
	$row['degree'] = $nv_Request->get_textarea( 'degree', '', NV_ALLOWED_HTML_TAGS );
	$row['gender'] = $nv_Request->get_int( 'gender', 'post', 0 );
	$row['age'] = $nv_Request->get_title( 'age', 'post', '' );
	$row['quantity'] = $nv_Request->get_int( 'quantity', 'post', 0 );
	$row['job_description'] = $nv_Request->get_editor( 'job_description', '', NV_ALLOWED_HTML_TAGS );
	$row['more_requirement'] = $nv_Request->get_textarea( 'more_requirement', '', NV_ALLOWED_HTML_TAGS );
	$row['interests'] = $nv_Request->get_textarea( 'interests', '', NV_ALLOWED_HTML_TAGS );

	$_document_id = $nv_Request->get_array( 'document_id', 'post' );
	$row['document_id'] = !empty( $_document_id ) ? implode( ',', $_document_id ) : '';

	$_document_type_id = $nv_Request->get_array( 'document_type_id', 'post' );
	$row['document_type_id'] = !empty( $_document_type_id ) ? implode( ',', $_document_type_id ) : '';

	$row['contact_fullname'] = $nv_Request->get_string( 'contact_fullname', 'post', '' );
	$row['contact_email'] = $nv_Request->get_string( 'contact_email', 'post', '' );
	$row['contact_phone'] = $nv_Request->get_string( 'contact_phone', 'post', '' );

	if( preg_match( '/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/', $nv_Request->get_string( 'document_exp', 'post' ), $m ) )
	{
		$row['document_exp'] = mktime( 23, 59, 59, $m[2], $m[1], $m[3] );
	}
	else
	{
		$row['document_exp'] = 0;
	}

	if( empty( $row['title'] ) )
	{
		$error[] = $lang_module['error_required_title'];
	}
	elseif( empty( $row['position_id'] ) )
	{
		$error[] = $lang_module['error_required_position_id'];
	}
	elseif( empty( $row['jobs_id'] ) )
	{
		$error[] = $lang_module['error_required_jobs'];
	}
	elseif( empty( $row['worktype_id'] ) )
	{
		$error[] = $lang_module['error_required_worktype_id'];
	}
	elseif( empty( $row['provinceid'] ) )
	{
		$error[] = $lang_module['error_required_province_id'];
	}
	elseif( empty( $row['job_description'] ) )
	{
		$error[] = $lang_module['error_required_job_description'];
	}
	elseif( $row['quantity'] != '' AND $row['quantity'] <= 0 )
	{
		$error[] = $lang_module['error_required_quantity'];
	}
	if( empty( $error ) )
	{
		$exc = false;
		try
		{
			if( empty( $row['id'] ) )
			{
				$status = $array_config['post_queue'] ? 2 : 1;
				$sql = 'INSERT INTO ' . $table_name . '_rows (jobprovider_id, title, alias, address, position_id, jobs_id, worktype_id, salary_from, salary_to, money_units, experience, degree, gender, age, quantity, job_description, more_requirement, interests, document_id, document_exp, document_type_id, contact_fullname, contact_email, contact_phone, adduser, addtime, edittime, status) VALUES (:jobprovider_id, :title, :alias, :address, :position_id, :jobs_id, :worktype_id, :salary_from, :salary_to, :money_units, :experience, :degree, :gender, :age, :quantity, :job_description, :more_requirement, :interests, :document_id, :document_exp, :document_type_id, :contact_fullname, :contact_email, :contact_phone, :adduser, :addtime, :edittime, ' . $status . ')';
				$data_insert = array( );
				$data_insert['jobprovider_id'] = $jobprovider_info['id'];
				$data_insert['title'] = $row['title'];
				$data_insert['alias'] = $row['alias'];
				$data_insert['address'] = $row['address'];
				$data_insert['position_id'] = $row['position_id'];
				$data_insert['jobs_id'] = $row['jobs_id'];
				$data_insert['worktype_id'] = $row['worktype_id'];
				$data_insert['salary_from'] = $row['salary_from'];
				$data_insert['salary_to'] = $row['salary_to'];
				$data_insert['money_units'] = $row['money_units'];
				$data_insert['experience'] = $row['experience'];
				$data_insert['degree'] = $row['degree'];
				$data_insert['gender'] = $row['gender'];
				$data_insert['age'] = $row['age'];
				$data_insert['quantity'] = $row['quantity'];
				$data_insert['job_description'] = $row['job_description'];
				$data_insert['more_requirement'] = $row['more_requirement'];
				$data_insert['interests'] = $row['interests'];
				$data_insert['document_id'] = $row['document_id'];
				$data_insert['document_exp'] = $row['document_exp'];
				$data_insert['document_type_id'] = $row['document_type_id'];
				$data_insert['contact_fullname'] = $row['contact_fullname'];
				$data_insert['contact_email'] = $row['contact_email'];
				$data_insert['contact_phone'] = $row['contact_phone'];
				$data_insert['adduser'] = $user_info['userid'];
				$data_insert['addtime'] = NV_CURRENTTIME;
				$data_insert['edittime'] = 0;
				$new_id = $db->insert_id( $sql, 'id', $data_insert );
			}
			else
			{
				$new_id = $row['id'];
				$stmt = $db->prepare( 'UPDATE ' . $table_name . '_rows SET title = :title, alias = :alias, address =:address, position_id = :position_id, jobs_id = :jobs_id, worktype_id = :worktype_id, salary_from = :salary_from, salary_to = :salary_to, money_units = :money_units, experience = :experience, degree = :degree, gender = :gender, age = :age, quantity = :quantity, job_description = :job_description, more_requirement = :more_requirement, interests = :interests, document_id = :document_id, document_exp = :document_exp, document_type_id = :document_type_id, contact_fullname = :contact_fullname, contact_email = :contact_email, contact_phone = :contact_phone, edittime = ' . NV_CURRENTTIME . ' WHERE id=' . $row['id'] );
				$stmt->bindParam( ':title', $row['title'], PDO::PARAM_STR );
				$stmt->bindParam( ':alias', $row['alias'], PDO::PARAM_STR );
				$stmt->bindParam( ':address', $row['address'], PDO::PARAM_STR );
				$stmt->bindParam( ':position_id', $row['position_id'], PDO::PARAM_INT );
				$stmt->bindParam( ':jobs_id', $row['jobs_id'], PDO::PARAM_STR );
				$stmt->bindParam( ':worktype_id', $row['worktype_id'], PDO::PARAM_INT );
				$stmt->bindParam( ':salary_from', $row['salary_from'], PDO::PARAM_STR );
				$stmt->bindParam( ':salary_to', $row['salary_to'], PDO::PARAM_STR );
				$stmt->bindParam( ':money_units', $row['money_units'], PDO::PARAM_INT );
				$stmt->bindParam( ':experience', $row['experience'], PDO::PARAM_STR );
				$stmt->bindParam( ':degree', $row['degree'], PDO::PARAM_STR, strlen( $row['degree'] ) );
				$stmt->bindParam( ':gender', $row['gender'], PDO::PARAM_INT );
				$stmt->bindParam( ':age', $row['age'], PDO::PARAM_STR );
				$stmt->bindParam( ':quantity', $row['quantity'], PDO::PARAM_INT );
				$stmt->bindParam( ':job_description', $row['job_description'], PDO::PARAM_STR, strlen( $row['job_description'] ) );
				$stmt->bindParam( ':more_requirement', $row['more_requirement'], PDO::PARAM_STR, strlen( $row['more_requirement'] ) );
				$stmt->bindParam( ':interests', $row['interests'], PDO::PARAM_STR, strlen( $row['interests'] ) );
				$stmt->bindParam( ':document_id', $row['document_id'], PDO::PARAM_STR );
				$stmt->bindParam( ':document_exp', $row['document_exp'], PDO::PARAM_INT );
				$stmt->bindParam( ':document_type_id', $row['document_type_id'], PDO::PARAM_INT );
				$stmt->bindParam( ':contact_fullname', $row['contact_fullname'], PDO::PARAM_STR, strlen( $row['contact_fullname'] ) );
				$stmt->bindParam( ':contact_email', $row['contact_email'], PDO::PARAM_STR, strlen( $row['contact_email'] ) );
				$stmt->bindParam( ':contact_phone', $row['contact_phone'], PDO::PARAM_STR, strlen( $row['contact_phone'] ) );
				$exc = $stmt->execute( );
			}

			if( $exc or $new_id > 0 )
			{
				// Cap nhat dia diem
				$province = $row['provinceid'];
				if( $province != $province_old )
				{
					$sth = $db->prepare( 'INSERT INTO ' . $table_name . '_rows_province VALUES( ' . $new_id . ', :provinceid )' );
					foreach( $province as $provinceid )
					{
						if( !in_array( $provinceid, $province_old ) )
						{
							$sth->bindParam( ':provinceid', $provinceid, PDO::PARAM_STR );
							$sth->execute( );
						}
					}

					$sth = $db->prepare( 'DELETE FROM ' . $table_name . '_rows_province WHERE province_id=:provinceid' );
					foreach( $province_old as $province_old_id )
					{
						if( !in_array( $province_old_id, $province ) )
						{
							$sth->bindParam( ':provinceid', $province_old_id, PDO::PARAM_STR );
							$sth->execute( );
						}
					}
				}
				
				
				// Cap nhat dia diem
				$district = $row['districtid'];
				if( $district != $district_old )
				{
					$sth = $db->prepare( 'INSERT INTO ' . $table_name . '_rows_district VALUES( ' . $new_id . ', :districtid )' );
					foreach( $district as $districtid )
					{
						if( !in_array( $districtid, $district_old ) )
						{
							$sth->bindParam( ':districtid', $districtid, PDO::PARAM_STR );
							$sth->execute( );
						}
					}

					$sth = $db->prepare( 'DELETE FROM ' . $table_name . '_rows_district WHERE district_id=:districtid' );
					foreach( $district_old as $district_old_id )
					{
						if( !in_array( $district_old_id, $district ) )
						{
							$sth->bindParam( ':districtid', $district_old_id, PDO::PARAM_STR );
							$sth->execute( );
						}
					}
				}
				// Cap nhat dia diem
				$ward = $row['wardid'];
				if( $ward != $ward_old )
				{
					$sth = $db->prepare( 'INSERT INTO ' . $table_name . '_rows_ward VALUES( ' . $new_id . ', :wardid )' );
					foreach( $ward as $wardid )
					{
						if( !in_array( $wardid, $ward_old ) )
						{
							$sth->bindParam( ':wardid', $wardid, PDO::PARAM_STR );
							$sth->execute( );
						}
					}

					$sth = $db->prepare( 'DELETE FROM ' . $table_name . '_rows_ward WHERE ward_id=:wardid' );
					foreach( $ward_old as $ward_old_id )
					{
						if( !in_array( $ward_old_id, $ward ) )
						{
							$sth->bindParam( ':wardid', $ward_old_id, PDO::PARAM_STR );
							$sth->execute( );
						}
					}
				}
				
				

				// Cap nhat lai so luong ban tin tuyen dung o moi nganh nghe
				//$db->query( 'UPDATE ' . $table_name . '_jobs SET num_post=(SELECT COUNT(*) FROM ' . $table_name . '_rows WHERE jobs_id=' . $row['jobs_id'] . ') WHERE id=' . $row['jobs_id'] );
				
				
				// XÓA record_id TRÊN BẢNG _job_jobs
				if( $new_id > 0 )
				{
					$db->query( 'DELETE FROM ' . $table_name . '_job_jobs WHERE job_id=' . $new_id );
					
					// THÊM LẠI DANH SÁCH record_id TRÊN BẢNG _job_jobs
					$array_job = explode(',',$row['jobs_id']);
					foreach($array_job as $job)
					{
						if($job > 0)
						{
							// insert vào bảng
							$db->query('INSERT INTO ' . $table_name . '_job_jobs (job_id, jobs_id) value ('. $new_id .', '. $job .') ');
						
						}
					}
				
				}
				

				// Cap nhat ma tin dang
				if( $new_id > 0 )
				{
					$auto_code = '';
					if( empty( $row['code'] ) )
					{
						$i = 1;
						$format_code = !empty( $array_config['post_code'] ) ? $array_config['post_code'] : 'TD%06s';
						$auto_code = vsprintf( $format_code, $new_id );

						$stmt = $db->prepare( 'SELECT id FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows WHERE code= :code' );
						$stmt->bindParam( ':code', $auto_code, PDO::PARAM_STR );
						$stmt->execute( );
						while( $stmt->rowCount( ) )
						{
							$auto_code = vsprintf( $format_code, ($new_id + $i++) );
						}

						$stmt = $db->prepare( 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_rows SET code= :code WHERE id=' . $new_id );
						$stmt->bindParam( ':code', $auto_code, PDO::PARAM_STR );
						$stmt->execute( );
					}
				}

				$nv_Cache->delMod( $module_name );

				$lang_content = '';
				$url_back = nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $module_info['alias']['list-post'], true );
				if( empty( $row['id'] ) )
				{
					$lang_title = $lang_module['post_send_success'];
					$lang_content = $array_config['post_queue'] ? $lang_module['post_send_success_queue'] : $lang_module['post_send_success_ok'];
				}
				else
				{
					$lang_title = $lang_module['post_update_success'];
				}
				nv_theme_recruitment_alert( $lang_title, $lang_content, 'info', $url_back );
				die();
			}
		}
		catch( PDOException $e )
		{
			trigger_error( $e->getMessage( ) );
			die( $e->getMessage( ) );
			//Remove this line after checks finished
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

$row['job_description'] = htmlspecialchars( nv_editor_br2nl( $row['job_description'] ) );

if( defined( 'NV_EDITOR' ) and nv_function_exists( 'nv_aleditor' ) )
{
	$row['job_description'] = nv_aleditor( 'job_description', '100%', '300px', $row['job_description'], 'Basic' );
}
else
{
	$row['job_description'] = '<textarea style="width:100%;height:300px" name="job_description">' . $row['job_description'] . '</textarea>';
}

$row['salary_from'] = !empty( $row['salary_from'] ) ? $row['salary_from'] : '';
$row['salary_to'] = !empty( $row['salary_to'] ) ? $row['salary_to'] : '';
$row['experience'] = !empty( $row['experience'] ) ? $row['experience'] : '';
$row['age'] = !empty( $row['age'] ) ? $row['age'] : '';
$row['quantity'] = !empty( $row['quantity'] ) ? $row['quantity'] : '';
$row['document_exp'] = !empty( $row['document_exp'] ) ? nv_date( 'd/m/Y', $row['document_exp'] ) : '';

$xtpl = new XTemplate( $op . '.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'NV_LANG_VARIABLE', NV_LANG_VARIABLE );
$xtpl->assign( 'NV_LANG_INTERFACE', NV_LANG_INTERFACE );
$xtpl->assign( 'NV_LANG_DATA', NV_LANG_DATA );
$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
$xtpl->assign( 'NV_NAME_VARIABLE', NV_NAME_VARIABLE );
$xtpl->assign( 'NV_OP_VARIABLE', NV_OP_VARIABLE );
$xtpl->assign( 'MODULE_NAME', $module_name );
$xtpl->assign( 'MODULE_UPLOAD', $module_upload );
$xtpl->assign( 'NV_ASSETS_DIR', NV_ASSETS_DIR );
$xtpl->assign( 'OP', $op );
$xtpl->assign( 'ROW', $row );

$i = 0;
foreach( $array_position as $key => $value )
{
	$xtpl->assign( 'OPTION', array(
		'key' => $value['id'],
		'title' => $value['title'],
		'checked' => ($value['id'] == $row['position_id'] OR $i == 0) ? ' checked="checked"' : ''
	) );
	$xtpl->parse( 'main.radio_position_id' );
	$i++;
}

$array_job = explode(',',$row['jobs_id']);
foreach( $array_jobs as $key => $value )
{
	$xtpl->assign( 'OPTION', array(
		'key' => $value['id'],
		'title' => $value['title'],
		'selected' => (in_array($value['id'],$array_job)) ? 'selected="selected"' : ''
	) );
	$xtpl->parse( 'main.select_jobs' );
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

$row['document_id'] = !empty( $row['document_id'] ) ? explode( ',', $row['document_id'] ) : array( );
foreach( $array_document as $key => $value )
{
	$xtpl->assign( 'OPTION', array(
		'key' => $value['id'],
		'title' => $value['title'],
		'checked' => in_array( $value['id'], $row['document_id'] ) ? ' checked="checked"' : ''
	) );
	$xtpl->parse( 'main.checkbox_document_id' );
}

$row['document_type_id'] = !empty( $row['document_type_id'] ) ? explode( ',', $row['document_type_id'] ) : array( );
foreach( $array_document_type as $key => $value )
{
	$xtpl->assign( 'OPTION', array(
		'key' => $value['id'],
		'title' => $value['title'],
		'checked' => in_array( $value['id'], $row['document_type_id'] ) ? ' checked="checked"' : ''
	) );
	$xtpl->parse( 'main.radio_document_type_id' );
}

foreach( $array_gender as $key => $title )
{
	$xtpl->assign( 'OPTION', array(
		'key' => $key,
		'title' => $title,
		'checked' => ($key == $row['gender']) ? ' checked="checked"' : ''
	) );
	$xtpl->parse( 'main.radio_gender' );
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

/*
$allow_country = !empty( $allow_country ) ? implode( ',', $allow_country ) : '';
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

//print_r($data_config);die;

$xtpl->assign( 'LOCATION', nv_location_build_input( $data_config ) );

*/


//print_r($ward_old);die;
	// LẤY DANH SÁCH 
	$i = 0;
	if(empty($province_old))
		$province_old[0] = 0;
		
	foreach($province_old as $province)
	{
		// LẤY TỈNH THÀNH RA
		$list_tinhthanh = $db->query('SELECT provinceid, title, type FROM ' . $db_config['prefix'] . '_location_province WHERE status = 1 ORDER BY weight ASC')->fetchAll();
		
		foreach($list_tinhthanh as $tinhthanh)
		{
			if($tinhthanh['provinceid'] == $province)
			{
			$tinhthanh['selected'] = 'selected=selected';
			}
			else $tinhthanh['selected'] = '';
			$xtpl->assign('l', $tinhthanh);
			$xtpl->parse('main.address.tinh');
		}
		
		// LẤY QUẬN HUYỆN RA
		if($province > 0)
		{
		$list_quan = $db->query('SELECT districtid, title, type FROM ' . $db_config['prefix'] . '_location_district WHERE provinceid = '. $province .' and status = 1 ORDER BY weight DESC')->fetchAll();
		
		foreach($list_quan as $tinhthanh)
		{	
			if($tinhthanh['districtid'] == $district_old[$i])
			{
			$tinhthanh['selected'] = 'selected=selected';
			}
			else $tinhthanh['selected'] = '';
			$xtpl->assign('l', $tinhthanh);
			$xtpl->parse('main.address.quan');
		}
		
		}
		// LẤY XÃ PHƯỜNG RA
		
		if(isset($district_old[$i]))
		{
		$list_xaphuong = $db->query('SELECT wardid, title ,type FROM ' . $db_config['prefix'] . '_location_ward WHERE districtid = '. $district_old[$i] .' and status = 1')->fetchAll();
		
		foreach($list_xaphuong as $tinhthanh)
		{
			if(isset($ward_old[$i]))
			{
				if($tinhthanh['wardid'] == $ward_old[$i])
				{
				$tinhthanh['selected'] = 'selected=selected';
				}
				else $tinhthanh['selected'] = '';
			}
			$xtpl->assign('l', $tinhthanh);
			$xtpl->parse('main.address.xa');
		}
		
		}
		
		if($i != 0)
		$xtpl->parse('main.address.delete');
		
		$i++;
		$xtpl->parse('main.address');
		
	}

if( !empty( $error ) )
{
	$xtpl->assign( 'ERROR', implode( '<br />', $error ) );
	$xtpl->parse( 'main.error' );
}

if( empty( $row['id'] ) )
{
	$xtpl->parse( 'main.auto_get_alias' );
}

$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

$page_title = $lang_module['content_add'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';
