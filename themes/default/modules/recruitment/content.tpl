<!-- BEGIN: main -->
<link rel="stylesheet" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.css">
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/ui/jquery.ui.core.css" rel="stylesheet" />
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/ui/jquery.ui.theme.css" rel="stylesheet" />
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/ui/jquery.ui.menu.css" rel="stylesheet" />
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/ui/jquery.ui.autocomplete.css" rel="stylesheet" />


<!-- BEGIN: error -->
<div class="alert alert-warning">
	{ERROR}
</div>
<!-- END: error -->

<div class="panel panel-default">
	<div class="panel-body">
		<form class="form-horizontal" action="{NV_BASE_SITEURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}/{ROW.id}" method="post">
			<input type="hidden" name="id" value="{ROW.id}" />
			<div class="form-group">
				<label class="col-xs-24 col-md-5 control-label"><strong>{LANG.title}</strong> <span class="red">*</span></label>
				<div class="col-xs-24 col-md-19">
					<input class="form-control" type="text" name="title" value="{ROW.title}" required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-24 col-md-5 control-label"><strong>{LANG.position_id}</strong> <span class="red">*</span></label>
				<div class="col-xs-24 col-md-19">
					<!-- BEGIN: radio_position_id -->
					<label class="none_weight"><input class="form-control" type="radio" name="position_id" value="{OPTION.key}" {OPTION.checked} >{OPTION.title} &nbsp;</label>
					<!-- END: radio_position_id -->
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-24 col-md-5 control-label"><strong>{LANG.jobs}</strong> <span class="red">*</span></label>
				<div class="col-xs-24 col-md-19">
					<select multiple="multiple" class="form-control" name="jobs_id[]">
						<!-- BEGIN: select_jobs -->
						<option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
						<!-- END: select_jobs -->
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-24 col-md-5 control-label"><strong>{LANG.worktype_id}</strong> <span class="red">*</span></label>
				<div class="col-xs-24 col-md-19">
					<select class="form-control" name="worktype_id">
						<option value=""> ---{LANG.worktype_id_c}--- </option>
						<!-- BEGIN: select_worktype_id -->
						<option value="{OPTION.key}" {OPTION.selected}>{OPTION.title}</option>
						<!-- END: select_worktype_id -->
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
						<label class="col-xs-24 col-sm-5 control-label"><strong>{LANG.address}</strong></label>
						<div class="col-xs-24 col-sm-19">
							<input class="form-control" type="text" name="address" value="{ROW.address}" />
						</div>
					</div>
					
			<div class="form-group">
				<label class="col-xs-24 col-md-5 control-label"><strong>{LANG.salary}</strong></label>
				<div class="col-xs-24 col-md-7">
					<input class="form-control" type="text" name="salary_from" value="{ROW.salary_from}" placeholder="{LANG.salary_from}" />
				</div>
				<div class="col-xs-24 col-md-7">
					<input class="form-control" type="text" name="salary_to" value="{ROW.salary_to}" placeholder="{LANG.salary_to}" />
				</div>
				<div class="col-xs-24 col-md-5">
					<select class="form-control" name="money_units">
								<!-- BEGIN: money_units -->
								<option value="{MONEY_UNITS.id}" {MONEY_UNITS.selected}>{MONEY_UNITS.title}</option>
								<!-- END: money_units -->
							</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-24 col-md-5">&nbsp;</label>
				<div class="col-xs-24 col-md-19">
					<em class="help-block">{LANG.salary_note}</em>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-24 col-md-5 control-label"><strong>{LANG.experience}</strong></label>
				<div class="col-xs-24 col-md-19">
					<input class="form-control" type="number" min="1" name="experience" value="{ROW.experience}" />
					<em class="help-block">{LANG.experience_note}</em>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-24 col-md-5 control-label"><strong>{LANG.degree}</strong></label>
				<div class="col-xs-24 col-md-19">
					<textarea class="form-control" style="height:100px;" cols="75" rows="5" name="degree">{ROW.degree}</textarea>
					<em class="help-block">{LANG.degree_note}</em>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-24 col-md-5 control-label"><strong>{LANG.gender_k}</strong></label>
				<div class="col-xs-24 col-md-19">
					<!-- BEGIN: radio_gender -->
					<label class="none_weight"><input class="form-control" type="radio" name="gender" value="{OPTION.key}" {OPTION.checked}>{OPTION.title} &nbsp;</label>
					<!-- END: radio_gender -->
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-24 col-md-5 control-label"><strong>{LANG.age}</strong></label>
				<div class="col-xs-24 col-md-19">
					<input class="form-control" type="text" name="age" value="{ROW.age}" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-24 col-md-5 control-label"><strong>{LANG.quantity}</strong></label>
				<div class="col-xs-24 col-md-19">
					<input class="form-control" type="text" name="quantity" value="{ROW.quantity}" pattern="^[0-9]*$"  oninvalid="setCustomValidity( nv_digits )" oninput="setCustomValidity('')" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-24 col-md-5 control-label"><strong>{LANG.job_description}</strong> <span class="red">*</span></label>
				<div class="col-xs-24 col-md-19">
					{ROW.job_description}
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-24 col-md-5 control-label"><strong>{LANG.more_requirement}</strong></label>
				<div class="col-xs-24 col-md-19">
					<textarea class="form-control" style="height:100px;" cols="75" rows="5" name="more_requirement">{ROW.more_requirement}</textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-24 col-md-5 control-label"><strong>{LANG.interest}</strong></label>
				<div class="col-xs-24 col-md-19">
					<textarea class="form-control" style="height:100px;" cols="75" rows="5" name="interests">{ROW.interests}</textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-24 col-md-5 control-label"><strong>{LANG.document}</strong></label>
				<div class="col-xs-24 col-md-19">
					<!-- BEGIN: checkbox_document_id -->
					<label class="show none_weight"><input class="form-control" type="checkbox" name="document_id[]" value="{OPTION.key}" {OPTION.checked}>{OPTION.title}</label>
					<!-- END: checkbox_document_id -->
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-24 col-md-5 control-label"><strong>{LANG.document_exp}</strong></label>
				<div class="col-xs-24 col-md-19">
					<div class="input-group">
						<input type="text" class="form-control" id="document_exp" name="document_exp" value="{ROW.document_exp}" readonly="readonly">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button" id="document_exp-btn"> <em class="fa fa-calendar fa-fix">&nbsp;</em></button>
						</span>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-24 col-md-5 control-label"><strong>{LANG.document_type_id}</strong></label>
				<div class="col-xs-24 col-md-19">
					<!-- BEGIN: radio_document_type_id -->
					<label class="show none_weight"><input class="form-control" type="checkbox" name="document_type_id[]" value="{OPTION.key}" {OPTION.checked}>{OPTION.title} &nbsp;</label>
					<!-- END: radio_document_type_id -->
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-24 col-md-5 control-label">&nbsp;</label>
				<div class="col-xs-24 col-md-19"><strong class="text-danger">{LANG.contact_info}</strong></div>
			</div>
			<div class="form-group">
				<label class="col-xs-24 col-md-5 control-label"><strong>{LANG.fullname}</strong></label>
				<div class="col-xs-24 col-md-19">
					<input type="text" class="form-control" name="contact_fullname" value="{ROW.contact_fullname}" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-24 col-md-5 control-label"><strong>{LANG.email}</strong></label>
				<div class="col-xs-24 col-md-19">
					<input type="email" class="form-control" name="contact_email" value="{ROW.contact_email}" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-xs-24 col-md-5 control-label"><strong>{LANG.phone}</strong></label>
				<div class="col-xs-24 col-md-19">
					<input type="text" class="form-control" name="contact_phone" value="{ROW.contact_phone}" />
				</div>
			</div>
			<div class="form-group" style="text-align: center"><input class="btn btn-primary" name="submit" type="submit" value="{LANG.save}" />
			</div>
		</form>
	</div>
</div>

<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/ui/jquery.ui.core.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/ui/jquery.ui.menu.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/ui/jquery.ui.autocomplete.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/ui/jquery.ui.datepicker.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/language/jquery.ui.datepicker-{NV_LANG_INTERFACE}.js"></script>
<link rel="stylesheet" type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/jquery-ui/jquery-ui.min.css?t=21">
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
		
		
			$('.button_add_address').click(function(){
			
			$.post(nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=config&add_address=1', function(res) {
					$('.total_address').append(res);
					
				});
		
		});
	
		
		$("select").select2();

	//<![CDATA[
	$(document).ready(function() {
		$("#document_exp").datepicker({
			dateFormat : "dd/mm/yy",
			changeMonth : true,
			changeYear : true,
			showOtherMonths : true,
			showOn : 'focus'
		});
	});

	//]]>
</script>
<!-- END: main -->