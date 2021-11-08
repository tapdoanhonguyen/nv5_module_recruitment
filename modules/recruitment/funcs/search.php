<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Fri, 19 Jun 2015 07:33:37 GMT
 */

if ( ! defined( 'NV_IS_MOD_RECRUITMENT' ) ) die( 'Stop!!!' );

$page_title = $module_info['custom_title'];
$table_name = NV_PREFIXLANG . '_' . $module_data;
$base_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $op;

$contents = '';
$array_data = array();
$base_url_rewrite = $request_uri = urldecode( $_SERVER['REQUEST_URI'] );
$where = '';

//print_r($_SESSION['keyword']);die;

// XỬ LÝ LINK TÌM KIẾM


//https://nhansuvang.com/recruitment/Quan-ly-Tuyen-nhan-vien-lap-trinh-php-Thanh-Pho-Ho-Chi-Minh-Quan-1-Phuong-Ben-Thanh-Cong-viec-tri-tue-vi-tri-Nhan-vien-ky-thuat-trinh-do-Cao-dang-kinh-nghiem-4-nam.html

$q = '';
$jobs_id = 0;
$districtid = 0;
$provinceid = 0;
$wardid = 0;
$salary = '';
$worktype_id = 0;
$position_id = 0;
$experience = 0;
$learning_id = 0;
$search = 'jobs';


