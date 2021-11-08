<!-- BEGIN: main -->
<div class="panel panel-default">
	<div class="panel-heading">
		<span class="pull-left">{LANG.record_new}</span>
		<span class="pull-right form-inline">
			<!-- BEGIN: jobs_new -->
			<select class="form-control input-sm" id="jobs_new" onchange="nv_get_record_condition('new')">
				<option value="0">{LANG.jobs_a}</option>
				<!-- BEGIN: loop -->
				<option value="{JOBS.id}">{JOBS.title}</option>
				<!-- END: loop -->
			</select>
			<!-- END: jobs_new -->
		</span>
		<div class="clear"></div>
	</div>
	<div class="panel-body" id="record_new">
		<p class="text-center"><em class="fa fa-spinner fa-spin fa-3x">&nbsp;</em><br /><br /><em class="text-danger">{LANG.loading}</em></p>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<span class="pull-left">{LANG.record_mostview}</span>
		<span class="pull-right form-inline">
			<!-- BEGIN: jobs_mostview -->
			<select class="form-control input-sm" id="jobs_mostview" onchange="nv_get_record_condition('mostview')">
				<option value="0">{LANG.jobs_a}</option>
				<!-- BEGIN: loop -->
				<option value="{JOBS.id}">{JOBS.title}</option>
				<!-- END: loop -->
			</select>
			<!-- END: jobs_mostview -->
		</span>
		<div class="clear"></div>
	</div>
	<div class="panel-body" id="record_mostview">
		<p class="text-center"><em class="fa fa-spinner fa-spin fa-3x">&nbsp;</em><br /><br /><em class="text-danger">{LANG.loading}</em></p>
	</div>
</div>

<!-- BEGIN: jobs_record -->
<div class="panel panel-default">
	<div class="panel-heading">{LANG.search_jobs}</div>
	<div class="panel-body">
		<div class="row">
			<!-- BEGIN: loop -->
			<div class="col-md-8 m-bottom">
				<a href="{JOBS.url_view}" title="{JOBS.title}">{JOBS.title} (<span class="text-danger">{JOBS.num_record}</span>)</a>
			</div>
			<!-- END: loop -->
		</div>
	</div>
</div>
<!-- END: jobs_record -->

<div id="ajax_loader" class="ajax-load-qa"> </div>

<script>
	nv_get_record('new');
	nv_get_record('mostview');
</script>
<!-- END: main -->