<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sat, 10 Dec 2011 06:46:54 GMT
 */

if( ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );

if( ! nv_function_exists( 'nv_block_groups_gap_gap' ) )
{
	function nv_block_config_groups_gap( $module, $data_block, $lang_block )
	{
		global $site_mods,$nv_Cache;

		$html_input = '';
		$html = '';
		$html .= '<tr>';
		$html .= '<td>' . $lang_block['blockid'] . '</td>';
		$html .= '<td><select name="config_blockid" class="form-control w200">';
		$html .= '<option value="0"> -- </option>';
		$sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $site_mods[$module]['module_data'] . '_block_cat ORDER BY weight ASC';
		$list = $nv_Cache->db( $sql, '', $module );
		foreach( $list as $l )
		{
			$html_input .= '<input type="hidden" id="config_blockid_' . $l['bid'] . '" value="' . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module . '&amp;' . NV_OP_VARIABLE . '=' . $site_mods[$module]['alias']['groups'] . '/' . $l['alias'] . '" />';
			$html .= '<option value="' . $l['bid'] . '" ' . ( ( $data_block['blockid'] == $l['bid'] ) ? ' selected="selected"' : '' ) . '>' . $l['title'] . '</option>';
		}
		$html .= '</select>';
		$html .= $html_input;
		$html .= '<script type="text/javascript">';
		$html .= '	$("select[name=config_blockid]").change(function() {';
		$html .= '		$("input[name=title]").val($("select[name=config_blockid] option:selected").text());';
		$html .= '		$("input[name=link]").val($("#config_blockid_" + $("select[name=config_blockid]").val()).val());';
		$html .= '	});';
		$html .= '</script>';
		$html .= '</tr>';
		$html .= '<tr>';
		$html .= '<td>' . $lang_block['numrow'] . '</td>';
		$html .= '<td><input type="text" class="form-control w200" name="config_numrow" size="5" value="' . $data_block['numrow'] . '"/></td>';
		$html .= '</tr>';
		return $html;
	}

	function nv_block_config_groups_gap_submit( $module, $lang_block )
	{
		global $nv_Request;
		$return = array();
		$return['error'] = array();
		$return['config'] = array();
		$return['config']['blockid'] = $nv_Request->get_int( 'config_blockid', 'post', 0 );
		$return['config']['numrow'] = $nv_Request->get_int( 'config_numrow', 'post', 0 );
		return $return;
	}

	
/**
 * nv_price_number_tostring()
 *
 * @param mixed $num            
 * @return
 *
 */
if( ! nv_function_exists( 'nv_price_number_tostring' ) )
{
	function nv_price_number_tostring($num = false, $pricetime = 0)
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


}
	
	
	function nv_block_groups_gap( $block_config )
	{
		global $module_info,$nv_Cache, $site_mods, $module_config, $global_config, $db, $array_jobs;

		$module = $block_config['module'];

		$db->sqlreset()
			->select( 't1.id, t1.title, t1.alias,t1.salary_from,t1.salary_to, t1.addtime, t1.jobs_id, t1.jobprovider_id' )
			->from( NV_PREFIXLANG . '_' . $site_mods[$module]['module_data'] . '_rows t1' )
			->join( 'INNER JOIN ' . NV_PREFIXLANG . '_' . $site_mods[$module]['module_data'] . '_block t2 ON t1.id = t2.id' )
			->where( 't2.bid= ' . $block_config['blockid'] . ' AND t1.status= 1' )
			->order( 't2.weight ASC' )
			->limit( $block_config['numrow'] );

		$list = $nv_Cache->db( $db->sql(), '', $module );

		if( ! empty( $list ) )
		{
			if( file_exists( NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/recruitment/block_groups_gap.tpl' ) )
			{
				$block_theme = $global_config['module_theme'];
			}
			else
			{
				$block_theme = 'default';
			}
			$xtpl = new XTemplate( 'block_groups_gap.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/modules/recruitment' );
			 $xtpl->assign('NV_BASE_SITEURL', NV_BASE_SITEURL);
            $xtpl->assign('TEMPLATE', $block_theme);

			foreach( $list as $l )
			{
				
				$l['jobprovider'] = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $site_mods[$module]['module_data'] . '_jobprovider WHERE id=' . $l['jobprovider_id'] )->fetch();
				$post_new[$l['id']] = $l;
				$l['jobprovider_url'] =  NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module . '&amp;' . NV_OP_VARIABLE . '=jobprovider/' . $l['jobprovider']['alias'] . '-' . $l['jobprovider']['id'];
				$jobprovider_img =  $l['jobprovider']['image'];
				$l['jobprovider_title'] =   $l['jobprovider']['title'];
				if (! empty ($jobprovider_img)) {
                   $l['jobprovider_img'] =  NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $site_mods[$module]['module_upload'] . '/jobprovider_images/' . $l['jobprovider']['image'];
                } 
				else {
                   $l['jobprovider_img'] = '/themes/' . $block_theme . '/images/recruitment/no_photo.png';
                }
				
				
				$array_jobs_tam = explode(',',$l['jobs_id']);
				$l['jobs_id'] = $array_jobs_tam[0];
				$l['link'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module . '&amp;' . NV_OP_VARIABLE . '=' . $array_jobs[$l['jobs_id']]['alias'] . '/' . $l['alias'] . '-' . $l['id'];
				$l['salary_from'] = nv_price_number_tostring($l['salary_from']);
				$l['salary_to'] = nv_price_number_tostring($l['salary_to']);
				$l['addtime'] = nv_date( 'd/m/Y',$l['addtime']);
				
				if(!empty($l['salary_from']))
				{ $xtpl->assign( 'SALARY', $l['salary_from'].' - '.$l['salary_to'] );}
			    else { $xtpl->assign( 'SALARY', 'Thỏa thuận' );}
				
			
				
				$xtpl->assign( 'ROW', $l );
				$xtpl->parse( 'main.loop.salary' );
				$xtpl->parse( 'main.loop' );
			}

			$xtpl->parse( 'main' );
			return $xtpl->text( 'main' );
		}
	}
}

if( defined( 'NV_SYSTEM' ) )
{
	global $site_mods, $module_name, $array_jobs;

	$module = $block_config['module'];

	if( isset( $site_mods[$module] ) )
	{
		if( $module != $module_name )
		{
			$sql = 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $site_mods[$module]['module_data'] . '_jobs WHERE status=1 ORDER BY weight';
			$array_jobs = $nv_Cache->db( $sql, 'id', $module );
		}
		$content = nv_block_groups_gap( $block_config );
	}
}
