<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Fri, 19 Jun 2015 07:33:37 GMT
 */

if( !defined( 'NV_IS_MOD_RECRUITMENT' ) )
	die( 'Stop!!!' );

/**
 * nv_theme_recruitment_main()
 *
 * @param mixed $array_data
 * @return
 */
function nv_theme_recruitment_main( $post_new )
{
	global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $op, $array_jobs,$array_province;

	$xtpl = new XTemplate( $op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'VIEWALL', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $module_info['alias']['all-post'] );

	if( !empty( $array_jobs ) )
	{
		foreach( $array_jobs as $jobs )
		{
			$jobs['url_view'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '/' . $jobs['alias'];
			$xtpl->assign( 'JOBS', $jobs );
			$xtpl->parse( 'main.jobs.loop' );
		}
		$xtpl->parse( 'main.jobs' );
	}	
	

	
	
	 $array_province = nv_location_get_province( 1 );
	if( !empty( $array_province ) )
	{
		foreach( $array_province as $province )
		{
			$province['url_view'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '/' . $jobs['alias'];
			$province['number'] =  count(tms_dem($province['provinceid']));
			$xtpl->assign( 'CITY', $province );
			$xtpl->parse( 'main.province.loop' );
			//print_r($province['number']); die();
		}
		$xtpl->parse( 'main.province' );
	}


	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

/**
 * nv_theme_recruitment_jobprovider_area()
 *
 * @param mixed $array_data
 * @return
 */
function nv_theme_recruitment_jobprovider_area( $post_new )
{
	global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $op, $array_jobs;

	$xtpl = new XTemplate( 'jobprovider-area.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'VIEWALL', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $module_info['alias']['all-post'] );

	if( !empty( $array_jobs ) )
	{
		foreach( $array_jobs as $jobs )
		{
			$jobs['url_view'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp' . NV_OP_VARIABLE . '=' . $module_info['alias']['viewjobs-record'] . '/' . $jobs['alias'];
			$xtpl->assign( 'JOBS', $jobs );
			$xtpl->parse( 'main.jobs_new.loop' );
			$xtpl->parse( 'main.jobs_mostview.loop' );
			$xtpl->parse( 'main.jobs_record.loop' );
		}
		$xtpl->parse( 'main.jobs_new' );
		$xtpl->parse( 'main.jobs_mostview' );
		$xtpl->parse( 'main.jobs_record' );
	}

	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

/**
 * nv_theme_recruitment_viewjobs()
 *
 * @param mixed $array_data
 * @param mixed $nv_alias_page
 * @return
 */
function nv_theme_recruitment_viewjobs( $array_data, $nv_alias_page )
{
	global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $op, $array_jobs, $array_money_units, $jobs_id;

	$xtpl = new XTemplate( $op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'JOBS', $array_jobs[$jobs_id] );

	if( !empty( $array_data ) )
	{
		$xtpl->assign( 'POST', nv_theme_recruitment_list_post_detail( $array_data, $nv_alias_page ) );
	}

	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

/**
 * nv_theme_recruitment_viewprovince()
 *
 * @param mixed $array_data
 * @param mixed $nv_alias_page
 * @return
 */
function nv_theme_recruitment_viewprovince( $array_data, $nv_alias_page )
{
	global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $op, $province_id;

	$xtpl = new XTemplate( 'viewprovince.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
	$xtpl->assign( 'LANG', $lang_module );
	$province_info = nv_location_get_province_info( $province_id );
	$xtpl->assign( 'PROVINCE', $province_info );

	if( !empty( $array_data ) )
	{
		$xtpl->assign( 'POST', nv_theme_recruitment_list_post_detail( $array_data, $nv_alias_page ) );
	}

	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

/**
 * nv_theme_recruitment_viewprovince_record()
 *
 * @param mixed $array_data
 * @param mixed $nv_alias_page
 * @return
 */
function nv_theme_recruitment_viewprovince_record( $array_data, $nv_alias_page )
{
	global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $op, $province_id;

	$xtpl = new XTemplate( 'viewprovince-record.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
	$xtpl->assign( 'LANG', $lang_module );
	$province_info = nv_location_get_province_info( $province_id );
	$xtpl->assign( 'PROVINCE', $province_info );

	if( !empty( $array_data ) )
	{
		$xtpl->assign( 'RECORD', nv_theme_recruitment_list_record( $array_data, $nv_alias_page ) );
	}

	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

/**
 * nv_theme_recruitment_jobs_search()
 *
 * @param mixed $array_data
 * @param mixed $nv_alias_page
 * @return
 */
function nv_theme_recruitment_jobs_search( $search_type, $array_data, $nv_alias_page )
{
	global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $op, $array_jobs, $array_money_units, $jobs_id;

	$xtpl = new XTemplate( $op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
	$xtpl->assign( 'LANG', $lang_module );

	if( !empty( $array_data ) )
	{
		if( $search_type == 'jobs' )
		{
			$xtpl->assign( 'POST', nv_theme_recruitment_list_post_detail( $array_data, $nv_alias_page ) );
		}
		elseif( $search_type == 'record' )
		{
			$xtpl->assign( 'POST', nv_theme_recruitment_list_record_detail( $array_data, $nv_alias_page ) );
		}
		$xtpl->parse( 'main.search_data' );
	}
	else
	{
		$xtpl->parse( 'main.empty' );
	}

	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

/**
 * nv_theme_recruitment_detail()
 *
 * @param mixed $array_data
 * @param mixed $jobprovider_info
 * @return
 */
function nv_theme_recruitment_detail( $post_data, $jobprovider_info )
{
	global $global_config, $module_name, $module_file, $module_upload, $lang_global, $lang_module, $module_config, $module_info, $op, $array_document, $array_document_type, $user_info, $array_money_units, $jobseeker_id, $array_config;

	$post_data['salary'] = nv_salary_string( $post_data['salary_from'], $post_data['salary_to'], $post_data['money_units'] );
	$post_data['document_exp'] = !empty( $post_data['document_exp'] ) ? nv_date( 'd/m/Y', $post_data['document_exp'] ) : $lang_module['document_exp_unlimit'];
	$post_data['addtime'] = nv_date( 'H:i d/m/Y', $post_data['addtime'] );
	$post_data['quantity'] = !empty( $post_data['quantity'] ) ? $post_data['quantity'] : '';

	$post_data['url_print'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $module_info['alias']['print-post'] . '/' . $post_data['alias'] . '-' . $post_data['id'];
	$jobprovider_info['link'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $module_info['alias']['jobprovider'] . '/' . $jobprovider_info['alias'] . '-' . $jobprovider_info['id'];

	$post_data['more_requirement'] = nv_nl2br( $post_data['more_requirement'] );
	$post_data['interests'] = nv_nl2br( $post_data['interests'] );

	if( defined( 'NV_IS_USER' ) )
	{
		$post_data['url_send_record'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $module_info['alias']['send-record'] . '/' . $post_data['alias'] . '-' . $post_data['id'];
	}
	else
	{
		$url_redirect = nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $module_info['alias']['send-record'] . '/' . $post_data['alias'] . '-' . $post_data['id'], true );
		$post_data['url_send_record'] = NV_BASE_SITEURL . 'index.php?' . NV_NAME_VARIABLE . '=users&' . NV_OP_VARIABLE . '=login&nv_redirect=' . nv_redirect_encrypt( $url_redirect );
	}

	$url_post_saved = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $module_info['alias']['list-post-saved'];
	$lang_module['post_save_success'] = sprintf( $lang_module['post_save_success'], $post_data['title'], $url_post_saved );
	$lang_module['post_saved_drop_success'] = sprintf( $lang_module['post_saved_drop_success'], $post_data['title'], $url_post_saved );

	$is_image = 0;
	if( !empty( $jobprovider_info['image'] ) and file_exists( NV_UPLOADS_REAL_DIR . '/' . $module_upload . '/jobprovider_images/' . $jobprovider_info['image'] ) )
	{
		$is_image = 1;
		$jobprovider_info['image'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/jobprovider_images/' . $jobprovider_info['image'];
	}

	if( empty( $row['age'] ) )
	{
		$post_data['age'] = $lang_module['none_require'];
	}

	$xtpl = new XTemplate( $op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'GLANG', $lang_global );
	$xtpl->assign( 'ROW', $post_data );
	$xtpl->assign( 'JOBPROVIDER', $jobprovider_info );
	$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
	$xtpl->assign( 'MODULE_FILE', $module_file );

	if( !empty( $post_data['more_requirement'] ) )
	{
		$xtpl->parse( 'main.more_requirement' );
	}

	if( !empty( $post_data['interests'] ) )
	{
		$xtpl->parse( 'main.interests' );
	}

	if( !empty( $post_data['degree'] ) )
	{
		$xtpl->parse( 'main.degree' );
	}

	if( !empty( $post_data['quantity'] ) )
	{
		$xtpl->parse( 'main.quantity' );
	}

	if( !empty( $post_data['document_id'] ) )
	{
		foreach( $post_data['document_id'] as $document_id )
		{
			$xtpl->assign( 'DOCUMENT', $array_document[$document_id]['title'] );
			$xtpl->parse( 'main.document.loop' );
		}
		$xtpl->parse( 'main.document' );
	}

	if( !empty( $post_data['document_type_id'] ) )
	{
		foreach( $post_data['document_type_id'] as $document_type_id )
		{
			$xtpl->assign( 'DOCUMENT_TYPE', $array_document_type[$document_type_id]['title'] );
			$xtpl->parse( 'main.document_type.loop' );
		}
		$xtpl->parse( 'main.document_type' );
	}

	if( $jobseeker_id > 0 and $array_config['send_record'] )
	{
		$xtpl->parse( 'main.record_send' );
	}

	if( defined( 'NV_IS_USER' ) )
	{
		if( $post_data['post_saved'] )
		{
			$xtpl->parse( 'main.user.saved' );
		}
		else
		{
			$xtpl->parse( 'main.user.save' );
		}
		$xtpl->parse( 'main.user' );
	}
	else
	{
		$xtpl->parse( 'main.guest' );
	}

	if( defined( 'NV_IS_ADMIN' ) )
	{
		$url_edit = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=content&amp;id=' . $post_data['id'];
		$xtpl->assign( 'URL_EDIT', $url_edit );
		$xtpl->parse( 'main.admin' );
	}
	elseif( !empty( $user_info ) and $user_info['userid'] == $post_data['adduser'] )
	{
		$url_edit = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $module_info['alias']['content'] . '/' . $post_data['id'];
		$xtpl->assign( 'URL_EDIT', $url_edit );
		$xtpl->parse( 'main.admin' );
	}

	if( $is_image )
	{
		$xtpl->parse( 'main.image' );
	}

	if( $jobprovider_info['is_real'] )
	{
		$xtpl->parse( 'main.is_real' );
	}

	if( $post_data['is_hot'] )
	{
		$xtpl->parse( 'main.is_hot' );
	}

	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

/**
 * nv_theme_recruitment_print_post()
 *
 * @param mixed $array_data
 * @param mixed $jobprovider_info
 * @return
 */
function nv_theme_recruitment_print_post( $post_data, $jobprovider_info )
{
	global $global_config, $module_name, $module_file, $lang_global, $lang_module, $module_config, $module_info, $op, $array_document, $array_document_type, $user_info, $array_money_units;

	$post_data['salary'] = nv_salary_string( $post_data['salary_from'], $post_data['salary_to'], $post_data['money_units'] );
	$post_data['document_exp'] = !empty( $post_data['document_exp'] ) ? nv_date( 'd/m/Y', $post_data['document_exp'] ) : $lang_module['document_exp_unlimit'];
	$post_data['addtime'] = nv_date( 'H:i d/m/Y', $post_data['addtime'] );
	$post_data['quantity'] = !empty( $post_data['quantity'] ) ? $post_data['quantity'] : '';

	$xtpl = new XTemplate( 'print-post.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'GLANG', $lang_global );
	$xtpl->assign( 'ROW', $post_data );
	$xtpl->assign( 'JOBPROVIDER', $jobprovider_info );

	if( !empty( $post_data['document_id'] ) )
	{
		foreach( $post_data['document_id'] as $document_id )
		{
			$xtpl->assign( 'DOCUMENT', $array_document[$document_id]['title'] );
			$xtpl->parse( 'main.document.loop' );
		}
		$xtpl->parse( 'main.document' );
	}

	if( !empty( $post_data['document_type_id'] ) )
	{
		foreach( $post_data['document_type_id'] as $document_type_id )
		{
			$xtpl->assign( 'DOCUMENT_TYPE', $array_document_type[$document_type_id]['title'] );
			$xtpl->parse( 'main.document_type.loop' );
		}
		$xtpl->parse( 'main.document_type' );
	}

	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

/**
 * nv_theme_recruitment_search()
 *
 * @param mixed $array_data
 * @return
 */
function nv_theme_recruitment_search( $array_data )
{
	global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $op;

	$xtpl = new XTemplate( $op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
	$xtpl->assign( 'LANG', $lang_module );

	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

/**
 * nv_theme_recruitment_alert()
 *
 * @param mixed $message
 * @param mixed $type
 * @return
 */
function nv_theme_recruitment_alert( $message_title, $message_content, $type = 'info', $url_back = '', $time_back = 3 )
{
	global $module_file, $module_info, $lang_module, $page_title;

	$xtpl = new XTemplate( 'alert.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'CONTENT', $message_content );

	if( $type == 'success' )
	{
		$xtpl->parse( 'main.success' );
	}
	elseif( $type == 'warning' )
	{
		$xtpl->parse( 'main.warning' );
	}
	elseif( $type == 'danger' )
	{
		$xtpl->parse( 'main.danger' );
	}
	else
	{
		$xtpl->parse( 'main.info' );
	}

	if( !empty( $message_title ) )
	{
		$page_title = $message_title;
		$xtpl->assign( 'TITLE', $message_title );
		$xtpl->parse( 'main.title' );
	}
	else
	{
		$page_title = $module_info['custom_title'];
	}

	if( !empty( $url_back ) )
	{
		$xtpl->assign( 'TIME', $time_back );
		$xtpl->assign( 'URL', $url_back );
		$xtpl->parse( 'main.url_back' );
		$xtpl->parse( 'main.url_back_button' );
	}

	$xtpl->parse( 'main' );
	$contents = $xtpl->text( 'main' );

	include (NV_ROOTDIR . "/includes/header.php");
	echo nv_site_theme( $contents );
	include (NV_ROOTDIR . "/includes/footer.php");
	exit( );
}

/**
 * nv_theme_recruitment_list_post()
 *
 * @param mixed $array_data
 * @param mixed $generate_page
 * @return
 */
function nv_theme_recruitment_list_post( $array_data, $generate_page = '' )
{
	global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $op, $array_jobs,$array_province;

	$xtpl = new XTemplate( 'list_post.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
	$xtpl->assign( 'MODULE_FILE', $module_file );
	$xtpl->assign( 'TEMPLATE', $module_info['template'] );

	if( !empty( $array_data ) )
	{
		foreach( $array_data as $data )
		{	$array_jobs_tam = explode(',',$data['jobs_id']);
			$data['jobs_id'] = $array_jobs_tam[0];
			
			$data['title0'] = nv_clean60( $data['title'], 50 );
			$data['url_view_jobs'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $array_jobs[$data['jobs_id']]['alias'] . '/' . $data['alias'] . '-' . $data['id'];
			$data['url_view_provider'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $module_info['alias']['jobprovider'] . '/' . $data['jobprovider']['alias'] . '-' . $data['jobprovider']['id'];
			
			$data['salary_from'] = tms_price_number($data['salary_from']);
			$data['salary_to'] = tms_price_number($data['salary_to']);
			$data['addtime'] = nv_date( 'd/m/Y',$data['addtime']);
			if(!empty($data['salary_from']))
			{ $xtpl->assign( 'SALARY', $data['salary_from'].' - '.$data['salary_to'] );}
			 else { $xtpl->assign( 'SALARY', 'Thỏa thuận' );}
			 
			$xtpl->assign( 'DATA', $data );

			if( isset( $data['is_highlights'] ) and $data['is_highlights'] )
			{
				$xtpl->parse( 'main.data.loop.highlights' );
			}

			if( isset( $data['is_hot'] ) and $data['is_hot'] and $data['is_hot_icon'] )
			{
				$xtpl->parse( 'main.data.loop.hot_icon' );
			}
			$xtpl->parse( 'main.data.loop.salary' );
			$xtpl->parse( 'main.data.loop' );
		}

		if( !empty( $generate_page ) )
		{
			$xtpl->assign( 'PAGE', $generate_page );
			$xtpl->parse( 'main.data.generate_page' );
		}

		$xtpl->parse( 'main.data' );
	}

	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

/**
 * nv_theme_recruitment_list_post_detail()
 *
 * @param mixed $array_data
 * @param mixed $generate_page
 * @return
 */
function nv_theme_recruitment_list_post_detail( $array_data, $generate_page = '' )
{
	global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $op, $array_jobs, $array_money_units;

	$xtpl = new XTemplate( 'list_post_detail.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
	$xtpl->assign( 'MODULE_FILE', $module_file );
	$xtpl->assign( 'TEMPLATE', $module_info['template'] );

	if( !empty( $array_data ) )
	{
		foreach( $array_data as $post_data )
		{		
			
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
			
			$post_data['url_view_jobs'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $array_jobs[$work_jobs[0]]['alias'] . '/' . $post_data['alias'] . '-' . $post_data['id'];

			//$post_data['jobs'] = $array_jobs[$post_data['jobs_id']]['title'];
			$post_data['jobs_url1'] = $array_jobs[$work_jobs[0]]['link'];

			$post_data['salary'] = nv_salary_string( $post_data['salary_from'], $post_data['salary_to'], $post_data['money_units'] );
			$post_data['document_exp'] = !empty( $post_data['document_exp'] ) ? nv_date( 'd/m/Y', $post_data['document_exp'] ) : $lang_module['document_exp_unlimit'];

			$work_location = array();
			if( !empty( $post_data['province_id'] ) )
			{
				foreach( $post_data['province_id'] as $location_id )
				{
					$province_info = nv_location_get_province_info( $location_id );
					$work_location[] = $province_info['title'];
				}
			}
			$post_data['work_location'] = implode( ', ', $work_location );

			if( !empty( $post_data['jobprovider'] ) )
			{
				$post_data['jobprovider']['url_view_provider'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $module_info['alias']['jobprovider'] . '/' . $post_data['jobprovider']['alias'] . '-' . $post_data['jobprovider']['id'];
			}

			$post_data['title0'] = nv_clean60( $post_data['title'], 30 );

			$xtpl->assign( 'POST', $post_data );

			if( !empty( $post_data['jobprovider'] ) )
			{
				$xtpl->parse( 'main.data.loop.jobprovider' );
			}

			if( isset( $post_data['is_highlights'] ) and $post_data['is_highlights'] )
			{
				$xtpl->parse( 'main.data.loop.highlights' );
			}

			if( isset( $post_data['is_hot'] ) and $post_data['is_hot'] and $post_data['is_hot_icon'] )
			{
				$xtpl->parse( 'main.data.loop.hot_icon' );
			}

			$xtpl->parse( 'main.data.loop' );
		}

		if( !empty( $generate_page ) )
		{
			$xtpl->assign( 'PAGE', $generate_page );
			$xtpl->parse( 'main.data.generate_page' );
		}

		$xtpl->parse( 'main.data' );
	}
	else
	{
		$xtpl->parse( 'main.empty' );
	}

	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

/**
 * nv_theme_recruitment_jobprovider()
 *
 * @param mixed $array_data
 * @param mixed $post_new
 * @return
 */
function nv_theme_recruitment_jobprovider( $jobprovider_info, $post_new = array() )
{
	global $global_config, $module_name, $module_file, $lang_module, $module_upload, $module_config, $module_info, $array_jobs, $array_money_units, $user_info;

	$lang_module['jobprovider_post'] = sprintf( $lang_module['jobprovider_post'], $jobprovider_info['title'] );

	if( !empty( $jobprovider_info['image'] ) and file_exists( NV_UPLOADS_REAL_DIR . '/' . $module_upload . '/jobprovider_images/' . $jobprovider_info['image'] ) )
	{
		$jobprovider_info['image'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_upload . '/jobprovider_images/' . $jobprovider_info['image'];
	}

	$xtpl = new XTemplate( 'jobprovider.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'DATA', $jobprovider_info );

	foreach( $jobprovider_info as $key => $value )
	{
		if( !empty( $value ) )
		{
			$xtpl->parse( 'main.' . $key );
		}
	}

	if( !empty( $jobprovider_info['jobs_id'] ) )
	{
		foreach( $jobprovider_info['jobs_id'] as $jobs_id )
		{
			$viewjobs = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '/' . $array_jobs[$jobs_id]['alias'];
			$xtpl->assign( 'JOBS', array( 'title' => $array_jobs[$jobs_id]['title'], 'url' => $viewjobs ) );
			$xtpl->parse( 'main.jobs' );
		}
	}

	if( !empty( $post_new ) )
	{
		$xtpl->assign( 'POST', nv_theme_recruitment_list_post_detail( $post_new ) );
		$xtpl->parse( 'main.post_new' );
	}

	if( !empty( $user_info ) )
	{
		if( $jobprovider_info['userid'] == $user_info['userid'] )
		{
			$xtpl->parse( 'main.admin' );
		}
	}

	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

/**
 * nv_theme_recruitment_all_post()
 *
 * @param mixed $array_data
 * @param mixed $generate_page
 * @return
 */
function nv_theme_recruitment_all_post( $array_data, $generate_page = '' )
{
	global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $op, $array_jobs, $per_page;

	$xtpl = new XTemplate( 'all-post.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
	$xtpl->assign( 'LANG', $lang_module );

	if( !empty( $array_data ) )
	{
		$xtpl->assign( 'POST', nv_theme_recruitment_list_post_detail( $array_data, $generate_page ) );

		if( !empty( $array_jobs ) )
		{
			foreach( $array_jobs as $jobs )
			{
				$xtpl->assign( 'JOBS', $jobs );
				$xtpl->parse( 'main.post_new.jobs' );
			}
		}

		for( $i = $per_page; $i <= 50; $i += 5 )
		{
			$xtpl->assign( 'PER_PAGE', $i );
			$xtpl->parse( 'main.post_new.per_page' );
		}

		$xtpl->parse( 'main.post_new' );
	}

	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

/**
 * nv_theme_recruitment_hot_post()
 *
 * @param mixed $array_data
 * @param mixed $generate_page
 * @return
 */
function nv_theme_recruitment_hot_post( $array_data, $generate_page = '' )
{
	global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $op, $array_jobs, $per_page;

	$xtpl = new XTemplate( 'hot-post.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
	$xtpl->assign( 'LANG', $lang_module );

	if( !empty( $array_data ) )
	{
		$xtpl->assign( 'POST', nv_theme_recruitment_list_post_detail( $array_data, $generate_page ) );

		if( !empty( $array_jobs ) )
		{
			foreach( $array_jobs as $jobs )
			{
				$xtpl->assign( 'JOBS', $jobs );
				$xtpl->parse( 'main.post_new.jobs' );
			}
		}

		for( $i = $per_page; $i <= 50; $i += 5 )
		{
			$xtpl->assign( 'PER_PAGE', $i );
			$xtpl->parse( 'main.post_new.per_page' );
		}

		$xtpl->parse( 'main.post_new' );
	}

	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

/**
 * nv_theme_recruitment_list_record()
 *
 * @param mixed $array_data
 * @param mixed $generate_page
 * @return
 */
function nv_theme_recruitment_list_record( $array_data, $generate_page = '' )
{
	global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $op, $array_jobs;

	$xtpl = new XTemplate( 'list_record.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
	$xtpl->assign( 'MODULE_FILE', $module_file );
	$xtpl->assign( 'TEMPLATE', $module_info['template'] );

	if( !empty( $array_data ) )
	{
		foreach( $array_data as $data )
		{
			$data['title'] = !empty( $data['title'] ) ? $data['title'] : $array_jobs[$data['jobs_id']]['title'];
			$data['title0'] = nv_clean60( $data['title'], 30 );
			$data['url_view_record'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $module_info['alias']['view-record'] . '/' . $array_jobs[$data['jobs_id']]['alias'] . '-' . $data['id'];

			$xtpl->assign( 'DATA', $data );

			if( isset( $data['is_highlights'] ) and $data['is_highlights'] )
			{
				$xtpl->parse( 'main.data.loop.highlights' );
			}

			if( isset( $data['is_hot'] ) and $data['is_hot'] and $data['is_hot_icon'] )
			{
				$xtpl->parse( 'main.data.loop.hot_icon' );
			}

			$xtpl->parse( 'main.data.loop' );
		}

		if( !empty( $generate_page ) )
		{
			$xtpl->assign( 'PAGE', $generate_page );
			$xtpl->parse( 'main.data.generate_page' );
		}

		$xtpl->parse( 'main.data' );
	}
	else
	{
		$xtpl->parse( 'main.empty' );
	}

	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

/**
 * nv_theme_recruitment_list_record_detail()
 *
 * @param mixed $array_data
 * @param mixed $generate_page
 * @return
 */
function nv_theme_recruitment_list_record_detail( $array_data, $generate_page = '' )
{
	global $global_config, $module_name, $module_file, $lang_module, $module_config, $module_info, $op, $array_jobs;

	$xtpl = new XTemplate( 'list_record_detail.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'MODULE_FILE', $module_file );
	$xtpl->assign( 'TEMPLATE', $module_info['template'] );

	if( !empty( $array_data ) )
	{
		foreach( $array_data as $data )
		{
			$data['title'] = !empty( $data['title'] ) ? $data['title'] : $array_jobs[$data['jobs_id']]['title'];
			$data['title0'] = nv_clean60( $data['title'], 30 );
			$data['salary'] = nv_salary_string( $data['salary_from'], $data['salary_to'], $data['money_units'] );
			$data['updatetime'] = !empty( $data['updatetime'] ) ? nv_date( 'H:i d/m/Y', $data['updatetime'] ) : 'N/A';
			$data['url_view_record'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $module_info['alias']['view-record'] . '/' . $array_jobs[$data['jobs_id']]['alias'] . '-' . $data['id'];

			
			$work_location = array();
			if( !empty( $data['province_id'] ) )
			{
				foreach( $data['province_id'] as $location_id )
				{
					$province_info = nv_location_get_province_info( $location_id );
					$work_location[] = $province_info['title'];
				}
			}
			$data['work_location'] = implode( ', ', $work_location );

			$xtpl->assign( 'DATA', $data );

			if( isset( $data['is_highlights'] ) and $data['is_highlights'] )
			{
				$xtpl->parse( 'main.data.loop.highlights' );
			}

			if( isset( $data['is_hot'] ) and $data['is_hot'] and $data['is_hot_icon'] )
			{
				$xtpl->parse( 'main.data.loop.hot_icon' );
			}

			$xtpl->parse( 'main.data.loop' );
		}

		if( !empty( $generate_page ) )
		{
			$xtpl->assign( 'PAGE', $generate_page );
			$xtpl->parse( 'main.data.generate_page' );
		}

		$xtpl->parse( 'main.data' );
	}

	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

/**
 * nv_theme_recruitment_viewrecord()
 *
 * @param mixed $record_data
 * @param mixed $jobseeker_info
 * @param mixed $print
 * @return
 */
function nv_theme_recruitment_viewrecord( $record_data, $jobseeker_info, $print )
{
	global $global_config, $module_name, $module_file, $lang_global, $lang_module, $module_config, $module_info, $op, $user_info, $array_jobs, $array_position, $array_money_units, $array_worktype, $array_learning, $array_config;

	$jobseeker_info['birthday'] = !empty( $jobseeker_info['birthday'] ) ? nv_date( 'd/m/Y', $jobseeker_info['birthday'] ) : '';
	$jobseeker_info['gender'] = $lang_module['gender_' . $jobseeker_info['gender']];
	$jobseeker_info['marital'] = $lang_module['marital_' . $jobseeker_info['marital']];

	$record_data['url_print'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $module_info['alias']['view-record'] . '/' . $array_jobs[$record_data['jobs_id']]['alias'] . '-' . $record_data['id'] . '/print';
	
			$works = array();
			$work_jobs = array();
			if( !empty( $record_data['jobs_id'] ) )
			{
				$work_jobs = explode(',',$record_data['jobs_id']);
				foreach( $work_jobs as $jobs )
				{
					$link = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' .  $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $lang_module['link_record'] .'-'. $array_jobs[$jobs]['alias'];
					$works[] = '<a href="'. $link .'">' . $array_jobs[$jobs]['title'] . '</a>';
				}
			}
			$record_data['jobs'] = implode( ', ', $works );
			
			
	$record_data['position'] = $array_position[$record_data['position_id']]['title'];
	$record_data['learning'] = $array_learning[$record_data['learning_id']]['title'];
	if( !empty( $record_data['worktype_id'] ) )
	{
		$record_data['worktype'] = $array_worktype[$record_data['worktype_id']]['title'];
	}
	else
	{
		$record_data['worktype'] = '-';
	}
	$work_location = array();
	if( !empty( $record_data['province_id'] ) )
	{
				foreach( $record_data['province_id'] as $location_id )
				{
					$province_info = nv_location_get_province_info( $location_id );
					$work_location[] = $province_info['title'];
				}
				
				$record_data['work_location'] = implode( ', ', $work_location );
	}			
	else
	{
		$record_data['work_location'] = 'N/A';
	}
	$record_data['addtime'] = !empty( $record_data['addtime'] ) ? nv_date( 'd/m/Y', $record_data['addtime'] ) : '';

	$record_data['salary'] = nv_salary_string( $record_data['salary_from'], $record_data['salary_to'], $record_data['money_units'] );

	$tpl = !$print ? 'view-record.tpl' : 'print-record.tpl';
	$xtpl = new XTemplate( $tpl, NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'GLANG', $lang_global );
	$xtpl->assign( 'DATA', $record_data );
	$xtpl->assign( 'JOBSEEKER', $jobseeker_info );
	$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
	$xtpl->assign( 'MODULE_FILE', $module_file );
	
	if( !empty( $record_data['contact_more'] ) )
	{
		$xtpl->parse( 'main.view.contact_more' );
	}

	if( defined( 'NV_IS_ADMIN' ) )
	{
		$url_edit = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=record_content&amp;id=' . $record_data['id'];
		$xtpl->assign( 'URL_EDIT', $url_edit );
		$xtpl->parse( 'main.admin' );
	}
	elseif( !empty( $user_info ) and $user_info['userid'] == $record_data['userid'] )
	{
		$url_edit = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $module_info['alias']['record-content'] . '/' . $record_data['id'];
		$xtpl->assign( 'URL_EDIT', $url_edit );
		$xtpl->parse( 'main.admin' );
	}
	
	// cho phép xem thông tin ứng viên, nếu là thành viên đăng tin tuyển dụng thì được quyền xem. chính nó đăng
	
	if($array_config['show_info'] or (!$array_config['show_info'] and $record_data['userid'] == $user_info['userid']))
	{
		$xtpl->parse( 'main.view' );
	}
	else
	{
		$xtpl->parse( 'main.contact' );
	}
	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

/**
 * nv_theme_recruitment_viewjobs_record()
 *
 * @param mixed $record_data
 * @param mixed $page
 * @return
 */
function nv_theme_recruitment_viewjobs_record( $record_data, $page )
{
	global $module_info, $lang_module, $module_file, $array_jobs, $jobs_id;

	$xtpl = new XTemplate( 'viewjobs-record.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'JOBS', $array_jobs[$jobs_id] );

	if( !empty( $record_data ) )
	{
		$record_list = nv_theme_recruitment_list_record_detail( $record_data, $page );
		$xtpl->assign( 'RECORD_LIST', $record_list );
	}

	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

/**
 * nv_theme_recruitment_confirm()
 *
 * @return
 */
function nv_theme_recruitment_confirm()
{
	global $module_info, $lang_module, $module_file, $module_name;

	$xtpl = new XTemplate( 'confirm.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_file );
	$xtpl->assign( 'LANG', $lang_module );
	$xtpl->assign( 'URL_JOBPROVIDER', nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $module_info['alias']['jobprovider-content'], true ) );
	$xtpl->assign( 'URL_JOBSEEKER', nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&' . NV_OP_VARIABLE . '=' . $module_info['alias']['jobseeker'], true ) );

	$xtpl->parse( 'main' );
	return $xtpl->text( 'main' );
}

