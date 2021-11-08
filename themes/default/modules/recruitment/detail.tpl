<!-- BEGIN: main -->
<link rel="StyleSheet" href="{NV_BASE_SITEURL}modules/{MODULE_FILE}/js/toastr.min.css">
<script type="text/javascript" src="{NV_BASE_SITEURL}modules/{MODULE_FILE}/js/toastr.min.js"></script>

<div class="viewjobs">
	<div class="row infobox">
		<div class="col-md-17 infoleft">
		    <div class="pull-left">
		    <span class="label label-success">{ROW.code}</span>
		    </div>
			<h1>{ROW.title}</h1>
			<hr />
			<span class="m-bottom pull-left"><strong>{LANG.viewjob_timepost}:</strong> {ROW.addtime}<br /><strong>{LANG.viewjob_viewcount}: </strong>{ROW.viewcount}</span>
			<!-- BEGIN: is_hot --><span class="m-bottom pull-right"><img src="{NV_BASE_SITEURL}themes/default/images/vip.png"></span><!-- END: is_hot -->
			<!-- <a href="{JOBPROVIDER.link}" title="{JOBPROVIDER.title}">{JOBPROVIDER.title}</a> -->
		</div>
		<div class="col-md-7 text-center">
			<!-- BEGIN: record_send -->
			<a class="btn btn-danger btn-record-send" href="{ROW.url_send_record}"><em class="fa fa-paper-plane-o fa-lg">&nbsp;&nbsp;</em>{LANG.record_send}</a>
			<!-- END: record_send -->
			<em class="help-block"><strong>{LANG.document_exp_sort}:</strong> {ROW.document_exp}</em>
			<div class="group-button">
				<a href="{ROW.url_print}" title="{LANG.post_print}" onclick="nv_open_print( $(this).attr('href') ); return false;"><em class="fa fa-print fa-lg" >&nbsp;</em>{LANG.post_print}</a>&nbsp;&nbsp;
				<span id="post_save">
				<!-- BEGIN: user -->
					<!-- BEGIN: saved -->
					<a href="#" title="{LANG.post_saved_drop}" onclick="nv_save_post({ROW.id}, 0); return false;"><em class="fa fa-save fa-lg" >&nbsp;</em>{LANG.post_saved}</a>
					<!-- END: saved -->
					<!-- BEGIN: save -->
					<a href="#" title="{LANG.post_save}" onclick="nv_save_post({ROW.id}, 1); return false;"><em class="fa fa-save fa-lg" >&nbsp;</em>{LANG.post_save}</a>
					<!-- END: save -->
				<!-- END: user -->
				</span>
				<!-- BEGIN: guest -->
				<a href="#" title="{LANG.post_save}" onclick="return loginForm();"><em class="fa fa-save fa-lg">&nbsp;</em>{LANG.post_save}</a>
				<!-- END: guest -->
			</div>
		</div>
	</div>


<div class="news_column panel panel-default">
	<div class="panel-body">
        <div class="socialicon clearfix">
        	<div class="fb-like" data-href="{SELFURL}" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true">&nbsp;</div>
	        <div class="g-plusone" data-size="medium"></div>
	        <a href="http://twitter.com/share" class="twitter-share-button">Tweet</a>
	    </div>
     </div>
