<!-- BEGIN: main -->

<!-- BEGIN: data -->
<div class="row">
    <!-- BEGIN: loop -->
    <div class="col-xs-8 col-sm-8 col-md-8 m-bottom">
        <div class="image pull-left">
            <img src="{DATA.image}" alt="{DATA.title}" width="50" class="img-thumbnail" />
        </div>
        <div class="info">
            <a href="{DATA.url_view_record}" title="{DATA.title}">
                <strong>{DATA.title0}</strong>
            </a>
            <small class="show"><a href="{DATA.url_view_record}" title="{DATA.jobseeker.title}" class="text-success">{DATA.jobseeker.last_name} {DATA.jobseeker.first_name}</a></small>
        </div>
    </div>
    <!-- BEGIN: clearfix -->
    <div class="clearfix"></div>
    <!-- END: clearfix -->
    <!-- END: loop -->
</div>

<!-- BEGIN: viewall -->
<div class="text-right">
	<a href="{URL_VIEW}" title="{LANG.viewall}">{LANG.viewall}</a>
</div>
<!-- END: viewall -->

<!-- END: main -->