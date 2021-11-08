<!-- BEGIN: main -->
<link type="text/css" href="{NV_BASE_SITEURL}js/ui/jquery.ui.core.css" rel="stylesheet" />
<link type="text/css" href="{NV_BASE_SITEURL}js/ui/jquery.ui.theme.css" rel="stylesheet" />
<link type="text/css" href="{NV_BASE_SITEURL}js/ui/jquery.ui.menu.css" rel="stylesheet" />
<link type="text/css" href="{NV_BASE_SITEURL}js/ui/jquery.ui.datepicker.css" rel="stylesheet" />

<!-- BEGIN: error -->
<div class="alert alert-warning">{ERROR}</div>
<!-- END: error -->
<div class="panel panel-default">
<div class="panel-body">
<form class="form-horizontal" action="{NV_BASE_SITEURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
	<input type="hidden" name="id" value="{ROW.id}" />
	<div class="form-group">
		<label class="col-sm-5 col-md-5 control-label"><strong>{LANG.lastname}</strong> <span class="red">(*)</span></label>
		<div class="col-sm-14 col-md-19">
			<input class="form-control" type="text" name="lastname" value="{ROW.lastname}" required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-5 col-md-5 control-label"><strong>{LANG.firstname}</strong> <span class="red">(*)</span></label>
		<div class="col-sm-14 col-md-19">
			<input class="form-control" type="text" name="firstname" value="{ROW.firstname}" required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-5 col-md-5 control-label"><strong>{LANG.birthday}</strong> <span class="red">(*)</span></label>
		<div class="col-sm-14 col-md-19">
			<input class="form-control" type="text" name="birthday" value="{ROW.birthday}" id="birthday" pattern="^[0-9]{2,2}\/[0-9]{2,2}\/[0-9]{1,4}$" required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-5 col-md-5 text-right"><strong>{LANG.candidate_gender}</strong> <span class="red">(*)</span></label>
		<div class="col-sm-14 col-md-19">
			<!-- BEGIN: radio_gender -->
				<label><input class="form-control" type="radio" name="gender" value="{OPTION.key}" {OPTION.checked}required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" >{OPTION.title} &nbsp;</label>
			<!-- END: radio_gender -->
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-5 col-md-5 control-label"><strong>{LANG.marital}</strong></label>
		<div class="col-sm-14 col-md-19">
			<input class="form-control" type="text" name="marital" value="{ROW.marital}" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-5 col-md-5 control-label"><strong>{LANG.nationality}</strong></label>
		<div class="col-sm-14 col-md-19">
			<input class="form-control" type="text" name="nationality" value="{ROW.nationality}" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-5 col-md-5 control-label"><strong>{LANG.address}</strong> <span class="red">(*)</span></label>
		<div class="col-sm-14 col-md-19">
			<input class="form-control" type="text" name="address" value="{ROW.address}" required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-5 col-md-5 control-label"><strong>{LANG.position}</strong></label>
		<div class="col-sm-14 col-md-19">
			<input class="form-control" type="text" name="position" value="{ROW.position}" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-5 col-md-5 control-label"><strong>{LANG.email}</strong> <span class="red">(*)</span></label>
		<div class="col-sm-14 col-md-19">
			<input class="form-control" type="text" name="email" value="{ROW.email}" required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-5 col-md-5 control-label"><strong>{LANG.phone}</strong></label>
		<div class="col-sm-14 col-md-19">
			<input class="form-control" type="text" name="phone" value="{ROW.phone}" />
		</div>
	</div>
	<div class="form-group" style="text-align: center"><input class="btn btn-primary" name="submit" type="submit" value="{LANG.save}" /></div>
</form>
</div></div>

<script type="text/javascript" src="{NV_BASE_SITEURL}js/ui/jquery.ui.core.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}js/ui/jquery.ui.menu.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}js/ui/jquery.ui.datepicker.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}js/language/jquery.ui.datepicker-{NV_LANG_INTERFACE}.js"></script>

<script type="text/javascript">
//<![CDATA[
	$("#birthday").datepicker({
		showOn : "both",
		dateFormat : "dd/mm/yy",
		changeMonth : true,
		changeYear : true,
		showOtherMonths : true,
		buttonImage : nv_siteroot + "images/calendar.gif",
		buttonImageOnly : true
	});

//]]>
</script>
<!-- END: main -->