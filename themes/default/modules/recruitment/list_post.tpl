<!-- BEGIN: main -->

<!-- BEGIN: data -->
<div id="list-post">
	<div class="row">
		<!-- BEGIN: loop -->
	<div class="col-sm-12 col-md-12 m-bottom">
	  <div class="tms_item">
		<div class="tms_item_title"><a href="{ROW.link}" title="{ROW.title}" >{DATA.title0}</a></div>
		<div class="tms_item_jobprovider"><a href="{ROW.jobprovider_url}" title="{ROW.jobprovider.title}" target="_blank" >{DATA.jobprovider.title}</a></div>
	   <div class="tms_item_info">
	   <span class="tms_item_money"><i class="fa fa-money" aria-hidden="true"></i><!-- BEGIN: salary --> {SALARY}<!-- END: salary -->   </span>
	    - <i class="fa fa-clock-o" aria-hidden="true" style="color:#000"></i> {DATA.addtime}
	    - <i class="fa fa-map-marker" aria-hidden="true" style="color:#000"></i> {DATA.province}
	   </div>
	
	   </div> 
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