<div id="content-container">
	<div id="page-title" class="manybutton">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('subscribers');?></h1>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in">
						<div class="orderstable panel-body">
							<div class="reportfilterdiv">
								<form action="<?php echo base_url(); ?>admin/abdaily/subscribers" method="get">
									<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px min-height">
										<label>Email</label>
										<input type="text" name="p_n" value="<?php echo @$phone; ?>" placeholder="Email">
									</div>
									<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px min-height">
										<label>From date</label>
										<input type="date" name="f_d" value="<?php echo @$from_date; ?>" placeholder="From date">
									</div>
									<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px min-height">
										<label>To date</label>
										<input type="date" name="t_d" value="<?php echo @$to_date; ?>" placeholder="To date">
									</div>
									<div class="col-sm-3 col-xs-6 paddingonlyfive m-b-5px min-height">
										<button class="reportbutton">Search</button>
										<?php if(@$phone != '' || @$from_date != '' || @$to_date != ''){ ?>
											<a class="creportbutton" href="<?php echo base_url(); ?>admin/abdaily/subscribers">Reset</a>
										<?php } ?>
									</div>
								</form>
							</div>
							<div class="fixed-table-container">
								<div class="fixed-table-body">
									<table id="example" class="table table-striped table-bordered" style="width:100%">
										<thead>
											<tr>
												<th style="width:4px"><?php echo translate('Sr No.');?></th>
												
												<th class="minwidth150px"><?php echo translate('email');?></th>												
												
											</tr>
										</thead>
										<tbody>
										<?php
										
											if(!empty($all_subscribers)){
												$i = $page_id+0;
												foreach($all_subscribers as $row){
												$i++; 
											?>
											<tr>
												<td><?php echo $i; ?></td>
												
												<td>
													<?php if($row['email'] != ''){ 
														echo $row['email']; 
													}else {
														echo '- - - N/A - - -'; 
													}   ?>
												</td>
												
											</tr>
										<?php } }else{ ?>
											<tr style="text-align:center;">
												<td colspan="9">Data Not Found....</td>
											</tr>	
										<?php } ?>
										</tbody>
									</table>
								</div>  
							</div>  
						</div>  
						<div class="custom_pagination">
							<?php echo $links; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<span id="prod" style="display:none;"></span>
<script>
	var base_url = '<?php echo base_url(); ?>';
	var user_type = 'admin';
	var module = 'contact_enquire/contact_enquires';
	var list_cont_func = '';
	var delete_function = 'delete';
	var extra = 'contact_delete';
</script>