$keyword_end = $array_op[0];
$base_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $keyword_end;
if(!empty($keyword_end))
{

	// LẤY RA HỒ SƠ HAY TUYỂN DỤNG
	// Tuyen-dung
	
	$search_type = explode('-',$keyword_end);
	
	// ghép 2 mảng đầu tiên lại để xem nó thuộc loại nào
	$tuyendung = 'Tuyen-dung';
	$hoso = 'Ho-so';
	
	$type_search = 'jobs';
	
	if(count($search_type) >= 2)
	{
		$ghep_type = $search_type[0] . '-' . $search_type[1];
		if($ghep_type == $hoso )
		{
			$type_search = 'record';
			
			$Replacement = '';
			$keyword_end = preg_replace('/'. $hoso .'/', $Replacement, $keyword_end, 1);
		}
		else
		{
			$type_search = 'jobs';
			$Replacement = '';
			$keyword_end = preg_replace('/'. $tuyendung .'/', $Replacement, $keyword_end, 1);
		}
	
	}
	
	$keyword_end = clear_fix($keyword_end);

	// lọc ra -kinh-nghiem-
	$kinhnghiem = explode('kinh-nghiem-',$keyword_end);
	
	if(!empty($kinhnghiem[count($kinhnghiem) - 1]))
	{
	
		$kinhnghiem_cuoi = $kinhnghiem[count($kinhnghiem) - 1];
		
		$kinhnghiem_array = explode('-nam',$kinhnghiem_cuoi);
	
		if(!empty($kinhnghiem_array))
		{
			if(is_numeric($kinhnghiem_array[0]) and empty($kinhnghiem_array[1]))
			{
				// LẤY ID NĂM KINH NGHIỆM RA
				$experience = $kinhnghiem_array[0];
			}
			
			if($experience > 0)
			{
					$keyword_end = '';
					for($j = 0; $j < count($kinhnghiem) - 1; $j++)
					{
						
						if(empty($keyword_end))
							$keyword_end = $kinhnghiem[$j];
						else
						{
							$keyword_end = $keyword_end . 'kinh-nghiem-'. $kinhnghiem[$j];
						}
						
					}
					
			}
					
					
		}
			
		
	}
	
	
	if(!empty($keyword_end))
	{
	$keyword_end = clear_fix($keyword_end);
	// lọc ra -trinh-do-
	$trinhdo = explode('trinh-do-',$keyword_end);
	
	if(!empty($trinhdo[count($trinhdo) - 1]))
	{
	
		$trinhdo_cuoi = $trinhdo[count($trinhdo) - 1];
		
		if(!empty($trinhdo_cuoi))
		{
			
			// LẤY ID TRÌNH ĐỘ 
			
			$learning_id = $db->query( 'SELECT id FROM ' . $table_name . '_learning WHERE alias ="' . $db_slave->dblikeescape($trinhdo_cuoi) .'"' )->fetchColumn();
			
			if($learning_id > 0)
			{
					$keyword_end = '';
					for($j = 0; $j < count($trinhdo) - 1; $j++)
					{
						
						if(empty($keyword_end))
							$keyword_end = $trinhdo[$j];
						else
						{
							$keyword_end = $keyword_end . 'trinh-do-'. $trinhdo[$j];
						}
						
					}
					
			}
					
					
		}
			
		
	}
	
	}
	
	
	if(!empty($keyword_end))
	{
	$keyword_end = clear_fix($keyword_end);
	// lọc ra -vi-tri-
	$vitri = explode('vi-tri-',$keyword_end);
	
	if(!empty($vitri[count($vitri) - 1]))
	{
	
		$vitri_cuoi = $vitri[count($vitri) - 1];
		
		if(!empty($vitri_cuoi))
		{
			
			// LẤY ID TRÌNH ĐỘ 
			
			$position_id = $db->query( 'SELECT id FROM ' . $table_name . '_position WHERE alias ="' . $db_slave->dblikeescape($vitri_cuoi) .'"' )->fetchColumn();
			
			if($position_id > 0)
			{
					$keyword_end = '';
					for($j = 0; $j < count($vitri) - 1; $j++)
					{
						
						if(empty($keyword_end))
							$keyword_end = $vitri[$j];
						else
						{
							$keyword_end = $keyword_end . 'vi-tri-'. $vitri[$j];
						}
						
					}
					
			}
					
					
		}
			
		
	}
	
	}
	
	
	
	if(!empty($keyword_end))
	{
	$keyword_end = clear_fix($keyword_end);
	// lọc ra -Cong viec-
	
	foreach($array_worktype as $worktype )
	{
		$chuoi_cat = explode($worktype['alias'],$keyword_end);
		
		if(count($chuoi_cat) > 1)
		{
			$keyword = rtrim($chuoi_cat[0], '-');
			$worktype_id = $worktype['id'];
			$keyword_end = $keyword;
			break;
		}
	}
	
	}
	
	
	
	// LƯƠNG
	
	if(!empty($keyword_end))
	{
	$keyword_end = clear_fix($keyword_end);
	// lọc ra -luong-
	$luong = explode('luong-',$keyword_end);
	
	if(!empty($luong[count($luong) - 1]))
	{
	
		$luong_cuoi = $luong[count($luong) - 1];
		
		$luong_array = explode('-trieu',$luong_cuoi);
	
		if(!empty($luong_array))
		{
			if(is_numeric($luong_array[0]) and !empty($luong_array[1]))
			{
				$salary = $luong_array[0] * 1000000 . $luong_array[1] * 1000000;
			}
			
			if(!empty($salary))
			{
					$keyword_end = '';
					for($j = 0; $j < count($luong) - 1; $j++)
					{
						
						if(empty($keyword_end))
							$keyword_end = $luong[$j];
						else
						{
							$keyword_end = $keyword_end . 'luong-'. $luong[$j];
						}
						
					}
					
			}
					
					
		}
			
		
	}
	
	}
	
	
	
	// TỈNH THÀNH QUẬN HUYỆN XÃ PHƯỜNG 
	
	
	
	$key_tinhthanh = '';
	$type_tinhthanh = '';
	
	// LẤY TỈNH THÀNH RA
	
		if(!empty($keyword_end))
		{
			$keyword_end = clear_fix($keyword_end);
			
			// lọc ra quận -Thanh-Pho-
			$tinhthanh_quanhuyen = explode('Thanh-Pho-',$keyword_end);
			 
			if(count($tinhthanh_quanhuyen) == 1)
			{
				if(count($tinhthanh_quanhuyen) == 1)
				{
					$tinhthanh_quanhuyen = explode('Tinh-',$keyword_end);
					$key_tinhthanh = 'Tinh-';
					$type_tinhthanh = 'Tỉnh';
				}
			}
			else
			{
				$key_tinhthanh = 'Thanh-Pho-';
				$type_tinhthanh = 'Thành Phố';
			}
			
			
			$tinhthanh_quanhuyen_tam = $tinhthanh_quanhuyen[count($tinhthanh_quanhuyen) - 1];
			
			if(!empty($tinhthanh_quanhuyen_tam))
			{
				// LẤY ID TỈNH THÀNH NÀY RA
				
				$id_quan_tam = $db->query('SELECT provinceid FROM ' . $db_config['prefix'] .'_location_province WHERE alias ="'. $tinhthanh_quanhuyen_tam .'" AND type ="'.$type_tinhthanh.'"')->fetchColumn();
				
				if($id_quan_tam > 0)
				{
					$provinceid = $id_quan_tam;
					
					$keyword_end = '';
					for($j = 0; $j < count($tinhthanh_quanhuyen) - 1; $j++)
					{
						
						if(empty($keyword_end))
							$keyword_end = $tinhthanh_quanhuyen[$j];
						else
						{
							$keyword_end = $keyword_end . $key_tinhthanh . $tinhthanh_quanhuyen[$j];
						}
						
					}
				}
			}
		
		}
	
	
	if(!empty($keyword_end) and $provinceid > 0)
	{
	$keyword_end = clear_fix($keyword_end);
	$key_quan_huyen = '';
	$type_quan_huyen = '';
	$id_quan = $id_tinhthanh = 0; 
	
	if(!empty($keyword_end))
	{
	
		// lọc ra quận -Quan- -Huyen- -Thi-Xa-
		
		$tinhthanh_quanhuyen = explode('Quan-',$keyword_end);
		
		if(count($tinhthanh_quanhuyen) == 1)
		{
			$tinhthanh_quanhuyen = explode('Huyen-',$keyword_end);
			$key_quan_huyen = 'Huyen-';
			$type_quan_huyen = 'Huyện';
			
			if(count($tinhthanh_quanhuyen) == 1)
			{
				$tinhthanh_quanhuyen = explode('-Thi-Xa-',$keyword_end);
				$key_quan_huyen = 'Thi-Xa-';
				$type_quan_huyen = 'Thị Xã';
			}
		}
		else
		{
			$key_quan_huyen = 'Quan-';
			$type_quan_huyen = 'Quận';
		}
		
		
		
		$tinhthanh_quanhuyen_tam = $tinhthanh_quanhuyen[count($tinhthanh_quanhuyen) - 1];
		
		if(!empty($tinhthanh_quanhuyen_tam))
		{
			// LẤY ID QUẬN NÀY RA
			
			$id_quan_tam = $db->query('SELECT districtid, provinceid FROM ' . $db_config['prefix'] .'_location_district WHERE alias ="'. $tinhthanh_quanhuyen_tam .'" AND provinceid ='. $provinceid .' AND type ="'.$type_quan_huyen.'"')->fetch();
		
			if($id_quan_tam['districtid'] > 0)
			{
				$districtid = $id_quan_tam['districtid'];
				$provinceid = $id_quan_tam['provinceid'];
				
				$keyword_end = '';
				
					for($j = 0; $j < count($tinhthanh_quanhuyen) - 1; $j++)
					{
						
						if(empty($keyword_end))
							$keyword_end = $tinhthanh_quanhuyen[$j];
						else
						{
							$keyword_end = $keyword_end . $key_quan_huyen . $tinhthanh_quanhuyen[$j];
						}
						
					}
					
			}
		}
	
	}
	
	
		
		
	}
		
	// KẾT THÚC QUẬN HUYỆN XÃ PHƯỜNG
	
	
	// NGHÀNH NGHỀ
	
	$q  = $keyword_end;
	
	if(!empty($keyword_end))
	{	$i = 1;
		foreach($array_jobs as $jobs)
		{
			$chuoi_cat = explode($jobs['alias'],$keyword_end);
			
			if(count($chuoi_cat) > 1)
			{
				$keyword_tam = substr( $chuoi_cat[1] , 1 );
				$jobs_id = $jobs['id'];
				$q = $keyword_tam;
					
				break;
			}
			$i++;
		}
	
	}
	
	// LỌC LẠI TỪ KHÓA CHO ĐÚNG CHUẨN
	if(!empty($q))
	{
		// cắt bỏ các ký tự - dư thừa trước sau.
		$q = clear_fix($q);
		
	}
	
	
	
}




