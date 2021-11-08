<!-- BEGIN: main -->
<style type="text/css">
	body {
		font-size: 12px;
		background: #FFFFFF;
	}
	#print{
		padding: 10px;
	}
	#print h2, #print h3, #print h4{
		text-transform: uppercase;
		text-align: center;
		font-weight: bold
	}
</style>

<script type="text/javascript">
	$(document).ready(function() {
	    window.print();
	});
</script>

<div id="print" class="viewjobs">
	<h1 class="m-bottom"><span class="label label-success">{DATA.code}</span> {DATA.title}</h1>
	<p class="m-bottom"><strong>{LANG.viewjob_timepost}:</strong> {DATA.addtime} - <strong>{LANG.viewjob_viewcount}: </strong>{DATA.viewcount}</p>
	<div class="panel panel-default">
		<div class="panel-heading">{LANG.viewrecord_jobseeker_info}</div>
		<div class="panel-body">
			<div class="pull-left image">
				<img src="{JOBSEEKER.photo}" class="img-thumbnail" />
			</div>
			<ul>
				<li><strong>{LANG.fullname}:</strong> {JOBSEEKER.last_name} {JOBSEEKER.first_name}</li>
				<li><strong>{LANG.birthday}:</strong> {JOBSEEKER.birthday}</li>
				<li><strong>{LANG.gender}:</strong> {JOBSEEKER.gender}</li>
				<li><strong>{LANG.marital}:</strong> {JOBSEEKER.marital}</li>
			</ul>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">{LANG.viewrecord_job_wish}</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-7 row-title">{LANG.jobs}</div>
				<div class="col-md-17 row-content"><a href="{DATA.jobs.link}" title="{DATA.jobs.title}">{DATA.jobs.title}</a></div>
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
</div>
<!-- END: main -->