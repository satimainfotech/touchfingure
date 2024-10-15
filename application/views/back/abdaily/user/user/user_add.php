<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('user_add');?></h1>
		<?php
			if(@$category != '' || @$sub_category != '' || @$product_name != ''){
		?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/product?c_i=<?php echo @$category; ?>&s_c_i=<?php echo @$sub_category; ?>&p_n=<?php echo @$product_name; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>"><?php echo translate('back');?> </a>
			<input type="hidden" value="<?php echo base_url(); ?>admin/product?c_i=<?php echo @$category; ?>&s_c_i=<?php echo @$sub_category; ?>&p_n=<?php echo @$product_name; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" id="return_url">
		<?php }else{ ?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/product<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>"><?php echo translate('back');?> </a>
			<input type="hidden" value="<?php echo base_url(); ?>admin/abdaily/user<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>" id="return_url">
		<?php } 
		?>
		 
	</div>
        <div class="tab-base">
            <div class="panel">
                <div class="panel-body">
                    <div class="tab-content">
                    <div class="tab-pane fade active in">
						<?php
							echo form_open(base_url() . 'admin/abdaily/user/user_added/', array(
								'class' => 'form-horizontal',
								'method' => 'post',
								'id' => 'product_add',
								'enctype' => 'multipart/form-data'
							));
						?>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 customtabcontentview">
								<div class="panel-body">
									<div class="tab-base">
										<div class="tab-content">
											<div id="product_details" class="tab-pane fade active in">											
												<div class="col-sm-6 col-md-6 col-xs-12 paddingzeroall">
													<label class="col-sm-12 control-label text-left" for="demo-hor-2"><?php echo translate('gender');?></label>
													<div class="col-sm-12">
														<select id="gender" name="gender" placeholder="Select a Gender" class="demo-chosen-select required" >
															<option value="">Select Gender</option>
															<option value="male"><?php echo ucfirst('male'); ?></option>
															<option value="female"><?php echo ucfirst('female'); ?></option>
														</select>
													</div>
												</div>
											<div class="col-sm-6 col-md-6 col-xs-12 paddingzeroall">
												<label class="col-sm-12 control-label text-left" for="demo-hor-2"><?php echo translate('member_type');?></label>
												<div class="col-sm-12">
													<select id="member_type_id" onchange="display_member(this.value);" name="member_type_id" placeholder="Select a member type" class="form-control demo-chosen-select required" >
													<option value="">Select a member type</option>
													<?php foreach($member_type_data as $member_type_row) { ?>
													<option value="<?php echo $member_type_row['member_type_id']; ?>"  data-fees="<?php echo $member_type_row['fees']; ?>"><?php echo $member_type_row['member_type_name']; ?></option>
													<?php } ?>
													</select>
												</div>
											</div>
												
												<div class="col-sm-6 col-md-6 col-xs-12 paddingzeroall 1">
																<label class="col-sm-12 control-label text-left" for="demo-hor-2"><?php echo translate('country');?></label>
																<div class="col-sm-12">
																	<select onchange="get_state(this.value);" id="country" name="country" placeholder="Select a country" class="form-control demo-chosen-select required" readonly >
																		<option value="">Select a Country</option>
																		<?php  foreach($country_data as $country_row) { ?>
																		<option value="<?php echo $country_row['country_id']; ?>" selected><?php echo $country_row['country_name']; ?></option>
																		<?php } ?>
																	</select>
																</div>
												</div>
												<div class="col-sm-6 col-md-6 col-xs-12 paddingzeroall 2" >
													<label class="col-sm-12 control-label text-left" for="demo-hor-2"><?php echo translate('State');?></label>
													<div class="col-sm-12">
														<select id="state" onchange="get_division(this.value); " name="state" placeholder="Select a state" class="form-control demo-chosen-select required" readonly>
														<option value="">Select State</option>
														</select>
													</div>
												</div>
												
												
												<div class="col-sm-6 col-md-6 col-xs-12 paddingzeroall" style="display:none;">
													<label class="col-sm-12 control-label text-left" for="demo-hor-2"><?php echo translate('Division');?></label>
													<div class="col-sm-12">
														<select id="division" name="division" onchange="get_district(this.value); get_district_m(this.value);" placeholder="Select a division" class="form-control demo-chosen-select " >
														<option value="">Select Division</option>
														</select>
													</div>
												</div>
												
												
												<div class="col-sm-6 col-md-6 col-xs-12 paddingzeroall district 4" >
													<label class="col-sm-12 control-label text-left" for="demo-hor-2"><?php echo translate('District');?></label>
													<div class="col-sm-12">
														<select id="district" name="district" onchange="get_taluka(this.value);" placeholder="Select a district" class="form-control demo-chosen-select " >
															<option value="">Select District</option>
														</select>
													</div>
												</div>
												
												<div class="col-sm-6 col-md-6 col-xs-12 paddingzeroall district_m 5" >
													<label class="col-sm-12 control-label text-left" for="demo-hor-2"><?php echo translate('District-M');?></label>
													<div class="col-sm-12">
														<select id="district_m" name="district_m" onchange="get_taluka_m(this.value);" placeholder="Select a district" class="form-control demo-chosen-select " >
														<option value="">Select District-M</option>

														</select>
													</div>
												</div>
												 
												<div class="col-sm-6 col-md-6 col-xs-12 paddingzeroall taluka 6" >
												<label class="col-sm-12 control-label text-left" for="demo-hor-2"><?php echo translate('Taluka');?></label>
													<div class="col-sm-12">
														<select id="taluka" name="taluka" onchange="get_gram_panchayat(this.value);" placeholder="Select a taluka" class="form-control demo-chosen-select " >
														<option value="">Select Taluka</option>
														</select>
													</div>
												</div>

													<div class="col-sm-6 col-md-6 col-xs-12 paddingzeroall taluka_m 7" >
														<label class="col-sm-12 control-label text-left" for="demo-hor-2"><?php echo translate('Taluka-M');?></label>
														<div class="col-sm-12">
														<select id="taluka_m" name="taluka_m" onchange="get_gram_panchayat(this.value);" placeholder="Select a taluka" class="form-control demo-chosen-select " >
															<option value="">Select Taluka-M</option>
														</select>
													</div>
												</div>
												
												
												<div class="col-sm-6 col-md-6 col-xs-12 paddingzeroall gram_panchayat 8" >
													<label class="col-sm-12 control-label text-left" for="demo-hor-2"><?php echo translate('Gram Panchayat');?></label>
													<div class="col-sm-12">
													<select id="gram_panchayat" name="gram_panchayat" placeholder="Select a gram panchayat" class="form-control demo-chosen-select " >
														<option value="">Select Gram Panchayat</option>
													</select>
												</div>
												</div>
												
												<div class="col-sm-6 col-md-6 col-xs-12 paddingzeroall area 9" >
													<label class="col-sm-12 control-label text-left" for="demo-hor-2"><?php echo translate('Area');?></label>
													<div class="col-sm-12">
														<select id="area" name="area" placeholder="Select a area" class="form-control demo-chosen-select " >
														<option value="">Select Area</option>
														</select>
													</div>
												</div>
												
												<div class="col-sm-6 col-md-6 col-xs-12 paddingzeroall">
													<div class="form-group">
														<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('mobile');?></label>
														<div class="col-sm-12">
															<input type="text" name="mobile" id="mobile" placeholder="<?php echo translate('mobile');?>" class="form-control required">
														</div>
													</div>
												</div>
												
												<div class="col-sm-6 col-md-6 col-xs-12 paddingzeroall">
													<div class="form-group">
														<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('name');?></label>
														<div class="col-sm-12">
															<input type="text" name="name" id="demo-hor-1" placeholder="<?php echo translate('name');?>" class="form-control required">
														</div>
													</div>
												</div>
												
												
												<div class="col-sm-6 col-md-6 col-xs-12 paddingzeroall">
													<div class="form-group">
														<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('email');?></label>
														<div class="col-sm-12">
															<input type="text" name="email" id="email" placeholder="<?php echo translate('email');?>" class="form-control required">
														</div>
													</div>
												</div>	

												<div class="col-sm-6 col-md-6 col-xs-12 paddingzeroall" >
												<label class="col-sm-12 control-label text-left" for="demo-hor-2"><?php echo translate('Blood Group');?></label>
													<div class="col-sm-12">
														<select id="gender" name="blood_group" placeholder="Select a Blood Group" class="form-control demo-chosen-select required" required>
															<option value="">Select Blood Group</option>
															<?php foreach($blood_data as $blood_row) { ?>
															<option value="<?php echo $blood_row['blood_id']; ?>" ><?php echo $blood_row['blood_name']; ?></option>
															<?php } ?>
														</select>
													</div>
												</div>
												
												<div class="col-sm-6 col-md-6 col-xs-12 paddingzeroall">													
													<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('adhar_card');?></label>
															<div class="col-sm-12">
																<input type="text" name="adharcard" id="adharcard" placeholder="<?php echo translate('adhar_card');?>" class="form-control required">
															</div>
													</div>	

												<div class="col-sm-6 col-md-6 col-xs-12 paddingzeroall">													
													<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('pan_card');?></label>
															<div class="col-sm-12">
																<input type="text" name="pancard" id="pancard" placeholder="<?php echo translate('pan_card');?>" class="form-control required">
															</div>
												</div>	

												<div class="col-sm-6 col-md-6 col-xs-12 paddingzeroall">													
													<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('police_station_name');?></label>
															<div class="col-sm-12">
																<input type="text" name="police_station_name" id="police_station_name" placeholder="<?php echo translate('police_station_name');?>" class="form-control required">
															</div>
												</div>													

												
													
													<div class="col-sm-6 col-md-6 col-xs-12 paddingleftzero">
													
													<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('address');?></label>
														<div class="col-sm-12">
														<textarea rows="5" class=" form-control required" data-height="100" name="address" placeholder="address" ></textarea>

														</div>
													</div>
													
													</div>
												</div>
												
												</div>
												
											
												<div class="col-sm-12 col-md-12 col-xs-12 paddingleftzero">
												<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('Documents Images');?></label>
												<hr>
												</div>
											
												<div class="col-sm-12 col-xs-12 paddingallzero">
													<div class="form-group">
														<div class="col-sm-4 col-xs-12 paddingzeroall">
															<label class="col-sm-12 control-label text-left" for="demo-hor-12"><?php echo translate('profile_image');?></label>
															<div class="col-sm-12">
															<span class="pull-left btn btn-default btn-file"> <?php echo translate('choose_file');?>
																<input type="file" name="profile_main_images" accept="image" id="profile_main_images" class="form-control">
																</span>
																<br><br>
																<span style="width: 50%;float:left; border:1px solid #ddd;border-radius:5px; padding:5px;margin-top:10px;" id="pofile_main_images_wrap">
																	<img src="<?php echo base_url(); ?>uploads/other_images/default.png" width="100%" id="profile_main_images_blah" />
																</span>
															</div>
														</div>	
														<div class="col-sm-4 col-xs-12 paddingzeroall">
															<label class="col-sm-12 control-label text-left" for="demo-hor-12"><?php echo translate('adharcard_image');?></label>
															<div class="col-sm-12">
															<span class="pull-left btn btn-default btn-file"> <?php echo translate('choose_file');?>
																<input type="file" name="adharcard_main_images" accept="image" id="adharcard_main_images" class="form-control">
																</span>
																<br><br>
																<span style="width: 50%;float:left; border:1px solid #ddd;border-radius:5px; padding:5px;margin-top:10px;" id="adharcard_main_images_wrap">
																	<img src="<?php echo base_url(); ?>uploads/other_images/default.png" width="100%" id="adharcard_main_images_blah" />
																</span>
															</div>
														</div>	
															<div class="col-sm-4 col-xs-12 paddingzeroall">
															<label class="col-sm-12 control-label text-left" for="demo-hor-12"><?php echo translate('pancard_image');?></label>
															<div class="col-sm-12">
															<span class="pull-left btn btn-default btn-file"> <?php echo translate('choose_file');?>
																<input type="file" name="pancard_main_images" accept="image" id="pancard_main_images" class="form-control">
																</span>
																<br><br>
																<span style="width: 50%;float:left; border:1px solid #ddd;border-radius:5px; padding:5px;margin-top:10px;" id="pancard_main_images_wrap">
																	<img src="<?php echo base_url(); ?>uploads/other_images/default.png" width="100%" id="pancard_main_images_blah" />
																</span>
															</div>
														</div>															
													</div>
												</div>
											</div>
										</div>
									
							<div class="panel-footer">
								<div class="row">
									<div class="col-md-12 paddingzeroall">
										<span class="btn btn-purple btn-labeled fa fa-refresh pro_list_btn pull-left " onclick="form_reset(); "><?php echo translate('reset');?>
										</span>
										<span class="btn btn-success btn-md btn-labeled fa fa-upload pull-left enterer" onclick="product_submit('product_add','<?php echo translate('user_has_been_added!'); ?>');" ><?php echo translate('Submit');?></span>
									</div>
								</div>
							</div>
						</form>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>    
