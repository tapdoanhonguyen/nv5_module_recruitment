<!-- BEGIN: main -->
<div class="alert alert-info">{LANG.record_add_note}</div>

<!-- BEGIN: error -->
<div class="alert alert-warning">
	{ERROR}
</div>
<!-- END: error -->

<form class="form-horizontal" action="{NV_BASE_SITEURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post" enctype="multipart/form-data">
	<input type="hidden" name="id" value="{ROW.id}" />
	<input type="hidden" name="status" value="{ROW.status}" />
	<div class="panel panel-default">
		<div class="panel-heading">{LANG.viewrecord_job_wish}</div>
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-5 col-md-7 control-label"><strong>{LANG.record_title}</strong></label>
				<div class="col-sm-14 col-md-17">
					<input class="form-control" type="text" name="title" value="{ROW.title}" />
					<small class="help-block"><em>{LANG.record_title_note}</em></small>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-5 col-md-7 control-label"><strong>{LANG.alias}</strong></label>
				<div class="col-sm-10 col-md-15">
					<input class="form-control" type="text" name="alias" value="{ROW.alias}" id="id_alias" />
				</div>
				<div class="col-sm-4 col-md-2">
				
					<i onclick="nv_get_alias();" class="fa fa-refresh" aria-hidden="true"></i>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-5 col-md-7 control-label"><strong>{LANG.jobs_id}</strong></label>
				<div class="col-sm-14 col-md-17">
					<select multiple="multiple" class="form-control jobs_id" name="jobs_id[]">
						<option value=""> ---{LANG.jobs_c}--- </option>
						<!-- BEGIN: select_jobs_id -->
						<option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
						<!-- END: select_jobs_id -->
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-7 control-label"><strong>{LANG.position_id}</strong></label>
				<div class="col-sm-14 col-md-17">
					<select class="form-control required" name="position_id">
						<option value=""> ---{LANG.position_c}--- </option>
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
						<label class="col-sm-5 col-md-7 control-label"><strong>{LANG.city}</strong> <span class="red">(*)</span></label>
						<div class="col-sm-14 col-md-17">
							<select onchange="tinhthanh(this)" name="province[]" class="form-control tinhthanh">
								<option value="0">-- {LANG.selected_city} --</option>
								<!-- BEGIN: tinh -->
								<option {l.selected} value="{l.provinceid}">-- {l.type} {l.title} --</option>
								<!-- END: tinh -->
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-5 col-md-7 control-label"><strong>{LANG.district}</strong> <span class="red">(*)</span></label>
						<div class="col-sm-14 col-md-17">
							<select onchange="quanhuyen(this)" name="district[]" class="form-control quanhuyen">
							<option value="0">-- {LANG.selected_district} --</option>
							<!-- BEGIN: quan -->
							<option {l.selected} value="{l.districtid}">-- {l.type} {l.title} --</option>
							<!-- END: quan -->
							</select>
						</div>
					</div> 
					<div class="form-group">
						<label class="col-sm-5 col-md-7 control-label"><strong>{LANG.wards}</strong></label>
						<div class="col-sm-14 col-md-17">
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
				<label class="col-xs-24 col-md-7 control-label"><strong>{LANG.salary}</strong></label>
				<div class="col-xs-24 col-md-6">
					<input class="form-control" type="text" name="salary_from" value="{ROW.salary_from}" placeholder="{LANG.salary_from}" />
				</div>
				<div class="col-xs-24 col-md-6">
					<input class="form-control" type="text" name="salary_to" value="{ROW.salary_to}" placeholder="{LANG.salary_to}" />
				</div>
				<div class="col-xs-24 col-md-5">
					<select class="form-control" name="money_units">
						<!-- BEGIN: money_units -->
						<option value="{MONEY_UNITS.id}" {MONEY_UNITS.selected}>{MONEY_UNITS.note}</option>
						<!-- END: money_units -->
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-7 control-label"><strong>{LANG.worktype_id}</strong></label>
				<div class="col-sm-14 col-md-17">
					<select class="form-control" name="worktype_id">
						<option value=""> ---{LANG.worktype_id_c}--- </option>
						<!-- BEGIN: select_worktype_id -->
						<option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
						<!-- END: select_worktype_id -->
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-7 control-label"><strong>{LANG.target}</strong></label>
				<div class="col-sm-14 col-md-17">
					<textarea class="form-control" style="height:100px;" cols="75" rows="5" name="target">{ROW.target}</textarea>
				</div>
			</div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">{LANG.viewrecord_academic_level}</div>
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-5 col-md-7 control-label"><strong>{LANG.viewrecord_academic_level}</strong></label>
				<div class="col-sm-14 col-md-17">
					<select class="form-control" name="learning_id">
						<!-- BEGIN: learning -->
						<option value="{LEARNING.id}" {LEARNING.selected}>{LEARNING.title}</option>
						<!-- END: learning -->
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-7 control-label"><strong>{LANG.graduate_school}</strong></label>
				<div class="col-sm-14 col-md-17">
					<input class="form-control" type="text" name="graduate_school" value="{ROW.graduate_school}" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-7 control-label"><strong>{LANG.graduate_year}</strong></label>
				<div class="col-sm-14 col-md-17">
					<input class="form-control" type="text" name="graduate_year" value="{ROW.graduate_year}" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-7 control-label">
					<strong>{LANG.foreign_language}</strong>
				</label>
				<div class="col-sm-14 col-md-17">
					<textarea class="form-control" style="height:100px;" cols="75" rows="5" name="foreign_language">{ROW.foreign_language}</textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-7 control-label">
					<strong>{LANG.degreed_other}</strong>
				</label>
				<div class="col-sm-14 col-md-17">
					<textarea class="form-control" style="height:100px;" cols="75" rows="5" name="degree">{ROW.degree}</textarea>
					<small><em class="help-block">{LANG.degreed_other_note}</em></small>
				</div>
			</div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">{LANG.worked_experience}</div>
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-5 col-md-7 control-label"><strong>{LANG.worked_company}</strong></label>
				<div class="col-sm-14 col-md-17">
					<textarea class="form-control" style="height:100px;" cols="75" rows="5" name="worked_company">{ROW.worked_company}</textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-7 control-label"><strong>{LANG.worked_work}</strong></label>
				<div class="col-sm-14 col-md-17">
					<textarea class="form-control" style="height:100px;" cols="75" rows="5" name="worked_work">{ROW.worked_work}</textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-7 control-label"><strong>{LANG.worked_position}</strong></label>
				<div class="col-sm-14 col-md-17">
					<textarea class="form-control" style="height:100px;" cols="75" rows="5" name="worked_position">{ROW.worked_position}</textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-7 control-label"><strong>{LANG.time_experience}</strong></label>
				<div class="col-sm-14 col-md-17">
					<input class="form-control" type="text" name="experience" value="{ROW.experience}"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-7 control-label"><strong>{LANG.achievement}</strong></label>
				<div class="col-sm-14 col-md-17">
					<textarea class="form-control" style="height:100px;" cols="75" rows="5" name="achievement">{ROW.achievement}</textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-7 control-label"><strong>{LANG.skill}</strong></label>
				<div class="col-sm-14 col-md-17">
					<textarea class="form-control" style="height:100px;" cols="75" rows="5" name="skill">{ROW.skill}</textarea>
				</div>
			</div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">{LANG.viewrecord_jobseeker_info_contact}</div>
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-5 col-md-7 control-label"><strong>{LANG.contact_fullname}</strong></label>
				<div class="col-sm-14 col-md-17">
					<input class="form-control required" type="text" name="contact_fullname" value="{ROW.contact_fullname}" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-7 control-label"><strong>{LANG.email}</strong></label>
				<div class="col-sm-14 col-md-17">
					<input class="form-control required" type="email" name="contact_email" value="{ROW.contact_email}" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-7 control-label"><strong>{LANG.phone}</strong></label>
				<div class="col-sm-14 col-md-17">
					<input class="form-control required" type="text" name="contact_phone" value="{ROW.contact_phone}" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-7 control-label"><strong>{LANG.image}</strong></label>
				<div class="col-sm-14 col-md-17">
					<div class="input-group">
						<input type="text" class="form-control" id="file_name" disabled>
						<span class="input-group-btn">
							<button class="btn btn-default" onclick="$('#upload_fileupload').click();" type="button">
								<em class="fa fa-folder-open-o fa-fix">&nbsp;</em> {LANG.file_selectfile}
							</button> </span>
					</div>
					<em class="help-block">{LANG.image_size}: {ROW.record_size_width} x {ROW.record_size_height} cm</em>
					<input type="file" name="upload_fileupload" id="upload_fileupload" style="display: none" />
					<!-- BEGIN: contact_image -->
					<img src="{ROW.contact_image}" class="img-thumbnail" />
					<!-- END: contact_image -->
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-7 control-label"><strong>{LANG.contact_info_more}</strong></label>
				<div class="col-sm-14 col-md-17">
					<textarea class="form-control" name="contact_more">{ROW.contact_more}</textarea>
				</div>
			</div>
		</div>
	</div>

	<blockquote><em>{LANG.record_send_note}</em></blockquote>

	<div class="text-center m-bottom">
		<!-- BEGIN: save_tmp -->
		<input class="btn btn-success" name="submit_tmp" type="submit" value="{LANG.save_tmp}" />
		<!-- END: save_tmp -->

		<!-- BEGIN: send_record -->
		<input class="btn btn-primary" name="submit" type="submit" value="{LANG.record_send}" />
		<!-- END: send_record -->

		<!-- BEGIN: update_record -->
		<input class="btn btn-primary" name="submit" type="submit" value="{LANG.record_update}" />
		<!-- END: update_record -->
	</div>
