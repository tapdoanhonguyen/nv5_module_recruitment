<!-- BEGIN: main -->

<div class="well">
	<form action="{NV_BASE_ADMINURL}index.php" method="get">
		<input type="hidden" name="{NV_LANG_VARIABLE}"  value="{NV_LANG_DATA}" />
		<input type="hidden" name="{NV_NAME_VARIABLE}"  value="{MODULE_NAME}" />
		<input type="hidden" name="{NV_OP_VARIABLE}"  value="{OP}" />
		<input type="hidden" name="is_search"  value="1" />
		<div class="row">
			<div class="col-xs-24 col-md-4">
				<div class="form-group">
					<input class="form-control" type="text" value="{SEARCH.q}" name="q" maxlength="255" placeholder="{LANG.search_title}" />
				</div>
			</div>
			<div class="col-xs-24 col-md-6">
				<div class="form-group">
					<select name="jobs_id" id="jobs_id" class="form-control">
						<option value="0">---{LANG.jobs_c}---</option>
						<!-- BEGIN: jobs -->
						<option value="{JOBS.key}" {JOBS.selected}>{JOBS.title}</option>
						<!-- END: jobs -->
					</select>
				</div>
			</div>
			<div class="col-xs-24 col-md-4">
				<div class="form-group">
					<select name="position_id" id="position_id" class="form-control">
						<option value="0">---{LANG.position_c}---</option>
						<!-- BEGIN: position -->
						<option value="{POSITION.key}" {POSITION.selected}>{POSITION.title}</option>
						<!-- END: position -->
					</select>
				</div>
			</div>
			<div class="col-xs-24 col-md-4">
				<div class="form-group">
					<select name="status" class="form-control">
						<option value="-1">---{LANG.status_c}---</option>
						<!-- BEGIN: status -->
						<option value="{STATUS.key}" {STATUS.selected}>{STATUS.value}</option>
						<!-- END: status -->
					</select>
				</div>
			</div>
			<div class="col-xs-24 col-md-3">
				<div class="form-group">
					<select name="per_page" class="form-control">
						<option value="15">---{LANG.display}---</option>
						<!-- BEGIN: per_page -->
						<option value="{PER_PAGE.key}" {PER_PAGE.selected}>{PER_PAGE.key}</option>
						<!-- END: per_page -->
					</select>
				</div>
			</div>
			<div class="col-xs-12 col-md-3">
				<div class="form-group">
					<input class="btn btn-primary" type="submit" value="{LANG.search_submit}" />
				</div>
			</div>
		</div>
	</form>
</div>

<form action="{NV_BASE_SITEURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover">
			<colgroup>
				<col width="50" />
				<col width="100" />
				<col span="2" />
				<col width="200" />
				<col width="100" />
				<col width="100" span="2" />
			</colgroup>
			<thead>
				<tr>
					<th class="text-center"><input name="check_all[]" type="checkbox" value="yes" onclick="nv_checkAll(this.form, 'idcheck[]', 'check_all[]',this.checked);" /></th>
					<th>{LANG.record_code}</th>
					<th>{LANG.jobs_id}</th>
					<th>{LANG.record_position}</th>
					<th>{LANG.jobseeker}</th>
					<th class="text-center">
						<span data-toggle="tooltip" data-placement="top" title="" data-original-title="{LANG.status_note1}">{LANG.status} <em class="fa fa-info-circle text-info">&nbsp;</em></span>
					</th>
					<th class="text-center">{LANG.active}</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<!-- BEGIN: generate_page -->
			<tfoot>
				<tr>
					<td class="text-center" colspan="6">{NV_GENERATE_PAGE}</td>
				</tr>
			</tfoot>
			<!-- END: generate_page -->
			<tbody>
				<!-- BEGIN: loop -->
				<tr>
					<td class="text-center">
						<input type="checkbox" class="post" onclick="nv_UncheckAll(this.form, 'idcheck[]', 'check_all[]', this.checked);" value="{VIEW.id}" name="idcheck[]" />
					</td>
					<td> {VIEW.code} </td>
					<td> {VIEW.jobs_id} </td>
					<td> {VIEW.position_id} </td>
					<td> {VIEW.username} ({VIEW.userfullname})</td>
					<td class="text-center">
						<!-- BEGIN: display -->
						<span data-toggle="tooltip" data-placement="top" title="" data-original-title="{LANG.status_1}"><em class="fa fa-check fa-pointer">&nbsp;</em></span>
						<!-- END: display -->
						<!-- BEGIN: display_none -->
						<span data-toggle="tooltip" data-placement="top" title="" data-original-title="{LANG.status_0}"><em class="fa fa-circle-o fa-pointer">&nbsp;</em></span>
						<!-- END: display_none -->
						<!-- BEGIN: queue -->
						<span data-toggle="tooltip" data-placement="top" title="" data-original-title="{LANG.status_2}"><em class="fa fa-hourglass-o fa-pointer">&nbsp;</em></span>
						<!-- END: queue -->
					</td>
					<td class="text-center"><input type="checkbox" name="status" id="change_status_{VIEW.id}" value="{VIEW.id}" {CHECK} onclick="nv_change_status({VIEW.id});" /></td>
					<td class="text-center">
						<a href="{VIEW.link_highlights}&is_modal=1" data-code="{VIEW.code}" data-title="{VIEW.jobs_id}" onclick="nv_main_add_highlights( $(this) ); return false;" title="{LANG.record_highlights_add}" data-toggle="tooltip" data-placement="top" title="" data-original-title="{LANG.record_highlights_add}"><i class="fa fa-star-o fa-lg">&nbsp;</i></a>
						<a href="{VIEW.link_edit}" title="{LANG.edit}" data-toggle="tooltip" data-placement="top" title="" data-original-title="{LANG.edit}"><i class="fa fa-edit fa-lg">&nbsp;</i></a>
						<a href="{VIEW.link_delete}" onclick="return confirm(nv_is_del_confirm[0]);" title="{LANG.delete}" data-toggle="tooltip" data-placement="top" title="" data-original-title="{LANG.delete}"><em class="fa fa-trash-o fa-lg">&nbsp;</em></a>
					</td>
				</tr>
				<!-- END: loop -->
			</tbody>
		</table>
	</div>
</form>
<form class="form-inline m-bottom">
	<select class="form-control" id="action">
		<!-- BEGIN: action -->
		<option value="{ACTION.key}">{ACTION.value}</option>
		<!-- END: action -->
	</select>
	<button class="btn btn-primary" onclick="nv_list_post_action( $('#action').val(), '{BASE_URL}', '{LANG.del_confirm_no_post}' ); return false;">{LANG.perform}</button>
</form>
<script>
	function nv_change_status(id) {
		var new_status = $('#change_status_' + id).is(':checked') ? true : false;
		if (confirm(nv_is_change_act_confirm[0])) {
			var nv_timer = nv_settimeout_disable('change_status_' + id, 5000);
			$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=record&nocache=' + new Date().getTime(), 'change_status=1&id=' + id, function(res) {
				var r_split = res.split('_');
				if (r_split[0] != 'OK') {
					alert(nv_is_change_act_confirm[2]);
				}
			});
		} else {
			$('#change_status_' + id).prop('checked', new_status ? false : true);
		}
		return;
	}
</script>

<!-- END: main -->