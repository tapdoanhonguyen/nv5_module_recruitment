<!-- BEGIN: main -->
<!-- BEGIN: error -->
<div class="alert alert-warning">
	{ERROR}
</div>
<!-- END: error -->

<div class="panel panel-default">
	<div class="panel-heading">{LANG.viewjob_title}</div>
	<div class="panel-body"	>
		<dl class="dl-horizontal">
			<dt>{LANG.code}</dt>
			<dd><a href="{POST.url_view_jobs}" target="_blank" title="{POST.code}">{POST.code}</a></dd>

			<dt>{LANG.title}</dt>
			<dd><a href="{POST.url_view_jobs}" target="_blank" title="{POST.title}">{POST.title}</a></dd>

			<dt>{LANG.jobprovider}</dt>
			<dd><a href="{JOBPROVIDER.link}" target="_blank" title="{JOBPROVIDER.title}">{JOBPROVIDER.title}</a></dd>
		</dl>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-body">
		<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
			<input type="hidden" name="id" value="{ROW.id}" />
			<input type="hidden" name="rows_id" value="{ROW.rows_id}" />
			<div class="form-group">
				<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.record_title}</strong> <span class="red">(*)</span></label>
				<div class="col-sm-19 col-md-20">
					<input class="form-control" type="text" name="title" value="{ROW.title}" required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.fullname}</strong> <span class="red">(*)</span></label>
				<div class="col-sm-19 col-md-20">
					<input class="form-control" type="text" name="fulname" value="{ROW.fulname}" placeholder="{LANG.contact_fullname}" required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.email}</strong> <span class="red">(*)</span></label>
				<div class="col-sm-19 col-md-20">
					<input class="form-control" type="email" name="email" value="{ROW.email}" placeholder="{LANG.contact_email}" required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.phone}</strong> <span class="red">(*)</span></label>
				<div class="col-sm-19 col-md-20">
					<input class="form-control" type="text" name="phone" value="{ROW.phone}" placeholder="{LANG.contact_phone}" required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.introduction}</strong> <span class="red">(*)</span></label>
				<div class="col-sm-19 col-md-20">
					{ROW.introduction}
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.file}</strong></label>
				<div class="col-sm-19 col-md-20">
					<div class="input-group">
						<input type="text" class="form-control" id="file_name" disabled>
						<span class="input-group-btn">
							<button class="btn btn-default" onclick="$('#upload_fileupload').click();" type="button">
								<em class="fa fa-folder-open-o fa-fix">&nbsp;</em> {LANG.file_selectfile}
							</button> </span>
					</div>
					<em class="help-block">{LANG.upload_valid_ext_info}: {EXT_ALLOWED}</em>
					<input type="file" name="upload_fileupload" id="upload_fileupload" style="display: none" />
				</div>
			</div>
			<div class="form-group" style="text-align: center">
				<input class="btn btn-primary" name="submit" type="submit" value="{LANG.save}" />
			</div>
		</form>
	</div>
</div>
<!-- END: main -->