<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sat, 10 Dec 2011 06:46:54 GMT
 */

if( ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );

if( ! nv_function_exists( 'nv_block_recruitment' ) )
{
	function nv_block_recruitment( $block_config )
	{
		global $module_info, $site_mods, $module_name, $lang_module, $module_config, $global_config, $db, $user_info, $my_footer, $jobprovider_id, $jobprovider_alias, $jobseeker_id;

		$array = array();
		$module = $block_config['module'];
		$mod_data = $site_mods[$module]['module_data'];
		$mod_file = $site_mods[$module]['module_file'];
		$mod_alias = $site_mods[$module]['alias'];

		if( file_exists( NV_ROOTDIR . '/themes/' . $global_config['module_theme']  . '/modules/' . $mod_file . '/block_recruitment.tpl' ) )
		{
			$block_theme = $global_config['module_theme'] ;
		}
		else
		{
			$block_theme = 'default';
		}

		if( file_exists( NV_ROOTDIR . '/themes/' . $block_theme . '/js/' . $mod_file . '.js' ) )
		{
			$my_footer .= "<script type=\"text/javascript\" src=\"" . NV_BASE_SITEURL . "themes/" . $block_theme . "/js/" . $mod_file . ".js\"></script>\n";
		}

		if( $module != $module_name )
		{
			if( file_exists( NV_ROOTDIR . NV_BASE_SITEURL . 'modules/' . $mod_file . '/language/' . NV_LANG_INTERFACE . '.php' ) )
			{
				require_once NV_ROOTDIR . NV_BASE_SITEURL . 'modules/' . $mod_file . '/language/' . NV_LANG_INTERFACE . '.php';
			}
		}

		$xtpl = new XTemplate( 'block_recruitment.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/modules/' . $mod_file );
		$xtpl->assign( 'LANG', $lang_module );

		$is_show = 0;
		if( !defined( 'NV_IS_USER' ) )
		{
			$is_show = 1;
			$redirect = nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module . '&' . NV_OP_VARIABLE . '=' . $mod_alias['jobprovider-content'], true );
			$xtpl->assign( 'JOBPROVIDER_URL', NV_BASE_SITEURL . 'index.php?' . NV_NAME_VARIABLE . '=users&' . NV_OP_VARIABLE . '=register&nv_redirect=' . nv_redirect_encrypt( $redirect ) );

			$redirect = nv_url_rewrite( NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module . '&' . NV_OP_VARIABLE . '=' . $mod_alias['jobseeker'], true );
			$xtpl->assign( 'JOBSEEKER_URL', NV_BASE_SITEURL . 'index.php?' . NV_NAME_VARIABLE . '=users&' . NV_OP_VARIABLE . '=register&nv_redirect=' . nv_redirect_encrypt( $redirect ) );

			$xtpl->assign( 'LOGIN_URL', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=users&amp;' . NV_OP_VARIABLE . '=login' );

			$xtpl->parse( 'main.guest' );
		}
		else
		{
			// Xac dinh neu la nha tuyen dung
			if( $jobprovider_id > 0 )
			{
				$is_show = 1;
				$xtpl->assign( 'JOBPROVIDER_INFO_URL', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module . '&amp;' . NV_OP_VARIABLE . '=' . $mod_alias['jobprovider'] . '/' . $jobprovider_alias . '-' . $jobprovider_id );
				$xtpl->assign( 'JOBPROVIDER_URL', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module . '&amp;' . NV_OP_VARIABLE . '=' . $mod_alias['jobprovider-content'] );
				$xtpl->assign( 'LIST_NEWS_URL', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module . '&amp;' . NV_OP_VARIABLE . '=' . $mod_alias['list-post'] );
				$xtpl->assign( 'NEW_NEWS_URL', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module . '&amp;' . NV_OP_VARIABLE . '=' . $mod_alias['content'] );
				$xtpl->parse( 'main.user.jobprovider' );
			}
			else
			{
				// Xac dinh neu la ung vien
				if( $jobseeker_id > 0 )
				{
					$is_show = 1;
					$xtpl->assign( 'POST_SAVED_URL', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module . '&amp;' . NV_OP_VARIABLE . '=' . $mod_alias['list-post-saved'] );
					$xtpl->assign( 'JOBSEEKER_URL', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module . '&amp;' . NV_OP_VARIABLE . '=' . $mod_alias['jobseeker'] );
					$xtpl->assign( 'RECORD_URL', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module . '&amp;' . NV_OP_VARIABLE . '=' . $mod_alias['record'] );
					$xtpl->assign( 'RECORD_ADD_URL', NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module . '&amp;' . NV_OP_VARIABLE . '=' . $mod_alias['record-content'] );
					$xtpl->parse( 'main.user.jobseeker' );
				}
			}
			$xtpl->parse( 'main.user' );
		}

		if( !$is_show ) return '';

		$xtpl->parse( 'main' );
		return $xtpl->text( 'main' );
	}
}

if( defined( 'NV_SYSTEM' ) )
{
	global $site_mods, $module_name, $global_array_cat, $module_array_cat;

	$module = $block_config['module'];
	$content = nv_block_recruitment( $block_config );
}
