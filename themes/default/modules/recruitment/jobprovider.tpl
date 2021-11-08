<!-- BEGIN: main -->
<div class="jobprovider">
	<h1 class="m-bottom title">{DATA.title}</h1>
	<hr />
	<div class="row">
                <div class="col-md-5">
                <!-- BEGIN: image -->
			<div class="m-bottom">
				<a href="#" title=""><img src="{DATA.image}" data-title="{DATA.title}" class="img-thumbnail" width="150" onclick='modalShow( $(this).data("title"), "<img src=" + $(this).attr("src") + " />" );' /></a>
			</div>
		<!-- END: image -->

                </div>
		<div class="col-md-13">
			<ul>
				<li><strong>{LANG.jobs}:</strong> <!-- BEGIN: jobs --><em class="fa fa-circle-o">&nbsp;</em><a href="{JOBS.url}" title="{JOBS.title}">{JOBS.title}</a>&nbsp;&nbsp;<!-- END: jobs --></li>
                <!-- BEGIN: taxcode -->
                <li><strong>{LANG.taxcode}:</strong> {DATA.taxcode}</li>
                <!-- END: taxcode -->
				<!-- BEGIN: email -->
				<li><strong>{LANG.email}:</strong> <a href="mailto:{DATA.email}" title="Mail to {DATA.email}">{DATA.email}</a></li>
				<!-- END: email -->
				<!-- BEGIN: fax -->
				<li><strong>{LANG.fax}:</strong> {DATA.fax}</li>
				<!-- END: fax -->
				<!-- BEGIN: address -->
				<li><strong>{LANG.address}:</strong> {DATA.address}, {DATA.province} (<a href="" class="pointer" data-toggle="modal" data-target="#company-map-modal" >{LANG.maps_view}</a>)</li>
				<!-- END: address -->
			</ul>
		</div>
		<div class="col-md-6 text-center">
			<!-- BEGIN: is_real -->
			<div id="jobprovider-ok"></div>
			<!-- END: is_real -->
		</div>
	</div>
	<p>{DATA.descripion}</p>

	<!-- BEGIN: post_new -->
	<div class="panel panel-default">
		<div class="panel-heading">{LANG.jobprovider_post}</div>
		<div class="panel-body">{POST}</div>
	</div>
	<!-- END: post_new -->
</div>

<div class="modal fade" id="company-map-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div id="company-map" data-clat="{DATA.maps.maps_mapcenterlat}" data-clng="{DATA.maps.maps_mapcenterlng}" data-lat="{DATA.maps.maps_maplat}" data-lng="{DATA.maps.maps_maplng}" data-zoom="{DATA.maps.maps_mapzoom}"></div>
            </div>
        </div>
    </div>
</div>

<!-- END: main -->