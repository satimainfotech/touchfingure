<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('product_edit');?></h1>
		<?php
			if(@$category != '' || @$sub_category != '' || @$product_name != '' || @$brand != '' || @$our_range != ''){
		?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin//user?c_i=<?php echo @$category; ?>&s_c_i=<?php echo @$sub_category; ?>&b_i=<?php echo @$brand; ?>&or_i=<?php echo @$our_range; ?>&p_n=<?php echo @$product_name; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>"><?php echo translate('back');?> </a>
			<input type="hidden" value="<?php echo base_url(); ?>admin//user?c_i=<?php echo @$category; ?>&s_c_i=<?php echo @$sub_category; ?>&b_i=<?php echo @$brand; ?>&or_i=<?php echo @$our_range; ?>&p_n=<?php echo @$product_name; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" id="return_url">
		<?php }else{ ?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin//user<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>"><?php echo translate('back');?> </a>
			<input type="hidden" value="<?php echo base_url(); ?>admin//user<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>" id="return_url">
		<?php } 
		?>
	</div>
        <div class="tab-base">
            <div class="panel">
                <div class="panel-body">
                    <div class="tab-content">
                    <div class="tab-pane fade active in">
						<?php
							//echo "<pre>"; print_r($product_data); 
							foreach($user_data as $row){	
						?>
						<?php
							echo form_open(base_url() . 'admin//user/user_update/' . $row['id'], array(
								'class' => 'form-horizontal',
								'method' => 'post',
								'id' => 'product_edit',
								'enctype' => 'multipart/form-data'
							));
						?>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 customtabcontentview">
								<div class="panel-body">
									<div class="tab-base">
										<div class="tab-content">
											<div id="product_details" class="tab-pane fade active in">
											
												<div class="col-sm-3 col-md-3 col-xs-12 paddingzeroall">
																<label class="col-sm-12 control-label text-left" for="demo-hor-2"><?php echo translate('member_type');?></label>
																<div class="col-sm-12">
																	<select id="member_type_id" name="member_type_id" placeholder="Select a member type" class="demo-chosen-select required" >
																		<option value="">Select a member type</option>
																		<?php foreach($member_type_data as $member_type_row) { ?>
																			<option <?php if($member_type_row['member_type_id'] == $row['member_type_id']) { ?> selected <?php } ?> value="<?php echo $member_type_row['member_type_id']; ?>"><?php echo $member_type_row['member_type_name']; ?></option>
																		<?php } ?>
																	</select>
																</div>
												</div>
												<div class="col-sm-3 col-md-3 col-xs-12 paddingleftzero">
												
													<div class="form-group">
														<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('name');?></label>
														<div class="col-sm-12">
															<input type="text" name="name" id="demo-hor-1" placeholder="<?php echo translate('name');?>" value="<?php echo $row['name'];?>" class="form-control required">
														</div>
													</div>
												</div>
												
												<div class="col-sm-3 col-md-3 col-xs-12 paddingleftzero">
													<div class="form-group">
														<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('email');?></label>
														<div class="col-sm-12">
															<input type="text" name="email" id="email" placeholder="<?php echo translate('email');?>" value="<?php echo $row['email'];?>" class="form-control required">
														</div>
													</div>
												</div>
												
												<div class="col-sm-3 col-md-3 col-xs-12 paddingleftzero">
													<div class="form-group">
														<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('mobile');?></label>
														<div class="col-sm-12">
															<input type="text" name="mobile" id="mobile" placeholder="<?php echo translate('mobile');?>" value="<?php echo $row['mobile'];?>" class="form-control required">
														</div>
													</div>
												</div>									
												
												<div class="col-sm-6 col-md-6 col-xs-12 paddingleftzero">
													<div class="form-group">
														
													<div class="col-sm-6 col-md-6 col-xs-12 paddingleftzero">
														<div class="form-group">
															<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('address');?></label>
															<div class="col-sm-12">
															<textarea rows="5" class=" form-control required" data-height="100" name="address" placeholder="address" ><?php echo $row['address'];?>"</textarea>	
															</div>
														</div>
													</div>														
													</div>
												</div>
												
												<div class="col-sm-12 col-md-12 col-xs-12 paddingleftzero">
												<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('Documents Details');?></label>
												<hr>
												</div>
												
												
												<div class="col-sm-12 col-md-12 col-xs-12 paddingleftzero">
												
													<div class="form-group">
														<div class="col-sm-6 col-md-6 col-xs-12 paddingleftzero">
														<div class="form-group">
															<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('adhar_card');?></label>
															<div class="col-sm-12">
																<input type="text" name="adharcard" id="adharcard" placeholder="<?php echo translate('adhar_card');?>" value="<?php echo $row['adharcard'];?>"  class="form-control required">
															</div>
														</div>
													</div>	
													
														<div class="col-sm-6 col-md-6 col-xs-12 paddingleftzero">
														<div class="form-group">
															<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('pan_card');?></label>
															<div class="col-sm-12">
																<input type="text" name="pancard" id="pancard" 
																value="<?php echo $row['pancard'];?>" placeholder="<?php echo translate('pan_card');?>" class="form-control required">
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
																	 
																	<?php
																	
																		if($row['profile_image'] != ''){
																			if(file_exists('uploads/abdaily_profile_images/'.$row['profile_image'])){
																		?>
																			<img src="<?php echo base_url(); ?>uploads/abdaily_profile_images/<?php echo $row['profile_image']; ?>" width="100%" id="profile_main_images_blah" />  
																		<?php
																			} else {
																		?>
																			<img src="<?php echo base_url(); ?>uploads/other_images/default.png" width="100%" id="profile_main_images_blah" />
																		<?php
																			}
																		}else{?>
																			<img src="<?php echo base_url(); ?>uploads/other_images/default.png" width="100%" id="profile_main_images_blah" />
																		<?php }
																	?> 
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
																<?php
																	
																		if($row['adharcard_image'] != ''){
																			if(file_exists('uploads/abdaily_adharcard_images/'.$row['adharcard_image'])){
																		?>
																			<img src="<?php echo base_url(); ?>uploads/abdaily_adharcard_images/<?php echo $row['adharcard_image']; ?>" width="100%" id="adharcard_main_images_blah" />  
																		<?php
																			} else {
																		?>
																			<img src="<?php echo base_url(); ?>uploads/other_images/default.png" width="100%" id="adharcard_main_images_blah" />
																		<?php
																			}
																		}else{?>
																			<img src="<?php echo base_url(); ?>uploads/other_images/default.png" width="100%" id="adharcard_main_images_blah" />
																		<?php }
																	?> 
																	
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
																<?php
																	
																		if($row['pancard_image'] != ''){
																			if(file_exists('uploads/abdaily_pancard_images/'.$row['pancard_image'])){
																		?>
																			<img src="<?php echo base_url(); ?>uploads/abdaily_pancard_images/<?php echo $row['pancard_image']; ?>" width="100%" id="pancard_main_images_blah" />  
																		<?php
																			} else {
																		?>
																			<img src="<?php echo base_url(); ?>uploads/other_images/default.png" width="100%" id="pancard_main_images_blah" />
																		<?php
																			}
																		}else{?>
																			<img src="<?php echo base_url(); ?>uploads/other_images/default.png" width="100%" id="pancard_main_images_blah" />
																		<?php }
																	?> 
																	
																</span>
															</div>
														</div>															
													</div>
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
										<span class="btn btn-success btn-md btn-labeled fa fa-upload pull-left enterer" onclick="product_submit('product_edit','<?php echo translate('product_has_been_updated!'); ?>');" ><?php echo translate('upload');?></span>
									</div>
								</div>
							</div>
						</form>
						<?php } ?>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>    
