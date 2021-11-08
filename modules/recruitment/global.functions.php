<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Tue, 02 Jun 2015 07:10:02 GMT
 */

if( ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );
global $nv_Cache, $db, $module_name, $module_data, $global_config;
$array_config = array();
$_sql = 'SELECT config_name, config_value FROM ' . NV_PREFIXLANG . '_' . $module_data . '_config';
$_query = $db->query( $_sql );
while( list( $config_name, $config_value ) = $_query->fetch( 3 ) )
{
	$array_config[$config_name] = $config_value;
}
$array_config['countryid'] = unserialize( $array_config['countryid'] );

// Danh sach nganh nghe
$sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobs WHERE status=1 ORDER BY weight';
$array_jobs = $nv_Cache->db( $sql, 'id', $module_name );

$sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobprovider WHERE status=1 ORDER BY id';
$array_jobprovider = $nv_Cache->db( $sql, 'id', $module_name );

// Danh sach bang cap
$sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_learning WHERE status=1 ORDER BY weight';
$array_learning = $nv_Cache->db( $sql, 'id', $module_name );

// Danh sach don vi tien te
$sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_money_units WHERE status=1';
$array_money_units = $nv_Cache->db( $sql, 'id', $module_name );

// Vi tri cong viec
$sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_position WHERE status=1';
$array_position = $nv_Cache->db( $sql, 'id', $module_name );

// Loai hinh cong viec
$sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_worktype WHERE status=1';
$array_worktype = $nv_Cache->db( $sql, 'id', $module_name );

// Ho so kem theo
$sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_document WHERE status=1';
$array_document = $nv_Cache->db( $sql, 'id', $module_name );

// Loai ho so
$sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_document_type WHERE status=1';
$array_document_type = $nv_Cache->db( $sql, 'id', $module_name );



// Tinh trang hon nhan
$array_marital = array(
	'0' => $lang_module['marital_0'],
	'1' => $lang_module['marital_1']
);

// Gioi tinh
$array_gender = array(
	'1' => $lang_module['gender_1'],
	'0' => $lang_module['gender_0'],
	'2' => $lang_module['gender_2']
);

// Trang thai tin đăng
$array_post_status = array(
	'2' => $lang_module['status_2'],
	'1' => $lang_module['status_1'],
	'0' => $lang_module['status_0'],
);

$array_status = array(
	'1' => $lang_module['status_1'],
	'0' => $lang_module['status_0'],
);

/**
 * nv_number_format()
 *
 * @param mixed $number
 * @param integer $decimals
 * @return
 */
function nv_number_format( $number, $decimals = 0 )
{
	global $money_config, $pro_config;

	$str = number_format( $number, $decimals, ',', '.' );
	return $str;
}

/**
 * nv_delete_rows()
 *
 * @param mixed $rows_id
 * @param mixed $jobprovider_id
 * @return
 */
function nv_delete_rows( $rows_id, $jobprovider_id = 0 )
{
	global $db, $module_data;

	if( !empty( $rows_id ) )
	{
		if( $jobprovider_id > 0 )
		{
			$post = $db->query( 'SELECT jobs_id FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows WHERE id=' . $rows_id . ' AND jobprovider_id=' . $jobprovider_id )->fetch();
		}
		else
		{
			$post = $db->query( 'SELECT jobs_id FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows WHERE id=' . $rows_id )->fetch();
		}

		if( !empty( $post ) )
		{
			// Xoa tin dang
			$result = $db->query( 'DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows WHERE id=' . $rows_id );
			if( $result )
			{
				// Xoa dia diem
				$db->query( 'DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows_province WHERE rows_id=' . $rows_id );
				
				// Xóa block tin nổi bật
				$db->query( 'DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_block WHERE id=' . $rows_id );

				// Xóa khỏi tin nổi bật
				$db->query( 'DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows_highlights WHERE rows_id=' . $rows_id );
				
				// Xóa trong bảng _record_jobs
				$db->query( 'DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_record_jobs WHERE record_id=' . $rows_id );

				// Xoa ho so ung tuyen
				$result = $db->query( 'SELECT id FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows_record WHERE rows_id=' . $rows_id );
				while( list( $record_id ) = $result->fetch( 3 ) )
				{
					nv_delete_sended_record( $record_id );
				}

				// Cap nhat lai so luong ban tin tuyen dung o moi nganh nghe
				//$db->query( 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_jobs SET num_post=(SELECT COUNT(*) FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows WHERE jobs_id=' . $post['jobs_id'] . ') WHERE id=' . $post['jobs_id'] );
			}
		}
	}
	return true;
}

/**
 * nv_delete_jobseeker()
 *
 * @param mixed $jobseeker_id
 * @return
 */
