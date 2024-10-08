<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('payment_receipt');?></h1>
		<input type="hidden" value="<?php echo base_url(); ?>admin//manage_website/payment_receipt" id="return_url">
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in" id="list">
						<div class="viewpages panel-body">
							<?php
								foreach($header_data as $row){
							?>
								<?php
									echo form_open(base_url() . 'admin//manage_website/payment_receipt_update/' . $row['payment_receipt_id'], array(
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
														
															<div class="form-group ">
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 paddinglzero">
																	<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('company_name');?></label>
																	<div class="col-sm-12">
																		<input type="text" name="company_name" id="demo-hor-1" placeholder="<?php echo translate('company_name');?>" class="form-control"  value="<?php echo $row['company_name']; ?>">
																	</div>
																</div>
																<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 paddinglzero">
																	<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('website_name');?></label>
																	<div class="col-sm-12">
																		<input type="text" name="website_name" id="demo-hor-1" placeholder="<?php echo translate('website_name');?>" class="form-control"  value="<?php echo $row['website_name']; ?>">
																	</div>
																</div>
																
															</div>		
															<div class="form-group ">
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 paddingrzero">
																	<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('office_address');?></label>
																	<div class="col-sm-12">
																		<input type="text" name="office_address" id="demo-hor-1" placeholder="<?php echo translate('office_address');?>" class="form-control"  value="<?php echo $row['office_address']; ?>">
																	</div>
																</div>
																<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 paddinglzero">
																	<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('customer_support');?></label>
																	<div class="col-sm-12">
																		<input type="text" name="customer_support" id="demo-hor-1" placeholder="<?php echo translate('customer_support');?>" class="form-control"  value="<?php echo $row['customer_support']; ?>">
																	</div>
																</div>
																
															</div>																
															<div class="form-group ">
																<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 paddingrzero">
																	<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('email');?></label>
																	<div class="col-sm-12">
																		<input type="text" name="email" id="demo-hor-1" placeholder="<?php echo translate('email');?>" class="form-control"  value="<?php echo $row['email']; ?>">
																	</div>
																</div>
																<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 paddingrzero">
																<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('cin_number');?></label>
																<div class="col-sm-12">
																	<input type="text" name="cin_number" id="demo-hor-1" placeholder="<?php echo translate('cin_number');?>" class="form-control"  value="<?php echo $row['cin_number']; ?>">
																</div>
																</div>
															</div>
															
															<div class="form-group ">
															<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 paddingrzero">
																<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('gst_no');?></label>
																<div class="col-sm-12">
																	<input type="text" name="gst_no" id="demo-hor-1" placeholder="<?php echo translate('gst_no');?>" class="form-control"  value="<?php echo $row['gst_no']; ?>">
																</div>
															</div>
															</div>
															
															
																<div class="form-group">
															
															<div class="col-sm-6">
															<label class="col-sm-6 control-label text-left" for="demo-hor-2">
																<?php echo translate('company_main_logo');?>
															</label>
																<span class="pull-left btn btn-default btn-file">
																	<?php echo translate('select_company_logo');?>
																	<input type="file" name="company_main_logo" id="company_main_logo" accept="image">
																</span>
																<span id="company_main_logo_wrap" class=" show_iin_image" style="width: 50px;float:right;
																border:1px solid #ddd;border-radius:5px;padding:5px">
																<?php if($row['company_main_logo'] != ''){ ?>
																<img src="<?php echo base_url(); ?>uploads/other_images/<?php echo $row['company_main_logo']; ?>" width="100%" id='company_main_logo_blah' />
																<?php } else {?> 
																	<img src="<?php echo base_url(); ?>uploads/other_image/default.png" width="100%" id='company_main_logo_blah' />
																<?php } ?>
																</span>
															</div>
														</div>
															
															<div class="form-group">
															
															<div class="col-sm-6">
															<label class="col-sm-6 control-label text-left" for="demo-hor-2">
																<?php echo translate('company_logo');?>
															</label>
																<span class="pull-left btn btn-default btn-file">
																	<?php echo translate('select_company_logo');?>
																	<input type="file" name="company_logo" id="company_logo" accept="image">
																</span>
																<span id="company_logo_wrap" class=" show_iin_image" style="width: 50px;float:right;
																border:1px solid #ddd;border-radius:5px;padding:5px">
																<?php if($row['company_logo'] != ''){ ?>
																<img src="<?php echo base_url(); ?>uploads/other_images/<?php echo $row['company_logo']; ?>" width="100%" id='company_logo_blah' />
																<?php } else {?> 
																	<img src="<?php echo base_url(); ?>uploads/other_image/default.png" width="100%" id='company_logo_blah' />
																<?php } ?>
																</span>
															</div>
														</div>
														
														<div class="form-group">
															
															<div class="col-sm-6 t">
															<label class="col-sm-6 control-label text-left" for="demo-hor-2">
																<?php echo translate('application_logo');?>
															</label>
																<span class="pull-left btn btn-default btn-file">
																	<?php echo translate('select_application_logo');?>
																	<input type="file" name="application_logo" id="application_logo" accept="image">
																</span>
																<span id="application_logo_wrap" class=" show_iin_image" style="width: 50px;float:right;
																border:1px solid #ddd;border-radius:5px;padding:5px">
														
																<?php if($row['application_logo'] != ''){ ?>
																<img src="<?php echo base_url(); ?>uploads/other_images/<?php echo $row['application_logo']; ?>" width="100%" id='application_logo_blah' />
																<?php } else {?> 
																	<img src="<?php echo base_url(); ?>uploads/other_image/default.png" width="100%" id='application_logo_blah' />
																<?php } ?>
																	
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
    
    	function company_main_logo(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
	
			reader.onload = function(e) {
				$('#company_main_logo_blah').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#company_main_logo").change(function() {
		company_main_logo(this);
	});
    
    
	function company_logo(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
	
			reader.onload = function(e) {
				$('#company_logo_blah').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#company_logo").change(function() {
		company_logo(this);
	});
	
	function application_logo(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
	
			reader.onload = function(e) {
				$('#application_logo_blah').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#application_logo").change(function() {
		application_logo(this);
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