// KẾT THÚC XỬ LÝ LINK TÌM KIẾM

$array_search = array(
	'keyword' => $_SESSION['keyword'],
	'q' => $q,
	'jobs_id' => $jobs_id,
	'provinceid' => $provinceid,
	'districtid' => $districtid,
	'wardid' => $wardid,
	'salary' => $salary,
	'worktype_id' => $worktype_id,
	'position_id' => $position_id,
	'experience' => $experience,
	'learning_id' => $learning_id,
	'search' => $type_search
);

$_SESSION['search'] = $array_search;

 
//print_r($array_search);die;

if( !empty( $array_search['q'] ) )
{
	if( $array_search['search'] == 'jobs' )
	{
		$where .= ' AND (title LIKE "%' . $array_search['q'] . '%"
		OR code LIKE "%' . $array_search['q'] . '%"
		OR alias LIKE "%' . $array_search['q'] . '%"
		OR degree LIKE "%' . $array_search['q'] . '%"
		OR job_description LIKE "%' . $array_search['q'] . '%"
		OR more_requirement LIKE "%' . $array_search['q'] . '%"
		OR contact_fullname LIKE "%' . $array_search['q'] . '%"
		OR contact_email LIKE "%' . $array_search['q'] . '%"
		OR contact_phone LIKE "%' . $array_search['q'] . '%"
		)';
	}
	elseif( $array_search['search'] == 'record' )
	{
		$where .= ' AND (title LIKE "%' . $array_search['q'] . '%"
		OR code LIKE "%' . $array_search['q'] . '%"
		OR alias LIKE "%' . $array_search['q'] . '%"
		OR graduate_school LIKE "%' . $array_search['q'] . '%"
		OR graduate_year LIKE "%' . $array_search['q'] . '%"
		OR degree LIKE "%' . $array_search['q'] . '%"
		OR worked_company LIKE "%' . $array_search['q'] . '%"
		OR worked_work LIKE "%' . $array_search['q'] . '%"
		OR worked_position LIKE "%' . $array_search['q'] . '%"
		OR target LIKE "%' . $array_search['q'] . '%"
		OR achievement LIKE "%' . $array_search['q'] . '%"
		OR skill LIKE "%' . $array_search['q'] . '%"
		)';
	}
}



