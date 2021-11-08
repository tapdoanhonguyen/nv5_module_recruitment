<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Fri, 19 Jun 2015 07:33:37 GMT
 */

if ( ! defined( 'NV_IS_MOD_RECRUITMENT' ) ) die( 'Stop!!!' );

$url = array();

$cacheFile = NV_LANG_DATA . '_Sitemap_' . NV_CACHE_PREFIX . '.cache';
$pa = NV_CURRENTTIME - 7200;

if( ( $cache = nv_get_cache( $module_name, $cacheFile ) ) != false and filemtime( NV_ROOTDIR . '/' . NV_CACHEDIR . '/' . $module_name . '/' . $cacheFile ) >= $pa )
{
    $url = unserialize( $cache );
}
else
{
	$url = array();

	$db->sqlreset()
		->select( 'id, jobs_id, alias, addtime' )
		->from( NV_PREFIXLANG . '_' . $module_data . '_rows' )
		->where( 'status=1' )
		->order( 'addtime DESC' )
		->limit( 1000 );
	$result = $db->query( $db->sql() );

	while( list( $id, $jobs_id, $alias, $addtime ) = $result->fetch( 3 ) )
	{
		$jobsalias = $array_jobs[$jobs_id]['alias'];
		$url[] = array(
			'link' => NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $jobsalias . '/' . $alias . '-' . $id . $global_config['rewrite_exturl'],
			'publtime' => $addtime
		);
	}

    $cache = serialize($url);
    nv_set_cache( $module_name, $cacheFile, $cache );
}

nv_xmlSitemap_generate( $url );
die();