<script>
	$(function () {
		$('.textarea').wysihtml5();
	})
</script>
<script>
	var base_url = '<?php echo base_url(); ?>';
	var user_type = 'admin';
	var module = 'user/users';
	var list_cont_func = 'list';
	var dlt_cont_func = 'delete';
	var extra = '';
	
  
    function other_forms(){}
	var selected_category_id = '<?php echo @$product_data[0]["category_id"]; ?>';
	var selected_sub_category_id = '<?php echo @$product_data[0]["sub_category_id"]; ?>';
	var selected_brand_logo = '<?php echo @$product_data[0]["brand_logo"]; ?>';
	var selected_our_range = '<?php echo @$product_data[0]["our_range"]; ?>';
	$(document).ready(function() {
		set_select();
		if(selected_category_id != ''){
			select_category(selected_category_id);
			$("#category").val(selected_category_id).trigger("chosen:updated");
		}
		if(selected_brand_logo != ''){
			$("#brand").val(selected_brand_logo).trigger("chosen:updated");
		}
		if(selected_our_range){
			$("#our_range").val(selected_our_range).trigger("chosen:updated");
		}
    });
    function set_select(){
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width:'100%'});
    }
	
    $('body').on('click', '.rmc', function(){
        $(this).parent().parent().remove();
    });
	

	$(document).ready(function() {
		$("form").submit(function(e){
			event.preventDefault();
		});
	});
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
	
	
</script>

<style>
	.btm_border{
		border-bottom: 1px solid #ebebeb;
		padding-bottom: 15px;	
	}
</style>