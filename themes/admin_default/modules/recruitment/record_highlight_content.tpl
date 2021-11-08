<!-- BEGIN: main -->

<!-- BEGIN: data -->
<link rel="StyleSheet" href="{NV_BASE_SITEURL}modules/{MODULE_FILE}/js/toastr.min.css">
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/ui/jquery.ui.core.css" rel="stylesheet" />
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/ui/jquery.ui.theme.css" rel="stylesheet" />
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/ui/jquery.ui.menu.css" rel="stylesheet" />
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/ui/jquery.ui.datepicker.css" rel="stylesheet" />

<div class="panel panel-default">
	<div class="panel-body">
		<form class="form-horizontal" action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post" id="frm-highlights">
			<input type="hidden" name="id" value="{ROW.id}" />
			<input type="hidden" name="record_id" value="{ROW.record_id}" />
			<input type="hidden" name="is_edit" id="is_edit" value="{ROW.is_edit}" />
			<input type="hidden" name="submit" value="1" />
			<div class="form-group">
				<label class="col-sm-5 col-md-6 text-right"><strong>{LANG.title}</strong></label>
				<div class="col-sm-19 col-md-18">
					[{ROW.code}] {ROW.title}
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-6 text-right"><strong>{LANG.is_hot}</strong></label>
				<div class="col-sm-19 col-md-18">
					<label><input type="checkbox" name="is_hot" value="1" {ROW.ck_is_hot} /> {LANG.is_hot_note}</label>
					<br />
					<label id="is_hot_icon" {ROW.display_is_hot_icon}><input type="checkbox" {ROW.ck_is_hot_icon} name="is_hot_icon" value="1" /> {LANG.is_hot_icon}</label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-6 text-right"><strong>{LANG.is_highlights}</strong></label>
				<div class="col-sm-19 col-md-18">
					<label><input type="checkbox" name="is_highlights" value="1" {ROW.ck_is_highlights} /> {LANG.is_highlights_note}</label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-6 control-label"><strong>{LANG.time_begin}</strong> <span class="red">(*)</span></label>
				<div class="col-sm-19 col-md-18">
					<div class="input-group">
						<input class="form-control" type="text" name="time_begin" value="{ROW.time_begin}" id="time_begin" pattern="^[0-9]{2,2}\/[0-9]{2,2}\/[0-9]{1,4}$" required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" />
						<span class="input-group-btn">
							<button class="btn btn-default" type="button" id="time_begin-btn">
								<em class="fa fa-calendar fa-fix"> </em>
							</button> </span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-6 control-label"><strong>{LANG.time_end}</strong></label>
				<div class="col-sm-19 col-md-18">
					<div class="input-group">
						<input class="form-control" type="text" name="time_end" value="{ROW.time_end}" id="time_end" pattern="^[0-9]{2,2}\/[0-9]{2,2}\/[0-9]{1,4}$" />
						<span class="input-group-btn">
							<button class="btn btn-default" type="button" id="time_end-btn">
								<em class="fa fa-calendar fa-fix"> </em>
							</button> </span>
					</div>
				</div>
			</div>
			<div class="form-group" style="text-align: center">
				<input class="btn btn-primary" name="submit" type="submit" value="{LANG.save}" />
			</div>
		</form>
	</div>
</div>

<script type="text/javascript" src="{NV_BASE_SITEURL}modules/{MODULE_FILE}/js/toastr.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/ui/jquery.ui.core.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/ui/jquery.ui.menu.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/ui/jquery.ui.datepicker.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/language/jquery.ui.datepicker-{NV_LANG_INTERFACE}.js"></script>

<script type="text/javascript">
	//<![CDATA[
	$("#time_begin,#time_end").datepicker({
		dateFormat : "dd/mm/yy",
		changeMonth : true,
		changeYear : true,
		showOtherMonths : true,
	});

	$('input[name="is_hot"]').click(function() {
		$('#is_hot_icon').toggle();
	});

	$('#frm-highlights').submit(function(){
		$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=record_highlight_content&nocache=' + new Date().getTime(), $( this ).serialize(), function(res) {
			var r_split = res.split("_");
			if (r_split[0] != 'OK') {
				alert(r_split[1]);
			}
			else{
				if( $('#is_edit').val() == '1' ){
					nv_alert_success( r_split[1] );
					setTimeout(function(){
						window.location = 'index.php?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=record_highlights';
					}, 1000);
				}
				else{
					$('#sitemodal').modal('hide');
					nv_alert_success( r_split[1] );
					setTimeout(function(){
						window.location.href = window.location.href;
					}, 1000);
				}
			}
		});
		return false;
	});
	//]]>
</script>
<!-- END: data -->

<!-- BEGIN: empty -->
<div class="alert alert-danger">{LANG.error_required_rows_empty}</div>
<!-- END: empty -->

<!-- END: main -->