if( empty( $array_search['salary'] ) )
{
	$base_url_rewrite = str_replace('&salary=' . $array_search['salary'], '', $base_url_rewrite );
}
else
{
	$salary = explode( '-', $array_search['salary'] );
	if( sizeof( $salary ) == 2 )
	{
		$where .= ' AND t1.salary_from <= ' . $salary[0] . ' AND t1.salary_to >= ' . $salary[1];
	}
}

if( empty( $array_search['worktype_id'] ) )
{
	$base_url_rewrite = str_replace('&worktype_id=' . $array_search['worktype_id'], '', $base_url_rewrite );
}
else
{
	$where .= ' AND worktype_id=' . $array_search['worktype_id'];
}

if( empty( $array_search['position_id'] ) )
{
	$base_url_rewrite = str_replace( '&position_id=' . $array_search['position_id'], '', $base_url_rewrite );
}
else
{
	$where .= ' AND position_id=' . $array_search['position_id'];
}

if( empty( $array_search['learning_id'] ) )
{
	$base_url_rewrite = str_replace('&learning_id=' . $array_search['learning_id'], '', $base_url_rewrite );
}
else
{
	$where .= ' AND learning_id=' . $array_search['learning_id'];
}

if($array_search['experience'] > 0 )
{
	$where .= ' AND experience=' . $array_search['experience'];
}


