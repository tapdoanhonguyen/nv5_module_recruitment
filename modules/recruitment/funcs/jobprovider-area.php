<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sat, 20 Jun 2015 07:15:10 GMT
 */

if( ! defined( 'NV_IS_MOD_RECRUITMENT' ) ) die( 'Stop!!!' );

$array_data = array();

$contents = nv_theme_recruitment_jobprovider_area( $array_data );
$page_title = $module_info['custom_title'];

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';