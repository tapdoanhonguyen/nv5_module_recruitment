<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Fri, 19 Jun 2015 07:33:37 GMT
 */

if ( ! defined( 'NV_ADMIN' ) ) die( 'Stop!!!' );

$submenu['approved'] = $lang_module['approved'];
$submenu['content'] = $lang_module['post_add'];
$submenu['highlights'] = $lang_module['highlights'];
$submenu['record_highlights'] = $lang_module['record_highlights'];
$submenu['groups'] = $lang_module['groups'];

$jobprovider=array();
$jobprovider['jobprovider_content'] = $lang_module['jobprovider_add'];
$submenu['jobprovider'] = array( 'title' => $lang_module['jobprovider'], 'submenu' => $jobprovider );

$submenu['jobseeker'] = $lang_module['jobseeker'];
$submenu['jobseeker_content'] = $lang_module['jobseeker_add'];
$submenu['record'] = $lang_module['record'];
$submenu['record_content'] = $lang_module['record_add'];
$submenu['learning'] = $lang_module['learning'];
$submenu['jobs'] = $lang_module['jobs'];
$submenu['worktype'] = $lang_module['worktype'];
$submenu['position'] = $lang_module['position'];
$submenu['document'] = $lang_module['document'];
$submenu['document_type'] = $lang_module['document_type'];
$submenu['money_units'] = $lang_module['money_units'];
$submenu['config'] = $lang_module['config'];