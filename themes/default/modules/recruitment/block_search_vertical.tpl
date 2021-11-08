<!-- BEGIN: main -->

<!-- BEGIN: select2 -->
<link rel="stylesheet" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.css">
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.js"></script>
<!-- END: select2 -->

<form class="content_form_block" action="{BASE_URL_SITE}index.php" method="post">
	<!-- BEGIN: search_chosen -->
	<div class="form-group text-center">
		<!-- BEGIN: loop -->
		<label><input name="search_type" type="radio" class="search_type" value="{SEARCH_TYPE.value}" {SEARCH_TYPE.checked} />{SEARCH_TYPE.value}&nbsp;&nbsp;&nbsp;</label>
		<!-- END: loop -->
	</div>
	<!-- END: search_chosen -->
	
	<div class="row">
		<div class="col-sm-16 col-md-10">
			<input type="text" class="form-control" name="keyword" value="{SEARCH.keyword}" />
		</div>
		
		<div class="col-sm-16 col-md-4">
			<select class="form-control" name="jobs_id" id="jobs_id">
				<option value="0">---{LANG.jobs_c}---</option>
				<!-- BEGIN: jobs -->
				<option value="{JOBS.id}" {JOBS.selected}>{JOBS.title}</option>
				<!-- END: jobs -->
			</select>
		</div>
		<div class="col-sm-16 col-md-4">
			<select onchange="tinhthanh(this)" name="provinceid" class="form-control tinhthanh">
			<option value="0">-- {LANG.selected_city} --</option>
			<!-- BEGIN: tinh -->
			<option value="{l.provinceid}" {l.selected}>{l.type} {l.title}</option>
			<!-- END: tinh -->
			</select>
			</div>
				
			<div class="col-sm-16 col-md-4">
			<select onchange="quanhuyen(this)" name="districtid" class="form-control quanhuyen">
			<option value="0">-- {LANG.selected_district} --</option>
			<!-- BEGIN: quan -->
			<option {l.selected} value="{l.districtid}">-- {l.type} {l.title} --</option>
			<!-- END: quan -->
			</select>
			</div>
	
	</div>
	
	<div class="row">
	<div class="col-sm-16 col-md-4">
		<select class="form-control" name="salary">
			<option value=""> ---{LANG.salary_c}-- </option>
			<!-- BEGIN: salary -->
			<option value="{SALARY.key}" {SALARY.selected}>{SALARY.value}</option>
			<!-- END: salary -->
		</select>
	</div>
	<div class="col-sm-16 col-md-4">
		<select class="form-control" name="worktype_id">
			<option value="0"> ---{LANG.worktype_id_c}--- </option>
			<!-- BEGIN: worktype -->
			<option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
			<!-- END: worktype -->
		</select>
	</div>
	<div class="col-sm-16 col-md-4">
		<select class="form-control" name="position_id">
			<option value="0"> ---{LANG.position_c}--- </option>
			<!-- BEGIN: position_id -->
			<option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
			<!-- END: position_id -->
		</select>
	</div>
<div class="col-sm-16 col-md-4">
		<select class="form-control" name="learning_id">
			<option value="0">---{LANG.viewrecord_academic_level_c}---</option>
			<!-- BEGIN: learning -->
			<option value="{LEARNING.id}" {LEARNING.selected}>{LEARNING.title}</option>
			<!-- END: learning -->
		</select>
	</div>
	<div class="col-sm-16 col-md-4">
		<select class="form-control" name="experience">
			<option value="-1"> ---{LANG.experiences_c}--- </option>
			<option value="0">{LANG.experiences_n}</option>
			<!-- BEGIN: experience -->
			<option value="{EXP.key}" {EXP.selected}>{EXP.key} {LANG.year}</option>
			<!-- END: experience -->
		</select>
	</div>
	</div>
	
	
	<div class="text-center">
		<!-- BEGIN: search_chosen_hidden -->
		<input type="hidden" name="search" value="{VALUE}" id="search_chosen_hidden" />
		<!-- END: search_chosen_hidden -->
		<!-- BEGIN: search_jobs -->
		<input type="hidden" name="search" value="jobs" />
		<!-- END: search_jobs -->
		<!-- BEGIN: search_record -->
		<input type="hidden" name="search" value="record" />
		<!-- END: search_record -->
		<div class="text-right button_block_search">
				<span class="bton_search btn btn-primary">{LANG.search}</span>
		</div>
	</div>