</div>

	
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active">
			<a href="#post" aria-controls="post" role="tab" data-toggle="tab">{LANG.viewjob_title}</a>
		</li>
		<li role="presentation">
			<a href="#jobprovider" aria-controls="jobprovider" role="tab" data-toggle="tab">{LANG.viewjob_jobprovider}</a>
		</li>
	</ul>

	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="post">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">
						<div class="col-md-13">
							<div class="row">
								<div class="col-md-8 row-title">{LANG.jobs}</div>
								<div class="col-md-16 row-content"><em class="fa fa-bars">&nbsp;</em>{ROW.jobs}</div>
							</div>
							<div class="row">
								<div class="col-md-8 row-title">{LANG.position_id}</div>
								<div class="col-md-16 row-content"><em class="fa fa-random">&nbsp;</em>{ROW.position}</div>
							</div>
							<div class="row">
								<div class="col-md-8 row-title">{LANG.worktype_id}</div>
								<div class="col-md-16 row-content"><em class="fa fa-newspaper-o">&nbsp;</em>{ROW.worktype}</div>
							</div>
							<div class="row">
								<div class="col-md-8 row-title">{LANG.work_address}</div>
								<div class="col-md-16 row-content"><em class="fa fa-home">&nbsp;</em>{ROW.ward} , {ROW.district} , {ROW.province}</div>
							</div>
						</div>
						<div class="col-md-11">
							<div class="row">
								<div class="col-md-10 row-title">{LANG.salary}</div>
								<div class="col-md-14 row-content"><em class="fa fa-money">&nbsp;</em>{ROW.salary}</div>
							</div>
							<!-- BEGIN: quantity -->
							<div class="row">
								<div class="col-md-10 row-title">{LANG.quantity}</div>
								<div class="col-md-14 row-content"><em class="fa fa-square-o">&nbsp;</em>{ROW.quantity}</div>
							</div>
							<!-- END: quantity -->
							<div class="row">
								<div class="col-md-10 row-title">{LANG.gender}</div>
								<div class="col-md-14 row-content"><em class="fa fa-genderless fa-lg">&nbsp;</em>{ROW.gender}</div>
							</div>
							<div class="row">
								<div class="col-md-10 row-title">{LANG.age}</div>
								<div class="col-md-14 row-content"><em class="fa fa-globe">&nbsp;</em>{ROW.age}</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">
						<div class="col-md-5 row-title">{LANG.job_description}</div>
						<div class="col-md-19 row-content">{ROW.job_description}</div>
					</div>
					<hr />
					<!-- BEGIN: more_requirement -->
					<div class="row">
						<div class="col-md-5 row-title">{LANG.more_requirement}</div>
						<div class="col-md-19 row-content">{ROW.more_requirement}</div>
					</div>
					<hr />
					<!-- END: more_requirement -->
					<!-- BEGIN: interests -->
					<div class="row">
						<div class="col-md-5 row-title">{LANG.interest}</div>
						<div class="col-md-19 row-content">{ROW.interests}</div>
					</div>
					<hr />
					<!-- END: interests -->
					<!-- BEGIN: degree -->
					<div class="row">
						<div class="col-md-5 row-title">{LANG.degree}</div>
						<div class="col-md-19 row-content">{ROW.degree}</div>
					</div>
					<hr />
					<!-- END: degree -->
					<div class="row">
						<div class="col-md-5 row-title">{LANG.document}</div>
						<div class="col-md-19 row-content">
							<!-- BEGIN: document -->
							<ul>
								<!-- BEGIN: loop -->
								<li>- {DOCUMENT}</li>
								<!-- END: loop -->
							</ul>
							<!-- END: document -->
						</div>
					</div>
					<hr />
					<div class="row">
						<div class="col-md-5 row-title">{LANG.document_exp}</div>
						<div class="col-md-19 row-content">{ROW.document_exp}</div>
					</div>
					<hr />
					<div class="row">
						<div class="col-md-5 row-title">{LANG.submitcount}</div>
						<div class="col-md-19 row-content text-center"><span style="font-size:32px; color:#fc205b; font-weight:bold">{ROW.submitcount}</span><br/>{LANG.submitcount_note}</div>
					</div>
					<hr />
					<div class="row">
						<div class="col-md-5 row-title">{LANG.document_type_id}</div>
						<div class="col-md-19 row-content">
							<!-- BEGIN: document_type -->
							<ul>
								<!-- BEGIN: loop -->
								<li>- {DOCUMENT_TYPE}</li>
								<!-- END: loop -->
							</ul>
							<!-- END: document_type -->
						</div>
					</div>
					<hr />
					<div class="row">
					<div class="col-md-24">
					<div class="btn btn-danger" style="display:block"><em class="fa fa-warning" style="font-size:25px"></em>  Người tìm việc cảnh giác khi có bất kỳ yêu cầu thu phí từ phía nhà tuyển dụng   >> Xem thêm</div>
					</div>
					</div>
					<hr />
					<div class="row">
						<div class="col-md-5 row-title">&nbsp;</div>
						<div class="col-md-19 row-content text-danger"><strong>{LANG.contact_info}</strong></div>
					</div>
					<div class="row">
						<div class="col-md-5 row-title">{LANG.fullname}</div>
						<div class="col-md-19 row-content">{ROW.contact_fullname}</div>
					</div>
					<div class="row">
						<div class="col-md-5 row-title">{LANG.email}</div>
						<div class="col-md-19 row-content">{ROW.contact_email}</div>
					</div>
					<div class="row">
						<div class="col-md-5 row-title">{LANG.phone}</div>
						<div class="col-md-19 row-content">{ROW.contact_phone}</div>
					</div>
				</div>
			</div>
		</div>
		<div role="tabpanel" class="tab-pane" id="jobprovider">
			<div class="row">
                                <div class="col-md-5">
                                        <!-- BEGIN: image -->
					<a href="#" title=""><img src="{JOBPROVIDER.image}" class="img-thumbnail" width="150" onclick='modalShow("", "<img src=" + $(this).attr("src") + " />" );' /></a>
					<!-- END: image -->
                                </div>
				<div class="col-md-13">
					<div class="row">
						<div class="col-md-6 row-title">{LANG.company_name}</div>
						<div class="col-md-18 row-content">{JOBPROVIDER.title}</div>
					</div>
					<div class="row">
						<div class="col-md-6 row-title">{LANG.address}</div>
						<div class="col-md-18 row-content">{JOBPROVIDER.address}, {JOBPROVIDER.ward},{JOBPROVIDER.district},{JOBPROVIDER.province}</div>
					</div>
					<div class="row">
						<div class="col-md-6 row-title">{LANG.email}</div>
						<div class="col-md-18 row-content"><a href="mailto:{JOBPROVIDER.email}" title="Mail to {JOBPROVIDER.email}">{JOBPROVIDER.email}</a></div>
					</div>
					<div class="row">
						<div class="col-md-6 row-title">{LANG.fax}</div>
						<div class="col-md-18 row-content">{JOBPROVIDER.fax}</div>
					</div>
					<div class="row">
						<div class="col-md-6 row-title">{LANG.website}</div>
						<div class="col-md-18 row-content"><a href="{JOBPROVIDER.website}" target="_blank" title="{LANG.company_name}">{JOBPROVIDER.website}</a></div>
					</div>
					<div class="row">
						<div class="col-md-6 row-title">{LANG.agent}</div>
						<div class="col-md-18 row-content">{JOBPROVIDER.agent}</div>
					</div>
				</div>
				<div class="col-md-6 text-center">
					
					<!-- BEGIN: is_real -->
					<div id="jobprovider-ok"></div>
					<!-- END: is_real -->
				</div>
			</div>
			<hr />
			<p>{JOBPROVIDER.descripion}</p>
		</div>
	</div>
</div>
<!-- BEGIN: admin -->
<div class="text-center m-bottom">
	<a href="{URL_EDIT}" class="btn btn-success btn-xs"><em class="fa fa-edit">&nbsp;</em>{GLANG.edit}</a>
	<a href="" class="btn btn-danger btn-xs" onclick="nv_delete_rows({ROW.id})"><em class="fa fa-edit">&nbsp;</em>{GLANG.delete}</a>
</div>
<!-- END: admin -->

<script>
	var cfg = {
		'lang_post_save': '{LANG.post_save}',
		'lang_post_save_success': '{LANG.post_save_success}',
		'lang_post_saved': '{LANG.post_saved}',
		'lang_post_save_confirm': '{LANG.post_save_confirm}',
		'lang_post_saved_drop': '{LANG.post_saved_drop}',
		'lang_post_saved_drop_success': '{LANG.post_saved_drop_success}',
		'lang_post_drop_saved_confirm': '{LANG.post_drop_saved_confirm}',
		'var_post_id': '{ROW.id}'
	};
</script>
<!-- END: main -->