if( !empty( $array_search['search'] ))
{
	if( $array_search['search'] == 'jobs' )
	{
		$db->sqlreset()
		  ->select( 'COUNT(distinct t1.id)' )
		  ->from( $table_name . '_rows t1' )
		  ->where( 't1.status=1' . $where );
		$join = '';
			
		if( !empty( $array_search['provinceid'] ) )
		{
			$join .= ' INNER JOIN ' . $table_name . '_rows_province t2 ON t1.id=t2.rows_id AND t2.province_id =' .  $array_search['provinceid'];
		}
		if( !empty( $array_search['districtid'] ) )
		{
			$join .= ' INNER JOIN ' . $table_name . '_rows_district t3 ON t1.id=t3.rows_id AND t3.district_id =' .  $array_search['districtid'];
		}
		if( !empty( $array_search['wardid'] ) )
		{
			$join .= ' INNER JOIN ' . $table_name . '_rows_ward t4 ON t1.id=t3.rows_id AND t4.ward_id =' .  $array_search['wardid'];
		}
		
		if( !empty( $array_search['jobs_id'] ) )
		{
			$join .= ' INNER JOIN ' . $table_name . '_job_jobs t4 ON t1.id=t4.job_id AND t4.jobs_id =' .  $array_search['jobs_id'];
		}

		
		$db->join($join);
		
		$num_items = $db->query( $db->sql() )->fetchColumn();
		//$per_page = 2;
		if( preg_match( '/^page\-([0-9]+)$/', ( isset( $array_op[1] ) ? $array_op[1] : '' ), $m ) )
		{
			$page = ( int )$m[1];
		}
		
		
		
		$db->select( 'distinct t1.id, t1.*' )
		  ->order( 't1.id DESC' )
		  ->limit( $per_page )
		  ->offset( ($page - 1) * $per_page );
		$_query = $db->query( $db->sql() );
		
		//die($db->sql());
		
		while( $row = $_query->fetch() )
		{
			$row['jobprovider'] = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobprovider WHERE id=' . $row['jobprovider_id'] )->fetch();

			$row['province_id'] = array();
			$_result = $db->query( 'SELECT province_id FROM ' . $table_name . '_rows_province WHERE rows_id=' . $row['id'] );
			while( list( $province_id ) = $_result->fetch( 3 ) )
			{
				$row['province_id'][] = $province_id;
			}
			$array_data[] = $row;
		}
	}
	elseif( $array_search['search'] == 'record' )
	{
		

		
		
		if( !empty( $array_search['provinceid'] ) ){
		$where .= ' AND t2.provinceid=' . $array_search['provinceid'];
		}
		if( !empty( $array_search['districtid'] ) ){
			$where .= ' AND t2.districtid=' . $array_search['districtid'];
		}
		if( !empty( $array_search['wardid'] ) ){
			$where .= ' AND t2.wardid=' . $array_search['wardid'];
		}
		
		
		
		$db->sqlreset()
		  ->select( 'COUNT(distinct t1.id)' )
		  ->from( $table_name . '_record t1' )
		  ->where( 't1.status=1' . $where );
		  
		$join = '';	
		if( !empty( $array_search['provinceid'] ) )
		{
			$join .= ' INNER JOIN ' . $table_name . '_record_wlocation t2 ON t1.id=t2.record_id' ;
		}
		
		if( !empty( $array_search['jobs_id'] ) )
		{
			$join .= ' INNER JOIN ' . $table_name . '_record_jobs t3 ON t1.id=t3.record_id AND t3.jobs_id =' .  $array_search['jobs_id'];
		}

		
		$db->join($join);
		  
		//print($db->sql());die;

		$num_items = $db->query( $db->sql() )->fetchColumn();
		
		//$per_page = 2;
		if( preg_match( '/^page\-([0-9]+)$/', ( isset( $array_op[1] ) ? $array_op[1] : '' ), $m ) )
		{
			$page = ( int )$m[1];
		}

		$db->select( 'distinct t1.id, t1.*' )
		  ->order( 't1.id DESC' )
		  ->limit( $per_page )
		  ->offset( ($page - 1) * $per_page );

		$_query = $db->query( $db->sql() );
		while( $row = $_query->fetch() )
		{
			$row['jobseeker'] = $db->query( 'SELECT * FROM ' . NV_PREFIXLANG . '_' . $module_data . '_jobseeker WHERE id=' . $row['jobseeker_id'] )->fetch();
			
			$row['province_id'] = array();
			
			$_result = $db->query( 'SELECT distinct provinceid FROM ' . $table_name . '_record_wlocation WHERE record_id=' . $row['id'] );
			while( list( $province_id ) = $_result->fetch( 3 ) )
			{
				$row['province_id'][] = $province_id;
			}
			
			$array_data[] = $row;
		}
	}

	$nv_alias_page = nv_alias_page( $page_title, $base_url, $num_items, $per_page, $page );
	$contents = nv_theme_recruitment_jobs_search( $array_search['search'], $array_data, $nv_alias_page );
}


