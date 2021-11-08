<!-- BEGIN: main -->

<!-- BEGIN: post_new -->
<h1 class="wtitle pull-left">{LANG.work_new}</h1>
<div class="form-inline text-center pull-right">
	<select id="jobs" class="form-control input-sm" onchange="nv_get_post_new_condition()">
		<option value="0">{LANG.jobs_a}</option>
		<!-- BEGIN: jobs -->
		<option value="{JOBS.id}">{JOBS.title}</option>
		<!-- END: jobs -->
	</select>
	<select id="per_page" class="form-control input-sm" onchange="nv_get_post_new_condition()">
		<!-- BEGIN: per_page -->
		<option value="{PER_PAGE}">{PER_PAGE}</option>
		<!-- END: per_page -->
	</select>
</div>
<div class="clearfix"></div>
<div id="list-post">{POST}</div>
<div id="ajax_loader" class="ajax-load-qa"> </div>
<!-- END: post_new -->

<!-- END: main -->