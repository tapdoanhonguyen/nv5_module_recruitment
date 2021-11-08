<!-- BEGIN: main -->
<link rel="stylesheet" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.css">

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
<form action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th class="w50 text-center"><input name="check_all[]" type="checkbox" value="yes" onclick="nv_checkAll(this.form, 'idcheck[]', 'check_all[]',this.checked);" /></th>
					<th class="w100">{LANG.post_code}</th>
					<th>{LANG.title}</th>
					<th>{LANG.jobs_id}</th>
					<th>{LANG.position}</th>
					<th>{LANG.post_time}</th>
					<th class="text-center">{LANG.post_viewcount}</th>
					<th class="w100 text-center">{LANG.active}</th>
					<th class="w100">&nbsp;</th>
				</tr>
			</thead>
			<!-- BEGIN: generate_page -->
			<tfoot>
				<tr>
					<td class="text-center" colspan="11">{NV_GENERATE_PAGE}</td>
				</tr>
			</tfoot>
			<!-- END: generate_page -->
			<tbody>
				<!-- BEGIN: loop -->
				<tr>
					<td class="text-center">
						<input type="checkbox" class="post" onclick="nv_UncheckAll(this.form, 'idcheck[]', 'check_all[]', this.checked);" value="{VIEW.id}" name="idcheck[]" />
					</td>
					<td> <strong>{VIEW.code}</strong> </td>
					<td>
						<a href="{VIEW.link_view_post}" target="_blank" title="{VIEW.title}">{VIEW.title}</a>
						<small class="show"><a href="{VIEW.link_view_jobprovider}" target="_blank" title="{VIEW.jobprovider.title}" class="text-success">{VIEW.jobprovider.title}</a></small>
					</td>
					<td> {VIEW.jobs} </td>
					<td> {VIEW.position} </td>
					<td> {VIEW.addtime} </td>
					<td class="text-center"> {VIEW.viewcount} </td>
					<td class="text-center"><input type="checkbox" name="status" id="change_status_{VIEW.id}" value="{VIEW.id}" {CHECK} onclick="nv_change_status({VIEW.id});" /></td>
					<td class="text-center">
						<a href="{VIEW.link_highlights}&is_modal=1" data-code="{VIEW.code}" data-title="{VIEW.title}" onclick="nv_main_add_highlights( $(this) ); return false;" title="{LANG.highlights_add}" data-toggle="tooltip" data-placement="top" title="" data-original-title="{LANG.highlights_add}"><i class="fa fa-star-o fa-lg">&nbsp;</i></a>
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
	<button class="btn btn-primary" onclick="nv_list_post_action( $('#action').val(), '{BASE_URL}', '{CHECKSS}', '{LANG.del_confirm_no_post}' ); return false;">{LANG.perform}</button>
</form>

<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.js"></script>
<script>
	$('#jobs_id,#position_id').select2();
	function nv_change_status(id) {
		var new_status = $('#change_status_' + id).is(':checked') ? true : false;
		if (confirm(nv_is_change_act_confirm[0])) {
			var nv_timer = nv_settimeout_disable('change_status_' + id, 5000);
			$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=main&nocache=' + new Date().getTime(), 'change_status=1&id=' + id, function(res) {
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