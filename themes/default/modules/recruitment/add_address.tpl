<!-- BEGIN: main -->

<div class="content_ajax">
<i class="fa fa-times" aria-hidden="true"></i>
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


<script type="text/javascript">
	//<![CDATA[
	
		$('.content_ajax i').click(function(){
			$(this).parent().remove();
		});
		
		
		
		$("select").select2();

</script>		
<!-- END: main -->