function nv_delete_jobseeker( $jobseeker_id )
{
	global $db, $module_data, $array_config;

	$jobseeker = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobseeker WHERE id=' . $jobseeker_id )->fetch();
	if( !empty( $jobseeker ) )
	{
		// Xoa ung vien
		$result = $db->query( 'DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobseeker WHERE id=' . $jobseeker_id );
		if( $result )
		{
			// Xoa ho so
			$result = $db->query( 'SELECT id FROM ' . NV_PREFIXLANG . '_' . $module_data . '_record WHERE jobseeker_id=' . $jobseeker_id );
			while( list( $record_id ) = $result->fetch( 3 ) )
			{
				nv_delete_record( $record_id );
			}

			// Xoa ho so da luu
			$db->query( 'DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobseeker_rsave WHERE userid=' . $jobseeker['userid'] );

			// Xoa khoi nhom Ung vien
			nv_remove_groups_user( $array_config['group_jobseeker'], $jobseeker['userid'] );
		}
	}
	return true;
}

/**
 * nv_delete_record()
 *
 * @param mixed $rows_id
 * @return
 */
function nv_delete_record( $rows_id )
{
	global $db, $nv_Cache, $module_name, $module_data, $module_upload;

	if( !empty( $rows_id ) )
	{
		$record = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_record WHERE id=' . $rows_id )->fetch();
		if( !empty( $record ) )
		{
			// Xoa ho so
			$result = $db->query( 'DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_record WHERE id=' . $rows_id );
			if( $result )
			{
				// Xoa khoi ho so noi bat
				$db->query( 'DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_record_highlights WHERE record_id=' . $rows_id );

				// Xoa dia diem
				$db->query( 'DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_record_wlocation WHERE record_id=' . $rows_id );

				// Cap nhat lai so luong ho so o moi nganh nghe
				//$db->query( 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_jobs SET num_record=(SELECT COUNT(*) FROM ' . NV_PREFIXLANG . '_' . $module_data . '_record WHERE jobs_id=' . $record['jobs_id'] . ') WHERE id=' . $record['jobs_id'] );

				// Xoa anh ho so
				if( !empty( $record['contact_image'] ) )
				{
					nv_deletefile( NV_ROOTDIR . NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/record_images/' . $record['contact_image'] );
				}

				$nv_Cache->delMod( $module_name );
			}
		}
	}
	return true;
}

/**
 * nv_delete_sended_record()
 *
 * @param mixed $id
 * @return
 */
function nv_delete_sended_record( $id )
{
	global $db, $module_name, $module_data, $module_upload;

	$record_info = $db->query( 'SELECT file FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows_record WHERE id=' . $id )->fetch();
	if( !empty( $record_info ) )
	{
		// Xoa khoi ho so
		$result = $db->query('DELETE FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows_record WHERE id = ' . $db->quote( $id ) );
		if( $result )
		{
			// Xoa file dinh kem
			nv_deletefile( NV_UPLOADS_REAL_DIR . '/' . $module_upload . '/record/' . $record_info['file'] );
		}
		else
		{
			return false;
		}
	}
	else
	{
		return false;
	}

	return true;
}

/**
 * nv_salary_string()
 *
 * @param mixed $salary_from
 * @param mixed $salary_to
 * @param mixed $money_units
 * @return
 */
function nv_salary_string( $salary_from, $salary_to, $money_units )
{
	global $array_money_units, $lang_module;

	$salary = $lang_module['salary_deal'];
	$money_units = $array_money_units[$money_units]['title'];

	if( !empty( $salary_to ) and !empty( $salary_from ) )
	{
		$salary = nv_number_format( $salary_from ) . ' - ' . nv_number_format( $salary_to ) . ' ' . $money_units;
	}
	elseif( empty( $salary_to ) and !empty( $salary_from ) )
	{
		$salary = sprintf( $lang_module['salary_min'], nv_number_format( $salary_from ) ) . ' ' . $money_units;
	}
	elseif( empty( $salary_from ) and !empty( $salary_to ) )
	{
		$salary = sprintf( $lang_module['salary_max'], nv_number_format( $salary_to ) ) . ' ' . $money_units;
	}

	return $salary;
}

/**
 * nv_add_groups()
 *
 * @param mixed $gid
 * @param mixed $uid
 * @return
 */
function nv_add_groups( $gid, $uid, $user_add = 0 )
{
	global $db, $nv_Cache, $global_config, $lang_module, $module_name;

	$error = '';

	//Lay danh sach nhom
	$sql = 'SELECT * FROM ' . NV_GROUPS_GLOBALTABLE . ' WHERE idsite = ' . $global_config['idsite'] . ' or (idsite =0 AND group_id > 3 AND siteus = 1) ORDER BY idsite, weight';
	$result = $db->query( $sql );
	$groupsList = array();
	$groupcount = 0;
	$weight_siteus = 0;
	while( $row = $result->fetch() )
	{
		if( $row['idsite'] == $global_config['idsite'] )
		{
			++$groupcount;
		}
		else
		{
			$row['weight'] = ++$weight_siteus;
			$row['title'] = '<strong>' . $row['title'] . '</strong>';
		}
		$groupsList[$row['group_id']] = $row;
	}

	if( ! isset( $groupsList[$gid] ) or $gid < 10 ) $error = $lang_module['error_group_not_found'];

	if( $groupsList[$gid]['idsite'] != $global_config['idsite'] AND $groupsList[$gid]['idsite'] == 0 )
	{
		$row = $db->query( 'SELECT idsite FROM ' . NV_USERS_GLOBALTABLE . ' WHERE userid=' . $uid )->fetch();
		if( ! empty( $row ) )
		{
			if( $row['idsite'] != $global_config['idsite'] )
			{
				$error = $lang_module['error_group_in_site'];
			}
		}
		else
		{
			$error = $lang_module['search_not_result'];
		}
	}

	if( ! nv_groups_add_user( $gid, $uid ) )
	{
		$error = $lang_module['search_not_result'];
	}

	// Update for table users
	$in_groups = array();
	$result_gru = $db->query( 'SELECT group_id FROM ' . NV_GROUPS_GLOBALTABLE . '_users WHERE userid=' . $uid );
	while( $row_gru = $result_gru->fetch() )
	{
		$in_groups[] = $row_gru['group_id'];
	}
	$db->exec( "UPDATE " . NV_USERS_GLOBALTABLE . " SET in_groups='" . implode( ',', $in_groups ) . "' WHERE userid=" . $uid );

	$nv_Cache->delMod( $module_name );
	if( $user_add > 0 )
	{
		nv_insert_logs( NV_LANG_DATA, $module_name, $lang_module['addMemberToGroup'], 'Member Id: ' . $uid . ' group ID: ' . $gid, $user_add );
	}

	return $error;
}

/**
 * nv_remove_groups_user()
 *
 * @param mixed $gid
 * @param mixed $userid
 * @return
 */
function nv_remove_groups_user( $gid, $uid )
{
	global $db, $nv_Cache, $lang_module, $global_config, $module_name;

	$error = '';

	//Lay danh sach nhom
	$sql = 'SELECT * FROM ' . NV_GROUPS_GLOBALTABLE . ' WHERE idsite = ' . $global_config['idsite'] . ' or (idsite =0 AND group_id > 3 AND siteus = 1) ORDER BY idsite, weight';
	$result = $db->query( $sql );
	$groupsList = array();
	$groupcount = 0;
	$weight_siteus = 0;
	while( $row = $result->fetch() )
	{
		if( $row['idsite'] == $global_config['idsite'] )
		{
			++$groupcount;
		}
		else
		{
			$row['weight'] = ++$weight_siteus;
			$row['title'] = '<strong>' . $row['title'] . '</strong>';
		}
		$groupsList[$row['group_id']] = $row;
	}

	if( ! isset( $groupsList[$gid] ) or $gid < 10 ) $error = $lang_module['error_group_not_found'];

	if( $groupsList[$gid]['idsite'] != $global_config['idsite'] AND $groupsList[$gid]['idsite'] == 0 )
	{
		$row = $db->query( 'SELECT idsite FROM ' . NV_USERS_GLOBALTABLE . ' WHERE userid=' . $uid )->fetch();
		if( ! empty( $row ) )
		{
			if( $row['idsite'] != $global_config['idsite'] )
			{
				$error = $lang_module['error_group_in_site'];
			}
		}
		else
		{
			$error = $lang_module['search_not_result'];
		}
	}

	if( ! nv_groups_del_user( $gid, $uid ) )
	{
		$error = $lang_module['UserNotInGroup'];
	}

	// Update for table users
	$in_groups = array();
	$result_gru = $db->query( 'SELECT group_id FROM ' . NV_GROUPS_GLOBALTABLE . '_users WHERE userid=' . $uid );
	while( $row_gru = $result_gru->fetch() )
	{
		$in_groups[] = $row_gru['group_id'];
	}
	$db->query( "UPDATE " . NV_USERS_GLOBALTABLE . " SET in_groups='" . implode( ',', $in_groups ) . "' WHERE userid=" . $uid );

	$nv_Cache->delMod( $module_name );

	return $error;
}

function clear_fix($keyword)
{
	$key = '';
	if(!empty($keyword))
	{
		$array_keyword = explode('-',$keyword);
		foreach($array_keyword as $word)
		{
			if(!empty($word))
			{
				if(empty($key))
				$key = $word;
				else
				$key .= '-' . $word;
			}
		}
	}
	
	return $key;

}

function view_job($string_job)
{
	global $array_jobs;
	if(!empty($string_job))
	{
		$array_string_job = explode(',',$string_job);
		$string = '';
		foreach($array_string_job as $job)
		{
			if(empty($string))
			$string .=  $array_jobs[$job]['title'];
			else
			$string .= ', ' .  $array_jobs[$job]['title'];
		}
		
	}
	
	return $string ;

}

function first_view_job($string_job)
{
	if(!empty($string_job))
	{
		$array_string_job = explode(',',$string_job);
	
		return $array_string_job[0];
		
	}
	
	return 0 ;

}

