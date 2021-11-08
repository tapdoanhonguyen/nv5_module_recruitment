<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Fri, 19 Jun 2015 07:33:37 GMT
 */

if ( ! defined( 'NV_IS_MOD_RECRUITMENT' ) ) die( 'Stop!!!' );

// Thong tin tin tuyen dung
$post_data = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows WHERE id=' . $id )->fetch();
if( empty( $post_data ) )
{
	Header( 'Location: ' . nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name, true ) );
	die();
}

if( !defined( 'NV_IS_ADMIN' ) and $post_data['status'] != 1 )
{
	$redirect = '<meta http-equiv="Refresh" content="3;URL=' . nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name, true ) . '" />';
	nv_info_die( $lang_global['error_404_title'], $lang_global['error_404_title'], $lang_global['error_404_content'] . $redirect );
}

// Dia diem lam viec
$result = $db->query( 'SELECT province_id FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows_province WHERE rows_id=' . $id  );
while( list( $province_id ) = $result->fetch( 3 ) )
{
	$province_info = nv_location_get_province_info( $province_id );
	$post_data['province'][] = $province_info['title'];
}
// Dia diem lam viec
$result = $db->query( 'SELECT district_id FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows_district WHERE rows_id=' . $id  );
while( list( $district_id ) = $result->fetch( 3 ) )
{
	$district_info = nv_location_get_district_info( $district_id );
	$post_data['district'][] = $district_info['title'];
}
// Dia diem lam viec
$result = $db->query( 'SELECT ward_id FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows_ward WHERE rows_id=' . $id  );
while( list( $ward_id ) = $result->fetch( 3 ) )
{
	$ward_info = nv_location_get_ward_info( $ward_id );
	$post_data['ward'][] = $ward_info['title'];
}
if(isset($post_data['province']))
$post_data['province'] = implode( ', ', $post_data['province'] );

if(isset($post_data['district']))
$post_data['district'] = implode( ', ', $post_data['district'] );

if(isset($post_data['ward']))
$post_data['ward'] = implode( ', ', $post_data['ward'] );
$post_data['position'] = $array_position[$post_data['position_id']]['title'];

$works = array();
			$work_jobs = array();
			if( !empty( $post_data['jobs_id'] ) )
			{
				$work_jobs = explode(',',$post_data['jobs_id']);
				foreach( $work_jobs as $jobs )
				{
					$link = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $array_jobs[$jobs]['alias'];
					$works[] = '<a href="'. $link .'">' . $array_jobs[$jobs]['title'] . '</a>';
				}
			}
			$post_data['jobs'] = implode( ', ', $works );
			
			
//$post_data['jobs'] = $array_jobs[$post_data['jobs_id']]['title'];
$post_data['worktype'] = $array_worktype[$post_data['worktype_id']]['title'];
$post_data['gender'] = $array_gender[$post_data['gender']];
if( !empty( $post_data['document_id'] ) )
{
	$post_data['document_id'] = explode( ',', $post_data['document_id'] );
}
if( !empty( $post_data['document_type_id'] ) )
{
	$post_data['document_type_id'] = explode( ',', $post_data['document_type_id'] );
}

$post_data['is_hot'] = 0;
$is_hot = $db->query( 'SELECT COUNT(*) FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows_highlights WHERE rows_id=' . $post_data['id'] . ' AND status=1 AND is_hot=1 AND time_begin<=' . NV_CURRENTTIME . ' AND (time_end = 0 OR time_end >= ' . NV_CURRENTTIME . ' )' )->fetchColumn();
if( $is_hot > 0 )
{
	$post_data['is_hot'] = 1;
}

// Thong tin nha tuyen dung
$jobprovider_info = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobprovider WHERE id=' . $post_data['jobprovider_id'] )->fetch();
if( empty( $jobprovider_info ) )
{
	Header( 'Location: ' . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name );
	die( );
}

$province_info = nv_location_get_province_info( $jobprovider_info['provinceid'] );
$district_info = nv_location_get_district_info( $jobprovider_info['districtid'] );
$ward_info = nv_location_get_ward_info( $jobprovider_info['wardid'] );
$jobprovider_info['province'] = $province_info['title'];
$jobprovider_info['district'] = $district_info['title'];
$jobprovider_info['ward'] = $ward_info['title'];

// Luu viec lam
$post_data['post_saved'] = 0;
if( defined( 'NV_IS_USER' ) )
{
	$post_data['post_saved'] = $db->query( 'SELECT COUNT(*) FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobseeker_rsave WHERE userid=' . $user_info['userid'] . ' AND rows_id=' . $post_data['id'] )->fetchColumn();;
}

// So luong ho so ung tuyen
$post_data['submitcount'] = $db->query( 'SELECT COUNT(*) FROM ' . NV_PREFIXLANG . '_' . $module_data . '_rows_record WHERE rows_id=' . $post_data['id'] )->fetchColumn();

// Cap nhat luot xem
$time_set = $nv_Request->get_int( $module_data . '_' . $op . '_' . $id, 'session' );
if( empty( $time_set ) )
{
	$nv_Request->set_Session( $module_data . '_' . $op . '_' . $id, NV_CURRENTTIME );
	$query = 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data . '_rows SET viewcount=viewcount+1 WHERE id=' . $id;
	$db->query( $query );
}

$page_title = $post_data['title'];

$contents = nv_theme_recruitment_detail( $post_data, $jobprovider_info );

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';