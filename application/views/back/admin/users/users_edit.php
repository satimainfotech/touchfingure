<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('edit_a_users');?></h1>
		<?php
			if(@$name != '' || @$user_name != '' || @$mobile_number != '' || @$refrence_code != '' || @$account_status != ''){
		?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>mind1992gameadmin/users/regular_users?n_n=<?php echo @$name; ?>&u_n=<?php echo @$user_name; ?>&m_n=<?php echo @$mobile_number; ?>&r_c=<?php echo @$refrence_code; ?>&a_s=<?php echo @$account_status; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>"><?php echo translate('back');?> </a>
			<input type="hidden" value="<?php echo base_url(); ?>mind1992gameadmin/users/regular_users?n_n=<?php echo @$name; ?>&u_n=<?php echo @$user_name; ?>&m_n=<?php echo @$mobile_number; ?>&r_c=<?php echo @$refrence_code; ?>&a_s=<?php echo @$account_status; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" id="return_url">
		<?php }else{ ?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>mind1992gameadmin/users/regular_users<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>"><?php echo translate('back');?> </a>
			<input type="hidden" value="<?php echo base_url(); ?>mind1992gameadmin/users/regular_users<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>" id="return_url">
		<?php } 
		?>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in" id="list">
						<div class="viewpages panel-body">
							<?php
								foreach($users_data as $row){
							?>
								<?php
									echo form_open(base_url() . 'mind1992gameadmin/users/regular_update/' . $row['user_id'], array(
										'class' => 'form-horizontal',
										'method' => 'post',
										'id' => 'form_edits',
										'enctype' => 'multipart/form-data'
									));
								?>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 customtabcontentview fulllabel">
										<div class="panel-body">
											<div class="tab-base">
												 <div class="tab-content">
													<div id="vendor_details" class="tab-pane fade active in">
														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
															<div class="form-group ">
																<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('name');?></label>
																<div class="col-sm-12">
																	<input type="text" name="name" id="demo-hor-1" placeholder="<?php echo translate('name');?>" class="form-control required" value="<?php echo $row['name']; ?>">
																</div>
															</div>
															<div class="form-group ">
																<label class="col-sm-2 control-label responsivezero" for="demo-hor-1"><?php echo translate('user name');?></label>
																<div class="col-sm-12 responsivezero">
																	<input type="text" name="user_name" id="demo-hor-1" placeholder="<?php echo translate('user name');?>" class="form-control required" value="<?php echo $row['team_name']; ?>" readonly>
																</div>
															</div>
															<div class="form-group ">
																<label class="col-sm-2 control-label" for="demo-hor-2"><?php echo translate('Mobile');?></label>
																<div class="col-sm-6">
																	<?php echo $this->crud_model->select_country_code_html('country_code','country_code','phonecode','edit','demo-chosen-select required',$row['country_code'],'',NULL,'','','nicename'); ?>
																</div>
																<div class="col-sm-6">
																	<input type="text" name="mobile_number" id="mobile_number" min="0" placeholder="<?php echo translate('mobile');?>" class="form-control required number" onkeyup="check_mobile_number(this.value);" pattern="\d{3}[\-]\d{3}[\-]\d{4}" value="<?php echo $row['mobile_number']; ?>">
																</div>
																<span class="exit_mobile" style="display:none;" >Mobile Number already exist.</span>
															</div>
															<div class="form-group ">
																<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('email');?></label>
																<div class="col-sm-12">
																	<input type="email" name="email" id="email" placeholder="<?php echo translate('email');?>" class="form-control " onchange="check_email(this.value);" value="<?php echo $row['email']; ?>">
																</div>
																<span class="exit_email" style="display:none;" >Email already exist.</span>
															</div>
															
														</div>
														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
															<div class="form-group ">
																<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('Referral Code');?></label>
																<div class="col-sm-12">
																	<input type="text" name="my_refer_code" id="demo-hor-1" placeholder="<?php echo translate('Referral Code');?>" class="form-control " value="<?php echo $row['register_with_refer_code']; ?>" readonly>
																</div>
															</div>
															<div class="form-group">
																<label class="col-sm-2 control-label" for="demo-hor-2">
																	<?php echo translate('image');?>
																</label>
																<div class="col-sm-12">
																	<span class="pull-left btn btn-default btn-file">
																		<?php echo translate('select_image');?>
																		<input type="file" name="profile_image" id='profile_image' accept="image">
																	</span>
																	<span id="profile_image_wrap" class=" show_iin_image" style="width: 50px;float:right; border:1px solid #ddd;border-radius:5px;padding:5px">
																		<?php
																			if($row['profile_image'] != ''){
																				if(file_exists('uploads/user_image/'.$row['profile_image'])){
																			?>
																				<img src="<?php echo base_url(); ?>uploads/user_image/<?php echo $row['profile_image']; ?>" width="100%" id="profile_image_blah" />  
																			<?php
																				} else {
																			?>
																				<img src="<?php echo base_url(); ?>uploads/user_image/default.jpg" width="100%" id="profile_image_blah" />
																			<?php
																				}
																			}else{?>
																				<img src="<?php echo base_url(); ?>uploads/user_image/default.jpg" width="100%" id="profile_image_blah" />
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
									<div class="panel-footer">
										<div class="row">
											<span class="btn btn-success btn-md btn-labeled fa fa-wrench pull-left enterer" onclick="ajax_form_submit('form_edits','<?php echo translate('successfully_edited!'); ?>');"><?php echo translate('update');?></span> 
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
</div>
<script type="text/javascript">
    
    function set_select(){
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width:'100%'});
    }
    
	$(document).ready(function() {
        set_select();
    });
	var user_id = "<?php echo @$user_id; ?>";
	function profile_image(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
	
			reader.onload = function(e) {
				$('#profile_image_blah').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#profile_image").change(function() {
		profile_image(this);
	});
	$(document).ready(function() {
		$("form").submit(function(e){
			event.preventDefault();
		});
	});
	function check_mobile_number(mobile){
		var country_code = $('#country_code').val();
		if(country_code != ''){
			if(mobile.length == 10){
				$.ajax({
					url : base_url+'mind1992gameadmin/users/check_edit_mobile_number',
					type: 'POST',
					dataType: 'html',
					data: {mobile:mobile,country_code:country_code,user_id:user_id},
					success: function(data){
						if(data == 'yes'){
							var buttonp = $('.enterer');
							buttonp.addClass('disabled');
							$('.exit_mobile').show();
						}else{
							var buttonp = $('.enterer');
							buttonp.removeClass('disabled');
							$('.exit_mobile').hide();
						}
					}
				});
			}else{
				var buttonp = $('.enterer');
				buttonp.removeClass('disabled');
				$('.exit_mobile').hide();
			}
		}else{
			$('#mobile_number').val('');
			alert('Select a country code');
		}
	}
	
	function check_email(email){
		if(email != ''){
			$.ajax({
				url : base_url+'mind1992gameadmin/users/check_edit_email',
				type: 'POST',
				dataType: 'html',
				data: {email:email,user_id:user_id},
				success: function(data){
					if(data == 'yes'){
						var buttonp = $('.enterer');
						buttonp.addClass('disabled');
						$('.exit_email').show();
					}else{
						var buttonp = $('.enterer');
						buttonp.removeClass('disabled');
						$('.exit_email').hide();
					}
				}
			});
		}else{
			var buttonp = $('.enterer');
			buttonp.removeClass('disabled');
			$('.exit_email').hide();
		}
	}
</script>