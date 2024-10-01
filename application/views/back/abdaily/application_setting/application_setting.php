<div id="content-container"> 
    <div id="page-title">
        <h1 class="page-header text-overflow custompagetitle"><?php echo translate('manage_application_setting'); ?></h1>
    </div>
    <div class="tab-base">
        <div class="panel">
			<div class="row">
				<div class="col-md-12">
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 customtabview">
						<ul class="nav nav-tabs">
							<?php
								$i=0;
								foreach($table_info as $row1){
									$i++;
							?>
								<li class="template_tab <?php if($i==1){ ?>active<?php } ?>">
									<a data-toggle="tab" href="#demo-stk-lft-tab-<?php echo $row1['application_setting_id']; ?>"><?php echo translate($row1['application_setting_name']);?></a>
								</li>
							<?php
								}
							?>
						</ul>
					</div>
					<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 customtabcontentview">
						<div class="tab-content">
						<?php
							$j=0;
							foreach($table_info as $row2){
								$j++;
						?>	
							<div id="demo-stk-lft-tab-<?php echo $row2['application_setting_id']; ?>" class="tab-pane fade <?php if($j==1){ ?>active in<?php } ?>">
								<div class="panel-body">
									<?php
										echo form_open(base_url() . 'admin/application_setting/update_setting/update/'.$row2['application_setting_id'], array(
											'class' => 'form-horizontal',
											'method' => 'post',
											'id' => '',
											'enctype' => 'multipart/form-data'
										));
									?>
										<div class="panel-body pt-panel-padding">
											<?php if($row2['application_setting_id'] == '1'){ ?>
												<div class="form-group">
													<div class="col-sm-12">
														<label class="col-sm-12 control-label text-left paddingleft"><?php echo translate('normal Update');?></label>
														<select class="only_option_select" name="application_setting_value">
															<option value="">Select Option</option>
															<option value="yes" <?php if($row2['application_setting_value'] == 'yes'){ echo 'selected'; }?>>Yes</option>
															<option value="no" <?php if($row2['application_setting_value'] == 'no'){ echo 'selected'; }?>>No</option>
														</select>
													</div>
												</div>
												<div class="form-group">
													<div class="col-sm-12">
														<label class="col-sm-12 control-label text-left paddingleft"><?php echo translate('Normal Update message');?></label>
														<input type="text" name="cms_content" value="<?php echo $row2['cms_content']; ?>"  class="form-control">
													</div>
												</div>
												<div class="form-group">
													<div class="col-sm-12">
														<label class="col-sm-12 control-label text-left paddingleft"><?php echo translate('fourse_update');?></label>
														<select class="only_option_select" name="application_setting_type">
															<option value="">Select Option</option>
															<option value="yes" <?php if($row2['application_setting_type'] == 'yes'){ echo 'selected'; }?>>Yes</option>
															<option value="no" <?php if($row2['application_setting_type'] == 'no'){ echo 'selected'; }?>>No</option>
														</select>
													</div>
												</div>
												<div class="form-group">
													<div class="col-sm-12">
														<label class="col-sm-12 control-label text-left paddingleft"><?php echo translate('Fource Update message');?></label>
														<input type="text" name="cms_page_link" value="<?php echo $row2['cms_page_link']; ?>"  class="form-control">
													</div>
												</div>
												<div class="form-group">
													<div class="col-sm-12">
														<label class="col-sm-12 control-label text-left paddingleft"><?php echo translate('version');?></label>
														<input type="text" name="version" value="<?php echo $row2['version']; ?>"  class="form-control">
													</div>
												</div>
											<?php }else if($row2['application_setting_id'] == '21'){ ?>
												<div class="form-group">
													<div class="col-sm-12">
														<label class="col-sm-12 control-label text-left paddingleft"><?php echo translate('min_withdraw_amount');?></label>
														<input type="text" name="application_setting_value" value="<?php echo $row2['application_setting_value']; ?>"  class="form-control">
													</div>
												</div>
												<div class="form-group">
													<div class="col-sm-12">
														<label class="col-sm-12 control-label text-left paddingleft"><?php echo translate('max_withdraw_amount');?></label>
														<input type="text" name="application_setting_type" value="<?php echo $row2['application_setting_type']; ?>"  class="form-control">
													</div>
												</div>
												<div class="form-group">
													<div class="col-sm-12">
														<label class="col-sm-12 control-label text-left paddingleft"><?php echo translate('withdraw_text');?></label>
														<input type="text" name="cms_content" value="<?php echo $row2['cms_content']; ?>"  class="form-control">
													</div>
												</div>
											<?php }else if($row2['application_setting_id'] == '2'){ ?> 
												<div class="form-group">
													<div class="col-sm-12">
														<label class="col-sm-12 control-label text-left paddingleft"><?php echo translate($row2['application_setting_name']);?></label>
														<select class="only_option_select" name="application_setting_value">
															<option value="">Select Option</option>
															<option value="yes" <?php if($row2['application_setting_value'] == 'yes'){ echo 'selected'; }?>>Yes</option>
															<option value="no" <?php if($row2['application_setting_value'] == 'no'){ echo 'selected'; }?>>No</option>
														</select>
													</div>
												</div>
											<?php }else if($row2['application_setting_id'] == '3'){ ?>
												<div class="form-group">
													<div class="col-sm-12">
														<label class="col-sm-12 control-label text-left paddingleft"><?php echo translate($row2['application_setting_name']);?></label>
														<input type="text" name="application_setting_value" value="<?php echo $row2['application_setting_value']; ?>"  class="form-control">
													</div>
												</div>
											<?php }else if($row2['application_setting_id'] == '4'){ ?>
												<div class="form-group">
													<div class="col-sm-12">
														<label class="col-sm-12 control-label text-left paddingleft"><?php echo translate($row2['application_setting_name']);?></label>
														<input type="text" name="application_setting_value" value="<?php echo $row2['application_setting_value']; ?>"  class="form-control">
													</div>
												</div>
											<?php }else if($row2['application_setting_id'] == '5'){ ?>
												<div class="form-group">
													<div class="col-sm-12">
														<label class="col-sm-12 control-label text-left paddingleft"><?php echo translate($row2['application_setting_name']);?></label>
														<input type="text" name="application_setting_value" value="<?php echo $row2['application_setting_value']; ?>"  class="form-control">
													</div>
												</div>
											<?php }else if($row2['application_setting_id'] == '17'){ ?>
												<div class="form-group">
													<div class="col-sm-12">
														<label class="col-sm-12 control-label text-left paddingleft"><?php echo translate($row2['application_setting_name']);?> (%)</label>
														<input type="text" name="application_setting_value" value="<?php echo $row2['application_setting_value']; ?>"  class="form-control">
													</div>
												</div>
											<?php }else if($row2['application_setting_id'] == '20'){ ?>
												<div class="form-group">
													<div class="col-sm-12">
														<label class="col-sm-12 control-label text-left paddingleft"><?php echo translate($row2['application_setting_name']);?> (%)</label>
														<input type="text" name="application_setting_value" value="<?php echo $row2['application_setting_value']; ?>"  class="form-control">
													</div>
												</div>
											<?php }else if($row2['application_setting_id'] == '13'){ ?>
												<div class="form-group">
													<div class="col-sm-12">
														<label class="col-sm-12 control-label text-left paddingleft"><?php echo translate($row2['application_setting_name']);?></label>
														<input type="text" name="application_setting_value" value="<?php echo $row2['application_setting_value']; ?>"  class="form-control">
													</div>
												</div>
											<?php }else if($row2['application_setting_id'] == '14'){ ?>
												<div class="form-group">
													<div class="col-sm-12">
														<select class="only_option_select" name="application_setting_value">
															<option value="">Select Option</option>
															<option value="single" <?php if($row2['application_setting_value'] == 'single'){ echo 'selected'; }?>>Single</option>
															<option value="both" <?php if($row2['application_setting_value'] == 'both'){ echo 'selected'; }?>>Both</option>
														</select>
													</div>
												</div>
											<?php }else if($row2['application_setting_id'] == '16'){ ?>
												<div class="form-group">
													<div class="col-sm-12">
														<label class="col-sm-12 control-label text-left paddingleft"><?php echo translate('Fource Logout');?></label>
														<select class="only_option_select" name="application_setting_value">
															<option value="">Select Option</option>
															<option value="yes" <?php if($row2['application_setting_value'] == 'yes'){ echo 'selected'; }?>>Yes</option>
															<option value="no" <?php if($row2['application_setting_value'] == 'no'){ echo 'selected'; }?>>No</option>
														</select>
													</div>
												</div>
												<div class="form-group">
													<div class="col-sm-12">
														<label class="col-sm-12 control-label text-left paddingleft"><?php echo translate('logout message');?></label>
														<input type="text" name="cms_content" value="<?php echo $row2['cms_content']; ?>"  class="form-control">
													</div>
												</div>
											<?php }else if($row2['application_setting_id'] == '18'){ ?>
												<div class="form-group">
													<div class="col-sm-12">
														<label class="col-sm-12 control-label text-left paddingleft"><?php echo translate('Advertisement Popup');?></label>
														<select class="only_option_select" name="application_setting_value">
															<option value="">Select Option</option>
															<option value="yes" <?php if($row2['application_setting_value'] == 'yes'){ echo 'selected'; }?>>Yes</option>
															<option value="no" <?php if($row2['application_setting_value'] == 'no'){ echo 'selected'; }?>>No</option>
														</select>
													</div>
												</div>
												<div class="form-group">
													<div class="col-sm-12">
														<label class="col-sm-12 control-label text-left paddingleft"><?php echo translate('Open Type');?></label>
														<select class="only_option_select" name="application_setting_type">
															<option value="">Select Option</option>
															<option value="open_match" <?php if($row2['application_setting_type'] == 'open_match'){ echo 'selected'; }?>>Match</option>
															<option value="open_add_cash" <?php if($row2['application_setting_type'] == 'open_add_cash'){ echo 'selected'; }?>>Add Cash</option>
															<option value="open_spin" <?php if($row2['application_setting_type'] == 'open_spin'){ echo 'selected'; }?>>Spin</option>
														</select>
													</div>
												</div>
												<div class="form-group">
													<div class="col-sm-12">
														<label class="col-sm-12 control-label text-left paddingleft"><?php echo translate('Open Match ID');?></label>
														<input type="text" name="version" value="<?php echo $row2['version']; ?>"  class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-12 control-label responsivezero text-left" for="demo-hor-2">
														<?php echo translate('advertisement_image');?>
													</label>
													<div class="col-sm-12">
														<span class="pull-left btn btn-default btn-file">
															<?php echo translate('select_image');?>
															<input type="file" name="advertisement_image" id='advertisement_image' accept="image">
														</span>
														<br/>
														<br/>
														<span id="advertisement_image_wrap" class=" show_iin_image" style="width: 250px;float:left;border:1px solid #ddd;border-radius:5px;padding:5px">
															<?php
															if($row2['app_menu_title'] != ''){
																if(file_exists('uploads/advertisement_image/'.$row2['app_menu_title'])){
															?>
																<img src="<?php echo base_url(); ?>uploads/advertisement_image/<?php echo $row2['app_menu_title']; ?>" width="100%" id="advertisement_image_blah" />  
															<?php
																} else {
															?>
																<img src="<?php echo base_url(); ?>uploads/advertisement_image/default.png" width="100%" id="advertisement_image_blah" />
															<?php
																}
															}else{?>
																<img src="<?php echo base_url(); ?>uploads/advertisement_image/default.png" width="100%" id="advertisement_image_blah" />
															<?php }
															?> 
														</span>
													</div>
												</div>
											<?php }else if($row2['application_setting_id'] == '19'){ ?>
												<div class="form-group">
													<div class="col-sm-12">
														<label class="col-sm-12 control-label text-left paddingleft"><?php echo translate('home_announcement');?></label>
														<select class="only_option_select" name="application_setting_value">
															<option value="">Select Option</option>
															<option value="yes" <?php if($row2['application_setting_value'] == 'yes'){ echo 'selected'; }?>>Yes</option>
															<option value="no" <?php if($row2['application_setting_value'] == 'no'){ echo 'selected'; }?>>No</option>
														</select>
													</div>
												</div>
												<div class="form-group">
													<div class="col-sm-12">
														<label class="col-sm-12 control-label text-left paddingleft"><?php echo translate('message');?></label>
														<input type="text" name="cms_content" value="<?php echo $row2['cms_content']; ?>"  class="form-control">
													</div>
												</div>
												<div class="announse_text">
													<p>1. Change in Lineups | IN : Ply Name (IND)  OUT : Ply Name (IND)</p>
													<p>2. The deadline for this match has been extended. Make it count.</p>
													<p>3. Match Delay due to rain.</p>
													<p>4. Match start shortly because bed weather.</p>
													<p>5. The result of all the matches of the night will be announced in the early morning. so don't panic...</p>
												</div>
											<?php } ?>
										</div>
										<div class="panel-footer text-left">
											<span class="btn btn-success btn-labeled fa fa-check app_setting" data-ing='<?php echo translate('saving'); ?>' data-msg='<?php echo translate('settings_updated!'); ?>'>
												<?php echo translate('update');?>
											</span>
										</div>
									</form>
								</div>
							</div>
						<?php
							}
						?>    
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>
</div>
<div style="display:none;" id="site"></div>
<!-- for logo settings -->
<script>
    var base_url = '<?php echo base_url(); ?>'
    var user_type = 'admin';
	function set_select(){
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width:'100%'});
    }
	function advertisement_image(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
	
			reader.onload = function(e) {
				$('#advertisement_image_blah').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#advertisement_image").change(function() {
		advertisement_image(this);
	});
	$(document).ready(function() {
		set_select();
		$("form").submit(function(e){
			return false;
		});
    });
</script>