// LƯU THÔNG TIN TÌM KIẾM VÀO TRONG CSDL

// LẤY LẠI THÔNG TIN TIÊU ĐỀ LINK TÌM KIẾM


if(!empty($array_op[0]))
{
	// KIỂM TRA ALIAS NÀY ĐÃ TỒN TẠI CHƯA
	
	$module_data_link_search = 'link_search';
	// KIỂM TRA ALIAS NÀY ĐÃ TỒN TẠI TRONG CSDL CHƯA
	$link_title = $db->query('SELECT title FROM ' . NV_PREFIXLANG . '_' . $module_data_link_search . ' WHERE alias = "'. $array_op[0] .'"')->fetchColumn();
	
	
	if(empty($link_title))
	{
		if($array_search['jobs_id'] > 0)
		{
			$link_title .= ' ' . $array_jobs[$array_search['jobs_id']]['title'];
		}
		
		if(!empty($_SESSION['keyword']))
		{
			$link_title .= ' ' . $_SESSION['keyword'];
		}
		elseif(!empty($array_search['q']))
		{
			$link_title .= ' ' . $array_search['q'];
		}
		
		if($array_search['districtid'] > 0)
		{
			
			$districtid_new = $db->query('SELECT type, title FROM ' . $db_config['prefix'] .'_location_district WHERE districtid ='. $array_search['districtid'])->fetch();
			if(!empty($districtid_new))
			$link_title .= ' ' . $districtid_new['type'] . ' ' .  $districtid_new['title'];
		}
		
		if($array_search['provinceid'] > 0)
		{
			$provinceid_new = $db->query('SELECT type, title FROM ' . $db_config['prefix'] .'_location_province WHERE provinceid ='. $array_search['provinceid'])->fetch();
			if(!empty($provinceid_new))
			$link_title .= ' ' . $provinceid_new['type'] . ' ' .  $provinceid_new['title'];
		}
		
		if(!empty($array_search['salary']))
		{
			$array_salary = explode('-',$array_search['salary']);
			if($array_salary[0] > 0 and $array_salary[1] > 0)
			{
			$salary_tu = $array_salary[0]/1000000;
			$salary_den = $array_salary[1]/1000000;
			$link_title .= ' lương ' . $salary_tu . ' triệu đến ' .  $salary_den . ' triệu';
			}
		}
		
		if($array_search['worktype_id'] > 0)
		{
			$link_title .= ' ' . $array_worktype[$array_search['worktype_id']]['title'];
		}
		
		if($array_search['position_id'] > 0)
		{
			$link_title .= ' vị trí ' . $array_position[$array_search['position_id']]['title'];
		}
		
		if($array_search['learning_id'] > 0)
		{
			$link_title .= ' trình độ ' . $array_learning[$array_search['learning_id']]['title'];
		}
		
		if($array_search['experience'] > 0)
		{
			$link_title .= ' kinh nghiệm ' . $array_search['experience'] . ' năm';
		}
	
	}
	else
	{
		$keyword = $db->query('SELECT keyword FROM ' . NV_PREFIXLANG . '_' . $module_data_link_search . ' WHERE alias = "'. $array_op[0] .'"')->fetchColumn();
		$_SESSION['keyword'] = $keyword;
	}
	
	//die($link_title);
	
}

