<!-- BEGIN: main -->
<ul>
	<!-- BEGIN: guest -->
	<li class="text-center">
		<a href="{LOGIN_URL}" class="btn btn-primary"><em class="fa fa-sign-out">&nbsp;</em>Đăng nhập</a>
		<a href="javascript:void(0)" class="btn btn-primary" id="recruitment_register" data-objmember="{LANG.objmemeber}"><em class="fa fa-user-plus">&nbsp;</em>Đăng ký</a>
		<div id="register_content" style="display: none">
			<blockquote>Hệ thống cần xác định Bạn là ai? Vui lòng chọn đúng đối tượng. Căn cứ vào việc lựa chọn tại đây để xác định các thông tin khác.</blockquote>
			<div class="text-center">
				<a href="{JOBPROVIDER_URL}" class="btn btn-primary" title="Nhà tuyển dụng">Nhà tuyển dụng</a>
				<a href="{JOBSEEKER_URL}" class="btn btn-primary" title="Người xin việc">Người xin việc</a>
			</div>
		</div>
	</li>
	<!-- END: guest -->

	<!-- BEGIN: user -->
	<!-- BEGIN: jobprovider -->
	<li><em class="fa fa-language">&nbsp;</em><a href="{JOBPROVIDER_INFO_URL}">Thông tin công ty</a></li>
	<li><em class="fa fa-refresh">&nbsp;</em><a href="{JOBPROVIDER_URL}">Cập nhật công ty</a></li>
	<li><em class="fa fa-bars">&nbsp;</em><a href="{LIST_NEWS_URL}">Danh sách tin đăng</a></li>
	<li><em class="fa fa-sign-out">&nbsp;</em><a href="{NEW_NEWS_URL}">Đăng tin tuyển dụng</a></li>
	<!-- END: jobprovider -->

	<!-- BEGIN: jobseeker -->
	<li><em class="fa fa-language">&nbsp;</em><a href="{JOBSEEKER_URL}">Thông tin ứng viên</a></li>
	<li><em class="fa fa-bars">&nbsp;</em><a href="{RECORD_URL}">Danh sách hồ sơ</a></li>
	<li><em class="fa fa-sign-out">&nbsp;</em><a href="{RECORD_ADD_URL}">Tạo hồ sơ mới</a></li>
	<li><em class="fa fa-floppy-o">&nbsp;</em><a href="{POST_SAVED_URL}">Việc làm đã lưu</a></li>
	<!-- END: jobseeker -->
	<!-- END: user -->
</ul>
<!-- END: main -->