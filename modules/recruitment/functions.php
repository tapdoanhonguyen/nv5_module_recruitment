<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Fri, 19 Jun 2015 07:33:37 GMT
 */

if ( ! defined( 'NV_SYSTEM' ) ) die( 'Stop!!!' );

define( 'NV_IS_MOD_RECRUITMENT', true );
require_once NV_ROOTDIR . '/modules/' . $module_file . '/global.functions.php';
require_once NV_ROOTDIR . '/modules/location/data.functions.php';

$jobprovider_id = $jobseeker_id = 0;
$jobprovider_alias = '';

if( defined( 'NV_IS_USER' ) )
{
	$result = $db->query( 'SELECT id, alias FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobprovider WHERE userid=' . $user_info['userid'] );
	if( $result->rowCount() > 0 )
	{
		list( $jobprovider_id, $jobprovider_alias ) = $result->fetch( 3 );
	}

	$result = $db->query( 'SELECT id FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobseeker WHERE userid=' . $user_info['userid'] );
	if( $result->rowCount() > 0 )
	{
		$jobseeker_id = $result->fetchColumn();
	}

	if( !defined( 'NV_IS_ADMIN' ) and $module_info['funcs'][$op]['func_name'] != 'confirm-page' and $module_info['funcs'][$op]['func_name'] != 'jobprovider-content' and $module_info['funcs'][$op]['func_name'] != 'jobseeker' and $module_name != 'users' )
	{
		//print_r($array_config['group_jobseeker']);die;
		$user_groups = !empty( $user_info['in_groups'] ) ? $user_info['in_groups'] : array();
		if( empty( $user_groups ) or ( !in_array( $array_config['group_jobprovider'], $user_groups ) and !in_array( $array_config['group_jobseeker'], $user_groups ) ) )
		{
			Header( 'Location: ' . nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $module_info['alias']['confirm-page'], true ) );
			die();
		}
	}
}

$jobs_id = 0;
$jobs_alias = isset( $array_op[0] ) ? $array_op[0] : '';

foreach( $array_jobs as $jobs )
{
	$array_jobs[$jobs['id']]['link'] =  NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $jobs['alias'];

	if( $jobs_alias == $jobs['alias'] )
	{
		$jobs_id = $jobs['id'];
	}
}



function tms_dem($provinceid =0)
	{
		global $db,$module_data,$db_config;
		$sql = 'SELECT province_id FROM  '. NV_PREFIXLANG . '_' . $module_data . '_rows_province WHERE province_id='.$provinceid;
		$data = $db->query($sql)->fetchAll();
		return $data;
	}


	
	
function tms_price_number($num = false, $pricetime = 0)
{
    global $lang_module, $array_config, $array_price_time;
    
    $str = '';
    $num = trim($num);
    
    $arr = str_split($num);
    $count = count($arr);
    
    $f = number_format(floatval($num));
    if ($count < 4) {
        $str = $num;
    } else {
        $r = explode(',', $f);
        switch (count($r)) {
            case 4:
                $str = $r[0] . ' ' . $lang_module['billion'];
                if ((int) $r[1]) {
                    $str .= ' ' . $r[1] . ' ' . $lang_module['million'];
                } else {
                    $str = $r[0];
                    if ($pricetime > 0) {
                        $str .= ' (' . $lang_module['billion'] . $array_price_time[$pricetime] . ')';
                    } else {
                        $str .= ' ' . $lang_module['billion'];
                    }
                }
                break;
            case 3:
                $str = $r[0] . ' ' . $lang_module['million'];
                if ((int) $r[1]) {
                    $str .= ' ' . $r[1] . ' ' . $lang_module['thousand'];
                } else {
                    $str = $r[0];
                    if ($pricetime > 0) {
                        $str .= ' (' . $lang_module['million'] . $array_price_time[$pricetime] . ')';
                    } else {
                        $str .= ' ' . $lang_module['million'];
                    }
                }
                break;
            case 2:
                $str = $r[0] . ' ' . $lang_module['thousand'];
                if ((int) $r[1]) {
                    $str .= ' ' . $r[1] . ' ' . $lang_module['dong'];
                } else {
                    $str = $r[0];
                    if ($pricetime > 0) {
                        $str .= ' (' . $lang_module['thousand'] . $array_price_time[$pricetime] . ')';
                    } else {
                        $str .= ' ' . $lang_module['thousand'];
                    }
                }
                break;
        }
    }
    return ($str);
}



