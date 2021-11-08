<!-- BEGIN: main -->

<!-- BEGIN: data -->
<div class="list-detail" id="list-record">
	<div class="row">
		<div class="col-md-7"><strong>{LANG.record_title}</strong></div>
		<div class="col-md-4"><strong>{LANG.time_experience}</strong></div>
		<div class="col-md-4"><strong>{LANG.work_address}</strong></div>
		<div class="col-md-5"><strong>{LANG.salary}</strong></div>
		<div class="col-md-4"><strong>{LANG.updatetime}</strong></div>
	</div>
	<!-- BEGIN: loop -->
	<div class="row">
		<div class="col-md-7">
			<a href="{DATA.url_view_record}" title="{DATA.title}">
				<strong <!-- BEGIN: highlights -->class="highlights"<!-- END: highlights -->>{DATA.title0}</strong>
				<!-- BEGIN: hot_icon -->
				<img src="{NV_BASE_SITEURL}themes/{TEMPLATE}/images/{MODULE_FILE}/icon_hot.gif" />
				<!-- END: hot_icon -->
			</a>
			<small class="show"><a href="{DATA.url_view_record}" title="{DATA.jobseeker.title}" class="text-success">{DATA.jobseeker.last_name} {DATA.jobseeker.first_name}</a></small>
		</div>
		<div class="col-md-4"><em class="fa fa-industry">&nbsp;</em>{DATA.experience} {LANG.month}</div>
		<div class="col-md-4"><em class="fa fa-map-marker">&nbsp;</em>{DATA.work_location}</div>
		<div class="col-md-5"><em class="fa fa-money">&nbsp;</em>{DATA.salary}</div>
		<div class="col-md-4"><em class="fa fa-clock-o">&nbsp;</em>{DATA.updatetime}</div>
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