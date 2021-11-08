/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Fri, 19 Jun 2015 07:33:37 GMT
 */

$(function () {
	$('#upload_fileupload').change(function(){
	     $('#file_name').val($(this).val().match(/[-_\w]+[.][\w]+$/i)[0]);
	});
});

function nv_alert_success( str )
{
	toastr.options = {
  		"closeButton": true,
  		"positionClass": "toast-bottom-right",
  	};
	toastr.success( str );
}

function nv_main_add_highlights( $_this )
{
	$.get( $_this.attr('href'), function(res){
		modalShow( '[' + $_this.data('code') + '] ' + $_this.data('title'), res );
	});
	return false;
}

function nv_list_post_action( action, url_action, checkss, del_confirm_no_post )
{
	var listall = [];
	$('input.post:checked').each(function() {
		listall.push($(this).val());
	});

	if (listall.length < 1) {
		alert( del_confirm_no_post );
		return false;
	}

	if( action == 'delete_list_id' )
	{
		if (confirm(nv_is_del_confirm[0])) {
			$.ajax({
				type : 'POST',
				url : url_action,
				data : 'delete_list=1&listall=' + listall,
				success : function(data) {
					var r_split = data.split('_');
					if( r_split[0] == 'OK' ){
						window.location.href = window.location.href;
					}
					else{
						alert( nv_is_del_confirm[2] );
					}
				}
			});
		}
	}
	else if( action == 'accept' )
	{
		if (confirm(nv_is_del_confirm[0])) {
			$.ajax({
				type : 'POST',
				url : script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=approved',
				data : 'accept_list=1&listall=' + listall,
				success : function(data) {
					var r_split = data.split('_');
					if( r_split[0] == 'OK' ){
						window.location.href = window.location.href;
					}
					else{
						alert( nv_is_del_confirm[2] );
					}
				}
			});
		}
	}
	else if( action == 'addgroups' ){
		window.location.href = script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=block&listid=' + listall + '&checkss=' + checkss;
	}

	return false;
}

function nv_open_file( $_this )
{
	var area = $_this.data('area');
	var path = $_this.data('path');
	var currentpath = $_this.data('currentpath');
	var type = $_this.data('type');
	nv_open_browse( script_name + '?' + nv_name_variable + "=upload&popup=1&area=" + area + "&path=" + path + "&currentpath="+currentpath+"&type=" + type, "NVImg", 850, 500, "resizable=no,scrollbars=no,toolbar=no,location=no,status=no");
	return false;
}

function nv_del_block_cat(bid) {
	if (confirm(nv_is_del_confirm[0])) {
		$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=groups&nocache=' + new Date().getTime(), 'del_block_cat=1&bid=' + bid, function(res) {
			var r_split = res.split('_');
			if (r_split[0] == 'OK') {
				nv_show_list_block_cat();
			} else if (r_split[0] == 'ERR') {
				alert(r_split[1]);
			} else {
				alert(nv_is_del_confirm[2]);
			}
		});
	}
	return false;
}

function nv_chang_block_cat(bid, mod) {
	var nv_timer = nv_settimeout_disable('id_' + mod + '_' + bid, 5000);
	var new_vid = $('#id_' + mod + '_' + bid).val();
	$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=chang_block_cat&nocache=' + new Date().getTime(), 'bid=' + bid + '&mod=' + mod + '&new_vid=' + new_vid, function(res) {
		var r_split = res.split('_');
		if (r_split[0] != 'OK') {
			alert(nv_is_change_act_confirm[2]);
		}
		clearTimeout(nv_timer);
		nv_show_list_block_cat();
	});
	return;
}

function nv_show_list_block_cat() {
	if (document.getElementById('module_show_list')) {
		$('#module_show_list').load(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=list_block_cat&nocache=' + new Date().getTime());
	}
	return;
}

function nv_chang_block(bid, id, mod) {
	if (mod == 'delete' && !confirm(nv_is_del_confirm[0])) {
		return false;
	}
	var nv_timer = nv_settimeout_disable('id_weight_' + id, 5000);
	var new_vid = $('#id_weight_' + id).val();
	$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=change_block&nocache=' + new Date().getTime(), 'id=' + id + '&bid=' + bid + '&mod=' + mod + '&new_vid=' + new_vid, function(res) {
		nv_chang_block_result(res);
	});
	return;
}

function nv_chang_block_result(res) {
	var r_split = res.split('_');
	if (r_split[0] != 'OK') {
		alert(nv_is_change_act_confirm[2]);
	}
	var bid = parseInt(r_split[1]);
	nv_show_list_block(bid);
	return;
}

function nv_show_list_block(bid) {
	if (document.getElementById('module_show_list')) {
		$('#module_show_list').load(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=list_block&bid=' + bid + '&nocache=' + new Date().getTime());
	}
	return;
}

function nv_del_block_list(oForm, bid, del_confirm_no_post) {
	var del_list = '';
	var fa = oForm['idcheck[]'];
	if (fa.length) {
		for (var i = 0; i < fa.length; i++) {
			if (fa[i].checked) {
				del_list = del_list + ',' + fa[i].value;
			}
		}
	} else {
		if (fa.checked) {
			del_list = del_list + ',' + fa.value;
		}
	}

	if (del_list != '') {
		if (confirm(nv_is_del_confirm[0])) {
			$.post(script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=change_block&nocache=' + new Date().getTime(), 'del_list=' + del_list + '&bid=' + bid, function(res) {
				nv_chang_block_result(res);
			});
		}
	}
	else{
		alert(del_confirm_no_post);
	}
}