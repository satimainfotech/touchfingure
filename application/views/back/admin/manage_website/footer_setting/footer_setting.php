<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('footer_setting');?></h1>
		<input type="hidden" value="<?php echo base_url(); ?>admin//manage_website/footer_setting" id="return_url">
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in" id="list">
						<div class="viewpages panel-body">
							<?php
								foreach($footer_data as $row){
							?>
								<?php
									echo form_open(base_url() . 'admin//manage_website/footer_setting_update/' . $row['footer_id'], array(
										'class' => 'form-horizontal',
										'method' => 'post',
										'id' => 'form_edits',
										'enctype' => 'multipart/form-data'
									));
								?>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 customtabcontentview">
										<div class="panel-body">
											<div class="tab-base">
												 <div class="tab-content">
													<div id="vendor_details" class="tab-pane fade active in">
														<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
															<div class="form-group ">
															<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 paddinglzero">
																	<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('description_title');?></label>
																	<div class="col-sm-12">
																		<input type="text" name="description_title" id="demo-hor-1" placeholder="<?php echo translate('description_title');?>" class="form-control"  value="<?php echo $row['description_title']; ?>">
																	</div>
																</div>
																
																<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 paddinglzero">
																	<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('menu_title');?></label>
																	<div class="col-sm-12">
																		<input type="text" name="menu_title" id="demo-hor-1" placeholder="<?php echo translate('menu_title');?>" class="form-control"  value="<?php echo $row['menu_title']; ?>">
																	</div>
																</div>
																
																
																<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 paddinglzero">
																	<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('contact_title');?></label>
																	<div class="col-sm-12">
																		<input type="text" name="address_title" id="demo-hor-1" placeholder="<?php echo translate('contact_title');?>" class="form-control"  value="<?php echo $row['address_title']; ?>">
																	</div>
																</div>
																<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 paddinglzero">
																	<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('content');?></label>
																	<div class="col-sm-12">
																		<textarea rows="9"  class="textareas" style="height:100px" name="content"><?php echo $row['content']; ?></textarea>
																	</div>
																</div>
																<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 paddinglzero">
																	<label class="col-sm-12 control-label text-left" for="demo-hor-2">
																		<?php echo translate('Logo');?>
																	</label>
																	<div class="col-sm-12">
																		<span class="pull-left btn btn-default btn-file">
																			<?php echo translate('select_logo');?>
																			<input type="file" name="logo" id='logo_image' accept="image">
																		</span>
																		<span id='logo_wrap' class="show_iin_image" style="width: 100px;float:right; border:1px solid #ddd;border-radius:5px;padding:5px">
																			<?php
																			if($row['logo'] != ''){
																				if(file_exists('uploads/other_images/'.$row['logo'])){
																			?>
																				<img src="<?php echo base_url(); ?>uploads/other_images/<?php echo $row['logo']; ?>" width="100%" id='logo_blah' />  
																			<?php
																				} else {
																			?>
																				<img src="<?php echo base_url(); ?>uploads/other_images/default.png" width="100%" id='logo_blah' />
																			<?php
																				}
																			}else{?>
																				<img src="<?php echo base_url(); ?>uploads/other_images/default.png" width="100%" id='logo_blah' />
																			<?php }
																			?> 
																		</span>
																	</div>
																</div>
															</div>
															<div class="form-group ">
																<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('address');?></label>
																<div class="col-sm-12">
																	<textarea rows="9"  class="textareas" style="height:100px" name="address"><?php echo $row['address']; ?></textarea>
																</div>
															</div>
															<div class="form-group ">
																<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 paddinglzero">
																	<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('contact_one');?></label>
																	<div class="col-sm-12">
																		<input type="text" name="contact_one" id="demo-hor-1" placeholder="<?php echo translate('contact_one');?>" class="form-control"  value="<?php echo $row['contact_one']; ?>">
																	</div>
																</div>
																<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 paddingrzero">
																	<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('whatsapp_number');?></label>
																	<div class="col-sm-12">
																		<input type="text" name="contact_two" id="demo-hor-1" placeholder="<?php echo translate('whatsapp_number');?>" class="form-control"  value="<?php echo $row['contact_two']; ?>">
																	</div>
																</div>
															</div>
																<div class="form-group ">
																<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 paddinglzero">
																	<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('whatsapp_message');?></label>
																	<div class="col-sm-12">
																		<textarea rows="9"  class="textareas" style="height:100px" name="whatsapp_message"><?php echo $row['whatsapp_message']; ?></textarea>
																	</div>
																</div>
															</div>
															<div class="form-group ">
																<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('email');?></label>
																<div class="col-sm-12">
																	<input type="text" name="email" id="demo-hor-1" placeholder="<?php echo translate('email');?>" class="form-control"  value="<?php echo $row['email']; ?>">
																</div>
															</div>
															<div class="form-group ">
																<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('map_link');?></label>
																<div class="col-sm-12">
																	<textarea rows="9"  class="textareas" style="height:100px" name="footer_map"><?php echo $row['footer_map']; ?></textarea>
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
											<span class="btn btn-success btn-md btn-labeled fa fa-wrench pull-left enterer" onclick="ajax_form_submit('form_edits','<?php echo translate('successfully_edited!'); ?>');" ><?php echo translate('update');?></span> 
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
<script>
	$(function () {
		$('.textarea').wysihtml5();
	})
</script>
<script>
    function other_forms(){}
	
    function set_select(){
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width:'100%'});
    }
	function logo_image(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
	
			reader.onload = function(e) {
				$('#logo_blah').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#logo_image").change(function() {
		logo_image(this);
	});
    $(document).ready(function() {
        set_select();
	});
    $('body').on('click', '.rmc', function(){
        $(this).parent().parent().remove();
    });
	$(document).ready(function() {
		$("form").submit(function(e){
			event.preventDefault();
		});
	});
</script>