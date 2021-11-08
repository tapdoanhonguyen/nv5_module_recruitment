<!-- BEGIN: main -->
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/ui/jquery.ui.core.css" rel="stylesheet" />
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/ui/jquery.ui.theme.css" rel="stylesheet" />
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/ui/jquery.ui.menu.css" rel="stylesheet" />
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/ui/jquery.ui.datepicker.css" rel="stylesheet" />

<!-- BEGIN: error -->
<div class="alert alert-warning">
	{ERROR}
</div>
<!-- END: error -->

<form class="form-horizontal" action="{NV_BASE_SITEURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
	<div class="panel panel-default">
		<div class="panel-heading">{LANG.viewrecord_jobseeker_info_account}</div>
		<div class="panel-body">
			<dl class="dl-horizontal">
				<dt>{LANG.username}</dt>
				<dd>{USER_INFO.username}</dd>
				<dt>{LANG.email}</dt>
				<dd>{USER_INFO.email}</dd>
				<dt>{LANG.password}</dt>
				<dd><a href="{USER_INFO.url_password_change}" target="_blank" title="{LANG.password_change}">{LANG.password_change}</a></dd>
				<dt>{LANG.image}</dt>
				<dd>
					<!-- BEGIN: image -->
					<img src="{USER_INFO.photo}" class="img-thumbnail m-bottom" />
					<a class="show" href="{USER_INFO.url_image_change}" target="_blank" title="{LANG.image_change}">{LANG.image_change}</a>
					<!-- END: image -->
					<!-- BEGIN: empty -->
					<em class="fa fa-folder-open-o">&nbsp;</em><a href="{USER_INFO.url_image_change}" target="_blank" title="{LANG.image_chosen}">{LANG.image_chosen}</a>
					<!-- END: empty -->
				</dd>
			</dl>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">{LANG.viewrecord_jobseeker_info}</div>
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-5 col-md-5 control-label"><strong>{LANG.last_name}</strong> <span class="red">(*)</span></label>
				<div class="col-sm-8 col-md-9">
					<input class="form-control" type="text" name="last_name" value="{ROW.last_name}" required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" />
				</div>
				<label class="col-sm-4 col-md-3 control-label"><strong>{LANG.first_name}</strong> <span class="red">(*)</span></label>
				<div class="col-sm-6 col-md-7">
					<input class="form-control" type="text" name="first_name" value="{ROW.first_name}" required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-5 control-label"><strong>{LANG.birthday}</strong> <span class="red">(*)</span></label>
				<div class="col-sm-8 col-md-9">
					<div class="input-group">
						<input class="form-control" type="text" name="birthday" value="{ROW.birthday}" id="birthday" pattern="^[0-9]{2,2}\/[0-9]{2,2}\/[0-9]{1,4}$" required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" />
						<span class="input-group-btn">
							<button class="btn btn-default" type="button" id="birthday-btn">
								<em class="fa fa-calendar fa-fix"> </em>
							</button> </span>
					</div>
				</div>
				<label class="col-sm-4 col-md-3 control-label"><strong>{LANG.marital}</strong> </label>
				<div class="col-sm-6 col-md-7">
					<select class="form-control" name="marital">
						<!-- BEGIN: marital -->
						<option value="{MARITAL.key}" {MARITAL.selected}>{MARITAL.value}</option>
						<!-- END: marital -->
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-5 text-right"><strong>{LANG.gender}</strong> </label>
				<div class="col-sm-19 col-md-19">
					<!-- BEGIN: radio_gender -->
					<label><input class="form-control" type="radio" name="gender" value="{OPTION.key}" {OPTION.checked}required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" >{OPTION.title} &nbsp;</label>
					<!-- END: radio_gender -->
				</div>
			</div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">{LANG.viewrecord_jobseeker_info_contact}</div>
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-5 col-md-5 control-label"><strong>Email</strong> <span class="red">(*)</span></label>
				<div class="col-sm-19 col-md-19">
					<input class="form-control" type="email" name="email" value="{ROW.email}" required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-5 control-label"><strong>{LANG.phone}</strong> <span class="red">(*)</span></label>
				<div class="col-sm-19 col-md-19">
					<input class="form-control" type="text" name="phone" value="{ROW.phone}" required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-5 control-label"><strong>{LANG.province}</strong> <span class="red">(*)</span></label>
				<div class="col-sm-19 col-md-19">
					{LOCATION}
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-5 control-label"><strong>{LANG.address}</strong></label>
				<div class="col-sm-19 col-md-19">
					<input class="form-control" type="text" name="address" value="{ROW.address}" />
				</div>
			</div>
			<div class="form-group" style="text-align: center"><input class="btn btn-primary" name="submit" type="submit" value="{LANG.save}" />
			</div>
		</div>
	</div>
</form>

<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/ui/jquery.ui.core.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/ui/jquery.ui.menu.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/ui/jquery.ui.datepicker.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/language/jquery.ui.datepicker-{NV_LANG_INTERFACE}.js"></script>

<script type="text/javascript">
	//<![CDATA[
	$("#birthday").datepicker({
		dateFormat : "dd/mm/yy",
		changeMonth : true,
		changeYear : true,
		showOtherMonths : true,
	});

	//]]>
</script>
<!-- END: main -->