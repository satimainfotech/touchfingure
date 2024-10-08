<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('users_transaction');?></h1>
		<?php
			if(@$name != '' || @$user_name != '' || @$mobile_number != '' || @$refrence_code != '' || @$account_status != ''){
		?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>mind1992gameadmin/users/regular_users?n_n=<?php echo @$name; ?>&u_n=<?php echo @$user_name; ?>&m_n=<?php echo @$mobile_number; ?>&r_c=<?php echo @$refrence_code; ?>&a_s=<?php echo @$account_status; ?><?php if(@$pages == ''){ }else{ echo "&page=$pages"; } ?>"><?php echo translate('back');?> </a>
		<?php }else{ ?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>mind1992gameadmin/users/regular_users<?php if(@$pages == ''){ }else{ echo "?page=$pages"; } ?>"><?php echo translate('back');?> </a>
		<?php } 
		?>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in" id="list">
						<div class="orderstable panel-body">
							<div class="reportfilterdiv">
								<form action="<?php echo base_url(); ?>mind1992gameadmin/users/regular_transaction_list" method="get">
									<input type="hidden" name="u_t" value="<?php echo @$user_token?>">
									<input type="hidden" name="u_i" value="<?php echo @$user_id?>">
									<input type="hidden" name="n_n" value="<?php echo @$name?>">
									<input type="hidden" name="u_n" value="<?php echo @$user_name?>">
									<input type="hidden" name="m_n" value="<?php echo @$mobile_number?>">
									<input type="hidden" name="r_c" value="<?php echo @$refrence_code?>">
									<input type="hidden" name="a_s" value="<?php echo @$account_status?>">
									<input type="hidden" name="pages" value="<?php echo @$pages?>">
									<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px searchboxs">
										<label>Type</label>
										<select id="txt_type" name="t_y" class="demo-chosen-select">
											<option value="">Select Status</option>
											<option value="Won a Contest">Won a Contest</option>
											<option value="Contests Joined">Contests Joined</option>
											<option value="Won Cashback">Won Cashback</option>
											<option value="Deposited Failed">Deposited Failed</option>
											<option value="Deposited Cash">Deposited Cash</option>
											<option value="Refund">Refund</option>
											<option value="Welcome Bonus added">Welcome Bonus added</option>
											<option value="Extra Cash added">Extra Cash Added</option>
											<option value="Extra Cashback added">Extra Cashback Added</option>
											<option value="Extra Bonus Added">Extra Bonus Added</option>
											<option value="Refer Bonus added">Refer Bonus added</option>
										</select>
									</div>
									<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px">
										<label>Txt Date</label>
										<input type="date" name="t_d" value="<?php echo @$txt_date; ?>" placeholder="Txt Date">
									</div>
									<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px searchboxs">
										<label>Status</label>
										<select id="account_status" name="a_s" class="demo-chosen-select">
											<option value="">Select Status</option>
											<option value="success">Success</option>
											<option value="failed">Failed</option>
										</select>
									</div>
									<div class="col-sm-2 col-xs-12 paddingonlyfive m-b-5px">
										<button class="reportbutton">Filter</button>
										<?php if(@$txt_type != '' || @$txt_date != '' || @$txt_status != ''){?>
											<a class="reportbutton" href="<?php echo base_url(); ?>mind1992gameadmin/users/regular_transaction_list?u_t=<?php echo @$user_token; ?>&u_i=<?php echo @$user_id; ?><?php if(@$pages == ''){ }else{ echo "&pages=$pages"; } ?>">Filter Clear</a>
										<?php }else if(@$name != '' || @$user_name != '' || @$mobile_number != '' || @$refrence_code != '' || @$account_status != ''){ ?>
											<a class="reportbutton" href="<?php echo base_url(); ?>mind1992gameadmin/users/regular_transaction_list?u_t=<?php echo @$user_token; ?>&u_i=<?php echo @$user_id; ?>&n_n=<?php echo @$name; ?>&u_n=<?php echo @$user_name; ?>&m_n=<?php echo @$mobile_number; ?>&r_c=<?php echo @$refrence_code; ?>&a_s=<?php echo @$account_status; ?><?php if(@$pages == ''){ }else{ echo "&pages=$pages"; } ?>">Filter Clear</a>
										<?php } ?>
									</div>
								</form>
							</div>
							<div class="fixed-table-container">
								<div class="fixed-table-body">
									<table id="example" class="table table-striped table-bordered" style="width:100%">
										<thead>
											<tr>
												<th><?php echo translate('Sr.no');?></th>
												<th><?php echo translate('transaction_id');?></th>
												<th><?php echo translate('transaction_order_id');?></th>
												<th style="min-width:100px;"><?php echo translate('amount');?></th>
												<th><?php echo translate('Type');?></th>
												<th><?php echo translate('status');?></th>
												<th><?php echo translate('date');?></th>
												<th><?php echo translate('method');?></th>
												<th style="min-width:150px;"><?php echo translate('match');?></th>
												<th style="min-width:150px;"><?php echo translate('coupon_code');?></th>
											</tr>
										</thead>				
										<tbody >
										<?php
										if(!empty($txt_data)){
											$i = @$page_id + 0;
											foreach($txt_data as $row){
												$i++;
										?>     
										<tr>
											<td><?php echo $i; ?> (<?php if($row['txt_id'] != ''){ echo $row['txt_id'];  }else{ echo 'N/A'; } ?>)</td>
											<td><?php if($row['transaction_id'] != ''){ echo $row['transaction_id'];  }else{ echo 'N/A'; } ?></td>
											<td><?php if($row['txt_order_id'] != ''){ echo $row['txt_order_id']; }else{ echo 'N/A'; } ?></td>
											<td>
												<?php if($row['txt_type'] == 'add'){ $add_sign = '+'; }else{ $add_sign = '-'; } ?>
												<?php if($row['txt_amount'] != ''){ if($add_sign == '+'){  echo '<span style="color:green;font-size:14px;font-weight:600">'.$add_sign.' '.$row['txt_amount'].'</span>'; }else{ echo '<span style="color:#f00;font-size:14px;font-weight:600">'.$add_sign.' '.$row['txt_amount'].'</span>'; } }else{ echo 'N/A'; } ?>
											</td>
											<td><?php if($row['txt_contents'] != ''){ echo $row['txt_contents']; }else{ echo 'N/A'; } ?></td>
											<td><?php if($row['txt_status'] != ''){ if($row['txt_status'] == 'success'){ echo 'Success'; }else{ echo 'Failed'; } }else{ echo ''; } ?></td>
											<td><?php echo get_orignal_datetime($row['txt_date']); ?></td>
											<td><?php if($row['txt_method'] != ''){ echo $row['txt_method']; }else{ echo 'N/A'; } ?></td>
											<td><?php if($row['txt_match'] != ''){ echo get_field_id_name('match_data','match_id','short_title',$row['txt_match']); }else{ echo 'N/A'; } ?></td>
											<td><?php if($row['coupon_code'] != ''){ echo $row['coupon_code']; }else{ echo 'N/A'; } ?></td>
										</tr>
										<?php
											}
										}else{ ?>
											<tr style="text-align:center;">
												<td colspan="9">Data Not Found....</td>
											</tr>	
										<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<?php echo $links; ?>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
<span id="users" style="display:none;"></span>
<script>
	var base_url = '<?php echo base_url(); ?>'
	var user_type = 'mind1992gameadmin';
	var module = 'users/userss';
	var delete_function = 'delete';
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
	var selected_txt_type = '<?php echo @$txt_type; ?>';
	var selected_txt_status = '<?php echo @$txt_status; ?>';
	$(document).ready(function() {
        set_select();
		if(selected_txt_type != ''){
			$("#txt_type").val(selected_txt_type).trigger("chosen:updated");
		}
		if(selected_txt_status != ''){
			$("#txt_status").val(selected_txt_status).trigger("chosen:updated");
		}
	});
	$( document ).ready(function() {
		$(".sw2").each(function(){
			new Switchery(document.getElementById('accounts_'+$(this).data('id')), {color:'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
			var changeCheckbox = document.querySelector('#accounts_'+$(this).data('id'));
			changeCheckbox.onchange = function() {
			ajax_load(base_url+''+user_type+'/'+module+'/account_set/'+$(this).data('id')+'/'+changeCheckbox.checked,'pag','others');
			if(changeCheckbox.checked == true){
				var trans_msg = 'User successfully avtivated';
				$.activeitNoty({
					type: 'success',
					icon : 'fa fa-check',
					message : trans_msg,
					container : 'floating',
					timer : 3000
				});
			} else {
				var trans_msg = 'User successfully De-avtivated';
				$.activeitNoty({
					type : 'danger',
					icon : 'fa fa-check',
					message : trans_msg,
					container : 'floating',
					timer : 3000
				});
				
			  }
			};
		});
	});
</script>