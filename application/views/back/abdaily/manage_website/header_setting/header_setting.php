<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('header_setting');?></h1>
		<input type="hidden" value="<?php echo base_url(); ?>admin/abdaily/manage_website/header_setting" id="return_url">
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
									echo form_open(base_url() . 'admin/abdaily/manage_website/header_setting_update/' . $row['header_id'], array(
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
																	<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('contact_one');?></label>
																	<div class="col-sm-12">
																		<input type="text" name="contact_one" id="demo-hor-1" placeholder="<?php echo translate('contact_one');?>" class="form-control"  value="<?php echo $row['contact_one']; ?>">
																	</div>
																</div>
																<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 paddingrzero">
																	<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('email');?></label>
																	<div class="col-sm-12">
																		<input type="text" name="email" id="demo-hor-1" placeholder="<?php echo translate('email');?>" class="form-control"  value="<?php echo $row['email']; ?>">
																	</div>
																</div>
															</div>		
															<div class="form-group ">
																<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 paddinglzero">
																	<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('location');?></label>
																	<div class="col-sm-12">
																		<input type="text" name="location" id="demo-hor-1" placeholder="<?php echo translate('location');?>" class="form-control"  value="<?php echo $row['location']; ?>">
																	</div>
																</div>
																
															</div>																
															<div class="form-group ">
																<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('news');?></label>
																<div class="col-sm-12">
																	<input type="text" name="news" id="demo-hor-1" placeholder="<?php echo translate('news');?>" class="form-control"  value="<?php echo $row['news']; ?>">
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