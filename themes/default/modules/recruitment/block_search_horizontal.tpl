<!-- BEGIN: main -->
<div class="block-search">
<!-- BEGIN: select2 -->
<link rel="stylesheet" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.css">
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.js"></script>
<!-- END: select2 -->

<form action="{BASE_URL_SITE}index.php" method="get">
	<input type="hidden" name="{NV_LANG_VARIABLE}" value="{NV_LANG_DATA}" />
	<input type="hidden" name="{NV_NAME_VARIABLE}" value="{MODULE_NAME}" />
	<input type="hidden" name="{NV_OP_VARIABLE}" value="{OP_NAME}" />

	<!-- BEGIN: search_chosen -->
	<div class="row">
		<div class="col-md-24">
			<div class="form-group text-center">
				<!-- BEGIN: loop -->
				<label><input type="radio" class="search_type" value="{SEARCH_TYPE.key}" {SEARCH_TYPE.checked} />{LANG.search} {SEARCH_TYPE.value}&nbsp;&nbsp;&nbsp;</label>
				<!-- END: loop -->
			</div>
		</div>
	</div>
	<!-- END: search_chosen -->
	<div class="row">
		<div class="col-md-24">
			<div class="form-group">
				<input type="text" class="form-control" name="q" value="{SEARCH.q}" placeholder="{LANG.search_title}" />
			</div>
		</div>
		
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-8">
			<div class="form-group">
				<select class="form-control" name="position_id">
					<option value="0"> ---{LANG.position_c}--- </option>
					<!-- BEGIN: position_id -->
					<option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
					<!-- END: position_id -->
				</select>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-8">
			<div class="form-group">
				<select class="form-control" name="jobs_id" id="jobs_id">
					<option value="0">---{LANG.jobs_c}---</option>
					<!-- BEGIN: jobs -->
					<option value="{JOBS.id}" {JOBS.selected}>{JOBS.title}</option>
					<!-- END: jobs -->
				</select>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-8">
			<div class="form-group">
				<select class="form-control" name="salary">
					<option value=""> ---{LANG.salary_c}-- </option>
					<!-- BEGIN: salary -->
					<option value="{SALARY.key}" {SALARY.selected}>{SALARY.value}</option>
					<!-- END: salary -->
				</select>
			</div>
		</div>
		{LOCATION}
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-6">
			<div class="form-group">
				<select class="form-control" name="worktype_id">
					<option value="0"> ---{LANG.worktype_id_c}--- </option>
					<!-- BEGIN: worktype -->
					<option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
					<!-- END: worktype -->
				</select>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-6">
			<div class="form-group">
				<select class="form-control" name="experience">
					<option value="-1"> ---{LANG.experiences_c}--- </option>
					<option value="0">{LANG.experiences_n}</option>
					<!-- BEGIN: experience -->
					<option value="{EXP.key}" {EXP.selected}>{EXP.key}</option>
					<!-- END: experience -->
				</select>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-6">
			<div class="form-group">
				<select class="form-control" name="learning_id">
					<option value="0">---{LANG.viewrecord_academic_level_c}---</option>
					<!-- BEGIN: learning -->
					<option value="{LEARNING.id}" {LEARNING.selected}>{LEARNING.title}</option>
					<!-- END: learning -->
				</select>
			</div>
		</div>	
		<div class="col-md-6">
			<input type="submit" class="btn btn-primary" value="{LANG.search}" style="width: 100%" />
		</div>		
	</div>
	<div class="row">
		
	</div>
	<div class="row">
		
	</div>
	<!-- BEGIN: search_chosen_hidden -->
	<input type="hidden" name="search" value="{VALUE}" id="search_chosen_hidden" />
	<!-- END: search_chosen_hidden -->
	<!-- BEGIN: search_jobs -->
	<input type="hidden" name="search" value="jobs" />
	<!-- END: search_jobs -->
	<!-- BEGIN: search_record -->
	<input type="hidden" name="search" value="record" />
	<!-- END: search_record -->
</form>
<script>
	$('#jobs_id, #location_id').select2();
	$('.search_type').change(function(){
		$('#search_chosen_hidden').val( $(this).val() );
	});
</script>
</div>
<!-- END: main -->