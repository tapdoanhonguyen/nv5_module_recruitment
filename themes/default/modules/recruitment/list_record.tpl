<!-- BEGIN: main -->

<!-- BEGIN: empty -->
<div class="alert alert-danger">{LANG.record_new_empty}</div>
<!-- END: empty -->

<!-- BEGIN: data -->
<div id="list-record">
	<div class="row">
		<!-- BEGIN: loop -->
		<div class="col-md-8 m-bottom">
			<em class="fa fa-circle-o">&nbsp;</em>
			<a href="{DATA.url_view_record}" title="{DATA.title}">
				<strong <!-- BEGIN: highlights -->class="highlights"<!-- END: highlights -->>{DATA.title0}</strong>
				<!-- BEGIN: hot_icon -->
				<img src="{NV_BASE_SITEURL}themes/{TEMPLATE}/images/{MODULE_FILE}/icon_hot.gif" />
				<!-- END: hot_icon -->
			</a>
			<small class="show"><a href="{DATA.url_view_record}" title="{DATA.jobseeker.title}" class="text-success">{DATA.jobseeker.last_name} {DATA.jobseeker.first_name}</a></small>
		</div>
		<!-- END: loop -->
	</div>

	<!-- BEGIN: generate_page -->
	<hr />
	<div class="text-center">{PAGE}</div>
	<!-- END: generate_page -->
</div>
<!-- END: data -->

<!-- END: main -->