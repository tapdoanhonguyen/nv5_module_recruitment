<!-- BEGIN: main -->
<link rel="stylesheet" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.css">

<!-- BEGIN: error -->
<div class="alert alert-warning">
	{ERROR}
</div>
<!-- END: error -->

<form class="form-horizontal" action="{ACTION}" method="post" enctype="multipart/form-data">
	<div class="panel panel-default">
		<div class="panel-heading">{LANG.viewrecord_job_wish}</div>
		<div class="panel-body">
			<input type="hidden" name="id" value="{ROW.id}" />
			<div class="form-group">
				<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.userid}</strong></label>
				<div class="col-sm-19 col-md-20">
					<select name="userid" id="userid" class="form-control">
						<!-- BEGIN: userid -->
						<option value="{ROW.userid}" selected="selected">{ROW.username}</option>
						<!-- END: userid -->
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.record_code}</strong></label>
				<div class="col-sm-14 col-md-20">
					<input class="form-control" type="text" name="code" value="{ROW.code}" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.record_title}</strong></label>
				<div class="col-sm-14 col-md-20">
					<input class="form-control" type="text" name="title" value="{ROW.title}" />
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.alias}</strong></label>
				<div class="col-sm-19 col-md-18">
					<input class="form-control" type="text" name="alias" value="{ROW.alias}" id="id_alias" />
				</div>
				<div class="col-sm-4 col-md-2">
					<i class="fa fa-refresh fa-lg icon-pointer" onclick="nv_get_alias();">&nbsp;</i>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.jobs_id}</strong> <span class="red">(*)</span></label>
				<div class="col-sm-14 col-md-20">
					<select multiple="multiple" class="form-control jobs_id" name="jobs_id[]">
						<option value=""> ---{LANG.jobs_id_c}--- </option>
						<!-- BEGIN: select_jobs_id -->
						<option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
						<!-- END: select_jobs_id -->
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.record_position}</strong> <span class="red">(*)</span></label>
				<div class="col-sm-14 col-md-20">
					<select class="form-control" name="position_id">
						<option value=""> ---{LANG.record_position_c}--- </option>
						<!-- BEGIN: select_position_id -->
						<option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
						<!-- END: select_position_id -->
					</select>
				</div>
			</div>
			
			
			<!-- BEGIN: address -->
					<div class="content_ajax">
						<!-- BEGIN: delete -->
						<i class="fa fa-times" aria-hidden="true"></i>
						<!-- END: delete -->
					<div class="add_address_ajax">
					<div class="form-group">
						<label class="col-xs-24 col-sm-5 control-label"><strong>{LANG.city}</strong> <span class="red">(*)</span></label>
						<div class="col-xs-24 col-sm-19">
							<select onchange="tinhthanh(this)" name="province[]" class="form-control tinhthanh">
								<option value="0">-- {LANG.selected_city} --</option>
								<!-- BEGIN: tinh -->
								<option {l.selected} value="{l.provinceid}">-- {l.type} {l.title} --</option>
								<!-- END: tinh -->
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-xs-24 col-sm-5 control-label"><strong>{LANG.district}</strong> <span class="red">(*)</span></label>
						<div class="col-xs-24 col-sm-19">
							<select onchange="quanhuyen(this)" name="district[]" class="form-control quanhuyen">
							<option value="0">-- {LANG.selected_district} --</option>
							<!-- BEGIN: quan -->
							<option {l.selected} value="{l.districtid}">-- {l.type} {l.title} --</option>
							<!-- END: quan -->
							</select>
						</div>
					</div> 
					<div class="form-group">
						<label class="col-xs-24 col-sm-5 control-label"><strong>{LANG.wards}</strong></label>
						<div class="col-xs-24 col-sm-19">
							<select name="wards[]" class="form-control xaphuong">
							<option value="0">-- {LANG.selected_wards} --</option>
							<!-- BEGIN: xa -->
							<option {l.selected} value="{l.wardid}">-- {l.type} {l.title} --</option>
							<!-- END: xa -->
							</select>
						</div>
					</div>
					</div>
					</div>
					<!-- END: address -->
					
					<div class="total_address"></div>
					
					<div class="button_add_address"><span class="btn btn-primary">{LANG.add_address}</span></div>
					
			<div class="form-group">
				<label class="col-xs-24 col-sm-4 control-label"><strong>{LANG.salary}</strong></label>
				<div class="col-xs-24 col-sm-8">
					<input class="form-control" type="text" name="salary_from" value="{ROW.salary_from}" placeholder="{LANG.salary_from}" />
				</div>
				<div class="col-xs-24 col-sm-8">
					<input class="form-control" type="text" name="salary_to" value="{ROW.salary_to}" placeholder="{LANG.salary_to}" />
				</div>
				<div class="col-xs-24 col-sm-4">
							<select class="form-control" name="money_units">
								<!-- BEGIN: money_units -->
								<option value="{MONEY_UNITS.id}" {MONEY_UNITS.selected}>{MONEY_UNITS.title}</option>
								<!-- END: money_units -->
							</select>
						</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.worktype_id}</strong></label>
				<div class="col-sm-14 col-md-20">
					<select class="form-control" name="worktype_id">
						<option value=""> ---{LANG.worktype_id_c}--- </option>
						<!-- BEGIN: select_worktype_id -->
						<option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
						<!-- END: select_worktype_id -->
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.target}</strong></label>
				<div class="col-sm-14 col-md-20">
					<textarea class="form-control" style="height:100px;" cols="75" rows="5" name="target">{ROW.target}</textarea>
				</div>
			</div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">{LANG.learning}</div>
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.learning}</strong></label>
				<div class="col-sm-14 col-md-20">
					<select class="form-control" name="learning_id">
						<!-- BEGIN: learning -->
						<option value="{LEARNING.id}" {LEARNING.selected}>{LEARNING.title}</option>
						<!-- END: learning -->
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.graduate_school}</strong></label>
				<div class="col-sm-14 col-md-20">
					<input class="form-control" type="text" name="graduate_school" value="{ROW.graduate_school}" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.graduate_year}</strong></label>
				<div class="col-sm-14 col-md-20">
					<input class="form-control" type="text" name="graduate_year" value="{ROW.graduate_year}" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-4 control-label">
					<strong>{LANG.foreign_language}</strong>
				</label>
				<div class="col-sm-14 col-md-20">
					<textarea class="form-control" style="height:100px;" cols="75" rows="5" name="foreign_language">{ROW.foreign_language}</textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-4 control-label">
					<strong>{LANG.degreed_other}</strong>
				</label>
				<div class="col-sm-14 col-md-20">
					<textarea class="form-control" style="height:100px;" cols="75" rows="5" name="degree">{ROW.degree}</textarea>
				</div>
			</div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">{LANG.worked_experience}</div>
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.worked_company}</strong></label>
				<div class="col-sm-14 col-md-20">
					<textarea class="form-control" style="height:100px;" cols="75" rows="5" name="worked_company">{ROW.worked_company}</textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.worked_work}</strong></label>
				<div class="col-sm-14 col-md-20">
					<textarea class="form-control" style="height:100px;" cols="75" rows="5" name="worked_work">{ROW.worked_work}</textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.worked_position}</strong></label>
				<div class="col-sm-14 col-md-20">
					<textarea class="form-control" style="height:100px;" cols="75" rows="5" name="worked_position">{ROW.worked_position}</textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.time_experience}</strong> <span class="red">(*)</span></label>
				<div class="col-sm-14 col-md-20">
					<input class="form-control" type="text" name="experience" value="{ROW.experience}" pattern="^[0-9]*$"  oninvalid="setCustomValidity( nv_digits )" oninput="setCustomValidity('')" required="required" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.achievement}</strong></label>
				<div class="col-sm-14 col-md-20">
					<textarea class="form-control" style="height:100px;" cols="75" rows="5" name="achievement">{ROW.achievement}</textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.skill}</strong></label>
				<div class="col-sm-14 col-md-20">
					<textarea class="form-control" style="height:100px;" cols="75" rows="5" name="skill">{ROW.skill}</textarea>
				</div>
			</div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">{LANG.contact_info}</div>
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.fullname}</strong> <span class="red">(*)</span></label>
				<div class="col-sm-14 col-md-20">
					<input class="form-control required" type="text" name="contact_fullname" value="{ROW.contact_fullname}" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.email}</strong> <span class="red">(*)</span></label>
				<div class="col-sm-14 col-md-20">
					<input class="form-control required" type="email" name="contact_email" value="{ROW.contact_email}" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.phone}</strong> <span class="red">(*)</span></label>
				<div class="col-sm-14 col-md-20">
					<input class="form-control required" type="text" name="contact_phone" value="{ROW.contact_phone}" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.record_image}</strong></label>
				<div class="col-sm-14 col-md-20">
					<div class="input-group m-bottom">
						<input type="text" class="form-control" id="file_name" disabled>
						<span class="input-group-btn">
							<button class="btn btn-default" onclick="$('#upload_fileupload').click();" type="button">
								<em class="fa fa-folder-open-o fa-fix">&nbsp;</em> {LANG.file_selectfile}
							</button> </span>
					</div>
					<input type="file" name="upload_fileupload" id="upload_fileupload" style="display: none" />
					<!-- BEGIN: contact_image -->
					<img src="{ROW.contact_image}" class="img-thumbnail" />
					<!-- END: contact_image -->
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.more}</strong></label>
				<div class="col-sm-14 col-md-20">
					<textarea class="form-control" name="contact_more">{ROW.contact_more}</textarea>
				</div>
			</div>
		</div>
	</div>
	<div class="text-center">
		<input class="btn btn-primary" name="submit" type="submit" value="{LANG.save}" />
		<!-- BEGIN: record_acept -->
		<label><input type="checkbox" name="status" value="1" {ROW.ck_record_acept} />{LANG.record_acept}</label>
		<!-- END: record_acept -->
	</div>
