<!-- BEGIN: main -->

<!-- BEGIN: empty -->
<div class="alert alert-info">{LANG.record_empty}</div>
<!-- END: empty -->

<blockquote>
	- {LANG.record_limit_content}.<br />
	- {LANG.record_limit_content1}.<br />
</blockquote>
<hr />
<div class="m-bottom text-right">
	<button onclick="window.location.href='{URL_CREATE}';" class="btn btn-primary btn-xs" <!-- BEGIN: record_create_dis -->disabled="disabled"<!-- END: record_create_dis -->><em class="fa fa-clone">&nbsp;</em>{LANG.record_create}</button>
</div>

<!-- BEGIN: view -->
<form action="{NV_BASE_SITEURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover">
			<colgroup>
				<col width="50" />
				<col width="100" />
				<col span="2" />
				<col width="100" />
				<col width="80" />
			</colgroup>
			<thead>
				<tr>
					<th class="text-center">{LANG.number}</th>
					<th>{LANG.record_code}</th>
					<th>{LANG.jobs_id}</th>
					<th>{LANG.position_id}</th>
					<th class="text-center">{LANG.active}</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<!-- BEGIN: generate_page -->
			<tfoot>
				<tr>
					<td class="text-center" colspan="5">{NV_GENERATE_PAGE}</td>
				</tr>
			</tfoot>
			<!-- END: generate_page -->
			<tbody>
				<!-- BEGIN: loop -->
				<tr>
					<td class="text-center"> {VIEW.number} </td>
					<td>{VIEW.code}</td>
					<td>
						<!-- BEGIN: url -->
						<a href="{VIEW.link_view}" title="{VIEW.jobs}">{VIEW.jobs}</a>
						<!-- END: url -->
						<!-- BEGIN: label -->
						{VIEW.jobs}
						<!-- END: label -->
					</td>
					<td> {VIEW.position_id} </td>
					<td class="text-center form-tooltip">
						<!-- BEGIN: display -->
						<input type="checkbox" name="status" id="change_status_{VIEW.id}" value="{VIEW.id}" {CHECK} onclick="nv_change_status({VIEW.id});" />
						<!-- END: display -->

						<!-- BEGIN: lock_display -->
						<label data-toggle="tooltip" data-placement="top" title="" data-original-title="{LANG.record_locked}"><input type="checkbox" disabled="disabled" /></label>
						<!-- END: lock_display -->

						<!-- BEGIN: draft -->
						<a href="{VIEW.link_edit}" data-toggle="tooltip" data-placement="top" title="" data-original-title="{LANG.record_status_draft_note}"><em>{LANG.status_draft}</em></a>
						<!-- END: draft -->

						<!-- BEGIN: queue -->
						<em>{LANG.status_queue}</em>
						<!-- END: queue -->
					</td>
					<td class="text-center form-tooltip"><a href="{VIEW.link_edit}" data-toggle="tooltip" data-placement="top" title="" data-original-title="{LANG.edit}"><i class="fa fa-edit fa-lg">&nbsp;</i></a> <a href="{VIEW.link_delete}" onclick="return confirm(nv_is_del_confirm[0]);" data-toggle="tooltip" data-placement="top" title="" data-original-title="{LANG.delete}"><em class="fa fa-trash-o fa-lg">&nbsp;</em></a></td>
				</tr>
				<!-- END: loop -->
			</tbody>
		</table>
	</div>
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
<!-- END: view -->

<!-- END: main -->