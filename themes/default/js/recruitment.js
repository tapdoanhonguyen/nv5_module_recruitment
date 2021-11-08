/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2015 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Fri, 19 Jun 2015 07:33:37 GMT
 */

$(function () {
	$('#recruitment_register').click(function(){
		$("#sitemodal").find(".modal-title").html( $(this).data( 'objmember' ) );
		$("#sitemodal").find(".modal-body").html( $('#register_content').html() );
		$("#sitemodal").modal();
	});

	$('#upload_fileupload').change(function(){
	     $('#file_name').val($(this).val().match(/[-_\w]+[.][\w]+$/i)[0]);
	});
});

function nv_get_post_new()
{
	$.post(nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=ajax&nocache=' + new Date().getTime(), 'post_new=1&id_list=post_new', function(res) {
		$('#post_new').html(res);
	});

	$.post(nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=ajax&nocache=' + new Date().getTime(), 'post_new=1&order_field=viewcount&id_list=most_view', function(res) {
		$('#most_view').html(res);
	});
}

function nv_get_post_new_condition()
{
	var jobs_id = $('#jobs').val();
	var per_page = $('#per_page').val();
	$('#ajax_loader').show();
	$.post(nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=ajax&nocache=' + new Date().getTime(), 'post_new=1&display=1&jobs_id=' + jobs_id + '&per_page=' + per_page, function(res) {
		$('#list-post').html(res);
		setTimeout(function(){
			$('#ajax_loader').hide();
		}, 500);
	});
}

function nv_get_post_hot_condition()
{
	var jobs_id = $('#jobs').val();
	var per_page = $('#per_page').val();
	$('#ajax_loader').show();
	$.post(nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=ajax&nocache=' + new Date().getTime(), 'post_hot=1&display=1&jobs_id=' + jobs_id + '&per_page=' + per_page, function(res) {
		$('#list-post').html(res);
		setTimeout(function(){
			$('#ajax_loader').hide();
		}, 500);
	});
}

function nv_delete_rows( rows_id )
{
	if (confirm(nv_is_del_confirm[0])) {
		$.post(nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=main&nocache=' + new Date().getTime(), 'delete_rows=1&rows_id=' + rows_id, function(res) {
			if( res == 'OK' ){
				window.location.href = nv_base_siteurl;
			}
			else{
				alert( nv_is_del_confirm[2] );
			}
		});
	}
}

function nv_save_post( rows_id, flag )
{
	var $_confirm = flag ? cfg.lang_post_save_confirm : cfg.lang_post_drop_saved_confirm;
	if (confirm($_confirm)) {
		$.post(nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=ajax&nocache=' + new Date().getTime(), 'post_save=1&rows_id=' + rows_id + '&flag=' + flag, function(res) {
			if( res == 'OK' ){
				if( flag ){
					$('#post_save').html( '<a href="#" title="'+cfg.lang_post_saved_drop+'" onclick="nv_save_post('+cfg.var_post_id+', 0); return false;"><em class="fa fa-save fa-lg" >&nbsp;</em>'+cfg.lang_post_saved+'</a>' );
					nv_alert_success( cfg.lang_post_save_success );
				}
				else{
					$('#post_save').html( '<a href="#" title="'+cfg.lang_post_save+'" onclick="nv_save_post('+cfg.var_post_id+', 1); return false;"><em class="fa fa-save fa-lg" >&nbsp;</em>'+cfg.lang_post_save+'</a>' );
					nv_alert_success( cfg.lang_post_saved_drop_success );
				}
			}
			else{
				alert( nv_is_del_confirm[2] );
			}
		});
	}
}

function nv_open_print( url )
{
	nv_open_browse( url, '', 800, 500, 'resizable=no,scrollbars=yes,toolbar=no,location=no,status=no');
	return false;
}

function nv_alert_success( str )
{
	toastr.options = {
  		"closeButton": true,
  		"positionClass": "toast-bottom-right",
  	};
	toastr.success( str );
}

function nv_get_record( mod )
{
	if( mod == 'new' ){
		$.post(nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=ajax&nocache=' + new Date().getTime(), 'get_record=1&id_list=record_new', function(res) {
			$('#record_' + mod).html(res);
		});
	}
	else if( mod == 'mostview' ){
		$.post(nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=ajax&nocache=' + new Date().getTime(), 'get_record=1&order_field=viewcount&id_list=record_mostview', function(res) {
			$('#record_' + mod).html(res);
		});
	}
}

function nv_get_record_condition( mod )
{
	var post_str = '';
	var jobs_id = $('#jobs_' + mod).val();
	$('#ajax_loader').show();
	if( mod == 'mostview'){
		post_str = '&order_field=viewcount';
	}

	$.post(nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=ajax&nocache=' + new Date().getTime(), 'get_record=1&jobs_id=' + jobs_id + post_str, function(res) {
		$('#record_' + mod).html(res);
		setTimeout(function(){
			$('#ajax_loader').hide();
		}, 500);
	});
}

function nv_delete_record( rows_id )
{
	if (confirm(nv_is_del_confirm[0])) {
		$.post(nv_base_siteurl + 'index.php?' + nv_lang_variable + '=' + nv_lang_data + '&' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=main&nocache=' + new Date().getTime(), 'delete_record=1&rows_id=' + rows_id, function(res) {
			if( res == 'OK' ){
				window.location.href = nv_base_siteurl;
			}
			else{
				alert( nv_is_del_confirm[2] );
			}
		});
	}
}

function nv_list_post_del( $_this )
{
	if (confirm(nv_is_del_confirm[0])) {
		window.location.href = $_this.attr('href');
	}
}

function nv_list_post_action( action, url_action, del_confirm_no_post )
{
	var listall = [];
	$('input.post:checked').each(function() {
		listall.push($(this).val());
	});

	if (listall.length < 1) {
		alert( del_confirm_no_post );
		return false;
	}

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
	return false;
}