</form>



<script type="text/javascript">


$('.content_ajax i').click(function(){
			$(this).parent().remove();
		});
		
	
	function tinhthanh(a){
		var tinhthanh = $(a).val();
		if(tinhthanh > 0)
		{
				$.post(nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=config&id_tinhthanh=' + tinhthanh, function(res) {
				
					$(a).parent().parent().parent().find('.quanhuyen').html(res);
					
				});
		}
		}
		
		function quanhuyen(a){
			var id_quanhuyen = $(a).val();
			if(id_quanhuyen != '')
			{
				$.post(nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=config&id_quanhuyen=' + id_quanhuyen, function(res) {
				
						$(a).parent().parent().parent().find('.xaphuong').html(res);
						
					});
			}
		
		}
		
		
$(".jobs_id, .tinhthanh, .quanhuyen, .xaphuong").select2();

function nv_get_alias() {
		var title = strip_tags( $("[name='title']").val() );
		if (title != '') {
			$.post(nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=record-content&nocache=' + new Date().getTime(), 'get_alias_title=' + encodeURIComponent(title), function(res) {
				$("[name='alias']").val( strip_tags( res ) );
			});
		}
		return false;
	}
	
	
	$(document).ready(function() {
	
		$('.button_add_address').click(function(){
			
			$.post(nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=config&add_address=1', function(res) {
					$('.total_address').append(res);
					
				});
		
		});
	
	
		$("[name='title']").change(function(){
			nv_get_alias();
		});
		
	});
		
</script>
<!-- END: main -->