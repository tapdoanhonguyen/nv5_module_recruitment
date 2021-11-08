<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 2-9-2010 14:43
 */

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

