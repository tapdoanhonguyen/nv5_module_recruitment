<!-- BEGIN: main -->
<style type="text/css">
	body {
		font-size: 12px;
		background: #FFFFFF;
	}
	#print{
		padding: 10px;
	}
	#print h2, #print h3, #print h4{
		text-transform: uppercase;
		text-align: center;
		font-weight: bold
	}
	#print .table > tbody > tr > td
	{
		border-top: 1px dotted #dddddd;
	}
</style>

<script type="text/javascript">
	$(document).ready(function() {
	    window.print();
	});
</script>

<div id="print">
	<h1 class="m-bottom">{ROW.title}</h1>
	<p class="m-bottom">{JOBPROVIDER.title} - <strong>{LANG.code}: </strong>{ROW.code} - <strong>{LANG.viewjob_timepost}:</strong> {ROW.addtime}</p>
	<div class="panel panel-default">
		<div class="panel-heading">{LANG.viewjob_title}</div>
		<table class="table">
			<col width="200" />
			<tbody>
				<tr>
					<td><strong>{LANG.jobs}</strong></td>
					<td>{ROW.jobs}</td>
				</tr>
				<tr>
					<td><strong>{LANG.position_id}</strong></td>
					<td>{ROW.position}</td>
				</tr>
				<tr>
					<td><strong>{LANG.worktype_id}</strong></td>
					<td>{ROW.worktype}</td>
				</tr>
				<tr>
					<td><strong>{LANG.work_address}</strong></td>
					<td>{ROW.province}</td>
				</tr>
				<tr>
					<td><strong>{LANG.salary}</strong></td>
					<td>{ROW.salary}</td>
				</tr>
				<tr>
					<td><strong>{LANG.job_description}</strong></td>
					<td>{ROW.job_description}</td>
				</tr>
				<tr>
					<td><strong>{LANG.quantity}</strong></td>
					<td>{ROW.quantity}</td>
				</tr>
				<tr>
					<td><strong>{LANG.more_requirement}</strong></td>
					<td>{ROW.more_requirement}</td>
				</tr>
				<tr>
					<td><strong>{LANG.degree}</strong></td>
					<td>{ROW.degree}</td>
				</tr>
				<tr>
					<td><strong>{LANG.gender}</strong></td>
					<td>{ROW.gender}</td>
				</tr>
				<tr>
					<td><strong>{LANG.age}</strong></td>
					<td>{ROW.age}</td>
				</tr>
				<tr>
					<td><strong>{LANG.document}</strong></td>
					<td>
						<!-- BEGIN: document -->
						<ul>
							<!-- BEGIN: loop -->
							<li>- {DOCUMENT}</li>
							<!-- END: loop -->
						</ul>
						<!-- END: document -->
					</td>
				</tr>
				<tr>
					<td><strong>{LANG.document_exp}</strong></td>
					<td>{ROW.document_exp}</td>
				</tr>
				<tr>
					<td><strong>{LANG.document_type_id}</strong></td>
					<td>
						<!-- BEGIN: document_type -->
						<ul>
							<!-- BEGIN: loop -->
							<li>- {DOCUMENT_TYPE}</li>
							<!-- END: loop -->
						</ul>
						<!-- END: document_type -->
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">{LANG.contact_info}</div>
		<table class="table">
			<col width="200" />
			<tbody>
				<tr>
					<td><strong>{LANG.fullname}</strong></td>
					<td>{ROW.contact_fullname}</td>
				</tr>
				<tr>
					<td><strong>{LANG.email}</strong></td>
					<td>{ROW.contact_email}</td>
				</tr>
				<tr>
					<td><strong>{LANG.phone}</strong></td>
					<td>{ROW.contact_phone}</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">{LANG.viewjob_jobprovider}</div>
		<table class="table">
			<col width="200" />
			<tbody>
				<tr>
					<td><strong>{LANG.company_name}</strong></td>
					<td>{JOBPROVIDER.title}</td>
				</tr>
				<tr>
					<td><strong>{LANG.company_description}</strong></td>
					<td>{JOBPROVIDER.description}</td>
				</tr>
				<tr>
					<td><strong>{LANG.address}</strong></td>
					<td>{JOBPROVIDER.address}</td>
				</tr>
				<tr>
					<td><strong>{LANG.email}</strong></td>
					<td>{JOBPROVIDER.email}</td>
				</tr>
				<tr>
					<td><strong>{LANG.website}</strong></td>
					<td>{JOBPROVIDER.website}</td>
				</tr>
				<tr>
					<td><strong>{LANG.agent}</strong></td>
					<td>{JOBPROVIDER.agent}</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<!-- END: main -->