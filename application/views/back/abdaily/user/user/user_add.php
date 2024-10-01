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
											
												<div class="col-sm-3 col-md-3 col-xs-12 paddingzeroall">
																<label class="col-sm-12 control-label text-left" for="demo-hor-2"><?php echo translate('member_type');?></label>
																<div class="col-sm-12">
																	<select id="member_type_id" name="member_type_id" placeholder="Select a member type" class="demo-chosen-select required" >
																		<option value="">Select a member type</option>
																		<?php foreach($member_type_data as $member_type_row) { ?>
																			<option value="<?php echo $member_type_row['member_type_id']; ?>"><?php echo $member_type_row['member_type_name']; ?></option>
																		<?php } ?>
																	</select>
																</div>
												</div>
												<div class="col-sm-3 col-md-3 col-xs-12 paddingleftzero">
												
													<div class="form-group">
														<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('name');?></label>
														<div class="col-sm-12">
															<input type="text" name="name" id="demo-hor-1" placeholder="<?php echo translate('name');?>" class="form-control required">
														</div>
													</div>
												</div>
												
												<div class="col-sm-3 col-md-3 col-xs-12 paddingleftzero">
													<div class="form-group">
														<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('email');?></label>
														<div class="col-sm-12">
															<input type="text" name="email" id="email" placeholder="<?php echo translate('email');?>" class="form-control required">
														</div>
													</div>
												</div>
												
												<div class="col-sm-3 col-md-3 col-xs-12 paddingleftzero">
													<div class="form-group">
														<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('mobile');?></label>
														<div class="col-sm-12">
															<input type="text" name="mobile" id="mobile" placeholder="<?php echo translate('mobile');?>" class="form-control required">
														</div>
													</div>
												</div>
												
												
												
												<div class="col-sm-6 col-md-6 col-xs-12 paddingleftzero">
													<div class="form-group">
														<div class="col-sm-3 col-md-3 col-xs-12 paddingleftzero">
														<div class="form-group">
															<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('password');?></label>
															<div class="col-sm-12">
																<input type="password" name="password" id="password" placeholder="<?php echo translate('password');?>" class="form-control required">
															</div>
														</div>
													</div>
													<div class="col-sm-6 col-md-6 col-xs-12 paddingleftzero">
													<div class="form-group">
														<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('address');?></label>
														<div class="col-sm-12">
														<textarea rows="5" class=" form-control required" data-height="100" name="address" placeholder="address" ></textarea>
															
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
																<input type="text" name="adharcard" id="adharcard" placeholder="<?php echo translate('adhar_card');?>" class="form-control required">
															</div>
														</div>
													</div>	
													
														<div class="col-sm-6 col-md-6 col-xs-12 paddingleftzero">
														<div class="form-group">
															<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('pan_card');?></label>
															<div class="col-sm-12">
																<input type="text" name="pancard" id="pancard" placeholder="<?php echo translate('pan_card');?>" class="form-control required">
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
									</div>
								</div>
							</div>
							<div class="panel-footer">
								<div class="row">
									<div class="col-md-12 paddingzeroall">
										<span class="btn btn-purple btn-labeled fa fa-refresh pro_list_btn pull-left " onclick="form_reset(); "><?php echo translate('reset');?>
										</span>
										<span class="btn btn-success btn-md btn-labeled fa fa-upload pull-left enterer" onclick="product_submit('product_add','<?php echo translate('user_has_been_added!'); ?>');" ><?php echo translate('upload');?></span>
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
<script>
	$(function () {
		$('.textarea').wysihtml5();
	})
</script>
<script>
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

</script>

<style>
	.btm_border{
		border-bottom: 1px solid #ebebeb;
		padding-bottom: 15px;	
	}
</style>