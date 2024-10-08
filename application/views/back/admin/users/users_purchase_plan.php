<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('purchase_plan');?></h1>
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
								echo form_open(base_url() . 'mind1992gameadmin/users/regular_purchaseed_plan/' . $user_id, array(
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
													<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 responsivezero">
														<div class="form-group ">
															<label class="col-sm-2 control-label responsivezero" for="demo-hor-1"><?php echo translate('Membership Plan');?></label>
															<div class="col-sm-12 responsivezero">
																<select id="mem_plan" name="membership_plan" class="demo-chosen-select required" placeholder="Membership Plan">
																	<option value="">Select Membership Plan</option>
																	<?php foreach($plan as $m_data){?>
																		<option value="<?php echo $m_data['plan_id']?>" <?php if($users_data[0]['franchise_plan_id'] == $m_data['plan_id']){ echo "disabled"; }?>><?php echo $m_data['plan_name'].' ( Rs. '.$m_data['discount_price'].' )'?> <?php if($users_data[0]['franchise_plan_id'] == $m_data['plan_id']){ echo "( Activeted )"; }?></option>
																	<?php } ?>
																</select>
															</div>
														</div>
														<div class="form-group ">
															<label class="col-sm-2 control-label responsivezero" for="demo-hor-1"><?php echo translate('Payment Method');?></label>
															<div class="col-sm-12 responsivezero">
																<select id="pay_method" name="payment_method" class="demo-chosen-select required" onchange="select_payment_method(this.value);" placeholder="Payment Method">
																	<option value="">Select Payment Method</option>
																	<option value="paytm">Paytm</option>
																	<option value="google_pay">Google Pay</option>
																	<option value="phone_pay">Phone Pay</option>
																	<option value="online">Online</option>
																	<option value="cash">Cash</option>
																	<option value="net_banking">Net Banking</option>
																	<option value="cheque">Cheque</option>
																	<option value="free">Free</option>
																</select>
															</div>
														</div>
													</div>
													<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 responsivezero">
														<div class="form-group ">
															<label class="col-sm-2 control-label responsivezero" for="demo-hor-1"><?php echo translate('transaction_id');?></label>
															<div class="col-sm-12 responsivezero">
																<input type="text" name="transaction_id" id="demo-hor-1" placeholder="<?php echo translate('transaction_id');?>" class="form-control ">
															</div>
														</div>
														<div class="form-group" id="cheque_number" style="display:none">
															<label class="col-sm-2 control-label responsivezero" for="demo-hor-1"><?php echo translate('cheque_number');?></label>
															<div class="col-sm-12 responsivezero">
																<input type="text" name="cheque_number" id="cheque_numbers" placeholder="<?php echo translate('cheque_number');?>" class="form-control ">
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
										<span class="btn btn-success btn-md btn-labeled fa fa-upload pull-left enterer" onclick="ajax_form_submit('form_edits','<?php echo translate('membership_plan_successfully_purchased!'); ?>');"><?php echo translate('submit');?></span>
									</div>
								</div>
							</form>
						</div>
						<div class="viewpages panel-body">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 customtabcontentview fulllabel">
								<div class="panel-body">
									<div class="tab-base">
										<div class="tab-content">
											<div id="vendor_details" class="tab-pane fade active in">
												<h4>All Membership Plan with details</h4>
												<?php foreach($plan as $p_row){ ?>
												<div class="col-sm-3 col-md-3 col-lg-3 col-xs-12 plancoloum">
													<?php if($users_data[0]['franchise_plan_id'] == $p_row['plan_id']){ echo "<span class='plan_choosed'>Activated</span>"; }?>
													<h3><?php echo $p_row['plan_name']; ?></h3>
													<span class="price_name"><?php echo 'Rs. '.$p_row['discount_price']; ?></span>
													<div class="content_plan">
														<?php echo $p_row['contents']; ?>
													</div>
												</div>
												<?php } ?>
											</div>
										</div>
									</div>
								</div>
							</div>
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
	
	function select_payment_method(method){
		if(method == 'cheque'){
			$('#cheque_numbers').addClass('required');
			$('#cheque_number').show();
		}else{
			$('#cheque_numbers').removeClass('required');
			$('#cheque_number').hide();
			$('#cheque_numbers').val('');
		}
	}
	
</script>