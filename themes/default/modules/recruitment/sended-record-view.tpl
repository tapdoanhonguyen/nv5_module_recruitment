<!-- BEGIN: main -->
<div class="viewjobs jobprovider">
	<div class="row">
		<div class="col-md-16">
			<h1 class="wtitle">{DATA.title}</h1>
		</div>
		<div class="col-md-8">
			<ul class="list-inline form-tooltip text-right">
				<li><em class="fa fa-reply">&nbsp;</em><a href="{DATA.sended_record_url}" data-toggle="tooltip" data-placement="top" title="" data-original-title='{LANG.sended_record_list_s}'>{LANG.back}</a></li>
			</ul>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-body">
			<dl class="dl-horizontal">
				<dt><strong>{LANG.post}:</strong></dt>
				<dd><a href="{POST.url_view}" title="{POST.title}">{POST.title}</a></dd>

				<dt><strong>{LANG.fullname}:</strong></dt>
				<dd>{DATA.fulname}</dd>

				<dt><strong>{LANG.email}:</strong></dt>
				<dd><a href="mailto:{DATA.email}" title="Mail to: {DATA.email}">{DATA.email}</a></dd>

				<dt><strong>{LANG.phone}:</strong></dt>
				<dd>{DATA.phone}</dd>

				<dt><strong>{LANG.file}:</strong></dt>
				<dd><em class="fa fa-download">&nbsp;</em><a href="#" title="{LANG.file_download}" onclick="window.location.href=nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=sended-record-view&download=1&record_id={DATA.id}'; return false;">{LANG.file_download}</a></dd>
			</dl>
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-body">
			<p>{DATA.introduction}</p>
		</div>
	</div>
</div>
<!-- END: main -->