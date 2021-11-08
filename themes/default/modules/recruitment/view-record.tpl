<!-- BEGIN: main -->
<link rel="StyleSheet" href="{NV_BASE_SITEURL}modules/{MODULE_FILE}/js/toastr.min.css">
<script type="text/javascript" src="{NV_BASE_SITEURL}modules/{MODULE_FILE}/js/toastr.min.js"></script>

<div class="viewjobs">
	<h1 class="m-bottom"><span class="label label-success">{DATA.code}</span> {DATA.title}</h1>
	<div class="pull-left">
		<p class="m-bottom"><strong>{LANG.viewjob_timepost}:</strong> {DATA.addtime} - <strong>{LANG.viewjob_viewcount}: </strong>{DATA.viewcount}</p>
	</div>
	<div class="pull-right">
		<a href="{DATA.url_print}" title="{LANG.record_print}" onclick="nv_open_print( $(this).attr('href') ); return false;"><em class="fa fa-print fa-lg" >&nbsp;</em>{LANG.viewrecord_print}</a>&nbsp;&nbsp;
		<span id="post_save">
		<!-- BEGIN: user -->
			<!-- BEGIN: saved -->
			<a href="#" title="{LANG.post_saved_drop}" onclick="nv_save_post({DATA.id}, 0); return false;"><em class="fa fa-save fa-lg" >&nbsp;</em>{LANG.post_saved}</a>
			<!-- END: saved -->
			<!-- BEGIN: save -->
			<a href="#" title="{LANG.post_save}" onclick="nv_save_post({DATA.id}, 1); return false;"><em class="fa fa-save fa-lg" >&nbsp;</em>{LANG.post_save}</a>
			<!-- END: save -->
		<!-- END: user -->
		</span>
		<!-- BEGIN: guest -->
		<a href="#" title="{LANG.post_save}" onclick="return loginForm();"><em class="fa fa-save fa-lg">&nbsp;</em>{LANG.post_save}</a>
		<!-- END: guest -->
	</div>
	<div class="clear"></div>
	<div class="panel panel-default">
		<div class="panel-heading">{LANG.viewrecord_jobseeker_info}</div>
		<div class="panel-body">
			<div class="pull-left image">
				<img src="{JOBSEEKER.photo}" class="img-thumbnail" />
			</div>
			<ul class="pull-left show">
				<li><strong>{LANG.fullname}:</strong> {JOBSEEKER.last_name} {JOBSEEKER.first_name}</li>
				<li><strong>{LANG.birthday}:</strong> {JOBSEEKER.birthday}</li>
				<li><strong>{LANG.gender}:</strong> {JOBSEEKER.gender}</li>
				<li><strong>{LANG.marital}:</strong> {JOBSEEKER.marital}</li>
			</ul>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">{LANG.viewrecord_jobseeker_info_contact}</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-7 row-title">{LANG.fullname}</div>
				<div class="col-md-17 row-content">{DATA.contact_fullname}</div>
			</div>
			<div class="row">
				<div class="col-md-7 row-title">{LANG.email}</div>
				<div class="col-md-17 row-content"><a href="mailto:{DATA.contact_email}" title="Mail to: {DATA.contact_email}">{DATA.contact_email}</a></div>
			</div>
			<div class="row">
				<div class="col-md-7 row-title">{LANG.phone}</div>
				<div class="col-md-17 row-content">{DATA.contact_phone}</div>
			</div>
			<!-- BEGIN: contact_more -->
			<div class="row">
				<div class="col-md-7 row-title">{LANG.contact_info_more}</div>
				<div class="col-md-17 row-content">{DATA.contact_more}</div>
			</div>
			<!-- END: contact_more -->
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">{LANG.viewrecord_job_wish}</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-7 row-title">{LANG.jobs}</div>
				<div class="col-md-17 row-content">{DATA.jobs}</div>
			</div>
			<div class="row">
				<div class="col-md-7 row-title">{LANG.position_id}</div>
				<div class="col-md-17 row-content">{DATA.position}</div>
			</div>
			<div class="row">
				<div class="col-md-7 row-title">{LANG.work_address}</div>
				<div class="col-md-17 row-content">{DATA.work_location}</div>
			</div>
			<div class="row">
				<div class="col-md-7 row-title">{LANG.salary}</div>
				<div class="col-md-17 row-content">{DATA.salary}</div>
			</div>
			<div class="row">
				<div class="col-md-7 row-title">{LANG.worktype_id}</div>
				<div class="col-md-17 row-content">{DATA.worktype}</div>
			</div>
			<div class="row">
				<div class="col-md-7 row-title">{LANG.target}</div>
				<div class="col-md-17 row-content">{DATA.target}</div>
			</div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">{LANG.viewrecord_academic_level}</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-7 row-title">{LANG.degreed}</div>
				<div class="col-md-17 row-content">{DATA.learning}</div>
			</div>
			<div class="row">
				<div class="col-md-7 row-title">{LANG.graduate_school}</div>
				<div class="col-md-17 row-content">{DATA.graduate_school}</div>
			</div>
			<div class="row">
				<div class="col-md-7 row-title">{LANG.graduate_year}</div>
				<div class="col-md-17 row-content">{DATA.graduate_year}</div>
			</div>
			<div class="row">
				<div class="col-md-7 row-title">{LANG.foreign_language}</div>
				<div class="col-md-17 row-content">{DATA.foreign_language}</div>
			</div>
			<div class="row">
				<div class="col-md-7 row-title">{LANG.degreed_other}</div>
				<div class="col-md-17 row-content">{DATA.degree}</div>
			</div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">{LANG.worked_experience}</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-7 row-title">{LANG.worked_company}</div>
				<div class="col-md-17 row-content">{DATA.worked_company}</div>
			</div>
			<div class="row">
				<div class="col-md-7 row-title">{LANG.worked_work}</div>
				<div class="col-md-17 row-content">{DATA.worked_work}</div>
			</div>
			<div class="row">
				<div class="col-md-7 row-title">{LANG.worked_position}</div>
				<div class="col-md-17 row-content">{DATA.worked_position}</div>
			</div>
			<div class="row">
				<div class="col-md-7 row-title">{LANG.time_experience}</div>
				<div class="col-md-17 row-content">{DATA.experience}</div>
			</div>
			<div class="row">
				<div class="col-md-7 row-title">{LANG.achievement}</div>
				<div class="col-md-17 row-content">{DATA.achievement}</div>
			</div>
			<div class="row">
				<div class="col-md-7 row-title">{LANG.skill}</div>
				<div class="col-md-17 row-content">{DATA.skill}</div>
			</div>
		</div>
	</div>
	
	<!-- BEGIN: admin -->
	<div class="text-center m-bottom">
		<a href="{URL_EDIT}" class="btn btn-success btn-xs"><em class="fa fa-edit">&nbsp;</em>{GLANG.edit}</a>
		<a href="" class="btn btn-danger btn-xs" onclick="nv_delete_record({DATA.id})"><em class="fa fa-edit">&nbsp;</em>{GLANG.delete}</a>
	</div>
	<!-- END: admin -->
</div>
<!-- END: main -->