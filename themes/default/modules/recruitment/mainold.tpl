<!-- BEGIN: main -->
<div class="recruitment">
	<!-- BEGIN: jobs -->
	<div class="panel panel-default">
		<div class="panel-heading">{LANG.search_jobs}</div>
		<div class="panel-body">
			<div class="row">
				<!-- BEGIN: loop -->
				<div class="col-sm-12 col-md-8 m-bottom">
					<a href="{JOBS.url_view}" title="{JOBS.title}">{JOBS.title} (<span class="text-danger">{JOBS.num_post}</span>)</a>
				</div>
				<!-- END: loop -->
			</div>
		</div>
	</div>
	<!-- END: jobs -->

	<div class="panel panel-default">
		<div class="panel-heading">
			<span class="pull-left">{LANG.work_new}</span>
			<span class="pull-right"><a href="{VIEWALL}" title="{LANG.viewall}">{LANG.viewall}...</a></span>
			<div class="clear"></div>
		</div>
		<div class="panel-body" id="post_new">
			<p class="text-center"><em class="fa fa-spinner fa-spin fa-3x">&nbsp;</em><br /><br /><em class="text-danger">{LANG.loading}</em></p>
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading">{LANG.work_mostview}</div>
		<div class="panel-body" id="most_view">
			<p class="text-center"><em class="fa fa-spinner fa-spin fa-3x">&nbsp;</em><br /><br /><em class="text-danger">{LANG.loading}</em></p>
		</div>
	</div>
</div>
<script>
	nv_get_post_new();
</script>
<!-- END: main -->