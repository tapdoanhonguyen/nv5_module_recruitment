<!-- BEGIN: main -->
<form action="" method="post" class="form-horizontal">
	<div class="panel panel-default">
		<div class="panel-heading">{LANG.config_system}</div>
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-5 control-label"><strong>{LANG.jobseeker}</strong></label>
				<div class="col-sm-19">
					<select class="form-control" name="group_jobseeker">
						<option value="0">---{LANG.config_groups_jobseeker_c}---</option>
						<!-- BEGIN: group_jobseeker -->
						<option value="{GROUP_JOBSEEKER.id}" {GROUP_JOBSEEKER.selected}>{GROUP_JOBSEEKER.title}</option>
						<!-- END: group_jobseeker -->
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 control-label"><strong>{LANG.jobprovider}</strong></label>
				<div class="col-sm-19">
					<select class="form-control" name="group_jobprovider">
						<option value="0">---{LANG.config_groups_jobprovider_c}---</option>
						<!-- BEGIN: group_jobprovider -->
						<option value="{GROUP_PROVIDER.id}" {GROUP_PROVIDER.selected}>{GROUP_PROVIDER.title}</option>
						<!-- END: group_jobprovider -->
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 text-right"><strong>{LANG.config_country}</strong></label>
				<div class="col-sm-19">
					<!-- BEGIN: country -->
					<label><input type="checkbox" name="countryid[]" value="{COUNTRY.countryid}" {COUNTRY.checked} />{COUNTRY.title}</label>&nbsp;&nbsp;&nbsp;&nbsp;
					<!-- END: country -->
					<span class="help-block">{LANG.config_country_note}</span>
				</div>
			</div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">{LANG.jobprovider} - {LANG.post}</div>
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-5 text-right"><strong>{LANG.config_post_queue}</strong></label>
				<div class="col-sm-19">
					<input type="checkbox" name="post_queue" value="1" class="form-control" {ck_post_queue} />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 text-right"><strong>{LANG.config_send_record}</strong></label>
				<div class="col-sm-19">
					<label><input type="checkbox" name="send_record" value="1" class="form-control" {ck_send_record} />{LANG.config_send_record_note}</label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 control-label"><strong>{LANG.config_maxfilesize}</strong></label>
				<div class="col-sm-19">
					<input name="maxfilesize" value="{DATA.maxfilesize}" type="text" maxlength="10" class="pull-left form-control w200"/><span class="text-middle"> {LANG.config_maxfilemb}. {LANG.config_maxfilesizesys} <strong>{NV_UPLOAD_MAX_FILESIZE}</strong> </span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 text-right"><strong>{LANG.config_allowfiletype}</strong></label>
				<div class="col-sm-19">
					<!-- BEGIN: allow_files_type -->
					<label><input name="upload_filetype[]" type="checkbox" value="{TP}" {CHECKED} /> {TP}</label>&nbsp;&nbsp;&nbsp;
					<!-- END: allow_files_type -->
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 control-label"><strong>{LANG.config_logo_size} (px)</strong></label>
				<div class="col-sm-19">
					<div class="row">
						<div class="col-sm-11">
							<input type="number" name="logo_size_width" value="{DATA.logo_size_width}" class="form-control" placeholder="{LANG.config_size_widht}" />
						</div>
						<div class="col-sm-1 text-center">x</div>
						<div class="col-sm-12">
							<input type="number" name="logo_size_height" value="{DATA.logo_size_height}" class="form-control" placeholder="{LANG.config_size_height}" />
						</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 control-label"><strong>{LANG.config_post_code}</strong></label>
				<div class="col-sm-19">
					<input type="text" name="post_code" value="{DATA.post_code}" class="form-control" />
				</div>
			</div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">{LANG.jobseeker} - {LANG.record}</div>
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-5 text-right"><strong>{LANG.config_record_queue}</strong></label>
				<div class="col-sm-19">
					<input type="checkbox" name="record_queue" value="1" class="form-control" {ck_record_queue} />
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-5 text-right"><strong>{LANG.show_info}</strong></label>
				<div class="col-sm-19">
					<input type="checkbox" name="show_info" value="1" class="form-control" {ck_show_info} />
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-5 control-label"><strong>{LANG.config_record_limit}</strong></label>
				<div class="col-sm-19">
					<input type="number" name="record_limit" value="{DATA.record_limit}" class="form-control" />
					<span class="help-block">{LANG.config_record_limit_note}</span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 control-label"><strong>{LANG.config_record_size} (cm)</strong></label>
				<div class="col-sm-19">
					<div class="row">
						<div class="col-sm-11">
							<input type="number" name="record_size_width" value="{DATA.record_size_width}" class="form-control" placeholder="{LANG.config_size_widht}" />
						</div>
						<div class="col-sm-1 text-center">x</div>
						<div class="col-sm-12">
							<input type="number" name="record_size_height" value="{DATA.record_size_height}" class="form-control" placeholder="{LANG.config_size_height}" />
						</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 control-label"><strong>{LANG.config_record_code}</strong></label>
				<div class="col-sm-19">
					<input type="text" name="record_code" value="{DATA.record_code}" class="form-control" />
				</div>
			</div>
		</div>
	</div>
	<div class="text-center"><input type="submit" class="btn btn-primary" value="{LANG.save}" name="savesetting" /></div>
</form>
<script type="text/javascript">
	$("#selectimg").click(function() {
		var area = "image";
		var path = "{NV_UPLOADS_DIR}";
		var type = "image";
		nv_open_browse(script_name + "?" + nv_name_variable + "=upload&popup=1&area=" + area + "&path=" + path + "&type=" + type, "NVImg", 850, 420, "resizable=no,scrollbars=no,toolbar=no,location=no,status=no");
		return false;
	});
</script>
<!-- BEGIN: main -->