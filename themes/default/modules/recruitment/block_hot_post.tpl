<!-- BEGIN: main -->

<!-- BEGIN: data -->
<div class="row">
    <!-- BEGIN: loop -->
	<div class="col-sm-24 col-md-24 m-bottom">
	  <div class="tms_item">
		<div class="tms_item_title"><a href="{ROW.link}" title="{ROW.title}" >{DATA.title0}</a></div>
		<div class="tms_item_jobprovider_small"><a href="{ROW.jobprovider_url}" title="{ROW.jobprovider.title}" target="_blank" >{DATA.jobprovider.title}</a></div>
	   <div class="tms_item_info">
	   <span class="tms_item_money"><i class="fa fa-money" aria-hidden="true"></i><!-- BEGIN: salary --> {SALARY}<!-- END: salary -->   </span>
	    - <i class="fa fa-clock-o" aria-hidden="true" style="color:#000"></i> {DATA.addtime}
	   </div>
	
	   </div> 
		</div> 
		<!-- END: loop -->
</div>

<!-- BEGIN: viewall -->
<div class="text-right">
	<a href="{URL_VIEW}" title="{LANG.viewall}">{LANG.viewall}</a>
</div>
<!-- END: viewall -->

<!-- END: main -->