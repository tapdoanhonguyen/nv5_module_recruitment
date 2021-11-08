<!-- BEGIN: main -->
<link rel="stylesheet" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.css">
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/ui/jquery.ui.core.css" rel="stylesheet" />
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/ui/jquery.ui.theme.css" rel="stylesheet" />
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/ui/jquery.ui.menu.css" rel="stylesheet" />
<link type="text/css" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/ui/jquery.ui.datepicker.css" rel="stylesheet" />

<!-- BEGIN: error -->
<div class="alert alert-warning">
	{ERROR}
</div>
<!-- END: error -->

<form class="form-horizontal" action="{ACTION}" method="post">
	<div class="panel panel-default">
		<div class="panel-heading">{LANG.jobseeker_info}</div>
		<div class="panel-body">
			<input type="hidden" name="id" value="{ROW.id}" />
			<div class="form-group">
				<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.userid_manage}</strong></label>
				<div class="col-sm-19 col-md-20">
					<select name="userid" id="userid" class="form-control">
						<!-- BEGIN: userid -->
						<option value="{ROW.userid}" selected="selected">{ROW.username}</option>
						<!-- END: userid -->
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.last_name}</strong> <span class="red">(*)</span></label>
				<div class="col-sm-8 col-md-9">
					<input class="form-control" type="text" name="last_name" value="{ROW.last_name}" required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" />
				</div>
				<label class="col-sm-4 col-md-3 control-label"><strong>{LANG.first_name}</strong> <span class="red">(*)</span></label>
				<div class="col-sm-6 col-md-8">
					<input class="form-control" type="text" name="first_name" value="{ROW.first_name}" required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.birthday}</strong> <span class="red">(*)</span></label>
				<div class="col-sm-8 col-md-9">
					<div class="input-group">
						<input class="form-control" type="text" name="birthday" value="{ROW.birthday}" id="birthday" pattern="^[0-9]{2,2}\/[0-9]{2,2}\/[0-9]{1,4}$" required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" />
						<span class="input-group-btn">
							<button class="btn btn-default" type="button" id="birthday-btn">
								<em class="fa fa-calendar fa-fix"> </em>
							</button> </span>
					</div>
				</div>
				<label class="col-sm-4 col-md-3 control-label"><strong>{LANG.marital}</strong> </label>
				<div class="col-sm-6 col-md-8">
					<select class="form-control" name="marital">
						<!-- BEGIN: marital -->
						<option value="{MARITAL.key}" {MARITAL.selected}>{MARITAL.value}</option>
						<!-- END: marital -->
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-4 text-right"><strong>{LANG.gender}</strong> </label>
				<div class="col-sm-19 col-md-20">
					<!-- BEGIN: radio_gender -->
					<label><input class="form-control" type="radio" name="gender" value="{OPTION.key}" {OPTION.checked}required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" >{OPTION.title} &nbsp;</label>
					<!-- END: radio_gender -->
				</div>
			</div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">{LANG.contact_info}</div>
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.email}</strong> <span class="red">(*)</span></label>
				<div class="col-sm-19 col-md-20">
					<input class="form-control" type="text" name="email" value="{ROW.email}" required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.phone}</strong> <span class="red">(*)</span></label>
				<div class="col-sm-19 col-md-20">
					<input class="form-control" type="text" name="phone" value="{ROW.phone}" required="required" oninvalid="setCustomValidity( nv_required )" oninput="setCustomValidity('')" />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.province}</strong> <span class="red">(*)</span></label>
				<div class="col-sm-19 col-md-20">
					{LOCATION}
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 col-md-4 control-label"><strong>{LANG.address}</strong></label>
				<div class="col-sm-19 col-md-20">
					<input class="form-control" type="text" name="address" value="{ROW.address}" />
				</div>
			</div>
		</div>
	</div>
	<div class="text-center">
		<input class="btn btn-primary" name="submit" type="submit" value="{LANG.save}" />
	</div>
</form>

<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/i18n/{NV_LANG_INTERFACE}.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/ui/jquery.ui.core.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/ui/jquery.ui.menu.min.js"></script>


<script type="text/javascript">
	
	$(document).ready(function() {
		$("#userid").select2({
			language: "vi",
			ajax: {
		    url: script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=jobseeker_content&get_user_json=1',
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

	function formatRepo (repo) {console.log(repo);
		if (repo.loading) return repo.text;

		$('input[name=last_name]').val(repo.last_name);
		$('input[name=first_name]').val(repo.first_name);
		$('input[name=birthday]').val(repo.birthday);
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
	//]]>
</script>
<!-- END: main -->