</form>


<script>

	function tinhthanh(a){
		var tinhthanh = $(a).val();
		if(tinhthanh > 0)
		{
				$.post(nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '={MODULE_NAME}&' + nv_fc_variable + '=config&id_tinhthanh=' + tinhthanh, function(res) {
				
					$('.quanhuyen').html(res);
					
				});
		}
		}
		
		
	$('.bton_search').click(function(){
	
		var search = '';
		
		var search_type = $('.content_form_block input[name=search_type]:checked').val();
		if(search_type != '')
		{
			search = search + '-' + search_type ;
		}
		
		var jobs_id = $('.content_form_block select[name=jobs_id] option:selected').val();
		if(jobs_id > 0)
		{
			jobs_text = $('.content_form_block select[name=jobs_id] option:selected').text();
			search = search + '-' + jobs_text ;
		}
		var key = $('.content_form_block input[name=keyword]').val();
		if(key != '')
		search = search + '-' + key ;
		
		var dia_diem = '';
		  
		var districtid = $('.content_form_block select[name=districtid] option:selected').val();
		if(districtid > 0)
		  dia_diem = $('.content_form_block select[name=districtid] option:selected').text();
		  
		var value_province = $('.content_form_block select[name=provinceid] option:selected').val();
		if(value_province > 0)
		  dia_diem = dia_diem + '-' + $('.content_form_block select[name=provinceid] option:selected').text();
		  
		/*  
		var wardid = $('.content_form_block select[name=wardid] option:selected').val();
		if(wardid > 0)
		  dia_diem = dia_diem + '-' + $('.content_form_block select[name=wardid] option:selected').text();
		*/  
		  
		if(dia_diem != '')
		search = search + '-' + dia_diem ;
		
		
		var salary = $('.content_form_block select[name=salary] option:selected').val();
		
		if(salary != '')
		{
			salary_text = $('.content_form_block select[name=salary] option:selected').text();
			search = search + '-luong-' + salary_text ;
		}
		
		  
		var worktype = $('.content_form_block select[name=worktype_id] option:selected').val();
		if(worktype > 0)
		{
			worktype_text = $('.content_form_block select[name=worktype_id] option:selected').text();
			search = search + '-' + worktype_text ;
		}
		
		
		
		var position_id = $('.content_form_block select[name=position_id] option:selected').val();
		
		if(position_id > 0)
		{
			position_text = $('.content_form_block select[name=position_id] option:selected').text();
			search = search + '-vi-tri-' + position_text ;
		}
		
		
		var learning_id = $('.content_form_block select[name=learning_id] option:selected').val();
		
		if(learning_id > 0)
		{
			learning_text = $('.content_form_block select[name=learning_id] option:selected').text();
			search = search + '-trinh-do-' + learning_text ;
		}
		
		var experience = $('.content_form_block select[name=experience] option:selected').val();
		
		if(experience > 0)
		{
			experience_text = $('.content_form_block select[name=experience] option:selected').text();
			search = search + '-kinh-nghiem-' + experience_text ;
		}
		
		// xử lý lưu keyword vào session 
		
		session_keyword(key);
			
		var link = link_alias(search);
		
		if(link == '/')
			link = '/timkiem';
		$('.content_form_block').attr('action', link);   
		$('.content_form_block').submit();
		
		
		
	});
	
	function session_keyword(key)
	{
	
		$.ajax({
				type : 'POST',
				async: false,
				url : nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '={MODULE_NAME}&' + nv_fc_variable + '=main',
				data : { get_alias_key : key},
				success : function(res){
					
				}
			});
		
	}
	
	function link_alias(title)
	{
	var html = '';
	if (title != '') {
		$.ajax({
				type : 'POST',
				async: false,
				url : nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '={MODULE_NAME}&' + nv_fc_variable + '=main',
				data : { get_alias_title : title},
				success : function(res){
					html = res;
				}
			});
		}
		return html;
	}
	
</script>



<script>
	$('#jobs_id, #location_id').select2();
	$('.search_type').change(function(){
		$('#search_chosen_hidden').val( $(this).val() );
	});
</script>
<!-- END: main -->