<input type="text" id="base_url" value="<?php echo base_url(); ?>admin/abdaily">
<script>
	$(function () {
		$('.textarea').wysihtml5();
	})
</script>
<script>
		get_state(1);
	get_division(1);
	get_district(1);
	get_district_m(1);
	
	function profile_main_images(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#profile_main_images_blah').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#profile_main_images").change(function() {
		profile_main_images(this);
	});
	
	function adharcard_main_images(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#adharcard_main_images_blah').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#adharcard_main_images").change(function() {
		adharcard_main_images(this);
	});
	
	
	function pancard_main_images(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#pancard_main_images_blah').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#pancard_main_images").change(function() {
		pancard_main_images(this);
	});
		
	
    function set_select(){
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width:'100%'});
    }
	
    $(document).ready(function() {
        set_select();
	});
	
	function display_member(id) {
    // Loop through numbers 1 to 6
    for (let i = 1; i <= 9; i++) {
        // Check if the current number is less than the provided id
        if (i <= id) {
            // Show the element with the class of the current number
            $("." + i).show();
        } else {
            // Hide the element with the class of the current number
            $("." + i).hide();
        }
    }
    
      var selectedOption = $("#member_type_id option:selected");

    // Retrieve the data-fees attribute from the selected option
    var dataFees = selectedOption.data('fees');
    
    // Alert the data-fees value
    
	
	$("#fees_label").html("Rs."+dataFees);
	$("#fees").val(dataFees);
    
    if(id == 4)
    { 
		 $(".district").show();
			get_state(1);
		  get_district(1);
	}
	else if(id == 5)
	{
		$(".district").hide();
		$(".district_m").show();
		get_state(1);
		get_district_m(1);
	}
	
	else if(id == 6)
	{
		$(".district").show();
		$(".taluka").show();
		$(".district_m").hide();
		get_state(1);	
		get_district(1);
	}
	
	else if(id == 7)
	{		
		$(".district").show();
		$(".taluka_m").show();
		$(".taluka").hide();
		$(".district_m").hide();
		get_state(1);
		get_district(1);
	}
	else if(id == 8)
	{		
		$(".district").show();
		$(".taluka").show();
		$(".gram_panchayat").show();
		$(".taluka_m").hide();	
		$(".district_m").hide();
		$(".area").hide();
		get_state(1);
	}
	else if(id == 9)
	{	
		$(".district").show();
		$(".taluka_m").show();	
		$(".area").show();
		$(".taluka").hide();		
		$(".district_m").hide();
		$(".taluka").hide();
		$(".gram_panchayat").hide();
		get_state(1);
	}	
	
}
	
	function get_state(country){
		
		var base_url = $('#base_url').val();
	
			$.ajax({
				url : base_url+'abdaily/user/get_state',
				type: 'POST',
				dataType: 'html',
				data: {country:country},
				success: function(data){
					
					if(data != ''){
						$('#state').html(data);
						$('#state').trigger("chosen:updated");
					}
				}
			});
		}
		
		function get_division(state){
		var base_url = $('#base_url').val();		
			$.ajax({
				url : base_url+'abdaily/user/get_division',
				type: 'POST',
				dataType: 'html',
				data: {state:state},
				success: function(data){
					
					if(data != ''){
						$('#division').html(data);
						$('#division').trigger("chosen:updated");
					}
				}
			});
		}
		
		function get_district(division){
		var base_url = $('#base_url').val();		
			$.ajax({
				url : base_url+'abdaily/user/get_district',
				type: 'POST',
				dataType: 'html',
				data: {division:division},
				success: function(data){
					
					if(data != ''){
						$('#district').html(data);
						$('#district').trigger("chosen:updated");
						//get_taluka(district);
						
						
					}
				}
			});
		}
		
		function get_district_m(division){
		var base_url = $('#base_url').val();		
			$.ajax({
				url : base_url+'abdaily/user/get_district_m',
				type: 'POST',
				dataType: 'html',
				data: {division:division},
				success: function(data){
					
					if(data != ''){
						
						$('#district_m').html(data);
						$('#district_m').trigger("chosen:updated");
					}
				}
			});
		}
		function get_taluka(district){
				var base_url = $('#base_url').val();	
				var member_type_id =  $("#member_type_id").val();

				if(member_type_id == 7 || member_type_id == 9 )
				{
					var url = base_url+'abdaily/user/get_taluka_m';
				}
				else
				{
					var url = base_url+'abdaily/user/get_taluka';
				}


				var base_url = $('#base_url').val();	
				$.ajax({
					url : url,
					type: 'POST',
					dataType: 'html',
					data: {district:district},
					success: function(data){					
						if(data != ''){
						if(member_type_id == 7 || member_type_id == 9){
							$('#taluka_m').html(data);
							$('#taluka_m').trigger("chosen:updated");
						} else {
							$('#taluka').html(data);
							$('#taluka').trigger("chosen:updated");
						}						
						}
					},
					error: function(xhr, status, error) {
					console.error("AJAX Error: " + status + " - " + error);
					}
				});		
			
		}
		
		
		
		
		function get_taluka_m(district_m){
			
		var base_url = $('#base_url').val();		
			$.ajax({
				url : base_url+'abdaily/user/get_taluka_m',
				type: 'POST',
				dataType: 'html',
				data: {district_m:district_m},
				success: function(data){
					
					if(data != ''){
						$('#taluka_m').html(data);
						$('#taluka_m').trigger("chosen:updated");	

					}
				}
			});
		}
		
		
		function get_gram_panchayat(taluka){
			var base_url = $('#base_url').val();	
			var member_type_id =  $("#member_type_id").val();
			if(member_type_id == 9 )
			{
				var url = base_url+'abdaily/user/get_area';
			}
			else
			{
				var url = base_url+'abdaily/user/get_gram_panchayat';
			}
			
		var base_url = $('#base_url').val();		
			$.ajax({
				url :url,
				type: 'POST',
				dataType: 'html',
				data: {taluka:taluka},
				success: function(data){
					
					if(data != ''){
						if(member_type_id == 9 )
						{
							$('#area').html(data);
							$('#area').trigger("chosen:updated");	
						}
						else
						{
							$('#gram_panchayat').html(data);
							$('#gram_panchayat').trigger("chosen:updated");	
						}
					}
				}
			});
		}
	

</script>

<style>
	.btm_border{
		border-bottom: 1px solid #ebebeb;
		padding-bottom: 15px;	
	}
</style>