<!-- BEGIN: main -->
<h1 class="wtitle">{LANG.sended_record_list_s}</h1>
<em class="show m-bottom">{LANG.sended_record_number}</em>
<!-- BEGIN: view -->
<form action="{NV_BASE_SITEURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th class="w100 text-center">{LANG.number}</th>
					<th>{LANG.title}</th>
					<th>{LANG.fullname}</th>
					<th>{LANG.email}</th>
					<th>{LANG.phone}</th>
					<th>{LANG.sendtime}</th>
					<th class="w150">&nbsp;</th>
				</tr>
			</thead>
			<!-- BEGIN: generate_page -->
			<tfoot>
				<tr>
					<td class="text-center" colspan="9">{NV_GENERATE_PAGE}</td>
				</tr>
			</tfoot>
			<!-- END: generate_page -->
			<tbody>
				<!-- BEGIN: loop -->
				<tr>
					<td class="text-center"> {VIEW.number} </td>
					<td> <a href="{VIEW.link_view}" title="{VIEW.title}">{VIEW.title}</a> </td>
					<td> {VIEW.fulname} </td>
					<td> <a href="mailto:{VIEW.email}" title="Mail to: {VIEW.email}">{VIEW.email}</a> </td>
					<td> {VIEW.phone} </td>
					<td> {VIEW.sendtime} </td>
					<td class="text-center"><em class="fa fa-trash-o">&nbsp;</em> <a href="{VIEW.link_delete}" onclick="return confirm(nv_is_del_confirm[0]);">{LANG.delete}</a></td>
				</tr>
				<!-- END: loop -->
			</tbody>
		</table>
	</div>
</form>
<!-- END: view -->

<!-- END: main -->