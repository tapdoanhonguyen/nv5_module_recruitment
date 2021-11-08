<!-- BEGIN: main -->

<div class="well">
<form action="{NV_BASE_ADMINURL}index.php" method="get">
	<input type="hidden" name="{NV_LANG_VARIABLE}"  value="{NV_LANG_DATA}" />
	<input type="hidden" name="{NV_NAME_VARIABLE}"  value="{MODULE_NAME}" />
	<input type="hidden" name="{NV_OP_VARIABLE}"  value="{OP}" />
	<div class="row">
		<div class="col-xs-24 col-md-6">
			<div class="form-group">
				<input class="form-control" type="text" value="{Q}" name="q" maxlength="255" placeholder="{LANG.search_title}" />
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
					<th class="w50 text-center">{LANG.number}</th>
					<th>{LANG.post_code}</th>
					<th>{LANG.title}</th>
					<th class="w100 text-center">{LANG.is_hot}</th>
					<th class="w100 text-center">{LANG.is_highlights}</th>
					<th>{LANG.time_begin}</th>
					<th>{LANG.time_end}</th>
					<th class="w100 text-center">{LANG.active}</th>
					<th class="w150">&nbsp;</th>
				</tr>
			</thead>
			<!-- BEGIN: generate_page -->
			<tfoot>
				<tr>
					<td class="text-center" colspan="8">{NV_GENERATE_PAGE}</td>
				</tr>
			</tfoot>
			<!-- END: generate_page -->
			<tbody>
				<!-- BEGIN: loop -->
				<tr>
					<td class="text-center"> {VIEW.number} </td>
					<td> {VIEW.code} </td>
					<td> {VIEW.title} </td>
					<td class="text-center">
						<!-- BEGIN: is_hot -->
						<em class="fa fa-check">&nbsp;</em>
						<!-- END: is_hot -->
						<!-- BEGIN: n_is_hot -->
						<em class="fa fa-circle-o">&nbsp;</em>
						<!-- END: n_is_hot -->
					</td>
					<td class="text-center">
						<!-- BEGIN: is_highlights -->
						<em class="fa fa-check">&nbsp;</em>
						<!-- END: is_highlights -->
						<!-- BEGIN: n_is_highlights -->
						<em class="fa fa-circle-o">&nbsp;</em>
						<!-- END: n_is_highlights -->
					</td>
					<td> {VIEW.time_begin} </td>
					<td> {VIEW.time_end} </td>
					<td class="text-center"><input type="checkbox" name="status" id="change_status_{VIEW.id}" value="{VIEW.id}" {CHECK} onclick="nv_change_status({VIEW.id});" /></td>
					<td class="text-center"><i class="fa fa-edit fa-lg">&nbsp;</i> <a href="{VIEW.link_edit}">{LANG.edit}</a> - <em class="fa fa-trash-o fa-lg">&nbsp;</em> <a href="{VIEW.link_delete}" onclick="return confirm(nv_is_del_confirm[0]);">{LANG.delete}</a></td>
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
			$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=highlights&nocache=' + new Date().getTime(), 'change_status=1&id=' + id, function(res) {
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