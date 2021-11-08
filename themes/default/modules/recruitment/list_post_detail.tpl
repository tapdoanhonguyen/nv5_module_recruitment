<!-- BEGIN: main -->

<!-- BEGIN: data -->
<div class="list-detail" id="list-post">
	<div class="row">
		<div class="col-md-7"><strong>{LANG.title}</strong></div>
		<div class="col-md-4"><strong>{LANG.jobs}</strong></div>
		<div class="col-md-4"><strong>{LANG.work_address}</strong></div>
		<div class="col-md-5"><strong>{LANG.salary}</strong></div>
		<div class="col-md-4"><strong>{LANG.document_exp}</strong></div>
	</div>
	<!-- BEGIN: loop -->
	<div class="row">
		<div class="col-md-7">
			<a href="{POST.url_view_jobs}" title="{POST.title}">
				<strong <!-- BEGIN: highlights -->class="highlights"<!-- END: highlights -->>{POST.title0}</strong>
				<!-- BEGIN: hot_icon -->
				<img src="{NV_BASE_SITEURL}themes/{TEMPLATE}/images/{MODULE_FILE}/icon_hot.gif" />
				<!-- END: hot_icon -->
			</a>
			<!-- BEGIN: jobprovider -->
			<small class="show"><a href="{POST.jobprovider.url_view_provider}" title="{POST.jobprovider.title}" class="text-success">{POST.jobprovider.title}</a></small>
			<!-- END: jobprovider -->
		</div>
		<div class="col-md-4">{POST.jobs}</div>
		<div class="col-md-4"><em class="fa fa-map-marker">&nbsp;</em>{POST.work_location}</div>
		<div class="col-md-5"><em class="fa fa-money">&nbsp;</em>{POST.salary}</div>
		<div class="col-md-4"><em class="fa fa-clock-o">&nbsp;</em>{POST.document_exp}</div>
	</div>
	<!-- END: loop -->

	<!-- BEGIN: generate_page -->
	<div class="text-center">{PAGE}</div>
	<!-- END: generate_page -->
</div>
<!-- END: data -->

<!-- BEGIN: empty -->
<div class="alert alert-danger text-center"><em class="fa fa-clone fa-lg">&nbsp;</em>{LANG.data_empty}</div>
<!-- END: empty -->

<!-- END: main -->