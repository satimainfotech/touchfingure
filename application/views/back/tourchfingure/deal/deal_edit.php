	<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('edit_student');?></h1>
		<?php if(@$deal != ''){ ?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/deal?b_n=<?php echo @$deal; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>"><?php echo translate('back');?> </a>
			<input type="hidden" value="<?php echo base_url(); ?>admin/deal?b_n=<?php echo @$deal; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" id="return_url">
		<?php }else{ ?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/deal<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>"><?php echo translate('back');?> </a>
			<input type="hidden" value="<?php echo base_url(); ?>admin/deal<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>" id="return_url">
		<?php } ?>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in" id="list">
						<div class="viewpages panel-body">
							<?php
							
								foreach($deal_data as $row){
							?>
								<?php
									echo form_open(base_url() . 'admin/deal/deal_update/' . $row['deal_id'], array(
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
														
														<div class="form-group">
														<label class="col-sm-2 control-label" for="demo-hor-2"><?php echo translate('Agent');?></label>
														<div class="col-sm-10">
															<select name="agent_id" class="demo-chosen-select" data-placeholder="Choose a Agent" id="agent_id" onchange="get_agent_intrest_amount(this.value);">
																<option value="">Choose Agent</option>
																<?php foreach($agent_data as $a_row){ 
																if($a_row['agent_id'] == $row['agent_id']){
																				$selected = "selected='selected'";
																			}else{
																				$selected = "";
																			}
																?>
																	<option value="<?php echo $a_row['agent_id']; ?>" <?php echo $selected; ?> ><?php echo $a_row['agent_name']; ?></option>
																<?php } ?>
															</select>
														</div>
													</div>
													
														<div class="form-group">
														<label class="col-sm-2 control-label" for="demo-hor-2"><?php echo translate('Products');?></label>
														<div class="col-sm-10">
															<select name="agent_id" class="demo-chosen-select" data-placeholder="Choose a Products" id="product">
																<option value="">Choose Product</option>
																	<option value="bank_balance" <?php if($row['product'] == 'bank_balance'){ ?> selected="selected" <?php } ?>>Bank Balance </option>
																		<option value="fd" <?php if($row['product'] == 'fd'){ ?> selected="selected" <?php } ?>>FD</option>
																			<option value="loan_letter" <?php if($row['product'] == 'loan_letter'){ ?> selected="selected" <?php } ?>>Loan Letter</option>
															</select>
														</div>
													</div>
														
														
													
														
															<div class="form-group ">
																<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('student name');?></label>
																<div class="col-sm-10">
																	<input type="text" name="student_name" id="demo-hor-1" placeholder="<?php echo translate('name');?>" class="form-control required" value="<?php echo $row['student_name']; ?>">
																</div>
															</div>
															<div class="form-group ">
																<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('student mobile');?></label>
																<div class="col-sm-10">
																	<input type="text" name="student_mobile" id="demo-hor-1" placeholder="<?php echo translate('student_mobile');?>" class="form-control required" value="<?php echo $row['student_mobile']; ?>">
																</div>
															</div>
																<div class="form-group ">
																<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('student email');?></label>
																<div class="col-sm-10">
																	<input type="text" name="student_email" id="demo-hor-1" placeholder="<?php echo translate('student_email');?>" class="form-control required" value="<?php echo $row['student_email']; ?>">
																</div>
															</div>
															<div class="form-group ">
																<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('student address');?></label>
																<div class="col-sm-10">
																	<textarea type="text" name="student_address" id="demo-hor-1" placeholder="<?php echo translate('student_address');?>" class="form-control required" ><?php echo $row['student_address']; ?></textarea>
																</div>
															</div>
															<div class="form-group ">
																<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('loan amount');?></label>
																<div class="col-sm-10">
																	<input type="text" name="loan_amount" id="demo-hor-1" placeholder="<?php echo translate('name');?>" class="form-control required" value="<?php echo $row['loan_amount']; ?>">
																</div>
															</div>
															<div class="form-group">
															<label class="col-sm-2 control-label" for="demo-hor-2"><?php echo translate('months');?></label>
															<div class="col-sm-10">
																<select name="months" class="demo-chosen-select" data-placeholder="Choose a Months" id="bank">
																	<option value="">Choose Months</option>
																	<?php for($i=1;$i<24;$i++){ 
																	if($i == $row['months']){
																				$selected = "selected='selected'";
																			}else{
																				$selected = "";
																			}
																?>
																		<option value="<?php echo $i; ?>" <?php echo $selected; ?>  ><?php echo $i; ?></option>
																	<?php } ?>
																</select>
															</div>
														</div>
															<div class="form-group ">
																<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('intrest percentage');?></label>
																<div class="col-sm-10">
																	<input type="text" name="intrest_percentage" id="demo-hor-1" placeholder="<?php echo translate('name');?>" class="form-control required" value="<?php echo $row['intrest_percentage']; ?>">
																</div>
															</div>
														<div class="form-group ">
															<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('deal date');?></label>
															<div class="col-sm-10">
															<input type="date" name="deal_date" value="<?php echo $row['deal_date']; ?>" placeholder="To date" class="form-control required">
																
															</div>
														</div>
														
														<div class="form-group ">
															<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('addon');?></label>
															<div class="col-sm-10">
																<input type="text" name="addon" id="addon" placeholder="<?php echo translate('addon');?>" value="<?php echo $row['addon']; ?>" class="form-control required">
															</div>
														</div>
															<div class="form-group">
																<label class="col-sm-2 control-label" for="demo-hor-2"><?php echo translate('bank');?></label>
																<div class="col-sm-10">
																	<select name="bank_id" class="demo-chosen-select" data-placeholder="Choose a bank" id="bank_id" >
																		<option value="">Choose bank</option>
																		<?php foreach($bank_data as $b_row){ 
																			if($b_row['bank_id'] == $row['bank_id']){
																				$selected = "selected='selected'";
																			}else{
																				$selected = "";
																			}
																		?>
																			<option value="<?php echo $b_row['bank_id']; ?>" <?php echo $selected; ?>><?php echo $b_row['bank_name']; ?></option>
																		<?php } ?>
																	</select>
																</div>
															</div>
														<div class="form-group ">
															<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('Student Bank account number');?></label>
															<div class="col-sm-10">
																<input type="text" name="student_account_number" id="account_number" placeholder="<?php echo translate('student_account_number');?>" value="<?php echo $row['student_account_number']; ?>" class="form-control required">
															</div>
														</div>
														
														<div class="form-group">
														<label class="col-sm-2 control-label" for="demo-hor-2"><?php echo translate('Company');?></label>
														<div class="col-sm-10">
															<select name="investor_id" class="demo-chosen-select" data-placeholder="Choose a Company" id="agent_id">
																<option value="">Choose Company</option>
																<?php foreach($investor_data as $i_row){
																	if($i_row['investor_id'] == $row['investor_id']){
																	$selected = "selected='selected'";
																	}else{
																	$selected = "";
																	}																	
																?>
																	<option value="<?php echo $i_row['investor_id']; ?>" <?php echo $selected; ?> ><?php echo $i_row['investor_name']; ?></option>
																<?php } ?>
															</select>
														</div>
													</div>
													
													
														<div class="form-group">
														<label class="col-sm-2 control-label" for="demo-hor-2"><?php echo translate('Investor bank');?></label>
														<div class="col-sm-10">
															<select name="investor_bank_id" class="demo-chosen-select" data-placeholder="Choose a bank" id="investor_bank_id">
																<option value="">Choose bank</option>
																<?php foreach($bank_data as $bank_row){ 
																if($bank_row['bank_id'] == $row['investor_bank_id']){
																				$selected = "selected='selected'";
																			}else{
																				$selected = "";
																			}
																?>
																	<option value="<?php echo $bank_row['bank_id']; ?>" <?php echo $selected; ?> ><?php echo $bank_row['bank_name']; ?> -<?php echo $bank_row['bank_name']; ?></option>
																<?php } ?>
															</select>
														</div>
													</div>
													
													<div class="form-group ">
															<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('investor bank account number');?></label>
															<div class="col-sm-10">
																<input type="text" name="investor_account_number" id="investor_account_number" placeholder="<?php echo translate('investor_account_number');?>" 
																value="<?php echo $row['investor_account_number']; ?>" class="form-control required">
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
	
	function deal_image(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
	
			reader.onload = function(e) {
				$('#deal_image_blah').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#deal_image").change(function() {
		deal_image(this);
	});
	$(document).ready(function() {
		$("form").submit(function(e){
			event.preventDefault();
		});
	});
		function get_agent_intrest_amount(agent_id)
	{
			var base_url = $('#base_url').val();	
			$.ajax({
				url : base_url+'agent/agent_intrest_amount',
				type: 'POST',
				dataType: 'html',
				data: {agent_id:agent_id},
				success: function(data){
					if(data != ''){
						$('#intrest_percentage').val(data);
					}
				}
			});
	}
</script>