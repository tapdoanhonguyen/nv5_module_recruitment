<!-- BEGIN: main -->
<div class="m-bottom text-right form-tooltip">
	<button class="btn btn-primary btn-xs" onclick="window.location.href='{POST_URL}'"><em class="fa fa-hand-pointer-o">&nbsp;</em>{LANG.post_create}</button>
</div>
<div class="table-responsive">
	<table class="table table-striped table-bordered table-hover">
		<colgroup>
			<col width="50" />
			<col />
			<col width="90" />
			<col width="90" />
			<col width="130" />
			<col width="80" />
			<col width="70" />
		</colgroup>
		<thead>
			<tr>
				<th class="text-center"><input name="check_all[]" type="checkbox" value="yes" onclick="nv_checkAll(this.form, 'idcheck[]', 'check_all[]',this.checked);" /></th>
				<th>{LANG.title}</th>
				<th>{LANG.sended_record}</th>
				<th class="text-center">{LANG.viewcount}</th>
				<th>{LANG.addtime}</th>
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
				<td>
					<!-- BEGIN: url -->
					<a href="{VIEW.link_view}" title="{VIEW.title}">{VIEW.title}</a>
					<!-- END: url -->
					<!-- BEGIN: label -->
					{VIEW.title}
					<!-- END: label -->
				</td>
				<td class="text-center"> <a href="{VIEW.sended_record_url}" title="{LANG.sended_record_list}">{VIEW.num_record} {LANG.record}</a> </td>
				<td class="text-center"> {VIEW.viewcount} </td>
				<td> {VIEW.addtime} </td>
				<td class="text-center">
					<!-- BEGIN: display -->
					<input type="checkbox" name="status" id="change_status_{VIEW.id}" value="{VIEW.id}" {CHECK} onclick="nv_change_status({VIEW.id});" />
					<!-- END: display -->
					<!-- BEGIN: queue -->
					<em>{LANG.status_queue}</em>
					<!-- END: queue -->
				</td>
				<td class="text-center">
					<a href="{VIEW.link_edit}" title="{LANG.edit}"><i class="fa fa-edit">&nbsp;</i></a>
					<a href="{VIEW.link_delete}" onclick="nv_list_post_del( $(this) ); return false;" title="{LANG.delete}"><em class="fa fa-trash-o">&nbsp;</em></a>
				</td>
			</tr>
			<!-- END: loop -->
		</tbody>
	</table>
</div>
<form class="form-inline m-bottom">
	<select class="form-control" id="action">
		<!-- BEGIN: action -->
		<option value="{ACTION.key}">{ACTION.value}</option>
		<!-- END: action -->
	</select>
	<button class="btn btn-primary" onclick="nv_list_post_dellist( $('#action').val(), '{BASE_URL}', '{LANG.del_confirm_no_post}' ); return false;">{LANG.perform}</button>
</form>

<script type="text/javascript">
	function nv_change_status(id) {
		var new_status = $('#change_status_' + id).is(':checked') ? true : false;
		if (confirm(nv_is_change_act_confirm[0])) {
			var nv_timer = nv_settimeout_disable('change_status_' + id, 5000);
			$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '={OP}&nocache=' + new Date().getTime(), 'change_status=1&id=' + id, function(res) {
				var r_split = res.split('_');
				if (r_split[0] != 'OK') {
					alert(nv_is_change_act_confirm[2]);
				}
			});
		}
		else{
			$('#change_status_' + id).prop('checked', new_status ? false : true );
		}
		return;
	}
</script>

<!-- END: main -->