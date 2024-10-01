	<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('edit_investor');?></h1>
		<?php if(@$investor != ''){ ?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/investor?b_n=<?php echo @$investor; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>"><?php echo translate('back');?> </a>
			<input type="hidden" value="<?php echo base_url(); ?>admin/investor?b_n=<?php echo @$investor; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" id="return_url">
		<?php }else{ ?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/investor<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>"><?php echo translate('back');?> </a>
			<input type="hidden" value="<?php echo base_url(); ?>admin/investor<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>" id="return_url">
		<?php } ?>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in" id="list">
						<div class="viewpages panel-body">
							<?php
								foreach($investor_data as $row){
							?>
								<?php
									echo form_open(base_url() . 'admin/investor/investor_update/' . $row['investor_id'], array(
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
																<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('investor name');?></label>
																<div class="col-sm-10">
																	<input type="text" name="investor_name" id="demo-hor-1" placeholder="<?php echo translate('name');?>" class="form-control required" value="<?php echo $row['investor_name']; ?>">
																</div>
															</div>
															<div class="form-group ">
																<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('investor mobile');?></label>
																<div class="col-sm-10">
																	<input type="text" name="investor_mobile" id="demo-hor-1" placeholder="<?php echo translate('name');?>" class="form-control required" value="<?php echo $row['investor_mobile']; ?>">
																</div>
															</div>
															<div class="form-group ">
																<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('investor email');?></label>
																<div class="col-sm-10">
																	<input type="text" name="investor_email" id="demo-hor-1" placeholder="<?php echo translate('name');?>" class="form-control required" value="<?php echo $row['investor_email']; ?>">
																</div>
															</div>
															<div class="form-group ">
															<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('investor Address');?></label>
															<div class="col-sm-10">
																<textarea type="text" name="investor_address" id="demo-hor-1" placeholder="<?php echo translate('investor_address');?>" class="form-control required"><?php echo $row['investor_address']; ?></textarea>
															</div>
														</div>
															<div class="form-group">
																<label class="col-sm-2 control-label" for="demo-hor-2"><?php echo translate('Bank branch');?></label>
																<div class="col-sm-10">
																	<select name="bank_id" class="demo-chosen-select" data-placeholder="Choose a branch" id="bank_id" >
																		<option value="">Choose Branch</option>
																		<?php foreach($bank_data as $b_row){ 
																			if($b_row['bank_id'] == $row['bank_id']){
																				$selected = "selected='selected'";
																			}else{
																				$selected = "";
																			}
																		?>
																			<option value="<?php echo $b_row['bank_id']; ?>" <?php echo $selected; ?>><?php echo $b_row['bank_name']; ?>-<?php echo $b_row['branch_name']; ?>- <?php echo $b_row['ifsc_code']; ?></option>
																		<?php } ?>
																	</select>
																</div>
															</div>
															<div class="form-group ">
															<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('Bank Acount Number');?></label>
															<div class="col-sm-10">
																<input type="text" name="bank_account_number" id="demo-hor-1" placeholder="<?php echo translate('bank_account_number');?>" value="<?php echo $row['bank_account_number']; ?>" class="form-control required">
															</div>
														</div>
															<div class="form-group " >
															<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('Intrest Rate');?></label>
															<div class="col-sm-10">
																<input type="text" name="intrest_rate" id="intrest_rate" placeholder="<?php echo translate('intrest_rate');?>" value="<?php echo $row['intrest_rate']; ?>" class="form-control required"></input>
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
	function other(){
	    set_select();
    }
    $(document).ready(function() {
        set_select();
	});
    $('body').on('click', '.rmc', function(){
        $(this).parent().parent().remove();
    });
	
	function investor_image(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
	
			reader.onload = function(e) {
				$('#investor_image_blah').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#investor_image").change(function() {
		investor_image(this);
	});
	$(document).ready(function() {
		$("form").submit(function(e){
			event.preventDefault();
		});
	});
</script>