</form>

<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/i18n/{NV_LANG_INTERFACE}.js"></script>
<script type="text/javascript">


$('.content_ajax i').click(function(){
			$(this).parent().remove();
		});
		
	
	function tinhthanh(a){
		var tinhthanh = $(a).val();
		if(tinhthanh > 0)
		{
				$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=config&id_tinhthanh=' + tinhthanh, function(res) {
				
					$(a).parent().parent().parent().find('.quanhuyen').html(res);
					
				});
		}
		}
		
		function quanhuyen(a){
			var id_quanhuyen = $(a).val();
			if(id_quanhuyen != '')
			{
				$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=config&id_quanhuyen=' + id_quanhuyen, function(res) {
				
						$(a).parent().parent().parent().find('.xaphuong').html(res);
						
					});
			}
		
		}
		
		
$(".jobs_id, .tinhthanh, .quanhuyen, .xaphuong").select2();

function nv_get_alias() {
		var title = strip_tags( $("[name='title']").val() );
		if (title != '') {
			$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=record_content&nocache=' + new Date().getTime(), 'get_alias_title=' + encodeURIComponent(title), function(res) {
				$("[name='alias']").val( strip_tags( res ) );
			});
		}
		return false;
	}
	
	
	$(document).ready(function() {
	
		$('.button_add_address').click(function(){
			
			$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=config&add_address=1', function(res) {
					$('.total_address').append(res);
					
				});
		
		});
	
	
		$("[name='title']").change(function(){
			nv_get_alias();
		});
		
		$("#userid").select2({
			language: "vi",
			ajax: {
		    url: script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=record_content&get_user_json=1',
		    	dataType: 'json',
		    	delay: 250,
		    	data: function (params) {
		      		return {
		      			q: params.term, // search term
		      			page: params.page
		      		};
		      	},
		    	processResults: function (data, params) {
		    		params.page = params.page || 1;
		    		return {
		    			results: data,
		    			pagination: {
		    				more: (params.page * 30) < data.total_count
		    			}
		    		};
		    	},
			cache: true
			},
			escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
			minimumInputLength: 3,
			templateResult: formatRepo, // omitted for brevity, see the source of this page
			templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
		});
	});

	function formatRepo (repo) {
		if (repo.loading) return repo.text;

		var markup = '<div class="clearfix">' +
		'<div class="col-sm-19">' + repo.username + '</div>' +
	    '<div clas="col-sm-5"><span class="show text-right">' + repo.fullname + '</span></div>' +
	    '</div>';
		markup += '</div></div>';
		return markup;
	}

	function formatRepoSelection (repo) {
		$('#username').val( repo.username );
		return repo.username || repo.text;
	}
</script>
<!-- END: main -->