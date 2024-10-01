<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('edit_a_social_media');?></h1>
		<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/manage_website/social_media<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>"><?php echo translate('back');?> </a>
		<input type="hidden" value="<?php echo base_url(); ?>admin/manage_website/social_media<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>" id="return_url">
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in" id="list">
						<div class="viewpages panel-body">
							<?php
								foreach($social_media_data as $row){
							?>
								<?php
									echo form_open(base_url() . 'admin/manage_website/social_media_update/' . $row['w_s_id'], array(
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
																<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('link');?></label>
																<div class="col-sm-12">
																	<input type="text" name="link" id="demo-hor-1" placeholder="<?php echo translate('link');?>" class="form-control " value="<?php echo $row['link']; ?>">
																</div>
															</div>
															<div class="form-group">
																<label class="col-sm-2 control-label" for="demo-hor-2">
																	<?php echo translate('image');?>
																</label>
																<div class="col-sm-12">
																	<span class="pull-left btn btn-default btn-file">
																		<?php echo translate('select_image');?>
																		<input type="file" name="social_icon" id='social_media' accept="image">
																	</span>
																	<span id="social_media_wrap" class=" show_iin_image" style="width: 50px;float:right;
																		border:1px solid #ddd;border-radius:5px;padding:5px">
																			<?php
																			if($row['icon'] != ''){
																				if(file_exists('uploads/web_social_icon/'.$row['icon'])){
																			?>
																				<img src="<?php echo base_url(); ?>uploads/web_social_icon/<?php echo $row['icon']; ?>" width="100%" id="social_media_blah" />  
																			<?php
																				} else {
																			?>
																				<img src="<?php echo base_url(); ?>uploads/web_social_icon/default.png" width="100%" id="social_media_blah" />
																			<?php
																				}
																			}else{?>
																				<img src="<?php echo base_url(); ?>uploads/web_social_icon/default.png" width="100%" id="social_media_blah" />
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
	
	function social_media(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
	
			reader.onload = function(e) {
				$('#social_media_blah').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#social_media").change(function() {
		social_media(this);
	});
	$(document).ready(function() {
		$("form").submit(function(e){
			event.preventDefault();
		});
	});
</script>