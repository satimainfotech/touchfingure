<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('contactus');?></h1>
		<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/abdaily/manage_website/cms_pages"><?php echo translate('back');?> </a>
		<input type="hidden" value="<?php echo base_url(); ?>admin/abdaily/manage_website/cms_pages" id="return_url">
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in" id="list">
						<div class="viewpages panel-body">
							<?php
								foreach($contactus_data as $row){
							?>
								<?php
									echo form_open(base_url() . 'admin/abdaily/manage_website/update_contactus/' . $row['contactus_id'], array(
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
														
														<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 paddingallzero">
															<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 paddingallzero">
																<div class="form-group">
																	<label class="col-sm-12 control-label" for="demo-hor-1"><?php echo translate('title');?></label>
																	<div class="col-sm-12">
																		<input type="text" name="title" id="demo-hor-1" placeholder="<?php echo translate('title');?>" class="form-control " value="<?php echo $row['title']; ?>">
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-sm-12 control-label" for="demo-hor-1"><?php echo translate('main_title');?></label>
																	<div class="col-sm-12">
																		<input type="text" name="page_small_title" id="demo-hor-1" placeholder="<?php echo translate('title');?>" class="form-control " value="<?php echo $row['title']; ?>">
																	</div>
																</div>
															</div>
															
															<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 paddingallzero">
																<div class="form-group">
																	<label class="col-sm-12 control-label" for="demo-hor-1"><?php echo translate('description');?></label>
																	<div class="col-sm-12">
																		<textarea type="text" name="page_description" id="demo-hor-1" placeholder="<?php echo translate('office_address_map');?>" class="form-control"><?php echo $row['page_description']; ?></textarea>
																	</div>
																</div>
															</div>
														
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
																<div class="form-group">
																	<label class="col-sm-12 control-label" for="demo-hor-1"><?php echo translate('office_address');?></label>
																	<div class="col-sm-12">
																		<textarea type="text" name="office_address" id="demo-hor-1" placeholder="<?php echo translate('office_address');?>" class="form-control"><?php echo $row['office_address']; ?></textarea>
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-sm-12 control-label" for="demo-hor-1"><?php echo translate('office_address_map');?></label>
																	<div class="col-sm-12">
																		<textarea type="text" name="office_address_map" id="demo-hor-1" placeholder="<?php echo translate('office_address_map');?>" class="form-control"><?php echo $row['office_address_map']; ?></textarea>
																	</div>
																</div>
															</div>
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 paddingallzero">
																<div class="form-group">
																	<label class="col-sm-12 control-label" for="demo-hor-1"><?php echo translate('email');?></label>
																	<div class="col-sm-12">
																		<input type="text" name="email" id="demo-hor-1" placeholder="<?php echo translate('email');?>" class="form-control " value="<?php echo $row['email']; ?>">
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-sm-12 control-label" for="demo-hor-1"><?php echo translate('contact_one');?></label>
																	<div class="col-sm-12">
																		<input type="text" name="contact_one" id="demo-hor-1" placeholder="<?php echo translate('contact_one');?>" class="form-control " value="<?php echo $row['contact_one']; ?>">
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-sm-12 control-label" for="demo-hor-1"><?php echo translate('wahtsapp');?></label>
																	<div class="col-sm-12">
																		<input type="text" name="contact_two" id="demo-hor-1" placeholder="<?php echo translate('contact_two');?>" class="form-control " value="<?php echo $row['contact_two']; ?>">
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
<script>
	$(function () {
		$('.textarea').wysihtml5();
	})
</script>
<script type="text/javascript">
	function header_image(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
	
			reader.onload = function(e) {
				$('#header_image_blah').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#header_image").change(function() {
		header_image(this);
	});
	function contactus_image(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
	
			reader.onload = function(e) {
				$('#contactus_image_blah').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#contactus_image").change(function() {
		contactus_image(this);
	});
	function set_select(){
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width:'100%'});
    }
    $(document).ready(function() {
		 set_select();
		$("form").submit(function(e){
			event.preventDefault();
		});
	});
</script>