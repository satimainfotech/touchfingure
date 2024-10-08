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
									<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px">
										<label>Txt Date</label>
										<input type="date" name="t_d" value="<?php echo @$txt_date; ?>" placeholder="Txt Date">
									</div>
									<div class="col-sm-2 col-xs-12 paddingonlyfive m-b-5px">
										<button class="reportbutton">Filter</button>
										<?php if(@$txt_date != ''){?>
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
												<th><?php echo translate('date');?></th>
												<th><?php echo translate('amount');?></th>
												<th><?php echo translate('total_spin');?></th>
												<th><?php echo translate('use_spin');?></th>
												<th><?php echo translate('details');?></th>
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
											<td><?php echo $i; ?></td>
											<td><?php if($row['win_bonus_date'] != ''){ echo $row['win_bonus_date'];  }else{ echo 'N/A'; } ?></td>
											<td><?php if($row['win_bonus_total_amount'] != ''){ echo 'Rs. '.$row['win_bonus_total_amount']; }else{ echo 'Rs. 0'; } ?></td>
											<td><?php if($row['win_bonus_total_spin'] != ''){ echo $row['win_bonus_total_spin']; }else{ echo 'N/A'; } ?></td>
											<td><?php if($row['win_bonus_use_total_spin'] != ''){ echo $row['win_bonus_use_total_spin']; }else{ echo 'N/A'; } ?></td>
											<td><?php $txt_data = json_decode($row['win_bonus_transaction_json'],true); 
												if(!empty($txt_data)){ ?>
													<div class="win_spin_txt">
														<?php 
															foreach($txt_data as $row_d){
														?>
															<p><b>Amount : </b><?php echo $row_d['amount']; ?> &nbsp; &nbsp; <b>Time : </b><?php echo $row_d['time']; ?></p>
														<?php
															}
														?>
													</div>
												<?php 
												}else{ 
													echo 'N/A'; 
												} ?>
											</td>
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