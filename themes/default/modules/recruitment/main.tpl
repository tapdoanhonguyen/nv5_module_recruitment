<!-- BEGIN: main -->
	<div class="tms_box">
		<div class="tms_new_title">
			<span class="pull-left">{LANG.work_new}</span>
			<span class="pull-right tms_more_title"><a href="{VIEWALL}" title="{LANG.viewall}">{LANG.viewall}...</a></span>
			<div class="clear"></div>
		</div>
		<div class="tms_box_body" id="post_new">
			<p class="text-center"><em class="fa fa-spinner fa-spin fa-3x">&nbsp;</em><br /><br /><em class="text-danger">{LANG.loading}</em></p>
		</div>
	</div>
<div class="quangcao">
[bodyqc]
</div>
<div class="recruitment">
<!-- Nav tabs -->
<ul class="nav nav-tabs">
  <li class="nav-item active">
    <a class="nav-link active" data-toggle="tab" href="#search_jobs">{LANG.search_jobs}</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#search_city">{LANG.search_city}</a>
  </li>

</ul>


<div class="tab-content tms_primary">
  <div class="tab-pane active container" id="search_jobs">
  	<!-- BEGIN: jobs -->
		<div class="panel-body">
			<div class="row">
				<!-- BEGIN: loop -->
				<div class="col-sm-12 col-md-8 m-bottom">
					<a href="{JOBS.url_view}" title="{JOBS.title}">{JOBS.title} (<span class="text-danger">{JOBS.num_post}</span>)</a>
				</div>
				<!-- END: loop -->
			</div>
		</div>
	<!-- END: jobs -->
  </div>
  <div class="tab-pane container" id="search_city">
    	<!-- BEGIN: province -->
		<div class="panel-body">
			<div class="row">
				<!-- BEGIN: loop -->
				<div class="col-sm-12 col-md-6 m-bottom">
					<a href="{CITY.url_view}" title="{CITY.title}">{CITY.title} (<span class="text-danger">{CITY.number}</span>)</a>
				</div>
				<!-- END: loop -->
			</div>
		</div>
	<!-- END: province -->
  </div>
</div>
<div class="quangcao">
[bodyqc1]
</div>
<div class="clear"></div>
<div class="tms_box">
<div class="tms_view_title">{LANG.work_mostview}</div>
<div class="tms_box_body" id="most_view">
<p class="text-center"><em class="fa fa-spinner fa-spin fa-3x">&nbsp;</em><br /><br /><em class="text-danger">{LANG.loading}</em></p>
</div>
</div>
</div>
<script>
	nv_get_post_new();
	

</script>
<!-- END: main -->