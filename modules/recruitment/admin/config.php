<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 2-9-2010 14:43
 */

if( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );



if($nv_Request->isset_request('add_address', 'get'))
{

	$xtpl = new XTemplate( 'add_address.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file );
	$xtpl->assign( 'LANG', $lang_module );

	// LẤY TỈNH THÀNH RA
	$list_tinhthanh = $db->query('SELECT provinceid, title, type FROM ' . $db_config['prefix'] . '_location_province WHERE status = 1 ORDER BY weight ASC')->fetchAll();
	
	foreach($list_tinhthanh as $tinhthanh)
	{
		if($tinhthanh['provinceid'] == $row['city'])
		{
		$tinhthanh['selected'] = 'selected=selected';
		}
		else $tinhthanh['selected'] = '';
		$xtpl->assign('l', $tinhthanh);
        $xtpl->parse('main.tinh');
	}
	
	$xtpl->parse( 'main' );
	$contents = $xtpl->text( 'main' );

	echo $contents;
	die;


}
if($nv_Request->isset_request('id_tinhthanh', 'get'))
{
	$id_tinhthanh = $nv_Request->get_int('id_tinhthanh','get', 0);
	if($id_tinhthanh > 0)
	{
		$list_quan = $db->query('SELECT * FROM ' . $db_config['prefix'] . '_location_district WHERE status = 1 and provinceid = '. $id_tinhthanh .' ORDER BY weight ASC')->fetchAll();
		$html = '<option value=0>-- Chọn quận huyện --</option>';
					foreach($list_quan as $l)
					{
						$html .= '<option value='.$l['districtid'].'>'.$l['type'] . ' '. $l['title'].'</option>';
					}
		print $html;die;
	}

}

if($nv_Request->isset_request('id_quanhuyen', 'get'))
{
	$id_quanhuyen = $nv_Request->get_title('id_quanhuyen','get', '');
	if(!empty($id_quanhuyen))
	{ 
		//print('SELECT * FROM ' . $db_config['prefix'] . '_location_ward WHERE status = 1 and districtid IN('. $id_quanhuyen .') ORDER BY title ASC');die;
		$list_quan = $db->query('SELECT * FROM ' . $db_config['prefix'] . '_location_ward WHERE status = 1 and districtid IN('. $id_quanhuyen .')  ORDER BY districtid ASC, title ASC')->fetchAll();
		$html = '<option value=0>-- Chọn xã phường --</option>';
					foreach($list_quan as $l)
					{
						$html .= '<option value='.$l['wardid'].'>'.$l['type'] . ' '. $l['title'].'</option>';
					}
		print $html;die;
	}

}

//change status
if( $nv_Request->isset_request( 'change_status', 'post, get' ) )
{
	$id = $nv_Request->get_int( 'id', 'post, get', 0 );
	$content = 'NO_' . $id;

	$query = 'SELECT status FROM ' . $db_config['prefix'] . '_' . $module_data . '_zone_address WHERE id=' . $id;
	$row = $db->query( $query )->fetch();
	if( isset( $row['status'] ) )
	{
		$status = ( $row['status'] ) ? 0 : 1;
		$query = 'UPDATE ' . $db_config['prefix'] . '_' . $module_data . '_zone_address SET status=' . intval( $status ) . ' WHERE id=' . $id;
		$db->query( $query );
		$content = 'OK_' . $id;
	}
	$nv_Cache->delMod( $module_name );
	include NV_ROOTDIR . '/includes/header.php';
	echo $content;
	include NV_ROOTDIR . '/includes/footer.php';
	exit();
}


$page_title = $lang_module['config'];

$data = array();
if( $nv_Request->isset_request( 'savesetting', 'post' ) )
{
	$data['group_jobseeker'] = $nv_Request->get_int( 'group_jobseeker', 'post', 0 );
	$data['group_jobprovider'] = $nv_Request->get_int( 'group_jobprovider', 'post', 0 );
	$data['per_page'] = $nv_Request->get_int( 'per_page', 'post', 20 );
	$data['record_queue'] = $nv_Request->get_int( 'record_queue', 'post', 0 );
	$data['show_info'] = $nv_Request->get_int( 'show_info', 'post', 0 );
	$data['record_limit'] = $nv_Request->get_int( 'record_limit', 'post', 5 );
	$data['post_queue'] = $nv_Request->get_int( 'post_queue', 'post', 0 );
	$data['send_record'] = $nv_Request->get_int( 'send_record', 'post', 0 );
	$data['record_code'] = $nv_Request->get_title( 'record_code', 'post', 'HS%06s' );
	$data['post_code'] = $nv_Request->get_title( 'post_code', 'post', 'HS%06s' );
	$data['maxfilesize'] = $nv_Request->get_float( 'maxfilesize', 'post', 0 );
	$data['upload_filetype'] = $nv_Request->get_typed_array( 'upload_filetype', 'post', 'string' );
	$data['countryid'] = $nv_Request->get_typed_array( 'countryid', 'post', 'int' );
	$data['countryid'] = serialize( $data['countryid'] );

	if( $data['maxfilesize'] <= 0 or $data['maxfilesize'] > NV_UPLOAD_MAX_FILESIZE )
	{
		$data['maxfilesize'] = NV_UPLOAD_MAX_FILESIZE;
	}
    else
    {
        $data['maxfilesize'] = intval( $data['maxfilesize'] * 1048576 );
    }
	$data['upload_filetype'] = ( ! empty( $data['upload_filetype'] ) ) ? implode( ',', $data['upload_filetype'] ) : '';

	$sth = $db->prepare( "UPDATE " . NV_PREFIXLANG . '_' . $module_data . "_config SET config_value = :config_value WHERE config_name = :config_name" );
	foreach( $data as $config_name => $config_value )
	{
		$sth->bindParam( ':config_name', $config_name, PDO::PARAM_STR, 30 );
		$sth->bindParam( ':config_value', $config_value, PDO::PARAM_STR );
		$sth->execute();
	}

	nv_insert_logs( NV_LANG_DATA, $module_name, $lang_module['config'], "Config", $admin_info['userid'] );
	$nv_Cache->delMod( $module_name );

	Header( "Location: " . NV_BASE_ADMINURL . "index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . '=' . $op );
	die();
}

$data['group_jobseeker'] = 0;
$data['group_jobprovider'] = 0;
$data['per_page'] = 20;
$data['record_queue'] = 0;
$data['show_info'] = 1;
$data['record_limit'] = 5;
$data['post_queue'] = 0;
$data['send_record'] = 0;
$data['maxfilesize'] = 2097152; // 2 MB
$data['upload_filetype'] = array( 'archives', 'documents' );
$data['countryid'] = '';

$array_config['maxfilesize'] = number_format( $array_config['maxfilesize']/1048576, 2);

$xtpl = new XTemplate( $op . ".tpl", NV_ROOTDIR . "/themes/" . $global_config['module_theme'] . "/modules/" . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'DATA', $array_config );
$xtpl->assign( 'NV_UPLOAD_MAX_FILESIZE', nv_convertfromBytes( NV_UPLOAD_MAX_FILESIZE ) );

$groups_list = nv_groups_list( );
foreach( $groups_list as $group_id => $grtl )
{
	$xtpl->assign( 'GROUP_JOBSEEKER', array(
		'id' => $group_id,
		'title' => $grtl,
		'selected' => ($array_config['group_jobseeker'] == $group_id) ? ' selected=selected' : ''
	) );
	$xtpl->parse( 'main.group_jobseeker' );
}

foreach( $groups_list as $group_id => $grtl )
{
	$xtpl->assign( 'GROUP_PROVIDER', array(
		'id' => $group_id,
		'title' => $grtl,
		'selected' => ($array_config['group_jobprovider'] == $group_id) ? ' selected=selected' : ''
	) );
	$xtpl->parse( 'main.group_jobprovider' );
}

if( ! empty( $global_config['file_allowed_ext'] ) )
{
	$allow_files_type = array( $global_config['file_allowed_ext'], explode( ',', $array_config['upload_filetype'] ) );
	foreach( $allow_files_type[0] as $tp )
	{
		$xtpl->assign( 'CHECKED', in_array( $tp, $allow_files_type[1] ) ? ' checked="checked"' : '' );
		$xtpl->assign( 'TP', $tp );
		$xtpl->parse( 'main.allow_files_type' );
	}
}

$array_country = nv_location_get_country();
if( !empty( $array_country ) )
{
	foreach( $array_country as $countryid => $country )
	{
		$country['checked'] = in_array( $countryid, $array_config['countryid'] ) ? 'checked="checked"' : '';
		$xtpl->assign( 'COUNTRY', $country );
		$xtpl->parse( 'main.country' );
	}
}

$xtpl->assign( 'ck_record_queue', $array_config['record_queue'] ? 'checked="checked"' : '' );
$xtpl->assign( 'ck_show_info', $array_config['show_info'] ? 'checked="checked"' : '' );
$xtpl->assign( 'ck_post_queue', $array_config['post_queue'] ? 'checked="checked"' : '' );
$xtpl->assign( 'ck_send_record', $array_config['send_record'] ? 'checked="checked"' : '' );

$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';