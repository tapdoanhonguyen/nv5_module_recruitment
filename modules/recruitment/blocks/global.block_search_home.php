<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sat, 10 Dec 2011 06:46:54 GMT
 */

if( ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );

if( ! nv_function_exists( 'nv_block_search_home' ) )
{
	function nv_block_config_search_home( $module, $data_block, $lang_block )
	{
		global $site_mods;

		$html = '';
		$html .= '<tr>';
		$html .= '<td>' . $lang_block['search_type'] . '</td>';
		$html .= '<td>';
		$html .= "<select name=\"config_search_type\" class=\"form-control w200\">\n";
		$sl = (isset( $data_block['search_type'] ) and $data_block['search_type'] == 'chosen') ? 'selected="selected"' : '';
		$html .= "<option value=\"chosen\" " . $sl . " >" . $lang_block['search_type_chosen'] . "</option>\n";
		$sl = (isset( $data_block['search_type'] ) and $data_block['search_type'] == 'jobs') ? 'selected="selected"' : '';
		$html .= "<option value=\"jobs\" " . $sl . " >" . $lang_block['search_type_jobs'] . "</option>\n";
		$sl = (isset( $data_block['search_type'] ) and $data_block['search_type'] == 'record') ? 'selected="selected"' : '';
		$html .= "<option value=\"record\" " . $sl . ">" . $lang_block['search_type_record'] . "</option>\n";
		$html .= "</select>\n";
		$html .= '</td>';
		$html .= '</tr>';
		$html .= '<tr>';
		$html .= '<td>' . $lang_block['search_template'] . '</td>';
		$html .= '<td>';
		$html .= "<select name=\"config_search_template\" class=\"form-control w200\">\n";
		$sl = (isset( $data_block['search_template'] ) and $data_block['search_template'] == 'vertical') ? 'selected="selected"' : '';
		$html .= "<option value=\"vertical\" " . $sl . " >" . $lang_block['search_template_vertical'] . "</option>\n";
		$sl = (isset( $data_block['search_template'] ) and $data_block['search_template'] == 'horizontal') ? 'selected="selected"' : '';
		$html .= "<option value=\"horizontal\" " . $sl . " >" . $lang_block['search_template_horizontal'] . "</option>\n";
		$html .= "</select>\n";
		$html .= '</td>';
		$html .= '</tr>';
		return $html;
	}

	function nv_block_config_search_home_submit( $module, $lang_block )
	{
		global $nv_Request;
		$return = array( );
		$return['error'] = array( );
		$return['config'] = array( );
		$return['config']['search_type'] = $nv_Request->get_title( 'config_search_type', 'post', 'jobs' );
		$return['config']['search_template'] = $nv_Request->get_title( 'config_search_template', 'post', 'vertical' );
		return $return;
	}

	/**
	 * numoney_to_strmoney()
	 *
	 * @param mixed $money
	 * @param mixed $mod_file
	 * @return
	 */
	function numoney_to_strmoney( $money, $mod_file )
	{
		include NV_ROOTDIR . '/modules/' . $mod_file . '/language/' . NV_LANG_DATA . '.php' ;
		if( $money > 1000 and $money < 1000000 )
		{
			$money = $money / 1000;
			return $money . ' ' . $lang_module['salary_thousand'];
		}
		elseif( $money >= 1000000 )
		{
			$money = $money / 1000000;
			return $money . ' ' . $lang_module['salary_million'];
		}
		return $money;
	}

	function nv_block_search_home( $block_config )
	{
		global $nv_Request, $module_info, $site_mods, $module_name, $lang_module, $module_config, $global_config, $array_jobs, $array_province, $array_worktype, $array_recruitment_position, $array_learning;

		$array = array();
		$module = $block_config['module'];
		$mod_data = $site_mods[$module]['module_data'];
		$mod_file = $site_mods[$module]['module_file'];
		$mod_alias = $site_mods[$module]['alias'];

		if( file_exists( NV_ROOTDIR . '/themes/' . $global_config['module_theme']  . '/modules/' . $mod_file . '/block_search_home.tpl' ) )
		{
			$block_theme = $global_config['module_theme'] ;
		}
		else
		{
			$block_theme = 'default';
		}

		if( $module != $module_name )
		{
			if( file_exists( NV_ROOTDIR . NV_BASE_SITEURL . 'modules/' . $mod_file . '/language/' . NV_LANG_INTERFACE . '.php' ) )
			{
				require_once NV_ROOTDIR . NV_BASE_SITEURL . 'modules/' . $mod_file . '/language/' . NV_LANG_INTERFACE . '.php';
			}
		}
		
		
		$array_search = array(
			'keyword' => (!empty($_SESSION['keyword'])) ? $_SESSION['keyword'] : $_SESSION['search']['q'],
			'jobs_id' => $_SESSION['search']['jobs_id'],
			'provinceid' => $_SESSION['search']['provinceid'],
			'districtid' => $_SESSION['search']['districtid'],
			'wardid' => $_SESSION['search']['wardid'],
			'salary' => $_SESSION['search']['salary'],
			'worktype_id' => $_SESSION['search']['worktype_id'],
			'position_id' => $_SESSION['search']['position_id'],
			'experience' => $_SESSION['search']['experience'],
			'learning_id' => $_SESSION['search']['learning_id'],
			'search' => $_SESSION['search']['search']
		);
		
		//PRINT_R($_SESSION['keyword']);DIE;
		
		$xtpl = new XTemplate( 'block_search_home.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/modules/' . $mod_file );
		$xtpl->assign( 'LANG', $lang_module );
		$xtpl->assign( 'BASE_URL_SITE', NV_BASE_SITEURL );
		$xtpl->assign( 'NV_LANG_VARIABLE', NV_LANG_VARIABLE );
		$xtpl->assign( 'NV_LANG_DATA', NV_LANG_DATA );
		$xtpl->assign( 'NV_NAME_VARIABLE', NV_NAME_VARIABLE );
		$xtpl->assign( 'MODULE_NAME', $module );
		$xtpl->assign( 'NV_OP_VARIABLE', NV_OP_VARIABLE );
		$xtpl->assign( 'OP_NAME', 'search' );
		$xtpl->assign( 'SEARCH', $array_search );
		$xtpl->assign( 'NV_ASSETS_DIR', NV_ASSETS_DIR );
		$allow_country = !empty( $allow_country ) ? implode( ',', $allow_country ) : '';
		$allow_province = !empty( $allow_province ) ? implode( ',', $allow_province ) : '';
		$allow_district = !empty( $allow_district ) ? implode( ',', $allow_district ) : '';
		$allow_ward = !empty( $allow_ward ) ? implode( ',', $allow_ward ) : '';
		$provinceid = !empty( $array_search['provinceid'] ) ?  $array_search['provinceid']  : 0;
		$districtid = !empty( $array_search['districtid'] ) ?  $array_search['districtid'] : 0;
		$wardid = !empty( $array_search['wardid'] ) ?  $array_search['wardid']  : 0;
		$countryid = nv_location_get_countryid_from_province( $provinceid );
		
		
		$data_config = array(
			'select_countyid' => $countryid,
			'select_provinceid' => $provinceid,
			'select_districtid' => $districtid,
			'allow_country' => $allow_country,
			'allow_province' => $allow_province,
			'allow_district' => $allow_district,
			'is_district' => true,
			'multiple_province' => false
		);
		//print_r($data_config);die;
		$xtpl->assign( 'LOCATION', nv_location_build_input( $data_config ) );
		if( !empty( $array_jobs ) )
		{
			foreach( $array_jobs as $jobs )
			{
				$jobs['selected'] = $jobs['id'] == $array_search['jobs_id'] ? 'selected="selected"' : '';
				$xtpl->assign( 'JOBS', $jobs );
				$xtpl->parse( 'main.jobs' );
			}
		}
		unset( $array_part_list );

		

		$block_config['price_step'] = 1000000;
		$block_config['price_begin'] = 1000000;
		$block_config['price_end'] = 20000000;

		$val = $block_config['price_begin'];

		while( true )
		{
			$salary_from = $val;
			$salary_to = $val + $block_config['price_step'];
			$arr_price = array();
			if( $val < $block_config['price_end'] )
			{
				$sl = $array_search['salary'] == $salary_from . '-' . $salary_to ? 'selected="selected"' : '';
				$title = numoney_to_strmoney( $salary_from, $mod_file ) . ' - ' . numoney_to_strmoney( $salary_to, $mod_file );
				$arr_salary = array( 'key' => $salary_from . '-' . $salary_to, 'value' => $title, 'selected' => $sl );
			}
			elseif( $val >= $block_config['price_end'] )
			{
				$sl = $array_search['salary'] == $salary_from ? 'selected="selected"' : '';
				$title = $lang_module['salary_over'] . ' - ' . numoney_to_strmoney( $val, $mod_file );
				$arr_salary = array( 'key' => $salary_from, 'value' => $title, 'to' => $salary_to, 'selected' => $sl );
			}

			$xtpl->assign( 'SALARY', $arr_salary );
			$xtpl->parse( 'main.salary' );

			if( $val >= $block_config['price_end'] )
			{
				break;
			}
			$val += $block_config['price_step'];
		}

		if( !empty( $array_worktype ) )
		{
			foreach( $array_worktype as $value )
			{
				$xtpl->assign( 'OPTION', array(
					'key' => $value['id'],
					'title' => $value['title'],
					'selected' => ($value['id'] == $array_search['worktype_id']) ? ' selected="selected"' : ''
				) );
				$xtpl->parse( 'main.worktype' );
			}
		}

		foreach( $array_recruitment_position as $key => $value )
		{
			$xtpl->assign( 'OPTION', array(
				'key' => $value['id'],
				'title' => $value['title'],
				'selected' => $value['id'] == $array_search['position_id'] ? ' selected="selected"' : ''
			) );
			$xtpl->parse( 'main.position_id' );
		}

		if( !empty( $array_learning ) )
		{
			foreach( $array_learning as $learning )
			{
				$learning['selected'] = $learning['id'] == $array_search['learning_id'] ? 'selected="selected"' : '';
				$xtpl->assign( 'LEARNING', $learning );
				$xtpl->parse( 'main.learning' );
			}
		}

		for( $i = 1; $i <= 10; $i++ )
		{
			$xtpl->assign( 'EXP', array( 'key' => $i, 'selected' => $i == $array_search['experience'] ? 'selected="selected"' : '' ) );
			$xtpl->parse( 'main.experience' );
		}

		if( !defined( 'SELECT2' ) )
		{
			define( 'SELECT2', true );
			$xtpl->parse( 'main.select2' );
		}

		if( $block_config['search_type'] == 'jobs' )
		{
			$xtpl->parse( 'main.search_jobs' );
		}
		elseif( $block_config['search_type'] == 'record' )
		{
			$xtpl->parse( 'main.search_record' );
		}
		elseif( $block_config['search_type'] == 'chosen' )
		{
			$array_search_type = array(
				'jobs' => $lang_module['work'],
				'record' => $lang_module['record']
			);
			foreach( $array_search_type as $key => $value )
			{
				$ck = $key == $array_search['search'] ? 'checked="checked"' : '';
				$xtpl->assign( 'SEARCH_TYPE', array( 'key' => $key, 'value' => $value, 'checked' => $ck ) );
				$xtpl->parse( 'main.search_chosen.loop' );
			}
			$xtpl->parse( 'main.search_chosen' );

			$xtpl->assign( 'VALUE', $array_search['search'] );
			$xtpl->parse( 'main.search_chosen_hidden' );
		}

		$xtpl->parse( 'main' );
		return $xtpl->text( 'main' );
	}
}

if( defined( 'NV_SYSTEM' ) )
{
	global $site_mods, $module_name, $array_jobs, $array_recruitment_position, $array_province, $array_learning, $nv_Cache, $array_worktype ;

	$module = $block_config['module'];
	$mod_data = $site_mods[$module]['module_data'];

	if( $module != $module_name )
	{
		require_once NV_ROOTDIR . '/modules/location/data.functions.php';
		
		

		$sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $mod_data . '_jobs WHERE status=1 ORDER BY weight';
		$array_jobs = $nv_Cache->db( $sql, 'id', $module );

		$sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $mod_data . '_learning WHERE status=1 ORDER BY weight';
		$array_learning = $nv_Cache->db( $sql, 'id', $module );

		// Loai hinh cong viec
		$sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $mod_data . '_worktype WHERE status=1';
		
		$array_worktype = $nv_Cache->db( $sql, 'id', $module );
	}

	// Tinh/Thanh pho
	$array_province = nv_location_get_province( 1 );

	// Vi tri cong viec
	$sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $mod_data . '_position WHERE status=1';
	$array_recruitment_position = $nv_Cache->db( $sql, 'id', $module );

	$content = nv_block_search_home( $block_config );
}