if(!empty($array_op[0]) and !empty($link_title))
{
	$page_title = $link_title;
	$module_data_link_search = 'link_search';
	// KIỂM TRA ALIAS NÀY ĐÃ TỒN TẠI TRONG CSDL CHƯA
	$tontai = $db->query('SELECT id FROM ' . NV_PREFIXLANG . '_' . $module_data_link_search . ' WHERE alias = "'. $array_op[0] .'"')->fetchColumn();
	
	if($tontai)
	{
		// cập nhật num và ngày
		$db->query( 'UPDATE ' . NV_PREFIXLANG . '_' . $module_data_link_search . ' SET num = num + 1, date =' . NV_CURRENTTIME . ' WHERE id = '. $tontai);
	}
	else
	{
		
		$row['id'] = 0;
		$row['title'] = $link_title;
		$row['alias'] = $array_op[0];
		$row['keyword'] = (!empty($array_search['keyword'])) ? $array_search['keyword'] : $array_search['q'];
		$row['image'] = '';
		$row['des'] = '';
		$row['num'] = 1;
		$row['date'] = NV_CURRENTTIME;
		
		$stmt = $db->prepare( 'INSERT INTO ' . NV_PREFIXLANG . '_' . $module_data_link_search . ' (weight, title, alias, keyword, image, des, num, date, status) VALUES (:weight, :title, :alias, :keyword, :image, :des, :num, :date, :status)' );

		$weight = $db->query( 'SELECT max(weight) FROM ' . NV_PREFIXLANG . '_' . $module_data_link_search . '' )->fetchColumn();
		$weight = intval( $weight ) + 1;
		$stmt->bindParam( ':weight', $weight, PDO::PARAM_INT );

		$stmt->bindValue( ':status', 1, PDO::PARAM_INT );
	
		$stmt->bindParam( ':title', $row['title'], PDO::PARAM_STR );
		$stmt->bindParam( ':alias', $row['alias'], PDO::PARAM_STR );
		$stmt->bindParam( ':keyword', $row['keyword'], PDO::PARAM_STR );
		$stmt->bindParam( ':image', $row['image'], PDO::PARAM_STR );
		$stmt->bindParam( ':des', $row['des'], PDO::PARAM_STR, strlen($row['des']) );
		$stmt->bindParam( ':num', $row['num'], PDO::PARAM_INT );
		$stmt->bindParam( ':date', $row['date'], PDO::PARAM_INT );
		
		$exc = $stmt->execute();
	
	}


}
// KẾT THÚC LƯU THÔNG TIN TÌM KIẾM VÀO CSDL


//PRINT_R($_SESSION['keyword']);DIE;
include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme( $contents );
include NV_ROOTDIR . '/includes/footer.php';