$page = 1;
$per_page = 20;

if( $op == 'main' )
{
	if( empty( $jobs_id ) )
	{
		if( preg_match( '/^page\-([0-9]+)$/', ( isset( $array_op[0] ) ? $array_op[0] : '' ), $m ) )
		{
			$page = ( int )$m[1];
		}
	}
	else
	{
		if( sizeof( $array_op ) == 2 and preg_match( '/^([a-z0-9\-]+)\-([0-9]+)$/i', $array_op[1], $m1 ) and ! preg_match( '/^page\-([0-9]+)$/', $array_op[1], $m2 ) )
		{
			$op = 'detail';
			$id = $m1[2];
		}
		else
		{
			if( preg_match( '/^page\-([0-9]+)$/', ( isset( $array_op[1] ) ? $array_op[1] : '' ), $m ) )
			{
				$page = ( int )$m[1];
			}
			$op = 'viewjobs';
		}
	}
}

if( $nv_Request->isset_request( 'delete_rows', 'post' ) )
{
	$rows_id = $nv_Request->get_int( 'rows_id', 'post', 0 );

	if( !empty( $rows_id ) )
	{
		if( nv_delete_rows( $rows_id, $jobprovider_id ) )
		{
			$nv_Cache->delMod( $module_name );
			die( 'OK' );
		}
	}
	die( 'NO' );
}

if( $nv_Request->isset_request( 'delete_record', 'post' ) )
{
	$rows_id = $nv_Request->get_int( 'rows_id', 'post', 0 );

	if( !empty( $rows_id ) )
	{
		if( nv_delete_record( $rows_id ) )
		{
			$nv_Cache->delMod( $module_name );
			die( 'OK' );
		}
	}
	die( 'NO' );
}





/**
 * nv_get_company_premission()
 *
 * @return
 */
function nv_check_premission()
{
	global $db, $site_mods, $module_data, $lang_module, $module_name, $user_info;

	$allow = false;
	if( defined( 'NV_IS_USER' ) )
	{
		$count = $db->query( 'SELECT COUNT(*) FROM ' . NV_PREFIXLANG . '_' . $site_mods[COMPANY_MODULE_NAME]['module_data'] . '_admin WHERE admin_id=' . $user_info['userid'] )->fetchColumn();
		if( $count > 0 )
		{
			$allow = true;
		}
	}
	if( !$allow )
	{
		$redirect = '<meta http-equiv="Refresh" content="3;URL=' . nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name, true ) . '" />';
		nv_info_die( $lang_module['no_premission'], $lang_module['no_premission'], $lang_module['no_premission_note'] . $redirect );
		exit();
	}
}


if(($op == 'main' and !empty($array_op[0])) or ($op == 'viewjobs' and !empty($array_op[0])))
{
	$op = 'search';
}
//die($op);
$_SESSION['search']['q'] = '';
$_SESSION['search']['jobs_id'] = 0;
$_SESSION['search']['provinceid'] = 0;
$_SESSION['search']['districtid'] = 0;
$_SESSION['search']['wardid'] = 0;
$_SESSION['search']['salary'] = '';
$_SESSION['search']['worktype_id'] = 0;
$_SESSION['search']['position_id'] = 0;
$_SESSION['search']['experience'] = 0;
$_SESSION['search']['learning_id'] = 0;
$_SESSION['search']['search'] = '';
