<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('add_student');?></h1>
		<?php if(@$deal != ''){ ?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/deal?c_n=<?php echo @$deal; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>"><?php echo translate('back');?> </a>
		<?php }else{ ?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/deal<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>"><?php echo translate('back');?> </a>
		<?php } ?>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in" id="list">
						<div class="viewpages panel-body">
							<?php
								echo form_open(base_url() . 'admin/deal/deal_do_add/', array(
									'class' => 'form-horizontal',
									'method' => 'post',
									'id' => 'deal_add',
									'enctype' => 'multipart/form-data'
								));
							?>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 customtabcontentview">
									<div class="panel-body">
										<div class="tab-base">
											<div class="tab-content">
												<div id="vendor_details" class="tab-pane fade active in">
													<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<div class="form-group  agent_product">
															<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('student name');?></label>
															<div class="col-sm-10">
																<input type="text" name="student_name" id="student_name" placeholder="<?php echo translate('student name');?>" class="form-control required">
															</div>
													</div>
													
														<div class="form-group ">
															<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('student mobile');?></label>
															<div class="col-sm-10">
																<input type="text" name="student_mobile" id="student_mobile" placeholder="<?php echo translate('student_mobile');?>" class="form-control required">
															</div>
														</div>
														<div class="form-group ">
															<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('student email');?></label>
															<div class="col-sm-10">
																<input type="text" name="student_email" id="student_email" placeholder="<?php echo translate('student_email');?>" class="form-control required">
															</div>
														</div>
														<div class="form-group ">
																<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('student address');?></label>
																<div class="col-sm-10">
																	<textarea type="text" name="student_address" id="demo-hor-1" placeholder="<?php echo translate('student_address');?>" class="form-control required" ></textarea>
																</div>
															</div>
														<div class="form-group">
														<label class="col-sm-2 control-label" for="demo-hor-2"><?php echo translate('bank');?></label>
														<div class="col-sm-10">
															<select name="student_bank_id" class="demo-chosen-select" data-placeholder="Choose a bank" id="bank">
																<option value="">Choose bank</option>
																<?php foreach($bank_data as $b_row){ 
																?>
																	<option value="<?php echo $b_row['bank_id']; ?>-<?php echo $b_row['bank_name']; ?>" ><?php echo $b_row['bank_name']; ?> -<?php echo $b_row['bank_name']; ?></option>
																<?php } ?>
															</select>
														</div>
														</div>
														<div class="form-group ">
															<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('student bank account number');?></label>
															<div class="col-sm-10">
																<input type="text" name="student_account_number" id="student_account_number" placeholder="<?php echo translate('student_account_number');?>" class="form-control required">
															</div>
														</div>
														<div class="form-group ">
															<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('loan amount');?></label>
															<div class="col-sm-10">
																<input type="text" name="loan_amount" id="loan_amount" placeholder="<?php echo translate('loan_amount');?>" class="form-control required">
															</div>
														</div>
														<div class="form-group ">
															<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('Loan Margin Percentage');?></label>
															<div class="col-sm-10">
																<input type="text" name="loan_margin_percentage" onchange="loan_margin(this.value);" id="loan_margin_percentage" placeholder="<?php echo translate('loan_margin_percentage');?>" class="form-control required">
															</div>
														</div>
														
														<div class="form-group ">
															<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('Loan Return Amount');?></label>
															<div class="col-sm-10">
																<input type="text" name="loan_return_amount" id="loan_return_amount" placeholder="<?php echo translate('loan_return_amount');?>" class="form-control required" readonly>
															</div>
														</div>
														
														<div class="form-group ">
															<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('Loan Final Amount');?></label>
															<div class="col-sm-10">
																<input type="text" name="loan_final_amount" id="loan_final_amount" placeholder="<?php echo translate('loan_final_amount');?>" class="form-control required" readonly>
															</div>
														</div>
														
														
													<div class="form-group">
														<label class="col-sm-2 control-label" for="demo-hor-2"><?php echo translate('Agent');?></label>
														<div class="col-sm-10">
															<select name="agent_id" class="demo-chosen-select" data-placeholder="Choose a Agent" id="agent_id" onchange="get_agent_products(this.value);">
																<option value="">Choose Agent</option>
																<?php foreach($agent_data as $a_row){ 
																?>
																	<option value="<?php echo $a_row['agent_id']; ?>-<?php echo $a_row['agent_name']; ?>" ><?php echo $a_row['agent_name']; ?></option>
																<?php } ?>
															</select>
														</div>
													</div>
														<div class="form-group ">
														<label class="col-sm-2 control-label" for="demo-hor-2"><?php echo translate('Products');?></label>
														<div class="col-sm-10" id="product_id">
															<select name="product_id" class="demo-chosen-select" data-placeholder="Choose a Products" >
																<option value="">Choose Product</option>
																	
															</select>
														</div>
													</div>
													<div id="agent_product_details">
													</div>
														
														<div class="form-group">
														<label class="col-sm-2 control-label" for="demo-hor-2"><?php echo translate('Investor');?></label>
														<div class="col-sm-10">
															<select name="investor_id" class="demo-chosen-select" data-placeholder="Choose a Investor" id="investor_id" onchange="get_investor_details(this.value);">
																<option value="">Choose Investor</option>
																<?php foreach($investor_data as $i_row){ 
																?>
																	<option value="<?php echo $i_row['investor_id']; ?>-<?php echo $i_row['investor_name']; ?>" ><?php echo $i_row['investor_name']; ?></option>
																<?php } ?>
															</select>
														</div>
													</div>
													<div id="investor_details">													
													</div>
													
														<div class="form-group">
														<label class="col-sm-2 control-label" for="demo-hor-2"><?php echo translate('Investor bank');?></label>
														<div class="col-sm-10">
															<select name="investor_bank_id" class="demo-chosen-select" data-placeholder="Choose a bank" id="investor_bank_id">
																<option value="">Choose bank</option>
																<?php foreach($bank_data as $b_row){ 
																?>
																	<option value="<?php echo $b_row['bank_id']; ?>-<?php echo $b_row['bank_name']; ?>" ><?php echo $b_row['bank_name']; ?> -<?php echo $b_row['bank_name']; ?></option>
																<?php } ?>
															</select>
														</div>
													</div>
													
													<div class="form-group ">
															<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('investor bank account number');?></label>
															<div class="col-sm-10">
																<input type="text" name="investor_account_number" id="investor_account_number" placeholder="<?php echo translate('investor_account_number');?>" class="form-control required">
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
										<span class="btn btn-purple btn-labeled fa fa-refresh pro_list_btn pull-left " 
											onclick="page_reload(); "><?php echo translate('reset');?>
										</span>
										<span class="btn btn-success btn-md btn-labeled fa fa-upload pull-left enterer" onclick="ajax_form_submit('deal_add','<?php echo translate('deal_has_been_added!'); ?>','deal');"><?php echo translate('submit');?></span>
									</div>
								</div>
							</form>
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
	
	function get_agent_product_details(agent_prodcut_id)
	{
		var loan_amount = $("#loan_amount").val();
			var base_url = $('#base_url').val();	
			$.ajax({
				url : base_url+'deal/get_agent_product_details',
				type: 'POST',
				dataType: 'html',
				data: {agent_prodcut_id:agent_prodcut_id,loan_amount:loan_amount},
				success: function(data){
					if(data != ''){
						$('#agent_product_details').html(data);
					}
				}
			});
	}
	
	
	function get_agent_products(agent_id)
	{
			var base_url = $('#base_url').val();	
			$.ajax({
				url : base_url+'deal/get_agent_products',
				type: 'POST',
				dataType: 'html',
				data: {agent_id:agent_id},
				success: function(data){
				
					if(data != ''){
						$('#product_id').html(data);
						 $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width:'100%'});
					}
				}
			});
	}
	
	function get_investor_details(investor_id)
	{
			var loan_amount = $("#loan_final_amount").val();
			
			var base_url = $('#base_url').val();	
			$.ajax({
				url : base_url+'deal/get_investor_details',
				type: 'POST',
				dataType: 'html',
				data: {investor_id:investor_id,loan_amount:loan_amount},
				success: function(data){
					if(data != ''){
						$('#investor_details').html(data);
					}
				}
			});
	}
	function loan_margin(loan_margin_percentage)
	{		
		var loan_amount = $("#loan_amount").val();
		var loan_margin_percentage = parseFloat(loan_margin_percentage);
		var return_amount = (parseFloat(loan_amount) * loan_margin_percentage) / 100;
		var total_return_payment = parseFloat(loan_amount)-return_amount;
		
		$("#loan_final_amount").val(return_amount);
		$("#loan_return_amount").val(total_return_payment);
	}
</script>